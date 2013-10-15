<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Select extends Command
{
    protected function configure()
    {
        $this->setName('select');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
$colors = array('Red', 'Blue', 'Green', 'Yellow');

// Ask the user if it's the right directory
$dialog = $this->getHelperSet()->get('dialog');
$colorIndex = $dialog->select(
    $output,
    'What color do you like?',
    $colors
);

// Writes the Output
$output->writeln(
    sprintf('The color you like is <info>%s</info>.', $colors[$colorIndex])
);
    }
}


$app = new Application();
$app->add(new \Select());
$app->run(new ArrayInput(array('command' => 'select')));

