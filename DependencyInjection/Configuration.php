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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('segment_io');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('segment_io');
        }

        $rootNode
            ->children()
                ->scalarNode('write_key')
                    ->defaultValue('')
                ->end()
                ->arrayNode('sources')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('name')->end()
                            ->scalarNode('write_key')->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('guest_id')
                    ->defaultValue('guest')
                ->end()
                ->enumNode('env')
                    ->values(['dev', 'prod'])
                    ->defaultValue('prod')
                ->end()
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('consumer')
                            ->defaultValue('socket')
                        ->end()
                        ->booleanNode('debug')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('ssl')
                            ->defaultFalse()
                        ->end()
                        ->integerNode('max_queue_size')
                            ->defaultValue(10000)
                        ->end()
                        ->integerNode('batch_size')
                            ->defaultValue(100)
                        ->end()
                        ->floatNode('timeout')
                            ->defaultValue(0.5)
                        ->end()
                        ->scalarNode('filename')
                            ->defaultValue(null)
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
