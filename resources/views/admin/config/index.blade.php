@extends('admin.layout.base')

@section('head-title')
<title>Configuration</title>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>Configuration</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget widget-content-area br-4">
            <div class="widget-one">

                <h3><strong>Configuration</strong></h3>

                <form action="{{ route('configuration.update', $config->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="logo">LOGO</label>
                                <div style="background-color: #0e1726;" class="card col-lg-6 col-md-6 text-center">
                                    <div class="card-body">
                                        <img id="LogoView" src="{{ asset('upload/config/'.$config->logo) }}" alt="your logo"
                                            width="100px" class="rounded">
                                    </div>
                                </div>
                                <input type="file" id="LogoInput" name="logo"
                                    class="form-control-file mt-4 @error('logo') is-invalid @enderror" accept="image/*">
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="icon">ICON</label>
                                <div style="background-color: #0e1726;" class="card col-lg-6 col-md-6 text-center">
                                    <div class="card-body">
                                        <img id="LogoView" src="{{ asset('upload/config/'.$config->icon) }}" alt="your logo"
                                            width="100px" class="rounded">
                                    </div>
                                </div>
                                <input type="file" id="IconInput" name="icon"
                                    class="form-control-file mt-4 @error('icon') is-invalid @enderror" accept="image/*">
                                @error('icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about">ABOUT</label>
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror"
                            rows="4">{{ $config->about }}</textarea>
                        @error('about')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">WEB DESCRIPTION</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="4">{{ $config->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <h6>Basic Information:</h6>
                            <hr />
                            <div class="form-group">
                                <label for="nameweb">COMPANY NAME</label>
                                <input id="nameweb" type="text" name="nameweb"
                                    class="form-control @error('nameweb') is-invalid @enderror"
                                    value="{{ $config->nameweb }}">
                                @error('nameweb')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">EMAIL</label>
                                <input id="text" type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $config->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">PHONE</label>
                                <input id="phone" type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ $config->phone }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                    rows="5">{{ $config->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <h6>Social network:</h6>
                            <hr />

                            <div class="form-group">
                                <label for="facebook">FACEBOOK</label>
                                <input id="facebook" type="text" name="facebook"
                                    class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ $config->facebook }}">
                                @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="instagram">INSTAGRAM</label>
                                <input id="instagram" type="text" name="instagram"
                                    class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ $config->instagram }}">
                                @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="twitter">TWITTER</label>
                                <input id="twitter" type="text" name="twitter"
                                    class="form-control @error('twitter') is-invalid @enderror"
                                    value="{{ $config->twitter }}">
                                @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="github">GITHUB</label>
                                <input id="github" type="text" name="github"
                                    class="form-control @error('github') is-invalid @enderror"
                                    value="{{ $config->github }}">
                                @error('github')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="linkedin">LINKEDIN</label>
                                <input id="linkedin" type="text" name="linkedin"
                                    class="form-control @error('linkedin') is-invalid @enderror"
                                    value="{{ $config->linkedin }}">
                                @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <h6>Modul SEO (Search Engine Optimization):</h6>
                            <hr>

                            <div class="form-group">
                                <label for="keywords">KEYWORDS (KEYWORD SEARCH FOR GOOGLE, BING, ETC)</label>
                                <textarea name="keywords" class="form-control @error('keywords') is-invalid @enderror"
                                    rows="4">{{ $config->keywords }}</textarea>
                                @error('keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <h6>Google Maps:</h6>
                            <hr>

                            <div class="form-group">
                                <label for="google_maps">GOOGLE MAPS</label>
                                <div class="maps mb-2">
                                    <div class="rounded"> {!! $config->google_maps !!}</div>
                                </div>
                                <textarea name="google_maps"
                                    class="form-control @error('google_maps') is-invalid @enderror"
                                    rows="5">{{ $config->google_maps }}</textarea>
                                @error('google_maps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 px-5 float-right">Save</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>




</div>
@endsection