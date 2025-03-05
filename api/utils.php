<?php

function IsUtilsClassDefined(){
	return true;
}

FUNCTION DBG($info){
	//echo $info.'<br>';
}

FUNCTION RESPONSE($info){
	//echo $info;
}

FUNCTION RES_SUCCESS(){
	//echo "SUCCESS";
}

FUNCTION RES_FAILED(){
	//echo "FAILED";
}

FUNCTION uniqidReal($lenght = 14) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {        
		$byte = uniqid();
		//throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

FUNCTION decode_3x($data){
	//the query was encoded 3 times
	//so have to decode 3 times
	$data = base64_decode($data);
	$data = base64_decode($data);
	$data = base64_decode($data);
	
	return $data;
}	


date_default_timezone_set('UTC');

FUNCTION time_ago( $time ){
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'just now'; }
    $condition = array(
                12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

FUNCTION is_empty($input){
    return ($input == false || $input == "");
}

FUNCTION is_not_empty($input){
    return ($input != false && $input != "");
}

FUNCTION read_param($param, $default_value=""){
	return is_empty($param)? $default_value:$param;
}

FUNCTION try_or($value_to_try, $or_value=""){
	return is_empty($value_to_try)? $or_value:$value_to_try;
}

FUNCTION echo_return($result){
	if(!is_string($result)){
		$result = json_encode($result);
	}
	
	echo $result;
}

FUNCTION echo_string($result){
	if(!is_string($result)){
		$result = json_encode($result);
	}
	
	echo $result;
}

FUNCTION stringify($rows){
    if(!is_string($rows)){
        $rows = json_encode($rows);
    }

    return $rows;
}

FUNCTION VerifyUser($token=''){
	$user = base64_decode($token);
	$user = json_decode($user);
	return $user;
}
?>