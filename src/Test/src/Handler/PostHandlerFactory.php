<?php

declare(strict_types=1);

namespace Test\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Test\Form\RegisterForm;

class PostHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostHandler
    {
        return new PostHandler(
            $container->get('FormElementManager')->get(RegisterForm::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
