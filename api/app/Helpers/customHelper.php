<?php

if(! function_exists("is_mobile_phone") )
{
    /**
     * @param bool|false $sPhone
     * @return bool
     */
    function is_mobile_phone( $sPhone = false )
    {
        if ( $sPhone ) {
            $exp_regular = '/^(?:[12][1-9]9[2-9]|[3-9][1-9][5-9])[0-9]{7}$/';
            $ret = preg_match($exp_regular, $sPhone);

            if ($ret === 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

if(! function_exists("dec") ) {
    /**
     * Format a string do decimal value
     * Ex: 300,45 - 300.45
     * @param string $value
     * @param int $precision
     * @return float
     */
    function dec($value, $precision = 2)
    {
        if (strpos($value, ',') > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        } elseif (substr_count($value, ".") > 1) {
            $new_num = "";
            $count = substr_count($value, ".");
            $array = explode('.', $value);
            foreach ($array as $key => $number) {
                if ($key == $count) {
                    $new_num .= "." . $number;
                } else {
                    $new_num .= $number;
                }
            }
            $value = $new_num;
        }
        $value = bcmul($value, 100, $precision);
        $value = bcdiv($value, 100, $precision);
        return $value;
    }
}

if(! function_exists("mon") ) {
    /**
     * @param float $number
     * @param int   $precision
     * @return string
     */
    function mon($number, $precision = 2)
    {
        return number_format(floatval($number), $precision, ',', '.');
    }
}