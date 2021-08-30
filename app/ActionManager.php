<?php
declare(strict_types = 1);

namespace app;

use app\process_message\{
	ProcessMessage,
	ProcessMessageManager,
	OpenProcessMessage,
	ReopenProcessMessage,
	CloseProcessMessage,
	NullableProcessMessage
};

/**
 * Handles type of requested action and transmits control to a concrete action
 */
class ActionManager {

	const ACTION_TYPE_OPEN = 'open';
	const ACTION_TYPE_REOPEN = 'reopen';
	const ACTION_TYPE_CLOSE = 'close';
	const ACTION_TYPE_UPDATE = 'update';

	private $action = '';
	private $postData = [];
	private $issue;
	
	public function __construct(string $action, array $postData, Issue $issue) {
		$this->action = $action;
		$this->postData = $postData;
		$this->issue = $issue;
	}
	
	public function getProcessMessage(): ProcessMessage {
		$processMessagesMap = ProcessMessageManager::processMessagesMap();

		$processMessageClassName = [
			self::ACTION_TYPE_OPEN => $processMessagesMap[OpenProcessMessage::getLabelName()],
			self::ACTION_TYPE_REOPEN => $processMessagesMap[ReopenProcessMessage::getLabelName()],
			self::ACTION_TYPE_CLOSE => $processMessagesMap[CloseProcessMessage::getLabelName()],
			self::ACTION_TYPE_UPDATE => $this->getProcessMessageForUpdateAction()
		][$this->action];

		$processMessage = new $processMessageClassName($this->postData, $this->issue);
		
		return $processMessage;
	}
	
	private function getProcessMessageForUpdateAction(): string {
		$labelsTitles = $this->issue->getLabelsTitles();
		$processMessagesMap = ProcessMessageManager::processMessagesMap();

		$currentProcessMessageLabelName = array_values(array_filter($labelsTitles, function($labelTitle) use ($processMessagesMap) {
			return array_key_exists($labelTitle, $processMessagesMap);
		}))[0];
		
		if (is_null($currentProcessMessageLabelName))
			return $processMessagesMap[NullableProcessMessage::getLabelName()];
		
		return $processMessagesMap[$currentProcessMessageLabelName];
	}
}