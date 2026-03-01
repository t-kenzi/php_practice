<?php
class User{
    public string $name;
    public int $hp;
    public int $attack;
    public int $defence;
    public string $role;

    // 変更: 今回はコンストラクタを使わず、インスタンス生成後に代入する構成に変更

    public function displayStatus(){
        $text = "名前：{$this->name}"."\n"
            ."体力：{$this->hp}"."\n"
            ."攻撃力：{$this->attack}"."\n"
            ."防御力：{$this->defence}"."\n"
            ."役職：{$this->role}"."\n";
        echo $text;
    }
}

$hero = new User(); // 変更: 引数なしで生成
$hero->name = 'A'; // 変更: 生成後にプロパティを代入
$hero->hp = 100; // 変更
$hero->attack = 100; // 変更
$hero->defence = 100; // 変更
$hero->role = '勇者'; // 変更
$hero->displayStatus();

class Hero extends User{
    public string $equipment;

    // 変更: 3-4の要件に合わせて装備表示メソッドを追加
    public function displayEquipment(){
        echo "Heroの装備は{$this->equipment}です。\n";
    }

    // 変更: 引数なしで$this->nameを使う攻撃メソッドに変更
    public function attack(){
        $userAttack = "{$this->name}の攻撃"."\n";
        echo $userAttack;
    }   
}

$yusya = new Hero(); // 変更: 引数なしで生成
$yusya->name = '勇者'; // 変更
$yusya->hp = 120; // 変更
$yusya->attack = 150; // 変更
$yusya->defence = 80; // 変更
$yusya->role = '勇者'; // 変更
$yusya->equipment = '刀'; // 変更
$yusya->displayStatus();
$yusya->displayEquipment(); // 変更
$yusya->attack();


echo "------以下はenemyクラス------"."\n";

class Enemy extends User{
    public string $magic;

    public function displayMagicType(){
        $text = "{$this->name}は{$this->magic}魔法使いです"."\n";
        echo $text;
    }
}

$teki = new Enemy(); // 変更: 引数なしで生成
$teki ->name = 'A'; // 変更
$teki ->hp = 120; // 変更
$teki ->attack = 150; // 変更
$teki ->defence = 80; // 変更
$teki ->role = '敵'; // 変更
$teki -> magic = '刀';
$teki -> displayMagicType();
