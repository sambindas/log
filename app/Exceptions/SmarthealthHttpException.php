<?php

namespace App\Exceptions;

class SmarthealthHttpException extends \Exception {
	
	protected $status_code;
	protected $message;
	
	function __construct($status_code, $message, $error='') {
		$this->status_code = $status_code;
        if (is_array($message)) {
            $message = implode(',', $message);
        }
		$this->message = $message.' '.$error;
	}
	
	function getStatusCode() {
		return $this->status_code;
	}
	
	function getStatus() {
		return $this->message;
	}
	
}

