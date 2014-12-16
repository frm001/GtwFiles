<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
?>
<script language="javascript" type="text/javascript">
    <?php if($totalFiles == 1) {?>
    window.top.window.uploadComplete(
         <?php echo $fileId; ?>,
        "<?php echo $fileName; ?>",
        "<?php echo implode('/',$this->params['pass']); ?>"
    );
    <?php } else { ?>
    window.top.window.uploadComplete(
        "<?php echo $commaSepratedFileId; ?>",
        "<?php echo $commaSepratedFileName; ?>",
        "<?php echo implode('/',$this->params['pass']); ?>"
    );    
    <?php }?>
</script>
