<?php

namespace App\Interfaces;

use App\Entity\Member;

interface MessageFormatterInterface
{
    public function format(Member $member): string;
}
