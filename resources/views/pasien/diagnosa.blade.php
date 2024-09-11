@extends('templates.index')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Tambahkan beberapa styling dasar */
        /*CSS Diagnosa ICD-10*/
        .autocomplete-suggestions-icd10 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
            position: absolute;
            z-index: 1000;
            width: 97%;
        }

        .autocomplete-suggestion-icd10 {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-suggestion-icd10:hover {
            background-color: #17a2b8;
            color: #fff;
            width: 100%;
        }

        .selected-items-icd10 {
            margin-top: 20px;
            width: 100%;
        }

        .selected-item-icd10 {
            padding: 10px;
            margin-bottom: 5px;
            background-color: #fff4d6;
            border: 2px solid #d8c593;
            border-radius: 10px;
        }

        /*End of CSS Diagnosa ICD-10*/
        /*CSS Prosedur ICD-9*/
        .autocomplete-suggestions-icd9 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
            position: absolute;
            z-index: 1000;
            width: 97%;
        }

        .autocomplete-suggestion-icd9 {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-suggestion-icd9:hover {
            background-color: #ffc107;
            color: #fff;
            width: 100%;
        }

        .selected-items-icd9 {
            margin-top: 20px;
            width: 100%;
        }

        .selected-item-icd9 {
            padding: 10px;
            margin-bottom: 5px;
            background-color: #fff4d6;
            border: 2px solid #d8c593;
            border-radius: 10px;
        }

        /*End of CSS Prosedur ICD-9*/
        .grid-container {
            display: grid;
            grid-template-columns: auto 1fr;
            width: 100%;
        }

        .item-name {
            text-align: left;
            order: 1;
        }

        .item-number {
            text-align: right;
            order: 2;
        }
    </style>
    <!-- Content Header (Page header) -->
    @include('pasien.navbar')
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h6 class="card-title text-bold">ICD-10 (Diagnosa)</h6>
                            </div>
                            <div class="card-body">
                                <div class="row add_item_icd10" width="100%">
                                    <div class="form-group col-md-10 mb-3">
                                        <label for="kd_penyakit" class="form-label">
                                            <h3 class="text-bold">Diagnosa</h3>
                                        </label>
                                        <div>
                                            <input type="text" id="search-box-icd10" class="rounded"
                                                style="width: 100%; height: 38px; border: 1px solid #ccc;"
                                                placeholder="Ketik untuk mencari Diagnosa ...">
                                            <div id="suggestions-icd10" class="autocomplete-suggestions-icd10"></div>
                                        </div>
                                    </div>
                                </div> <!---end row-->
                                <div class="selected-items-icd10" id="selected-items-icd10">
                                    <!-- Item yang dipilih akan ditambahkan di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h6 class="card-title text-bold">ICD-9 (Prosedur)</h6>
                            </div>
                            <div class="card-body">
                                <div class="row add_item_icd9">
                                    <div class="form-group col-md-8 mb-3">
                                        <label for="kode" class="form-label">
                                            <h3 class="text-bold">Prosedur</h3>
                                        </label>
                                        <div>
                                            <input type="text" id="search-box-icd9" class="rounded"
                                                style="width: 100%; height: 38px; border: 1px solid #ccc;"
                                                placeholder="Ketik untuk mencari Prosedur ...">
                                            <div id="suggestions-icd9" class="autocomplete-suggestions-icd9"></div>
                                        </div>
                                    </div>
                                </div> <!---end row-->
                                <div class="selected-items-icd9" id="selected-items-icd9">
                                    <!-- Item yang dipilih akan ditambahkan di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                    </div>
                </div>
            </form>

            <div class="row mt-5">
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
                                    <tr>
                                        <td>Gecko</td>
                                        <td>Firefox 2.0</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>1.8</td>
                                        <td>A</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!---------------------------For Section--------------------------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter10 = 0;
            $(document).on("click", ".addeventmoreicd10", function() {
                var whole_extra_item_add = $("#whole_extra_item_add_icd10").html();
                $(this).closest(".add_item_icd10").append(whole_extra_item_add);
                counter10++;
            });
            $(document).on("click", ".removeeventmoreicd10", function(event) {
                $(this).closest("#whole_extra_item_delete_icd10").remove();
                counter10 -= 1
            });

            var counter9 = 0;
            $(document).on("click", ".addeventmoreicd9", function() {
                var whole_extra_item_add = $("#whole_extra_item_add_icd9").html();
                $(this).closest(".add_item_icd9").append(whole_extra_item_add);
                counter9++;
            });
            $(document).on("click", ".removeeventmoreicd9", function(event) {
                $(this).closest("#whole_extra_item_delete_icd9").remove();
                counter9 -= 1
            });
        });
        $(function() {
            $("#table-pasien").DataTable();
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script>
        $(document).ready(function() {
            // Saat pengguna mengetik di kotak pencarian
            $('#search-box-icd10').on('input', function() {
                var query = $(this).val();

                // Periksa apakah ada query
                if (query.length > 0) {
                    // Lakukan request AJAX ke server untuk mendapatkan data
                    $.ajax({
                        url: '/search-items-icd10', // URL untuk endpoint pencarian
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            // Kosongkan kotak suggestions
                            $('#suggestions-icd10').empty();

                            // Tambahkan hasil pencarian ke kotak suggestions
                            response.forEach(function(item) {

                                $('#suggestions-icd10').append(
                                    '<div class="autocomplete-suggestion-icd10" data-id="' +
                                    item.kd_penyakit +
                                    '" data-name="' +
                                    item.nm_penyakit +
                                    '"><table style="width: 100%;"><tr><td style="text-align: left;">' +
                                    item.nm_penyakit +
                                    '</td><td style="text-align: right;">' + item
                                    .kd_penyakit + '</td></tr></table></div>');
                            });
                        }
                    });
                } else {
                    // Kosongkan kotak suggestions jika tidak ada query
                    $('#suggestions-icd10').empty();
                }
            });

            // Saat pengguna mengklik salah satu suggestion
            $(document).on('click', '.autocomplete-suggestion-icd10', function() {
                var itemKd_penyakit = $(this).data('id');
                var itemNm_penyakit = $(this).data('name');
                console.log('itemKd_penyakit : ' + itemKd_penyakit);
                console.log('itemNm_penyakit : ' + itemNm_penyakit);

                // Tambahkan item yang dipilih ke daftar selected items
                $('#selected-items-icd10').append(
                    '<div class="whole_extra_item_delete_icd10" id="whole_extra_item_delete_icd10">' +
                    '<div class="row" width="100%">' +
                    '<div class ="form-group col-md-10 mb-3 selected-item-icd10">' +
                    '<div class="grid-container text-bold" name="kd_penyakit[]" id="kd_penyakit" data-id="' +
                    itemKd_penyakit + '">' +
                    '<div class="item-name">' + itemNm_penyakit + '</div>' +
                    '<div class="item-number">' +
                    '<span class="bg-info p-1 rounded">' + itemKd_penyakit + '<span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="grid-container form-group col-md-2" style="place-items: center;">' +
                    '<span class="btn btn-danger mt-1 removeeventmoreicd10">' +
                    '<i class="fa fa-minus-circle">&nbsp;Remove</i>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                // Kosongkan kotak pencarian dan suggestions
                $('#search-box-icd10').val('');
                $('#suggestions-icd10').empty();
            });

            $('#search-box-icd9').on('input', function() {
                var query = $(this).val();

                // Periksa apakah ada query
                if (query.length > 0) {
                    // Lakukan request AJAX ke server untuk mendapatkan data
                    $.ajax({
                        url: '/search-items-icd9', // URL untuk endpoint pencarian
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            // Kosongkan kotak suggestions
                            $('#suggestions-icd9').empty();

                            // Tambahkan hasil pencarian ke kotak suggestions
                            response.forEach(function(item) {

                                $('#suggestions-icd9').append(
                                    '<div class="autocomplete-suggestion-icd9" data-id="' +
                                    item.kode +
                                    '" data-name="' +
                                    item.deskripsi_panjang +
                                    '"><table style="width: 100%;"><tr><td style="text-align: left;">' +
                                    item.deskripsi_panjang +
                                    '</td><td style="text-align: right;">' + item
                                    .kode + '</td></tr></table></div>');
                            });
                        }
                    });
                } else {
                    // Kosongkan kotak suggestions jika tidak ada query
                    $('#suggestions-icd9').empty();
                }
            });

            // Saat pengguna mengklik salah satu suggestion
            $(document).on('click', '.autocomplete-suggestion-icd9', function() {
                var itemKode = $(this).data('id');
                var itemDeskripsi_panjang = $(this).data('name');
                console.log('itemKode : ' + itemKode);
                console.log('itemDeskripsi_panjang : ' + itemDeskripsi_panjang);

                // Tambahkan item yang dipilih ke daftar selected items
                $('#selected-items-icd9').append(
                    '<div class="whole_extra_item_delete_icd9" id="whole_extra_item_delete_icd9">' +
                    '<div class="row" width="100%">' +
                    '<div class ="form-group col-md-10 mb-3 selected-item-icd9">' +
                    '<div class="grid-container text-bold" name="kode[]" id="kode" data-id="' +
                    itemKode + '">' +
                    '<div class="item-name">' + itemDeskripsi_panjang + '</div>' +
                    '<div class="item-number">' +
                    '<span class="bg-warning p-1 rounded">' + itemKode + '<span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="grid-container form-group col-md-2" style="place-items: center;">' +
                    '<span class="btn btn-danger mt-1 removeeventmoreicd9">' +
                    '<i class="fa fa-minus-circle">&nbsp;Remove</i>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                // Kosongkan kotak pencarian dan suggestions
                $('#search-box-icd9').val('');
                $('#suggestions-icd9').empty();
            });
        });
    </script>
@endsection
