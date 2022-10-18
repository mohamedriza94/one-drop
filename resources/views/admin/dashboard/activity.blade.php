@extends('admin.layouts.master')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="header layout-top-spacing">
                <h3 class=""><b>ACTIVITIES</b></h3>
                <hr>
            </div>
            
            <div class="row layout-top-spacing">
                    <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>Admin</b></th>
                                            <th scope="col"><b>Photo</b></th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                    </thead>

                        <input type="hidden" class="form-control" id="change_status_id" name="change_status_id">

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        
</div>

</div>

</div>
</div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    //csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //retrieve data to html elements
    setInterval(function(){
        fetchActivities();
    }, 1000);

    //fetch data function
    function fetchActivities()
    {
        $.ajax({
            type:"GET",
            url:'{{ url("admin/dashboard/fetchActivities") }}',
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.activities,function(key,item){
                    
                    var activity_date_str = item.date;
                    var activity_date_str = activity_date_str.slice(0, 10); 

                    var activity_time_str = item.time;
                    var activity_time_str = activity_time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.user_id+'</b></td>\
                        <td><img style="width:50px;" id="adminPhoto" src="'+item.photo+'" alt=""></td>\
                        <td>'+item.task+'</td>\
                        <td>'+activity_date_str+'</td>\
                        <td>'+activity_time_str+'</td>\
                        </tr>\
                        ');
                });
            }
        });
    }
    
});
</script>
@endsection

