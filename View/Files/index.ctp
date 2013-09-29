<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */
?>
<h1>Files</h1>    
<table class='table table-hover'>    
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('title', 'Title'); ?></th>
            <th>Actions</th>
            <th>Owner</th>
            <th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modified'); ?></th>
        </tr>
    </thead>
    <?php foreach ($files as $f): ?>
    <tr>
        <td><?php echo $f['File']['id'];?></td>
        <td><?php echo $f['File']['title'];?></td>
        <td>
            <?php echo $this->Html->link(
                'Supprimer',
                array('action' => 'admin_delete', $f['File']['id']),
                array('confirm' => 'Are you sure you want to delete this file?'));
            ?>
        </td>
        <td><?php echo $f['File']['user'];?></td>
        
        <td><?php echo CakeTime::format('d-m-Y', $f['File']['created']); ?></td>
        <td><?php echo CakeTime::format('d-m-Y', $f['File']['modified']); ?></td>
    </tr>
    <?php endforeach; ?>

</table>