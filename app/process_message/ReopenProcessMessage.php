<?php
declare(strict_types = 1);

namespace app\process_message;

class ReopenProcessMessage extends  ProcessMessage {
	
	protected static $labelName = 'Переоткрыт';
	
	protected function formingIsAcceptable(): bool {
		return true;
	}
}