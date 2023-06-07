<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class CourseMemberProgressModalLayout extends Component
{
    public $memberId;
    public $courseId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($memberId, $courseId)
    {
        $this->memberId = $memberId;
        $this->courseId = $courseId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.course-member-progress-modal-layout', ['progress' => $this->getMemberMarkedSyllabuses($this->courseId, $this->memberId)]);
    }

    private function getMemberMarkedSyllabuses($courseId, $memberId)
    {
        $progress = [];
        $courseSyllabuses = $this->getCourseSyllabuses($courseId);
        $markedSyllabuses = $this->getMarkedSyllabusIds($courseId, $memberId);

        $lookup = [];
        foreach($markedSyllabuses as $syllabus) {
            $lookup[$syllabus['condition_id']] = $syllabus;
        }

        foreach ($courseSyllabuses as $courseSyllabus) {
            $id = $courseSyllabus['id'];

            if (isset($lookup[$id])) {
                $item = array_merge($courseSyllabus, ['marked' => true, 'created_at' => $lookup[$id]['created_at']]);
                $progress[] = $item;
            } else {
                $item = array_merge($courseSyllabus, ['marked' => false, 'created_at' => '-']);
                $progress[] = $item;
            }
        }

        return $progress;
    }

    private function getMarkedSyllabusIds($courseId, $memberId)
    {
        $markedSyllabuses = DB::table('progress')
            ->where('course_id', $courseId)
            ->where('user_id', $memberId)
            ->select('condition_id', 'created_at')
            ->get()
            ->toArray();

        return json_decode(json_encode($markedSyllabuses), true);
    }

    private function getCourseSyllabuses($courseId)
    {
        $courseSyllabuses = DB::table('course_information')
            ->where('course_id', $courseId)
            ->whereNotNull('syllabus-name')
            ->select('id', 'course_id', 'syllabus-name')
            ->get()
            ->toArray();

        return json_decode(json_encode($courseSyllabuses), true);
    }
}
