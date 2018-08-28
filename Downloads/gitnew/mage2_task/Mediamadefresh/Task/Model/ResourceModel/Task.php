<?php
namespace Mediamadefresh\Task\Model\ResourceModel;

/**
 * Task Resource Model
 */
class Task extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mediamadefresh_task', 'task_id');
    }
}
