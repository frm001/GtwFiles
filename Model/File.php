<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class File extends AppModel {
    
    public $belongsTo = 'User';
    
    public function save($data = null, $validate = true, $fieldList = array()) {
        $this->set($data);
        if (isset($this->data['File']['modified'])) {
            unset($this->data['File']['modified']);
        }
        return parent::save($this->data, $validate, $fieldList);
    }
    
    public function moveUploaded($tmpFile, $userId){
        
        // fetch data
        $fileInfo['user_id'] = $userId;
        $fileInfo['size'] = $tmpFile['tmpFile']['size'];
        $fileInfo['type'] = $tmpFile['tmpFile']['type'];
        $fileInfo['title'] = $tmpFile['title'];
        $fileInfo['ext'] = pathinfo($tmpFile['tmpFile']['name'], PATHINFO_EXTENSION);
        $fileInfo['filename'] = $this->createFileName($fileInfo['ext'], $userId);
        
        // move file
        $file = fopen($tmpFile['tmpFile']['tmp_name'], "rb");
        $data = fread($file, $fileInfo['size']);
        file_put_contents( $this->getPath($fileInfo['filename']) , $data);
        
        return $fileInfo;
    }
    
    // This function creates/define what path and filename to give before storing it
    public function createFileName($ext, $userId){
        return date("d_m_Y_G.i.s") . '_' . $userId . '.' . $ext;
    }
    
    public function getPath($filename){
        return WWW_ROOT . '\files\uploads\\' . $filename;
    }
}