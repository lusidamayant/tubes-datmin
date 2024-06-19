@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Siswa</a></li>
            <li class="breadcrumb-item active"> List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
{{-- Alert Success Add --}}
@if (session()->has('primary'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    {{ session('primary') }}
</div>
@endif
{{-- Alert Success Update --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
</div>
@endif
{{-- Alert Success Delete --}}
@if (session()->has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('danger') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="buttons">
            <a href="{{ route('student.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
           
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-body table-responsive">
                <table class='table datatable table-striped table-bordered' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin </th>
                            <th>Pekerjaan Orang Tua</th>
                            <th>Penghasilan Orang Tua</th>
                            <th>Tanggungan Orang Tua</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student as $x => $item)
                        <tr>
                            <td>{{ $x+1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ date_format(date_create($item->tanggal_lahir), 'd M Y') }}</td>
                            <td>{{ $item->jenis_kelamin}}</td>
                            <td>{{ $item->pekerjaan_orang_tua}}</td>
                            <td>Rp. {{ number_format($item->pendapatan_orang_tua) }}</td>
                            <td>{{ $item->jumlah_tanggungan_orang_tua }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('student.edit', $item->id_student) }}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('student.destroy', $item->id_student) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="if(!confirm('Anda yakin menghapus data ini?')) return false;" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection