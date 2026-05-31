<?php
// 1. Room クラス
// 会議室1室の情報を表すクラスです。

// ・保持する情報
// 会議室ID
// 会議室名
// 定員

// ・持つべき機能
// 会議室IDを取得する
// 会議室名を取得する
// 定員を取得する
// ・責務
// Room は会議室1室の基本情報だけを管理する
// 予約可否そのものは判定しない
// メッセージ出力はしない
// ・ポイント
// 今回の Book よりさらに明確に、状態を持つだけのクラスとして扱うこと
// getter の意味を正しく理解すること
// 引数を返すのではなく、自分のプロパティを返すこと

class Room
{
    private int $roomId;
    private string $roomName;
    private int $capacity;

    public function __construct(int $roomId, string $roomName, int $capacity)
    {
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->capacity = $capacity;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getRoomName(): string
    {
        return $this->roomName;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }
}
