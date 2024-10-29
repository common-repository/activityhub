# Field Day
Contributors: glocify
Tags: fieldday, fieldday, camps, onlineclasses, kids activity
Requires at least: 5.0
Tested up to: 6.4.2
Stable tag: 3.4.0
Requires PHP: 7.2 or Greater
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Field Day wordpress plugin is a free wordpress plugin

== Description ==

Field Day plugin can be used on wordpress websites to use fieldday API to get sessions, Get user profile with provider

== Installation ==

1) Download the plugin, unzip it and move the unzipped folder to the wp-content/plugins directory in your WordPress installation.
2) In your admin panel, go to Plugins and you find fieldday in the plugins section.
3) Click on the Activate button to use your new plugin right away.

== Requirments ==

valid fieldday account. You can get the details from [fieldday](https://www.vendor.fieldday.com)

== Frequently Asked Questions ==

= How can i get API details =

go to [fieldday](https://www.fieldday.com) and signup as vendor and you will get your API key details.

= Where i need to setup API key details? =

Go to your admin area and find the menu link with name `fieldday` in left sidebar panel and add your configuration details here

== available shortcodes ==

**Session Listing:-** `[fieldday_sessions]` This shortcode will list the session registered in Ipad application. This shortcode will fetch the session through an API call.

**Activity Session Listing:-** `[fieldday_activity_sessions]` This shortcode will list the specific session with Session ID and sessions within specific activity with Activity ID parameters in shortcode. This shortcode will fetch the sessions through an API call.

[fieldday_activity_sessions] :- To fetch all the sessions

[fieldday_activity_sessions activityid="pass activity id here"] :- To fetch all the sessions from any activityid.

[fieldday_activity_sessions sessionid="pass session id here"] :- To fetch single session by sessionid.

[fieldday_activity_sessions sessionid="pass session id here" buttononly="true"] :- To display add to cart button for a session.

[fieldday_event_button type="bankday" id='bank day event id here'  text='Purchase Now'] :-  - To create fieldday button to pop up bankday, by bank day event id and text.By passing text we can override plugin default text.
 
[fieldday_event_button type="giftcard" id='giftcard id here'   text='Purchase Now'] :-  - To create fieldday button to pop up giftcard, by passing giftcard event id and text.By passing text we can override plugin default text.
 
[fieldday_event_button id='session or event id here'   text='Purchase Now'] :-  - To create fieldday button to pop up session or event, by passing event id and text.By passing text we can override plugin default text.


**CheckIn Page:-** `[fieldday_checkin]` This shortcode will used on the Check-in Page. Where user can see the ticket details to self Check-in.

**Login Page:-** `[fieldday_login]` This shortcode will display a login screen on the page. Where user can use their fieldday acount detail.

**Register page** `[fieldday_register]` This shortcode will display a register screen on the page. Where user can use their information to register a new fieldday account.

**Profile page:-** `[fieldday_profile]` This shortcode will display a user profile page where user can update parents basic information , kids information and insurance informations etc.

**Cart page:-** `[fieldday_cart]` This shortcode will display a cart page where user can see the items added into cart to purchase.

**Checkout page:-** `[fieldday_checkout]` This shortcode will display a checkout page where user can purchase the items added into cart through stripe payments.

**Contact Us Form :-** `[fieldday_contact]` This shortcode will display a contact form.

**Request Demo Form :-** `[fieldday_requestdemo]` This shortcode will display a Request demo form.

**Party Form :-** `[fieldday_partyform]` This shortcode will display a party form.

**Donation form:-** `[fieldday_donate event_name="" event_description="" column="1 0r 2" success_message=""]` This shortcode will display a donation form.

** Thankyou Page  :-** `[fieldday_thankyou_page]` Firstly create a thankyou page , and in the page add the shortcode . Once the shortcode is added , save the page . And in fieldday settings set the thankyou page. After camps,semester,events ticket purchase users will be redirected to the thankyou page.

=== Developer's Guide ===

== overwriting views ==

You can overwrite the view file into your theme. Just create a folder with name ```fieldday``` in theme's root and place the files with the same name and folder structure as in fieldday plugin.

== Plugin Filters ==

Filter are used to overwrite some outputes through your theme file. fieldday plugin use a couple of filters which can be extends into theme. Below is the list of filters you can use.

`
fieldday_states_list
fieldday_doctor_form_lable
fieldday_dietrestrict_form_lable
fieldday_treatments_form_lable
fieldday_symptoms_form_lable
fieldday_food_allergies_form_lable
fieldday_environment_allergies_form_lable
fieldday_medication_allergies_form_lable
fieldday_medical_insurance_form_lable
fieldday_dental_insurance_form_lable
fieldday_health_concerns_form_lable
fieldday_provider_terms
fieldday_after_logout_url
fieldday_default_avtar
fieldday_add_to_cart_text
fieldday_atc_next_btn
fieldday_atc_prev_btn
fieldday_kid_text
fieldday_no_kid_found
fieldday_label_atc_kidsamount
fieldday_modal_title_seats
fieldday_modal_title_kids
fieldday_modal_title_kids_form
fieldday_modal_title_options
fieldday_modal_title_credits
fieldday_atc_empty_cart
fieldday_delete_confirm_text
fieldday_invalid_form_message
fieldday_invalid_form_message
fieldday_thankyou_title
fieldday_thankyou_message
fieldday_checkout_return_text
fieldday_checkout_return_url
fieldday_cart_empty_message
fieldday_merchandise_purchase_btn
fieldday_logout_btn
fieldday_confirm_pop_text
fieldday_session_filter_search
fieldday_session_filter_types
fieldday_session_filter_bankdays
fieldday_session_filter_location
fieldday_session_filter_month
fieldday_session_filter_age
fieldday_session_filter_type
km_merchandise_thankyou_title
km_merchandise_thankyou_message
km_merchandise_checkout_return_text
km_merchandise_checkout_return_url
donation_success_message
fieldday_session_filters

== Screenshots ==

1. Session Filters.
2. Session list view.
3. Session grid view.
4. Login screen
5. My profile page area
6. Configuration screen in backend

== Changelog ==

= 3.4.0 =
* Fieldday Security Fixes
* Fieldday Login process skip at event ticket checkout
* Fieldday Stripe Checkout/datepicker checkout Fixes 

= 3.3.8 =
* Fieldday Thankyou Page 
* UI Changes
* Accessing camps,session,event from url
* Country select option in fieldday settings
* Gift Card inout issue fixed
* Add Max discount label for Coupons have the Max discount enable

= 3.3.7 =
* UI Changes and Plugin fixes

= 3.3.6 =
* Checkout Process for session and event  UI Changes

= 3.3.5 =
* Wishlist & Add to Cart functionality updates

= 3.3.4 =
* Fieldday Plugin Fixes. 

= 3.3.3 =
* Fieldday Plugin Fixes. 

= 3.3.2 =
* Enable sticky location pop on purchase page.Can be enabled and disabled from fieldday settings. 

= 3.3.1 =
* Event Transfer or Cancel/refund option added in checkin page.

= 3.3.0 =
* Introduced fieldday_event_button shortcode
* Fieldday Sticky Widget Changes

= 3.2.12 =
* Activity Sessions Shortcode Changes 
* Review Widget updates
* UX/UI updates

= 3.2.11 =
* Design Changes Bank Days, Other Design Changes and other security fixes

= 3.2.10 =
* Purchase session issue fixed

= 3.2.9 =
* Activity Session Listing Shortcode
* UX/UI updates

= 3.2.8 =
* Fieldday Sessions Detailed View Elementor Widget
* UX/UI Changes

= 3.2.7 =
*Check-In Counter Tickets and Success Screen Updates


= 3.2.6 =
*Check-In and Ticket Updates

= 3.2.5 =
*Check-In updates

= 3.2.4 =
*Check-In changes

= 3.2.3 =
*Event Listing Changes

= 3.2.2 =
*Participants tab design

= 3.2.1 = 
* Account page changes
* UX/UI improvements


= 3.2.0 = 
* Marketplace integration 
* Filters bug fixes 
* UX/UI Improvements
* Change images style to rectangle

= 3.1.1 = 
* Request a Demo form Changes

= 3.1.0 = 
* Added Request a Demo form

= 3.0.9 = 
* Event Updates

= 3.0.8 = 
* Activity Widget Changes
* Calendar Detailed view added
* Event Ticket updates

= 3.0.7 = 
* Purchase Flow fixes

= 3.0.6 = 
* Purchase Flow fixes
* Wishlist Code

= 3.0.5 = 
* Provider Specific note update

= 3.0.4 = 
* Activity Widget Changes

= 3.0.3 = 
* Activity Widget Changes

= 3.0.2 = 
* Activity Widget Changes
* Session description text format fix

= 3.0.1 = 
* Note for Specific Vendor Events

= 3.0.0 = 
* Available Coupons show in Event Purchase
* Event data changes
* Single Session Detail Popup Button updates
* Party Custom Form

= 2.9.9 =
* Signup Verification Code Fixes

= 2.9.8 = 
* Session Grouping changes
* Login/Signup Flow updated
* Login Signup with Verification Code

= 2.9.7 = 
* Session listing Grouping

= 2.9.6 = 
* Store Credit issues fixed

= 2.9.5 = 
* Purchase flow fixes

= 2.9.4 = 
* Cart Page

= 2.9.3 = 
* Purchase Flow Changes

= 2.9.2 = 
* Available Coupons Added

= 2.9.1 = 
* Partner specific sessions changes

= 2.9.0 = 
* Design and Calender Fixes

= 2.8.9 = 
* Login/SignUp API changes 

= 2.8.8 = 
* Partner specific sessions conditions added

= 2.8.7 = 
* Error fixing for Validate Cart

= 2.8.6 = 
* Error Message design fixed

= 2.8.5 = 
* Validate seats before add session to cart

= 2.8.4 = 
* Design Changes 

= 2.8.3 = 
* Grades Integration 

= 2.8.2 = 
* Logs Updated

= 2.8.1 = 
* Save Card issue for Installment payments Fixed

= 2.8.0 = 
* Cart manage from backend
* Payment Issue Fixes

= 2.7.9 = 
* Cart manage from backend
* Coupon Code Fixes

= 2.7.8 = 
* Cart manage from backend

= 2.7.7 = 
* Purchase Fixes

= 2.7.6 = 
* Cart Fixes

= 2.7.5 = 
* Continue with Guest user if initially choose Guest User.
* Make Known-As field Optional.
* Filters UI fixes
* Implement Slide Filter

= 2.7.4 = 
* Cart design fixes

= 2.7.3 = 
* Purchase Button in Detail Screen

= 2.7.2 = 
* Cart Total Design 
* Added Fee for Camp Sessions in Checkout
* Autocomplete Address Field (Doctor Form)

= 2.7.1 = 
* Bank Day Image issue fixed

= 2.7.0 = 
* Empty Cart when user Logged-in

= 2.6.13 = 
* Contact Form Elementor Widget

= 2.6.12 = 
* Cart issue fixed

= 2.6.11 = 
* One Day Booking Verification 

= 2.6.10 = 
* Contact form Module
* Guest Info Fields and other changes
* UI Changes

= 2.6.9 = 
* Guest Info Fields and other changes

= 2.6.8 =
* Event available tickets changes

= 2.6.7 =
* Event available tickets changes

= 2.6.6 =
* Event Changes

= 2.6.5 =
* Design, Event & Phone field Fixes

= 2.6.4 =
* Check-In & Offset Changes

= 2.6.3 =
* Check-In Changes

= 2.6.2 =
* Check-In Success screen updates

= 2.6.1 = 
* CheckIn Success updated

= 2.6.0 = 
* CheckIn Fixes

= 2.5.20 = 
* CheckIn Changes

= 2.5.19
* Note added for Events

= 2.5.18
* Event Promo Code Functionality & CheckIn success icon updated

= 2.5.17
* Loader Fix

= 2.5.16
* Checkout fixes

= 2.5.15
* Terms & Condition Popup Fixes

= 2.5.14
* Event fixes

= 2.5.13
* Free Event grouping Subline

= 2.5.12
* Event grouping 
* Loading issue fixed

= 2.5.11
* Event grouping revert

= 2.5.10 = 
* Event Grouping

= 2.5.9 = 
* Insurance Tab Fixes

= 2.5.8 = 
* Event More Info Changes

= 2.5.7 = 
* Event Changes

= 2.5.6 = 
* Event Changes

= 2.5.5 = 
* Event Changes

= 2.5.4 = 
* Event Changes

= 2.5.3 = 
* Event Changes

= 2.5.2 = 
* Event Tickets Fixes

= 2.5.1 = 
* Check-In Module Fixes

= 2.5.0 = 
* Check-In Module Fixes

= 2.4.12 = 
* Check-In Module Completed

= 2.4.11 = 
* Check-In Changes

= 2.4.10 = 
* Fields changes

= 2.4.9 = 
* Minor Changes

= 2.4.8 =
* Autocomplete field Fixes

= 2.4.7 = 
* Event fixes

= 2.4.6 =
* Design Fixes

= 2.4.5 =
* Design Fixes

= 2.4.4 = 
* Installment Plans Fixes and Mobile Fixes

= 2.4.3 = 
* Event Price fix

= 2.4.2 = 
* Event module changes and design fixes

= 2.4.1 = 
* Responsive Fixes

= 2.4.0 =
* Design Fixes

= 2.3.20 = 
* Tabs and Design fixes

= 2.3.19 = 
* Session & Event Fixes

= 2.3.18 = 
* Sessions Fixes

= 2.3.17 = 
* Design Fixes

= 2.3.16 = 
* Claim store credit issues

= 2.3.15 = 
* Listing Filter fixes

= 2.3.14 = 
* Listing Offset fixes

= 2.3.13 = 
* Booking Dates fixes

= 2.3.12 =
* Design and Functionaliy fixes 

= 2.3.11 =
* Cart Functionality

= 2.3.9 =
* iPad Design Fixes

= 2.3.8 =
* Age Verification 
* Activity Widget Changes
* Design Fixes

= 2.3.7 =
* Design Fixes

= 2.3.6 =
* Design Fixes

= 2.3.5 =
* Design Fixes

= 2.3.4 =
* Design Fixes for Mobile Screens

= 2.3.3 =
* Design Fixes 

= 2.3.2 =
* Available Dates Selection Bug Fixes 

= 2.3.1 =
* Design Fixes 

= 2.3.0 =
* Event Purchase
* Design and look updates
* Class Packages Purchase