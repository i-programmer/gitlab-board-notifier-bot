<?php

require './vendor/autoload.php';

use app\{
	Issue,
	ActionManager,
	ConfigReader,
	process_message\ProcessMessageManager
};
use app\message_sender\TelegramMessageSender;
use config\Config;

$rawJson = file_get_contents('php://input');
$postData = json_decode($rawJson, true);

ConfigReader::set(Config::get());
ProcessMessageManager::initMap();

$issue = new Issue($postData['object_attributes'], $postData['changes']);
$actionManager = new ActionManager($postData['object_attributes']['action'], $postData, $issue);
$processMessage = $actionManager->getProcessMessage();

(new TelegramMessageSender($processMessage->get()))->send();
