@extends('layouts.app')




@section('content')
    <div class="row justify-content-center py-5 border rounded ">
        @include('partials.error')
        <form class="form col-md-8" action="{{route('absensi.store')}}" method="POST">
            @csrf
            <div class="form-row mx-auto" >
                <div class="form-group col-md-8 ">
                    <label for="pegawai">Nama Pegawai</label>
                    <select class="form-control select2" name="pegawai" id="pegawai">
                        @foreach ($pegawai as $pegawai)
                            <option value="{{$pegawai->id}}">{{$pegawai->nama_pegawai}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="status">Status absen</label>
                    <select class="form-control" name="status" id="status">
                        <option value="5">Sakit</option>
                        <option value="4">Hadir</option>
                        <option value="3">Absen</option>
                        <option value="2">Izin</option>
                        <option value="1">Cuti</option>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <label for="inputPassword4">‎‎‎‎‏‏‎ ‎</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class=" justify-content-center mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="d-inline-block">Absensi</h3>
            </div>
            <div class="card-body">
                @if ($pegawai->count() > 0)
                <table class="table">
                    <thead>
                        <th>Nama pegawai</th>
                        <th>Jabatan</th>
                        <th>Tanggal Absen</th>
                        <th>Status Absensi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $absensi)
                            <tr>
                                <td>{{$absensi->pegawai->nama_pegawai}}</td>
                                <td>{{$absensi->pegawai->jabatan->nama_jabatan}}</td>
                                <td>{{$absensi->tgl}}</td>
                                <td>
                                    @switch($absensi->status)
                                        @case(5)
                                            SAKIT
                                        @break
                                        @case(4)
                                            HADIR
                                            @break
                                        @case(3)
                                            ABSEN
                                            @break
                                        @case(2)
                                            IZIN
                                            @break
                                        @default
                                            CUTI
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{route('absensi.edit', $absensi->id)}}" class="btn btn-sm btn-primary">Edit Status</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama pegawai</th>
                            <th>Jabatan</th>
                            <th>Tanggal Absen</th>
                            <th>Status Absensi</th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h3 class="text-center">
                    Belum ada absensi.
                </h3>
            @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $('.select2').select2({
        theme: "bootstrap"
    });

    $('.table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }

        ],

        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
</script>
@endsection

