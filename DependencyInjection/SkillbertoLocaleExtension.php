<?php

namespace Skillberto\LocaleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SkillbertoLocaleExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['locale_file']) {
            $container->setParameter("skillberto_locale.locale_file", $config['locale_file']);
        } else {
            $container->setParameter("skillberto_locale.params.actual_locale", $config['params']['actual_locale']);
            $container->setParameter("skillberto_locale.params.actual_locales", $config['params']['actual_locales']);
            $container->setParameter("skillberto_locale.params.existed_locales", $config['params']['existed_locales']);
        }
    }
}
