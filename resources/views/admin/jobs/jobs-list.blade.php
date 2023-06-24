@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Jobs list</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="card-header pt-0">
                        <h4 class="card-title">Jobs List</h4>
                        <a href="{{URL::to('superadmin/jobs/add-job')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Job
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
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="color:#000;">Job ID</th>
                                    <th style="color:#000;">Job Title</th>
                                    <th style="color:#000;">Location</th>
                                    <th style="color:#000;">Ideal Start Date</th>
                                    <th style="color:#000;">Status</th>
                                    <th style="color:#000;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td style="font-size:14px;">{{$job->job_id}}</td>
                                        <td style="font-size:14px;">{{$job->jobTitle}}</td>
                                        <td style="font-size:14px;">{{$job->jobLocatin}}</td>
                                        <td style="font-size:14px;">{{$job->IdealStartDate}}</td>
                                        <td style="font-size:14px;">
                                            <input type="hidden" id="jobid{{$job->id}}" value="{{encrypt($job->id)}}"/>
                                            <select class="form-control" id="changeJobStatus{{$job->id}}" name="status">
                                                <option value="publish"  @if($job->status=='publish') selected @endif>Publish</option>
                                                <option value="draft" @if($job->status=='draft') selected @endif>Draft </option>
                                                <option value="disabled" @if($job->status=='disabled') selected @endif>Disabled </option>                                 
                                            </select>
                                            <p class="response_text{{$job->id}}"></p>
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>                                            
                                            <script>
                                                $(document).on('change', '#changeJobStatus{{$job->id}}', function() {                                                    
                                                    $.ajax({
                                                        type: 'GET',
                                                        url : "{{ url('superadmin/job/update-job-status') }}",
                                                        data : {
                                                            jobID : $('#jobid{{$job->id}}').val(),
                                                            statusVa: $(this).val()
                                                        },
                                                        beforeSend: function(data){
                                                            $('.response_text{{$job->id}}').text('wait..').css('color','red');
                                                        },
                                                        success:function(data){                                                            
                                                            $('.response_text{{$job->id}}').text(data.statusUpdated).css('color','green');
                                                            setTimeout(function() {
                                                                $('.response_text{{$job->id}}').text('');                                                                
                                                            }, 3000);                                                            
                                                        }
                                                    });
                                                });
                                            </script>  
                                        </td>                                     
                                        <td style="font-size:14px;">
                                            <div class="d-flex">
                                                <a href="{{ URL::to('superadmin/jobs/'.$job->jobSlug) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ URL::to('superadmin/jobs/delete/'.$job->id) }}" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="color:#000;">Job ID</th>
                                    <th style="color:#000;">Job Title</th>
                                    <th style="color:#000;">Location</th>
                                    <th style="color:#000;">Ideal Start Date</th>
                                    <th style="color:#000;">Status</th>
                                    <th style="color:#000;">Action</th>
                                </tr>
                            </thead>
                        </table>
                        {!! $jobs->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection