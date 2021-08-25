<?php
namespace AHT\SaleAgent\Plugin\Customer;

class Firstnamesa
{
    public function afterGetFirstname(\Magento\Customer\Model\Data\Customer $subject, $result)
    {
        if($subject->getCustomAttribute("is_sale_agent")) {
            if($subject->getCustomAttribute("is_sale_agent")->getValue() == \Magento\Eav\Model\Entity\Attribute\Source\Boolean::VALUE_YES){
                // $result = str_replace('Sales Agent : ', ' ', $result);
                $result = "Sales Agent : ".$result;
            }
        }
    
        return $result;
    }
}
