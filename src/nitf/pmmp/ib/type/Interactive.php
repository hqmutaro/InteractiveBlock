<?php

namespace nitf\pmmp\ib\type;

use pocketmine\math\Vector3;

abstract class Interactive extends Vector3{

    /** @var array $pos */
    private $pos = [];

    /** @var null $callable */
    private $callable = null;

    public function __construct(Vector3 $vector3, ?callable $callable){
        parent::__construct($vector3->getX(), $vector3->getY(), $vector3->getZ());
        $this->callable = $callable;
    }

    public function getCallable(): ?callable{
        return $this->callable;
    }

    public function setCallable(?callable $callable): void{
        $this->callable = $callable;
    }
}