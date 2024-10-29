<?php

/*
 * fieldday Actions
 * @package fieldday
 * @since   1.0.0
 */

class fielddayActions
{

    /**
     * fielddayActions Constructor.
     */
    public function __construct()
    {
        foreach ($this->AjaxActions() as $key => $action) {
            add_action("wp_ajax_{$action['name']}", [$this, $action['callback']]);
            add_action("wp_ajax_nopriv_{$action['name']}", [$this, $action['callback']]);
        }
        add_action('init', [$this, 'fielddayActionsInit']);
        add_action('template_redirect', [$this, 'KmLoginRedirect']);
    }

    /*
     * fieldday ajax handlers
     *
     * @return Array
     */

    private function AjaxActions()
    {
        return [
            ['name' => 'km_filtersession', 'callback' => 'FilterSessions'],
            ['name' => 'km_LocationPopUpformVisibility', 'callback' => 'km_LocationPopUpformVisibility'],
            ['name' => 'km_kidsinfo', 'callback' => 'GetKidsInformation'],
            ['name' => 'km_login', 'callback' => 'LoginProcess'],
            ['name' => 'km_login_new', 'callback' => 'LoginProcessNew'],
            ['name' => 'km_register', 'callback' => 'RegisterProcess'],
            ['name' => 'km_register_new', 'callback' => 'RegisterProcessNew'],
            ['name' => 'km_verify_otp', 'callback' => 'VerifyOTP'],
            ['name' => 'km_login_verify_otp', 'callback' => 'LoginVerifyOTP'],
            ['name' => 'km_resend_otp', 'callback' => 'ResendOtp'],
            ['name' => 'km_loginresend_otp', 'callback' => 'LoginResendOtp'],
            ['name' => 'km_update_phone', 'callback' => 'UpdatePhone'],
            ['name' => 'km_social_login', 'callback' => 'SocialLogin'],
            ['name' => 'km_display_auth', 'callback' => 'DisplayAuthForm'],
            ['name' => 'km_display_login', 'callback' => 'DisplayLoginForm'],
            ['name' => 'km_display_register', 'callback' => 'DisplayRegisterForm'],
            ['name' => 'km_get_kid_form', 'callback' => 'GetKidsForm'],
            ['name' => 'km_updateCart', 'callback' => 'UpdateCartInformation'],
            ['name' => 'km_Apply_CouponCart', 'callback' => 'ApplyCouponCart'],
            ['name' => 'get_school_info', 'callback' => 'getSchoolInfo'],
            ['name' => 'km_display_cartform', 'callback' => 'AddToCartForm'],
            ['name' => 'km_display_eventcartform', 'callback' => 'EventAddToCartForm'],
            ['name' => 'km_display_packageform', 'callback' => 'PackagePurchaseForm'],
            ['name' => 'km_display_plans', 'callback' => 'DisplayPlansPopup'],
            ['name' => 'km_edit_cart_item', 'callback' => 'EditCartForm'],
            ['name' => 'km_atc_partcipants', 'callback' => 'getAtcParticipants'],
            ['name' => 'km_multiweek_calculations', 'callback' => 'MultiweekCalculations'],
            ['name' => 'km_apply_sibling_discount', 'callback' => 'SiblingDiscountAPI'],
            //['name' => 'km_get_otheroptions', 'callback' => 'atcSessionExtendedCare'],
            //['name' => 'km_prepare_cart', 'callback' => 'PrepareCart'],
            ['name' => 'km_set_cartitems', 'callback' => 'APIsaveCartItem'],
            ['name' => 'km_set_waitlistitems', 'callback' => 'APIsaveWaitListItem'],
            ['name' => 'km_update_cartitems', 'callback' => 'APIupdateCartItem'],
            ['name' => 'get_cart_data', 'callback' => 'getCartHtml'],
            //['name' => 'remove_sessioncart_items', 'callback' => 'removeSessioncartItems'],
            ['name' => 'km_remove_cart_item', 'callback' => 'removeCartItem'],
            ['name' => 'km_check_store_credit', 'callback' => 'checkStoreCredit'],
            ['name' => 'km_purchase', 'callback' => 'fielddaySessionPurchase'],
            ['name' => 'km_update_profile', 'callback' => 'UpdateProfile'],
            ['name' => 'km_profile_tab', 'callback' => 'profileTab'],
            ['name' => 'km_update_password', 'callback' => 'updatePassword'],
            ['name' => 'km_get_purchase', 'callback' => 'GetAjaxPurchase'],
            ['name' => 'km_get_bankdays', 'callback' => 'fielddayBankDays'],
            ['name' => 'km_get_giftcards', 'callback' => 'fielddayGiftCards'],
            ['name' => 'km_get_days', 'callback' => 'fielddayDaysFilter'],
            ['name' => 'km_merchandise_form', 'callback' => 'merchandiseForm'],
            ['name' => 'km_merchandise_process', 'callback' => 'merchandiseProcess'],
            ['name' => 'km_add_new_kid', 'callback' => 'AddkidModal'],
            ['name' => 'km_save_kid', 'callback' => 'SaveNewKid'],
            ['name' => 'km_update_kid_profile', 'callback' => 'UpdateKid'],
            ['name' => 'km_update_insurance', 'callback' => 'updateInsurance'],
            ['name' => 'km_delete_kid', 'callback' => 'deleteKid'],
            ['name' => 'km_save_kidforms', 'callback' => 'saveKidForms'],
            ['name' => 'km_forget_popup', 'callback' => 'forgetModal'],
            ['name' => 'km_reset_password', 'callback' => 'ResetPassword'],
            ['name' => 'km_getmenu_data', 'callback' => 'getMenuData'],
            ['name' => 'km_getprovider_terms', 'callback' => 'displayProviderTerms'],
            ['name' => 'km_parent_info', 'callback' => 'processParentInfo'],
            ['name' => 'km_process_stripe', 'callback' => 'processStripe'],
            ['name' => 'km_display_claim_form', 'callback' => 'displayClaimForm'],
            ['name' => 'km_claimcredit', 'callback' => 'claimCredit'],
            ['name' => 'km_session_detail', 'callback' => 'singleSessionDetail'],
            ['name' => 'km_session_booking_options', "callback" => "sessionBookingOptions"],
            ['name' => 'km_submit_donation', "callback" => "submitDonation"],
            ['name' => 'km_calenderevents', "callback" => "calenderevents"],
            ['name' => 'km_registerSessionTiming', "callback" => "registerSessionTiming"],
            ['name' => 'km_set_membershipcartitems', "callback" => "savemebershipCartitmes"],
            ['name' => 'km_set_membershipurchase', "callback" => "membershipPurchase"],
            ['name' => 'km_set_packagepurchase', "callback" => "packagePurchase"],
            ['name' => 'km_set_eventpurchase', "callback" => "EventPurchase"],
            ['name' => 'km_multiweekpurchase', "callback" => "MultiweekPurchase"],
            ['name' => 'km_self_checkin', "callback" => "SelfCheckIn"],
            ['name' => 'km_contact_form', "callback" => "ContactForm"],
            ['name' => 'refundFormEventSession', "callback" => "refundFormEventSession"],
            ['name' => 'km_requestdemo_form', "callback" => "RequestDemoForm"],
            ['name' => 'km_party_form', "callback" => "PartyForm"],
            ['name' => 'km_sticky_widget', "callback" => "StickyWidget"],
            ['name' => 'km_pullticket', "callback" => "PullTicket"],
            ['name' => 'km_get_class_packages_options', "callback" => "packageOptions"],
            ['name' => 'km_get_events_price', "callback" => "eventPrices"],
            ['name' => 'km_get_sessions_extradata', "callback" => "sessions_extradata"],
            ['name' => 'km_class_package_info', "callback" => "ClasspackageInfo"],
            ['name' => 'km_set_giftCardmodel', "callback" => "giftCardmodel"],
            ['name' => 'km_set_giftcardPurchase', "callback" => "giftCardPurchase"],
            ['name' => 'km_set_singlegiftcard', "callback" => "singleGiftcard"],
            ['name' => 'km_set_checkoutpayments', "callback" => "checkoutpaymentInstallments"],
            ['name' => 'km_delete_saved_card', 'callback' => 'deleteSavedCard'],
            ['name' => 'km_card_form', 'callback' => 'getCardForm'],
            ['name' => 'km_save_card', 'callback' => 'saveCard'],
            ['name' => 'km_setdefault_card', 'callback' => 'setDefaultCard'],
            ['name' => 'km_getactivity_sessions', 'callback' => 'getactivitySessions'],
        ];
    }

    public function getactivitySessions()
    {
        $filters = [];
        $activity_id = filter_input(INPUT_POST, 'activity_id', FILTER_SANITIZE_STRING);
        if ($activity_id && $activity_id != 'all') {
            $filters['filters']['activityId'] = $activity_id;
        }
        $data = '';
        if ($activity_id) {
            $content .= '<option selected="selected" value="all">all</option>';
            $ProviderSessions = fieldday()->api->GetProviderSessionsNew($filters);
            $sessions_data = $this->getSessionsList($ProviderSessions);
            foreach ($sessions_data as $key => $session) {
                $content .= '<option value=' . $key . '>' . $session . '</option>';
            }

        }
        wp_send_json(['status' => 'success', 'content' => $content]);
    }
    private function getSessionsList($sessions, $key = false)
    {
        $activitys = $sessions->data->sessions;
        $searchactivitys = [];
        foreach ($activitys as $singleactivitys => $singleactivity) {
            //foreach ($singlesessions->sessions as $singleactivitys => $singleactivity) { //echo $singleactivity->activityId->_id;
                $searchactivitys[$singleactivity->_id] = wp_sprintf('%s', $singleactivity->name);
            //}
        }
        return $searchactivitys;
    }
    /**
     * get partcipants for add to cart form
     *
     * @return JSON participant html with json response
     */
    public function getAtcParticipants()
    {
        $cartKey = filter_input(INPUT_POST, 'cartkey', FILTER_SANITIZE_STRING);
        $sessionID = filter_input(INPUT_POST, 'sessionID', FILTER_SANITIZE_STRING);
        if ($cartKey) {
            $cartItem = fieldday()->engine->getCartItem($cartKey);
        } else {
            $cartItem = [];
        }
        $singlesessionInfo = fieldday()->api->getActivitySessionDetail($sessionID);
        $content = fieldday()->engine->fielddayCartParticipants($cartItem, $singlesessionInfo->data);

        wp_send_json(['status' => 'success', 'content' => $content]);
    }

    /**
     * Saves a new kid form.
     * @param array $postdata
     * @return json success and html
     */
    public function SaveNewKid()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);

        unset($postdata['action'], $postdata['permalink'], $postdata['_wpnonce']);
        if (array_key_exists('ATC', $postdata)) {
            unset($postdata['ATC']);
            unset($postdata['kidscount']);
            unset($postdata['cartItemKey']);
        }
        if (!fieldday()->engine->getValue('school', $postdata, false)) {
            unset($postdata['school']);
        }
        if (!fieldday()->engine->getValue('gender', $postdata, false)) {
            unset($postdata['gender']);
        }
        if (!fieldday()->engine->getValue('knownAs', $postdata, false)) {
            $postdata['knownAs'] = $postdata['firstName'];
        }
        if ($_FILES["ParentPicUpload"]['tmp_name'] != '') {
            $postdata['file'] = [
                "path" => $_FILES['ParentPicUpload']['tmp_name'],
                "type" => $_FILES['ParentPicUpload']['type'],
                "name" => 'file',
            ];
        }
        $addkid = fieldday()->api->AddKid($postdata);
        if ($addkid->statusCode == 201) {
            $html = fieldday()->engine->getView('account/_kidsinfo', ['kid' => $addkid->data, 'permalink' => $permalink]);
            $response = ['status' => 'success', 'message' => __($addkid->message, 'fieldday'), 'html' => $html];
        } else {
            $response = ['status' => 'fail', 'message' => $addkid->message, 'log' => $addkid];
        }
        wp_send_json($response);
    }

    /**
     * Modal view for add new kid
     * @return Json json respose
     */
    public function AddkidModal()
    {
        $ATCdata = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $sessionId = fieldday()->engine->getValue('session_id', $ATCdata, false);
        $sessionDetail = fieldday()->api->getActivitySession($sessionId);

        $school = fieldday()->api->getProviderSchools();
        //$content = fieldday()->engine->getView('account/addkidform', ['school' => $school]);
        $content = fieldday()->engine->getView('account/addnewparticipant', ['school' => $school, 'sessionInfo' => $sessionDetail->data]);
        //$header = wp_sprintf('<h4>%s</h4>', __('ADD KID INFORMATION', 'fieldday'));
        //$footer = wp_sprintf("<button class='km_btn km_add_kid_cancel km_secondary_bg' onclick='fieldday.closepopup(this);'>%s</button>", __('Cancel', 'fieldday'));
        //$footer .= wp_sprintf("<button class='km_btn km_add_kid_save km_primary_bg'>%s</button>", __('Save', 'fieldday'));
        // wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => $footer]);
        wp_send_json(['status' => 'success', 'content' => $content, 'price' => $price]);
    }

    /**
     * Modal view for Forget password
     * @return Json json respose
     */
    public function forgetModal()
    {

        $header = __('Reset Password', 'fieldday');
        $content = fieldday()->engine->getView('forget_password');
        wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content]);
    }

    /**
     * Reset password.
     * @return Json json respose
     */
    public function ResetPassword()
    {
        global $fielddaySetting;
        $email = filter_input(INPUT_POST, 'km_user_email', FILTER_SANITIZE_STRING);
        $redirect = site_url('/');
        $vendor = array_key_exists('siteName', $fielddaySetting) ? $fielddaySetting['siteName'] : null;
        $resetPassword = fieldday()->api->getResetPasswordToken($email, $redirect, $vendor);
        if ($resetPassword->statusCode == 200) {
            $response = ['status' => 'success', 'message' => $resetPassword->message];
        } else {
            $response = ['status' => 'fail', 'message' => $resetPassword->message, 'log' => $resetPassword];
        }

        wp_send_json($response);
    }

    /**
     * Update parent password
     * @return Json json response
     */
    public function updatePassword()
    {
        $current_password = filter_input(INPUT_POST, 'current-password', FILTER_SANITIZE_STRING);
        $new_password = filter_input(INPUT_POST, 'new-password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm-new-password', FILTER_SANITIZE_STRING);
        if ($new_password == $confirm_password) {
            $updatePassword = fieldday()->api->wp_change_password(['password' => $current_password, 'newPassword' => $new_password]);
            if ($updatePassword->statusCode == 200) {
                $response = ['status' => 'success', 'message' => __('Password Updated', 'fieldday')];
            } else {
                $response = ['status' => 'fail', 'message' => $updatePassword->message, 'log' => $updatePassword];
            }
        } else {
            $response = ['status' => 'fail', 'message' => __('Password and confirm password not matching', 'fieldday')];
        }
        wp_send_json($response);
    }

    /**
     * Change html according to tab
     *
     * @return string html
     */
    public function profileTab()
    {

        $pagename = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);
        $page = 'account/' . $pagename;
        switch ($pagename) {
            case 'purchase':
                $purchase = fieldday()->api->GetactivityRegistrations(['page' => 0, 'count' => 10]);
                if ($purchase->statusCode == 200) {
                    $content = fieldday()->engine->getView($page, ['purchases' => $purchase->data, 'purchase' => $purchase]);
                    $response = ['status' => 'success', 'content' => $content];
                } else {
                    $response = ['status' => 'fail', 'message' => $purchase->message];
                }
                break;
            case 'kid_generalInfo':
                $kidId = filter_input(INPUT_POST, 'dataId', FILTER_SANITIZE_STRING);
                $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
                $kidData = fieldday()->api->GetKidDetail($kidId);
                if ($kidData->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
                } else {
                    $content = fieldday()->engine->getView($page, ['profile' => $kidData->data->kidProfile, 'permalink' => $permalink]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'kid_doctors':
                $kidId = filter_input(INPUT_POST, 'dataId', FILTER_SANITIZE_STRING);
                $kidData = fieldday()->api->GetKidDetail($kidId);
                if ($kidData->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
                } else {
                    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'doctor_info' => $kidData->data->doctors]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'kid_allergies':
                $kidId = filter_input(INPUT_POST, 'dataId', FILTER_SANITIZE_STRING);
                $kidData = fieldday()->api->GetKidDetail($kidId);
                if ($kidData->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
                } else {
                    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'kid_environment_allergies' => $kidData->data->environmentAllergies, 'kid_food_allergies' => $kidData->data->foodAllergies, 'kid_dietRestricts' => $kidData->data->dietRestricts, 'kid_medication_allregies' => $kidData->data->medicationAllergies]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;

            case 'kid_medical':
                $kidId = filter_input(INPUT_POST, 'dataId', FILTER_SANITIZE_STRING);
                $kidData = fieldday()->api->GetKidDetail($kidId);
                if ($kidData->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
                } else {
                    //print_r($kidData);
                    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'kid_heathConcerns' => $kidData->data->healthConcerns, 'kid_treatments' => $kidData->data->treatments, 'kid_symptoms' => $kidData->data->symptoms]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'store_credit':
                $storeCredit = fieldday()->api->userCreditSummary();
                if ($storeCredit->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $storeCredit->message);
                } else {
                    //print_r($kidData);
                    $content = fieldday()->engine->getView($page, ['storeCredits' => $storeCredit->data]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'store_statement':
                $isPerDayCredit = filter_input(INPUT_POST, 'isPerdayCredit', FILTER_SANITIZE_STRING);
                if (!$isPerDayCredit) {
                    $isPerDayCredit = "true";
                }
                $storeCredit = fieldday()->api->userStoreCreditStatements(['isPerDayCredit' => $isPerDayCredit]);

                if ($storeCredit->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $storeCredit->message);
                } else {
                    //print_r($kidData);
                    $content = fieldday()->engine->getView($page, ['creditStatements' => $storeCredit->data]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'tax_detail':
                $taxDetails = fieldday()->api->getTaxDetails();
                if ($taxDetails->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $taxDetails->message);
                } else {
                    //print_r($kidData);
                    $content = fieldday()->engine->getView($page, ['taxDetails' => $taxDetails->data]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;
            case 'saved_cards':
                $savedCards = fieldday()->api->getSavedCards();
                if ($savedCards->statusCode !== 200) {
                    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $savedCards->message);
                } else {
                    //print_r($kidData);
                    $content = fieldday()->engine->getView($page, ['savedCards' => $savedCards->data]);
                }

                $response = ['status' => 'success', 'content' => $content];
                break;

            default:
                $content = fieldday()->engine->getView($page);
                $response = ['status' => 'success', 'content' => $content];
                break;
        }

        wp_send_json($response);
    }

    /**
     * Gets the ajax purchase.
     *
     * @return string html
     */
    public function GetAjaxPurchase()
    {
        global $fielddaySetting;

        $providerKey = array_key_exists('fieldday_api_provider', $fielddaySetting) ? $fielddaySetting['fieldday_api_provider'] : null;
        $pagenumber = filter_input(INPUT_POST, 'pagenumber', FILTER_SANITIZE_STRING);
        $purchase = fieldday()->api->GetactivityRegistrations(['providerId' => $providerKey, 'page' => $pagenumber, 'count' => 10]);
        if ($purchase->statusCode == 200) {
            $page = 'account/purchase';
            $content = fieldday()->engine->getView($page, ['purchases' => $purchase->data, 'purchase' => $purchase]);
            $response = ['status' => 'success', 'content' => $content];
        } else {
            $response = ['status' => 'fail', 'message' => $purchase->message];
        }
        wp_send_json($response);
    }

    /**
     * update parents details
     * @return json response
     */
    public function UpdateProfile()
    {
        global $KmUser;
        $userId = isset($KmUser->accessToken) ? $KmUser->_id : null;
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
        $maritalStatus = filter_input(INPUT_POST, 'maritalStatus', FILTER_SANITIZE_STRING);
        if ($_FILES["ParentPicUpload"]['tmp_name'] != '') {
            $PayloadData = [
                'name' => $name,
                'gender' => $gender,
                'maritalStatus' => $maritalStatus,
            ];
            $PayloadData['file'] = [
                "path" => $_FILES['ParentPicUpload']['tmp_name'],
                "type" => $_FILES['ParentPicUpload']['type'],
                "name" => 'profilePic',
            ];
            $update = fieldday()->api->UpdateUser($userId, $PayloadData);
        } else {
            $update = fieldday()->api->UpdateUser($userId, ['name' => $name, 'gender' => $gender, 'maritalStatus' => $maritalStatus]);
        }

        if ($update->statusCode == 200) {
            $response = ['status' => 'success', 'message' => __('Update successfully', 'fieldday')];
        } else {
            $response = ['status' => 'fail', 'message' => $update->message, 'log' => $update];
        }

        wp_send_json($response);
    }

    /*
     * Filter sessions with Tagtype
     *
     * @param String POST[tagId]
     */

    public function FilterSessions()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $queryParams = [];
        if ($postdata && $postdata['isMarketplaceList'] == "true") {
            $queryParams['isMarketplaceList'] = 'true';
        }
        if ($postdata) {
            $multiweek = '';
            $multiweek = fieldday()->engine->getValue('multiweek', $postdata, false);
            $layout = fieldday()->engine->getValue('layout', $postdata, false);
            $tagId = fieldday()->engine->getValue('tagId', $postdata, false);
            $tabId = fieldday()->engine->getValue('tabId', $postdata, false);
            $filters = fieldday()->engine->getValue('filters', $postdata, false);

            /* unset if value is all */
            foreach ($filters as $key => $filter) {
                if ($filter == 'all' || trim($filter) == '') {
                    unset($filters[$key]);
                }
                if ($key == 'activityId' && $filter == 'all') {
                    $queryParams['showAllSessions'] = 'true';
                }
            }

            $queryParams['showAllSessions'] = 'true';
            if ($layout == 'two_column_layout') {
                if ($tagId) {
                    $queryParams['tagId'] = $tagId;
                }
                if ($filters) {
                    $queryParams['filters'] = $filters;
                }
                $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
                $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);

                if ($sessions->statusCode === 200 || $sessions->status == 'success') {
                    $content = "";
                    $content .= fieldday()->engine->getView('layout/_sessionlist_part', ['sessions' => $sessions, 'permalink' => $permalink, 'filters' => $queryParams, 'tagId' => $tagId, 'multiweek' => $multiweek]);

                    $locations = fieldday()->engine->getSessionLocations($sessions);
                    $response = ['status' => 'success', 'content' => $content, 'locations' => $locations, '$sessions' => $sessions];
                } else {
                    $response = ['status' => 'fail', 'message' => __($sessions->message, 'fieldday')];
                }
            } else {

                if ($tagId) {
                    $queryParams['tagId'] = $tagId;
                }
                global $fielddaySetting;
                if (!array_key_exists('offset', $queryParams)) {
                    $queryParams['offset'] = $fielddaySetting['offset'];
                }

                if (array_key_exists('fromDate', $queryParams) &&
                    array_key_exists('toDate', $queryParams)) {

                    $datefilter = array("fromDate" => $filters['fromDate'],
                        "toDate" => $filters['toDate'],
                    );
                    $datefilterjson = json_encode($datefilter);
                    $queryParams['filters'] = $datefilterjson;
                }

                if ($filters) {
                    $queryParams['filters'] = $filters;
                }
                //print_r($queryParams);
                $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
                $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);
                if ($sessions->statusCode === 200 || $sessions->status == 'success') {
                    $content = "";

                    $content .= fieldday()->engine->getView('_sessionlist_part', ['sessions' => $sessions, 'permalink' => $permalink, 'filters' => $queryParams, 'tagId' => $tagId, 'multiweek' => $multiweek]);
                    $response = ['status' => 'success', 'content' => $content, '$sessions' => $sessions];
                } else {
                    $response = ['status' => 'fail', 'message' => __($sessions->message, 'fieldday')];
                }
            }
        } else {
            $response = ['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')];
        }

        wp_send_json($response);
    }

    public function km_LocationPopUpformVisibility()
    {
        global $fielddaySetting;
        $isenabledStickyLocation = fieldday()->engine->getValue('fieldday_sticky_location_widget', $fielddaySetting, false);
        $locationsResponse = fieldday()->api->getProviderLocations();
        $locations_html = '';
        $content = '';
        if ($isenabledStickyLocation && $locationsResponse->statusCode == 200) {
            if (is_array($locationsResponse->data)) {$count_locations_html = count($locationsResponse->data);} else { $count_locations_html = 0;}
            $count_locations_html;
            foreach ($locationsResponse->data as $key => $locationdata) {
                $locations[$locationdata->_id] = $locationdata->name;
                $locations_html .= '
                <div class="km_locationpopup_location_div">
                        <div class="km_locationpopup_location_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                                <path d="M13 7.13636C13 11.9091 7 16 7 16C7 16 1 11.9091 1 7.13636C1 5.5089 1.63214 3.94809 2.75736 2.7973C3.88258 1.64651 5.4087 1 7 1C8.5913 1 10.1174 1.64651 11.2426 2.7973C12.3679 3.94809 13 5.5089 13 7.13636Z" stroke="#A40000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.99997 9.18181C8.10454 9.18181 8.99997 8.26603 8.99997 7.13636C8.99997 6.00669 8.10454 5.0909 6.99997 5.0909C5.8954 5.0909 4.99997 6.00669 4.99997 7.13636C4.99997 8.26603 5.8954 9.18181 6.99997 9.18181Z" stroke="#A40000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </div>
                        <div class="km_locationpopup_locaton_content">
                            <h5>' . $locationdata->name . '</h5>
                            <p>' . $locationdata->street . ', ' . $locationdata->city . '</p>
                            <p>' . $locationdata->state . ', ' . $locationdata->country . '</p>
                            <button onclick="fieldday.SetLocationPopUpformVisibility(\'' . $locationdata->_id . '\');" class="km_btn km_primary_bg">Book Now</button>
                        </div>
                </div>';
            }
            //show pop up only if counts of locations is greatar than 2
            if (is_array($locationsResponse->data) && count($locationsResponse->data) >= 2) {
                $content .= '<div class="km_locationpopup_pc_overlay"></div><div class="km_locationpopup_pc">
                <p class="km_locationpopup_find_h2">Location Preference</p>
                <p class="km_locationpopup_find_h6">Choose your preferred location, or select \'All Locations\' to explore all activities. You can always change the location using the dropdown option in filters.</p>
                <button  onclick="fieldday.SetLocationPopUpformVisibility(\'all\');"  class="km_locationpopup_location_but km_btn km_primary_bg">All Locations</button>
               <h6>' . $count_locations_html . ' Locations Available</h6>' . $locations_html . '</div>';
            }
        }
        $response = ['status' => 'success', 'content' => $content];
        wp_send_json($response);
    }

    public function fielddayBankDays()
    {
        $bankDays = fieldday()->api->getShoppingPackages();
        $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
        $theme_mode_active_ul_wrapper = fieldday()->engine->getValue('fieldday_theme_mode', $fielddaySetting, false);

        if (fieldday()->engine->getValue('data', $_POST, false) != 'two_column_layout') {
            if ($bankDays->statusCode === 200) {
                $content = "";
                $count = 0;
                if ($bankDays->data) {
                    foreach ($bankDays->data as $bankDayDetail) {if ($count == 0) {
                        $content .= '<div class="filters_info_record" style=""></div>';
                    }
                        $content .= '<section class="program-wrap"><ul class="km_sessions_list km_list km_grid ' . $theme_mode_active_ul_wrapper . '">';
                        $content .= fieldday()->engine->getView('_bankday', ['DayDetail' => $bankDayDetail, 'permalink' => $permalink]);
                        $content .= "</ul></section>";
                        $count++;}
                } else {
                    $content .= wp_sprintf("<div class='km_nodata'>%s</div>", __("No bank day found for this provider."));
                }
                wp_send_json(['status' => 'success', 'content' => $content]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($bankDays->message, 'fieldday')]);
            }
        } else {
            if ($bankDays->statusCode === 200) {
                $content = "";
                if ($bankDays->data) {
                    $content .= '<div class="filters_info_record" style=""></div><ul class="km_sessions_list km_list ' . $theme_mode_active_ul_wrapper . '" id="km_sessions_list_two_column_layout_km_merchandise">';
                    foreach ($bankDays->data as $bankDayDetail) {

                        $content .= fieldday()->engine->getView('_bankday', ['DayDetail' => $bankDayDetail, 'permalink' => $permalink]);
                    }
                    $content .= "</ul>";
                } else {
                    $content .= wp_sprintf("<div class='km_nodata'>%s</div>", __("No bank day found for this provider."));
                }
                wp_send_json(['status' => 'success', 'content' => $content]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($bankDays->message, 'fieldday')]);
            }
        }
    }

    public function fielddayGiftCards()
    {
        $giftOptions = fieldday()->api->getProviderGiftCards();
        $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
        $theme_mode_active_ul_wrapper = fieldday()->engine->getValue('fieldday_theme_mode', $fielddaySetting, false);
        if ($giftOptions->statusCode === 200) {$content = "";
            if ($giftOptions->data) {
                $content .= '<div class="filters_info_record" style=""></div><section class="program-wrap"><ul class="km_sessions_list km_list km_grid ' . $theme_mode_active_ul_wrapper . '" id="km_sessions_list_two_column_layout">';
                foreach ($giftOptions->data as $giftOption) {

                    $content .= fieldday()->engine->getView('_giftcards', ['gifts' => $giftOption, 'permalink' => $permalink]);

                }
                $content .= "</ul></section";
                $response = ['status' => 'success', 'content' => $content];
            }} else {
            $response = ['status' => 'fail', 'message' => __($giftOptions->message, 'fieldday')];
        }
        wp_send_json($response);
    }

    public function fielddayDaysFilter()
    {

        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $tagId = fieldday()->engine->getValue('tagId', $postdata, false);
        $date = fieldday()->engine->getValue('date', $postdata, false);
        $queryParams = [];
        if ($tagId) {
            $queryParams['tagId'] = $tagId;
        }

        $permalink = filter_input(INPUT_GET, 'permalink', FILTER_SANITIZE_STRING);
        $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);
        if ($sessions->statusCode === 200) {
            $content = "";
            $content .= fieldday()->engine->getView('_sessionlist_part', ['sessions' => $sessions, 'permalink' => $permalink, 'filters' => $queryParams, 'tagId' => $tagId, 'tagdate' => $date]);
            $response = ['status' => 'success', 'content' => $content];
        } else {
            $response = ['status' => 'fail', 'message' => __($sessions->message, 'fieldday')];
        }
        wp_send_json($response);
        exit;
    }

    /**
     * display kids information in popup
     *
     * @return JSON kids data
     */
    /* public function GetKidsInformation() {
    $kidscount = filter_input(INPUT_POST, 'kidscount', FILTER_SANITIZE_STRING);
    if ($kidscount) {
    // get the parent kids
    if(fieldday()->engine->isKmLogin()) {
    $kidsresponse = fieldday()->api->GetKids();
    if ($kidsresponse->statusCode === 200) {
    $kids = $kidsresponse->data;
    }else {
    $kids = fieldday()->engine->getCookieStorage('km_saved_kids');
    }
    }else {
    $kids = fieldday()->engine->getCookieStorage('km_saved_kids');
    }

    if ($kids) {
    ob_start();
    echo "<div class='kids-pop-listing'><form class='km_kidselection_form' id='km_kidselection_form'>";
    echo apply_filters('fieldday_atc_before_kidlist', $this->kidsListHelptext($kidscount), $kidscount);
    foreach ($kids as $kid) {
    ?>
    <ul class="kid-pop-single km_col_6">
    <li class="kid_pop_select km_col_2">
    <label class="km_checkbox_wrap">
    <input type="checkbox" class="selected_kid"  name="selected_kid[]" value="<?php echo $kid->_id; ?>">
    <span class="km_checkbox"></span>
    </label>
    </li>
    <li class="kid_pop_dp km_col_4">
    <div class="km_kid_pic_wrapper">
    <?php print fieldday()->engine->getfielddayKidDP($kid); ?>
    </div>
    </li>
    <li class="kid_pop_meta km_col_6">
    <span class="kid_name"><?php fieldday()->engine->getValue('firstName', $kid); ?> <?php fieldday()->engine->getValue('lastName', $kid); ?></span>
    <span class="kid_gender"><?php fieldday()->engine->getValue('gender', $kid); ?></span>
    <span class="kid_school"><?php //echo $kid->school->name;     ?></span>
    </li>
    </ul>
    <?php
    }
    echo "</form></div>";
    $contents = ob_get_contents();
    ob_end_clean();
    $response = ['status' => 'success', 'content' => $contents];
    //parent kids
    }else {
    $response = ['status' => 'nokids', 'content' => wp_sprintf("<div class='km_nodata'>%s</div>", fieldday()->engine->displayText('km_no_kid_found', false))];
    }
    } else {
    $response = ['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')];
    }

    wp_send_json($response);
    }
     */

    /**
     * get text for kidselection info in add to cart form
     *
     * @param Int $seatCount seats count for booking
     *
     * @return HTML html string for help text
     */
    public function kidsListHelptext($seatCount)
    {
        $kidtext = apply_filters('fieldday_kid_text', __('Participant'));
        $text1 = __('Select (' . $seatCount . ') ' . $kidtext . '(s) for this session. To Add New, Click next without making a selection.', 'fieldday');
        $text2 = __('If you don’t select ' . $kidtext . ' and click Next, then you will be adding new ' . $kidtext . ' information.', 'fieldday');
        $output = "";
        $output .= wp_sprintf('<p class="km_before_kidlist_note"><strong>%s</strong></p>', $text1);
        $output .= wp_sprintf('<p class="km_before_kidlist_note" style="padding-top: 5px;"><strong>Note:</strong> %s</p>', $text2);

        return $output;
    }

    public function EditCartForm()
    {
        $cartkey = filter_input(INPUT_POST, 'cartkey', FILTER_SANITIZE_STRING);
        if ($cartkey) {
            $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
            $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
            $singlecartitem = fieldday()->api->GetSingleCartItemApi($cartkey, $GcartId, $GparentId);
            //print_r($singlecartitem->data);
            if ($singlecartitem->statusCode === 200) {
                $singlesessionInfo = fieldday()->api->getActivitySessionDetail($singlecartitem->data->sessionId->_id);

                $cartForm = fieldday()->engine->getView('cart/edit_cart', ['session' => $singlesessionInfo->data, 'cartItem' => $singlecartitem->data, 'cartkey' => $cartkey, 'singlesessionInfo' => $singlesessionInfo->data, 'datamode' => 'edit']);

                $footer = wp_sprintf('<a href="" class="km_update_cart km_btn km_btn_green km_primary_bg">%s</a>', __('Update Cart', 'fieldday'));
                wp_send_json(['status' => 'success', 'content' => $cartForm, 'footer' => $footer, 'header' => $singlecartitem->data->sessionId->name, 'session' => $sessionDetail->data]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __("Invalid Cart Item", 'fieldday')]);
            }

        }
        /*$cartItem = fieldday()->engine->getCartItem($cartkey);
    if ($cartItem)
    {
    $sessionId = $cartItem['session_id'];
    $tagId = $cartItem['tag_id'];
    $sessionDate = $cartItem['session_date'];
    $params = [];
    if ($sessionDate && $tagId)
    {
    $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
    }

    $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
    $singlesessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);

    if ($sessionDetail->statusCode != 200)
    {
    wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);
    }
    $cartForm = fieldday()->engine->getView('cart/add_to_cart', ['session' => $singlesessionInfo->data, 'tagId' => $tagId, 'sessionDate' => $sessionDate, 'cartItem' => $cartItem, 'cartkey' => $cartkey, 'singlesessionInfo'=> $singlesessionInfo->data,'datamode'=>'edit']);
    $footer = wp_sprintf('<span class="km_col_12 km_text_red km_required_disclaimer">%s</span>', fieldday()->engine->displayText('km_required_fields_disclaimer', false));

    $footer .= wp_sprintf('<a href="" class="km_add_participant_cancel km_primary_color km_transparent_bg km_btn km_hidden">%s</a>', __('Cancel', 'fieldday'));
    $footer .= wp_sprintf('<a href="" class="km_add_participant km_primary_bg km_btn km_btn_green km_hidden">%s</a>', __('Save', 'fieldday'));

    $footer .= wp_sprintf('<a href="" class="km_update_cart km_btn km_btn_green km_primary_bg">%s</a>', __('Update Cart', 'fieldday'));
    wp_send_json(['status' => 'success', 'content' => $cartForm, 'footer' => $footer, 'header' => $sessionDetail->data->name, 'session' => $sessionDetail->data]);
    } else
    {
    wp_send_json(['status' => 'fail', 'message' => __("invalid cart item", 'fieldday')]);
    }*/
    }

    /**
     * Display Cart form
     *
     * @return String Html form
     */
    public function AddToCartForm()
    {

        global $KmUser;
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
        $sessionDate = filter_input(INPUT_POST, 'sessionDate', FILTER_SANITIZE_STRING);
        $sessionFeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $sessionDateArray = filter_input(INPUT_POST, 'sessionDate', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $Iswaitlist = filter_input(INPUT_POST, 'waitlist', FILTER_SANITIZE_STRING);
        $back_btn_html = wp_sprintf('<a href="javascript:;" class="km_btn km_cartguest_back  km_btn_green km_primary_color km_transparent_bg" data-checkout-rediect="true"><i class="fa fa-angle-left"></i></a>', __('<', 'fieldday'));

        //NEW TEST CODE

        if (isset($_SESSION['fieldday']['ProviderId']) && $_SESSION['fieldday']['ProviderId'] != '') {
            $this->ProviderId = $_SESSION['fieldday']['ProviderId'];
        }
        if (isset($_SESSION['fieldday']['AuthKey']) && $_SESSION['fieldday']['AuthKey'] != '') {
            $this->AuthKey = $_SESSION['fieldday']['AuthKey'] ?? 'test';
        }

        //NEW TEST CODE END

        if (!$KmUser) {$_SESSION['typeofuser'] = 'guest';} else {unset($_SESSION['typeofuser']);}
        if (!empty($sessionFeatured) && !is_array($sessionDateArray)) {

            $this->registerSessionTiming();
        }

        $params = [];
        if ($sessionDate && $tagId) {
            $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
        }

        $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
        $singlesessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);

        if ($sessionDetail->statusCode != 200) {

            wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);

        }

        if (is_array($sessionDateArray) && isset($sessionDateArray)) {
            if ($sessionDetail->data->sessionType == "multiWeek") {
                $cartForm = fieldday()->engine->getView('cart/add_to_cart_multiweek', ['session' => $sessionDetail->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDateArray, 'cartItem' => [], 'cartkey' => null]);
            } else {
                $cartForm = fieldday()->engine->getView('cart/add_to_cart', ['session' => $singlesessionInfo->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDateArray, 'cartItem' => [], 'cartkey' => null, 'WaitlistSession' => $Iswaitlist]);
            }

        }
        global $fielddaySetting;

        $purchasepage = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));

        if ($sessionDetail->data->sessionType == "multiWeek") {
            $cartForm = fieldday()->engine->getView('cart/add_to_cart_multiweek', ['session' => $sessionDetail->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDateArray, 'cartItem' => [], 'cartkey' => null]);
        } else {
            $cartForm = fieldday()->engine->getView('cart/add_to_cart', ['session' => $singlesessionInfo->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDate, 'cartItem' => [], 'cartkey' => null, 'WaitlistSession' => $Iswaitlist]);
        }

        $footer = wp_sprintf('<span class="km_col_12 km_text_red km_required_disclaimer">%s</span>', fieldday()->engine->displayText('km_required_fields_disclaimer', false));
        $footermulti = wp_sprintf('<span class="km_col_12 km_text_red km_required_disclaimer">%s</span>', fieldday()->engine->displayText('km_required_fields_disclaimer', false));
        $footer .= wp_sprintf('<a href="" class="km_add_participant_cancel km_primary_color km_transparent_bg km_btn km_hidden">%s</a>', __('Cancel', 'fieldday'));
        $footer .= wp_sprintf('<a href="" class="km_add_participant km_primary_bg km_btn km_hidden">%s</a>', __('Save', 'fieldday'));
        /*
        $footer.= wp_sprintf('<a href="javascript:;" class="km_btn km_cartguest_back  km_btn_green km_primary_color km_transparent_bg" data-checkout-rediect="true">%s</a>', __('Back', 'fieldday'));
         */

        if ($Iswaitlist) {
            $footer .= wp_sprintf('<a href="javascript:;"  id="km_session_add_to_cart_pc" class="km_continue km_add_to_waitlist km_btn km_btn_green km_primary_bg">%s</a>', __('Add to Waitlist', 'fieldday'));
        } else {
            $footer .= wp_sprintf('<a href="javascript:;" class="km_btn km_cartguest_continue  km_btn_green km_primary_bg" data-checkout-rediect="true">%s</a>', __('Continue', 'fieldday'));
            $footer .= wp_sprintf('<a href="" class="km_add_to_cart km_btn km_btn_green km_primary_color km_transparent_bg km_new_checkout_btn_add_to_cart_form" data-checkout-rediect="true">%s</a>', __('Checkout', 'fieldday'));

            $footer .= wp_sprintf('<a id="km_session_add_to_cart_pc" href="' . $purchasepage . '" class="km_continue km_add_to_cart km_btn km_btn_green km_primary_bg">%s</a>', __('Add to Cart', 'fieldday'));
        }
        $footermulti .= wp_sprintf('<a href="javascript:;" class="km_btn km_multiweek_continue  km_btn_green km_primary_bg" data-checkout-rediect="true">%s</a>', __('Continue', 'fieldday'));
        $footermulti .= wp_sprintf('<a href="javascript:;" class="km_btn km_multiweek_back km_hidden km_btn_green km_transparent_bg km_primary_color" data-checkout-rediect="true">%s</a>', __('Back', 'fieldday'));

        $footermulti .= wp_sprintf('<a href="javascript:;" id="km_multiweek_purchase_btn_pc" class="km_hidden km_multiweek_btn km_btn km_btn_green km_primary_bg  km_btn_i_wrapper"><i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>%s</a>', __('Book Now', 'fieldday'));


        if ($sessionDetail->data->sessionType == "multiWeek") {
            //hide footer content based on conditions
            if(($sessionDetail->data->bookingStatus=='open' || $sessionDetail->data->bookingStatus=='waitlist') && $KmUser){
                $footermulti =  $footermulti;
            }else{
                $footermulti =  '';
            }
             //hide footer content based on conditions
            wp_send_json(['status' => 'success', 'content' => $cartForm, 'footer' => $footermulti, 'header' => $back_btn_html . $sessionDetail->data->name,'full_session_detail'=>$sessionDetail]);
        } else {
            //hide footer content based on conditions
            if( (($sessionDetail->data->bookingStatus=='open' || $sessionDetail->data->bookingStatus=='waitlist') && $KmUser) || (!$kmUser && $sessionDetail->data->bookingStatus=='open') ){
                $footer=$footer;
            }else{
                $footer='';
            }
             //hide footer content based on conditions
            wp_send_json(['status' => 'success', 'content' => $cartForm, 'footer' => $footer, 'header' => $back_btn_html . $sessionDetail->data->name,'full_session_detail'=>$sessionDetail]);
        }
    }

    /**
     * Display Event Purchase Form
     *
     */
    public function EventAddToCartForm()
    {
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
        $sessionDate = filter_input(INPUT_POST, 'sessionDate', FILTER_SANITIZE_STRING);
        $sessionFeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $sessionDateArray = filter_input(INPUT_POST, 'sessionDate', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if (!$KmUser) {$_SESSION['typeofuser'] = 'guest';} else {unset($_SESSION['typeofuser']);}
        if (!empty($sessionFeatured) && !is_array($sessionDateArray)) {

            $this->registerSessionTiming();
        }

        $params = [];
        if ($sessionDate && $tagId) {
            $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
        }

        $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
        $singlesessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);
        if ($sessionDetail->statusCode != 200) {

            wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);
        }

        if (is_array($sessionDateArray) && isset($sessionDateArray)) {

            $cartForm = fieldday()->engine->getView('cart/event_purchase', ['session' => $sessionDetail->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDateArray, 'cartItem' => [], 'cartkey' => null]);
        }
        global $fielddaySetting;
        $purchasepage = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
        $cartForm = fieldday()->engine->getView('cart/event_purchase', ['session' => $sessionDetail->data, 'tagId' => $tagId, 'singlesessionInfo' => $singlesessionInfo->data, 'sessionDate' => $sessionDate, 'cartItem' => [], 'cartkey' => null]);
        $footer = wp_sprintf('<span class="km_col_12 km_text_red km_required_disclaimer">%s</span>', fieldday()->engine->displayText('km_required_fields_disclaimer', false));
        $footer .= wp_sprintf('<a href="javascript:;" class="km_btn km_event_continue  km_btn_green km_primary_bg" data-checkout-rediect="true">%s</a>', __('Continue', 'fieldday'));
        $footer .= wp_sprintf('<a href="javascript:;" class="km_btn km_event_back km_hidden km_btn_green km_transparent_bg km_primary_color" data-checkout-rediect="true">%s</a>', __('Back', 'fieldday'));
        $footer .= wp_sprintf('<a href="javascript:;" id="km_event_checkout_btn" class="km_hidden km_btn  km_event_checkout km_btn_green km_primary_bg  km_btn_i_wrapper" data-checkout-rediect="true"><i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>%s</a>', __('Checkout', 'fieldday'));

        /*$footer .= wp_sprintf('<a href="'.$purchasepage.'" class="km_continue km_add_to_cart km_btn km_btn_green km_primary_bg">%s</a>', __('Add to Cart', 'fieldday'));*/
        wp_send_json(['status' => 'success', 'content' => $cartForm, 'footer' => $footer, 'header' => $sessionDetail->data->name]);
    }

    /**
     * Display Package Purchase Form
     *
     */
    public function PackagePurchaseForm()
    {
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $packageId = filter_input(INPUT_POST, 'packageId', FILTER_SANITIZE_STRING);

        if ($sessionId) {
            $sessionDetail = fieldday()->api->getActivitySession($sessionId);
            if ($sessionDetail->statusCode != 200) {
                wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);
            }
        }

        $classPackages = fieldday()->api->getPackages();
        /*Count Price*/
        if (isset($sessionId) || isset($packageId)) {
            $kidscount = 1;
            $prices = fieldday()->engine->CountPackagePrice($kidscount, true);
            $price = fieldday()->engine->CountPackagePrice($kidscount, false);

        }
        if ($classPackages->statusCode != 200) {
            wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);
        }
        global $fielddaySetting;
        $packageForm = fieldday()->engine->getView('package', ['session' => $sessionDetail->data, 'package' => $classPackages->data, 'sessionid' => $sessionId, 'cartItem' => [], 'price' => $price, 'cartkey' => null]);
        $footer = wp_sprintf('<span class="km_col_12 km_text_red km_required_disclaimer">%s</span>', fieldday()->engine->displayText('km_required_fields_disclaimer', false));
        $footer .= wp_sprintf('<a href="" class="km_add_participant_cancel km_primary_color km_transparent_bg km_btn km_hidden">%s</a>', __('Cancel', 'fieldday'));
        $footer .= wp_sprintf('<a href="" class="km_add_participant km_btn km_primary_bg km_hidden">%s</a>', __('Save', 'fieldday'));

        $footer .= wp_sprintf('<a href="javascript:;" class="km_package_back_btn km_transparent_bg km_package_btns km_btn km_primary_color" data-checkout-rediect="true">%s</a><a href="javascript:;" class="km_package_next_btn km_package_btns  km_btn km_btn_green km_primary_bg" data-checkout-rediect="true">%s</a><a href="" data-paymentmethod="card" data-purchasecount="1" class="km_package_purchase_btn km_package_btns  km_btn km_btn_green km_primary_bg" data-checkout-rediect="true">%s</a>', __('Back', 'fieldday'), __('Next', 'fieldday'), __('Book Now', 'fieldday'));
        wp_send_json(['status' => 'success', 'content' => $packageForm, 'footer' => $footer, 'header' => $sessionDetail->data->name, 'prices' => $prices]);
    }

    /**
     * Display Plans Popup
     *
     */
    public function DisplayPlansPopup()
    {
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
        $sessionDate = filter_input(INPUT_POST, 'sessionDate', FILTER_SANITIZE_STRING);
        $sessionFeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $sessionDateArray = filter_input(INPUT_POST, 'sessionDate', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $params = [];
        if ($sessionDate && $tagId) {
            $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
        }

        $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
        if ($sessionDetail->statusCode != 200) {
            wp_send_json(['status' => 'fail', 'message' => $sessionDetail->message]);
        }

        $PlansDiv = fieldday()->engine->getView('plans', ['session' => $sessionDetail->data, 'tagId' => $tagId, 'sessionDate' => $sessionDate, 'cartItem' => [], 'cartkey' => null]);

        wp_send_json(['status' => 'success', 'content' => $PlansDiv, 'footer' => '', 'header' => $sessionDetail->data->name]);
    }

    /**
     * get session extended care and extra purchases
     *
     * @return JSON json response
     */
    /* public function atcSessionExtendedCare() {
    $cartData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $sessionId = $cartData['ATC']['session_id'];
    $tagId = $cartData['ATC']['tag_id'];
    $sessionDate = $cartData['ATC']['session_date'];
    $params = [];
    if ($sessionDate && $tagId) {
    $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
    }
    $session = fieldday()->api->getActivitySession($sessionId, $params);
    if ($session->statusCode === 200) {
    $content = fieldday()->engine->getView('cart/extra_purchase', ['session' => $session->data]);
    wp_send_json(['status' => 'success', 'content' => $content]);
    } else {
    wp_send_json(['status' => 'fail', 'message' => 'session is invalid', 'logs' => $session]);
    }
    } */

    /**
     * Display the cart description
     */
    public function PrepareCart()
    {
        $cartData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = $cartData['ATC'];
        $sessionId = $data['session_id'];
        $tagId = $data['tag_id'];
        $sessionDate = $data['session_date'];
        $params = [];
        if ($sessionDate && $tagId) {
            $params = ['tagId' => $tagId, 'oneDaySelectedDate' => $sessionDate];
        }
        $session = fieldday()->api->getActivitySession($sessionId, $params);
        if ($session->statusCode === 200) {
            $content = apply_filters('fieldday_cart_detail', $this->prepareCartHtml($data, $session->data), $data, $session->data);
            wp_send_json(['status' => 'success', 'content' => $content]);
        } else {
            wp_send_json(['status' => 'fail', 'content' => '', 'logs' => $session]);
        }
    }

    public function prepareCartHtml($data, $session)
    {
        $extendedCareSelected = $data['extendedCareSelected']; // string
        $additionalChargeDetails = $data['additionalChargeDetails']; // array
        $session_additionalCharges = $session->additionalCharges;
        $add_services = [];
        foreach ($session_additionalCharges as $key => $sess_add_charge) {
            $chargeId = $sess_add_charge->_id;
            if ($additionalChargeDetails && in_array($chargeId, $additionalChargeDetails)) {
                $add_services[] = $sess_add_charge->title;
            }
        }
        $Htmldata = '<div class="atc_success_left">';
        $Htmldata .= '<ul class="atc_session_detail">';
        $Htmldata .= wp_sprintf('<li class="atc_succ_session"><b>%s</b></li>', $session->name);
        $Htmldata .= wp_sprintf('<li>%s<b>%d</b></li>', __('seats: ', 'fieldday'), count($data['kids']));
        if ($extendedCareSelected) {
            $Htmldata .= wp_sprintf('<li>%s<b>%s</b></li>', __('Extended Care: ', 'fieldday'), fieldday()->engine->extendedCareTypes($extendedCareSelected));
        }
        if ($additionalChargeDetails) {
            $Htmldata .= wp_sprintf('<li>%s<b>%s</b></li>', __('Additional Charges: '), implode(', ', $add_services));
        }
        $Htmldata .= '</ul>';
        $Htmldata .= '</div>';
        $Htmldata .= wp_sprintf('<p class="atc_help_text">%s</p>', fieldday()->engine->displayText('km_cart_help_text', false));

        return $Htmldata;
    }

    public function APIupdateCartItem()
    {
        global $KmUser;global $fielddaySetting;
        $cartData = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $kidscount = filter_input(INPUT_POST, 'kidscount', FILTER_SANITIZE_STRING);
        $cartItemKey = filter_input(INPUT_POST, 'cartItemKey', FILTER_SANITIZE_STRING);
        $sessionId = fieldday()->engine->getValue('session_id', $cartData, false);
        $kidsdata = $this->_getKidsForPurchase($cartData, $cartData);
        $extendedCareSelected_array = $cartData['extendedCareSelected'];
        if ($KmUser && $kidscount < 1) {
            wp_send_json(['status' => 'fail', 'message' => __("Please select any participants", 'fieldday')]);
        }
        $apidata = [];
        $apidata['offset'] = $fielddaySetting['offset'];
        if ($KmUser) {
            $apidata['kidId'] = $kidsdata;
        } else {
            $apidata['kidsDetails'] = $kidsdata;
        }
        if (isset($cartData['extendedCareSelected'])) {
            foreach ($cartData['extendedCareSelected'] as $extendedCareSelected_value) {
                $apidata['extendedCareSelected'] = $extendedCareSelected_value;
            }
            $apidata['optedForExtendedCare'] = 'true';
        } else { $apidata['optedForExtendedCare'] = 'false';}
        if (isset($cartData['additionalChargeDetails'])) {
            $apidata['additionalChargeDetails'] = $cartData['additionalChargeDetails'];
        }
        //print_r($apidata);
        $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
        $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
        $singlecartitem = fieldday()->api->UpdateSingleCartItemApi($cartItemKey, $GcartId, $GparentId, $apidata);
        //print_r($singlecartitem);
        if ($singlecartitem->statusCode === 200) {
            wp_send_json(['status' => 'success']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $singlecartitem->message]);
        }

    }

    public function APIsaveWaitListItem()
    {
        global $KmUser;global $fielddaySetting; 
        $queryParams = [];
        $cartData = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $kidscount = filter_input(INPUT_POST, 'kidscount', FILTER_SANITIZE_STRING);
        $sessionId = fieldday()->engine->getValue('session_id', $cartData, false);
        $kidsdata = $this->_getKidsForPurchase($cartData, $cartData);
        $extendedCareSelected_array = $cartData['extendedCareSelected'];
        $dropindates = json_decode($cartData['dropindates']); //"2022-05-29T05:00:00.000Z";
        //$dropindatestime = json_decode($cartData['dropindatestime']);
        $dropindatestime = json_decode($cartData['DatesTimeLabelAllDatesUtcFormat']);

        if (!array_key_exists('bookingoption_selection', $cartData)) {
            wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Options", 'fieldday')]);
        }
        if ($KmUser && $kidscount < 1) {
            wp_send_json(['status' => 'fail', 'message' => __("Please select any participants", 'fieldday')]);
        }
        /*
        if(array_key_exists('dropindates', $cartData) && $cartData['bookingoption_selection']=='fullDay' && $cartData['dropindates']==''){
        wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Dates", 'fieldday')]);
        }
         */
        if (array_key_exists('dropindates', $cartData) && $cartData['bookingoption_selection'] == 'fullDay' && ($cartData['dropindates'] == ''|| (is_array($cartData['dropindates']) && count($cartData['dropindates']) < 1))) 
        {
            wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Dates", 'fieldday')]);
        }

        $apidata = array();
        $apidata['kidId'] = $kidsdata;
        $apidata['sessionId'] = $sessionId;
        $apidata['offset'] = $fielddaySetting['offset'];
        $bookingoption = $cartData['bookingoption_selection'];
        if ($bookingoption != 'fullcamp') {
            $count = 0;
            foreach ($dropindates as $dropindate) {
                $date1 = strtr($dropindate, '-', '/');
                $date_booked = $dropindatestime->$dropindate;
                $extendedCareSelected_array = $cartData['extendedCareSelected'];
                $date_needs = date('m-d-Y', strtotime($date1));
                $date_booked_sel = str_replace("-", "", $date_needs);
                $apidata['addedForOneDayOnly'] = "true";
                $apidata['oneDayType'] = $bookingoption;
                $apidata['oneDaySelectedDate'] = $date_booked;
                if (isset($cartData['extendedCareSelected'])) {
                    foreach ($extendedCareSelected_array as $extendedCareSelected_value) {
                        $extended_array = explode("_", $extendedCareSelected_value);
                        if ($extended_array[1] == $date_booked_sel) {
                            $apidata['extendedCareSelected'] = $extended_array[0];
                        }
                    }
                    $apidata['optedForExtendedCare'] = true;
                }
                if (isset($cartData['additionalChargeDetails'])) {$additionalC_array = [];
                    $additionalChargeDetails_array = $cartData['additionalChargeDetails'];
                    foreach ($additionalChargeDetails_array as $additionalChargeDetails_value) {
                        $additional_array = explode("_", $additionalChargeDetails_value);
                        if ($additional_array[1] == $date_booked_sel) {
                            $additionalC_array[] = $additional_array[0];
                            $apidata['additionalChargeDetails'] = $additionalC_array;
                        }
                    }}
                $cartItemData = fieldday()->api->ItemtoWaitListAPI($apidata); 
                if ($cartItemData->statusCode === 201) {
                    wp_send_json(['status' => 'success']);
                } else {
                    wp_send_json(['status' => 'fail', 'message' => $cartItemData->message]);
                }

            } // foreach date ends

            } else { // For Booking Option fullcamp

            if (isset($cartData['selected_payment_option']) && $cartData['selected_payment_option'] !== 'full_amount') {
                $apidata['enabledPaymentOptions'] = true;
                $apidata['paymentOptionId'] = $cartData['selected_payment_option'];
            }

            $apidata['addedForOneDayOnly'] = "false";
            if (isset($cartData['extendedCareSelected'])) {
                foreach ($cartData['extendedCareSelected'] as $extendedCareSelected_value) {
                    $apidata['extendedCareSelected'] = $extendedCareSelected_value;
                }
                $apidata['optedForExtendedCare'] = true;
            }
            if (isset($cartData['additionalChargeDetails'])) {
                $apidata['additionalChargeDetails'] = $cartData['additionalChargeDetails'];
            }
            $cartItemData = fieldday()->api->ItemtoWaitListAPI($apidata);
            if ($cartItemData->statusCode === 201) {
                wp_send_json(['status' => 'success']);
            } else {
                wp_send_json(['status' => 'fail', 'message' => $cartItemData->message]);
            }}
    }

    public function APIsaveCartItem()
    {

        global $KmUser;global $fielddaySetting;
        $queryParams = [];
        $cartData = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $kidscount = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'kidscount', FILTER_SANITIZE_STRING));
        $checkoutRediect = filter_input(INPUT_POST, 'checkoutRediect', FILTER_SANITIZE_STRING);
        $personal_fullname = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'personal_fullname', FILTER_SANITIZE_STRING));
        $personal_guestEmail = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'personal_guestEmail', FILTER_SANITIZE_STRING));
        $personal_phone = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'personal_phone', FILTER_SANITIZE_STRING));
        $personal_phonecode = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'user-country-code', FILTER_SANITIZE_STRING));
        $personal_countrycode = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_input(INPUT_POST, 'users-countrycode', FILTER_SANITIZE_STRING));
        $sessionId = fieldday()->engine->getValue('session_id', $cartData, false);
        $kidsdata = $this->_getKidsForPurchase($cartData, $cartData);
        $extendedCareSelected_array = $cartData['extendedCareSelected'];
        $dropindates = json_decode($cartData['dropindates']); //"2022-05-29T05:00:00.000Z";
        //$dropindatestime = json_decode($cartData['dropindatestime']);
        $dropindatestime = json_decode($cartData['DatesTimeLabelAllDatesUtcFormat']);

        if (isset($cartData['kids']) && is_array($cartData['kids']) && count($cartData['kids']) > 0) {
            foreach ($cartData['kids'] as $key => $value) {
                if (isset($cartData['kids'][$key]['firstName'])) {$cartData['kids'][$key]['firstName'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($cartData['kids'][$key]['firstName'], FILTER_SANITIZE_STRING));}

                if (isset($cartData['kids'][$key]['lastName'])) {$cartData['kids'][$key]['lastName'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($cartData['kids'][$key]['lastName'], FILTER_SANITIZE_STRING));}
                if (isset($cartData['kids'][$key]['knownAs'])) {$cartData['kids'][$key]['knownAs'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($cartData['kids'][$key]['knownAs'], FILTER_SANITIZE_STRING));}
                if (isset($cartData['kids'][$key]['gender'])) {$cartData['kids'][$key]['gender'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($cartData['kids'][$key]['gender'], FILTER_SANITIZE_STRING));}
                if (isset($cartData['kids'][$key]['grade'])) {$cartData['kids'][$key]['grade'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($cartData['kids'][$key]['grade'], FILTER_SANITIZE_STRING));}
            }
        }

        if (!$KmUser && array_key_exists('selected_payment_option', $cartData) && $cartData['selected_payment_option'] !== 'full_amount') {
            wp_send_json(['status' => 'fail', 'message' => __("Payment in installments is only available for registered user.", 'fieldday')]);
        }
        if (!array_key_exists('bookingoption_selection', $cartData)) {
            wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Options", 'fieldday')]);
        }
        if ($KmUser && $kidscount < 1) {
            wp_send_json(['status' => 'fail', 'message' => __("Please select any participants", 'fieldday')]);
        }
        /*
        if(array_key_exists('dropindates', $cartData) && $cartData['bookingoption_selection']=='fullDay' && $cartData['dropindates']==''){
        wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Dates", 'fieldday')]);
        }
         */
        if (array_key_exists('dropindates', $cartData) && $cartData['bookingoption_selection'] == 'fullDay' &&
            (
                $cartData['dropindates'] == ''
                ||
                (is_array($cartData['dropindates']) && count($cartData['dropindates']) < 1)
            )
        ) {
            wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Dates", 'fieldday')]);
        }

        if (!$KmUser) {
            $cartData['Usertype'] = 'is_guest';
        }

        $apidata = array();
        if ($personal_guestEmail) {
            $_SESSION['Gpersonal_detail']['fullname'] = $personal_fullname;
            $_SESSION['Gpersonal_detail']['guestEmail'] = $personal_guestEmail;
            $_SESSION['Gpersonal_detail']['phone'] = $personal_phone;
            $_SESSION['Gpersonal_detail']['phonecode'] = $personal_phonecode;
            $_SESSION['Gpersonal_detail']['countrycode'] = $personal_countrycode;
        }
        if (!$KmUser && array_key_exists('Gpersonal_detail', $_SESSION)) {
            $apidata['parent']['name'] = $_SESSION['Gpersonal_detail']['fullname'];
            $apidata['parent']['guestEmail'] = $_SESSION['Gpersonal_detail']['guestEmail'];
            $apidata['parent']['countryCode'] = $_SESSION['Gpersonal_detail']['phonecode'];
            $apidata['parent']['phone'] = str_replace(' ', '', $_SESSION['Gpersonal_detail']['phone']);
        }

        if ($KmUser) {
            $apidata['kidId'] = $kidsdata;
        } else {
            $apidata['kidsDetails'] = $kidsdata;
        }
        $apidata['sessionId'] = $sessionId;
        $apidata['offset'] = $fielddaySetting['offset'];
        $bookingoption = $cartData['bookingoption_selection'];

        if ($bookingoption != 'fullcamp') {
            $count = 0;
            $cartAPIresponse = [];
            $cartId = fieldday()->engine->getCookieStorage('GcartId', false) ?? null;
            foreach ($dropindates as $dropindate) {
                $date1 = strtr($dropindate, '-', '/');
                $date_booked = $dropindatestime->$dropindate;
                $extendedCareSelected_array = $cartData['extendedCareSelected'];
                $date_needs = date('m-d-Y', strtotime($date1));
                $date_booked_sel = str_replace("-", "", $date_needs);
                $apidata['addedForOneDayOnly'] = "true";
                $apidata['oneDayType'] = $bookingoption;
                $apidata['oneDaySelectedDate'] = $date_booked;
                if (isset($cartData['extendedCareSelected'])) {
                    foreach ($extendedCareSelected_array as $extendedCareSelected_value) {
                        $extended_array = explode("_", $extendedCareSelected_value);
                        if ($extended_array[1] == $date_booked_sel) {
                            $apidata['extendedCareSelected'] = $extended_array[0];
                        }
                    }
                    $apidata['optedForExtendedCare'] = true;
                }
                if (isset($cartData['additionalChargeDetails'])) {$additionalC_array = [];
                    $additionalChargeDetails_array = $cartData['additionalChargeDetails'];
                    foreach ($additionalChargeDetails_array as $additionalChargeDetails_value) {
                        $additional_array = explode("_", $additionalChargeDetails_value);
                        if ($additional_array[1] == $date_booked_sel) {
                            $additionalC_array[] = $additional_array[0];
                            $apidata['additionalChargeDetails'] = $additionalC_array;
                        }
                    }}
                //$cartIdFromCookie = fieldday()->engine->getCookieStorage('GcartId', false);
                //$GcartId = fieldday()->engine->getValue('GcartId', $_SESSION, false);
                if ($cartId) {
                    $apidata['cartId'] = $cartId;
                }

                $cartItemData = fieldday()->api->ItemtoCartAPI($apidata);

                $cartAPIresponse['response'][] = $cartItemData;
                $cartAPIresponse['payload'][] = $apidata;
                if ($cartItemData->statusCode === 201) {
                    $cartId = $cartItemData->data->cartDetails[0]->cartId;
                    setcookie('GcartId', $cartId, time() + (86400), "/"); // 86400 = 1 day
                    setcookie('GparentId', $cartItemData->data->parentId, time() + (86400), "/"); // 86400 = 1 day
                    $_SESSION['api_cartId'] = $cartItemData->data->_id;
                    $_SESSION['api_parentId'] = $cartItemData->data->parentId;
                } else {
                    wp_send_json(['status' => 'fail', 'message' => $cartItemData->message]);
                }

            } //foreach date ends
            if (isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured != 'feature-purchase' || isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured == 'feature-purchase') {
                $checkout = apply_filters('km_checkout_page', site_url('/checkout'));
                wp_send_json(['status' => 'success', 'pageredirect' => $checkout]);
            } else {
                wp_send_json(['status' => 'success', 'logs' => $cartAPIresponse]);
            }
        } else { // For Booking Option fullcamp

            if (isset($cartData['selected_payment_option']) && $cartData['selected_payment_option'] !== 'full_amount') {
                $apidata['enabledPaymentOptions'] = true;
                $apidata['paymentOptionId'] = $cartData['selected_payment_option'];
            }

            $apidata['addedForOneDayOnly'] = "false";
            if (isset($cartData['extendedCareSelected'])) {
                foreach ($cartData['extendedCareSelected'] as $extendedCareSelected_value) {
                    $apidata['extendedCareSelected'] = $extendedCareSelected_value;
                }
                $apidata['optedForExtendedCare'] = true;
            }
            if (isset($cartData['additionalChargeDetails'])) {
                $apidata['additionalChargeDetails'] = $cartData['additionalChargeDetails'];
            }
            /*if(isset($_SESSION['api_cartId']) && $_SESSION['api_cartId']!='')
            {
            $apidata['cartId'] = $_SESSION['api_cartId'];
            }*/

            $cartId = fieldday()->engine->getCookieStorage('GcartId', false);
            if ($cartId) {
                $apidata['cartId'] = $cartId;
            }

            $cartItemData = fieldday()->api->ItemtoCartAPI($apidata);
            if ($cartItemData->statusCode === 201) {
                setcookie('GcartId', $cartItemData->data->cartDetails[0]->cartId, time() + (86400), "/"); // 86400 = 1 day
                setcookie('GparentId', $cartItemData->data->parentId, time() + (86400), "/"); // 86400 = 1 day
                $_SESSION['api_cartId'] = $cartItemData->data->cartDetails[0]->cartId;
                $_SESSION['api_parentId'] = $cartItemData->data->parentId;
                if (isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured != 'feature-purchase' || isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured == 'feature-purchase') {
                    $checkout = apply_filters('km_checkout_page', site_url('/checkout'));
                    wp_send_json(['status' => 'success', 'pageredirect' => $checkout]);
                } else {
                    wp_send_json(['status' => 'success', 'apiData' => $apidata, 'apiresposne' => $cartItemData]);
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => $cartItemData->message]);
            }
        }
    }

    /**
     * save item into cart
     *
     * @return JSON json response
     */
    public function saveCartItem()
    {
        global $KmUser;
        $cartData = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $cartKey = filter_input(INPUT_POST, 'cartItemKey', FILTER_SANITIZE_STRING);
        $checkoutRediect = filter_input(INPUT_POST, 'checkoutRediect', FILTER_SANITIZE_STRING);
        $personal_fullname = filter_input(INPUT_POST, 'personal_fullname', FILTER_SANITIZE_STRING);
        $personal_guestEmail = filter_input(INPUT_POST, 'personal_guestEmail', FILTER_SANITIZE_STRING);
        $personal_phone = filter_input(INPUT_POST, 'personal_phone', FILTER_SANITIZE_STRING);
        $personal_phonecode = filter_input(INPUT_POST, 'user-country-code', FILTER_SANITIZE_STRING);
        $personal_countrycode = filter_input(INPUT_POST, 'users-countrycode', FILTER_SANITIZE_STRING);

        if (!$KmUser && array_key_exists('selected_payment_option', $cartData) && $cartData['selected_payment_option'] !== 'full_amount') {
            wp_send_json(['status' => 'fail', 'message' => __("Payment in installments is only available for registered user.", 'fieldday')]);
        }
        if (array_key_exists('session_id', $cartData)) {
            $sessionId = $cartData['session_id'];
            $age_from = $cartData['age_from'];
            $age_to = $cartData['age_to'];
            $tag_id = $cartData['tag_id'];
            $session_date = $cartData['session_date'];

            /*New data added with Booking Dates*/
            $session_oneday_booking = $cartData['oneday_booking'];
            $session_bookingoption = $cartData['bookingoption_selection'];
            $session_dropindates = $cartData['dropindates'];
            $session_dropindatestime = $cartData['dropindatestime'];
            /* ends */
            $sessionfeatured = $cartData['sessionfeatured'];

            $params = [];
            if ($session_date && $tag_id) {
                $params = ['tagId' => $tag_id, 'oneDaySelectedDate' => $session_date];
            }

            $newkids = [];
            $index = 1;
            if (!array_key_exists('bookingoption_selection', $cartData)) {
                wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Options", 'fieldday')]);
            }
            if (array_key_exists('dropindates', $cartData) && $cartData['bookingoption_selection'] == 'fullDay' && $cartData['dropindates'] == '') {
                wp_send_json(['status' => 'fail', 'message' => __("Please Select Booking Dates", 'fieldday')]);
            }
            if (!$KmUser) {
                $cartData['Usertype'] = 'is_guest';
            }
            if (array_key_exists('kids', $cartData)) {

                foreach ($cartData['kids'] as $key => $kidInfo) {
                    if ($kidInfo['knownAs'] == '') {
                        $kidInfo['knownAs'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($kidInfo['firstName'], FILTER_SANITIZE_STRING));
                    }
                    $newkids[$index] = $kidInfo;
                    $index++;
                    /*$dob = $kidInfo['dob'];

                $from = new DateTime($dob);
                $to   = new DateTime('today');
                $kid_age = $from->diff($to)->y;
                if(($age_from <= $kid_age) && ($kid_age <= $age_to))
                {
                //echo $kid_age." age is between the range".$age_from." and ".$age_to;
                } else {
                wp_send_json(['status' => 'fail', 'message' => __("Participant age should be between ".$age_from." - ".$age_to, 'fieldday')]);
                }*/

                }
                $cartData['kids'] = $newkids;
                if (is_array($cartData['session_date'])) {
                    $cartDates = $cartData['session_date'];
                    unset($cartData['session_date']);
                    foreach ($cartDates as $sessionDate) {
                        $cartData['session_date'] = $sessionDate;
                        $params = ['tagId' => $tag_id, 'oneDaySelectedDate' => $sessionDate];

                        $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
                        if ($sessionDetail->statusCode === 200) {
                            $cartData['session_detail'] = $sessionDetail->data;
                            if ($personal_guestEmail) {
                                $_SESSION['Gpersonal_detail']['fullname'] = $personal_fullname;
                                $_SESSION['Gpersonal_detail']['guestEmail'] = $personal_guestEmail;
                                $_SESSION['Gpersonal_detail']['phone'] = $personal_phone;
                                $_SESSION['Gpersonal_detail']['phonecode'] = $personal_phonecode;
                                $_SESSION['Gpersonal_detail']['countrycode'] = $personal_countrycode;

                            }
                            $fielddayCart = fieldday()->engine->saveCartItem($cartData, $cartKey);
                            $cartitems = count($fielddayCart);
                            $bookingdetail = $this->_generateBoking($cartData);
                            if (!$KmUser && array_key_exists('Gpersonal_detail', $_SESSION)) {
                                $bookingdetail['parent']['name'] = $_SESSION['Gpersonal_detail']['fullname'];
                                $bookingdetail['parent']['guestEmail'] = $_SESSION['Gpersonal_detail']['guestEmail'];
                                $bookingdetail['parent']['countryCode'] = $_SESSION['Gpersonal_detail']['phonecode'];
                                $bookingdetail['parent']['phone'] = str_replace(' ', '', $_SESSION['Gpersonal_detail']['phone']);
                            }
                            // print_r($bookingdetail);
                            $calculationInfo = fieldday()->api->calculateSessionPrice($bookingdetail);
                        }
                    }
                    if (isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured != 'feature-purchase' || isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured == 'feature-purchase') {

                        $checkout = apply_filters('km_checkout_page', site_url('/checkout'));
                        wp_send_json(['status' => 'success', 'total' => $cartitems, 'pageredirect' => $checkout]);

                    } else {
                        wp_send_json(['status' => 'success', 'total' => $cartitems]);
                    }
                } else {

                    $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);

                    if ($sessionDetail->statusCode === 200) {

                        $cartData['session_detail'] = $sessionDetail->data;
                        if ($personal_guestEmail) {
                            $_SESSION['Gpersonal_detail']['fullname'] = $personal_fullname;
                            $_SESSION['Gpersonal_detail']['guestEmail'] = $personal_guestEmail;
                            $_SESSION['Gpersonal_detail']['phone'] = $personal_phone;
                            $_SESSION['Gpersonal_detail']['phonecode'] = $personal_phonecode;
                            $_SESSION['Gpersonal_detail']['countrycode'] = $personal_countrycode;
                        }
                        //print_r($cartData);
                        $fielddayCart = fieldday()->engine->saveCartItem($cartData, $cartKey);
                        $cartitems = count($fielddayCart);
                        $bookingdetail = $this->_generateBoking($cartData);
                        if (!$KmUser && array_key_exists('Gpersonal_detail', $_SESSION)) {
                            $bookingdetail['parent']['name'] = $_SESSION['Gpersonal_detail']['fullname'];
                            $bookingdetail['parent']['guestEmail'] = $_SESSION['Gpersonal_detail']['guestEmail'];
                            $bookingdetail['parent']['countryCode'] = $_SESSION['Gpersonal_detail']['phonecode'];
                            $bookingdetail['parent']['phone'] = str_replace(' ', '', $_SESSION['Gpersonal_detail']['phone']);
                        }
                        //print_r($bookingdetail);
                        $calculationInfo = fieldday()->api->calculateSessionPrice($bookingdetail);

                        if (isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured != 'feature-purchase' || isset($checkoutRediect) && $checkoutRediect == 'true' && $sessionfeatured == 'feature-purchase') {

                            $checkout = apply_filters('km_checkout_page', site_url('/checkout'));
                            wp_send_json(['status' => 'success', 'total' => $cartitems, 'pageredirect' => $checkout]);

                        } else {
                            wp_send_json(['status' => 'success', 'total' => $cartitems]);
                        }

                    } else {
                        wp_send_json(['status' => 'fail', 'message' => __("unable to get session detail. Please try again.", 'fieldday'), 'logs' => $sessionDetail]);
                    }
                }
            } else {

                wp_send_json(['status' => 'fail', 'message' => __("Please select any participants", 'fieldday')]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __("invalid session found. Please try again.", 'fieldday')]);
        }
    }

    /*public function removeSessioncartItems(){
    if(isset($_SESSION['removed_cart_items']) && ($_SESSION['removed_cart_items'])!=''){
    unset($_SESSION['removed_cart_items']);
    }
    }*/
    /**
     * get the cart html
     *
     * @return JSON json response
     */
    public function getCartHtml()
    {
        global $fielddaySetting;global $KmUser;
        $cartDetails = fieldday()->engine->GetCartData();
        if (!empty($cartDetails)) {
            $purchasepage = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
            $content = "<h3 class='km_secondary_bg'>Cart</h3><div class='removecartselecter'>X</div><div class='km_cart_itemsul'>";
            foreach ($cartDetails as $cartDetail) {
                $kids = $cartDetail->kidId;
                $kidname = '';
                $key = $cartDetail->_id;
                $addedForOneDayOnly = $cartDetail->addedForOneDayOnly;
                $selectedate = '';
                if ($addedForOneDayOnly) {
                    $bookingtypesel = "Drop-In";
                    $selectedate = fieldday()->engine->parseDate($cartDetail->oneDaySelectedDate, 'd-M-Y');
                } else {
                    $bookingtypesel = "All Session Days";
                }
                foreach ($kids as $kid) {
                    $kidname .= '<span>' . $kid->firstName . '</span>';
                }
                $session_img = fieldday()->engine->displaySessionThumb($cartDetail->sessionId, false, true);
                $location = $cartDetail->sessionId->siteLocationId->name;
                $location_state = $cartDetail->sessionId->siteLocationId->state;
                $location_country = $cartDetail->sessionId->siteLocationId->country;
                $location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
                $content .= '<div class="km_row km_cart_single">';
                $content .= wp_sprintf('<div class="km_col_2 km_cart_img">%s</div>', $session_img);
                $content .= wp_sprintf('<div class="km_cart_desc km_col_10"><span class="cart_item_heading">%s</span>', $cartDetail->sessionId->name);
                $content .= wp_sprintf('<div class="km_cart_item_seats"><i class="fa fa-child km_primary_color" aria-hidden="true"></i>%s</div>', $kidname);
                $content .= wp_sprintf('<div class="km_cart_item_sdate km_cart_time km_cart_bookingtype_sel"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span>%s</span>', $bookingtypesel);
                if ($selectedate) {
                    $content .= wp_sprintf('<span class="km_cart_item_sdate km_cart_time"> (%s)</span>', $selectedate);
                }
                $content .= '</div>';
                $content .= wp_sprintf('<div class="km_cart_location km_cart_time">
                    <i class="fa fa-map-marker km_primary_color"></i>
                    <span class="km_location_session_details"><a href="%s" onclick="window.open(this.href,"targetWindow","toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600"); return false;">(%s)</a></span></div>', $location_link, $location);
                $content .= wp_sprintf('<div class="km_cart_button"><span data-cart-key="%s" class="km_edit_cart_item km_primary_color">Edit</span><span data-cart-key="%s" class="km_remove_cart_item km_secondary_color" data-actionfrom="cart">Remove</span></div></div>', $key, $key);
                $content .= '</div>';
            }
            $content .= '</div>';
            $content .= wp_sprintf('<div class="checkout_button"><a class="km_primary_color km_btn km_transparent_bg" href="%s">Continue Shopping</a>', apply_filters('km_purchase_page', $purchasepage));
            $content .= wp_sprintf('<a class="km_btn km_primary_bg" href="%s">Checkout</a></div>', apply_filters('km_checkout_page', site_url('/checkout')));
            wp_send_json(['status' => 'success', 'items' => count($cartDetails), 'content' => $content]);
        } else {
            $emptycartText = wp_sprintf("<div class='removecartselecter'>X</div> <div class='km_nodata'>%s</div>", fieldday()->engine->displayText('atc_empty_cart', false));
            wp_send_json(['status' => 'success', 'items' => 0, 'content' => $emptycartText]);
        }
    }

    /**
     * remove cart item
     *
     * @return JSON json response
     */
    public function removeCartItem()
    {
        $cart_key = filter_input(INPUT_POST, 'cart_key', FILTER_SANITIZE_STRING);
        if ($cart_key) {
            $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
            $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
            $apicartitems = fieldday()->api->RemoveCartItemApi($cart_key, $GcartId, $GparentId);
            $this->getCartHtml();
        }
    }

    public function SiblingDiscountAPI()
    {
        global $KmUser;global $fielddaySetting;
        $status = filter_input(INPUT_POST, 'astatus', FILTER_SANITIZE_STRING);
        $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
        $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
        $applydiscount = fieldday()->api->ApplySiblingDiscount($status, $GcartId, $GparentId);
        if ($applydiscount->statusCode == 200) {
            wp_send_json(['status' => 'success']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $applydiscount->message]);
        }

    }

    /**
     * get kids form to purchase seats
     *
     * @return JSON json response
     */
    public function GetKidsForm()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $cartKey = fieldday()->engine->getValue('cartItemKey', $postdata, false);
        $sessionId = $postdata['ATC']['session_id'];
        $packageId = $postdata['ATC']['package_id'];
        $tag_id = $postdata['ATC']['tag_id'];
        $session_date = $postdata['ATC']['session_date'];
        //$kids = $postdata['ATC']['kids'];
        $params = [];
        $price = '';
        if ($session_date && $tag_id) {
            if (is_array($session_date)) {
                $params = ['tagId' => $tag_id, 'oneDaySelectedDate' => $session_date[0]];
            } else {
                $params = ['tagId' => $tag_id, 'oneDaySelectedDate' => $session_date];
            }
        }
        if (isset($sessionId) && !isset($packageId)) {
            $sessionDetail = fieldday()->api->getActivitySession($sessionId, $params);
            if ($sessionDetail->statusCode !== 200) {
                wp_send_json(['status' => 'fail', 'message' => __('Invalid session. Please try again.', 'fieldday')]);
            }
        }
        /*Count Price*/
        if (isset($packageId)) {
            $kidscount = $postdata['kidscount'];
            $price = fieldday()->engine->CountPackagePrice($kidscount);

        }
        if (!isset($postdata['kidscount']) || $postdata['kidscount'] < 1) {
            wp_send_json(['status' => 'fail', 'message' => __('please select seats first', 'fieldday')]);
        }
        //$selected = isset($postdata['selected_kid']) ? $postdata['selected_kid'] : null;
        //$AllKids = fieldday()->engine->getKids($selected);
        $KidformHtml = "";
        $counter = 1;
        $kidNumber = 0;
        if ($cartKey) {
            $AllKids = $postdata['ATC']['kids'];
            /*$cartItem = fieldday()->engine->getCartItem($cartKey);
        if ($cartItem)
        {
        $AllKids = $cartItem['kids'];
        }*/
        }
        while ($counter <= $postdata['kidscount']) {

            if (isset($AllKids[$counter])) {
                $profile = $AllKids[$counter];
                $kidId = $profile->_id;
            } else {
                $profile = [];
                $kidId = fieldday()->engine->generateRandomId(16, 'new_kid_');
            }

            $KidformHtml .= fieldday()->engine->getView('cart/single_kid_form', [
                'profile' => $profile,
                'counter' => $counter,
                'kidId' => $kidId,
                'sessionInfo' => $sessionDetail->data,
            ]
            );

            $counter++;
            $kidNumber++;
        }

        wp_send_json(['status' => 'success', 'content' => $KidformHtml, 'price' => $price]);
    }

    /**
     * generate the required parameters for booking
     *
     * @param array $postdata
     * @param boolean $purchase request type i.e for purchase or price calculation
     * @return array array of booking details
     */
    private function _generateBoking($postdata, $purchase = false)
    {
        global $KmUser;
        global $fielddaySetting;
        $cartdata = fieldday()->engine->GetCartData();
        //print_r($cartdata);

        if (empty($cartdata)) {
            return false;
        }
        $storeCreditUsed = fieldday()->engine->getvalue('storeCreditId', $postdata, false);

        if ($purchase) {
            /* fixes for IE */
            $lastKey = key(array_slice($postdata, -1, 1, true));
            if (strpos($lastKey, '-----------------------------') !== false) {
                unset($postdata[$lastKey]);
            }
            $bookingdetail = $postdata;

            /* remove not required data from array */
            if ($KmUser) {
                unset($bookingdetail['parent']);
            }
            unset($bookingdetail['kids'], $bookingdetail['action'], $bookingdetail['permalink'], $bookingdetail['_wpnonce']);

            if (fieldday()->engine->getvalue('stripeToken', $postdata, false)) {
                $bookingdetail['paymentMethod'] = 'card';
            } else {
                $bookingdetail['paymentMethod'] = 'free';
                unset($bookingdetail['paymentAddress']);
            }
            $bookingdetail['offset'] = $fielddaySetting['offset'];
            $saveCard = fieldday()->engine->getvalue('saveCard', $postdata, false);
            if ($KmUser) {
                $bookingdetail['saveCard'] = $saveCard == 'on' ? true : false;
            }

        } else {
            $bookingdetail = [];
        }
        $coupon = fieldday()->engine->getvalue('couponCode', $postdata, false);
        if ($coupon != '') {$bookingdetail['couponCode'] = $coupon;}
        if ($storeCreditUsed) {
            $bookingdetail['storeCreditUsed'] = true;
            $bookingdetail['storeCreditId'] = $storeCreditUsed;
            $manualStoreCreditPaid = fieldday()->engine->getvalue('manualStoreCreditPaid', $postdata, false);
            if ($manualStoreCreditPaid) {
                $bookingdetail['manualStoreCreditPaid'] = $manualStoreCreditPaid;
            }
        }

        /* set individual Items */
        //$dates_array = array();
        $items_count = 0;
        foreach ($cartdata as $cartKey => $cartItem) { //echo "mydata"; print_r($cartItem['kids']); print_r($cartItem);
            $sessionData = $cartItem['session_detail'];
            $bookingoption_selection = $cartItem['bookingoption_selection'];
            $dropindates = json_decode($cartItem['dropindates']); //"2022-05-29T05:00:00.000Z";
            $dropindatestime = json_decode($cartItem['dropindatestime']);
            /*$test_date = "2022-05-29";
            $newtestDate = fieldday()->engine->parseDate($test_date,'Y-m-d\TH:i:s\Z'); */

            if (isset($bookingoption_selection) && $bookingoption_selection != 'fullcamp') {
                foreach ($dropindates as $dropindate) {
                    $date1 = strtr($dropindate, '-', '/');
                    //$date_booked =date('Y-m-d\TH:i:s\Z', strtotime($date1));
                    $date_booked = $dropindatestime->$dropindate;
                    $extendedCareSelected_array = $cartItem['extendedCareSelected'];
                    //print_r($extendedCareSelected_array);
                    $date_needs = date('m-d-Y', strtotime($date1));
                    $date_booked_sel = str_replace("-", "", $date_needs);
                    /* for purchase based data */
                    if ($purchase) {
                        $singleBooking[$items_count]['kids'] = $this->_getKidsForPurchase($postdata, $cartItem);
                    } else {
                        $singleBooking[$items_count]['kidsCount'] = count($cartItem['kids']);
                        $kidsdata = $this->_getKidsForPurchase($postdata, $cartItem);
                        if (!$KmUser) {
                            foreach ($kidsdata as $key => $kiddata) {
                                if ($kiddata['forms']) {
                                    unset($kiddata['forms']);
                                    $kidsdata[$key] = $kiddata;
                                }
                            }
                            $singleBooking[$items_count]['kidsDetails'] = $kidsdata;
                        } else {
                            $singleBooking[$items_count]['kidId'] = $kidsdata;
                        }
                        //echo "kidsdatasdasd";
                        //print_r($kidsdata);

                        $singleBooking[$items_count]['bookingKey'] = $cartKey;
                    }

                    /* for purchase based data */
                    $singleBooking[$items_count]['sessionId'] = $cartItem['session_id'];
                    $singleBooking[$items_count]['applySiblingDiscount'] = $this->apply_sibling_discount($storeCreditUsed, $sessionData, $postdata);

                    //if (isset($sessionData->oneDayType))
                    /*if(isset($bookingoption_selection) && $bookingoption_selection!='fullcamp')
                    {*/
                    //$singleBooking['oneDayType'] = $sessionData->oneDayType;
                    $singleBooking[$items_count]['addedForOneDayOnly'] = "true";
                    $singleBooking[$items_count]['oneDayType'] = $bookingoption_selection;
                    //}
                    if (isset($dropindates)) {
                        $singleBooking[$items_count]['oneDaySelectedDate'] = $date_booked;
                    }
                    if (isset($cartItem['extendedCareSelected'])) {
                        foreach ($extendedCareSelected_array as $extendedCareSelected_value) {
                            $extended_array = explode("_", $extendedCareSelected_value);
                            if ($extended_array[1] == $date_booked_sel) {
                                $singleBooking[$items_count]['extendedCareSelected'] = $extended_array[0];
                            }

                        }
                        /*$singleBooking[$items_count]['extendedCareSelected'] = $cartItem['extendedCareSelected'];*/
                        $singleBooking[$items_count]['optedForExtendedCare'] = true;
                    }
                    if (isset($cartItem['additionalChargeDetails'])) {$additionalC_array = [];
                        $additionalChargeDetails_array = $cartItem['additionalChargeDetails'];
                        foreach ($additionalChargeDetails_array as $additionalChargeDetails_value) {
                            $additional_array = explode("_", $additionalChargeDetails_value);
                            //$additionalC_value = str_replace("-","",$additional_array[0]);
                            if ($additional_array[1] == $date_booked_sel) {
                                $additionalC_array[] = $additional_array[0];
                                $singleBooking[$items_count]['additionalChargeDetails'] = $additionalC_array;
                            }
                            //$additionalC_array[] = $additional_array[0];
                        }}
                    /* if($cartItem['selected_payment_option'] !== 'full_amount') {
                    if(isset($cartItem['session_detail']->enablePaymentOptions) && $cartItem['session_detail']->enablePaymentOptions) {
                    $singleBooking[$items_count]['enabledPaymentOptions'] = true;
                    $singleBooking[$items_count]['paymentOptionId'] = $cartItem['session_detail']->paymentOptions[0]->_id;
                    if ($purchase && $KmUser)
                    {
                    $bookingdetail['saveCard'] = true;
                    }
                    }
                    }*/
                    //$bookingdetail['bookingDetails'] = $singleBooking;
                    $items_count++;
                }
            } else { //Data for Full Camp
                if ($purchase) {
                    $singleBooking[$items_count]['kids'] = $this->_getKidsForPurchase($postdata, $cartItem);
                } else {
                    $singleBooking[$items_count]['kidsCount'] = count($cartItem['kids']);
                    $kidsdata = $this->_getKidsForPurchase($postdata, $cartItem);
                    if (!$KmUser) {
                        foreach ($kidsdata as $key => $kiddata) {
                            if ($kiddata['forms']) {
                                unset($kiddata['forms']);
                                $kidsdata[$key] = $kiddata;
                            }
                        }
                        $singleBooking[$items_count]['kidsDetails'] = $kidsdata;
                    } else {
                        $singleBooking[$items_count]['kidId'] = $kidsdata;
                    }
                    //echo "kidsdatasdasd";
                    //print_r($kidsdata);

                    $singleBooking[$items_count]['bookingKey'] = $cartKey;
                }

                /* for purchase based data */
                $singleBooking[$items_count]['sessionId'] = $cartItem['session_id'];
                $singleBooking[$items_count]['applySiblingDiscount'] = $this->apply_sibling_discount($storeCreditUsed, $sessionData, $postdata);
                $singleBooking[$items_count]['addedForOneDayOnly'] = "false";
                if (isset($cartItem['extendedCareSelected'])) {
                    foreach ($cartItem['extendedCareSelected'] as $extendedCareSelected_value) {
                        //$extended_array = explode("_",$extendedCareSelected_value);
                        //if($extended_array[1]==$date_booked_sel){
                        $singleBooking[$items_count]['extendedCareSelected'] = $extendedCareSelected_value;
                        //}

                    }
                    // $singleBooking[$items_count]['extendedCareSelected'] = $cartItem['extendedCareSelected'];
                    $singleBooking[$items_count]['optedForExtendedCare'] = true;
                }
                if (isset($cartItem['additionalChargeDetails'])) {
                    $singleBooking[$items_count]['additionalChargeDetails'] = $cartItem['additionalChargeDetails'];
                }
                if ($cartItem['selected_payment_option'] !== 'full_amount') {
                    if (isset($cartItem['session_detail']->enablePaymentOptions) && $cartItem['session_detail']->enablePaymentOptions) {
                        $singleBooking[$items_count]['enabledPaymentOptions'] = true;
                        $singleBooking[$items_count]['paymentOptionId'] = $cartItem['session_detail']->paymentOptions[0]->_id;
                        if ($purchase && $KmUser) {
                            $bookingdetail['saveCard'] = true;
                        }
                    }
                }
                $items_count++;
            } // ends fullcamp else
        } // ends foreach
        $bookingdetail['bookingDetails'] = $singleBooking;
        return $bookingdetail;
    }

    /**
     * get the kids for purchase API
     *
     * @param array $postdata data from html form
     * @param mixed $cartdata data from cart
     *
     * @return mixed kids data i.e array of Id's or array object for guest user
     */
    private function _getKidsForPurchase($postdata, $cartdata)
    {
        global $KmUser;
        $kids = [];
        $kidForms = fieldday()->engine->getValue('kids', $postdata, false);
        if ($KmUser) {
            /* if user is logged in only needs Kid id's */
            foreach ($cartdata['kids'] as $key => $kidInfo) {

                if (preg_match("/new_kid_/", $kidInfo['_id'])) {
                    $kidDataFromPost = fieldday()->engine->getValue($kidInfo['_id'], $kidForms, false);
                    $forms = fieldday()->engine->getValue('forms', $kidDataFromPost, false);
                    unset($kidInfo['_id']);
                    $kidResponse = fieldday()->engine->addNewKid($kidInfo, $forms);
                    if ($kidResponse) {
                        $kids[] = $kidResponse->_id;
                    }
                } else {
                    /* check for update */
                    $updateTriggers = fieldday()->engine->getValue('update_kid_info', $postdata, false);
                    if (fieldday()->engine->getValue($kidInfo['_id'], $updateTriggers, false)) {
                        $kidDataFromPost = fieldday()->engine->getValue($kidInfo['_id'], $kidForms, false);
                        $insurance = [];
                        if (fieldday()->engine->getValue('forms', $kidDataFromPost, false)) {
                            if (array_key_exists('medicalInsurance', $kidDataFromPost['forms'])) {
                                $insurance['medInsurance'] = $kidDataFromPost['forms']['medicalInsurance'];
                                $insurance['medInsurance']['isAvailable'] = true;
                                unset($kidDataFromPost['forms']['medicalInsurance']);
                            }
                            if (array_key_exists('dentalInsurance', $kidDataFromPost['forms'])) {
                                $insurance['dentalInsurance'] = $kidDataFromPost['forms']['dentalInsurance'];
                                $insurance['dentalInsurance']['isAvailable'] = true;
                                unset($kidDataFromPost['forms']['dentalInsurance']);
                            }
                        }
                        $kidDataFromPost['kidId'] = $kidInfo['_id'];
                        /* update kid profile */
                        $kidprofile = $kidInfo;
                        $updateKid = fieldday()->api->UpdateKidProfile($kidInfo['_id'], $kidprofile);

                        /* update medical forms */
                        $formsResponse = fieldday()->api->SaveMedicalForms($kidDataFromPost);

                        /* save insurance */
                        if (!empty($insurance)) {
                            $insuranceUpdate = fieldday()->api->UpdateInsurance($insurance);
                        }
                    }

                    $kids[] = $kidInfo['_id'];
                }
            }
            return $kids;
        } else {
            /* if user is not loggedin Need full kid data with forms */
            foreach ($cartdata['kids'] as $key => $kidInfo) {
                $kidId = $kidInfo['_id'];
                unset($kidInfo['_id']);
                if (!fieldday()->engine->getValue('knownAs', $kidInfo, false)) {
                    $kidInfo['knownAs'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', filter_var($kidInfo['firstName'], FILTER_SANITIZE_STRING));
                }
                if (!fieldday()->engine->getValue('school', $kidInfo, false)) {
                    unset($kidInfo['school']);
                }
                if (isset($kidInfo['gender']) && !$kidInfo['gender']) {
                    unset($kidInfo['gender']);
                }
                $kidDataFromPost = fieldday()->engine->getValue($kidId, $kidForms, false);
                $formsRequired = fieldday()->engine->getValue('forms', $kidDataFromPost, false);
                if ($formsRequired) {
                    $kidInfo['forms'] = $formsRequired;
                    if (array_key_exists('medicalInsurance', $kidInfo['forms'])) {
                        $kidInfo['forms']['medicalInsurance']['isAvailable'] = true;
                    }
                    if (array_key_exists('dentalInsurance', $kidDataFromPost['forms'])) {
                        $kidInfo['forms']['dentalInsurance']['isAvailable'] = true;
                    }
                }
                $kids[] = $kidInfo;
            }

            return $kids;
        }
    }

    /**
     * update cart data
     *
     * @return Json Json data
     */
    public function UpdateCartInformation()
    {
        global $KmUser;global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $kids = fieldday()->engine->getValue('kids', $postdata, false);
        $storeCreditUsed = fieldday()->engine->getvalue('storeCreditId', $postdata, false);
        $coupon = fieldday()->engine->getValue('couponCode', $postdata, false);
        $manualStoreCreditPaid = fieldday()->engine->getvalue('manualStoreCreditPaid', $postdata, false);
        $apidata = [];
        if ($KmUser) {
            if ($storeCreditUsed) {
                $apidata['creditId'] = $storeCreditUsed;
                if ($manualStoreCreditPaid) {
                    $apidata['manualStoreCreditPaid'] = $manualStoreCreditPaid;
                }
                $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
                if ($GcartId) {
                    $apidata['cartId'] = $GcartId;
                }
                //$apidata['cartId'] = $_SESSION['api_cartId'];
                $updatecredit = fieldday()->api->ApplyStoreCreditAPI($apidata);
            } else {
                $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
                if ($GcartId) {
                    $apidata['cartId'] = $GcartId;
                }
                //$apidata['cartId'] = $_SESSION['api_cartId'];
                $removecredit = fieldday()->api->RemoveStoreCreditAPI($apidata);
            }
        }
        /*if($coupon && $coupon!=$_SESSION['coupon_value']){
        $couponapidata['couponCode'] = $coupon;
        $GcartId = fieldday()->engine->getCookieStorage('GcartId',false);
        $GparentId = fieldday()->engine->getCookieStorage('GparentId',false);
        $queryParams['cartId'] = $GcartId;
        $queryParams['parentId'] = $GparentId;
        $status = 'applycoupon';
        $applycoupon = fieldday()->api->ApplyCouponAPI($couponapidata,$queryParams,$status);
        if ($applycoupon->statusCode != 200)
        {
        wp_send_json(['status' => 'fail', 'message' => $applycoupon->message]);
        } else {
        $_SESSION['coupon_applied'] = 'yes';
        $_SESSION['coupon_value'] = $coupon;
        }

        } else if($coupon=='' && $_SESSION['coupon_applied']=='yes') {
        unset($_SESSION['coupon_applied']);
        unset($_SESSION['coupon_value']);
        $GcartId = fieldday()->engine->getCookieStorage('GcartId',false);
        $GparentId = fieldday()->engine->getCookieStorage('GparentId',false);
        $queryParams['cartId'] = $GcartId;
        $queryParams['parentId'] = $GparentId;
        $status = 'removecoupon';
        $removecoupon = fieldday()->api->ApplyCouponAPI('',$queryParams,$status);
        }*/

        foreach ($kids as $key => $kidInfo) {
            if ($kidInfo['forms']['doctors']['address']['state'] == '') {
                $kidInfo['forms']['doctors']['address']['state'] = $kidInfo['forms']['doctors']['address']['street'];
            }
            if ($kidInfo['forms']['doctors']['address']['city'] == '') {
                $kidInfo['forms']['doctors']['address']['city'] = $kidInfo['forms']['doctors']['address']['street'];
            }
            if ($kidInfo['forms']['doctors']['address']['pin'] == '') {
                $kidInfo['forms']['doctors']['address']['pin'] = $kidInfo['forms']['doctors']['address']['street'];
            }
            $kidDataFromPost = $kidInfo;
            $kidDataFromPost['kidId'] = $key;
            if (array_key_exists('medicalInsurance', $kidDataFromPost['forms'])) {
                $kidDataFromPost['forms']['medInsurance'] = $kidDataFromPost['forms']['medicalInsurance'];
                unset($kidDataFromPost['forms']['medicalInsurance']);
            }
            $formsResponse = fieldday()->api->SaveMedicalForms($kidDataFromPost);
        }
        $cartdata = fieldday()->engine->GetCartData(true); // fetch cart data
        if ($cartdata->cartDetails) {
            $content = fieldday()->engine->getView('checkout/cart', ['coupon' => $coupon, 'calculationInfo' => $cartdata->cartDetails, 'CartTotals' => $cartdata]);
            $extraData = [
                'totalAmount' => $cartdata->totalAmount,
                'payableAmount' => $cartdata->payableAmount == null ? 0 : $cartdata->payableAmount,
                'authPickups' => $this->getAuthPickups($postdata),
                'cardinfo' => apply_filters('fieldday_checkout_card_info', $this->getCardInfo($postdata), $postdata),
                'pricedetail' => apply_filters('fieldday_checkout_price_info', $this->getPriceInfo($cartdata), $cartdata),
            ];
            wp_send_json(['status' => 'success', 'content' => $content, 'data' => $extraData]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => fieldday()->engine->displayText('km_empty_cart_msg', false)]);
        }
    }

    public function ApplyCouponCart()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $coupon = fieldday()->engine->getValue('couponCode', $postdata, false);
        if ($coupon) {
            $couponapidata['couponCode'] = $coupon;
            $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
            $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
            $queryParams['cartId'] = $GcartId;
            $queryParams['parentId'] = $GparentId;
            $status = 'applycoupon';
            $applycoupon = fieldday()->api->ApplyCouponAPI($couponapidata, $queryParams, $status);
            if ($applycoupon->statusCode != 200) {
                wp_send_json(['status' => 'fail', 'message' => $applycoupon->message]);
            } else {
                //$_SESSION['coupon_applied'] = 'yes';
                //$_SESSION['coupon_value'] = $coupon;
                wp_send_json(['status' => 'success', 'message' => 'Coupon Applied Successfully.']);
            }

        } else if ($coupon == '') {
            //unset($_SESSION['coupon_applied']);
            //unset($_SESSION['coupon_value']);
            $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
            $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
            $queryParams['cartId'] = $GcartId;
            $queryParams['parentId'] = $GparentId;
            $status = 'removecoupon';
            $removecoupon = fieldday()->api->ApplyCouponAPI('', $queryParams, $status);
            wp_send_json(['status' => 'success', 'message' => '']);
        }
    }

    /**
     * Display Auth Pickups
     *
     * @param type $postData
     *
     * @return String pickup detail
     */
    public function getAuthPickups($postData)
    {
        $authpickups = "<span class='km_default_pickman'>";
        $authpickups .= wp_sprintf('<p>%s</p>', $postData['parent']['name']);
        $authpickups .= wp_sprintf('<p>+%s %s</p>', $postData['parent']['countryCode'], $postData['parent']['phone']);
        $authpickups .= "</span>";
        $authpickups .= '<span class="km_authpick_check_wrap km_primary_bg"><i class="fa fa-check km_authpick_check"></i></span>';

        return $authpickups;
    }

    private function getPriceInfo($calculationInfo)
    {
        $engine = fieldday()->engine;
        $content = "<ul>";
        $content .= wp_sprintf('<li><span class="km_title_">%s</span><span class="km_price_">%s</span></li>', __('Bag Total', 'fieldday'), $engine->display_price($calculationInfo->totalAmount));
        if ($calculationInfo->siblingDiscount) {
            $content .= wp_sprintf('<li><span class="km_title_">%s</span><span class="km_price_ km_primary_color">%s</span></li>', __('Sibling Discount', 'fieldday'), $engine->display_price($calculationInfo->siblingDiscount));
        }
        $content .= wp_sprintf('<li><span class="km_title_">%s</span><span class="km_price_ km_primary_color">%s</span></li>', __('Store Credit Applied', 'lfieldday'), $engine->getCreditApplied($calculationInfo));
        $content .= wp_sprintf('<li><span class="km_title_">%s</span><span class="km_price_ km_secondary_color">%s</span></li>', __('Total Payable', 'fieldday'), $engine->display_price($calculationInfo->payableAmount));
        $content .= "</ul>";

        return $content;
    }

    private function getCardInfo($postData)
    {

    }

    /**
     * purchase fieldday session with fieldday API
     *
     * @return Json json response
     */

    public function fielddaySessionPurchase()
    {
        global $fielddaySetting;global $KmUser;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $apidata = [];
        $saveCard = fieldday()->engine->getvalue('saveCard', $postdata, false);
        $stripeToken = fieldday()->engine->getvalue('stripeToken', $postdata, false);
        $cartId = fieldday()->engine->getvalue('cartId', $postdata, false);
        $cardId = fieldday()->engine->getvalue('cardId', $postdata, false);
        $paymentMethod = fieldday()->engine->getvalue('paymentMethod', $postdata, false);
        $apidata['cartId'] = $cartId;

        if ($KmUser) {
            $saveCard == 'on' ? true : false;
            if ($saveCard) {
                $apidata['saveCard'] = $saveCard;
            }
        }
        if (!$KmUser) {
            $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
            $apidata['parentId'] = $GparentId;
        }

        if ($paymentMethod == 'card') {
            if ($cardId) {$apidata['cardId'] = $postdata['cardId'];}
            if (fieldday()->engine->getvalue('stripeToken', $postdata, false)) {
                $apidata['stripeToken'] = $stripeToken;
                //$apidata['paymentMethod'] = 'card';
            }
        }
        $apidata['paymentMethod'] = $paymentMethod;
        $apidata['authPickUps'] = $postdata['authPickUps'];

        foreach ($apidata['authPickUps'] as $key => $picker) {
            $apidata['authPickUps'][$key]['countryCode'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $apidata['authPickUps'][$key]['countryCode']);
            $apidata['authPickUps'][$key]['name'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $apidata['authPickUps'][$key]['name']);
            $apidata['authPickUps'][$key]['phone'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $apidata['authPickUps'][$key]['phone']);
        }

        foreach ($apidata['authPickUps'] as $key => $picker) {
            if (trim(fieldday()->engine->getValue('phone', $picker, false)) == '') {
                unset($apidata['authPickUps'][$key]);
            }
        }
        if (count($apidata['authPickUps']) == 0) {
            unset($apidata['authPickUps']);
        }

        $apidata['terms'] = $postdata['terms'];

        foreach ($apidata['terms'] as $key => $newTerms) {
            $apidata['terms'][$key]['isAccepted'] = $newTerms['isAccepted'] == 'on' ? true : false;
            $apidata['terms'][$key]['termId'] = $newTerms['termId'];
        }

        if ($postdata['paymentAddress']['city']) {
            $apidata['paymentAddress']['city'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $postdata['paymentAddress']['city']);
        }
        $apidata['offset'] = $fielddaySetting['offset'];
        $date = date('Y-m-d H:i:s');

        $purchaseInfo = fieldday()->api->purchaseSession($apidata);
        $this->__savelogs("Purchase step (" . $date . "): Let's purchase", $purchaseInfo);
        if ($purchaseInfo->statusCode === 201) {
            $content = fieldday()->engine->getView('checkout/thanks', ['order' => $purchaseInfo->data]);
            $redirect = fieldday()->engine->ThankyouRedirect();
            if(isset($redirect) && $redirect!=''){
                $redirect .= '?orderid='.$purchaseInfo->data->_id;
            }
            unset($_SESSION['coupon_applied']);
            unset($_SESSION['GcartId']);
            unset($_SESSION['coupon_value']);
            wp_send_json(['status' => 'success', 'content' => $content, 'order' => $purchaseInfo->data,'redirect'=>$redirect]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($purchaseInfo->message), 'logs' => $purchaseInfo]);
        }

    }

    /**
     * get sibling discount applied or not
     *
     * @param String $storeCreditUsed store credit ID
     * @param mixed $sessionData session data object
     * @param mixed $postdata form data
     *
     * return bool
     */
    private function apply_sibling_discount($storeCreditUsed, $sessionData)
    {
        if ($storeCreditUsed) {
            return false;
        }

        return fieldday()->engine->getValue('offersSiblingDiscount', $sessionData, false);
    }

    /**
     * get total price after store credit applied
     * @param Array $storeCredit store credit apply data
     * @param Int $seats seatrs to reserve
     * @param type $seatPrice price of one seat
     * @param type $session_type session type weekly, oneday, morningonly, afternoononly
     *
     * @return Int Price after store credit
     */
    private function CalculateStoreCredit($storeCredit, $seats, $seatPrice, $session_type)
    {
        if (fieldday()->engine->getValue('type', $storeCredit, false) == 'dollercredit') {
            $dollercredit = $storeCredit['amount'];
            $totalPrice = $seats * $seatPrice;
            if ($dollercredit > $totalPrice) {
                $priceafterDiscount = 0;
            } else {
                $priceafterDiscount = $totalPrice - $dollercredit;
            }

            return $priceafterDiscount;
        } elseif (fieldday()->engine->getValue('type', $storeCredit, false) == 'daycredit') {
            $sessionDays = 1;
            if ($session_type == 'weekly') {
                $sessionDays = 5;
            }
            $totalDays = $seats * $sessionDays;
        }
    }

    /**
     * calculate total price after sibling discount
     *
     * @param Int $seats total seats to purchase
     * @param Int $seatPrice Price for single seat
     * @param Array $discountRules Discount rules
     *
     * @return int Price after apply discount
     */
    public function getSiblingDiscount($seats, $seatPrice, $discountRules)
    {
        $discountRules = (array) $discountRules;
        $netprice = 0;
        for ($i = 1; $i <= $seats; $i++) {
            if (count($discountRules) > $i && isset($discountRules[$i])) {
                $netprice = $netprice + $seatPrice - (($seatPrice * $discountRules[$i]) / 100);
            } else if ($i > 4 && $discountRules["+"]) {
                $netprice = $netprice + $seatPrice - (($seatPrice * $discountRules["+"]) / 100);
            } else {
                $netprice = $netprice + $seatPrice;
            }
        }

        return $netprice;
    }

    /**
     * display auth modal to user
     */
    public function DisplayAuthForm()
    {

        $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_STRING);
        $offerId = filter_input(INPUT_POST, 'offerId', FILTER_SANITIZE_STRING);
        $offername = filter_input(INPUT_POST, 'offername', FILTER_SANITIZE_STRING);
        $packageId = filter_input(INPUT_POST, 'package_id', FILTER_SANITIZE_STRING);
        $sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $isGuest = filter_input(INPUT_POST, 'isGuest', FILTER_SANITIZE_STRING);
        $isGroupSessionListing = filter_input(INPUT_POST, 'isGroupSessionListing', FILTER_SANITIZE_STRING);
        $data = [];
        if ($session_id) {
            $sessionDate = filter_input(INPUT_POST, 'session_date', FILTER_SANITIZE_STRING);
            $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
            $data = ['sessionDate' => $sessionDate, 'sessionId' => $session_id, 'tagId' => $tagId, 'sessionfeatured' => $sessionfeatured, 'isGuest' => $isGuest, 'isGroupSessionListing' => $isGroupSessionListing];
        } elseif ($offerId) {
            $data = ['offerId' => $offerId, 'offername' => $offername, 'isGroupSessionListing' => $isGroupSessionListing];
        } elseif ($packageId) {
            $data = ['packageId' => $packageId, 'isGroupSessionListing' => $isGroupSessionListing];
        }
        $contents = fieldday()->engine->getView('login_popup', $data);
        $header = __('', 'fieldday');
        wp_send_json(['status' => 'success', 'content' => $contents, 'header' => $header]);
    }

    /**
     * Display a login form
     */
    public function DisplayLoginForm()
    {
        $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_STRING);
        $offerId = filter_input(INPUT_POST, 'offerId', FILTER_SANITIZE_STRING);
        $offername = filter_input(INPUT_POST, 'offername', FILTER_SANITIZE_STRING);
        $data = [];
        if ($session_id) {
            $sessionDate = filter_input(INPUT_POST, 'session_date', FILTER_SANITIZE_STRING);
            $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
            $sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
            $isGuest = filter_input(INPUT_POST, 'isGuest', FILTER_SANITIZE_STRING);

            $data = ['sessionDate' => $sessionDate, 'sessionId' => $session_id, 'tagId' => $tagId, 'sessionfeatured' => $sessionfeatured, "isGuest" => $isGuest];
        } elseif ($offerId) {
            $data = ['offerId' => $offerId];
            $data = ['offername' => $offername];

        }
        $contents = fieldday()->engine->getView('login', $data);
        $header = __('', 'fieldday');
        wp_send_json(['status' => 'success', 'content' => $contents, 'header' => $header]);
    }

    /**
     * Display a register form
     */
    public function DisplayRegisterForm()
    {
        $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_STRING);
        $offerId = filter_input(INPUT_POST, 'offerId', FILTER_SANITIZE_STRING);
        $offername = filter_input(INPUT_POST, 'offername', FILTER_SANITIZE_STRING);
        $data = [];
        if ($session_id) {
            $sessionDate = filter_input(INPUT_POST, 'session_date', FILTER_SANITIZE_STRING);
            $tagId = filter_input(INPUT_POST, 'tagId', FILTER_SANITIZE_STRING);
            $data = ['sessionDate' => $sessionDate, 'sessionId' => $session_id, 'tagId' => $tagId];
        } elseif ($offerId) {
            $data = ['offerId' => $offerId];
            $data = ['offername' => $offername];
        }
        $contents = fieldday()->engine->getView('register', $data);
        $header = __('Create Account', 'fieldday');
        wp_send_json(['status' => 'success', 'content' => $contents, 'header' => '']);
    }

    /**
     * fieldday API login
     *
     * @return JSON Json response of user data
     */
    public function LoginProcessNew()
    {
        $username = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
        $username = trim($username);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $redirect = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_STRING);
        $sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $isGuest = filter_input(INPUT_POST, 'isGuest', FILTER_SANITIZE_STRING);
        if ($username) {
            $recatcha = fieldday()->engine->recaptchaVerify($token);
            if (!$recatcha['success']) {
                wp_send_json(['status' => 'fail', 'loggedin' => false, 'message' => __('reCAPTCHA invalid')]);
            }
            $LoggedIn = fieldday()->api->LoginWithEmail($username);
            //print_r($LoggedIn);
            if ($LoggedIn->statusCode === 201 && $LoggedIn->success === true) {
                $loginToken = $LoggedIn->data->loginToken;
                $isSent = fieldday()->api->LoginResendOtpEmail($loginToken, 'true');
                if (!$redirect) {
                    $redirect = fieldday()->engine->LoginRedirect();
                }
                if ($isSent->statusCode === 211 && $isSent->success === true) {
                    $header = 'Enter the Verification Code';
                    if ($isSent->success && $isSent->statusCode == 211) {
                        $verificationView = fieldday()->engine->getView('login_register_verification', ['user' => $LoggedIn, 'redirect_url' => $redirect, 'is_registered' => false]);
                        wp_send_json(['status' => 'varificationsent', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView, 'logs' => $LoggedIn->data, 'header' => $header]);
                    } else {
                        wp_send_json(['status' => 'varificationfailed', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent->data]);
                    }
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($LoggedIn->message, 'fieldday'), 'logs' => $LoggedIn]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')]);
        }
    }

    public function LoginProcess()
    {

        $username = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'user_password', FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $redirect = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_STRING);
        $sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
        $isGuest = filter_input(INPUT_POST, 'isGuest', FILTER_SANITIZE_STRING);
        if ($username) {
            /* varify google recaptcha */
            $recatcha = fieldday()->engine->recaptchaVerify($token);
            if (!$recatcha['success']) {
                wp_send_json(['status' => 'fail', 'loggedin' => false, 'message' => __('reCAPTCHA invalid')]);
            }
            $LoggedIn = fieldday()->api->LoginWithEmail($username);
            if ($LoggedIn->statusCode === 201 && $LoggedIn->success === true) {
                /* check if user phone is verified */
                if ($LoggedIn->data->phoneVerified) {
                    $isLoggedin = fieldday()->engine->fielddayDoLogin($LoggedIn->data);
                    if ($isLoggedin) {
                        /*if(!empty($_SESSION['km_cart_items'])){
                        fieldday()->engine->removeCart();
                        }*/
                        if (!$redirect) {
                            $redirect = fieldday()->engine->LoginRedirect();
                        }

                        if (!empty($sessionfeatured)) {

                            wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'logs' => $LoggedIn->data, 'sessionfeatured' => $sessionfeatured]);
                        } else if ($isGuest == 'true') {

                            wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'isGuest' => $isGuest, 'redirect' => '', 'logs' => $LoggedIn->data]);
                        } else {

                            wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'redirect' => $redirect, 'logs' => $LoggedIn->data]);
                        }

                    } else {
                        wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday')]);
                    }
                } else {
                    /* send unverified user a OTP to verify phone */
                    $isSent = fieldday()->api->ResendOtp($LoggedIn->data->countryCode, $LoggedIn->data->phone, $LoggedIn->data->accessToken);
                    $header = 'Enter the verification Code';
                    if ($isSent->success && $isSent->statusCode == 211) {
                        $verificationView = fieldday()->engine->getView('verification', ['user' => $LoggedIn]);
                        wp_send_json(['status' => 'varificationsent', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView, 'logs' => $LoggedIn->data, 'header' => $header]);
                    } else {
                        wp_send_json(['status' => 'varificationfailed', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent->data]);
                    }
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($LoggedIn->message, 'fieldday'), 'logs' => $LoggedIn]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')]);
        }
    }

    public function SocialLogin()
    {
        $AuthCode = filter_input(INPUT_POST, 'AuthCode', FILTER_SANITIZE_STRING);
        $client = filter_input(INPUT_POST, 'client', FILTER_SANITIZE_STRING);
        $redirect = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_STRING);
        $openpopup = filter_input(INPUT_POST, 'openpopup', FILTER_SANITIZE_STRING);
        $popup = '';
        if ($AuthCode) {
            if ($client == 'facebook') {
                $UserData = fieldday()->engine->fielddayFacebookLogin($AuthCode);
            } else if ($client == 'google') {
                $UserData = fieldday()->engine->fielddayGoogleLogin($AuthCode);
                //print_r($UserData);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')]);
            }
            if ($UserData->statusCode === 201) {
                if ($UserData->data->phoneVerified) {
                    $isLoggedin = fieldday()->engine->fielddayDoLogin($UserData->data);
                    if ($isLoggedin) {
                        if (!$redirect && !$openpopup) {
                            $redirect = fieldday()->engine->LoginRedirect();
                        } elseif (isset($openpopup)) {
                            $redirect = '';
                            $popup = $openpopup;
                        }
                        /*if(!empty($_SESSION['km_cart_items'])){
                        fieldday()->engine->removeCart();
                        }*/
                        wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'popup' => $popup, 'redirect' => $redirect, 'logs' => $UserData]);
                    } else {
                        wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday')]);
                    }
                } else {
                    if ($UserData->data->phone && $UserData->data->countryCode) {
                        /* send unverified user a OTP to verify phone */
                        $isSent = fieldday()->api->ResendOtp($UserData->data->countryCode, $UserData->data->phone, $UserData->data->accessToken);
                        if ($isSent->success && $isSent->statusCode == 211) {
                            $verificationView = fieldday()->engine->getView('verification', ['user' => $UserData]);
                            wp_send_json(['status' => 'varificationsent', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView]);
                        } else {
                            wp_send_json(['status' => 'varificationfailed', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent->data]);
                        }
                    } else {
                        $verificationView = fieldday()->engine->getView('phoneupdate', ['user' => $UserData]);
                        $header = __('Phone Verification.', 'fieldday');
                        wp_send_json(['status' => 'nophone', 'message' => __("Please update phone no.", 'fieldday'), 'content' => $verificationView, 'header' => $header]);
                    }
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($UserData->message, 'fieldday'), 'logs' => $UserData]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __('your request is invalid', 'fieldday')]);
        }
    }

    /**
     *
     * @return Json response
     */
    public function RegisterProcess()
    {
        $name = filter_input(INPUT_POST, 'user-register-name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'user-register-email', FILTER_SANITIZE_STRING);
        $countrycode = filter_input(INPUT_POST, 'user-country-code', FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        //$password = filter_input(INPUT_POST, 'user-register-password', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'user-phone-number', FILTER_SANITIZE_STRING);
        /* varify google recaptcha */
        $recatcha = fieldday()->engine->recaptchaVerify($token);

        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'loggedin' => false, 'message' => __('reCAPTCHA invalid')]);
        }
        $userdata = [
            'name' => $name,
            'email' => $email,
            'countryCode' => $countrycode,
            'phone' => $phone,
            //'password' => $password
        ];
        $registered = fieldday()->api->Registration($userdata);
        if ($registered->statusCode === 201 && $registered->success === true) {
            $LoggedIn = fieldday()->api->LoginWithEmail($email);
            if ($LoggedIn->statusCode !== 201) {
                wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday'), 'logs' => $LoggedIn]);
            }
            if ($LoggedIn->data->phoneVerified) {
                $isLoggedin = fieldday()->engine->fielddayDoLogin($LoggedIn->data);
                if ($isLoggedin) { /*if(!empty($_SESSION['km_cart_items'])){
                fieldday()->engine->removeCart();
                }*/
                    wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'redirect' => fieldday()->engine->LoginRedirect(), 'logs' => $LoggedIn->data]);
                } else {
                    wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday')]);
                }
            } else {
                /* send unverified user a OTP to verify phone */
                $isSent = fieldday()->api->ResendOtp($LoggedIn->data->countryCode, $LoggedIn->data->phone, $LoggedIn->data->accessToken);
                $header = 'Enter the verification Code';
                if ($isSent->success && $isSent->statusCode == 211) {
                    $verificationView = fieldday()->engine->getView('verification', ['user' => $LoggedIn]);
                    wp_send_json(['status' => 'varificationsent', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView, 'logs' => $LoggedIn->data, 'header' => $header]);
                } else {
                    wp_send_json(['status' => 'varificationfailed', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent]);
                }
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($registered->message, 'fieldday'), 'logs' => $registered]);
        }
    }

    public function RegisterProcessNew()
    {
        $name = filter_input(INPUT_POST, 'user-register-name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'user-register-email', FILTER_SANITIZE_STRING);
        $countrycode = filter_input(INPUT_POST, 'user-country-code', FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        //$password = filter_input(INPUT_POST, 'user-register-password', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'user-phone-number', FILTER_SANITIZE_STRING);
        /* varify google recaptcha */
        $recatcha = fieldday()->engine->recaptchaVerify($token);

        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'loggedin' => false, 'message' => __('reCAPTCHA invalid')]);
        }

        $userdata = [
            'name' => trim($name),
            'email' => trim($email),
            'countryCode' => trim($countrycode),
            'phone' => trim($phone),
        ];

        $registered = fieldday()->api->Registration($userdata);
        if ($registered->statusCode === 201 && $registered->success === true) {
            $LoggedIn = fieldday()->api->LoginWithEmail($email);
            if ($LoggedIn->statusCode === 201 && $LoggedIn->success === true) {
                $loginToken = $LoggedIn->data->loginToken;
                $isSent = fieldday()->api->LoginResendOtpEmail($loginToken, 'false');
                if ($isSent->statusCode === 211 && $isSent->success === true) {
                    $header = 'Enter the Verification Code';
                    if ($isSent->success && $isSent->statusCode == 211) {
                        $verificationView = fieldday()->engine->getView('login_register_verification', ['user' => $LoggedIn, 'actionp' => 'register', 'is_registered' => true]);
                        wp_send_json(['status' => 'varificationsent', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView, 'logs' => $LoggedIn->data, 'header' => $header]);
                    } else {
                        wp_send_json(['status' => 'varificationfailed', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent->data]);
                    }
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($LoggedIn->message, 'fieldday'), 'logs' => $LoggedIn]);
            }

        } else {
            wp_send_json(['status' => 'fail', 'message' => __($registered->message, 'fieldday'), 'logs' => $registered]);
        }
    }

    /**
     * Submit the provider donation
     */
    public function submitDonation()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $success_message = filter_input(INPUT_POST, 'success_message', FILTER_SANITIZE_STRING);
        /* varify google recaptcha */
        $recatcha = fieldday()->engine->recaptchaVerify($token);
        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'message' => __('reCAPTCHA invalid')]);
        }
        $donationData = $postdata['donationData'];
        if ($donationData['userDetails']['lastName'] == '') {
            unset($donationData['userDetails']['lastName']);
        }
        $apiResponse = fieldday()->api->makeDonation($donationData);
        if ($apiResponse->statusCode === 201) {
            if ($success_message == '') {
                $success_message = wp_sprintf("<span class='km_donation_success_message km_text_center'>%s</span>", apply_filters('donation_success_message', __("Thank you for your donation")));
            }
            wp_send_json(['status' => 'success', 'message' => __('Donation successful', 'fieldday'), 'header' => __("donation successful"), 'content' => $success_message]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($apiResponse->message, 'fieldday')]);
        }
    }

    /**
     * verify Otp
     */

    public function LoginVerifyOTP()
    {
        $userID = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
        //$access_token = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);
        $redirect = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_STRING);
        $login_token = filter_input(INPUT_POST, 'login_token', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $redirect_page_ = fieldday()->engine->LoginRedirect();
        if ($redirect_page_ == '') {
            $redirect_page_ = site_url('/');
        }
        if (!$userID) {
            wp_send_json(['status' => 'fail', 'message' => __("your request is invalid", 'fieldday')]);
        }
        $otp = implode('', $postdata['otp']);
        $isVerified = fieldday()->api->LoginverifyOTP($otp, $login_token);
        if ($isVerified->statusCode === 200) {
            $access_token = $isVerified->data->accessToken;
            //echo "hereis the token:".$access_token;
            $LoggedIn = fieldday()->api->getUser($userID, $access_token);
            $LoggedIn->data->accessToken = $access_token;
            $isLoggedin = fieldday()->engine->fielddayDoLogin($LoggedIn->data);
            if ($isLoggedin) {
                wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'redirect_page_' => $redirect_page_, 'redirect' => $redirect, 'logs' => $LoggedIn->data]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday')]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($isVerified->message, 'fieldday'), 'logs' => $isVerified]);
        }
    }

    public function VerifyOTP()
    {
        $userID = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
        $access_token = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!$userID) {
            wp_send_json(['status' => 'fail', 'message' => __("your request is invalid", 'fieldday')]);
        }

        $userData = fieldday()->api->getUser($userID, $access_token);

        if ($userData->statusCode === 200) {
            $otp = implode('', $postdata['otp']);
            $isVerified = fieldday()->api->verifyOTP($otp, $access_token);
            if ($isVerified->statusCode === 200) {
                $LoggedIn = fieldday()->api->getUser($userID, $access_token);
                $LoggedIn->data->accessToken = $access_token;
                $isLoggedin = fieldday()->engine->fielddayDoLogin($LoggedIn->data);
                if ($isLoggedin) { /*if(!empty($_SESSION['km_cart_items'])){
                fieldday()->engine->removeCart();
                }*/
                    wp_send_json(['status' => 'success', 'message' => __('login successful', 'fieldday'), 'redirect' => fieldday()->engine->LoginRedirect(), 'logs' => $LoggedIn->data]);
                } else {
                    wp_send_json(['status' => 'fail', 'message' => __('unable to login please try again later.', 'fieldday')]);
                }
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($isVerified->message, 'fieldday'), 'logs' => $isVerified]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($userData->message, 'fieldday'), 'logs' => $userData]);
        }
    }

    /**
     * resend the OTP to user
     *
     * @param ARRAY $_POST post data needs user_phone_code, user_phone, access_token
     * @return JSON json response
     */
    public function ResendOtp()
    {

        $PhoneCode = filter_input(INPUT_POST, 'user_phone_code', FILTER_SANITIZE_STRING);
        $Phone = filter_input(INPUT_POST, 'user_phone', FILTER_SANITIZE_STRING);
        $access_token = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);
        $otpType = filter_input(INPUT_POST, 'km_verify_code_type', FILTER_SANITIZE_STRING);
        if ($otpType == 'email') {
            $isSent = fieldday()->api->ResendOtpEmail($access_token);
        } else {
            $isSent = fieldday()->api->ResendOtp($PhoneCode, $Phone, $access_token);
        }

        if ($isSent->success && $isSent->statusCode == 211) {
            wp_send_json(['status' => 'success', 'message' => __("Verification Code Sent.", 'fieldday'), 'logs' => $isSent->data]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent]);
        }
    }

    public function LoginResendOtp()
    {

        $PhoneCode = filter_input(INPUT_POST, 'user_phone_code', FILTER_SANITIZE_STRING);
        $Phone = filter_input(INPUT_POST, 'user_phone', FILTER_SANITIZE_STRING);
        //$isEmailOTP = filter_input(INPUT_POST, 'isEmailOTP', FILTER_SANITIZE_STRING);
        $login_token = filter_input(INPUT_POST, 'login_token', FILTER_SANITIZE_STRING);
        $otpType = filter_input(INPUT_POST, 'km_verify_code_type', FILTER_SANITIZE_STRING);

        if ($otpType == 'email') {
            $isSent = fieldday()->api->LoginResendOtpEmail($login_token, 'true');
        } else {
            $isSent = fieldday()->api->LoginResendOtpEmail($login_token, 'false');
        }

        if ($isSent->success && $isSent->statusCode == 211) {
            wp_send_json(['status' => 'success', 'message' => __("Verification Code Sent.", 'fieldday'), 'logs' => $isSent->data]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __("failed to send verification code.", 'fieldday'), 'logs' => $isSent]);
        }
    }

    /**
     * update user phone and resend verification code
     */
    public function UpdatePhone()
    {
        $PhoneCode = filter_input(INPUT_POST, 'new_user_country', FILTER_SANITIZE_STRING);
        $Phone = filter_input(INPUT_POST, 'new_user_phone', FILTER_SANITIZE_STRING);
        $access_token = filter_input(INPUT_POST, 'access_token', FILTER_SANITIZE_STRING);
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
        $isSent = fieldday()->api->ResendOtp($PhoneCode, $Phone, $access_token);

        if ($isSent->success && $isSent->statusCode == 211) {
            $UserDetail = fieldday()->api->getUser($user_id, $access_token);
            $UserDetail->data->accessToken = $access_token;
            $verificationView = fieldday()->engine->getView('verification', ['user' => $UserDetail]);
            wp_send_json(['status' => 'success', 'message' => __("Verification Code Sent.", 'fieldday'), 'content' => $verificationView, 'logs' => $UserDetail->data]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($isSent->message, 'fieldday'), 'logs' => $isSent]);
        }
    }

    /**
     * get the school information track and trade
     * @return Json
     */
    public function getSchoolInfo()
    {
        $schoolId = filter_input(INPUT_POST, 'schoolId', FILTER_SANITIZE_STRING);
        if (!$schoolId) {
            wp_send_json(['status' => 'fail', 'message' => __("please select a valid school.", 'fieldday')]);
        }
        $SchoolInfo = fieldday()->api->getSchoolInfo($schoolId);
        if ($SchoolInfo->statusCode !== 200) {
            wp_send_json(['status' => 'fail', 'message' => __($SchoolInfo->message, 'fieldday'), 'logs' => $SchoolInfo]);
        }

        wp_send_json(['status' => 'success', 'schools' => $SchoolInfo->data]);
    }

    /**
     * display the merchandise form in popup
     *
     * @return JSON json response
     */
    public function merchandiseForm()
    {
        $offerId = filter_input(INPUT_POST, 'offerId', FILTER_SANITIZE_STRING);
        $offername = filter_input(INPUT_POST, 'offername', FILTER_SANITIZE_STRING);
        if (!$KmUser) {$_SESSION['typeofuser'] = 'guest';} else {unset($_SESSION['typeofuser']);}
        if (!$offerId) {
            wp_send_json(['status' => 'fail', 'message' => __("please select a valid offer.", 'fieldday')]);
        }

        $header = $offername;
        $content = fieldday()->engine->getView('merchandise_form', ['offerid' => $offerId]);
        $footer = wp_sprintf("<button id='km_purchase_merchandise_pc' class='km_btn purchase_merchandise km_primary_bg  km_btn_i_wrapper'><i class='km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin'></i>%s</button>", __('Purchase', 'fieldday'));
        $modalClass = fieldday()->engine->isKmLogin() ? 'modal-large km_user_login' : 'modal-large';
        wp_send_json(['status' => 'success', 'content' => $content, 'header' => $header, 'footer' => $footer, 'modalclass' => $modalClass]);
    }

    public function merchandiseProcess()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($postdata) {
            unset($postdata['permalink'], $postdata['_wpnonce'], $postdata['action']);
            unset($postdata['km_terms_condition']);
            $purchaseResponse = fieldday()->api->purchaseShoppingPackage($postdata);
            if ($purchaseResponse->statusCode === 201) {
                $content = fieldday()->engine->getView('checkout/merchandise_thanks', ['order' => $purchaseResponse->data]);

                wp_send_json(['status' => 'success', 'content' => $content, 'header' => "", 'footer' => ""]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __($purchaseResponse->message), 'logs' => $purchaseResponse]);
            }
        }
    }

    /**
     * update parent insurance
     *
     * @return JSON json response on api call
     */
    public function updateInsurance()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!isset($postdata['insurance']['medInsurance'])) {
            $postdata['insurance']['medInsurance']['isAvailable'] = false;
        }
        if (!isset($postdata['insurance']['dentalInsurance'])) {
            $postdata['insurance']['dentalInsurance']['isAvailable'] = false;
        }
        $insuranceUpdate = fieldday()->api->UpdateInsurance($postdata['insurance']);
        if ($insuranceUpdate->statusCode === 201) {
            wp_send_json(['status' => 'success', 'message' => __($insuranceUpdate->message, 'fieldday')]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __($insuranceUpdate->message, 'fieldday'), 'logs' => $insuranceUpdate]);
        }
    }

    /**
     * update kid information
     *
     * return JSON response
     */
    public function UpdateKid()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $kidId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        unset($postdata['action'], $postdata['permalink'], $postdata['_wpnonce'], $postdata['id']);
        if ($_FILES["kidProfilePic"]['tmp_name'] != '') {
            $postdata['file'] = [
                "path" => $_FILES['kidProfilePic']['tmp_name'],
                "type" => $_FILES['kidProfilePic']['type'],
                "name" => 'file',
            ];
            $updateKid = fieldday()->api->UpdateKidProfile($kidId, $postdata);
        } else {
            $updateKid = fieldday()->api->UpdateKidProfile($kidId, $postdata);
        }
        if ($updateKid->statusCode == 200) {
            $response = ['status' => 'success', 'message' => __($updateKid->message, 'fieldday')];
        } else {
            $response = ['status' => 'fail', 'message' => $updateKid->message, 'log' => $updateKid];
        }
        wp_send_json($response);
    }

    /**
     * get single session information
     *
     * @return Json response from API
     */
    public function singleSessionDetail()
    {
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $sessiontype = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($sessionId) {
            $sessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);

            if ($sessionInfo->statusCode === 200) {
                $session = $sessionInfo->data;
                $header = wp_sprintf("<span style='%s'>%s</span>", isset($session->activityId->colorHex) ? 'color: #' . $session->activityId->colorHex : '', $sessionInfo->data->name);
                $header = $sessionInfo->data->name;

                $content = fieldday()->engine->getview('session_detail', ['session' => $session, 'tags' => fieldday()->engine->getValue('tags', $postdata, false), 'sessiontype' => $sessiontype]);

                wp_send_json(['status' => 'success', 'content' => $content, 'header' => $header, 'footer' => ""]);
            } else {
                wp_send_json(['status' => 'error', 'message' => $sessionInfo->message]);
            }
        }
    }

    public function sessionBookingOptions()
    {
        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($sessionId) {
            $sessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);
            if ($sessionInfo->statusCode === 200) {
                $session = $sessionInfo->data;
                $header = $sessionInfo->data->name;
                $content = fieldday()->engine->sessionBookingTypes($session, $postdata['tags']);
                wp_send_json(['status' => 'success', 'content' => $content, 'header' => $header, 'footer' => ""]);
            } else {
                wp_send_json(['status' => 'error', 'message' => $sessionInfo->message]);
            }
        }
    }

    /**
     * delete a kid from fieldday
     *
     * @return JSON json response from fieldday
     */
    public function deleteKid()
    {
        $kidId = filter_input(INPUT_POST, 'kidId', FILTER_SANITIZE_STRING);
        if (!$kidId) {
            wp_send_json(['status' => 'fail', 'message' => __("please select a kid to delete")]);
        }

        $apiResponse = fieldday()->api->DeleteKidProfile($kidId);
        if ($apiResponse->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => $apiResponse->message]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $apiResponse->message, 'log' => $apiResponse]);
        }
    }

    public function saveKidForms()
    {
        $kidId = filter_input(INPUT_POST, 'kidId', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!$kidId) {
            wp_send_json(['status' => 'fail', 'message' => __("please select a kid to save")]);
        }

        $apiResponse = fieldday()->api->SaveMedicalForms(['kidId' => $kidId, 'forms' => $postdata['forms']]);
        if ($apiResponse->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => $apiResponse->message]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $apiResponse->message, 'log' => $apiResponse]);
        }
    }

    /**
     * check the store credit of user
     */
    public function checkStoreCredit()
    {
        $storeCredit = fieldday()->api->getUserProviderCreditSummary();
        //$storeCredit = fieldday()->api->getUserStoreCredit();
        $this->__savelogs("Purchase step: checking Store credit", $storeCredit);
        if ($storeCredit->statusCode != 200) {
            wp_send_json(['status' => 'fail', 'message' => __("failed to get store credits", 'fieldday'), 'logs' => $storeCredit]);
        }

        if ($storeCredit->data) {
            $dollarCredit = $daycredit = false;
            foreach ($storeCredit->data as $data) {
                if (array_key_exists("remainingCredits", $data)) {
                    $dollarCredit = $data;
                } elseif (array_key_exists("remainingDaysCount", $data)) {
                    $daycredit = $data;
                }
            }
            /* check if has dollar credit */
            if ($dollarCredit && $dollarCredit->remainingCredits > 0) {
                $remainingDollarCount = $dollarCredit->remainingCredits;
                $header = apply_filters('km_dollarcredit_title', __('You have Dollar credit'), $dollarCredit);

                $message = wp_sprintf(__('Your account has a balance of <b>%d</b> store credit. Are you interested in using these for this order?', 'fieldday'), $remainingDollarCount);
                $content = apply_filters('km_dollarcredit_text', $message, $dollarCredit);

                $footer = wp_sprintf("<button class='km_btn decline_store_credit km_primary_color  km_transparent_bg'>%s</button>", __('No', 'fieldday'));
                $footer .= wp_sprintf("<button data-credit-id='%s' class='km_btn apply_store_credit km_primary_bg'>%s</button>", $dollarCredit->_id, __('Yes', 'fieldday'));

                wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => $footer]);
            } else if ($daycredit && !$dollarCredit && $daycredit->remainingDaysCount > 0) {
                $sessionDays = $this->_calculateSessionDays();
                $remainingDaysCount = $daycredit->remainingDaysCount;
                if ($remainingDaysCount >= $sessionDays) {
                    $header = apply_filters('km_daycredit_title', __('You have Bank Days'), $daycredit);
                    $message = wp_sprintf(__('There are <b>%d</b> store credit bank days available to you. Would you like to use these to place this order?', 'fieldday'), $remainingDaysCount);
                    $content = apply_filters('km_daycredit_text', $message, $daycredit);

                    $footer = wp_sprintf("<button class='km_btn decline_store_credit km_primary_color  km_transparent_bg'>%s</button>", __('No', 'fieldday'));

                    $footer .= wp_sprintf("<button data-credit-id='%s' class='km_btn apply_store_credit km_primary_bg'>%s</button>", $daycredit->_id, __('Yes', 'fieldday'));

                    wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => $footer]);
                } else {
                    $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $PaymentOptions = $this->getPaymentOptions($postdata);
                    if ($PaymentOptions) {
                        $header = apply_filters('km_daycredit_title', __('You have Day credit'), $daycredit);
                        $message = wp_sprintf(__('The number of day credits you have is <b>%d</b>. Here are the options for booking this and utilizing your credit days.', 'fieldday'), $remainingDaysCount);
                        $content = apply_filters('km_daycredit_text', $message, $daycredit);
                        $index = 0;
                        foreach ($PaymentOptions as $key => $PaymentOption) {
                            $selected = $index == 0 ? "checked" : "";
                            $content .= wp_sprintf('<label class="km_radio_wrap">
                                <span class="km_radio_text">%s</span>
                                <input %s data-credit-type="%s" class="manual_store_credit_paid" name="manualStoreCreditPaid" value="%s" type="radio">
                                <span class="km_radio"></span>
                            </label>', $PaymentOption->description, $selected, $PaymentOption->type, $PaymentOption->apply);
                            $index++;
                        }

                        $footer = wp_sprintf("<button class='km_btn decline_store_credit km_primary_color  km_transparent_bg'>%s</button>", __('No', 'fieldday'));
                        $footer .= wp_sprintf("<button data-credit-id='%s' class='km_btn apply_store_credit km_primary_bg'>%s</button>", $daycredit->_id, __('Yes', 'fieldday'));
                        wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => $footer]);
                    } else {
                        wp_send_json(['status' => 'nostorecredit', 'message' => __("No store credit in your account", 'fieldday'), 'logs' => $PaymentOptions]);
                    }
                }
            }
        } else {
            wp_send_json(['status' => 'nostorecredit', 'message' => __("No store credit in your account", 'fieldday'), 'logs' => $storeCredit]);
        }
    }

    /**
     * get the available payment options with partial day credit
     * @param array $postData
     * @return mixed
     */
    private function getPaymentOptions($postData)
    {
        global $fielddaySetting;global $KmUser;
        $apiData = [];
        $cartDetails = fieldday()->engine->GetCartData(true);
        $apiData['providerId'] = $cartDetails->providerId;
        $apiData['cartId'] = $cartDetails->_id;
        $PaymentOptions = fieldday()->api->PaymentOptions($apiData);
        if ($PaymentOptions->statusCode === 201) {
            foreach ($PaymentOptions->data as $index => $paymentoption) {
                if ($paymentoption->type == 'siblingDiscount') {
                    unset($PaymentOptions->data[$index]);
                }
            }

            return $PaymentOptions->data;
        }

        return false;
    }

    /**
     * get the session days
     * @return Int session days
     */
    private function _calculateSessionDays()
    {
        $cartdata = fieldday()->engine->GetCartData();
        $sessionDays = 0;
        if (!empty($cartdata)) {
            foreach ($cartdata as $cartItem) {
                //$session = $cartItem['session_detail'];
                $kidsCount = count($cartItem->kidId);
                /* if session is added only for one day */
                if (fieldday()->engine->getValue('addedForOneDayOnly', $cartItem, false)) {
                    $sessionDays = $sessionDays + (1 * $kidsCount);
                } else {
                    $sessionWorkingDays = $cartItem->daysOfWeek;
                    $sessionStartDate = $cartItem->dateTimestamp->from;
                    $sessionEndDate = $cartItem->dateTimestamp->to;
                    $sessesionOccuranceDays = $this->_dateDiffInDays($sessionStartDate, $sessionEndDate, $sessionWorkingDays);
                    $sessionDays = $sessionDays + ($sessesionOccuranceDays * $kidsCount);
                }
            }
        }
        return $sessionDays;
    }

    /**
     *
     * @param string $date1
     * @param string $date2
     * @param array $workingDays working days number i.e [0,1,3,4,5,6]
     * @return Int
     */
    private function _dateDiffInDays($date1, $date2, $workingDays = [])
    {
        // Declare an empty array
        $days = 0;

        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($date2);
        //$realEnd->add($interval);

        $period = new DatePeriod(new DateTime($date1), $interval, $realEnd);
        $totaldays = iterator_count($period);
        if ($totaldays > 1000) {
            return false;
        }

        // Use loop to store date into array
        foreach ($period as $date) {
            $daynumber = $date->format('w');
            if (in_array($daynumber, $workingDays)) {
                $days++;
            }
        }

        // Return the array elements
        return $days;
    }

    /**
     * redirect the user if on login page and already loggedin
     */
    public function KmLoginRedirect()
    {
        global $post;
        global $KmUser;
        $redirectpage = fieldday()->engine->LoginRedirect();
        if (is_user_logged_in() && has_shortcode($post->post_content, 'fieldday_login') && current_user_can(fieldday_ROLE) && $redirectpage && $KmUser) {

            wp_redirect($redirectpage);
            die;
        }
    }

    /**
     * get menu data to display after login
     *
     * @return json standard json response
     */
    public function getMenuData()
    {
        global $fielddaySetting;
        $selectedMenuId = fieldday()->engine->getValue('user_menu', $fielddaySetting, false);
        if ($selectedMenuId) {
            $menu = wp_get_nav_menu_object($selectedMenuId);
            if ($menu) {
                $menuIdInhtml = wp_sprintf('menu-%s', $menu->slug);
                $html = fieldday()->engine->UserInMenuHtml();
                $afterloginscript = apply_filters('fieldday_after_login', '');
                wp_send_json(['status' => 'success', 'slug' => $menu->slug, 'menuId' => $menuIdInhtml, 'html' => $html, 'afterLoginScript' => $afterloginscript]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => __('invalid menu selected', 'fieldday')]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => __('no menu selected', 'fieldday')]);
        }
    }

    public function displayClaimForm()
    {
        $header = __("Claim your Credit", 'fieldday');
        $content = fieldday()->engine->getView('account/claimform');
        wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => ""]);
    }

    /**
     * claim store credit through coupon code
     */
    public function claimCredit()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $response = fieldday()->api->clamimCoupon($postdata);
        if ($response->statusCode != 201) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        }

        wp_send_json(['status' => 'success', 'message' => $response->message]);
    }

    /**
     * Display terms and conditions
     */
    public function displayProviderTerms()
    {
        $response = fieldday()->api->getActivityProviderTerms([]);
        $header = __("Terms & Conditions", 'fieldday');
        $content = "<div class='km_tersms_condition_wrap'>";
        $unchecked = apply_filters('fieldday_uncheck_conditions', [1, 2, count($response->data)], $response->data);
        if ($response->statusCode == 200) {
            foreach ($response->data as $key => $termData) {
                $number = $key + 1;
                $icon = "<i class='fa fa-check km_primary_color'></i>";
                if (in_array($number, $unchecked)) {
                    $icon = "<i style='visibility:hidden;' class='fa fa-check km_primary_color'></i>";
                }

                $content .= wp_sprintf("<div class='km_single_term'>%s<p>%s</p></div>", $icon, $termData->termId->text);
            }
        }
        $content .= "</div>";

        wp_send_json(['status' => 'success', 'header' => $header, 'content' => $content, 'footer' => ""]);
    }

    /**
     * process prarent information
     */

    public function processParentInfo()
    {
        $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($Data['parent']['name']) {$Data['parent']['name'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['name']);}
        if ($Data['parent']['guestEmail']) {$Data['parent']['guestEmail'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['guestEmail']);}
        if ($Data['parent']['gender']) {$Data['parent']['gender'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['gender']);}
        if ($Data['parent']['countryCode']) {$Data['parent']['countryCode'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['countryCode']);}
        if ($Data['parent']['phone']) {$Data['parent']['phone'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['phone']);}
        if ($Data['parent']['maritalStatus']) {$Data['parent']['maritalStatus'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $Data['parent']['maritalStatus']);}
        $message = "First step checkout: parent Information";
        $data = $Data['parent'];
        $this->__savelogs($message, $data);
    }

    public function processStripe()
    {
        $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $message = "mpmstp checkout: beautiful";
        $this->__savelogs($message, $Data);
    }

    /**
     *
     * @global array $fielddaySetting
     * @global type $KmUser
     * @param string $message
     * @param mixed $data
     * @return boolean
     */
    private function __savelogs($message, $data)
    {
        global $fielddaySetting;
        if (fieldday()->engine->getValue('fieldday_debug_mode', $fielddaySetting, false) !== 'enabled') {
            return false;
        }

        global $KmUser;
        if (!is_dir(fieldday_ABSPATH . "/logs/")) {
            mkdir(fieldday_ABSPATH . "/logs/", 0777);
        }
        /* check the security */
        if (!file_exists(fieldday_ABSPATH . "/logs/.htaccess")) {
            file_put_contents(fieldday_ABSPATH . "/logs/.htaccess", 'Options -Indexes
                deny from all');
        }
        if ($KmUser) {
            $logFile = fieldday_ABSPATH . "/logs/" . $KmUser->email . ".logs";
        } else {
            $logFile = fieldday_ABSPATH . "/logs/guestuserlogs.logs";
        }

        if (!file_exists($logFile)) {
            file_put_contents($logFile, 'adding logs for user');
        }
        $content = file_get_contents($logFile);
        $content .= "######### \n";
        $content .= $message . "\n";
        $content .= json_encode($data) . "\n";
        file_put_contents($logFile, $content);
    }

    public function calenderevents()
    {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $mobiledata = $_POST['mobiledata'];

        if ($mobiledata) {
            $start = date("m-d-Y 23:59:59");
            $end = $_POST['end'];
        } else {
            $current_date = date("m-d-Y 23:59:59");
            if ($start < $current_date) {
                $start = $current_date;
            }
        }
        $eventdata = array();
        global $fielddaySetting;

        $queryParams['offset'] = $fielddaySetting['offset'];

        $datefilter = array("fromDate" => $start,
            "toDate" => $end,
        );
        $datefilterjson = json_encode($datefilter);
        $queryParams['filters'] = $datefilterjson;

        if ($filters) {
            $queryParams['filters'] = $filters;
        }

        $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);
        foreach ($sessions->data->sessions as $counter => $mySession) {
            //foreach ($session->sessions as $counter => $mySession) {
                $starts = date("Y-m-d", strtotime($mySession->dateTimestamp->from));
                //$ends=date("Y-m-d", strtotime($mySession->dateTimestamp->to .'+12 hours'));
                $ends = date("Y-m-d", strtotime($mySession->dateTimestamp->to));
                $mySession->dateTimestamp->from;
                $days = fieldday()->engine->eventDays($mySession);
                $event = array('id' => $mySession->_id,
                    'title' => $mySession->name,
                    'title_color' => isset($mySession->activityId->colorHex) ? $mySession->activityId->colorHex : null,
                    'start' => $starts,
                    'starttimestamp' => $mySession->dateTimestamp->from,
                    'endtimestamp' => $mySession->dateTimestamp->to,
                    'end' => $ends,
                    'end_fulldate' => $mySession->dateTimestamp->to,
                    'start_fulldate' => $mySession->dateTimestamp->from,
                    'days' => $days);

                array_push($eventdata, $event);
            //}
        }

        echo json_encode($eventdata);
        exit;
    }

    /*featuresessions*/
    public function registerSessionTiming()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $activityTags = fieldday()->api->getActivityTagsCount();
        $sessiondates = array();
        $sessionId = '';
        $sessionfeatured = '';
        $tagId;
        $singleSession;
        $sessionType;
        if (isset($postdata) && $postdata['action'] == 'km_registerSessionTiming') {
            $sessionId = fieldday()->engine->getValue('session_id', $postdata, false);
            $tagId = fieldday()->engine->getValue('tagId', $postdata, false);
            $sessionfeatured = fieldday()->engine->getValue('sessionfeatured', $postdata, false);
            $session_date = fieldday()->engine->getValue('session_date', $postdata, false);
        } elseif (isset($postdata) && $postdata['action'] == 'km_display_cartform') {
            $sessionId = fieldday()->engine->getValue('sessionId', $postdata, false);
            $session_date = fieldday()->engine->getValue('sessionDate', $postdata, false);
            $tagId = fieldday()->engine->getValue('tagId', $postdata, false);
        }
        global $fielddaySetting;

        $queryParams['offset'] = $fielddaySetting['offset'];

        if ($sessionId) {
            $queryParams['filters']['sessionId'] = $sessionId;
        }
        foreach ($activityTags->data as $key => $tags) {
            if ($tagId) {
                $queryParams['tagId'] = $tagId;

                if ($tags->title == "One Day Only") {
                    $singleSession = $tags->title;
                } else {
                    $sessionType = $tags->title;
                }
            }
        }

        $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);

        $content;
        $content .= "<div class='registertimecsection'>
                    <div class='registertimecantainer'>";
        foreach ($sessions->data->sessions as $counter => $mySession):
            //foreach ($session->sessions as $counter => $mySession) {
                $sessionDateToFilter = $mySession->dateTimestamp->to;
                $sessiontitle = $mySession->name;
                $sessionId = $mySession->_id;
                $sessiontagId = $tagId;
                $featuresessions = "feature-purchase";
                $sessiondates = json_decode(json_encode($mySession->oneDaySeats), true);

                $tagArray = fieldday()->engine->sessionBookingTypesLable($mySession, $sessiontagId, true);

                foreach ($activityTags->data as $key => $tags) {
                    if ($sessiontagId) {

                        $sessionType = $tags->title;

                    }
                }

            //}
        endforeach;

        //$content .= '<h3 class="km_login_m_title">' . $sessiontitle . '</h3>';
        $content .= '<div class="singleitemmain">';
        if (in_array($singleSession, $tagArray)) {

            //$content .= '<span class="km_login_m_title"> The package can either be purchased as a drop-in service (for individual sessions) or as a total package. A total of  '. sizeof($sessiondates) .' sessions for the '. $sessiontitle .' '. implode(" / ",$tagArray) . '  This session starts on '. date("d M Y", strtotime($mySession->dateTimestamp->from)) . '</span>';
            $content .= '<span class="km_login_m_title"> Available Sessions ' . date("d M Y", strtotime($mySession->dateTimestamp->from)) . ' - ' . date("d M Y", strtotime($mySession->dateTimestamp->to)) . '</span>';
            $content .= '<div class="km_session_single_item km_fullweeksession"
               data-time-stamp-from="' . $mySession->dateTimestamp->from . '"
               data-time-stamp-to="' . $mySession->dateTimestamp->to . '"></div>';
            foreach ($sessiondates as $dates => $val) {
                $date = str_replace('-', '/', $dates);
                $newdates = date('d M Y', strtotime($date));
                $content .= '<div class="km_session_single_item"
                    data-time-stamp-from="' . $mySession->dateTimestamp->from . '"
                    data-time-stamp-to="' . $mySession->dateTimestamp->to . '">';
                $content .= '<input type="checkbox" name="sessionDate[]"  data-session-id="' . $sessionId . '" data-session-tag="' . $sessiontagId . '" data-session-featured="' . $featuresessions . '" id="cb1" value="' . $dates . '" /><label for="cb1">' . $newdates . '<br></label>';
                $content .= '</div>';
            }
        } else {
            $content .= '<span class="km_login_m_title"> This package includes a total of ' . sizeof($sessiondates) . ' sessions for the ' . $sessiontitle . ' ' . $sessionType . '. This session starts on ' . date("d M Y", strtotime($mySession->dateTimestamp->from)) . '.</span>';
            $content .= '<div class="km_session_single_item km_fullweeksession"
                  data-time-stamp-from="' . $mySession->dateTimestamp->from . '"
                  data-time-stamp-to="' . $mySession->dateTimestamp->to . '"><input type="checkbox" name="sessionDate[]"   data-sessionfullweek="true" data-session-id="' . $sessionId . '" data-session-tag="' . $sessiontagId . '" data-session-featured="" id="cb1" value="" /></div>';
            foreach ($sessiondates as $dates => $val) {
                $date = str_replace('-', '/', $dates);
                $newdates = date('d M Y', strtotime($date));
                $content .= '<div class="km_session_single_item"
                      data-time-stamp-from="' . $mySession->dateTimestamp->from . '"
                      data-time-stamp-to="' . $mySession->dateTimestamp->to . '">';
                $content .= '<label for="cb1">' . $newdates . '<br></label>';
                $content .= '</div>';
            }

        }

        $content .= '</div>';
        $content .= '<div class="km_col_12"><a href="JavaScript:void(0);" id="sessiontimenext" class="km_btn km_session_btn km_primary_bg" >Next</a></div>
        </div>
        </div> ';
        $content .= "</div></div>";
        wp_send_json(['status' => 'success', 'header' => '', 'content' => $content, 'footer' => ""]);
        exit;
    }

    /* Membership */

    public function savemebershipCartitmes()
    {
        global $KmUser;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (array_key_exists('membershipid', $postdata)) {
            $membershipid = fieldday()->engine->getValue('membershipid', $postdata, false);
            $membershipprice = fieldday()->engine->getValue('membershipprice', $postdata, false);
            $providerId = fieldday()->engine->getValue('providerId', $postdata, false);
            $title = fieldday()->engine->getValue('title', $postdata, false);
            $loggedInemail = fieldday()->engine->getValue('email', $KmUser, false);
            $loggedInphone = fieldday()->engine->getValue('phone', $KmUser, false);
            $finalPrice = fieldday()->engine->display_price($membershipprice);
            //$saveCard=_e('Save Card','fieldday');
        }
        $content;
        $content .= wp_sprintf("<div class='km_membership_purchase_model'>");
        $content .= wp_sprintf("<div class='km_membership_purchase_content'>");
        $heading .= wp_sprintf("%s (%s)", $title, $finalPrice);
        //$content.=wp_sprintf("<span class='km_mermbership_price purchase_model'>%s</span>", $finalPrice);
        $content .= wp_sprintf("<div class='km_col_12 km_membership_input_wrap'><div class='membership_input_wrap'><span for='email'>Email<br>
       <input type='text' value='%s' name='parent[email]' value=''  required=''/></span>", $loggedInemail);
        $content .= wp_sprintf("<span for='phone'>Phone<input type='text' value='%s' id='parent_phone'  name='parent[phone]' value=''  required=''/></span></div></div>", $loggedInphone);
        $content .= fieldday()->engine->getView('merchandise_form');
        $content .= wp_sprintf("<div class='membership_input_wrap'><span class='savecheckbox'><input type='checkbox' class='savecardcheck' value='true' name='savecard' value='' />%s</span></div>", 'Save Card');
        $content .= wp_sprintf('<a href="javascript:void(0);"  data-purchasecount="1" data-membershipid="%s" data-paymentmethod="card"  class="km_btn membership_purchase_button km_primary_bg">Pay %s</a>', $membershipid, $finalPrice);
        $content .= "</div>";
        $content .= "</div>";
        wp_send_json(['status' => 'success', 'header' => $heading, 'content' => $content, 'footer' => ""]);
        exit;
    }

    public function membershipPurchase()
    {

        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $apiPostData = [];
        if (array_key_exists('membershipid', $postdata)) {
            $membershipid = fieldday()->engine->getValue('membershipid', $postdata, false);
            $paymentmethod = fieldday()->engine->getValue('paymentmethod', $postdata, false);
            $purchaseCount = fieldday()->engine->getValue('purchasecount', $postdata, false);
            $stripeToken = fieldday()->engine->getValue('stripeToken', $postdata, false);
            $saveCard = fieldday()->engine->getValue('savecard', $postdata, false);

            if (!$savecard) {
                $saveCard = 'false';
            }

            $apiPostData['membershipId'] = $membershipid;
            $apiPostData['paymentMethod'] = $paymentmethod;
            $apiPostData['purchaseCount'] = $purchaseCount;
            $apiPostData['stripeToken'] = $stripeToken;
            $apiPostData['saveCard'] = $saveCard;
        }

        $response = fieldday()->api->membershipSubscriptionPurchase($apiPostData);
        if ($response->statusCode != 201) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        }

        wp_send_json(['status' => 'success', 'message' => $response->message]);
        exit;
    }

    /* Package */

    public function packagePurchase()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $packageid = $postdata['ATC']['package_id'];
        $sessionid = $postdata['ATC']['session_id'];
        $kidsarray = $postdata['ATC']['kids'];
        $apiPostData = [];
        $kids_ids = array();
        if ($packageid) {
            $purchaseCount = fieldday()->engine->getValue('kidscount', $postdata, false);
            $cardId = $postdata['ATC']['cardId'];
            $selectedOption = $postdata['ATC']['prices'];
            $paymentmethod = $postdata['ATC']['paymentmethod'];
            $stripeToken = $postdata['ATC']['stripeToken'];
            $saveCard = $postdata['ATC']['savecard'];
            if (!$saveCard) {
                $saveCard = 'true';
            }
        }
        if ($purchaseCount > 0) {
            foreach ($kidsarray as $key => $value) {
                array_push($kids_ids, $value['_id']);
            }
            $apiPostData['sessionId'] = $sessionid;
            $apiPostData['offset'] = 0;
            $apiPostData['kids'] = $kids_ids;
            if ($cardId) {$apiPostData['cardId'] = $cardId;}
            $apiPostData['saveCard'] = $saveCard;
            $apiPostData['stripeToken'] = $stripeToken;
            $apiPostData['paymentMethod'] = $paymentmethod;
            $apiPostData['selectedOption'] = $selectedOption;
            /*if ($packageid)
            {
            $apiPostData['packageId'] = $packageid;
            $apiPostData['offset'] = 0;
            if($cardId){ $apiPostData['cardId'] = $cardId; }
            $apiPostData['paymentMethod'] = $paymentmethod;
            $apiPostData['purchaseCount'] = $purchaseCount;
            $apiPostData['stripeToken'] = $stripeToken;
            $apiPostData['saveCard'] = $saveCard;
            }*/
            $response = fieldday()->api->PackagePurchase($apiPostData);
            if ($response->statusCode != 201) {
                wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
            }
            wp_send_json(['status' => 'success', 'message' => $response->message]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => __("Please select any participants", 'fieldday')]);
        }
        exit;

    }
    /*Get the Extended care and extra options*/
    public function sessions_extradata()
    {
        $html_additional = '';
        $html = '';
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionId = $postdata['ATC']['session_id'];
        $bookingoption = $postdata['ATC']['bookingoption_selection'];
        $ATCdata = filter_input(INPUT_POST, 'ATC', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $dropindates = $ATCdata['dropindates'];
        $dropindates = json_decode($dropindates);
        $singlesessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);
        $session = $singlesessionInfo->data;
        $session_type = fieldday()->engine->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
        $datespicked = $bookingoption . 'Dates';
        $Onedaydates = $session->$datespicked;
        if ($bookingoption == 'fullcamp') {
            $extendedCareDetails = $session->extendedCareDetails;
            $additionalCharges = $session->additionalCharges;
            $priceforAllkids = '/seat';
            $isCare = (isset($extendedCareDetails->afterCare) || isset($extendedCareDetails->earlyCare) || isset($extendedCareDetails->combined)) ? true : false;
            if (!empty($extendedCareDetails) && $isCare):
                if (fieldday()->engine->getvalue('isAvailable', $extendedCareDetails, false)):
                    $html = '<h3 class="km_primary_color">' . __("Elevate Your Experience with these Add-Ons", "fieldday") . '</h3>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										            <div class="km_additionalcharges_wrap">';
                    foreach ($extendedCareDetails as $chargetype => $charges):
                        /*if ($chargetype == 'afterCare'):
                        $html .='<label class="km_radio_wrap km_radio_wrap_care extendcare_selection">
                        <span class="km_radio_text">'.fieldday()->engine->extendedCareTypes($chargetype).'
                        <span class="km_cartsession_price km_FullSessionextendedPrice km_primary_color">'.fieldday()->engine->display_price($charges->pricePerSession).$priceforAllkids.'</span><span class="km_hidden km_cartsession_price km_primary_color km_perDayextendedPrice">'.fieldday()->engine->display_price($charges->pricePerDay).'/day</span></span><span class="days km_service_days km_text_green">'.fieldday()->engine->sessionServiceDays($session_type).'</span>
                        <input class="km_purchasefield" data-text="'.fieldday()->engine->extendedCareTypes($chargetype).'" type="checkbox" data-price="'.$charges->pricePerSession.'" value="'.$chargetype.'" name="ATC[extendedCareSelected]" onclick="fieldday.radiobuttonevent(this, event)">
                        <span class="km_radio"></span></label>';
                        endif;*/
                        if ($chargetype == 'earlyCare' || $chargetype == 'afterCare' || $chargetype == 'combined'):
                            $html .= '<label class="km_checkbox_wrap km_checkbox_wrap_care">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                        <span class="km_radio_text">' . fieldday()->engine->extendedCareTypes($chargetype) . '
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                        <span class="km_cartsession_price km_FullSessionextendedPrice km_primary_color">' . fieldday()->engine->display_price($charges->price) . $priceforAllkids . '</span><span class="km_hidden km_cartsession_price km_primary_color km_perDayextendedPrice">' . fieldday()->engine->display_price($charges->pricePerDay) . '/day</span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                        </span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                        <span class="days km_service_days km_text_green">' . fieldday()->engine->sessionServiceDays($session_type) . '</span>

																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                        <input class="km_purchasefield" data-text="' . fieldday()->engine->extendedCareTypes($chargetype) . '" type="checkbox" data-price="' . $charges->price . '" value="' . $chargetype . '" name="ATC[extendedCareSelected][]"><span class="km_checkbox"></span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                    </label>';
                        endif;
                        /*if ($chargetype == 'combined'):
                    $html .='<label class="km_radio_wrap km_radio_wrap_care">
                    <span class="km_radio_text">'.fieldday()->engine->extendedCareTypes($chargetype).'
                    <span class="km_cartsession_price km_FullSessionextendedPrice km_primary_color">'.fieldday()->engine->display_price($charges->pricePerSession).$priceforAllkids.'</span><span class="km_hidden km_cartsession_price km_primary_color km_perDayextendedPrice">'.fieldday()->engine->display_price($charges->pricePerDay).'/day</span></span>
                    <span class="days km_service_days km_text_green">'.fieldday()->engine->sessionServiceDays($session_type).'</span>
                    <input class="km_purchasefield" data-text="'.fieldday()->engine->extendedCareTypes($chargetype).'" type="checkbox" data-price="'.$charges->pricePerSession.'" value="'.$chargetype.'" name="ATC[extendedCareSelected]" onclick="fieldday.radiobuttonevent(this, event)"><span class="km_radio"></span>
                    </label>';

                    endif;*/
                    endforeach;
                    $html .= '</div>';
                endif;
            endif;
            //Additional Charges
            if (!empty($additionalCharges)):
                $html_additional .= '<h3 class="km_primary_color">' . __("More Options", "fieldday") . '</h3>
																																																																																																																																																																																																																																																																					            <div class="additionalcharges_wrap">';
                foreach ($additionalCharges as $key => $product):
                    if (!isset($product->isAvailablefor) || isset($product->isAvailableFor->$session_type) && $product->isAvailableFor->$session_type):
                        $optionname = $product->_id;
                        $option_checked = '';
                        $mandatory_message = '';
                        if ($product->isMandatory == 1) {
                            $option_checked = 'checked disabled';
                            $mandatory_message = '<span class="km_mandatory">This option is mandatory to check </span>';
                        }

                        $html_additional .= '<label class="km_checkbox_wrap km_checkbox_wrap_care">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                            <span class="km_radio_text">' . $product->title . '<span class="km_cartsession_price km_primary_color">' . fieldday()->engine->display_price($product->price) . '</span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                            </span>' . $mandatory_message . '
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                            <input ' . $option_checked . ' data-parsley-required-message="Required" data-parsley-group="atc_field" class="km_purchasefield" data-text="' . $product->title . '" data-price="' . $product->price . '" value="' . $product->_id . '" type="checkbox" name="ATC[additionalChargeDetails][]">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                            <span class="km_checkbox"></span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                        </label>';
                    endif;
                endforeach;
                $html_additional .= '</div>';
            endif;

        } else { //oneday selected
            //$html .= '<h3 class="km_primary_color">'.__("Elevate Your Experience with these Add-Ons", "fieldday").'</h3>';
            //$html_additional .= '<h3 class="km_primary_color">'.__("More Options", "fieldday").'</h3>';
            $titleshow = 'false';
            $addtitle = 'false';
            foreach ($Onedaydates as $Onedaydate) {
                $oneDaySelectedDate = $Onedaydate->oneDaySelectedDate;
                $date_booked = date('m-d-Y', strtotime($oneDaySelectedDate));
                $date_booked_sel = str_replace("-", "", $date_booked);
                if (in_array($date_booked, $dropindates)) {
                    $extendedCareDetails = $Onedaydate->extendedCareDetails;
                    $additionalCharges = $Onedaydate->additionalCharges;
                    //echo "arrayvalue<br>";
                    $isCare = (isset($extendedCareDetails->afterCare) || isset($extendedCareDetails->earlyCare) || isset($extendedCareDetails->combined)) ? true : false;
                    if (!empty($extendedCareDetails) && $isCare):
                        if (fieldday()->engine->getvalue('isAvailable', $extendedCareDetails, false)):
                            if ($titleshow == 'false') {
                                $html .= '<h3 class="km_primary_color">' . __("Elevate Your Experience with these Add-Ons", "fieldday") . '</h3>';
                                $titleshow = 'true';
                            }
                            $html .= '<div class="km_additionalcharges_wrap">';
                            foreach ($extendedCareDetails as $chargetype => $charges):
                                if ($chargetype == 'earlyCare' || $chargetype == 'combined' || $chargetype == 'afterCare'):
                                    $html .= '<label class="km_checkbox_wrap km_checkbox_wrap_care">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                <span class="km_radio_text">' . fieldday()->engine->extendedCareTypes($chargetype) . '
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                <span class="km_cartsession_price km_primary_color km_perDayextendedPrice">' . fieldday()->engine->display_price($charges->price) . '/day</span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                </span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                <span class="days km_service_days km_text_green">' . $date_booked . '</span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                <input class="km_purchasefield" data-text="' . fieldday()->engine->extendedCareTypes($chargetype) . '" type="checkbox" data-price="' . $charges->price . '" value="' . $chargetype . '_' . $date_booked_sel . '" name="ATC[extendedCareSelected][]"><span class="km_checkbox"></span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                            </label>';
                                endif;
                            endforeach;
                            $html .= '</div>';
                        endif;
                    endif;
                    //Additional Charges
                    if (!empty($additionalCharges)):
                        if ($addtitle == 'false') {
                            $html_additional .= '<h3 class="km_primary_color">' . __("More Options", "fieldday") . '</h3>';
                            $addtitle = 'true';
                        }
                        $html_additional .= '<div class="additionalcharges_wrap">';
                        foreach ($additionalCharges as $key => $product):
                            if (!isset($product->isAvailablefor) || isset($product->isAvailableFor->$session_type) && $product->isAvailableFor->$session_type):
                                $option_checked = '';
                                $mandatory_message = '';
                                if ($product->isMandatory == 1) {
                                    $option_checked = 'checked disabled';
                                    $mandatory_message = '<span class="km_mandatory">This option is mandatory to check </span>';
                                }
                                $html_additional .= '<label class="km_checkbox_wrap km_checkbox_wrap_care">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                    <span class="km_radio_text">' . $product->title . '<span class="km_cartsession_price km_primary_color">' . fieldday()->engine->display_price($product->price) . '</span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                    </span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                    <span class="days km_service_days km_text_green">' . $date_booked . '</span>' . $mandatory_message . '
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                    <input ' . $option_checked . '  data-parsley-required-message="Required" data-parsley-group="atc_field" class="km_purchasefield" data-text="' . $product->title . '" data-price="' . $product->price . '" value="' . $product->_id . '_' . $date_booked_sel . '" type="checkbox" name="ATC[additionalChargeDetails][]">
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                    <span class="km_checkbox"></span>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															                </label>';
                            endif;
                        endforeach;
                        $html_additional .= '</div>';
                    endif;
                }
            }
        }

        wp_send_json(['status' => 'success', 'data' => $html, 'additionaldata' => $html_additional]);
        exit;

    }

    /*Event Prices*/
    public function eventPrices()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionid = $postdata['ATC']['session_id'];
        $session_date = $postdata['ATC']['session_date'][0];
        $event_discount = $postdata['ATC']['event_discount'];
        $eventpromocode = $postdata['eventpromocode'];
        $yeselected = $noselected = '';
        if ($event_discount) {
            if ($event_discount == 'yes') {$yeselected = 'checked';}
            if ($event_discount == 'no') {$noselected = 'checked';}
        } else { $noselected = 'checked';}

        $sessionId = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //print_r($session_date);
        /*$kidsarray = $postdata['ATC']['kids'];
        if ($sessionid)
        {
        $purchaseCount = fieldday()->engine->getValue('kidscount', $postdata, false);
        }*/
        $apirun = false;
        $apiPostData['eventId'] = $sessionid;
        if ($postdata['ATC']['infants'] > 0) {
            $apirun = true;
            $apiPostData['participants']['infants'] = $postdata['ATC']['infants'];
        }
        if ($postdata['ATC']['toddler'] > 0) {
            $apirun = true;
            $apiPostData['participants']['toddler'] = $postdata['ATC']['toddler'];
        }
        if ($postdata['ATC']['children'] > 0) {$apirun = true;
            $apiPostData['participants']['children'] = $postdata['ATC']['children'];}
        if ($postdata['ATC']['youth'] > 0) {$apirun = true;
            $apiPostData['participants']['youth'] = $postdata['ATC']['youth'];}
        if ($postdata['ATC']['adults'] > 0) {$apirun = true;
            $apiPostData['participants']['adults'] = $postdata['ATC']['adults'];}
        if ($postdata['ATC']['seniors'] > 0) {$apirun = true;
            $apiPostData['participants']['seniors'] = $postdata['ATC']['seniors'];}

        if ($event_discount == 'yes') {
            $apiPostData['applyMilitaryDiscount'] = 'true';
        }
        if ($eventpromocode) {
            $apiPostData['couponCode'] = $eventpromocode;
        }
        $apiPostData['selectedDate'] = $session_date;
        if ($apirun) {
            $response = fieldday()->api->EventsCalc($apiPostData);
            if ($response->statusCode != 201) {
                wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
            } else {
                $data = $response->data;
                $result = '';
                $summary = '';
                $isPrice = '';
                if ($data->totalPrice == 0) {
                    if (!$KmUser) {
                        $isPrice = 01;
                    } else {
                        $isPrice = 0;
                    }

                }

                //echo"<pre>"; print_r($data); echo"</pre>";
                $summary .= '<div class="km_summary_payment km_primary_color"><span class="">' . __("Payment due today", "fieldday") . '<span class="km_arrow_summary">(Click on arrow to see order details)</span></span><span>' . fieldday()->engine->display_price($data->totalPrice) . '<span class="km_more_summary"></span></span></div>';
                $summary .= '<div class="km_event_orderdetails km_hidden"><span class="km_primary_color">' . __("Order Details", "fieldday") . '</span>';
                if ($data->event->offersMilitaryDiscount) {
                    $result .= '<div class="km_event_discount"><h3 class="km_primary_color">' . __("Are You member of Military or First responders?", "fieldday");
                    //if($data->appliedMilitaryDiscount){
                    $result .= '<span class="km_subheading">Military and first responder discount - Please bring your ID card to show it to check-in agent</span>';
                    //}
                    $result .= '</h3><label class="km_radio_wrap km_radio_wrap_care"><span class="km_radio_text">No <input ' . $noselected . ' class="km_event_radio" type="radio" value="no" name="ATC[event_discount]"><span class="km_radio"></span></label><label class="km_radio_wrap km_radio_wrap_care"><span class="km_radio_text">Yes, I am <input ' . $yeselected . ' class="km_event_radio" type="radio" value="yes" name="ATC[event_discount]"><span class="km_radio"></span></label></div>';
                }
                $result .= '<div class="km_event_coupon"><h3 class="km_primary_color">' . __("Have a Promo Code?", "fieldday") . '</h3><div class="km_col_12 km_field_wrap"><input type="text" value="' . $eventpromocode . '" name="eventpromocode" value="" class="km_input"/><a href="javascript:void(0);" class="km_eventpromo_btn km_btn km_primary_bg">Apply</a></div></div>';

                $available_coupons = fieldday()->api->AvailableCoupons();
                if ($available_coupons->statusCode == 200) {
                    $coupons = $available_coupons->data;
                    if ($coupons) {
                        $result .= '<div id="km_avail_coupons" class="km_column_wrap km_col_12">
                            <h3 class="km_heading km_primary_color">' . __('Available Coupons', 'fieldday') . '</h3>
                            <ul>';
                        foreach ($coupons as $coupon) {
                            $percentagesymbol = $dollarsymbol = '';
                            $discountType = $coupon->discountType;
                            if ($discountType == 'percent') {$percentagesymbol = '%';}
                            if ($discountType == 'unit') {$dollarsymbol = '$';}
                            $expiryDate = fieldday()->engine->parseDate($coupon->expiryDate, 'd/M/Y');
                            $result .= '<li><h4>' . $coupon->title . '</h4><span class="km_coupon_percent">' . $dollarsymbol . $coupon->discount . $percentagesymbol . '</span><span class="km_coupon_valid">Valid until ' . $expiryDate . '</span></li>';
                        }
                        $result .= '</ul></div>';
                    }
                }

                $result .= '<div class="km_event_price"><h3 class="km_primary_color">' . __("Price Details:", "fieldday") . '</h3>';
                $result .= '<input type="hidden" class="event_price" name="ATC[event_price]" id="km_atc_event_price" value="' . fieldday()->engine->display_price($data->totalPrice) . '">';
                $result .= '<ul class="km_events_price">';
                $summary .= '<ul class="km_events_price">';
                foreach ($data->priceBreakup as $prices) {
                    //$result .='<li><span>'.fieldday()->engine->display_price($prices->seatPrice).' x '.$prices->seatCount.' '.$prices->key.'</span><span>'.fieldday()->engine->display_price($prices->subTotal).'</span></li>';
                    if ($prices->customGroupKey) {$grouptitle = $prices->customGroupKey;} else { $grouptitle = $prices->key;}
                    $summary .= '<li><span>' . $grouptitle . ' ' . $prices->seatCount . ' * ' . fieldday()->engine->display_price($prices->seatPrice) . '</span><span>' . fieldday()->engine->display_price($prices->subTotal) . '</span></li>';

                    $result .= '<li><span>' . $grouptitle . ' ' . $prices->seatCount . ' * ' . fieldday()->engine->display_price($prices->seatPrice) . '</span><span>' . fieldday()->engine->display_price($prices->subTotal) . '</span></li>';
                }

                if ($data->tax) {
                    $result .= '<li class="km_event_tax"><span>' . __("Tax", "fieldday") . '</span><span>' . fieldday()->engine->display_price($data->tax) . '</span></li>';
                    $summary .= '<li class="km_event_tax"><span>' . __("Tax", "fieldday") . '</span><span>' . fieldday()->engine->display_price($data->tax) . '</span></li>';
                }
                if ($data->totalFee) {
                    $result .= '<li class="km_event_tax"><span>' . __("Fee", "fieldday") . '<span class="km_process_fee">(Credit Card + Field Day Fee)</span></span><span>' . fieldday()->engine->display_price($data->totalFee) . '</span></li>';
                    $summary .= '<li class="km_event_tax"><span>' . __("Fee", "fieldday") . '<span class="km_process_fee">(Credit Card + Field Day Fee)</span></span><span>' . fieldday()->engine->display_price($data->totalFee) . '</span></li>';
                }
                if ($data->totalDiscount) {
                    $if_discount_applied = true;
                    $result .= '<li class="km_event_tax"><span>' . __("Discount", "fieldday") . '<span class="km_totaldiscount_text" >(' . $data->discountText . ')</span></span><span>' . fieldday()->engine->display_price($data->totalDiscount) . '<span class="km_remove_coupon_icon km_eventpromo_coupon_remove"><i class="fa fa-remove" style="font-size:48px;color:red"></i></span></span></li>';
                    $summary .= '<li class="km_event_tax"><span>' . __("Discount", "fieldday") . '<span class="km_totaldiscount_text" >(' . $data->discountText . ')</span></span><span>' . fieldday()->engine->display_price($data->totalDiscount) . '<span class="km_remove_coupon_icon km_eventpromo_coupon_remove"><i class="fa fa-remove" style="font-size:48px;color:red"></i></span></span></li>';
                } else {
                    $if_discount_applied = false;
                }
                /* if($data->isCouponApplied){
                $result .= '<li class="km_event_tax"><span>'.__("Coupon Discount", "fieldday").'</span><span>'.fieldday()->engine->display_price($data->couponDiscount).'</span></li>';
                $summary .= '<li class="km_event_tax"><span>'.__("Coupon Discount", "fieldday").'</span><span>'.fieldday()->engine->display_price($data->couponDiscount).'</span></li>';
                }*/

                $summary .= '</ul><div></div>';
                $result .= '</div><div class="km_events_total">' . __("Total: ", "fieldday") . '<span>' . fieldday()->engine->display_price($data->totalPrice) . '</span></div>';

                wp_send_json(['status' => 'success', 'if_discount_applied' => $if_discount_applied, 'message' => $response->message, 'data' => $result, 'isPrice' => $isPrice, 'summary' => $summary]);
                exit;
            }
        } else {wp_send_json(['status' => 'fail', 'message' => '', 'log' => $response, 'datablank' => 'true']);}

    }

    /**/
    public function SelfCheckIn()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ticketId = $postdata['ticketid'];
        $orderNo = $postdata['orderno'];
        $apidata['ticketid'] = $apiPostData['ticketId'] = $ticketId;
        $apidata['orderno'] = $apiPostData['orderNo'] = $orderNo;
        $apiPostData['offset'] = $fielddaySetting['offset']; //330;
        $response = fieldday()->api->SelfCheckIn($apiPostData);
        if ($response->statusCode === 201) {
            $ticketdetails = fieldday()->api->GetTicketDetail($apidata);
            if ($ticketdetails->statusCode === 200) {
                $content = fieldday()->engine->getView('checkout/self_checkin_success', ['ticketId' => $ticketId, 'ticketdata' => $ticketdetails->data]);
                wp_send_json(['status' => 'success', 'content' => $content]);
            }
        } else {
            wp_send_json(['status' => 'fail', 'message' => $response->message]);
        }
        exit;
    }

    /**/
    public function PullTicket()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ticket_email = $postdata['ticket_email'];
        $ticket_phone = $postdata['ticket_phone'];
        $countrycode = $postdata['user-country-code'];

        if ($ticket_email) {$apiPostData['email'] = $ticket_email;}
        if ($ticket_phone) {
            $apiPostData['countryCode'] = $countrycode;
            $apiPostData['phone'] = trim($ticket_phone);
        }
        $apiPostData['offset'] = $fielddaySetting['offset']; //330;
        $ticketdetails = fieldday()->api->PullTicketAPI($apiPostData);

        if ($ticketdetails->statusCode === 200) {
            $ticketid = $ticketdetails->data->booking->ticketId;
            $content = fieldday()->engine->getView('checkin', ['ticketid' => $ticketid, 'ticketdata' => $ticketdetails->data]);
            wp_send_json(['status' => 'success', 'content' => $content]);
        } else {
            $content = fieldday()->engine->getView('checkin', ['notfound' => 'true']);
            wp_send_json(['status' => 'success', 'content' => $content]);
        }
    }

    public function ContactForm()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $recatcha = fieldday()->engine->recaptchaVerify($token);
        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'message' => __('reCAPTCHA invalid')]);
        }
        $apiPostData = [];
        $apiPostData['firstName'] = $postdata['cont_name'];
        $apiPostData['lastName'] = $postdata['cont_lname'];
        $apiPostData['email'] = $postdata['cont_email'];
        $apiPostData['countryCode'] = $postdata['user-country-code'];
        $apiPostData['phone'] = str_replace(' ', '', $postdata['personal_phone']);
        $apiPostData['message'] = $postdata['cont_message'];
        $ContactForm = fieldday()->api->ContactFormAPI($apiPostData);
        if ($ContactForm->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => 'Thank you! your request is submitted successfully.']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $ContactForm->message]);
        }
        exit;
    }

    public function refundFormEventSession()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $apiPostData = [];
        $apiPostData['selectedOption'] = $postdata['order_refund'];
        $apiPostData['newSessionId'] = $postdata['newSessionId'];
        $ticketId = $postdata['ticketId'];
        $eventId = $postdata['eventId'];
        $providerId = $postdata['providerId'];
        $refundFormEventSession = fieldday()->api->refundFormEventSessionAPI($apiPostData, $ticketId, $eventId, $providerId);
        if ($refundFormEventSession->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => 'Thank you! your request is submitted successfully.']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $refundFormEventSession->message]);
        }
        exit;
    }

    public function RequestDemoForm()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $recatcha = fieldday()->engine->recaptchaVerify($token);
        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'message' => __('reCAPTCHA invalid')]);
        }
        $apiPostData = [];
        $apiPostData['firstName'] = $postdata['cont_name'];
        $apiPostData['lastName'] = $postdata['cont_lname'];
        $apiPostData['businessName'] = $postdata['cont_businessname'];
        $apiPostData['email'] = $postdata['cont_email'];
        $apiPostData['website'] = $postdata['cont_website'];
        $apiPostData['countryCode'] = $postdata['user-country-code'];
        $apiPostData['phone'] = str_replace(' ', '', $postdata['personal_phone']);
        $RequestForm = fieldday()->api->RequestDemoFormAPI($apiPostData);
        if ($RequestForm->statusCode === 201) {
            wp_send_json(['status' => 'success', 'message' => 'Thank you! your request is submitted successfully.']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $RequestForm->message]);
        }
        exit;
    }

    public function PartyForm()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $recatcha = fieldday()->engine->recaptchaVerify($token);
        if (!$recatcha['success']) {
            wp_send_json(['status' => 'fail', 'message' => __('reCAPTCHA invalid')]);
        }
        $apiPostData = [];
        $apiPostData['firstName'] = $postdata['cont_name'];
        $apiPostData['email'] = $postdata['cont_email'];
        $apiPostData['countryCode'] = $postdata['user-country-code'];
        $apiPostData['phone'] = str_replace(' ', '', $postdata['personal_phone']);

        $message = 'Location: ' . $postdata['cont_locations'] . ' ';
        $message .= 'Party Planned on: ' . $postdata['cont_date'] . ' ';
        $message .= 'Estimated headcount: ' . $postdata['cont_estimate'] . ' ';
        $message .= 'Add-ons/Special Requests: ' . $postdata['cont_message'];

        $apiPostData['message'] = $message;
        $ContactForm = fieldday()->api->ContactFormAPI($apiPostData);
        if ($ContactForm->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => 'Thank you! your request is submitted successfully.']);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $ContactForm->message]);
        }
        exit;
    }

    /*To display the Sticky Element*/
    public function StickyWidget()
    {
        global $fielddaySetting;
        $StickyOption = fieldday()->engine->getValue('fieldday_sticky_option', $fielddaySetting, false);
        if ($StickyOption) {
            $content = fieldday()->engine->getView($StickyOption, ['captcha' => 'c-recaptch', 'phoneID' => 'phoneS']);
            wp_send_json(['status' => 'success', 'content' => $content]);
        }
        exit;
    }

    /*Event Purchase*/
    public function EventPurchase()
    {global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionid = $postdata['ATC']['session_id'];
        $session_date = $postdata['ATC']['session_date'][0];
        $cardId = $postdata['ATC']['cardId'];
        $selectedOption = $postdata['ATC']['prices'];
        $paymentmethod = $postdata['ATC']['paymentmethod'];
        $stripeToken = $postdata['ATC']['stripeToken'];
        $saveCard = $postdata['ATC']['savecard'] ?? 'false';
        $countrycode = $postdata['user-country-code'];
        $event_discount = $postdata['ATC']['event_discount'];
        $eventpromocode = $postdata['eventpromocode'];

        if (isset($postdata['parent']['name']) || isset($postdata['parent']['lname'])) {
            $km_full_name = $postdata['parent']['name'] . ' ' . $postdata['parent']['lname'];
            $apiPostData['parent']['name'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $km_full_name);
        }
        if (isset($postdata['parent']['guestEmail'])) {
            $km_guestEmail = $postdata['parent']['guestEmail'];
            $apiPostData['parent']['guestEmail'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $km_guestEmail);
        }
        if (isset($postdata['parent']['phone'])) {
            $km_phone = str_replace(' ', '', $postdata['parent']['phone']);
            $apiPostData['parent']['phone'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $km_phone);
        }
        if (isset($postdata['user-country-code'])) {
            $apiPostData['parent']['countryCode'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $countrycode);
        }

        if (isset($postdata['parent']['address'])) {
            $km_address = $postdata['parent']['address'];
            $apiPostData['paymentAddress']['city'] = preg_replace(fieldday_NOT_ALLOWED_INPUT_CHAR, '', $km_address);
        }

        $apiPostData['eventId'] = $sessionid;
        if ($postdata['ATC']['infants'] > 0) {
            $apiPostData['participants']['infants'] = $postdata['ATC']['infants'];
        }
        if ($postdata['ATC']['toddler'] > 0) {
            $apiPostData['participants']['toddler'] = $postdata['ATC']['toddler'];
        }
        if ($postdata['ATC']['children'] > 0) {
            $apiPostData['participants']['children'] = $postdata['ATC']['children'];
        }
        if ($postdata['ATC']['youth'] > 0) {
            $apiPostData['participants']['youth'] = $postdata['ATC']['youth'];
        }
        if ($postdata['ATC']['adults'] > 0) {
            $apiPostData['participants']['adults'] = $postdata['ATC']['adults'];
        }
        if ($postdata['ATC']['seniors'] > 0) {
            $apiPostData['participants']['seniors'] = $postdata['ATC']['seniors'];
        }
        $apiPostData['selectedDate'] = $session_date;
        $apiPostData['offset'] = $fielddaySetting['offset']; //330;
        if ($cardId) {$apiPostData['cardId'] = $cardId;}
        if (!isset($postdata['parent']['guestEmail'])) {
            $apiPostData['saveCard'] = $saveCard;
        }
        $apiPostData['stripeToken'] = $stripeToken;
        $apiPostData['paymentMethod'] = $paymentmethod;

        if ($event_discount == 'yes') {
            $apiPostData['applyMilitaryDiscount'] = 'true';
        }

        if ($eventpromocode) {
            $apiPostData['couponCode'] = $eventpromocode;
        }
        $response = fieldday()->api->EventsPurchase($apiPostData);
        if ($response->statusCode != 201) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        } else {
            $redirect = fieldday()->engine->ThankyouRedirect();
            if(isset($redirect) && $redirect!=''){
                $redirect .= '?orderid='.$response->data->_id;
            }
            wp_send_json(['status' => 'success', 'message' => $response->message, 'log' => $response,'redirect'=>$redirect]);
        }
        exit;}

    /*Multiweek Purchase*/
    public function MultiweekPurchase()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionid = $postdata['ATC']['session_id'];
        $startingDate = $postdata['ATC']['startingdate'];
        $storeCreditUsed = $postdata['storeCreditUsed'];
        $daysOfWeek = $postdata['ATC']['daysOfWeek'];
        $kidscount = $postdata['kidscount'];
        $cardId = $postdata['ATC']['cardId'];
        $paymentMethod = $postdata['ATC']['paymentmethod'];
        $stripeToken = $postdata['ATC']['stripeToken'];
        $saveCard = $postdata['ATC']['savecard'] ?? 'false';
        $kidsarray = $postdata['ATC']['kids'];
        $kids_ids = array();
        foreach ($kidsarray as $key => $value) {
            array_push($kids_ids, $value['_id']);
        }
        $apiPostData = [];
        $apiPostData['sessionId'] = $sessionid;
        if ($startingDate) {$apiPostData['startingDate'] = $startingDate;}
        if ($daysOfWeek) {$apiPostData['daysOfWeek'] = $daysOfWeek;}
        if ($storeCreditUsed) {
            $apiPostData['storeCreditUsed'] = 'true';
            $apiPostData['storeCreditId'] = $storeCreditUsed;
        }
        if ($cardId != '') {
            $apiPostData['cardId'] = $cardId;
        }
        if (isset($stripeToken)) {
            $apiPostData['stripeToken'] = $stripeToken;
        }

        $apiPostData['kidId'] = $kids_ids;
        $apiPostData['offset'] = $fielddaySetting['offset'];

        $apiPostData['saveCard'] = $saveCard;
        $apiPostData['paymentMethod'] = $paymentMethod;
        $response = fieldday()->api->MultiweekRegistrationPurchase($apiPostData);
        if ($response->statusCode != 200) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        } else {
            $redirect = fieldday()->engine->ThankyouRedirect();
            if(isset($redirect) && $redirect!=''){
                $redirect .= '?orderid='.$response->data->_id;
            }
            wp_send_json(['status' => 'success', 'message' => $response->message, 'log' => $response,'redirect'=>$redirect]);
        }
        exit;
    }

    /* Class Package Options*/
    public function packageOptions()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionid = $postdata['ATC']['session_id'];
        $packageid = $postdata['ATC']['package_id'];
        $kidsarray = $postdata['ATC']['kids'];
        $apiPostData = [];
        $kids_ids = array();
        if ($sessionid || $packageid) {
            $purchaseCount = fieldday()->engine->getValue('kidscount', $postdata, false);
        }
        foreach ($kidsarray as $key => $value) {
            array_push($kids_ids, $value['_id']);
        }
        $apiPostData['sessionId'] = $sessionid;
        $apiPostData['offset'] = 0;
        $apiPostData['kids'] = $kids_ids;
        $apiPostData['selectedOption'] = 'oneTime';
        $response = fieldday()->api->PackageOPtions($apiPostData);
        if ($response->statusCode != 201) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        }
        $data = $response->data;
        $renewal_fre = fieldday()->engine->RenewalFrequencyCalc($data->vendorPackage->validFor, $data->vendorPackage->validForUnit);
        /*  $packagePurchased = $data->packagePurchased;
        $paymentRequired = $data->paymentRequired;
        $oneTimeFee = '$'.$data->oneTimeFee;
        $price = $data->vendorPackage->price;
        $prices_single = fieldday()->engine->CountPackagePrice(1,false);
        $additionalSeatCost = $price->additionalSeatCost;
        $totalPrice = fieldday()->engine->CountPackagePrice($purchaseCount,false,true);

        if($purchaseCount==1 && $packagePurchased!=1){
        $radio_buttons = array(
        array( 'option'=>'package', 'timeperiod'=>'per month', 'title'=>__("Class Package","fieldday"),'price'=>$totalPrice,'checked'=>'checked'),

        );
        }
        if($purchaseCount==1 && $packagePurchased==1){
        $radio_buttons = array(
        array( 'option'=>'package', 'timeperiod'=>'', 'title'=>__("Use existing package for cost $0","fieldday"),'price'=>'','checked'=>'checked'),
        );
        }
        if($purchaseCount>1 && $packagePurchased==1){
        $radio_buttons = array(
        array( 'option'=>'package', 'timeperiod'=>'per month', 'title'=>__("Upgrade Class Package","fieldday"),'price'=>$totalPrice,'checked'=>'checked'),
        );
        }
        if($purchaseCount>1 && $packagePurchased!=1){
        $radio_buttons = array(
        array( 'option'=>'package', 'timeperiod'=>'per month', 'title'=>__("Class Package","fieldday"),'price'=>$totalPrice,'checked'=>'checked'),
        );
        }

        $input = '<h3 class="km_heading_wrap">'.__('How would you like to pay?','fieldday').'</h3>';
        foreach($radio_buttons as $radio_button){ $priceDiv ='';
        if($radio_button['price']){ $priceDiv = '<p>Price: '.$radio_button["price"].'</p>'; }
        $input .= '<label class="km_radio_wrap"><div class="km_radio_text"><span>'.$radio_button["title"].'</span>'.$priceDiv.'</div><input data-price="'.$radio_button["price"].'" id="'.$radio_button["option"].'" data-parsley-group="atc_field" class="km_purchasefield" data-text="" value="'.$radio_button["option"].'" type="radio" name="ATC[prices]"><span class="km_radio"></span></label>';
        }*/

        $renewal_data = '';
        $renewalPaymentDate = $data->nextPaymentOn;
        $renewal_data .= '<h3 class="km_heading_wrap km_primary_color">' . __('When will the next renewal be scheduled?', 'fieldday') . '</h3><span>' . fieldday()->engine->parseDate($renewalPaymentDate, 'd-M-Y') . '<span class="km_renewal_freq"></span></span>';

        wp_send_json(['status' => 'success', 'renewal' => $renewal_data, 'renewal_fre' => $renewal_fre, 'message' => $response->message, 'data' => $response]);
        exit;
    }

    public function MultiweekCalculations()
    {
        global $fielddaySetting;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionid = $postdata['ATC']['session_id'];
        $packageid = $postdata['ATC']['package_id'];
        $kidsarray = $postdata['ATC']['kids'];
        $kidscount = $postdata['kidscount'];
        $daysOfWeek = $postdata['ATC']['daysOfWeek'];
        $startingdate = $postdata['ATC']['startingdate'];
        $apiPostData = [];
        $apidata['kidsCount'] = $kidscount;
        $apidata['sessionId'] = $sessionid;
        if ($daysOfWeek) {$apidata['daysOfWeek'] = $daysOfWeek;}
        if ($startingdate) {$apidata['startingDate'] = $startingdate;}
        $apidata['offset'] = $fielddaySetting['offset'];
        /*if($storeCreditUsed){
        $apidata['storeCreditUsed'] = true;
        $apidata['storeCreditId'] = $storeCreditUsed;
        }*/
        $response = fieldday()->api->multiWeekRegistrationsCalc($apidata);
        //print_r($response);
        if ($response->statusCode === 200 || $response->status == 'success') {
            wp_send_json(['status' => 'success', 'message' => $response->message, 'data' => $response->data]);
            exit;
        }
    }

    /* Giftcard */
    public function singleGiftcard()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (array_key_exists('giftcardid', $postdata)) {
            $giftCardId = fieldday()->engine->getValue('giftcardid', $postdata, false);
            $giftcardtitle = fieldday()->engine->getValue('giftcardtitle', $postdata, false);
            $giftcardpricerange = fieldday()->engine->getValue('giftcardpricerange', $postdata, false);
            $buttontext = fieldday()->engine->getValue('buttontext', $postdata, false);
        }
        $content;
        $content = fieldday()->engine->getView('widgets/elementor/singlegiftcard', ['giftCardId' => $giftCardId, 'amonunts' => $giftcardpricerange, 'buttonPurchase' => $buttontext]);
        wp_send_json(['status' => 'success', 'header' => $giftcardtitle, 'content' => $content, 'footer' => ""]);
        exit;
    }

    public function giftCardmodel()
    {
        global $KmUser;
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // echo"<pre>";
        // print_r($postdata);
        // echo"</pre>";
        // die;
        if (array_key_exists('giftCardid', $postdata)) {
            $giftCardid = fieldday()->engine->getValue('giftCardid', $postdata, false);
            $amount = fieldday()->engine->getValue('amount', $postdata, false);
            $imageOrg = fieldday()->engine->getValue('image', $postdata, false);
            $imagethumb = fieldday()->engine->getValue('imagethumb', $postdata, false);
            $title = fieldday()->engine->getValue('title', $postdata, false);
            $loggedInemail = fieldday()->engine->getValue('email', $KmUser, false);
            $loggedInname = fieldday()->engine->getValue('name', $KmUser, false);
            $loggedInphone = fieldday()->engine->getValue('phone', $KmUser, false);
            $sendMethod = fieldday()->engine->getValue('sendmethod', $postdata, false);
            $recipientname = fieldday()->engine->getValue('recipientname', $postdata, false);
            $recipientemail = fieldday()->engine->getValue('recipientemail', $postdata, false);
            $recipientphone = fieldday()->engine->getValue('recipientphone', $postdata, false);
            $usergiftmsg = fieldday()->engine->getValue('usergiftmsg', $postdata, false);
            $sendername = fieldday()->engine->getValue('sendername', $postdata, false);
            $senddate = fieldday()->engine->getValue('senddate', $postdata, false);
            $finalPrice = preg_replace('~\.0+$~', '', $amount);
            $finalamount = str_replace('$', '', $finalPrice);
            //$saveCard=_e('Save Card','fieldday');
            $isLoggedin = fieldday()->engine->isKmLogin();
        }
        $content;
        $content .= wp_sprintf("<div class='km_membership_purchase_model'>");
        $content .= wp_sprintf("<div class='km_membership_purchase_content km_giftCardmodel km_row'>");
        $content .= wp_sprintf("<div class='km_membership_purchase_left_container km_col_8'>");
        //$content .= wp_sprintf("<span class='km_mermbership_title purchase_model'><h3>%s (%s)</h3></span>", $title, trim($finalPrice));
        $content .= wp_sprintf("<div class='km_col_12'><span class='km_mermbership_title purchase_model'><h3 class='km_primary_color'>%s</h3></span></div>", 'Billing Details');
        $content .= wp_sprintf("<span class='km_gift_image purchase_model' style='display:none;'>%s</span>", $imageOrg);
        $content .= wp_sprintf("<span class='km_gift_imagethumb purchase_model' style='display:none;'>%s</span>", $imagethumb);
        $content .= wp_sprintf("<span class='km_gift_amount purchase_model' style='display:none;'>%s</span>", $finalamount);
        if (fieldday()->engine->isKmLogin()) {
            $content .= wp_sprintf("<span class='km_gift_loginusername purchase_model' style='display:none;'>%s</span>", $loggedInname);
            $content .= wp_sprintf("<div class='km_col_12'><div class='membership_input_wrap'><span for='email'>Email<br>
          <input type='text' value='%s' name='parent[email]' value=''  required=''/></span>", $loggedInemail);
            $content .= wp_sprintf("<span for='phone'>Phone<input type='text' value='%s' class='km_phone_field km_input' id='parent_phone' name='parent[phone]' value=''  required='' data-parsley-minlength-message='Phone should contain 10 characters'/></span></div></div>", $loggedInphone);
        } else {
            $content .= wp_sprintf("<span for='guest' style='display:none;'><input id='usreguest' type='text' value='%s' name='guest'   required=''/></span>", 'true'); // code...
        }
        $content .= fieldday()->engine->getView('merchandise_form', ['giftcheckout' => 'true']);
        $content .= "<div class='km_col_12 km_pay_button'><div class='membership_input_wrap'>";
        //$content .= wp_sprintf("<span class='savecheckbox'><input type='checkbox' class='savecardcheck' value='true' name='savecard' value='' />%s</span>", 'Save Card');

        $content .= wp_sprintf('<a href="javascript:void(0);" id="km_gift_card_prchase_btn" data-giftCardId="%s" data-paymentmethod="card"  class="km_btn giftcard_purchase_button km_primary_bg  km_btn_i_wrapper"><i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>Pay %s</a>', $giftCardid, $finalPrice);

        $content .= "</div></div></div>";
        $content .= wp_sprintf("<div class='km_membership_purchase_right_container km_col_4'>");
        $content .= wp_sprintf("<div class='km_gift_perview_container'>");
        $content .= wp_sprintf("<div class='km_giftimgecontainer'>");
        $content .= wp_sprintf("<img class='km_gift_image'  src='%s'", $imagethumb);
        $content .= "</div>";
        $content .= wp_sprintf("<div class='km_giftcardcheckout_content'>");
        $content .= wp_sprintf("<div class='km_giftcard_content'>");
        $content .= wp_sprintf("<span class='km_gift_username purchase_model'>%s</span>", $recipientname);
        $content .= wp_sprintf("<span class='km_gift_useremail purchase_model'>%s</span>", $recipientemail);
        //$content.=wp_sprintf("<span class='km_gift_userphone purchase_model' style='display:none'>%s</span>", $recipientphone);
        $content .= wp_sprintf("<span class='km_gift_amount_detail purchase_model'>%s %s</span>", 'Amount :', $amount);
        $content .= wp_sprintf("<span class='km_gift_msg purchase_model'>%s %s</span>", '', '<p class="msguser">' . $usergiftmsg . '</p><p class="sendername km_primary_color">-' . $sendername . '</p>');
        $content .= "</div>";
        $content .= "</div>";
        $content .= "</div>";
        $content .= "</div>";
        $content .= "</div>";
        $content .= "</div>";

        $header = '<a href="javascript:;" id="km_giftpurchase_btn" data-giftcardid="' . $giftCardid . '" data-giftcardprice-range="[25,50,100,125]" class="km_btn km_btn giftcard_purchase_button  km_btn_green km_primary_color km_transparent_bg km_giftcard_back" data-checkout-rediect="true" style="display: inline-block;"><i class="fa fa-angle-left"></i></a>Confirm and Pay';
        
        wp_send_json(['status' => 'success', 'isLoggedin' => $isLoggedin, 'header' => $header, 'content' => $content, 'footer' => ""]);
        exit;
    }

    public function giftCardPurchase()
    {

        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $apiPostData = [];
        if (array_key_exists('giftCardid', $postdata)) {
            $giftCardId = fieldday()->engine->getValue('giftCardid', $postdata, false);
            $paymentmethod = fieldday()->engine->getValue('paymentmethod', $postdata, false);
            $amount = fieldday()->engine->getValue('amount', $postdata, false);
            $stripeToken = fieldday()->engine->getValue('stripeToken', $postdata, false);
            $saveCard = fieldday()->engine->getValue('savecard', $postdata, false);
            $name = fieldday()->engine->getValue('userName', $postdata, false);
            $email = fieldday()->engine->getValue('userEmail', $postdata, false);
            $phone = fieldday()->engine->getValue('userPhone', $postdata, false);
            $giftCardImageOrg = fieldday()->engine->getValue('giftCardImage', $postdata, false);
            $giftCardImagethumb = fieldday()->engine->getValue('giftCardImagethumb', $postdata, false);
            $sendername = fieldday()->engine->getValue('sendername', $postdata, false);
            $senderemail = fieldday()->engine->getValue('senderemail', $postdata, false);
            $senderphone = fieldday()->engine->getValue('senderphone', $postdata, false);
            $massgage = fieldday()->engine->getValue('massgage', $postdata, false);
            $senderDisplayName = str_replace('-', '', fieldday()->engine->getValue('senderDisplayName', $postdata, false));

            if (!$savecard) {
                $saveCard = 'false';
            }

            $apiPostData['giftCardId'] = $giftCardId;
            $apiPostData['paymentMethod'] = $paymentmethod;
            $apiPostData['amount'] = trim($amount);
            $apiPostData['stripeToken'] = $stripeToken;
            $apiPostData['message'] = $massgage;
            $apiPostData['senderDisplayName'] = $senderDisplayName;
            $apiPostData['image'] = ['original' => $giftCardImageOrg, 'thumbnail' => $giftCardImagethumb];
            if (array_key_exists('guest', $postdata)) {
                if (!empty($senderphone) && !empty($senderemail)) {
                    $apiPostData['userDetails'] = ['name' => $sendername, 'email' => $senderemail, 'phone' => $senderphone];
                    $apiPostData['senderDetails'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
                } elseif (empty($senderphone) && !empty($senderemail)) {
                    $apiPostData['userDetails'] = ['name' => $sendername, 'email' => $senderemail];
                    $apiPostData['senderDetails'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
                } elseif (!empty($senderphone) && empty($senderemail)) {
                    $apiPostData['userDetails'] = ['name' => $sendername, 'phone' => $senderphone];
                    $apiPostData['senderDetails'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
                }

            } else {
                $apiPostData['userDetails'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
                $apiPostData['saveCard'] = $saveCard;
            }
        }

        if (array_key_exists('guest', $postdata)) {
            $response = fieldday()->api->giftcardPurchaseGuest($apiPostData);
        } else {
            $response = fieldday()->api->giftcardPurchase($apiPostData);
        }

        if ($response->statusCode != 201) {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'log' => $response]);
        }
        wp_send_json(['status' => 'success', 'message' => $response->message]);
        exit;
    }

    public function checkoutpaymentInstallments()
    {

        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sessionId = fieldday()->engine->getValue('session_id', $postdata, false);
        $content;
        global $fielddaySetting;

        $queryParams['offset'] = $fielddaySetting['offset'];

        if ($sessionId) {
            $queryParams['filters']['sessionId'] = $sessionId;
        }
        $sessions = fieldday()->api->GetProviderSessionsNew($queryParams);
        $engine = fieldday()->engine;
        foreach ($sessions->data->sessions as $counter => $mySession):
            //foreach ($session->sessions as $counter => $mySession) {
                if ($mySession->enablePaymentOptions):

                    $content .= wp_sprintf('<div class="km_col_12 km_field_wrap">');
                    $content .= wp_sprintf('<div class="km_radio_text">');
                    //$content .= wp_sprintf('<h3 class="km_payment_installment_heading">%s</h3>',  __("Next payment installment(s) date and amount:", 'fielday'));
                    $content .= wp_sprintf('<div class="km_payment_packages km_row">');
                    $content .= wp_sprintf('<ul>');
                    $content .= wp_sprintf('<li>');
                    $content .= wp_sprintf('<span>%s</span>', __("Deposit", 'fieldday'));
                    $content .= wp_sprintf('<span>%s</span>', __("Today", 'fieldday'));
                    $content .= wp_sprintf('<span>%s</span>', $engine->display_price($mySession->paymentOptions[0]->deposit));
                    $content .= wp_sprintf('</li>');
                    foreach ($mySession->paymentOptions[0]->payments as $key => $paymentOption):
                        $content .= wp_sprintf('<li>');
                        $content .= wp_sprintf('<span>%s</span>', __("Installment", 'fieldday'));
                        $content .= wp_sprintf('<span>%s</span>', $engine->parseDate($paymentOption->dateTime));
                        $content .= wp_sprintf('<span>%s</span>', $engine->display_price($paymentOption->deposit));
                        $content .= wp_sprintf('</li>');
                    endforeach;
                    $content .= wp_sprintf('</ul>');
                    $content .= wp_sprintf('</div>');
                    $content .= wp_sprintf('</div>');

                endif;
            //}
        endforeach;

        wp_send_json(['status' => 'success', 'header' => 'Next payment installment(s) date and amount', 'content' => $content, 'footer' => ""]);

        exit;
    }

    public function deleteSavedCard()
    {
        $cardId = filter_input(INPUT_POST, 'cardId', FILTER_SANITIZE_STRING);
        if (!$cardId) {
            wp_send_json(['status' => 'fail', 'message' => __("invalid card id", 'fieldday')]);
        }

        $isDeleted = fieldday()->api->deleteSavedCard($cardId);

        if ($isDeleted->statusCode === 200) {
            wp_send_json(['status' => 'success', 'message' => $isDeleted->message, 'logs' => $isDeleted]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $isDeleted->message, 'logs' => $isDeleted]);
        }

    }

    public function setDefaultCard()
    {
        $cardId = filter_input(INPUT_POST, 'cardId', FILTER_SANITIZE_STRING);
        if (!$cardId) {
            wp_send_json(['status' => 'fail', 'message' => __("invalid card id", 'fieldday')]);
        }

        $response = fieldday()->api->setCardAsDefault($cardId);

        if ($response->statusCode == 200) {
            wp_send_json(['status' => 'success', 'message' => $response->message, 'logs' => $response]);
        } else {
            wp_send_json(['status' => 'fail', 'message' => $response->message, 'logs' => $response]);
        }
    }
    public function getCardForm()
    {
        $content = fieldday()->engine->getView('account/card_form', ['cardDetail' => $paymentDetail]);
        $header = wp_sprintf('<h4>%s</h4>', __('Add New Card', 'fieldday'));
        $footer = wp_sprintf("<button class='km_btn km_add_kid_cancel km_primary_color  km_transparent_bg' onclick='fieldday.closepopup(this);'>%s</button>", __('Cancel', 'fieldday'));
        $footer .= wp_sprintf("<button onclick='fieldday.addNewCard();' class='km_btn km_primary_bg'>%s</button>", __('Save', 'fieldday'));

        wp_send_json(['status' => 'success', 'content' => $content, 'header' => $header, 'footer' => $footer]);
    }

    public function saveCard()
    {
        $postdata = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (array_key_exists('stripeToken', $postdata)) {
            $response = fieldday()->api->saveNewCard($postdata);
            if ($response->statusCode === 201) {
                wp_send_json(['status' => 'success', 'message' => $response->message, 'logs' => $response]);
            } else {
                wp_send_json(['status' => 'fail', 'message' => $response->message, 'logs' => $response]);
            }
        }
    }

    public function fielddayActionsInit()
    {

    }

}

return new fielddayActions();


