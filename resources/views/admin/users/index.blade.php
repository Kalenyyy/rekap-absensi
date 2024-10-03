@extends('layouts.template_fix')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clipRule="evenodd"></path>
            </svg>
            <a href="{{ route('admin.user.index') }}"
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Users</a>
        </div>
    </li>
@endsection

@section('modal')
    <div id="edit-guru-modal" tabindex="1" aria-hidden="true" data-modal-backdrop="false"
        class="fixed inset-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 h-screen transition-opacity duration-300 ease-out">
        <div class="relative w-full max-w-2xl max-h-full transform transition-transform duration-300 ease-in-out">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="edit-guru-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name_guru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Guru</label>
                            <input type="text" name="name" id="name_guru"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Bonnie" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email_guru"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email_guru"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="example@company.com" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="role_guru"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="role_guru" name="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Laboran</option>
                                <option>Guru</option>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="status_guru"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Status</label>
                            <select id="status" name="status_guru"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Online</option>
                                <option>Offline</option>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="password_guru"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="password" name="password" id="password_guru"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="••••••••" required="">
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                    <button type="button"
                        class="text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-hide="edit-guru-modal">Cancel</button>
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>






    {{-- Modal Create Guru --}}
    <div id="guru-ps-modal" tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Data Guru
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="guru-ps-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('admin.user.store-guru') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <div class="col-span-full">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type name user" required="">
                        </div>
                        <div class="col-span-full sm:col-span-1">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="test@gmail.com" required="">
                        </div>
                        <div class="col-span-full sm:col-span-1">
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                name="role">
                                <option hidden selected>Pilih Role</option>
                                <option value="Laboran">Laboran</option>
                                <option value="Guru">Guru</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new user
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div id="default-tab-content" class="w-full">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="guru-ps-tab" data-tabs-target="#guru-ps"
                        type="button" role="tab" aria-controls="guru-ps" aria-selected="false">Guru &
                        Laboran</button>
                </li>
                {{-- <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="guru-rayon-tab" data-tabs-target="#guru-rayon" type="button" role="tab"
                        aria-controls="guru-rayon" aria-selected="false">Guru Rayon</button>
                </li> --}}
            </ul>
        </div>

        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-full" id="guru-ps" role="tabpanel"
                aria-labelledby="guru-ps-tab">

                <div class="relative overflow-x-auto shadow-sm sm:rounded-lg w-full">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div
                            class="flex items-center flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
                            <form id="search-form" action="#" class="mr-2">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative flex">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search-users"
                                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for users">
                                    <button type="submit"
                                        class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </form>
                            <button type="button" data-modal-target="guru-ps-modal" data-modal-toggle="guru-ps-modal"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mx-5">Tambah
                                Data Guru <i class="fa-solid fa-arrow-right fa-xl" style="color: #ffffff;"></i></button>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Position
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $usr)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            1
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $usr->nama }}</div>
                                                <div class="font-normal text-gray-500">{{ $usr->user->email }}</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $usr->user->role }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if ($usr->user->status === 'Offline')
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                @else
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                @endif
                                                {{ $usr->user->status }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <a type="button" data-modal-target="edit-guru-modal"
                                                data-modal-toggle="edit-guru-modal" id="{{ $usr->id_user }}"
                                                class="edit-guru font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit
                                                user</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.edit-guru');
            const modal = document.getElementById('edit-guru-modal');
            const nameGuru = document.getElementById('name_guru');
            const email = document.getElementById('email_guru');
            const role = document.getElementById('role_guru');
            const status = document.getElementById('status_guru');
            const password = document.getElementById('password_guru');
            // const rombelForm = document.getElementById('rombelForm');

            buttons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default action
                    const userId = this.getAttribute('id');

                    // Update form action with candidateId
                    // rombelForm.action =
                    //     `http://127.0.0.1:8000/data-master/update-rombel/${rombelId}`;

                    $.ajax({
                        url: `http://127.0.0.1:8000/users/edit-guru/${userId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            nameGuru.value = response.guru_kejuruan.username;
                            email.value = response.guru_kejuruan.email;
                            role.value = response.guru_kejuruan.role;
                        },
                        error: function(error) {
                            console.log(error.responseText);
                            alert("Error: " + error.responseText);
                        }
                    });

                    // Show the modal
                    modal.classList.remove('hidden');
                });
            });

            // rombelForm.addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     $.ajax({
            //         url: $(this).attr('action'),
            //         method: 'POST',
            //         data: $(this).serialize(), // Serialize form data
            //         success: function(response) {
            //             // Lakukan redirect ke halaman yang sama untuk memuat session
            //             window.location.href = window.location.href;
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // });
        });
    </script>
@endsection
