<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Progress extends Command
{
    protected function configure()
    {
        $this->setName('progress');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
$progress = $this->getHelperSet()->get('progress');

$progress->start($output, 50);
$i = 0;
while ($i++ < 50) {
    $progress->advance();
}

$progress->finish();
    }
}


$app = new Application();
$app->add(new \Progress());
$app->run(new ArrayInput(array('command' => 'progress')));

