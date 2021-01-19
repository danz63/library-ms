@extends('template/template')
@section('title','Buku | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap mx-1 lg:-mx-4">
            <h1 class="w-full my-2 text-4xl font-bold leading-tight text-center text-gray-800">Daftar Buku</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            @if ($message)
            <div class="w-full mb-4">
                <p class="text-black opacity-75">{{ $message }}</p>
            </div>
            @endif
            <!-- Column -->
            <?php if(count($books) < 1) : ?>
            <div class="w-full mb-4 text-center">
                <p class="text-black opacity-75">Tidak Ditemukan</p>
            </div>
            <?php endif; ?>
            @foreach ($books as $book)
            <div class="my-1 px-1 w-full md:w-1/3 lg:my-4 lg:px-4 lg:w-1/4">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg divide-y divide-gray-200">
                    <div class="h-64 bg-gray-200">
                        @if(_isMember())
                        <form id="FormAddWishList" method="post">
                            @csrf
                            <button
                                class="absolute mr-2 bg-white text-black p-1 rounded leading-none text-sm tooltip focus:outline-none"
                                onclick="addWishList({{$book->id}});" type="button">
                                <i class="fa fa-plus"></i>
                                <span class='tooltip-text bg-blue-200 p-3 -mt-6 -ml-6 rounded w-48'>
                                    Tambahkan Ke Wishlist
                                </span>
                            </button>
                        </form>
                        @endif
                        <img alt="Placeholder" class="h-full mx-auto" src="{{ asset('img/books/'.$book->images) }}">
                    </div>
                    <header class="flex items-center justify-between leading-tight p-2 md:px-4">
                        <h1 class="text-lg">
                            <p class="hover:text-teal-700 text-teal-500 cursor-default">
                                {{ $book->title }}
                            </p>
                        </h1>
                    </header>
                    <div class="pl-1 py-2 h-16 text-black">
                        <span class="text-black text-xs">Tags : </span>
                        @foreach (getCategoriesOfBooks($book->id) as $tag)
                        <a href="{{ url('pages/books?category='.$tag->id) }}"
                            class="hover:text-teal-500 text-teal-600 hover:underline text-xs">
                            {{ $tag->name }}
                        </a>&nbsp;
                        @endforeach
                    </div>
                    <footer class="flex flex-col leading-none p-2 md:p-4">
                        <?php $writer = getAuthorOfBook($book->id); ?>
                        <?php $publisher = getPublisherOfBooks($book->id); ?>
                        <a class="no-underline hover:underline hover:text-teal-500 text-teal-600 ml-2 text-sm mb-2"
                            href="{{ url('pages/books?writer='.$writer->writer_id) }}">
                            {{ $writer->name }}
                        </a>
                        <a class="no-underline hover:underline hover:text-teal-500 text-teal-600 ml-2 text-sm text-right"
                            href="{{ url('pages/books?publisher='.$publisher->publisher_id) }}">
                            {{ $publisher->name }}
                        </a>
                    </footer>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('script')
@include('js/scroll')
<script>
    function addWishList(bookId){
        let data = {
            _token : document.getElementById("FormAddWishList").querySelector("[name=_token]").value,
            params : "book_id=" + bookId+"&user_id="+"{{ session('user_id') }}",
            url : '{{ route('post_wishlist') }}'
        };
        ajax_post(data);
    }
    function ajax_post(data){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let res = JSON.parse(this.responseText);
                Swal.fire({
                    icon: res.icon,
                    title: res.title,
                    text: res.text,
                }).then(() => {
                    location.reload();
                });
            }
        };
        xhttp.open("POST", data.url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-TOKEN", data._token);
        xhttp.send(data.params);
    }
</script>
@endsection