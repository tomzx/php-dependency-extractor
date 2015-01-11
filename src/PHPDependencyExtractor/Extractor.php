<?php

namespace PHPDependencyExtractor;

use PHPDependencyExtractor\Registry\Registry;
use PHPDependencyExtractor\Visitor\TrackedNameResolver;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\Parser;

class Extractor
{
	/**
	 * @var \PhpParser\Parser
	 */
	protected $parser;

	public function __construct()
	{
		$this->parser = new Parser(new Emulative());
	}

	/**
	 * @param $file
	 * @return array
	 */
	public function file($file)
	{
		$script = file_get_contents($file);
		return $this->extractFromString($script);
	}

	/**
	 * @param $string
	 * @return array
	 */
	public function extractFromString($code)
	{
		$traverser = new NodeTraverser();
		$registry = new Registry();

		$traverser->addVisitor(new TrackedNameResolver($registry));

		try {
			$statements = $this->parser->parse($code);
			$statements = $traverser->traverse($statements);
		} catch (Error $e) {
			echo 'Parse Error: ', $e->getMessage();
			return;
		}

		$dependencies = $registry->getEntries();
		sort($dependencies);
		return $dependencies;
	}
}
