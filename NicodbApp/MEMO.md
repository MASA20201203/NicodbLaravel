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
