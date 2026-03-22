<?php
require_once __DIR__."/vehicle.php";

class Bus extends Vehicle{
    public int $passengerCount;
    public int $sales;

    public function __construct($speed, $fuel, $passengerCount, $sales)
    {
        parent::__construct($speed, $fuel);
        $this->passengerCount = $passengerCount;
        $this->sales = $sales;
    }


    public function getPassengerCount(){
        return $this->passengerCount;
    }

    public function getSales(){
        return $this->sales;
    }
    //追加機能
    public function ride($fare)
    {
        if ($this->speed > 0) {
            return "走行中のため乗車できません";
        }
        if ($this->passengerCount >= 50) {
            return "50人以上は乗車できません";
        }

        $this->passengerCount += 1;
        $this->sales += $fare;
        return null;
    }

    public function getOff()
    {
        if ($this->speed > 0) {
            return "走行中のため降車できません";
        }
        if ($this->passengerCount <= 0) {
            return "乗客はいません";
        }

        $this->passengerCount -= 1;
        return null;
    }

}

$A = new Bus(0, 20, 50, 1);
$A->speedUp(1);
print("{$A->speed}".PHP_EOL);
print("{$A->ride(1)}".PHP_EOL);
print("{$A->getOff(1)}".PHP_EOL);
