<?php
namespace AHT\SaleAgent\Model\Source;

class Commissiontype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{
  /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('--Fixel/Percent--'), 'value' => ''],
                ['label' => __('Fixel'), 'value' => '1'],
                ['label' => __('Percent'), 'value' => '2'],
            ];
        }
        return $this->_options;
    }
}
