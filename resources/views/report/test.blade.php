<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <img src="https://tools/{{$company->site}}/webpage/images/logo.png">
            </div>
            <div class="col-lg-4">
                <h1>PT BERLIAN TRANSTAR ABADI</h1>
                <span>Jalan Williem Iskandar Komp. MMTC Blok C 93, RT.94,
                    Medan Estate, Kec. Percut Sei Tuan, Kabupaten Deli
                    Serdang, Sumatera Utara 20371
                    06180032999</span>
                <a href="#">support@ {{$company->site}}</a>
            </div>
            <div class="col-lg-4">
                <img
                    src="data:image/png;base64,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">
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
