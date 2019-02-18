<?php
/**
 * @package  CtiDigital\AdvancedAclPermissions
 * @author Bartosz Herba <b.herba@ctidigital.com>
 * @copyright 2017 CtiDigital
 * @license See LICENSE.txt for license details.
 */

namespace CtiDigital\AdvancedAclPermissions\Plugin\Block\Widget\Grid;

use Magento\Backend\Block\Widget\Grid\Massaction;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\DataObject;

/**
 * Class MassactionPlugin
 */
class MassactionPlugin
{
    const CACHE_SECTION = 'admin/cache';

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * MassactionPlugin constructor.
     *
     * @param AuthorizationInterface $authorization
     */
    public function __construct(AuthorizationInterface $authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @param Massaction $subject
     * @param callable $proceed
     * @param string $itemId
     * @param array|DataObject $item
     *
     * @return Massaction
     */
    public function aroundAddItem(Massaction $subject, callable $proceed, $itemId, $item)
    {
        if ($this->getCurrentPage($subject) !== self::CACHE_SECTION) {
            return $proceed($itemId, $item);
        }

        if ($this->isTogglingMenuItem($itemId) && $this->hasAccessToToggleMassActions()) {
            return $proceed($itemId, $item);
        }

        if ($this->isRefreshMenuItem($itemId) && $this->hasAccessToRefreshMassAction()) {
            return $proceed($itemId, $item);
        }

        return $subject;
    }

    /**
     * @param string $itemId
     *
     * @return bool
     */
    private function isTogglingMenuItem($itemId)
    {
        return ('enable' === $itemId || 'disable' === $itemId);
    }

    /**
     * @return bool
     */
    private function hasAccessToToggleMassActions()
    {
        return $this->authorization->isAllowed('CtiDigital_AdvancedAclPermissions::toggling_cache_type');
    }

    /**
     * @param string $itemId
     *
     * @return bool
     */
    private function isRefreshMenuItem($itemId)
    {
        return ('refresh' === $itemId);
    }

    /**
     * @return bool
     */
    private function hasAccessToRefreshMassAction()
    {
        return $this->authorization->isAllowed('CtiDigital_AdvancedAclPermissions::refresh_cache_type');
    }

    private function getCurrentPage($subject)
    {
        $request = $subject->getRequest();
        return $request->getModuleName().DIRECTORY_SEPARATOR.$request->getControllerName();
    }
}
