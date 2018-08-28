<?php
namespace Mediamadefresh\Task\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class TaskLoader implements TaskLoaderInterface
{
    /**
     * @var \Mediamadefresh\Task\Model\TaskFactory
     */
    protected $taskFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Mediamadefresh\Task\Model\TaskFactory $taskFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Mediamadefresh\Task\Model\TaskFactory $taskFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->taskFactory = $taskFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $taskId = (int)$request->getParam('id');
        if (!$taskId) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $task = $this->taskFactory->create()->load($taskId);
        $this->registry->register('current_task', $task);
        return true;
    }
}
