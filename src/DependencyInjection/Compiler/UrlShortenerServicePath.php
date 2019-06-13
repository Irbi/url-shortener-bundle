<?php

namespace irbi\UrlShortenerBundle\DependencyInjection\Compiler;

use irbi\UrlShortenerBundle\Controller\EncodeController;
use irbi\UrlShortenerBundle\Service\Contracts\EncoderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class UrlShortenerServicePath implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(EncodeController::class)) {
            return;
        }

        $controller = $container->findDefinition(EncodeController::class);
        foreach (array_keys($container->findTaggedServiceIds(EncoderInterface::TAG)) as $serviceId) {
            $controller->addMethodCall('addUrlShortenerService', [new Reference($serviceId)]);
        }
    }
}

