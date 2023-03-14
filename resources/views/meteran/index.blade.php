@extends('template')
@section('content')
    <div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/detector"><i class="fas fa-home"
                                            style="color: #172B4D"></i></a></li>
                                <li class="breadcrumb-item"><a href="/meteran-table" style="color: #172B4D">Table</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        @if ($notification = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $notification }}</strong>
            </div>
        @endif
        @if ($notification = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ $notification }}</strong>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row my-3">
                    <div class="col">
                        <a href="{{ route('detector.index') }}">
                            <button class="btn btn-success">Add Data</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Unit</th>
                                <th>Type</th>
                                <th>Nilai Meteran</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meterans as $meteran)
                                <tr>
                                    <td>{{ $meteran->id }}</td>
                                    <td>{{ $meteran->unit->name }}</td>
                                    <td>{{ $meteran->type }}</td>
                                    <td>{{ $meteran->meteran_value }}</td>
                                    <td>
                                        <button id="show-image" class="btn btn-success"
                                            onclick="ShowImage({{ $meteran->id }})">Show Image</button>
                                    </td>
                                    <td>
                                        <form action="{{ route('meteran.destroy', $meteran->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                function ShowImage(id) {
                    $.ajax({
                        url: '/admin/meteran/image' + id,
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: 'Image',
                                imageUrl: data.media_src,
                                imageWidth: 400,
                                imageHeight: 200,
                                imageAlt: 'Custom image',
                            })
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            </script>
        @endpush
    @endsection
