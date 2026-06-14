<?php

namespace App\Widgets;

use Statamic\Widgets\Widget;

class QuickLinksWidget extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        return view('widgets.quick_links_widget');
    }
}
