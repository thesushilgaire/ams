<?php 
    use App\Http\Controllers\NepaliCalendarController;
    
    function adToBs($englishDate){
        $calendar = new NepaliCalendarController();
        $dateConveter = explode('-', $englishDate);
        $yy =$dateConveter[0];
        $mm = (strlen($dateConveter[1]) == 1) ? '0'.$dateConveter[1] : $dateConveter[1];
        $dd = (strlen($dateConveter[2]) == 1) ? '0'.$dateConveter[2] : $dateConveter[2];
        $nepalidate= $calendar->eng_to_nep($yy, $mm, $dd);
        // dump($nepalidate);
        $yy = $nepalidate['year'];
        // $mm = $nepalidate['month'];
        // $dd = $nepalidate['date'];
        $mm = (strlen($nepalidate['month']) == 1) ? '0'.$nepalidate['month'] : $nepalidate['month'];
        $dd = (strlen($nepalidate['date']) == 1) ? '0'.$nepalidate['date'] : $nepalidate['date'];
        $date_in_bs = $yy.'-'.$mm.'-'.$dd;
        return $date_in_bs; 
    }

    function bsToAd($nepalidate){
        // dd($nepalidate);
        $calendar = new NepaliCalendarController();
        $dateConveter = explode('-', $nepalidate);
        $yy = $dateConveter[0];
        $mm = (strlen($dateConveter[1]) == 1) ? '0'.$dateConveter[1] : $dateConveter[1];
        $dd = (strlen($dateConveter[2]) == 1) ? '0'.$dateConveter[2] : $dateConveter[2];
        $englishDate= $calendar->nep_to_eng($yy, $mm, $dd);
        $yy = $englishDate['year'];
        // $mm = $englishDate['month'];
        // $dd = $englishDate['date'];
        $mm = (strlen($englishDate['month']) == 1) ? '0'.$englishDate['month'] : $englishDate['month'];
        $dd = (strlen($englishDate['date']) == 1) ? '0'.$englishDate['date'] : $englishDate['date'];
        $date_in_ad = $yy.'-'.$mm.'-'.$dd;
        return $date_in_ad;
    }
