@extends('template/template')
@section('title','Book | Library Management System')
@section('content')
@include('svgs.wave')
<section class="bg-white py-8">
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Form Buku</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="d-block">
            <div
                class="w-full md:w-3/5 mx-auto sm:items-center text-center md:text-left border border-blue-500 p-5 rounded bg-gray-100">
                <form action="{{ url('/books/store') }}" method="POST" class="md:w-full sm:w-full sm:mx-auto"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="title">
                            Judul
                        </label>
                        <input
                            class="shadow appearance-none border 
                            focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight transition duration-300"
                            id="title" name="title" type="text" placeholder="Judul" autocomplete="off"
                            value="{{ old('title') }}" autofocus>
                        <p class="text-red-800 text-xs italic">
                            @error('title')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="writers">
                            Penulis
                        </label>
                        <select
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="writers" name="writers">
                            <option disabled selected>Pilih Penulis</option>
                            @foreach ($options->writers as $writer)
                            <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-red-800 text-xs italic">
                            @error('writers')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="publishers">
                            Penerbit
                        </label>
                        <select
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="publishers" name="publishers">
                            <option selected>Pilih Penerbit</option>
                            @foreach ($options->publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-red-800 text-xs italic">
                            @error('publishers')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="year">
                            Tahun Terbit
                        </label>
                        <input
                            class="shadow appearance-none border 
                            focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight transition duration-300"
                            id="year" name="year" type="text" placeholder="Tahun" autocomplete="off"
                            value="{{ old('year') }}" pattern="[0-9]{4}">
                        <p class="text-red-800 text-xs italic">
                            @error('year')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="bookshelfs">
                            Rak
                        </label>
                        <select
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none rounded w-full py-2 px-3 text-gray-700 leading-tight transition duration-300"
                            id="bookshelfs" name="bookshelfs">
                            <option disabled selected>Pilih Rak</option>
                            @foreach ($options->bookshelfs as $bookshelf)
                            <option value="{{ $bookshelf->id }}">{{ $bookshelf->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-red-800 text-xs italic">
                            @error('bookshelfs')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700">
                            Kategori
                        </label>
                        <div
                            class="shadow appearance-none border 
                        border-blue-500 focus:outline-none rounded w-full py-2 px-3 text-gray-700 leading-tight transition duration-300 grid grid-flow-row grid-cols-2 gap-4">
                            @foreach ($options->categories as $category)
                            <div class="font-bold inline text-sm">
                                <input type="checkbox" value="{{ $category->id }}" name="categories[]"
                                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                <span class="py-2">{{ $category->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="image">
                            Foto
                        </label>
                        <input class="shadow appearance-none border 
                        @if (session('status') === 'image') border-red-800
                        @else border-blue-500 focus:outline-none focus:shadow-outline
                        @endif rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="image" name="image" type="file" autocomplete="off" value="{{ old('image') }}">
                        <p class="text-red-800 text-xs italic">
                            @error('image')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="submit" value="Submit"
                            class="mx-auto lg:mx-2 sm:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full py-2 mx-2 shadow-lg cursor-pointer lg:w-2/3 md:w-2/3 sm:w-full sm:block transition duration-300 focus:outline-none focus:shadow-outline">Simpan</button>
                        <button type="button" onclick="window.location.href='{{ url('books') }}';"
                            class="mx-auto lg:mx-2 sm:mx-0 bg-red-500 hover:bg-red-400 text-gray-100 font-bold rounded-full py-2 mx-2 shadow-lg cursor-pointer lg:w-2/3 md:w-2/3 sm:w-full sm:block transition duration-300 focus:outline-none focus:shadow-outline">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
@include('js/scroll')
@endsection