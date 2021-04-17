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
                                <th><p style="text-align:center">KODE</th>
                                <th><p style="text-align:center">MATA PELAJARAN</th>
                                <th><p style="text-align:center">SEMESTER</th>
                                <th><p style="text-align:center">AKSI</th>
						        </tr>
							</thead>
								<tbody> 
                                    @foreach($data_mapel as $mapel)
                            		<tr>
										<td><p style="text-align:center">{{$mapel->kode}}</td>
                                        <td><p style="text-align:center">{{$mapel->nama_mapel}}</td>
                                        <td><p style="text-align:center">{{$mapel->semester}}</td>
                                        <td>
                                        <div class="col text-center">
                                        <a href="/mapel/{{$mapel->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                                        <a href="/mapel/{{$mapel->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('hapus ga ?')">Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form action ="/mapel/create" method="POST">
                        {{csrf_field()}}
                    <div class="form-group {{$errors->has('kode') ? 'has-error' : ''}}">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control" id="kode" aria-describedby="kode" placeholder="Masukkan Kode" value ="{{old('kode')}}">
                        @if ($errors->has('kode'))
                            <span class="help-block">{{$errors->first('kode')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('nama_mapel') ? 'has-error' : ''}} ">
                        <label for="nama_mapel" class="form-label"> Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mapel" class="form-control" id="nama_mapel" aria-describedby="nama_mapel" placeholder="Masukkan Nama Mata Pelajaran" value ="{{old('nama_mapel')}}">
                        @if ($errors->has('nama_mapel'))
                            <span class="help-block">{{$errors->first('nama_mapel')}}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" name="semester" class="form-control" id="semester" aria-describedby="semester" placeholder="Masukkan Semester" value ="{{old('semester')}}">
                        @if ($errors->has('semester'))
                            <span class="help-block">{{$errors->first('semester')}}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
      </div>
    </div>
  </div>
</div>
@endsection
