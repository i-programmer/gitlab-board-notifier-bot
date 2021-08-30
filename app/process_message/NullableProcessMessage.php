<?php
declare(strict_types = 1);

namespace app\process_message;

class NullableProcessMessage extends  ProcessMessage {
	
	protected static $labelName = 'nullable';
	
	protected function form() {
		$this->message = self::DEFAULT_EMPTY_MESSAGE;
	}
}