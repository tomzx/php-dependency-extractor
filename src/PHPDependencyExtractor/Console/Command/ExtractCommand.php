<?php

namespace PHPDependencyExtractor\Console\Command;

use File_Iterator_Facade;
use PHPDependencyExtractor\Extractor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExtractCommand extends Command {
	protected function configure()
	{
		$this
			->setName('extract')
			->setDescription('Extract dependencies')
			->setDefinition([
				new InputArgument('target', InputArgument::REQUIRED, 'A directory to extract dependencies from'),
				new InputOption('format', null, InputOption::VALUE_OPTIONAL, 'To output in another format <info>(default: txt)</info>', 'txt'), // TODO: Support other formats such as xml/json <tom@tomrochette.com>
				new InputOption('why', null, InputOption::VALUE_NONE, 'Display where each namespace is used'),
			]);
	}

	/**
	 * @param \Symfony\Component\Console\Input\InputInterface   $input
	 * @param \Symfony\Component\Console\Output\OutputInterface $output
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$fileIterator = new File_Iterator_Facade;
		$files = $input->getArgument('target');
		$files = $fileIterator->getFilesAsArray($files, '.php');

		$extractor = new Extractor();
		$results = [];

		$progress = new ProgressBar($output, count($files));
		foreach ($files as $file) {
			$results[$file] = $extractor->file($file);
			$progress->advance();
		}
		$progress->clear();

		$namespaces = [];
		foreach ($results as $file => $result) {
			foreach ($result as $dependency) {
				$namespaces[$dependency][] = $file;
			}
		}
		ksort($namespaces);

		$output->writeln(''); // line break (due to the progress bar not completely clearing out)
		if ($input->getOption('why')) {
			foreach ($namespaces as $namespace => $files) {
				$output->writeln($namespace);
				foreach ($files as $file) {
					$output->writeln("\t" . $file);
				}
			}
		} else {
			foreach (array_keys($namespaces) as $namespace) {
				$output->writeln($namespace);
			}
		}
	}
}
