<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
// use App\Models\Food;
use Illuminate\Http\Request;



class PenempatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penempatans = Penempatan::orderBy('name', 'asc')->get();
        return view('penempatan.index', compact('penempatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penempatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:3'
        ]);

        Penempatan::create([
            'name'=>$request->get('name')
        ]);
        return redirect()->back()->with('message','Penempatan Gedung berhasil dibuat');
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
        $penempatan = Penempatan::find($id);
        return view ('penempatan.edit', compact('penempatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'=>'required|min:3'
        ]);

        $penempatan = Penempatan::find($id);
        $penempatan->name = $request->get('name');
        $penempatan->save();
        return redirect()->route('penempatan.index')->with('message','Penempatan behasil diupdate');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penempatan = Penempatan::find($id);
        $penempatan->delete();
        return redirect()->route('penempatan.index')->with('message', 'Penempatan berhasil dihapus');
    }
    // {

    // $category = Category::find($id);
    // if (!$category) {
    //     return redirect()->route('category.index')->with('message', 'Kategori tidak ditemukan');
    // }

    // $category->delete();
    // return redirect()->route('category.index')->with('message', 'Kategori berhasil dihapus');
    // }


}
