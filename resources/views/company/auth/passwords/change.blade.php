@extends('layouts.company.app')

@section('content')
            <!-- Sign Up Window Code -->
            <!-- Title Header Start -->
            <section class="login-plane-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif                      
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('auth.Change password page')</h3>
                                </div>
                                <div class="panel-body">
                                    <p>&nbsp;</p>
                                      <form method="POST" action="{{ route('company.password.change') }}" novalidate>
                                         @csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <input id="oldpassword" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Old password')" name="oldpassword" type="password" value="{{ old('oldpassword') }}" required autofocus>
                                                @if ($errors->has('oldpassword'))
                                                <span class="invalid-feedback" style="color:#ff0000;text-align:center;">
                                                    <strong>{{ $errors->first('oldpassword') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="newpassword" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" data-toggle="password" name="newpassword" value="{{ old('newpassword') }}" data-placement="after" class="form-control" type="password" placeholder="@lang('auth.New password')" data-eye-class="material-icons" data-eye-open-class="visibility" data-eye-close-class="visibility_off" data-eye-class-position-inside="true" required>
                                                @if ($errors->has('newpassword'))
                                                <span class="invalid-feedback" style="color:#ff0000;text-align:center;">
                                                    <strong>{{ $errors->first('newpassword') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Confirm new password')" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required>
                                                @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" style="color:#ff0000;text-align:center;">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                @endif
                                            </div>                                                                                        
                                            <!-- Change this to a button or input when using this as a form -->
                                            <input type="submit" value="@lang('auth.Change Password')" class="btn btn-login" data-loading-text="Loading..."></br> 
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Sign Up Window -->
            
@endsection 
    @section('after_scripts')
        <script type="text/javascript">
            $('[data-attr="show-password"]').password({
                placement: 'before',
                eyeClass: 'material-icons',
                eyeOpenClass: 'visibility',
                eyeCloseClass: 'visibility_off',
                eyeClassPositionInside: true
            })
        </script>
    @endsection