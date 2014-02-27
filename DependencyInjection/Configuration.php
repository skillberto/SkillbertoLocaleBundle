<?php

namespace Skillberto\LocaleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('skillberto_locale');

        $rootNode
            ->children()
                ->arrayNode('params')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('actual_locale')
                            ->defaultValue('locale')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('actual_locales')
                            ->defaultValue('locales')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('existed_locales')
                            ->defaultValue('all_locales')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('locale_file')
                ->end()
            ->end()
        ;


        return $treeBuilder;
    }
}
