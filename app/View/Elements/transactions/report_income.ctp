<?php if (!empty($statistical_data['maxIncome'])): ?>
    <h3>Income (Total: <?php echo __convertMoney($statistical_data['income']) . ' ' . $unit; ?>)</h3>
    <h4>Maximum: <?php
        echo $statistical_data['maxIncome']['category_info']['name'] .
        ' (' . __convertMoney($statistical_data['maxIncome']['amount']) . ' ' . $unit . ')'
        ?>
    </h4>
    <small style="display: block;">Transaction at: <?php echo date('d-m-Y', $statistical_data['maxIncome']['create_time']); ?></small>
    <div class="rp-area">
        <?php
        foreach ($listTransaction as $key => $transaction) :
            if ($transaction['category']['expense_type'] == 'in') :
                $width = round(($transaction['totalMoney'] / $statistical_data['income'] * 100), 2);
                ?>
                <div class="rp-row row">
                    <div class="rp-name col-md-3 col-xs-12">
                        <?php echo $transaction['category']['name'] . ' (' . __convertMoney($transaction['totalMoney']) . ' ' . $unit . ')'; ?>
                    </div>
                    <div class="rp-progress-bar col-md-8 col-xs-9">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" 
                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $width; ?>%">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-xs-3"><?php echo '(' . $width . '%)'; ?></div>
                </div>
                <?php
            endif;
        endforeach;
        ?>
    </div>
<?php endif; ?>