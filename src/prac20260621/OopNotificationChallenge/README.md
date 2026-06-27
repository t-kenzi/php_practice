# OOP Notification Challenge

## 調査メモ

この問題は、既存の `prac20260621/NotifierInterface` の発展版です。

参考にした内容:

- PHP 公式: interface は「どのメソッドを実装する必要があるか」を決め、実装方法は各クラスに任せる。
- PHP 公式: namespace はクラス名の衝突を避け、ファイル分割したコードを整理するために使う。
- PHP 公式: `spl_autoload_register()` は、未読み込みクラスが参照されたときにクラスファイルを読み込む仕組みを登録する。
- PHP-FIG PSR-4: namespace とディレクトリ構成を対応させる autoload の考え方。

RareTECH の公開記事も検索しましたが、今回の調査時点では参照できる公開ページを確認できませんでした。そのため、問題設計の根拠は PHP 公式ドキュメントと PSR-4 を中心にしています。

## この問題で学ぶこと

- `interface` による差し替え可能な設計
- `namespace` とディレクトリ構成の対応
- `spl_autoload_register()` による簡易 autoloader
- constructor injection による依存関係の受け渡し
- `Entity`、`Service`、`Logger`、`Formatter` の責務分離
- 1つの処理を複数ファイルのクラスで組み立てる感覚

## 問題

会員にお知らせを送る小さな通知アプリを作ります。

既存の `NotifierInterface` では、通知手段を `EmailNotifier` や `SmsNotifier` に差し替えていました。

今回は少し難度を上げて、次の要素を追加します。

1. 通知対象の会員を `Member` クラスで表す
2. 通知本文を `MessageFormatterInterface` で差し替えられるようにする
3. 通知手段を `NotifierInterface` で差し替えられるようにする
4. 通知ログを `LoggerInterface` で差し替えられるようにする
5. `NotificationService` は、具体的な通知手段やログ保存方法を知らない形にする

## ファイル構成

```text
OopNotificationChallenge/
├── README.md
├── autoload.php
├── main.php
└── src/
    ├── Entity/
    │   └── Member.php
    ├── Formatter/
    │   ├── BirthdayMessageFormatter.php
    │   └── CampaignMessageFormatter.php
    ├── Interfaces/
    │   ├── LoggerInterface.php
    │   ├── MessageFormatterInterface.php
    │   └── NotifierInterface.php
    ├── Logger/
    │   ├── ConsoleLogger.php
    │   └── FileLogger.php
    ├── Notification/
    │   ├── EmailNotifier.php
    │   └── SlackNotifier.php
    ├── Service/
    │   └── NotificationService.php
    └── storage/
        └── notification.log
```

## 実行方法

VS Code のターミナルで、このディレクトリへ移動します。

```bash
cd php_base/src/prac20260621/OopNotificationChallenge
php main.php
```

## 期待する出力例

```text
[Email]
To: taro@example.com
Message: 田中太郎さん、お誕生日おめでとうございます。500ポイントをプレゼントしました。
--------------------
[log] email通知を送信しました: 田中太郎

[Slack]
Channel: #campaign
Message: 佐藤花子さん限定のお知らせ: 週末セールを開催中です。
--------------------
```

2つ目の通知は `FileLogger` を使っているため、`src/storage/notification.log` に通知ログが追記されます。

## Step 1: まず読む

次の順番で読んでください。

1. `main.php`
2. `autoload.php`
3. `src/Entity/Member.php`
4. `src/Interfaces/*.php`
5. `src/Notification/*.php`
6. `src/Formatter/*.php`
7. `src/Service/NotificationService.php`
8. `src/Logger/*.php`

## Step 2: 理解チェック

コードを実行した後、次の質問に答えてください。

1. `main.php` で `require_once` しているファイルはなぜ `autoload.php` だけでよいですか。
2. `NotificationService` は `EmailNotifier` や `SlackNotifier` を直接 `new` していません。これはなぜですか。
3. `MessageFormatterInterface` を使うと、どの部分を変更せずに本文の作り方を差し替えられますか。
4. `FileLogger` と `ConsoleLogger` は同じ `LoggerInterface` を実装しています。これにより `NotificationService` にどんな利点がありますか。
5. `Member` クラスを配列ではなくクラスにした理由は何ですか。

## Step 3: 追加課題

次の順番で改造してください。

1. `LineNotifier` を追加する
    - namespace は `App\Notification`
    - `NotifierInterface` を実装する
    - `getName()` は `line` を返す
2. `PointExpirationMessageFormatter` を追加する
    - namespace は `App\Formatter`
    - `MessageFormatterInterface` を実装する
    - 例: `田中太郎さん、保有ポイントの有効期限が近づいています。`
3. `main.php` で、追加した notifier と formatter を使って通知する
4. `NotificationService` のコードを変更せずに実現できるか確認する

## Step 4: 発展課題

余裕があれば、次の変更にも挑戦してください。

1. `Member` に `phoneNumber` を追加する
2. `SmsNotifier` を追加する
3. `EmailNotifier`、`SlackNotifier`、`SmsNotifier` で宛先の取り出し方が違う問題をどう扱うか考える

ヒント: 最初は `main.php` 側で宛先を渡す設計でも構いません。慣れてきたら、通知先を選ぶクラスを追加してもよいです。

## この問題のゴール

正解の丸暗記ではなく、次の感覚をつかむことです。

- interface は「使う側」と「作る側」の約束
- Service は処理の流れを持つ
- Entity はデータと、そのデータに関係する小さな振る舞いを持つ
- Logger、Formatter、Notifier は差し替えやすい部品
- namespace と autoload は、複数ファイルのコードを整理して読み込む仕組み
