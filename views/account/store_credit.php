<div class="km_col_12 km_field_wrap km_storecredit_wrap">
    <h3><?php _e("Store Credits", "fieldday"); ?></h3>
    <a onclick="return fieldday.openClaimForm(this, event);" class="km_btn km_claim_btn km_primary_bg"><?php _e("Claim Credit"); ?></a>
</div>
<?php if(empty($storeCredits)) : ?>
    <table class="km_table">
        <tr><td style="text-align: center; background: #fff;" colspan="4"><?php _e("No data found"); ?></td></tr>
    </table>
    
<?php else: ?>
    <table class="km_table">
        <tbody>
            <tr>
                <th><?php _e("Total Credits", "fieldday"); ?></th>
                <th><?php _e("Used Credits", "fieldday"); ?></th>
                <th><?php _e("Remaining Credits", "fieldday"); ?></th>
                <th><?php _e("Date", "fieldday"); ?> </th>
            </tr>
            <?php foreach($storeCredits as $index => $storeCredit): ?>
                <?php if($storeCredit->isPerDayCredit) : ?>
                    <tr>
                        <td><?php echo wp_sprintf("%d %s", $storeCredit->totalDaysCount, __("Days", "fieldday")); ?></td>
                        <td><?php echo wp_sprintf("%d %s", $storeCredit->usedDaysCount, __("Days", "fieldday")); ?></td>
                        <td><?php echo wp_sprintf("%d %s", $storeCredit->remainingDaysCount, __("Days", "fieldday")); ?></td>
                        <td><?php echo $this->parseDate($storeCredit->createdAt); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><?php echo $this->display_price($storeCredit->totalCredits); ?></td>
                        <td><?php echo $this->display_price($storeCredit->usedCredits); ?></td>
                        <td><?php echo $this->display_price($storeCredit->remainingCredits); ?></td>
                        <td><?php echo $this->parseDate($storeCredit->createdAt); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>    
        </tbody>
    </table>
<?php endif; ?>    