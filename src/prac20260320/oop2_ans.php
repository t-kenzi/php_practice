<!-- 類題：ポイントカード管理システム
問題
1. PointAccount クラス
会員のポイント口座を表すクラスです。
・保持する情報
会員ID
保有ポイント
・持つべき機能
ポイントを加算する
ポイントを利用する
現在のポイント数を取得する
会員IDを取得する

・制約
ポイント利用時、保有ポイントが不足している場合は失敗させる
保有ポイントはマイナスにならないようにする
加算・利用するポイントは 1以上 であること

2. PointService クラス
ポイント口座をまとめて管理するクラスです。
PointAccount クラスを利用して会員管理を行います。
・保持する情報
会員口座一覧
・持つべき機能
新しい会員口座を作成する
指定会員にポイントを加算する
指定会員のポイントを利用する
会員Aから会員Bへポイントを移行する
・ポイント移行（transferPoints）の要件
会員Aのポイントを会員Bへ移す処理を実装してください。

条件
移行元のポイントが十分な場合のみ成功する
ポイント不足の場合は失敗する
処理が失敗した場合、どちらの会員のポイントも変化しないこと
存在しない会員IDには操作できないこと
移行するポイントは 1以上 であること

共通ルール
数値は不正な値にならないようにする
保有ポイントは常に 0 以上であること
存在しない会員に対する操作は失敗させること

追加条件
余裕があれば次も考えてください。
同じ会員IDでは口座を2つ作れないようにする
会員一覧を確認できるようにする
処理成功時は true、失敗時は false を返す -->

<?php
class PointAccount {
    private int $id;
    private int $point;

    public function __construct(int $id, int $point = 0) {
        $this->id = $id;
        $this->point = max(0, $point);
    }

    public function getAccountId(): int {
        return $this->id;
    }

    public function getPoint(): int {
        return $this->point;
    }

    public function addPoint(int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        $this->point += $amount;
        return true;
    }

    public function usePoint(int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        if ($this->point < $amount) {
            return false;
        }
        $this->point -= $amount;
        return true;
    }
}

class PointService {
    /** @var array<int, PointAccount> */
    private array $accounts = [];

    // 新しい会員口座を作成する（同一IDは不可）
    public function createAccount(int $id): bool {
        if (isset($this->accounts[$id])) {
            return false;
        }
        $this->accounts[$id] = new PointAccount($id, 0);
        return true;
    }

    // 指定会員にポイントを加算する
    public function addPoints(int $id, int $amount): bool {
        $account = $this->getAccount($id);
        if ($account === null) {
            return false;
        }
        return $account->addPoint($amount);
    }

    // 指定会員のポイントを利用する
    public function usePoints(int $id, int $amount): bool {
        $account = $this->getAccount($id);
        if ($account === null) {
            return false;
        }
        return $account->usePoint($amount);
    }

    // 会員Aから会員Bへポイントを移行する
    public function transferPoints(int $fromId, int $toId, int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        $from = $this->getAccount($fromId);
        $to = $this->getAccount($toId);
        if ($from === null || $to === null) {
            return false;
        }
        if (!$from->usePoint($amount)) {
            return false;
        }
        if (!$to->addPoint($amount)) {
            $from->addPoint($amount); // 差し戻し
            return false;
        }
        return true;
    }

    // 会員一覧を確認できるようにする
    public function listAccounts(): array {
        $list = [];
        foreach ($this->accounts as $id => $account) {
            $list[$id] = $account->getPoint();
        }
        return $list;
    }

    private function getAccount(int $id): ?PointAccount {
        return $this->accounts[$id] ?? null;
    }
}
