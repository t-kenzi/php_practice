<!-- 
問い：Book クラスを作成してください。
プロパティ
title（文字列）
price（整数）
メソッド
showInfo()
→ 書籍名: ○○ / 価格: ○○円 を表示
その後、
Book のオブジェクトを1つ作成
title と price に値を入れる
showInfo() を呼び出す
-->

<?php
class Book{
    public string $title;
    public int $price;

    public function __construct(string $title, int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function showInfo(){
        return "書籍名：{$this->title}/価格：{$this->price}";
    }
}

$book = new Book('本', 1500);
echo $book->showInfo();