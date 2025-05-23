@if (Auth::check() && Auth::id() !== $post->user_id)
    @if (Auth::user()->hasFavorited($post->id))
        <form method="POST" action="{{ route('unfavorite', $post->id) }}" class="favorite-button">
            @csrf
            @method('DELETE')
            <button type="submit">
                <span class="icon-wrapper">
                    <i class="fas fa-heart"></i>
                    <span class="tooltip">いいね</span>
                </span>
                <span class="count">{{ $post->favoriteUsers()->count() }}</span>
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('favorite', $post->id) }}" class="favorite-button">
            @csrf
            <button type="submit">
                <span class="icon-wrapper">
                    <i class="far fa-heart"></i>
                    <span class="tooltip">いいね</span>
                </span>
                <span class="count">{{ $post->favoriteUsers()->count() }}</span>
            </button>
        </form>
    @endif
@else
    {{-- 非ログイン or 自分の投稿の場合 --}}
    <div class="favorite-button">
        <div class="button-content">
            <span class="icon-wrapper">
                <i class="far fa-heart"></i>
                <span class="tooltip">いいね</br>（したい場合はログイン）</span>
            </span>
            <span class="count">{{ $post->favoriteUsers()->count() }}</span>
        </div>
    </div>
@endif
