@extends('layouts.app')

@section('content')
<!-- Profile Header -->
<div class="max-w-5xl mx-auto mt-8 pb-3 header-border">
    <div class="flex justify-between items-center px-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                @if($user->profile_image)
                    <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-3xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                @endif
            </div>
            <div>
                <h1 class="text-xl font-medium text-gray-800">{{ $user->name }}</h1> 
                <div class="flex gap-6 mt-1 text-sm">
                    <a href="{{ route('user.followers', $user->id) }}" target="_blank" rel="noopener" class="...">
                        <span><strong>{{ $followersCount }}</strong> Followers</span>
                    </a>
                    <a href="{{ route('user.followings', $user->id) }}" target="_blank" rel="noopener" class="...">
                        <span><strong>{{ $followingCount }}</strong> Following</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
            @if(!$isOwner)
            <button id="follow-btn"
                class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition"
                data-user="{{ $user->id }}"
                style="{{ $isFollowing ? 'display:none;' : '' }}">
                Follow
            </button>
            <button id="unfollow-btn"
                class="bg-gray-300 text-gray-800 px-4 py-1.5 rounded hover:bg-gray-400 transition"
                data-user="{{ $user->id }}"
                style="{{ $isFollowing ? '' : 'display:none;' }}">
                Unfollow
            </button>
            @else
                <button id="edit-profile-btn" type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Edit Profile</button>
                <a href="{{ route('favorites_page') }}" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Favorites</a>    
            @endif
        </div>
    </div>
    <!-- Social Media Icons -->
    <div class="flex gap-4 mt-4 px-6">
        @if(isset($socialLinks['youtube']))
            <a href="{{ $socialLinks['youtube'] }}" target="_blank" class="text-gray-600 hover:text-red-600">
                <i class="fab fa-youtube"></i>
            </a>
        @endif
        @if(isset($socialLinks['instagram']))
            <a href="{{ $socialLinks['instagram'] }}" target="_blank" class="text-gray-600 hover:text-pink-600">
                <i class="fab fa-instagram"></i>
            </a>
        @endif
        @if(isset($socialLinks['facebook']))
            <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="text-gray-600 hover:text-blue-600">
                <i class="fab fa-facebook"></i>
            </a>
        @endif
        @if(isset($socialLinks['twitter']))
            <a href="{{ $socialLinks['twitter'] }}" target="_blank" class="text-gray-600 hover:text-blue-400">
                <i class="fab fa-twitter"></i>
            </a>
        @endif
        @if(isset($socialLinks['tiktok']))
            <a href="{{ $socialLinks['tiktok'] }}" target="_blank" class="text-gray-600 hover:text-black">
                <i class="fab fa-tiktok"></i>
            </a>
        @endif
    </div>
    <!-- Bio -->
    <div class="mt-4 px-6">
        <p class="text-gray-600">{{ $user->bio ?? 'No bio available' }}</p>
    </div>
</div>
<!-- Content Tabs and Recipe Cards -->
<div class="max-w-5xl mx-auto mt-2">
    <div class="border-b border-gray-200">
        <nav class="flex -mb-px">
            <button class="tab-button tab-active whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm">
                Created
            </button>
        </nav>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 px-6">
        @foreach($recipes as $recipe)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                        @if($user->profile_image)
                            <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-sm text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($recipe['created_at'])->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full h-64 overflow-hidden">
                <img src="{{ asset('http://127.0.0.1:8000/storage/' . $recipe['cover_image']) }}" alt="{{ $recipe['title'] }}" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-800">{{ $recipe['title'] }}</h3>
                <div class="flex justify-between items-center mt-3">
                    <div class="flex gap-6">
                        <div class="flex items-center gap-1">
                            <button class="text-gray-700"><i class="far fa-thumbs-up"></i></button>
                            <span class="text-sm">{{ $recipe['likes_count'] }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="text-gray-700"><i class="far fa-comment"></i></button>
                            <span class="text-sm">{{ $recipe['comments_count'] }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="text-gray-700"><i class="far fa-bookmark"></i></button>
                            <span class="text-sm">{{ $recipe['saves_count'] }}</span>
                        </div>
                    </div>
                    <div>
                        <a target="span" href="{{ route('recipe_page', $recipe['id']) }}" class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition">View Recipe</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Edit Profile</h2>
            <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="edit-profile-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4 text-center">
                <div class="w-24 h-24 rounded-full bg-gray-300 mx-auto mb-2 flex items-center justify-center overflow-hidden relative">
                    <div id="profile-preview" class="w-full h-full">
                        @if($user->profile_image)
                            <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <label for="profile_image" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 cursor-pointer transition">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </label>
                </div>
                <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*">
            </div>
            <div class="mb-4">
                <input type="name" name="name" id="name" value="{{ $user->name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="mb-4">
                <input type="email" name="email" id="email" value="{{ $user->email ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="mb-4">
                <label for="bio" class="block text-gray-700 text-sm font-medium mb-1">Bio</label>
                <textarea name="bio" id="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $user->bio ?? '' }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Social Media Links</label>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="w-8 text-center text-gray-500"><i class="fab fa-facebook"></i></span>
                        <input type="url" name="facebook_link" value="{{ $socialLinks['facebook'] ?? '' }}" placeholder="Facebook URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex items-center">
                        <span class="w-8 text-center text-gray-500"><i class="fab fa-instagram"></i></span>
                        <input type="url" name="instagram_link" value="{{ $socialLinks['instagram'] ?? '' }}" placeholder="Instagram URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex items-center">
                        <span class="w-8 text-center text-gray-500"><i class="fab fa-twitter"></i></span>
                        <input type="url" name="twitter_link" value="{{ $socialLinks['twitter'] ?? '' }}" placeholder="Twitter URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex items-center">
                        <span class="w-8 text-center text-gray-500"><i class="fab fa-youtube"></i></span>
                        <input type="url" name="youtube_link" value="{{ $socialLinks['youtube'] ?? '' }}" placeholder="YouTube URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="flex items-center">
                        <span class="w-8 text-center text-gray-500"><i class="fab fa-tiktok"></i></span>
                        <input type="url" name="tiktok_link" value="{{ $socialLinks['tiktok'] ?? '' }}" placeholder="TikTok URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-edit" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
// Tab switching
const tabButtons = document.querySelectorAll('.tab-button');
tabButtons.forEach(button => {
    button.addEventListener('click', function() {
        tabButtons.forEach(btn => {
            btn.classList.remove('tab-active');
            btn.classList.add('text-gray-500');
        });
        this.classList.add('tab-active');
        this.classList.remove('text-gray-500');
    });
});
// Edit profile modal
const editProfileBtn = document.getElementById('edit-profile-btn');
const editProfileModal = document.getElementById('edit-profile-modal');
const closeModalBtn = document.getElementById('close-modal');
const cancelEditBtn = document.getElementById('cancel-edit');
if (editProfileBtn) {
    editProfileBtn.addEventListener('click', function() {
        editProfileModal.classList.remove('hidden');
    });
}
if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
        editProfileModal.classList.add('hidden');
    });
}
if (cancelEditBtn) {
    cancelEditBtn.addEventListener('click', function() {
        editProfileModal.classList.add('hidden');
    });
}
// Profile image preview
const profileImageInput = document.getElementById('profile_image');
const profilePreview = document.getElementById('profile-preview');
if (profileImageInput) {
    profileImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    });
}
$('#follow-btn').on('click', function() {
    var userId = $(this).data('user');
    $.post('/users/' + userId + '/follow', {_token: '{{ csrf_token() }}'}, function(res) {
        $('#follow-btn').hide();
        $('#unfollow-btn').show();
    });
});
$('#unfollow-btn').on('click', function() {
    var userId = $(this).data('user');
    $.post('/users/' + userId + '/unfollow', {_token: '{{ csrf_token() }}'}, function(res) {
        $('#unfollow-btn').hide();
        $('#follow-btn').show();
    });
});
</script>
@endpush