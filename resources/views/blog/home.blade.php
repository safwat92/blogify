@extends("blog.index")

@section("title", "Blogify")
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
    <div class="max-w-[1200px] m-auto justify-between px-4">

        <form method="GET" action="{{ route('blog') }}" id="sort-form" class="flex flex-col md:flex-row md:items-center my-5 gap-4 justify-between">
            <div class="flex flex-wrap items-center gap-2">
                <select name="sort" id="sort" class="px-3 py-2 rounded border w-full sm:w-auto sm:min-w-52">
                    <option value="default" disabled selected>Sort By..</option>
                    <option value="reach" {{ request('sort') == 'reach' ? 'selected' : '' }}>Most reach</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                </select>

                <button class="{{ request('order') == 'descending' ? 'border-red-500 text-red-500' : '' }} rounded-full border border-green-500 px-4 py-2 text-green-500 text-sm font-medium transition-colors" type="button" id="order">
                    <span>{{ request('order') == 'descending' ? __("Descending") : __("Ascending") }}</span>
                    <i class="fa-solid fa-arrow-up {{ request('order') == 'descending' ? 'fa-arrow-down' : ''}} ml-1"></i>
                </button>
                <input type="hidden" name="order" value="ascending" id="order-input" class="border-red-500 scale-100">
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <div class="tag">
                        <button type="button" class="rounded-full border px-3 py-1.5 text-sm hover:bg-gray-100 transition-colors" data-tag="{{$tag->tag}}">
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
            @if(count($articles) == 0)
               <div class="my-12">
                   <img src="{{ asset("./images/empty_data.svg") }}" class="mx-auto" alt="not found">
                   <p class="text-center mt-5">No data matches your search found!</p>
               </div>
                @endif
        </div>
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection

@push("scripts")
    @vite('resources/js/sort.js')
@endpush