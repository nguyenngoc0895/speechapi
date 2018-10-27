@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Acc: {{ Auth::user()->name }}</div>

                <div class="card-body">
                    <p><b>Name&nbsp;:&nbsp;</b>{{ $user->name}}</p>
                    <p><b>Email-Address&nbsp;:&nbsp;</b>{{ $user->email}}</p>
                    <p><b>Address&nbsp;:&nbsp;</b>{{ $user->address}}</p>
                    <p><b>Phone Number&nbsp;:&nbsp;</b>{{ $user->phone_number}}</p>
                    <a href="{{ route('profile.edit', $user->id)}}" type="button" class="btn btn-success" >Update Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
