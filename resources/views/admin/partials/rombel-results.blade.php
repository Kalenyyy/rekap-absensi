@foreach ($rombels as $rombel)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">#</td>
        <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="ps-3">
                <div class="text-base">{{ $rombel->name_rombel }}</div>
            </div>
        </th>
        <td class="px-6 py-4">
            <!-- Modal toggle -->
            <a type="button" id="{{ $rombel->id }}" data-modal-target="edit-rombel-modal"
                data-modal-toggle="edit-rombel-modal" class="edit-rombel font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit
                | </a>
            <a type="button" id="{{ $rombel->id }}" data-modal-target="delete-rombel-modal"
                data-modal-toggle="delete-rombel-modal" class="delete-rombel font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Delete</a>
        </td>
    </tr>
@endforeach
