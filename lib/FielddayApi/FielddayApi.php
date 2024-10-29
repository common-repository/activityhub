<?php

/*
 * fielddayApi.php
 *
 * Copyright 2017 fieldday <contact@fieldday.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

class fielddayApi
{

    private $apiurl = "http://api-dev.kidcircle.com";
    private $apiversion = 'v2';
    public $ProviderId;
    public $AuthKey;
    private $user_access_token;
    public static $CurlTimeout = 100;
    public static $DebugFile = 'php://output';
    public static $debug = false;
    public static $SSLVerification = false;
    public static $PATCH = "PATCH";
    public static $POST = "POST";
    public static $GET = "GET";
    public static $HEAD = "HEAD";
    public static $OPTIONS = "OPTIONS";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    public function __construct()
    {
        global $fielddaySetting;

        if (isset($fielddaySetting['fieldday_api_endpoint']) && !empty($fielddaySetting['fieldday_api_endpoint'])) {
            $this->apiurl = $fielddaySetting['fieldday_api_endpoint'];
        }

        if (isset($fielddaySetting['fieldday_api_provider']) && !empty($fielddaySetting['fieldday_api_provider'])) {
            $this->ProviderId = $fielddaySetting['fieldday_api_provider'];
        }
        if (isset($fielddaySetting['fieldday_api_auth_key']) && !empty($fielddaySetting['fieldday_api_auth_key'])) {
            $this->AuthKey = $fielddaySetting['fieldday_api_auth_key'];
        }
    }

    /**
     * Set API version
     *
     * @param String $version version of the API default is v2
     */
    public function setVersion($version = 'v2')
    {
        $this->apiversion = $version;
    }

    /**
     * get purchase list of a parent for wordpress
     * @param string $userAuthKey parentn Auth ID
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetactivityRegistrations($queryOptions)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        /* set other imp data */
        if (!array_key_exists('providerId', $queryOptions)) {
            $queryOptions['providerId'] = $this->ProviderId;
        }

        return $this->callApi(
            "wp/activityRegistrations", 'GET', $queryOptions, [], ['Authorization' => $accessToken]
        );
    }

    /**
     * v2 place order/add kid to session for logged in user wordpress vendor
     * @param string $userAuthKey parent Auth ID
     * @param array  $postData  Order parameters
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function PostactivityRegistrations($userAuthKey, $postData)
    {
        $this->setVersion();
        return $this->callApi(
            "wp/activityRegistrations", 'POST', [], $postData, ['Authorization' => "Bearer " . $userAuthKey]
        );
    }

    /**
     * login user with email from wordpress vendor
     * @param string $email user email address
     * @param array  $password  user password
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function LoginWithEmail($email)
    {
        $this->setVersion('v3');
        $providerId = $this->ProviderId;
        return $this->callApi(
            "wp/auth/email/login", 'POST', [], ['email' => $email, 'providerId' => $providerId]
        );
    }

    /**
     * register user into fieldday
     * @param string $email user email address
     * @param array  $password  user password
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function Registration($postData)
    {
        $this->setVersion('v3');
        $postData['providerId'] = $this->ProviderId;
        return $this->callApi(
            "wp/auth/email/registration", 'POST', [], $postData
        );
    }

    /**
     * login user with facebook
     * @param string $email user email address
     * @param array  $password  user password
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function LoginWithFacebook($postData)
    {
        $this->setVersion();
        return $this->callApi(
            "wp/auth/facebook", 'POST', [], $postData
        );
    }

    /**
     * login user by google
     * @param string $email user email address
     * @param array  $password  user password
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function LoginWithGoogle($postData)
    {
        $this->setVersion();
        return $this->callApi(
            "wp/auth/google", 'POST', [], $postData
        );
    }

    /**
     * get coupon detail with coupon ID
     * @param string $couponCode user email address
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetCoupon($couponCode)
    {
        $this->setVersion();
        return $this->callApi(
            "wp/coupons/{$couponCode}", 'GET'
        );
    }

    /**
     * save kid insurance data into fieldday
     * @param array $postData Insurance Form data
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function UpdateInsurance($postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/insurance", 'POST', [], $postData, ['Authorization' => $accessToken]
        );
    }

    /**
     * get medical and dental insurance details from wordpress vendor
     * @param array $queryOptions Insurance Form data
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetInsurance($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/insurance", 'GET', $queryOptions, [], ['Authorization' => $accessToken]
        );
    }



    /**
     * get orderDetails By Order Id
     * @param array $queryOptions Insurance Form data
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetOrderDetailsByOrderId($queryOptions = [],$orderId)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/providers/{$this->ProviderId}/activityRegistrations/{$orderId}", 'GET', $queryOptions, []
        );
    }



    /**
     * get list of kids from wordpress vendor
     * @param array $queryOptions Query Parameters
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetKids($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/kids", 'GET', $queryOptions, [], ['Authorization' => $accessToken]
        );
    }

    /**
     * add a kid from wordpress vendor
     * @param array $postData PostData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function AddKid($postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi(
            "wp/kids", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'multipart/form-data']
        );
    }

    /**
     * convert on/off to true/false
     * @param array formdata
     *
     */
    public function kmConvertOnOffToBoolean($data)
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $value = $this->kmConvertOnOffToBoolean($value); // Recursive call for nested arrays
            } else {
                if ($value === 'on') {
                    $value = true;
                } elseif ($value === 'off') {
                    $value = false;
                }
            }
        }
        return $data;
    }

    /**
     * save medical forms for a kid
     *
     * @param array $postData PostData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function SaveMedicalForms($postData = [])
    {
        $this->setVersion();
        global $KmUser;
        $parentId = $_SESSION['api_parentId'];
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/kids/medforms", 'POST', [], $postData, ['Authorization' => $accessToken]);
        } else {
            return $this->callApi("wp/providers/{$this->ProviderId}/kids/{$parentId}/medforms", 'POST', [], $postData);
        }
    }

    /**
     * update a kid profile from wordpress vendor
     * @param String $kidId Kid Id
     * @param array $postData PostData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function UpdateKidProfile($kidId, $postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/kids/{$kidId}", 'PUT', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'multipart/form-data']
        );
    }

    /**
     * Delete a kid profile from fieldday
     *
     * @global array $KmUser
     * @param String $kidId
     * @return mixed response from fieldday API
     */
    public function DeleteKidProfile($kidId)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/kids/{$kidId}", 'DELETE', [], [], ['Authorization' => $accessToken]
        );
    }

    /**
     * update a kid profile from wordpress vendor
     * @param String $kidId Kid Id
     * @param string $accessToken parent access token
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetKidDetail($kidId, $accessToken = null)
    {
        $this->setVersion();
        if (!$accessToken) {
            global $KmUser;
            $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        }
        return $this->callApi(
            "wp/kids/{$kidId}", 'GET', [], [], ['Authorization' => $accessToken]
        );
    }

    /**
     * get available payment options from wordpress app
     * @param Array $postData
     * @param Array $queryOptions
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function PaymentOptions($postData = [], $queryOptions = [])
    {
        $this->setVersion('v4');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        $postData['providerId'] = $this->ProviderId;
        return $this->callApi(
            "wp/paymentoptions", 'POST', $queryOptions, $postData, ['Authorization' => $accessToken]
        );
    }

    /**
     * @return mixed
     */
    public function userProviderCreditSummary($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi("wp/userProviderCreditSummary/{$this->ProviderId}", 'GET', $queryOptions, [], ['Authorization' => $accessToken]);

    }

    /**
     * @return mixed
     */
    public function multiWeekRegistrationsCalc($postData = [])
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi(
            "wp/multiWeekRegistrations/calculation", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
        );

    }

    public function MultiweekRegistrationPurchase($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/multiWeekRegistrations", 'POST', [], $postData, ['Authorization' => $accessToken]);
        }
    }

    /**
     * get terms of provider
     * @param Array $queryOptions
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getActivityProviderTerms($queryOptions = [])
    {
        $this->setVersion();
        return $this->callApi(
            "wp/providers/{$this->ProviderId}/activityProviderTerms", 'GET', $queryOptions
        );
    }

    /**
     * get terms of provider
     * @param Array $queryOptions
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getActivityProvider($queryOptions = [])
    {
        $this->setVersion();
        return $this->callApi(
            "wp/providers/{$this->ProviderId}/activityProviders", 'GET', $queryOptions
        );
    }

    /**
     * v2 place order/add kid to session from wordpress vendor
     * @param Array $postData Form data to register kid for a session
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function activityRegistration($postData = [])
    {
        $this->setVersion();
        return $this->callApi(
            "providers/{$this->ProviderId}/activityRegistrations", 'POST', [], $postData
        );
    }

    /**
     * get providers list
     * @param array  $providerId  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function ProvidersList($providerId = null)
    {
        $this->setVersion('v1');
        if ($providerId) {
            $endpoint = "wp/providers/{$providerId}/activityProviders";
        } else {
            $endpoint = "wp/providers/{$this->ProviderId}/activityProviders";
        }
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get single provider detaiil
     * @param array  $providerId  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function ProviderDetail($providerId = null, $Id = null)
    {
        $this->setVersion('v1');
        $endpoint = "wp/providers/{$providerId}/activityProviders/{$Id}";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get sessions from a provider
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetProviderSessions($queryOptions = [])
    {
        $this->setVersion('v2');
        $endpoint = "wp/providers/{$this->ProviderId}/activitySessions";
        $data =  $this->callApi($endpoint, 'GET', $queryOptions, [], ['content-Type' => 'application/json']);
        return $data;
    }


    /**
     * get sessions from a provider
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function GetProviderSessionsNew($queryOptions = [])
    {
        $this->setVersion('v3');
        $endpoint = "wp/providers/{$this->ProviderId}/activitySessions";
        $data =  $this->callApi($endpoint, 'GET', $queryOptions, [], ['content-Type' => 'application/json']);
        return $data;
    }



    /**
     * v2 get details of session for wordpress vendor
     * @param String $sessionId Session Id
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getActivitySession($sessionId, $queryOptions = [])
    {

        $this->setVersion();
        $endpoint = "wp/providers/{$this->ProviderId}/activitySessions/{$sessionId}";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * v2 get details of session for wordpress vendor
     * @param String $sessionId Session Id
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getActivitySessionDetail($sessionId, $queryOptions = [])
    {
        $this->setVersion('v2');
        $endpoint = "wp/providers/{$this->ProviderId}/activitySessions/{$sessionId}/details";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get gallery photos for wordpress vendor
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function galleryPhotos($queryOptions = [])
    {
        $this->setVersion();
        $endpoint = "wp/providers/{$this->ProviderId}/galleryPhotos/gallery";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get list of schools for wordpress vendor
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getProviderSchools($queryOptions = [])
    {
        $this->setVersion();
        $endpoint = "wp/providers/{$this->ProviderId}/schools/search";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get the data of single school
     * @param string $schooldId
     * @param array $queryOptions
     * @return mixed Response
     */
    public function getSchoolInfo($schooldId, $queryOptions = [])
    {
        $this->setVersion();
        $endpoint = "wp/providers/{$this->ProviderId}/schools/search/{$schooldId}";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get wordpress providers testimonials
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getTestimonials($queryOptions = [])
    {
        $this->setVersion();
        $endpoint = "wp/providers/{$this->ProviderId}/testimonials";
        return $this->callApi($endpoint, 'GET', $queryOptions);
    }

    /**
     * get list of schools for wordpress vendor
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getSchools($queryOptions = [])
    {
        $this->setVersion();
        return $this->callApi("wp/schools/search", 'GET', $queryOptions);
    }

    /**
     * wp get users provider store credit summary
     * @param String $accessToken optional user access token
     * @param array  $queryOptions  parameters to be place in query URL
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getUserProviderCreditSummary($accessToken = null, $queryOptions = [])
    {
        $this->setVersion();
        if (!$accessToken) {
            global $KmUser;
            $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        }
        return $this->callApi("wp/userProviderCreditSummary/{$this->ProviderId}", 'GET', $queryOptions, [], ['Authorization' => $accessToken]);
    }

    /**
     * Change Password for User from wordpress vendor
     * @param array  $postData  FormData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function changePassword($postData = [])
    {
        $this->setVersion();
        return $this->callApi("wp/userProviderCreditSummary/{$this->ProviderId}", 'PUT', [], $postData);
    }

    /**
     * Sends Reset Password Token To User
     * @param String  $email  user email address
     * @param String $redirectUri redirect url
     * @param String $vendorName vendor name
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getResetPasswordToken($email, $redirectUri = '', $vendorName = '')
    {
        $this->setVersion();
        return $this->callApi("wp/users/getResetPasswordToken/{$email}", 'GET', ['redirectUri' => $redirectUri, 'vendorName' => $vendorName]);
    }

    /**
     * resend otp from wordpress
     *
     * @param String $countryCode Country code'
     * @param Int  $phone  user mobile number
     * @param String $accessToken user access token
     * @param String $sendingType call or sms
     *
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function ResendOtp($countryCode, $phone, $accessToken, $sendingType = 'sms')
    {
        $this->setVersion();
        return $this->callApi("wp/users/resendOTP", 'PUT', [], ['phone' => $phone, 'countryCode' => $countryCode, 'sendingType' => $sendingType], ['Authorization' => $accessToken]);
    }

    /**
     * resend otp from wordpress via email
     *
     * @param String $accessToken user access token
     *
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function ResendOtpEmail($accessToken)
    {
        $this->setVersion();
        return $this->callApi("wp/users/resendOTP/email", 'PUT', [], [], ['Authorization' => $accessToken]);
    }

    /**
     * verify otp from wordpress
     * @param Int  $otpCode  user one time password
     * @param String $accessToken user access token
     *
     * @throws ApiException on a non 2xx response
     *
     * @return mixed
     */
    public function verifyOTP($otpCode, $accessToken)
    {
        $this->setVersion();
        return $this->callApi("wp/users/verifyOTP", 'PUT', [], ['otpCode' => $otpCode], ['Authorization' => $accessToken]);
    }

    /**
     * resend otp from wordpress via email
     *
     * @param String $accessToken user access token
     *
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function LoginResendOtpEmail($loginToken, $isEmailOtp)
    {
        $this->setVersion('v3');
        return $this->callApi("wp/users/resendOTP", 'PUT', [], ['loginToken' => $loginToken, 'isEmailOtp' => $isEmailOtp]);
        //return $this->callApi("wp/users/resendOTP/email", 'PUT', [], [], ['Authorization' => $accessToken]);
    }

    /**
     * verify otp from wordpress
     * @param Int  $otpCode  user one time password
     * @param String $accessToken user access token
     *
     * @throws ApiException on a non 2xx response
     *
     * @return mixed
     */
    public function LoginverifyOTP($otpCode, $loginToken)
    {
        $this->setVersion('v3');
        return $this->callApi("wp/users/verifyOTP", 'PUT', [], ['otpCode' => $otpCode, 'loginToken' => $loginToken]);
    }

    /**
     * verify otp from wordpress
     * @param Int  $userId  user Id
     * @param String $accessToken user access token
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getUser($userId, $accessToken = null)
    {
        $this->setVersion();
        if (!$accessToken) {
            global $KmUser;
            $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        }
        return $this->callApi("wp/users/{$userId}", 'GET', [], [], ['Authorization' => $accessToken]);
    }

    /**
     * verify otp from wordpress
     * @param Int  $userId  user Id
     * @param Array $postData FormData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function UpdateUser($userId, $postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/users/{$userId}", 'PUT', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'multipart/form-data']);
    }

    /**
     * get the activity tag types of provider
     * @param Array $queryOptions FormData
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function getActivityTagsCount($queryOptions = [])
    {
        $this->setVersion();
        return $this->callApi("wp/providers/{$this->ProviderId}/activitySessions/activityTagsCount", 'GET', $queryOptions, []);
    }

    /**
     * calculate the price of single session
     *
     * @param Array $postData calculation API Data as POST request
     * @param type $queryOptions other filter parameters as GET request.
     *
     * @return Mixed returned response object
     */
    public function calculateSessionPrice($postData, $queryOptions = [])
    {
        $this->setVersion('v3');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        /* set other imp data */
        $postData['providerId'] = $this->ProviderId;
        return $this->callApi(
            "wp/activityRegistrations/calculateamount", 'POST', $queryOptions, $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
        );
    }

    /**
     * Check seat availability
     */
    public function ValidateCartAPI($sessionId, $queryOptions = [])
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi(
                "wp/providers/{$this->ProviderId}/shoppingCartDetails/validateSession/{$sessionId}", 'GET', $queryOptions, [], ['Content-Type' => 'application/json']);
        } else {
            return $this->callApi(
                "wp/providers/{$this->ProviderId}/shoppingCartDetails/validateSession/{$sessionId}", 'GET', $queryOptions, [], ['Content-Type' => 'application/json']);
        }
    }

    /**
     * send a single item to cart
     */
    public function ItemtoCartAPI($postData)
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            /* call api for loggedin user */
            $postData['providerId'] = $this->ProviderId;
            return $this->callApi(
                "wp/shoppingCartDetails", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
            );
        } else {
            /* call api For guest User */
            return $this->callApi(
                "wp/providers/{$this->ProviderId}/shoppingCartDetails", 'POST', [], $postData, ['Content-Type' => 'application/json']
            );
        }
    }

    /**
     * send a single item to Waitlist
     */
    public function ItemtoWaitListAPI($postData)
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi(
                "wp/sessionWaitings", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
            );
        }
    }

    /**
     * fetch cart items from API
     */
    public function GetCartItemApi($cartId = null, $parentId = null)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/shoppingCarts/{$cartId}", 'GET', [], [], ['Authorization' => $accessToken]);
            // return $this->callApi("wp/shoppingCarts/{$cartId}", 'GET');
        } else {
            /* call api For guest User */
            return $this->callApi("wp/providers/{$this->ProviderId}/shoppingCarts/{$parentId}/{$cartId}", 'GET');
        }

    }

    /**
     * fetch Single cart item from API
     */
    public function GetSingleCartItemApi($itemId, $cartId = null, $parentId = null)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/shoppingCartDetails/{$cartId}/{$itemId}", 'GET', [], [], ['Authorization' => $accessToken]);
        } else {
            /* call api For guest User */
            return $this->callApi("wp/providers/{$this->ProviderId}/shoppingCartDetails/{$parentId}/{$cartId}/{$itemId}", 'GET');
        }

    }

    /**
     * Update Single cart item to API
     */
    public function UpdateSingleCartItemApi($itemId, $cartId = null, $parentId = null, $postData)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/shoppingCartDetails/{$cartId}/{$itemId}", 'PUT', [], $postData, ['Authorization' => $accessToken]);
        } else {
            /* call api For guest User */
            return $this->callApi("wp/providers/{$this->ProviderId}/shoppingCartDetails/{$parentId}/{$cartId}/{$itemId}", 'PUT', [], $postData);
        }
    }

    /**
     * Remove item from cart(API)
     */
    public function RemoveCartItemApi($itemid, $cartId = null, $parentId = null)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/shoppingCartDetails/{$cartId}/{$itemid}", 'DELETE', [], [], ['Authorization' => $accessToken]);
        } else {
            /* call api For guest User */
            return $this->callApi("wp/providers/{$this->ProviderId}/shoppingCartDetails/{$parentId}/{$cartId}/{$itemid}", 'DELETE');
        }
    }

    public function ApplySiblingDiscount($status, $cartId = null, $parentId = null)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            if ($status != "apply") {
                return $this->callApi("wp/siblingdiscount/remove/{$cartId}", 'PUT', [], [], ['Authorization' => $accessToken]);
            } else {
                return $this->callApi("wp/siblingdiscount/apply/{$cartId}", 'PUT', [], $postData, ['Authorization' => $accessToken]);
            }
        } else {
            /* call api For guest User */
            if ($status != "apply") {
                return $this->callApi("wp/providers/{$this->ProviderId}/siblingdiscount/remove/{$parentId}/{$cartId}", 'PUT');
            } else {
                return $this->callApi("wp/providers/{$this->ProviderId}/siblingdiscount/apply/{$parentId}/{$cartId}", 'PUT', [], $postData);
            }
        }

    }

    /**
     * apply store credit for logged-in user
     */
    public function ApplyStoreCreditAPI($postData)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            /* call api for loggedin user */
            return $this->callApi("wp/storecredit/cart/apply", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
            );
        }

    }

    public function AvailableCoupons()
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        return $this->callApi("wp/providers/{$this->ProviderId}/coupons", 'GET');
    }

    public function ApplyCouponAPI($postData = null, $queryParams, $status)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $cartId = $queryParams['cartId'];
        $parentId = $queryParams['parentId'];
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            if ($status != "applycoupon") {
                return $this->callApi("wp/coupons/{$cartId}", 'DELETE', [], [], ['Authorization' => $accessToken]);
            } else {
                return $this->callApi("wp/coupons/{$cartId}", 'POST', [], $postData, ['Authorization' => $accessToken]);
            }
        } else {
            /* call api For guest User */
            if ($status != "applycoupon") {
                return $this->callApi("wp/providers/{$this->ProviderId}/coupons/{$parentId}/{$cartId}", 'DELETE');
            } else {
                return $this->callApi("wp/providers/{$this->ProviderId}/coupons/{$parentId}/{$cartId}", 'POST', [], $postData);
            }
        }

    }

    /**
     *
     */
    public function RemoveStoreCreditAPI($postData)
    {
        global $fielddaySetting;global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            /* call api for loggedin user */
            return $this->callApi("wp/storecredit/cart/remove", 'PUT', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
            );
        }

    }

    /**
     * place order
     *
     * @param array $postData set of data to fieldday API
     *
     * @return mixed Response from fieldday API
     */
    public function purchaseSession($postData)
    {
        $this->setVersion('v4');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            /* call api for loggedin user */
            //$postData['providerId'] = $this->ProviderId;
            return $this->callApi("wp/activityRegistrations", 'POST', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => 'application/json']
            );
        } else {
            /* call api For guest User */
            return $this->callApi("wp/providers/{$this->ProviderId}/activityRegistrations", 'POST', [], $postData, ['Content-Type' => 'application/json']
            );
        }
    }

    /**
     * Wp user change password
     *
     * @return mixed Response from fieldday API
     */
    public function wp_change_password($postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        $postData = json_encode($postData);
        return $this->callApi("wp/users/changePassword", 'PUT', [], $postData, ['Authorization' => $accessToken, 'Content-Type' => ' application/json']);
    }

    /**
     *
     * @param array $queryOptions query parameters
     *
     * @return mixed Response from fieldday API
     */
    public function getShoppingPackages($queryOptions = [])
    {
        $this->setVersion();

        return $this->callApi("wp/providers/{$this->ProviderId}/providerShoppingPackages", 'GET', $queryOptions);
    }

    public function getSingleShoppingPackages($queryOptions = [], $package_id = '')
    {
        $this->setVersion();
        return $this->callApi("wp/providers/{$this->ProviderId}/providerShoppingPackages/{$package_id}", 'GET', $queryOptions);
    }

    /**
     * purchase shoping package
     *
     * @global type $KmUser
     * @param type $postData
     * @return type
     */
    public function purchaseShoppingPackage($postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            /* call api for loggedin user */
            return $this->callApi(
                "wp/providerShoppingPackages/order", 'POST', [], $postData, ['Authorization' => $accessToken]
            );
        } else {
            /* call api For guest User */
            return $this->callApi(
                "wp/providers/{$this->ProviderId}/providerGivenStoreCredits/order", 'POST', [], $postData
            );
        }
    }

    /* fieldday event button html */
    public function fieldday_event_button_html_api($event_type = '', $event_id = '')
    {
        $Info = false;
        if (isset($event_id) && $event_id != '') {
            if ($event_type == 'bankday') {
                $Info = $this->getSingleShoppingPackages([], $event_id);
            } elseif ($event_type == 'giftcard') {
                $Info = $this->getProviderSingleGiftCard($event_id);
            } else {
                $Info = $this->getActivitySessionDetail($event_id);
            }
        }
        return $Info;
    }

    /* fieldday event button html end */

    /**
     * get the user tax details from fieldday account
     * @global array $KmUser
     * @global array $fielddaySetting
     * @param type $queryOptions extra parameters like offset etc
     * @return mixed Response
     */
    public function getTaxDetails($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        global $fielddaySetting;

        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if (!array_key_exists('providerId', $queryOptions)) {
            $queryOptions['providerId'] = $this->ProviderId;
        }
        if (!array_key_exists('offset', $queryOptions)) {
            $queryOptions['offset'] = $fielddaySetting['offset'];
        }
        return $this->callApi(
            "wp/activityRegistrations/expenses/yearwise", 'GET', $queryOptions, [], ['Authorization' => $accessToken]
        );
    }

    /**
     * get the user credit summary
     * @global array $KmUser
     * @param type $queryOptions query options
     * @return mixed Response
     */
    public function userCreditSummary($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/userProviderCreditSummary/{$this->ProviderId}", 'GET', $queryOptions, [], ['Authorization' => $accessToken]);
    }

    /**
     * user credit statements
     * @global array $KmUser
     * @param array $queryOptions
     * @return Response
     */
    public function userStoreCreditStatements($queryOptions = [])
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        /* set other imp data */
        if (!array_key_exists('providerId', $queryOptions)) {
            $queryOptions['providerId'] = $this->ProviderId;
        }
        if (!array_key_exists('isPerDayCredit', $queryOptions)) {
            $queryOptions['isPerDayCredit'] = 'true';
        }

        return $this->callApi("wp/userStoreCreditStatements", 'GET', $queryOptions, [], ['Authorization' => $accessToken]);
    }

    /**
     * get featured session
     * @global array $fielddaySetting
     * @param type $queryOptions
     *
     * @return Response
     */
    public function getFeaturedSession($queryOptions = [])
    {
        global $fielddaySetting;
        $this->setVersion('v3');
        if (!array_key_exists('offset', $queryOptions)) {
            $queryOptions['offset'] = $fielddaySetting['offset'];
        }
        return $this->callApi("wp/providers/{$this->ProviderId}/activitySessions/list/home", 'GET', $queryOptions);
    }

    /**
     * get featured session
     * @global array $fielddaySetting
     * @param type $queryOptions
     *
     * @return Response
     */
    public function getFeaturedActivities($queryOptions = [])
    {
        global $fielddaySetting;
        $this->setVersion('v3');
        if (!array_key_exists('offset', $queryOptions)) {
            //$queryOptions['offset'] = $fielddaySetting['offset'];
        }

        return $this->callApi("wp/activities/{$this->ProviderId}", 'GET', $queryOptions);
    }

    /**
     * get packages
     * @global array $fielddaySetting
     * @param type $queryOptions
     *
     * @return Response
     */
    public function getPackages($queryOptions = [])
    {
        global $fielddaySetting;
        $this->setVersion('v1');
        return $this->callApi("wp/providers/{$this->ProviderId}/classPackages", 'GET', $queryOptions);
    }

    /**
     *
     * @global array $fielddaySetting
     * @param array $queryOptions
     * @return type Response
     */
    public function homeSessionActivities($queryOptions = [])
    {
        global $fielddaySetting;
        $this->setVersion('v3');
        if (!array_key_exists('offset', $queryOptions)) {
            $queryOptions['offset'] = $fielddaySetting['offset'];
        }
        return $this->callApi("wp/providers/{$this->ProviderId}/activities/list/home", 'GET', $queryOptions);
    }
    /**
     * claim store credit through Coupon code
     * @global array $KmUser
     * @param array $postData
     * @return Response
     */
    public function clamimCoupon($postData)
    {
        $this->setVersion();
        global $KmUser;

        $postData['providerId'] = $this->ProviderId;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/storeCredits/claim", 'POST', [], $postData, ['Authorization' => $accessToken]);
    }

    /**
     * make the provider donation
     * @global array $KmUser
     * @param array $postData
     * @return Response
     */
    public function makeDonation($postData)
    {
        $this->setVersion();
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        /* set other imp data */
        if (!array_key_exists('providerId', $postData)) {
            $postData['providerId'] = $this->ProviderId;
        }

        return $this->callApi(
            "wp/providerDonations", 'POST', [], $postData, ['Authorization' => $accessToken]
        );
    }

    /**
     * get the provider testimonials
     * @param array $queryOptions
     * @return Response
     */
    public function getProviderTestimonials($queryOptions = [])
    {
        $this->setVersion();

        return $this->callApi("wp/providers/{$this->ProviderId}/testimonials", 'GET', $queryOptions);
    }

    /**
     * get all activities of provider
     * @param array $queryOptions
     * @return Response
     */
    public function getProviderActivities($queryOptions = [])
    {
        $this->setVersion('v3');

        return $this->callApi("wp/providers/{$this->ProviderId}/activities", 'GET', $queryOptions);
    }

    /**
     * get activity tags list
     * @param array $queryOptions
     *
     * @return Response activity tags
     */
    public function getActivityTags($queryOptions = [])
    {
        $this->setVersion();

        return $this->callApi("wp/activityTags?providerId={$this->ProviderId}", 'GET', $queryOptions);
    }

    /**
     * get gift card for a provider
     * @return Response
     */
    public function getProviderGiftCards()
    {
        $this->setVersion('v1');

        return $this->callApi("wp/providers/{$this->ProviderId}/giftCards", 'GET');
    }

    /**
     * get single gift card for a provider
     * @return Response
     */
    public function getProviderSingleGiftCard($giftCardid)
    {
        $this->setVersion('v1');

        return $this->callApi("wp/providers/{$this->ProviderId}/giftCards/{$giftCardid}", 'GET');
    }

    /**
     * get birthday parties activities
     * @return Response
     */
    /*public function BirthdayActivityRooms()
    {
    $this->setVersion('v1');
    global $KmUser;
    $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

    return $this->callApi("providers/{$this->ProviderId}/BirthdayActivityRooms", 'GET', [], [], ['Authorization' => $accessToken]);
    }*/

    /**
     * get saved card of parent
     * @global array $KmUser
     * @return type
     */
    public function getSavedCards()
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/parentPaymentDetails", 'GET', [], [], ['Authorization' => $accessToken]);
    }

    /**
     * get saved card of parent
     * @global array $KmUser
     * @return type
     */
    public function saveNewCard($postData)
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if (!array_key_exists('isDefault', $postData)) {
            $postData['isDefault'] = "false";
        }

        return $this->callApi("wp/parentPaymentDetails", 'POST', [], $postData, ['Authorization' => $accessToken]);
    }

    public function deleteKmUser()
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        $userId = $KmUser->_id;
        $userId = '21312313';
        return $this->callApi("wp/users/{$userId}", 'DELETE', [], [], ['Authorization' => $accessToken]);
    }

    public function deleteSavedCard($cardId)
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/parentPaymentDetails/{$cardId}", 'DELETE', [], [], ['Authorization' => $accessToken]);
    }

    public function setCardAsDefault($cardId)
    {
        $this->setVersion('v1');
        global $KmUser;
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("wp/parentPaymentDetails/{$cardId}", 'PUT', [], [], ['Authorization' => $accessToken]);
    }
    
    public function getSavedCard($cardId)
    {
        $cards = $this->getSavedCards();
        if ($cards->statusCode === 200) {
            foreach ($cards->data as $key => $card) {
                if ($card->_id == $cardId) {
                    $cards->data = $card;
                }
            }
        }

        return $cards;
    }
    /**
     * get locations available for a provider
     * @param array $queryOptions
     * @return Response provider locations
     */
    public function getProviderLocations($queryOptions = [])
    {
        $this->setVersion();

        return $this->callApi("wp/providers/{$this->ProviderId}/providerLocations", 'GET', $queryOptions);
    }

    /**
     * * get membership subscription available for a provider
     * @param array $queryOptions
     * @return type Response
     */
    public function homeMemberActivities($queryOptions = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        if (!array_key_exists('providerId', $queryOptions)) {
            $queryOptions['providerId'] = $this->ProviderId;
        }
        return $this->callApi("wp/memberships", 'GET', $queryOptions, []);
    }
    /**
     * Purchase membership from parent app
     * @param array $postData API Post data
     * @return type Response
     */
    public function membershipSubscriptionPurchase($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        /*if (!array_key_exists('providerId', $queryOptions)) {
        $queryOptions['providerId'] = $this->ProviderId;
        }*/
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;

        return $this->callApi("membershipSubscriptions/purchase", 'POST', [], $postData, ['Authorization' => $accessToken]);
    }

    /**
     * Purchase Package
     * @param array $postData API Post data
     * @return type Response
     */
    public function PackagePurchase($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/activityRegistrations/classPackage/booking", 'POST', [], $postData, ['Authorization' => $accessToken]);
        } else {
            return $this->callApi("wp/activityRegistrations/classPackage/booking", 'POST', [], $postData);
        }
    }

    /**
     * Package Options
     * @param array $postData API Post data
     * @return type Response
     */
    public function PackageOPtions($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/activityRegistrations/classPackage/calculation", 'POST', [], $postData, ['Authorization' => $accessToken]);
        } else {
            return $this->callApi("wp/activityRegistrations/classPackage/calculation", 'POST', [], $postData);
        }
    }

    /**
     * Events Calculation
     * @param array $postData API Post data
     * @return type Response
     */
    public function EventsCalc($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {
            return $this->callApi("wp/activityRegistrations/activityEvents/calculateamount", 'POST', [], $postData, ['Authorization' => $accessToken]);
        } else {
            return $this->callApi("wp/activityRegistrations/activityEvents/calculateamount", 'POST', [], $postData, ['Authorization' => '']);
        }
    }

    /**
     * Events Purchase
     * @param array $postData API Post data
     * @return type Response
     */
    public function EventsPurchase($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        if ($accessToken) {

            return $this->callApi("wp/activityRegistrations/activityEvents/booking", 'POST', [], $postData, ['Authorization' => $accessToken]);
        } else {
            $this->setVersion('v3');
            return $this->callApi("wp/providers/{$this->ProviderId}/activityRegistrations/activityEvents/booking", 'POST', [], $postData);
        }
    }

    /**
     * Get Event Ticket details
     */
    public function GetTicketDetail($apidata, $queryOptions = [])
    {
        global $fielddaySetting;
        $this->setVersion('v1');
        $ticketid = $apidata['ticketid'];
        $orderno = $apidata['orderno'];
        $queryOptions['offset'] = 330;
        //$accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi("wp/activityRegistrations/activityEvents/" . $ticketid . "/" . $orderno, 'GET', $queryOptions, []);
    }

    /**
     * Self Check-In
     */
    public function SelfCheckIn($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi("wp/activityEvents/self-check-in", 'POST', [], $postData, ['Authorization' => $accessToken]);
    }

    /**
     * Pull Ticket
     */
    public function PullTicketAPI($queryOptions = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        $queryOptions['providerId'] = $this->ProviderId;
        return $this->callApi("wp/activityRegistrations/activityEvents/pull-ticket", 'GET', $queryOptions, []);
    }
    /**
     * Contact Form
     */
    public function ContactFormAPI($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        return $this->callApi("wp/providers/{$this->ProviderId}/providerWebsiteQueries", 'POST', [], $postData, []);
    }

    /* refund functon */
    public function refundFormEventSessionAPI($postData = [], $tiketID = '', $eventID = '', $providerId = '')
    {
        global $fielddaySetting;
        $this->setVersion('v1');
        return $this->callApi("wp/ActivityRegistrationDetails/{$this->ProviderId}/{$tiketID}/{$eventID}/cancel-options", 'PUT', [], $postData, []);
    }
    /**
     * Contact Form
     */
    public function RequestDemoFormAPI($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        return $this->callApi("partnerDemoRequests", 'POST', [], $postData, []);
    }
    /**
     * Purchase giftCard
     * @param array $postData API Post data
     * @return type Response
     */
    public function giftcardPurchase($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi("wp/giftCards/purchase", 'POST', [], $postData, ['Authorization' => $accessToken]);
    }

    /**
     * Purchase giftCard for guest user
     * @param array $postData API Post data
     * @return type Response
     */
    public function giftcardPurchaseGuest($postData = [])
    {
        global $fielddaySetting;
        global $KmUser;
        $this->setVersion('v1');
        $accessToken = isset($KmUser->accessToken) ? $KmUser->accessToken : null;
        return $this->callApi("wp/{$this->ProviderId}/giftCards/purchase", 'POST', [], $postData);
    }

    /**
     * Make the HTTP call (Sync)
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headerParams parameters to be place in request header
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function callApi($resourcePath, $method = 'GET', $queryParams = [], $postData = array(), array $headerParams = array())
    {

        if (!array_key_exists('Authorization', $headerParams)) {
            $headerParams['Authorization'] = "Bearer " . $this->AuthKey;
        } elseif (!empty($headerParams['Authorization'])) {
            $headerParams['Authorization'] = "Bearer " . $headerParams['Authorization'];
        }
        //$headerParams['Access-Control-Allow-Origin'] = "*";
        //$headerParams['Access-Control-Allow-Methods'] = $method;
        // form data
        if (array_key_exists('Content-Type', $headerParams) && $headerParams['Content-Type'] == 'multipart/form-data') { // json model
            $boundary = wp_generate_password(24);
            $headerParams['Content-Type'] = 'multipart/form-data; boundary=' . $boundary;

            $payload = '';
            foreach ($postData as $name => $value) {
                if ($name != 'file') {
                    $payload .= '--' . $boundary;
                    $payload .= "\r\n";
                    $payload .= 'Content-Disposition: form-data; name="' . $name . '"' . "\r\n\r\n";
                    $payload .= $value;
                    $payload .= "\r\n";
                } else {
                    $local_file = $value['path'];
                    $filename = $value['name'];
                    if ($local_file) {
                        $payload .= '--' . $boundary;
                        $payload .= "\r\n";
                        $payload .= 'Content-Disposition: form-data; name="' . $filename .
                        '"; filename="' . basename($local_file) . '"' . "\r\n";
                        // $payload .= 'Content-Type: image/jpeg' . "\r\n";
                        $payload .= "\r\n";
                        $payload .= file_get_contents($local_file);
                        $payload .= "\r\n";
                    }
                }
            }
            $payload .= '--' . $boundary . '--';
            $postData = $payload;

        } else if (array_key_exists('Content-Type', $headerParams) && $headerParams['Content-Type'] == 'application/json') {
            $oldPostData = $postData;
            $postData = json_encode($postData);
        }

        $url = $this->apiurl . "/" . $this->apiversion . "/" . $resourcePath;
        if (!empty($queryParams)) {
            $url = ($url . '?' . http_build_query($queryParams));
        }
        $requestarg = [
            'headers' => $headerParams,
            'timeout' => self::$CurlTimeout,
            'body' => $postData,
        ];

        switch ($method) {
            case self::$POST:
                $api_response = wp_remote_post($url, $requestarg);
                break;
            case self::$PUT:
                $requestarg['method'] = "PUT";
                $api_response = wp_remote_request($url, $requestarg);
                break;
            case self::$DELETE:
                $requestarg['method'] = "DELETE";
                $api_response = wp_remote_request($url, $requestarg);
                break;
            case self::$GET:
                $api_response = wp_remote_get($url, $requestarg);
                break;
            default:
                break;
        }

        if (is_wp_error($api_response)) {
            return (object) array('message' => $api_response->get_error_message(), 'statusCode' => 404, 'headers' => '');
        }

        $response = json_decode($api_response['body']);
        if (!is_object($response)) {
            $response = new stdClass();
        }
        $response->apiUrl = $url;
        $response->message = isset($response->message) && $response->message !== '' ? $response->message : $response->customMessage;
        if ($response->statusCode >= 200 && $response->statusCode <= 299) {
            return $response;
        } else {
            $response->message = $response->message;
            $response->params = $requestarg;
            return $response;
        }
    }
}
