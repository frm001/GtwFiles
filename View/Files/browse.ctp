<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
?>
<div id='browseFileModal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo __d('gtw_files', 'File List');?></h3>
    </div>
    
    <div class="modal-body">
        <table id='fileList' class='table table-hover'>    
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('title', __d('gtw_files', 'Title')); ?></th>
                    <th><?php echo $this->Paginator->sort('user', __d('gtw_files', 'Owner')); ?></th>
                    <th><?php echo $this->Paginator->sort('modified', __d('gtw_files', 'Midified')); ?></th>
                </tr>
            </thead>
            <?php foreach ($files as $f): ?>
            <tr>
                <td>
                    <a href="#" class='fileChoice'><?php echo $f['File']['title'];?></a>
                    <input type="hidden" value="<?php echo $f['File']['id'];?>">
                    <input type="hidden" value="/files/uploads/<?php echo $f['File']['filename'];?>">
                </td>
                
                <td><?php echo $f['File']['user'];?></td>
                <td><?php echo CakeTime::format('d-m-Y', $f['File']['modified']); ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
    
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __d('gtw_files', 'Close');?></button>
    </div>
    
</div>
