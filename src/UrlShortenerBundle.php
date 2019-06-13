<?php

namespace irbi\UrlShortenerBundle;

use irbi\UrlShortenerBundle\Service\Contracts\EncoderInterface;
use irbi\UrlShortenerBundle\DependencyInjection\Compiler\UrlShortenerServicePath;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UrlShortenerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new UrlShortenerServicePath());
        $container->registerForAutoconfiguration(EncoderInterface::class)->addTag(EncoderInterface::TAG);
    }
}