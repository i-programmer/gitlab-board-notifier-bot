<?php
declare(strict_types = 1);

namespace app\process_message;

use ReflectionClass;

class ProcessMessageManager {
	
	private static $processMessagesMap = [];
	
	public static function initMap() {
		$files = array_diff(scandir(__DIR__), ['.', '..']);
		$namespace = __NAMESPACE__;
		
		foreach ($files as $file) {
			$fileName = pathinfo($file, PATHINFO_FILENAME);
			$processMessageClass = "$namespace\\$fileName";
			$class = new ReflectionClass($processMessageClass);
			
			if ($class->isSubclassOf(ProcessMessage::class)) {
				$result = call_user_func($processMessageClass . '::getLabelName');
				self::$processMessagesMap[$result] = $processMessageClass;
			}
		}
	}
	
	public static function getProcessMessagesMap(): array {
		return self::$processMessagesMap;
	}
}