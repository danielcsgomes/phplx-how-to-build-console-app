<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Formatter extends Command
{
    protected function configure()
    {
        $this->setName('formatter');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
$formatter = $this->getHelperSet()->get('formatter');

$formattedLine = $formatter->formatSection(
    'SomeSection',
    'Here is some message related to that section'
);
$output->writeln($formattedLine);
$errorMessages = array('Something went wrong');
$formattedBlock = $formatter->formatBlock($errorMessages, 'error');
$output->writeln($formattedBlock);

$errorMessages = array('Custom Colors');
$formattedBlock = $formatter->formatBlock($errorMessages, 'bg=blue;fg=white');
$output->writeln($formattedBlock);
    }
}


$app = new Application();
$app->add(new \Formatter());
$app->run(new ArrayInput(array('command' => 'formatter')));

