@extends('user.layouts.login_before')

@section('title','Signup page')

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card  shadow bg-white rounded">
                    <div>
                        <div class="login-main">
                            <form action="{{ route('dosignup') }}" method="POST" id="signup_form" name="signup_form"
                                class="theme-form">
                                @csrf
                                <h4>Register Account</h4>
                                <div class="form-group">
                                    <label class="col-form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstname" name="firstname"
                                        placeholder="First Name" required>
                                    @if ($errors->has('firstname'))
                                        <span class="text-danger invalid">{{ $errors->first('firstname') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" id="lastname" name="lastname"
                                        placeholder="Last Name" required>
                                    @if ($errors->has('lastname'))
                                        <span class="text-danger invalid">{{ $errors->first('lastname') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Test@gmail.com" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Mobile No</label>
                                    <input class="form-control" type="text" id="mobile" name="mobile"
                                        placeholder="9*******" required>
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger invalid">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        value="" placeholder="*********" required>
                                    <div class="show-hide"><span class="show"> </span></div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary mt-3" type="submit">Signup</button>
                                </div>

                                <br>
                                <a href="{{route("login")}}"> Login </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#password').keyup(function() {
            if (jQuery.trim($("#password").val()).length == 0) {
                this.value = $.trim(this.value);
            }
        })
        $('#email').keyup(function() {
            if (jQuery.trim($("#password").val()).length == 0) {
                this.value = $.trim(this.value);
            }
        })

        $("form[name='signup_form']").on('submit', function(e) {
            e.preventDefault();
        }).validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                firstname: {
                    required: "First name is required",
                },
                lastname: {
                    required: "Last name is required",
                },
                email: {
                    required: "Email is required",
                },
                mobile: {
                    required: "Mobile no is required",
                },
                password: {
                    required: "Password is required",
                },
            },
            submitHandler: function(form) {
                var form_data = $(form).serialize();
                $("#signup_form button[type='submit']").attr('disabled', true);
                $.ajax({
                    url: $(form).attr("action"),
                    type: 'post',
                    data: form_data,
                    beforeSend: function() {
                        $(".loader").show();
                    },
                    complete: function() {
                        $(".loader").hide();
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = base_url + '/';
                            $.notify(response.message, {
                                type: 'success'
                            });
                        } else if (!response.success) {
                            $.notify(response.message, {
                                type: 'danger'
                            });
                        } else {
                            $.notify('Something went wrong', {
                                type: 'danger'
                            });
                        }
                    },
                    fail: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            $.notify(item, {
                                type: 'danger'
                            });
                        });

                    }
                });

                $("#signup_form button[type='submit']").attr('disabled', false);
            }
        });
    </script>
@endsection
