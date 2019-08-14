<?php
class ES_Vcatalog_Block_Vcatalog extends Mage_Page_Block_Html_Topmenu
{
    protected function _getHtml(Varien_Data_Tree_Node $menuTree, $childrenWrapClass)
    {
        $html = '';

        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();
        $childLevel = is_null($parentLevel) ? 0 : $parentLevel + 1;

        $counter = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        if ($childLevel == 1) {
            $category = Mage::getModel('catalog/category')->load($menuTree->getData('category_id'));
            $imgUrl = $category->getImageUrl();
            $shortDesc = $category->getDescription();
        }

        if ($childLevel == 1) {
            $html .= '<ul class="v-nav-left">';
        }

        foreach ($children as $child) {
            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();

            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $child->setClass($outermostClass);
            }

            $html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
            $html .= '<a href="' . $child->getUrl() . '" ' . $outermostClassCode . '><span>'
                . $this->escapeHtml($child->getName()) . '</span></a>';

            if ($child->hasChildren()) {
                if (!empty($childrenWrapClass)) {
                    $html .= '<div class="' . $childrenWrapClass . '">';
                }

                if ($childLevel == 0) {
                    $collClass = ' vcol-'.Mage::getStoreConfig('vcatalog/general/columns').' img-'.Mage::getStoreConfig('vcatalog/general/imgposition');
                }
                $html .= '<ul class="level' . $childLevel .$collClass. '">';
                $html .= $this->_getHtml($child, $childrenWrapClass);
                $html .= '</ul>';

                if (!empty($childrenWrapClass)) {
                    $html .= '</div>';
                }
            }
            $html .= '</li>';


            $counter++;
        }
        if ($childLevel == 1) {
            if (($imgUrl || $shortDesc) && Mage::getStoreConfig('vcatalog/general/showimg') == 1) {
                $html .= '</ul><ul class="v-nav-right">';
                if ($imgUrl)
                    $html .= '<img width="'.Mage::getStoreConfig('vcatalog/general/imagewidth').'px" src="'.$imgUrl.'" /><br/>';
                if ($shortDesc)
                    $html .= '<span>'.$shortDesc.'</span>';
            }
            $html .= '</ul>';
        }
        return $html;
    }


}