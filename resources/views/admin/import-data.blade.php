@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Import Data</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <h4>Choose what to import</h4>
                    <small><b>Note : if you want import , <span class="text-danger">first select All users option</span> then import other data. </b></small>
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input importsData" checked value="{{encrypt('usersData')}}" name="importOption">All Users
                        </label>
                    </div>
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input importsData" value="{{encrypt('usersSubscribersPlans')}}" name="importOption">Users Subscribers Plans
                        </label>
                    </div>                    
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input importsData" value="{{encrypt('MembsersFriendsList')}}" name="importOption">Membsers Friends List
                        </label>
                    </div>
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input importsData" value="{{encrypt('MembsersPrivateMessages')}}" name="importOption">Membsers Private Messages
                        </label>
                    </div>
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input importsData" value="{{encrypt('memberReviews')}}" name="importOption"> Reviews
                        </label>
                    </div>
                    <button class="btn btn-info importData mt-3">Import</button>
                    <p class="mt-3 text-success importStatus" style="display:none;"></p>
                    <p class="mt-3 text-success loader_text" style="display:none;"><span class="spinner-border"></span> wait..</p>
                    <p class="mt-3 text-danger errorSelect" style="display:none;"> Please Choose option.</p>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $(".importData").click(function(){
                var inputVal = $('input[name="importOption"]:checked').val();
                if(inputVal){
                    $(".loader_text").css('display','block');
                    $(".importData").css('display','none');
                    $.ajax({
                        url : "{{ url('superadmin/importData') }}",
                        data : 'inputData='+inputVal,
                        success : function(data){
                            if(data.dataimport){
                                $(".loader_text").css('display','none');
                                $(".importStatus").css('display','block');
                                $(".importStatus").text(data.dataimport);
                                setTimeout(function() {
                                    $(".importStatus").text('');
                                    $(".importStatus").css('display','none');
                                    $(".importData").css('display','block');
                                }, 3000);
                            }
                        }
                    });
                } else {
                    $(".errorSelect").css('display','block');
                    setTimeout(function() {
                        $(".errorSelect").css('display','none')
                    }, 3000);
                }
                                
            });
        });
    </script>
@end('scripts')