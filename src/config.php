<?php

set_time_limit(0);



if(!ini_get("date.timezone") and ($timezone = detect_system_timezone()) and date_default_timezone_set($timezone)){
    //Success! Timezone has already been set and validated in the if statement.
    //This here is just for redundancy just in case some program wants to read timezone data from the ini.
    ini_set("date.timezone", $timezone);
}else{
    /*
     * This is here so that people don't come to us complaining and fill up the issue tracker when they put
     * an incorrect timezone abbreviation in php.ini apparently.
     */
    $timezone = ini_get("date.timezone");
    if(strpos($timezone, "/") === false){
        $default_timezone = timezone_name_from_abbr($timezone);
        ini_set("date.timezone", $default_timezone);
        date_default_timezone_set($default_timezone);
    }else{
        date_default_timezone_set($timezone);
    }
}

function detect_system_timezone(){
    if(strpos(" " . strtoupper(php_uname("s")), " WIN") !== false){ //Windows
        $regex = '/(UTC)(\+*\-*\d*\d*\:*\d*\d*)/';

        /*
         * wmic timezone get Caption
         * Get the timezone offset
         *
         * Sample Output var_dump
         * array(3) {
         *	  [0] =>
         *	  string(7) "Caption"
         *	  [1] =>
         *	  string(20) "(UTC+09:30) Adelaide"
         *	  [2] =>
         *	  string(0) ""
         *	}
         */
        exec("wmic timezone get Caption", $output);

        $string = trim(implode("\n", $output));

        //Detect the Time Zone string
        preg_match($regex, $string, $matches);

        if(!isset($matches[2])){
            return false;
        }

        $offset = $matches[2];

        if($offset == ""){
            return "UTC";
        }

        return parse_offset($offset);
    }else{ //Linux
        // Ubuntu / Debian.
        if(file_exists('/etc/timezone')){
            $data = file_get_contents('/etc/timezone');
            if($data){
                return trim($data);
            }
        }

        // RHEL / CentOS
        if(file_exists('/etc/sysconfig/clock')){
            $data = parse_ini_file('/etc/sysconfig/clock');
            if(!empty($data['ZONE'])){
                return trim($data['ZONE']);
            }
        }

        //Portable method for incompatible linux distributions.

        $offset = trim(exec('date +%:z'));

        if($offset == "+00:00"){
            return "UTC";
        }

        return parse_offset($offset);
    }
}


/**
 * @param string $offset In the format of +09:00, +02:00, -04:00 etc.
 *
 * @return string
 */
function parse_offset($offset){
    //Make signed offsets unsigned for date_parse
    if(strpos($offset, '-') !== false){
        $negative_offset = true;
        $offset = str_replace('-', '', $offset);
    }else{
        if(strpos($offset, '+') !== false){
            $negative_offset = false;
            $offset = str_replace('+', '', $offset);
        }else{
            return false;
        }
    }

    $parsed = date_parse($offset);
    $offset = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];

    //After date_parse is done, put the sign back
    if($negative_offset == true){
        $offset = -abs($offset);
    }

    //And then, look the offset up.
    //timezone_name_from_abbr is not used because it returns false on some(most) offsets because it's mapping function is weird.
    //That's been a bug in PHP since 2008!
    foreach(timezone_abbreviations_list() as $zones){
        foreach($zones as $timezone){
            if($timezone['offset'] == $offset){
                return $timezone['timezone_id'];
            }
        }
    }

    return false;
}

gc_enable();
error_reporting(E_ALL | E_STRICT);
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
ini_set("default_charset", "utf-8");
if(defined("POCKETMINE_COMPILE") and POCKETMINE_COMPILE === true){
	define("FILE_PATH", realpath(dirname(__FILE__)) . "/");
}else{
	define("FILE_PATH", realpath(dirname(__FILE__) . "/../") . "/");
}
set_include_path(get_include_path() . PATH_SEPARATOR . FILE_PATH);

ini_set("memory_limit", "256M"); //Default

const LOG = true;

define("START_TIME", microtime(true));

const MAJOR_VERSION = "1.0.0";
const CODENAME = "生存斧服务器"; //i'm not very creative - kotyaralih
const CURRENT_MINECRAFT_VERSION = "v0.8.1 alpha";
const CURRENT_API_VERSION = '12.1';
const CURRENT_PHP_VERSION = "8.0";
$gitsha1 = false;
if(file_exists(FILE_PATH . ".git/refs/heads/master")){ //Found Git information!
	define("GIT_COMMIT", strtolower(trim(file_get_contents(FILE_PATH . ".git/refs/heads/master"))));
}else{ //Unknown :(
	define("GIT_COMMIT", str_repeat("00", 20));
}
