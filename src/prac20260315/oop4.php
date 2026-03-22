<!-- 問題

「チケット」クラスを作成してください。

要件

チケット枚数を保持する

コンストラクタでは次のいずれかで初期化できるようにする

引数なし

数値

同じ Ticket クラスのオブジェクト

引数なしの場合は 0 枚で初期化する

数値で初期化する場合、0 未満の値は 0 として扱う

add() でチケットを1枚増やす

use() でチケットを1枚減らす

ただし、0 枚未満にはならないようにする

getCount() で現在のチケット枚数を取得できるようにする -->

<?php
class Ticket{
    private int $card;

    public function __construct(Ticket|int|null $value = null)
    {
        if($value instanceof Ticket){
            $this->card = $value->getCount();
        }else if($value >= 0){
            $this->card = $value;
        }else{
            $this->card = 0;
        }
    }

    public function add(){
        $this->card ++;
    }

    public function use(){
        if($this->card -1 < 0){
            echo "枚数が不足しています"."\n";
            return;
        }else{
            $this->card --;
        }
    }

    public function getCount(){
        return $this->card;
    }
}


$A = new Ticket(2);
$A -> add();
$A -> add();

$B = new Ticket($A);
$B -> use();
$B -> use();
$B -> use();
echo "残りチケットは{$B->getCount()}枚です"."\n";

$C = new Ticket(-5);
echo "チケット枚数は{$C->getCount()}"."\n";
