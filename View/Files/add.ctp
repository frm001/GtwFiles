<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
?>
<div id='addFileModal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <form id="ControllerAddForm" method="post" enctype="multipart/form-data" target="upload_target" action="/files/add">
    
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add file</h3>
        </div>
        
        <div class="modal-body">
        
        <?php
            
            echo $this->Form->input('File.tmpFile', array(
                'type' => 'file',
                'label' => 'File',
            ));
            
            echo $this->Form->input('File.title', array(
                'type' => 'text',
                'label' => 'Title',
            ));
            
        ?>

        </div>
        
        <div class="modal-footer">
            <input class="btn btn-primary" type="submit" value="Enregistrer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
        </div>
    
    </form>
    
    <!-- Older browsers won't let us use ajax for file uploads. This is the hack -->
    <iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;"></iframe>
    
</div>