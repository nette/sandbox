<?php declare(strict_types = 1);

namespace App\Model;


class HelloCommand extends \Symfony\Component\Console\Command\Command
{

	public function configure(): void
	{
		$this->setName('app:hello')
			->setDescription('It will greet you')
			->addOption('force', 'f');
	}


	protected function execute(
		\Symfony\Component\Console\Input\InputInterface $input,
		\Symfony\Component\Console\Output\OutputInterface $output
	)
	{
		$force = $input->getOption('force');

		$output->writeln('Ahoj');

		if ($force) {
			$output->writeln('💣💣');
		}
	}

}
