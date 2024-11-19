@foreach ($data_siswas as $student)
    @php
        $isRegistered = \App\Models\StudentRegister::where('nis', $student['nis'])->exists();
    @endphp
    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 even:bg-gray-50 even:dark:bg-gray-800">
        <td class="px-6 py-4">{{ ($data_siswas->currentPage() - 1) * $data_siswas->perPage() + $loop->iteration }}</td>
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
            {{ $student['name'] }}</th>
        <td class="px-6 py-4">{{ $student['nis'] }}</td>
        <td class="px-6 py-4">{{ $student['rayon'] }}</td>
        <td class="px-6 py-4">{{ $student['rombel'] }}</td>
        
    </tr>
@endforeach
