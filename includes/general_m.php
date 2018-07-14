<?php
function YMDtoDMY($date)
{
	if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
    {
        $string = explode('-', $date);
        return $string[2]."/".$string[1]."/".$string[0];
    }
    else
    {
        return null;
    }
}
?>