<?php

/*
 * fieldday Base Class
 * @package fieldday
 * @since   1.0.0
 */

class fielddayBase
{

    public function __construct()
    {

    }

    /**
     * get all label and other text info
     * @return Array
     */
    public function getLabelValues()
    {
        $kidText = apply_filters('fieldday_kid_text', __('Kid', 'fieldday'));
        return [

            /* ATC buttons */
            'add_to_cart_btn' => apply_filters('fieldday_add_to_cart_text', __('Add to Cart', 'fieldday')),
            'installment_plans' => apply_filters('fieldday_installment_plans_text', __('Installment Plan', 'fieldday')),
            'atc_next_btn' => apply_filters('fieldday_atc_next_btn', __('Next', 'fieldday')),
            'atc_prev_btn' => apply_filters('fieldday_atc_prev_btn', __('Back', 'fieldday')),
            /* ATC kid form */
            'km_kid_text' => apply_filters('fieldday_kid_text', __('Participant', 'fieldday')),
            /* Atc messages */
            'km_no_kid_found' => apply_filters('fieldday_no_kid_found', __("Oops! We did not find any {$kidText}(s) in Your Profile. Please click Next to Add New.", 'fieldday')),
            'km_cart_help_text' => apply_filters('fieldday_cart_help_text', __('** Discounts and promotion will be apply on checkout page.', 'fieldday')),
            /* ATC form fields lable */
            'km_atc_kidsamount' => apply_filters('fieldday_label_atc_kidsamount', __("Enter the number of {$kidText} for this registration.", 'fieldday')),
            /* ATC form fields modal Title */
            'km_atc_modaltitle_kids' => apply_filters('fieldday_modal_title_kids', __("Select {$kidText}(s).", 'fieldday')),
            'km_atc_modaltitle_kidsform' => apply_filters('fieldday_modal_title_kids_form', __("{$kidText} Information.", 'fieldday')),
            'km_atc_modaltitle_options' => apply_filters('fieldday_modal_title_options', __('Other Options.', 'fieldday')),
            'km_atc_modaltitle_success' => apply_filters('fieldday_modal_title_success', __('Cart Information', 'fieldday')),
            'km_atc_modaltitle_credits' => apply_filters('fieldday_modal_title_credits', __('Select Credits.', 'fieldday')),
            /* ATC messages */
            'atc_empty_cart' => apply_filters('fieldday_atc_empty_cart', __('Your cart is empty. Please add some items into cart.', 'fieldday')),
            'delete_confirm_text' => apply_filters('fieldday_delete_confirm_text', __('are you sure to delete this item?', 'fieldday')),
            /* checkout message */
            'invalid_form_message' => apply_filters('fieldday_invalid_form_message', __('Please complete the required forms.', 'fieldday')),
            'km_calculation_error' => apply_filters('fieldday_invalid_form_message', __('Failed to get your cart information. Please try again later.', 'fieldday')),
            'km_thankyou_title' => apply_filters('fieldday_thankyou_title', __('Congratulations', 'fieldday')),
            'km_thankyou_message' => apply_filters('fieldday_thankyou_message', __('Your signup request is processed successfully. Thank you!', 'fieldday')),
            'km_checkout_return_text' => apply_filters('fieldday_checkout_return_text', __('Return to Home', 'fieldday')),
            'km_checkout_return_url' => apply_filters('fieldday_checkout_return_url', site_url()),
            'km_event_thankyou_title' => apply_filters('fieldday_thankyou_title', __('Thank You!', 'fieldday')),
            'km_event_thankyou_message' => apply_filters('fieldday_thankyou_message', __('Tickets have been emailed to you. Upon arrival, follow the email instructions to speed up check-in.', 'fieldday')),
            'km_waitlist_thankyou_title' => apply_filters('fieldday_thankyou_title', __('You are on the Waitlist', 'fieldday')),
            'km_waitlist_thankyou_message' => apply_filters('fieldday_thankyou_title', __('We will notify you if a spot opens up. Keep an eye out for an email, text, call or notification so we can get you booked.', 'fieldday')),
            'km_multiweek_thankyou_message' => apply_filters('fieldday_thankyou_message', __('Your request is processed successfully. Thank you!', 'fieldday')),
            'km_merchandise_thankyou_title' => apply_filters('fieldday_thankyou_title', __('Congratulations', 'fieldday')),
            'km_merchandise_thankyou_message' => apply_filters('fieldday_thankyou_message', __('Your purchase request is processed successfully. Thank you!', 'fieldday')),
            'km_merchandise_checkout_return_text' => apply_filters('fieldday_checkout_return_text', __('Return to Home', 'fieldday')),
            'km_merchandise_checkout_return_url' => apply_filters('fieldday_checkout_return_url', site_url()),
            'km_empty_cart_msg' => apply_filters('fieldday_cart_empty_message', __("Your cart is empty. Please add some items into cart.")),
            'km_not_relevant_account' => apply_filters('fieldday_cart_notrelevant_message', __("The Cart Item is not relevant to this account. Login with different account.")),
            'bank_day_btn' => apply_filters('fieldday_merchandise_purchase_btn', __('Purchase', 'fieldday')),
            'km_logout_btn' => apply_filters('fieldday_logout_btn', __('Log Out', 'fieldday')),
            /* google map popup */
            'map_header_text' => apply_filters('fieldday_map_header_text', __('Drag pointer to select latitude and longitude.', 'fieldday')),
            'map_footer_button_text' => apply_filters('fieldday_map_footer_button_text', __('Select', 'fieldday')),
            'confirm_pop_text' => apply_filters('fieldday_confirm_pop_text', __('You can`t Select more than limit as you select from step one. For Select More kids press "ok"  ', 'fieldday')),
            /* checkout label */
            'km_checkout_personal_info_lable' => apply_filters('fieldday_checkout_personal_info_lable', __('Contact Information', 'fieldday')),
            //'km_checkout_kid_info_lable' => apply_filters('fieldday_checkout_kid_info_lable', __($kidText . ' Information', 'fieldday')),
            'km_checkout_kid_info_lable' => apply_filters('fieldday_checkout_kid_info_lable', __('Participant Information', 'fieldday')),
            'km_checkout_purchase_info_lable' => apply_filters('fieldday_checkout_purchase_info_lable', __('Purchase Details', 'fieldday')),
            'km_checkout_purchase_confirmation_lable' => apply_filters('fieldday_checkout_confirmation_info_lable', __('Purchase Confirmation', 'fieldday')),
            'km_required_fields_disclaimer' => apply_filters('fieldday_required_fields_disclaimer', __('* Indicate Required Field', 'fieldday')),
            'km_clear_session_filters_btn_text' => apply_filters('km_clear_session_filters_btn_text', __('Clear Filters', 'fieldday')),
            'km_no_session_found' => apply_filters('fieldday_required_fields_disclaimer', __("No session found. Please try again or use other filters", "fieldday")),
        ];
    }

}
