<?php
declare(strict_types=1);

namespace Vino\RandomOrderPrefix\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Math\Random;

class Prefix
{
    /**
     * @var Random
     */
    private $random;

    /**
     * Prefix constructor.
     *
     * @param Random $random
     */
    public function __construct(Random $random)
    {
        $this->random = $random;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function generateRandom(): string
    {
        return $this->random->getRandomString(8, null);
    }
}
