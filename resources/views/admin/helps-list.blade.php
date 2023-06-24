@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Helps List</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="card-header pt-0">
                        <h4 class="card-title">Helps List</h4>
                        <a href="{{URL::to('superadmin/helps/add')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Help
                        </a> 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>ID</th>                                    
                                    <th>Post Name</th>
                                    <th>Post Content</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($helps_list as $help)
                                    @php 
                                        $cateName = DB::table('helps_categories')->where('id',$help->help_category)->first();
                                    @endphp
                                    <tr>
                                        <td style="font-size:14px;">{{$help->id}}</td>
                                        <td style="font-size:14px;">{{$help->post_title}}</td>                                        
                                        <td style="font-size:14px;">{!! Str::of($help->post_content)->words(10, '...') !!}</td>                                        
                                        <td style="font-size:14px;">
                                            @if(!empty($help->help_category))
                                                {{$cateName->category_title}}
                                            @else
                                                Null
                                            @endif    
                                        </td>
                                        <td style="font-size:14px;">
                                            @if(!empty($help->post_status=='publish'))
                                                <span class="text-success">{{$help->post_status}}</span>
                                            @else 
                                                <span class="text-danger">{{$help->post_status}}</span>
                                            @endif
                                        </td> 
                                        <td style="font-size:14px;">{{$help->created_at}}</td>
                                        <td style="font-size:14px;">
                                            <div class="d-flex">
                                                <a href="{{ URL::to('/superadmin/helps/'.$help->post_name) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </td>                                       
                                    </tr>
                                @endforeach
                            </tbody>                           
                        </table>
                        {!! $helps_list->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection