@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/transactions')}}">Transactions List</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Transaction</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0 pl-0">
                        <h4 class="card-title">Transaction Edit : {{$TransactionDetail->id}}</h4> 
                        <a href="{{URL::to('superadmin/transactions')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-exchange"></i> Transactions
                        </a>                       
                    </div>  
                    <div class="message">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{ Form::open(array('url' => 'superadmin/transaction/update' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        <input type="text" name="id" readonly value="{{$TransactionDetail->id}}" class="form-control">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Transaction Number</label>
                                @if(!empty($TransactionDetail->trans_num))
                                    <input type="text" name="trans_num" readonly value="{{$TransactionDetail->trans_num}}" class="form-control">
                                @else 
                                    <input type="text" name="trans_num" readonly value="{{$trans_num}}" class="form-control">
                                @endif;
                                <small>A unique ID for this Transaction.</small>
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">User<sup class="text-danger">*</sup></label>
                                <input type="text" name="username" required value="{{$userData->username}}" class="form-control findUsername">
                                <small>The user who made this transaction.</small>                               
                                <div id="product_list"></div>                               
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Membership<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="product_id">
                                    @foreach($memberships as $membership)
                                        <option value="{{$membership->id}}" @if($TransactionDetail->product_id==$membership->id) selected @endif>{{$membership->post_title}}</option>
                                    @endforeach                                
                                </select>
                                <small>The membership that was purchased.</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label style="color:#333;">Sub-Total<sup class="text-danger">*</sup></label>
                                <input type="text" name="sub_total" required value="{{$TransactionDetail->total}}" class="form-control">
                                <small>The sub-total (amount before tax) of this transaction</small>
                            </div>
                            <div class="col-md-4">
                                <label style="color:#333;">Tax Amount<sup class="text-danger">*</sup></label>
                                <input type="text" name="tax_amount" required value="{{$TransactionDetail->tax_amount}}" class="form-control">
                                <small>The amount of taxes for this transaction</small>
                            </div>
                            <div class="col-md-4">
                                <label style="color:#333;">Tax Rate<sup class="text-danger">*</sup></label>
                                <input type="text" name="tax_rate" required value="{{$TransactionDetail->tax_rate}}" class="form-control">
                                <small>The tax rate in percentage. (Ex: 10.00 for 10%)</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Status<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="status">
                                    <option value="complete" @if($TransactionDetail->status=='complete') selected @endif>Complete</option>
                                    <option value="pending" @if($TransactionDetail->status=='pending') selected @endif>Pending</option>
                                    <option value="failed" @if($TransactionDetail->status=='failed') selected @endif>Failed</option>
                                    <option value="refunded" @if($TransactionDetail->status=='refunded') selected @endif>Refunded</option>                                  
                                </select>
                                <small>The current status of the transaction</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Gateway</label>
                                <select class="form-control" name="gateway">
                                    <option value="manual" @if($TransactionDetail->gateway=='manual') selected @endif>Manual</option>
                                    <option value="stripe" @if($TransactionDetail->gateway=='stripe') selected @endif>Stripe (Stripe) </option>                                
                                </select>
                                <small>The payment method associated with the transaction.</small>
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Subscription</label>
                                <input type="text" name="subscription_id" value="{{ $TransactionDetail->subscription_id ?? '0' }}" class="form-control">
                                <small>The optional subscription to associate this transaction with.</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Created (UTC/GMT)</label>
                                <input type="text" name="created_at" readonly value="{{ $TransactionDetail->created_at ?? $time_date_now }}" class="form-control">
                                <small>The date that the transaction was created on. This field is displayed in UTC/GMT.</small>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="default_time" value="{{$default_time}}" class="form-control default_time">
                                <label style="color:#333;">Expiration Date (UTC/GMT)</label>
                                <div class="row">
                                    <div class="col-md-6">                                        
                                        <input type="text" name="updated_at" value="" class="form-control updated_at">
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-default get_default_time" style="cursor:pointer;background-color:#fff;color: #2271b1;border: 1px solid #2271b1;margin-top: 6px;">Default</a>
                                        <a class="btn btn-default life_time" style="cursor:pointer;background-color:#fff;color: #2271b1;border: 1px solid #2271b1;margin-top: 6px;">Life Time</a>
                                    </div>
                                </div>                             
                                <small>The date that the transaction will expire. This is used to determine how long the user will have access to the membership until another transaction needs to be made. This field is displayed in UTC/GMT</small>
                                <p><small><b>Note:</b> Blank indicates a lifetime expiration.</small></p>
                            </div>
                        </div>
                        <hr> 
                        <div class="form-group row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>           
                    {{ Form::close() }}   
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection

@push('scripts')
    <script>
        $(".findUsername").on('keyup', function(event){
            if($(this).val().length>=3){
                var username = $(this).val();                
                $.ajax({
                    url : "{{ url('superadmin/findUsername') }}",
                    data : 'username='+username,
                    success : function(response){                  
                        if(response.userData!='') {
                            $('#product_list').html(response.userData);
                        } else {  
                            $('#product_list').html('');                          
                        }                                   
                    }
                });
            } else {
                $('#product_list').html(''); 
            }
        });
        $(document).on('click', '.clickUsername', function(){
            console.log('clcik');       
            var value = $(this).text();
            $('.findUsername').val(value);
            $('#product_list').html("");
        });

        $(".get_default_time").on('click', function(event){            
            var default_time = $('.default_time').val();
            $('.updated_at').val(default_time);
        }); 
        
        $(".life_time").on('click', function(event){            
            $('.updated_at').val('');
        });        
    </script>
@endpush