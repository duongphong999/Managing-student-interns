<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    /** home dashboard */
    public function index()
    {
        //Lọc ra những lớp học đang available trong khung giờ hiện tại
        $mydate = new \DateTime();
        $mydate->modify('+7 hours');

        $currentDate = $mydate->format('Y-m-d');

        $frametime = 0; //0 -> 2,4,6 | 1 => 3, 5, 7
        $day       = $mydate->format('N'); //1 => Thu 2, 2 => Thu 3, ..., 7 => Chu nhat
        //1, 3, 5 => thu 2, 4, 6 => frametime = 0
        //2, 4, 6 => thu 3, 5, 7 => frametime = 1
        if ($day == 1 || $day == 3 || $day == 5) {
            $frametime = 0;
        } else if ($day != 7) {
            $frametime = 1;
        } else {
            $frametime = -1;
        }
        $hour        = $mydate->format('H');
        $minute      = $mydate->format('i');
        $currentTime = $hour + $minute / 60;

        $schedulesToday = Schedule::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where('frametime', $frametime)
            // ->where('starttime', '<=', $currentTime)
            // ->where('endtime', '>=', $currentTime)
            ->get();

        return view('front.index')->with([
            'index'        => 1,
            'schedulesToday' => $schedulesToday
        ]);
    }

    /**
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $schedule = Schedule::where('id', $id)->first();

        if (empty($schedule)) {
            return redirect()->route('attendence.index');
        }

        //danh sach sinh vien;
        $mydate = new \DateTime();
        $mydate->modify('+7 hours');

        $currentDate = $mydate->format('Y-m-d');

        //1 ngay => hoc 1 buoi => 1 lan diem danh.
        $edit = Attendance::leftJoin('students', 'students.student_id', '=', 'attendances.student_id')
            ->where('attendances.schedule_id', $id)
            ->where('attendances.created_at', '>=', $currentDate)
            ->select('attendances.*', 'students.first_name')
            ->get();

        $studentList = [];
        if ($edit == null || count($edit) == 0) {
            $studentList = Student::where('class', $schedule->class_name)->get();
        }

        return view('front.view')->with([
            'index'       => 1,
            'schedule'     => $schedule,
            'studentList' => $studentList,
            'edit'        => $edit
        ]);
    }

    /** profile user */
    public function userProfile()
    {
        return view('dashboard.profile');
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }
}
