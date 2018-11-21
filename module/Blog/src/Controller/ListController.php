<?php

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use InvalidArgumentException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class ListController
 *
 * @package Blog\Controller
 */
class ListController extends AbstractActionController
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * ListController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(
            [
                'posts' => $this->postRepository->findAllPosts(),
            ]
        );
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $post = $this->postRepository->findPost($id);
            $post->replacePseudoTag();
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(
            [
                'post' => $post,
            ]
        );
    }

}
