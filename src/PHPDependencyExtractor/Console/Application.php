<?php

namespace PHPDependencyExtractor\Console;

use PHPDependencyExtractor\Console\Command\ExtractCommand;
use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends SymfonyApplication {

	private static $VERSION = '0.1';

	private static $logo = '               __
    ____  ____/ /__
   / __ \/ __  / _ \
  / /_/ / /_/ /  __/
 / .___/\__,_/\___/
/_/
';

	public function __construct()
	{
		parent::__construct('PHP Dependency Extractor by Tom Rochette', static::$VERSION);
	}

	public function getHelp()
	{
		return self::$logo . parent::getHelp();
	}

	protected function getDefaultCommands()
	{
		$commands = parent::getDefaultCommands();
		$commands[] = $this->add(new ExtractCommand());
		return $commands;
	}
}
