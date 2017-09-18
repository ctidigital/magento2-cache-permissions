<?php
/**
 * @package  CtiDigital\AdvancedAclPermissions
 * @author Bartosz Herba <b.herba@ctidigital.com>
 * @copyright 2017 CtiDigital
 * @license See LICENSE.txt for license details.
 */

namespace CtiDigital\AdvancedAclPermissions\Block\Cache;

/**
 * Class Additional
 */
class Additional extends \Magento\Backend\Block\Cache\Additional
{
    /**
     * @return bool
     */
    public function hasAccessToFlushCatalogImages()
    {
        return $this->_authorization->isAllowed('CtiDigital_AdvancedAclPermissions::flush_catalog_images');
    }

    /**
     * @return bool
     */
    public function hasAccessToFlushJsCss()
    {
        return $this->_authorization->isAllowed('CtiDigital_AdvancedAclPermissions::flush_js_css');
    }

    /**
     * @return bool
     */
    public function hasAccessToFlushStaticFiles()
    {
        return $this->_authorization->isAllowed('CtiDigital_AdvancedAclPermissions::flush_static_files');
    }

    /**
     * @return bool
     */
    public function hasAccessToAdditionalActions()
    {
        return ($this->hasAccessToFlushCatalogImages()
                || $this->hasAccessToFlushJsCss()
                || $this->hasAccessToFlushStaticFiles());
    }
}
