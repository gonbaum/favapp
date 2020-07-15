<?php 

namespace App\Helpers;

class Helper
{   
    # This helper function check if the passed date is a day of the weekend:
    public static function is_weekend($date) 
    {
            
        return (date('N', strtotime($date)) >= 6);
            
    }

}
