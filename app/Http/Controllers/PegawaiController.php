<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Http\Requests\PegawaiRequest;
use App\Http\Requests\PegawaiUpdateRequest;
use App\Jabatan;
use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pegawai.index')->with('pegawai',Pegawai::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create')->with('jabatan' , Jabatan::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {


        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'jk' => $request->jk,
            'jabatan_id' => $request->jabatan,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
        ]);

        session()->flash('success', 'Pegawai sukses dibuat 💓💓💓');

        return redirect(route('pegawai.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.create')
                ->withPegawai($pegawai)
                ->withJabatan(Jabatan::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiUpdateRequest $request, Pegawai $pegawai)
    {
        $data = $request->all();

        if ($request->jabatan) {
            $pegawai->jabatan()->associate($request->jabatan);
        }

        $pegawai->update($data);

        session()->flash('success', 'Pegawai telah berhasil di update');

        return redirect(route('pegawai.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai)
    {
        $pegawai->delete();

        // $absen = Absensi::find($pegawai->id);

        // $absen->delete();

        session()->flash('success', 'Pegawai telah berhasil di hapus');

        return back();
    }
}
