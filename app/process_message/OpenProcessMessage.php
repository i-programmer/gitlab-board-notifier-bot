<?php
declare(strict_types = 1);

namespace app\process_message;

class OpenProcessMessage extends  ProcessMessage {
	
	protected static $labelName = 'Открыт';
	
	protected function form() {
		$this->message = self::DEFAULT_EMPTY_MESSAGE;
	}
}