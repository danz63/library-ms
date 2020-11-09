@extends('template/template')
@section('title','Kategori Buku | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Form Kategori</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="d-block">
            <div
                class="w-full md:w-3/5 mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
                <form action="{{ url('/categories/store') }}" method="POST" class="md:w-full sm:w-full sm:mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="name">
                            Nama Kategori
                        </label>
                        <input
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300 placeholder-gray-500"
                            id="name" name="name" type="text" placeholder="Nama Rak" autocomplete="off"
                            value="{{ old('name') }}" autofocus>
                        <p class="text-red-800 text-xs italic">
                            @error('name')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="submit" value="Submit"
                            class="mx-auto lg:mx-2 sm:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full py-2 mx-2 shadow-lg cursor-pointer lg:w-2/3 md:w-2/3 sm:w-full sm:block transition duration-300">Simpan</button>
                        <button type="button" onclick="window.history.back();"
                            class="mx-auto lg:mx-2 sm:mx-0 bg-red-500 hover:bg-red-400 text-gray-100 font-bold rounded-full py-2 mx-2 shadow-lg cursor-pointer lg:w-2/3 md:w-2/3 sm:w-full sm:block transition duration-300">Kembali</button>
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