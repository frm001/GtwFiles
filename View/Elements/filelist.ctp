<tr>
    <td><?php echo $file['File']['id'];?></td>
    <td>
        <span id='title_<?php echo $file['File']['id']?>'><?php echo $file['File']['title'];?></span>
        <a href="javascript:void(0)" class="editTitle pull-right" data-value="<?php echo $file['File']['title']?>" data-pk="<?php echo $file['File']['id'];?>"><i class="fa fa-pencil"> </i></a>
    </td>
    <td><?php echo $file['File']['filename'];?></td>
    <td><?php echo $file['File']['ext'];?></td>
    <td class='text-right'><?php echo $this->Number->toReadableSize($file['File']['size']);?></td>
    <?php if($this->Session->read('Auth.User.role')=='admin'){?>
        <td><?php echo $file['User']['first'].' <small>('.$file['User']['email'].')</small>';?></td>
    <?php }?>
    <td><?php echo $this->Time->format('Y-m-d H:i:s', $file['File']['created']); ?></td>
    <td class="text-center">
        <span class="text-center">
            <?php echo $this->Html->actionIcon('fa fa-download', 'download', $file['File']['filename']);?>
            &nbsp;
            <?php echo $this->Html->link('<i class="fa fa-trash-o"> </i>',array('controller'=>'files','action'=>'delete',$file['File']['id']),array('role'=>'button','escape'=>false,'title'=>'Delete this file'),'Are you sure? You want to delete this file.');?>
        </span>
    </td>
</tr>