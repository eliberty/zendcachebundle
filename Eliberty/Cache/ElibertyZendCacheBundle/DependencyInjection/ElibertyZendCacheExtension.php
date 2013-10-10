<?php

namespace Eliberty\Cache\ElibertyZendCacheBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ElibertyZendCacheExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('manager.xml');

        $templates = array();
        foreach ($configs as $config) {
            if (isset($config['templates'])) {
                $templates = array_merge($templates, $config['templates']);
            }
        }

        foreach ($templates as $name => $template) {
            $container->findDefinition('eliberty_zend_cache.manager')->addMethodCall('setCacheTemplate', array($name, $template));
        }
    }
}
