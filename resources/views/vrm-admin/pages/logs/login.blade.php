{{-- Extend the Layout --}}
@extends("$theme_dir.layouts.log")

@section('column_size', 'col-md-8 col-lg-6 col-xl-5')

{{-- Banner --}}
@section('banner')
    <h5 class="text-white font-size-20">{{ $site_name }}</h5>
    <p class="text-white-50 mb-0">Sign In</p>
@endsection

{{-- Content --}}
@section('content')
    <form action="{!! url($links->save) !!}" class="form-horizontal" method="post" accept-charset="utf-8"
        enctype="multipart/form-data" autocomplete="off">
        @csrf
        <!-- Notification -->
        {!! $notify !!}

        <div class="form-group">
            <label for="userlogname" class="sks-required">Email / Username</label>
            <input type="text" class="form-control @error('logname') is-invalid @enderror" id="logname" name="logname"
                value="{{ old('logname') }}" placeholder="Enter Email/Username">
            @error('logname')
                <span class="error">{{ $errors->first('logname') }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="userpassword" class="sks-required">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword"
                name="password" value="{{ old('password') }}" placeholder="Enter password">
            @error('password')
                <span class="error">{{ $errors->first('password') }}</span>
            @enderror
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remeber" name="remember" value="yes"
                @checked(old('remember', 'yes'))>
            <label class="custom-control-label" for="remeber">Remember me</label>
            <div class="col-12">
                @error('remember')
                    <span class="error">{{ $errors->first('remember') }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
        </div>

        <div class="mt-4 text-center">
            <a href="#" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your
                password?</a>
        </div>
    </form>
@endsection
