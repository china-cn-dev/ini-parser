<?php
/**
 * china-cn-dev/ini-parser
 *
 * @license Apache License Version 2.0
 */

namespace chinacn\parser;

/**
 * Ini Parser
 *
 * @author Li Liang <liliang@mail.china.cn>
 */
class IniParser
{
    /**
     * Parse INI string
     *
     * @param string $str INI string
     * @return array|false
     * @author <epicmaxim@gmail.com>
     * @see http://php.net/manual/zh/function.parse-ini-string.php#111845
     */
    public function parse($str)
    {
        if(empty($str)) return false;

        $lines = explode("\n", $str);
        $ret = Array();
        $inside_section = false;

        foreach($lines as $line) {
            
            $line = trim($line);

            if(!$line || $line[0] == "#" || $line[0] == ";") continue;
            
            if($line[0] == "[" && $endIdx = strpos($line, "]")){
                $inside_section = substr($line, 1, $endIdx-1);
                continue;
            }
           
            if($inside_section) {

                if(!strpos($line, '=')) {

                    if(strpos($line,"#")) {
                         $_line = explode('#',$line);
                         $ret[$inside_section][trim($_line[0])] = "";

                    }else{
                         $ret[$inside_section][trim($line)] = "";
                    }
                    
                }else{

                    $tmp = explode("=", $line, 2);
                    $key = rtrim($tmp[0]);
                    $value = ltrim($tmp[1]);

                
                    if(strpos($value,"#")) {

                       $_val = explode('#',$value);
                       $ret[$inside_section][trim($tmp[0])] = trim($_val[0]);

                    }else{

                      $ret[$inside_section][trim($tmp[0])] = trim($value);
                    }
                }    

            }
        }
        return $ret;
    }
}

