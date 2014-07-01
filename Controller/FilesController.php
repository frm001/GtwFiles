<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class FilesController extends AppController {
    
    public $components = array('RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();
        if($this->RequestHandler->responseType() == 'json'){
            $this->RequestHandler->setContent('json', 'application/json' );
        }
    }
    
    function add() {
        $this->layout = 'ajax';
        if ($this->request->is('post')) {
            if (is_uploaded_file($this->request->data['File']['tmpFile']['tmp_name'])) {
                $this->request->data['File'] = $this->File->moveUploaded(
                    $this->request->data['File'], 
                    $this->Auth->user('id')
                );
                $this->File->Create();
                if ($this->File->save($this->request->data)){
                    $this->set('file', $this->File->read(null, $this->File->getLastInsertId()));
                    $this->render('completed');
                } else {
                    $this->Session->setFlash('Unable to add file');
                }
            }
        }
    }
    
    function get_row($id) {
        $this->layout = 'ajax';
        App::uses('CakeTime', 'Utility');
        $this->set('file', $this->File->read(null, $id));
    }
    
    public function delete($id) {
        $file = $this->File->findById($id);
        unlink($this->File->getPath($file['File']['filename']));
        
        if ($this->File->delete($id)) {
            $this->Session->setFlash('File has been deleted');
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function index() {
        App::uses('CakeTime', 'Utility');
        $this->set('files', $this->paginate());
    }
}
