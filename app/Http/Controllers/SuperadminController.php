<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\rombel;
use App\Models\superadmin;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
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
}
