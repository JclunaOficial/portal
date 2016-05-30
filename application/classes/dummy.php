<?php

final class DummyClass {
    private $id;
    private $name;
    
    public function __construct() {
        $this->id = 0;
        $this->name = "";
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = UString::toEmpty($name);
    }
}