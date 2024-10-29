     <div id="km_modal_discount_global" style="display: block" class="km_modal km_overlay modal-normal">
            <div class="km_modal_alert">
                <a href="javascript:void();" class="km_popup_close" onclick="fieldday.closediscountpopup(this);">
                    <svg width="12" height="12" viewport="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <line x1="1" stroke="#fff" y1="11" x2="11" y2="1" stroke-width="2"></line>
                        <line x1="1" y1="1" stroke="#fff" x2="11" y2="11" stroke-width="2"></line>
                    </svg>
                </a>
                <!-- <div class="km_modal_heading"></div> -->
                <div class="km_modal_content" style="/*background: #0e5763;*/ padding:0px;">
                    <div class="km_globalpop_content">
                        <?php print apply_filters("fieldday_global_popup_content", $this->getview('_global_popup')); ?>
                    </div>
                </div>
            </div>
        </div>
