@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Users list</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="card-header pt-0">
                        <h4 class="card-title">Users List</h4>
                        <a href="{{URL::to('superadmin/add-user')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add User
                        </a> 
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Mobile</th>
                                    <!-- <th>Status</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center" style="font-size:14px;">
                                            <a href="{{URL::to('superadmin/user/view/'.$user->id)}}" style="color:#2f4cdd;">
                                                {{$user->username}}
                                            </a>
                                        </td>
                                        <td class="text-center" style="font-size:14px;">
                                            @if($user->role=='admin')
                                                <span class="text-success">{{$user->role}}</span>
                                            @else 
                                                <span class="text-info">{{$user->role}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="font-size:14px;">{{$user->name}}</td>
                                        <td class="text-center" style="font-size:14px;">{{$user->email}}</td>
                                        <td class="text-center" style="font-size:14px;">
                                            <!-- <a class="text-danger showPassword" data-id="{{$user->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a> -->
                                            @if(!empty($user->user_password))
                                                {{$user->user_password}}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td class="text-center" style="font-size:14px;">
                                            @if(!empty($user->mobile))
                                                {{$user->mobile}}
                                            @else 
                                                Null
                                            @endif
                                        </td>
                                        <!-- <td style="font-size:14px;">
                                            @if(!empty($user->status==0))
                                                <span class="text-danger">Un-active</span>
                                            @else 
                                                <span class="text-danger">Active</span>
                                            @endif
                                        </td> -->
                                        <td class="text-center" style="font-size:14px;">
                                            <div class="d-flex">
                                                <a href="{{URL::to('superadmin/user/view/'.$user->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Mobile</th>
                                    <!-- <th>Status</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                        {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection

<!-- @push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".showPassword").on('click', function(event){
                console.log('test', $(this).data('id'));
            });
        });
    </script>
@end('scripts') -->