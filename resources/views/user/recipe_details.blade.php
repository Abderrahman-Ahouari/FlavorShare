@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-8">
    <!-- Recipe Header and Image -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $recipe->cover_image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover">
        </div>
        <div class="flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center text-white overflow-hidden">
                        @if($recipe->user && $recipe->user->profile_image)
                            <img src="{{ asset('http://127.0.0.1:8000/storage/' . $recipe->user->profile_image) }}" alt="{{ $recipe->user->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <a href="{{ route('account_page', $recipe->user->id) }}">
                        <span class="text-gray-800">by {{ $recipe->user->name ?? 'Unknown' }}</span>
                    </a>
                    <div class="ml-auto flex items-center gap-2">
                        <button id="favorite-btn" class="flex items-center gap-1 text-gray-700">
                            <i class="far fa-bookmark"></i>
                            <span>{{ $recipe->favorites_count }}</span>
                        </button>
                        <button id="like-btn" class="flex items-center gap-1 text-gray-700 ml-4">
                            <i class="far fa-thumbs-up"></i>
                            <span>{{ $recipe->likes_count }}</span>
                        </button>
                    </div>
                </div>  
                <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>
                <div class="flex flex-wrap gap-2 mb-6">
                    @if($recipe->categories)
                    @foreach($recipe->categories as $category)
                        <span class="bg-primary text-sm px-3 py-1 rounded-full">{{ $category->name }}</span>
                    @endforeach
                    @endif
                    <span class="bg-primary text-sm px-3 py-1 rounded-full">{{ $recipe->preparation_time }} min</span>
                </div>
                <div class="text-gray-700 mb-4">
                    <p>{{ $recipe->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Recipe Content -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Ingredients -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-2xl font-bold mb-6">Ingredients</h2>
            <div class="space-y-3">
                @if($recipe->ingredients)
                @foreach($recipe->ingredients as $ingredient)
                    <div class="bg-gray-100 px-4 py-2 rounded-full inline-block">
                        <span class="font-medium">{{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</span> {{ $ingredient->name }}
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <!-- Instructions -->
        <div class="bg-white p-6 rounded-lg shadow-sm md:col-span-2">
            <h2 class="text-2xl font-bold mb-6">Instructions</h2>
            <div class="space-y-6">
                @if($recipe->steps)
                @foreach($recipe->steps as $index => $step)
                    <div>
                        <h3 class="text-xl font-bold mb-2">Step {{ $index + 1 }}</h3>
                        <p class="text-gray-700">{{ $step->description }}</p>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Comments -->
    <div class="bg-white p-6 rounded-lg shadow-sm mt-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Comments</h2>
            <button id="show-comment-form" type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Leave a comment</button>
        </div>
        <!-- Comment Form Modal -->
        <div id="comment-form-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 ">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <button id="close-comment-form" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                <h3 class="text-lg font-bold mb-4">Add a Comment</h3>
                <form method="POST" action="{{ route('comments.store', $recipe->id) }}">
                    @csrf
                    <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Write your comment..."></textarea>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">Send</button>
                </form>
            </div>
        </div>
        <div class="border-t pt-4">
            @if($recipe->comments)
            @forelse($recipe->comments as $comment)
                <div class="flex gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex-shrink-0 overflow-hidden">
                        @if($comment->user && $comment->user->profile_image)
                            <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500 flex items-center justify-center w-full h-full">{{ $comment->user->name[0] ?? '?' }}</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-medium">{{ $comment->user->name ?? 'Unknown' }}</h3>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endforelse
            @endif
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
// ...existing code for comment modal, favorite/like toggles, and mobile menu toggle...
document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const showCommentFormBtn = document.getElementById('show-comment-form');
    const commentFormModal = document.getElementById('comment-form-modal');
    const closeCommentFormBtn = document.getElementById('close-comment-form');
    // Show comment form when clicking the "Leave a comment" button
    showCommentFormBtn.addEventListener('click', function() {
        commentFormModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    // Hide comment form when clicking the close button
    closeCommentFormBtn.addEventListener('click', function() {
        commentFormModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    // Toggle favorite button
    const favoriteBtn = document.getElementById('favorite-btn');
    let isFavorite = false;
    favoriteBtn.addEventListener('click', function() {
        isFavorite = !isFavorite;
        if (isFavorite) {
            favoriteBtn.querySelector('i').classList.remove('far');
            favoriteBtn.querySelector('i').classList.add('fas');
            favoriteBtn.querySelector('i').style.color = '#FF8C00';
        } else {
            favoriteBtn.querySelector('i').classList.remove('fas');
            favoriteBtn.querySelector('i').classList.add('far');
            favoriteBtn.querySelector('i').style.color = '';
        }
    });
    // Toggle like button
    const likeBtn = document.getElementById('like-btn');
    let isLiked = false;
    likeBtn.addEventListener('click', function() {
        isLiked = !isLiked;
        if (isLiked) {
            likeBtn.querySelector('i').classList.remove('far');
            likeBtn.querySelector('i').classList.add('fas');
            likeBtn.querySelector('i').style.color = '#FF8C00';
        } else {
            likeBtn.querySelector('i').classList.remove('fas');
            likeBtn.querySelector('i').classList.add('far');
            likeBtn.querySelector('i').style.color = '';
        }
    });
});
</script>
@endpush