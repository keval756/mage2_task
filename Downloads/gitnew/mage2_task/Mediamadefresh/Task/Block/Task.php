<?php
namespace Mediamadefresh\Task\Block;

/**
 * Task content block
 */
class Task extends \Magento\Framework\View\Element\Template
{
    /**
     * Task collection
     *
     * @var Mediamadefresh\Task\Model\ResourceModel\Task\Collection
     */
    protected $_taskCollection = null;
    
    /**
     * Task factory
     *
     * @var \Mediamadefresh\Task\Model\TaskFactory
     */
    protected $_taskCollectionFactory;
    
    /** @var \Mediamadefresh\Task\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Mediamadefresh\Task\Model\Resource\Task\CollectionFactory $taskCollectionFactory
	 * @param \Mediamadefresh\Task\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mediamadefresh\Task\Model\ResourceModel\Task\CollectionFactory $taskCollectionFactory,
        \Mediamadefresh\Task\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_taskCollectionFactory = $taskCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve task collection
     *
     * @return Mediamadefresh_Task_Model_ResourceModel_Task_Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_taskCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared task collection
     *
     * @return Mediamadefresh_Task_Model_Resource_Task_Collection
     */
    public function getCollection()
    {
        if (is_null($this->_taskCollection)) {
            $this->_taskCollection = $this->_getCollection();
            $this->_taskCollection->setCurPage($this->getCurrentPage());
            $this->_taskCollection->setPageSize($this->_dataHelper->getTaskPerPage());
            $this->_taskCollection->setOrder('published_at','asc');
        }

        return $this->_taskCollection;
    }
    
    /**
     * Fetch the current page for the task list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Mediamadefresh_Task_Model_Task $taskItem
     * @return string
     */
    public function getItemUrl($taskItem)
    {
        return $this->getUrl('*/*/view', array('id' => $taskItem->getId()));
    }
    
    /**
     * Return URL for resized Task Item image
     *
     * @param Mediamadefresh_Task_Model_Task $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('task_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $taskPerPage = $this->_dataHelper->getTaskPerPage();

            $pager->setAvailableLimit([$taskPerPage => $taskPerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
