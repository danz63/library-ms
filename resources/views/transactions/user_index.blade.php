<?php
$notifications = getNotifications();
?>
@extends('template/template')
@section('title','Data Peminjaman | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-full mx-auto m-8">
        <div class="w-full md:w-full mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Data Peminjaman Member
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="d-block">
                <div class="inline-block bg-gray-300 px-2 py-1 font-bold rounded">
                    <p class="text-gray-700">
                        <i class="fas fa-fw fa-user"></i>
                        {{ session('name') }}
                    </p>
                </div>
                <table class="border-collapse w-full" id="Table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1/12">
                                #</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-6/12">
                                List Buku</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-2/12">
                                Status
                            </th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-2/12">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $b)
                        <?php $updated_at = ($b->updated_at === null) ? false : $b->updated_at; ?>
                        <?php $detail_status = LoanStatus($b->status, $updated_at); ?>
                        <tr
                            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">#</span>
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    List Buku</span>
                                @foreach ($detail as $d)
                                <div class="grid grid-rows-2 grid-cols-5 gap-2 my-2">
                                    <div class="row-span-2 col-span-1 border h-full">
                                        <div class="h-32 bg-gray-200">
                                            <img src="{{ asset('img/books/'.$d->images) }}" class="h-full mx-auto">
                                        </div>
                                    </div>
                                    <div class="row-span-1 col-span-4 p-3 bg-green-500 border">
                                        <div class="grid grid-rows-1 grid-cols-4 text-gray-900">
                                            <div class="row-span-1 col-span-3 font-bold">
                                                {{ $d->title }}
                                            </div>
                                            @if($detail_status->button)
                                            <div class="row-span-1 col-span-1 text-right">
                                                <button
                                                    onclick="removeWishList('{{ url('transaction/remove_wishlist/'.$d->id) }}');"
                                                    class="w-4 h-4 mb-6 hover:text-red-500 rounded-full cursor-pointer">
                                                    <i class="far fa-fw fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row-span-1 p-1 col-span-4 border">
                                        <p>Penulis : {{ getAuthorOfBook($d->id)->name }}, Penerbit :
                                            {{ getPublisherOfBooks($d->id)->name }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Status</span>
                                <div class="mt-2">
                                    <div class="inline-block w-full mx-auto bg-{{ $detail_status->color }} p-2">
                                        {{ $detail_status->information }}
                                    </div>
                                </div>
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Keterangan</span>
                                <div class="inline-block w-full text-left p-2">
                                    {!! $detail_status->explanation !!}
                                </div>
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