## 📌 概要
これはLaravelで構築したブログ投稿アプリです。
投稿、編集、削除、ユーザー認証機能などを実装しています。

## 🔧 使用技術
- Laravel 10　(PHP フレームワーク)
- MySQL（DB）
- Blade（テンプレートエンジン）
- Tailwind CSS / 自作CSS
- Quill.js（エディタ）
- npm / vite（フロントビルド）

## ✨ 主な機能
- ユーザー登録 / ログイン / ログアウト / 退会
- 投稿作成・編集・削除
- いいね機能
- タグ付け・タグ検索機能
- キーワード検索機能
- モーダル　※ログイン/ログアウト時の確認など

## 🛠️ セットアップ手順
```bash
git clone https://github.com/imuran33/my_blog_project.git
cd my_blog_project
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate --seed

## 詳細資料・開発ログはこちら

▶ [Notionポートフォリオページ](https://www.notion.so/Laravel-1e30a1f1b06980af9a7dc64468676b80)
