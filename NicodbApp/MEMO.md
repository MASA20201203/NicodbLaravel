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