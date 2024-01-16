@extends('layouts.master')
@section('content')
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <form action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Name ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Attendance</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="teachers.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="{{ route('teacher/grid/page') }}" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-download"></i> Download</a>
                                    <a href="{{ route('teacher/add/page') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th>Subject</th>
                                        <th>Attendence</th>
                                        <th class="text-center">Statistical</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedulesToday as $key=>$item)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ $item->class_name }}</td>
                                        <td>{{ $item->teacher }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning" onclick="window.open('{{ route('attendance.show', ['id' => $item->id]) }}')">Attendence</button>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-success me-2">Week</button>
                                            <select name="selected_month" id="selected_month{{ $key }}" onchange="changeMonth({{ $item->id }}, 'selected_month{{ $key }}')">
                                                <option value="">Select Month</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#search-by-date').on('change', function() {
        console.log($('#search-by-date').val());
        var date = $('#search-by-date').val();
        var url = "/attendance/show/" + date;
        location.href = url;
    });

    function changeMonth(scheduleId, selectId) {
        var selectedMonth = document.getElementById(selectId).value;
        window.location.href = "{{ url('attendance/show/month') }}/" + scheduleId + "?selected_month=" + selectedMonth;
    }
</script>
@endsection
