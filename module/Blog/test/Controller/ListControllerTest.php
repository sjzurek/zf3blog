<?php

namespace ListTest\Controller;


use Blog\Controller\ListController;
use Blog\Model\PostRepositoryInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ListControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = false;

    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    public function setUp()
    {
        $configOverrides = [];

        $this->setApplicationConfig(
            ArrayUtils::merge(
                include __DIR__ . '/../../../../config/application.config.php',
                $configOverrides
            )
        );
        parent::setUp();

        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);
        $services->setService(
            'config', $this->updateConfig($services->get('config'))
        );
        $services->setService(
            PostRepositoryInterface::class,
            $this->mockPostRepository()->reveal()
        );
        $services->setAllowOverride(false);
    }

    protected function updateConfig($config)
    {
        $config['db'] = [];

        return $config;
    }

    protected function mockPostRepository()
    {
        $this->postRepository = $this->prophesize(
            PostRepositoryInterface::class
        );

        return $this->postRepository;
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->postRepository->findAllPosts()->willReturn([]);
        $this->dispatch('/blog', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Blog');
        $this->assertControllerName(ListController::class);
        $this->assertControllerClass('ListController');
        $this->assertMatchedRouteName('blog');
    }

}
