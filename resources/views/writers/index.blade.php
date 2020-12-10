@extends('template/template')
@section('title','Penulis Buku | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-full mx-auto m-8">
        <div class="w-full md:w-full mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Penulis Buku</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="d-block w-4/6 mx-auto">
                <div class="d-block text-right my-5 mx-3">
                    <a href="{{ url('/writers/create') }}"
                        class="text-base text-gray-200 bg-blue-700 hover:bg-blue-500 hover:text-gray-100 px-2 py-1 rounded"><i
                            class="fas fa-plus fa-sm mr-1"></i> Tambah
                        Penulis</a>
                </div>
                <table class="border-collapse w-full" id="Table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1">
                                #</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-2/6">
                                Penulis</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-64">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($writers as $writer)
                        <tr
                            class="bg-white lg:hover:bg-gray-300 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 cursor-pointer">
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">#</span>
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Penulis</span>
                                {{ $writer->name }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-right ms:text-center lg:text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                                <button value="{{ $writer->id }}"
                                    class="bg-teal-700 text-gray-200 hover:bg-teal-500 px-2 py-1 text-sm rounded mx-1 sm:mx-auto">
                                    <i class="fas fa-sm fa-info-circle mr-1"></i>Daftar Buku
                                </button>
                                <button onclick="window.location='{{ url('writers/edit/'.$writer->id) }}'"
                                    class="bg-green-700 text-gray-200 hover:bg-green-500 px-2 py-1 text-sm rounded mx-1 sm:mx-auto focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-sm fa-edit mr-1"></i>Edit
                                </button>
                                <form action="{{ url('writers/destroy/'.$writer->id) }}" class="inline" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button"
                                        onclick="ConfirmDelete(this,'Yakin Ingin menghapus Penulis Ini?')"
                                        class="bg-red-700 text-gray-200 hover:bg-red-500 px-2 py-1 text-sm rounded mx-1 sm:mx-auto focus:outline-none focus:shadow-outline">
                                        <i class="fas fa-sm fa-eraser mr-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@include('js/datatable')
@include('js/scroll')
@endsection