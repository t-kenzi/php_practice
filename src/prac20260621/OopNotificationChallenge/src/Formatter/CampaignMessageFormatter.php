<?php

namespace App\Formatter;

use App\Entity\Member;
use App\Interfaces\MessageFormatterInterface;

class CampaignMessageFormatter implements MessageFormatterInterface
{
    private string $campaignTitle;

    public function __construct(string $campaignTitle)
    {
        $this->campaignTitle = $campaignTitle;
    }

    public function format(Member $member): string
    {
        if ($member->isPremium()) {
            return "{$member->getName()}さん限定のお知らせ: {$this->campaignTitle}";
        }

        return "{$member->getName()}さんへのお知らせ: {$this->campaignTitle}";
    }
}
