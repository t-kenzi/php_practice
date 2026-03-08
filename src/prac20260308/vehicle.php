<?php
class Vehicle{
    public int $speed;
    public int $fuel;

    public function __construct($speed,$fuel)
    {
        $this->speed = $speed;
        $this->fuel = $fuel;
    }

    public function speedUp($value){
        $this->speed += $value;
    }

    public function speedDown($value){
        $this->speed -= $value;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function getFuel(){
        return $this->fuel;
    }
}