<?php
namespace Atma\SocialVideos\Block\Product;

use Magento\Framework\View\Element\Template;
use Atma\SocialVideos\Helper\Configuration;
use Atma\SocialVideos\Setup\Patch\Data\TiktokProductAttribute;

class Videos extends Template
{
    /**
     * @var Configuration
     */
    public Configuration $configuration;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param Configuration $configuration
     */
    public function __construct(
        Template\Context $context,
        Configuration $configuration,
        array $data = []
    ) {
        $this->configuration = $configuration;
        parent::__construct($context, $data);
    }

    /**
     * Enable embed tiktok Videos
     * @return bool
     */
    public function enableEmbedTikTokVideos() :bool
    {
        return $this->configuration->enableTiktokVideos();
    }

    /**
     * Get product TikTok embed video
     * @return string
     */
    public function getProductTikTokVideo() : string
    {
        $product = $this->configuration->getProduct();
        if ($product !== null){
            $pattern = '/\/video\/(\d+)/';
            $fullTiktokUrl = (string) $product->getData(TiktokProductAttribute::TIKTOK_VIDEO_PRODUCT_ATTRIBUTE);
            if (preg_match($pattern, $fullTiktokUrl, $matches)) {
                // $matches[1] contains the video ID
                return $matches[1];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
}
