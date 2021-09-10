@extends('admin.layout.base')

@section('head-title')
<title>Profile User</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span>Profile User</span></li>
<li class="breadcrumb-item active" aria-current="page"><span>Change Password</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget widget-content-area br-4">
            <div class="widget-one">

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3><strong>Profile {{ Auth::user()->name }}</strong></h3>
                    </div>
                </div>
                <hr>
                <form action="{{ route('user.updatepassword') }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="password">
                        <h5>Change Password</h5>
                        <div class="form-group">
                            <label for="current_password">CURRENT PASSWORD</label>
                            <input id="current_password" type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" placeholder="Entry new password" autocomplete="current_password">
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">NEW PASSWORD</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="Entry new password" autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">CONFIRM NEW PASSWORD</label>
                            <input id="password-confirm" type="password" name="password_confirmation"
                                class="form-control @error('password-confirm') is-invalid @enderror"
                                value="{{ old('password-confirm') }}" placeholder="Entry new password confirm"
                                autocomplete="new-password">
                            @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection