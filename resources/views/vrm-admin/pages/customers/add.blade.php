{{-- Extend the Layout --}}
@extends("$theme_dir.layouts.main")


{{-- Content --}}
@section('content')
    <form action="{!! url($links->save) !!}" class="form-horizontal" method="post" accept-charset="utf-8"
        enctype="multipart/form-data" autocomplete="off">
        @csrf

        <!-- Notification -->
        {!! $notify !!}

        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Personal Info</h4>
                        <hr />
                        {{-- <p class="card-title-desc"></p> --}}
                        <div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="sks-required">
                                            First Name
                                        </label>
                                        <input type="text" class="form-control @error('f_name') is-invalid @enderror"
                                            id="" placeholder="" name="f_name" value="{{ old('f_name') }}">

                                        @error('f_name')
                                            <span class="error">{{ $errors->first('f_name') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="">
                                            Middle Name
                                        </label>
                                        <input type="text" class="form-control @error('m_name') is-invalid @enderror"
                                            id="" placeholder="" name="m_name" value="{{ old('m_name') }}">

                                        @error('m_name')
                                            <span class="error">{{ $errors->first('m_name') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="sks-required">
                                            last Name
                                        </label>
                                        <input type="text" class="form-control @error('l_name') is-invalid @enderror"
                                            id="" placeholder="" name="l_name" value="{{ old('l_name') }}">

                                        @error('l_name')
                                            <span class="error">{{ $errors->first('l_name') }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="sks-required">
                                            Email
                                        </label>
                                        <input type="email" class="form-control @error('user_email') is-invalid @enderror"
                                            id="" placeholder="" name="user_email" value="{{ old('user_email') }}">

                                        @error('user_email')
                                            <span class="error">{{ $errors->first('user_email') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="sks-required">
                                            Phone Number <small>(start with +254)</small>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('user_mobile') is-invalid @enderror" id=""
                                            placeholder="" name="user_mobile" value="{{ old('user_mobile') }}">

                                        @error('user_mobile')
                                            <span class="error">{{ $errors->first('user_mobile') }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="">
                                    Note <small>(any extra infomantion)</small>
                                </label>
                                <textarea name="note" id="" class="form-control @error('note') is-invalid @enderror" rows="5"
                                    spellcheck="false">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="error">{{ $errors->first('note') }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Account Info</h4>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="" class="sks-required">
                                        Account Username
                                    </label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="" placeholder="" name="username" value="{{ old('username') }}">

                                    @error('username')
                                        <span class="error">{{ $errors->first('username') }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="" class="sks-required">
                                        Create Password
                                    </label>
                                    <input type="password" class="form-control @error('user_password') is-invalid @enderror"
                                        id="" placeholder="Enter password" name="user_password"
                                        value="{{ old('user_password') }}">

                                    @error('user_password')
                                        <span class="error">{{ $errors->first('user_password') }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="" class="sks-required">
                                        Confirm Password
                                    </label>
                                    <input type="text"
                                        class="form-control @error('user_password_confirmation') is-invalid @enderror"
                                        id="" placeholder="Enter confirm password"
                                        name="user_password_confirmation"
                                        value="{{ old('user_password_confirmation') }}">

                                    @error('user_password_confirmation')
                                        <span class="error">{{ $errors->first('user_password_confirmation') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            {{-- set col-6 and float right --}}
            <div class="col-6">
                <div class=" float-end">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light"> Add
                            Customer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
