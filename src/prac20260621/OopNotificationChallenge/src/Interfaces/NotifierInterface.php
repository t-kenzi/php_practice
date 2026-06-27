<?php

namespace App\Interfaces;

use App\Entity\Member;

interface NotifierInterface
{
    public function send(Member $member, string $message): void;

    public function getName(): string;
}
