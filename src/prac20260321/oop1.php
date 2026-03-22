<?php
/*
類題：倉庫在庫管理システム

問題
1. ItemStock クラス
倉庫内の商品在庫を表すクラスです。

保持する情報
商品ID
在庫数

持つべき機能
在庫を増やす
在庫を減らす
現在の在庫数を取得する
商品IDを取得する

制約
在庫を減らすとき、在庫数が不足している場合は失敗させる
在庫数はマイナスにならないようにする
増減する数量は 1以上 であること

2. Warehouse クラス
倉庫を管理するクラスです。
ItemStock クラスを利用して商品在庫を管理します。

保持する情報
商品一覧

持つべき機能
商品を登録する
指定した商品の在庫を追加する
指定した商品の在庫を減らす
商品Aの在庫を別の倉庫へ移動する

3. 倉庫間移動の要件
倉庫Aから倉庫Bへ、指定した商品の在庫を移動する処理を実装してください。

条件
移動元の倉庫に、対象商品の十分な在庫がある場合のみ成功する
在庫不足の場合は失敗する
処理が失敗した場合、どちらの倉庫の在庫も変化しないこと
存在しない商品IDには操作できないこと
移動数量は 1以上 であること

共通ルール
在庫数は常に 0 以上であること
不正な数量は受け付けないこと
存在しない商品には操作できないこと

追加条件
余裕があれば、次も考えてください。
同じ商品IDは同じ倉庫内で重複登録できないようにする
倉庫ごとの在庫一覧を表示できるようにする
成功時は true、失敗時は false を返す
*/

class ItemStock
{
    private int $id;
    private int $stock;

    public function __construct(int $id, int $stock = 0)
    {
        $this->id = $id;
        $this->stock = $stock;
    }

    public function addStock(int $qty): bool
    {
        if ($qty < 1) {
            return false;
        }
        $this->stock += $qty;
        return true;
    }

    public function useStock(int $qty): bool
    {
        if ($qty < 1) {
            return false;
        }
        if ($this->stock < $qty) {
            return false;
        }
        $this->stock -= $qty;
        return true;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

class Warehouse
{
    /** @var array<int, ItemStock> */
    private array $stockLists;

    public function __construct()
    {
        $this->stockLists = [];
    }

    public function registerItem(int $id, int $initialStock = 0): bool
    {
        if ($id < 0) {
            return false;
        }
        if (array_key_exists($id, $this->stockLists)) {
            return false; // 重複登録不可
        }
        if ($initialStock < 0) {
            return false;
        }
        $this->stockLists[$id] = new ItemStock($id, $initialStock);
        return true;
    }

    public function addStock(int $id, int $qty): bool
    {
        if (!array_key_exists($id, $this->stockLists)) {
            return false;
        }
        return $this->stockLists[$id]->addStock($qty);
    }

    public function useStock(int $id, int $qty): bool
    {
        if (!array_key_exists($id, $this->stockLists)) {
            return false;
        }
        return $this->stockLists[$id]->useStock($qty);
    }

    public function transferTo(Warehouse $to, int $id, int $qty): bool
    {
        if ($qty < 1) {
            return false;
        }
        if (!array_key_exists($id, $this->stockLists)) {
            return false;
        }
        if (!array_key_exists($id, $to->stockLists)) {
            return false;
        }

        // 先に引き落とし可能かを確認し、成功したら相手へ加算
        if (!$this->stockLists[$id]->useStock($qty)) {
            return false;
        }

        // 加算は必ず成功する想定だが、失敗時は巻き戻す
        if (!$to->stockLists[$id]->addStock($qty)) {
            $this->stockLists[$id]->addStock($qty);
            return false;
        }

        return true;
    }

    public function getInventory(): array
    {
        $result = [];
        foreach ($this->stockLists as $id => $item) {
            $result[$id] = $item->getStock();
        }
        return $result;
    }
}

// --- Simple test code ---
if (PHP_SAPI === 'cli') {
    $a = new Warehouse();
    $b = new Warehouse();

    $a->registerItem(1, 10);
    $b->registerItem(1, 0);

    $a->addStock(1, 5);          // 15
    $a->useStock(1, 3);          // 12
    $ok = $a->transferTo($b, 1, 7); // A:5, B:7

    echo "transfer ok: " . ($ok ? 'true' : 'false') . PHP_EOL;
    echo "A inventory: " . json_encode($a->getInventory()) . PHP_EOL;
    echo "B inventory: " . json_encode($b->getInventory()) . PHP_EOL;

    $fail = $a->transferTo($b, 1, 10); // fail, A/B unchanged
    echo "transfer fail: " . ($fail ? 'true' : 'false') . PHP_EOL;
    echo "A inventory after fail: " . json_encode($a->getInventory()) . PHP_EOL;
    echo "B inventory after fail: " . json_encode($b->getInventory()) . PHP_EOL;
}
