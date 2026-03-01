<?php
function diamond(int $diagonal1,int $diagonal2): int
{
    return $diagonal1 * $diagonal2 / 2; 
}

print diamond(2,2);