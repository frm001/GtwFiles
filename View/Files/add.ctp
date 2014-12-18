<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
 
$add = $this->Html->url(array(
    'plugin' => 'gtw_files',
    'controller' => 'files',
    'action' => 'add',
));
$add .= '/' . implode('/',$this->params['pass']);
?>

<div class="modal fade" id="file-modal" tabindex="-1" role="dialog" aria-labelledby="file-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        
        <form id="ControllerAddForm" method="post" enctype="multipart/form-data" target="upload_target" action="<?php echo $add; ?>" role="form">
        
        <?php
            echo $this->Form->create(null, array(
                'url' => array(
                    'plugin' => 'gtw_files',
                    'controller' => 'files',
                    'action' => 'add'
                ),
                'inputDefaults' => array(
                    'div' => 'form-group',
                    'wrapInput' => false,
                    'class' => 'form-control'
                ),
                'enctype' => 'multipart/form-data',
                'target' => 'upload_target'
            ));
        ?>
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="file-modal-label">Upload File</h4>
            </div>
            <div class="modal-body">
            <?php
                echo $this->Form->input('File.title', array(
                    'type' => 'text',
                    'label' => 'Title',
                ));
                
                echo $this->Form->input('File.tmpFile', array(
                    'type' => 'file',
                    'label' => false,
                    'name' => 'data[File][tmpFile][]',
                    //'multiple' => true,
                    'style' => 'display:none',
                    'beforeInput' => '<div class="input-group"><span class="input-group-btn"><label class="btn btn-primary btn-file" for="FileTmpFile">Browse ',
                    'afterInput' => '</label></span><input id="filename" type="text" class="form-control" placeholder="No file Uploaded" readonly></div>'
                ));
                if($this->request->named){
                    echo $this->Form->input('dir',array('type'=>'hidden','value'=>!empty($this->request->named['dir'])?$this->request->named['dir']:''));
                }
            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="Upload" class="btn btn-primary" disabled="disabled"></button>
            </div>
            
        </form>
    
        <!-- Older browsers won't let us use ajax for file uploads. This is the hack -->
        <iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;"></iframe>   
        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    require(['files/feedback']);
</script>
