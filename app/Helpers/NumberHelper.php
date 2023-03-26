<?php



function convertToEnglish($number)
{
    // convert Bangla numbers to English numbers
    $eng_numbers = [
        '০' => 0,
        '১' => 1,
        '২' => 2,
        '৩' => 3,
        '৪' => 4,
        '৫' => 5,
        '৬' => 6,
        '৭' => 7,
        '৮' => 8,
        '৯' => 9,
		'-' =>'-',
		'.' =>'.',
    ];

    if (is_array($number)) {
        // If $number is an array, loop through each element and convert to English
        $english_numbers = [];
        foreach ($number as $value) {
            $english_number = strtr($value, $eng_numbers);
            $english_numbers[] = (double) $english_number;
        }
        return $english_numbers;
    } else {
        // If $number is a single value, convert to English directly
        $english_number = strtr($number, $eng_numbers);
        return (double) $english_number;
    }
}


     function convertToBangla($number)
    {
        // convert English numbers to Bangla numbers
        $bangla_numbers = [
            0 => '০',
            1 => '১',
            2 => '২',
            3 => '৩',
            4 => '৪',
            5 => '৫',
            6 => '৬',
            7 => '৭',
            8 => '৮',
            9 => '৯',
			'-' =>'-',
		    '.' =>'.',
        ];

        $bangla_number = strtr($number, $bangla_numbers);

        return  $bangla_number;
    }












