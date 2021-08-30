<?php
declare(strict_types = 1);

namespace app\process_message;

class CloseProcessMessage extends  ProcessMessage {
	
	protected static $labelName = 'Закрыт. Залит на dev.';
	
	protected function formingIsAcceptable(): bool {
		return true;
	}
}