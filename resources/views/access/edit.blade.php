@extends('template/template')
@section('title','Access | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Edit Akses</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="d-block">
            <div
                class="w-full md:w-3/5 mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
                <form action="{{ url('/access/update') }}" method="POST" class="md:w-full sm:w-full sm:mx-auto">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" value="{{ $access->id }}">
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="level">
                            Level
                        </label>
                        <input
                            class="shadow appearance-none border 
                            border-blue-500 focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                            id="level" name="level" type="text" placeholder="Level Access" autocomplete="off"
                            value="{{ $access->level }}" autofocus>
                        <p class="text-red-800 text-xs italic">
                            @error('level')
                            {{ $message }}
                            @enderror
                            &nbsp;
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="submit" value="Submit"
                            class="mx-auto lg:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full mt-6 py-2 shadow-lg cursor-pointer w-full transition duration-300">Pebaharui</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button" onclick="window.history.back();"
                            class="mx-auto lg:mx-0 bg-red-500 hover:bg-red-400 text-gray-100 font-bold rounded-full my-3 py-2 shadow-lg cursor-pointer w-full transition duration-300">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@include('js/datatable')
@include('js/scroll')
@endsection