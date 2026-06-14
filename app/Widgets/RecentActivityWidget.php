<?php

namespace App\Widgets;

use Statamic\Widgets\Widget;

class RecentActivityWidget extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        $recentLogs = \App\Models\CommunicationLog::with('student')
            ->latest()
            ->take(4)
            ->get();

        $recentPayments = \App\Models\FeePayment::with('student')
            ->latest()
            ->take(4)
            ->get();

        return view('widgets.recent_activity_widget', [
            'recentLogs' => $recentLogs,
            'recentPayments' => $recentPayments,
        ]);
    }
}
