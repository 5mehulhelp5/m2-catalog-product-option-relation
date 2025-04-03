<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Type implements OptionSourceInterface
{
    public const ALLOW = 1;
    public const PROHIBIT = 2;
    public const ALLOW_HIDE = 3;
    public const PROHIBIT_HIDE = 4;

    public function toOptionArray(): array
    {
        return [
            ['value' => static::ALLOW, 'label' => __('Allow')],
            ['value' => static::ALLOW_HIDE, 'label' => __('Allow & Hide')],
            ['value' => static::PROHIBIT, 'label' => __('Prohibit')],
            ['value' => static::PROHIBIT_HIDE, 'label' => __('Prohibit & Hide')]
        ];
    }

    public function toOptions(): array
    {
        return [static::ALLOW    => __('Allow'),
                static::ALLOW_HIDE => __('Allow & Hide'),
                static::PROHIBIT => __('Prohibit'),
                static::PROHIBIT_HIDE => __('Prohibit & Hide')
        ];
    }
}
