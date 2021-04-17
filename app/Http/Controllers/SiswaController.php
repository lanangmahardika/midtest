<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function profile($id)
    {
        $siswa = \App\Siswa::find($id);
        $matapelajaran = \App\Mapel::all();

        //data chart
        $categories = [];
        $nilai =[];

        foreach ($matapelajaran as $mp){
        if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
            $categories[] = $mp->nama_mapel;
            $nilai[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }  
        return view('siswa/profile',['siswa'=>$siswa, 'matapelajaran'=>$matapelajaran, 'categories'=>$categories, 'nilai'=>$nilai]);
    }

    public function index(Request $request)
    { 
        $data_siswa = \App\Siswa::orderBy('id','desc')->get();
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create (Request $request)
    {
        $this->validate($request,[
            'nama_depan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_tinggal' => 'required',
            'avatar' => 'mimes:jpg,png'
        ]);
        $siswa = \App\Siswa::create($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data Berhasil Diinput!'); 
    }

    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa/edit',['siswa'=> $siswa]);
    } 

    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'avatar' => 'mimes:jpg,png']);

        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('siswa/'.$id.'/profile')->with('sukses','Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses','Data Berhasil Dihapus!');
    }

    public function tambahnilai (Request $request,$idsiswa)
    {
        $siswa = \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('gagal','Mata Pelajaran Tersebut Sudah Ada');  
        }
        $siswa->mapel()->attach($request->mapel,['nilai'=>$request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Nilai Berhasil Dimasukkan');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Data Nilai Berhasil Dihapus!');
    }

}
