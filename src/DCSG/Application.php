<?php
/**
 * This file is part of the how-to-build-console-applications package.
 *
 * (c) Daniel Gomes <me@danielcsgomes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DCSG;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends BaseApplication implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        // Configure the container - usually the container is defined in an external file
        $container = new ContainerBuilder();
        $container->register('filesystem', '%filesystem.class%');
        $container->register('finder', '%finder.class%');

        // Set the parameters - usually in an external file
        $container->setParameter('filesystem.class', 'Symfony\Component\Filesystem\Filesystem');
        $container->setParameter('finder.class', 'Symfony\Component\Finder\Finder');

        // set the container
        $this->setContainer($container);
    }

    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 