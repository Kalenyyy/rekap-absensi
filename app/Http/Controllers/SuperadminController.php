<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rayon;
use App\Models\siswa;
use App\Models\rombel;
use App\Models\absensi;
use Illuminate\Support\Str;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Models\guru_kejuruan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $users = guru_kejuruan::with('user')->get();
        return view('admin.users.index', compact('users'));
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

        return redirect()->back()->with('successRombel', 'Data Rombel Sudah Ditambah');
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


    public function storeDataGuru(Request $request)
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
            'role' => $request->input('role'),
            'password' => $hashedPassword,
            'status' => 'Online'
        ];

        $userCreate = User::create($userStore);


        $guru_ps_store = [
            'nama' => $userCreate->username,
            'id_user' => $userCreate->id_user,
        ];

        guru_kejuruan::create($guru_ps_store);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function getDataGuru($id)
    {
        $guru_kejuruan = user::where('id_user', $id)->first();
        return response()->json([
            'guru_kejuruan' => $guru_kejuruan
        ]);
    }

    public function indexRegister(Request $request)
    {
        // $response = Http::get('https://be-sidata.smkwikrama.sch.id/student');

        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Query dasar
        $query = siswa::query();

        // Jika ada pencarian nama
        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        // Jika ada filter rombel
        if ($rombel && $rombel !== '') {
            $query->where('rombel', $rombel);
        }

        // Mengurutkan data berdasarkan rombel dan kemudian nama
        $query->orderBy('rombel', 'asc')->orderBy('name', 'asc');

        $data_siswas = $query->paginate(8);

        $rombels = rombel::all();
        return view('admin.absen.index', ['data_siswas' => $data_siswas, 'rombels' => $rombels]);
    }



    public function importSiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully');
    }

    public function RegisterSiswa($id)
    {
        $siswa = siswa::where('id', $id)->first();
        return view('admin.absen.register', ['siswa' => $siswa]);
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

        return redirect()->route('admin.register.index')->with('status', $response->json('message'));
    }

    public function indexAbsen()
    {
        return view('admin.absen.absensi');
    }

    public function recognizeFace(Request $request)
    {
        // Mengirim request ke Flask
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:5000/recognize_face', [
            'json' => ['image' => $request->image]
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }

    public function absenSiswa(Request $request)
    {

        // Decode the base64 image
        $imageData = $request->input('image');
        $image = base64_decode($imageData);

        // Generate a unique name for the image file
        $imageName = Str::random(10) . '.jpg';

        // Store the image in the public directory (storage/app/public)
        Storage::disk('public')->put('absensi/' . $imageName, $image);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->input('nis'))->first();

        // Jika siswa ditemukan
        if ($siswa) {
            // Cek apakah sudah absen hari ini
            $today = now()->format('Y-m-d');
            $absenHariIni = Absensi::where('id_siswa', $siswa->id)
                ->whereDate('tanggal', $today)
                ->exists();

            // Jika sudah absen hari ini, kembalikan dengan pesan error
            if ($absenHariIni) {
                return redirect()->back()->with('error', 'Siswa sudah melakukan absensi hari ini.');
            }

            // Jika belum absen, buat data absensi
            absensi::create([
                'name' => $request->input('name'),
                'id_siswa' => $siswa->id,
                'tanggal' => now(),
                'status' => 'Hadir',
                'foto_siswa' => $imageName, // Simpan nama file gambar
            ]);

            return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Siswa dengan NIS tersebut tidak ditemukan.');
        }
    }
}
