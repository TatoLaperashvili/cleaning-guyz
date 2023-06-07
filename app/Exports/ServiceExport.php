<?php

namespace App\Exports;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServiceExport implements FromView
{
    protected  $submissions;

    function __construct($submissions)
    {
        $this->submissions = $submissions;
    }
    public function view(): View
    {
        return view('admin.submission_service.export', [
          
            'submissions' => $this->submissions
           
        ]);
    }
}
