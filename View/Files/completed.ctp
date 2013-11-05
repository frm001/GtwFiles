<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
?>
<script language="javascript" type="text/javascript">
    window.top.window.uploadComplete(
         <?php echo $file['File']['id']; ?>,
        "<?php echo $file['File']['filename']; ?>",
        "<?php echo implode('/',$this->params['pass']); ?>"
    );
</script>