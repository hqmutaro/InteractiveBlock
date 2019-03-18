<?php

namespace nitf\pmmp\ib\type;

use pocketmine\math\Vector3;

abstract class Interactive{

    /** @var array $pos */
    private $pos = [];

    /** @var null $callable */
    private $callable = null;

    public function __construct(Vector3 $vector3, ?callable $callable){
        $this->pos["x"] = $vector3->getX();
        $this->pos["y"] = $vector3->getY();
        $this->pos["z"] = $vector3->getZ();
        $this->callable = $callable;
    }

    public function getX(): int{
        return $this->pos["x"];
    }

    public function getY(): int{
        return $this->pos["y"];
    }

    public function getZ(): int{
        return $this->pos["z"];
    }

    public function getCallable(): ?callable{
        return $this->callable;
    }
}