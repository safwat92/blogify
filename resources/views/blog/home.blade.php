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
            <form action="#">
                @csrf
                <input type="search" placeholder="{{ __("Realtime Article Search..") }}"
                    class="px-3 py-2 rounded border md:min-w-80 block w-full">
            </form>
        </div>

        <div class="md:flex items-center my-5 hidden justify-between">

            <div>
                <select name="sort" id="sort" class="px-3 py-2 rounded border md:min-w-52 mr-2">
                    <option value="default" disabled selected>Sort By..</option>
                    <option value="reach">Most reach</option>
                    <option value="latest">Latest</option>
                </select>

                <button class="rounded-full border border-green-500 px-3 py-2 text-green-500">
                    {{ __("Ascending") }} {{-- Descending --}}
                    <i class="fa-solid fa-arrow-up"></i>
                </button>
            </div>

            <div>
                @foreach ($tags as $tag)
                    <button class="rounded-full border px-3 py-2">
                        {{ $tag->tag }}
                    </button>
                @endforeach
            </div>

        </div>

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