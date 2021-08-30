<?php
declare(strict_types=1);

namespace app;

/**
 * Class ConfigReader

 * holds config data
 */
class ConfigReader {

	/**
	 * @var array Config data
	 */
	private static $config = [];

	/**
	 * @param array $config
	 */
	public static function set(array $config) {
		self::$config = $config;
	}

	/**
	 * @return array
	 */
	public static function get(): array {
		return self::$config;
	}

	/**
	 * @param string $key
	 *
	 * @return array
	 */
	public static function getByKey(string $key): array {
		return self::$config[$key];
	}
}