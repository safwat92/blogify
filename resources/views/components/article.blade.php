@props(['id', 'title', 'description', 'author', 'date', 'image', "profile", 'views', 'likes', 'comments'])

<article class='border-2 rounded overflow-hidden mb-4 flex flex-row-reverse justify-between'>
    <div class="relative p-3">
        <img src="https://images.unsplash.com/photo-1761839257961-4dce65b72d99?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8" alt="cover" class="min-w-52 max-w-52 object-cover block h-52">
    </div>
    <div class="px-6 py-3">
        <h3 class="text-xl font-bold my-3 truncate">{{ $title }}</h3>
        <p class="text-gray-700" style="
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        overflow: hidden;
                                      ">{{$description}}</p>

        <div class="flex items-center justify-between pt-3 text-sm text-gray-500">
            <div class="flex items-center justify-between">
                <img src="{{ asset("storage/" . $image) }}" alt="author" class="w-5 rounded-full mr-2 object-cover">
                <span>{{ $author }}</span>
            </div>
            {{-- <span class="text-xs">{{ $date->format('Y-m-d') }}</span> --}}
        </div>

        <div class="flex justify-between items-center mt-4">
            <a href="{{ route("show-article", $id) }}" class="px-4 py-2 bg-blue-800 text-white rounded block w-fit">read more</a>
            <div class="text-gray-500 text-sm flex gap-2">
                <div><i class="fa-solid fa-eye"></i>
                    <span>{{ $views }}</span>
                </div>
                <div><i class="fa-solid fa-comment"></i>
                    <span>{{ $comments }}</span>
                </div>
                <div><i class="fa-solid fa-heart"></i>
                    <span>{{ $likes }}</span>
                </div>
            </div>
        </div>
    </div>
</article>