@section('modal')
    
@endsection



@foreach ($rayons as $rayon)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">#</td>
        <th scope="row"
            class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="ps-3">
                <div class="text-base">{{ $rayon->name_rayon }}</div>
            </div>
        </th>
        <td class="px-6 py-4">
            <!-- Modal toggle -->
            <a type="button" id="{{ $rayon->id }}" data-modal-target="edit-rayon-modal"
                data-modal-toggle="edit-rayon-modal"
                class="edit-rayon font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit
                | </a>
            <a type="button" id="{{ $rayon->id }}" data-modal-target="delete-rayon-modal"
                data-modal-toggle="delete-rayon-modal"
                class="delete-rayon font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Delete</a>
        </td>
    </tr>
@endforeach
