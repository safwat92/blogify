@extends("blog.index")

@section("title", "Blogify | Bookmarks")
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
    <div class="mt-10 max-w-[1200px] m-auto px-4">
        <div class="flex flex-col lg:flex-row gap-5">
            <div class="border-2 rounded p-3">
                <h3 class="text-2xl mb-6 font-bold">{{ __("User Info") }}</h3>
                <div class="flex items-center">
                    <img src="{{ asset("storage/" . auth()->user()->profile_image) }}" alt="{{ __("user profile") }}"
                        class="rounded-full w-32 h-32 object-cover">
                    <div class="pl-5">
                        <div>
                            <h4 class="text-lg font-bold">{{ auth()->user()->full_name }}</h4>
                            <span class="text-gray-700 text-sm">{{ auth()->user()->email }}</span>
                            <p class="text-gray-700 text-sm max-w-80 mb-4">{{ auth()->user()->description }}</p>
                        </div>
                        <div class="text-gray-500 flex gap-4 justify-center">
                            <div title="{{ __("Total Views") }}"><i class="fa-solid fa-eye"></i>
                                <span>{{ $views }}</span>
                            </div>
                            <div title="{{ __("Total Comments") }}"><i class="fa-solid fa-comment"></i>
                                <span>{{ $comments }}</span>
                            </div>
                            <div title="{{ __("Total Likes") }}"><i class="fa-solid fa-heart"></i>
                                <span>{{ $likes }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="border-2 rounded p-3">
            <h3 class="text-2xl mb-3 font-bold">{{ __("Edit Profile") }}</h3>
            <form action="{{ route("update-profile") }}" method="post">
                @csrf
                <div class="flex gap-3">
                    <div>
                        <label for="full_name">{{ __("Name") }}</label>
                        <input type="text" name="full_name" id="full_name"
                            value="{{ old('full_name', auth()->user()->full_name) }}"
                            class="px-3 py-2 rounded border md:min-w-80 block w-full">
                        @error('full_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email">{{ __("Email") }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                            class="px-3 py-2 rounded border md:min-w-80 block w-full">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class='mt-2'>
                        <label for="description">{{ __("Description") }}</label>
                        <textarea name="description" id="description"
                            class="px-3 py-2 rounded border md:min-w-80 block w-full">{{ old('description', auth()->user()->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-2 px-4 py-2 bg-blue-800 text-white rounded block w-fit">{{ __("Update Info") }}</button>
                </div>
            </form>
        </div>
        </div>

        <div class="mt-4">
            <div class="text-2xl font-bold flex mb-4 border">
                <a class="p-4" href="{{ route("profile") }}">{{ __("Your Articles") }}</a>
                <a class="p-4 border-b border-blue-400 bg-blue-50 block" href="{{ route("bookmarks.index") }}">{{ __("Bookmarks") }}</a>
            </div>
            <div class="flex flex-col gap-3">
                @foreach ($bookmarks as $bookmark)
            <x-article
                :id="$bookmark->id"
                :title="$bookmark->title"
                :description="$bookmark->description"
                :author="auth()->user()->full_name"
                :date="''"
                :image="'user.png'"
                :profile="'cover.png'"
                :views="$bookmark->views_count"
                :comments="$bookmark->comments_count"
                :likes="$bookmark->article_likes_count"
                />
            @endforeach
            </div>
        </div>

    </div>
@endsection