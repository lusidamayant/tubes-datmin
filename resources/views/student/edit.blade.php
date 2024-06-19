@extends('layouts.app')
@section('content')

<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Siswa</a></li>
      <li class="breadcrumb-item active">Edit Data Siswa</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
  <div class="card-body">
    <form action="{{ route('student.update', $student->id_student) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="id_student" class="form-label">Id Siswa</label>
        <input type="text" class="form-control" id="id_student" name="id_student">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Siswa</label>
        <input type="text" class="form-control" id="nama" name="nama">
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat">
      </div>
      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
      </div>
      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
      <div class="mb-3">
        <label for="pekerjaan_orang_tua" class="form-label">Pekerjaan Orang Tua</label>
        <input type="text" class="form-control" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua">
      </div>
      <div class="mb-3">
        <label for="pendapatan_orang_tua" class="form-label">Pendapatan Orang Tua</label>
        <input type="text" class="form-control" id="pendapatan_orang_tua" name="pendapatan_orang_tua">
      </div>
      <div class="mb-3">
        <label for="jumlah_tanggungan_orang_tua" class="form-label">Jumlah Tanggungan Orang Tua</label>
        <input type="text" class="form-control" id="jumlah_tanggungan_orang_tua" name="jumlah_tanggungan_orang_tua">
      </div>
     
      <div class="mb-3 text-right">
        <a href="{{ route('student.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection