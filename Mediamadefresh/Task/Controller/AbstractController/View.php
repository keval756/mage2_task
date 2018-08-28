<?php
namespace Mediamadefresh\Task\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Mediamadefresh\Task\Controller\AbstractController\TaskLoaderInterface
     */
    protected $taskLoader;

	/**
     * @var PageFactory
     */
    protected $resultPageFactory;
	
    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, TaskLoaderInterface $taskLoader, PageFactory $resultPageFactory)
    {
        $this->taskLoader = $taskLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Task view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->taskLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
