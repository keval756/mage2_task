<?php
namespace Mediamadefresh\Task\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mediamadefresh_Task::task_manage');
    }

    /**
     * Task List action
     *
     * @return void
     */
    public function execute()
    {
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Mediamadefresh_Task::task_manage'
        )->addBreadcrumb(
            __('Task'),
            __('Task')
        )->addBreadcrumb(
            __('Manage Task'),
            __('Manage Task')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Task'));
		return $resultPage;
    }
}
