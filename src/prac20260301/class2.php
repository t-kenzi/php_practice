<?php
class Car{
    public string $brand;
    public string $model;
    public int $price;

    public function __construct(string $brand,string $model,int $price){
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
    }

    public function displayCarInfo(){
        print("ブランド：{$this->brand} 車種：{$this->model} 価格：{$this->price}".PHP_EOL);
    }
}

$toyota = new Car('Toyota','Camry',25000);
$toyota -> displayCarInfo();
$honda = new Car('Honda','Civic',20000);
$honda -> displayCarInfo();