<?php 
$APP_PID = "1010";
$APP_ALIAS = "localeventfinder";
$APP_HOST="$APP_ALIAS.hssoftvn.com";
$APP_VERSION = "101";
$CACHE_REVISION = "?vvv={$APP_VERSION}_{".($CACHE_REVISION_NO?? time()). "}";
$LOCALHOST="http://localhost";

$form_method = "GET";

$enable_ads = false;
$enable_analytics = !true;
$enable_facebook_chat = false;
$enable_facebook_comment = false;
$enable_google_translate = false;

$enable_admin = false;

$server_name = $_SERVER['SERVER_NAME'];
$server_scheme = $_SERVER['REQUEST_SCHEME'];
$url_origin = "$server_scheme://$APP_HOST";
if($server_name != $APP_HOST){
    $url_origin = $LOCALHOST;	
}

$is_local = $url_origin == $LOCALHOST;

$current_url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

//foreach ($_SERVER as $parm => $value)  echo "$parm = '$value'<br>";

$nav_paths = [
    //link              // seo map
    "view"          =>  "/home",
    "speak"      =>  "/download",
    "play-games"      =>  "/search",    
];

$records_per_page = 20;
$records_per_page_posts = 12;
$records_per_page_search = 20;

function is_config_called(){return true;}
function wrap_file($relative_file_path=""){
    global $url_origin, $CACHE_REVISION;
    return "$url_origin/$relative_file_path?$CACHE_REVISION";
}