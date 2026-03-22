<!-- 問題

「ポイント」クラスを作成してください。

要件

ポイント数を保持する

コンストラクタでは次のどちらかを受け取れるようにする

PointCounter オブジェクト

数値

引数が省略された場合は 0 で初期化する

add() でポイントを1増やす

use() でポイントを1減らす

0未満にはならないようにする

getPoint() で現在のポイント数を取得できるようにする -->
<?php
class Point{
    private int $point;

    public function __construct($catch)
    {
        if($catch instanceof Point){
            $this->point = $catch -> getPoint();
        }else{
            $this->point = (int)$catch;
        }
    }

    public function add(int $in){
        $this->point += $in;
    }

    public function use(int $out){
        $this->point -= $out;
    }

    public function getPoint(){
        return $this->point;
    }
}

$A = new Point(100);
echo "残ポイントは{$A->getPoint()}"."\n";

$B = new Point($A);
$B->add(100);
$B->use(50);
echo "残ポイントは{$B->getPoint()}"."\n";
