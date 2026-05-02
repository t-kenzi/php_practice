<?php

class Book
{
    // 保持する情報
    // - 本ID
    // - タイトル
    // - 貸出中かどうか

    // 持つべき機能
    // - 本IDを取得する
    // - タイトルを取得する
    // - 貸出中か確認する
    // - 本を貸出中にする
    // - 本を返却済みにする

    // 責務
    // - 本1冊の状態だけを管理する
    // - この本が貸出中かを扱う
    // - この本を貸出中にできるかを扱う
    // - この本を返却済みにできるかを扱う
    // - メッセージ出力はしない

    private int $bookId;
    private string $title;
    private bool $lendStatus;

    public function __construct(int $bookId,string $title,bool $lendStatus)
    {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->lendStatus = $lendStatus;
    }

    public function getBookId(){
        return $this->bookId;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getLendStatus(){
        return $this->lendStatus;
    }

    public function lendBook(){
        $this->lendStatus = true;
    }

    public function returnBook(){
        $this->lendStatus = false;
    }
}

