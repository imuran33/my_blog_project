<!-- ヘッダーでTrixのスタイルとスクリプト読み込み -->
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Quill Image Resize Module -->
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<!-- Tagify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

<!-- Tagify JS -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

@extends('layouts.app')

@section('title', '記事作成')

@section('content')
    <form method="POST" action="{{ route('store.post') }}" id="post-form">
        @csrf
        <input type="text" name="title" placeholder="タイトル" required>
        <select name="category" required>
            <option value="">カテゴリを選択</option>
            <option value="programming">プログラミング</option>
            <option value="music">音楽</option>
            <option value="food">食べ物</option>
            <option value="diary">日記</option>
            <option value="memoir">回顧録</option>
        </select>
        
        <input name="tags" id="tags" placeholder="タグを入力（カンマ区切り）">

        <div id="editor-container" style="height: 300px;"></div>
        <input type="hidden" name="content" id="content">
        <button type="submit">投稿する</button>
    </form>

    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'align': []
                        }], //←揃え
                        [{
                            'color': []
                        }, {
                            'background': []
                        }], // ← 色
                        ['code', 'code-block'], // ← コード系
                        ['link', 'image']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                },
                imageResize: {} // 画像リサイズ用スクリプト
            }
        });

        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('attachment', file);

                try {
                    const res = await fetch('{{ route('attachments.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();
                    if (data.url) {
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', data.url);
                    } else {
                        alert('画像アップロードに失敗しました。');
                    }
                } catch (err) {
                    alert('アップロード中にエラーが発生しました。');
                    console.error(err);
                }
            };
        }

        // 投稿時にQuillの中身を hidden に書き出す
        document.getElementById('post-form').addEventListener('submit', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });

        const input = document.querySelector('input[name=tags]');
        const tagify = new Tagify(input, {
            whitelist: @json($tags->pluck('name')), // 既存タグ
            dropdown: {
                enabled: 1,
                maxItems: 10,
            }
        });
    </script>
@endsection
