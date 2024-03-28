<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class InvoicesExport implements FromArray
{
    protected array $invoices;

    public function __construct(array $fields)
    {
        $this->invoices = $fields;
    }

    public function array(): array
    {
        return $this->invoices;
    }
}
