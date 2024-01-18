# 開発時メモ

## 1.14(日)

### Streamer モデルを作成

#### モデル作成時発生エラー

```エラー
masa:NicodbApp$ php artisan migrate:status

   Illuminate\Database\QueryException

  SQLSTATE[HY000] [2002] Connection refused (SQL: select * from information_schema.tables where table_schema = nicodb_laravel and table_name = migrations and table_type = 'BASE TABLE')
```

```解決方法
DB_HOST=127.0.0.1
↓
DB_HOST=localhost
```

```原因
127.0.0.1だとTCP接続 locahostだとunix domain socket接続になる
```

### Streamer データを取得する処理（artisan コマンドの作成）を作成

[Laravel のタスクスケジュールで定期処理を自動実行](https://www.rail-c.com/laravel%E3%81%AE%E3%82%BF%E3%82%B9%E3%82%AF%E3%82%B9%E3%82%B1%E3%82%B8%E3%83%A5%E3%83%BC%E3%83%AB%E3%81%A7%E5%AE%9A%E6%9C%9F%E5%87%A6%E7%90%86%E3%82%92%E8%87%AA%E5%8B%95%E5%AE%9F%E8%A1%8C/)

```Streamer データを取得する artisan コマンドを作成
php artisan make:command GetStreamers
```

```実行コマンド
php artisan getstreamer
```

### Web スクレイピング処理の実装

````ロジック

```ChatGPTへのプロンプト
下記URLに対して、PHP で Webスプレイピングを利用し、ユーザー名・ユーザーIDを取得したいです。

  ```URL
  https://live.nicovideo.jp/ranking
  ```

  取得したいユーザー名・ユーザー ID の例は下記のとおりです。

  ```ユーザー名
  おっちち姫
  ```

  ```ユーザーID
  116547421
  ```

````

## 1.15(月)

### Web スクレイピング処理作成

```必要なライブラリをインストール
composer require guzzlehttp/guzzle symfony/dom-crawler
```

## 1.16(火)

### ニコ生公式クリ奨ランキングからユーザー名を取得し、コンソールに表示

### 取得したユーザー名を取得し、Streamer モデルに登録

- 今後の課題
  - drawio を Github で見れるようにする
  - Stremaers モデルの修正->ユーザー ID をプライマリーキーにする
  - ニコ生公式ランキングからユーザー ID を取得する
  - 取得したユーザー ID を Streamers テーブルに登録する

### drawio を Github で見れるようにする

### ニコ生公式ランキングのjsonデータの確認

```ChatGPTヘのプロンプト
下記URLで"embedded-data"のデータを取得する方法をおしえてください

- URL
  - view-source:https://live.nicovideo.jp/ranking
```

### ニコ生公式ランキングのjsonデータからユーザー情報の取得

### Stremaers モデルの修正->ユーザー ID をプライマリーキーにする

```php
composer require doctrine/dbal
```

- マイグレーションファイル作成
  - php artisan make:migration modify_streamers_table

- id列をプライマリーキーに設定

### 取得したユーザーID・ユーザー名 を Streamers テーブルに登録する

- foreach を Collection に変更
- データを一括登録させる処理に変更

- 今後の課題
  - DBの日時を修正する

### 本日学んだこと

- マイグレーションの仕方から、PHPによるDOM(XML処理)、JSONの扱い方、LaravelでのDB一括登録

### DBの日時を修正

### ニコ生公式ランキングに表示されているコミュニティIDをstreamersテーブルに登録する

- やること
  - Communitiy モデルを作成
  - ニコ生公式ランキングをスクレイピングして、コミュニティIDを取得
  - 取得したコミュニティIDをcommunitiesテーブルにデータを登録

### Community モデルを作成

```Communitiy モデルを作成
php artisan make:model Community -m
```

### Community の id を string に変更

### 取得したコミュニティIDをstremaer_communitiesテーブルにデータを登録

- 外部キーをつける
- データ登録処理実装

## 1.17(水)

### メンテ時処理エラー

```bash
masa:NicodbApp$ php artisan getstreamers
Start, getstreamers!

   GuzzleHttp\Exception\ServerException 

  Server error: `GET https://live.nicovideo.jp/ranking` resulted in a `503 Service Temporarily Unavailable` response:
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-w (truncated...)

  at vendor/guzzlehttp/guzzle/src/Exception/RequestException.php:113
    109▕         if ($summary !== null) {
    110▕             $message .= ":\n{$summary}\n";
    111▕         }
    112▕ 
  ➜ 113▕         return new $className($message, $request, $response, $previous, $handlerContext);
    114▕     }
    115▕ 
    116▕     /**
    117▕      * Obfuscates URI if there is a username and a password present

      +10 vendor frames 
  11  app/Console/Commands/GetStreamers.php:49
      GuzzleHttp\Client::request()

      +13 vendor frames 
  25  artisan:37
      Illuminate\Foundation\Console\Kernel::handle()
```

### 【配信データ取得処理】毎日1回12時頃

- 処理概要
  - commities テーブルからコミュニティIDを1件ずつ読み出す
  - 取得したコミュニティIDを元に、生放送履歴ページを開く
  - 生放送履歴ページから前日分の配信URLを取得
  - 配信URLから来場者数、コメント、広告pt、ギフトpt データ等を取得
  - 取得したデータを streamings テーブルに登録する

### commities テーブルからコミュニティIDを1件ずつ読み出す

- やること
  - vscode で laravel のデバッガーを設定する
  - エラーの解消

## 1.18(木)

### プロジェクト管理

### vscode で laravel のデバッガーを設定する

- 作業手順
  - 必要な拡張機能のインストール
    - PHP Debug 拡張機能のインストール
    - PHP Intelephense 拡張機能
  - Xdebugの設定
    - PHPファイルの場所を確認
      - php artisan serve
      - ```<?php phpinfo(); ?>```
    - PHPにXdebugをイントール

      ```/etc/php/7.4/cli/php.ini
      zend_extension=xdebug.so
      xdebug.mode=debug
      xdebug.start_with_request=yes
      ```

    - xdebugをインストール

      ```bash
      sudo apt install php-pear
      sudo pecl install xdebug
      ```

### エラーの解消

- 参考情報
  - [Laravel の主キーで UUID を利用する時にハマった事、調べた事](https://yudy1152.hatenablog.com/entry/2019/04/19/132638)
  - [Laravelにてidの値を取得できない](https://qiita.com/calltella/items/b1dde1a40ad70ced5158)
    - Laravelのモデルidに文字列（string）を使うとidを取得した際にidの値が0になるため、falseの設定が必要だった

### 取得したコミュニティIDを元に、生放送履歴ページを開く

### 生放送履歴ページから前日分の配信URLを取得

- 処理概要
  - ソースコードから配信開始日時と配信URLを取得
  - 配信開始日時が前日かどうかを判定
  - 配信開始日時が前日の場合、配信URLのページを開く

- 課題
  - HTTPクライアントではjsでレンダリングされたデータを取得できない
    - selenium or playwright をつかえばスクレイピングできる？
    - ```Playwrightを利用して、Laravel で動的サイトをスクレイピングする方法をおしえてください```

- 今後やること
  - Laravelプロジェクトで動的サイトをスクレイピング
