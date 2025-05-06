<!-- ヘッダーでTrixのスタイルとスクリプト読み込み -->
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

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
        </select>

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
                        ['link', 'image']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
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
    </script>
@endsection
