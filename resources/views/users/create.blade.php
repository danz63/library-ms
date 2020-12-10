@extends('template/template')
@section('title','Users | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Form Pengguna</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="d-block">
            <div
                class="w-full md:w-3/5 mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
                <form action="{{ url('/users/store') }}" method="POST" class="md:w-full sm:w-full sm:mx-auto"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="username">
                            Username
                        </label>
                        <input
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="username" name="username" type="text" placeholder="Username" autocomplete="off"
                            value="{{ old('username') }}" autofocus>
                        <p class="text-red-800 text-xs italic">
                            @error('username')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border rounded
                         border-blue-500 focus:outline-none focus:shadow-outline
                         border-red-800 w-full py-2 px-3 text-gray-700 leading-tight transition duration-300"
                            id="password" name="password" type="password" placeholder="Password">
                        <p class="text-red-800 text-xs italic">
                            @error('password')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="fullname">
                            Nama Lengkap
                        </label>
                        <input class="shadow appearance-none border 
                         border-blue-500 focus:outline-none focus:shadow-outline
                         rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300" id="fullname"
                            name="fullname" type="text" placeholder="Fullname" autocomplete="off"
                            value="{{ old('fullname') }}">
                        <p class="text-red-800 text-xs italic">
                            @error('fullname')
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
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="access_id">
                            Akses sebagai
                        </label>
                        <select class="shadow appearance-none border 
                        @if (session('status') === 'access_id') border-red-800
                        @else border-blue-500 focus:outline-none focus:shadow-outline
                        @endif rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="access_id" name="access_id">
                            <option disabled selected> Pilih Akses </option>
                            @foreach ($access as $acs)
                            <option value="{{ $acs->id }}">{{ $acs->level }}</option>
                            @endforeach
                        </select>
                        <p class="text-red-800 text-xs italic">
                            @error('access_id')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="submit" value="Submit"
                            class="mx-auto lg:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full my-2 py-2 shadow-lg cursor-pointer w-full transition duration-300 focus:outline-none focus:shadow-outline">Simpan</button>

                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button" onclick="window.location.href = '{{ url('users') }}';"
                            class="mx-auto lg:mx-0 bg-red-500 hover:bg-red-400 text-gray-100 font-bold rounded-full py-2 shadow-lg cursor-pointer w-full transition duration-300 focus:outline-none focus:shadow-outline">Kembali</button>
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