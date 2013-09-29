<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class File extends AppModel {
    
    public function save($data = null, $validate = true, $fieldList = array()) {
        $this->set($data);
        if (isset($this->data['File']['modified'])) {
            unset($this->data['File']['modified']);
        }
        return parent::save($this->data, $validate, $fieldList);
    }
    
}