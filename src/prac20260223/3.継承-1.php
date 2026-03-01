<!-- 
お題
Book クラスを作成してください。
条件
プロパティ
title（文字列） → private
price（整数） → private
メソッド
setTitle(string $title): void
getTitle(): string
setPrice(int $price): void
0未満の値は設定しない
getPrice(): int
showInfo(): void
書籍名: ○○ / 価格: ○○円 を表示
-->

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
        return "書籍名：{$this->title} 価格：{$this->price}";
    }
}

class Ebook extends Book{
    
}



$book = new Book('PHP',100);
$book->showInfo();
