<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Http\Requests\AbsensiRequest;
use App\Pegawai;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensi.index')->with('pegawai', Pegawai::all())->with('absensi', Absensi::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(AbsensiRequest $request)
    {
        Absensi::create([
            'pegawai_id' => $request->pegawai,
            'status' => $request->status,
            'tgl' => date('Y-m-d H:i:s')
        ]);

        session()->flash('success', 'Absen tersimpan.');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        return view('absensi.edit')->withAbsensi($absensi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $absensi->update($request->all());

        session()->flash('success', 'Status absensi berhasil di update');

        return redirect(route('absensi.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
