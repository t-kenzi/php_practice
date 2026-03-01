<?php

class MyClass{
    public int $width;
    public int $height;

    public function __construct(int $width,int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public static function square (int $width,int $height){
        $squareTotal = $width * $height;
        return $squareTotal;
    }
}

echo MyClass::square(4,5);

// 静的メソッドならインスタンスは不要
// インスタンスとして使用するならfunction squareをintに指定する