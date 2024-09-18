<?php

namespace App\Imports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Siswa::updateOrCreate(
            ['nis' => $row['nis']], // Menggunakan header 'nis' sebagai kunci
            [
                'name' => $row['name'],  // Menggunakan header 'name' sebagai kunci
                'rayon' => $row['rayon'], // Menggunakan header 'rayon' sebagai kunci
                'rombel' => $row['rombel'], // Menggunakan header 'rombel' sebagai kunci
            ]
        );
    }
}
