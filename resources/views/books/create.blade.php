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
                class="w-full md:w-3/5 mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
                <form action="{{ url('/do_register') }}" method="POST" class="md:w-full sm:w-full sm:mx-auto"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="username">
                            Judul
                        </label>
                        <input
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
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
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="address">
                            Alamat
                        </label>
                        <textarea class="shadow appearance-none border 
                        @if (session('status') === 'address') border-red-800
                        @else border-blue-500 focus:outline-none focus:shadow-outline
                        @endif rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="address" name="address" type="text" placeholder="Address" autocomplete="off"
                            rows="4">{{ old('address') }}</textarea>
                        <p class="text-red-800 text-xs italic">
                            @error('address')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
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
                            class="mx-auto lg:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full my-6 py-2 shadow-lg cursor-pointer w-full transition duration-300">Register</button>
                    </div>
                    <div class="d-block my-4">
                        <p class="text-gray-700 text-md text-center">Sudah Punya akun?
                            <a href="{{ url('/') }}" class="text-blue-700 text-md hover:underline">
                                Login
                            </a>
                        </p>
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