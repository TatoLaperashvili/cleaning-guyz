<?php
namespace App\Exports;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class collaborateexport implements FromView
{
    protected $submissions;

    function __construct($submissions)
    {
        $this->submissions = $submissions;
    }
    public function view(): View
    {
        return view('admin.collaborate_submission.export', [
            'submissions' => $this->submissions
        ]);
    }
}
