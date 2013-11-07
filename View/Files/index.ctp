<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
 
 $this->Helpers->load('GtwRequire.GtwRequire');
 echo $this->GtwRequire->req('files/filepicker');
?>


<h1>Files</h1>
<div id = "upload-alert"></div>
<div id="modal-loader"></div>
<button type="button" class="btn btn-primary upload" data-loading-text="Loading..." data-upload-callback="files/index">Upload file</button>

<table id="all-files" class='table table-hover'>    
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('title', 'Title'); ?></th>
            <th><?php echo $this->Paginator->sort('filename', 'Filename'); ?></th>
            <th><?php echo $this->Paginator->sort('size', 'Size'); ?></th>
            <th>Owner</th>
            <th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
            <th></th>
        </tr>
    </thead>
    <?php foreach ($files as $f): ?>
    <tr>
        <td><?php echo $f['File']['id'];?></td>
        <td><?php echo $f['File']['title'];?></td>
        <td><?php echo $f['File']['filename'];?></td>
        <td><?php echo $f['File']['size'];?></td>
        <td><?php echo $f['User']['email'];?></td>
        <td><?php echo CakeTime::format('Y-m-d', $f['File']['created']); ?></td>
        <td>
            <span class="pull-right">
                <?php echo $this->Html->actionIcon('icon-remove', 'delete', $f['File']['id']); ?>
            </span>
        </td>
        
    </tr>
    <?php endforeach; ?>

</table>