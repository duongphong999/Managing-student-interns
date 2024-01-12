<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Lọc ra những lớp học đang available trong khung giờ hiện tại
        $mydate = new \DateTime();
        $mydate->modify('+7 hours');

        $currentDate = $mydate->format('Y-m-d');

        $frameTime = 0; //0 -> 2,4,6 | 1 => 3, 5, 7
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

        $schedulesToday = DB::table('schedules')
            ->where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where('frametime', $frametime)
            ->where('starttime', '<=', $currentTime)
            ->where('endtime', '>=', $currentTime)
            ->get();

        return view('attendence.index')->with([
            'index'        => 1,
            'schedulesToday' => $schedulesToday
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

		return view('attendence.view')->with([
				'index'       => 1,
				'schedule'     => $schedule,
				'studentList' => $studentList,
				'edit'        => $edit
			]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $mydate = new \DateTime();
		$mydate->modify('+7 hours');

		$schedule_id  = $request->schedule_id;
		$data        = json_decode($request->data, true);
		$currentTime = $mydate->format('Y-m-d H:i:s');
		$currentDate = $mydate->format('Y-m-d');

		//check du lieu da ton tai chua
		$edit = Attendance::leftJoin('students', 'students.student_id', '=', 'attendances.student_id')
			->where('attendances.schedule_id', $schedule_id)
			->where('attendances.created_at', '>=', $currentDate)
			->select('attendances.*', 'students.first_name')
			->get();
        try {
            if ($edit != null && count($edit) > 0) {
                //update
                foreach ($data as $item) {
                    DB::table('attendances')
                        ->where('schedule_id', $request->schedule_id)
                        ->where('created_at', '>=', $currentDate)
                        ->where('student_id', $item['student_id'])
                        ->update([
                            'status'     => $item['status'],
                            'note'       => $item['note'],
                            'updated_at' => $currentTime
                        ]);
                }
            } else {
                //create
                foreach ($data as $item) {
                    $attendance = new Attendance();
                    $attendance->schedule_id = $schedule_id;
                    $attendance->student_id = $item['student_id'];
                    $attendance->status = $item['status'];
                    $attendance->note = $item['note'];
                    $attendance->created_at = $currentTime;
                    $attendance->updated_at = $currentTime;
                    $attendance->save();
                }
            }

            Toastr::success('Has been add successfully :)', 'Success');
            DB::commit();

            return redirect()->route('attendance.show',['id' => $schedule_id]);
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('fail, edit attendance  :)', 'Error');

            return redirect()->route('attendance.show',['id' => $schedule_id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
