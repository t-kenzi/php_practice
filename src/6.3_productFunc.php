<?php
function product(int ...$args)
{
    $result = 1;
    foreach($args as $arg){
        $result *= $arg;
    }
    return $result;
}

print product(1,2,3,4,5);