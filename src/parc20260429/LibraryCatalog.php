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

    public function registerBook(int $id, string $title, bool $lendStatus = false): void
    {
        $newBook = new Book($id, $title, $lendStatus);
        $this->booklists[] = $newBook;
    }

    public function searchBook(int $id){
        foreach($this->booklists as $book){
            if($book->getBookId() === $id){
                return $book;
            }
        }
    }

    public function checkBook(int $id){
        foreach($this->booklists as $book){
            if($book->getBookId() === $id){
                return true;
                }
            }
            return false;
    }

    public function getBookLists(){
        return $this->booklists;
    }

}
