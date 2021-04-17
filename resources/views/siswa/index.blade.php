@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses'))
				<div class="alert alert-success" role="alert">
				{{session('sukses')}}
					</div>
				@endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><b>DATA SISWA</b></h3>
                            <!-- Button trigger modal -->
						</div>
						<div class="panel-body">
							<table class="table table-dark">
							<thead>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-plus-square"></i>
                                </button>
								<tr>
                                <th><p style="text-align:center">DETAIL</th>
                                <th><p style="text-align:center">NAMA DEPAN</th>
                                <th><p style="text-align:center">NAMA BELAKANG</th>
                                <th><p style="text-align:center">JENIS KELAMIN</th>
                                <th><p style="text-align:center">AGAMA</th>
                                <th><p style="text-align:center">TEMPAT TINGGAL</th>
                                <th><p style="text-align:center">AKSI</th>
						        </tr>
							</thead>
								<tbody> 
                                    @foreach($data_siswa as $siswa)
                            		<tr>
                                        <td>
                                        <div class="col text-center">
                                            <a href="/siswa/{{$siswa->id}}/profile" class="btn btn-warning btn-sm center">Detail</a>
                                        </div>
                                        </td>
										<td><p style="text-align:center">{{$siswa->nama_depan}}</td>
                                        <td><p style="text-align:center">{{$siswa->nama_belakang}}</td>
                                        <td><p style="text-align:center">{{$siswa->jenis_kelamin}}</td>
                                        <td><p style="text-align:center">{{$siswa->agama}}</td>
                                        <td><p style="text-align:center">{{$siswa->tempat_tinggal}}</td>
                                        <td>
                                        <div class="col text-center">
                                        <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('hapus ga?')">Delete</a>
                                        </div>
                                        </td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
                            <div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form action ="/siswa/create" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                        <label for="nama_depan" class="form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" id="nama_depan" aria-describedby="nama_depan" placeholder="Masukkan Nama Depan" value ="{{old('nama_depan')}}">
                        @if ($errors->has('nama_depan'))
                            <span class="help-block">{{$errors->first('nama_depan')}}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="nama_belakang" class="form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" aria-describedby="nama_belakang" placeholder="Masukkan Nama Belakang" value ="{{old('nama_belakang')}}">
                    </div>
                    <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                        <option>Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                        </select>
                        @if ($errors->has('jenis_kelamin'))
                            <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control" id="agama" aria-describedby="agama" placeholder="Masukkan Agama"  value ="{{old('agama')}}">
                        @if ($errors->has('agama'))
                            <span class="help-block">{{$errors->first('agama')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('tempat_tinggal') ? 'has-error' : ''}}">
                        <label for="tempat_tinggal">Tempat Tinggal</label>
                        <textarea name="tempat_tinggal" class="form-control" id="tempat_tinggal" rows="3" placeholder="Masukkan Tempat Tinggal"  value ="{{old('tempat_tinggal')}}"></textarea>
                        @if ($errors->has('tempat_tinggal'))
                            <span class="help-block">{{$errors->first('tempat_tinggal')}}</span>
                        @endif
                    </div>
                    <div class="form-group  ">
                            <label for="foto_profil">Foto Profil</label>
                            <input type="file" name="avatar" class="form-control"  value ="{{old('avatar')}}">
                        @if ($errors->has('tempat_tinggal'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
      </div>
    </div>
  </div>
</div>
@endsection
