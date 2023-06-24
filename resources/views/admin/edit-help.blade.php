@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/helps')}}">Helps List</a></li>
                <li class="breadcrumb-item active">{{$helpDetail->post_title}}</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0 pl-0">
                        <h5 class="card-title">Edit : <span style="font-size: 15px;">{{$helpDetail->post_title}}</span></h5>
                        <a href="{{URL::to('superadmin/helps')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Helps List
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

                    {{ Form::open(array('url' => 'superadmin/helps/'.$helpDetail->post_name , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        <input type="hidden" name="id" value="{{encrypt($helpDetail->id)}}" class="form-control">
                        <div class="row mt-4"> 
                            <div class="col-md-6">                           
                             <label style="color:#333;">Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="post_title" required value="{{$helpDetail->post_title}}" class="form-control">
                            </div>
                            <div class="col-md-6">                           
                             <label style="color:#333;">Category</label>
                                <select class="form-control" name="help_category">
                                    @foreach($helpCats as $helpCat)
                                        <option value="{{$helpCat->id}}" @if($helpCat->id==$helpDetail->help_category) selected @endif>{{$helpCat->category_title}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Description<sup class="text-danger">*</sup></label>
                                <textarea name="post_content" required class="form-control ckeditor">{{$helpDetail->post_content}}</textarea>
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.ckeditor').ckeditor();
        });       
    </script>
@endpush('scripts')
