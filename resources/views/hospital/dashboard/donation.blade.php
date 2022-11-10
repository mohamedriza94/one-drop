@extends('hospital.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>DONATIONS</b></h3>
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
                                            <th scope="col"><b>Donation No.</b></th>
                                            <th scope="col">Donor No.</th>
                                            <th scope="col">Blood Group</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                    </thead>
                                    
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

    setInterval(function(){
        fetchDonation();
    }, 100);

    function fetchDonation()
    {
        var url = '{{ url("hospital/dashboard/fetchDonation") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.donations,function(key,item){

                    var date_str = item.date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.time;
                    var time_str = time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.donationNo+'</b></td>\
                        <td>'+item.donorNo+'</td>\
                        <td class="text-danger"><strong>'+item.bloodGroup+'</strong></td>\
                        <td>'+date_str+'</td>\
                        <td>'+time_str+'</td>\
                        </tr>\
                        ');
                });
            }
        });
    }
});
</script>
@endsection
