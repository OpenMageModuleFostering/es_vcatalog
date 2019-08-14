<?php

class ES_Vcatalog_Model_System_Config_Imgposition
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'bottom', 'label'=>Mage::helper('adminhtml')->__('Bottom')),
            array('value' => 'right', 'label'=>Mage::helper('adminhtml')->__('Right')),
        );
    }
}