<?php

declare(strict_types=1);

namespace Select\Handler;

use Select\Model\Table\SelectModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class SelectHandlerFactory
{
    public function __invoke(ContainerInterface $container): SelectHandler
    {
        return new SelectHandler(
            $container->get(SelectModel::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
