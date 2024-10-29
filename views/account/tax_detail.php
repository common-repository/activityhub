<?php //echo "<pre>"; print_r($taxDetails); ?>
<h3><?php _e("Tax Details", "fieldday"); ?></h3>

<?php if(empty($taxDetails)) : ?>
    <div class='km_nodata'><?php _e("No data found"); ?></div>
<?php else: ?>
    <div class="km_taxdetails_wrap km_row">
        <?php foreach($taxDetails as $key => $taxDetail): ?>
            <div class="km_col_3">
                <div class="km_single_taxdetail">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/tax_calender.png"/>
                    <span class="km_tax_year"><?php $this->getValue('year', $taxDetail); ?></span>
                    <span title="Total tax paid for <?php $this->getValue('year', $taxDetail); ?>" class="km_tax_paid km_text_green"><?php echo $this->display_price($this->getValue('totalExpense', $taxDetail, false)); ?></span>
                    <span class="km_tax_vendor km_primary_bg">Tax Id: <?php echo $taxDetail->vendors[0]->taxId; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>