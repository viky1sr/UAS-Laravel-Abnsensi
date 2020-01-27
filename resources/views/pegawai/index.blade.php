@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">Pegawai</h3>
        <a href="{{route('pegawai.create')}}" class="btn btn-md btn-primary float-right">Tambah Pegawai</a>
        </div>
        <div class="card-body">
            @if ($pegawai->count() > 0)
                <table class="table">
                    <thead>
                        <th>Nama pegawai</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $pegawai)
                            <tr>
                                <td>{{$pegawai->nama_pegawai}}</td>
                                <td>{{$pegawai->jabatan->nama_jabatan}}</td>
                                <td>{{$pegawai->jk == 0 ? 'Pria' : 'Wanita'}}</td>
                                <td>{{$pegawai->no_telp}}</td>
                                <td>{{$pegawai->alamat}}</td>
                                <td>
                                    <a href="{{route('pegawai.edit', $pegawai->id)}}" class="btn btn-sm btn-secondary">Edit</a>
                                    <button onclick="deleteHandler({{$pegawai->id}})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama pegawai</th>
                            <th>Jabatan</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h3 class="text-center">
                    Belum ada Pegawai.
                </h3>
            @endif


            <form action="" method="POST" id="deletePegawaiForm">
                @csrf
                @method("DELETE")
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak!</button>
                        <button type="submit" class="btn btn-danger">Ya!</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
   <script>
        function deleteHandler(id){
            const form = document.querySelector('#deletePegawaiForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '/pegawai/' + id;
            $('#deleteModalLabel').html('Hapus pegawai?');
            $('#deleteModal').modal('show');
    }

    $('.table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
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
