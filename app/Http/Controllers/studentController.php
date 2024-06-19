<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        $student = student::all();
        return view('student.index', compact('student'));
    }
    public function create()
    {
        return view('student.create');
    }
    public function store(Request $request)
    {
       $request->validate([
        'nama'=> 'required',
        'alamat' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'pekerjaan_orang_tua' => 'required',
        'pendapatan_orang_tua' => 'required',
        'jumlah_tanggungan_orang_tua'=> 'required',
        ]);

        student::create([
            'nama'=> $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
            'pendapatan_orang_tua' => $request->pendapatan_orang_tua,
            'jumlah_tanggungan_orang_tua' => $request->jumlah_tanggungan_orang_tua,
        ]);

        return redirect('/student')->with('success', 'Data berhasil disimpan');
    }
    public function edit($id_student)
    {
        $student = student::find($id_student);
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, $id_student)
    {
        $request->validate([
       'nama'=> 'required',
        'alamat' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'pekerjaan_orang_tua' => 'required',
        'pendapatan_orang_tua' => 'required',
        'jumlah_tanggungan_orang_tua'=> 'required',
        ]);

        $student = student::find($id_student);

        $student->update([
            'nama'=> $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
            'pendapatan_orang_tua' => $request->pendapatan_orang_tua,
            'jumlah_tanggungan_orang_tua' => $request->jumlah_tanggungan_orang_tua,
        ]);

        return redirect('/student')->with('success', 'Data berhasil diUpdate');
    }

    public function delete($id_student)
    {
        $student = student::find($id_student);
        return view('student.hapus', compact('student'));
    }

    public function destroy($id_student)
    {
        $student = student::find($id_student);
        $student->delete();
        return redirect('/student')->with('success', 'Data berhasil hapus ');
    }


}
