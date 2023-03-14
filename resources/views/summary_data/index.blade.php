@extends('template')
@section('content')
    <div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="fas fa-home"
                                            style="color: #172B4D"></i></a></li>
                                <li class="breadcrumb-item"><a href="/admin/lihat-semua-data-akun"
                                        style="color: #172B4D">Summary</a></li>
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
        <div class="row">
            <div class="col-12" style="width: 100%;">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <table class="table table-bordered data-table" style="width: 100%;" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Unit</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($summary_datas as $summary_data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $summary_data->type }}</td>
                                        <td>{{ $summary_data->unit_id }}</td>
                                        <td>{{ $summary_data->jan }}</td>
                                        <td>{{ $summary_data->feb }}</td>
                                        <td>{{ $summary_data->mar }}</td>
                                        <td>{{ $summary_data->apr }}</td>
                                        <td>{{ $summary_data->may }}</td>
                                        <td>{{ $summary_data->jun }}</td>
                                        <td>{{ $summary_data->jul }}</td>
                                        <td>{{ $summary_data->aug }}</td>
                                        <td>{{ $summary_data->sep }}</td>
                                        <td>{{ $summary_data->oct }}</td>
                                        <td>{{ $summary_data->nov }}</td>
                                        <td>{{ $summary_data->dec }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#dataTable').DataTable({
            "scrollX": true
        });
    </script>
@endsection
