## 📌 概要
個人で開発したブログサイトです。投稿、編集、削除、ユーザー認証機能などを実装しています。

## 🔧 使用技術
- フレームワーク：Laravel 8
- フロント：HTML / CSS / JavaScript
- データベース：MySQL
- 開発環境：Docker

## ✨ 主な機能
- ユーザー登録 / ログイン / ログアウト / 退会
- 投稿作成・編集・削除
- いいね機能
- タグ付け・タグ検索機能
- キーワード検索機能

## 🛠️ セットアップ手順
```bash
git clone https://github.com/imuran33/my_blog_project.git
cd my_blog_project
cp .env.example .env
composer install
php artisan key:generate
# その他手順（DB設定やnpm installなど）
