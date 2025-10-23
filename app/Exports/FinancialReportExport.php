<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinancialReportExport implements FromView
{
    public function __construct(
        public $transactions,
        public $start_date,
        public $end_date,
        public $type
    ) {}

    public function view(): View
    {
        return view('exports.financial-report', [
            'transactions' => $this->transactions,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->type,
        ]);
    }
}