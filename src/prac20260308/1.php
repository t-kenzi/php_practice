<?php
class Person{
    protected string $name;
    protected int $age;
    protected string $gender;

    public function __construct($name,$age,$gender)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }

    public function addAge(){
        if($this->age <= 0){
            return;
        }
        $this->age += 1;
    }

    public function setName(){
        return $this->name;
    }

    public function setAge(){
        return $this->age;
    }

    public function setGender(){
        return $this->gender;
    }
}

$A = new Person('田中', 1, '女');
print("私は{$A->setName()}、{$A->setAge()}歳、{$A->setGender()}".PHP_EOL);
$A -> addAge();
print("私は{$A->setName()}、{$A->setAge()}歳、{$A->setGender()}".PHP_EOL);

