<h3><?php _e("Saved Cards", "fieldday");?></h3>
<div class="km_card_btn km_col_12">
    <a style="margin: 0px;" class="km_btn km_primary_bg" onclick="fieldday.newCardForm();"><?php _e("Add New Card");?></a>
</div>
<div class="km_saved_cards_wrap">
    <?php foreach ($savedCards as $key => $card): ?>
    <div class="km_col_6 ">
        <div class="credit-card <?php echo str_replace(' ', '-', strtolower($card->cardType)); ?> selectable">
            <div class="credit-card-last4">
                <?php echo $card->cardLast4; ?>
            </div>
            <div class="credit-card-expiry">
                <?php echo $card->expMonth; ?>/<?php echo $card->expYear; ?>
            </div>
            <div class="km_action_wrap">
                <i title="set default" onclick="fieldday.setDefaultCard('<?php echo $card->_id ?>');" class="fa fa-star <?php echo $card->isDefault ? 'star_active' : ''; ?>"></i>
                <i onclick="fieldday.deleteSavedCard('<?php echo $card->_id ?>');" class="fa fa-trash"></i>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>

<!-- Mastercard - selectable -->
<!-- <div class="credit-card mastercard selectable">
    <div class="credit-card-last4">
        8210
    </div>
    <div class="credit-card-expiry">
        10/22
    </div>
</div>-->

<!-- Amex - selectable -->
<!--<div class="credit-card amex selectable">
    <div class="credit-card-last4">
        8431
    </div>
    <div class="credit-card-expiry">
        01/24
    </div>
</div>-->

<!-- Discover - selectable -->
<!--<div class="credit-card discover selectable">
    <div class="credit-card-last4">
        9424
    </div>
    <div class="credit-card-expiry">
        06/23
    </div>
</div>-->

<!-- Diners - selectable -->
<!--<div class="credit-card diners selectable">
    <div class="credit-card-last4">
        3237
    </div>
    <div class="credit-card-expiry">
        08/25
    </div>
</div>-->

<!-- JCB - selectable -->
<!--<div class="credit-card jcb selectable">
    <div class="credit-card-last4">
        1060
    </div>
    <div class="credit-card-expiry">
        02/21
    </div>
</div>-->


<!-- Unionpay - selectable -->
<!--<div class="credit-card unionpay selectable">
    <div class="credit-card-last4">
        0005
    </div>
    <div class="credit-card-expiry">
        03/25
    </div>
</div>-->