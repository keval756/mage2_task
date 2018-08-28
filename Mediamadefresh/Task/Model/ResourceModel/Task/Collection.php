<?php
/**
 * Task Resource Collection
 */
namespace Mediamadefresh\Task\Model\ResourceModel\Task;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mediamadefresh\Task\Model\Task', 'Mediamadefresh\Task\Model\ResourceModel\Task');
    }
}
