<?php

declare(strict_types=1);

namespace Select\Model\Table;

use Psr\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SelectModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new SelectModel(
            $container->get(Adapter::class)
        );
    }
}
