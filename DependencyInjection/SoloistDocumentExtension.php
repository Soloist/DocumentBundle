<?php

namespace Soloist\Bundle\DocumentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SoloistDocumentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (is_null($config['upload_dir'])) {
            $config['upload_dir'] = $container->getParameter('kernel.root_dir') . '/../files/soloist_document';
        }
        if (!is_dir($config['upload_dir'])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The "%s" directory does not exists. Please create it with sufficent permissions.',
                    $config['upload_dir']
                )
            );
        }

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->getDefinition('soloist.document.manager.file')->addArgument(realpath($config['upload_dir']));
    }
}
