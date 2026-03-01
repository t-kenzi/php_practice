<?php
class Book{
    public string $title;
    public int $price;

    public function __construct(string $title,int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function showInfo(){
        echo "この{$this->title}は{$this->price}円です";
    }

}

// インスタンス作成
$book = new Book('PHP入門', 2800);

// メソッド呼び出し
$book->showInfo();