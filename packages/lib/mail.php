<?php
namespace ez\app;

class mail {

	public $from;
	public $to;
	public $subject;
	public $body;
	public $cc = array();
	public $headers = array();

	public function __construct($type = 'text/html; charset=ISO-8859-1', $mime = '1.0') {
		$this->header('MIME-Version', $mime);
		$this->header('Content-Type', $type);
	}

	public function from($address) {
		if(is_string($address)) {
			$this->header('From', strip_tags($address));
			$this->from = $address;
		}
	}

	public function to($recipients) {
		if(is_string($recipients)) $this->to = $recipients;
	}

	public function cc($recipient) {
		array_push($this->cc, $recipient);
		if(!isset($this->headers['CC'])) $this->header('CC', $recipient);
	}

	public function reply($address) {
		$this->header('Reply-To', strip_tags($address));
	}

	public function subject($subject) {
		if(is_string($subject)) $this->subject = $subject;
	}

	public function body($body) {
		if(is_string($body)) $this->body = $body;
	}

	public function header($header, $value) {
		if(strtoupper($header) != 'CC') {
			if(isset($this->header[$header])) unset($this->header[$header]);
			$this->headers[$header] = $value;
		}
	}

	public function build_headers() {
		$headers = '';
		foreach($this->headers as $header => $value) {
			$headers .= "$header: $value\r\n";
		}
		foreach($this->cc as $cc) {
			$headers .= "CC: $cc\r\n";
		}
		return $headers;
	}

	public function send() {
		return mail($this->to, $this->subject, $this->body, $this->build_headers());
	}

	public function debug() {
		return array(
			'from' => $this->from,
			'to' => $this->to,
			'subject' => $this->subject,
			'body' => $this->body,
			'cc' => $this->cc,
			'headers' => $this->build_headers(),
		);
	}

}
