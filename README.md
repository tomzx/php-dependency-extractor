#PHP Dependency Extractor

[![Build Status](https://travis-ci.org/tomzx/php-dependency-extractor.svg)](https://travis-ci.org/tomzx/php-dependency-extractor)
[![Total Downloads](https://poser.pugx.org/tomzx/php-dependency-extractor/downloads.svg)](https://packagist.org/packages/tomzx/php-dependency-extractor)
[![Latest Stable Version](https://poser.pugx.org/tomzx/php-dependency-extractor/v/stable.svg)](https://packagist.org/packages/tomzx/php-dependency-extractor)
[![Latest Unstable Version](https://poser.pugx.org/tomzx/php-dependency-extractor/v/unstable.svg)](https://packagist.org/packages/tomzx/php-dependency-extractor)
[![License](https://poser.pugx.org/tomzx/php-dependency-extractor/license.svg)](https://packagist.org/packages/tomzx/php-dependency-extractor)

`PHP Dependency Extractor` is a command line tool that will parse a directory of PHP source code to extract dependencies.

As it currently stands, `PHP Dependency Extractor` will extract the list of namespaces used. This can allow you, for instance, to figure out which libraries are used (or not).

## Getting started

1. Install `php-dependency-extractor` through composer, either globally or locally:

Locally
```bash
php composer require --dev tomzx/php-dependency-extractor
```

Globally
```bash
php composer global require tomzx/php-dependency-extractor
```

See the example section for examples of how to use the tool.

## Example

```bash
php bin/php-dependency-extractor extract --why target-path

File_Iterator_Facade
PHPDependencyExtractor\Console\Command\ExtractCommand
PHPDependencyExtractor\Extractor
PHPDependencyExtractor\Registry\Registry
PHPDependencyExtractor\Visitor\TrackedNameResolver
PhpParser\Lexer\Emulative
PhpParser\Node
PhpParser\NodeTraverser
PhpParser\NodeVisitor\NameResolver
PhpParser\Node\Stmt\UseUse
PhpParser\Parser
Symfony\Component\Console\Application
Symfony\Component\Console\Command\Command
Symfony\Component\Console\Helper\ProgressBar
Symfony\Component\Console\Input\InputArgument
Symfony\Component\Console\Input\InputInterface
Symfony\Component\Console\Input\InputOption
Symfony\Component\Console\Output\OutputInterface
```

## License

The code is licensed under the [MIT license](http://choosealicense.com/licenses/mit/). See LICENSE.
