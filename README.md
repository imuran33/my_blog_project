## 📌 概要
これはLaravelで構築したブログ投稿アプリです。
投稿、編集、削除、ユーザー認証機能などを実装しています。
コードの中身を見るには、develop_myblogブランチから、src/laravelappをご覧ください。

## 🔧 使用技術
- Laravel 10　(PHP フレームワーク)
- MySQL（DB）
- Blade（テンプレートエンジン）
- Tailwind CSS / 自作CSS
- Quill.js（エディタ）
- npm / vite（フロントビルド）

## ✨ 主な機能
- ログイン／ログアウト（認証機能）
- 記事の投稿・編集・削除
- 投稿一覧、詳細ページ、いいね機能
- タグ付け、タグごとの絞り込み
- Quillエディタでのリッチテキスト投稿
- 管理者限定の投稿機能

## 🛠️ セットアップ手順
```bash
git clone https://github.com/imuran33/my_blog_project.git
cd my_blog_project
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate --seed


## キャプチャなど
トップページのデザイン
![image](https://github.com/user-attachments/assets/b5b7300e-ee7f-411d-b73a-23b4097ae952)
記事ページイメージ　※記事に対するいいねや、タグボタンでほかの同じような記事が見れる。
![image](https://github.com/user-attachments/assets/8cb3dded-ad16-4f73-9f04-335cc8e27450)

