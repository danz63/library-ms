@extends('template/template')
@section('title','Users | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0">
        <!--Main Col-->
        <div id="profile"
            class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0">
            <div class="p-4 md:p-12 text-center lg:text-left">
                <!-- Image for mobile view-->
                <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center"
                    style="background-image: url('{{ asset('img/upload/'.$user->image) }}')">
                </div>
                <h1 class="text-3xl font-bold pt-8 lg:pt-0 text-gray-800">{{ $user->name }}</h1>
                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
                <p class="mt-4 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800"
                    aria-label="Username" data-balloon-pos="up-left">
                    <i class="fas fa-id-card h-4 fill-current  pr-4"></i>
                    {{ $user->username }}
                </p>
                <p class="mt-2 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800"
                    aria-label="Alamat" data-balloon-pos="up-left">
                    <i class="fas fa-search-location h-4 fill-current  pr-4"></i>
                    {{ $user->address }}
                </p>
                <p class="mt-2 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800"
                    aria-label="Level" data-balloon-pos="up-left">
                    <i class="fas fa-layer-group h-4 fill-current  pr-4"></i>
                    {{ $user->level }}
                </p>
                <p class="mt-2 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800"
                    aria-label="Tanggal Dibuat" data-balloon-pos="up-left">
                    <i class="fas fa-calendar-alt h-4 fill-current  pr-4"></i>
                    {{ gmdate('H:i A. F j, Y', strtotime($user->created_at)) }}
                </p>
                <p class="mt-2 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800"
                    aria-label="Tanggal Diubah" data-balloon-pos="up-left">
                    <i class="fas fa-calendar-alt h-4 fill-current pr-4"></i>
                    @if ($user->updated_at)
                    {{ gmdate('H:i A. F j, Y', strtotime($user->updated_at)) }}
                    @else
                    Belum pernah diubah
                    @endif
                </p>
                <p class="mt-2 text-base font-bold flex items-center justify-start lg:justify-start text-gray-800">
                    <i class="fas fa-phone h-4 fill-current pr-4"></i>
                    Nomor Telepon
                    <ul class="ml-6 pl-1 list-none text-left text-gray-800 font-bold">
                        @if (count($phones) > 0)
                        @foreach ($phones as $phone)
                        <li class="my-2">
                            {{ substr_replace(substr_replace(substr_replace($phone->number,'-',4,0),'-',-4,0),'+62 ',0,1) }}
                            <form action="{{ url('phone/destroy/') }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $phone->id }}">
                                <button type="button" class="ml-5 focus:outline-none" aria-label="Hapus"
                                    data-balloon-pos="right" onclick="ConfirmDelete(this);">
                                    <i class="far fa-trash-alt fa-sm"></i>
                                </button>
                            </form>
                        </li>
                        @endforeach
                        @else
                        <li class="my-2 text-gray-500">&nbsp;Nomor Tidak ditemukan</li>
                        @endif
                        <li>
                            <button class="font-bold hover:underline hover:opacity-75" id="btn_add">
                                <i class="fas fa-plus fa-sm h-4 fill-current pr-2 pt-4"></i>Tambah Nomor
                            </button>
                        </li>
                    </ul>
                </p>
                <div class="mt-6 pb-8">
                    <a href="{{ url('users/edit/'.$user->id) }}"
                        class="gradient text-white font-bold py-2 px-4 rounded-full hover:underline hover:opacity-75">
                        Edit Profil
                    </a>
                </div>
            </div>
        </div>
        <!--Img Col-->
        <div class="w-full lg:w-2/5">
            <img src="{{ asset('img/upload/'.$user->image) }}"
                class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
        </div>
        <!-- Pin to top right corner -->
        <div class="absolute top-0 right-0 h-12 w-18 p-4">
            <button class="js-change-theme focus:outline-none">🌙</button>
        </div>

    </div>
</section>
<!--Modal-->
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-start z-40">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div
            class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6 text-gray-800">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Tambah Nomor</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-gray-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <form method="post" id="MyForm" onsubmit="document.getElementById('submit').click(); return false;">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2 uppercase text-gray-700" for="phone_number">
                        Nomor Telepon
                    </label>
                    <input
                        class="shadow appearance-none border 
                        border-blue-500 focus:outline-none focus:shadow-outline rounded w-full py-2 px-3 text-gray-700 leading-tight  transition duration-300"
                        id="phone_number" name="phone_number" type="text" placeholder="Phone Number" autocomplete="off">
                    <p class="text-red-800 text-xs italic">
                        @error('phone_number')
                        {{ $message }}
                        @enderror
                        Hanya Menerima Nomor (0-9) dan Spasi
                    </p>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button type="button" id="submit"
                        class="px-2 p-1 bg-blue-500 hover:bg-blue-400 text-gray-100 font-bold mr-2 rounded"
                        onclick="addNumber();">Submit</button>
                    <button type="button"
                        class="modal-close px-2 bg-red-500 hover:bg-red-400 text-gray-100 font-bold rounded">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function ConfirmDelete(el) {
        Swal.fire({
            title: 'Yakin ingin menghapus nomor ini?',
            showDenyButton: true,
            confirmButtonText: `Ya`,
            denyButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                let data = {
                    form : el.parentNode,
                    _token : el.parentNode.querySelector("[name=_token]").value,
                    params : "id=" + el.parentNode.querySelector("[name=id]").value + "&_method=" + el.parentNode.querySelector("[name=_method]").value,
                    withModal : false,
                    url : el.parentNode.action
                };
                ajax_post(data);
            } else if (result.isDenied) {
                Swal.fire({
                    icon: 'success',
                    title: 'Canceled',
                    text: 'Aksi Dibatalkan'
                });
            }
        })
    }
    function addNumber() {
        let data = {
            form : document.getElementById("MyForm"),
            _token : document.getElementById("MyForm").querySelector("[name=_token]").value,
            params : "number=" + document.getElementById("MyForm").querySelector("[name=phone_number]").value,
            withModal : true,
            url : '{{ route('post_number') }}'
        };
        ajax_post(data);
    }

    function ajax_post(data){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if(data.withModal==true){
                    toggleModal()
                }
                location.reload();
            }
        };
        xhttp.open("POST", data.url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-TOKEN", data._token);
        xhttp.send(data.params);
    }
    document.getElementById("btn_add").addEventListener('click', function () {
        document.getElementById("phone_number").focus();
        event.preventDefault();
        toggleModal();
    });
</script>
@include('js/modal')
@include('js/scroll')
@endsection