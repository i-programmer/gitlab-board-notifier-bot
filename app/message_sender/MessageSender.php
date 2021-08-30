<?php
declare(strict_types = 1);

namespace app\message_sender;

/**
 * Base class for Message Senders (Telegram. Discord, etc.)
 */
abstract class MessageSender {
	
	protected $message = '';
	
	public function __construct(string $message) {
		$this->message = $message;
	}
	
	public function send() {
		if (empty($this->message))
			return;

		$requestString = $this->formRequestString();
		file_get_contents($requestString);
	}
	
	/**
	 * Request string which must be sent to a concrete messenger
	 *
	 * @return string
	 */
	protected abstract function formRequestString(): string;
}