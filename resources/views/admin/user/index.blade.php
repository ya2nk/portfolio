@extends('admin.layout.base')

@section('head-title')
<title>Profile User</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>Profile User</span></li>
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
                        <div class="col-lg-6 col-md-6">
                            <a href="{{ route('user.changepassword') }}"
                                class="btn btn-primary float-right">Change Password</a>
                        </div>
                    </div>

                <hr>

                <form action="{{ route('user.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="username">
                                <h5>Change Username</h5>
                                <div class="form-group">
                                    <label for="username">NEW USERNAME</label>
                                    <input id="username" type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $user->username) }}" placeholder="Entry new username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="name">
                                <h5>Change Name</h5>
                                <div class="form-group">
                                    <label for="name">NEW NAME</label>
                                    <input id="name" type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" placeholder="Entry new name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="email">
                                <h5>Change Email</h5>
                                <div class="form-group">
                                    <label for="email">NEW EMAIL</label>
                                    <input id="email" type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" placeholder="Entry new email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="col-lg-6 col-md-6">

                            <div class="form-group">
                                <h5>Change Avatar</h5>
                                <label for="avatar">NEW AVATAR</label>
                                <div style="background-color: #0e1726;" class="card col-lg-6 col-md-6 text-center">
                                    <div class="card-body">
                                        <img id="avatarView" src="{{ asset('upload/user/'.$user->avatar) }}" alt="your avatar"
                                            width="150px" class="rounded">
                                    </div>
                                </div>
                                <input type="file" id="avatarInput" name="avatar"
                                    class="form-control-file mt-4 @error('avatar') is-invalid @enderror" accept="image/*">
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- <div class="password">
                                <h5>Change Password</h5>
                                <div class="form-group">
                                    <label for="password">NEW PASSWORD</label>
                                    <input id="password" type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" placeholder="Entry new password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">CONFIRM NEW PASSWORD</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}" placeholder="Entry new password confirm">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div> --}}
                            <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
                        </div>

                       

                        
                    </div>
                </form>

            </div>
        </div>
    </div>




</div>
@endsection

@push('js-external')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatarView').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatarInput").change(function () {
        readURL(this);
    });

    $(".placeholder").select2({
        placeholder: "Make a Selection",
        allowClear: true
    });

</script>
@endpush