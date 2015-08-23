<?php

class Test
{
    static $b=2;
    private static function __construct(){
        self::$b++;
        
    }
    static function incb()
    {
        self::__construct();
        return self::$b;
    }
    
}
echo Test::incb();
//$res = read_conf($_SERVER["DOCUMENT_ROOT"].'/config.txt');
//print_r($res);
//$res = read_conf_2($_SERVER["DOCUMENT_ROOT"].'/config.txt');
//print_r($res);
//$res1 = Fibonacci(array(1,2),20);
//echo implode(" ",$res1);
//$a = "abc";
//$a[3] = "";
//$b = "defg";
//$a = $a ^ $b;
//$b = $a ^ $b;
//$a = $a ^ $b;
//var_dump($a);
//var_dump($b);

function Fibonacci($numbers, $n)
{
    if ($n !== 0)
    {
        $cnt = count($numbers);
        $new = $numbers[$cnt - 2] + $numbers[$cnt - 1];
        array_push($numbers, $new);
        $numbers = Fibonacci($numbers, $n - 1);
    }
    return $numbers;
}

function read_conf($filename)
{
    $params = file($filename);
    $result = array();
    foreach ($params as $param)
    {
        list($names, $value) = explode("=", $param, 2);

        $keys = explode(".", $names);

        $str = '$result';
        foreach ($keys as $key)
        {
            $str.='["' . $key . '"]';
        }
        $str.="='$value';";
        eval($str);
    }
    return $result;
}

function read_conf_2($filename)
{
    $params = file($filename);
    $result = array();

    foreach ($params as $param)
    {
        list($names, $value) = explode("=", $param, 2);

        $keys = explode(".", $names);
        $temp_result = &$result;
        foreach ($keys as $key)
        {
            if (!isset($temp_result[$key]))
            {
                $temp_result[$key] = array();
            }
            $temp_result = &$temp_result[$key];
        }
        $temp_result = $value;
    }
    return $result;
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
