<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Superadmin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/public/assets/images/cropped-motherhood.png') }}">
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100" style="background-color:#B3ABAB47;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
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
                                    {{ Form::open(array('url' => 'superadmin')) }}
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username or Email</strong></label>
                                            <input type="text" name="email" class="form-control" value="" style="border:1px solid #ccc;"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" value="" style="border:1px solid #ccc;">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">                                            
                                            <div class="form-group">
                                                <a  class="openModel" href="" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                            <a href="{{URL::to('/')}}" class="btn btn-danger btn-block mt-3">Back to site</a>
                                        </div>
                                    {{ Form::close() }}                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------- Forgot Password Modal ------------------------------>
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="border-bottom: 1px solid #ccc;">
                            <h4 class="modal-title">Forgot Password</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>                        
                        <div class="modal-body" style="padding:1rem 1.875rem;">
                            <div class="form-group forgotFields">
                                <label class="mb-1">Username or Email <sup class="text-danger">*</sup></label>
                                <input type="text" name="usernameEmail" class="form-control usernameEmail" placeholder="Enter Username or Email..." value="" style="border:1px solid #ccc;"/>
                            </div>
                            <div class="form-group passwordFields" style="display:none;">
                                <label class="mb-1">New Password <sup class="text-danger">*</sup></label>
                                <input type="hidden" class="form-control usernameID" value=""/>
                                <input type="password" class="form-control userNewpassword" placeholder="Enter new password..." value="" style="border:1px solid #ccc;"/>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <button class="btn btn-info ResetPassword">Submit</button>
                                    <button class="btn btn-primary updatePassword" style="display:none;">Reset Password</button>
                                </div>
                                <div class="col-md-7">
                                    <p class="response"></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!----------------- End Forgot Password Modal -------------------------->
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('public/admin/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('public/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/deznav-init.js') }}"></script>
    <script>
        $(function() {   
            setTimeout(function() {
                $(".message").text('');
                $(".message").hide();
            }, 5000);
        });

        $(document).ready(function (e) {
            $(".openModel").click(function(){
                $('.forgotFields').css('display','block');
                $('.ResetPassword').css('display','block');
                $('.passwordFields').css('display','none');
                $('.updatePassword').css('display','none');
                $('.usernameID').val('');
                $('.usernameEmail').val('');                
                $('.response').text('').removeClass('text-danger');
            });
            $(".ResetPassword").click(function(){
                var usernameEmail = $('.usernameEmail').val();                
                if(!usernameEmail) {
                    $('.usernameEmail').addClass('border border-danger');                    
                } else {
                    $('.usernameEmail').removeClass('border border-danger');
                    $.ajax({
                        url : "{{ url('superadmin/ForgotPassword') }}",
                        data : 'inputData='+usernameEmail,
                        success : function(data){
                            //console.log(data.userName);
                            if(data.detailnotMatch){
                                $('.response').text(data.detailnotMatch).addClass('text-danger');
                                setTimeout(function() {
                                    $(".response").hide('blind', {}, 500)
                                }, 5000);
                            } else {
                                $('.response').text(data.detailMatch).removeClass('text-danger').addClass('text-success');
                                $('.usernameID').val(data.userName);
                                setTimeout(function() {
                                    $('.forgotFields').css('display','none');
                                    $('.ResetPassword').css('display','none');
                                    $('.passwordFields').css('display','block');
                                    $('.updatePassword').css('display','block');
                                    $('.response').text('');
                                }, 5000);
                            }
                            
                        }
                    });                                        
                }
            });

            $(".updatePassword").click(function(){
                var usernameID = $('.usernameID').val();
                var userNewpassword = $('.userNewpassword').val();
                if(!userNewpassword) {
                    $('.userNewpassword').addClass('border border-danger');
                } else {
                    $('.userNewpassword').removeClass('border border-danger');
                    $.ajax({
                        url : "{{ url('superadmin/ResetPassword') }}",
                        data : {usernameID:usernameID, userNewpassword:userNewpassword},
                        success : function(data){
                            if(data.passwordReset){
                                $('.userNewpassword').val('');
                                $('.usernameID').val('');
                                $('.response').text(data.passwordReset).addClass('text-success');
                                setTimeout(function() {                                    
                                    $('.response').text('');
                                    $("#myModal .close").click()
                                }, 5000);
                            }
                        }
                    });
                }
                
            });

        });        
        
    </script>
</body>

</html>