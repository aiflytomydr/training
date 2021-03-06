<?php echo $this->Html->script('wallets/processWallet'); ?>
<div class="popupForm">
    <?php
    //get list unit
    $optionUnit = array();
    foreach ($listUnit as $key => $unitObj):
        $optionUnit[$unitObj['Unit']['id']] = $unitObj['Unit']['name'] . ' (' . $unitObj['Unit']['signature'] . ')';
    endforeach;

    //process wallet's icon
    $icon = '/img/wallet.png';
    if (!empty($this->request->data['Wallet']['icon'])) {
        $icon = $this->request->data['Wallet']['icon'];
    }

    echo $this->Form->create('Wallet', array(
        'inputDefaults' => array(
            'div' => array(
                'class' => 'form-group',
            ),
        ),
        'type'          => 'file',
    ));
    echo $this->Form->input('name', array(
        'label'    => "Wallet's name",
        'class'    => 'form-control',
        'required' => false,
    ));
    echo $this->Form->input('icon', array(
        'label'    => 'Icon',
        'type'     => 'file',
        'class'    => 'form-control',
        'between'  => "<div class='icon-preview form-group'><img class='wl-icon-preview' src='" . $icon . "'/></div>",
        'required' => false,
    ));
    echo $this->Form->input('unit_id', array(
        'options'  => array($optionUnit),
        'empty'    => 'Choose unit',
        'class'    => 'form-control',
        'required' => false,
    ));
    echo $this->Form->end(array(
        'label' => 'Update wallet',
        'div'   => array(
            'class' => 'form-group'
        ),
        'class' => 'btn btn-default',
    ));
    ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Wallets.init();
    });
</script>