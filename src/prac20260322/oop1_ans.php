<!--
問題：機材貸出管理システム

概要
社内でノートPCやプロジェクターなどの機材を貸し出すシステムを作成してください。
このシステムでは「機材そのもの」と「貸出管理」を分けて考えます。

1. Equipment クラス（1つの機材を表す）
保持する情報
- 機材ID
- 機材名
- 利用可能状態（貸出中でなければ利用可能）

持つべき機能
- 機材IDを取得する
- 機材名を取得する
- 現在貸出可能か確認する
- 貸出中に変更する
- 返却済みに変更する

制約
- すでに貸出中の機材は再度貸し出せない
- 返却済みの機材に対して返却処理はできない

2. User クラス（機材を利用する社員）
保持する情報
- 社員ID
- 社員名
- 現在借りている機材数

持つべき機能
- 社員IDを取得する
- 社員名を取得する
- 現在借りている機材数を取得する
- 機材を借りたことを記録する
- 機材を返したことを記録する

制約
- 1人が同時に借りられる機材は最大3台まで
- 借りていないのに返却処理はできない

3. RentalManager クラス（貸出全体の管理）
Equipment と User を利用して貸出管理を行います。

保持する情報
- 機材一覧
- 社員一覧
- 貸出記録一覧

持つべき機能
- 機材を登録する
- 社員を登録する
- 機材を貸し出す
- 機材を返却する
- 機材の貸出状況を確認する

貸出処理の要件
社員に機材を貸し出す処理を実装してください。

条件
- 対象の機材が存在すること
- 対象の社員が存在すること
- 機材が貸出可能であること
- 社員の現在の貸出台数が3台未満であること

失敗条件
- 上記を満たさない場合は失敗すること

重要ルール（貸出）
貸出処理が失敗した場合、以下は一切変更されないこと。
- 機材の状態
- 社員の貸出台数
- 貸出記録

返却処理の要件
社員が借りている機材を返却する処理を実装してください。

条件
- 対象の機材が存在すること
- 対象の社員が存在すること
- その社員がその機材を借りていること

失敗条件
- 借りていない機材を返却しようとした場合
- 別の社員が借りている機材を返却しようとした場合
- すでに返却済みの機材を返却しようとした場合

重要ルール（返却）
返却処理が失敗した場合も、状態は一切変化しないこと。

共通ルール
- 存在しない社員ID・機材IDには操作できない
- 不正な状態遷移を許可しない
- 処理成功時は true、失敗時は false を返すこと
-->
<?php
class Equipment {
    private int $id;
    private string $name;
    private bool $available;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->available = true;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function isAvailable(): bool {
        return $this->available;
    }

    public function markRented(): bool {
        if (!$this->available) {
            return false;
        }
        $this->available = false;
        return true;
    }

    public function markReturned(): bool {
        if ($this->available) {
            return false;
        }
        $this->available = true;
        return true;
    }
}

class User {
    private int $id;
    private string $name;
    private int $borrowedCount;
    private int $maxBorrow = 3;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->borrowedCount = 0;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBorrowedCount(): int {
        return $this->borrowedCount;
    }

    public function canBorrow(): bool {
        return $this->borrowedCount < $this->maxBorrow;
    }

    public function borrowed(): bool {
        if (!$this->canBorrow()) {
            return false;
        }
        $this->borrowedCount++;
        return true;
    }

    public function returned(): bool {
        if ($this->borrowedCount < 1) {
            return false;
        }
        $this->borrowedCount--;
        return true;
    }
}

class RentalManager {
    /** @var array<int, Equipment> */
    private array $equipments = [];
    /** @var array<int, User> */
    private array $users = [];
    /** @var array<int, int> equipmentId => userId */
    private array $records = [];

    public function registerEquipment(int $id, string $name): bool {
        if (isset($this->equipments[$id])) {
            return false;
        }
        $this->equipments[$id] = new Equipment($id, $name);
        return true;
    }

    public function registerUser(int $id, string $name): bool {
        if (isset($this->users[$id])) {
            return false;
        }
        $this->users[$id] = new User($id, $name);
        return true;
    }

    public function lend(int $equipmentId, int $userId): bool {
        $equipment = $this->equipments[$equipmentId] ?? null;
        $user = $this->users[$userId] ?? null;
        if ($equipment === null || $user === null) {
            return false;
        }
        if (!$equipment->isAvailable()) {
            return false;
        }
        if (!$user->canBorrow()) {
            return false;
        }

        // ここから状態変更
        if (!$equipment->markRented()) {
            return false;
        }
        if (!$user->borrowed()) {
            // 万一の巻き戻し
            $equipment->markReturned();
            return false;
        }
        $this->records[$equipmentId] = $userId;
        return true;
    }

    public function returnEquipment(int $equipmentId, int $userId): bool {
        $equipment = $this->equipments[$equipmentId] ?? null;
        $user = $this->users[$userId] ?? null;
        if ($equipment === null || $user === null) {
            return false;
        }
        if (!isset($this->records[$equipmentId])) {
            return false;
        }
        if ($this->records[$equipmentId] !== $userId) {
            return false;
        }
        if ($equipment->isAvailable()) {
            return false;
        }

        // ここから状態変更
        if (!$equipment->markReturned()) {
            return false;
        }
        if (!$user->returned()) {
            // 万一の巻き戻し
            $equipment->markRented();
            return false;
        }
        unset($this->records[$equipmentId]);
        return true;
    }

    public function getRentalStatus(int $equipmentId): ?int {
        if (!isset($this->equipments[$equipmentId])) {
            return null;
        }
        return $this->records[$equipmentId] ?? null; // 借り手の社員ID or null
    }
}
