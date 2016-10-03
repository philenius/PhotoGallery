<!DOTCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Malaysia Summer Camp 2016</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>International Intensive Programme 2016 <small>Business Environment In Malaysia</small></h1>
                <p></p>
            </div>
        </div>
        <div class="row">
        @foreach ($photos as $i=>$photo)
            <div class="col-lg-6 col-md-6">
                <section class="wow @if (($i % 2) == 0) bounceInLeft @else bounceInRight @endif" data-wow-offset="50">
                    <a href="{{ asset('uploads/' . $photo->file_name_compressed) }}" data-lightbox="roadtrip">
                        <img src="{{ asset('uploads/' . $photo->file_name_thumbnail) }}">
                    </a>
                </section>
                <p>
                    {{ $photo->title }}, {{ $photo->location }}
                    <a href="{{ asset('uploads/' . $photo->file_name_original) }}" class="pull-right download" download>Download</a>
                </p>
            </div>
        @endforeach
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large orange">
                <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
            </a>
        </div>
        <footer>
            <div class="row footer">
                <div class="col-lg-12 text-center">
                    <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
                    <a href="https://philenius.de" target="_blank">Philipp Perez, 2016</a>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script type="text/javascript">
        var width = $(document).width();
        var lightBoxWidth = 0;
        if (width < 750) {
                lightBoxWidth = width;
        } else {
                lightBoxWidth = width / 1.5;
        }
        
        new WOW().init();
        lightbox.option({
            'showImageNumberLabel': false,
            'wrapAround': true,
            'alwaysShowNavOnTouchDevices': true,
            'maxWidth': lightBoxWidth,
            'resizeDuration': 400
        });
    </script>
</body>
</html>