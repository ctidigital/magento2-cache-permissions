<?php
/**
 * @package  CtiDigital\AdvancedAclPermissions
 * @author Bartosz Herba <b.herba@ctidigital.com>
 * @copyright 2017 CtiDigital
 * @license See LICENSE.txt for license details.
 */

namespace CtiDigital\AdvancedAclPermissions\Block;

/**
 * Class Cache
 */
class Cache extends \Magento\Backend\Block\Cache
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();

        if (false === $this->_authorization->isAllowed('CtiDigital_AdvancedAclPermissions::flush_magento_cache')) {
            $this->buttonList->remove('flush_magento');
        }

        if (false === $this->_authorization->isAllowed('CtiDigital_AdvancedAclPermissions::flush_cache_storage')) {
            $this->buttonList->remove('flush_system');
        }
    }
}
