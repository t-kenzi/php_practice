<?php
// 2. Employee クラス
// 社員1人の情報と、その社員が持つ予約情報を管理するクラスです。
// ・保持する情報
// 社員ID
// 社員名
// 現在の予約ID一覧

// ・持つべき機能
// 社員IDを取得する
// 社員名を取得する
// 現在の予約ID一覧を取得する
// 予約を追加する
// 予約を削除する
// 指定した予約IDを持っているか確認する
// 現在の予約件数を取得する

// ・責務
// Employee は社員1人の予約状態だけを管理する
// 予約一覧の更新はするが、予約の正当性判定はしない
// メッセージ出力はしない

// ・ポイント
// 今回の Member と同じく、boolではなく配列で状態を管理する
// 配列の「添字」と「値」を混同しないこと
// this が「その社員自身」を指していることを理解すること

class Emploee
{
    private int $emploeeId;
    private string $emploeeName;
    private array $reservationList;

    public function __construct(int $emploeeId, string $emploeeName)
    {
        $this->emploeeId = $emploeeId;
        $this->emploeeName = $emploeeName;
        $this->reservationList = [];
    }

    public function getEmploeeId(): int
    {
        return $this->emploeeId;
    }

    public function getEmploeeName(): string
    {
        return $this->emploeeName;
    }

    public function getReservationList(): array
    {
        return $this->reservationList;
    }

    public function addReservation(int $reservationId): void
    {
        if (!$this->hasReservation($reservationId)) {
            $this->reservationList[] = $reservationId;
        }
    }

    public function removeReservation(int $reservationId): void
    {
        $this->reservationList = array_values(
            array_filter(
                $this->reservationList,
                fn (int $currentReservationId): bool => $currentReservationId !== $reservationId
            )
        );
    }

    public function hasReservation(int $reservationId): bool
    {
        return in_array($reservationId, $this->reservationList, true);
    }

    public function getReservationCount(): int
    {
        return count($this->reservationList);
    }
}
