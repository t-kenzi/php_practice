<?php
class Person{
    public string $name;
    public int $age;

    public function __construct(string $name,int $age)
    {
        $this -> name = $name;
        $this -> age = $age;
    }

    public function displayInfo(){
        print ("名前：{$this->name}, 年齢：{$this->age}".PHP_EOL);
    }
}

$user = new Person('田中',10);
$user -> displayInfo();