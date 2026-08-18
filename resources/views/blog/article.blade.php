@extends("blog.index")

@section("title", $article->title)
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
    <div class="max-w-[1200px] m-auto px-4 py-4">
        <img src="{{ asset("images/cover.png") }}" alt="Article Cover" class="m-auto w-full max-h-[450px] object-cover rounded-lg shadow-sm">
        <div class="max-w-[800px] m-auto text-base md:text-[18px] relative pb-20 lg:pb-0">
            <h1 class="font-bold py-4 text-2xl sm:text-4xl md:text-[50px] leading-tight text-gray-900">{{ $article->title }}</h1>
            <div class="prose max-w-none text-gray-800 leading-relaxed my-4">{!! $article->body !!}</div>

            <div id="comment" class="mt-10 pt-6 border-t">
                <h3 class="font-bold text-xl sm:text-2xl mb-4 text-gray-900">{{ __("Leave a Comment") }}</h3>
                <form action="{{ route("comment.store", $article->id) }}" method="POST"
                    class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-center mb-10">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="flex-1">
                        <input type="text" name="body" id="add-comment" placeholder="Enter your Comment here"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="px-6 py-2 bg-black hover:bg-gray-800 text-white font-medium rounded-lg transition-colors shrink-0">Post</button>
                </form>
                @foreach ($comments as $comment)
                    <div class="bg-gray-50 p-4 sm:p-5 rounded-lg mb-4 border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset("storage/" . $comment->user->profile_image) }}" alt="" class="rounded-full w-8 h-8 object-cover">
                            <h3 class="text-blue-600 text-sm sm:text-base font-bold">{{ $comment->user->full_name }}</h3>
                        </div>
                        <p class="px-2 sm:px-10 text-slate-700 text-sm sm:text-base my-2">{{ $comment->body }}</p>
                        <div class="flex justify-end">
                            <button
                                class="{{ $comment->is_liked ? "text-red-500 " : "" }} text-gray-500 pr-2 comment-like-button text-sm flex items-center gap-1"
                                data-comment-id="{{$comment->id}}" data-state="{{ $comment->is_liked }}"><i
                                    class="fa-solid fa-heart"></i>
                                <span>{{ count($comment->comment_likes) }}</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Responsive Reaction Bar (Sticky Bottom Bar on Mobile/Tablet, Right Sidebar on Desktop) -->
            <div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200 py-2 px-6 shadow-lg flex justify-around items-center text-gray-500 text-2xl lg:absolute lg:top-10 lg:-right-24 lg:left-auto lg:bottom-auto lg:w-9 lg:flex-col lg:gap-6 lg:bg-transparent lg:border-none lg:shadow-none lg:p-0 lg:text-3xl">
                <div class="{{ $isLiked ? "text-red-500 " : " " }} transition-colors cursor-pointer flex flex-col items-center" id="article-like"
                    data-article-id="{{ $article->id }}" data-state="{{ $isLiked }}"><i class="fa-solid fa-heart"></i>
                    <p class="text-xs sm:text-sm text-center font-medium mt-0.5">{{ $likesCount }}</p>
                </div>
                <a href="#comment" id="comment-btn" class="flex flex-col items-center"><i class="fa-solid fa-comment"></i>
                    <p class="text-xs sm:text-sm text-center font-medium mt-0.5">{{ $commentsCount }}</p>
                </a>
                <div class="{{ $isBookmarked ? "text-yellow-500 " : " " }} transition-colors cursor-pointer flex flex-col items-center" id="bookmark"
                    data-article-id="{{ $article->id }}" data-state="{{ $isBookmarked }}"><i
                        class="fa-solid fa-bookmark"></i>
                    <p class="text-xs sm:text-sm text-center font-medium mt-0.5">{{ $bookmarksCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    @vite('resources/js/reactions.js')
@endpush