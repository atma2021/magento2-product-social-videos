<?php
namespace Atma\Atma_SocialVideos\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Configuration extends AbstractHelper
{
    const ENABLE_TIKTOK_EMBED_VIDEO = 'configuration/tiktok/enable';

    /**
     * @return bool
     */
    public function enableTiktokVideos(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::ENABLE_TIKTOK_EMBED_VIDEO, ScopeInterface::SCOPE_STORE);
    }
}
