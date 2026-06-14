<?php

namespace App\Widgets;

use Statamic\Widgets\Widget;

class SchoolStatsWidget extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        return view('widgets.school_stats_widget', [
            'studentsCount' => \App\Models\Student::count(),
            'teachersCount' => \App\Models\Teacher::count(),
            'coursesCount' => \App\Models\Course::count(),
            'departmentsCount' => \App\Models\Department::count(),
        ]);
    }
}
