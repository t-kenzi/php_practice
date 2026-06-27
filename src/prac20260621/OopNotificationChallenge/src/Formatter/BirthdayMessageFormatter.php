<?php

namespace App\Formatter;

use App\Entity\Member;
use App\Interfaces\MessageFormatterInterface;

class BirthdayMessageFormatter implements MessageFormatterInterface
{
    private int $giftPoint;

    public function __construct(int $giftPoint)
    {
        $this->giftPoint = $giftPoint;
    }

    public function format(Member $member): string
    {
        return "{$member->getName()}さん、お誕生日おめでとうございます。{$this->giftPoint}ポイントをプレゼントしました。";
    }
}
