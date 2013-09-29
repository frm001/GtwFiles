<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class FilesController extends AppController {
    
    public $uses = array('GtwUsers.File');
    public $components = array('RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();
        if($this->RequestHandler->responseType() == 'json'){
            $this->RequestHandler->setContent('json', 'application/json' );
        }
    }
    
    function admin_add() {
        $this->layout = 'ajax';
        
        if ($this->request->is('post')) {
            if (is_uploaded_file($this->request->data['File']['tmpFile']['tmp_name'])) {
                
                $file = fopen($this->request->data['File']['tmpFile']['tmp_name'], "rb");
                $size = $this->data['File']['tmpFile']['size'];
                $data = fread($file, $size);
                $extension = pathinfo($this->data['File']['tmpFile']['name'], PATHINFO_EXTENSION);
                
                $filename = date("d_m_Y_G.i.s") . '_' . $this->Auth->user('id') . '.' . $extension;
                $filepath =   getcwd() . '\app\webroot\files\uploads\\' . $filename;
                
                file_put_contents($filepath, $data);
                
                $this->File->Create();
                $this->File->data['File']['title'] = $this->request->data['File']['title'];
                $this->File->data['File']['filename'] = $filename;
                $this->File->data['File']['type'] = $this->data['File']['tmpFile']['type'];
                $this->File->data['File']['size'] = $size;
                $this->File->data['File']['extension'] = $extension;
                    
                $this->File->data['File']['user'] = $this->Auth->user('id');
                
                if ($this->File->save()){
                    $this->Session->setFlash('File added successfully');
                    $this->redirect('/admin/files/completed/'. $this->File->getLastInsertId());
                } else {
                    $this->Session->setFlash('Unable to add file');
                }
            }
        }
    }
    
    public function completed($id) {
        $this->layout = 'ajax';
        $this->File->id = $id;
        $this->File->read();
        $this->set('file_id', $id);
        $this->set('file_name', $this->File->data['File']['filename']);
    }
    
    public function browse() {
        $this->layout = 'ajax';
        $this->set('files', $this->paginate());
    }
    
    public function delete($id) {
        $file = $this->File->findById($id);
        $filepath =   getcwd() . '\app\webroot\files\uploads\\' . $file['File']['filename'];
        unlink($filepath);
        if ($this->File->delete($id)) {
            $this->Session->setFlash('File has been deleted');
        }
        $this->redirect('/admin/files/index/');
    }
    
    public function index() {
        $this->set('files', $this->paginate());
    }
}