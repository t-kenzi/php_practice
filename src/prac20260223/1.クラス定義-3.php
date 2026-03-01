<!-- 
問い：User クラスを作成してください。
プロパティ
name（文字列）
age（整数）
メソッド
introduce()
→ 私は○○です。○歳です。 を表示
その後、
User オブジェクトを 2つ 作成する（例：田中さん、佐藤さん）
それぞれ異なる値を設定
2つとも introduce() を呼び出す
-->

<?php
class User{
    public string $name;
    public int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function introduce():string{
        return "私は{$this->name}です。{$this->age}歳です。";
    }
}

$user = new User('佐藤', 10);
$user2 = new User('田中',31);
echo $user->introduce();
echo $user2->introduce();