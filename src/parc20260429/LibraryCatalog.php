<?php
include "php_base/src/parc20260429/Book.php";

class LibraryCatalog
{
    // 保持する情報
    // - 本一覧：オブジェクトを作成

    // 持つべき機能
    // - 本を登録する
    // - 本IDで本を探す
    // - 本が存在するか確認する
    // - 本一覧を取得する

    // 責務
    // - 本の一覧管理専用のクラス
    // - 本を登録する
    // - 本IDから Book オブジェクトを取得する
    // - 本が存在するか確認する
    // - 貸出処理そのものは担当しない


    private array $booklists;

    public function __construct()
    {
        $this->booklists = [];
    }

    public function registerBook(int $id,string $title,$lendStatus = false){
        $newBook = new Book();

    }
}

