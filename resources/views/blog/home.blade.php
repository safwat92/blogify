@extends("blog.index")

@section("title", "Blogify")
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
    <div class="max-w-[1200px] m-auto justify-between px-4">

        <div class="md:flex justify-between items-center my-7">
            <h2 class="text-3xl font-bold mb-3 md:m-0"> {{ __("Explore latest Articles on Blogify!🚀") }} </h2>
            <form method="GET" action="{{ route('blog') }}" class="flex gap-2">
                <input type="search" placeholder="{{ __("Realtime Article Search..") }}"
                    class="px-3 py-2 rounded border md:min-w-80 block w-full" name="search" value="{{request('search')}}">
                <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded block w-fit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <form method="GET" action="{{ route('blog') }}" id="sort-form" class="md:flex items-center my-5 hidden justify-between">
            <div>
                <select name="sort" id="sort" class="px-3 py-2 rounded border md:min-w-52 mr-2">
                    <option value="default" disabled selected>Sort By..</option>
                    <option value="reach" {{ request('sort') == 'reach' ? 'selected' : '' }}>Most reach</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                </select>

                <button class="{{ request('order') == 'descending' ? 'border-red-500 text-red-500' : '' }} rounded-full border border-green-500 px-3 py-2 text-green-500" type="button" id="order">
                    <span>{{ request('order') == 'descending' ? __("Descending") : __("Ascending") }}</span>
                    <i class="fa-solid fa-arrow-up {{ request('order') == 'descending' ? 'fa-arrow-down' : ''}}"></i>
                </button>
                <input type="hidden" name="order" value="ascending" id="order-input" class="border-red-500 scale-100 scale-90">
            </div>

            <div class="flex gap-2">
                @foreach ($tags as $tag)
                    <div class="tag">
                        <button type="button" class="rounded-full border px-3 py-2" data-tag="{{$tag->tag}}">
                            {{ $tag->tag }}
                        </button>
                    </div>
                @endforeach
            </div>

        </form>

        <div class="">
            @foreach ($articles as $article)
                <x-article
                :id="$article->id"
                :title="$article->title"
                :description="$article->description"
                :author="$article->user->full_name"
                :date="$article->updated_at"
                :image="$article->user->profile_image"
                :profile="'cover.png'"
                :views="$article->views_count"
                :comments="$article->comments_count"
                :likes="$article->article_likes_count"
                />
            @endforeach
        </div>
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection

@push("scripts")
    @vite('resources/js/sort.js')
@endpush