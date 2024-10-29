<?php //echo "<pre>"; print_r($creditStatements); ?>
<h3><?php _e("Store Credits Statement", "fieldday"); ?></h3>
<div class="km_row km_row km_credit_statement_btn_wrapper">
    <div onclick="return fieldday.creditStatementFilter(this, 'true');" class="km_day_credit km_credit_filter km_cred_filter_active km_primary_bg ">
        <span><i class="far fa-calendar-alt"></i> <?php _e("Day Credit", 'fieldday'); ?></span>
    </div>
    <div onclick="return fieldday.creditStatementFilter(this, 'false');" class="km_dollar_credit km_credit_filter km_primary_color  km_transparent_bg">
        <span><i class="fas fa-funnel-dollar"></i> <?php _e("Dollar Credit", 'fieldday'); ?></span>
    </div>
</div>
<?php if(empty($creditStatements)) : ?>
    <div class='km_nodata'><?php _e("No data found"); ?></div>
<?php else: ?>
    <table class="km_table">
        <tbody>
            <tr>
                <th><?php _e("Order Id", "fieldday"); ?></th>
                <th><?php _e("Type", "fieldday"); ?></th>
                <th><?php _e("Credit Count", "fieldday"); ?></th>
                <th><?php _e("Date", "fieldday"); ?> </th>
                <th><?php _e("Remarks", "fieldday"); ?></th>
            </tr>
            <?php foreach($creditStatements as $index => $creditStatement): ?>
                <?php $class = $creditStatement->statementType == 'debit' ? 'km_text_red' : 'km_text_green'; ?>
                <?php if($creditStatement->gainedFrom == "paidForOrder"): ?>
                    <tr>
                        <td><b><?php echo $creditStatement->paidOrderId->orderNo; ?></b></td>  
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>     
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("Paid For Order", "fieldday"); ?></td>
                    </tr>
                <?php elseif($creditStatement->gainedFrom == "purchased") : ?>  

                    <tr>
                        <td><b><?php echo $creditStatement->purchaseOrderId->orderNo; ?></b></td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>    
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("Purchased", "fieldday"); ?></td>
                    </tr>
                <?php elseif($creditStatement->gainedFrom == "givenByProvider") : ?>  
                    <tr>
                        <td><b><?php echo $creditStatement->providerCreditsGivenId; ?></b></td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>     
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("Given by Provider", "fieldday"); ?></td>
                    </tr>
                <?php elseif($creditStatement->gainedFrom == "orderCancellation"): ?>
                    <tr>
                        <td><b><?php echo $creditStatement->cancelledOrderId; ?></b></td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>    
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("Order Cancellation", "fieldday"); ?></td>
                    </tr>  
                <?php elseif($creditStatement->gainedFrom == "seatCancellationByProvider"): ?>
                    <tr>
                        <td><b><?php echo $creditStatement->sessionAffectedOrderDetailId; ?></b></td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>     
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("seat Cancellation By Provider", "fieldday"); ?></td>
                    </tr>  
                <?php elseif($creditStatement->gainedFrom == "bookingReward"): ?>
                    <tr>
                        <td>n/a</td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <?php if($creditStatement->isPerDayCredit) : ?>
                            <td><?php echo wp_sprintf("%d %s", $creditStatement->daysCount, __("Days", "fieldday")); ?></td>
                        <?php else: ?>
                            <td><?php echo $this->display_price($creditStatement->creditAmount); ?></td>
                        <?php endif; ?>     
                        <td><?php echo $this->parseDate($creditStatement->createdAt); ?></td>
                        <td><?php _e("Booking Reward", "fieldday"); ?></td>
                    </tr>    
                <?php else: ?>
                    <tr <?php echo json_encode($creditStatement); ?>>
                        <td>-</td>
                        <td class="<?php echo $class; ?>">
                            <?php echo $creditStatement->statementType == 'debit' ? 'Used' : 'Added'; ?>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $creditStatement->gainedFrom; ?></td>
                    </tr>
                <?php endif; ?>         
            <?php endforeach; ?>    
        </tbody>
    </table>
<?php endif; ?>