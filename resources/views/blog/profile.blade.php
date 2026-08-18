@extends("blog.index")

@section("title", "Blogify | Profile")
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section("content")
@section("content")
    <div class="mt-6 sm:mt-10 max-w-[1200px] m-auto px-4">
        <div class="flex flex-col lg:flex-row gap-5">
            <!-- User Info Card -->
            <div class="border border-gray-200 rounded-lg p-4 sm:p-6 flex-1 bg-white shadow-sm">
                <h3 class="text-xl sm:text-2xl mb-4 font-bold text-gray-900">{{ __("User Info") }}</h3>
                <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4">
                    <img src="{{ asset("storage/" . auth()->user()->profile_image) }}" alt="{{ __("user profile") }}"
                        class="rounded-full w-28 h-28 sm:w-32 sm:h-32 object-cover cursor-pointer hover:opacity-90 transition-opacity shrink-0 border-2 border-gray-100 shadow-sm" id="profile-image" title="Click to change profile picture">
                    <div class="flex-1 w-full">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">{{ auth()->user()->full_name }}</h4>
                            <span class="text-gray-600 text-sm block pb-2 font-medium">{{ auth()->user()->email }}</span>
                            <p class="text-gray-700 text-sm max-w-full sm:max-w-80 mb-4 mx-auto sm:mx-0">{{ auth()->user()->description }}</p>
                        </div>
                        <div class="text-gray-500 flex gap-6 justify-center sm:justify-start text-sm">
                            <div title="{{ __("Total Views") }}" class="flex items-center gap-1.5"><i class="fa-solid fa-eye"></i>
                                <span>{{ $views }}</span>
                            </div>
                            <div title="{{ __("Total Comments") }}" class="flex items-center gap-1.5"><i class="fa-solid fa-comment"></i>
                                <span>{{ $comments }}</span>
                            </div>
                            <div title="{{ __("Total Likes") }}" class="flex items-center gap-1.5"><i class="fa-solid fa-heart text-red-500"></i>
                                <span>{{ $likes }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Card -->
            <div class="border border-gray-200 rounded-lg p-4 sm:p-6 flex-1 bg-white shadow-sm">
                <h3 class="text-xl sm:text-2xl mb-4 font-bold text-gray-900">{{ __("Edit Profile") }}</h3>
                <form action="{{ route("profile.update", auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">{{ __("Name") }}</label>
                            <input type="text" name="full_name" id="full_name"
                                value="{{ old('full_name', auth()->user()->full_name) }}"
                                class="px-3 py-2 rounded border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('full_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __("Email") }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                class="px-3 py-2 rounded border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __("Description") }}</label>
                            <textarea name="description" id="description" rows="3"
                                class="px-3 py-2 rounded border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', auth()->user()->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="file" hidden id="profile-upload-image" name="profile_image">
                        <button type="submit"
                            class="mt-3 px-5 py-2 bg-black hover:bg-gray-800 text-white rounded-lg font-medium text-sm transition-colors w-full sm:w-fit block">{{ __("Update Info") }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabbed Navigation -->
        <div class="mt-8">
            <div class="text-base sm:text-xl font-bold flex mb-6 border-b border-gray-200">
                <a class="px-4 py-3 border-b-2 border-blue-500 text-blue-600 bg-blue-50/50 rounded-t"
                    href="{{ route("profile.index") }}">{{ __("Your Articles") }}</a>
                <a class="px-4 py-3 text-gray-600 hover:text-gray-900 transition-colors" href="{{ route("show-bookmarks") }}">{{ __("Bookmarks") }}</a>
            </div>
            <div class="flex flex-col gap-3">
                @foreach ($articles as $article)
                    <x-article :id="$article->id" :title="$article->title" :description="$article->description"
                        :author="auth()->user()->full_name" :date="$article->updated_at" :image="auth()->user()->profile_image"
                        :profile="'cover.png'" :views="$article->views_count" :comments="$article->comments_count"
                        :likes="$article->article_likes_count" />
                @endforeach
                @if(count($articles) == 0)
                    <div class="my-12 text-center">
                        <img src="{{ asset("./images/empty_data.svg") }}" class="mx-auto w-48 sm:w-64" alt="not found">
                        <p class="text-gray-500 mt-4 text-sm sm:text-base">No articles found.</p>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        </div>

    </div>
@endsection


@push("scripts")
    <script type="module">
        const profileUploadBtn = document.getElementById("profile-upload-image");
        const profileImage = document.getElementById("profile-image");

        profileImage.addEventListener("click", () => {
            profileUploadBtn.click();
        })

        profileUploadBtn.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) profileImage.src = URL.createObjectURL(file);
        })
    </script>
@endpush