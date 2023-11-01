@extends("$theme_dir.layouts.$layoutName")

{{-- Content --}}
@section('content')
    <form action="{!! url($links->update) !!}" class="form-horizontal" method="post" accept-charset="utf-8"
        enctype="multipart/form-data" autocomplete="off">
        @csrf

        {{-- hidden userId --}}
        <input type="hidden" name="id" value="{{ $resultFound->id }}">

        <!-- Notification -->
        {!! $notify !!}

        <div class="row justify-content-center">
            <div class="col-md-7 col-sm-12">

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Company Info</h4>
                                <hr />
                                {{-- <p class="card-title-desc">make changes here</p> --}}
                                <div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="customer" class="form-label sks-required"> Customer </label>
                                                <select name="customer"
                                                    class="form-control form-control-lg select2 @error('customer') is-invalid @enderror"
                                                    data-placeholder="Select customer from list">
                                                    @foreach ($customer_list as $index => $list)
                                                        <option value="{{ $list->id }}" @selected($resultFound->customer == $list->id)>
                                                            {{ $list->name }} - {{ $list->phone }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('customer')
                                                    <span class="error">{{ $errors->first('customer') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="sks-required">
                                                    Company Name
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id=""
                                                    name="name" value="{{ $resultFound->name }}">

                                                @error('name')
                                                    <span class="error">{{ $errors->first('name') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Company Phone
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" id=""
                                                    placeholder="" name="phone" value="{{ $resultFound->phone }}">

                                                @error('phone')
                                                    <span class="error">{{ $errors->first('phone') }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Company Email
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror" id=""
                                                    placeholder="" name="email" value="{{ $resultFound->email }}">

                                                @error('email')
                                                    <span class="error">{{ $errors->first('email') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Company Address
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="" name="address" value="{{ $resultFound->address }}">

                                                @error('address')
                                                    <span class="error">{{ $errors->first('address') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    City
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror" id=""
                                                    placeholder="" name="city" value="{{ $resultFound->city }}">

                                                @error('city')
                                                    <span class="error">{{ $errors->first('city') }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Country
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('country') is-invalid @enderror"
                                                    id="" placeholder="" name="country"
                                                    value="{{ $resultFound->country }}">

                                                @error('country')
                                                    <span class="error">{{ $errors->first('country') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class=" float-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Update Company Info
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
