<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;

class MapelController extends Controller
{
    public function index(Request $request)
    { 
        $data_mapel = Mapel::all();
        return view('mapel/index', compact('data_mapel'));
    }

    public function create (Request $request)
    {
        $this->validate($request,[
            'kode' => 'required|unique:mapel,kode',
            'nama_mapel' => 'required',
            'semester' => 'required'
        ]);

        $siswa = mapel::create($request->all());

        return redirect('/mapel')->with('sukses','Data Berhasil Diinput!');
    }

    public function edit(Mapel $mapel)
    {
        $mapel = Mapel::where("id", $mapel->id)->first();
        return view('mapel/edit', compact('mapel'));
    } 

    public function update(Request $request, $id)
    {
        $mapel = Mapel::where("id",$id);
        $mapel->update($request->all());
        
        return redirect('/mapel')->with('sukses','Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();
        return redirect('/mapel')->with('sukses','Data Berhasil Dihapus!');
    }
}
