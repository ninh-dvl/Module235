<?php

namespace AHT\SaleAgent\Block\Customer;

class Salesagents extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_customerSession;
    protected $_resource;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\ResourceConnection $Resource,


        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_resource = $Resource;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $customerId = $this->_customerSession->getCustomer()->getId();
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*')->addFieldToFilter('sale_agent_id', $customerId);
        $collection->getSelect()->join(
            ['order_sa' => "catalog_product_entity_varchar"],
            'order_sa.entity_id = e.entity_id and order_sa.attribute_id = 73 '
           );
        $collection->setPageSize(5);
        return $collection;
    }
}