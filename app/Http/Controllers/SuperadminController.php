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

    public function indexDataMaster(Request $request)
    {
        $search = $request->input('search_rayon');

        $rayons = Rayon::query()
            ->when($search, function ($query, $search) {
                return $query->where('name_rayon', 'like', '%' . $search . '%');
            })
            ->get();

        $rombels = rombel::all();

        return view('admin.data_master.index', compact('rayons', 'rombels'));
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

        return redirect()->back()->with('success', 'Data Rayon Sudah Ditambah');
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
        session()->flash('success', 'Data rayon berhasil diperbarui');

        return response()->json([
            'message' => 'Data rayon berhasil diperbarui',
            'rayon' => $rayon
        ]);
    }

    public function deleteDataRayon($id)
    {
        $rayon = Rayon::findOrFail($id);
        $rayon->delete();

        session()->flash('success', 'Data rayon berhasil dihapus');

        return response()->json([
            'message' => 'Rayon berhasil dihapus!'
        ]);
    }
}
