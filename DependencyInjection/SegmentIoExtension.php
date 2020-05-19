<?php

/**
 * This file is part of the SegmentIoBundle project.
 *
 * (c) Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 */

namespace Farmatholin\SegmentIoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SegmentIoExtension
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
class SegmentIoExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('farma.segment_io_write_key', $config['write_key']);
        $container->setParameter('farma.segment_io_sources', $config['sources']??[]);
        $container->setParameter('farma.segment_io_guest_id', $config['guest_id']);
        $container->setParameter('farma.segment_io_env', $config['env']);
        $container->setParameter('farma.segment_io_options', $config['options']);
    }
}
