@extends('templates.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-bold">{{ $header }} </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">
                            Pasien Poli ..
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-pasien" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Tgl. Registrasi</th>
                                    <th>No. RM</th>
                                    <th>Pasien</th>
                                    <th>Engine version</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $data)
                                    <tr>
                                        <td>{{ $data->waktu_registrasi }}</td>
                                        <td>{{ $data->no_rkm_medis }}</td>
                                        <td>{{ $data->pasien->nm_pasien }}</td>
                                        <td>{{ $data->tgl_registrasi }}</td>
                                        <td>{{ $data->tgl_registrasi }}</td>
                                        <td>
                                            <a href="/pasien/{{ $data->nomor_rawat }}"
                                                class="btn btn-primary btn-sm border-0" data-popup='tooltip'
                                                title='Periksa'>
                                                <i class="fas fa-user-md"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        $(function() {
            $("#table-pasien").DataTable();
        });
    </script>
@endsection
