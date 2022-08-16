<?php

declare(strict_types=1);

namespace Test\Model\Table;


use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;

class PostTableFactory
{
    public function __invoke(ContainerInterface $container) 
    {
        return new PostTable(
            $container->get(Adapter::class)
        );
    }
}
