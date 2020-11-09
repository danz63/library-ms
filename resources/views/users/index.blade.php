@extends('template/template')
@section('title','Users | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div class="container max-w-full mx-auto m-8">
        <div class="w-full md:w-full mx-auto sm:items-center text-center md:text-left border p-5 rounded bg-gray-100">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Pengguna</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="d-block">
                <div class="d-block text-right my-5 mx-3">
                    <a href="{{ url('/users/create') }}"
                        class="text-base text-gray-200 bg-blue-700 hover:bg-blue-500 hover:text-gray-100 px-2 py-1 rounded"><i
                            class="fas fa-plus fa-sm mr-1"></i> Tambah
                        Pengguna</a>
                </div>
                <table class="border-collapse w-full" id="Table">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1">
                                #</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1/6">
                                Nama Lengkap</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1/6">
                                Username</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-2/6">
                                Alamat</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-1/12">
                                level</th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell w-64">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $usr)
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
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nama
                                    Lengkap</span>
                                {{ $usr->name }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Username</span>
                                {{ $usr->username }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Alamat</span>
                                {{ $usr->address }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Level</span>
                                {{ $usr->level }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                                <button value="{{ $usr->id }}"
                                    class="modal-open bg-teal-700 text-gray-200 hover:bg-teal-500 px-2 py-1 text-sm rounded mx-1"
                                    onclick="modalOpen(this)">
                                    <i class="fas fa-sm fa-info-circle mr-1"></i>Detail
                                </button>
                                @if ($usr->username !== 'root' && $usr->username !== 'member')
                                <div class="inline">
                                    <button onclick="window.location='{{ url('users/edit/'.$usr->id) }}';"
                                        class="bg-green-700 text-gray-200 hover:bg-green-500 px-2 py-1 text-sm rounded mx-1">
                                        <i class="fas fa-sm fa-edit mr-1"></i>Edit
                                    </button>
                                </div>
                                <form action="{{ url('users/destroy/') }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $usr->id }}">
                                    <button onclick="ConfirmDelete(this);" type="button"
                                        class="bg-red-700 text-gray-200 hover:bg-red-500 px-2 py-1 text-sm rounded mx-1">
                                        <i class="fas fa-sm fa-eraser mr-1"></i>Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center text-gray-800 z-40"
    style="max-height: 100vh;">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-4xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div
            class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Detail User</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="grid grid-cols-2 gap-2" style="min-height: 32rem;">
                <div style="max-height: 64rem;">
                    <img src="" alt="User's Photo'" class="object-cover w-full mx-auto rounded-lg shadow-md" id="image"
                        style="height: 32rem;">
                </div>
                <div class="max-h-full h-full sm:pt-16 md:pt-32 pt-16">
                    <p id="fullname"></p>
                    <hr class="my-2 mr-3">
                    <p id="address"></p>
                    <hr class="my-2 mr-3">
                    <p id="username"></p>
                    <hr class="my-2 mr-3">
                    <p id="access"></p>
                    <hr class="my-2 mr-3">
                    <p id="created_at"></p>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button class="modal-close px-4 bg-teal-700 hover:bg-teal-500 p-3 rounded-lg text-white">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
@include('js/modal')
@include('js/datatable')
@include('js/scroll')
<script>
    function modalOpen(el) {
        event.preventDefault();
        getJson(el);
        toggleModal();
    }
</script>
<script>
    function ConfirmDelete(el) {
        let form = el.parentNode;
        Swal.fire({
            title: 'Do you want to delete this User?',
            showDenyButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                Swal.fire({
                    icon: 'success',
                    title: 'Canceled',
                    text: 'Action Canceled'
                });
            }
        })
    }

    function responseParse(data) {
        document.getElementById("fullname").innerHTML = ret('Full Name',data.name);
        document.getElementById("image").src = "{{asset('img/upload')}}/" + data.image;
        document.getElementById("username").innerHTML = ret('Username', data.username);
        document.getElementById("access").innerHTML = ret('Level', data.level);
        document.getElementById("created_at").innerHTML = ret('Dibuat Pada', data.created_at);
        document.getElementById("address").innerHTML = ret('Address', data.address);
    }

    function ret(uname, str) {
        return `
        <span class='font-bold'>` + uname + ` : </span>
        <span class='font-semibold'>` + str + `</span>
        `;
    }

    function getJson(el) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', "{{ url('users/show/') }}/" + el.value, true);
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                var data = JSON.parse(this.response);
                responseParse(data);
            } else {
                // We reached our target server, but it returned an error
                console.log("Error Response, Not Return JSON");
            }
        };
        xhr.onerror = function () {
            console.log("Error Server");
        };
        xhr.send();
    }

</script>
@endsection