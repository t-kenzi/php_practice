<?php
// 3. Reservation クラス
// 予約1件の情報を表すクラスです。

// ・保持する情報
// 予約ID
// 会議室ID
// 社員ID
// 利用日
// 開始時刻
// 終了時刻
// キャンセル済みかどうか

// ・持つべき機能
// 予約IDを取得する
// 会議室IDを取得する
// 社員IDを取得する
// 利用日を取得する
// 開始時刻を取得する
// 終了時刻を取得する
// キャンセル済みか確認する
// キャンセル済みにする
// 指定した日時帯と重複しているか確認する
// ・責務
// Reservation は予約1件の状態だけを管理する
// 自分自身の時間帯重複判定はしてよい
// 他の予約一覧全体の管理はしない
// メッセージ出力はしない
// ・ポイント
// ここで初めて、単なる保持 + 状態変更 + 条件判定の組み合わせが出てきます
// 「この予約はキャンセル済みか」
// 「この予約は指定時間と重なるか」
// という、自分自身に閉じた責務を持たせてください

class Reservation
{
    private int $reservationId;
    private int $roomId;
    private int $emploeeId;
    private string $useDate;
    private string $startTime;
    private string $endTime;
    private bool $canceled;

    public function __construct(
        int $reservationId,
        int $roomId,
        int $emploeeId,
        string $useDate,
        string $startTime,
        string $endTime
    ) {
        $this->reservationId = $reservationId;
        $this->roomId = $roomId;
        $this->emploeeId = $emploeeId;
        $this->useDate = $useDate;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->canceled = false;
    }

    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getEmploeeId(): int
    {
        return $this->emploeeId;
    }

    public function getUseDate(): string
    {
        return $this->useDate;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function isCanceled(): bool
    {
        return $this->canceled;
    }

    public function cancel(): void
    {
        $this->canceled = true;
    }

    public function overlaps(string $useDate, string $startTime, string $endTime): bool
    {
        if ($this->canceled) {
            return false;
        }

        if ($this->useDate !== $useDate) {
            return false;
        }

        return $this->startTime < $endTime && $startTime < $this->endTime;
    }
}
