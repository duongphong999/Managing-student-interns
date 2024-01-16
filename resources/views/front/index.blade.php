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
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-success me-2" href="{{ route('home.show',['id' => $item->id]) }}">Today</a>
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
</body>
</html>
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
