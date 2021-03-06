<?php
echo $this->Html->script('categories/processCategory');

//process option select wallet
$optionWallet = array();

foreach ($listWallet as $wallet) :
    $optionWallet[$wallet['Wallet']['id']] = $wallet['Wallet']['name'];
endforeach;
?>
<div class="popupForm">
    <?php
    echo $this->Form->create('Category', array(
        'inputDefaults' => array(
            'div' => array(
                'class' => 'form-group',
            ),
        ),
        'url'           => array(
            'controller' => 'Categories',
            'action'     => 'add',
        ),
        'type'          => 'file',
    ));
    echo $this->Form->input('name', array(
        'label'    => "Category's name",
        'class'    => 'form-control',
        'required' => false,
    ));
    echo $this->Form->input('icon', array(
        'label'    => 'Icon',
        'type'     => 'file',
        'class'    => 'form-control',
        'between'  => "<div class='icon-preview form-group'><img class='wl-icon-preview' src='/img/building.png'/></div>",
        'required' => false,
    ));
    echo $this->Form->input('expense_type', array(
        'options'  => array(
            'in'  => 'Income',
            'out' => 'Expense',),
        'empty'    => 'Choose type',
        'class'    => 'form-control',
        'required' => false,
    ));
    echo $this->Form->input('wallet_id', array(
        'label'   => 'Choose Wallet',
        'options' => $optionWallet,
        'default' => AuthComponent::user('current_wallet'),
        'class'   => 'form-control',
    ));
    echo $this->Form->end(array(
        'label' => 'Create Category',
        'div'   => array(
            'class' => 'form-group'
        ),
        'class' => 'btn btn-default',
        'id'    => 'btnCategoryAdd',
    ));
    ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Categories.init();
    });
</script>