<?php

namespace Omnipay\CobreFacil;

use Omnipay\Common\Item;

class SubscriptionItem extends Item
{
    public function getProductsServicesId()
    {
        return $this->getParameter('products_services_id');
    }

    public function setProductsServicesId($productsServicesId): SubscriptionItem
    {
        return $this->setParameter('products_services_id', $productsServicesId);
    }
}
