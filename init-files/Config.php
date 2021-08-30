<?php
declare(strict_types=1);

namespace config;

/**
 * Class Config

 * config data
 */
class Config {

	const API_TYPE_TELEGRAM = 'telegram';
	const API_TYPE_WHATSAPP = 'whatsapp';
	const API_TYPE_DISCORD = 'discord';

	public static function get() {
		return [
			self::API_TYPE_TELEGRAM => [
				'token' => '',
				'chat_id' => '',
				'parse_mode' => 'HTML', // do not change. Notifier is working in the HTML parse made
			],
			self::API_TYPE_WHATSAPP => [

			],
			self::API_TYPE_DISCORD => [

			],
		];
	}
}