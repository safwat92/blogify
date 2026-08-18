@props(['id', 'title', 'description', 'author', 'date', 'image', "profile", 'views', 'likes', 'comments'])

<article class='border border-gray-200 rounded-lg overflow-hidden mb-4 flex flex-col-reverse sm:flex-row-reverse justify-between bg-white shadow-sm hover:shadow-md transition-shadow'>
    <div class="relative p-3 w-full sm:w-auto shrink-0">
        <img src="https://images.unsplash.com/photo-1761839257961-4dce65b72d99?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8" alt="cover" class="w-full h-48 sm:w-52 sm:h-52 sm:min-w-52 sm:max-w-52 object-cover block rounded">
    </div>
    <div class="p-4 sm:px-6 sm:py-4 flex-1 flex flex-col justify-between">
        <div>
            <h3 class="text-lg sm:text-xl font-bold mb-2 line-clamp-2">{{ $title }}</h3>
            <p class="text-gray-700 text-sm sm:text-base line-clamp-2">{{ $description }}</p>
        </div>

        <div>
            <div class="flex items-center justify-between pt-3 text-sm text-gray-500">
                <div class="flex items-center">
                    <img src="{{ asset("storage/" . $image) }}" alt="author" class="w-6 h-6 rounded-full mr-2 object-cover">
                    <span class="font-medium text-xs sm:text-sm">{{ $author }}</span>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center mt-4 gap-2">
                <a href="{{ route("show-article", $id) }}" class="px-4 py-2 bg-black hover:bg-gray-800 text-white text-xs sm:text-sm font-medium rounded block w-fit transition-colors">read more</a>
                <div class="text-gray-500 text-xs sm:text-sm flex items-center gap-3">
                    <div class="flex items-center gap-1"><i class="fa-solid fa-eye"></i>
                        <span>{{ $views }}</span>
                    </div>
                    <div class="flex items-center gap-1"><i class="fa-solid fa-comment"></i>
                        <span>{{ $comments }}</span>
                    </div>
                    <div class="flex items-center gap-1"><i class="fa-solid fa-heart"></i>
                        <span>{{ $likes }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>