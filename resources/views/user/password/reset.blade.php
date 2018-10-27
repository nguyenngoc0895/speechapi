@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="current-password" class="col-md-4 col-form-label text-md-right">{{ __('Password Current') }}</label>
                            <div class="col-md-6">
                                <input type="password" name="current-password" id="current-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span id="checkPassword"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" name="new-password" id="new-password" class="form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }}" required>
                                @if ($errors->has('new-password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
                                <span id='message'></span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
    console.log( "ready!" );
    //check confirm password
    $('#new-password, #password_confirm').keyup(function () {
        if ($('#new_password').val() == $('#password_confirm').val()) {
            $('#message').html('Password is Matching').css('color', 'green');
        } else 
            $('#message').html('Password is not Matching').css('color', 'red');
    });
});
</script>
@endsection
