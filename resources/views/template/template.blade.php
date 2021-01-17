<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/ico" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Font Awesome if you need it -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <!-- Replace with your tailwind.css once created -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css"
        integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
        crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <!-- Datatable Vanilla Javascript -->
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet"
        type="text/css">
    <!-- Own Style include Baloon.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="leading-normal tracking-normal text-white gradient">
    <nav id="header" class="fixed w-full z-30 top-0 text-white transition duration-500">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="{{ url('/') }}">
                    <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24">
                        <path
                            d="M23 5v13.883l-1 .117v-16c-3.895.119-7.505.762-10.002 2.316-2.496-1.554-6.102-2.197-9.998-2.316v16l-1-.117v-13.883h-1v15h9.057c1.479 0 1.641 1 2.941 1 1.304 0 1.461-1 2.942-1h9.06v-15h-1zm-12 13.645c-1.946-.772-4.137-1.269-7-1.484v-12.051c2.352.197 4.996.675 7 1.922v11.613zm9-1.484c-2.863.215-5.054.712-7 1.484v-11.613c2.004-1.247 4.648-1.725 7-1.922v12.051z" />
                    </svg>
                    Library MS
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center p-1 text-blue-700 hover:text-gray-900 focus:border-none focus:outline-none">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20 shadow-2xl rounded-lg lg:shadow-none"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    @if (_isMember())
                    <?php $wishList = getWishList(session('user_id')); ?>

                    <li>
                        <div
                            class="dropdown inline-block text-black no-underline hover:text-gray-800 hover:text-underline">
                            <button
                                class="mr-3 px-1 relative border-2 border-transparent text-black rounded-full hover:text-gray-800 focus:outline-none"
                                onclick="showdd(this.parentNode);" title="Wishlist">
                                <i class="fa fa-fw fa-list-alt"></i>
                                @if (count($wishList) > 0)
                                <span class="absolute inset-0 object-right-top -mr-6 -mt-4">
                                    <div
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                        {{ count($wishList) }}
                                    </div>
                                </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu absolute hidden rounded bg-white shadow-outline">
                                <li>
                                    @foreach ($wishList as $wl)
                                    <div
                                        class="p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-100">
                                        <div class="p-2 h-24 w-32">
                                            <img src="{{ asset('img/books/'.$wl->images) }}" alt="img book"
                                                class="h-full mx-auto">
                                        </div>
                                        <div class="flex-auto text-sm w-32">
                                            <div class="font-bold">Buku {{ $loop->iteration }}</div>
                                            <div class="break-words">{{ $wl->title }}</div>
                                        </div>
                                        <div class="flex flex-col w-18 font-medium items-end">
                                            <div
                                                class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700">
                                                <button
                                                    onclick="removeWishList('{{ url('transaction/remove_wishlist/'.$wl->db_id) }}');"
                                                    class="focus:outline-none">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if (count($wishList) > 0)
                                    <div class="p-4 justify-center flex">
                                        <a class="text-base undefined hover:scale-110 focus:outline-none flex justify-center px-2 py-1 rounded font-bold cursor-pointer hover:bg-teal-700 hover:text-teal-100 
                                        bg-teal-100 text-teal-700 border duration-200 ease-in-out 
                                        border-teal-600 transition" href="{{ url('transaction/apply_loan') }}">Ajukan
                                            Peminjaman</a>
                                    </div>
                                    @else
                                    <div class="p-4 justify-center flex">
                                        <p class="text-sm hover:scale-110 focus:outline-none flex justify-center px-2 py-1 rounded cursor-pointer duration-200 ease-in-out 
                                        transition">Wishlist Kosong</p>
                                    </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(_isLoggedIn())
                    <?php $notifications = getNotifications(); ?>
                    <li>
                        <div
                            class="dropdown inline-block text-black no-underline hover:text-gray-800 hover:text-underline">
                            <button
                                class="mr-3 px-1 relative border-2 border-transparent text-black rounded-full hover:text-gray-800 focus:outline-none"
                                onclick="showdd(this.parentNode);" title="Notifikasi">
                                <i class="fa fa-fw fa-bell"></i>
                                @if (count($notifications['detail']) > 0)
                                <span class="absolute inset-0 object-right-top -mr-6 -mt-4">
                                    <div
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                        {{ count($notifications['detail']) }}
                                    </div>
                                </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu absolute hidden rounded bg-white shadow-outline">
                                <li>
                                    <div class="p-2 flex bg-white border-b border-gray-100">
                                        <div class="flex-auto text-sm w-64">
                                            <div class="font-bold">{{ $notifications['message'] }}</div>
                                            @if (_isMember())
                                            <div class="break-words">
                                                {{ count($notifications['detail']) }}
                                                {{ $notifications['detail_message'] }}
                                            </div>
                                            @elseif (_isAdmin())
                                            @foreach ($notifications['detail'] as $item)
                                            <div class="break-words">
                                                {{ $item->jum }}
                                                {{ $item->status_borrow }}
                                            </div>
                                            @endforeach
                                            <a href="{{ url('transaction/list/applied') }}"
                                                class="underline hover:no-underline text-blue-800">Lihat
                                                Semua</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li>
                        <div
                            class="dropdown inline-block text-black no-underline hover:text-gray-800 hover:text-underline px-4">
                            <button class="rounded inline-flex items-center focus:outline-none focus:border-none"
                                onclick="showdd(this.parentNode);">
                                <span class="mr-1"><i class="fas fa-fw fa-book mr-1"></i>Buku</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden rounded bg-white shadow-outline">
                                @if (_isAdmin())
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2"
                                        href="{{ url('/transaction/list/wishlist') }}">
                                        <i class="fas fa-fw fa-list mr-1"></i>
                                        Data Peminjaman
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2"
                                        href="{{ url('/books') }}"><i class="fas fa-fw fa-atlas mr-1"></i>Buku
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/bookshelfs') }}"><i class="fas fa-fw fa-layer-group mr-1"></i>Rak
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/categories') }}"><i class="fas fa-fw fa-tag mr-1"></i>Kategori
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/publishers') }}"><i
                                            class="fas fa-fw fa-building mr-1"></i>Penerbit
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/writers') }}"><i class="fas fa-fw fa-user-edit mr-1"></i>Penulis
                                    </a>
                                </li>
                                @endif
                                @if (_isMember() || !_isLoggedIn())
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2"
                                        href="{{ url('/pages/books') }}"><i class="fas fa-fw fa-atlas mr-1"></i>Daftar
                                        Buku
                                    </a>
                                </li>
                                @endif
                                @if (_isMember())
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/books') }}"><i class="fas fa-fw fa-book-reader mr-1"></i>Pinjaman
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @if (_isAdmin())
                    <li>
                        <div
                            class="dropdown inline-block text-black no-underline hover:text-gray-800 hover:text-underline px-4">
                            <button class="rounded inline-flex items-center focus:outline-none focus:border-none"
                                onclick="showdd(this.parentNode);">
                                <span class="mr-1"><i class="fas fa-fw fa-users mr-1"></i>Pengguna</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden rounded bg-white shadow-outline">
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/access') }}"><i class="fas fa-fw fa-key mr-1"></i>Akses
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 "
                                        href="{{ url('/users') }}"><i class="fas fa-fw fa-users mr-1"></i>Pengguna
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if (_isMember() || _isAdmin())
                    <li>
                        <div
                            class="dropdown inline-block text-black no-underline hover:text-gray-800 hover:text-underline px-4">
                            <button class="rounded inline-flex items-center focus:outline-none focus:border-none"
                                onclick="showdd(this.parentNode);">
                                <span class="mr-1"><i class="fas fa-fw fa-user mr-1"></i>Akun</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden rounded bg-white shadow-outline">
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 w-32"
                                        href="{{ url('/user/detail') }}"><i
                                            class="fas fa-fw fa-user-alt mr-1"></i>Profilku
                                    </a>
                                </li>
                                <li>
                                    <a class="text-black no-underline hover:text-gray-800 hover:bg-gray-300 hover:text-underline block whitespace-no-wrap py-2 pr-4 pl-2 w-32"
                                        href="{{ url('/do_logout') }}"><i
                                            class="fas fa-fw fa-sign-out-alt mr-1"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(!_isLoggedIn())
                    <li>
                        <a href="{{ url('/') }}"
                            class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline pl-2 pr-1 rounded inline-flex items-center focus:outline-none focus:border-none"
                            title="Sign In">
                            <i class="fa fa-fw fa-sign-in-alt"></i>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ url('faq') }}"
                            class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline pl-1 pr-4 rounded inline-flex items-center focus:outline-none focus:border-none"
                            title="FAQ">
                            <i class="fas fa-fw fa-question-circle"></i>
                        </a>
                    </li>
                    <li>
                        <form class="w-full max-w-sm" action="{{ url('pages/books/') }}" method="get">
                            <div class="flex items-center py-2">
                                <input
                                    class="appearance-none border rounded w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none placeholder-gray-700"
                                    type="text" name="query" placeholder="Cari Buku" autocomplete="Off">
                                <button
                                    class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 border-gray-100 hover:border-gray-200 text-sm border-4 text-black py-1 px-2 rounded"
                                    type="submit">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
    @yield('content')
    @include('svgs.wave2')
    <section class="container mx-auto text-center py-6 mb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">Kunjungi Kami</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <h3 class="my-4 text-2xl leading-tight">Jl. Raya Pasirukem Desa Pasirukem Kecamatan Cilamaya
            Kulon Kabupaten Karawang
        </h3>
    </section>
    <!--Footer-->
    <footer class="bg-white">
        <div class="container mx-auto  px-8">
            <div class="w-full flex flex-col md:flex-row py-6">
                <div class="flex-1 mb-6">
                    <a class="text-blue-700 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                        <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            viewBox="0 0 24 24">
                            <path
                                d="M23 5v13.883l-1 .117v-16c-3.895.119-7.505.762-10.002 2.316-2.496-1.554-6.102-2.197-9.998-2.316v16l-1-.117v-13.883h-1v15h9.057c1.479 0 1.641 1 2.941 1 1.304 0 1.461-1 2.942-1h9.06v-15h-1zm-12 13.645c-1.946-.772-4.137-1.269-7-1.484v-12.051c2.352.197 4.996.675 7 1.922v11.613zm9-1.484c-2.863.215-5.054.712-7 1.484v-11.613c2.004-1.247 4.648-1.725 7-1.922v12.051z" />
                        </svg>
                        Library MS
                    </a>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">About Me</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://web.facebook.com/moch.dhannie"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-facebook"></i>
                                Facebook
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://www.linkedin.com/in/danz63/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-linkedin"></i>
                                Linkedin
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://github.com/danz63"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-github"></i>
                                Github
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Framework</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://laravel.com/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-laravel"></i> Laravel
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://tailwindcss.com/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-css3"></i> Tailwind
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://fontawesome.com/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">
                                <i class="fab fa-font-awesome-flag"></i> Font Awesome
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Credit</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://www.tailwindtoolbox.com/templates/landing-page"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">Tailwind
                                Toolbox</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://iconmonstr.com/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">Iconmonstr</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://undraw.co/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">unDraw</a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Credit</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://www.freepik.com/free-photos-vectors/background"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">Freepik</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://sweetalert2.github.io/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">SweetAlert2</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://kazzkiq.github.io/balloon.css/"
                                class="no-underline hover:underline text-gray-800 hover:text-teal-500">Baloon.css</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"></script>
    <script>
        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");
        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);  
            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }

        function showdd(el) {
            hidealldd(el);
            let ddm = el.getElementsByClassName("dropdown-menu")[0];
            if (ddm.classList.contains("hidden")) {
                ddm.classList.remove("hidden");
            } else {
                ddm.classList.add("hidden");
            }
        }

        function hidealldd(el = false) {
            el = el==false ? '' : el.getElementsByClassName("dropdown-menu")[0];
            let dd = document.querySelectorAll(".dropdown-menu");
            for(each of dd){
                if(each != el){
                    each.classList.add("hidden");
                }
            }

        }

        function ConfirmDelete(el,title) {
            let form = el.parentNode;
            Swal.fire({
                title: title,
                showDenyButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.isDenied) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Batal',
                        text: 'Aksi Dibatalkan'
                    });
                }
            })
        }

        function removeWishList(params) {
            var request = new XMLHttpRequest();
            request.open('GET', params, true);
            request.onload = function() {
                if (this.status >= 200 && this.status < 400) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Wishlist Berhasil dihapus'
                    });
                    setInterval(() => {
                        location.reload();
                    }, 1000);
                }
            };
            // request.onerror = function() {
            // There was a connection error of some sort
            // };
            request.send();
        }
    </script>
    @include('js/scroll')
    @yield('script')
    @if (session('flash')!==null)
    <script>
        Swal.fire({
            icon: '{{ session('flash')['icon'] }}',
            title: '{{ session('flash')['title'] }}',
            text: '{{ session('flash')['text'] }}'
        });
    </script>
    @endif
</body>

</html>