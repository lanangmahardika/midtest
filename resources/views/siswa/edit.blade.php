@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Edit Data Siswa</h3>
						</div>
								<div class="panel-body">
                    <form action ="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" id="nama_depan" aria-describedby="nama_depan" placeholder="Masukkan Nama Depan" value="{{$siswa->nama_depan}}">
                        </div>
                        <div class="form-group">
                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" aria-describedby="nama_belakang" placeholder="Masukkan Nama Belakang" value="{{$siswa->nama_belakang}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="Pria" @if($siswa->jenis_kelamin == 'Pria') selected @endif>Pria</option>
                            <option value="Wanita" @if($siswa->jenis_kelamin == 'Wanita') selected @endif>Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" name="agama" class="form-control" id="agama" aria-describedby="agama" placeholder="Masukkan Agama" value="{{$siswa->agama}}">
                        </div>
                        <div class="form-group">
                            <label for="tempat_tinggal">Tempat Tinggal</label>
                            <textarea name="tempat_tinggal" class="form-control" id="tempat_tinggal" rows="3" placeholder="Masukkan Tempat Tinggal">{{$siswa->tempat_tinggal}}</textarea>
                        </div>
                        <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}" >
                            <label for="foto_profil">Foto Profil</label>
                            <input type="file" name="avatar" class="form-control">
                        @if ($errors->has('tempat_tinggal'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                        @endif
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            </form>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


