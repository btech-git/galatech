<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Size</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($model->details as $i => $detail): ?>
        <tr>
            <td style="text-align: center">
                <?php echo CHtml::activeTextField($detail, "[$i]size", array('maxLength' => 60)); ?>
                <?php echo CHtml::error($detail, 'size'); ?>
            </td>	

            <td>
                <?php
                echo CHtml::button('Delete', array(
                    'onclick' => CHtml::ajax(array(
                        'type' => 'POST',
                        'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $model->header->id, 'index' => $i)),
                        'update' => '#detail_div',
                    )),
                ));
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>