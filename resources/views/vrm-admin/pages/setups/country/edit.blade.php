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
                                <h4 class="card-title">Status Info</h4>
                                <hr />
                                {{-- <p class="card-title-desc"></p> --}}
                                <div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="sks-required">
                                                    Status Title
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id=""
                                                    placeholder="" name="name" value="{{ $resultFound->name }}">

                                                @error('name')
                                                    <span class="error">{{ $errors->first('name') }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="sks-required">Parent </label>
                                                <select
                                                    class="form-control form-control-lg select2 @error('parent') is-invalid @enderror"
                                                    id="" placeholder="" name="parent">
                                                    <option value="0" @selected($resultFound->parent == 0)>
                                                        -- Self --
                                                    </option>
                                                    @foreach ($entry_list as $list)
                                                        <option value="{{ $list->id }}" @selected($resultFound->parent == $list->id)>
                                                            {{ $list->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('parent')
                                                    <span class="error">{{ $errors->first('parent') }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Country Code <small>(KE)</small>
                                                </label>
                                                @php
                                                    $country_code = $resultFound->attributes->where('name', 'country_code')->first();
                                                    $country_code = !is_null($country_code) ? $country_code->value : ($country_code = '');
                                                @endphp
                                                <input type="text"
                                                    class="form-control @error('country_code') is-invalid @enderror"
                                                    id="" placeholder="" name="country_code"
                                                    value="{{ $country_code }}">

                                                @error('country_code')
                                                    <span class="error">{{ $errors->first('country_code') }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Dial Code <small>(+254)</small>
                                                </label>
                                                @php
                                                    $country_dial_code = $resultFound->attributes->where('name', 'country_dial_code')->first();
                                                    $country_dial_code = !is_null($country_dial_code) ? $country_dial_code->value : ($country_dial_code = '');
                                                @endphp
                                                <input type="text"
                                                    class="form-control @error('country_dial_code') is-invalid @enderror"
                                                    id="" placeholder="" name="country_dial_code"
                                                    value="{{ $country_dial_code }}">

                                                @error('country_dial_code')
                                                    <span class="error">{{ $errors->first('country_dial_code') }}</span>
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
                                    Update Status Info
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
