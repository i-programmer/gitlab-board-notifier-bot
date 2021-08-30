<?php
declare(strict_types = 1);

namespace app;

/**
 * class Issue provides information about issue that currently operating
 */
class Issue {
	
	private $id = 0;
	private $title = '';
	private $url = '';
	private $labelsTitles = [];
	private $changes = [];
	
	public function __construct(array $issueData, array $changes) {
		$this->id = $issueData['iid'];
		$this->title = $issueData['title'];
		
		if (mb_strlen($this->title) >= 40)
			$this->title = mb_substr($this->title, 0, 37) . '...';
		
		$this->url = $issueData['url'];
		$this->labelsTitles = array_column($issueData['labels'], 'title');
		$this->changes = $changes;
	}
	
	public function getId(): int {
		return $this->id;
	}
	
	public function getTitle(): string {
		return $this->title;
	}
	
	public function getUrl(): string {
		return $this->url;
	}
	
	public function getLabelsTitles(): array {
		return $this->labelsTitles;
	}
	
	public function getChanges(): array {
		return $this->changes;
	}
	
	public function countOfLabelsChanged(): bool {
		return count($this->changes['labels']['previous']) !== count($this->changes['labels']['current']);
	}
	
	public function changesHasTitleOrDescription(): bool {
		return count($this->changes) > 0 && (array_key_exists('title', $this->changes) || array_key_exists('description', $this->changes));
	}
	
	public function changesIsInRelativePositionOnly(): bool {
		return count($this->changes) === 1 && array_key_exists('relative_position', $this->changes);
	}
}