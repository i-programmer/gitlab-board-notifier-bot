<?php
declare(strict_types=1);

namespace app\message_sender;

use app\ConfigReader;
use config\Config;

/**
 * Concrete realization of messenger (for telegram bot)
 */
class TelegramMessageSender extends MessageSender {

	public function formRequestString (): string {
		$config = ConfigReader::getByKey(Config::API_TYPE_TELEGRAM);

		$params = [
			'text' => $this->message,
			'chat_id' => $config['chat_id'],
			'parse_mode' => $config['parse_mode'],
		];

		return "https://api.telegram.org/bot{$config['token']}/sendMessage?" . http_build_query($params);
	}
}