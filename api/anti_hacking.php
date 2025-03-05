<?php
const FILTERS = [
	'string' => FILTER_SANITIZE_STRING,
	'string[]' => [
		'filter' => FILTER_SANITIZE_STRING,
		'flags' => FILTER_REQUIRE_ARRAY
	],
	'email' => FILTER_SANITIZE_EMAIL,
	'int' => [
		'filter' => FILTER_SANITIZE_NUMBER_INT,
		'flags' => FILTER_REQUIRE_SCALAR
	],
	'int[]' => [
		'filter' => FILTER_SANITIZE_NUMBER_INT,
		'flags' => FILTER_REQUIRE_ARRAY
	],
	'float' => [
		'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
		'flags' => FILTER_FLAG_ALLOW_FRACTION
	],
	'float[]' => [
		'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
		'flags' => FILTER_REQUIRE_ARRAY
	],
	'url' => FILTER_SANITIZE_URL,
];

class AntiHacking
{
	// THE only instance of the class
	private static $instance;
	private function __construct() {}
	public static function getInstance(){
		if ( !isset(self::$instance))
		{
			self::$instance = new self;
		}

		return self::$instance;
	}
	
	/**
	 * Escape all text using htmlentities
	 * @return string text after converted.
	 */
	public static function escape($text){
		return htmlentities($text, ENT_QUOTES, 'UTF-8');
	}

	/**
	 * Same as escape
	 * @return string text after converted.
	 */
	public static function print($text){
		return self::escape($text);
	}

	/**
	 * Escape all text using special method, and manually check
	 * @return string text after converted.
	 */
	public static function jsEscape($str){
		$output = '';
		$str = str_split($str);
		for($i=0;$i<count($str);$i++) {
			$chrNum = ord($str[$i]);
			$chr = $str[$i];
			if($chrNum === 226) {
				if(isset($str[$i+1]) && ord($str[$i+1]) === 128) {
					if(isset($str[$i+2]) && ord($str[$i+2]) === 168) {
						$output .= '\u2028';
						$i += 2;
						continue;
					}
					if(isset($str[$i+2]) && ord($str[$i+2]) === 169) {
						$output .= '\u2029';
						$i += 2;
						continue;
					}
				}
			}
			switch($chr) {
				case "`":
				case "'":
				case '"':
				case "\n";
				case "\r";
				case "&";
				case "\\";
				case "<":
				case ">":
					$output .= sprintf("\\u%04x", $chrNum);
				break;
				default:
					$output .= $str[$i];
				break;
		}
		}
		return $output;
	}

	//https://www.phptutorial.net/php-tutorial/php-sanitize-input/
	

	/**
	* Recursively trim strings in an array
	* @param array $items
	* @return array
	*/
	public static function array_trim(array $items): array
	{
		return array_map(function ($item) {
			if (is_string($item)) {
				return trim($item);
			} elseif (is_array($item)) {
				return self::array_trim($item);
			} else
				return $item;
		}, $items);
	}

	/**
	* Sanitize the inputs based on the rules an optionally trim the string
	* * Still allow IMG AUDIO, and VIDEO tag
	* @param array $inputs
	* @param array $fields
	* @param int $default_filter FILTER_SANITIZE_STRING
	* @param array $filters FILTERS
	* @param bool $trim
	* @return array same as `input` array but with all data sanitized
	*/
	public static function sanitizeArray(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): array
	{
		if ($fields) {
			$options = array_map(fn($field) => self::excludeSomeTags($filters[$field]), $fields);
			$data = filter_var_array($inputs, $options);
		} else {
			$data = filter_var_array($inputs, $default_filter);
		}

		$results =  $trim ? self::array_trim($data) : $data;
		foreach ($results as $key => $value) {
			$result = $value;
			$results[$key] = $result;			
		}
		

		return $results;
	}
	public static function sanitizeArrayWithKeysLowercase(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): array
	{
		if ($fields) {
			$options = array_map(fn($field) => self::excludeSomeTags($filters[$field]), $fields);
			$data = filter_var_array($inputs, $options);
		} else {
			$data = filter_var_array($inputs, $default_filter);
		}

		$results =  $trim ? self::array_trim($data) : $data;
		foreach ($results as $key => $value) {
			$result = $value;
			$results[$key] = $result;
			//$results[strtolower($key)] = $result;
		}
		
		$results = array_change_key_case($results, CASE_LOWER);
		return $results;
	}
	public static function sanitizeArrayExcept(array $inputs, string $exceptField, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): array {
		if ($fields) {
			$options = array_map(
				fn($field, $filters, $exceptField) => $exceptField!=$field? self::excludeSomeTags($filters[$field]):$filters[$field] ,
				$fields);
			$data = filter_var_array($inputs, $options);
		} else {
			$data = filter_var_array($inputs, $default_filter);
		}

		$results =  $trim ? self::array_trim($data) : $data;
		foreach ($results as $key => $value) {
			$result = $value;
			$results[$key] = $result;
		}
	

	return $results;
	}

	/**
	 * Sanitize String only.
	 * Still enable IMG AUDIO, and VIDEO tag
	 * @return string
	 */
	public static function sanitize(mixed $input, mixed $type = "string", int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): mixed
	{
		$result = self::sanitizeArray(['data'=>$input], ['data' => $type], $default_filter, $filters, $trim)['data'];			
		return $result;
	}

	/**
	 * Exclude some tags like IMG, VIDEO, AUDIO
	 * @return string proccessed text and supporting above tags
	 */
	public static function excludeSomeTags(mixed $input)
	{	
		//[[-img src="" -img]]	=> <img src=""/>
		$result = preg_replace("/<img/", "/\[\[-img/", $input);
		$result = preg_replace("/<\/>/", "/-img\]\]/", $result);
		//$result = preg_replace("/on.+/", "ignore", $result);
		return $result;
	}

	/**
	 * Format Html Text and clean up them before printing to web.
	 * * Convert internal IMG, AUDIO, VIDEO back to HTML tag
	 * @return string HTML formated text
	 */
	public static function formatHtmlText(mixed $input)
	{	
		//[[-img src="" -img]]	=> <img src=""/>
		$result = preg_replace("/\[\[-img/", "<img ", $input);
		$result = preg_replace("/-img\]\]/", " />", $result);
		//$result = preg_replace("/on.+=/", "ignore", $result);
		return $result;
	}

	public static function lowerCaseArrayKeys(array $inputs): array
	{
		$results = array_change_key_case($inputs, CASE_LOWER);
		return $results;
	}
}

?>