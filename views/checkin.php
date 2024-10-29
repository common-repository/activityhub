<div class="km_checkIn km_checkin_design_upgrade">
<?php
global $fielddaySetting;
$providerKey = array_key_exists('fieldday_api_provider', $fielddaySetting) ? $fielddaySetting['fieldday_api_provider'] : null;
$IsEventDay = false;
//$EventClass= "km_eventDay";
$events = $ticketdata->booking->details[0];
$session = $events->sessionId;
$activity = $events->activityId;
$eventDate = date('Y-m-d', strtotime($session->dateTimestamp->from));
$Todaydate = date('Y-m-d'); //"2023-11-16"; //date('Y-m-d');
if ($ticketdata->selfCheckinAllowed) {
    $IsEventDay = true;
    $EventClass = "";
}

$eventDateStatus = $ticketdata->eventDateStatus;
if ($eventDateStatus == 'future') {
    $eventDateStatus_title = 'Upcoming Event';
    $hide_checkout_button_class = 'km_hidden';
} elseif ($eventDateStatus == 'past') {
    $eventDateStatus_title = 'Completed Event';
    $hide_checkout_button_class = 'km_hidden';
} elseif ($eventDateStatus == 'today' && $ticketdata->isSelfCheckIn) {
    $eventDateStatus_title = 'Ticket Checked-in';
    $hide_checkout_button_class = 'km_hidden';
} elseif ($eventDateStatus == 'today') {
    $eventDateStatus_title = 'Ticket Found';
    $hide_checkout_button_class = '';
} else {
    $eventDateStatus_title = 'Ticket Found';
    $hide_checkout_button_class = 'km_hidden';
}

$newdates = date('M, d Y', strtotime($eventDate));
$purchase_page = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
if ($ticketid && $ticketdata->bookingFound == 1) {

    //case to cancel or refund
    //original if($providerKey=='62ffe9b671e2c33fc449f104' && $session->_id=='6526fbd2f50ede01bfc7c77c'){
    if ($session->allowSelfRefundOnCancellation || $session->allowSelfTransferOnCancellation) {
        if ($session->allowSelfRefundOnCancellation && $session->allowSelfTransferOnCancellation) {
            $no_of_options_offered = 'two options';
        } else {
            $no_of_options_offered = 'one option';
        }
        echo '<div class="km_checkin_tickets_option">
        <div class="km_checkin_tickets_option_hd">
            <h2 class="km_tickets_lg_hd">Booking Options</h2>
            <p class="km_tickets_sm_hd">Transfer/ Cancel</p>
        </div>
        <form class="km_checkin_tickets_option_content">
                <input type="hidden" name="orderid" value="' . $ticketdata->booking->_id . '" />
                <input type="hidden" name="ticketId" value="' . $ticketdata->booking->ticketId . '" />
                <input type="hidden" name="orderNo" value="' . $ticketdata->booking->orderNo . '" />
                <input type="hidden" name="providerID" value="' . $ticketdata->booking->providerId->_id . '" />
                <input type="hidden" name="eventId" value="' . $events->_id . '" />';
        if ($session->allowSelfTransferOnCancellation) {
            echo '<input type="hidden" name="newSessionId" value="' . $session->transferToSessions[0]->_id . '" />';
        }

        if (($session->allowSelfRefundOnCancellation && $session->allowSelfTransferOnCancellation) || ($session->allowSelfTransferOnCancellation && !$session->allowSelfRefundOnCancellation)) {
            echo '<p class="km_checkin_tickets_contentm">Due to inclement weather, we regret to announce that the event scheduled for ' . date('M d', strtotime($events->localDateTimestamp->from)) . ' has been cancelled. For those who have purchased tickets, we offer ' . $no_of_options_offered . ':</p>';
        } else {
            echo '<p class="km_checkin_tickets_contentm">We regret to announce that the event scheduled for December ' . date('M d', strtotime($events->localDateTimestamp->from)) . ' has been cancelled. We understand this may be disappointing and apologize for any inconvenience caused. For those who have purchased tickets, please rest assured that we will process refunds in accordance with our policy.</p>';
        }

        echo '<div class="options">';
        if ($session->allowSelfRefundOnCancellation) {
            echo '<label title="Select to Cancel/ Refund booking.">
                    <input type="radio" name="order_refund" value="refund"><div class="km_main_check"><i class="fas fa-check"></i></div>
                    Cancel and Refund my order.
                </label>';
        }
        if ($session->allowSelfTransferOnCancellation) {
            echo '<label title="Select to Reschedule booking.">
                    <input type="radio" name="order_refund" value="transfer"><div class="km_main_check"><i class="fas fa-check"></i></div>
                    Transfer to ' . date('d M, Y', strtotime($session->transferToSessions[0]->dateTimestamp->from)) . ' event(' . $session->transferToSessions[0]->name . ').
                </label> ';
        }

        echo '</div>
                <div class="km_btn_wrap">
                 <button class="km_btn km_primary_bg  km_btn_i_wrapper" id="km_order_refund_form_submit" type="submit"><i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>Submit</button>
                </div>
        </form>
        </div>';
    } else {
        //case to cacel or refund end
        //case when ticket is found start for upper  section
        if ($ticketdata->isSignedIn) {?>
                <div class="km_ticket_header"><h2 class="km_primary_color"><?php echo $eventDateStatus_title; ?></h2>
                    <?php if ($ticketdata->showMessage && $ticketdata->showMessage != '') {?> <p class="check_in_tikcet_found_p"><?php echo $ticketdata->showMessage; ?></p> <?php }?>
                    <a href="javascript:void(0);" class="km_btn km_primary_bg km_self_checkIn_btn  <?php echo $hide_checkout_button_class; ?>" data-id="<?php echo $ticketdata->booking->ticketId; ?>" data-order="<?php echo $ticketdata->booking->orderNo; ?>">Click to Self Check-in</a>
                    <p class="check_in_page_show_qr_text <?php echo $hide_checkout_button_class; ?>">If Self Check-in does'nt work, present this QR Code & details at the counter.</p>
                </div>
        <?php } else {
            if ($IsEventDay == false) {
                echo '<div class="km_ticket_header ' . $EventClass . '"><h2 class="km_primary_color">' . $eventDateStatus_title . '</h2>';
                if ($ticketdata->showMessage && $ticketdata->showMessage != '') {
                    echo '<p class="check_in_tikcet_found_p">' . $ticketdata->showMessage . '</p>';
                }
                echo '<a href="javascript:void(0);" class="km_btn km_primary_bg km_session_btn disabled ' . $hide_checkout_button_class . '">Click to Self Check-in</a><div class="kmEvent_header ' . $EventClass . '"><p class="check_in_page_show_qr_text ' . $hide_checkout_button_class . '">You can complete this process when you arrive at the event on ' . $newdates . '.</p></div></div>';
            } else {?>
            <div class="km_ticket_header"><h2 class="km_primary_color"><?php echo $eventDateStatus_title; ?></h2>
                <?php if ($ticketdata->showMessage && $ticketdata->showMessage != '') {?> <p class="check_in_tikcet_found_p"><?php echo $ticketdata->showMessage; ?></p> <?php }?>
                <a href="javascript:void(0);" class="km_btn km_primary_bg km_self_checkIn_btn  <?php echo $hide_checkout_button_class; ?>" data-id="<?php echo $ticketdata->booking->ticketId; ?>" data-order="<?php echo $ticketdata->booking->orderNo; ?>">Click to Self Check-in</a>
                <p class="check_in_page_show_qr_text <?php echo $hide_checkout_button_class; ?>">If Self Check-in does'nt work, present this QR Code & details at the counter.</p>
            </div>
    <?php }}}?>

<!--//case when ticket is found start for upper  section -->

<div id="km_checkin_wrap" class="km_checkin_wrap km_col_12 <?php echo $EventClass; ?>">
    <ul class="km_sessions_list km_list km_grid <?php echo 'km_theme_mode_ul_' . fieldday()->engine->getValue('fieldday_theme_mode', $fielddaySetting, false); ?>" id="km_sessions_list_two_column_layout">
    <li id="km_session_two_coloum_layout" class="km_checkIn_single_item" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>">

    <div class="km_col_5 km_padding5 view_ticket_checkin_pg_col">
        <div class="km_thumbnail_title">

            <div class="km_full_age">
                <input type="hidden" id="km_session_tags" value="{}">
                <h3 class="km_session_name_heading km_with_tooltip km_primary_color">Ticket Details</h3>
                <p class="km_session_title_checkin_pg"><?php echo $session->name; ?></p>
                <div class="km_month_date km_month_year">
                    <i class="fa fa-calendar km_primary_color" aria-hidden="true"></i>
                    <span class="time km_session_month"><?php echo date('M d', strtotime($events->localDateTimestamp->from)) . '-' . date('M d', strtotime($events->localDateTimestamp->to)); ?></span>
                    <span class="year km_session_year"><?php echo date('Y', strtotime($events->localDateTimestamp->to)); ?></span>
                </div>
                <div class="km_time">
                    <i class="fa fa-clock km_primary_color" aria-hidden="true"></i>
                    <span class="time km_sess_time"><?php echo date('g:i A', strtotime($events->localDateTimestamp->from)) . '-' . date('g:i A', strtotime($events->localDateTimestamp->to)); ?></span>
                </div>
                <div class="km_group_size">
                    <span>Group Size</span>
                    <span class="km_number km_highlight_color"><?php echo $events->totalParticipants; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="km_col_4 km_padding5 view_ticket_checkin_pg_col">
        <div class="km_Heading_content">
            <!-- Heading -->
            <div class="km_QRCode">
                <h4>QR Code to Check-in</h4>
                <div class="km_thumbnail_checkin km_qr_img">

                    <img src="<?php echo $events->qrBase64; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="km_col_3 km_details_col view_ticket_checkin_pg_col">
        <div class="km_session_bottom_wrap km_listview_price_col km_checkin_details">
           <h4>Order Details</h4>
           <div class="km_checkin_detail"><label>Ticket:</label><span><?php echo $ticketdata->booking->orderNo; ?></span></div>
           <div class="km_checkin_detail"><label>Contact:</label><span><?php echo $ticketdata->booking->parentId->name; ?></span></div>
           <div class="km_checkin_detail"><label>Email:</label><span><?php echo $ticketdata->booking->parentId->email; ?></span></div>
           <div class="km_checkin_detail"><label>Group:</label><span><ul>
            <?php $participants = $events->participants;
            $priceBreakup =  $events->priceBreakup;
            if($priceBreakup ){
                foreach ($priceBreakup as $key => $participant) {
                    echo '<li>' . $participant->customGroupKey . ' ' . $participant->seatCount . '</li>';
                }
            }else{
                foreach ($participants as $key => $participant) {
                    echo '<li>' . $key . ' ' . $participant . '</li>';
                }
            }

    ?>
            </ul>
            </span></div>
        </div>
    </div>


</li></ul>
</div>
<?php } else {?>
<div class="km_80_1 km_ticket_section">
    <?php if (isset($notfound)) {?>
        <h2>Ticket Not Found!!</h2>
        <p class="km_pull_heading">Oops something went wrong! Our search for entered information could not yield any tickets.</p>
    <?php } else {?>
    <h2>Welcome to <?php echo get_bloginfo(); ?></h2>
    <?php }?>
    <div class="km_ticket_wrap">
    <div class="km_pull_ticket">
        <p class="km_pull_heading"><strong>SELF CHECK-IN,</strong> I have bought my ticket online, help me find my ticket with either email id or phone number.</p>

        <form id="km_ticket_form" class="km_ticket_form" action="#" method="post">

            <div class="km_field_wrap required_field">
                <i class="fa fa-user-circle km_user_icon" aria-hidden="true"></i>
                <input type="email" required data-parsley-errors-messages-disabled class="km_input" name="ticket_email" placeholder="Email Address">
            </div>
            <div class="km_or_field">OR</div>
            <div class="km_field_wrap">
                <!-- <i class="fa fa-phone km_user_icon" aria-hidden="true"></i> -->
                <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                <input type="tel" required  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-errors-messages-disabled value="" name="ticket_phone" id="Phone"  class="km_phone_field km_input" placeholder="Phone Number"/>
            </div>
            <div class="invalid-form-error-message"></div>
            <div class="km_ticket_btn_wrap">
                <a class="km_btn km_primary_bg km_pullticket_btn">Find Ticket</a>
            </div>
        </form>
    </div>
    <div class="km_new_ticket">
        <p><strong>NEW TICKET,</strong> My ticket has not yet been purchased, Take me to the purchase page to buy the event ticket.</p>
        <div class="km_ticket_btn_wrap"><a href="<?php echo $purchase_page . '?tab=events'; ?>" class="km_btn km_transparent_bg km_primary_color km_session_btn">Purchase Ticket</a></div>
    </div>

    </div>

</div>

<?php }?>
</div>