@extends('visitor.layouts.master')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">NEWS AND UPDATES</h3>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs" id="newsCards">

                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="readMoreModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em
                    class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <div class="mt-2">
                    <div class="row g-gs">
                        <div class="col 12">
                            <div class="gallery-image">
                                <img class="w-100 rounded-top" id="thumbnail" src="" alt="">
                            </div>
                            <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                <div class="user-card">
                                    <div class="">
                                        <p class="text-primary" id="lastUpdatedDate"></p>
                                        <h5 class="text-dark" id="title"></h5>
                                        <div id="description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- makeRequestModal modal -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        fetchNewsAndUpdates();

        function fetchNewsAndUpdates()
        {
            var url = '{{ url("visitor/dashboard/fetchNewsAndUpdates") }}';

            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#newsCards').html('');
                    $.each(response.newsandupdates,function(key,item){

                    var title_str = item.title;
                    var title_str = title_str.slice(0, 10)+'...'; 
                    
                    var description_str = item.description;
                    var description_str = description_str.slice(0, 150)+'...'; 

                    var updated_at_str = item.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('#newsCards').append('<div class="col-sm-6 col-lg-4">\
                            <div class="gallery card card-bordered">\
                                <div class="gallery-image">\
                                    <img class="w-100 rounded-top" src="'+item.thumbnail+'" alt="">\
                                </div>\
                                <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">\
                                    <div class="user-card">\
                                        <div class="">\
                                            <h5 class="text-dark">'+title_str+'</h5>\
                                            <p>'+description_str+'</p>\
                                            <button class="btn btn-dark" id="btnReadMore" value="'+item.id+'" data-bs-toggle="modal"\
                                        data-bs-target="#readMoreModal">Read More</button></br></br>\
                                            <p class="text-primary">Last updated on '+updated_at_str+'</p>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        ');
                        });
                    }
                });
        }

        //read more news
        $(document).on('click', '#btnReadMore',function(e){
         e.preventDefault();
         var id = $(this).val();

         var url = '{{ url("visitor/dashboard/fetchSingleNews/:id") }}';
         url = url.replace(':id', id);

         $.ajax({
           type:"GET", url:url,
            success: function (response){
                if(response.status==404){
                    alert('Post Does Not Exist')
                }else{
                    $('#title').text(response.newsandupdates.title);
                    $('#description').html(response.newsandupdates.description);
                    $('#thumbnail').attr("src",response.newsandupdates.thumbnail);

                    var updated_at_str = response.newsandupdates.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('#lastUpdatedDate').text('Last updated on '+updated_at_str);
                }
            }
            });
        });
    });
</script>
@endsection
