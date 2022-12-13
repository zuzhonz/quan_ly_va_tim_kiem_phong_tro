<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\Motel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BillsImport implements ToCollection
{
    public function __construct()
    {
    }

    public
    function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index > 0) {
                Bill::insertGetId(
                    [
                        'motel_id' => $row[1],
                        'title' => 'Hóa đơn tiên phòng tháng ' . Carbon::now()->format('m'),
                        'status' => 0,
                        'number_elec_old' => $row[2],
                        'number_elec' => $row[3],
                        'number_warter_old' => $row[4],
                        'number_warter' => $row[5],
                        'created_at' => Carbon::now()
                    ]
                );
            }
        }
    }
}
