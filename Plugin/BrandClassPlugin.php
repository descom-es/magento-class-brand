<?php

namespace Descom\BrandClass\Plugin;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class BrandClassPlugin implements ObserverInterface
{
    protected $config;
    protected $request;
    protected $registry;

    public function __construct(
        \Magento\Framework\View\Page\Config $config,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $registry
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->registry = $registry;
    }

    public function execute(Observer $observer)
    {
        $brand = $this->brand();

        if ($brand) {
            $brandSlug = $this->slug($brand);

            $this->config->addBodyClass("brand-{$brandSlug}");
        }
    }

    private function brand(): ?string
    {
        if ($this->request->getFullActionName() == 'catalog_product_view') {
            $product = $this->registry->registry('current_product');

            if ($product && $product->getBrand()) {
                return $product->getBrand();
            }
        }

        return null;
    }

    private function slug(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    }
}
