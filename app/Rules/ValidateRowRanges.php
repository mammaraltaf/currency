<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateRowRanges implements Rule
{
    public function passes($attribute, $value)
    {
        $data = request()->all();
        $from = $data['from'];
        $to = $data['to'];

        foreach ($data['rows'] as $row) {
            if ($row['from'] <= $to && $row['to'] >= $from) {
                return false; // Invalid range overlap
            }
        }

        return true; // Valid range
    }

    public function message()
    {
        return 'Invalid range overlap with existing rows.';
    }
}
