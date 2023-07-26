@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>INVOICES</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-9">
                        <form><input type="text" placeholder="Request No. here..." id="searchBar" class="form-control"></form>
                    </div>
                    <div class="col-3">
                        <button class="form-control btn btn-primary btn-lg" id="btnGet">Get</button>
                    </div>
                </div>
            </div>
            
            <div class="row layout-top-spacing">
                <div class="row invoice layout-top-spacing layout-spacing" id="invoiceBody">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        
                        <div class="doc-container">
                            
                            <div class="row">
                                
                                <div class="col-xl-9">
                                    
                                    <div class="invoice-container">
                                        <div class="invoice-inbox">
                                            
                                            <div id="ct" class="">
                                                
                                                <div class="invoice-00001">
                                                    <div class="content-section">
                                                        
                                                        <div class="inv--head-section inv--detail-section">
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <div class="d-flex">
                                                                        <img src="{{asset('assets/admin/src/assets/img/authLogo.png')}}" style="width: 100px;">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-sm-6 text-sm-end">
                                                                    <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4" id="invRequestNo"></p>
                                                                    <p class="inv-created-date mt-sm-5 mt-3" id="invDate"></p>
                                                                    <p class="inv-due-date" id="invTime"></p>
                                                                </div>                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="inv--detail-section inv--customer-detail-section">
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Blood To:</p>
                                                                </div>
                                                                
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name" id="invFullname">full name</p>
                                                                    <p class="inv-street-addr" id="invNic">NIC</p>
                                                                    <p class="inv-email-address" id="invEmail">email</p>
                                                                    <p class="inv-email-address" id="invTelephone">telephone</p>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="">
                                                                        <tr>
                                                                            <th scope="col">Request No.</th>
                                                                            <th scope="col">Bag No.</th>
                                                                            <th class="text-end" scope="col">Blood Group</th>
                                                                            <th class="text-end" scope="col">Expiry Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td id="invTableRequestNo"></td>
                                                                            <td id="invTableBagNo"></td>
                                                                            <td class="text-end" id="invTableBloodGroup"></td>
                                                                            <td class="text-end" id="invTableExpiryDate"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="inv--note">
                                                            
                                                            <div class="row mt-4">
                                                                <hr class="border border-darl">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                    <p id="staffMemberDetails"><b>STAFF MEMBER:</b> Name: &nbsp;&nbsp;
                                                                        Telephone: </p>
                                                                        <p>Thank you for using Life Saver Services.</p>
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
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    {{-- modal --}}
    
    
</div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        
        var publicURL = '';
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //retrieve data to html table
        $('#btnGet').click(function(){
            var searchInput = $('#searchBar').val();
                
            var customURL = '{{ url("admin/dashboard/getInvoice/:input") }}';
            customURL = customURL.replace(':input', searchInput);
                
            publicURL = customURL;
           
            
            getInvoice();
        });
        
        function getInvoice()
        {
            $.ajax({
                type:"GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    $.each(response.invoices,function(key,item){
                        
                     $('#invRequestNo').text('Request No.: '+item.requestNo);
                     $('#invDate').text('Date: '+item.date);
                     $('#invTime').text('Time: '+item.time);
                     
                     $('#invFullname').text(item.fullname);
                     $('#invNic').text(item.nic);
                     $('#invEmail').text(item.email);
                     $('#invTelephone').text(item.telephone);
                     
                     $('#invTableRequestNo').text(item.requestNo);
                     $('#invTableBagNo').text(item.bagNo);
                     $('#invTableBloodGroup').text(item.bloodGroup);
                     $('#invTableExpiryDate').text(item.expiryDate);

                       $('#staffMemberDetails').html('<p id="staffMemberDetails"><b>STAFF MEMBER:</b> Name: '+item.staffName+'&nbsp;&nbsp;\
                                                    Telephone: '+item.staffTelephone+'</p>');
                      
                    });
                }
            });
        }
    });
    
</script>
@endsection
