@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Groups List</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0">
                        <h4 class="card-title">Groups List</h4>
                        <!--a href="{{URL::to('superadmin/groups/add')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Group
                        </a--> 
                    </div>
                                  
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="color:#000;" class="text-center">Image</th>
                                    <th style="color:#000;" class="text-center">Group Name</th>
                                    <th style="color:#000;" class="text-center">Description</th>
                                    <th style="color:#000;" class="text-center">Status</th>
                                    <th style="color:#000;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($groups)>0)
                                    @foreach($groups as $group)                                
                                        <tr>                  
                                            <td class="text-center" style="font-size:14px;">
                                                @if(!empty($group->groupImage))
                                                    <img src="{{ URL::asset('/uploads/groupsImages/'.$group->groupImage) }}" width="100px" alt="{{$group->groupName}}"/>
                                                @else 
                                                    <img src="{{ URL::asset('/uploads/groupsImages/baby-care.JPG') }}" width="100px" alt="{{$group->groupName}}"/>
                                                @endif
                                            </td>
                                            <td class="text-center" style="font-size:14px;">{{$group->groupName}}</td>
                                            <td class="text-center" style="font-size:14px;">{!! Str::of($group->groupDescription)->words(10, '...') !!}</td>
                                            <td class="text-center" style="font-size:14px;">
                                                @if($group->groupStatus=='Active')
                                                    <span class="text-success">{{$group->groupStatus}}</span>
                                                @else
                                                    <span class="text-danger">{{$group->groupStatus}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="font-size:14px;">
                                                <div class="d-flex">
                                                    <a href="{{ URL::to('superadmin/groups/'.$group->groupSlug) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else 
                                <tr>
                                    <td class="text-center text-danger pt-4" colspan="4">Data not found..</td>
                                </tr>
                                @endif                               
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="color:#000;" class="text-center">Image</th>
                                    <th style="color:#000;" class="text-center">Group Name</th>
                                    <th style="color:#000;" class="text-center">Description</th>
                                    <th style="color:#000;" class="text-center">Status</th>
                                    <th style="color:#000;" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>                        
                    </div>
                    {!! $groups->withQueryString()->links('pagination::bootstrap-5') !!}                   
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection