<!-- ヘッダーでTrixのスタイルとスクリプト読み込み -->
<!-- Trix CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">

<!-- Trix JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

<!-- フォーム本体 -->
<form method="POST" action="{{ route('store.post') }}">
    @csrf
    <input type="text" name="title" placeholder="タイトル" required>

    <select name="category" required>
        <option value="">カテゴリを選択</option>
        <option value="programming">プログラミング</option>
        <option value="music">音楽</option>
        <option value="food">食べ物</option>
        <option value="diary">日記</option>
    </select>

    <!-- Trix用入力フィールド -->
    <input id="content" type="hidden" name="content">
    <trix-editor input="content"></trix-editor>

    <button type="submit">投稿する</button>
</form>
