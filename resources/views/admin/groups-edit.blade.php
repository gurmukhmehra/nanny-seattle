@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{URL::to('superadmin/groups')}}">Groups List</a></li>
                <li class="breadcrumb-item active">{{$groupDetail->groupName}}</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0">
                        <h4 class="card-title">Edit Groups</h4>
                        <a href="{{URL::to('superadmin/groups')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Groups List
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
                    {{ Form::open(array('url' => 'superadmin/groups/'.$groupDetail->groupSlug , 'enctype' =>'multipart/form-data')) }}
                        <input type="hidden" name="id" value="{{encrypt($groupDetail->id)}}" class="form-control">
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label text-dark text-right">Group Name <sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input type="text" name="groupName" required value="{{$groupDetail->groupName}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label text-dark text-right">Group Description</label>
                            <div class="col-md-8">
                                <textarea name="groupDescription" class="form-control ckeditor">{{$groupDetail->groupDescription}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label text-dark text-right">Image</label>
                            <div class="col-md-4">
                                <input type="file" name="groupImage" class="form-control"/>
                            </div>
                            <div class="col-md-5">
                                @if(!empty($groupDetail->groupImage))
                                    <img src="{{ URL::asset('/uploads/groupsImages/'.$groupDetail->groupImage) }}" width="300px" alt="{{$groupDetail->groupName}}"/>
                                @else 
                                    <img src="{{ URL::asset('/uploads/groupsImages/baby-care.JPG') }}" width="300px" alt="{{$groupDetail->groupName}}"/>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right"></label>
                            <div class="col-md-8">
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.ckeditor').ckeditor();
        });       
    </script>
@endpush('scripts')