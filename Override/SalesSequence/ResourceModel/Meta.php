<?php
declare(strict_types=1);

namespace Vino\RandomOrderPrefix\Override\SalesSequence\ResourceModel;


use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context as DatabaseContext;
use Magento\SalesSequence\Model\MetaFactory;
use Magento\SalesSequence\Model\ResourceModel\Profile as ResourceProfile;

class Meta extends \Magento\SalesSequence\Model\ResourceModel\Meta
{
    /**
     * Meta constructor.
     *
     * @param DatabaseContext $context
     * @param MetaFactory $metaFactory
     * @param ResourceProfile $resourceProfile
     * @param null $connectionName
     */
    public function __construct(
        DatabaseContext $context,
        MetaFactory $metaFactory,
        ResourceProfile $resourceProfile,
        $connectionName = null
    ) {
        parent::__construct($context, $metaFactory, $resourceProfile, $connectionName);
    }

    /**
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
     * @return int
     * @throws Exception
     */
    public function generateRandom(): int
    {
        return random_int(0, 999999);
    }

}
