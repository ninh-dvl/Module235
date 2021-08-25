<?php

namespace AHT\SaleAgent\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'sale_agent_id',
            [
                'group'  => 'Product Details',
                'type' => 'text',
                'backend' => '',
                'frontend' => '',
                'label' => 'Sale agent id',
                'input' => 'select',
                'class' => '',
                'source' => 'AHT/SaleAgent/Model/Source/Saleagent',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'sort_order'   => 100,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'commission_type',
            [
                'group'        => 'Product Details',
                'type'         => 'int',
                'label'        => 'Commission type',
                'input'        => 'select',
                'sort_order'   => 110,
                'source'       => 'AHT/SaleAgent/Model/Source/Commissiontype',
                'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible'      => true,
                'required'     => false,
                'user_defined' => false,
                'default'      => null,
                'backend'      => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'commission_value',
            [
                'group'  => 'Product Details',
                'type' => 'decimal',
                'backend' => '',
                'frontend' => '',
                'label' => 'Sale agent id',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'sort_order'   => 120,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple',
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'is_sale_agent',
            [
                'type'         => 'int',
                'label'        => 'Is sale agent',
                'input'        => 'boolean',
                'source'       => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 9,
                'sort_order'   => 9,
                'system'       => 0,
            ]
        );
        $customerAttr = $this->eavConfig->getAttribute(Customer::ENTITY, 'is_sale_agent');
		$customerAttr->setData(
			'used_in_forms',
			['adminhtml_customer']

		);
		$customerAttr->save();
        $setup->endSetup();
    }
}
