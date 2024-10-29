# Kidmaster

Contributors: upworksanjeev

Tags: fieldday,kidmaster

Requires at least: 5.0

Tested up to: 6.4.1

Requires PHP: 7.2 or Greater


Kidmaster wordpress plugin is a free wordpress plugin

## Description

Kidmaster plugin can be used on wordpress websites to use fieldday API to get sessions, Get user profile with provider

## Installation

1) Download the plugin, unzip it and move the unzipped folder to the “wp-content/plugins” directory in your WordPress installation.
2) In your admin panel, go to Plugins and you’ll find Kidmaster in the plugins section.
3) Click on the ‘Activate’ button to use your new plugin right away.

## Requirments

valid fieldday account. You can get the details from Here https://vendor.fieldday.com/

# available shortcodes

## Session Listing

```
[fieldday_sessions]
```

This shortcode will list the session registered in Ipad application. This shortcode will fetch the session through an API call.

## Login Page

```
[fieldday_login]
```

This shortcode will display a login screen on the page. Where user can use their fieldday acount detail.

## Register page

```
[fieldday_register]
```

This shortcode will display a register screen on the page. Where user can use their information to register a new fieldday account.

## Profile page

```
[fieldday_profile]
```

This shortcode will display a user profile page where user can update parents basic information , kids information and insurance informations etc.

## Checkout page

```
[fieldday_checkout]
```

This shortcode will display a checkout page where user can purchase the items added into cart through stripe payments.

## Developer's Guide

### overwriting views

You can overwrite the view file into your theme. Just create a folder with name ```fieldday``` in theme's root and place the files with the same name and folder structure as in fieldday plugin.

### Plugin Filters

Filter are used to overwrite some outputes through your theme file. fieldday plugin use a couple of filters which can be extends into theme. Below is the list of filters you can use.

```
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
km_merchandise_thankyou_title
km_merchandise_thankyou_message
km_merchandise_checkout_return_text
km_merchandise_checkout_return_url
```

## Changelog

### version 2.0.0

	kidcircle is now fieldday

### version 1.3.2
	
	Fixed the date time issue in featured session

### version 1.3.1
	
	added elementor widget for Featured sessions
	
	added session list filters 
	
	added option to disable sibling discount popup in admin
	
	purchase flow bug fixes

### version 1.3.0

	Integrated partial credit system
	
	google invalid client fixes
	
	Other bug fixes 

### version 1.2.2
	
	new filters layout on sessions page 
	
### version 1.2.1

	Added tax details in My account
	
	added credit statement and store credit tabs in my account

### version 1.2.0

	Bug fixes in social login functions
	
### version 1.1.15

	redirect to add to cart screen on social login
	
	backend options to add the redirect url
	
	age limit validations in purchase flow
	
	kid form modal modifications for additional specs

### version 1.1.14

	responsive issue and active day color change
	
### version 1.1.13

	Fixed session days in session list
	
### version 1.1.12

	Added session days in session list
	
### version 1.1.11

	Select dropdown issue in school dropdown in cart screen resolved
	
### version 1.1.10

	Design modifications in radio and checkboxes
	
	kids saving for logged in user will also work on cart addition
	
	
### version 1.1.9

	Added select2 library for searching in school
	
	fixed design issues on IE

### version 1.1.8

	design bugs removed

### version 1.1.7

	dob validations added
	
	design bugs
	
### version 1.1.6

	removed Datepicker. DOB will be select with the dropdowns
	
	removed filter apply_sibling_discount. need to manage this on fieldday now
	
### version 1.1.5

	Disign fixes
	
	Phone input flag selected on user login
	
### version 1.1.4

	validation added on login page
	
	debug mode availablein admin options now
	
	
### version 1.1.3

	Validatiopn added for kid DOB
	
### version 1.1.2

	bug fixed
	
	added the filter fieldday_debug_mode to enable debug mode.

### version 1.1.1

	added the default authPickup detail in purchase confirmation
	
	added the index.html file to hide plugin files through browser
	
	Flags issue in phone field resolved

### version 1.1.0

	User default picture replaced with Name initials
	
	terms and conditions with one single checkbox
	
	confliction resolved with the fieldday theme
	
	added following filters for merchandise purchase success screen
	
	`km_merchandise_thankyou_title` `km_merchandise_thankyou_message` `km_merchandise_checkout_return_text` `km_merchandise_checkout_return_url`
	
	resolved admin login issue 
	
	resolved fieldday login issue for deleted accounts

### version 1.0.8

	bug fixes
	
### version 1.0.7

	design issues fixed
	
	confliction with fieldday theme resolved in design

### version 1.0.6

	bug fixes in verification email otp
	

### version 1.0.5

	added account verification through email OTP

### version 1.0.4

	added login html on ajax login
	
	filter added `fieldday_after_login` add the script to run just after login
	
	User dummy image changed
	
	user kids save bug fixed
	

### version 1.0.3

	fixed bugs in IE 11 and design issues
	
	gender radio button fixed
	
	removed insurance available options
	
	added extra purchase type for weekly and oneday only sessions
	
	

### version 1.0.2

fixed bugs and error in IE 11

### version 1.0.1

added cart success screen

### version 1.0.0 

initial Kidmaster plugin version