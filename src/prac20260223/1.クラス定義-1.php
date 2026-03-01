<!-- 
問い：Greeting クラスを作成してください。
メソッド sayHello() を作る
sayHello() は "こんにちは、PHP OOP!" を表示する
その後、
Greeting クラスのオブジェクトを1つ作成し
sayHello() を呼び出してください
-->

<?php
class Greeting{
    public static function sayHello(){
        return "こんにちわ,PHP OOP!";
    }
}

echo Greeting::sayHello();