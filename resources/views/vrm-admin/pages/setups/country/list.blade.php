@extends("$theme_dir.layouts.$layoutName")

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Notification -->
            {!! $notify !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Country Status</h4>
                    <hr />

                    <form action="{!! url($links->save) !!}" class="form-horizontal" method="post" accept-charset="utf-8"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="" class="sks-required">
                                        Title
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="" placeholder="" name="name" value="{{ old('name') }}">

                                    @error('name')
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="" class="sks-required">Parent </label>
                                    <select
                                        class="form-control form-control-lg select2 @error('parent') is-invalid @enderror"
                                        id="" placeholder="" name="parent">
                                        <option value="0" @selected(old('parent') == 0)> -- Self -- </option>
                                        @foreach ($entry_list as $list)
                                            <option value="{{ $list->id }}" @selected(old('parent') == $list->id)>
                                                @if ($list->parent != 0)
                                                    ---
                                                @endif
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
                                    <input type="text" class="form-control @error('country_code') is-invalid @enderror"
                                        id="" placeholder="" name="country_code" value="{{ old('country_code') }}">

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
                                    <input type="text"
                                        class="form-control @error('country_dial_code') is-invalid @enderror" id=""
                                        placeholder="" name="country_dial_code" value="{{ old('country_dial_code') }}">

                                    @error('country_dial_code')
                                        <span class="error">{{ $errors->first('country_dial_code') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- set col-6 and float right --}}
                            <div class="col-12 float-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <h4 class="card-title">Country Status </h4>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Title</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($entry_list as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        @php
                                            $parent = $entry_list->where('id', $list->parent)->first();
                                            if ($parent) {
                                                $parent = $parent->name;
                                            } else {
                                                $parent = 'Self';
                                            }
                                        @endphp
                                        {{ $parent }}
                                    </td>
                                    <td>
                                        @if ($list->flag == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url($links->edit . '?id=' . $list->id) }}"
                                            class="btn btn-primary waves-effect waves-light btn-sm">
                                            <i class="bx bx-spreadsheet font-size-16 align-middle mr-2"></i> Edit
                                        </a>

                                        <button onclick="deleteData('{{ $list->id }}')"
                                            class="btn
                                            btn-danger waves-effect waves-light btn-sm">
                                            <i class="bx bx-trash font-size-16 align-middle mr-2"></i> Delete
                                        </button>

                                        @if ($list->flag == 1)
                                            <a href="{{ url($links->route . '/deactivate?id=' . $list->id) }}"
                                                class="btn btn-info waves-effect waves-light btn-sm">
                                                Inactive
                                            </a>
                                        @else
                                            <a href="{{ url($links->route . '/activate?id=' . $list->id) }}"
                                                class="btn btn-info waves-effect waves-light btn-sm">
                                                Active
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        // ?  Delete data
        const deleteData = (userId) => {
            // ? Are you sure
            Swal.fire({
                title: 'Are you sure you want to delete?',
                text: "This can't be undone, and will affect shipments and invoices!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, send a request to the Laravel route for deletion
                    let base_url = `{{ url($links->delete) }}`;
                    window.location.href = `${base_url}?id=${userId}`;
                } else {
                    // If canceled, close the SweetAlert dialog
                    showConfirm = false;
                }
            });
        }
    </script>
@endsection
