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
            <div class="col-md-7 col-md-12">

                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status Info</h4>
                                <hr />
                                {{-- <p class="card-title-desc"></p> --}}
                                <div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="">
                                                    Note <small>(any extra infomantion)</small>
                                                </label>
                                                @php
                                                    $note = $resultFound->attributes->where('name', 'note')->first();
                                                    $note = !is_null($note) ? $note->value : ($note = '');
                                                @endphp
                                                <textarea name="note" id="" class="form-control @error('note') is-invalid @enderror" rows="5"
                                                    spellcheck="false">{{ $note }}</textarea>
                                                @error('note')
                                                    <span class="error">{{ $errors->first('note') }}</span>
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
