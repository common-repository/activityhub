<?php

/*
 * fieldday Shortcodes
 * @package fieldday
 * @since   1.0.0
 */

class fielddayShortcodes
{

    public function __construct()
    {
        /**
         * Shortcode to display the list of session in front end through shortcodes
         * [fieldday_sessions]
         */
        add_shortcode('fieldday_sessions', [$this, 'fielddaySessions']);
        /**
         * Shortcode to display login forms
         * [fieldday_login]
         */
        add_shortcode('fieldday_login', [$this, 'fielddayLogin']);

        /**
         * Shortcode to display register forms
         * [fieldday_login]
         */
        add_shortcode('fieldday_register', [$this, 'fielddayRegister']);

        /**
         * Shortcode to display user profile
         * [fieldday_profile]
         */
        add_shortcode('fieldday_profile', [$this, 'fielddayProfile']);

        /**
         * this shortcode will display the Cart page content
         *
         * [fieldday_cart]
         */
        add_shortcode('fieldday_cart', [$this, 'fielddayCart']);


        /**
         * this shortcode will display the Thankyou page content
         *
         * [fieldday_thankyou_page]
         */
        add_shortcode('fieldday_thankyou_page', [$this, 'fieldday_thankyou_page']);

        /**
         * this shortcode will display the checkout page content
         *
         * [fieldday_checkout]
         */
        add_shortcode('fieldday_checkout', [$this, 'fielddayCheckout']);

        /**
         * this shortcode will display the donate form
         *
         * [fieldday_donate event_name="" event_description="" column="1 0r 2" success_message=""]
         */
        add_shortcode('fieldday_donate', [$this, 'fielddayDonate']);

        /**
         * this shortcode will display the CheckIn list
         *
         * [fieldday_checkin]
         */
        add_shortcode('fieldday_checkin', [$this, 'fielddayCheckIn']);
        /**
         * Shortcode to display Contact forms
         * [fieldday_contact]
         */
        add_shortcode('fieldday_contact', [$this, 'fielddayContact']);
        /**
         * Shortcode to display Contact forms
         * [fieldday_contact]
         */
        add_shortcode('fieldday_requestdemo', [$this, 'fielddayRequestForm']);
        /**
         * Shortcode to display Party forms
         * [fieldday_partyform]
         */
        add_shortcode('fieldday_partyform', [$this, 'fielddayPartyForm']);

        /**
         * Shortcode to display Providers Listing
         * [fieldday_providers]
         */
        //add_shortcode('fieldday_providers', [$this, 'fielddayProvidersList']);

        /**
         * Shortcode to display the list of camps/events in front end through shortcodes
         * [fieldday_activity_sessions]
         */
        add_shortcode('fieldday_activity_sessions', [$this, 'fielddayActivitySessions']);

        /* fieldday event button html shortcode */
        add_shortcode('fieldday_event_button', [$this, 'fieldday_event_button_html']);
        /* fieldday event button html shortcode */
    }

    /**
     * display sessions from a provider
     * @param array  $arg  Shortcode arguments
     *
     * @global array $fielddaySetting
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function fielddaySessions($arg = [])
    {
        global $fielddaySetting;
        $query_options = [];
        $tagId = filter_input(INPUT_GET, 'tagId', FILTER_SANITIZE_STRING);
        $activityId = filter_input(INPUT_GET, 'activityId', FILTER_SANITIZE_STRING);
        $sessionId = filter_input(INPUT_GET, '_id', FILTER_SANITIZE_STRING);
        $activityTags = fieldday()->api->getActivityTagsCount();
        /* is sessionId filter from url */
        if ($sessionId) {
            $query_options['filters']['sessionId'] = $sessionId;
        }

        if ($activityId) {
            $query_options['filters']['activityId'] = $activityId;
        }
        if ($arg && $arg['ismarketplacelist'] == "true") {
            $query_options['isMarketplaceList'] = $arg['ismarketplacelist'];
        }

        if ($activityTags->statusCode == 200) {
            foreach ($activityTags->data as $key => $tags) {
                if ($tagId) {
                    $query_options['tagId'] = $tagId;
                } else {
                    if ($tags->title == "Full Week") {
                        $query_options['tagId'] = $tags->_id;
                        $tagId = $tags->_id;
                    }
                }
            }
        } else {
            print fieldday()->engine->displayFlash('error', __($activityTags->message, 'fieldday'));
        }
        /* activity tags */
        $activityTypes = fieldday()->api->getActivityTags();
        if ($activityTypes->data && count((array) $activityTypes->data)) {
            $tabId = $activityTypes->data[0]->_id;
        }

        if ($arg && $arg['ismarketplacelist'] == "true") {
            $data = ['activityTags' => $activityTags, 'tagId' => $tagId, 'filters' => $query_options, 'activityTypes' => $activityTypes, 'tabId' => $tabId, 'isMarketplaceList' => $arg['ismarketplacelist']];
        } else {
            $data = ['activityTags' => $activityTags, 'tagId' => $tagId, 'filters' => $query_options, 'activityTypes' => $activityTypes, 'tabId' => $tabId];
        }

        return fieldday()->engine->getView('sessions_list', $data);
    }

    /* fieldday event button html */
    public function fieldday_event_button_html($arg = [])
    {
        global $fielddaySetting;
        $eventId = fieldday()->engine->getValue('id', $arg, false);
        $eventType = fieldday()->engine->getValue('type', $arg, false);
        $eventText = fieldday()->engine->getValue('text', $arg, null);
        if (isset($eventId) && $eventId != '') {
            $data = fieldday()->api->fieldday_event_button_html_api($eventType, $eventId);
            if ($data->statusCode === 200) {
                return fieldday()->engine->getView('fieldday_event_button_html', ['session' => $data->data, 'eventId' => $eventId, 'eventType' => $eventType, 'eventText' => $eventText]);
            }
        }
    }
    /* fieldday event button html  end*/

    /**
     * display sessions from a activity
     * @param array  $arg  Shortcode arguments
     *
     * @global array $fielddaySetting
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function fielddayActivitySessions($arg = [])
    {
        global $fielddaySetting;
        $filters = [];
        $content = '';
        $activityId = fieldday()->engine->getValue('activityid', $arg, false);
        $sessionId = fieldday()->engine->getValue('sessionid', $arg, false);
        $buttonOnly = fieldday()->engine->getValue('buttononly', $arg, false);
        if ($activityId) {
            $filters['filters']['activityId'] = $activityId;
        }

        if ($sessionId) {
            $sessionInfo = fieldday()->api->getActivitySessionDetail($sessionId);
            if ($sessionInfo->statusCode === 200) {
                $session = $sessionInfo->data;
                $content .= fieldday()->engine->getView('activity_sessions_list', ['session' => $session, 'buttonOnlySingleSession' => $buttonOnly, 'is_single_session' => true]);
            }
        } else {
            $sessions = fieldday()->api->GetProviderSessionsNew($filters);
            $activitys = $sessions->data->sessions;
            foreach ($activitys as $activity => $singleactivity) {
                //foreach ($singlesessions->sessions as $singleactivity) {
                    $session_id = wp_sprintf('%s', $singleactivity->_id);
                    $sessionInfo = fieldday()->api->getActivitySessionDetail($session_id);
                    if ($sessionInfo->statusCode === 200) {
                        $session = $sessionInfo->data;
                        $content .= fieldday()->engine->getView('activity_sessions_list', ['session' => $session]);
                    }
                //}

            }
        }
        return $content;
    }

    /**
     * display login page
     * @param array  $arg  Shortcode arguments
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function fielddayLogin($arg = [])
    {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if ($action == 'km_register') {

            return fieldday()->engine->getView('register');
        }
        return fieldday()->engine->getView('login');
    }

    /**
     * display register page
     * @param array  $arg  Shortcode arguments
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function fielddayRegister($arg = [])
    {
        global $KmUser;
        if (is_user_logged_in() && $KmUser) {
            return fieldday()->engine->getView('account/_myaccount', ['KmUser' => $KmUser]);
        }

        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if ($action == 'km_login') {

            return fieldday()->engine->getView('login');
        }

        return fieldday()->engine->getView('register');
    }

    /**
     * display loggedin user profile
     * @param array  $arg  Shortcode arguments
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function fielddayProfile($arg = [])
    {
        global $KmUser;
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$KmUser) {
            return fieldday()->engine->getView('account/_loginrequired');
        }
        switch ($action) {
            case "myaccount":
                return fieldday()->engine->getView('account/profile', ['action' => $action]);
                break;
            case "kidsinfo":
                $kidId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
                if ($kidId) {
                    $kidData = fieldday()->api->GetKidDetail($kidId);
                    $view = 'account/kidDetail';
                    $data = ['kidData' => $kidData->data->kidProfile];
                } else {
                    $kidData = fieldday()->api->GetKids();
                    $view = 'account/kidsinfo';
                    $data = ['kids' => $kidData->data, ['action' => $action]];
                }
                if ($kidData->statusCode !== 200) {
                    return fieldday()->engine->getView('account/kidsInfoError', ['message' => $kidData->message, ['action' => $action]]);
                }

                return fieldday()->engine->getView($view, $data);
                break;
            case "insurance":
                $insurance = fieldday()->api->GetInsurance();
                $kidData = fieldday()->api->GetKids();
                if ($insurance->statusCode !== 200) {
                    return fieldday()->engine->getView('account/kidsInfoError', ['message' => $insurance->message, 'action' => $action]);
                }

                return fieldday()->engine->getView('account/insurance', ['dentalInsurance' => $insurance->data->dentalInsurance, 'medInsurance' => $insurance->data->medInsurance, 'action' => $action, 'kids' => $kidData->data]);
                break;
            default:
                return fieldday()->engine->getView('account/profile', ['action' => $action]);
        }
    }

    /**
     * Display cart page for user
     *
     * @param Array $arg
     */
    public function fielddayCart($arg = [])
    {
        global $fielddaySetting;
        $cartDetails = fieldday()->engine->GetCartData();
        if (!empty($cartDetails)) {
            return fieldday()->engine->getView('cart/session_cart', ['cartDetails' => $cartDetails]);
        } else {
            $purchasepage = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
            return wp_sprintf('<div class="km_nodata km_empty_cart">%s</div><div class="checkout_button"><a class="km_primary_color km_btn km_transparent_bg" href="%s">Continue Shopping</a>', fieldday()->engine->displayText('km_empty_cart_msg', false), apply_filters('km_purchase_page', $purchasepage));

        }

    }


    /**
     * Display Thankyou page for user
     *
     * @param Array $arg
     */
    public function fieldday_thankyou_page($arg = [])
    {
        global $fielddaySetting;
        $ProviderId = $fielddaySetting['fieldday_api_provider'];
        $authKey = $fielddaySetting['fieldday_api_auth_key'];
        $orderId = $_REQUEST['orderid'];
        $orderData = fieldday()->api->GetOrderDetailsByOrderId([],$orderId);
        return fieldday()->engine->getView('checkout/thankyou', ['data' => $orderData]);
    }


    /**
     * Display checkout page for user
     *
     * @param Array $arg
     */
    public function fielddayCheckout($arg = [])
    {
        global $KmUser;global $fielddaySetting;
        $cartDetails = fieldday()->engine->GetCartData();
        $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $checkout_url = $base_url . $_SERVER["REQUEST_URI"];
        if (isset($_REQUEST['cartId']) && $_REQUEST['waitlist'] == 'true') {
            if (!$KmUser) {
                return fieldday()->engine->getView('login', ['redirect' => $checkout_url]);
            }
        }
        if (!empty($cartDetails)) {
            return fieldday()->engine->getView('checkout/session_checkout', ['steps' => fieldday()->engine->Km_purchase_Steps()]);
        } else {
            return wp_sprintf('<div class="km_nodata km_empty_cart">%s</div>', fieldday()->engine->displayText('km_empty_cart_msg', false));
        }
    }

    /**
     * display donation form
     * @param type $arg
     * @return Html
     */
    public function fielddayDonate($arg = [])
    {
        $title = fieldday()->engine->getValue('event_name', $arg, false);
        $description = fieldday()->engine->getValue('event_description', $arg, false);
        $column = fieldday()->engine->getValue('column', $arg, false);
        $success_message = fieldday()->engine->getValue('success_message', $arg, false);
        $layoutClass = $column == 2 ? 'km_col_6' : 'km_col_12';
        return fieldday()->engine->getView('donate', ['title' => $title, 'description' => $description, 'layout_class' => $layoutClass, 'success_message' => $success_message]);
    }

    /**
     * display CheckIn Order form
     * @param type $arg
     * @return Html
     */
    public function fielddayCheckIn($arg = [])
    {$ticketid = '';
        $apidata = [];
        if ($_REQUEST['ticketId']) {$apidata['ticketid'] = $ticketid = $_REQUEST['ticketId'];}
        if ($_REQUEST['orderNo']) {$apidata['orderno'] = $_REQUEST['orderNo'];}
        if ($_REQUEST['orderId']) {$apidata['orderid'] = $_REQUEST['orderId'];}
        $ticketdetails = fieldday()->api->GetTicketDetail($apidata);
        //print_r($ticketdetails); echo "sdasd";
        if ($ticketdetails->statusCode === 200) {
            return fieldday()->engine->getView('checkin', ['ticketid' => $ticketid, 'ticketdata' => $ticketdetails->data]);
        } else {
            return fieldday()->engine->getView('checkin');
        }
        //return fieldday()->engine->getView('checkin');
    }

    /**
     * display Contact form
     * @param type $arg
     * @return Html
     */
    public function fielddayContact($arg = [])
    {
        return fieldday()->engine->getView('contactform');
    }

    /**
     * display Request Demo form
     * @param type $arg
     * @return Html
     */
    public function fielddayRequestForm()
    {
        return fieldday()->engine->getView('requestform');
    }

    /**
     * display Party form
     * @param type $arg
     * @return Html
     */
    public function fielddayPartyForm($arg = [])
    {
        return fieldday()->engine->getView('partyform');
    }

}

return new fielddayShortcodes();
