<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rayon;
use App\Models\rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $users = User::where('role', '!=', 'Admin')->get();
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

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan.');
    }



    public function getDataGuru($id)
    {
        $guru_kejuruan = user::where('id_user', $id)->first();
        return response()->json([
            'guru_kejuruan' => $guru_kejuruan
        ]);
    }

    public function updateGuru(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|min:6', // Password opsional
        ]);

        $guru = User::findOrFail($id);
        $guru->username = $validatedData['name'];
        $guru->email = $validatedData['email'];
        $guru->role = $validatedData['role'];
        $guru->status = $validatedData['status'];

        if (!empty($validatedData['password'])) {
            $guru->password = Hash::make($validatedData['password']);
        }

        $guru->save();

        return response()->json(['message' => 'Data guru berhasil diperbarui']);
    }
}
