@extends('template/template')
@section('title','Buku | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-full mx-auto m-8">
        <div class="w-11/12 mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Buku</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="d-block w-full mx-auto">
                <div class="d-block text-right my-5 mx-3">
                    <a href="{{ url('/books/create') }}"
                        class="text-base text-gray-200 bg-blue-700 hover:bg-blue-500 hover:text-gray-100 px-2 py-1 rounded"><i
                            class="fas fa-plus fa-sm mr-1"></i> Tambah
                        Buku</a>
                </div>
            </div>
            <div class="flex flex-wrap">
                @foreach ($books as $book)
                <div class="my-1 px-1 w-full md:w-1/3 lg:my-4 lg:px-4 lg:w-1/4">
                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg divide-y divide-gray-200">
                        <div class="h-64 bg-gray-200">
                            <span class="absolute mr-2 bg-white text-black p-1 rounded leading-none text-sm">
                                {{ getStoragesOfBook($book->id) }}
                            </span>
                            <img alt="Placeholder" class="h-full mx-auto" src="{{ asset('img/books/'.$book->images) }}">
                        </div>
                        <header class="flex items-center justify-between leading-tight p-2 md:px-4 h-20">
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
                        <footer class="flex flex-col leading-none px-2 md:px-4 py-1">
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
                            <div class="my-2 text-center">
                                <button onclick="window.location='{{ url('books/edit/'.$book->id) }}';"
                                    class="bg-green-700 text-gray-200 hover:bg-green-500 px-2 py-1 text-sm rounded mx-1 sm:mx-auto focus:outline-none focus:shadow-outline"><i
                                        class="fas fa-sm fa-edit mr-1"></i>
                                    Edit
                                </button>
                                <form action="{{ url('books/destroy/'.$book->id) }}" class="inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button"
                                        onclick="ConfirmDelete(this,'Yakin Ingin menghapus Buku Ini?')"
                                        class="bg-red-700 text-gray-200 hover:bg-red-500 px-2 py-1 text-sm rounded mx-1 sm:mx-auto focus:outline-none focus:shadow-outline">
                                        <i class="fas fa-sm fa-eraser mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </footer>
                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@include('js/datatable')
@include('js/scroll')
@endsection