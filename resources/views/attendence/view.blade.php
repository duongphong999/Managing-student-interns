@extends('layouts.master')
@section('content')
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <form action="">
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
                                    <h3 class="page-title">Teachers</h3>
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
                                        <th class="text-center">Count</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Student</th>
                                        <th class="text-center">Absent</th>
                                        <th class="text-center">Present</th>
                                        <th class="text-center">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($studentList != null)
                                    @foreach ($studentList as $key=>$item)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->student_id }}</td>
                                        <td hidden class="id">{{ $item->id }}</td>
                                        <td hidden class="avatar">{{ $item->upload }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="student-details.html"class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" src="{{ Storage::url('student-photos/'.$item->upload) }}" alt="User Image">
                                                </a>
                                                <a href="student-details.html">{{ $item->first_name }} {{ $item->last_name }}</a>
                                            </h2>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}" value="0">
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}" value="1">
                                        </td>
                                        <td>
                                            <input type="text" name="note_{{ $item->student_id }}" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if ($edit != null && count($edit) > 0)
                                    @foreach ($edit as $key=>$item)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->student_id }}</td>
                                        <td hidden class="id">{{ $item->id }}</td>
                                        <td hidden class="avatar">{{ $item->student->upload }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="student-details.html"class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" src="{{ Storage::url('student-photos/'.$item->student->upload) }}" alt="User Image">
                                                </a>
                                                <a href="student-details.html">{{ $item->first_name }} {{ $item->last_name }}</a>
                                            </h2>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}" value="0" {{ ($item->status == 0)?'checked':'' }}>
                                        </td>
                                        <td class="text-center">
                                            <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}" value="1" {{ ($item->status == 1)?'checked':'' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="note_{{ $item->student_id }}" class="form-control" value="{{ $item->note }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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
    $('#submit').on('click',function(e) {
        statusList = $('input[type=radio]:checked')
        data = []
        for(i = 0; i < statusList.length; i++) {
            std = {
                'student_id': $(statusList[i]).attr('name'),
                'status': $(statusList[i]).val(),
                'note': $('[name=note_'+$(statusList[i]).attr('name')+']').val()
            }
            data.push(std)
        }
        console.log(data)

        $.post('{{ route('attendance.post') }}', {
            '_token': "{{ csrf_token() }}",
            'schedule_id': {{ $schedule->id }},
            'data': JSON.stringify(data)
        }, function(data) {
            location.reload()
        })
    })
</script>
@endsection
