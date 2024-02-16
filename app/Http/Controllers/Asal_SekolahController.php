<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Asal_Sekolah;


class Asal_SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolahs = Asal_Sekolah::orderBy('nama_sekolah', 'asc')->paginate(8);
        return view ('asal_sekolah.index', compact('sekolahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('asal_sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_sekolah'=>'required',
            'alamat_sekolah'=>'required'

        ]);

        // $image = $request->file('image');
        // $name = time().'.'.$image->getClientOriginalExtension();
        // $destinationPath = public_path('/image');
        // $image->move($destinationPath, $name);

        Asal_Sekolah::create([
            'nama_sekolah'=>$request->get('nama_sekolah'),
            'alamat_sekolah'=>$request->get('alamat_sekolah'),

        ]);

        return redirect()->back()->with('message', 'Sekolah berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sekolahs = Asal_Sekolah::find($id);
        return view('asal_sekolah.edit', compact('sekolahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama_sekolah'=>'required',
            'alamat_sekolah'=>'required',

        ]);

        $sekolahs = Asal_Sekolah::find($id);
        // $name = $sekolah->image;
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/image');
        //     $image->move($destinationPath,$name);
        // }

        $sekolahs->nama_sekolah = $request->get('nama_sekolah');
        $sekolahs->alamat_sekolah = $request->get('alamat_sekolah');
        // $sekolah->image = $name;
        $sekolahs->save();

        return redirect()->route('asal_sekolah.index')->with('message','Informasi Sekolah berhasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sekolahs = Asal_Sekolah::find($id);
        $sekolahs->delete();
        return redirect()->route('asal_sekolah.index')->with('message', 'Sekolah Berhasil Dihapus');
    }
}
