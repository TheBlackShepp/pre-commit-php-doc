<?php

class Parameter
{
    public string $type;
    public string $name;

    public function __construct(string $type, string $name){
        $this->type = $type;
        $this->name = $name;
    }
}