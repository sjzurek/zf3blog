<?php

namespace Blog\Factory;

use Blog\Model\Post;
use Blog\Model\ZendDbSqlRepository;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ZendDbSqlRepositoryFactory
 *
 * @package Blog\Factory
 */
class ZendDbSqlRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param null|array         $options
     *
     * @return ZendDbSqlRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        return new ZendDbSqlRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new Post('', '')
        );
    }

}
