<?php

namespace PHPDependencyExtractor\Registry;

class Registry
{
	/**
	 * @var array
	 */
	protected $namespaces = [];

	/**
	 * @param $namespace
	 */
	public function add($namespace)
	{
		$this->namespaces[$namespace] = true;
	}

	/**
	 * @return array
	 */
	public function getEntries()
	{
		return array_keys($this->namespaces);
	}
}
