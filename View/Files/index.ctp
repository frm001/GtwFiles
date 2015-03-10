<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
 
    $this->Helpers->load('GtwRequire.GtwRequire');
    echo $this->GtwRequire->req('files/filepicker');
?>
<div id = "upload-alert"></div>
<div id="modal-loader"></div>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-8"><h3 style='margin-top:0px'><?php echo __d('gtw_files', 'Files');?></h3></div>
            <div class="col-md-4 text-right">
                <?php if(!empty($userId)){?>
                <button type="button" class="btn btn-default" onclick="javascript:history.go(-1);"><i class="fa fa-reply"></i> <?php echo __d('gtw_files', 'Back');?></button>
                <?php }else{?>
                    <button type="button" class="btn btn-primary upload" data-multiple="true" data-loading-text="<?php echo __d('gtw_files', 'Loading');?>..." data-upload-callback="files/index"><i class="fa fa-upload"></i> <?php echo __d('gtw_files', 'Upload file');?></button>
                <?php }?>
            </div>
        </div>
    </div>    
    <table class="table table-hover table-striped table-bordered" id="all-files">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('title', __d('gtw_files', 'Title')); ?></th>
                <th><?php echo $this->Paginator->sort('filename', __d('gtw_files', 'File Name')); ?></th>
                <th><?php echo $this->Paginator->sort('ext', __d('gtw_files', 'Extension')); ?></th>
                <th class='text-center'><?php echo $this->Paginator->sort('size', __d('gtw_files', 'Size')); ?></th>
                <?php if($this->Session->read('Auth.User.role')=='admin'){?>
                    <th><?php echo $this->Paginator->sort('User.first','Owner'); ?></th>
                <?php }?>
                <th><?php echo $this->Paginator->sort('created', __d('gtw_files', 'Added')); ?></th>
                <th class='text-center'><?php echo __d('gtw_files', 'Action');?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($files)){?>
                <tr>
                    <td colspan='7' class='text-warning'><?php echo __d('gtw_files', 'No file uploaded yet.');?></td>
                </tr>
            <?php 
                }else{
                    foreach ($files as $file){
                        echo $this->element('filelist',array('file'=>$file));
                    }
                }
            ?>
        </tbody>
    </table>    
</div>
<div class="modal fade" id="editTitleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php echo $this->Form->create('File',array('url'=>array('action'=>'update'),'id'=>'gtwFileUpdateForm'));?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo __d('gtw_files', 'Update Title');?></h4>
            </div>
            <div class="modal-body">                
                <?php 
                    echo $this->Form->input('id',array('type'=>'hidden','id'=>'gtwFileid'));
                    echo $this->Form->input('title',array('label'=>false,'class'=>'form-control','div'=>false,'id'=>'gtwFileTitle','maxlength'=>255));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" style="display:none;"><i class="fa fa-refresh fa-spin"></i> <?php echo __d('gtw_files', 'Please wait');?>...</button>
                <?php echo $this->Form->submit( __d('gtw_files', 'Save'), array('div' => false,'class' => 'btn btn-primary'));?>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __d('gtw_files', 'Close');?></button>
            </div>
            <?php $this->Form->end();?>
        </div>
    </div>
</div>
