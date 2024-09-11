<div class="content-header">
    <div class="btn-group btn-block">
        <a href="{{ route('index') }}" class="btn btn-app bg-info" style="height: 70px;">
            <i class="fas fa-chevron-left"></i>
            <h5>List Pasien</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}" class="btn btn-app bg-info {{ $header == 'Resume' ? 'active' : '' }}"
            style="height: 70px;">
            <i class="fas fa-laptop-medical"></i>
            <h5>Resume</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}/soapie"
            class="btn btn-app bg-info {{ $header == 'S.O.A.P.I.E.' ? 'active' : '' }}" style="height: 70px;">
            <i class="fas fa-notes-medical"></i>
            <h5>S.O.A.P.I.E.</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}/diagnosa"
            class="btn btn-app bg-info {{ $header == 'Diagnosa' ? 'active' : '' }}" style="height: 70px;">
            <i class="fas fa-diagnoses"></i>
            <h5>Diagnosa</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}/laboratorium"
            class="btn btn-app bg-info {{ $header == 'Laboratorium' ? 'active' : '' }}" style="height: 70px;">
            <i class="fas fa-microscope"></i>
            <h5>Laboratorium</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}/radiologi"
            class="btn btn-app bg-info {{ $header == 'Radiologi' ? 'active' : '' }}" style="height: 70px;">
            <i class="fas fa-x-ray"></i>
            <h5>Radiologi</h5>
        </a>
        <a href="/pasien/{{ $pasien->nomor_rawat }}/eresep"
            class="btn btn-app bg-info {{ $header == 'E-Resep' ? 'active' : '' }}" style="height: 70px;">
            <i class="fas fa-pills"></i>
            <h5>E-Resep</h5>
        </a>
    </div>
    <div class="container-fluid">
        <div class="row mb-2 mt-4">
            <div class="col-sm-6">
                <h1 class="m-0 text-bold">{{ $header }} : </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info shadow text-bold">
                    <span><i class="fas fa-user"></i></span>
                    <span>{{ $pasien->pasien->nm_pasien }}</span>
                    <span>({{ \Carbon\Carbon::parse($pasien->pasien->tgl_lahir)->age }}) -</span>
                    <span>({{ $pasien->no_rkm_medis }})</span>
                    <span><i class="fas fa-venus-mars ml-3"></i></span>
                    <span>{{ $pasien->pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    <span><i class="fas fa-calendar-alt ml-3"></i></span>
                    <span>{{ \Carbon\Carbon::parse($pasien->tgl_registrasi)->format('d-m-Y') }} | </span>
                    <span>{{ $pasien->jam_reg }}</span>
                    <span><i class="fas fa-map-marked-alt ml-3"></i> </span>
                    <span>{{ $pasien->almt_pj }}</span>
                    <span><i class="fas fa-money-check-alt ml-3"></i> </span>
                    <span>{{ $pasien->kd_pj == 'BPJ' ? 'BPJS' : 'UMUM' }}</span>
                    <span><i class="fas fa-notes-medical ml-3"></i></span>
                    <span>{{ $pasien->no_rawat }}</span>
                    <span><i class="fas fa-phone-alt ml-3"></i></span>
                    <span>{{ $pasien->pasien->no_tlp }}</span>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
