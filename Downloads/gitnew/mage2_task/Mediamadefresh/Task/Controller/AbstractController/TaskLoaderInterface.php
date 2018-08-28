<?php
namespace Mediamadefresh\Task\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface TaskLoaderInterface
{
    /**
     * Load order
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Mediamadefresh\Task\Model\Task
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
