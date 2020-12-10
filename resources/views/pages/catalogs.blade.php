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
            @if ($query)
            <div class="w-full mb-4">
                <p class="text-black opacity-75">Hasil Pencarian '{{ $query }}'</p>
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
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <div class="h-64">
                        <img alt="Placeholder" class="h-full mx-auto" src="{{ asset('img/books/'.$book->images) }}">
                    </div>
                    <header class="flex items-center justify-between leading-tight p-2 md:px-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline hover:text-teal-500 text-teal-600" href="#">
                                {{ $book->title }}
                            </a>
                        </h1>
                    </header>
                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <a class="no-underline hover:underline hover:text-teal-500 text-teal-600" href="#">
                            <p class="ml-2 text-sm">
                                {{ getAuthorOfBook($book->id)->name }}
                            </p>
                        </a>
                    </footer>

                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('script')
@include('js/scroll')
@endsection