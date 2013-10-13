<?php
/**
 * This file is part of the how-to-build-console-applications package.
 *
 * (c) Daniel Gomes <me@danielcsgomes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DCSG\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CacheClearCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('cache:clear')
            ->setDescription('Clears Application Cache')
            ->addArgument('directory', InputArgument::OPTIONAL, 'The cache directory', './cache')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Forces to clear the cache.')
            ->setHelp(
                <<<EOF
                The <info>cache:clear</info> command removes all files inside the <info>cache directory</info>.
EOF
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Reads the Input
        $directory = $input->getArgument('directory');

        // Validate the input
        if (false === $cacheDir = realpath($directory)) {
            throw new \InvalidArgumentException('Directory does not exist.');
        }

        $force = $input->getOption('force');

        // Ask the user if it's the right directory
        $dialog = $this->getHelperSet()->get('dialog');
        $answer = $dialog->askConfirmation(
            $output,
            sprintf('Remove all files inside: %s ? (no) ', $cacheDir),
            false
        );

        if (!$answer) {
            exit;
        }

        // Logic
        $container = $this->getApplication()->getContainer();
        $fs = $container->get('filesystem');
        $finder = $container->get('finder');

        if (!$fs->exists($cacheDir)) {
            $fs->mkdir($cacheDir);
        }

        if (!$fs->exists($cacheDir . '/test.txt')) {
            $fs->touch($cacheDir . '/test.txt');
        }

        $files = $finder->in($cacheDir);
        $counter = count($files);
        $fs->remove($files);

        // Writes the Output
        $output->writeln(
            sprintf('Cache cleared. Removed %d files.', $counter)
        );
    }
}