@props(['id', 'title', 'description', 'author', 'date', 'image', "profile" ,'views', 'likes', 'comments'])

<article class='border-2 rounded min-w-72 overflow-hidden mb-4'>
    <div class="relative">
        <img src="{{ asset("images/".$profile) }}" alt="cover" class="w-full object-cover block h-52">
        <button class="absolute bottom-4 right-4 text-amber-300 text-lg" title="{{ __("Add to favourites") }}"><i
                class="fa-regular fa-bookmark"></i></button>
    </div>
    <div class="p-3">
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
            <a href="{{ route("article.show", $id) }}" class="px-4 py-2 bg-blue-800 text-white rounded block w-fit">read more</a>
            <div class="text-gray-500 text-sm flex gap-2">
                <div><i class="fa-solid fa-eye"></i>
                    <span>{{ $views }}</span>
                </div>
                <div><i class="fa-solid fa-comment"></i>
                    <span>{{ $comments }}</span>
                </div>
                <div><i class="fa-solid fa-heart text-red-400"></i>
                    <span>{{ $likes }}</span>
                </div>
            </div>
        </div>
    </div>
</article>