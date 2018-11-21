<?php

namespace Blog\Factory;

use Blog\Model\ZendDbSqlCommand;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ZendDbSqlCommandFactory
 *
 * @package Blog\Factory
 */
class ZendDbSqlCommandFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return ZendDbSqlCommand|object
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        return new ZendDbSqlCommand($container->get(AdapterInterface::class));
    }

}
