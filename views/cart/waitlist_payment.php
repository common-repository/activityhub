<div class="km_checkIn">
<div class="km_80_1 km_ticket_section">
	<img src="<?php echo fieldday_URL; ?>/assets/img/happiness.png">
        <h2 class="km_primary_color">Good news, the wait is over!!</h2>
    <p>Rohan & Riya's(Kids name) spots at the upcoming Art Camp(Session name) beginning March 16th(session date) can be confirmed by submitting payment.</p>
        <div class="km_ticket_wrap">
    <div class="km_pull_ticket">
        <p class="km_pull_heading km_hidden"><strong>SELF CHECK-IN,</strong> I have bought my ticket online, help me find my ticket with either email id or phone number.</p>
        <form id="km_payment_form" class="km_payment_form" action="#" method="post">
            <div class="km_payment_wrap">
                <div class="km_col_8 km_field_wrap field_card_number">
                    <label for="km_card_number"><?php _e('Card Number', 'fieldday'); ?></label>
                    <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="km_payment"  required="" />
                    <div class="km_card_type"></div>
                </div>
                <div class="km_col_4 km_field_wrap field_card_cvv">
                    <label for="km_cvv_code"><?php _e('CVV Code', 'fieldday'); ?></label>
                    <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="km_payment" data-parsley-required-message="Required"  required=""   />
                </div>
                <div class="km_col_12 km_field_wrap field_card_holdername">
                    <label for="km_card_holder_name"><?php _e('Card Holder Name', 'fieldday'); ?></label>
                    <input  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  type="text" id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="km_payment" required="" />
                </div>
                <div class="km_col_6 km_field_wrap field_card_exp">
                    <label><?php _e('Exp.Month', 'fieldday'); ?></label>
                    <div class="km_custom_dropdown">
                        <select id='km_expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="km_payment" required="" >
                            <option value='' selected>Select</option>
                            <?php foreach($this->KmMonths() as $number => $monthName): ?>
                            <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                <div class="km_col_6 km_field_wrap field_card_exp_year">
                    <label><?php _e('Exp.Year', 'fieldday'); ?></label>
                    <div class="km_custom_dropdown">
                        <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="km_payment" data-parsley-required-message="Required"  required=""  >
                            <option value=''>Select</option>
                            <?php 
                            for ($i = date('Y'); $i <= date('Y')+30; $i++) {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            } ?>
                        </select> 
                    </div>
                </div>
                <?php if($KmUser): ?>
                    <div class="km_col_6 km_field_wrap">
                        <label class='km_checkbox_wrap'>
                            <span><?php _e("Save this card") ?></span>
                            <input name="saveCard" type="checkbox" <?php echo $this->getCardSaveOptions($step['name']); ?> class="km_provider_terms km_checkboxteam">
                            <span class="km_checkbox"></span>
                        </label>    
                    </div>
                <?php endif; ?>
                <div class="km_ticket_btn_wrap">
                	<a class="km_btn km_primary_bg km_pullticket_btn"><?php _e("Place Your Order", 'fieldday'); ?></a>
            	</div>
            </div>
        </form>
    </div>
    <div class="km_new_ticket">
        <!-- <p><strong>NEW TICKET,</strong> My ticket has not yet been purchased, Take me to the purchase page to buy the event ticket.</p> -->
        <!-- <div class="km_ticket_btn_wrap"><a href="http://localhost/wordpresss/purchase/?tab=events" class="km_btn km_transparent_bg km_primary_color km_session_btn">Purchase Ticket</a></div> -->
    </div>

    </div>   

</div>

</div>