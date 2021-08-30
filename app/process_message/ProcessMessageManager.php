<?php
declare(strict_types = 1);

namespace app\process_message;

class ProcessMessageManager {
	
	public static function processMessagesMap(): array {
		return [
			OpenProcessMessage::getLabelName() => OpenProcessMessage::class,
			ReopenProcessMessage::getLabelName() => ReopenProcessMessage::class,
			CloseProcessMessage::getLabelName() => CloseProcessMessage::class,

			ToDoProcessMessage::getLabelName() => ToDoProcessMessage::class,
			FixmeProcessMessage::getLabelName() => FixmeProcessMessage::class,
			CodeReviewProcessMessage::getLabelName() => CodeReviewProcessMessage::class,
			TestingProcessMessage::getLabelName() => TestingProcessMessage::class,
			WaitingForMergeProcessMessage::getLabelName() => WaitingForMergeProcessMessage::class,
			
			NullableProcessMessage::getLabelName() => NullableProcessMessage::class
		];
	}
}