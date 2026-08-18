@extends("blog.index")

@section("title", "Blogify | Write Article")

@section("content")

    <form action="{{route("create-article")}}" method="POST" class="max-w-[1200px] mx-auto p-4 sm:p-6">
        @csrf
        <textarea name="content" id="myeditor"></textarea>
        <button type="submit" class="px-6 py-2.5 bg-black hover:bg-gray-800 text-white font-medium rounded-lg transition-colors block w-full sm:w-fit mt-4"> {{__("save")}} </button>
    </form>


@endsection

@push("scripts")
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/ua1b5naw783z87b6gvhju2gzqa89beqaxoclkefxq0pnud9l/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Premium features
                'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            tinymceai_token_provider: async () => {
                await fetch(`https://demo.api.tiny.cloud/1/ua1b5naw783z87b6gvhju2gzqa89beqaxoclkefxq0pnud9l/auth/random`, { method: "POST", credentials: "include" });
                return { token: await fetch(`https://demo.api.tiny.cloud/1/ua1b5naw783z87b6gvhju2gzqa89beqaxoclkefxq0pnud9l/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
            },
            uploadcare_public_key: 'dde1459bd0b91fc74ea1',
        });
    </script>
@endpush
