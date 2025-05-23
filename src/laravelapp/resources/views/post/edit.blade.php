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

@section('title', '記事編集')

@section('content')
    <form method="POST" action="{{ route('update.post', $post->id) }}" id="post-form">
        @csrf
        <input type="text" name="title" placeholder="タイトル" value="{{ $post->title }}" required>
        <select name="category" required>
            <option value="">カテゴリを選択</option>
            <option value="programming" {{ $post->category == 'programming' ? 'selected' : '' }}>プログラミング</option>
            <option value="music" {{ $post->category == 'music' ? 'selected' : '' }}>音楽</option>
            <option value="food" {{ $post->category == 'food' ? 'selected' : '' }}>食べ物</option>
            <option value="diary" {{ $post->category == 'diary' ? 'selected' : '' }}>日記</option>
            <option value="memoir" {{ $post->category == 'memoir' ? 'selected' : '' }}>回顧録</option>
        </select>

        <input name="tags" id="tags" placeholder="タグを入力（カンマ区切り）">

        <div id="editor-container" style="height: 300px;"></div>
        <input type="hidden" name="content" id="content">
        <button type="submit">更新する</button>
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

        // 初期データをQuillにセット（contentがHTML形式ならOK）
        const content = {!! json_encode($post->content) !!};
        quill.root.innerHTML = content;

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

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('#tags');

            // タグの初期値（既に投稿に紐づいているもの）
            const selectedTags = @json($post->tags->map(fn($tag) => ['value' => $tag->name]));

            // 利用可能なタグ一覧（新規も許可されるが補完に使える）
            const whitelist = @json($tags->pluck('name'));

            // Tagify初期化
            const tagify = new Tagify(input, {
                whitelist: whitelist,
                dropdown: {
                    maxItems: 10,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            });

            // 初期タグをセット
            tagify.addTags(selectedTags);
        });
    </script>
@endsection
