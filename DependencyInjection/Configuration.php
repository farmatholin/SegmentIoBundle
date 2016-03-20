<?php

namespace Farmatholin\SegmentIoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Farmatholin\SegmentIoBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('segment_io');

        $rootNode
            ->children()
                ->scalarNode('write_key')
                    ->cannotBeEmpty()
                    ->isRequired()
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
