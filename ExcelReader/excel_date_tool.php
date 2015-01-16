<?php
    //Only Microsoft would do something this stupid:
    function excel_date($serial){
        
        // Excel/Lotus 123 have a bug with 29-02-1900. 1900 is not a
        // leap year, but Excel/Lotus 123 think it is...
        if ($serial == 60) {
            $day = 29;
            $month = 2;
            $year = 1900;
            
            return sprintf('%02d/%02d/%04d', $month, $day, $year);
        }
        else if ($serial < 60) {
            // Because of the 29-02-1900 bug, any serial date 
            // under 60 is one off... Compensate.
            $serial++;
        }
        
        // Modified Julian to DMY calculation with an addition of 2415019
        $l = $serial + 68569 + 2415019;
        $n = floor(( 4 * $l ) / 146097);
        $l = $l - floor(( 146097 * $n + 3 ) / 4);
        $i = floor(( 4000 * ( $l + 1 ) ) / 1461001);
        $l = $l - floor(( 1461 * $i ) / 4) + 31;
        $j = floor(( 80 * $l ) / 2447);
        $day = $l - floor(( 2447 * $j ) / 80);
        $l = floor($j / 11);
        $month = $j + 2 - ( 12 * $l );
        $year = 100 * ( $n - 49 ) + $i + $l;
        return sprintf('%02d-%02d-%04d', $month, $day, $year);
    }
?>
