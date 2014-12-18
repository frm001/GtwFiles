<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class File extends AppModel
{
    
    public $belongsTo = 'User';
    
    public function save($data = null, $validate = true, $fieldList = array())
    {
        $this->set($data);
        if (isset($this->data['File']['modified'])) {
            unset($this->data['File']['modified']);
        }
        return parent::save($this->data, $validate, $fieldList);
    }
    
    public function moveUploaded($tmpFile, $userId, $dirName, $count)
    {    
        // fetch data
        $fileInfo['user_id'] = $userId;
        $fileInfo['size'] = $tmpFile['tmpFile']['size'];
        $fileInfo['type'] = $tmpFile['tmpFile']['type'];
        $fileInfo['title'] = $tmpFile['title'];
        $fileInfo['ext'] = pathinfo($tmpFile['tmpFile']['name'], PATHINFO_EXTENSION);
        $fileInfo['filename'] = $this->createFileName($fileInfo['ext'], $userId, $count);
        
        // move file
        $file = fopen($tmpFile['tmpFile']['tmp_name'], "rb");
        $data = fread($file, $fileInfo['size']);
        file_put_contents( $this->getPath($fileInfo['filename'],$dirName) , $data);
        
        return $fileInfo;
    }
    
    // This function creates/define what path and filename to give before storing it
    public function createFileName($ext, $userId, $count)
    {
		$count = empty($count)?'':('_'.$count);
        return date("d_m_Y_G.i.s") . '_' . $userId.$count . '.' . $ext;
    }
    
    public function getPath($filename,$dirName)
    {
        if(empty($dirName)){
            $path = WWW_ROOT . 'files'.DS.'uploads'.DS ;
        }else{
            $path = WWW_ROOT . 'files'.DS.'uploads'.DS.$dirName.DS ;
        }
        //Check folder and if not exist then create folder
        $dir = new Folder($path,true,0777);
        return  $path. $filename;
    }
    public function getUrl($filename)
    {
        return 'files/uploads/'.$filename;
    }
    public function deleteFile($filename)
    {
        $file = new File($this->getPath($filename));
        $file->delete();
    }
}
