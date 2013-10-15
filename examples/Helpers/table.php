<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Table extends Command
{
    protected function configure()
    {
        $this->setName('table');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table
            ->setHeaders(array('Color', 'HEX'))
            ->setRows(
                array(
                     array('Red', '#ff0000'),
                     array('Blue', '#0000ff'),
                     array('Green', '#008000'),
                     array('Yellow', '#ffff00')
                )
            );
        $table->render($output);
    }
}


$app = new Application();
$app->add(new \Table());
$app->run(new ArrayInput(array('command' => 'table')));

