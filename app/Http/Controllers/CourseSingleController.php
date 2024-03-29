<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CourseController;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Services\EnlistmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseSingleController extends Controller
{
    public function index($courseId)
    {
        $course = new CourseController;
        $enlistmentService = new EnlistmentService;

        return view('course-single-page', ['course' => $course->getSelectedCourse($courseId), 'availability' => $enlistmentService->checkEnlistment(), 'rating' => $course->getUserRating($courseId), 'marks' => $this->getMarks($courseId), 'courseLimit' => $enlistmentService->currentCourseLimitCheck($courseId)]);
    }

    public function rateCourse($courseId)
    {
        DB::table('course_rating')
            ->updateOrInsert(
                [
                    'course_id' => $courseId,
                    'user_id' => Auth::id(),

                ],
                [
                    'rating' => request('user-rating')
                ]
            );

        $courseRating = DB::table('course_rating')
            ->where('course_id', $courseId)
            ->get();

        $sumCourseRating = 0;
        foreach($courseRating as $rating) {
            $sumCourseRating += $rating->rating;
        }

        Course::updateOrCreate(
            [
                'id' => $courseId,
            ],
            [
                'rating' => $sumCourseRating / count($courseRating)
            ]
        );

        return redirect('course-single/' . $courseId);
    }

    public function markComplete($courseId, $conditionId)
    {
        DB::table('progress')
            ->insert(
                [
                    'course_id' => $courseId,
                    'user_id' => Auth::id(),
                    'condition_id' => $conditionId
                ]
            );

        return redirect('/course-single/' . $courseId);
    }

    public function markNotComplete($courseId, $conditionId)
    {
        DB::table('progress')
            ->where('course_id', $courseId)
            ->where('user_id', Auth::id())
            ->where('condition_id', $conditionId)
            ->delete();

        return redirect('/course-single/' . $courseId);
    }

    public function getMarks($courseId)
    {
        $marksWithKey = [];
        $userId = Auth::id();

        $marks = DB::table('progress')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->get()
            ->toArray();

        foreach ($marks as $mark) {
            $marksWithKey[$mark->condition_id] = $mark;
        }

        return json_decode(json_encode($marksWithKey), true);
    }

// TODO VIDEO PLAYBACK WORKS BUT NEED TO SOLVE THE POSITIONING FOR CODE
//    public function test()
//    {
//        $file = public_path('video/Introduction.mp4');
//
//        $fp = @fopen($file, 'rb');
//        $size = filesize($file); // File size
//        $length = $size; // Content length
//        $start = 0; // Start byte
//        $end = $size - 1; // End byte
//        header('Content-type: video/mp4');
//        //header("Accept-Ranges: 0-$length");
//        header("Accept-Ranges: bytes");
//        if (isset($_SERVER['HTTP_RANGE'])) {
//            $c_start = $start;
//            $c_end = $end;
//            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
//            if (strpos($range, ',') !== false) {
//                header('HTTP/1.1 416 Requested Range Not Satisfiable');
//                header("Content-Range: bytes $start-$end/$size");
//                exit;
//            }
//
//            if ($range == '-') {
//                $c_start = $size - substr($range, 1);
//            }else{
//                $range = explode('-', $range);
//                $c_start = $range[0];
//                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
//            }
//            $c_end = ($c_end > $end) ? $end : $c_end;
//
//            if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
//                header('HTTP/1.1 416 Requested Range Not Satisfiable');
//                header("Content-Range: bytes $start-$end/$size");
//                exit;
//            }
//            $start = $c_start;
//            $end = $c_end;
//            $length = $end - $start + 1;
//            fseek($fp, $start);
//            header('HTTP/1.1 206 Partial Content');
//        }
//        header("Content-Range: bytes $start-$end/$size");
//        header("Content-Length: ".$length);
//        $buffer = 1024 * 8;
//        while(!feof($fp) && ($p = ftell($fp)) <= $end) {
//            if ($p + $buffer > $end) {
//                $buffer = $end - $p + 1;
//            }
//            set_time_limit(0);
//            echo fread($fp, $buffer);
//            flush();
//        }
//        fclose($fp);
//        exit();
//    }
}
