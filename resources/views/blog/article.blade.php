@extends("blog.index")

@section("title", "Blogify | ArticleId")
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
    <div class="max-w-[1200px] m-auto px-4">
        <img src="{{ asset("images/cover.png") }}" alt="" class="m-auto w-full">
        <div class="max-w-[800px] m-auto text-[18px] relative">
            <h2 class="font-bold py-4" style="font-size: 50px">{{ $article->title }}</h2>
                <p>{{ $article->body }}</p>

            <div id="comment">
                <h3 class="font-bold text-2xl mb-4">{{ __("Leave a Comment") }}</h3>
                <form action="{{ route("comment.store") }}" method="POST" class="flex gap-2 justify-center mb-10">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div>
                        <input type="text" name="body" placeholder="Enter your Comment here" class="w-96"></input>
                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded block w-fit">Post</button>
                </form>
                @foreach ($comments as $comment)
                    <div class="bg-gray-100 p-5 rounded mb-5 border shadow">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset("images/user.png") }}" alt="" class="rounded-full w-8">
                            <h3 class="text-blue-500 text-[15px] font-bold">{{ $comment->user->full_name }}</h3>
                        </div>
                        <p class="px-14 text-slate-700">{{ $comment->body }}</p>
                        <div class="flex justify-end">
                            <button class="text-gray-500 pr-6"><i class="fa-solid fa-heart mr-1"></i>{{ count($comment->comment_likes) }}</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="absolute top-10 -right-24 w-9">
                <div class="text-gray-500 text-2xl flex gap-5 flex-col">
                    <div class="hover:text-red-500 transition-colors"><i class="fa-solid fa-heart"></i>
                    </div>
                    <a href="#comment"><i class="fa-solid fa-comment"></i>
                    </a>
                    <div class="hover:text-yellow-500 transition-colors"><i class="fa-solid fa-bookmark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection