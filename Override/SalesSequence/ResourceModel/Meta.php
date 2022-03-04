<?php
declare(strict_types=1);

namespace Vino\RandomOrderPrefix\Override\SalesSequence\ResourceModel;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Meta extends \Magento\SalesSequence\Model\ResourceModel\Meta
{
    /**
     * Set custom prefix after load
     *
     * @param AbstractModel $object
     * @return $this|AbstractDb|\Magento\SalesSequence\Model\ResourceModel\Meta
     * @throws LocalizedException
     * @throws Exception
     */
    protected function _afterLoad(AbstractModel $object)
    {
        $randomPrefix = $this->generateRandom();

        $activeProfile = $this->resourceProfile->loadActiveProfile($object->getId());
        $activeProfile->setPrefix($randomPrefix);

        $object->setData(
            'active_profile',
            $activeProfile
        );

        return $this;
    }

    /**
     * Generate random number for prefix
     *
     * @return int
     * @throws Exception
     */
    public function generateRandom(): int
    {
        return random_int(0, 999999);
    }

}
