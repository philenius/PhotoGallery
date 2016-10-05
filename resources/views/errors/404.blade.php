<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Malaysia Photo Gallery - Share your photos from Malaysia. You can easily upload your photos and download photos from others in high quality." />
    <meta name="keywords" content="Photo Gallery, Malaysia, Summercamp, International Intensive Programme 2016, Business Environment, Kompaktprogramm, DHBW Karlsruhe" />
	<title>Error - Kompaktprogramm Malaysia 2016</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body>
	<div class="container">
		<h1>
			Error 403<br>
        </h1>
        <div class="row">
	        <div class="col-lg-12 text-center">
	        	<img src="{{ asset('uploads/Forbidden.gif') }}" class="">
			</div>
		</div>
		<div class="text-center">
        	<a class="btn" href="{{ route('index') }}" role="button">
            	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			</a>
		</div>
	</div>
    
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script>
		setInterval(function() {
            $('.glyphicon-chevron-left').fadeToggle(1500);
        }, 1500);
	</script>
</body>
</html>