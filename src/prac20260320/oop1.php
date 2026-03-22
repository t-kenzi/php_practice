<!-- 1. BankAccount クラス
銀行口座を表すクラスです。

保持する情報
口座ID
残高

持つべき機能
入金する
出金する
現在の残高を取得する

制約
出金時、残高が不足している場合は処理を失敗させる
残高はマイナスにならないようにする

2. Bank クラス
銀行を管理するクラスです。
BankAccount クラスを利用して口座管理を行います。

保持する情報
口座一覧

持つべき機能
口座を開設する
指定口座へ入金する
指定口座から出金する
口座間で振替を行う

振替（transfer）の要件
口座Aから口座Bへお金を移動する処理を実装してください。

条件
出金元の残高が十分な場合のみ成功する
残高不足の場合は処理を失敗させる
処理が失敗した場合、どちらの口座の残高も変化しないこと

共通ルール
金額は 1 以上であること
残高はマイナスにならないこと
存在しない口座には操作できないこと -->
<!-- <?php
class BankAccount{
    private int $id;
    private int $balance;

    public function __construct($id,$balance){
        $this->id=$id;
        $this->balance=$balance;
    }

    public function deposit(int $in){
        if($in <= 0){
            echo "入金額が間違っています"."\n";
            return;
        }else{
            $this->balance+=$in;
        }
    }

    public function withdrawal(int $out){
        if($this->balance - $out < 0){
            echo "残高が不足しています"."\n";
            return;
        }else{
            $this->balance-=$out;
        }
    }

    public function getBalance(){
        return $this->balance;
    }
}

class Bank{
    private array $bankList;

    public function __construct(){
            $this->bankList =[];
    }
    // 口座を開設する
    public function kouza(){
        $N = count($this->bankList);
        $num = $N;

        $A = new BankAccount($num,0);
        array_push($this->bankList,$A);
    }

    // 指定口座へ入金する
    public function kouzaDeposit(int $id,int $money){
    // 引数から口座IDを受け取る
    // BankListから受け取った口座IDを検索する
        if(array_key_exists($id,$this->bankList)){
            foreach($this->bankList as $account){
                if($account->getId() == $id){
                    $account->balance += $money;
                }else{
                    return;
                }
            }
        }
    }

    // 指定口座から出金する
    // 口座間で振替を行う

    public function getId(){
        return $this->id;
    }
} -->