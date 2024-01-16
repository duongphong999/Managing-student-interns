<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="http://managing-studen-interns.test/assets/img/favicon.png">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/simple-calendar/simple-calendar.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://managing-studen-interns.test/assets/css/style.css">

	<link rel="stylesheet" href="http://managing-studen-interns.test/assets/css/toastr.min.css">
	<script src="http://managing-studen-interns.test/assets/js/toastr_jquery.min.js"></script>
	<script src="http://managing-studen-interns.test/assets/js/toastr.min.js"></script>
</head>

<body>
    @if (count($attendanceByDayGrouped) == 0)
    <div class="text-center">
        <h1>There is no data available for the month {{ $selectedMonth }}</h1>
    </div>
    @endif
    @foreach ($attendanceByDayGrouped as $date => $attendaceList)
        <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped dataTable">
            <thead class="student-thread">
                <tr>
                    <th colspan="6">{{ $date }}</th>
                </tr>
                <tr>
                    <th>Count</th>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Absent</th>
                    <th>Present</th>
                    <th>note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendaceList as $key => $item)
                <tr>
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
                        <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}{{$date}}" value="0" {{ ($item->status == 0)?'checked':'' }}>
                    </td>
                    <td class="text-center">
                        <input class="form-check-input" type="radio" id="action-attendance-{{ $item->student_id }}" name="{{ $item->student_id }}{{$date}}" value="1" {{ ($item->status == 1)?'checked':'' }}>
                    </td>
                    <td>
                        <input type="text" name="note_{{ $item->student_id }}{{$date}}" class="form-control" value="{{ $item->note }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
