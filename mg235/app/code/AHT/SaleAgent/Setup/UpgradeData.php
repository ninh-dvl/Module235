<?php
namespace AHT\SaleAgent\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.12') < 0) {

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'sale_agent_id');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'sale_agent_id',
                [
                    'group'  => 'Sale Agent',
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Sale agent id',
                    'input' => 'select',
                    'class' => '',
                    'source' => 'AHT\SaleAgent\Model\Source\Saleagent',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
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
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'commission_type');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'commission_type',
                [
                    'group'        => 'Sale Agent',
                    'type'         => 'int',
                    'label'        => 'Commission type',
                    'input'        => 'select',
                    'sort_order'   => 110,
                    'source'       => 'AHT\SaleAgent\Model\Source\Commissiontype',
                    'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible'      => true,
                    'required'     => false,
                    'user_defined' => false,
                    'default'      => null,
                    'backend'      => ''
                ]
            );
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'commission_value');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'commission_value',
                [
                    'group'  => 'Sale Agent',
                    'type' => 'decimal',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Commission value',
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
            $eavSetup->removeAttribute( \Magento\Customer\Model\Customer::ENTITY, 'is_sale_agent');
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,'is_sale_agent',
                [
                    'type'         => 'int',
                    'label'        => 'Is sale agent',
                    'input'        => 'boolean',
                    'source'       => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'required'     => false,
                    'visible'      => true,
                    'user_defined' => false,
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
        }
        $setup->endSetup();
    }
}