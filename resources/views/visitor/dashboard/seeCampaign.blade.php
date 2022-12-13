@extends('visitor.layouts.master')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">CAMPAIGN</h3>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered" id="campaignBlockWhite">
                        <div class="card-inner card-inner-xl" id="campaignBlockTransparent">
                            <article class="entry" >
                                <h3 style="color:rgb(152, 45, 253);">{{ $campaigns->title }}</h3>
                                <img style="border-radius:10px;" src="{{ $campaigns->thumbnail }}" alt="">
                                <div class="d-flex justify-content-start" style="margin-top: 10px;">
                                    <span class="btn btn-outline-light me-1">FROM</span>
                                    <span class="btn btn-dark me-1">{{ $campaigns->startDate }}</span>
                                    <span class="btn btn-outline-light me-1">TO</span>
                                    <span class="btn btn-danger me-1">{{ $campaigns->endDate }}</span>
                                </div>
                                <div class="d-flex justify-content-start align-items-center" style="margin-top: 10px;">
                                    <span class="btn btn-primary me-1">TAGS &nbsp;<em class="icon ni ni-tags-fill"></em></span>
                                    @foreach ($campaignTags as $campaignTag)
                                    <span class="btn btn-light me-1">{{ $campaignTag['tag'] }}</span>
                                    @endforeach
                                    
                                </div>
                                <hr>
                                <input type="hidden" id="descInput" value="{{ $campaigns->description }}">
                                <input type="hidden" id="noInput" value="{{ $campaigns->no }}">
                                
                                <p id="desc"></p>
                            </article>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-xl">
                            <article class="entry">
                                <h3>Works</h3>
                                <div class="row g-gs" id="worksBlock">
                                    
                                    @foreach ($photos as $photo)
                                    <div class="col-lg-3">
                                        <div class="card card-bordered">
                                            <a class="gallery-image popup-image" href="{{ $photo->photo }}">
                                                <img class="card-img-top" src="{{ $photo->photo }}" alt="{{ $photo->caption }}">
                                            </a>
                                            
                                            <p class="card-text p-1">{{ $photo->caption }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </article>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                
                
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-xl">
                            <a class="btn btn-dark" id="" data-bs-toggle="modal"
                            data-bs-target="#becomeADonorModal">Participate</a>
                            <button class="btn btn-outline-primary" id="btnShare">Share Campaign Link</button>
                            <a class="btn btn-outline-danger" id="btnDownloadWhite"><em class="icon ni ni-download"></em>&nbsp; White Poster</a>
                            <a class="btn btn-outline-danger" id="btnDownloadTransparent"><em class="icon ni ni-download"></em>&nbsp; Transparent Poster</a>
                            <a class="btn btn-outline-danger" id="btnDownloadWorks"><em class="icon ni ni-download"></em>&nbsp; Works</a>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
@section('scripts')
<script>
    $(document).ready(function() {
        
        var description = $('#descInput').val();
        var no = $('#noInput').val();
        $('#desc').html(description);
        
        $(document).on('click', '#btnShare', function(e) {
            e.preventDefault();
            navigator.clipboard.writeText(window.location.href);;
            
            $(this).removeClass('btn-outline-primary');
            $(this).addClass('btn-success');
            $(this).text('Copied Link To Clipboard');
            
            setTimeout(() => {
                $(this).addClass('btn-outline-primary');
                $(this).removeClass('btn-success');
                $(this).text('Share Campaign Link');
            }, 3000);
        });
        
        //download campaign image white{
            var elementWhite = $("#campaignBlockWhite"); // global variable
            var getCanvasWhite; //global variable
            html2canvas(elementWhite, {
                onrendered: function (canvas) {
                    getCanvasWhite = canvas;
                }
            });
            
            $("#btnDownloadWhite").on('click', function () {
                var imageData = getCanvasWhite.toDataURL("image/png");
                //Now browser starts downloading it instead of just showing it
                var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#btnDownloadWhite").attr("download", no+"_white.png").attr("href", newData);
            });
            //}
            
            //download campaign image transparent{
                var elementTransparent = $("#campaignBlockTransparent"); // global variable
                var getCanvasTransparent; //global variable
                html2canvas(elementTransparent, {
                    onrendered: function (canvas) {
                        getCanvasTransparent = canvas;
                    }
                });
                
                $("#btnDownloadTransparent").on('click', function () {
                    var imageData = getCanvasTransparent.toDataURL("image/png");
                    //Now browser starts downloading it instead of just showing it
                    var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $("#btnDownloadTransparent").attr("download", no+"_Transparent.png").attr("href", newData);
                });
                //}
                
                //download campaign image works block{
                    var elementWorks = $("#worksBlock"); // global variable
                    var getCanvasWorks; //global variable
                    html2canvas(elementWorks, {
                        onrendered: function (canvas) {
                            getCanvasWorks = canvas;
                        }
                    });
                    
                    $("#btnDownloadWorks").on('click', function () {
                        var imageData = getCanvasWorks.toDataURL("image/png");
                        //Now browser starts downloading it instead of just showing it
                        var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
                        $("#btnDownloadWorks").attr("download", no+"_works.png").attr("href", newData);
                    });
                    //}
                    });
                </script>
                @endsection
