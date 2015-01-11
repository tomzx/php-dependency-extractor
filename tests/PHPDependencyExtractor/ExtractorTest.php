<?php

use PHPDependencyExtractor\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
	public function testExtractFromStringExtractsUse()
	{
		$script = '<?php use test\testnamespace;';
		$extractor = new Extractor();
		$usages = $extractor->extractFromString($script);

		$this->assertCount(1, $usages);
		$this->assertEquals('test\testnamespace', $usages[0]);
	}

	public function testExtractFromStringExtractsUseList()
	{
		$script = '<?php use test\testnamespace, test\testnamespace2;';
		$extractor = new Extractor();
		$usages = $extractor->extractFromString($script);

		$this->assertCount(2, $usages);
		$this->assertEquals('test\testnamespace', $usages[0]);
		$this->assertEquals('test\testnamespace2', $usages[1]);
	}

	public function testExtractFromStringExtractsInlineNamespaceNew()
	{
		$script = '<?php $x = new A\B\C();';
		$extractor = new Extractor();
		$usages = $extractor->extractFromString($script);

		$this->assertCount(1, $usages);
		$this->assertEquals('A\B\C', $usages[0]);
	}

	public function testExtractFromStringExtractsPartiallyDeclaredInlineNamespace()
	{
		$script = '<?php use A\B; $x = new B\C();';
		$extractor = new Extractor();
		$usages = $extractor->extractFromString($script);

		$this->assertCount(2, $usages);
		$this->assertEquals('A\B', $usages[0]);
		$this->assertEquals('A\B\C', $usages[1]);
	}

	public function testExtractFromStringExtractsInlineNamespaceStaticCall()
	{
		$script = '<?php $x = A\B\C::d();';
		$extractor = new Extractor();
		$usages = $extractor->extractFromString($script);

		$this->assertCount(1, $usages);
		$this->assertEquals('A\B\C', $usages[0]);
	}
}
