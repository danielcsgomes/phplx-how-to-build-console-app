<?php

namespace DCSG\Tests;

use DCSG\Application;
use DCSG\ClearCacheCommand;
use DCSG\Command\CacheClearCommand;
use Symfony\Component\Console\Tester\CommandTester;

class CacheClearCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testCacheClear()
    {
        $application = new Application();
        $application->add(new CacheClearCommand());

        $baseDir = '/tmp/testCacheClear';
        $filename = $baseDir . '/test.txt';

        if (!is_dir($baseDir)) {
            mkdir($baseDir);
        }
        touch($filename);
        $this->assertFileExists($filename);

        // Mock the DialogHelper
        $dialog = $this->getMock('Symfony\Component\Console\Helper\DialogHelper', array('askConfirmation'));
        $dialog->expects($this->once())
            ->method('askConfirmation')
            ->will($this->returnValue('yes'));

        $command = $application->find('cache:clear');
        $command->getHelperSet()->set($dialog, 'dialog');

        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                 'command' => 'cache:clear',
                 'directory' => $baseDir
            )
        );

        $this->assertFileNotExists($filename);
    }
}
