<?php
namespace Atma\SocialVideos\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface; // Import ScopeConfigInterface
use Magento\Catalog\Api\Data\ProductInterface;
use Exception;

class Configuration extends AbstractHelper
{
    const ENABLE_TIKTOK_EMBED_VIDEO = 'configuration/tiktok/enable_tiktok';

    /**
     * @var RequestInterface
     */
    public $request;

    /**
     * @var ProductRepository
     */
    public $productRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param RequestInterface $request
     * @param ProductRepository $productRepository
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        RequestInterface $request,
        ProductRepository $productRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function enableTiktokVideos(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::ENABLE_TIKTOK_EMBED_VIDEO, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get product by the entity ID from the URL
     * @return ProductInterface|null
     */
    public function getProduct()
    {
        $productId = (int)$this->request->getParam('id');
        if ($productId === 0) {
            $this->_logger->error('Atma_SocialVideos:: Product with ID: ' . $productId . ' is missing from the URL!');
            return null;
        }
        try {
            return $this->productRepository->getById($productId);
        } catch (Exception $error) {
            $this->_logger->error('Atma_SocialVideos:: Cannot load product with ID: ' . $productId);
            return null;
        }
    }
}
