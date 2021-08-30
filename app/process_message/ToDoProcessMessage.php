<?php
declare(strict_types = 1);

namespace app\process_message;

class ToDoProcessMessage extends ProcessMessage {
	
	protected static $labelName = 'TODO';
	
	protected function formingIsAcceptable(): bool {
		$thisLabelNameInPreviousLabelsChanges = $this->checkThisLabelNameInCertainLabels('previous');
		$thisLabelNameInCurrentLabelsChanges = $this->checkThisLabelNameInCertainLabels('current');
		
		$formingIsAcceptable = !empty($this->assigneeName)
			&& $this->arrayHasLabelForBoardProcess($this->issue->getLabelsTitles(), self::$labelName)
			&& !$this->issue->changesHasTitleOrDescription()
			&& (!$this->issue->countOfLabelsChanged() || ($this->issue->countOfLabelsChanged() && !$thisLabelNameInPreviousLabelsChanges && $thisLabelNameInCurrentLabelsChanges));
		
		return $formingIsAcceptable;
	}
	
	private function checkThisLabelNameInCertainLabels(string $previousOrCurrentType): bool {
		$issueLabelsChanges = $this->issue->getChanges()['labels'];
		$labels = $issueLabelsChanges[$previousOrCurrentType];
		
		if (is_null($issueLabelsChanges) || empty($labels))
			return true;
		
		return in_array(self::$labelName, array_column($labels, 'title'), true);
	}
}