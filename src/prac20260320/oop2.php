<!-- 類題：ポイントカード管理システム
問題
1. PointAccount クラス
会員のポイント口座を表すクラスです。
・保持する情報
会員ID
保有ポイント
・持つべき機能
ポイントを加算する
ポイントを利用する
現在のポイント数を取得する
会員IDを取得する

・制約
ポイント利用時、保有ポイントが不足している場合は失敗させる
保有ポイントはマイナスにならないようにする
加算・利用するポイントは 1以上 であること

2. PointService クラス
ポイント口座をまとめて管理するクラスです。
PointAccount クラスを利用して会員管理を行います。
・保持する情報
会員口座一覧
・持つべき機能
新しい会員口座を作成する
指定会員にポイントを加算する
指定会員のポイントを利用する
会員Aから会員Bへポイントを移行する
・ポイント移行（transferPoints）の要件
会員Aのポイントを会員Bへ移す処理を実装してください。

条件
移行元のポイントが十分な場合のみ成功する
ポイント不足の場合は失敗する
処理が失敗した場合、どちらの会員のポイントも変化しないこと
存在しない会員IDには操作できないこと
移行するポイントは 1以上 であること

共通ルール
数値は不正な値にならないようにする
保有ポイントは常に 0 以上であること
存在しない会員に対する操作は失敗させること

追加条件
余裕があれば次も考えてください。
同じ会員IDでは口座を2つ作れないようにする
会員一覧を確認できるようにする
処理成功時は true、失敗時は false を返す -->

<?php
class PointAccount{
    private int $id;
    private int $point;

    public function __construct(int $id,int $point = 1)
    {
        $this->id = $id;
        $this->point = $point;
    }
// ポイントを加算する
    public function addPoint(int $in){
        if($in < 0){
            return;
        }elseif($this->point < $in)
            return;
        else{
            $this->point += $in;
        }
    } 
// ポイントを利用する
    public function outPoint(int $out){
        if($out < 0){
            return;
        }elseif($this->point < $out)
            return;
        else{
            $this->point -= $out;
        }
    }
// 現在のポイント数を取得する
    public function getPoint(){
        return $this->point;
    }
// 会員IDを取得する
    public function getAccountID(){
        return $this->id;
    }
}

class PointService{
    private array $PointIdLists;

    public function __construct()
    {
        $this->pointIdLists = [];
    }
// 新しい会員口座を作成する
    public function newAccount(){
        $idcount = count($this->pointIdLists);
        $A = new PointAccount($idcount,1);
        array_push($this->pointIdLists,$A);
    }
// 指定会員にポイントを加算する
    public function addAccountPoint(int $id,int $addPoint){
        $addUser = new PointAccount($id);
        if($addUser == null){
            return;
        }else{
            $addUser->addPoint($addPoint);
        }

    }
// 指定会員のポイントを利用する
    public function useAccountPoint(int $id,int $addPoint){
        $outUser = new PointAccount($id);
        if($outUser == null){
            return;
        }else{
            $outUser->outPoint($addPoint);
        }
    }
// 会員Aから会員Bへポイントを移行する
    public function changeUsePointAccount($A,$B,$usePoint){
        $userTo = new PointAccount($A);
        $userFrom = new PointAccount($B);
        if($userTo == null || $userFrom == null){
            retun;
        }else if( $userTo->getPoint()<$usePoint|$userFrom->getPoint()<$usePoint){
            return;
        }else{
            $userTo->outPoint($usePoint);
            $userFrom->point = $userTo->getPoint();
        }
    }
}