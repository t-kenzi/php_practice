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
    private string $title;
    private int $price;

    public function __construct(string $title, int $price)
    {
        // 変更: setter経由でバリデーションを通す
        $this->setTitle($title);
        $this->setPrice($price);
    }

    // 変更: 戻り値型を明示
    public function getTitle(): string{
        return $this->title;
    }
    // 変更: 戻り値型を明示
    public function getPrice(): int{
        return $this->price;
    }

    // 変更: voidにし、値をセットする
    public function setTitle(string $title): void{
        if(empty($title)){
            throw new Exception("タイトルが未定です。");
        }
        $this->title = $title;
    }
    // 変更: voidにし、0未満のみ拒否して値をセット
    public function setPrice(int $price): void{
        if($price < 0){
            return;
        }
        $this->price = $price;
    }

    // 変更: voidにし、指定フォーマットで表示
    public function showInfo(): void{
        echo "書籍名: {$this->title} / 価格: {$this->price}円";
    }
}

$book = new Book('PHP',100);
$book->showInfo();
