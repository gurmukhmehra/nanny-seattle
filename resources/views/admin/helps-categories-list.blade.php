@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Helps Categories List</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="card-header pt-0">
                        <h4 class="card-title">Helps Categories List</h4>
                        <a href="{{URL::to('superadmin/help/categories/add')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Help Category
                        </a> 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>ID</th>                                    
                                    <th>Category Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($helps_Cats_list as $cat)
                                    <tr>
                                        <td style="font-size:14px;">{{$cat->id}}</td>
                                        <td style="font-size:14px;">{{$cat->category_title}}</td>                                        
                                        <td style="font-size:14px;">{{$cat->created_at}}</td>
                                        <td style="font-size:14px;">
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </td>                                       
                                    </tr>
                                @endforeach
                            </tbody>                           
                        </table>
                        {!! $helps_Cats_list->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection