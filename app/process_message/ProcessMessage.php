<?php
declare(strict_types = 1);

namespace app\process_message;

use app\Issue;

/**
 * Base class for all process messages (open, close, etc.)
 */
abstract class ProcessMessage {
	
	const DEFAULT_EMPTY_MESSAGE = '';
	
	/** @var Issue $issue */
	protected $issue;
	
	protected $assigneeName = '';
	protected $assigneeNick = '';
	protected static $labelName = '';
	
	protected $message = self::DEFAULT_EMPTY_MESSAGE;
	
	public function __construct(array $postData, Issue $issue) {
		$this->issue = $issue;
		$assignee = $postData['assignees'][0]; // Во free версии нельзя прикрепить больше одного, поэтому можно смело брать одного по индексу 0
		
		$this->assigneeName = $this->getUserFullNameWithShortedName($assignee['name'] ?? '');
		$this->assigneeNick = $assignee['username'] ?? '';
		
		if (!$this->issue->changesIsInRelativePositionOnly() && $this->formingIsAcceptable())
			$this->form();
	}
	
	public static function getLabelName(): string {
		return static::$labelName;
	}
	
	/**
	 * Returns a concrete message from a concrete realization of process messenger
	 * By default it returns a message, that pointed in a class property
	 *
	 * @return string
	 */
	public function get(): string {
		return $this->message;
	}
	
	/**
	 * Template of messages
	 *
	 * @return string
	 */
	protected function getTemplateWithCustomLabelName(): string {
		$labelName = static::$labelName;
		$message = <<<MESSAGE
🦊
<a href="{$this->issue->getUrl()}">#{$this->issue->getId()}</a> ($this->assigneeName) - {$labelName}
"{$this->issue->getTitle()}"


MESSAGE;
		
		return $message;
	}
	
	/**
	 * Forms an output message
	 *
	 * @return void
	 */
	protected function form() {
		$this->message = $this->getTemplateWithCustomLabelName();
	}
	
	/**
	 * Sets flag if forming message is acceptable.
	 * If not - no message will be sent
	 *
	 * Necessary, If we don't want to send any message, for example for "Open" issues
	 *
	 * @return bool
	 */
	protected function formingIsAcceptable(): bool {
		return $this->arrayHasLabelForBoardProcess($this->issue->getLabelsTitles(), static::$labelName) && !$this->issue->countOfLabelsChanged();
	}
	
	/**
	 * Check if item has label for process entity (not open or close)
	 *
	 * @param array $boardProcessLabelsTitles
	 * @param string $labelName
	 *
	 * @return bool
	 */
	protected function arrayHasLabelForBoardProcess(array $boardProcessLabelsTitles, string $labelName): bool {
		return in_array($labelName, $boardProcessLabelsTitles);
	}
	
	/**
	 * Returns full username with a shorted name.
	 * For properly usage assignee name must be set as "name surname",
	 * e.g. "Владимир Петров", "Сергей Волков", "Aleister Black"
	 *
	 * or this method must be rewritten
	 *
	 * @param string $fullName
	 *
	 * @return string
	 */
	private function getUserFullNameWithShortedName(string $fullName): string {
		if (empty($fullName))
			return '';
		
		$nameExploded = explode(' ', $fullName);
		$changedFullName = mb_substr($nameExploded[0], 0, 1) . '. ' . $nameExploded[1];
		
		return $changedFullName;
	}
}