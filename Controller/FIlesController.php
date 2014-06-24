<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class FilesController extends AppController {
    
    public $components = array('RequestHandler');
    public $helpers = array('Number','Time');
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
        $this->set('file', $this->File->read(null, $id));
    }
    
    public function delete($id) {
        $file = $this->File->findById($id);        
        if ($this->File->delete($id)) {
            //Delete File
            $this->File->deleteFile($file['File']['filename']);
            $this->Session->setFlash(__('File has been deleted'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function index($userId = 0) {
		if (CakePlugin::loaded('GtwUsers')){
            $this->layout = 'GtwUsers.users';
        }
        $arrConditions = array();
        if(!empty($userId)){
            $this->set(compact('userId'));
            $arrConditions = array('user_id'=>$userId);
        }
		if($this->Session->read('Auth.User.role')!='admin'){
			$arrConditions = array('user_id'=>$this->Session->read('Auth.User.id'));
        }        
        $this->paginate = array(
                                'conditions' => $arrConditions,
                                'order' => array('File.created' => 'desc')
                        );
        $this->set('files', $this->paginate('File'));
    }
    public function download($filename){
        $filename = WWW_ROOT . 'files'.DS.'uploads'.DS.$filename;
        if(file_exists($filename) && !is_dir($filename)){
            $this->autoRender = false;
            return $this->response->file($filename, array('download' => true));
            exit;
        }
        $this->Session->setFlash(__('File Not Found'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
                ));
        $this->redirect($this->referer());        
    }
    public function update(){
        $this->layout = false;
        $arrResponse = array('status'=>'fail');
        if(!empty($this->request->data)){
            $arrResponse = array(
                                'status'=> 'success',
                                'id'    => $this->request->data['File']['id'],
                                'value' => $this->request->data['File']['title']
                            );
            $this->File->save($this->request->data);
        }
        echo json_encode($arrResponse);
        exit;
    }
}
