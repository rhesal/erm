@extends('templates.index')
@section('content')
    <style>
        .vertical-line-container {
            display: grid;
            align-items: center;
            justify-items: center;
            height: 300px;
        }

        .vertical-line {
            width: 2px;
            background-color: cyan;
            height: 100%;
            position: relative;
        }

        .vertical-line::before {
            content: "Tinggi \A 165 cm";
            white-space: pre-wrap;
            width: 80px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 0 10px;
        }
    </style>
    
    <!-- Content Header (Page header) -->
    @include('pasien.navbar')
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Content Tanda Vital--->
                <div class="col-3">
                    <div class="card card-primary card-outline" style="height: 400px;">
                        <div class="card-header">
                            <h3 class="card-title d-flex">
                                <img src="{{ asset('adminlte/img/icons/heart-rate-icon.png') }}" width="24px"> <b
                                    class="ml-3">Tanda Vital</b>
                            </h3>
                            <a class="btn-sm bg-warning d-flex float-lg-right">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">01/12/2024</th>
                                        <th class="text-center">07/12/2024</th>
                                    </tr>
                                </thead>
                                <tbody class="align-items-center">
                                    <tr>
                                        <td class="text-center"><img
                                                src="{{ asset('adminlte/img/icons/blood-pressure-icon.png') }}"
                                                width="16px" alt=""></td>
                                        <td>Tensi(mmHg)</td>
                                        <td class="text-center">135/90</td>
                                        <td class="text-center">130/90</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img
                                                src="{{ asset('adminlte/img/icons/heart-rate-icon.png') }}" width="16px"
                                                alt=""></td>
                                        <td>Nadi(x/menit)</td>
                                        <td class="text-center">90</td>
                                        <td class="text-center">90</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img src="{{ asset('adminlte/img/icons/lungs-icon.png') }}"
                                                width="16px" alt=""></td>
                                        <td>RR(x/menit)</td>
                                        <td class="text-center">20</td>
                                        <td class="text-center">20</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img
                                                src="{{ asset('adminlte/img/icons/thermometer-icon.png') }}" width="16px"
                                                alt=""></td>
                                        <td>Suhu(&deg;C)</td>
                                        <td class="text-center">36.5</td>
                                        <td class="text-center">36.5</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img
                                                src="{{ asset('adminlte/img/icons/blood-oxygen-icon.png') }}" width="16px"
                                                alt=""></td>
                                        <td>SpO<sub>2</sub>(%)</td>
                                        <td class="text-center">98</td>
                                        <td class="text-center">98</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img
                                                src="{{ asset('adminlte/img/icons/psychology-icon.png') }}" width="16px"
                                                alt=""></td>
                                        <td>GCS(E,V,M)</td>
                                        <td class="text-center">456</td>
                                        <td class="text-center">456</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Content BMI--->
                <div class="col-3">
                    <div class="card card-primary card-outline" style="height: 400px;">
                        <div class="card-header">
                            <h3 class="card-title d-flex">
                                <img src="{{ asset('adminlte/img/icons/bmi-icon.png') }}" width="24px"> <b
                                    class="ml-3">Indeks Massa Tubuh</b>
                            </h3>
                            <a class="btn-sm bg-warning d-flex float-lg-right">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 mt-xl-5" style="text-align: center;">
                                    <p>IMT : 25.4</p>
                                    <hr>
                                    <p>Berat : 65 kg</p>
                                </div>
                                <div class="col-4 ml-2">
                                    <img src="{{ asset('adminlte/img/body-vector.png') }}" width="120px" height="300px">
                                </div>
                                <div class="col-2 ml-3">
                                    <div class="vertical-line-container">
                                        <div class="vertical-line"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
