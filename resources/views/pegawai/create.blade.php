@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">{{isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai'}}</h3>
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($pegawai) ? route('pegawai.update', $pegawai->id) : route('pegawai.store')}}" method="POST">
                @csrf
                @if (isset($pegawai))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama_pegawai">Nama Pegawai</label>
                    <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" value="{{old('nama_pegawai', isset($pegawai) ? $pegawai->nama_pegawai : '')}}">
                </div>

                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" id="jk" name="jk" class="form-control">
                        <option value="0">Pria</option>
                        <option value="1">Wanita</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control">
                        @foreach ($jabatan as $jabatan)
                            <option value="{{$jabatan->id}}"
                                @if (isset($pegawai))
                                    @if ($jabatan->id === $pegawai->jabatan_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{$jabatan->nama_jabatan}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input type="number" id="no_telp" name="no_telp" class="form-control" value="{{old('no_telp', isset($pegawai) ? $pegawai->no_telp : '')}}">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" value="{{old('alamat', isset($pegawai) ? $pegawai->alamat : '')}}">
                </div>

                <button type="submit" class="btn btn-md btn-success">{{isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai'}}</button>
            </form>
        </div>
    </div>
@endsection

