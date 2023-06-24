@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Transactions List</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0 pl-0">
                        <h4 class="card-title">Transactions List</h4> 
                        <a href="{{URL::to('superadmin/transaction/add-new')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-exchange"></i> Add New
                        </a>                       
                    </div>
                    <div class="message">
                        @if(session()->has('deleteTransaction'))
                            <div class="alert alert-success">
                                {{ session()->get('deleteTransaction') }}
                            </div>
                        @endif                        
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="color:#000;text-align:center;">ID</th>
                                    <th style="color:#000;text-align:center;">Transaction</th>
                                    <th style="color:#000;text-align:center;">Subscription id</th>
                                    <th style="color:#000;text-align:center;">User</th>
                                    <th style="color:#000;text-align:center;">Product</th>
                                    <th style="color:#000;text-align:center;">Amount</th>                                    
                                    <th style="color:#000;text-align:center;">Status</th>
                                    <th style="color:#000;text-align:center;">Date</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach($transactions as $transaction) 
                                        @php
                                            $userDetail = DB::table('users')->where('id',$transaction->user_id)->first();
                                            $plans = DB::table('memberships')->where('id',$transaction->product_id)->first(); 
                                        @endphp                           
                                        <tr>
                                            <td style="font-size:14px;text-align:center;">{{$transaction->id}}</td>
                                            <td style="font-size:14px;text-align:center;">
                                                @if(!empty($transaction->trans_num))
                                                    {{$transaction->trans_num}}
                                                @else
                                                    Null 
                                                @endif
                                                <p>
                                                    <div class="d-inline">
                                                        <a href="{{ URL::to('superadmin/transaction/edit/'.$transaction->id) }}" class="text-info">Edit</a> | 
                                                        <a href="{{ URL::to('superadmin/transaction/delete/'.$transaction->id) }}" class="text-info" onclick="return confirm('Are you sure you want to delete this transaction?');">Delete</a>
                                                    </div>
                                                </p>
                                            </td>
                                            <td style="font-size:14px;text-align:center;">{{$transaction->subscription_id}}</td>
                                            <td style="font-size:14px;text-align:center;">{{$userDetail->username}}</td>
                                            <td style="font-size:14px;text-align:center;">{{$plans->post_title}}</td>
                                            <td style="font-size:14px;text-align:center;">${{$transaction->amount}}</td>                                    
                                            <td style="font-size:14px;text-align:center;">
                                                @if($transaction->status=='complete')
                                                    <span class="text-success">Complete</span>
                                                @else 
                                                    <span class="text-danger">Pending</span>
                                                @endif

                                            </td>
                                            <td style="font-size:14px;text-align:center;">{{ date('j F, Y', strtotime($transaction->created_at)) }}</td>
                                        </tr> 
                                    @endforeach                           
                                </tbody>
                            <thead>
                                <tr>
                                    <th style="color:#000;text-align:center;">ID</th>
                                    <th style="color:#000;text-align:center;">Transaction</th>
                                    <th style="color:#000;text-align:center;">Subscription id</th>
                                    <th style="color:#000;text-align:center;">User</th>
                                    <th style="color:#000;text-align:center;">Product</th>
                                    <th style="color:#000;text-align:center;">Amount</th>                                    
                                    <th style="color:#000;text-align:center;">Status</th>
                                    <th style="color:#000;text-align:center;">Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    {!! $transactions->withQueryString()->links('pagination::bootstrap-5') !!}  
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection