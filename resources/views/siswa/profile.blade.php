@extends('layouts.master')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop

@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					@if(session('sukses'))
					<div class="alert alert-success" role="alert">
					{{session('sukses')}}
					</div>
					@endif

					@if(session('gagal'))
					<div class="alert alert-danger" role="alert">
					{{session('gagal')}}
					</div>
					@endif

					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{$siswa->getAvatar()}}" class="img-circle" height ="150" weight ="150" alt="Avatar">
										<h3 class="name">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</h3>
										<span class="online-status status-available">Aktif</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
											{{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Awards</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Data Diri</h4>
										<ul class="list-unstyled list-justify">
											<li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
											<li>Agama <span>{{$siswa->agama}}</span></li>
											<li>Tempat Tinggal <span>{{$siswa->tempat_tinggal}}</span></li>
										</ul>
									</div>
									<div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
							<div class="text-right"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  										Masukkan Nilai
								</button>
								</div>
								<!-- TABBED CONTENT -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Nilai Siswa</h3>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
								</div>
											<tr>
												<th><p style="text-align:center">KODE</th>
												<th><p style="text-align:center">MATA PELAJARAN</th>
												<th><p style="text-align:center">SEMESTER</th>
												<th><p style="text-align:center">NILAI</th>
												<th><p style="text-align:center">AKSI</th>
											</tr>
										</thead>
										<tbody>
											@foreach($siswa->mapel as $mapel)
											<tr>
												<td><p style="text-align:center">{{$mapel->kode}}</td>
												<td><p style="text-align:center">{{$mapel->nama_mapel}}</td>
												<td><p style="text-align:center">{{$mapel->semester}}</td>
												<td><p style="text-align:center">{{$mapel->pivot->nilai}}</td>
												<td>
												<div class="col text-center">
													<a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
												</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="panel">
									<div id="chartNilai">
									
									</div>
								</div>
							</div>
								<!-- END TABBED CONTENT -->
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

<!-- Modal Tambah Nilai -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalLabel">Masukkan Nilai</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         				<span aria-hidden="true">&times;</span>
        				</button>
     				 </div>
     				<div class="modal-body">
        				<div class="panel">
							<form action ="/siswa/{{$siswa->id}}/tambahnilai" method="POST" enctype="multipart/form-data">
                      	{{csrf_field()}}
							<div class="form-group">
								<label for="mapel">Mata Pelajaran</label>
								<select class="form-control" name="mapel" id="exampleFormControlSelect1">
								@foreach($matapelajaran as $mp)
									<option value="{{$mp->id}}">{{$mp->nama_mapel}}</option>
								@endforeach
								</select>
							</div>
                    		<div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                        		<label for="nilai" class="form-label">Nilai</label>
                        		<input type="text" name="nilai" class="form-control" id="nilai" aria-describedby="nilai" placeholder="Masukkan Nilai" value ="{{old('nilai')}}">
                        @if ($errors->has('nilai'))
                            	<span class="help-block">{{$errors->first('nilai')}}</span>
                        @endif
                    		</div>
						</div>	
      						<div class="modal-footer">
       							<button type="submit" class="btn btn-primary">Submit</button>   
							</form>
     	 					</div>
  					</div>					
@stop

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Nilai Siswa'
    },
    xAxis: {
        categories:{!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data: {!!json_encode($nilai)!!}
    }]
});
          
</script>
@stop