<tr>
    <td><?php echo $file['File']['id'];?></td>
    <td><?php echo $file['File']['title'];?></td>
    <td>
        <?php echo $this->Html->link(
            'Supprimer',
            array('action' => 'admin_delete', $file['File']['id']),
            array('confirm' => 'Are you sure you want to delete this file?'));
        ?>
    </td>
    <td><?php echo $file['User']['email'];?></td>
    
    <td><?php echo CakeTime::format('d-m-Y', $file['File']['created']); ?></td>
    <td><?php echo CakeTime::format('d-m-Y', $file['File']['modified']); ?></td>
</tr>