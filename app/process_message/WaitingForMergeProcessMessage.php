<?php
declare(strict_types = 1);

namespace app\process_message;

class WaitingForMergeProcessMessage extends ProcessMessage {
	
	protected static $labelName = 'Ожидает слияния';
}