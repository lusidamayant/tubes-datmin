@extends('Layouts.template') @section('content')

<div class="pagetitle">
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Siswa</li>
        <li class="breadcrumb-item"><a href="{{ route('Admin') }}"></a>Data Siswa</li>
        <li class="breadcrumb-item active">Detail Data Siswa</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">

    <div class="card">
      <div class="card-body"><br>
        <form class="row g-3" action="{{ route('insertbarang') }}" method="POST">
        @csrf
        <div class="col-12">
        <label for="id_student" class="form-label">Id Siswa</label>
        <input type="text" class="form-control" id="id_student" name="id_student">
          </div>
          <div class="col-12">
          <label for="nama" class="form-label">Nama Siswa</label>
          <input type="text" class="form-control" id="nama" name="nama">
          </div>
          <div class="col-12">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat">
          </div>
          <div class="col-12">
          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
          </div>
          <div class="col-12">
          <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
          <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
          </div>
          <div class="col-12">
          <label for="pekerjaan_orang_tua" class="form-label">Pekerjaan Orang Tua</label>
        <input type="text" class="form-control" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua">
          </div>
          <div class="col-12">
          <label for="pendapatan_orang_tua" class="form-label">Pendapatan Orang Tua</label>
          <input type="text" class="form-control" id="pendapatan_orang_tua" name="pendapatan_orang_tua">
          </div>
          <div class="col-12">
          <label for="jumlah_tanggungan_orang_tua" class="form-label">Jumlah Tanggungan Orang Tua</label>
          <input type="text" class="form-control" id="jumlah_tanggungan_orang_tua" name="jumlah_tanggungan_orang_tua">
          </div>


        </form>
      </div>
    </div>
@endsection