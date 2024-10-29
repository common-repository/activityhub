<div class="km_session_purchase">
    <form class="km_purchase_form" method="post" id="km_purchase_form">
        <div class="session_purchase_steps">
            <?php echo $this->getView('checkout/session_purchase_steps', ['steps' => $steps]); ?>
        </div>
        <div id="km_purchase_wrap" class="km_purchase_wrap">
            <?php do_action('km_before_purchase_form');?>
            <div class="km_purchase_form_content">
<?php
foreach ($steps as $stepId => $step) {
    echo $this->getView('checkout/' . $step['name'], ['step' => $step, 'stepId' => $stepId]);
}
?>
            </div>
            <?php do_action('km_after_purchase_form');?>
        </div>
    </form>
</div>
