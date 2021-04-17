@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Edit Data Mata Pelajaran</h3>
						</div>
								<div class="panel-body">
                    <form action ="/mapel/{{$mapel->id}}/update" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" id="kode" aria-describedby="kode" placeholder="Masukkan Kode" value="{{$mapel->kode}}">
                        </div>
                        <div class="form-group">
                            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                            <input type="text" name="nama_mapel" class="form-control" id="nama_mapel" aria-describedby="nama_mapel" placeholder="Masukkan Mata Pelajaran" value="{{$mapel->nama_mapel}}">
                        </div>
                        <div class="form-group">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control" id="semester" aria-describedby="semester" placeholder="Masukkan Semester" value="{{$mapel->semester}}">
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


