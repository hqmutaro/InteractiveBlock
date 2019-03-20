クロージャ使ってみたかっただけの自己満プラグイン
イベント登録しなくてもPlayerInteractEventが発火する際に処理できるコードが書けるヤツもどき
ほかのイベントも実装するかもしれない
# さんぽぅ
```php
<?php

namespace nitf\pmmp\ibsample;

use pocketmine\event\Event;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use nitf\pmmp\ib\InteractiveBlockPlugin;

class Main extends PluginBase{

    public function onEnable(): void{
        $this->onInteractiveBlock();
    }

    public function onInteractiveBlock(): void{
        $function = function (Event $e, Player $player, ?array $data){
            $player->sendMessage($data["title"]);
            $player->sendMessage($data["message"]);
            Server::getInstance()->dispatchCommand($player, $data["command"]);
        };
        $vector3 = new Vector3(287, 5, 338);
        $block = InteractiveBlockPlugin::registerTouchBlock($vector3, $function);
        $block->setTitle("title");
        $block->setMessage("message");
        $block->addCommand("give", ["nitf2003", "1", "64"]);
    }
}
```
