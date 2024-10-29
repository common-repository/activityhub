<?php

/*
 * fieldday Core funtions
 * @package fieldday
 * @since   1.0.0
 */

class fielddayCore extends fielddayBase
{

    /**
     * @var String Facebook client Id
     */
    private $fb_client_id;

    /**
     * @var String redirect url
     */
    private $fb_redirect_url;

    /**
     * @var String Google client Id
     */
    private $google_client;

    /**
     * @var String google redirect url
     */
    private $google_redirect_url;

    /**
     * @var String google recaptcha site key
     */
    private $google_recaptcha_key;

    /**
     * @var String google recaptcha secret
     */
    private $google_recaptcha_secret;

    /**
     * @var String stripe token
     */
    private $stripe_token;

    /**
     * @var String stripe payment mode
     */
    private $stripe_payment_mode;

    /**
     * class constructor
     * @global type $fielddaySetting
     */
    public function __construct()
    {
        global $fielddaySetting;
        parent::__construct();

        $this->fb_client_id = "819012162367590";
        $this->fb_redirect_url = $this->getvalue('fieldday_facebook_redirect', $fielddaySetting, false);
        $this->google_client = "743631987217-7bhocn53ich8cl9oe6d3in465o3d6set.apps.googleusercontent.com";
        $this->google_redirect_url = $this->getvalue('fieldday_google_redirect', $fielddaySetting, false);

        $this->google_recaptcha_key = $this->getvalue('fieldday_google_recaptcha_id', $fielddaySetting, false);
        $this->google_recaptcha_secret = $this->getvalue('fieldday_google_recaptcha_secret', $fielddaySetting, false);
        $this->stripe_payment_mode = $this->getvalue('fieldday_payment_mode', $fielddaySetting, false);
        if ($this->stripe_payment_mode == 'yes') {
            $this->stripe_token = "pk_live_2PIp7ZDshJ5IXCiy0Wdtkl5q";
        } else {
            $this->stripe_token = "pk_test_x2ptAQABuV51Jb80felkSj8q";
        }
    }

    /**
     * get the session page filter options
     * @return array
     */
    public function fielddayFilters()
    {
        return apply_filters('fieldday_session_filters', [
            'location' => __('Locations', 'fieldday'),
            'search' => __('Search Input', 'fieldday'),
            'activities' => __("Activities", 'fieldday'),
            'types' => __("Types", 'fieldday'),
            'bankdays' => __('Bank Days', 'fieldday'),
            'month' => __("Month", 'fieldday'),
            'age' => __("Age", 'fieldday'),
        ]);

    }
    /**
     * get the selected filters from database
     * @return array
     */
    public function fielddaySelectedFilters()
    {
        global $fielddaySetting;
        $session_filters = $this->getValue('session_filters', $fielddaySetting, false);
        if (!$session_filters) {
            $session_filters = array_keys($this->fielddayFilters());
        }
        return $session_filters;
    }

    /**
     * Display session filter output
     * @param string $filterKey
     * @param string $tagId session active tag
     * @param array $locations session locations
     * @param array $activityTags session tags
     *
     * @return string Html
     */
    public function session_filter_output($filterKey, $tagId, $activityTags)
    {
        switch ($filterKey) {
            case 'search':
                return $this->searchInput();
                break;
            case 'types':
                $activityTags = apply_filters('km_activity_tags', $activityTags);
                return $this->sessionActivityTags($tagId, $activityTags);
                break;
            case 'bankdays':
                return $this->filterBankDays();
                break;
            case 'location':
                $locations = [];
                $locationsResponse = fieldday()->api->getProviderLocations();
                if ($locationsResponse->statusCode == 200) {
                    foreach ($locationsResponse->data as $key => $locationdata) {
                        $locations[$locationdata->_id] = $locationdata->name;
                    }
                }
                return $this->filterLocations($locations);
                break;
            case 'month':
                return $this->filterMonths();
                break;
            case 'age':
                return $this->filterAge();
                break;
            case 'type':
                return $this->filterType();
                break;
            case 'activities':
                return $this->filterActivities();
                break;
            default:
                break;
        }
    }

    /**
     * get the session filter html for Activity Tags
     *
     * @param string $tagId
     * @param array $activityTags
     * @return array
     */
    private function sessionActivityTags($tagId, $activityTags)
    {
        return;
    }

    /**
     * Filter html for session tyoe i.e Camp or class
     * @return type Html
     */
    private function filterType()
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
    }

    /**
     * Filter html for activities
     * @return type Html
     */
    private function filterActivities()
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
    }

    /**
     * get the filter html for age filter
     * @return string Html
     */
    private function filterAge()
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
    }

    /**
     * get the filter options for months
     * @return string Html
     */
    private function filterMonths()
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
    }

    /**
     * Get the locations filter html
     *
     * @param array $locations session available locations array
     * @return string Html
     */
    private function filterLocations($locations)
    {
        $options = "";
        foreach ($locations as $location_id => $location) {
            $options .= wp_sprintf('<option value="%s">%s</option>', $location_id, $location);
        }

        return '<div class="km_col_3 km_session_location_filter select-wrapper">
      <i class="fa fa-map-marker" aria-hidden="true" style="top: 13px;"></i>
            <select data-search-name="location" onchange="return fieldday.processSessionFilters(this, event);" id="km_location_search" class="km_session_search session-search_location km_input" name="filters[location]">
                <option value="all">' . __('All Locations', 'fieldday') . '</option>
                ' . $options . '
            </select>

      </div>';

    }

    /**
     * get the input text html for search input filter
     * @return string
     */
    private function searchInput()
    {
        return '<div class="km_col_3 select-wrapper">
        <input id="km_session_search_keyword"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   data-search-name="searchKey" type="text" class="searchInput km_input" name="filters[searchKey]" placeholder="type anything"/></div>';

    }

    /**
     * get the filter options html for bank days
     * @return Html
     */
    private function filterBankDays()
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
    }

    /**
     * get the data for bank days
     * @return Boolean
     */
    public function GetBankDays()
    {
        $bankDays = fieldday()->api->getShoppingPackages();
        if ($bankDays->data) {
            return true;
        } else {return false;}

    }

    /**
     * get the data for GiftCards
     * @return array
     */
    public function GetGiftCards()
    {
        $giftOptions = fieldday()->api->getProviderGiftCards();
        if ($giftOptions->data) {return true;} else {return false;}
    }

    public function displaySessionTabs($activityTypes)
    {
        $html = "<div class='km_hide_mobile km_col_03'>";
        $html .= '<ul class="km_session_tabs">';
        foreach ($activityTypes->data as $index => $activityType) {
            if ($activityType->purchaseFlow == 'bankDays') {
                $html .= wp_sprintf('<li><a class="km_session_tab_merchandise" onclick="fieldday.showMerchandise(event, this);" href="javascript:void();">%s</a></li>', $activityType->title);
            } else {
                $html .= wp_sprintf('<li><a class="km_session_tab %s" data-id="%s" href="#tab1">%s</a></li>', $index == 0 ? 'km_active_tab km_primary_color' : '', $activityType->_id, $activityType->title);
            }
        }
        $html .= "</ul>";
        $html .= "</div>";

        $html .= "<div class='km_show_mobile km_col_12 km_session_mob_tabs'>";
        $html .= "<select class='km_input' onchange='fieldday.mobileSessionTabs(this, event);'>";
        foreach ($activityTypes->data as $index => $activityType) {
            if ($activityType->purchaseFlow == 'bankDays') {
                // $html.= wp_sprintf('<option value="%s">%s</option>', $activityType->purchaseFlow, $activityType->title);
            } else {
                $html .= wp_sprintf('<option %s value="%s">%s</option>', $index == 0 ? 'selected' : '', $activityType->_id, $activityType->title);
            }
        }
        $html .= "</select>";
        $html .= "</div>";

        print $html;
    }

    /**
     * session booking types
     *
     * @return array session booking type parameters
     */
    public function _sessionBookingTypes()
    {
        return [
            'oneDayKidRegistration' => [
                'lable' => __("One Day Only", "fieldday"),
                'icon' => "oneday_icon.png",
                'duration' => '/day',
                'apikey' => 'fullDay',
                'singlesessionkey' => 'oneDayDetails',
            ],
            'morningKidRegistration' => [
                'lable' => __("Morning Only", "fieldday"),
                'icon' => "morning_icon.png",
                'duration' => '/day(Morning)',
                'apikey' => 'halfDayMrng',
                'singlesessionkey' => 'morningOnlyDetails',
            ],
            'eveningKidRegistration' => [
                'lable' => __("Afternoon Only", "fieldday"),
                'icon' => "afternoon_icon.png",
                'duration' => '/day(Evening)',
                'apikey' => 'halfDayEvng',
                'singlesessionkey' => 'eveningOnlyDetails',
            ],
            'weeklyKidRegistration' => [
                'lable' => __("Full Week", "fieldday"),
                'icon' => "fullweek_icon.png",
                'duration' => '',
                'apikey' => 'price',
                'singlesessionkey' => '',
            ],
        ];
    }

    /**
     *
     * @return String Stripe token
     */
    public function getStripeToken()
    {
        return $this->stripe_token;
    }

    /**
     *
     * @param string $type error type "error" "success"
     * @param string $message message to display
     * @return string Html message
     */
    public function displayFlash($type, $message)
    {
        return "<div class='km_flash km_alert_{$type}'>$message</div>";
    }

    /**
     * get the content from view file
     * @param String $viewname view file name
     * @param Array $data Data to send into view file
     * @throws ApiException on a non 2xx response
     * @return HTML
     */
    public function getView($viewname, array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        /* default variables in view */
        global $KmUser;
        global $fielddaySetting;

        ob_start();
        $viewpath = get_stylesheet_directory() . "/fieldday/{$viewname}.php";
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);

        if (!file_exists($viewpath)) {
            $themeViewFile = fieldday_ABSPATH . "views/theme/{$activetheme}/{$viewname}.php";
            if (file_exists($themeViewFile)) {
                $viewpath = $themeViewFile;
            } else {
                $viewpath = fieldday_ABSPATH . "views/{$viewname}.php";
            }
        }

        require $viewpath;
        $html = ob_get_clean();
        return $html;
    }

    /**
     * get the states
     * @param type $html get html or array
     * @return type mixed array of states of Html
     */
    public function getStatesList($html = true)
    {
        $states = [
            "AL" => __("Alabama", 'fieldday'),
            "AK" => __("Alaska", 'fieldday'),
            "AZ" => __("Arizona", 'fieldday'),
            "AR" => __("Arkansas", 'fieldday'),
            "CA" => __("California", 'fieldday'),
            "CO" => __("Colorado", 'fieldday'),
            "CT" => __("Connecticut", 'fieldday'),
            "DE" => __("Delaware", 'fieldday'),
            "DC" => __("District Of Columbia", 'fieldday'),
            "FL" => __("Florida", 'fieldday'),
            "GA" => __("Georgia", 'fieldday'),
            "HI" => __("Hawaii", 'fieldday'),
            "ID" => __("Idaho", 'fieldday'),
            "IL" => __("Illinois", 'fieldday'),
            "IN" => __("Indiana", 'fieldday'),
            "IA" => __("Iowa", 'fieldday'),
            "KS" => __("Kansas", 'fieldday'),
            "KY" => __("Kentucky", 'fieldday'),
            "LA" => __("Louisiana", 'fieldday'),
            "ME" => __("Maine", 'fieldday'),
            "MD" => __("Maryland", 'fieldday'),
            "MA" => __("Massachusetts", 'fieldday'),
            "MI" => __("Michigan", 'fieldday'),
            "MN" => __("Minnesota", 'fieldday'),
            "MS" => __("Mississippi", 'fieldday'),
            "MO" => __("Missouri", 'fieldday'),
            "MT" => __("Montana", 'fieldday'),
            "NE" => __("Nebraska", 'fieldday'),
            "NV" => __("Nevada", 'fieldday'),
            "NH" => __("New Hampshire", 'fieldday'),
            "NJ" => __("New Jersey", 'fieldday'),
            "NM" => __("New Mexico", 'fieldday'),
            "NY" => __("New York", 'fieldday'),
            "NC" => __("North Carolina", 'fieldday'),
            "ND" => __("North Dakota", 'fieldday'),
            "OH" => __("Ohio", 'fieldday'),
            "OK" => __("Oklahoma", 'fieldday'),
            "OR" => __("Oregon", 'fieldday'),
            "PA" => __("Pennsylvania", 'fieldday'),
            "RI" => __("Rhode Island", 'fieldday'),
            "SC" => __("South Carolina", 'fieldday'),
            "SD" => __("South Dakota", 'fieldday'),
            "TN" => __("Tennessee", 'fieldday'),
            "TX" => __("Texas", 'fieldday'),
            "UT" => __("Utah", 'fieldday'),
            "VT" => __("Vermont", 'fieldday'),
            "VA" => __("Virginia", 'fieldday'),
            "WA" => __("Washington", 'fieldday'),
            "WV" => __("West Virginia", 'fieldday'),
            "WI" => __("Wisconsin", 'fieldday'),
            "WY" => __("Wyoming", 'fieldday'),
        ];
        if (!$html) {
            return apply_filters('fieldday_states_list', $states);
        }

        foreach ($states as $ID => $state) {
            print wp_sprintf("<option value='%s'>%s</option>", $ID, $state);
        }
    }

    /**
     * return value for Class Package Renewal Frequency
     */

    public function RenewalFrequencyCalc($validFor, $validForUnit)
    {
        if ($validFor == 1 && $validForUnit == 'months') {
            $period = "/month";
        } else if ($validFor == 6 && $validForUnit == 'months') {
            $period = '/Quarter';
        } else if ($validFor == 1 && $validForUnit == 'years') {
            $period = '/Year';
        } else {
            $period = $validFor . ' ' . $validForUnit;
        }
        return $period;
    }

    /**
     * return value for Class Package Price
     */
    public function CountPackagePrice($kidscount, $array = true, $renewal_freq = false)
    {
        $classPackages = fieldday()->api->getPackages();

        $prices = array();
        $packagepricelist = $classPackages->data;
        foreach ($packagepricelist->price as $key => $price) {
            $prices[$key] = $price;
        }
        if ($array) {
            return $prices;
        } else {
            if (isset($packagepricelist->price->$kidscount)) {
                $totalprice = $packagepricelist->price->$kidscount;
                $price = $this->display_price($totalprice);
            } else {
                $additionalcost = $packagepricelist->price->additionalSeatCost;
                $price_last = array_slice($prices, -2, 1, true);
                $key = key($price_last);
                $value = current($price_last);
                $additional_price = $additionalcost * ($kidscount - $key);
                $totalprice = $value + $additional_price;
                $price = $this->display_price($totalprice);
                /*if(isset($packagecalc)){ echo "exist";
            $total_prices = count($prices);
            $no_of_prices = $total_prices-1;
            $seatprice = $packagepricelist->price->$no_of_prices;
            $totalkids = $kidscount-$no_of_prices;
            $extra_price = $totalkids*$additionalcost;
            $price = $extra_price+$seatprice;
            }*/

            }
            if (isset($renewal_freq) && $renewal_freq == true) {
                $frequency = $this->RenewalFrequencyCalc($packagepricelist->validFor, $packagepricelist->validForUnit);
                $price = $price . $frequency;
            }
            return $price;
        }

    }

    /**
     * get value from array/object if set
     *
     * @param String $key
     * @param Mixed $Data
     *
     * return Mixed
     */
    public function getValue($key, $Data, $print = true)
    {
        if (is_array($Data)) {
            if (array_key_exists($key, $Data)) {
                if ($print) {
                    if (is_array($Data[$key])) {
                        return $Data[$key];
                    } else {
                        echo $Data[$key];
                    }
                } else {
                    return $Data[$key];
                }
            }
        }

        if (isset($Data->$key)) {
            if ($print) {
                echo $Data->$key;
            } else {
                return $Data->$key;
            }
        }

        return false;
    }

    /**
     * mask any string
     *
     * @param String $string
     * @param type $maskingCharacter
     * @return String
     */
    private function ccMasking($string, $maskingCharacter = '*')
    {
        $length = strlen($string);
        $output = substr_replace($string, str_repeat($maskingCharacter, $length - 4), 0, $length - 4);
        return $output;
    }

    /**
     * get country dialcode
     *
     */
    public function kmGetCountryDialCode()
    {
        global $KmUser, $fielddaySetting;
        $kmUserDialCode = '1'; // Default value
        if ($KmUser) {
            $kmUserDialCodeSettings = $this->getValue('fieldday_provider_dial_code', $fielddaySetting, false) ?? '1';
            $kmUserDialCode = $this->getValue('countryCode', $KmUser, false) ?? $kmUserDialCodeSettings;
            if ($kmUserDialCodeSettings == '') {$kmUserDialCode = 1;}
        } elseif ($fielddaySetting) {
            $kmUserDialCode = $this->getValue('fieldday_provider_dial_code', $fielddaySetting, false) ?? '1';
            if ($kmUserDialCodeSettings == '') {$kmUserDialCode = 1;}
        }
        return $kmUserDialCode;
    }
    /**
     * get country code
     *
     */
    public function kmGetCountryCode()
    {
        global $KmUser, $fielddaySetting;
        $kmUserCountryCode = 'US'; // Default value
        if ($fielddaySetting) {
            $kmUserCountryCode = $this->getValue('fieldday_provider_country_code', $fielddaySetting, false) ?? 'US';
        }
        return $kmUserCountryCode;
    }

    /**
     * hide email address partially
     * @param string $email
     * @return type
     */
    public function emailMasking($email)
    {
        $em = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    /*
     * get all month names
     *
     * @return Array
     */

    public function KmMonths($key = null)
    {
        $months = [
            '01' => __('Jan', 'fieldday'),
            '02' => __('Feb', 'fieldday'),
            '03' => __('Mar', 'fieldday'),
            '04' => __('Apr', 'fieldday'),
            '05' => __('May', 'fieldday'),
            '06' => __('Jun', 'fieldday'),
            '07' => __('Jul', 'fieldday'),
            '08' => __('Aug', 'fieldday'),
            '09' => __('Sep', 'fieldday'),
            '10' => __('Oct', 'fieldday'),
            '11' => __('Nov', 'fieldday'),
            '12' => __('Dec', 'fieldday'),
        ];
        if ($key) {
            $intKey = $key + 1;
            $intKey = ($intKey < 10) ? "0" . $intKey : $intKey;
            return $this->getValue($intKey, $months, false);
        }
        return $months;
    }

    /** fieldday purchase form steps
     * @param Int $stepId form id to return single step
     * return Mixed
     */
    public function Km_purchase_Steps($stepId = null)
    {
        $steps = [
            1 => ['name' => 'personal_information', 'classes' => 'km_active_step km_single_step personal_information', 'label' => $this->displayText('km_checkout_personal_info_lable', false)],
            2 => ['name' => 'kid_information', 'classes' => 'km_single_step kid_information', 'label' => $this->displayText('km_checkout_kid_info_lable', false)],
            3 => ['name' => 'purchase_details', 'classes' => 'km_single_step purchase_details', 'label' => $this->displayText('km_checkout_purchase_info_lable', false)],
            4 => ['name' => 'purchase_confirmation', 'classes' => 'km_single_step purchase_confirmation', 'label' => $this->displayText('km_checkout_purchase_confirmation_lable', false)],
        ];

        if ($stepId && array_key_exists($stepId, $steps)) {
            return $steps[$stepId];
        }

        return $steps;
    }

    /**
     * get the kid information
     * @param array $kids
     * @return array Kids information
     */
    public function getKids($kids = [])
    {
        $KidInformation = [];
        if (empty($kids)) {
            if (is_array($kids)) {
                $allkids = fieldday()->api->GetKids();
                if ($allkids->statusCode == 200) {
                    foreach ($allkids->data as $key => $kid) {
                        $kidInfo = $this->getSingleKid($kid->_id);
                        if ($kidInfo) {
                            $KidInformation[] = $kidInfo;
                        }
                    }
                }
            }
            return $KidInformation;
        } else {
            foreach ($kids as $key => $kidId) {
                $kidInfo = $this->getSingleKid($kidId);
                if ($kidInfo) {
                    $KidInformation[] = $kidInfo;
                }
            }
        }
        return $KidInformation;
    }

    /**
     * add new kid in fieldday
     *
     * @param array $profile profile data
     * @param array $forms
     *
     * @return mixed kid information object from fieldday API
     */
    public function addNewKid(array $profile, array $forms = [])
    {
        /* add new kid */
        if (trim($this->getValue('school', $profile, false) == '' || trim($this->getValue('school', $profile, false) == 'select'))) {
            unset($profile['school']);
        }
        $apiResponse = fieldday()->api->AddKid($profile);

        if ($apiResponse->statusCode !== 201) {
            return false;
        }
        $kidId = $apiResponse->data->_id;
        /* add forms */
        if ($forms && $kidId) {
            if (array_key_exists('medicalInsurance', $forms)) {
                unset($forms['medicalInsurance']);
            }
            if (array_key_exists('dentalInsurance', $forms)) {
                unset($forms['dentalInsurance']);
            }
            $kidFormData = ['kidId' => $kidId, 'forms' => $forms];
            fieldday()->api->SaveMedicalForms($kidFormData);
        }

        return $apiResponse->data;
    }

    /**
     * check if forms are required or not
     * @param array $kidForms
     */
    public function isParticipantFormRequired($kidForms)
    {
        $totalForms = null;
        foreach ($kidForms as $key => $value) {
            if ($value === true) {
                $totalForms = $totalForms + 1;
            }
        }

        return $totalForms;
    }

    /**
     *
     * @param String $kidId kid Id
     *
     * @return Mixed Single kid infomation object
     */
    public function getSingleKid($kidId)
    {
        /* get info from cookie */
        $kids_from_cookie = $this->getCookieStorage('km_saved_kids');
        if (array_key_exists($kidId, $kids_from_cookie) && preg_match("/new_kid_/", $kidId)) {
            $kidInfo = new stdClass;
            $kidInfo->_id = $kidId;
            $kidProfile = $kids_from_cookie->$kidId;
            $schoolId = isset($kidProfile->school->_id) ? $kidProfile->school->_id : null;
            if ($schoolId) {
                $schoolresponse = fieldday()->api->getSchoolInfo($schoolId);
                if ($schoolresponse->statusCode === 200) {
                    $kidProfile->school = $schoolresponse->data;
                }
            }
            $kidInfo->kidProfile = $kidProfile;

            return $kidInfo;
        } else {
            $response = $this->kidAllDetail($kidId);
            return $response;
        }
        return false;
    }

    /**
     *
     * @param String $kidId kid Id
     *
     * @return Mixed Single kid infomation object
     */
    private function kidAllDetail($kidId)
    {
        $response = fieldday()->api->GetKidDetail($kidId);
        $insurance = fieldday()->api->GetInsurance();
        if ($response->statusCode === 200) {
            if ($insurance->statusCode === 200) {
                $response->data->dentalInsurance = $insurance->data->dentalInsurance;
                $response->data->medicalInsurance = $insurance->data->medInsurance;
            }

            return $response->data;
        }
    }

    /**
     * create array of unique kids to fill the unique data in medical forms
     *
     * @return mixed mixed array of unique kids data with forms
     */
    public function getUniqueKids()
    {
        $uniqueKids = [];
        $cartdata = $this->GetCartData();
        //$cartdata = json_decode(json_encode($cartdata), true);
        foreach ($cartdata as $sess_key => $sessionItem) {
            $forms = [];
            //$session_info = $sessionItem['session_detail'];
            $sessionKidFormsValidation = $sessionItem->activityId->regFormValidations;
            //$sessionKidFormsValidation = $sessionItem['activityId']['regFormValidations'];
            $sessionItemKids = json_decode(json_encode($sessionItem->kidId), true);
            foreach ($sessionItemKids as $key => $kid) {
                $kidId = (array_key_exists('_id', $kid) && $kid['_id']) ? $kid['_id'] : $this->generateRandomId(16, 'new_kid_');
                $uniqueKids[$kidId]['kidInfo'] = $kid;

                //Doctors
                $uniqueKids[$kidId]['forms']['kidsDoctors'] = $this->add_kidform_value('kidsDoctors', $uniqueKids[$kidId], $sessionKidFormsValidation);
                $uniqueKids[$kidId]['forms']['kidsDietRestricts'] = $this->add_kidform_value('kidsDietRestricts', $uniqueKids[$kidId], $sessionKidFormsValidation);
                //Medical

                $uniqueKids[$kidId]['forms']['kidsTreatments'] = $this->add_kidform_value('kidsTreatments', $uniqueKids[$kidId], $sessionKidFormsValidation);
                $uniqueKids[$kidId]['forms']['kidsSymptoms'] = $this->add_kidform_value('kidsSymptoms', $uniqueKids[$kidId], $sessionKidFormsValidation);

                //Allergies
                $uniqueKids[$kidId]['forms']['kidsFoodAllergies'] = $this->add_kidform_value('kidsFoodAllergies', $uniqueKids[$kidId], $sessionKidFormsValidation);
                $uniqueKids[$kidId]['forms']['kidsEnvironmentAllergies'] = $this->add_kidform_value('kidsEnvironmentAllergies', $uniqueKids[$kidId], $sessionKidFormsValidation);

                $uniqueKids[$kidId]['forms']['kidsMedicationAllergies'] = $this->add_kidform_value('kidsMedicationAllergies', $uniqueKids[$kidId], $sessionKidFormsValidation);

                //Insurance
                $uniqueKids[$kidId]['forms']['kidsMedicalInsurances'] = $this->add_kidform_value('kidsMedicalInsurances', $uniqueKids[$kidId], $sessionKidFormsValidation);
                $uniqueKids[$kidId]['forms']['kidsDentalInsurances'] = $this->add_kidform_value('kidsDentalInsurances', $uniqueKids[$kidId], $sessionKidFormsValidation);

                $uniqueKids[$kidId]['forms']['kidsHealthConcerns'] = $this->add_kidform_value('kidsHealthConcerns', $uniqueKids[$kidId], $sessionKidFormsValidation);
            }
        }
        //echo "<pre>"; print_r($uniqueKids); echo "</pre>";
        return $uniqueKids;
    }

    /**
     *
     * @param String $key medical form key in Kid information from API
     * @param mixed $Kid kid information object from fieldday
     * @param mixed $sessionForms forms supported by session in session infor from fieldday API
     * @return boolean if form required or not
     */
    private function add_kidform_value($key, $Kid, $sessionForms)
    {
        if (isset($sessionForms->$key) && $sessionForms->$key === true) {
            return true;
        }
        if (isset($Kid['forms']) && array_key_exists($key, $Kid['forms']) && $Kid['forms'][$key] === true) {
            return true;
        }

        return false;
    }

    /**
     * get facebook auth sacreen url
     * @param Array $params fieldday website redirect after login
     * @return String Facebook auth sacreen url
     *
     */
    public function getFacebookAuthUrl($params = [])
    {
        $state = "facebook";
        if ($params) {
            $state .= "_" . implode("_", $params);
        }
        $args = [
            'client_id' => $this->fb_client_id,
            'redirect_uri' => $this->fb_redirect_url,
            'response_type' => 'code',
            'scope' => 'email',
            'state' => $state,
        ];

        return add_query_arg($args, 'https://www.facebook.com/dialog/oauth');
    }

    /**
     * get google auth sacreen url
     * @param String $params extra parameters to send
     * @return String google auth sacreen url
     *
     */
    public function getGooglekAuthUrl($params = [])
    {
        $state = "google";
        if ($params) {
            $state .= "_" . implode("_", $params);
        }
        $args = [
            'client_id' => $this->google_client,
            'redirect_uri' => $this->google_redirect_url,
            'response_type' => 'code',
            'scope' => 'email profile',
            'state' => $state,
        ];

        return add_query_arg($args, 'https://accounts.google.com/o/oauth2/auth');
    }

    public function googleRecaptcha($captcha = null, $return = null)
    {if (!$captcha) {$captcha = 'g-recaptcha';}
        if ($return) {
            return $html = '<div id="' . $captcha . '" class="' . $captcha . '" data-sitekey="' . $this->google_recaptcha_key . '"></div>';
        } else {
            echo wp_sprintf('<div id="%s" class="%s" data-sitekey="%s"></div>', $captcha, $captcha, $this->google_recaptcha_key);
        }}

    /**
     *
     * @param String $recaptcha google recaptcha code
     *
     * @return Array resposne from google
     */
    public function recaptchaVerify($recaptcha)
    {
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = add_query_arg(['secret' => $this->google_recaptcha_secret, 'response' => $recaptcha, 'remoteip' => $ip], $google_url);
        $results = wp_remote_get($url);
        if ($results['response']['code'] === 200) {
            return json_decode($results['body'], true);
        }

        return ['success' => false];
    }

    /**
     *
     * @param Mixed $userData
     *
     * @return Int wordpress user id
     */
    public function fielddayDoLogin($userData)
    {
        if (!isset($userData->_id)) {
            return false;
        }

        if ($userId = username_exists($userData->_id)) {
            wp_clear_auth_cookie();
            /* update user meta */
            update_user_meta($userId, 'km_user_data', $userData);
            $theUser = new WP_User($userId);
            $theUser->add_role(fieldday_ROLE);
            wp_set_current_user($userId);
            wp_set_auth_cookie($userId);
            return $userId;
        } else if ($userId = email_exists($userData->email)) {
            wp_clear_auth_cookie();
            /* update user meta */
            update_user_meta($userId, 'km_user_data', $userData);
            $theUser = new WP_User($userId);
            $theUser->add_role(fieldday_ROLE);
            wp_set_current_user($userId);
            wp_set_auth_cookie($userId);
            return $userId;
        } else {
            /* register a user with fieldday_user role */
            //$userId = register_new_user($userData->_id, $userData->email);
            $userdata = array(
                'user_login' => $userData->_id,
                'user_pass' => $userData->_id,
                'user_email' => $userData->email,
            );

            $userId = wp_insert_user($userdata);
            if (!is_wp_error($userId)) {
                wp_clear_auth_cookie();
                $this->UpdateWordpressUser($userId, $userData);
                wp_set_current_user($userId);
                wp_set_auth_cookie($userId);
                return $userId;
            } else {
                return false;
            }
        }
    }

    /**
     * login user in fieldday with facebook
     * @param String $code facebook code from auth login screen
     * @return Mixed
     */
    public function fielddayFacebookLogin($code)
    {
        $data = [
            'clientId' => $this->fb_client_id,
            'redirectUri' => $this->fb_redirect_url,
            'code' => $code,
        ];

        return fieldday()->api->LoginWithFacebook($data);
    }

    /**
     * login user with google
     * @param String $code google auth code
     * @return Mixed Response
     */
    public function fielddayGoogleLogin($code)
    {
        $data = [
            'clientId' => $this->google_client,
            'redirectUri' => $this->google_redirect_url,
            'code' => $code,
        ];

        return fieldday()->api->LoginWithGoogle($data);
    }

    /**
     * Update user data in wordpress database
     *
     * @param Int $userId wordpress inserted user
     * @param Array $userData
     *
     * @return Boolean response
     */
    private function UpdateWordpressUser($userId, $userData)
    {
        $data = [
            'ID' => $userId,
            'user_login' => $userData->_id,
            'display_name' => $userData->name,
            'role' => fieldday_ROLE,
        ];
        wp_update_user($data);

        /* update user meta */
        update_user_meta($userId, 'km_user_data', $userData);
    }

    /**
     *
     * @global type $fielddaySetting
     * @param type $redirect
     * @return String url
     */
    public function LoginRedirect($redirect = false)
    {
        global $fielddaySetting;

        $page = array_key_exists('login_redirect', $fielddaySetting) ? $fielddaySetting['login_redirect'] : null;
        if ($page) {
            $pagelink = get_page_link($page);
            if (!$redirect) {
                return $pagelink;
            }

            return wp_redirect($redirect);
        }
    }


    /**
     *
     * @global type $fielddaySetting
     * @param type $redirect
     * @return String url
     */
    public function ThankyouRedirect($redirect = false)
    {
        global $fielddaySetting;

        $page = array_key_exists('thankyou_page', $fielddaySetting) ? $fielddaySetting['thankyou_page'] : '';
        if ($page && $page!='') {
            $isPageExists = get_post($page);
            $pagelink = get_page_link($page);
            if (!$redirect && $isPageExists) {
                return $pagelink;
            }else{
                return ''; 
            }
            return wp_redirect($redirect);
        }else{
            return '';
        }
    }

    /**
     *
     * @global type $fielddaySetting
     * @param type $redirect
     * @return String url
     */
    public function myaccounyRedirect($redirect = false)
    {
        global $fielddaySetting;

        $page = array_key_exists('myaccount_redirect', $fielddaySetting) ? $fielddaySetting['myaccount_redirect'] : null;
        if ($page) {
            $pagelink = get_page_link($page);
            if (!$redirect) {
                return $pagelink;
            }

            return wp_redirect($redirect);
        }
    }

    /**
     * fieldday session register trigger
     * @param String $sessionId Session Id
     * @param String $tagId session Tag Id if one dayonly, morning only or weeklu etc
     * @param Date $sessionDate session onedayselected date only for one day session
     * @param Boolean $guest force to login or not
     * @param Date String $sessionDate session Date if one day session
     *
     * @return String javascript function to display login form or to register a session
     */
    public function sessionRegister($sessionId = null, $tagId = null, $sessionDate = null, $guest = false, $sessionfeatured = null, $typevent = null)
    {
        if (!$this->isKmLogin() && $guest === false) {
            if ($typevent != 'multiweek' && isset($_SESSION['typeofuser'])) {
                return wp_sprintf('onclick="fieldday.registerSession(\'%s\', \'%s\', \'%s\', \'%s\')"', $sessionId, $tagId, $sessionDate, $sessionfeatured);
            } else {
                return wp_sprintf('data-session-id="%s" data-tag-id="%s" data-session-date="%s" onclick="fieldday.showAuthPopup(this, event)"', $sessionId, $tagId, $sessionDate, '', '', 'event');
            }
        }
        else if ($sessionId && $guest === true) {
            return wp_sprintf('onclick="fieldday.registerSession(\'%s\', \'%s\', \'%s\',\'%s\')"', $sessionId, $tagId, $sessionDate, $sessionfeatured);
        } else {
            return wp_sprintf('onclick="fieldday.registerSession(\'%s\', \'%s\', \'%s\', \'%s\')"', $sessionId, $tagId, $sessionDate, $sessionfeatured);
        }
        //}
        //}
    }

    public function packageRegister($sessionId = null, $packageId = null, $guest = false)
    {
        if (!$this->isKmLogin() && $guest === false) {

            if (isset($_SESSION['typeofuser'])) {
                return wp_sprintf('onclick="fieldday.registerPackage(\'%s\',\'%s\')"', $sessionId, $packageId);
            } else {
                return wp_sprintf('data-session-id="%s" data-isguest="false" data-ispackage="true" onclick="fieldday.showAuthPopup(this, event)"', $sessionId, $packageId);
            }
        } else if ($sessionId && $guest === true) {
            return wp_sprintf('onclick="fieldday.registerPackage(\'%s\',\'%s\')"', $sessionId, $packageId);
        } else {
            return wp_sprintf('onclick="fieldday.registerPackage(\'%s\',\'%s\')"', $sessionId, $packageId);
        }

    }
    public function eventRegister($sessionId = null, $typevent = null, $guest = false)
    {
        if (!$this->isKmLogin() && $guest === false) {
            return wp_sprintf('onclick="fieldday.registerEvent(\'%s\',\'%s\')"', $sessionId, 'event');
            /*******************AS PER THE REQUIREMENTS LOGIN PROCESS IS TO BE SKIPPED FOR QUICK PURCHASE************ */
            /*
            if (isset($_SESSION['typeofuser'])) {
                return wp_sprintf('onclick="fieldday.registerEvent(\'%s\',\'%s\')"', $sessionId, 'event');
            } else {
                return wp_sprintf('data-session-id="%s" data-type="%s" onclick="fieldday.showAuthPopup(this, event)"', $sessionId, 'event');
            }
            */
        } else if ($sessionId && $guest === true) {
            return wp_sprintf('onclick="fieldday.registerEvent(\'%s\',\'%s\')"', $sessionId, 'event');
        } else {
            return wp_sprintf('onclick="fieldday.registerEvent(\'%s\',\'%s\')"', $sessionId, 'event');
        }

    }

    public function sessionWaitList($sessionId = null, $tagId = null, $sessionDate = null, $guest = false, $sessionfeatured = null, $typevent = null)
    {
        if (!$this->isKmLogin() && $guest === false) {
            return wp_sprintf('data-session-id="%s" data-tag-id="%s" data-session-date="%s" onclick="fieldday.showAuthPopup(this, event)"', $sessionId, $tagId, $sessionDate, '', '', 'event');
        } else {
            return wp_sprintf('onclick="fieldday.registerSession(\'%s\', \'%s\', \'%s\', \'%s\', \'%s\')"', $sessionId, $tagId, $sessionDate, $sessionfeatured, 'waitlist');
        }

    }

    public function InstallmentPopup($sessionId = null, $tagId = null, $sessionDate = null, $guest = false, $sessionfeatured = null)
    {
        print wp_sprintf('onclick="fieldday.InstallmentPlans(\'%s\', \'%s\', \'%s\', \'%s\')"', $sessionId, $tagId, $sessionDate, $sessionfeatured);

    }

    /**
     *
     * @param String $offerId shopping package ID
     * @param type $guest if guest user allow to continue as guest
     *
     * @return String click function and other related informations
     */
    public function merchandiseRegister($offerId, $offername, $guest = false, $sessionfeatured = null)
    {
        if (!$this->isKmLogin() && $guest === false) {
            if (isset($_SESSION['typeofuser'])) {
                print wp_sprintf('onclick="fieldday.registermerchandise(\'%s\', \'%s\')"', $offerId, $offername);
            } else {
                print wp_sprintf('data-offer-id="%s" data-offer-name="%s" onclick="fieldday.showAuthPopup(this, event)"', $offerId, $offername);
            }
        } else {
            print wp_sprintf('onclick="fieldday.registermerchandise(\'%s\', \'%s\')"', $offerId, $offername);
        }
    }

    /**
     * if user is loggedin with fieldday role
     * @return boolean
     */
    public function isKmLogin()
    {
        global $KmUser;
        if (is_user_logged_in() && current_user_can(fieldday_ROLE) && $KmUser) {
            return true;
        }

        return false;
    }

    /**
     * get the option list of all schools for select
     * @param Array $schoolInfo selected school id
     * @return String option html
     */
    public function displaySchools($schoolInfo = [])
    {
        $ProviderSchools = fieldday()->api->getProviderSchools();
        $selected = isset($schoolInfo->_id) ? $schoolInfo->_id : null;
        if ($ProviderSchools->statusCode == 200) {
            foreach ($ProviderSchools->data as $key => $schools) {
                $slect = $selected == $schools->_id ? "selected" : '';
                print "<option {$slect} value='{$schools->_id}'>{$schools->name}</option>";
            }
        }
    }

    /**
     *
     * @param String $date full date string
     *
     * @return Date date in wordpress format
     */
    public function parseDate($date, $format = 'Y-m-d')
    {
        if ($date) {
            return date($format, strtotime($date));
        }
    }

    public function return_week($datee)
    {
        $duedt = explode("-", $datee);
        $date = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        $week = (int) date('W', $date);
        return $week;
    }

    /**
     *
     * @param String $date full date string
     *
     * @return Date date in wordpress format
     */
    public function weeks_between($strtDate, $endDate)
    {
        // input dates of format yyyy-mm-dd between which you want to get number of weeks
        $start_date = new DateTime($strtDate);

        //$start_date = DateTime::createFromFormat("Y-m-d", $strtDate);
        //print_r($start_date);
        //echo $start_date->date;
        $end_date = new DateTime($endDate);

        //$end_date =  DateTime::createFromFormat("Y-m-d", $endDate);
        //print_r($end_date);
        //echo $end_date->date;
        $start_year = $start_date->format("Y");
        $end_year = $end_date->format("Y");
        $start_month = $start_date->format("m");
        $end_month = $end_date->format("m");
        $week1 = $this->return_week($strtDate);
        $week2 = $this->return_week($endDate);
        $diff = $end_year - $start_year;
        if ($end_month < $start_month && $start_year != $end_year) {
            $week_diff = (52 * $diff - $week1) + $week2 + 1;
            return ($start_year == $end_year) ? $week_diff : abs($week_diff);
        } else {
            $week_diff = $week2 - $week1 + 1;
            return ($start_year == $end_year) ? $week_diff : abs($week_diff) + 52 * $diff;
        }

    }

    /**
     *
     * @param String $date full date string
     *
     * @return Time time in wordpress format
     */
    public function parseTime($date)
    {
        if ($date) {
            return date(get_option('time_format'), strtotime($date));
        }
    }

    /**
     *
     * @param mixed $session
     *
     * @return string session single image url
     */
    public function getsessionImageUrl($session)
    {
        $sessionPhotoURL = $session->activityId->photosURL;

        return $sessionPhotoURL[0]->original;
    }

    /**
     * display session image
     *
     * @param mixed $session session data from fieldday API
     *
     * @return Html image tag with session Thumb url
     */
    public function displaySessionThumb($session, $multiple = false, $return = false, $if_detailed_view_widget_page = false)
    {
        $sessionPhotoURL = isset($session->activityId->photosURL) ? $session->activityId->photosURL : [];
        $photoOriginal = null;
        if ($multiple) {
            $sessionPhotoURL[] = $session->sessionImage;
            $sessionPhotoURL = array_reverse($sessionPhotoURL);
            $class = count($sessionPhotoURL) > 1 ? "km_slick_theme km_slides" : "";
            $html = "<div class='" . $class . "'>";
            if ($sessionPhotoURL) {
                foreach ($sessionPhotoURL as $photo) {
                    if ($photo->original) {
                        $html .= wp_sprintf('<div><div class="km_inner_slider_img_wrap"><img src="%s" alt="%s" title="%s" /></div></div>', $photo->original, $session->name, $session->name);
                    } else {
                        $html .= wp_sprintf('<div><div class="km_inner_slider_img_wrap"><img src="%s" /></div></div>', fieldday_PLACEHOLDER);
                    }
                }
            } else {
                $html .= wp_sprintf('<div><div class="km_inner_slider_img_wrap"><img src="%s" /></div></div>', fieldday_PLACEHOLDER);
            }
            $html .= "</div>";

            print $html;
        } else {

            $sessionPhotoURL = isset($session->sessionImage->original) ? $session->sessionImage->original : null;

            if ($sessionPhotoURL) {
                if ($return == true) {
                    $html = '<img src="' . $sessionPhotoURL . '" alt="' . $session->name . '" title="' . $session->name . '" />';
                    return $html;
                } else {
                    print wp_sprintf('<img src="%s" alt="%s" class="km_single_image_wthout_slide" title="%s" />', $sessionPhotoURL, $session->name, $session->name);
                }

            } else {
                if ($return == true) {
                    $html = '<img src="' . fieldday_PLACEHOLDER . '" alt="' . __('Field Day Placeholder') . '" title="' . __('Field Day Placeholder') . '" />';
                    return $html;
                } else {
                    print wp_sprintf('<img src="%s" alt="%s"  class="km_single_image_wthout_slide"  title="%s" />', fieldday_PLACEHOLDER, __('Field Day Placeholder'), __('Field Day Placeholder'));
                }

            }
        }
    }

    /**
     *
     * @param Object $session fieldday session object
     *
     * @return mixed array of imp session vars
     */
    private function GetSessionVar($session)
    {
        $vars = [
            'activityType' => 'weekly',
            'activityTitle' => 'Full Week',
            'SeatsClass' => 'text-danger',
        ];
        /* set activity type and title */
        if ($this->getValue('oneDayType', $session, false) == 'halfDayEvng') {
            $vars['activityType'] = 'eveningonly';
            $vars['activityTitle'] = 'Evening Only';
        } elseif ($this->getValue('oneDayType', $session, false) == 'halfDayMrng') {
            $vars['activityType'] = 'morningonly';
            $vars['activityTitle'] = 'Morning Only';
        } elseif ($this->getValue('oneDayType', $session, false) == 'fullDay') {
            $vars['activityType'] = 'fullday';
            $vars['activityTitle'] = 'Full Day';
        }
        /* set activity type and title */
        /* set seats availabilty class */
        $availableSpots = $this->getValue('availableSpots', $session, false);
        if ($availableSpots > 10) {
            $vars['SeatsClass'] = "text-success";
        } elseif ($availableSpots < 10 && $availableSpots > 5) {
            $vars['SeatsClass'] = "text-warning";
        }

        /* set seats availabilty class */
        return $vars;
    }

    /**
     * order confermation text
     */
    public function getOrderConfirmationText()
    {
        print wp_sprintf('<h4>%s</h4><p>%s</p>', __('Order Confirmation', 'fieldday'), __('Take a minute to review everything below and make sure it all looks correct.', 'fieldday'));
    }

    /**
     *
     * @param String $textId Id for the string
     * @param Bolean $print print or return the value
     * @return String display filtered text
     */
    public function displayText($textId, $print = true)
    {

        return $this->getValue($textId, $this->getLabelValues(), $print);
    }

    /**
     *
     * @param String $key cookie key
     * @param (boolen) $decode is return in decode or not.
     * @return mixed
     */
    public function getCookieStorage($key, $decode = true)
    {
        $cookie = $this->getValue($key, $_COOKIE, false);
        if (!$cookie) {
            return [];
        }
        if ($decode) {
            return json_decode(stripslashes($cookie));
        }

        return $cookie;
    }

    /**
     *
     * @param Int $length lenght of the generated Id
     *
     * @return String generated tring of give length
     */
    public function generateRandomId($length = 16, $prefix = null)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = $prefix;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     *
     * @return cart sidepopup html
     */

    public function GetCartView()
    {
        $item = '<li id="menu_item_km_cartinfo" class="menu-item">';
        $cartdata = $this->GetCartData();
        //print_r($cartdata);
        if ($cartdata) {
            $count = count($cartdata);
        } else {
            $count = 0;
        }
        $item .= '<div class="km_cart_toggle">
                    <span id="km_cart_total_count" class="km_secondary_color">' . $count . '</span>
                    <svg baseProfile="tiny" class="km_secondary_color" height="30px" version="1.2" viewBox="0 0 30 10" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Layer_1"  fill-rule="evenodd">
                            <g>
                                <path d="M20.756,5.345C20.565,5.126,20.29,5,20,5H6.181L5.986,3.836C5.906,3.354,5.489,3,5,3H2.75c-0.553,0-1,0.447-1,1    s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124c0.016,0.053,0.029,0.103,0.054,0.151    c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112c0.058,0.054,0.125,0.092,0.193,0.13    c0.038,0.021,0.071,0.049,0.112,0.065C6.748,16.972,6.87,17,6.999,17C7,17,18,17,18,17c0.553,0,1-0.447,1-1s-0.447-1-1-1H7.847    l-0.166-1H19c0.498,0,0.92-0.366,0.99-0.858l1-7C21.031,5.854,20.945,5.563,20.756,5.345z M18.847,7l-0.285,2H15V7H18.847z M14,7    v2h-3V7H14z M14,10v2h-3v-2H14z M10,7v2H7C6.947,9,6.899,9.015,6.852,9.03L6.514,7H10z M7.014,10H10v2H7.347L7.014,10z M15,12v-2    h3.418l-0.285,2H15z"/>
                                <circle cx="8.5" cy="19.5" r="1.5"/>
                                <circle cx="17.5" cy="19.5" r="1.5"/>
                            </g>
                        </g>
                    </svg>
                </div>
                <div id="km_cart_items_wrap"></div>';
        $item .= '</li>';
        return $item;
    }

    /**
     * get the fieldday cart items
     *
     * @return array cart items
     */
    public function GetCartData($completearray = false)
    {
        global $fielddaySetting;global $KmUser;
        $GcartId = fieldday()->engine->getCookieStorage('GcartId', false);
        $GparentId = fieldday()->engine->getCookieStorage('GparentId', false);
        $apicartitems = fieldday()->api->GetCartItemApi($GcartId, $GparentId);
        //print_r($apicartitems);
        if ($apicartitems->statusCode === 200) {
            if ($completearray) {
                return $cartDetails = $apicartitems->data;
            } else {
                return $cartDetails = $apicartitems->data->cartDetails;
            }
        } else {
            return [];
        }

        /*if (array_key_exists('km_cart_items', $_SESSION))
    {
    if($KmUser){
    foreach($_SESSION['km_cart_items'] as $key=>$value){
    if(array_key_exists('Usertype', $_SESSION['km_cart_items'][$key])){
    $_SESSION['removed_cart_items'][$key] = $value;
    unset($_SESSION['km_cart_items'][$key]);
    }
    }
    }
    return $_SESSION['km_cart_items'];
    }
    return [];*/
    }

    /**
     * save item to cart
     *
     * @param array $item
     * @param string $cartKey cart item key to update existing item
     *
     * @return mixed cart items
     */
    /*   public function saveCartItem(array $item, $cartKey = null)
    { //notinuse
    $cartData = $this->GetCartData();
    if (!$cartKey)
    {
    $cartKey = $this->generateRandomId(8);
    }
    $cartData[$cartKey] = $item;
    $_SESSION['km_cart_items'] = $cartData;

    return $cartData;
    }*/

    /**
     * remove one item from cart
     *
     * @param String $itemKey cart item key to delete item
     *
     * @return mixed updated cart data
     */
    /*public function removeCartItem($itemKey)
    { //notinuse
    $cartData = $this->GetCartData();
    if (array_key_exists($itemKey, $cartData))
    {
    unset($cartData[$itemKey]);
    }

    $_SESSION['km_cart_items'] = $cartData;

    return $cartData;
    }*/

    /**
     * remove one item from cart
     *
     * @param String $itemKey cart item key to delete item
     *
     * @return mixed updated cart data
     */
    public function getCartItem($itemKey)
    {
        $cartData = $this->GetCartData();
        return $this->getValue($itemKey, $cartData, false);
    }

    /**
     * remove cart data
     *
     * @return mixed updated cart data
     */
    /*public function removeCart()
    {
    $_SESSION['km_cart_items'] = [];
    }*/

    /**
     * get form data saved in kid profile
     *
     * @param String $formtype
     * @param mixed $kid_data
     *
     * @return mixed kidformdata
     */
    private function getKidFormData($formtype, $kid_data)
    {
        $mappedData = [
            'kidsDoctors' => 'doctors',
            'kidsDietRestricts' => 'dietRestricts',
            'kidsTreatments' => 'treatments',
            'kidsSymptoms' => 'symptoms',
            'kidsFoodAllergies' => 'foodAllergies',
            'kidsEnvironmentAllergies' => 'environmentAllergies',
            'kidsMedicationAllergies' => 'medicationAllergies',
            'kidsMedicalInsurances' => 'medicalInsurance',
            'kidsDentalInsurances' => 'dentalInsurance',
            'kidsHealthConcerns' => 'healthConcerns',
        ];

        if (array_key_exists($formtype, $mappedData)) {
            $objectkey = $mappedData[$formtype];
            if (isset($kid_data->$objectkey) && !empty((array) $kid_data->$objectkey)) {
                return $kid_data->$objectkey;
            }
        }

        return false;
    }

    /**
     * generate the kid forms HTML
     *
     * @param mixed $kid_data kid information object
     * @param String $formtype
     * @param Int $kidNumber
     * @param String $modalId
     *
     * @return HTML form html
     */
    public function kid_formpopup($kid_data, $formtype, $kidNumber, $modalId)
    {
        $wrapperId = $formtype . '_' . $kidNumber;
        $output = '<div id="' . $modalId . '" class="km_modal km_kids_form_modal km_overlay modal-large">
            <div class="km_modal_alert">
                <a href="" data-popup-id="#' . $modalId . '" class="km_popup_close">
                    <svg width="12" height="12" viewport="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <line x1="1" stroke="#fff" y1="11" x2="11" y2="1" stroke-width="2"></line>
                        <line x1="1" y1="1" stroke="#fff" x2="11" y2="11" stroke-width="2"></line>
                    </svg>
                </a>
                <div class="km_modal_heading">' . $this->MedicalFormLable($formtype) . '</div>';
        $output .= '<div class="km_modal_content">';
        switch ($formtype) {
            case 'kidsDoctors':
                $output .= $this->__km_doctor_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsHealthConcerns':
                $output .= $this->__km_health_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsTreatments':
                $output .= $this->__km_treatment_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsSymptoms':
                $output .= $this->__km_symptoms_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsFoodAllergies':
                $output .= $this->__km_food_allergies_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsEnvironmentAllergies':
                $output .= $this->__km_environment_allergies_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsDietRestricts':
                $output .= $this->__km_diet_restricts_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsMedicationAllergies':
                $output .= $this->__km_medication_allergies_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsMedicalInsurances':
                $output .= $this->__km_medical_insurances_form($wrapperId, $kidNumber, $kid_data);
                break;
            case 'kidsDentalInsurances':
                $output .= $this->__km_dental_insurances_form($wrapperId, $kidNumber, $kid_data);
                break;
            default:
                break;
        }
        $output .= '</div>';
        $output .= '<div class="km_modal_footer">
                    <a data-form-type="' . $formtype . '" data-kid-id="' . $kidNumber . '" href="#" class="km_btn save_medical_forms km_primary_bg">Save</a>
                </div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    /**
     *
     * @param String $key Form key
     *
     *
     */
    public function MedicalFormLable($key)
    {
        $defaults = [
            'kidsDoctors' => apply_filters('fieldday_doctor_form_lable', __('Doctors', 'fieldday')),
            'kidsDietRestricts' => apply_filters('fieldday_dietrestrict_form_lable', __('Diet Restrictions', 'fieldday')),
            'kidsTreatments' => apply_filters('fieldday_treatments_form_lable', __('Treatments', 'fieldday')),
            'kidsSymptoms' => apply_filters('fieldday_symptoms_form_lable', __('Symptoms', 'fieldday')),
            'kidsFoodAllergies' => apply_filters('fieldday_food_allergies_form_lable', __('Food Allergies', 'fieldday')),
            'kidsEnvironmentAllergies' => apply_filters('fieldday_environment_allergies_form_lable', __('Environment Allergies', 'fieldday')),
            'kidsMedicationAllergies' => apply_filters('fieldday_medication_allergies_form_lable', __('Medication Allergies', 'fieldday')),
            'kidsMedicalInsurances' => apply_filters('fieldday_medical_insurance_form_lable', __('Medical Insurances', 'fieldday')),
            'kidsDentalInsurances' => apply_filters('fieldday_dental_insurance_form_lable', __('Dental Insurances', 'fieldday')),
            'kidsHealthConcerns' => apply_filters('fieldday_health_concerns_form_lable', __('Health Concerns', 'fieldday')),
        ];

        if (array_key_exists($key, $defaults)) {
            return $defaults[$key];
        }
    }

    /**
     * Display Kid doctor fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_doctor_form($wrapperId, $kidNumber, $kid_data)
    {
        $doctor_info = $this->getvalue('doctors', $kid_data, false);
        return $this->getview('medicalforms/kid_doctor_form', ['wrapperId' => $wrapperId, 'doctor_info' => $doctor_info, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * display health form
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_health_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_heathConcerns = $this->getvalue('healthConcerns', $kid_data, false);
        return $this->getview('medicalforms/kid_health_form', ['wrapperId' => $wrapperId, 'kid_heathConcerns' => $kid_heathConcerns, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * Display treatments fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_treatment_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_heathConcerns = $this->getvalue('healthConcerns', $kid_data, false);
        $kid_treatments = $this->getvalue('treatments', $kid_data, false);

        return $this->getview('medicalforms/kid_treatment_form', ['wrapperId' => $wrapperId, 'kidNumber' => $kidNumber, 'kid_treatments' => $kid_treatments, 'kid_heathConcerns' => $kid_heathConcerns, 'kid_data' => $kid_data]);
    }

    /**
     * Display symptoms form fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_symptoms_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_symptoms = $this->getvalue('symptoms', $kid_data, false);
        $extremelyReactive = $this->getvalue('extremelyReactive', $kid_symptoms, false);
        $mildSymptoms = $this->getvalue('extremelyReactive', $kid_symptoms, false);

        return $this->getview('medicalforms/symptoms_form', ['wrapperId' => $wrapperId, 'mildSymptoms' => $mildSymptoms, 'extremelyReactive' => $extremelyReactive, 'kidNumber' => $kidNumber, 'kid_symptoms' => $kid_symptoms, 'kid_data' => $kid_data]);
    }

    /**
     * Display food allergies form fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_food_allergies_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_food_allergies = $this->getvalue('foodAllergies', $kid_data, false);
        return $this->getview('medicalforms/food_allergies_form', ['wrapperId' => $wrapperId, 'kid_food_allergies' => $kid_food_allergies, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * Display environment allergies fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_environment_allergies_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_environment_allergies = $this->getvalue('environmentAllergies', $kid_data, false);
        return $this->getview('medicalforms/environment_allergies_form', ['wrapperId' => $wrapperId, 'kid_environment_allergies' => $kid_environment_allergies, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * display diet restricts form
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_diet_restricts_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_dietRestricts = $this->getvalue('dietRestricts', $kid_data, false);
        return $this->getview('medicalforms/diet_restricts_form', ['wrapperId' => $wrapperId, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data, 'kid_dietRestricts' => $kid_dietRestricts]);
    }

    /**
     * display medical allergies
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_medication_allergies_form($wrapperId, $kidNumber, $kid_data)
    {
        $kid_medication_allregies = $this->getvalue('medicationAllergies', $kid_data, false);
        return $this->getview('medicalforms/medication_allergies_form', ['wrapperId' => $wrapperId, 'kid_medication_allregies' => $kid_medication_allregies, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * display medical unsrance form fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param type $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_medical_insurances_form($wrapperId, $kidNumber, $kid_data)
    {
        $insuranceData = [];
        return $this->getview('medicalforms/medical_insurances_form', ['wrapperId' => $wrapperId, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     * dispay dental insurance fields
     *
     * @param String $wrapperId wraper Id genrated
     * @param Int $kidNumber
     * @param mixed $kid_data object of kid information from fieldday API
     *
     * @return HTML Html form fields
     */
    private function __km_dental_insurances_form($wrapperId, $kidNumber, $kid_data)
    {
        $dentalInsuranceData = [];
        return $this->getview('medicalforms/dental_insurances_form', ['wrapperId' => $wrapperId, 'kidNumber' => $kidNumber, 'kid_data' => $kid_data]);
    }

    /**
     *
     * @param String $sessionId session id
     *
     * @return mixed session info object from fieldday API
     */
    public function getsingleSession($sessionId, $date = null)
    {
        $params = [];
        if ($date) {
            $params['oneDaySelectedDate'] = $date;
        }
        $sessionInfo = fieldday()->api->getActivitySession($sessionId, $params);
        if ($sessionInfo->statusCode === 200) {
            return $sessionInfo->data;
        }
    }

    /**
     * Display the applied credit i.e Day credit or Dollar credit
     *
     * @param type $cartInfo
     */
    public function getCreditApplied($cartInfo)
    {
        if ($cartInfo->isPerDayCredit === true) {
            return $cartInfo->storeCreditPaid . " Days";
        } else {
            return $this->display_price($cartInfo->storeCreditPaid);
        }
    }

    /**
     *
     * @param mixed $cartItemDetail
     */
    public function displayKidsOnCart($cartItemDetail)
    {
        if (array_key_exists('kids', $cartItemDetail)):
            print wp_sprintf("<b>%s(s):</b>", $this->displayText('km_kid_text', false));
            foreach ($cartItemDetail['kids'] as $key => $kidInfo) {
                $kidDisplayName = $this->getValue('knownAs', $kidInfo, false);
                if ($kidDisplayName) {
                    $kidDisplayName = $this->getValue('firstName', $kidInfo, false);
                }

                print wp_sprintf('<span class="cart_seat_title">%s</span>', $kidDisplayName);
            }
        endif;
    }

    public function displayCartSessionName($cartItemDetail)
    {
        $sessionInfo = $cartItemDetail['session_detail'];

        print $sessionInfo->name;
    }

    /**
     * Display additional charges on cart page
     *
     * @param object $cartInfo Cart information with calculation API
     *
     * @return String Additional charges HTML
     */
    public function displayAdditionalChargesOnCart($cartInfo)
    {
        $html = "";
        $additionalCharges = $this->getValue('additionalChargeDetails', $cartInfo, false);
        if ($additionalCharges) {
            foreach ($additionalCharges as $key => $singleItem) {
                $html .= wp_sprintf("<span class='km_add_charges_item'><span>%s</span><b> %s</b></span>", $singleItem->title, $this->display_price($singleItem->price));
            }
        } else {
            $html .= wp_sprintf("<div class='km_nodata_'>%s</div>", __("Additional Charges-N/A", 'fieldday'));
        }

        print $html;
    }

    public function displayPurchaseTags($purcaseData)
    {
        $additionalCharges = $this->getValue('additionalChargeDetails', $purcaseData, false);
        $html = "";
        if ($additionalCharges) {
            foreach ($additionalCharges as $key => $singleItem) {
                $html .= wp_sprintf("<span class='km_purcase_tags km_tags km_additionalcharg_tag km_primary_bg'>%s</span>", $singleItem->title);
            }
        }

        $selectedCare = $this->getValue('extendedCareSelected', $purcaseData, false);
        if ($selectedCare) {
            if (array_key_exists($selectedCare, $this->extendedCareTypes())) {
                $html .= wp_sprintf("<span class='km_purcase_tags km_tags km_extendendcare_tag km_primary_bg'>%s</span>", $this->extendedCareTypes($selectedCare));
            }
        }

        print $html;
    }

    /**
     * Display top nav on my account page
     *
     * @return print html
     */
    public function displayAccountTopNav(array $data = [])
    {
        $html = $this->getView('account/accountnav', $data);
        print $html;
    }

    /**
     *
     * @param String $type Care type
     *
     * @return mixed array of care labels or single item lable
     */
    public function extendedCareTypes($type = null)
    {
        $cares = [
            'earlyCare' => __("Early Drop", 'fieldday'),
            'afterCare' => __("Late Pickup", 'fieldday'),
            'combined' => __("Early Drop + Late Pickup", 'fieldday'),
        ];

        if ($type) {
            return $this->getValue($type, $cares, false);
        } else {
            return $cares;
        }
    }

    /**
     * Display Extended care charges on cart page
     *
     * @param object $cartInfo Cart information with calculation API
     *
     * @return String extended care details HTML
     */
    public function displayExtendedCareOnCart($cartInfo, $cartItemDetail)
    {
        //additionalChargeDetails
        $html = "";
        $extendedCares = $this->getValue('extendedCareDetails', $cartItemDetail['session_detail'], false);
        $selectedCare = $this->getValue('extendedCareSelected', $cartInfo, false);
        $selectedCareData = $this->getValue($selectedCare, $extendedCares, false);
        if ($selectedCare) {
            if (array_key_exists($selectedCare, $this->extendedCareTypes())) {
                $html .= wp_sprintf("<span class='km_ext_care_item'><span>%s</span><b> %s</b></span>", $this->extendedCareTypes($selectedCare), $this->display_price($selectedCareData->pricePerSession));
            }
        } else {
            $html .= wp_sprintf("<div class='km_nodata_'>%s</div>", __("Extended Care charges-N/A", 'fieldday'));
        }

        print $html;
    }

    /**
     * Display formated price
     *
     * @param mixed $price price to format
     *
     * @return Float price string with symbol
     */
    public function display_price($price)
    {
        if (is_float($price)) {
            return fieldday_CURRENCY . number_format($price, 2);
        } else {
            return fieldday_CURRENCY . number_format($price, 0);
        }
    }

    /**
     *
     * @param mixed $object
     * @param String $key
     *
     * @return HTML string if checked
     */
    public function km_display_pop_checked($object, $key)
    {
        if (isset($object->$key) && $object->$key) {
            print 'value="true" checked';
        }
    }

    /**
     * get terms and consitions
     *
     * @param array $queryOptions filter options
     *
     * @return String terms and conditions for that provider
     */
    public function getProviderTerms($stepName, array $queryOptions = [])
    {
        $response = fieldday()->api->getActivityProviderTerms($queryOptions);
        $termsHtml = "";
        if ($response->statusCode == 200) {
            foreach ($response->data as $key => $termData) {
                $termsHtml .= wp_sprintf("<input type='hidden' name='terms[%d][termId]' value='%s'>", $key, $termData->termId->_id);
                $termsHtml .= wp_sprintf('<input type="checkbox" name="terms[%d][isAccepted]" class="km_accepted_terms">', $key);
            }
        }

        return $termsHtml;
    }

    /**
     * fieldday logout Url
     *
     * @return String Logout url
     */
    public function kmLogoutUrl()
    {
        return wp_logout_url(apply_filters('fieldday_after_logout_url', home_url()));
    }

    /**
     * fieldday user menu
     * @param object $menu
     *
     * @return Html user menu html
     */
    public function UserInMenuHtml()
    {
        global $KmUser;
        if ($KmUser) {
            $item = '<li id="menu_item_km_userinfo" class="menu-item"><div class="km_user_menu_wrapper">';
            $item .= apply_filters('fieldday_user_in_menu', $this->userMenuHtml());
            $item .= '</li>';

            return $item;
        }
    }

    /**
     * generate user menu HTML
     * @global type $KmUser
     * @return string
     */
    public function userMenuHtml()
    {
        global $KmUser;
        global $fielddaySetting;
        $userDPStyleHeight = $fielddaySetting['fieldday_user_menu_height'];
        $userDPStyleWidth = $fielddaySetting['fieldday_user_menu_width'];
        if ($userDPStyleHeight || $userDPStyleWidth) {
            $userDPStyles = 'style="';
            if ($userDPStyleHeight && $userDPStyleHeight != '') {
                $userDPStyles .= 'height:' . $userDPStyleHeight . 'px!important;';
            }
            if ($userDPStyleWidth && $userDPStyleWidth != '') {
                $userDPStyles .= 'width:' . $userDPStyleWidth . 'px!important;';
            }
            $userDPStyles .= '";';
        } else {
            $userDPStyles = null;
        }

        $html = '';
        $html .= '<div class="km_user_avatar_wrapper" ' . $userDPStyles . ' >';
        $html .= $this->getfielddayUserDP('', $userDPStyles);

        $html .= '<ul class="sub-menu km_user_menu_dropdown">';
        $html .= wp_sprintf('<li><a href="%s" id="user-log-out">%s</a></li>', $this->kmLogoutUrl(), $this->displayText('km_logout_btn', false));
        $html .= '<li><a href="' . $this->myaccounyRedirect() . '" >My Account</a></li>';
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }

    /**
     * get user thumbnail
     * @global type $KmUser
     *
     * @return HTML user image html
     */
    public function getfielddayUserDP($user = null, $image_styles = '')
    {
        global $KmUser;
        global $fielddaySetting;
        if ($user == null) {
            $user = $KmUser;
        }
        if (isset($user->profilePicURL->thumbnail) && $user->profilePicURL->thumbnail) {
            if ($image_styles) {
                return wp_sprintf('<img class="" src="%s" alt="%s"  %s />', $user->profilePicURL->thumbnail, $user->name, $image_styles);
            } else {
                return wp_sprintf('<img class="" src="%s" alt="%s" />', $user->profilePicURL->thumbnail, $user->name);
            }

        } else {
            $initial = "";
            if ($name = $this->getValue('name', $user, false)) {
                $words = explode(" ", $name);
                foreach ($words as $count => $w) {
                    if ($count >= 2) {
                        break;
                    }
                    $initial .= $w[0];
                }
            }

            if ($image_styles) {
                return wp_sprintf("<span class='km_default_avatar km_secondary_bg km_user_info_menu_span'>%s</span><img src='' class='preview-img km_hidden'>", $initial);
            } else {
                return wp_sprintf("<span class='km_default_avatar km_secondary_bg'>%s</span><img src='' class='preview-img km_hidden'>", $initial);
            }

        }
    }

    /**
     * get the pic for kid
     * @param object $kidsInfo
     *
     * @return html user image
     */
    public function getfielddayKidDP($kidsInfo)
    {
        if (isset($kidsInfo->profilePicURL->thumbnail) && $kidsInfo->profilePicURL->thumbnail) {
            return wp_sprintf('<img class="km_user_dp preview-img" src="%s" alt="%s %s" />', $kidsInfo->profilePicURL->thumbnail, $kidsInfo->firstName, $kidsInfo->lastName);
        } else {
            $initial = substr($kidsInfo->firstName, 0, 1);
            if ($kidsInfo->firstName) {
                $initial .= substr($kidsInfo->lastName, 0, 1);
            }

            return wp_sprintf("<span class='km_default_avatar km_secondary_bg'>%s</span><img src='' class='preview-img km_hidden'>", $initial);
        }
    }

    /**
     * Function for pagination
     *
     * @param integer  $rowperpage   The rowperpage
     * @param integer   $currentPage  The current page
     * @param object   $pageInfo     The page information
     *
     * @return string   pagination html
     */
    public function km_pagination($rowperpage, $currentPage, $pageInfo)
    {
        // calculate total pages
        $pagination = ' <ul class="km_pagination">';
        $total_pages = ceil($pageInfo->total / $rowperpage);
        $i = 0;
        // Total number list show
        // Number List
        for ($shownum = 0; $i < $total_pages; $i++, $shownum++) {
            $class = '';
            $aclass = 'km_primary_color';
            if ($i == $currentPage) {
                $class = "km_pagination_active";
                $aclass = "km_primary_bg";
                $color = '';
            }
            $pagination .= wp_sprintf("<li class='%s' data-page='%d' onclick='fieldday.ajaxPurchase(this,event);'><a href='#' class='%s  km_transparent_bg'>%d</a></li>", $class, $i, $aclass, $i + 1);
        }
        $pagination .= "</ul>";

        return $pagination;
    }

    /**
     * Function for pagination
     *
     * @param integer  $rowperpage   The rowperpage
     * @param integer   $currentPage  The current page
     * @param object   $pageInfo     The page information
     *
     * @return string   pagination html
     */
    public function km_global_pagination($rowperpage, $currentPage, $pageInfo)
    {
        // calculate total pages
        $pagination = ' <ul class="km_pagination">';
        $total_pages = ceil($pageInfo->total / $rowperpage);
        if ($total_pages == 1) {
            return;
        }
        $i = 0;
        // Total number list show
        // Number List
        for ($shownum = 0; $i < $total_pages; $i++, $shownum++) {
            $class = '';
            if ($i == $currentPage) {
                $class = "km_pagination_active";
            }
            $pagination .= wp_sprintf("<li class='%s' data-page='%d' onclick='fieldday.ajaxPagination(this,event);'><a href='#'>%d</a></li>", $class, $i, $i + 1);
        }
        $pagination .= "</ul>";

        return $pagination;
    }

    /**
     * filter function for discount popup before button html
     * @param array $discount filter function
     * @return string $html The html
     */
    public function discount_before_button($discount)
    {
        $html = wp_sprintf('<p class="km_discount_type">%s</p>', __('Siblings discount!', 'fieldday'));
        $html .= wp_sprintf('<p class="km_discount_helptxt_1">%s</p>', __('*This discount will be applied at checkout.', 'fieldday'));
        return $html;
    }

    /**
     * filter function for discount popup button html
     * @param array $discount filter function
     * @return string $html The html
     */
    public function discount_button_text($discount)
    {
        $html = wp_sprintf('<a class="km_discount_button km_btn km_primary_bg">%s</a>', __('Shop Now', 'fieldday'));
        return $html;
    }

    /**
     * filter function for discount popup after button html
     * @param array $discount filter function
     * @return string $html The html
     */
    public function discount_after_button($discount)
    {
        $html = wp_sprintf('<p class="km_discount_helptxt_2">%s</p>', __('terms and conditions apply', 'fieldday'));
        return $html;
    }

    /**
     * filter function for parents manage account note
     *
     * @return string  $html html on account page for Parents note
     */
    public function fieldday_before_account_text()
    {
        if (empty(fieldday()->engine->getCookieStorage('display_account_help', false))) {
            /*
            $html = wp_sprintf('<div class="km_before_account_text km_secondary_bg">');
            $html .= wp_sprintf('<a href="javascript:void(0);" class="close close_before_account_text">
            <svg width="12" height="12" viewport="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <line x1="1" y1="11" x2="11" y2="1" stroke="black" stroke-width="2"></line>
            <line x1="1" y1="1" x2="11" y2="11" stroke="black" stroke-width="2"></line>
            </svg>
            </a>');
            $html .= wp_sprintf('%s', __('Manage your account and purchases by downloading the FieldDay Mobile App from the AppStore. We would like to invite you to use a more secure and user-friendly platform to locate and manage your activities.', 'fieldday'));
            $html .= wp_sprintf('</div>');
             */
            $html = '';
            return $html;
        }
    }

    /**
     * display the active filters
     * @param type $sessions
     * @param type $filters
     * @return html
     */
    public function session_filterinfo($sessions, $filters)
    {
        $activefilters = $this->getValue('filters', $filters, false);
        //unset($activefilters['activityId']);
        $filterText = "";
        if ($activefilters) {
            $filterText .= "<div class='km_active_filters_wrap'>";
            $filterText .= wp_sprintf("<b>%s</b>", __("Active Filters", "fieldday"));
            $filterText .= "<div class='km_active_filters'>";
            foreach ($activefilters as $filterkey => $filter) {

                $filtername = $this->getFilterText($filterkey, $filter, $sessions);
                if ($filtername) {
                    if ($filterkey == 'fromDate' || $filterkey == 'toDate') {
                        $datefomet = str_replace(array('FromDate: ', 'ToDate: '), '', $filtername);

                        $new_date = substr_replace($datefomet, '', 11, 11);
                        // $filternames = date("d-m-Y", $new_date);

                        $filterText .= wp_sprintf("<span class='km_tags km_secondary_bg'>%s <a data-filter-key='%s' class='km_close_tag km_reset_filter km_primary_bg' href='javascript:void(0);'>X</a></span>", $new_date, $filterkey);
                    } else {
                        $filterText .= wp_sprintf("<span class='km_tags km_secondary_bg'>%s <a data-filter-key='%s' class='km_close_tag km_reset_filter km_primary_bg' href='javascript:void(0);'>X</a></span>", $filtername, $filterkey);
                    }
                }
            }
            $filterText .= "</div>";
            $filterText .= "</div>";
        }
        print $filterText;
    }

    /**
     * get the filter title
     * @param string $key
     * @param string $value
     * @return mixed
     */
    private function getFilterText($key, $value, $sessions)
    {
        switch ($key) {
            case 'sessionId':
                $sessionInfo = $this->getsingleSession($value);
                if ($sessionInfo) {
                    return __("Session: ", 'fieldday') . $sessionInfo->name;
                }
                break;
            case 'location':
                $locationstring = $this->getSessionLocations($sessions, $value);
                if ($locationstring) {
                    return fieldday()->engine->getValue($key, fieldday()->engine->fielddayFilters(), false) . ": " . $locationstring;
                }
                break;
            case 'month':
                if ($value) {
                    return fieldday()->engine->getValue($key, fieldday()->engine->fielddayFilters(), false) . ": " . $this->KmMonths($value);
                }
                break;
            case 'activityId':
                $activitystring = $this->getSessionActivity($sessions, $value);
                if ($activitystring) {
                    return fieldday()->engine->getValue('activities', fieldday()->engine->fielddayFilters(), false) . ": " . $activitystring;
                }
                break;
            default:
                $label = fieldday()->engine->getValue($key, fieldday()->engine->fielddayFilters(), false);
                if ($label) {$label = $label . ": ";}
                if ($value && trim($value) != '') {
                    return ucfirst(__($label, 'fieldday')) . $value;
                }
                break;
        }

        return false;
    }

    /**
     *
     * @param string $tabId
     * @param string $tagId
     * @param string $filters
     */
    public function displaySessionList($tabId, $tagId, $filters, $permalink)
    {
        $activities = fieldday()->api->getProviderActivities(['sessionTypeTag' => $tabId]);
        if ($activities->statusCode != 200) {
            return $this->displayFlash('error', __($activities->message, 'fieldday'));
        }
        $html = "";
        foreach ($activities->data as $key => $activity) {
            $filters['filters']['activityId'] = $activity->_id;
            //$filters['showAllSessions'] = 'true';
            $sessions = fieldday()->api->GetProviderSessionsNew($filters);
            $html .= $this->getView('_sessionlist_part', ['activity' => $activity, 'sessions' => $sessions, 'permalink' => $permalink, 'filters' => $filters, 'tagId' => $tagId]);
        }

        return $html;
    }

    /**
     * get locations from session
     * @param mixed $sessions
     * @return string
     */
    public function getSessionLocations($sessions, $key = false)
    {
        $locations = $sessions->data->locations;
        $searchLocation = [];
        foreach ($locations as $location) {
            if (!array_key_exists($location->_id, $searchLocation)) {
                $searchLocation[$location->_id] = wp_sprintf('%s, %s, %s', $location->name, $location->city, $location->state);
            }
        }
        if ($key) {
            return $this->getValue($key, $searchLocation, false);
        }

        return $searchLocation;
    }

    /**
     * get locations from session
     * @param mixed $sessions
     * @return string
     */
    public function getSessionActivity($sessions, $key = false)
    {
        $activitys = $sessions->data->sessions;
        $searchactivitys = [];
        foreach ($activitys as $activity => $singlesessions) {
            foreach ($singlesessions->sessions as $singleactivitys => $singleactivity) {
                if (!array_key_exists($singleactivity->activityId->_id, $searchactivitys)) {
                    $searchactivitys[$singleactivity->activityId->_id] = wp_sprintf('%s', $singleactivity->activityId->title);
                }
            }
        }

        if ($key) {
            return $this->getValue($key, $searchactivitys, false);
        }

        return $searchactivitys;
    }

    /**
     * display records count info
     * @param mixed $sessions
     * @param type $filters
     */
    public function session_recordsinfo($sessions, $filters)
    {
        global $fielddaySetting;
        $activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
        if ($activetheme == "one_column_layout") {
            $location = $sessions->street . ", " . $sessions->city . ", " . $sessions->state . ", " . $sessions->country;
            return wp_sprintf('<div class="width-100"><span class="km_search_text">%s <b class="km_text_green">%d</b> %s <b  class="km_text_red">%s</b>.</span></div>', __('Displaying', 'fieldday'), count($sessions->sessions), __('record(s) in', 'fieldday'), $location);
        } elseif ($activetheme == "two_column_layout") {

            $activityTags = fieldday()->api->getActivityTagsCount();
            $getActivities = fieldday()->api->getFeaturedActivities();
            $tagTitle = "All Activities";
            $tagId = $this->getValue('tagId', $filters, false);
            if (isset($filters['filters'])) {
                if (fieldday()->engine->getValue('activityId', $filters['filters'], false)) {
                    foreach ($getActivities->data as $key => $activity) {
                        if ($activity->_id === $filters['filters']['activityId']) {
                            $tagTitle = $activity->title;
                        }
                    }
                } else {
                    foreach ($activityTags->data as $key => $tag) {
                        if ($tag->_id === $tagId) {
                            $tagTitle = $tag->wpShowTitle ? $tag->wpShowTitle : $tag->title;
                        }
                    }
                }
            } elseif (!isset($filters['filters']) && !isset($filters['tagId'])) {
                $tagTitle = "All Activities";
            } else {
                foreach ($activityTags->data as $key => $tag) {
                    if ($tag->_id === $tagId) {
                        $tagTitle = $tag->wpShowTitle ? $tag->wpShowTitle : $tag->title;
                    }
                }
            }
            return wp_sprintf('<span class="km_search_text">%s <b class="km_text_green">%d</b> %s <b  class="km_text_red">%s</b>.</span>', __('Displaying', 'fieldday'), count($sessions->data->sessions), __('records in', 'fieldday'), $tagTitle);
        } elseif ($activetheme == "list_view") {
            $activityTags = fieldday()->api->getActivityTagsCount();
            $getActivities = fieldday()->api->getFeaturedActivities();
            $tagTitle = "All Activities";
            $tagId = $this->getValue('tagId', $filters, false);
            $actvityfilterId = $this->getValue('actvityfilterId', $filters, false);
            if (isset($filters['filters'])) {
                if (fieldday()->engine->getValue('activityId', $filters['filters'], false)) {
                    foreach ($getActivities->data as $key => $activity) {
                        if ($activity->_id === $filters['filters']['activityId']) {
                            $tagTitle = $activity->title;
                        }
                    }
                } else {
                    foreach ($activityTags->data as $key => $tag) {
                        if ($tag->_id === $tagId) {
                            $tagTitle = $tag->wpShowTitle ? $tag->wpShowTitle : $tag->title;
                        }
                    }
                }
            } elseif (!isset($filters['filters']) && !isset($filters['tagId'])) {
                $tagTitle = "All Activities";
            } else {
                foreach ($activityTags->data as $key => $tag) {
                    if ($tag->_id === $tagId) {
                        $tagTitle = $tag->wpShowTitle ? $tag->wpShowTitle : $tag->title;
                    }
                }
            }
            return wp_sprintf('<span class="km_search_text">%s <b class="km_text_green">%d</b> %s<b class="km_text_red km_hidden">%s</b>. </span>', __('Displaying', 'fieldday'), $sessions, __('records', 'fieldday'), $tagTitle);
        }
    }

    /**
     * display session type
     *
     * @param string $session_type
     *
     * @return html session days
     */
    public function sessionServiceDays($session_type)
    {
        if ($session_type == 'weekly') {
            return __('for all days', 'fieldday');
        } else {
            return __('Per Day', 'fieldday');
        }
    }

    /**
     *
     * @param array $fieldAttributes
     * @param string $date
     */
    public function fielddayDateField(array $fieldAttributes, $date = null, $sessionInfo = [])
    {
        if ($date) {
            $day = date('d', strtotime($date));
            $month = date('m', strtotime($date));
            $year = date('Y', strtotime($date));
        } else {
            $day = 15;
            $month = 06;
            $year = date("Y", strtotime("-10 year"));
        }
        $fieldAttributes['class'] = "km_hidden_dob";
        $attributes = "";
        if ($sessionInfo) {
            $agefrom = $sessionInfo->activityId->ageRange->from;
            $ageto = $sessionInfo->activityId->ageRange->to;

            $attributes = "data-age-from='{$agefrom}' data-age-to='{$ageto}'";
        }

        $inputAttributes = "";
        foreach ($fieldAttributes as $attr_name => $att_value) {
            $inputAttributes .= " {$attr_name}='{$att_value}'";
        }

        $fieldHtml = "<div {$attributes} class='km_dob_wrap'>";
        $fieldHtml .= wp_sprintf("<input type='hidden' %s/>", $inputAttributes);
        $fieldHtml .= wp_sprintf("<select class='km_date_day km_input'>%s</select>", $this->_createOptions('days', $day));
        $fieldHtml .= wp_sprintf("<select class='km_date_month km_input'>%s</select>", $this->_createOptions('month', $month));
        $fieldHtml .= wp_sprintf("<select class='km_date_year km_input'>%s</select>", $this->_createOptions('year', $year));
        $fieldHtml .= "</div>";

        print $fieldHtml;
    }

    /**
     *
     * @param string $type
     * @param mixed $selected
     * @return Html options
     */
    private function _createOptions($type, $selected)
    {
        $options = "";
        switch ($type) {
            case 'days':
                $array = range(1, 31);
                foreach ($array as $key => $day) {
                    $day = $day < 10 ? "0" . $day : $day;
                    $select = $day == $selected ? "selected" : "";
                    $options .= wp_sprintf("<option %s value='%s'>%d</option>", $select, $day, $day);
                }
                break;
            case 'month':
                $array = $this->KmMonths();
                foreach ($array as $key => $month) {
                    $select = $key == $selected ? "selected" : "";
                    $options .= wp_sprintf("<option %s value='%s'>%s</option>", $select, $key, $month);
                }
                break;
            case 'year':
                $array = range(date("Y", strtotime("-89 year")), date('Y'));
                foreach ($array as $key => $year) {
                    $select = $year == $selected ? "selected" : "";
                    $options .= wp_sprintf("<option %s value='%d'>%d</option>", $select, $year, $year);
                }
                break;
            default:
                break;
        }
        return $options;
    }

    /**
     *
     * @param object $session session Data
     *
     */
    public function sessionDays($session, $daysOfWeek = null)
    {
        if (!$daysOfWeek) {
            $daysOfWeek = $this->getValue('daysOfWeek', $session, false);
        }

        foreach ($this->_weekDays() as $dayNum => $weekday) {
            $activeClass = is_array($daysOfWeek) && in_array($dayNum, $daysOfWeek) ? "km_day_active km_secondary_bg" : "";
            print wp_sprintf("<div data-tooltip-title='%s' class='km_session_day km_tooltip %s'>%s</div>", $weekday['name'], $activeClass, $weekday['initial']);
        }
    }

    /**
     *
     * day of a given date
     *
     */
    public function dayofweek($d, $m, $y)
    {
        static $t = array(0, 3, 2, 5, 0, 3,
            5, 1, 4, 6, 2, 4);
        $y -= $m < 3;
        return ($y + $y / 4 - $y / 100 +
            $y / 400 + $t[$m - 1] + $d) % 7;
    }

    public function fullweeksessionDays($session)
    {
        $daysOfWeek = $this->getValue('daysOfWeek', $session, false);
        $fullweekactiveDays;
        foreach ($this->_weekDays() as $dayNum => $weekday) {
            $activeClass = in_array($dayNum, $daysOfWeek) ? $fullweekactiveDays++ : "";
        }
        return $fullweekactiveDays;
    }

    public function eventDays($session)
    {
        $daysOfWeek = $this->getValue('daysOfWeek', $session, false);
        $activeDays;
        foreach ($this->_weekDays() as $dayNum => $weekday) {
            $activeClass = in_array($dayNum, $daysOfWeek) ? $dayNum : '';
            $activeDays[] = $activeClass;
        }

        return $activeDays;
    }

    /**
     *
     * @param String $day
     * @return mixed
     */
    private function _weekDays($day = null)
    {
        $days = [
            ['name' => __("Sunday", 'fieldday'), 'initial' => 'Su', 'short' => 'Sun'],
            ['name' => __("Monday", 'fieldday'), 'initial' => 'M', 'short' => 'Mon'],
            ['name' => __("Tuesday", 'fieldday'), 'initial' => 'T', 'short' => 'Tue'],
            ['name' => __("Wednesday", 'fieldday'), 'initial' => 'W', 'short' => 'Wed'],
            ['name' => __("Thursday", 'fieldday'), 'initial' => 'Th', 'short' => 'Thur'],
            ['name' => __("Friday", 'fieldday'), 'initial' => 'F', 'short' => 'Fri'],
            ['name' => __("Saturday", 'fieldday'), 'initial' => 'S', 'short' => 'Sat'],
        ];

        if ($day) {
            return array_key_exists($day, $days) ? $days[$day] : false;
        }

        return $days;
    }

    /**
     * display site location string
     * @param Array $session
     *
     * @return String location info
     */
    public function getSiteLocation($session)
    {
        $location = $this->getValue('siteLocationId', $session, false);
        if (isset($session->isOnlineSession) && $session->isOnlineSession) {
            return wp_sprintf('<p>%s</p>', $location->name);
        }

        $street = $this->getValue('street', $location, false);
        $city = $this->getValue('city', $location, false);
        $state = $this->getValue('state', $location, false);
        $country = $this->getValue('country', $location, false);
        $pin = $this->getValue('pin', $location, false);
        return wp_sprintf('<p>%s, %s, %s %s, %s</p>', $street, $city, $state, $pin, $country);
    }

    /**
     * display Important Dates string
     * @param Array $session
     * @return string
     */
    public function getImportantDates($session)
    {
        $importantdates = $this->getValue('importantDates', $session, false);
        return $importantdates;
    }

    /**
     *
     * @param mixed $session
     * @return string
     */
    public function displaysessionReviews($session)
    {
        $reviews = $this->getValue('reviews', $session, false);
        $html = "";
        if ($reviews) {
            $html .= '<div class="km_col_12 km_slides km_reviews_theme">';
            foreach ($reviews as $key => $review) {$description = $this->getValue('description', $review, false);
                if ($description != '') {
                    $html .= '<div class="km_review_content">';
                    $html .= '<p>' . $this->getValue('description', $review, false) . '</p>
                    <img src="' . fieldday_URL . '/assets/img/quetimg.png">
                    <div class="km_review_user">
                        <span>' . $review->reviewBy->name . '</span>
                    </div>';
                    $html .= '</div>';
                }}
            $html .= '</div>';
        }
        return $html;
    }

    /**
     * display session rating
     * @param array $session
     */
    public function sessionRating($session)
    {
        $sessionRating = (int) round($session->providerId->rating);
        $html = '<div title="' . $session->providerId->rating . __(" star average rating") . '" class="km_star_rating_wrap">';
        $html .= "<div class='km_star_rating accv'>";
        for ($index = 5; $index >= 1; $index--) {$rating_class = '';
            if ($index <= $sessionRating) {$rating_class = 'km_fill';}
            $checked = $sessionRating == $index ? "checked" : "oops";
            $html .= wp_sprintf('<input type="radio" disabled readonly id="%1$s-stars" %2$s name="rating" value="%1$s" data-rating="%3$d" /><label for="%1$s-stars" class="star %4$s">&#9733;</label>', $index, $checked, $sessionRating, $rating_class);}
        $html .= '</div>';
        $html .= wp_sprintf("<span>(%d star based on %d reviews)</span>", $sessionRating, count($session->reviews));
        $html .= '</div>';

        print $html;
    }

    /**
     *
     * @param mixed $session
     * @param Array $tags available tags with their Id
     * return HTML
     */
    public function sessionBookingTypes($session, $tags, $displayLable = true)
    {
        global $fielddaySetting;
        $html = '<div class="km_session_booking_types">';
        $bookingTypesAvailable = $this->_sessionBookingTypes();
        $purchasePage = get_permalink($this->getValue('purchase_page', $fielddaySetting, false));
        foreach ($bookingTypesAvailable as $key => $bookingType) {
            if ($bookingArray = $this->getValue($key, $session, false)) {
                $lable = $bookingType['lable'];
                $tagId = $this->getValue($lable, $tags, false);
                $purchaseLink = add_query_arg(['tagId' => $tagId, '_id' => $session->_id], $purchasePage);
                $html .= wp_sprintf('<div data-tooltip-title="%s" class="km_booking_type km_tooltip">
                        <a href="%s">
                            <img src="%s/assets/img/%s"/>
                            <span class="km_book_typ_txt">%s</span>
                        </a>
                    </div>', $lable, $purchaseLink, fieldday_URL, $bookingType['icon'], $displayLable ? $lable : "");
            }
        }
        /* add weekly booking */
        $purchaseLink = add_query_arg(['_id' => $session->_id], $purchasePage);
        $html .= wp_sprintf('<div data-tooltip-title="%s" class="km_booking_type km_tooltip">
            <a href="%s">
                <img src="%s/assets/img/%s"/>
                <span class="km_book_typ_txt">%s</span>
            </a>
        </div>', $bookingTypesAvailable['weeklyKidRegistration']['lable'], $purchaseLink, fieldday_URL, $bookingTypesAvailable['weeklyKidRegistration']['icon'], $displayLable ? $bookingTypesAvailable['weeklyKidRegistration']['lable'] : "");
        $html .= '</div>';

        return $html;
    }

    public function sessionBookingavail($session, $displayLable = true, $groupSessionListing = null)
    {
        global $fielddaySetting;

        $bookingTypesAvailable = $this->_sessionBookingTypes();
        /*if($is_single==true){
        $fullWeekPrice = $this->getValue('price', $session->fullCampDetails, false);
        }else{*/
        if ($session->oneDayType != 'fullDay') {
            $fullWeekPrice = $this->getValue('price', $session, false);
        }
        /*}*/
        $oneDayDetails = $this->getValue('oneDayPrice', $session, false);
        if ($session->availableSpots > 0 || $groupSessionListing) {
            $html = '<span class="km_session_prices"><i class="fa fa-money km_primary_color" aria-hidden="true"></i>';
            if (isset($fullWeekPrice) || $fullWeekPrice != 0) {
                $html .= wp_sprintf('<span class="km_session_price">%s</span>', $this->display_price($fullWeekPrice));
            }
            foreach ($bookingTypesAvailable as $key => $bookingType) {
                if ($bookingArray = $this->getValue($key, $session, false)) {
                    $lable = $bookingType['lable'];
                    $duration = $bookingType['duration'];
                    $Pricekey = $bookingType['apikey'];
                    if ($is_single == true) {
                        $singlesessionkey = $bookingType['singlesessionkey'];
                        $PriceValue = $this->getValue('price', $session->$singlesessionkey, false);
                    } else {
                        $PriceValue = $this->getValue($Pricekey, $oneDayDetails, false);
                    }
                    $html .= wp_sprintf('<span class="km_session_price">%s%s</span>', $this->display_price($PriceValue), $duration);
                }
            }
            $html .= '</span>';
        } else {
            if ($session->oneDayType != 'fullDay') {
                $html = '<span class="km_session_prices km_noavail_seat">No Available Seats</span>';
            }
        }

        return $html;
    }

    public function CartbookingOptions($session)
    { // not in use: This function is not used anywhere in the website
        global $fielddaySetting;
        $html = '';
        $bookingTypesAvailable = $this->_sessionBookingTypes();
        //if($session->oneDayType!='fullDay'){
        //$fullWeekPrice = $this->getValue('price', $session, false);
        //}
        $oneDayPrice = $this->getValue('oneDayPrice', $session, false);
        $days = $this->eventDays($session);
        $days_count = count(array_filter($days));
        if (array($days)) {
            $days = implode(',', array_filter($days));
        }
        $fullWeekPrice = $this->getValue('price', $session, false);
        $html .= '<h3 class="km_primary_color">What type of booking would you prefer? <span class="km_asterisk">*</span></h3> <div class="km_booking_options">';
        if ($fullWeekPrice) {
            $lable = $bookingTypesAvailable['weeklyKidRegistration']['lable'];
            $duration = $bookingTypesAvailable['weeklyKidRegistration']['duration'];
            //$Pricekey = $bookingTypesAvailable['weeklyKidRegistration']['apikey'];
            $fullWeekPrice = $this->getValue('price', $session, false);
            $html .= '<div class="km_Full_session km_booking_option">';
            $html .= wp_sprintf('<span class="km_booking_title">All Session Days</span>', $days_count);
            $html .= '<label class="km_radio_wrap km_radio_wrap_care">
            <span class="km_radio_text">Full Camp';
            $html .= wp_sprintf('<span class="km_cartsession_price km_secondary_color">%s</span>', $this->display_price($fullWeekPrice));
            $html .= '</span>
            <input class="km_booking_radio" type="radio" data-price="' . $fullWeekPrice . '" value="fullcamp" name="ATC[bookingoption_selection]" onclick="">
            <span class="km_radio"></span>
        </label></div>';
        }
        if ($this->getValue('oneDayKidRegistration', $session, false)) {

            $lable = $bookingTypesAvailable['oneDayKidRegistration']['lable'];
            $duration = $bookingTypesAvailable['oneDayKidRegistration']['duration'];
            $Pricekey = $bookingTypesAvailable['oneDayKidRegistration']['apikey'];
            $PriceValue = $this->getValue($Pricekey, $oneDayPrice, false);
            $html .= '<div class="km_drop_sessions km_booking_option"><span class="km_booking_title">Drop-In</span>';
        }
        $html .= '<div class="km_oneday_options">';
        $html .= '<div class="km_days">';
        foreach ($bookingTypesAvailable as $key => $bookingType) {
            if ($bookingArray = $this->getValue($key, $session, false)) {
                $lable = $bookingType['lable'];
                $duration = $bookingType['duration'];
                $Pricekey = $bookingType['apikey'];
                $PriceValue = $this->getValue($Pricekey, $oneDayPrice, false);
                $html .= '<label class="km_radio_wrap km_radio_wrap_care">
              <span class="km_radio_text">' . $lable;
                $html .= wp_sprintf('<span class="km_cartsession_price km_secondary_color">%s%s</span>', $this->display_price($PriceValue), $duration);
                $html .= '</span>
              <input class="km_purchasefield km_booking_radio" type="radio" data-price="' . $PriceValue . '" value="' . $Pricekey . '" name="ATC[bookingoption_selection]" onclick="">
              <span class="km_radio"></span>
              </label>';
            }
        }
        $html .= '</div></div>';
        $html .= '</div></div>';

        $html .= '<div class="km_cart_calender_main km_hidden"><h3 class="km_primary_color">What day(s) would you like to register for? <span class="km_asterisk">*</span></h3></div><div class="km_cart_calender km_datepicker km_hidden" data-date-from="' . $session->dateTimestamp->from . '" data-date-to="' . $session->dateTimestamp->to . '" data-days="' . $days . '">Select Date <span class="km_dates_count"></span></div><div class="km_calender km_hidden"><div class="km_calander_div"></div><span class="km_cal_close km_transparent_bg km_secondary_color">Done</span></div>';
        return $html;
    }

    /**
     *
     * @param mixed $session Types Label
     * @param Array $tags available tags with their Id
     * return HTML
     */

    public function sessionBookingTypesLable($session, $tags, $displayLable = true)
    {
        global $fielddaySetting;
        $html;
        $bookingTypesAvailable = $this->_sessionBookingTypes();
        $purchasePage = get_permalink($this->getValue('purchase_page', $fielddaySetting, false));
        foreach ($bookingTypesAvailable as $key => $bookingType) {
            if ($bookingArray = $this->getValue($key, $session, false)) {
                $lable = $bookingType['lable'];
                $html[] = $lable;
            }
        }
        /* add weekly booking */
        $html[] = $bookingTypesAvailable['weeklyKidRegistration']['lable'];

        return $html;
    }

    /**
     * get session extended care options
     * @param mixed $session
     * @return boolean|string
     */
    public function ExtendedCareOptions($session)
    {
        $extendedCareDetails = $this->getValue('extendedCareDetails', $session->fullCampDetails, false);
        $isAvailable = false;
        $html = "<div class='km_session_exte_care'>";
        if ($extendedCareDetails) {
            foreach ($extendedCareDetails as $chargetype => $charges) {
                if ($chargetype == 'afterCare' || $chargetype == 'earlyCare' || $chargetype == 'combined') {
                    if ($this->getvalue('isAvailable', $extendedCareDetails, false)) {
                        $isAvailable = true;
                        $html .= wp_sprintf('<span class="km_radio_text">%s</span>', $this->extendedCareTypes($chargetype));
                    }
                }
            }
        }
        $html .= "</div>";
        if ($isAvailable === false) {
            return false;
        }
        return $html;
    }

    /**
     * return session options
     * @param mixed $session
     * @return boolean|string
     */
    public function sessionOtherOptions($session)
    {
        $additionalCharges = $this->getValue('additionalCharges', $session->fullCampDetails, false);
        if (!$additionalCharges) {
            return false;
        }
        $html = "<div class='km_session_exte_care'>";
        foreach ($additionalCharges as $key => $product) {
            $html .= wp_sprintf('<span class="km_radio_text">%s</span>', $product->title);
        }
        $html .= "</div>";

        return $html;
    }

    private function ifKeyExists($array, $val)
    {
        foreach ($array as $item) {
            if (isset($item) && in_array($val, $item)) {
                return true;
            }
        }
        return false;
    }

    /**
     * display participants for add to cart
     */
    public function fielddayCartParticipants($cartItem, $sessionInfo = null, $title = null, $logintitle = null)
    {
        if (!$title) {
            $title = "How many Participants you want to register?";
        }
        if (!$logintitle) {
            $logintitle = "Select Participants to register?";
        }

        if ($this->isKmLogin()) {
            $kidsresponse = fieldday()->api->GetKids();
            //echo "<pre>"; print_r($kidsresponse); echo "</pre>";
            if ($kidsresponse->statusCode === 200) {
                $html = wp_sprintf("<h3 class='km_heading_title km_primary_color'>%s <span class='km_asterisk'>*</span></h3>", __($logintitle, 'fieldday'));
                $html .= "<ul class='km_profile_participants'>";
                $html .= '<input id="km_atc_participant_count" type="hidden" value="0" name="kidscount">';
                $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[sessionfeatured]" value="' . $_REQUEST['sessionfeatured'] . '">';
                $counter = 1;
                foreach ($kidsresponse->data as $key => $participant) {
                    if ($this->getValue('kids', $cartItem, false)) {
                        $isInCart = $this->ifKeyExists($cartItem['kids'], $participant->_id);
                    } else {
                        $isInCart = false;
                    }
                    if ($isInCart) {
                        $atttributes = '';
                        $activeClass = "km_active_participant";
                        $checked = "checked";
                    } else {
                        $atttributes = "disabled readonly";
                        $activeClass = "";
                        $checked = "";
                    }
                    $dob = $participant->dob;
                    $from = new DateTime($dob);
                    $to = new DateTime('today');
                    $kid_age = $from->diff($to)->y;
                    if ($sessionInfo && $sessionInfo->skillLevelOption != 'grade') {
                        //if($sessionInfo->skillLevelOption!='grade'){
                        $agefrom = $sessionInfo->activityId->ageRange->from;
                        $ageto = $sessionInfo->activityId->ageRange->to;
                        if (($agefrom <= $kid_age) && ($kid_age <= $ageto)) {
                            $html .= "<li class='" . $activeClass . "'>";
                            $html .= '<input type="checkbox" class="selected_kid" ' . $checked . '  name="ATC[kids][' . $counter . '][_id]" value="' . $participant->_id . '">';
                            $html .= '<div class="km_hidden km_profile_participant_form">';
                            $html .= '<input type="hidden"  ' . $atttributes . ' name="ATC[kids][' . $counter . '][firstName]" value="' . $participant->firstName . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][lastName]" value="' . $participant->lastName . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][knownAs]" value="' . $participant->knownAs . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][gender]" value="' . $participant->gender . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][grade]" value="' . $participant->grade . '">';

                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][dob]" value="' . $participant->dob . '">';
                            $html .= '</div>';

                            $html .= wp_sprintf('<div class="km_kid_pic_wrapper">%s</div>', fieldday()->engine->getfielddayKidDP($participant));
                            $html .= wp_sprintf('<div class="km_participant_name"><span>%s</span><span>%s</span></div>', $this->getValue('firstName', $participant, false), $this->getValue('lastName', $participant, false));
                            $html .= "</li>";

                            $counter++;
                        }
                        //}
                    } else {
                        $html .= "<li class='" . $activeClass . "'>";
                        $html .= '<input type="checkbox" class="selected_kid" ' . $checked . '  name="ATC[kids][' . $counter . '][_id]" value="' . $participant->_id . '">';
                        $html .= '<div class="km_hidden km_profile_participant_form">';
                        $html .= '<input type="hidden"  ' . $atttributes . ' name="ATC[kids][' . $counter . '][firstName]" value="' . $participant->firstName . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][lastName]" value="' . $participant->lastName . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][knownAs]" value="' . $participant->knownAs . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][gender]" value="' . $participant->gender . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][grade]" value="' . $participant->grade . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][dob]" value="' . $participant->dob . '">';

                        $html .= '</div>';

                        $html .= wp_sprintf('<div class="km_kid_pic_wrapper">%s</div>', fieldday()->engine->getfielddayKidDP($participant));
                        $html .= wp_sprintf('<div class="km_participant_name"><span>%s</span><span>%s</span></div>', $this->getValue('firstName', $participant, false), $this->getValue('lastName', $participant, false));
                        $html .= "</li>";

                        $counter++;
                    }
                }
                $html .= "<li class='add_new_participant'>+</li>";
                $html .= "</ul>";
                $html .= "<div class='km_addnewparticipant_forms'></div>";
            }
        } else {
            if ($cartItem) {
                $seatcount = count($cartItem['kids']);
            } else {
                $seatcount = 1;
            }
            $html = wp_sprintf("<h3 class='km_heading_title km_primary_color'>%s</h3>", __($title, 'fieldday'));
            $html .= "<ul class='km_guest_participants'>";
            $html .= '<input id="km_atc_participant_count" type="hidden" value="' . $seatcount . '" name="kidscount">';
            $html .= '<input type="hidden"  name="ATC[sessionfeatured]" value="' . $_REQUEST['sessionfeatured'] . '">';
            for ($i = 1; $i <= 10; $i++) {
                $activeclass = $i === $seatcount ? 'km_active_participant km_primary_border km_primary_shadow' : '';
                $html .= '<li data-count="' . $i . '" class="' . $activeclass . '"><span>' . $i . '</span></li>';
            }
            $html .= "</ul>";
            $html .= "<div class='km_guestparticipant_forms'>";

            for ($i = 1; $i <= $seatcount; $i++) {
                $participantDetail = isset($cartItem['kids'][$i]) ? $cartItem['kids'][$i] : [];
                $kidId = fieldday()->engine->generateRandomId(16, 'new_kid_');
                $html .= $this->getview('cart/single_kid_form', ['counter' => $i, 'kidId' => $kidId, 'profile' => $participantDetail, 'sessionInfo' => $sessionInfo]);
            }
            $html .= "</div>";
        }

        return $html;
    }
    public function KidsGradesOptions($from = null, $to = null)
    {
        $Avail_Grades = array();
        /*$GradeArray = array('PreK'=> 'Pre-kindergarten','K'=>'Kindergarten', '1'=>'1st grade', '2'=>'2nd grade', '3'=>'3rd grade', '4'=>'4th grade', '5'=>'5th grade', '6'=>'6th grade', '7'=>'7th grade', '8'=>'8th grade', '9'=>'9th grade', '10'=>'10th grade', '11'=>'11th grade', '12'=>'12th grade');*/
        $GradeArray = array('PreK', 'K', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
        $min = array_search($from, $GradeArray);
        $max = array_search($to, $GradeArray);
        //$GradeArrayKeys = array_keys($GradeArray);
        for ($i = $min; $i <= $max; $i++) {
            //$val = $GradeArray[$i];
            $Avail_Grades[] = $GradeArray[$i];
        }
        return $Avail_Grades;
    }

    /**
     * display participants for add to cart
     */
    public function fielddayCartParticipantsNew($cartItem, $sessionInfo = null, $title = null, $logintitle = null)
    {
        $cartItem = json_decode(json_encode($cartItem), true);
        if (!$title) {
            $title = "How many Participants you want to register?";
        }
        if (!$logintitle) {
            $logintitle = "Select Participants to register?";
        }
        $km_edit_checked_students = 0;

        if ($this->isKmLogin()) {
            $kidsresponse = fieldday()->api->GetKids();
            if ($kidsresponse->statusCode === 200) {
                $html = wp_sprintf("<h3 class='km_heading_title km_primary_color'>%s <span class='km_asterisk'>*</span></h3>", __($logintitle, 'fieldday'));
                $html .= "<ul class='km_profile_participants'>";
                $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[sessionfeatured]" value="' . $_REQUEST['sessionfeatured'] . '">';
                $counter = 1;
                foreach ($kidsresponse->data as $key => $participant) {
                    if ($this->getValue('kidId', $cartItem, false)) {
                        $isInCart = $this->ifKeyExists($cartItem['kidId'], $participant->_id);
                    } else {
                        $isInCart = false;
                    }
                    if ($isInCart) {
                        $atttributes = '';
                        $activeClass = "km_active_participant";
                        $checked = "checked";
                        $km_edit_checked_students = $km_edit_checked_students + 1;
                    } else {
                        $atttributes = "disabled readonly";
                        $activeClass = "";
                        $checked = "";
                    }
                    $dob = $participant->dob;
                    $from = new DateTime($dob);
                    $to = new DateTime('today');
                    $kid_age = $from->diff($to)->y;

                    if ($sessionInfo && $sessionInfo->skillLevelOption != 'grade') {
                        $agefrom = $sessionInfo->activityId->ageRange->from;
                        $ageto = $sessionInfo->activityId->ageRange->to;
                        if (($agefrom <= $kid_age) && ($kid_age <= $ageto)) {
                            $html .= "<li class='" . $activeClass . "'>";
                            $html .= '<input type="checkbox" class="selected_kid" ' . $checked . '  name="ATC[kids][' . $counter . '][_id]" value="' . $participant->_id . '">';
                            $html .= '<div class="km_hidden km_profile_participant_form">';
                            $html .= '<input type="hidden"  ' . $atttributes . ' name="ATC[kids][' . $counter . '][firstName]" value="' . $participant->firstName . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][lastName]" value="' . $participant->lastName . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][knownAs]" value="' . $participant->knownAs . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][gender]" value="' . $participant->gender . '">';
                            $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][dob]" value="' . $participant->dob . '">';

                            $html .= '</div>';

                            $html .= wp_sprintf('<div class="km_kid_pic_wrapper">%s</div>', fieldday()->engine->getfielddayKidDP($participant));
                            $html .= wp_sprintf('<div class="km_participant_name"><span>%s</span><span>%s</span></div>', $this->getValue('firstName', $participant, false), $this->getValue('lastName', $participant, false));
                            $html .= "</li>";

                            $counter++;

                        }
                    } else {
                        $html .= "<li class='" . $activeClass . "'>";
                        $html .= '<input type="checkbox" class="selected_kid" ' . $checked . '  name="ATC[kids][' . $counter . '][_id]" value="' . $participant->_id . '">';
                        $html .= '<div class="km_hidden km_profile_participant_form">';
                        $html .= '<input type="hidden"  ' . $atttributes . ' name="ATC[kids][' . $counter . '][firstName]" value="' . $participant->firstName . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][lastName]" value="' . $participant->lastName . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][knownAs]" value="' . $participant->knownAs . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][gender]" value="' . $participant->gender . '">';
                        $html .= '<input type="hidden" ' . $atttributes . ' name="ATC[kids][' . $counter . '][dob]" value="' . $participant->dob . '">';

                        $html .= '</div>';

                        $html .= wp_sprintf('<div class="km_kid_pic_wrapper">%s</div>', fieldday()->engine->getfielddayKidDP($participant));
                        $html .= wp_sprintf('<div class="km_participant_name"><span>%s</span><span>%s</span></div>', $this->getValue('firstName', $participant, false), $this->getValue('lastName', $participant, false));
                        $html .= "</li>";

                        $counter++;
                    }
                }
                $html .= "<li class='add_new_participant'>+</li>";
                $html .= '<input id="km_atc_participant_count" type="hidden" value="' . $km_edit_checked_students . '" name="kidscount">';
                $html .= "</ul>";
                $html .= "<div class='km_addnewparticipant_forms'></div>";
            }
        } else {
            if ($cartItem) {
                $seatcount = count($cartItem['kidId']);
            } else {
                $seatcount = 1;
            }
            $html = wp_sprintf("<h3 class='km_primary_color km_heading_title'>%s</h3>", __($title, 'fieldday'));
            $html .= "<ul class='km_guest_participants'>";
            $html .= '<input id="km_atc_participant_count" type="hidden" value="' . $seatcount . '" name="kidscount">';
            $html .= '<input type="hidden"  name="ATC[sessionfeatured]" value="' . $_REQUEST['sessionfeatured'] . '">';
            for ($i = 1; $i <= 10; $i++) {
                $activeclass = $i === $seatcount ? 'km_active_participant km_primary_border km_primary_shadow' : '';
                $html .= '<li data-count="' . $i . '" class="' . $activeclass . '"><span>' . $i . '</span></li>';
            }
            $html .= "</ul>";
            $html .= "<div class='km_guestparticipant_forms'>";
            for ($i = 0; $i <= $seatcount - 1; $i++) {
                $j = $i + 1;
                $participantDetail = isset($cartItem['kidId'][$i]) ? $cartItem['kidId'][$i] : [];
                $kidId = fieldday()->engine->generateRandomId(16, 'new_kid_');
                $html .= $this->getview('cart/single_kid_form', ['counter' => $j, 'kidId' => $kidId, 'profile' => $participantDetail, 'sessionInfo' => $sessionInfo]);
            }
            $html .= "</div>";
        }

        return $html;
    }

    /**
     * Global Popup Template content display
     */
    public function fielddayShowElementorTemplate($template_id)
    {
        /* $arg = array();
        $arg["source"] ='local';
        $arg["template_id"] = $template_id;
        $temp = \Elementor\Plugin::instance()->templates_manager->get_template_data($arg); */
        $response = \Elementor\Plugin::instance()->frontend->get_builder_content($template_id, true);
        print $response;
    }

    public function fielddayGlobalPopupData()
    {
        global $fielddaySetting;
        $activeGlobleTemplate = $this->getValue('fieldday_globalpopup_template', $fielddaySetting, false);
        $this->fielddayShowElementorTemplate($activeGlobleTemplate);
    }

    /**
     *
     * @param type $parsleyStepGroup
     * @return type Mixed
     */
    public function getCardSaveOptions($parsleyStepGroup)
    {
        $checkboxOptions = '';
        $cartItems = $this->GetCartData();
        foreach ($cartItems as $cartKey => $cartItem) {
            $paymentOption = $cartItem->enabledPaymentOptions;
            if ($paymentOption) {
                $checkboxOptions = " data-parsley-group='{$parsleyStepGroup}' data-parsley-required-message='Required for installment/recurring payments' required='required' checked='checked'";

                return $checkboxOptions;
            }
        }

        return $checkboxOptions;
    }

    /**
     *
     * @param type Get_User_Credit
     * @return type Mixed
     */
    public function Get_User_Credit()
    {
        $queryOptions['isPerDayCredit'] = 'false';
        $response = fieldday()->api->userProviderCreditSummary($queryOptions);
        if ($response->statusCode === 200 || $response->status == 'success') {
            return $response->data;
        }
    }

    /**
     *
     * @param type Calculations
     * @return type Mixed
     */
    public function multiWeekRegistrationsCalc($data)
    {
        $response = fieldday()->api->multiWeekRegistrationsCalc($data);
        if ($response->statusCode === 200 || $response->status == 'success') {
            return $response->data;
        }

    }
    /**
     * Sibling Popup Template content display*/

    // public function fielddaySiblingPopupData(){
    // global $fielddaySetting;
    // $activeSiblingTemplate = $this->getValue('fieldday_siblingpopup_template', $fielddaySetting, false);
    // $this->fielddayShowElementorTemplate($activeSiblingTemplate);
    // }

}
