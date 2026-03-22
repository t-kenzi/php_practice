<!-- 1. BankAccount クラス
銀行口座を表すクラスです。

保持する情報
口座ID
残高

持つべき機能
入金する
出金する
現在の残高を取得する

制約
出金時、残高が不足している場合は処理を失敗させる
残高はマイナスにならないようにする

2. Bank クラス
銀行を管理するクラスです。
BankAccount クラスを利用して口座管理を行います。

保持する情報
口座一覧

持つべき機能
口座を開設する
指定口座へ入金する
指定口座から出金する
口座間で振替を行う

振替（transfer）の要件
口座Aから口座Bへお金を移動する処理を実装してください。

条件
出金元の残高が十分な場合のみ成功する
残高不足の場合は処理を失敗させる
処理が失敗した場合、どちらの口座の残高も変化しないこと

共通ルール
金額は 1 以上であること
残高はマイナスにならないこと
存在しない口座には操作できないこと -->
<?php
class BankAccount {
    private int $id;
    private int $balance;

    public function __construct(int $id, int $initialBalance = 0) {
        $this->id = $id;
        $this->balance = max(0, $initialBalance);
    }
    // Idの取得
    public function getId(): int {
        return $this->id;
    }
    // 残高の取得
    public function getBalance(): int {
        return $this->balance;
    }
    // 入金処理
    public function deposit(int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        $this->balance += $amount;
        return true;
    }
    // 出金処理
    public function withdraw(int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        if ($this->balance < $amount) {
            return false;
        }
        $this->balance -= $amount;
        return true;
    }
}

class Bank {
    /** @var array<int, BankAccount> */
    private array $accounts = [];

    public function openAccount(): int {
        $newId = count($this->accounts);
        $this->accounts[$newId] = new BankAccount($newId, 0);
        return $newId;
    }

    public function depositTo(int $accountId, int $amount): bool {
        $account = $this->getAccount($accountId);
        if ($account === null) {
            return false;
        }
        return $account->deposit($amount);
    }

    public function withdrawFrom(int $accountId, int $amount): bool {
        $account = $this->getAccount($accountId);
        if ($account === null) {
            return false;
        }
        return $account->withdraw($amount);
    }

    public function transfer(int $fromId, int $toId, int $amount): bool {
        if ($amount < 1) {
            return false;
        }
        $from = $this->getAccount($fromId);
        $to = $this->getAccount($toId);
        if ($from === null || $to === null) {
            return false;
        }
        if (!$from->withdraw($amount)) {
            return false;
        }
        // 入金が失敗するケースはここではないが、念のため保険
        if (!$to->deposit($amount)) {
            $from->deposit($amount); // 差し戻し
            return false;
        }
        return true;
    }

    private function getAccount(int $accountId): ?BankAccount {
        return $this->accounts[$accountId] ?? null;
    }
}

$bank = new Bank();
$a = $bank->openAccount();
$b = $bank->openAccount();
$bank->depositTo($a, 1000);
$bank->transfer($a, $b, 300);
echo "A: {$bank->withdrawFrom($a, 100)}\n";
