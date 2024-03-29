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
        //print_r($configs);exit;
        $container->register('eliberty.zend_cache')
            ->setClass('Zend\Cache\Storage\Adapter\AbstractAdapter')
            ->setFactoryClass('Zend\Cache\StorageFactory')
            ->setFactoryMethod('factory')
            ->setArguments($configs);

        $adapterCfg = $configs[0];

        if (isset($adapterCfg['adapter']) && isset($adapterCfg['adapter']['options']['cache_dir'])) {
            if (!is_dir($adapterCfg['adapter']['options']['cache_dir'])) {
                mkdir($adapterCfg['adapter']['options']['cache_dir'], 0777);
            }
        }
    }
}
