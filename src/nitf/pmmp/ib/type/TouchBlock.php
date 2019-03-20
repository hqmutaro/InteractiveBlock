<?php

namespace nitf\pmmp\ib\type;

use pocketmine\math\Vector3;

class TouchBlock extends Interactive{

    /** @var array $data */
    private $data = [];

    public function __construct(Vector3 $vector3, ?callable $callable){
        parent::__construct($vector3, $callable);
    }

    public function setTitle(string $title): void{
        $this->data["title"] = $title;
    }

    public function setMessage(string $message): void{
        $this->data["message"] = $message;
    }

    public function addCommand(string $label, ?array $args): void{
        $this->data["command"]["label"] = $label;
        $this->data["command"]["args"] = $args;
    }

    public function getData(): array{
        $data = [];
        foreach ($this->data as $key => $value){
            switch ($key){
                case "title":
                    $data["title"] = $value;
                    break;
                case "message":
                    $data["message"] = $value;
                    break;
                case "command":
                    $cmd = $value["label"];
                    if (!empty($value["args"])){
                        foreach ($value["args"] as $args){
                            $cmd .= " " . $args;
                        }
                    }
                    $data["command"] = $cmd;
                    break;
            }
        }
        return $data;
    }
}