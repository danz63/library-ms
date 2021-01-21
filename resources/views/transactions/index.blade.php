<?php
$notifications = getNotifications();
?>
@extends('template/template')
@section('title','Data Peminjaman | Library Management System')
@section('content')
<script>
    document.onreadystatechange = function () {
    if (document.readyState === 'interactive') {
        showActive();
    }
}
</script>
{{-- 
    Status Table Peminjaman
    default peberian pada method addWishList()
    0 => 'belum diajukan peminjaman oleh member'
    Diubah oleh method ApplyLoan()
    1 => 'sudah diajukan peminjaman oleh member, belum dikonfirmasi admin'
    
    di proses oleh function response
    2 => 'sudah dikonfirmasi admin (buku fisik belu diambil)'
    3 => 'buku sudah diambil (masa peminjaman)'
    4 => 'buku sudah dikembalikan' 
--}}
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-full mx-auto m-8">
        <div class="w-full md:w-full mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Data Peminjaman</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="d-block">
                <div class="d-block my-5 mx-3">
                    <ul class="list-reset border-b flex sm:hidden md:hidden lg:flex xl:flex text-sm">
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-blue-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/wishlist') }}" id="wishlist">Wishlist
                            </a>
                        </li>
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-orange-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/applied') }}" id="applied">
                                Menunggu Konfirmasi
                                @foreach ($notifications['detail'] as $item)
                                @if ($item->status_borrow =='Anggota Menunggu Konfirmasi')
                                <span class="rounded bg-red-500 text-white uppercase px-1 text-xs font-bold ml-2">
                                    {{ $item->jum }}
                                </span>
                                @endif
                                @endforeach
                            </a>
                        </li>
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-green-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/confirmed') }}" id="confirmed">Belum diambil</a>
                        </li>
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-blue-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/loaned') }}" id="loaned">Sedang Dipinjam</a>
                        </li>
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-red-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/expired') }}" id="expired">
                                Hampir Habis
                                @foreach ($notifications['detail'] as $item)
                                @if ($item->status_borrow =='Hampir Habis')
                                <span class="rounded bg-red-500 text-white uppercase px-1 text-xs font-bold ml-2">
                                    {{ $item->jum }}
                                </span>
                                @endif
                                @endforeach
                            </a>
                        </li>
                        <li class="mr-1">
                            <a class="bg-white hover:bg-gray-200 inline-block py-2 px-4 text-teal-800 hover:underline font-semibold"
                                href="{{ url('transaction/list/returned') }}" id="returned">Sudah Dikembalikan</a>
                        </li>
                    </ul>
                    <select
                        class="hidden sm:flex md:flex lg:hidden xl:hidden shadow appearance-none border 
                    border-blue-500 focus:outline-none rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                        onchange="window.location=this.value;">
                        <option value="{{ url('transaction/list/wishlist') }}" id="opt_wishlist">Wishlist</option>
                        <option value="{{ url('transaction/list/applied') }}" id="opt_applied">Menunggu Konfirmasi
                        </option>
                        <option value="{{ url('transaction/list/loaned') }}" id="opt_loaned">Sedang Dipinjam</option>
                        <option value="{{ url('transaction/list/expired') }}" id="opt_expired">Hampir Habis</option>
                        <option value="{{ url('transaction/list/returned') }}" id="opt_returned">Sudah Dikembalikan
                        </option>
                    </select>
                </div>
                <table class="border-collapse w-full" id="Table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1">
                                #</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1/6">
                                Nama Member</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-64">
                                Buku
                            </th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-64">
                                @if ($active_tab=='loaned')
                                Waktu Peminjaman
                                @else
                                @if ($active_tab=='expired')
                                Tenggat Waktu Pengembalian
                                @else
                                @if ($active_tab=='returned')
                                Waktu Pengembalian
                                @else
                                Waktu
                                @endif
                                @endif
                                @endif
                            </th>
                            @if ($active_tab!='returned')
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-64">
                                @if ($active_tab=='loaned')
                                Tenggat Waktu Pengembalian
                                @else
                                Konfirmasi
                                @endif
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $r)
                        <tr
                            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">#</span>
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Nama Member</span>
                                {{ $r->name }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Buku</span>
                                <p class="whitespace-pre-line sm:ml-16 lg:ml-0">{{ $relation[$r->id] }}</p>
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    @if ($active_tab=='loaned')
                                    Waktu Peminjaman
                                    @else
                                    @if ($active_tab=='expired')
                                    Tenggat Waktu Pengembalian
                                    @else
                                    @if ($active_tab=='returned')
                                    Waktu Pengembalian
                                    @else
                                    Waktu
                                    @endif
                                    @endif
                                    @endif
                                </span>
                                @if ($active_tab=='loaned')
                                {{ parsingDate($r->updated_at) }}
                                @else
                                @if ($active_tab=='expired')
                                {{ parsingDate(date('Y-m-d H:i:s',strtotime($r->updated_at.'+ 7 days'))) }}
                                @else
                                {{ parsingDate($r->created_at) }}
                                @endif
                                @endif
                            </td>
                            @if ($active_tab!='returned')
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    @if ($active_tab=='loaned')
                                    Tenggat Waktu Pengembalian
                                    @else
                                    Konfirmasi
                                    @endif
                                </span>
                                @if ($active_tab=='wishlist')
                                <p class="text-gray-800 text-sm">Wishlist belum diajukan oleh member</p>
                                @else
                                @if ($active_tab=='loaned')
                                {{ parsingDate(date('Y-m-d H:i', strtotime("+7 days", strtotime($r->updated_at)))) }}
                                @else
                                <a href="{{ url('transaction/response/'.nextAction($active_tab).'/'.$r->id) }}"
                                    class="bg-blue-700 text-gray-200 hover:bg-blue-500 px-2 py-1 text-sm rounded mx-1 focus:outline-none focus:shadow-outline">
                                    <i class="fa fa-fw fa-check-circle"></i>
                                    Konfirmasi
                                    @if ($active_tab=='confirmed')
                                    Pengambilan
                                    @endif
                                    @if ($active_tab=='expired')
                                    Pengembalian
                                    @endif
                                </a>
                                @endif
                                @endif
                            </td>
                            @endif
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
<script>
    function showActive(){
        let tab = document.getElementById("{{ $active_tab }}");
        tab.classList.add("border-l","border-t","border-r","rounded-t");
        tab.parentElement.classList.add("-mb-px");
        let opt = document.getElementById("opt_{{ $active_tab }}");
        opt.setAttribute('selected','selected');
    }
</script>
@include('js/datatable')
@include('js/scroll')
@endsection