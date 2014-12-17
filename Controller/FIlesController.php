<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class FilesController extends AppController
{

    public $components = array('RequestHandler');
    public $helpers = array('Number', 'Time');

    public function beforeFilter()
    {
        parent::beforeFilter();
        if ($this->RequestHandler->responseType() == 'json') {
            $this->RequestHandler->setContent('json', 'application/json');
        }
    }

    function add()
    {
        $this->layout = 'ajax';
        if ($this->request->is('post')) {
            $totalFiles = count($this->request->data['File']['tmpFile']);
            $count = count($this->request->data['File']['tmpFile'])>1?0:'';
            $flag = true;
            $title = $this->request->data['File']['title'];
            $dirName = isset($this->request->data['File']['dir'])?$this->request->data['File']['dir']:"";
            foreach ($this->request->data['File']['tmpFile'] as $key => $name) {
                $tmpFileArray['title'] = !empty($count)?($title . '_' . $count):$title;
                $tmpFileArray['tmpFile'] = $name;
                if (is_uploaded_file($tmpFileArray['tmpFile']['tmp_name'])) {
                    $this->request->data['File'] = $this->File->moveUploaded(
                            $tmpFileArray, $this->Auth->user('id'),
                            $dirName,
                            $count
                    );
                    $this->request->data['File']['dir'] = $dirName;
                    $this->File->Create();
                    if ($this->File->save($this->request->data)) {
                        $fileIds[] = $this->File->getLastInsertId();
                        $fileNames[] = $this->request->data['File']['filename'];
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                }
                $count++;
            }
            if($totalFiles == 1){
                $fileId = $fileIds[0];
                $fileName = $fileNames[0];
                $this->set(compact('fileId','fileName','totalFiles'));
            } else {
                $commaSepratedFileId = implode(', ', $fileIds);
                $commaSepratedFileName = implode(', ', $fileNames);
                $this->set(compact('commaSepratedFileId','commaSepratedFileName','totalFiles'));
            }
            $this->render('completed');
        }
    }

    function get_row($id)
    {
        $this->layout = 'ajax';
        $fileIds = explode(', ', $id);
		foreach ($fileIds as $key => $id) {
			$files[]= $this->File->read(null, $id);
		}
        $this->set('files',$files);
    }

    public function delete($id)
    {
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

    public function index($userId = 0)
    {
        if (CakePlugin::loaded('GtwUsers')) {
            $this->layout = 'GtwUsers.users';
        }
        $arrConditions = array();
        if (!empty($userId)) {
            $this->set(compact('userId'));
            $arrConditions = array('user_id' => $userId);
        }
        if ($this->Session->read('Auth.User.role') != 'admin') {
            $arrConditions = array('user_id' => $this->Session->read('Auth.User.id'));
        }
        $this->paginate = array(
            'conditions' => $arrConditions,
            'order' => array('File.created' => 'desc')
        );
        $this->set('files', $this->paginate('File'));
    }

    public function download($filename)
    {
        $filename = WWW_ROOT . 'files' . DS . 'uploads' . DS . $filename;
        if (file_exists($filename) && !is_dir($filename)) {
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

    public function update()
    {
        $this->layout = false;
        $arrResponse = array('status' => 'fail');
        if (!empty($this->request->data)) {
            $arrResponse = array(
                'status' => 'success',
                'id' => $this->request->data['File']['id'],
                'value' => $this->request->data['File']['title']
            );
            $this->File->save($this->request->data);
        }
        echo json_encode($arrResponse);
        exit;
    }

}
