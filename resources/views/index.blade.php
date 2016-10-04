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
    
    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="UploadModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Upload a New Photo</h3>
                </div>
                <form method="post" action="{{ route('uploadPhoto') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 no-margin">
                                <p class="instruction">Select one <strong>image</strong> for upload (.png / .jpg):</p>
                            </div>
                            <div class="col-lg-6 no-margin">
                                <div class="input-group">
                                    <input class="inputfile" type="file" id="inputFile" accept="image/*" name="photo" required/>
                                </div>
                            </div>
                            <div class="col-lg-12 only-margin-top">
                                <hr>
                                <p class="instruction">Enter a <strong>title</strong> / short description for the image:</p>
                            </div>
                            <div class="col-lg-6 no-margin">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="photoTitle" placeholder="Name of building / location" required>
                                </div>
                            </div>
                            <div class="col-lg-12 only-margin-top">
                                <hr>
                                <p class="instruction">Enter the name of the <strong>city</strong> or the country name:</p>
                            </div>
                            <div class="col-lg-6 no-margin">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="photoLocation" placeholder="Name of city / country" required>
                                </div>
                            </div>
                            <div class="col-lg-12 no-margin">
                                <hr>
                                <p class="instruction">Select a <strong>subject</strong> for the photo:</p>
                            </div>
                            <div class="col-lg-12 no-margin">
                                <div class="row">
                                    <fieldset>
                                        <div class="form-group">
                                        @foreach($photoSubjects as $i=>$photoSubject)
                                            <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6">
                                                <div class="input-group">
                                                    <input type="radio" name="photoSubject" aria-label="{{ $photoSubject->subject }}" id="subject{{ $i }}" value="{{ $photoSubject->id }}" required>
                                                    <label for="subject{{ $i }}">
                                                        &nbsp;{{ $photoSubject->subject }}
                                                    </label>
                                                </div><!-- /input-group -->
                                             </div>
                                        @endforeach
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn material-btn btn-cancel grey" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn material-btn btn-submit grey" id="submitUpload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                <p class="wow @if (($i % 2) == 0) bounceInLeft @else bounceInRight @endif" data-wow-offset="50">
                    {{ $photo->title }}, {{ $photo->location }}
                    <a href="{{ asset('uploads/' . $photo->file_name_original) }}" class="pull-right download" download>Download</a>
                </p>
            </div>
        @endforeach
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red" data-toggle="modal" data-target="#uploadModal">
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
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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

        var newDOM = '<input type="text" class="form-control fileName" placeholder="File name" disabled>' +
                    '<span class="input-group-btn">' +
                    '<button class="btn" id="fileButton" type="button">Select file</button>' +
                    '</span>';
        $('#inputFile').before(newDOM);


        $('#inputFile').hide();
        $('body').on('click', '#fileButton', function() { 
            $('#inputFile').trigger('click');
        });

        var formValidated = false;
        var inputs = document.querySelectorAll( '[type="file"]' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label = input.nextSibling;
            var labelVal = label.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 ) {
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                } else {
                    fileName = e.target.value.split( '\\' ).pop();
                }

                if(fileName) {
                    $('input.fileName')[0].value = fileName;
                    formValidated = true;
                } else {
                    label.innerHTML = labelVal;
                }
            });
        });

        $('#submitUpload').click(function() {
            if (formValidated) {
                $(this).html('<span class="glyphicon glyphicon-chevron-up spinning"></span>&nbsp;Uploading');
                $(this).css('backgroundColor', '#009688');
            }
        });
    </script>
</body>
</html>