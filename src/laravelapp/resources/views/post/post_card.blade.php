{{-- components/post-card.blade.php --}}
@php
    // Quill内画像の抽出
    preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"]/i', $post->content, $matches);
    $thumbnail = $matches[1] ?? '/images/no-image.png';

    // カテゴリからルート生成（例: programming.show）
    $route = route($post->category . '.show', $post->id);
@endphp

<div class="post-card">
    <div class="post-content">
        <h3 class="post-title">
            <a href="{{ $route }}">{{ $post->title }}</a>
        </h3>
        <div class="post-meta">
            <span>{{ $post->created_at->format('Y年m月d日') }}</span>
            <span>いいね {{ $post->favoriteUsers->count() }}</span>
        </div>
        <div class="post-discription">
            <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
        </div>
        @if (!empty($post->tags))
            <div class="post-tags">
                <span class="tag-label">#タグ</span>
                @foreach ($post->tags as $tag)
                    <a href="{{ route('tag.posts', $tag->name) }}" class="tag-badge">{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif
    </div>

    <div class="post-thumbnail">
        <a href="{{ $route }}">
            <img src="{{ $thumbnail }}" alt="投稿画像">
        </a>
    </div>
</div>
