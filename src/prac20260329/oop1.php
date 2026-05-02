<!-- 作成するクラス
1. ProductStock クラス

商品の在庫を表すクラスです。

保持する情報
商品ID
在庫数

持つべき機能
在庫を追加する
在庫を減らす
現在の在庫数を取得する

2. InventoryManager クラス

在庫全体を管理するクラスです。
ProductStock を利用して処理を行います。

保持する情報
商品一覧

持つべき機能
商品を登録する
指定した商品の在庫を追加する
指定した商品の在庫を減らす
商品間で在庫を移動する


要件
① 不正な値のチェックを行う

以下の場合は処理を失敗させてください。

数量が 0 以下
存在しない商品への操作
在庫不足

➁ 在庫移動の整合性を守る

ある商品Aの在庫を減らし、商品Bへ在庫を移動する transferStock を実装してください。

条件
移動元の在庫が十分な場合のみ成功する
在庫不足の場合は失敗する
処理が失敗した場合、どちらの在庫数も変化しないこと

制限
メッセージの出力は「ProductStock」クラスでは行わない。
エラーメッセージや通知メッセージは全て「InventoryManager」クラスで行う。 -->
<?php
class ProductStock{
    private int $id;
    private int $stock;

    public function __construct($id, $stock){
        $this->id = $id;
        $this->stock = $stock;
    }

    // 在庫を追加する
    public function addStock($stock){
        if($stock < 0){
            return false;
        } else {
            $this->stock += $stock;
            return true;
        }
    }
    // 在庫を減らす
    public function removeStock($stock){
        if($this->stock < $stock){
            return false;
        } else {
            $this->stock -= $stock;
            return ture;
        }
    }

    // 現在の在庫数を取得する
    public function getStock(){
        return $this->stock;
    }
}

class InventoryManager{
    private array $stockLists;

    public function __construct(){
        $this->stockLists = [];
    }

    
}