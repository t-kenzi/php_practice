<?php
function square(float $base ,float $height){
    $result = 0;
    $result = $base * $height;
    return $result;
}

print square(4,5);