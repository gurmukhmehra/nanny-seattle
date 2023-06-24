@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add New Job</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0">
                        <h5 class="card-title">Add New Job</h5>
                        <a href="{{URL::to('superadmin/jobs')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Jobs List
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

                    {{ Form::open(array('url' => 'superadmin/jobs/add-job' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Job Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="job_title" required value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Job ID<sup class="text-danger">*</sup></label>
                                <input type="text" name="job_id" required value="" class="form-control">
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Location<sup class="text-danger">*</sup></label>
                                <input type="text" name="jobLocatin" required value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Ideal Start Date<sup class="text-danger">*</sup></label>
                                <input type="text" name="IdealStartDate" required value="" class="form-control">
                            </div>
                        </div> 
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Schedule<sup class="text-danger">*</sup></label>
                                <input type="text" name="jobSchedule" required value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Child<sup class="text-danger">*</sup></label>
                                <input type="text" name="children" required value="" class="form-control">
                            </div>
                        </div> 

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Compensation<sup class="text-danger">*</sup></label>
                                <input type="text" name="compensation" required value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Minimum Commitment <sup class="text-danger">*</sup></label>
                                <input type="text" name="jobExperience" required value="" class="form-control">
                            </div>
                        </div> 

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Must Be Legally Authorized <sup class="text-danger">*</sup></label>
                                <input type="text" name="legally_authorized_state" required value="" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">The Family<sup class="text-danger">*</sup></label>
                                <textarea name="AboutFamily" required class="form-control ckeditor"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Job Description<sup class="text-danger">*</sup></label>
                                <textarea name="jobDescription" required class="form-control ckeditor"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Attributes/Qualifications/Requirements<sup class="text-danger">*</sup></label>
                                <textarea name="Qualification_Requirement" required class="form-control ckeditor"></textarea>
                            </div>
                        </div>

                        <div class="row mt-4">                            
                            <div class="form-group col-md-6">
                                <label class="col-md-3 col-form-label" style="color:#333;">Status</label>
                                <select class="form-control" name="status">
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft </option>
                                    <option value="disabled">Disabled </option>                                  
                                </select>
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
