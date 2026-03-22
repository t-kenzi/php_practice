<!-- 要件

金額を保持する

同じ Balance オブジェクトを受け取って初期化できる

deposit() で金額を増やす

withdraw() で金額を減らす

0未満にはならないようにする

getAmount() で現在の金額を取得する

確認したい出力

次のような流れで確認してください。

最初のオブジェクトを作る

2回入金する

そのオブジェクトを元に別のオブジェクトを作る

別のオブジェクトで1回出金する

最後に現在の金額を出力する -->

<?php
class Balance{
    private int $money;

    public function __construct($base)
    {
        if($base instanceof Balance){
            $this->money = $base->getAmount();
        }else{
            $this->money = (int)$base;
        }
    }

    public function deposit(int $money){
        $this->money += $money;
    }

    public function drawwith(int $money){
        if($this->money - $money <= 0){
            print('残高が不足しています')."\n";
            return;
        }
        $this->money -= $money;
    }

    public function getAmount(){
        return $this -> money;
    }
}

$A = new Balance(100);
$A->deposit(100);
echo "Aの残高は{$A->getAmount()}円です"."\n";

$B = new Balance($A);
$B->deposit(100);
echo "Bの残高は{$B->getAmount()}円です"."\n";



