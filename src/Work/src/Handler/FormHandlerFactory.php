<?php

declare(strict_types=1);

namespace Work\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Work\Form\DataForm;
use Work\Model\Table\UsersTable;


class FormHandlerFactory
{
    public function __invoke(ContainerInterface $container): FormHandler
    {
        return new FormHandler(
            $container->get('FormElementManager')->get(DataForm::class),
            $container->get(UsersTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
