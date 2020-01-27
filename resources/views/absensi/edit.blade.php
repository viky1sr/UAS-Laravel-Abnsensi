@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">
                Nama:
                <span class="badge badge-info text-white">
                    {{$absensi->pegawai->nama_pegawai}}
                </span>
                Tanggal:
                <span class="badge badge-info text-white">
                    {{$absensi->tgl}}
                </span>
            </h3>
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{route('absensi.update', $absensi->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Absensi</label>
                    <select name="status" id="status" class="form-control">
                        <option value="4"
                            @if ($absensi->status == 4)
                            selected
                            @endif
                        >Hadir</option>
                        <option value="3"
                        @if ($absensi->status == 3)
                            selected
                            @endif>Absen</option>
                        <option value="2"
                        @if ($absensi->status == 2)
                            selected
                            @endif>izin</option>
                        <option value="1"
                        @if ($absensi->status == 1)
                            selected
                            @endif>Cuti</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-md btn-success">Edit absensi</button>
            </form>
        </div>
    </div>
@endsection

