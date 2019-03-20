<?php

namespace nitf\pmmp\ib;

use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use nitf\pmmp\ib\type\TouchBlock;

class InteractiveBlockPlugin extends PluginBase implements Listener{

    /** @var array $blocks */
    private static $blocks = [];

    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public static function registerTouchBlock(Vector3 $vector3, ?callable $callable): TouchBlock{
        $block = new TouchBlock($vector3, $callable);
        self::$blocks[self::createId($vector3)] = $block;
        return $block;
    }

    public static function createId(Vector3 $vector3): int{
        return $vector3->getX() + $vector3->getY() + $vector3->getZ();
    }

    public function onInteract(PlayerInteractEvent $e): void{
        $player = $e->getPlayer();
        $block = $e->getBlock();

        if (!$this->isInteractiveBlock($block)){
            return;
        }
        if (!$this->getType($block) === "TouchBlock"){
            return;
        }
        $id = self::createId($block);
        $block = self::$blocks[$id];
        $callable = $block->getCallable();
        $data = $block->getData();
        if (isset($callable)){
            $callable($e, $player, $data);
        }
    }

    public function isInteractiveBlock(Block $block): bool{
        $id = self::createId(new Vector3($block->getX(), $block->getY(), $block->getZ()));
        return isset(self::$blocks[$id]);
    }

    public function getType(Block $block): string{
        $id = self::createId(new Vector3($block->getX(), $block->getY(), $block->getZ()));
        switch (true){
            case self::$blocks[$id] instanceof TouchBlock:
                return "TouchBlock";
        }
    }
}
