<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactExport implements FromView, ShouldAutoSize
{
    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;

    }

    public function view(): View
    {
        return view('exports.contact-export',
            ['contacts' => $this->contacts]);
    }
}
