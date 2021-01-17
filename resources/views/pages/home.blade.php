@section('title','Home Page | Library Management System')
@extends('template/template')
@section('content')
<div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center" id="log_form">
        <!--Left Col-->
        @if (!_isLoggedIn())
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start sm:items-center text-center md:text-left">
            <form action="{{ url('/do_login') }}" method="POST"
                class="bg-transparent px-8 pt-6 pb-8 mb-4 w-full border border-gray-800 border-opacity-50 rounded">
                @csrf
                <div class="mb-4">
                    <h1 class="text-center text-3xl font-bold text-gray-200">Form Login</h1>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2 uppercase text-gray-200" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border 
                        @if (session('status') === 'username') border-red-800
                        @else border-blue-500 focus:outline-none focus:shadow-outline
                        @endif rounded w-full py-2 px-3 text-black leading-tight transition duration-300" id="username"
                        name="username" type="text" placeholder="Username" autocomplete="off"
                        value="{{ old('username') }}" autofocus>
                    <p class="text-red-800 text-xs italic">
                        @if (session('status') === 'username') {{ session('message') }} @else &nbsp; @endif
                    </p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2 uppercase text-gray-200" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded
                        @if (session('status') === 'password') border-red-800
                        @else border-blue-500 focus:outline-none focus:shadow-outline
                        @endif  border-red-800 w-full py-2 px-3 text-black leading-tight transition duration-300"
                        id="password" name="password" type="password" placeholder="Password">
                    <p class="text-red-800 text-xs italic">
                        @if (session('status') === 'password') {{ session('message') }} @else &nbsp; @endif
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" name="submit" value="Submit"
                        class="mx-auto lg:mx-0 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold rounded-full my-6 py-2 shadow-lg cursor-pointer w-full transition duration-300">Login</button>
                </div>
                <div class="d-block my-4">
                    <p class="text-gray-200 text-md text-center">Belum Punya akun?
                        <a href="{{ url('/register') }}" class="text-blue-200 text-md hover:underline">
                            Daftar
                        </a>
                    </p>
                </div>
            </form>
        </div>
        @else
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start sm:items-center text-center md:text-left">
            <h1 class="my-4 text-3xl font-bold leading-tight">Sistem Manajemen Perpustakaan</h1>
            <form class="bg-transparent px-8 pt-6 pb-8 mb-4 w-full border border-gray-800 border-opacity-50 rounded"
                action="{{ url('pages/books') }}" method="get">
                <div class="flex items-center border-b border-gray-100 py-2">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-white mr-3 py-1 px-2 leading-tight focus:outline-none"
                        name="query" type="text" placeholder="Cari Buku" autocomplete="off">
                    <button
                        class="flex-shrink-0 bg-gray-100 hover:bg-gray-300 border-gray-100 hover:border-gray-300 text-sm border-4 text-black py-1 px-2 rounded"
                        type="button">
                        <i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        @endif
        <!--Right Col-->
        <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50 md:ml-32" src="{{ asset('assets/img/clipart188689.png') }}">
        </div>
    </div>
</div>
<div class="relative mt-12 lg:-mt-24">
    @include('svgs.wave')
</div>
<section class="bg-white py-8">
    <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Perpustakaan</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-5/6 sm:w-1/2 p-6">
                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">Lautan Inspirasi, Timbunan Harta</h3>
                <p class="text-gray-600 mb-8 text-justify">Perpustakaan menyimpan energi yang mendorong imajinasi.
                    Ia membuka jendela ke dunia dan menginspirasi manusia untuk lebih mengeksplorasi, serta
                    berkonribusi untuk meningkatkan kualitas hidupnya, <b>Sidney Sheldon</b>.</p>
                <p class="text-gray-600 mb-8 text-justify">Ada Lebih Banyak Harta Didalam Buku Daripada apa yang
                    didapat perampok di pulau harta. <b>Walt Disney</b>.</p>
            </div>
            <div class="w-full sm:w-1/2 p-6">
                <title>Bookshelfs</title>
                @include('svgs.bookshelfs')
            </div>
        </div>
        <div class="flex flex-wrap flex-col-reverse sm:flex-row">
            <div class="w-full sm:w-1/2 p-1 mt-6">
                @include('svgs.hangouts')
            </div>
            <div class="w-full sm:w-1/2 p-6 mt-6">
                <div class="align-middle">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">Tentang Sistem</h3>
                    <p class="text-gray-600 mb-8 text-justify">Sistem Informasi Manajemen Perpustakaan yang dibangun
                        untuk memberikan informasi kepada anggota perpustakaan tentang buku-buku yang tersedia,
                        serta memudahkan pustakawan untuk mengatur dan memonitoring buku yang tersedia</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-white py-8">
    <div class="container mx-auto flex flex-wrap pt-4 pb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Dibangun Dengan</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                <div class="flex flex-wrap no-underline hover:no-underline">
                    <div class="w-full font-bold text-xl text-gray-800 px-6">Laravel 8.x</div>
                    <p class="text-gray-800 text-base px-6 mb-5 text-justify">
                        Laravel is a web application framework with expressive, elegant syntax. We’ve already laid
                        the foundation — freeing you to create without sweating the small things.
                    </p>
                </div>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                <div class="flex items-center justify-start">
                    <a href="https://laravel.com/"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg">Visit</a>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                <div class="flex flex-wrap no-underline hover:no-underline">
                    <div class="w-full font-bold text-xl text-gray-800 px-6">Tailwind CSS 1.9.x</div>
                    <p class="text-gray-800 text-base px-6 mb-5 text-justify">
                        Highly Customizable, Low-Level CSS Framework That Gives You All Of The Building Blocks You
                        Need
                    </p>
                </div>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                <div class="flex items-center justify-center">
                    <a href="https://tailwindcss.com/"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg">Visit</a>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                    <div class="w-full font-bold text-xl text-gray-800 px-6">Font Awesome 5.x</div>
                    <p class="text-gray-800 text-base px-6 mb-5 text-justify">
                        Get vector icons and social logos on your website with Font Awesome, the web's most popular
                        icon set and toolkit.
                    </p>
                </a>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                <div class="flex items-center justify-end">
                    <a href="https://fontawesome.com/"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg">Visit</a>
                </div>
            </div>
        </div>
    </div>
</section>
<button type="button" id="btnTop"
    class="rounded-full h-12 w-12 gradient transition duration-500 text-gray-100 focus:outline-none shadow-lg fixed right-0 bottom-0 mr-5 mb-5 z-50 invisible"
    onclick="scrollIt();">
    <i class="fas fa-chevron-right fa-rotate-270"></i>
</button>
@endsection
@section('script')
@include('js/scroll')
<script>
    function scrollIt() {
        const element = document.querySelector("#log_form");
        element.scrollIntoView({
            behavior: 'smooth'
        });
        setTimeout(function () {
            element.querySelector("#username").focus();
        }, 1000);
    }

    document.body.onscroll = function () {
        if (window.scrollY > 380) {
            document.getElementById('btnTop').classList.remove('invisible');
        } else {
            document.getElementById('btnTop').classList.add('invisible');
        }
    }
</script>
@endsection