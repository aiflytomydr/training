<tr>
    <td><img class="img-26px" src="<?php echo $transaction['Transaction']['category_info']['icon']; ?>" /></td>
    <td><?php echo $transaction['Transaction']['category_info']['name']; ?></td>
    <td><?php echo $transaction['Transaction']['amount']; ?></td>
    <td><?php
        if ($transaction['Transaction']['category_info']['expense_type'] == 'in') :
            echo 'Income';
        else :
            echo 'Expense';
        endif;
        ?></td>
    <td><?php echo $transaction['Transaction']['note']; ?></td>
    <td><?php
        echo $this->Html->link('Edit', array(
            'controller' => 'transactions',
            'action'     => 'edit',
            $transaction['Transaction']['id'],
        ));
        ?></td>
    <td><?php
        echo $this->Html->link('Delete', array(
            'controller' => 'transactions',
            'action'     => 'delete',
            $transaction['Transaction']['id'],
        ));
        ?></td>
</tr>