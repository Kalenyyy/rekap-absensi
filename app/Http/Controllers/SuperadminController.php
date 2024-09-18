<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rayon;
use App\Models\siswa;
use App\Models\rombel;
use App\Models\guru_ps;
use App\Models\superadmin;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $rayons = rayon::all();
        return view('admin.users.index', compact('rayons'));
    }

    public function indexRayon(Request $request)
    {
        $search = $request->input('search_rayon');

        $rayons = Rayon::query();

        if ($search) {
            $search = strtolower($search);
            $rayons = $rayons->whereRaw('LOWER(name_rombel) LIKE ?', ["%{$search}%"]);
        }

        $rayons = $rayons->orderBy('name_rayon')->get();

        // Kembalikan view dengan data rayon
        return view('admin.data_master.rayon', compact('rayons'));
    }

    public function indexRombel(Request $request)
    {
        $search = $request->input('search_rombel');

        $rombels = rombel::query();

        if ($search) {
            $search = strtolower($search);
            $rombels = $rombels->whereRaw('LOWER(name_rombel) LIKE ?', ["%{$search}%"]);
        }

        $rombels = $rombels->orderBy('name_rombel')->get();

        return view('admin.data_master.rombel', compact('rombels'));
    }


    public function storeRayon(Request $request)
    {
        $request->validate([
            'name_rayon' => 'required'
        ]);

        $rayonStore = [
            'name_rayon' => $request->input('name_rayon'),
        ];
        rayon::create($rayonStore);

        return redirect()->back()->with('successRayon', 'Data Rayon Sudah Ditambah');
    }

    public function getDataRayon($id)
    {
        $rayon = rayon::where('id', $id)->first();
        return response()->json([
            'rayon' => $rayon
        ]);
    }

    public function updateDataRayon(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_rayon' => 'required|string|max:255',
        ]);

        $rayon = Rayon::findOrFail($id);

        $rayon->update([
            'name_rayon' => $request->input('nama_rayon'),
        ]);

        // Set session dengan pesan sukses
        session()->flash('successRayon', 'Data rayon berhasil diperbarui');

        return response()->json([
            'message' => 'Data rayon berhasil diperbarui',
            'rayon' => $rayon
        ]);
    }

    public function deleteDataRayon($id)
    {
        $rayon = Rayon::findOrFail($id);
        $rayon->delete();

        session()->flash('successRayon', 'Data rayon berhasil dihapus');

        return response()->json([
            'message' => 'Rayon berhasil dihapus!'
        ]);
    }

    public function storeDataRombel(Request $request)
    {
        $request->validate([
            'name_rombel' => 'required'
        ]);

        $rombelStore = [
            'name_rombel' => $request->input('name_rombel'),
        ];
        rombel::create($rombelStore);

        return redirect()->back()->with('successRombel', 'Data ROmbel Sudah Ditambah');
    }

    public function getDataRombel($id)
    {
        $rombel = rombel::where('id', $id)->first();
        return response()->json([
            'rombel' => $rombel
        ]);
    }

    public function updateDataRombel(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_rombel' => 'required|string|max:255',
        ]);

        $rombel = rombel::findOrFail($id);

        $rombel->update([
            'name_rombel' => $request->input('name_rombel'),
        ]);

        // Set session dengan pesan sukses
        session()->flash('successRombel', 'Data Rombel berhasil diperbarui');

        return response()->json([
            'message' => 'Data Rombel berhasil diperbarui',
            'rombel' => $rombel
        ]);
    }


    public function storeGuruPS(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[\pL\s]+$/u',
                'not_regex:/<[^>]*>/'
            ],
            'email' => [
                'required',
                'email', 
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
                'not_regex:/<[^>]*>/',
                'unique:users,email'
            ],
            'rayon' => [
                'required',
            ]
        ]);
        

        // Ambil 3 huruf pertama dari username dan email
        $usernamePart = substr($request->input('name'), 0, 3);
        $emailPart = substr($request->input('email'), 0, 3);

        // Gabungkan 3 huruf dari username dan email
        $passwordRaw = $usernamePart . $emailPart;

        // Hash password
        $hashedPassword = Hash::make($passwordRaw);

        // Buat array untuk menyimpan data user
        $userStore = [
            'username' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'guru_ps',
            'password' => $hashedPassword,
            'status' => 'online'
        ];

        $userCreate = User::create($userStore);


        $guru_ps_store = [
            'nama' => $userCreate->username,
            'rayon_id' => $request->input('rayon'),
            'id_user' => $userCreate->id_user,
        ];

        guru_ps::create($guru_ps_store);

        return redirect()->back()->with('success', 'User dan Guru PS berhasil ditambahkan.');
    }

    public function indexRegister() {
    // $response = Http::get('https://be-sidata.smkwikrama.sch.id/student');

    $data_siswas = siswa::all();
    // dd($data_siswas);

    // Mengirim data ke view
    return view('admin.register.index', ['data_siswas' => $data_siswas]);
    }

    public function importSiswa(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully');
    }

    public function RegisterSiswa($id) {
        $siswa = siswa::where('id', $id)->first();
        return view('admin.register.register', ['siswa' => $siswa]);
    }

    public function registerFace(Request $request)
    {
        $response = Http::post('http://localhost:5000/register_face', [
            'name' => $request->input('name'),
            'nis' => $request->input('nis'),
            'rayon' => $request->input('rayon'),
            'rombel' => $request->input('rombel'),
            'image' => $request->input('image')
        ]);

        return redirect()->back()->with('status', $response->json('message'));
    }
}
