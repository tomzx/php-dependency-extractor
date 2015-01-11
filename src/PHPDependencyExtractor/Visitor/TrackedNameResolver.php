<?php

namespace PHPDependencyExtractor\Visitor;

use PHPDependencyExtractor\Registry\Registry;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\NodeVisitor\NameResolver;

class TrackedNameResolver extends NameResolver
{
	/**
	 * @var \PHPDependencyExtractor\Registry\Registry
	 */
	protected $registry;

	/**
	 * @param \PHPDependencyExtractor\Registry\Registry $registry
	 */
	public function __construct(Registry $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * @param \PhpParser\Node $node
	 */
	public function enterNode(Node $node)
	{
		parent::enterNode($node);

		if ($node instanceof UseUse) {
			$name = $node->name->toString();
			$this->registry->add($name);
		} elseif ($node instanceof Expr\StaticCall
			|| $node instanceof Expr\StaticPropertyFetch
			|| $node instanceof Expr\ClassConstFetch
			|| $node instanceof Expr\New_
			|| $node instanceof Expr\Instanceof_
		) {
			if ($node->class instanceof Name) {
				$name = $node->class->toString();
				$this->registry->add($name);
			}
		}
	}
}