<!doctype html>
<html lang="en">

<head>
    <title>Applied Candidate</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/bf3b9c3659.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header px-30 pt-30 pb-10 border-bottom-0">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-9 text-center">
                            <h6>Application Information</h6>
                            <h2 style="font-size: 28px; font-weight: 700;">{{$candidate->nama_lengkap}} -
                                {{$candidate->posisi()->first()->title}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-6 text-left">
                            <p>
                                Nama Lengkap <br>
                                <b>{{$candidate->nama_lengkap}}</b> <br><br>
                                Gender <br>
                                <b>
                                    @if ($candidate->jenis_kelamin=='Pria')
                                    <span><i class="fal fa-mars"></i>&nbsp;
                                        Pria</span>
                                    @else
                                    <span><i class="fal fa-venus"></i>&nbsp;
                                        Wanita</span>
                                    @endif
                                </b><br><br>
                                No. NIK <br>
                                <b>{{$candidate->noktp}}</b> <br><br>
                                No. NPWP <br>
                                <b>{{$candidate->nonpwp}}</b> <br><br>
                                No. BPJS <br>
                                <b>{{$candidate->nobpjg}}</b> <br><br>
                                Tempat, Tanggil Lahir <br>
                                <b>{{$candidate->tempat_lahir}}, {{$candidate->tanggal_lahir}}</b><br><br>
                                Alamat Tempat Tinggal <br>
                                <b>{!!$candidate->alamat_domisili!!}</b>
                                <br>
                                Provinsi, Domisili - Kecamatan/Kelurahan <br>
                                <b>{{$candidate->provinsi()->first()->province_name}},
                                    {{$candidate->domisili()->first()->domisili_name}} -
                                    {{$candidate->kecamatan()->first()->kecamatan_name}}{{$candidate->kelurahan()->first()->kelurahan_name}}</b>
                                <br><br>
                                Pendidikan Terakhir <br>
                                <b>{{$candidate->pendidikan_akhir}}</b><br><br>
                                Agama, Suku <br>
                                <b>{{$candidate->agama()->first()->agama_name}},
                                    {{$candidate->suku()->first()->suku_name}}</b><br><br>
                                Informasi Lowongan <br>
                                <b>{{$candidate->sumber_informasi}}</b><br><br>
                                Status Perkawinan <br>
                                <b>{{$candidate->status_perkawinan}}</b> <br><br>
                                Gaji yang diharapkan <br>
                                <b>{{$candidate->expected_sallary}}</b> <br><br>
                            </p>
                        </div>
                        <div class="col-lg-3 text-left">
                            <a target="_blank"><img style="width: 113.3px; height: 151.1px; object-fit:cover;"
                                    class="pasfoto" alt="Pas foto 3x4" src="{{$candidate->pictures}}"></a>
                            <br><br>
                            <p>
                                Email <br>
                                <b>{{$candidate->email}}</b><br><br>
                                Nomor HP <br>
                                <b>{{$candidate->nohp}}</b><br><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-lg-12 text-center mb-3">
                <i>Asset original document refer to BTSA LOGISTICS</i>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
