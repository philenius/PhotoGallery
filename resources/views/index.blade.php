<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Malaysia Photo Gallery - Share your photos from Malaysia. You can easily upload your photos and download photos from others in high quality." />
    <meta name="keywords" content="Photo Gallery, Malaysia, Summercamp, International Intensive Programme 2016, Business Environment, Kompaktprogramm, DHBW Karlsruhe" />
    <title>Kompaktprogramm Malaysia 2016</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
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

@if (Session::has('error'))
    <!-- internal server error modal -->
    <div class="modal fade error" tabindex="-1" role="dialog" id="internalServerErrorModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Upload Error</h3>
                </div>
                <div class="modal-body">
                    <p>{{ Session::get('error') }}</p>
                </div>
                <div class="modal-footer">
                    <a class="waves-effect waves-light btn red" data-dismiss="modal">Close</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->@endif
@if (count($errors) > 0)
    <!-- error modal -->
    <div class="modal fade error" tabindex="-1" role="dialog" id="errorModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Upload Error</h3>
                </div>
                <div class="modal-body">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
                <div class="modal-footer">
                    <a class="waves-effect waves-light btn red" data-dismiss="modal">Close</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endif

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="UploadModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Upload a New Photo</h3>
                </div>
                <form method="post" action="{{ route('uploadPhoto') }}" enctype="multipart/form-data" id="uploadForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 no-margin-top">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="instruction">Select one <strong>image</strong> for upload (only .jpg allowed):</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 no-padding-right">
                                        <input type="text" class="fileName" placeholder="File name" disabled>
                                        <input class="inputfile" type="file" id="inputFile" accept="image/jpeg" name="file" required/>
                                    </div>
                                    <div class="col-lg-4 no-padding">
                                        <a class="waves-effect waves-light btn blue-grey lighten-3" id="fileButton">Select file</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 no-margin-top">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="instruction">Enter a <strong>title</strong> / short description for the image:</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="photoTitle" placeholder="Name of building / location" required>
                                    </div>
                                </div>
                            </div>
                            <div class="visible-xs">
                                <div class="col-xs-12 no-margin-top">
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 no-margin-top">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="instruction">Enter the name of the <strong>city</strong> or the country name:</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="photoLocation" placeholder="Name of city / country" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                                <p class="instruction">Select a <strong>subject</strong> for the photo:</p>
                            </div>
                            <div class="col-lg-12">
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
                        <a class="waves-effect waves-light btn btn-flat" id="cancelUpload" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn waves-effect waves-light blue-grey lighten-1" id="submitUpload">Upload</button>
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

            <div class="col-lg-6 col-md-6 photo">
                <section class="wow @if (($i % 2) == 0) bounceInLeft @else bounceInRight @endif" data-wow-offset="50">
                    <a href="{{ asset('uploads/' . $photo->file_name_compressed) }}" data-lightbox="roadtrip">
                        <img src="{{ asset('uploads/' . $photo->file_name_thumbnail) }}">
                    </a>
                </section>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 no-margin-top">
                        <p>
                            {{ $photo->title }}, {{ $photo->location }}
                            <a href="{{ asset('uploads/' . $photo->file_name_original) }}" class="pull-right download" download>Download</a>
                        </p>
                    </div>
                </div>
            </div>

        @endforeach
        </div>
        <div class="fixed-action-btn horizontal">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">menu</i>
            </a>
            <ul>
                <li>
                    <a class="btn-floating blue-grey lighten-1" href="{{ asset('uploads/allPhotos.zip') }}" download>
                        <i class="material-icons">file_download</i>
                    </a>
                </li>
                <li>
                    <a class="btn-floating blue-grey darken-1" data-toggle="modal" data-target="#uploadModal">
                        <i class="material-icons">file_upload</i>
                    </a>
                </li>
            </ul>
        </div>
        <nav class="pagination" aria-label="pagination">
            <ul class="pager">
            @if ($page == '1')
                <li class="disabled"><a href="">Previous</a></li>
            @else
                <li><a href="/{{ $page - 1 }}">Previous</a></li>
            @endif
            @if ($nextPage)
                <li><a href="/{{ $page + 1 }}">Next</a></li>
            @else
                <li class="disabled"><a href="">Next</a></li>
            @endif
            </ul>
        </nav>
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
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    @if (count($errors) > 0)
        $('#errorModal').modal();
    @endif
    @if (Session::has('error'))
        $('#internalServerErrorModal').modal();
    @endif

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

        $('#inputFile').hide();
        $('body').on('click', '#fileButton', function() { 
            $('#inputFile').trigger('click');
        });
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
                } else {
                    label.innerHTML = labelVal;
                }
            });
        });

        $('#submitUpload').click(function() {
            var form = $('#uploadForm');
            form.validate();
            if (form.valid()) {
                $(this).html('<span class="glyphicon glyphicon-chevron-up spinning"></span>&nbsp;Uploading');
                $(this).css('backgroundColor', '#009688');
            }
        });
    </script>
</body>
</html>