<?php

class Logger{

	const INFO = "INFO";
	const DEBUG = "DEBUG";
	const ERROR = "ERROR";
	
	static function log($type, $text) {
		
		$logText = date("Y-m-d h:i:s") . " " . $type . " " . $text . PHP_EOL;
		
		$file = "../logs.txt";
		file_put_contents($file, $logText, FILE_APPEND);
	}
	
	static function info($text) {
		Logger::log(Logger::INFO, $text);
	}
	
	static function debug($text) {
		Logger::log(Logger::DEBUG, $text);
	}
	
	static function error($text) {
		Logger::log(Logger::ERROR, $text);
	}
}
?>