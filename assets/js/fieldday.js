/*
 *
 * fieldday front end Javascript
 *
 * @since 1.0.0
 *
 */
var fieldday;
(function($) {
    let kmIncrementTimer;
    var $this, $currentstep, $totalkids, reinitializeCalendarType, $timerOn, $timer, $otptimer, $isKmUser, $minstepnumber, $maxstepnumber, widgetId, AtcsessionId, AtctagId, AtcsessionDate, AtcOfferId, AtcOffername, $state, $code, $typingTimer, AtcpackageId, AtcIspackage, AtcIsEvent, AtcClickOpenSession, kmcleavePhone;
    fieldday = {
        settings: {
            loader: '<div class="km_loader_full"></div>',
            spinnerInline: '<i class="fa fa-spinner fa-spin wpforms-loading-inline"></i>',
            DaysArray: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            allCountries: {
                "93": "af",
                "355": "al",
                "213": "dz",
                "1": "us",
                "376": "ad",
                "244": "ao",
                "54": "ar",
                "374": "am",
                "297": "aw",
                "61": "cc",
                "43": "at",
                "994": "az",
                "973": "bh",
                "880": "bd",
                "375": "by",
                "32": "be",
                "501": "bz",
                "229": "bj",
                "975": "bt",
                "591": "bo",
                "387": "ba",
                "267": "bw",
                "55": "br",
                "246": "io",
                "673": "bn",
                "359": "bg",
                "226": "bf",
                "257": "bi",
                "855": "kh",
                "237": "cm",
                "238": "cv",
                "599": "cw",
                "236": "cf",
                "235": "td",
                "56": "cl",
                "86": "cn",
                "57": "co",
                "269": "km",
                "243": "cd",
                "242": "cg",
                "682": "ck",
                "506": "cr",
                "225": "ci",
                "385": "hr",
                "53": "cu",
                "357": "cy",
                "420": "cz",
                "45": "dk",
                "253": "dj",
                "593": "ec",
                "20": "eg",
                "503": "sv",
                "240": "gq",
                "291": "er",
                "372": "ee",
                "251": "et",
                "500": "fk",
                "298": "fo",
                "679": "fj",
                "358": "ax",
                "33": "fr",
                "594": "gf",
                "689": "pf",
                "241": "ga",
                "220": "gm",
                "995": "ge",
                "49": "de",
                "233": "gh",
                "350": "gi",
                "30": "gr",
                "299": "gl",
                "590": "mf",
                "502": "gt",
                "44": "gb",
                "224": "gn",
                "245": "gw",
                "592": "gy",
                "509": "ht",
                "504": "hn",
                "852": "hk",
                "36": "hu",
                "354": "is",
                "91": "in",
                "62": "id",
                "98": "ir",
                "964": "iq",
                "353": "ie",
                "972": "il",
                "39": "va",
                "81": "jp",
                "962": "jo",
                "7": "ru",
                "254": "ke",
                "686": "ki",
                "383": "xk",
                "965": "kw",
                "996": "kg",
                "856": "la",
                "371": "lv",
                "961": "lb",
                "266": "ls",
                "231": "lr",
                "218": "ly",
                "423": "li",
                "370": "lt",
                "352": "lu",
                "853": "mo",
                "389": "mk",
                "261": "mg",
                "265": "mw",
                "60": "my",
                "960": "mv",
                "223": "ml",
                "356": "mt",
                "692": "mh",
                "596": "mq",
                "222": "mr",
                "230": "mu",
                "262": "re",
                "52": "mx",
                "691": "fm",
                "373": "md",
                "377": "mc",
                "976": "mn",
                "382": "me",
                "212": "eh",
                "258": "mz",
                "95": "mm",
                "264": "na",
                "674": "nr",
                "977": "np",
                "31": "nl",
                "687": "nc",
                "64": "nz",
                "505": "ni",
                "227": "ne",
                "234": "ng",
                "683": "nu",
                "672": "nf",
                "850": "kp",
                "47": "sj",
                "968": "om",
                "92": "pk",
                "680": "pw",
                "970": "ps",
                "507": "pa",
                "675": "pg",
                "595": "py",
                "51": "pe",
                "63": "ph",
                "48": "pl",
                "351": "pt",
                "974": "qa",
                "40": "ro",
                "250": "rw",
                "290": "sh",
                "508": "pm",
                "685": "ws",
                "378": "sm",
                "239": "st",
                "966": "sa",
                "221": "sn",
                "381": "rs",
                "248": "sc",
                "232": "sl",
                "65": "sg",
                "421": "sk",
                "386": "si",
                "677": "sb",
                "252": "so",
                "27": "za",
                "82": "kr",
                "211": "ss",
                "34": "es",
                "94": "lk",
                "249": "sd",
                "597": "sr",
                "268": "sz",
                "46": "se",
                "41": "ch",
                "963": "sy",
                "886": "tw",
                "992": "tj",
                "255": "tz",
                "66": "th",
                "670": "tl",
                "228": "tg",
                "690": "tk",
                "676": "to",
                "216": "tn",
                "90": "tr",
                "993": "tm",
                "688": "tv",
                "256": "ug",
                "380": "ua",
                "971": "ae",
                "598": "uy",
                "998": "uz",
                "678": "vu",
                "58": "ve",
                "84": "vn",
                "681": "wf",
                "967": "ye",
                "260": "zm",
                "263": "zw"
            },
            parsley_valiation_options: {
                trigger: 'change',
                successClass: "has-success",
                errorClass: "has-error",
                classHandler: function(el) {
                    return el.$element.closest('fieldset'); //working
                },
                errorsWrapper: '<div class="km_invalid_message"></div>',
                errorTemplate: '<span></span>'
            },
            parsley_valiation_options_register: {
                trigger: 'change',
                successClass: "has-success",
                errorClass: "has-error",
                classHandler: function(el) {
                    return el.$element.closest('fieldset'); //working
                },
                errorsWrapper: '<div class="km_auth_invalid_message"></div>',
                errorTemplate: '<span></span>'
            }
        },
        initilaize: function() {
            $this = fieldday;
            $currentstep = 0;
            $otptimer = 120;
            $timerOn = true;
            $minstepnumber = 1;
            $maxstepnumber = 5;
            $isKmUser = fieldday_ajax.isKmUser;
            $(document).ready(function() {
                $this.onInitMethods();
            });
            /* clear session filter when user click browser back button */
            $this.ClearSessionFilters('.km_filter_form');
        },
        onInitMethods: function() {
            $this.FilterSessions();
            $this.BookingSelection();
            $this.BookingCalander();
            $this.MultiWeekBookingCalander();
            $this.fielddaySessionTime();
            $this.InitSessionFilter();
            $this.PhoneInput();
            $this.DateInput();
            $this.CardInput();
            $this.triggerModal();
            $this.handleQueryParam();
            $this.atc_cart_steps();
            $this.requiredfields();
            $this.inputincrement();
            $this.checkoutpageevents();
            $this.merchandiseevents();
            $this.kidspageevents();
            $this.SessionlistVeiw();
            $this.km_get_utc_string_func()
            $this.Myaccountpageevents();
            $this.getTimezoneOffset();
            $this.kmTooltip();
            $this.otpEvents();
            $this.fielddaySelect();
            $this.hasCart();
            $this.countItmeCart();
            $this.initilaizeDaterangepicker();
            $this.ModalCalander();
            $this.giftCardswitchevent();
            $this.passwordHideShowevent();
            $this.FilterMobile();
            $this.AddressAutoComplete();
            $this.ActivePurchasetab();
            $this.scrollTo();
            $this.StickyformVisibility();
            $this.initSlickSlider();
            $this.LocationPopUpformVisibility();
            //$this.Extradata();
            /* set stripe publishing key*/
            Stripe.setPublishableKey(fieldday_ajax.fieldday_stripe_token);
            $this.paymentrequired = false;
            var bankdays = document.URL.split('=')[1];
            if (bankdays == "bank_days") {
                $('.km_merchandise').attr('checked', true);
                $('.km_merchandise').trigger("change");
            }
        },
        km_get_utc_string_func: function() {
            try {
                let currentTime = new Date();
                currentTime.setUTCMinutes(currentTime.getUTCMinutes() + 2); // Add 2 minutes
                let hours = currentTime.getUTCHours();
                let minutes = currentTime.getUTCMinutes();
                let seconds = currentTime.getUTCSeconds();
                let utc_string = `${hours}:${minutes}:${seconds}`;
                return utc_string;
            } catch (err) {
                return `23:59:59`;
            }
        },
        getDaysBetweenDates: function(startDate, endDate) {
            var now = startDate.clone(),
                dates = [];
            while (now.isSameOrBefore(endDate)) {
                dates.push(now.format('MM-DD-YYYY'));
                now.add(1, 'days');
            }
            return dates;
        },
        deleteUserAccountFieldday: function() {
            let checkBoxes = '#km_user_delete_account_form input[type="checkbox"]';
            if (jQuery(checkBoxes + ':checked').length != jQuery(checkBoxes).length) {
                $this.DisplayAlert('error', 'Please check all the checkboxes fields.');
            } else if (jQuery("#km_user_delete_account_form input[name='delete']").val() != 'DELETE') {
                $this.DisplayAlert('error', 'Type DELETE in the Textbox first.');
            } else {
                var formData = new FormData();
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_user_delete", formData, function(response) {
                    if (response.status == 'success') {
                        console.log('successdata');
                        alert("in progress");
                        //$this.kmRemoveLoader();  
                    } else {
                        $this.kmRemoveLoader();
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        FilterMobile: function() {
            jQuery('.km_mobile_filters').click(function() {
                jQuery('#km_session_search_container .km_filter_row.bottom_row , .km_filter_row.myrow.km_filters_change').toggleClass('km_mobile_hidden');
            });
        },
        AddressAutoComplete: function() {
            if ($('#address_autocomplete').length) {
                var input = document.getElementById('address_autocomplete');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }
            if ($('.km_doctor_address').length) {
                $('.km_doctor_address').each(function() {
                    var attrid = $(this).find('input.kmdoctorStreet').attr('id');
                    var input = document.getElementById(attrid);
                    //Doctor ZipCode Field
                    var pinid = $(this).find('input.kmdoctorpin').attr('id');
                    var pininput = document.getElementById(pinid);
                    //Doctor State Field
                    var stateid = $(this).find('input.kmdoctorState').attr('id');
                    var stateinput = document.getElementById(stateid);
                    //Doctor City Field
                    var cityid = $(this).find('input.kmdoctorCity').attr('id');
                    var cityinput = document.getElementById(cityid);
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        for (var i = 0; i < place.address_components.length; i++) {
                            for (var j = 0; j < place.address_components[i].types.length; j++) {
                                if (place.address_components[i].types[j] == "postal_code") {
                                    //document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                                    $(pininput).val(place.address_components[i].long_name);
                                }
                                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                    $(stateinput).val(place.address_components[i].long_name);
                                }
                                if (place.address_components[i].types[j] == "locality") {
                                    $(cityinput).val(place.address_components[i].long_name);
                                }
                            }
                        }
                    });
                });
            }
        },
        ActivePurchasetab: function() {
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;
                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] === sParam) {
                        return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return false;
            };
            var tabid = getUrlParameter('tab');
            if (tabid) {
                jQuery('.km_radio_wrap[data-tab=' + tabid + ']').find('input').trigger('click');
                //jQuery('input[value='+tabid+']').trigger('click');
            }
        },
        BookingSelection: function() {
            //var edited_selected_value = $("input[name='ATC[bookingoption_selection]']:checked").val(); 
            var edited_selected_value = $("#km_booking_radio_select").val();
            if (edited_selected_value && edited_selected_value != 'fullcamp') {
                $('.km_cart_calender,.km_cart_calender_main').removeClass('km_hidden');
                var textare_value = $('#DatesLabel').val();
                if (textare_value) {
                    var selected_dates = JSON.parse($('#DatesLabel').val());
                    if (selected_dates != '') {
                        var len = Object.keys(selected_dates).length;
                        if (len > 0) {
                            if (len == 1) {
                                var dates_count_text = "date selected";
                            } else {
                                var dates_count_text = "dates selected";
                            }
                            $('.km_dates_count').html('(<span>' + len + '</span> ' + dates_count_text + ')');
                        } else {
                            $('.km_dates_count').html('');
                        }
                    }
                }
            }
            $(document).on('change', '#km_booking_radio_select', function() {
                let selected_value = $('#km_booking_radio_select').val();
                let selected_Option = $('#km_booking_radio_select').find('option:selected');
                let parsely_field_sel_date = jQuery('#DatesLabel').parent().find('.parsley-required');
                let calendarDateFrom = jQuery(this).attr('data-date-from');
                let calendarDateTo = jQuery(this).attr('data-date-to');
                let dataObjectOfDates = fieldday.BookingAtcWaitlistReinitializeObject(calendarDateFrom, calendarDateTo);
                if (selected_value == 'fullcamp' || selected_value == '') {
                    parsely_field_sel_date.hide();
                    $('.km_input_extraoptions,.km_extra_additional').html('');
                    $('.km_cart_calender,.km_cart_calender_main,.km_calender').addClass('km_hidden');
                    $('.km_FullSessionextendedPrice').removeClass('km_hidden');
                    $('.km_perDayextendedPrice').addClass('km_hidden');
                    $('.km_installments').removeClass('km_hidden');
                    $('.km_installments input').attr('required', 'required');
                    $('#DatesLabel').removeAttr('required');
                    jQuery('.km_calander_div').multiDatesPicker('resetDates', 'picked');
                    jQuery('#DatesLabel').val('');
                    jQuery('#DatesTimeLabel').val('');
                    jQuery('#DatesTimeLabelAllDates').val('');
                    jQuery('#DatesTimeLabelAllDatesUtcFormat').val('');
                    jQuery('#DatesAvail').val('');
                    jQuery('.km_dates_count').html('');
                    jQuery('.km_selected_opt').remove();
                    var availabilityFullcamp = selected_Option.attr('data-fullcamp-avail');
                    $('.km_allowed_seats').attr('id', availabilityFullcamp);
                    $this.Extradata();
                    fieldday.CalanderAtcDestroySetButtons('default');
                } else {
                    parsely_field_sel_date.show();
                    $('.km_input_extraoptions,.km_extra_additional').html('');
                    $('.km_cart_calender,.km_cart_calender_main').removeClass('km_hidden');
                    $('.km_FullSessionextendedPrice').addClass('km_hidden');
                    $('.km_perDayextendedPrice').removeClass('km_hidden');
                    $('.km_installments').addClass('km_hidden');
                    $('.km_installments input').removeAttr('required');
                    $('#DatesLabel').attr('required', 'required');
                    var datetimearray = selected_Option.attr('data-oneday-times');
                    jQuery('#DatesTimeLabel').val(datetimearray);
                    var datetimearrayAllDates = selected_Option.attr('data-oneday-times-all-dates');
                    jQuery('#DatesTimeLabelAllDates').val(datetimearrayAllDates);
                    var datetimearrayAllDates = selected_Option.attr('data-oneday-times-all-dates');
                    jQuery('#DatesTimeLabelAllDates').val(datetimearrayAllDates);
                    var DatesTimeLabelAllDatesUtcFormat = selected_Option.attr('data-oneday-times-all-dates-utc');
                    jQuery('#DatesTimeLabelAllDatesUtcFormat').val(DatesTimeLabelAllDatesUtcFormat);
                    $('#DatesLabel').val('');
                    jQuery('.km_dates_count').html('');
                    jQuery(".km_onedayavail").html('');
                    if (dataObjectOfDates && dataObjectOfDates.dates.length > 0) {
                        jQuery('.km_calander_div').multiDatesPicker('resetDates', 'picked');
                        fieldday.BookingCalanderForAtcDestroy(dataObjectOfDates.dates[0], dataObjectOfDates.dates[dataObjectOfDates.dates.length - 1]);
                    }
                    fieldday.CalanderAtcDestroySetButtons('default');
                }
            });
        },
        BookingCalander: function() {
            $(document).on("click", ".km_multidatepicker_date_trashIcon", function() {
                let date = $(this).parent().parent().find(".km_avail_content_dateOnly");
                let oldValue = $("#DatesLabel").val();
                let oneday_avails = $("#km_booking_radio_select").find('option:selected').attr('data-oneday-avail');
                let oneday_availsnew = JSON.parse(oneday_avails);
                var availCount = new Array();
                if (date) {
                    let dateListTemp = JSON.parse($("#DatesLabel").val());
                    date = date.text();
                    dateListTemp = dateListTemp.filter(datenew => datenew !== date);
                    if (dateListTemp.length == 0) {
                        $("#km_booking_radio_select").trigger("change");
                    } else {
                        let newDateValue = JSON.stringify(dateListTemp);
                        $("#DatesLabel").val(newDateValue);
                        let dateToRemove = new Date(date);
                        jQuery('.km_calander_div').multiDatesPicker('removeDates', dateToRemove);
                        $('.km_onedayavail').html('');
                        $.each(dateListTemp, function(i, item) {
                            var valuess = (oneday_availsnew[dateListTemp[i]] !== undefined) ? oneday_availsnew[dateListTemp[i]] : 0;
                            $('.km_onedayavail').append('<div class="km_selected_opt"><span class="km_avail_label">Date: </span><span class="km_avail_content  km_avail_content_dateOnly">' + dateListTemp[i] + '</span><span class="km_avail_label">Available Seats: </span><span class="km_avail_content">' + valuess + '&nbsp;&nbsp;<i class="fa fa-trash km_primary_color km_multidatepicker_date_trashIcon" aria-hidden="true"></i></span></div>');
                            availCount.push(valuess);
                        });
                        let minavailCount = Math.min.apply(Math, availCount);
                        $('.km_allowed_seats').attr('id', minavailCount);
                        let dates_count = dateListTemp.length;
                        if (dates_count > 0) {
                            if (dates_count == 1) {
                                var count_text = "date selected";
                            } else {
                                var count_text = "dates selected";
                            }
                            $('.km_dates_count').html('(<span>' + dates_count + '</span> ' + count_text + ')');
                        } else {
                            $('.km_dates_count').html('');
                        }
                        fieldday.Extradata();
                    }
                    //reinitialize the datepicker end
                }
            });
            $(".km_cart_calender").on('click', function() {
                $(this).next('.km_calender').toggleClass('km_hidden');
                var dateFrom = $(this).data('date-from');
                var dateTo = $(this).data('date-to');
                fieldday.BookingAtcWaitlistReinitialize(dateFrom, dateTo, 'reset');
            });
        },
        BookingAtcWaitlistReinitializeObject: function(dateFrom, dateTo, type = "reset") {
            try {
                var typeOfRequest;
                var BookingAtcObject = {};
                let addDisabledDates = new Array();
                let disablecal = '';
                // let startDate = moment(dateFrom);
                //let endDate = moment(dateTo);
                let arr = new Array();
                let allDates = new Array();
                let futureDates = new Array();
                let sel_arr = '';
                let addToCartDates = new Array();
                var allDatesObjectToGetDate = JSON.parse($("#km_booking_radio_select").find('option:selected').attr('data-oneday-times-all-dates'));
                startDate = moment(Object.values(allDatesObjectToGetDate)[0]);
                endDate = moment(Object.values(allDatesObjectToGetDate)[Object.values(allDatesObjectToGetDate).length - 1]);
                let dateList = [];
                //let dateList = $this.getDaysBetweenDates(startDate, endDate);
                if (allDatesObjectToGetDate !== null && typeof allDatesObjectToGetDate === 'object') {
                    dateList = Object.keys(allDatesObjectToGetDate);
                }
                /*
                $.each(dateList, function(index, value) { 
                        let date = new Date();
                        let valdate = new Date(value);
                        let newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                        if(valdate < date){
                            arr.push(newDate);
                        }           
                });
                */
                var textare_value = $('#DatesLabel').val();
                if (textare_value != '') {
                    let selected_dates = JSON.parse($('#DatesLabel').val());
                    if (selected_dates != '') {
                        let sel_arr = new Array();
                        $.each(selected_dates, function(index, value) {
                            var valdate = new Date(value);
                            var newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                            sel_arr.push(newDate);
                        });
                    }
                }
                let selected_value = $('#km_booking_radio_select').val();
                if (selected_value != 'fullcamp' && selected_value != '') {
                    var sel_array = $("#km_booking_radio_select").find('option:selected').attr('data-oneday-dates');
                    sel_array = JSON.parse(sel_array);
                    if (selected_value == 'halfDayMrng') {
                        let sel_mrnng_arr = $("#km_booking_radio_select option[value='halfDayMrng']").attr('data-waitlist-days-morning');
                        arr = JSON.parse(sel_mrnng_arr);
                    } else if (selected_value == 'halfDayEvng') {
                        let sel_array_evng_arr = $("#km_booking_radio_select option[value='halfDayEvng']").attr('data-waitlist-days-evening');
                        arr = JSON.parse(sel_array_evng_arr);
                    } else if (selected_value == 'fullDay') {
                        arr = $("#km_booking_radio_select option[value='fullDay']").attr('data-waitlist-days');
                        arr = JSON.parse(arr);
                    }
                    if (sel_array != '') {
                        addToCartDates = dateList.filter(function(date) {
                            return arr.indexOf(date) === -1;
                        });
                        if ($isKmUser) {
                            allDates = [...new Set([...addToCartDates, ...arr])];
                        } else {
                            allDates = addToCartDates;
                        }
                        BookingAtcObject.dates = allDates;
                        BookingAtcObject.atc = addToCartDates;
                        BookingAtcObject.atw = arr;
                    } else {
                        if ($isKmUser && arr && arr.length > 0) {
                            BookingAtcObject.dates = arr;
                            BookingAtcObject.atc = addToCartDates;
                            BookingAtcObject.atw = arr;
                        } else {
                            console.log("No Dates Found");
                            disablecal = true;
                            BookingAtcObject.dates = false;
                            BookingAtcObject.atc = false;
                            BookingAtcObject.atw = false;
                        }
                    }
                }
                if (BookingAtcObject.dates && BookingAtcObject.dates.length > 0) {
                    if (type == 'reset') {
                        addDisabledDates = '';
                    } else if (type == 'atw') {
                        addDisabledDates = BookingAtcObject.atc;
                    } else if (type == 'atc') {
                        addDisabledDates = BookingAtcObject.atw;
                    }
                    //let sortedAllDates = BookingAtcObject.dates.sort((a, b) => a.localeCompare(b));
                    let sortedAllDates = BookingAtcObject.dates.sort((a, b) => {
                        let partsA = a.split('-');
                        let partsB = b.split('-');
                        
                        let dateA = new Date(parseInt(partsA[2]), parseInt(partsA[0]) - 1, parseInt(partsA[1]));
                        let dateB = new Date(parseInt(partsB[2]), parseInt(partsB[0]) - 1, parseInt(partsB[1]));
                    
                        return dateA - dateB;
                    });

                    BookingAtcObject.minDate = new Date(sortedAllDates[0]);
                    BookingAtcObject.maxDate = new Date(sortedAllDates[sortedAllDates.length - 1]);
                    BookingAtcObject.addDisabledDates = addDisabledDates;
                    BookingAtcObject.addDates = sel_arr;
                    BookingAtcObject.disabled = disablecal;
                    return BookingAtcObject;
                } else {
                    console.log("No Dates Available");
                    return false;
                }
            } catch (err) {
                console.log(err);
                return false;
            }
        },
        /**
         * 
         * @param {*} dateFrom start date of event
         * @param {*} dateTo end date of event
         * @param {*} type reset,atc,atw
         */
        BookingAtcWaitlistReinitialize: function(dateFrom, dateTo, type = 'reset') {
            try {
                var typeOfRequest;
                var BookingAtcObject = {};
                let addDisabledDates = new Array();
                let disablecal = '';
                // let startDate = moment(dateFrom);
                // let endDate = moment(dateTo);
                let arr = new Array();
                let allDates = new Array();
                let futureDates = new Array();
                let sel_arr = '';
                let addToCartDates = new Array();
                var allDatesObjectToGetDate = JSON.parse($("#km_booking_radio_select").find('option:selected').attr('data-oneday-times-all-dates'));
                startDate = moment(Object.values(allDatesObjectToGetDate)[0]);
                endDate = moment(Object.values(allDatesObjectToGetDate)[Object.values(allDatesObjectToGetDate).length - 1]);
                //let dateList = $this.getDaysBetweenDates(startDate, endDate);
                let dateList = [];
                //let dateList = $this.getDaysBetweenDates(startDate, endDate);
                if (allDatesObjectToGetDate !== null && typeof allDatesObjectToGetDate === 'object') {
                    dateList = Object.keys(allDatesObjectToGetDate);
                }
                /*
                 $.each(dateList, function(index, value) { 
                         let date = new Date();
                         let valdate = new Date(value);
                         let newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                         if(valdate < date){
                             arr.push(newDate);
                         }           
                 });
                 */
                var textare_value = $('#DatesLabel').val();
                if (textare_value != '') {
                    let selected_dates = JSON.parse($('#DatesLabel').val());
                    if (selected_dates != '') {
                        let sel_arr = new Array();
                        $.each(selected_dates, function(index, value) {
                            var valdate = new Date(value);
                            var newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                            sel_arr.push(newDate);
                        });
                    }
                }
                let selected_value = $('#km_booking_radio_select').val();
                if (selected_value != 'fullcamp' && selected_value != '') {
                    var sel_array = $("#km_booking_radio_select").find('option:selected').attr('data-oneday-dates');
                    sel_array = JSON.parse(sel_array);
                    if (selected_value == 'halfDayMrng') {
                        let sel_mrnng_arr = $("#km_booking_radio_select option[value='halfDayMrng']").attr('data-waitlist-days-morning');
                        arr = JSON.parse(sel_mrnng_arr);
                    } else if (selected_value == 'halfDayEvng') {
                        let sel_array_evng_arr = $("#km_booking_radio_select option[value='halfDayEvng']").attr('data-waitlist-days-evening');
                        arr = JSON.parse(sel_array_evng_arr);
                    } else if (selected_value == 'fullDay') {
                        arr = $("#km_booking_radio_select option[value='fullDay']").attr('data-waitlist-days');
                        arr = JSON.parse(arr);
                    }
                    if (sel_array != '') {
                        addToCartDates = dateList.filter(function(date) {
                            return arr.indexOf(date) === -1;
                        });
                        if ($isKmUser) {
                            allDates = [...new Set([...addToCartDates, ...arr])];
                        } else {
                            allDates = addToCartDates;
                        }
                        BookingAtcObject.dates = allDates;
                        BookingAtcObject.atc = addToCartDates;
                        BookingAtcObject.atw = arr;
                    } else {
                        if ($isKmUser && arr && arr.length > 0) {
                            BookingAtcObject.dates = arr;
                            BookingAtcObject.atc = addToCartDates;
                            BookingAtcObject.atw = arr;
                        } else {
                            console.log("No Dates Found");
                            disablecal = true;
                            BookingAtcObject.dates = false;
                            BookingAtcObject.atc = false;
                            BookingAtcObject.atw = false;
                        }
                    }
                }
                if (BookingAtcObject.dates && BookingAtcObject.dates.length > 0) {
                    if (type == 'reset') {
                        addDisabledDates = '';
                    } else if (type == 'atw') {
                        addDisabledDates = BookingAtcObject.atc;
                    } else if (type == 'atc') {
                        addDisabledDates = BookingAtcObject.atw;
                    }
                    let sortedAllDates = BookingAtcObject.dates.sort((a, b) => a.localeCompare(b));
                    BookingAtcObject.minDate = new Date(sortedAllDates[0]);
                    BookingAtcObject.maxDate = new Date(sortedAllDates[sortedAllDates.length - 1]);
                    BookingAtcObject.addDisabledDates = addDisabledDates;
                    BookingAtcObject.addDates = sel_arr;
                    BookingAtcObject.disabled = disablecal;
                    $('.km_calander_div').multiDatesPicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: new Date(BookingAtcObject.dates[0]),
                        maxDate: new Date(BookingAtcObject.dates[BookingAtcObject.dates.length - 1]),
                        addDisabledDates: addDisabledDates,
                        addDates: sel_arr,
                        disabled: disablecal,
                        onSelect: function() {
                            var dates_json = $(this).multiDatesPicker("getDates");
                            var dates_count = dates_json.length;
                            var count_text = '';
                            //hide show parsely for datepicker
                            if (dates_count > 0) {
                                let DatesLabelElement = document.getElementById("DatesLabel");
                                if (DatesLabelElement) {
                                    var parsely_field = jQuery('#DatesLabel').parent().find('.parsley-required');
                                    parsely_field.hide();
                                }
                                var textarea_value = JSON.stringify($(this).multiDatesPicker("getDates"));
                                $("#DatesLabel").val(textarea_value);
                            } else {
                                let DatesLabelElement = document.getElementById("DatesLabel");
                                if (DatesLabelElement) {
                                    var parsely_field = jQuery('#DatesLabel').parent().find('.parsley-required');
                                    parsely_field.show();
                                }
                                var textarea_value = '';
                                $("#DatesLabel").val('');
                            }
                            //hide show parsely for datepicker
                            $('.km_onedayavail').html('');
                            /*Show Avail Seats for Selected Date*/
                            var oneday_avails = $("#km_booking_radio_select").find('option:selected').attr('data-oneday-avail');
                            var oneday_availsnew = JSON.parse(oneday_avails);
                            var availCount = new Array();
                            if (textarea_value && textarea_value != '') {
                                var selected_dates = JSON.parse($('#DatesLabel').val());
                                if ($(this).multiDatesPicker("getDates").length == 1) {
                                    if (arr.includes(selected_dates[0])) {
                                        typeOfRequest = 'atw';
                                        reinitializeCalendarType = 'atw';
                                        fieldday.BookingAtcWaitlistReinitialize(dateFrom, dateTo, typeOfRequest);
                                        fieldday.CalanderAtcDestroySetButtons('atw');
                                    } else {
                                        typeOfRequest = 'atc';
                                        reinitializeCalendarType = 'atc';
                                        fieldday.BookingAtcWaitlistReinitialize(dateFrom, dateTo, typeOfRequest);
                                        fieldday.CalanderAtcDestroySetButtons('atc');
                                    }
                                } else if ($(this).multiDatesPicker("getDates").length == 0) {
                                    typeOfRequest = 'reset';
                                    reinitializeCalendarType = 'reset';
                                    jQuery('.km_calander_div').multiDatesPicker('resetDates', 'picked');
                                    fieldday.BookingCalanderForAtcDestroy(BookingAtcObject.dates[0], BookingAtcObject.dates[BookingAtcObject.dates.length - 1]);
                                    fieldday.CalanderAtcDestroySetButtons('default');
                                } else {
                                    if (arr.includes(selected_dates[0])) {
                                        typeOfRequest = 'atw';
                                        reinitializeCalendarType = 'atw';
                                    } else {
                                        typeOfRequest = 'atc';
                                        fieldday.CalanderAtcDestroySetButtons('atc');
                                    }
                                    fieldday.BookingAtcWaitlistReinitialize(dateFrom, dateTo, typeOfRequest);
                                }
                                if (selected_dates != '') {
                                    $.each(selected_dates, function(i, item) {
                                        var valuess = (oneday_availsnew[selected_dates[i]] !== undefined) ? oneday_availsnew[selected_dates[i]] : 0;
                                        $('.km_onedayavail').append('<div class="km_selected_opt"><span class="km_avail_label">Date: </span><span class="km_avail_content  km_avail_content_dateOnly">' + selected_dates[i] + '</span><span class="km_avail_label">Available Seats: </span><span class="km_avail_content">' + valuess + '&nbsp;&nbsp;<i class="fa fa-trash km_primary_color km_multidatepicker_date_trashIcon" aria-hidden="true"></i></span></div>');
                                        availCount.push(valuess);
                                    });
                                }
                                var minavailCount = Math.min.apply(Math, availCount);
                                $('.km_allowed_seats').attr('id', minavailCount);
                            } else {
                                jQuery('.km_calander_div').multiDatesPicker('resetDates', 'picked');
                                fieldday.BookingCalanderForAtcDestroy(BookingAtcObject.dates[0], BookingAtcObject.dates[BookingAtcObject.dates.length - 1]);
                            }
                            $this.Extradata();
                            if (dates_count > 0) {
                                if (dates_count == 1) {
                                    var count_text = "date selected";
                                } else {
                                    var count_text = "dates selected";
                                }
                                $('.km_dates_count').html('(<span>' + dates_count + '</span> ' + count_text + ')');
                            } else {
                                $('.km_dates_count').html('');
                            }
                        },
                    });
                    var element = $(".km_cal_close").detach();
                    $('.km_calander_div').append(element);
                    $('.km_cal_close').click(function() {
                        $(this).parents('.km_calender').addClass('km_hidden');
                    });
                    //reinitialize the calendar end
                } else {
                    console.log("No dates Available");
                }
            } catch (err) {
                console.log(err);
            }
        },
        BookingCalanderForAtcDestroy: function(minDate, maxDate) {
            var allDatesObjectToGetDate = JSON.parse($("#km_booking_radio_select").find('option:selected').attr('data-oneday-times-all-dates'));
            if (allDatesObjectToGetDate[minDate] !== undefined) {
                minDate = allDatesObjectToGetDate[minDate];
            }
            if (allDatesObjectToGetDate[maxDate] !== undefined) {
                maxDate = allDatesObjectToGetDate[maxDate];
            }
            let objectOfData = fieldday.BookingAtcWaitlistReinitializeObject(minDate, maxDate);
            let arr = objectOfData.atw;
            jQuery('.km_calander_div').multiDatesPicker('destroy').multiDatesPicker({
                dateFormat: 'mm-dd-yy',
                minDate: new Date(minDate),
                maxDate: new Date(maxDate),
                onSelect: function(dateText, inst) {
                    var dates_json = $(this).multiDatesPicker("getDates");
                    var dates_count = dates_json.length;
                    var count_text = '';
                    //hide show parsely for datepicker
                    if (dates_count > 0) {
                        let DatesLabelElement = document.getElementById("DatesLabel");
                        if (DatesLabelElement) {
                            var parsely_field = jQuery('#DatesLabel').parent().find('.parsley-required');
                            parsely_field.hide();
                        }
                        var textarea_value = JSON.stringify($(this).multiDatesPicker("getDates"));
                        $("#DatesLabel").val(textarea_value);
                    } else {
                        let DatesLabelElement = document.getElementById("DatesLabel");
                        if (DatesLabelElement) {
                            var parsely_field = jQuery('#DatesLabel').parent().find('.parsley-required');
                            parsely_field.show();
                        }
                        var textarea_value = '';
                        $("#DatesLabel").val('');
                        fieldday.CalanderAtcDestroySetButtons('default');
                    }
                    $('.km_onedayavail').html('');
                    /*Show Avail Seats for Selected Date*/
                    //var oneday_avails = $("input[name='ATC[bookingoption_selection]']:checked").attr('data-oneday-avail');
                    var oneday_avails = $("#km_booking_radio_select").find('option:selected').attr('data-oneday-avail');
                    var oneday_availsnew = JSON.parse(oneday_avails);
                    var availCount = new Array();
                    if (textarea_value && textarea_value != '') {
                        var selected_dates = JSON.parse($('#DatesLabel').val());
                        if (selected_dates != '') {
                            $.each(selected_dates, function(i, item) {
                                var valuess = oneday_availsnew[selected_dates[i]];
                                $('.km_onedayavail').append('<div class="km_selected_opt"><span class="km_avail_label">Date: </span><span class="km_avail_content km_avail_content_dateOnly">' + selected_dates[i] + '</span><span class="km_avail_label">Available Seats: </span><span class="km_avail_content">' + valuess + '&nbsp;&nbsp;<i class="fa fa-trash km_primary_color  km_multidatepicker_date_trashIcon" aria-hidden="true"></i></span></div>');
                                availCount.push(valuess);
                            });
                        }
                        var minavailCount = Math.min.apply(Math, availCount);
                        //$('.km_allowed_seats').val(minavailCount);
                        $('.km_allowed_seats').attr('id', minavailCount);
                    }
                    let date = $(this).val();
                    if (arr && arr.length > 0 && arr.includes(date)) {
                        typeOfRequest = 'atw';
                        fieldday.BookingAtcWaitlistReinitialize(minDate, maxDate, typeOfRequest);
                        fieldday.CalanderAtcDestroySetButtons('atw');
                    } else {
                        typeOfRequest = 'atc';
                        fieldday.BookingAtcWaitlistReinitialize(minDate, maxDate, typeOfRequest);
                        fieldday.CalanderAtcDestroySetButtons('atc');
                    }
                    $this.Extradata();
                    if (dates_count > 0) {
                        if (dates_count == 1) {
                            var count_text = "date selected";
                        } else {
                            var count_text = "dates selected";
                        }
                        $('.km_dates_count').html('(<span>' + dates_count + '</span> ' + count_text + ')');
                    } else {
                        $('.km_dates_count').html('');
                    }
                }
            });
        },
        CalanderAtcDestroySetButtons: function(type = 'default') {
            let originalStatus = $("#KmSessionBookingStatus").val();
            if (type == 'atc') {
                if (!$("#km_session_add_to_cart_pc").hasClass('km_add_to_cart')) {
                    $("#km_session_add_to_cart_pc").addClass('km_add_to_cart');
                }
                if ($("#km_session_add_to_cart_pc").hasClass('km_add_to_waitlist')) {
                    $("#km_session_add_to_cart_pc").removeClass('km_add_to_waitlist');
                }
                $("#km_session_add_to_cart_pc").text('Add To Cart');
                $('#DatesTimeLabel').val($('#DatesTimeLabel').val());
                if ($isKmUser) {
                    $(".km_new_checkout_btn_add_to_cart_form").show();
                }
            } else if (type == 'atw' && $isKmUser) {
                if ($("#km_session_add_to_cart_pc").hasClass("km_add_to_cart")) {
                    $("#km_session_add_to_cart_pc").removeClass('km_add_to_cart');
                }
                if (!$("#km_session_add_to_cart_pc").hasClass("km_add_to_waitlist")) {
                    $("#km_session_add_to_cart_pc").addClass('km_add_to_waitlist');
                }
                $("#km_session_add_to_cart_pc").text('Add To Waitlist');
                if ($isKmUser) {
                    $(".km_new_checkout_btn_add_to_cart_form").hide();
                }
                $('#DatesTimeLabel').val($('#DatesTimeLabelAllDates').val());
            } else {
                if (originalStatus == 'open') {
                    if (!$("#km_session_add_to_cart_pc").hasClass('km_add_to_cart')) {
                        $("#km_session_add_to_cart_pc").addClass('km_add_to_cart');
                    }
                    if ($("#km_session_add_to_cart_pc").hasClass('km_add_to_waitlist')) {
                        $("#km_session_add_to_cart_pc").removeClass('km_add_to_waitlist');
                    }
                    $("#km_session_add_to_cart_pc").text('Add To Cart');
                    $('#DatesTimeLabel').val($('#DatesTimeLabel').val());
                    if ($isKmUser) {
                        $(".km_new_checkout_btn_add_to_cart_form").show();
                    }
                } else if (originalStatus == 'waitlist' && $isKmUser) {
                    if ($("#km_session_add_to_cart_pc").hasClass("km_add_to_cart")) {
                        $("#km_session_add_to_cart_pc").removeClass('km_add_to_cart');
                    }
                    if (!$("#km_session_add_to_cart_pc").hasClass("km_add_to_waitlist")) {
                        $("#km_session_add_to_cart_pc").addClass('km_add_to_waitlist');
                    }
                    $("#km_session_add_to_cart_pc").text('Add To Waitlist');
                    $('#DatesTimeLabel').val($('#DatesTimeLabelAllDates').val());
                    if ($isKmUser) {
                        $(".km_new_checkout_btn_add_to_cart_form").hide();
                    }
                } else {
                    if (!$("#km_session_add_to_cart_pc").hasClass('km_add_to_cart')) {
                        $("#km_session_add_to_cart_pc").addClass('km_add_to_cart');
                    }
                    if ($("#km_session_add_to_cart_pc").hasClass('km_add_to_waitlist')) {
                        $("#km_session_add_to_cart_pc").removeClass('km_add_to_waitlist');
                    }
                    $("#km_session_add_to_cart_pc").text('Add To Cart');
                    $('#DatesTimeLabel').val($('#DatesTimeLabel').val());
                    if ($isKmUser) {
                        $(".km_new_checkout_btn_add_to_cart_form").show();
                    }
                }
            }
        },
        MultiWeekBookingCalander: function() {
            $(".km_multiweek_calander").on('click', function() {
                $(this).next('.km_calender').toggleClass('km_hidden');
                var dateFrom = $(this).data('date-from');
                var dateTo = $(this).data('date-to');
                var weekdays = $(this).data('weekdays');
                var midweekbooking = $(this).data('midweekbooking');
                var excludedates = $(this).data('excluded-dates');
                var startDate = moment(dateFrom);
                var endDate = moment(dateTo);
                var arr = new Array();
                var dateList = $this.getDaysBetweenDates(startDate, endDate);
                //console.log(dateList);
                $.each(dateList, function(index, value) {
                    var date = new Date();
                    var current_date = jQuery.datepicker.formatDate('mm-dd-yy', date);
                    var valdate = new Date(value);
                    var newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                    if (valdate < date) {
                        arr.push(newDate);
                    }
                    if (midweekbooking !== 1) { // booking is not allowed in the middle week
                        var startOfWeek = moment().startOf('week').toDate();
                        var endOfWeek = moment().endOf('week').toDate();
                        var dateList = $this.getDaysBetweenDates(moment(startOfWeek), moment(endOfWeek));
                        $.each(dateList, function(index, value) {
                            var date = new Date();
                            var current_date = jQuery.datepicker.formatDate('mm-dd-yy', date);
                            var valdate = new Date(value);
                            var newDate = jQuery.datepicker.formatDate('mm-dd-yy', valdate);
                            if (valdate < date) {} else {
                                arr.push(newDate);
                            }
                        });
                    }
                    if (excludedates != '') {
                        //var sel_arr = new Array();
                        $.each(excludedates, function(index, value) {
                            var valexdate = new Date(value);
                            var exDate = jQuery.datepicker.formatDate('mm-dd-yy', valexdate);
                            arr.push(exDate);
                        });
                    }
                });
                if (arr.length === 0) {
                    var arr = '';
                }
                $('.km_multiweek_calander_div').datepicker({
                    format: 'mm-dd-yy',
                    minDate: new Date(dateFrom),
                    maxDate: new Date(dateTo),
                    beforeShowDay: function(date) {
                        var string = jQuery.datepicker.formatDate('mm-dd-yy', date);
                        var day = date.getDay();
                        var weekdaysJson = JSON.stringify(weekdays);
                        if (arr.indexOf(string) === -1) { // not matched
                            //return [true, "someothercssclass"]
                            if (weekdaysJson.indexOf(day) === -1) {
                                return [false, "somecssclass"]
                            } else {
                                return [true, "someothercssclass"]
                            }
                        } else {
                            return [false, "somecssclass"];
                        }
                    },
                    onSelect: function(dateStr) {
                        var date = $(this).datepicker('getDate');
                        var string = jQuery.datepicker.formatDate('mm-dd-yy', date);
                        var string_val = jQuery.datepicker.formatDate('d-M-yy', date);
                        $("#StartingDate").val(string);
                        var dates_count = 1;
                        var count_text = '';
                        if ($('#StartingDate').val()) {
                            var count_text = "Selected";
                            $('.kmdaterequired').text('');
                            $('.km_dates_count').html('(<span>' + string_val + '</span> ' + count_text + ')');
                        } else {
                            $('.km_dates_count').html('');
                        }
                        //$('.km_joiningdate .km_date_value').html('<b>'+string_val+'</b>');
                        //$('.km_joiningdate').show();
                        $this.MultiweekExtradata();
                    },
                });
                var element = $(".km_cal_close").detach();
                $('.km_multiweek_calander_div').append(element);
                $('.km_cal_close').click(function() {
                    $(this).parents('.km_calender').addClass('km_hidden');
                });
            });
        },
        ModalCalander: function() {
            $(".km_datepicker").on('click', function() {
                let header = $(this).data('modal-heading');
                var dateFrom = $(this).data('date-from');
                var dateTo = $(this).data('date-to');
                $this.displayModal({
                    header: header,
                    content: "<div class='km_calander_div'></div>",
                    footer: ""
                });
                var startDate = moment(dateFrom);
                var endDate = moment(dateTo);
                var dateList = $this.getDaysBetweenDates(startDate, endDate);
                $('.km_calander_div').datepicker({
                    format: 'mm-dd-yyyy',
                    minDate: new Date(dateFrom),
                    maxDate: new Date(dateTo),
                    beforeShowDay: function(date) {
                        var year = date.getFullYear(),
                            month = date.getMonth(),
                            day = date.getDate();
                        // see if the current date should be highlighted
                        for (var i = 0; i < dateList.length; ++i) {
                            let date = new Date(dateList[i]);
                            //console.log(date.getFullYear());
                            if (year == date.getFullYear() && month == date.getMonth() - 1 && day == date.getDate()) {
                                return [true, 'ui-state-highlight ui-state-active'];
                            }
                        }
                        return [false];
                    }
                });
            });
        },
        Extradata: function() {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_sessions_extradata", formData, function(response) {
                if (response.status == 'success') {
                    if (response.data != '') {
                        $('.km_input_extraoptions').html(response.data);
                        $('.km_input_extraoptions').show();
                    } else {
                        $('.km_input_extraoptions').hide();
                    }
                    if (response.additionaldata != '') {
                        $('.km_extra_additional').html(response.additionaldata);
                        $('.km_extra_additional').show();
                    } else {
                        $('.km_extra_additional').hide();
                    }
                }
            });
        },
        MultiweekExtradata: function() {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_multiweek_calculations", formData, function(response) {
                console.log(response);
                if (response.status == 'success') {
                    var date = moment(response.data.nextPaymentOn); //Get the current date
                    var nextPaymentOn = date.format("MMM Do, YYYY"); //2014-07-10
                    $('.km_due_today .km_date_value').text('$' + response.data.totalAmount);
                    var tamount = "$" + response.data.payableAmount;
                    if (response.data.totalAmount != response.data.payableAmount) {
                        var tamount = "<strike>$" + response.data.totalAmount + "</strike>" + "$" + response.data.payableAmount;
                    }
                    $('.km_total_due .km_date_value').html(tamount);
                    $('.km_next_payment .km_date_value').text(nextPaymentOn);
                    $('.km_weeks_remaining .km_date_title').text(response.data.remainingWeeks + ' Weeks Remaining');
                    $('.km_weeks_remaining .km_date_value').text(response.data.session.paymentFrequency + ' - $' + response.data.nextPaymentAmount + '/seat');
                    $('.km_due').removeClass('km_hidden');
                    var bookingdate = moment(response.data.nextBookingDate); //Get the current date
                    var nextBookingOn = bookingdate.format("MMM Do, YYYY"); //2014-07-10
                    $('.km_joiningdate .km_date_value').html('<b>' + nextBookingOn + '</b>');
                    $('.km_joiningdate').show();
                    if (response.data.autoRenewalRequired != '') {
                        $('.km_renewal').removeClass('km_hidden');
                    }
                    //console.log('Hiiii Im here'+response.data.autoRenewalRequired);
                    if (response.data.payableAmount) {
                        $('.paymentMethod').val('card');
                    } else {
                        $('.paymentMethod').val('free');
                    }
                }
            });
        },
        triggerModal: function() {
            $('.km_modal_link').on('click', function(e) {
                e.preventDefault();
                let modelTitle = $(this).data('title');
                let modeldescription = $(this).data('description');
                $this.displayModal({
                    header: modelTitle,
                    content: "<div class='km_wrapped_content'>" + modeldescription + "</div>"
                }, 'km_modal_small km_custom_trigger_popup');
            });
        },
        kmTooltip: function() {
            $(".km_session_location").mouseenter(function() {
                $(this).next('.km_sessions_description').show();
            });
            $(".km_session_location").mouseleave(function() {
                $(this).next('.km_sessions_description').hide();
            });
            $(document).on("mouseenter", ".km_tooltip", function() {
                var text = $(this).data('tooltip-title');
                $(this).append('<i>' + text + '</i>');
            });
            $(document).on("mouseleave", ".km_tooltip", function() {
                $('.km_tooltip i').remove();
            });
        },
        handleQueryParam: function() {
            $state = $this.GetQueryString('state');
            if ($state) {
                $code = $this.GetQueryString('code');
                var statevar = $state.split('_');
                var uri = window.location.href.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
                if (statevar[0] == 'facebook') {
                    $this.LoginWithFacebook();
                } else if (statevar[0] == 'google') {
                    $this.LoginWithGoogle();
                }
            }
            let $sessionId = $this.GetQueryString('sessionId');
            let $kmType = $this.GetQueryString('type');
            if ($kmType && $sessionId) {
                if ($kmType == 'event') {
                    if (!$isKmUser) {
                        $this.showAuthPopupNew($sessionId);
                    } else {
                        $this.registerEvent($sessionId, 'event');
                    }
                } else if ($kmType == 'session') {
                    if (!$isKmUser) {
                        $this.showAuthPopupNew($sessionId);
                    } else {
                        $this.registerSession($sessionId, '', '', '');
                    }
                } else {
                    $this.viewSessionDetail($sessionId, 'general');
                }
            } else if ($sessionId) {
                $this.viewSessionDetail($sessionId, 'general');
            }
            $("#km_modal .km_cart_button_p.km_detail_bookbtn a").click();
            let $session = $this.GetQueryString('session');
            if ($session) {
                document.cookie = "sessionclicked=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                $('a[data-click="' + $session + '"]').click();
            }
        },
        fielddaySelect: function() {
            $(".fieldday_select").select2();
        },
        fielddaySelectDestroy: function() {
            $(".fieldday_select").select2('destroy');
        },
        requiredfields: function() {
            $("input[required]:not(.optional), select[required]:not(.optional), textarea[required]:not(.optional)").each(function() {
                $(this).parents('.km_field_wrap').addClass('required_field');
            });
        },
        closepopup: function() {
            $(".fieldday_select").select2('destroy');
            $('#km_modal').hide();
            $("body").removeClass("body_km_open_true");
            $('#km_modal .km_modal_heading, #km_modal .km_modal_content, #km_modal .km_modal_footer').html('');
            let sessionId = $this.GetQueryString('sessionId');
            if (sessionId) {
                $this.removeQueryParam('sessionId');
            }
        },
        closeSecpopup: function() {
            $('#km_modal_sec').hide();
            $('#km_modal_sec .km_modal_heading, #km_modal_sec .km_modal_content, #km_modal_sec .km_modal_footer').html('');
            let sessionId = $this.GetQueryString('sessionId');
            if (sessionId) {
                $this.removeQueryParam('sessionId');
            }
        },
        closediscountpopup: function(element) {
            $(element).parents('.km_modal').hide();
        },
        showAuthPopup: function(button, event) {
            if ($isKmUser) {
                location.reload();
            }
            event.preventDefault();
            var isGuest = $(button).data('isguest');
            var formdata = {
                action: 'km_display_auth',
                'isGuest': isGuest
            };
            var sessionId = $(button).data('session-id');
            var Ispackage = $(button).data('ispackage');
            var session_type = $(button).data('type');
            var sessionfeatured = $(button).data('session-featured');
            var offerId = $(button).data('offer-id');
            var offername = $(button).data('offer-name');
            if (sessionId) {
                var tagId = $(button).data('tag-id');
                var sessionDate = $(button).data('session-date');
                formdata.session_id = sessionId;
                formdata.tagId = tagId;
                formdata.session_date = sessionDate;
                formdata.session_type = session_type;
                formdata.sessionfeatured = sessionfeatured;
                formdata.isGuest = isGuest;
                formdata.Ispackage = Ispackage;
                AtcsessionId = sessionId;
                AtcIspackage = Ispackage;
                AtcIsEvent = session_type;
                AtctagId = tagId;
                AtcsessionDate = sessionDate;
                AtcClickOpenSession = sessionId;
                $this.setCookie('sessionclicked', sessionId);
            }
            if (offerId) {
                formdata.offerId = offerId;
                formdata.offername = offername;
                AtcOfferId = offerId;
                AtcOffername = offername;
            }
            $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                $this.displayModal(response, 'modal-large km_auth_pop_up_modal_cls');
            });
        },
        showAuthPopupNew: function(sessionId) {
            var formdata = {
                action: 'km_display_auth'
            };
            AtcsessionId = sessionId;
            AtcClickOpenSession = sessionId;
            formdata.session_id = sessionId;
            $this.setCookie('sessionclicked', sessionId);
            $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                $this.displayModal(response, 'modal-large km_auth_pop_up_modal_cls');
            });
        },
        showLoginForm: function(button, event) {
            if ($isKmUser) {
                location.reload();
            }
            event.preventDefault();
            var sessionfeatured = $(button).data('session-featured');
            var sessionDate = $(button).data('session-date');
            var session_type = $(button).data('type');
            var isGuest = $(button).data('session-isguest');
            var formdata = {
                action: 'km_display_login',
                'sessionfeatured': sessionfeatured,
                'session_date': sessionDate,
                'session_type': session_type,
                'isGuest': isGuest,
            };
            var sessionId = $(button).data('session-id');
            var offerId = $(button).data('offer-id');
            var offername = $(button).data('offer-name');
            var sessionfeatured = $(button).data('session-featured');
            if (sessionId) {
                var tagId = $(button).data('tag-id');
                var sessionDate = $(button).data('session-date');
                formdata.session_id = sessionId;
                formdata.tagId = tagId;
                formdata.session_date = sessionDate;
                formdata.sessionfeatured = sessionfeatured;
                AtcsessionId = sessionId;
                AtctagId = tagId;
                AtcIsEvent = session_type;
                AtcsessionDate = sessionDate;
            }
            if (offerId) {
                formdata.offerId = offerId;
                formdata.offername = offername;
                AtcOfferId = offerId;
                AtcOffername = offername;
            }
            $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                $this.displayModal(response, 'modal-large');
                $('.km_modal_content .km_login_wrap').addClass('km_ajax_login');
                $('.km_signup_wrap:not(.km_ajax_signup_wrap)').hide();
                $('.km_ajax_signup_wrap').removeClass('km_hidden');
                widgetId = grecaptcha.render("g-recaptcha", {
                    sitekey: fieldday_ajax.g_sitekey,
                });
            });
        },
        showRegisterForm: function(button, event) {
            var formdata = {
                action: 'km_display_register'
            };
            var sessionId = $(button).data('session-id');
            var offerId = $(button).data('offer-id');
            var offername = $(button).data('offer-name');
            var sessionfeatured = $(button).data('session-featured');
            if (sessionId) {
                var tagId = $(button).data('tag-id');
                var sessionDate = $(button).data('session-date');
                formdata.session_id = sessionId;
                formdata.tagId = tagId;
                formdata.session_date = sessionDate;
                formdata.session_date = sessionfeatured;
                AtcsessionId = sessionId;
                AtctagId = tagId;
                AtcsessionDate = sessionDate;
            }
            if (offerId) {
                formdata.offerId = offerId;
                formdata.offername = offername;
                AtcOfferId = offerId;
                AtcOffername = offername;
            }
            $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                $this.displayModal(response, 'modal-large modal-register-popup');
                $('.km_modal_content .km_register_wrap').addClass('km_ajax_register');
                $('.km_signup_wrap:not(.km_ajax_signup_wrap)').hide();
                $('.km_ajax_signup_wrap').removeClass('km_hidden');
                $this.PhoneInput();
                widgetId = grecaptcha.render("g-recaptcha", {
                    sitekey: fieldday_ajax.g_sitekey,
                });
            });
        },
        showForgetPassword: function() {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_forget_popup'
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-normal');
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        forgetPassword: function(button, event) {
            event.preventDefault();
            $('#km_forget_password').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: 'forgetPassword'
            }).done(function() {
                var formData = new FormData($('#km_forget_password')[0]);
                //formData.set('action', 'km_reset_password');
                $(button).prop('disabled', true);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_reset_password", formData, function(response) {
                    if (response.status == 'success') {
                        $('#km_forget_password')[0].reset();
                        $this.DisplayMessage(button, 'success', response.message);
                    } else {
                        $this.DisplayMessage(button, 'error', response.message);
                    }
                    $(button).prop('disabled', false);
                });
            });
        },
        inputincrement: function() {
            $('.minus:not(.disabled)').click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 0 ? 0 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus:not(.disabled)').click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        },
        checkoutpageevents: function() {
            $('.km_enable_cardoption').on('change', function() {
                $this.CardInput();
                $this.paymentrequired = true;
                $('.km_payment_wrap').removeClass('km_hidden');
                $('.km_payment_option:not(".km_enable_cardoption")').prop('checked', false);
                if (!$('#_stripeToken').length) {
                    $('.km_purchase_form').prepend("<input type='hidden' name='stripeToken' value='' id='_stripeToken'>");
                }
                $('.km_payment_wrap').find('input:not(.optional), textarea:not(.optional), select:not(.optional)').attr('required', true);
            });
            $('.km_payment_option:not(".km_enable_cardoption")').on('change', function() {
                $this.paymentrequired = false;
                $('.km_enable_cardoption').prop('checked', false);
                $('.km_payment_wrap').addClass('km_hidden');
                $('#_stripeToken').remove();
                $('.km_payment_wrap').find('input, textarea, select').removeAttr('required');
            });
            $(document).on('click', '.km_provider_terms_display', function(e) {
                e.preventDefault();
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_getprovider_terms'
                }, function(response) {
                    if (response.status == 'success') {
                        $this.displaySecondModal(response, 'modal-small');
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            $(document).on('change', '.km_provider_terms', function() {
                if ($(this).is(":checked")) {
                    $(".km_accepted_terms").prop('checked', true);
                } else {
                    $(".km_accepted_terms").prop('checked', false);
                }
            });
            $(document).on('click', '.open_km_modal', function() {
                var modalId = $(this).data('target');
                var kidId = $(this).data('kid-id');
                $(modalId).find('input, select, textarea').each(function() {
                    $(this).attr('data-kid-id', kidId);
                });
                $(modalId).fadeIn();
            });
            $(document).on('click change blur keyup', '.km_kids_form_modal input, .km_kids_form_modal select, .km_kids_form_modal textarea', function() {
                var kidId = $(this).data('kid-id');
                $("#update_kid_info_" + kidId).val('true');
            });
            $(document).on('click', '.km_popup_close', function(e) {
                e.preventDefault();
                var modalId = $(this).data('popup-id');
                $(modalId).fadeOut();
            });
            $(document).on('click', '.save_medical_forms', function(e) {
                e.preventDefault();
                var formvalid = false;
                var formtype = $(this).data('form-type');
                var kidId = $(this).data('kid-id');
                var wraperId = formtype + '_' + kidId;
                /* forms with input fields */
                if (formtype == 'kidsDoctors' || formtype == 'kidsMedicalInsurances' || formtype == 'kidsDentalInsurances') {
                    $('#km_purchase_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                        group: wraperId
                    }).done(function() {
                        formvalid = true;
                    });
                } else if (formtype == 'kidsHealthConcerns' || formtype == 'kidsMedicationAllergies' || formtype == 'kidsEnvironmentAllergies' || formtype == 'kidsSymptoms' || formtype == 'kidsTreatments' || formtype == 'kidsDietRestricts' || formtype == 'kidsFoodAllergies') {
                    var totalcheckbox = $('#' + wraperId).find('input[type="checkbox"]').length;
                    var checkedcheckbox = $('#' + wraperId).find('input[type="checkbox"]:checked').length;
                    if (totalcheckbox > checkedcheckbox && checkedcheckbox > 0) {
                        formvalid = true;
                    }
                }
                if (formvalid) {
                    /*
                    $(this).parents('.km_modal').fadeOut();
                    $(this).parents('.km_modal').find('.med_form_error').hide();
                    var targetlen = $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').length;
                    $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').removeClass('Form_Error').addClass('Form_Success km_primary_border');
                    */
                    let error = $(this).parents('.km_modal').find('.km_modal_footer .med_form_error');
                    error.remove();
                    $(this).parents('.km_modal').fadeOut();
                    var targetlen = $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').length;
                    $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').removeClass('Form_Error').addClass('Form_Success km_primary_border');
                } else {
                    /*
                    $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').removeClass('Form_Success km_primary_border').addClass('Form_Error');
                    var errordiv = $(this).parents('.km_modal').find('.med_form_error');
                    var footerdiv = $(this).parents('.km_modal').find('.km_modal_footer');
                    $(errordiv).detach().appendTo(footerdiv);
                    errordiv.fadeIn();
                    setTimeout(function () {
                    }, 3000);
                    */
                    $('[data-target="#km_modal_' + formtype + '_' + kidId + '"]').removeClass('Form_Success km_primary_border').addClass('Form_Error');
                    $("#km_modal_" + wraperId + " .km_modal_footer .med_form_error").remove();
                    let errordiv = $(this).parents('.km_modal').find('.med_form_error');
                    $(this).parents('.km_modal').find('.med_form_error').css('display', 'none');
                    var footerdiv = $(this).parents('.km_modal').find('.km_modal_footer');
                    footerdiv.append(errordiv.clone());
                    errordiv.fadeOut();
                    setTimeout(function() {}, 3000);
                }
            });
            $(document).on('change', '.km_noform', function() {
                if ($(this).is(':checked')) {
                    $(this).parents('.km_modal_medfor_wrap').find('.km_hidden_noform_field').val(true);
                    $(this).parents('.km_medical_form_wrap').find('input[type="checkbox"]:not(.km_noform)').prop({
                        'checked': false,
                        'disabled': false
                    });
                    $(this).parents('.km_medical_form_wrap').find('.km_checkbox_wrap:not(.km_noform_wrap)').addClass('disabled');
                    $(this).parents('.km_medical_form_wrap').find('.related_checkbox_fields .km_input').val('');
                    $(this).parents('.km_medical_form_wrap').find('.related_checkbox_fields').addClass('km_hidden');
                    $(this).parents('.km_modal_medfor_wrap').find('.km_hidden_noform_field').val(true);
                    $(this).parents('.km_medical_form_wrap').find('.km_hidden_noform_field').val(true);
                } else {
                    $(this).parents('.km_modal_medfor_wrap').find('.km_hidden_noform_field').val(false);
                    $(this).parents('.km_medical_form_wrap').find('.km_hidden_noform_field').val(false);
                    $(this).parents('.km_medical_form_wrap').find('input[type="checkbox"]:not(.km_noform)').prop('disabled', false);
                    $(this).parents('.km_medical_form_wrap').find('.km_checkbox_wrap:not(.km_noform_wrap)').removeClass('disabled');
                }
            });
            $(document).on('change', '.kid-form-checkbox', function(e) {
                if ($(this).prop('checked') == true) {
                    $(this).parents('.km_medical_form_wrap').find('.km_noform').prop({
                        'checked': false,
                        'disabled': false
                    });
                    $(this).parents('.km_medical_form_wrap').find('.km_checkbox_wrap:not(.km_noform_wrap)').removeClass('disabled');
                    $(this).parents('.km_modal_medfor_wrap').find('.km_hidden_noform_field').val(false);
                    $(this).parents('.km_medical_form_wrap').find('.km_hidden_noform_field').val(false);
                } else {
                    $(this).parents('.km_modal_medfor_wrap').find('.km_hidden_noform_field').val(true);
                    $(this).parents('.km_medical_form_wrap').find('.km_hidden_noform_field').val(true);
                    $(this).parents('.km_medical_form_wrap').find('input[type="checkbox"]:not(.km_noform)').prop('disabled', false);
                    $(this).parents('.km_medical_form_wrap').find('.km_checkbox_wrap:not(.km_noform_wrap)').removeClass('disabled');
                }
            });
            $(document).on('change', '.km_enable_form', function() {
                if ($(this).is(':checked')) {
                    $(this).parents('.km_medical_form_wrap').find('.km_input:not(.optional)').prop({
                        'required': true,
                        'disabled': false
                    });
                } else {
                    $(this).parents('.km_medical_form_wrap').find('.km_input:not(.optional)').prop({
                        'required': false,
                        'disabled': true
                    }).val('');
                }
                $this.requiredfields();
            });
            $(document).on('click', '.apply_store_credit', function() {
                var CreditId = $(this).data('credit-id');
                $('#manualStoreCreditPaid, #storeCreditId, #applySiblingDiscount').remove();
                var manualcredit = $(".manual_store_credit_paid:checked").val();
                var manualCreditType = $(".manual_store_credit_paid:checked").data('credit-type');
                if (manualcredit && manualCreditType !== 'siblingDiscount') {
                    $('#km_purchase_form').prepend('<input type="hidden" name="manualStoreCreditPaid" id="manualStoreCreditPaid" value="' + manualcredit + '"/>');
                }
                if (CreditId && manualCreditType !== 'siblingDiscount') {
                    $('#km_purchase_form').prepend('<input type="hidden" name="storeCreditId" id="storeCreditId" value="' + CreditId + '"/>');
                }
                if (manualCreditType == 'siblingDiscount') {
                    $('#km_purchase_form').prepend('<input type="hidden" name="applySiblingDiscount" id="applySiblingDiscount" value="true"/>');
                }
                $this.UpdateCart();
                $this.closepopup();
                $this.NextStep();
            });
            $(document).on('click', '.decline_store_credit', function() {
                $('#manualStoreCreditPaid, #storeCreditId, #applySiblingDiscount').remove();
                $this.UpdateCart();
                $this.closepopup();
                $this.NextStep();
            });
        },
        kidspageevents: function() {
            $(document).on('click', '.km_add_kid_modal', function() {
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_add_new_kid'
                }, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-large modal_newkid');
                        $this.requiredfields();
                        $this.fielddaySelect();
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            $(document).on('click', '.km_update_insurance', function(event) {
                var btn = $(this);
                event.preventDefault();
                $('#parent_insurance_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'parent_insurance_form'
                }).done(function() {
                    var formData = new FormData($('#parent_insurance_form')[0]);
                    //formData.set('action', 'km_update_insurance');
                    btn.prop('disabled', true);
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_insurance", formData, function(response) {
                        if (response.status == 'success') {
                            $this.DisplayMessage(btn, 'success', response.message);
                        } else if (response.status == 'fail') {
                            $this.DisplayMessage(btn, 'error', response.message);
                        }
                        btn.prop('disabled', true);
                    });
                });
            });
            $(document).on('change', '.km_hasextra_form', function() {
                if ($(this).is(':checked')) {
                    $(this).parents('.km_field_wrap').find('.related_checkbox_fields').removeClass('km_hidden');
                } else {
                    $(this).parents('.km_field_wrap').find('.related_checkbox_fields').addClass('km_hidden');
                    $(this).parents('.km_field_wrap').find('.km_input').val("");
                }
            });
            $(document).on('click', '.km_add_kid_save', function(event) {
                event.preventDefault();
                $('#km_form_kid_add').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'new_kid_create'
                }).done(function() {
                    var isUpdated = $this.updateDate($('#km_form_kid_add'));
                    if (isUpdated) {
                        var formData = new FormData($('#km_form_kid_add')[0]);
                        //formData.set('action', 'km_save_kid');
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_save_kid", formData, function(response) {
                            if (response.status == 'success') {
                                $this.closepopup();
                                $this.DisplayAlert('success', response.message);
                                $('.km_single_kid_main').append(response.html)
                            } else if (response.status == 'fail') {
                                $this.DisplayAlert('error', response.message);
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.km_update_profile', function(event) {
                event.preventDefault();
                var btn = $(this);
                var id = btn.data('id');
                $('#km_kid_profile_update').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'update_kid'
                }).done(function() {
                    var isDobUpdated = $this.updateDate($('#km_kid_profile_update'));
                    if (isDobUpdated) {
                        var formData = new FormData($('#km_kid_profile_update')[0]);
                        //formData.set('action', 'km_update_kid_profile');
                        //formData.set('id', id);
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_kid_profile", formData, function(response) {
                            if (response.status == 'success') {
                                $this.DisplayMessage(btn, 'success', response.message);
                            } else if (response.status == 'fail') {
                                $this.DisplayMessage(btn, 'success', response.message);
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.km_delete_kid', function(event) {
                event.preventDefault();
                var isConfirmed = confirm(fieldday_ajax.delteConfirm);
                if (isConfirmed) {
                    var kidId = $(this).data('kid-num-id');
                    $this.makeCall(fieldday_ajax.ajax_url, {
                        action: 'km_delete_kid',
                        kidId: kidId
                    }, function(response) {
                        if (response.status == 'success') {
                            $("#km_parent_kid_" + kidId).remove();
                            $this.DisplayAlert('success', response.message);
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                }
            });
            $(document).on('click', '.km_save_kidform', function(event) {
                event.preventDefault();
                var btn = $(this);
                var form = jQuery(this).parents('form:first');
                form.parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'kids_forms_field'
                }).done(function() {
                    var formData = new FormData(form[0]);
                    //formData.set('action', 'km_save_kidforms');
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_save_kidforms", formData, function(response) {
                        if (response.status == 'success') {
                            $this.DisplayMessage(btn, 'success', response.message);
                        } else {
                            $this.DisplayMessage(btn, 'error', response.message);
                        }
                    });
                });
            });
        },
        calculateCartPrice: function() {},
        getParticipants: function(cartKey, sessionID) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_atc_partcipants',
                cartkey: cartKey,
                sessionID: sessionID
            }, function(response) {
                if (response.status == 'success') {
                    $('.km_atc_participants').html(response.content);
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        proceed_event_ticket_book_step_one: function() {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_events_price", formData, function(response) {
                if (response.status == 'success') {
                    $('.km_events_prices_section').html(response.data);
                    $('.km_event_ordersummary').html(response.summary);
                    $('.km_required_disclaimer').html('* Indicate Required Field <span class="km_scroll_indicate">(Scroll to see price details)</span>');
                    $('.km_event_continue').removeClass('km_hidden');
                } else {
                    $('.km_events_prices_section').html('');
                    $('.km_event_ordersummary').html('');
                    //$('.km_event_continue').addClass('km_hidden');  
                    if (!response.datablank) {
                        //$this.DisplayAlert('error', response.message);
                        $(".km_seats_error_message_event_tickets").text(response.message);
                    }
                }
            });
        },
        atc_cart_steps: function() {
            $(document).mouseup(function(e) {
                var container = $("#km_cart_items_wrap");
                // if the target of the click isn't the container nor a descendant of the container
                if (!$(e.target).parents('div').hasClass('km_cart_toggle') && !container.is(e.target) && container.has(e.target).length === 0) {
                    container.css({
                        right: '-370px'
                    });
                    jQuery('button.mobile_bttn').css({
                        display: 'block'
                    });
                }
            });
            $(document).on('click', '.km_edit_cart_item', function() {
                let cartkey = $(this).data('cart-key');
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_edit_cart_item',
                    cartkey: cartkey
                }, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-large km_addtocart_modal');
                        $('.km_modal_heading').hide();
                        //AtcsessionId = sessionId;
                        //AtctagId = tagId;
                        //AtcsessionDate = sessionDate;
                        $this.requiredfields();
                        $this.cartOnScroll();
                        $this.BookingSelection();
                        $this.BookingCalander();
                        $this.MultiWeekBookingCalander();
                        $this.fielddaySessionTime();
                        $('.km_profile_participants li.km_active_participant').addClass('km_primary_border km_primary_shadow');
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            jQuery(document).on('change', '.km_dob_wrap .km_date_day, .km_dob_wrap .km_date_month, .km_dob_wrap .km_date_year', function() {
                const parentForm = jQuery(this).closest('form');
                let parent_form_id = parentForm.attr('id');
                if (parentForm && parent_form_id != '') {
                    fieldday.updateDate(jQuery("#" + parent_form_id));
                }
            });
            $(document).on('change', '.km_eparticipants_type , .km_event_radio', function() {
                clearTimeout(kmIncrementTimer);
                let doTempIncrement = () => {
                    $this.proceed_event_ticket_book_step_one();
                }
                kmIncrementTimer = setTimeout(doTempIncrement, 200);
            });
            //increment decrement js new
            $(document).on('click', '.km_addmi_options_input-number-increment', function() {
                let $input = $(this).parents('.km_addmi_options_input-number-group').find('.km_addmi_options_input-number');
                let min = $input.attr("min");
                let max = $input.attr("max");
                let val = parseInt($input.val(), 10);
                if (val == '' || isNaN(val)) {
                    val = 0;
                }
                let newVal = val + 1;
                /*
                if (newVal > max || newVal < min) {
                    return false;
                }
                */
                if (newVal < min) {
                    return false;
                }
                $input.val(val + 1);
                $input.attr('value', $input.val());
                let doTempIncrement = () => {
                    $this.proceed_event_ticket_book_step_one();
                }
                clearTimeout(kmIncrementTimer);
                kmIncrementTimer = setTimeout(doTempIncrement, 200);
            });
            $(document).on('click', '.km_addmi_options_input-number-decrement', function() {
                let $input = $(this).parents('.km_addmi_options_input-number-group').find('.km_addmi_options_input-number');
                let min = $input.attr("min");
                let max = $input.attr("max");
                let val = parseInt($input.val(), 10);
                if (val == '' || isNaN(val)) {
                    val = 0;
                }
                let newVal = val - 1;
                /*
                if (newVal > max || newVal < min) {
                    return false;
                }
                */
                if (newVal < min) {
                    return false;
                }
                $input.val(val - 1);
                $input.attr('value', $input.val());
                let doTempIncrement = () => {
                    $this.proceed_event_ticket_book_step_one();
                }
                clearTimeout(kmIncrementTimer);
                kmIncrementTimer = setTimeout(doTempIncrement, 200);
            });
            $(document).on('input change copy', '.km_addmi_options_input-number', function() {
                let $input = $(this);
                let minValue = $input.prop('min');
                let maxValue = $input.prop('max');
                let currentValue = parseFloat($input.val()) || 0;
                if (currentValue == '' || isNaN(currentValue)) {
                    currentValue = 0;
                }
                /*
                if (currentValue < minValue) {
                    $input.val(minValue);
                } else if (currentValue > maxValue) {
                    $input.val(maxValue);
                }
                */
                if (currentValue < minValue) {
                    $input.val(minValue);
                }
                $input.val(function(index, value) {
                    return value.replace(/[^\d]/g, '');
                });
                let doTempIncrement = () => {
                    $this.proceed_event_ticket_book_step_one();
                }
                clearTimeout(kmIncrementTimer);
                kmIncrementTimer = setTimeout(doTempIncrement, 200);
            });
            //increment decrement js new end
            $(document).on('click', '.km_eventpromo_coupon_remove', function() {
                if ($('input[name=eventpromocode]').length) {
                    $('input[name=eventpromocode]').val('');
                    $(".km_eventpromo_btn").trigger('click');
                }
            });
            $(document).on('click', '.km_eventpromo_btn', function() {
                var formData = new FormData($('#km_add_to_cart_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_events_price", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_events_prices_section').html(response.data);
                        $('.km_event_ordersummary').html(response.summary);
                        if (response.isPrice === 0) {
                            $('#km_add_to_cart_form').find('.kmeventPrice').text('');
                            $('.km_package_card input, .km_package_card select').removeAttr('required');
                            $('.km_event_checkout').removeClass('km_hidden');
                            $('.km_event_continue').addClass('km_hidden');
                        } else {
                            $('.km_package_card input, .km_package_card select').attr('required', 'required');
                            $('.km_event_checkout').addClass('km_hidden');
                        }
                        if (response.isPrice === 01) {
                            $('.km_package_card').addClass('km_hidden');
                            $('.km_package_card input, .km_package_card select').removeAttr('required');
                            $('#km_add_to_cart_form').find('.kmeventPrice').text('');
                        } else {
                            $('.km_package_card').removeClass('km_hidden');
                            $('.km_package_card input, .km_package_card select').attr('required', 'required');
                        }
                        if (response.if_discount_applied) {
                            $this.DisplayAlert('success', 'Coupon Applied Successfully.');
                        }
                    } else {
                        $('input[name=eventpromocode]').val('');
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            $(document).on('click', '.km_event_continue', function() {
                //code to hide payyments option if cart total is zero:ajax performed
                let formData = new FormData($('#km_add_to_cart_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_events_price", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_events_prices_section').html(response.data);
                        $('.km_event_ordersummary').html(response.summary);
                        if (response.isPrice === 0) {
                            $('#km_add_to_cart_form').find('.kmeventPrice').text('');
                            $('.km_package_card input, .km_package_card select').removeAttr('required');
                            $('.km_event_checkout').removeClass('km_hidden');
                            $('.km_event_continue').addClass('km_hidden');
                            //show free div
                            if (!$('.km_events_right .km_freevent').length) {
                                $(".km_events_right").append('<span class="km_freevent km_notloggedIn">Enjoy Free Event, Fill the details above and click on checkout button to confirm the Booking.</span>');
                            }
                            //show free div end
                        } else {
                            $('.km_event_checkout').addClass('km_hidden');
                            $('.km_package_card input, .km_package_card select').attr('required', 'required');
                            $('.km_event_continue').addClass('km_hidden');
                            $(".km_events_right .km_freevent").remove();
                        }
                        if (response.isPrice === 01) {
                            $('.km_package_card').addClass('km_hidden');
                            $('.km_package_card input, .km_package_card select').removeAttr('required');
                            $('#km_add_to_cart_form').find('.kmeventPrice').text('');
                            //show free div
                            if (!$('.km_events_right .km_freevent').length) {
                                $(".km_events_right").append('<span class="km_freevent">Enjoy Free Event, Please click on checkout button to confirm the Booking.</span>');
                            }
                            //show free div end
                        } else {
                            $('.km_package_card input, .km_package_card select').attr('required', 'required');
                            $('.km_package_card').removeClass('km_hidden');
                            $(".km_events_right .km_freevent").remove();
                        }
                    } else {
                        $('input[name=eventpromocode]').val('');
                    }
                    //code to proceed
                    if ($('.km_events_prices_section').is(':empty')) {
                        if (response.message != '') {
                            $('.kmeventrequired').text(response.message);
                        } else {
                            $('.kmeventrequired').text('Please select the number of seats to continue.');
                        }
                        $(".km_modal_content").animate({
                            scrollTop: 0
                        }, "fast");
                        return false;
                    }
                    setTimeout(function() {
                        $('.km_event_continue').addClass('km_hidden');
                    }, 50);
                    $('.kmeventrequired').text('');
                    $('.km_cart_options').addClass('km_hidden');
                    $('.km_event_credit,.km_event_ordersummary').removeClass('km_hidden');
                    $('.km_event_checkout,.km_event_back').removeClass('km_hidden');
                    $(".km_modal_content").animate({
                        scrollTop: 0
                    }, "fast");
                    $this.requiredfields();
                    $this.CardInput();
                    //code to proceed end
                });
                //code to hide payyments option if cart total is zero   
            });
            $(document).on('click', '.km_event_back', function() {
                $('.km_cart_options').removeClass('km_hidden');
                setTimeout(function() {
                    $('.km_event_continue').removeClass('km_hidden');
                }, 50);
                $('.km_event_credit,.km_event_ordersummary').addClass('km_hidden');
                $('.km_event_checkout,.km_event_back').addClass('km_hidden');
            });
            /*Multiweek buttons*/
            $(document).on('click', '.km_multiweek_continue', function() {
                if ($('.km_profile_participants').length) {
                    if ($('#km_atc_participant_count').val() == 0) {
                        $('.kmkidsrequired').text('Please select Participant');
                        $this.scrollInModal('.km_modal_content', '.km_multiweek_options');
                        return false;
                    } else {
                        $('.kmkidsrequired').text('');
                    }
                }
                if ($('.km_event_Daysweek').length) {
                    if (!$('.km_multiweekday_selection').is(":checked")) {
                        $('.kmdaysrequired').text('Please select Days');
                        $this.scrollInModal('.km_modal_content', '.km_booking_selection');
                        return false;
                    } else {
                        $('.kmdaysrequired').text('');
                    }
                }
                if ($('.km_multiweek_calander').length) {
                    if ($('#StartingDate').val() === '') {
                        $('.kmdaterequired').text('Please select Date');
                        $this.scrollInModal('.km_modal_content', '.km_booking_selection');
                        return false;
                    } else {
                        $('.kmdaterequired').text('');
                    }
                }
                $('.km_multiweek_options').addClass('km_hidden');
                $('.km_multiweek_continue').addClass('km_hidden');
                $('.km_multiweek_credit').removeClass('km_hidden');
                $('.km_multiweek_btn,.km_multiweek_back').removeClass('km_hidden');
                $(".km_modal_content").animate({
                    scrollTop: 0
                }, "fast");
                $this.requiredfields();
                $this.CardInput();
            });
            $(document).on('click', '.km_multiweek_back', function() {
                $('.km_multiweek_options').removeClass('km_hidden');
                $('.km_multiweek_continue').removeClass('km_hidden');
                $('.km_multiweek_credit').addClass('km_hidden');
                $('.km_multiweek_btn,.km_multiweek_back').addClass('km_hidden');
            });
            $(document).on('click', '.km_more_summary', function() {
                $('.km_event_orderdetails').toggleClass('km_hidden');
                $('.km_event_orderdetails').toggleClass('open');
            });
            $(document).on('click', '.km_ticketinclude', function() {
                $(this).next('.km_event-notes').slideToggle("slow");
            });
            $(document).on('click', '.km_guest_participants li', function() {
                $('.km_guest_participants li').removeClass('km_active_participant km_primary_border km_primary_shadow');
                $(this).addClass('km_active_participant km_primary_border km_primary_shadow');
                let seatCount = $(this).data('count');
                $('#km_atc_participant_count').val(seatCount);
                /* display kid selection form*/
                var formData = new FormData($('#km_add_to_cart_form')[0]);
                //formData.set('action', 'km_get_kid_form'); // not working in i.e 11
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_kid_form", formData, function(response) {
                    $('.km_guestparticipant_forms').html(response.content);
                    //if(response.price){ $('.package_price span').text(response.price);}
                    if (response.purchasecount) {
                        $('.km_package_purchase_btn').attr('data-purchasecount', response.purchasecount);
                    }
                    $this.requiredfields();
                    //$this.fielddaySelect();
                    if (seatCount == 1) {
                        $('.km_delete_participant').addClass('disabled');
                    } else {
                        $('.km_delete_participant').removeClass('disabled');
                    }
                });
            });
            $(document).on('click', '.add_new_participant', function(e) {
                e.preventDefault();
                var seats = $('#km_atc_participant_count').val();
                var seatCount = parseInt(seats) + 1;
                $('#km_atc_participant_count').val(seatCount);
                var formData = new FormData($('#km_add_to_cart_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_add_new_kid", formData, function(response) {
                    $('.km_addnewparticipant_forms').html(response.content);
                    $this.requiredfields();
                    $this.fielddaySelect();
                });
                /*$this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_add_new_kid'
                }, function (response) {
                    $('.km_newparticipant_form').html(response.content);
                    $this.requiredfields();
                    $('.km_atc_participants, .km_atc_extended_care, .km_add_to_cart, .km_update_cart, .km_atc_paymentoptions, .km_package_wrapper').hide();
                    $('.km_add_participant, .km_add_participant_cancel').removeClass('km_hidden');
                    $('.km_package_btns').addClass('km_hidden');
                    $this.fielddaySelect();
                    $this.requiredfields();
                });*/
            });
            $(document).on('click', '.km_add_participant', function(e) {
                event.preventDefault();
                let cartKey = $('#km_atc_cartkey').val();
                var aform = $(this).parents('form').attr('id');
                var sessionID = $(this).parents('form').find('#km_atc_session_id').val();
                $('#' + aform).parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'new_kid_create'
                }).done(function() {
                    //var isUpdated = $this.updateDate($('#km_add_to_cart_form'));
                    var isUpdated = $this.updateDate($('#' + aform));
                    if (isUpdated) {
                        var formData = new FormData($('#' + aform)[0]);
                        //formData.set('action', 'km_save_kid');
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_save_kid", formData, function(response) {
                            if (response.status == 'success') {
                                $('.km_addnewparticipant_forms').html('');
                                if ($('.modal_newkid').length) {
                                    $('.modal_newkid').hide();
                                    location.reload();
                                }
                                //$('.km_atc_participants, .km_atc_extended_care, .km_add_to_cart, .km_update_cart, .km_atc_paymentoptions, .km_package_wrapper').show();
                                //$('.km_add_participant, .km_add_participant_cancel').addClass('km_hidden');
                                //$('.km_package_btns').removeClass('km_hidden');
                                $this.getParticipants(cartKey, sessionID);
                            } else if (response.status == 'fail') {
                                $this.DisplayAlert('error', response.message);
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.km_add_participant_cancel', function(e) {
                e.preventDefault();
                $('.km_addnewparticipant_forms').html('');
                if ($(".km_col_10_my_account").length) {
                    $this.closepopup();
                }
            });
            $(document).on('click', '.km_package_next_btn', function() {
                $(this).parents('div').find('form').find('.package_payment_section').show();
                $(this).parents('div').find('form').find('.km_package_payment_screen_info,.km_no_payment_info').toggleClass('km_hidden');
                $(this).parents('div').find('form').find('.km_atc_participants,.recommendedclassPackages, .km_about_package, .km_renewal').hide();
                $(this).parents('div').find('.km_modal_footer').find('.km_package_next_btn').hide();
                $(this).parents('div').find('.km_modal_footer').find('.km_package_purchase_btn,.km_package_back_btn').show();
                var $selectedPackage = $('.km_purchasefield:checked').parents('.km_radio_wrap').find('.km_radio_text').clone();
                $('.km_package_sel').html($selectedPackage);
            });
            $(document).on('click', '.km_package_back_btn', function() {
                $(this).parents('div').find('form').find('.package_payment_section').hide();
                $(this).parents('div').find('form').find('.km_package_payment_screen_info,.km_no_payment_info').toggleClass('km_hidden');
                $(this).parents('div').find('form').find('.km_atc_participants,.recommendedclassPackages, .km_about_package ,.km_renewal').show();
                $(this).parents('div').find('.km_modal_footer').find('.km_package_next_btn').show();
                $(this).parents('div').find('.km_modal_footer').find('.km_package_purchase_btn,.km_package_back_btn').hide();
            });
            $(document).on('change', '.km_purchasefield', function() {
                var $selectedPackage = $(this).parents('.km_radio_wrap').find('.km_radio_text').clone();
                $('.km_package_sel').html($selectedPackage);
            });
            $(document).on('change', '.km_multiweekday_selection', function() {
                if ($(this).is(':checked')) {
                    $(this).parent('label').addClass('km_primary_bg');
                } else {
                    $(this).parent('label').removeClass('km_primary_bg');
                }
                var formData = new FormData($('#km_add_to_cart_form')[0]);
                $this.MultiweekExtradata();
            });
            $(document).on('click', '.km_profile_participants li:not(.add_new_participant)', function() {
                if ($(this).find('.selected_kid').prop("checked")) {
                    $(this).removeClass('km_active_participant km_primary_border km_primary_shadow');
                    $(this).find('.km_profile_participant_form input').attr("readonly", true);
                    $(this).find('.km_profile_participant_form input').attr("disabled", true);
                    $(this).find('.selected_kid').prop('checked', false);
                } else {
                    $(this).addClass('km_active_participant km_primary_border km_primary_shadow');
                    $(this).find('.selected_kid').prop('checked', true);
                    $(this).find('.km_profile_participant_form input').attr("readonly", false);
                    $(this).find('.km_profile_participant_form input').attr("disabled", false);
                }
                $('#km_atc_participant_count').val($('.km_active_participant').length);
                $('.km_selected_kids .km_kids').html('');
                $('.km_active_participant').each(function() {
                    var $kids = $(this).find('.km_participant_name').clone();
                    $('.km_selected_kids .km_kids').append($kids);
                });
                /*Get Class Packages Options*/
                var form = $(this).parents('div').find('form');
                var haspackageid = $(this).parents('div').find('form').find('.package_id');
                var kidscount = $(this).parents('div').find('form').find('#km_atc_participant_count').val();
                //hide show "Please select Participant"
                if ($('#km_atc_participant_count').val() == 0) {
                    $('.kmkidsrequired').text('Please select Participant');
                } else {
                    $('.kmkidsrequired').text('');
                }
                //hide show "Please select Participant end" 
                if ($(haspackageid).length) {
                    var formData = new FormData(form[0]);
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_get_class_packages_options", formData, function(response) {
                        if (response.status == 'success') {
                            jQuery('.km_renewal').html(response.renewal);
                            var renewal_fre = response.renewal_fre;
                            var total_prices = 0;
                            jQuery('.km_package_next_btn,.km_package_purchase_btn').hide();
                            var res = oneTimeFee = packagePurchased = prices = prices_single = additionalSeatCost = 0;
                            var res = response.data.data;
                            var packagePurchased = res.packagePurchased;
                            var paymentRequired = res.paymentRequired;
                            var oneTimeFee = res.oneTimeFee;
                            //var prices = jQuery.parseJSON(JSON.stringify([res.vendorPackage.price]));
                            // Initialize prices array with data or an empty array if data is not received
                            var prices = res.vendorPackage && res.vendorPackage.price
                            ? [res.vendorPackage.price]
                            : [];

                            // If prices array is empty, set default data
                            if (prices.length === 0) {
                                var total_price = 0;
                            }else{
                                var prices_single = prices[0];
                                var additionalSeatCost = prices[0]['additionalSeatCost'];
                                jQuery.each(prices_single, function(key, val) {
                                    total_prices += 1;
                                });
                                var no_of_prices = total_prices - 1;
                                if (kidscount in prices_single) {
                                    var total_price = prices[0][kidscount];
                                } else {
                                    var seatprice = prices[0][no_of_prices];
                                    var totalkids = kidscount - no_of_prices;
                                    var extra_price = totalkids * additionalSeatCost;
                                    var total_price = extra_price + seatprice;
                                }
                            }
                            if (kidscount == 1 && packagePurchased == false) {
                                var radios = [{
                                    'option': 'package',
                                    'timeperiod': renewal_fre,
                                    'title': 'Class Package',
                                    'price': '$' + total_price.toFixed(2),
                                    'checked': 'checked'
                                }];
                                jQuery('.km_package_next_btn').show();
                            }
                            if (kidscount == 1 && packagePurchased == true) { //updated 26-7-2022
                                var radios = [{
                                    'option': 'package',
                                    'timeperiod': '',
                                    'title': 'Upgrade Class Package',
                                    'price': '$' + total_price.toFixed(2),
                                    'checked': 'checked'
                                }];
                                jQuery('.km_package_next_btn').show();
                                //jQuery('.km_package_purchase_btn').show();
                            }
                            if (kidscount > 1 && packagePurchased == true) {
                                var total_price = total_price - seatprice;
                                var radios = [{
                                    'option': 'package',
                                    'timeperiod': renewal_fre,
                                    'title': 'Upgrade Class Package',
                                    'price': '$' + total_price.toFixed(2),
                                    'checked': 'checked'
                                }];
                                jQuery('.km_package_next_btn').show();
                                //jQuery('.km_package_purchase_btn').show();
                            }
                            if (kidscount > 1 && packagePurchased == false) {
                                var radios = [{
                                    'option': 'package',
                                    'timeperiod': renewal_fre,
                                    'title': 'Class Package',
                                    'price': '$' + total_price.toFixed(2),
                                    'checked': 'checked'
                                }];
                                jQuery('.km_package_next_btn').show();
                            }
                            jQuery('.recommendedclassPackages').html('');
                            jQuery('.recommendedclassPackages').html('<h3 class="km_heading_wrap  ">How would you like to pay?</h3>');
                            for (var value of radios) {
                                var price_div = '';
                                if (value.price) {
                                    var price_div = '<p>Price: ' + value.price + ' ' + value.timeperiod + '</p>';
                                }
                                jQuery('.recommendedclassPackages').append('<label class="km_radio_wrap"><div class="km_radio_text"><span>' + value.title + '</span>' + price_div + '</div><input ' + value.checked + ' data-price="' + value.price + '" id="' + value.option + '" data-parsley-group="atc_field" class="km_purchasefield" data-text="" value="' + value.option + '" type="radio" name="ATC[prices]"><span class="km_radio"></span></label>');
                            }
                        }
                    });
                } // ends HasPackage
                if ($(".km_multiweek_section").hasClass("km_multiweek_session")) {
                    var formData = new FormData(form[0]);
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_multiweek_calculations", formData, function(response) {
                        if (response.status == 'success') {
                            var date = moment(response.data.nextPaymentOn); //Get the current date
                            var nextPaymentOn = date.format("MMM Do, YYYY"); //2014-07-10
                            $('.km_due_today .km_date_value').text('$' + response.data.totalAmount);
                            var tamount = "$" + response.data.payableAmount;
                            if (response.data.totalAmount != response.data.payableAmount) {
                                var tamount = "<strike>$" + response.data.totalAmount + "</strike>" + "$" + response.data.payableAmount;
                            }
                            $('.km_total_due .km_date_value').html(tamount);
                            $('.km_next_payment .km_date_value').text(nextPaymentOn);
                            $('.km_weeks_remaining .km_date_title').text(response.data.remainingWeeks + ' Weeks Remaining');
                            $('.km_weeks_remaining .km_date_value').text(response.data.session.paymentFrequency + ' - $' + response.data.nextPaymentAmount + '/seat');
                            $('.km_due').removeClass('km_hidden');
                            var bookingdate = moment(response.data.nextBookingDate); //Get the current date
                            var nextBookingOn = bookingdate.format("MMM Do, YYYY"); //2014-07-10
                            $('.km_joiningdate .km_date_value').html('<b>' + nextBookingOn + '</b>');
                            $('.km_joiningdate').show();
                            if (response.data.autoRenewalRequired != '') {
                                $('.km_renewal').removeClass('km_hidden');
                            }
                            //console.log('Hiiii new Im here'+response.data.autoRenewalRequired);
                            if (response.data.payableAmount) {
                                $('.paymentMethod').val('card');
                            } else {
                                $('.paymentMethod').val('free');
                            }
                        }
                    });
                } // ends check multiweek
            });
            $(document).on('click', '.km_update_cart', function(e) {
                e.preventDefault();
                $('.km_participant_error').remove();
                if ($(".km_allowed_seats").attr('data-static-seats') !== undefined) {
                    var allowed_seats = $('.km_allowed_seats').attr('data-static-seats');
                } else {
                    var allowed_seats = $('.km_allowed_seats').attr('id');
                }
                var selected_kids = $('input[name="kidscount"]').val();
                if (parseInt(selected_kids) > parseInt(allowed_seats)) {
                    $('.km_package_participants .km_heading_title').after('<span class="km_participant_error">Sadly, we can only accommodate ' + allowed_seats + ' attendees.</span>');
                    //$('.km_modal_content').scrollTo('.km_booking_options');
                    $this.scrollInModal('.km_modal_content', '.km_package_participants');
                    return false;
                }
                $('#km_add_to_cart_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'atc_field'
                }).done(function() {
                    var linkaddress = $(this).attr('href');
                    let isupdated = $this.updateDate($('#km_add_to_cart_form'));
                    if (isupdated) {
                        //$this.addSessionToCart(linkaddress);
                        $this.updateSessionToCart(linkaddress);
                    }
                });
            });
            $(document).on('click', '.km_delete_participant', function() {
                let participantCount = $("#km_atc_participant_count").val();
                if (participantCount > 1) {
                    $(this).parents('.km_single_kid_wrap').remove();
                    let newparticipantcount = participantCount - 1;
                    if (newparticipantcount == 1) {
                        $('.km_delete_participant').addClass('disabled');
                    } else {
                        $('.km_delete_participant').removeClass('disabled');
                    }
                    $("#km_atc_participant_count").val(newparticipantcount);
                    $(".km_guest_participants li").removeClass('km_active_participant  km_primary_border km_primary_shadow');
                    $(".km_guest_participants li[data-count='" + newparticipantcount + "']").addClass('km_active_participant km_primary_border km_primary_shadow');
                    let index = 1;
                    $('.km_single_kid_wrap').each(function() {
                        let participantText = $(this).data('participant-text');
                        $(this).find('.km_kidform_header h3').html(participantText + " " + index);
                        index++;
                    })
                }
            });
            $(document).on('click', '.km_add_to_cart', function(e) {
                $('.km_participant_error').remove();
                var checkoutRediect = $(this).data('checkout-rediect');
                /*Check either the Selected Participants are correct or not*/
                //var allowed_seats = $('.km_allowed_seats').val();
                if ($(".km_allowed_seats").attr('data-static-seats') !== undefined) {
                    var allowed_seats = $('.km_allowed_seats').attr('data-static-seats');
                } else {
                    var allowed_seats = $('.km_allowed_seats').attr('id');
                }
                var selected_kids = $('input[name="kidscount"]').val();
                if (parseInt(selected_kids) > parseInt(allowed_seats)) {
                    $('.km_package_participants .km_heading_title').after('<span class="km_participant_error">Sadly, we can only accommodate ' + allowed_seats + ' attendees.</span>');
                    //$('.km_modal_content').scrollTo('.km_booking_options');
                    $this.scrollInModal('.km_modal_content', '.km_package_participants');
                    return false;
                }
                if ($('.km_guest_personalinfo').length) {
                    var valgroup = 'atc_infofield';
                } else {
                    var valgroup = 'atc_field';
                }
                e.preventDefault();
                $('#km_add_to_cart_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: valgroup
                }).done(function() {
                    var linkaddress = $(this).attr('href');
                    let isupdated = $this.updateDate($('#km_add_to_cart_form'));
                    if (isupdated && checkoutRediect != 'undefined') {
                        $this.addSessionToCart(linkaddress, checkoutRediect);
                    }
                });
            });
            $(document).on('click', '.km_add_to_waitlist', function(e) {
                $('.km_participant_error').remove();
                //var checkoutRediect= $(this).data('checkout-rediect');
                var selected_kids = $('input[name="kidscount"]').val();
                var valgroup = 'atc_field';
                e.preventDefault();
                $('#km_add_to_cart_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: valgroup
                }).done(function() {
                    let isupdated = $this.updateDate($('#km_add_to_cart_form'));
                    $this.addSessionToWaitlist();
                    /*if (isupdated &&  checkoutRediect !='undefined') {
                        $this.addSessionToCart(linkaddress,checkoutRediect);
                    }*/
                });
            });
            $(document).on('click', '.km_cartguest_continue', function(e) {
                e.preventDefault();
                $('.km_participant_error').remove();
                /*Check either the Selected Participants are correct or not*/
                if ($(".km_allowed_seats").attr('data-static-seats') !== undefined) {
                    var allowed_seats = $('.km_allowed_seats').attr('data-static-seats');
                } else {
                    var allowed_seats = $('.km_allowed_seats').attr('id');
                }
                var selected_kids = $('input[name="kidscount"]').val();
                //console.log('allowed_seats: '+ allowed_seats+'selected_kids: '+selected_kids);
                if (parseInt(selected_kids) > parseInt(allowed_seats)) {
                    $('.km_package_participants .km_heading_title').after('<span class="km_participant_error">Sadly, we can only accommodate ' + allowed_seats + ' attendees.</span>');
                    //$('.km_modal_content').scrollTo('.km_booking_options');
                    $this.scrollInModal('.km_modal_content', '.km_package_participants');
                    return false;
                }
                $('#km_add_to_cart_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'atc_field'
                }).done(function() {
                    var isUpdatedage = $this.updateDate($('#km_add_to_cart_form'));
                    if (isUpdatedage) {
                        $('.km_cart_sectionone').addClass('km_hidden');
                        $('.km_guest_personalinfo').removeClass('km_hidden');
                        $('.km_add_to_cart,.km_cartguest_back').css('display', 'inline-block');
                        $('.km_cartguest_continue').css('display', 'none');
                    }
                });
            });
            $(document).on('click', '.km_cartguest_back', function(e) {
                $('.km_cart_sectionone').removeClass('km_hidden');
                $('.km_guest_personalinfo').addClass('km_hidden');
                $('.km_cartguest_continue').css('display', 'inline-block');
                $('.km_add_to_cart,.km_cartguest_back').css('display', 'none');
            });
            /*membership add to cart start */
            $(document).on('click', '.km_add_to_cart_membership', function(e) {
                e.preventDefault();
                var membershipid = $(this).data('membershipid');
                var membershipprice = $(this).data('membership-price');
                var providerId = $(this).data('providerid');
                var membershipTitle = $(this).data('membership-title');
                var formData = {
                    'membershipid': membershipid,
                    'membershipprice': membershipprice,
                    'providerId': providerId,
                    'title': membershipTitle,
                    'action': 'km_set_membershipcartitems'
                };
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-normal');
                        $this.CardInput();
                    }
                });
            });
            // Package purchase 
            $(document).on('click', '.km_package_purchase_btn', function(e) {
                e.preventDefault();
                var form = $(this).parents('div').find('form');
                var cardId = $(this).parents('.km_modal_alert').find('form').find(".km_package_cardId:checked").val();
                console.log(cardId);
                e.preventDefault();
                $(form).parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'merchandise_field'
                }).done(function() {
                    if (cardId) {
                        var formData = new FormData(form[0]);
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_packagepurchase", formData, function(response) {
                            if (response.status == 'success') {
                                form.hide();
                                form.parents('.km_modal_content').find('.thank-you-section').show();
                                form.parents('.km_package_modal').find('.km_modal_footer').hide();
                            } else {
                                $this.DisplayAlert('error', response.message);
                            }
                        });
                    } else {
                        $this.StripeProcess(form, function(response) {
                            if (response.error) {
                                $this.DisplayAlert('error', response.error.message);
                                $this.kmRemoveLoader();
                            } else {
                                form.find('.stripe_token').val(response.id);
                                var formData = new FormData(form[0]);
                                var stripeToken = response.id;
                                $(this).parents('div').find('form').find('.stripe_token').val(stripeToken);
                                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_packagepurchase", formData, function(response) {
                                    if (response.status == 'success') {
                                        console.log(response.status);
                                        form.hide();
                                        form.parents('.km_modal_content').find('.thank-you-section').show();
                                        form.parents('.km_package_modal').find('.km_modal_footer').hide();
                                    } else {
                                        $this.DisplayAlert('error', response.message);
                                    }
                                });
                            }
                        });
                    }
                });
            });
            // Self Check-In
            $(document).on('click', '.km_self_checkIn_btn', function(e) {
                e.preventDefault();
                var ticketid = $(this).attr('data-id');
                var orderno = $(this).attr('data-order');
                var formData = new FormData();
                formData.set('ticketid', ticketid);
                formData.set('orderno', orderno);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_self_checkin", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_checkIn').html(response.content);
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            /*Pull ticket*/
            $(document).on('click', '.km_pullticket_btn', function(e) {
                var email = $('input[name=ticket_email]').val();
                var phone = $('input[name=ticket_phone]').val();
                if (email == '' && phone == '') {
                    $('.invalid-form-error-message').html("Must fill one field either email id or phone number").addClass("filled");
                    return false;
                }
                var form = $('#km_ticket_form');
                form.parsley().validate();
                var formData = new FormData(form[0]);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_pullticket", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_checkIn').html(response.content);
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                    $this.fielddaySessionTime();
                    $this.PhoneInput();
                    $this.scrollTo('.km_checkIn');
                });
            });
            // Contact Form
            $(document).on('click', '#contact-submit', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                var formData = new FormData(form[0]);
                $(this).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'km_contact'
                }).done(function() {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_contact_form", formData, function(response) {
                        if (response.status == 'success') {
                            $('.km_contact_message').html('<p>' + response.message + '</p>');
                            $(form)[0].reset();
                            //$this.scrollTo('.km_contact_message');    
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                });
            });
            $(document).on('click', '#km_order_refund_form_submit', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                var formData = new FormData(form[0]);
                let refund_type = $('input[name="order_refund"]:checked').val();
                if (refund_type) {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=refundFormEventSession", formData, function(response) {
                        if (response.status == 'success') {
                            $this.DisplayAlert('success', response.message);
                            if (refund_type == 'refund') {
                                jQuery(".km_checkin_tickets_option_content").html("<h5 class='km_checkin_tickets_option_content_h5'>Cancellation Request Submitted!</h5><p class='km_checkin_tickets_option_content_p_cls'>We have successfully submitted your cancellation request. You will receive an email once it is processed. The refund amount will be credited to your bank account within 5 - 10 business days.</p>");
                            } else {
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                            }
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    }, '', 'km_order_refund_form_submit');
                } else {
                    $this.DisplayAlert('error', "Please select Ticket Options First.");
                }
            });
            // Request Demo Form
            $(document).on('click', '#demo-submit', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                var formData = new FormData(form[0]);
                $(this).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'km_contact'
                }).done(function() {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_requestdemo_form", formData, function(response) {
                        if (response.status == 'success') {
                            $('.km_contact_message').html('<p>' + response.message + '</p>');
                            $(form)[0].reset();
                            //$this.scrollTo('.km_contact_message');    
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                });
            });
            //Sticky Contact Form
            $(document).on('click', '.km_sticky_btn', function(e) {
                e.preventDefault();
                var formData = new FormData();
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_sticky_widget", formData, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-medium km_sticky_modal km_sticky_widget_pop_up');
                        $this.PhoneInput();
                        $this.requiredfields();
                        //grecaptcha.reset();
                        widgetId = grecaptcha.render("c-recaptch", {
                            sitekey: fieldday_ajax.g_sitekey,
                        });
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            // Party Form
            $(document).on('click', '#partyform-submit', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                var formData = new FormData(form[0]);
                $(this).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'km_party'
                }).done(function() {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_party_form", formData, function(response) {
                        if (response.status == 'success') {
                            $('.km_success_message').html('<p>' + response.message + '</p>');
                            $(form)[0].reset();
                            //$this.scrollTo('.km_contact_message');    
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                });
            });
            $(document).on('click', '.km_sticky_icon', function(e) {
                e.preventDefault();
                $('.km_sticky_content').toggleClass('km_hidden_sticky');
                if ($(".km_sticky_content").hasClass("km_hidden_sticky")) {
                    $('.km_sticky_icon').addClass("km_sticky_open");
                    $('.km_sticky_icon').removeClass("km_sticky_close");
                    $this.setCookie('km_stickyform', 'close');
                } else {
                    $('.km_sticky_icon').addClass("km_sticky_close");
                    $('.km_sticky_icon').removeClass("km_sticky_open");
                    $this.setCookie('km_stickyform', 'open');
                }
            });
            $(document).on('click', '.KmStickyWidgetAddToCartIcon', function(e) {
                e.preventDefault();
                if ($('#km_cart_items_wrap').length === 0) {
                    $('<div id="km_cart_items_wrap"></div>').appendTo('body');
                }
                $this.updatefielddayCart($('[id=km_cart_items_wrap]'));
            });
            // Event Purchase 
            $(document).on('click', '.km_event_checkout', function(e) {
                e.preventDefault();
                var form = $(this).parents('div').find('form');
                var cardId = $(this).parents('.km_modal_alert').find('form').find(".km_package_cardId:checked").val();
                //$(this).removeClass('km_event_checkout');
                if (cardId) {
                    var formData = new FormData(form[0]);
                    $this.km_loader();
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_eventpurchase", formData, function(response) {
                        if (response.status == 'success') {
                            if (response.redirect != '') {
                                //console.log(response,'response');
                                window.location.href = response.redirect;
                            } else {
                                form.hide();
                                form.parents('.km_modal_content').find('.thank-you-section').show();
                                form.parents('.km_event_modal').find('.km_modal_footer').hide();
                            }
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    }, '', 'km_event_checkout_btn');
                } else {
                    var kmeventPrice = $(this).parents('div').find('form').find('.kmeventPrice').text();
                    //var formData = new FormData(form[0]);
                    if (kmeventPrice == 1) {
                        $(this).parents('div').find('form').parsley($this.settings.parsley_valiation_options_register).whenValidate({
                            group: 'event_fields'
                        }).done(function() {
                            $this.StripeProcess(form, function(response) {
                                if (response.error) {
                                    $this.DisplayAlert('error', response.error.message);
                                    $this.km_btn_RemoveLoader("km_event_checkout_btn");
                                    $this.kmRemoveLoader();
                                } else {
                                    form.find('.stripe_token').val(response.id);
                                    var formData = new FormData(form[0]);
                                    formData.set('hideloader', 'hide');
                                    var stripeToken = response.id;
                                    $(this).parents('div').find('form').find('.stripe_token').val(stripeToken);
                                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_eventpurchase", formData, function(response) {
                                        if (response.status == 'success') {
                                            if (response.redirect != '') {
                                                window.location.href = response.redirect;
                                            } else {
                                                form.hide();
                                                form.parents('.km_modal_content').find('.thank-you-section').show();
                                                form.parents('.km_event_modal').find('.km_modal_footer').hide();
                                                if ($("#km_session_filter_form").length) {
                                                    $this.processSessionFilters();
                                                }
                                            }
                                        } else {
                                            $this.DisplayAlert('error', response.message);
                                        }
                                    }, '', 'km_event_checkout_btn');
                                }
                            }, true, 'km_event_checkout_btn');
                        }); // validation check
                    } // check kmeventPrice
                    else {
                        var formData = new FormData(form[0]);
                        $(this).parents('div').find('form').parsley($this.settings.parsley_valiation_options_register).whenValidate({
                            group: 'event_fields'
                        }).done(function() {
                            $this.km_loader();
                            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_eventpurchase", formData, function(response) {
                                if (response.status == 'success') {
                                    if (response.redirect != '') {
                                        window.location.href = response.redirect;
                                    } else {
                                        form.hide();
                                        form.parents('.km_modal_content').find('.thank-you-section').show();
                                        form.parents('.km_event_modal').find('.km_modal_footer').hide();
                                        if ($("#km_session_filter_form").length) {
                                            $this.processSessionFilters();
                                        }
                                    }
                                } else {
                                    $this.DisplayAlert('error', response.message);
                                }
                            }, '', 'km_event_checkout_btn');
                        }); // validate fields
                    }
                }
                // });
            });
            // Multiweek Purchase
            $(document).on('click', '.km_multiweek_btn', function(e) {
                e.preventDefault();
                var form = $(this).parents('div').find('form');
                var cardId = $(this).parents('.km_modal_alert').find('form').find(".km_package_cardId:checked").val();
                var formData = new FormData(form[0]);
                if (cardId) {
                    $this.km_loader();
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_multiweekpurchase", formData, function(response) {
                        if (response.status == 'success') {
                            if (response.redirect && response.redirect != '') {
                                window.location.href = response.redirect;
                            } else {
                                form.hide();
                                form.parents('.km_modal_content').find('.thank-you-section').show();
                                form.parents('.km_addtocart_modal').find('.km_modal_footer').hide();
                            }
                        } else {
                            $this.DisplayAlert('error', response.message);
                        }
                    }, '', 'km_multiweek_purchase_btn_pc');
                } else {
                    $(this).parents('div').find('form').parsley($this.settings.parsley_valiation_options_register).whenValidate({
                        group: 'multiweek_fields'
                    }).done(function() {
                        $this.StripeProcess(form, function(response) {
                            if (response.error) {
                                $this.DisplayAlert('error', response.error.message);
                                $this.km_btn_RemoveLoader("km_multiweek_purchase_btn_pc");
                                $this.kmRemoveLoader();
                            } else {
                                form.find('.stripe_token').val(response.id);
                                var formData = new FormData(form[0]);
                                var stripeToken = response.id;
                                $(this).parents('div').find('form').find('.stripe_token').val(stripeToken);
                                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_multiweekpurchase", formData, function(response) {
                                    if (response.status == 'success') {
                                        if (response.redirect && response.redirect != '') {
                                            window.location.href = response.redirect;
                                        } else {
                                            form.hide();
                                            form.parents('.km_modal_content').find('.thank-you-section').show();
                                            form.parents('.km_addtocart_modal').find('.km_modal_footer').hide();
                                        }
                                    } else {
                                        $this.DisplayAlert('error', response.message);
                                    }
                                }, '', 'km_multiweek_purchase_btn_pc');
                            }
                        }, true, 'km_multiweek_purchase_btn_pc');
                    }); // validation check
                }
            });
            $(document).on('click', '.membership_purchase_button', function(e) {
                e.preventDefault();
                var membershipid = $(this).data('membershipid');
                var paymentmethod = $(this).data('paymentmethod');
                var purchasecount = $(this).data('purchasecount');
                var stripeToken;
                var savecard = $(this).find('.savecardcheck:checked').val();
                var form = $(this).parents('div').find('form');
                $this.StripeProcess(form, function(response) {
                    if (response.error) {
                        $this.DisplayAlert('error', response.error.message);
                        $this.kmRemoveLoader();
                    } else {
                        form.find('.stripe_token').val(response.id);
                        var formData = new FormData(form[0]);
                        stripeToken = response.id;
                        formData.set('membershipid', membershipid);
                        formData.set('paymentmethod', paymentmethod);
                        formData.set('purchasecount', purchasecount);
                        formData.set('stripeToken', stripeToken);
                        formData.set('saveCard', savecard);
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_membershipurchase", formData, function(response) {
                            if (response.status == 'success') {
                                $this.DisplayAlert('success', response.message);
                                if (window.location.hostname == 'localhost') {
                                    var getUrl = window.location;
                                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                                    window.location = baseUrl + "/my-account/";
                                } else {
                                    window.location = window.location.origin + "/my-account/";
                                }
                            }
                        });
                    }
                });
            });
            /*membership add to cart end */
            /*giftCard add to cart start */
            $(document).on('click', '.km_add_to_cart_giftCard', function(e) {
                e.preventDefault();
                var recipientName = $("[name='recipientname']").val();
                var recipientEmail = $("[name='recipient_email']").val();
                recipientEmail = recipientEmail.trim();
                let recipientEmailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!recipientEmailPattern.test(recipientEmail)) {
                    $('.km-gift-recipentent-email-error').show();
                    $("[name='recipient_email']").focus();
                    return false;
                } else {
                    $('.km-gift-recipentent-email-error').hide();
                }
                var max = parseInt($('input#km_gift_custom_amount').attr('max'));
                var min = parseInt($('input#km_gift_custom_amount').attr('min'));
                var price = parseInt($('input#km_gift_custom_amount').val());
                var senderName = $("[name='sender_name']").val();
                var usergiftMsg = $("[name='usergiftmsg']").val();
                var sendMethod = $('span.km_sendoption_value.selectedCartItem').text();
                var km_giftcustomamount = $('input[name="km_gift_custom_amount"]').val();
                /*if (isNaN(price)) {
                    $this.DisplayAlert('error', 'Please enter the giftcard amount');
                    return false;
                }*/
                if (!km_giftcustomamount) {
                    $this.DisplayAlert('error', 'Please select/enter the giftcard amount');
                    return false;
                }
                if (recipientName != '' && senderName != '' && usergiftMsg != '' && recipientEmail != '') {
                    if (price > max) {
                        $this.DisplayAlert('error', 'Amount is over the $2000 maximum');
                        return false;
                    }
                    var giftCardid = $('.km_single_giftcard .km_gift_image').data('giftcardid');
                    var giftCardImageorg = $('.km_single_giftcard .km_gift_image').attr('data-original');
                    var giftCardImagethumb = $('.km_single_giftcard .km_gift_image').attr('src');
                    var giftCardPrice = $('.giftcardprice').text();
                    var title = $('.km_giftcard_title_single').text();
                    //var recipientPhone =$("[name='recipient_phone']").val();
                    var recipientPhone = $("[name='parent_phone_gift_code']").val() + $("[name='parent_phone_gift_org_number']").val();
                    var sendDate = $("[name='send_date']").val();
                    var giftCardPrice = $('.giftcardprice').text();
                } else {
                    $this.DisplayAlert('error', 'Please fill the requried fields.');
                    return false;
                }
                var formData = {
                    'giftCardid': giftCardid,
                    'image': giftCardImageorg,
                    'imagethumb': giftCardImagethumb,
                    'amount': giftCardPrice.trim(),
                    'title': title.trim(),
                    'sendmethod': sendMethod,
                    'recipientname': recipientName,
                    'recipientemail': recipientEmail,
                    'recipientphone': recipientPhone,
                    'usergiftmsg': usergiftMsg,
                    'sendername': senderName,
                    'senddate': sendDate,
                    'action': 'km_set_giftCardmodel'
                };
                localStorage.setItem('kmGiftCardPurchaseData_title', title.trim());
                localStorage.setItem('kmGiftCardPurchaseData_sendmethod', sendMethod);
                localStorage.setItem('kmGiftCardPurchaseData_recipientname', recipientName);
                localStorage.setItem('kmGiftCardPurchaseData_recipientemail', recipientEmail);
                localStorage.setItem('kmGiftCardPurchaseData_amount', giftCardPrice);
                localStorage.setItem('kmGiftCardPurchaseData_recipientphone_code', $("[name='parent_phone_gift_code']").val());
                localStorage.setItem('kmGiftCardPurchaseData_r_phone_org_no', $("[name='parent_phone_gift_org_number']").val());
                localStorage.setItem('kmGiftCardPurchaseData_recipientphone', recipientPhone);
                localStorage.setItem('kmGiftCardPurchaseData_usergiftmsg', usergiftMsg);
                localStorage.setItem('kmGiftCardPurchaseData_sendername', senderName);
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-large');
                        $this.CardInput();
                        $this.PhoneInput();
                        $this.requiredfields();
                    }
                });
            });
            $(document).on('click', '.giftcard_purchase_button', function(e) {
                e.preventDefault();
                var giftCardid = $(this).attr('data-giftcardid');
                var paymentmethod = $(this).data('paymentmethod');
                var purchasecount = $(this).data('purchasecount');
                var giftCardImage = $('.km_gift_image').text();
                var giftCardImagethumb = $('.km_gift_imagethumb').text();
                var senderDisplayName = $('.sendername').text();
                var amount = $('.km_gift_amount ').text();
                var userName;
                var userEmail;
                var userPhone;
                userName = $('.km_gift_loginusername').text();
                senderName = $('.km_gift_username').text();
                senderEmail = $('.km_gift_useremail').text();
                senderPhone = $("[name='recipient_phone']").val();
                massgage = $("span.km_gift_msg.purchase_model p").text();
                userEmail = $("[name='parent[email]']").val();
                userPhone = $("[name='parent[phone]']").val();
                guest = $("input#usreguest").val();
                if (userEmail == undefined && userPhone == undefined) {
                    userName = $("[name='userDetails[name]']").val();
                    userEmail = $("[name='userDetails[email]']").val();
                    userPhone = $("input#parent_phone").val();
                }
                var stripeToken;
                var savecard = $('.savecardcheck:checked').val();
                var cardinfo = {};
                cardinfo.number = $('#km_card_number').val();
                cardinfo.cvc = $('#km_card_cvc').val();
                cardinfo.exp_month = $('#expireMM').val();
                cardinfo.exp_year = $('.km_card_expiry_year').val();
                var form = $(this).parents('div').find('form');
                $(form).parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'merchandise_field'
                }).done(function() {
                    /* create stripe token*/
                    //$this.km_loader();
                    $this.StripeProcess(form, function(response) {
                        if (response.error) {
                            $this.DisplayAlert('error', response.error.message);
                            $this.km_btn_RemoveLoader('km_gift_card_prchase_btn');
                            $this.kmRemoveLoader();
                        } else {
                            $this.km_loader();
                            form.find('.stripe_token').val(response.id);
                            var formData = new FormData(form[0]);
                            formData.set('userName', userName);
                            formData.set('userEmail', userEmail);
                            formData.set('userPhone', userPhone);
                            formData.set('giftCardid', giftCardid);
                            formData.set('paymentmethod', paymentmethod);
                            formData.set('purchasecount', purchasecount);
                            formData.set('giftCardImage', giftCardImage);
                            formData.set('giftCardImagethumb', giftCardImagethumb);
                            formData.set('amount', amount);
                            formData.set('massgage', massgage);
                            formData.set('stripeToken', response.id);
                            formData.set('sendername', senderName);
                            formData.set('senderemail', senderEmail);
                            formData.set('senderphone', senderPhone);
                            formData.set('senderDisplayName', senderDisplayName);
                            formData.set('guest', guest);
                            // $(this).parents('div').find('form').find('.stripe_token').val(stripeToken);
                            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_giftcardPurchase", formData, function(response) {
                                if (response.status == 'success') {
                                    $this.DisplayAlert('success', 'Thankyou for gift card purchase.Please check your Email address.');
                                    localStorage.setItem('kmGiftCardPurchaseData_title', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_sendmethod', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_recipientname', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_recipientemail', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_amount', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_recipientphone_code', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_r_phone_org_no', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_recipientphone', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_usergiftmsg', '');
                                    localStorage.setItem('kmGiftCardPurchaseData_sendername', '');
                                    setTimeout(function() {
                                        if (window.location.hostname == 'localhost') {
                                            window.location = window.location.origin + "/wordpresss/my-account/";
                                        } else {
                                            window.location = window.location.origin + "/my-account/";
                                        }
                                    }, 1000);
                                } else {
                                    $this.DisplayAlert('error', 'Something went wrong.Please try again later.');
                                    setTimeout(function() {
                                        window.location = window.location.origin + "/my-account/";
                                    }, 1000);
                                }
                            }, true, 'km_gift_card_prchase_btn');
                        }
                    }, true, 'km_gift_card_prchase_btn');
                });
            });
            /*giftCard add to cart end */
            /*giftcard single popupshow start*/
            $(document).on('click', '#km_giftpurchase_btn', function(e) {
                e.preventDefault();
                var giftcardid = $(this).data('giftcardid');
                var giftcardtitle = $(this).data('title');
                var giftcardid = $(this).data('giftcardid');
                var giftcardpricerange = $(this).data('giftcardprice-range');
                var buttontext = $(this).text();
                var formData = {
                    'giftcardid': giftcardid,
                    'giftcardtitle': giftcardtitle,
                    'giftcardpricerange': giftcardpricerange,
                    'buttontext': buttontext,
                    'action': 'km_set_singlegiftcard'
                };
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $this.displayModal(response, 'modal-large km_single_giftcardpopup');
                        $this.requiredfields();
                        //$('.km_single_giftcard .km_single_giftdesign:first-child img').trigger('click');
                        fieldday.setGiftCardPurchaseInitialFormData();
                        setTimeout(function() {
                            fieldday.PhoneInput();
                            var msg = $('#giftmsg').text();
                            $('#giftcardmsg').text(msg);
                            $('#giftmsg').keyup(function() {
                                var giftmsg = this.value;
                                $('#giftcardmsg').text(giftmsg);
                            });
                        }, 100);
                    }
                });
            });
            /*giftcard single popupshow ends*/
            /*checkout payment Installment popupshow start*/
            $('body').on('click', 'p.km_installments_heading', function() {
                var formdata = {
                    action: 'km_set_checkoutpayments'
                };
                var sessionId = $(this).find('i#km_checkoutpayments').data('sessionid');
                if (sessionId) {
                    formdata.session_id = sessionId;
                }
                $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                    $this.displayModal(response, 'modal-small km_payment_installment');
                });
            });
            /*checkout payment Installment popupshow end*/
            /*
             jQuery('body').on('click',function(e){
             e.preventDefault();
             jQuery('.typescontent').hide();
             });
             */
            /*$(document).on('change', 'input.selected_kid', function() {
             Â var limit = $('#km_atc_seat_amount').val();
             Â var check = $('.selected_kid:checked').length;
             Â if(check > limit) {
             Â this.checked = false;
             Â var confirmation = confirm(fieldday_ajax.confirm_pop_text);
             Â if(confirmation == true){
             Â $this.display_atc_prev_step();
             Â }
             Â }
             Â });*/
            $(document).on('click', '.atc_prev_step', function() {
                $this.display_atc_prev_step();
            });
            $(document).on('click', '.km_cart_toggle', function() {
                //$this.updatefielddayCart();
                $this.updatefielddayCart($(this).parent().find('#km_cart_items_wrap'));
            });
            $(document).on('click', '.km_slidefilter_btn a', function() {
                $('.km_filter_slide').css({
                    left: '0px'
                }).addClass('fieldday_filter_open');
                $('.km_SessionsSection').css({
                    'margin-left': '210px',
                    'width': '85%'
                });
            });
            $(document).on('click', '.removefilterselecter', function(e) {
                e.stopPropagation();
                jQuery('.km_filter_slide').css({
                    left: '-100%'
                }).removeClass('fieldday_filter_open');
                $('.km_SessionsSection').css({
                    'margin-left': '0px',
                    'width': '100%'
                });
                //jQuery('#km_cart_items_wrap_mobile').css({top: '5000px'});
            });
            /*-- mobile cart view code start --*/
            $(document).on('click', '.mobile_bttn', function() {
                $this.updatefielddayCartMobile();
            });
            /*-- mobile cart view code end --*/
            $(document).on('click', '.km_remove_cart_item', function() {
                $('[id=km_cart_items_wrap]').addClass('fieldday_ajax_processing');
                $('#km_cart_items_wrap_mobile').addClass('fieldday_ajax_processing');
                var cartkey = $(this).data('cart-key');
                var actionfrom = $(this).data('actionfrom');
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_remove_cart_item',
                    cart_key: cartkey
                }, function(data) {
                    if (data.status == 'success') {
                        $('#km_cart_items_wrap_mobile').html(data.content); /*-- mobile cart view code  --*/
                        $('[id=km_cart_items_wrap]').html(data.content);
                        //$('#km_cart_total_count').html(data.items);
                        $('[id=km_cart_total_count]').html(data.items);
                        if ($("#KmStickyWidgetAddToCartIcon_total_count").length) {
                            $('[id=KmStickyWidgetAddToCartIcon_total_count]').html(data.items);
                        }
                        $('.mobile_cart_count').html(data.items); /*-- mobile cart view code  --*/
                        $('#km_cart_items_wrap_mobile a.km_btn').after("<p class='continue_shopping_cart'><a href='/purchase/'>Continue Shopping</a></p>"); /*-- mobile cart view code  --*/
                        $('#km_cart_items_wrap_mobile').removeClass('fieldday_ajax_processing');
                        $('[id=km_cart_items_wrap]').removeClass('fieldday_ajax_processing');
                        if (actionfrom !== 'cart') {
                            $this.UpdateCart();
                        }
                        var countitme = $('.mobile_cart_count').text();
                        if (countitme < 1) {
                            $('.cart_bttn_mobile').addClass('mobile_cart_count_0');
                        } else {
                            $('.cart_bttn_mobile').removeClass('mobile_cart_count_0');
                        }
                    } else {
                        $this.DisplayAlert('error', 'error to get the cart information');
                    }
                });
            });
        },
        /*kidFormsinCart: function(){
         Â var formData = new FormData($('#km_add_to_cart_form')[0]);
         Â //formData.set('action', 'km_get_kid_form'); // not working in i.e 11
         Â $this.postFormData(fieldday_ajax.ajax_url+"?action=km_get_kid_form", formData, function (response) {
         Â $('.km_atc_kid_forms').html(response.content);
         Â $this.requiredfields();
         Â $this.fielddaySelect();
         Â });
         Â },*/
        cartOnScroll: function() {
            let displayheader = false;
            $('.km_addtocart_modal .km_modal_content').scroll(function() {
                if ($(this).scrollTop() < 50) {
                    displayheader = false;
                    //$('.km_modal_heading').hide();
                    $('.km_atc_header').show();
                }
                if (displayheader && $this.inRange($(this).scrollTop(), 45, 55)) {
                    return;
                }
                if ($(this).scrollTop() > 50) {
                    displayheader = true;
                    // $('.km_modal_heading').show();
                    $('.km_atc_header').hide();
                } else {
                    displayheader = false;
                    //$('.km_modal_heading').hide();
                    $('.km_atc_header').show();
                }
            });
        },
        updateDate: function(form) {
            $('.custom_dob_error').remove();
            var error = false;
            form.find('.km_dob_wrap').each(function() {
                var year = $(this).find('.km_date_year').val();
                var month = $(this).find('.km_date_month').val();
                var day = $(this).find('.km_date_day').val();
                var datestring = year + "-" + month + "-" + day;
                var date = moment(datestring);
                var agefrom = $(this).data('age-from');
                var ageto = $(this).data('age-to');
                var age = moment().diff(datestring, 'years', false);
                if (!date.isBefore(moment(), 'day') || !date.isValid()) {
                    $(this).append("<span class='custom_dob_error'>Date is invalid</span>");
                    error = true;
                }
                if (age < agefrom || age > ageto) {
                    $(this).find('.custom_dob_error').remove();
                    $(this).append("<span class='custom_dob_error'>Age limit for this activity is " + agefrom + "y - " + ageto + "y.</span>");
                    error = true;
                    $(this).find('.km_date_year').focus();
                }
                $(this).find('.km_hidden_dob').val(datestring);
            });
            if (error) {
                return false;
            } else {
                return true;
            }
        },
        updateSessionToCart: function(linkaddress) {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_cartitems", formData, function(response) {
                if (response.status == 'success') {
                    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                    if (isMobile) {
                        $this.updatefielddayCartMobile();
                        $('.cart_bttn_mobile').removeClass('mobile_cart_count_0');
                    } else {
                        //$this.updatefielddayCart();
                        $this.updatefielddayCart($('[id=km_cart_items_wrap]'));
                    }
                    var timer;
                    window.clearTimeout(timer);
                    timer = setTimeout(function() {
                        $("#km_cart_items_wrap").css("right", "-370px");
                    }, 5000);
                    $this.closepopup();
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        addSessionToWaitlist: function() {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            var form = $('#km_add_to_cart_form');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_waitlistitems", formData, function(response) {
                if (response.status == 'success') {
                    //$this.displayModal(response);
                    form.hide();
                    form.parents('.km_modal_content').find('.thank-you-section').show();
                    form.parents('.km_addtocart_modal').find('.km_modal_footer').hide();
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        addSessionToCart: function(linkaddress, checkoutRediect) {
            var formData = new FormData($('#km_add_to_cart_form')[0]);
            formData.append('checkoutRediect', checkoutRediect);
            //formData.set('action', 'km_set_cartitems');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_set_cartitems", formData, function(response) {
                if (response.status == 'success') {
                    //$this.closepopup();
                    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                    if (isMobile) {
                        $this.updatefielddayCartMobile();
                        $('.cart_bttn_mobile').removeClass('mobile_cart_count_0');
                    } else {
                        //$this.updatefielddayCart();
                        $this.updatefielddayCart($('[id=km_cart_items_wrap]'));
                    }
                    var timer;
                    window.clearTimeout(timer);
                    timer = setTimeout(function() {
                        $("#km_cart_items_wrap").css("right", "-370px");
                    }, 5000);
                    if (response.pageredirect) {
                        window.location.href = response.pageredirect + '?cart=true';
                    }
                    if (linkaddress) {
                        window.location.href = linkaddress;
                    } else {
                        $this.closepopup();
                    }
                    //$this.processSessionFilters(); 
                    if ($("#km_session_filter_form").length) {
                        $this.processSessionFilters();
                    }
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        updatefielddayCart: function(element) {
            if ($('.km_cart_page').length) {} else {
                $('#km_cart_items_wrap').css({
                    right: '0px'
                }).html('').addClass('fieldday_ajax_processing');
            }
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'get_cart_data'
            }, function(data) {
                if (data.status == 'success') {
                    if (element) {
                        element.html(data.content);
                    }
                    if ($("#km_cart_total_count").length) {
                        $('[id=km_cart_total_count]').html(data.items);
                    }
                    if ($("#KmStickyWidgetAddToCartIcon_total_count").length) {
                        $('[id=KmStickyWidgetAddToCartIcon_total_count]').html(data.items);
                    }
                } else {
                    $this.DisplayAlert('error', 'error to get the cart information');
                }
                $('[id=km_cart_items_wrap]').removeClass('fieldday_ajax_processing');
            }, true);
        },
        /*-- mobile cart view code start --*/
        updatefielddayCartMobile: function() {
            $('#km_cart_items_wrap_mobile').css({
                top: '10px',
                left: '10px',
                right: '10px'
            }).html('').addClass('fieldday_ajax_processing');
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'get_cart_data'
            }, function(data) {
                if (data.status == 'success') {
                    $('#km_cart_items_wrap_mobile').html(data.content);
                    $('.mobile_cart_count').html(data.items);
                    $('.cart_bttn_mobile').removeClass('mobile_cart_count_0');
                    $('#km_cart_items_wrap').html(data.content);
                    //$('#km_cart_total_count').html(data.items);
                    $('[id=km_cart_total_count]').html(data.items);
                    if ($("#KmStickyWidgetAddToCartIcon_total_count").length) {
                        $('[id=KmStickyWidgetAddToCartIcon_total_count]').html(data.items);
                    }
                } else {
                    $this.DisplayAlert('error', 'error to get the cart information');
                }
                $('#km_cart_items_wrap_mobile').removeClass('fieldday_ajax_processing');
                $('button.mobile_bttn').css({
                    display: 'none'
                });
                $('#km_cart_items_wrap_mobile a.km_btn').after("<p class='continue_shopping_cart'><a href='/purchase/'>Continue Shopping</a></p>");
                if (data.items > 3) {
                    $('#km_cart_items_wrap_mobile ul').css('height', "550px");
                } else {
                    $('#km_cart_items_wrap_mobile ul').css('height', "auto");
                }
            }, true);
        },
        /*-- mobile cart view code end --*/
        saveKidsIntoLocal: function() {
            var savedKids = JSON.parse($this.getCookie('km_saved_kids'));
            if (!savedKids) {
                savedKids = {};
            }
            var formData = $('#km_add_to_cart_form').serializeJSON();
            var kidsData = formData.ATC.kids;
            $.each(kidsData, function(index, Kid) {
                var schoolId = Kid.school;
                Kid.school = {};
                Kid.school._id = schoolId;
                savedKids[Kid._id] = Kid;
            });
            $this.setCookie('km_saved_kids', JSON.stringify(savedKids));
        },
        setCookie: function(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        },
        getTimezoneOffset: function() {
            const d = new Date();
            let offset = d.getTimezoneOffset();
            var sign = offset < 0 ? '' : '-';
            offset = Math.abs(offset);
            var offsetvalue = sign + offset;
            /*function z(n) {
                return (n < 10 ? '0' : '') + n
            }
            var offset = new Date().getTimezoneOffset();
            var sign = offset < 0 ? '' : '-';
            offset = Math.abs(offset);
            var offsetvalue = sign + z(offset / 60 | 0) + z(offset % 60);*/
            if (offsetvalue) {
                $this.setCookie('offset', offsetvalue);
            }
        },
        setGiftCardPurchaseInitialFormData: function() {
            let recipientname = localStorage.getItem('kmGiftCardPurchaseData_recipientname') || '';
            let kmGiftCardPurchaseData_sendername = localStorage.getItem('kmGiftCardPurchaseData_sendername') || '';
            let kmGiftCardPurchaseData_usergiftmsg = localStorage.getItem('kmGiftCardPurchaseData_usergiftmsg') || '';
            let recipientEmail = localStorage.getItem('kmGiftCardPurchaseData_recipientemail') || '';
            let parent_phone_gift_code = localStorage.getItem('kmGiftCardPurchaseData_recipientphone_code');
            let parent_phone_gift_org_number = localStorage.getItem('kmGiftCardPurchaseData_r_phone_org_no') || '';
            let kmGiftCardPurchaseData_recipientphone = localStorage.getItem('kmGiftCardPurchaseData_recipientphone') || '';
            let tempSendMethod = localStorage.getItem('kmGiftCardPurchaseData_sendmethod');
            let tempGiftAmount = localStorage.getItem('kmGiftCardPurchaseData_amount');
            let clickTriggerSpan = $('.km_giftsendoption .km_sendoption_value').filter(function() {
                return $(this).text().trim() === tempSendMethod;
            });
            let giftdesignNumber = localStorage.getItem('kmGiftCardPurchaseData_gft_img') || 1;
            var giftdesignCount = $('.km_single_giftcardpopup .km_single_giftdesign').length;
            if (giftdesignCount - 1 >= giftdesignNumber) {
                $('.km_single_giftcardpopup .km_single_giftdesign:eq(' + giftdesignNumber + ') img').trigger('click');
            } else {
                $('.km_single_giftcard .km_single_giftdesign:first-child img').trigger('click');
            }
            if (clickTriggerSpan.length > 0) {
                clickTriggerSpan.click();
            }
            let selectedOfferGift = $('.km_gift_values_wrap .km_gift_value').filter(function() {
                return $(this).text() === tempGiftAmount;
            });
            if (selectedOfferGift.length > 0) {
                selectedOfferGift.click();
            } else {
                let lastSpanOffer = $('.km_gift_values_wrap').find('.km_gift_value').last();
                $('.giftcardprice').text(tempGiftAmount);
                $('.input#km_gift_custom_amount').val(tempGiftAmount);
                lastSpanOffer.click();
            }
            $('.km_gift_frm_field #giftCardForm [name="recipientname"]').val(recipientname);
            $('.km_gift_frm_field #giftCardForm [name="recipient_email"]').val(recipientEmail);
            $('.km_gift_frm_field #giftCardForm [name="usergiftmsg"]').val(recipientEmail);
            $('.km_gift_frm_field #giftCardForm [name="sender_name"]').val(kmGiftCardPurchaseData_sendername);
            $('.km_gift_frm_field #giftCardForm [name="usergiftmsg"]').val(kmGiftCardPurchaseData_usergiftmsg);
            if (parent_phone_gift_code && parent_phone_gift_code != '') {
                $('.km_gift_frm_field #giftCardForm [name="parent_phone_gift_code"]').val(parent_phone_gift_code);
                $('.km_gift_frm_field #giftCardForm [name="parent_phone_gift_org_number"]').val(parent_phone_gift_org_number);
                $('.km_gift_frm_field #giftCardForm [name="recipient_phone"]').val(parent_phone_gift_org_number);
            }
        },
        getCookie: function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },
        /*display_atc_next_step: function () {
         Â if ($atcstep <= $maxstepnumber) {
         Â $atcstep++;
         Â $this._display_step();
         Â }

         Â },*/
        /*_display_step: function () {
         Â if ($atcstep >= $minstepnumber && $atcstep <= $maxstepnumber) {
         Â $('.atc_next_step').html(fieldday_ajax.atc_next_btn).show();
         Â $('.atc_prev_step').html(fieldday_ajax.atc_prev_btn).show();

         Â if ($atcstep == $minstepnumber) {
         Â $('.atc_prev_step').hide();
         Â }

         Â if ($atcstep == $maxstepnumber) {
         Â //$('.atc_next_step').html(fieldday_ajax.add_to_cart_btn);
         Â //$('.km_modal_footer').hide();
         Â $('.km_atc_laststep_btn').removeClass('km_hidden');
         Â $('.atc_next_step').hide();
         Â $('.atc_prev_step').text('Back');
         Â }else {
         Â //$('.km_modal_footer').show();
         Â $('.km_atc_laststep_btn').addClass('km_hidden');
         Â }
         Â $('.add_to_cart_step').hide();
         Â $('#add_to_cart_step_' + $atcstep).show();
         Â var steptitle = $('#add_to_cart_step_' + $atcstep).data('step-title');
         Â $('.km_modal_heading').html(steptitle);
         Â $("#modal-large").removeClass('modal-large');
         Â var modalCllass = $('#add_to_cart_step_' + $atcstep).data('modal-class');
         Â $('#km_modal').removeClass('modal-normal modal-large').addClass(modalCllass);
         Â }
         Â },*/
        /*display_atc_prev_step: function () {
         Â var parentKidsCount = $('.kids-pop-listing .kid-pop-single').length;
         Â if($atcstep == 3 && parentKidsCount == 0) {
         Â $atcstep--;
         Â }
         Â if ($atcstep >= $minstepnumber) {
         Â $atcstep--;
         Â $this._display_step();
         Â }

         Â },*/
        inRange: function(n, nStart, nEnd) {
            if (n >= nStart && n <= nEnd) return true;
            else return false;
        },
        registerSession: function(sessionId, tagId, sessionDate, sessionfeatured, Waitlist) {
            //var waitlistType = Waitlist; //$(button).attr('data-type');
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_display_cartform',
                sessionId: sessionId,
                tagId: tagId,
                sessionDate: sessionDate,
                sessionfeatured: sessionfeatured,
                waitlist: Waitlist
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-large km_addtocart_modal');
                    if ($('.km_guest_personalinfo').length) {
                        $('.km_add_to_cart,.km_cartguest_back').css('display', 'none');
                        $('.km_cartguest_continue').css('display', 'inline-block');
                    } else {
                        $('.km_cartguest_continue , .km_cartguest_back').css('display', 'none');
                        $('.km_add_to_cart').css('display', 'inline-block');
                    }
                    //$('.km_modal_heading').hide();
                    AtcsessionId = sessionId;
                    AtctagId = tagId;
                    AtcsessionDate = sessionDate;
                    $this.scrollTo();
                    $this.requiredfields();
                    $this.BookingSelection();
                    $this.BookingCalander();
                    $this.MultiWeekBookingCalander();
                    $this.cartOnScroll();
                    $this.checkoutpageevents();
                    $this.fielddaySessionTime();
                    $this.PhoneInput();
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        registerEvent: function(sessionId, tagId, sessionDate, sessionfeatured) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_display_eventcartform',
                sessionId: sessionId,
                tagId: tagId,
                sessionDate: sessionDate,
                sessionfeatured: sessionfeatured
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-large km_addtocart_modal km_event_modal');
                    //$('.km_modal_heading').hide();
                    AtcsessionId = sessionId;
                    AtctagId = tagId;
                    AtcsessionDate = sessionDate;
                    $this.requiredfields();
                    $this.PhoneInput();
                    $this.cartOnScroll();
                    $this.fielddaySessionTime();
                    $this.inputincrement();
                    $this.fielddaySessionTime();
                    $this.checkoutpageevents();
                    $this.AddressAutoComplete();
                    /*if($('#address_autocomplete').length){
                    var input = document.getElementById('address_autocomplete');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    }*/
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        registerPackage: function(sessionId, packageId) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_display_packageform',
                sessionId: sessionId,
                packageId: packageId,
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-large km_package_modal km_addtocart_modal');
                    $('.package_payment_section, .km_package_btns').hide();
                    var json = [response.prices];
                    $('.store_json').attr('data-json', JSON.stringify(json));
                    //$('.km_modal_heading').hide();
                    AtcpackageId = packageId;
                    AtcsessionId = sessionId;
                    $this.requiredfields();
                    $this.cartOnScroll();
                    $this.checkoutpageevents();
                    $this.fielddaySessionTime();
                    $this.AddressAutoComplete();
                    /*var input = document.getElementById('address_autocomplete');
                    var autocomplete = new google.maps.places.Autocomplete(input);*/
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        InstallmentPlans: function(sessionId, tagId, sessionDate, sessionfeatured) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_display_plans',
                sessionId: sessionId,
                tagId: tagId,
                sessionDate: sessionDate,
                sessionfeatured: sessionfeatured
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-large km_addtocart_modal');
                    //$('.km_modal_heading').hide();
                    AtcsessionId = sessionId;
                    AtctagId = tagId;
                    AtcsessionDate = sessionDate;
                    $this.requiredfields();
                    $this.cartOnScroll();
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        siblingDiscount: function(elem, event) {
            var formData = new FormData();
            if ($(elem).is(':checked')) {
                formData.set('astatus', 'apply');
            } else {
                formData.set('astatus', 'remove');
            }
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_apply_sibling_discount", formData, function(response) {
                if (response.status == 'success') {
                    $this.UpdateCart();
                } else {
                    $this.kmRemoveLoader();
                    $this.DisplayAlert('error', response.message);
                }
            }, true);
        },
        merchandiseevents: function() {
            $(document).on('change', '.km_merchandise', function() {
                if ($(this).is(':checked')) {
                    $('.km_session_type').prop('checked', false);
                    var layout = $('#layoutdesign').val();
                    $this.makeCall(fieldday_ajax.ajax_url, {
                        action: 'km_get_bankdays',
                        data: layout
                    }, function(response) {
                        if (response.status == 'success') {
                            $('.km_provider_sessions').hide();
                            $('.km_provider_merchandise').html(response.content).show();
                            /*var newUrl = $this.addQueryVar(location.href, 'merchandise', true);
                             Â history.pushState({}, null, newUrl);*/
                        } else if (response.status == 'fail') {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                } else {
                    //$this.processSessionFilters();
                    if ($("#km_session_filter_form").length) {
                        $this.processSessionFilters();
                    }
                    //var tagId = $('.filter_type:checked').val();
                    //filter_posts(tagId);
                }
            });
            $(document).on('click', '.purchase_merchandise', function() {
                $('#fieldday_merchandise_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'merchandise_field'
                }).done(function() {
                    $this.StripeProcess($('#fieldday_merchandise_form'), function(response) {
                        if (response.error) {
                            $this.DisplayAlert('error', response.error.message);
                            $this.km_btn_RemoveLoader("km_purchase_merchandise_pc");
                            $this.kmRemoveLoader();
                        } else {
                            $("#fieldday_merchandise_form .merchandise_stripeToken").val(response.id);
                            var formData = new FormData($('#fieldday_merchandise_form')[0]);
                            //formData.set('stripeToken', response.id);
                            //formData.set('action', 'km_merchandise_process');
                            //formData.set('paymentMethod', 'card');
                            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_merchandise_process", formData, function(response) {
                                if (response.status == 'success') {
                                    $this.displayModal(response);
                                } else {
                                    $this.DisplayAlert('error', response.message);
                                }
                            }, '', 'km_purchase_merchandise_pc');
                        }
                    }, true, 'km_purchase_merchandise_pc');
                });
            });
        },
        registerSessionTiming: function(button, event) {
            var formdata = {
                action: 'km_registerSessionTiming'
            };
            var sessionId = $(button).data('session-id');
            var sessionfeatured = $(button).data('session-featured');
            var offerId = $(button).data('offer-id');
            var offername = $(button).data('offer-name');
            if (sessionId) {
                var tagId = $(button).data('tag-id');
                var sessionDate = $(button).data('session-date');
                formdata.session_id = sessionId;
                formdata.tagId = tagId;
                formdata.session_date = sessionDate;
                formdata.sessionfeatured = sessionfeatured;
                AtcsessionId = sessionId;
                AtctagId = tagId;
                AtcsessionDate = sessionDate;
            }
            if (offerId) {
                formdata.offerId = offerId;
                formdata.offername = offername;
                AtcOfferId = offerId;
                AtcOffername = offername;
            }
            $this.makeCall(fieldday_ajax.ajax_url, formdata, function(response) {
                $this.displayModal(response, 'modal-large');
                $this.fielddaySessionTime();
            });
        },
        hasCart: function() {
            //var path=window.location.origin;
            var rediectPage = document.URL.split('?')[1];
            if (rediectPage == 'cart=true') {
                //$this.updatefielddayCart();
                $this.updatefielddayCart($('[id=km_cart_items_wrap]'));
                setTimeout(function() {
                    $("#km_cart_items_wrap").css("right", "-370px");
                }, 5000);
            }
            $('body').on('click', '#sessiontimenext', function() {
                var sessionDate = [];
                var sessionid;
                var sessiontag;
                var sessionfeatured;
                jQuery(':checkbox:checked').each(function(i) {
                    sessionfullweek = jQuery(this).data('sessionfullweek');
                    if (sessionfullweek) {
                        sessionDate = '';
                    } else {
                        sessionDate.push(this.value);
                    }
                    sessionid = jQuery(this).data('session-id');
                    sessiontag = jQuery(this).data('session-tag');
                    sessionfeatured = jQuery(this).data('session-featured');
                });
                if (sessionid != undefined) {
                    $this.registerSession(sessionid, sessiontag, sessionDate, sessionfeatured);
                } else {
                    $this.DisplayAlert('error', 'Please Select Date!');
                }
            });
        },
        countItmeCart: function() {
            var countitme = $('.mobile_cart_count').text();
            if (countitme < 1) {
                $('.cart_bttn_mobile').addClass('mobile_cart_count_0');
            } else {
                $('.cart_bttn_mobile').removeClass('mobile_cart_count_0');
            }
            if (countitme > 4) {
                $('#km_cart_items_wrap_mobile ul').css('height', "550px");
            } else {
                $('#km_cart_items_wrap_mobile ul').css('height', "auto");
            }
            var countitmedesktop = $('#km_cart_total_count').text();
            if (countitme > 4) {
                $('#km_cart_items_wrap ul').css('height', "550px");
            } else {
                $('#km_cart_items_wrap ul').css('height', "auto");
            }
        },
        registermerchandise: function(offerId, offername) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_merchandise_form',
                offerId: offerId,
                offername: offername
            }, function(response) {
                $this.displayModal(response, response.modalclass);
                AtcOfferId = offerId;
                AtcOffername = offername;
                $this.requiredfields();
                $this.PhoneInput();
                $this.CardInput();
            });
        },
        kmRemoveExtraSpacesFromValue: function(input, event, waitBeforeExecution = false, delay = false) {
            clearTimeout(kmIncrementTimer);
            let removeExtraSpace = () => {
                event.target.value = event.target.value.trim();
                event.target.value = event.target.value.replace(/http:|https:|script|src=|\/|\.js|<|>/gi, '');
            }
            if (waitBeforeExecution) {
                if (!delay) {
                    kmIncrementTimer = setTimeout(removeExtraSpace, 2000);
                } else {
                    kmIncrementTimer = setTimeout(removeExtraSpace, delay);
                }
            } else {
                if (!delay) {
                    kmIncrementTimer = setTimeout(removeExtraSpace, 1700);
                } else {
                    kmIncrementTimer = setTimeout(removeExtraSpace, delay);
                }
            }
        },
        login: function(button, event, id = '') {
            event.preventDefault();
            let button_id = event.target.id;
            $(button).parents('form').parsley($this.settings.parsley_valiation_options_register).whenValidate({
                group: 'km_login'
            }).done(function() {
                var formData = new FormData($('#km_login_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.isGuest && !AtcIspackage) {
                        window.location.reload();
                    } else {}
                    $this.afterLogin(response, button, button_id);
                }, true, button_id);
            });
        },
        LoginWithFacebook: function() {
            let cookiesession = $this.getCookie('sessionclicked');
            if (cookiesession) {
                open_session = cookiesession;
            }
            var data = {
                action: 'km_social_login',
                AuthCode: $code,
                client: 'facebook',
                openpopup: open_session,
            };
            $this.makeCall(fieldday_ajax.ajax_url, data, function(response) {
                $this.afterLogin(response);
            });
        },
        LoginWithGoogle: function() {
            let cookiesession = $this.getCookie('sessionclicked');
            if (cookiesession) {
                open_session = cookiesession;
            }
            var data = {
                action: 'km_social_login',
                AuthCode: $code,
                client: 'google',
                openpopup: open_session,
            };
            $this.makeCall(fieldday_ajax.ajax_url, data, function(response) {
                $this.afterLogin(response);
            });
        },
        register: function(button, event) {
            event.preventDefault();
            $(button).parents('form').parsley($this.settings.parsley_valiation_options_register).whenValidate({
                group: 'register'
            }).done(function() {
                var formData = new FormData($('#km_register_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url, formData, function(response) {
                    $this.afterLogin(response, button, 'signup-submit');
                }, '', 'signup-submit');
            });
        },
        updateParent: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'profile_fields'
                }).done(function() {
                    var formData = new FormData($('#profile_update')[0]);
                    //formData.set('action', 'km_update_profile');
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_profile", formData, function(response) {
                        if (response.status == 'success') {
                            $this.DisplayMessage(button, 'success', response.message);
                        } else {
                            $this.DisplayMessage(button, 'error', response.message);
                        }
                    });
                });
            }
        },
        updatePassword: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                var formData = new FormData($('#km_reset_password_form')[0]);
                //formData.set('action', 'km_update_password');
                if (jQuery('#km_reset_password_form').parsley().validate()) {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_password", formData, function(response) {
                        if (response.status == 'success') {
                            $('#km_reset_password_form')[0].reset();
                            $this.DisplayMessage(button, 'success', response.message);
                        } else {
                            $this.DisplayMessage(button, 'error', response.message);
                        }
                    });
                } else {
                    $this.DisplayMessage(button, 'error', 'Please fill all the related details.');
                }
            }
        },
        profileForm: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                var id = $(button).attr('id');
                var dataId = $(button).data('id');
                var formData = {
                    'page': id,
                    'action': 'km_profile_tab',
                    dataId: dataId
                };
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_tab_data').html('');
                        $('.km_nav_link').removeClass('km_active');
                        $('.km_nav_link').removeClass('km_primary_color');
                        $(button).addClass('km_active');
                        $(button).addClass('km_primary_color');
                        $('.km_tab_data').html(response.content);
                        $this.PhoneInput();
                        $this.requiredfields();
                        $this.fielddaySelect();
                        $this.fielddaySessionTime();
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
            if ($(".km_view_all_prctpants_pg_ctm_new").length) {
                $(".km_view_all_prctpants_pg_ctm_new").toggleClass("open-sidebar");
            }
        },
        creditStatementFilter: function(button, isPerdayCredit) {
            $('.km_credit_filter').removeClass('km_cred_filter_active');
            $('.km_credit_filter').removeClass('km_primary_bg');
            $('.km_credit_filter').removeClass('km_primary_color');
            $(button).addClass('km_cred_filter_active');
            $(button).addClass('km_primary_bg');
            var formData = {
                'page': 'store_statement',
                'action': 'km_profile_tab',
                isPerdayCredit: isPerdayCredit
            };
            $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                if (response.status == 'success') {
                    $('.km_tab_data').html('');
                    $('.km_tab_data').html(response.content);
                    $('.km_credit_filter').removeClass('km_cred_filter_active');
                    $('.km_credit_filter').removeClass('km_primary_bg');
                    $('.km_credit_filter').addClass('km_primary_color');
                    if (isPerdayCredit == 'true') {
                        $('.km_day_credit').addClass('km_cred_filter_active');
                        $('.km_day_credit').addClass('km_primary_bg');
                        $('.km_day_credit').removeClass('km_primary_color');
                    } else if (isPerdayCredit == 'false') {
                        $('.km_dollar_credit').addClass('km_cred_filter_active');
                        $('.km_dollar_credit').addClass('km_primary_bg');
                        $('.km_dollar_credit').removeClass('km_primary_color');
                    }
                } else if (response.status == 'fail') {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        ajaxPurchase: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                $('.km_pagination li').removeClass('km_pagination_active');
                $(button).find('a').addClass('km_primary_color');
                $(button).addClass('km_pagination_active');
                var pagenumber = $(button).data('page');
                var action = 'km_get_purchase';
                var formData = {
                    'pagenumber': pagenumber,
                    'action': 'km_get_purchase'
                };
                $('.km_pagination_active').find('a').removeClass('km_primary_color');
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_tab_data').html('');
                        $('.km_tab_data').html(response.content);
                        $('.km_pagination_active').find('a').removeClass('km_primary_color');
                        $this.fielddaySessionTime();
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        ajaxPagination: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                $('.km_pagination li').removeClass('km_pagination_active');
                $(button).find('a').addClass('km_primary_color');
                $(button).addClass('km_pagination_active');
                $('.km_pagination_active').find('a').removeClass('km_primary_color');
                var pagenumber = $(button).data('page');
                var action = 'km_get_purchase';
                var formData = {
                    'pagenumber': pagenumber,
                    'action': 'km_get_pagination'
                };
                $this.makeCall(fieldday_ajax.ajax_url, formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_pagination_data').html('');
                        $('.km_pagination_data').html(response.content);
                        $('.km_pagination_active').find('a').removeClass('km_primary_color');
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        readURL: function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).parents('.profile-pic-upload').find('.preview-img').attr('src', e.target.result).show();
                    $(input).parents('.profile-pic-upload').find('.km_default_avatar').hide();
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        afterLogin: function(response, button, target_button_id = '') {
            var extraParam = null;
            if ($state) {
                extraParam = $state.split('_');
            } else {
                extraParam = [];
            }
            if (response.status == 'success') {
                if (target_button_id && target_button_id != '') {
                    $this.km_btn_RemoveLoader(target_button_id);
                }
                if (extraParam[1]) {
                    AtcsessionId = extraParam[1];
                }
                if (extraParam[4]) {
                    AtcOfferId = extraParam[4];
                }
                if (button) {
                    $this.DisplayMessage(button, 'success', response.message);
                }
                if (response.popup) {
                    window.location.replace(window.location.href + "?session=" + response.popup);
                }
                if (AtcOfferId) {
                    $this.registermerchandise(AtcOfferId, AtcOffername);
                    $isKmUser = true;
                    $this.updateMenu();
                } else if (AtcsessionId && !AtcIspackage && AtcIsEvent !== 'event') {
                    if (extraParam[2]) {
                        AtctagId = extraParam[2];
                        $(".km_session_type[value=" + AtctagId + "]").prop('checked', true).trigger('change');
                    }
                    if (extraParam[3]) {
                        AtcsessionDate = extraParam[3];
                    }
                    var IsWaitlist = '';
                    if (AtcIsEvent == 'waitlist') {
                        var IsWaitlist = AtcIsEvent;
                    }
                    $this.registerSession(AtcsessionId, AtctagId, AtcsessionDate, response.sessionfeatured, IsWaitlist);
                    $isKmUser = true;
                    $this.updateMenu();
                } else if (AtcIspackage) {
                    $this.registerPackage(AtcsessionId);
                    $isKmUser = true;
                    $this.updateMenu();
                } else if (AtcIsEvent == 'event') {
                    $this.registerEvent(AtcsessionId);
                    $isKmUser = true;
                    $this.updateMenu();
                } else {
                    if (response.redirect) {
                        window.location = response.redirect;
                    } else if (response.redirect_page_) {
                        window.location = response.redirect_page_;
                    }
                }
            } else if (response.status == 'varificationsent') {
                if (target_button_id && target_button_id != '') {
                    $this.km_btn_RemoveLoader(target_button_id);
                }
                $this.kmRemoveLoader();
                $this.displayModal(response, 'km_addtocart_modal verification_popup');
                $this.OtpInput();
                $this.PhoneInput();
                //$this.closePhoneUpdate();
                $this.OTPTimer($otptimer, true);
            } else if (response.status == 'nophone') {
                if (target_button_id && target_button_id != '') {
                    $this.km_btn_RemoveLoader(target_button_id);
                }
                $this.kmRemoveLoader();
                $this.displayModal(response);
                $this.OtpInput();
                $this.PhoneInput();
                //$this.openPhoneUpdate();
            } else {
                if (target_button_id && target_button_id != '') {
                    $this.km_btn_RemoveLoader(target_button_id);
                }
                $this.kmRemoveLoader();
                if (button) {
                    $this.DisplayMessage(button, 'error', response.message);
                } else {
                    alert(response.message);
                }
            }
            try {
                if (widgetId) {
                    grecaptcha.reset(widgetId);
                } else {
                    grecaptcha.reset();
                }
            } catch (err) {}
        },
        deleteSavedCard: function(cardId) {
            var isConfirmed = confirm("Are you sure to delete this card?");
            if (isConfirmed) {
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_delete_saved_card',
                    cardId: cardId
                }, function(response) {
                    if (response.status == 'success') {
                        $('#saved_cards').trigger('click');
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        newCardForm: function(cardId) {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_card_form',
                cardId: cardId
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'add_nwcrd_km_mdl_cls');
                    $this.CardInput();
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        addNewCard: function() {
            $('#km_card_form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: 'add_new_card'
            }).done(function() {
                $this.StripeProcess($('#km_card_form'), function(response) {
                    if (response.error) {
                        $this.DisplayAlert('error', response.error.message);
                    } else {
                        $('#_stripeToken').val(response.id);
                        var formData = new FormData($('#km_card_form')[0]);
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_save_card", formData, function(response) {
                            if (response.status == 'success') {
                                $this.DisplayAlert('success', response.message);
                                $('#saved_cards').trigger('click');
                                $this.closepopup();
                            } else {
                                $this.DisplayAlert('error', response.message);
                            }
                        });
                    }
                });
            });
        },
        setDefaultCard: function(cardId) {
            var isConfirmed = confirm("Are you sure to set this card as default?");
            if (isConfirmed) {
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'km_setdefault_card',
                    cardId: cardId
                }, function(response) {
                    if (response.status == 'success') {
                        $('#saved_cards').trigger('click');
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        updateMenu: function() {
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_getmenu_data'
            }, function(response) {
                if (response.status == 'success') {
                    if (!$("#menu_item_km_userinfo").length) {
                        let menuId = $('#' + response.menuId);
                        if ($('#' + response.menuId).length == 0) {
                            menuId = $('#' + response.slug);
                        }
                        menuId.append(response.html);
                        $('body').append(response.afterLoginScript);
                    }
                }
            }, true);
        },
        verifyOtp: function(button, event) {
            event.preventDefault();
            var formData = new FormData($('#km_verification_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_verify_otp", formData, function(response) {
                if (response.status == 'success') {
                    $this.DisplayMessage(button, 'success', response.message);
                    $this.afterLogin(response);
                } else {
                    $this.DisplayMessage(button, 'error', response.message);
                }
            });
        },
        LoginverifyOTP: function(button, event) {
            event.preventDefault();
            var formData = new FormData($('#km_verification_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_login_verify_otp", formData, function(response) {
                if (response.status == 'success') {
                    $this.DisplayMessage(button, 'success', response.message);
                    $this.afterLogin(response, '', 'km_verify_submit');
                } else {
                    $this.km_btn_RemoveLoader('km_verify_submit');
                    $this.DisplayMessage(button, 'error', response.message);
                }
            }, '', 'km_verify_submit');
        },
        OtpInput: function() {
            $(document).on('keyup', '.km_otp_number', function(event) {
                // check for hyphen
                $('.otp_number_error').text('');
                if (event.which == 8) {
                    $(this).prev('.km_otp_number').focus();
                } else {
                    if ($(this).val().length >= 1) {
                        event.preventDefault();
                        if ($(this).next('.km_otp_number')) {
                            if (/\D/g.test(this.value)) {
                                // Filter non-digits from input value.
                                this.value = this.value.replace(/\D/g, '');
                                $('.otp_number_error').text('Please enter all 4 digits');
                            } else {
                                $(this).next('.km_otp_number').focus();
                            }
                        } else {
                            $(this).blur();
                        }
                    }
                }
            });
        },
        updatePhone: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                var formData = new FormData($('#km_newphone_form')[0]);
                //formData.set('action', 'km_update_phone');
                $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                    group: 'newphone_update'
                }).done(function() {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_update_phone", formData, function(response) {
                        if (response.status == 'success') {
                            $this.displayModal(response);
                            $this.DisplayMessage(button, 'success', response.message);
                            $this.OTPTimer($otptimer, true);
                            $this.PhoneInput();
                            $this.closePhoneUpdate();
                        } else {
                            $this.DisplayMessage(button, 'error', response.message);
                        }
                    });
                });
            }
        },
        otpEvents: function() {
            $(document).on('change', '.km_verify_code_type', function(e) {
                var verificationType = $(this).val();
                $('.km_verifcatio_hl_txt').removeClass('km_hidden');
                $('.km_inline_message').hide();
                $this.OTPTimer(0, true);
                if (verificationType == 'sms') {
                    var IsEmailattr = $(this).attr('data-email');
                    if (typeof IsEmailattr !== 'undefined') {
                        $this.LoginresendOtp($(this), e);
                    } else {
                        $this.resendOtp($(this), e);
                    }
                    $('.km_verification_via_email .km_verifcatio_hl_txt').addClass('km_hidden');
                } else if (verificationType == 'email') {
                    var IsEmailattr = $(this).attr('data-email');
                    if (typeof IsEmailattr !== 'undefined') {
                        $this.LoginresendOtp($(this), e);
                    } else {
                        $this.resendOtp($(this), e);
                    }
                    $('.km_verification_via_sms .km_verifcatio_hl_txt').addClass('km_hidden');
                }
            });
        },
        resendOtp: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                var formData = new FormData($('#km_verification_form')[0]);
                //formData.set('action', 'km_resend_otp');
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_resend_otp", formData, function(response) {
                    if (response.status == 'success') {
                        $this.DisplayMessage(button, 'success', response.message);
                        $this.OTPTimer($otptimer, true);
                        $this.PhoneInput();
                        $this.closePhoneUpdate();
                    } else {
                        $this.DisplayMessage(button, 'error', response.message);
                    }
                });
            }
        },
        LoginresendOtp: function(button, event) {
            event.preventDefault();
            if (!$(button).hasClass('disabled')) {
                var formData = new FormData($('#km_verification_form')[0]);
                //formData.set('action', 'km_resend_otp');
                var isEmailOTP = $(button).attr('data-email');
                formData.set('isEmailOTP', isEmailOTP);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_loginresend_otp", formData, function(response) {
                    if (response.status == 'success') {
                        $this.DisplayMessage(button, 'success', response.message);
                        $this.OTPTimer($otptimer, true);
                        $this.PhoneInput();
                        $this.closePhoneUpdate();
                    } else {
                        $this.DisplayMessage(button, 'error', response.message);
                    }
                });
            }
        },
        OTPTimer: function(remaining, resettimer) {
            if (resettimer && $timer) {
                clearTimeout($timer);
            }
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            //document.getElementById('timer').innerHTML = m + ':' + s;
            $('.km_verification_form .otp_timer').html(m + ':' + s).show();
            remaining -= 1;
            if (remaining >= 0 && $timerOn) {
                $timer = setTimeout(function() {
                    $('.km_verification_form .resend_otp').addClass('disabled');
                    $this.OTPTimer(remaining);
                }, 1000);
                return;
            }
            if (!$timerOn) {
                // Do validate stuff here
                return;
            }
            $('.km_verification_form .otp_timer').html('');
            $('.km_verification_form .resend_otp').removeClass('disabled');
        },
        openPhoneUpdate: function() {
            $('.km_otp_verification_wrap').hide();
            $('.km_updatephone_wrap').show();
        },
        closePhoneUpdate: function() {
            jQuery('.km_otp_number').val('');
            $('.km_otp_verification_wrap').show();
            $('.km_updatephone_wrap').hide();
        },
        DateInput: function() {
            $('.km_date_field').datepicker({
                format: 'mm-dd-yy',
                minDate: 0
            });
        },
        kmProviderCountryCode: function() {
            let countryCode = fieldday_ajax.fieldday_provider_dial_code;
            if (typeof countryCode == 'undefined') {
                countryCode = '1';
            }
            return countryCode;
        },
        /*PhoneInput: function() {
            $(".km_phone_field").each(function() {
                var objectid = $(this).attr('id');
                var inputphone = document.querySelector("#" + objectid);
                var country_phone_code = $("#" + objectid).parents('.km_field_wrap').find('.country_code').val();
                var country_code = 'us';
                if (country_phone_code) {
                    var usercountrycode = fieldday.settings.allCountries[country_phone_code];
                    if (typeof usercountrycode !== 'undefined') {
                        country_code = usercountrycode;
                    }
                }
                if (objectid) {
                    var iti = window.intlTelInput(inputphone, {
                        initialCountry: country_code,
                        placeholderNumberType: 'FIXED_LINE',
                    });
                    inputphone.addEventListener("countrychange", function(e) {
                        var dialCode = iti.getSelectedCountryData().dialCode;
                        country_code = iti.getSelectedCountryData().iso2;
                        $("#" + objectid).parents('.km_field_wrap').find('.country_code').val(dialCode);
                    });
                    inputphone.addEventListener("keyup", function(e) {
                        var phone = this.value.replace(/ /g, '');
                        $("#" + objectid).parents('.km_field_wrap').find('.phone_number').val(phone);
                    });
                }
                var iso2 = country_code.toUpperCase();
                new Cleave(inputphone, {
                    phone: true,
                    phoneRegionCode: iso2
                });
            });
        },*/
        PhoneInput: function() {
            $(".km_phone_field").each(function() {
                var objectid = $(this).attr('id');
                var inputphone = document.querySelector("#" + objectid);
                var country_phone_code = $("#" + objectid).parents('.km_field_wrap').find('.country_code').val();
                var country_code = fieldday_ajax.fieldday_provider_country_code;
                if (typeof country_code == 'undefined') {
                    country_code = 'US';
                }
                if (country_phone_code) {
                    var usercountrycode = fieldday.settings.allCountries[country_phone_code];
                    if (typeof usercountrycode !== 'undefined') {
                        country_code = usercountrycode;
                    }
                    if ($('.users_countrycode').length) {
                        var country_code = $("#" + objectid).parents('.km_field_wrap').find('.users_countrycode').val();
                    }
                }
                if (objectid) {
                    var iti = window.intlTelInput(inputphone, {
                        initialCountry: country_code,
                        placeholderNumberType: 'FIXED_LINE',
                    });
                    inputphone.addEventListener("countrychange", function(e) {
                        var dialCode = iti.getSelectedCountryData().dialCode;
                        country_code = iti.getSelectedCountryData().iso2;
                        $("#" + objectid).parents('.km_field_wrap').find('.country_code').val(dialCode);
                        if ($('.users_countrycode').length) {
                            $("#" + objectid).parents('.km_field_wrap').find('.users_countrycode').val(country_code);
                        }
                        var phone = this.value.replace(/ /g, '');
                        $("#" + objectid).parents('.km_field_wrap').find('.phone_number').val(phone);
                        //remove value from input
                        this.value = '';
                        $("#" + objectid).parents('.km_field_wrap').find('.phone_number').val('');
                        //remove value from input end
                        //kmcleavePhone.setPhoneRegionCode(country_code.toUpperCase());
                        //kmcleavePhone.setRawValue("");
                        kmcleavePhone = new Cleave(inputphone, {
                            phone: true,
                            phoneRegionCode: country_code.toUpperCase()
                        });
                    });
                    inputphone.addEventListener("keyup", function(e) {
                        var phone = this.value.replace(/ /g, '');
                        $("#" + objectid).parents('.km_field_wrap').find('.phone_number').val(phone);
                        //check pattern while input
                        clearTimeout(kmIncrementTimer);
                        let doTempPatternChange = () => {
                            var country_code_test = iti.getSelectedCountryData().iso2;
                            //kmcleavePhone.setPhoneRegionCode(country_code.toUpperCase());
                            //kmcleavePhone.setRawValue("");
                            kmcleavePhone = new Cleave(inputphone, {
                                phone: true,
                                phoneRegionCode: country_code.toUpperCase()
                            });
                        }
                        kmIncrementTimer = setTimeout(doTempPatternChange, 100);
                        //check pattern while input end
                    });
                }
                if (country_code) {
                    var iso2 = country_code.toUpperCase();
                } else {
                    iso2 = fieldday_ajax.fieldday_provider_country_code;
                    if (typeof iso2 == 'undefined') {
                        iso2 = 'US';
                    }
                }
                kmcleavePhone = new Cleave(inputphone, {
                    phone: true,
                    phoneRegionCode: iso2
                });
            });
        },
        CardInput: function() {
            $(".km_card_number").each(function() {
                var objectid = $(this).attr('id');
                var _this = $(this);
                var inputcard = document.querySelector("#" + objectid);
                if (objectid) {
                    new Cleave(inputcard, {
                        creditCard: true,
                        onCreditCardTypeChanged: function(type) {
                            _this.next().removeAttr('class');
                            _this.next().addClass("km_card_type " + type);
                            //document.querySelector("." + objectid).innerHTML = '<i class="fa fa-cc-' + type + ' fa-fw fa-2x active" aria-hidden="true"></i>';
                        }
                    });
                }
            });
        },
        ClearSessionFilters: function(formId) {
            $(window).bind("pageshow", function() {
                // update hidden input field
                if ($(formId).length) {
                    $(formId)[0].reset();
                }
            });
        },
        fielddaySessionTime: function() {
            if ($('.km_session_single_item, .km_package_detail, .km_elem_dt,.km_km_order-placed').length) {
                $('.km_session_single_item, .km_package_detail, .km_elem_dt,.km_km_order-placed').each(function() {
                    var dateFrom = $(this).attr('data-time-stamp-from'),
                        dateTo = $(this).attr('data-time-stamp-to'),
                        programMonth = $(this).find('.km_session_month'),
                        programYear = $(this).find('.km_session_year'),
                        programFullDate = $(this).find('.km_session_fulldate'),
                        programFullDate_order = $(this).find('.km_session_fulldate_order'),
                        programTime = $(this).find('.km_sess_time'),
                        programTime_order = $(this).find('.km_sess_time_order'),
                        km_session_month_wd_strt_andd_year = $(this).find('.km_session_month_wd_strt_andd_year'),
                        //Month From
                        convertedMonthFrom = moment.utc(dateFrom).local().format('MMM DD'),
                        //Month To
                        convertedMonthTo = moment.utc(dateTo).local().format('MMM DD'),
                        //Year
                        convertedYear_From = moment.utc(dateFrom).local().format('YYYY'),
                        convertedYear = moment.utc(dateTo).local().format('YYYY'),
                        //Time From
                        convertedTimeFrom = moment.utc(dateFrom).local().format('h:mm a'),
                        //Time To
                        convertedTimeTo = moment.utc(dateTo).local().format('h:mm a');
                    if (dateFrom && dateTo) {
                        $(programMonth).html(convertedMonthFrom + ' - ' + convertedMonthTo);
                        programFullDate.html(convertedMonthFrom + ', ' + convertedYear + ' - ' + convertedMonthTo + ', ' + convertedYear);
                        programFullDate_order.html(convertedMonthFrom + ', ' + convertedYear_From + ' - ' + convertedMonthTo + ', ' + convertedYear);
                        $(programYear).html(convertedYear);
                        $(programTime).html(convertedTimeFrom + ' - ' + convertedTimeTo);
                        $(programTime_order).html(convertedTimeFrom + ' - ' + convertedTimeTo);
                        $(km_session_month_wd_strt_andd_year).html(convertedMonthFrom + ', ' + convertedYear_From);
                    }
                });
            }
        },
        InitSessionFilter: function() {},
        process_personal_info: function(button, event) {
            event.preventDefault();
            var form = $(button).parents('form');
            $totalkids = form.find('.km_parent_kids').val();
            var group = $(button).data('group');
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: group
            }).done(function() {
                $this.NextStep();
                if ($('.single_kid_info').length) {
                    $('.km_participant_form_text').removeClass('km_hidden');
                    $('.km_participant_form_notrequired_text').addClass('km_hidden');
                } else {
                    $('.km_participant_form_notrequired_text').removeClass('km_hidden');
                    $('.km_participant_form_text').addClass('km_hidden');
                }
                var formData = new FormData($('#km_purchase_form')[0]);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_parent_info", formData, function(response) {
                    //console.log(response);
                    /*$('.open_km_modal').each(function(){
                     var  doctorFromId=$(this).attr('data-kid-id');
                     //console.log('doctorFromId',doctorFromId);
                     var searchInput = 'doctorStreet'+doctorFromId;
                     var autocomplete;
                     autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                     types: ['geocode']

                     });

                     google.maps.event.addListener(autocomplete, 'place_changed', function () {
                     var near_place = autocomplete.getPlace();
                     });

                     });*/
                }, false);
            });
        },
        process_kid_info: function(button, event) {
            event.preventDefault();
            var group = $(button).data('group');
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: group
            }).done(function() {
                var incompleteForms = $('.fieldday_form_button.Form_Error').length;
                $('#storeCreditId').remove();
                if (incompleteForms == 0) {
                    /* check store credits */
                    if ($isKmUser) {
                        $this.checkStoreCredit(function(response) {
                            /* if has store credit */
                            if (response.status == 'success') {
                                $this.displayModal(response, 'km_storecredit_modal');
                            } else {
                                $this.UpdateCart();
                                $this.NextStep();
                            }
                        });
                    } else {
                        $this.UpdateCart();
                        $this.NextStep();
                    }
                } else {
                    $this.DisplayAlert('error', fieldday_ajax.invalid_form_message)
                }
            });
        },
        process_coupon_apply: function(button, event, remove_coupon = '') {
            event.preventDefault();
            //$this.checkValidCoupon();
            var formData = new FormData();
            if (remove_coupon && remove_coupon != '') {
                $('input[name="couponCode"]').val('');
                formData.set('couponCode', '');
            }
            var couponCode = $('input[name="couponCode"]').val();
            formData.set('couponCode', couponCode);
            $('#km_checkoutcart_detail').addClass('fieldday_ajax_processing');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_Apply_CouponCart", formData, function(response) {
                if (response.status == 'success') {
                    //$this.kmRemoveLoader(); 
                    if (response.message != '') {
                        $this.DisplayAlert('success', response.message);
                    }
                    $this.UpdateCart();
                } else {
                    $this.DisplayAlert('error', response.message);
                    $this.kmRemoveLoader();
                }
            }, true);
            /*var group = $(button).data('group');
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: group
            }).done(function () {
                var incompleteForms = $('.fieldday_form_button.Form_Error').length;
                $('#storeCreditId').remove();
                if (incompleteForms == 0) {
                    if ($isKmUser) {
                        $this.checkStoreCredit(function (response) {
                            
                            if (response.status == 'success') {
                                $this.displayModal(response);
                            } else {
                                $this.UpdateCart();
                                $this.NextStep();
                            }
                        });
                    } else {
                        $this.UpdateCart();
                        $this.NextStep();
                    }
                } else {
                    $this.DisplayAlert('error', fieldday_ajax.invalid_form_message)
                }
            });*/
        },
        checkStoreCredit: function(callback) {
            $('#manualStoreCreditPaid, #storeCreditId, #applySiblingDiscount').remove();
            var formData = new FormData($('#km_purchase_form')[0]);
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_check_store_credit", formData, function(response) {
                callback(response);
            });
        },
        process_purchase: function(button, event) {
            event.preventDefault();
            var group = $(button).data('group');
            let event_button_id = button.id;
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: group
            }).done(function() {
                //var formData = new FormData($('#km_purchase_form')[0]);
                if ($this.paymentrequired === true) {
                    var form = $(button).parents('form');
                    $this.StripeProcess(form, function(response) {
                        if (response.error) {
                            $('#_stripeToken').val('');
                            $this.km_btn_RemoveLoader(event_button_id);
                            $this.kmRemoveLoader();
                            $this.DisplayAlert('error', response.error.message);
                        } else {
                            $('#_stripeToken').val(response.id);
                            $this.processPurchaseAPI(button);
                        }
                    }, true, event_button_id);
                } else {
                    $this.processPurchaseAPI(button);
                }
            });
        },
        processPurchaseAPI: function(button) {
            var formData = new FormData($('#km_purchase_form')[0]);
            $('#km_checkoutcart_detail').addClass('fieldday_ajax_processing');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_purchase", formData, function(response) {
                if (response.status == 'success') {
                    if (response.status != '') {
                        window.location.href = response.redirect;
                    } else {
                        $(button).parents('.km_purchase_form_content').html(response.content);
                        $this.scrollTo('.km_session_purchase');
                    }
                } else {
                    $this.DisplayAlert('error', response.message);
                }
            }, '', button.id);
        },
        process_purchaseDetail: function(button, event) {
            event.preventDefault();
            var group = $(button).data('group');
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: group
            }).done(function() {
                $this.UpdateCart();
                /*if(result==true){
                    $this.NextStep();
                }*/
                $this.NextStep();
            });
        },
        StripeProcess: function(form, callback, showloader, target_button_id = '') {
            var cardinfo = {};
            var loader = false;
            cardinfo.number = form.find('.km_card_number').val();
            cardinfo.cvc = form.find('.km_card_cvc').val();
            cardinfo.exp_month = form.find('.km_card_expiry_month').val();
            cardinfo.exp_year = form.find('.km_card_expiry_year').val();
            var package_id = form.find('.package_id').val();
            if (showloader) {
                var loader = true;
            }
            //console.log(package_id);
            /* create stripe token*/
            $this.km_loader();
            if (target_button_id && target_button_id != '') {
                $this.km_btn_loader(target_button_id);
            }
            Stripe.card.createToken(cardinfo, function(status, response) {
                //$this.postFormData(fieldday_ajax.ajax_url + "?action=km_claimcredit", formData, function (response) {
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_process_stripe", {
                    token: response.id,
                    fullresponse: response
                }, function() {}, loader);
                callback(response);
                if (package_id) {
                    $this.km_loader();
                } else { //$this.kmRemoveLoader(); 
                }
            });
        },
        getSchoolData: function(elem, event, grade, track) {
            var schoolId = $(elem).val();
            var parentDiv = $(elem).parents('.km_kids_fields_wrap');
            if (schoolId) {
                $this.makeCall(fieldday_ajax.ajax_url, {
                    action: 'get_school_info',
                    schoolId: schoolId
                }, function(response) {
                    if (response.status == 'success') {
                        //parentDiv.find('.km_school_grades, .km_school_tracks').remove();
                        parentDiv.find('.km_school_tracks').remove();
                        /*if (response.schools.grades.length) {
                            var fieldwrap = $("<div class='km_col_4 km_field_wrap km_school_grades'>").appendTo(parentDiv);
                            fieldwrap.append('<label>Grade</label>');
                            var sel = $('<select data-name="grade" class="km_input" name="' + grade + '">').appendTo(fieldwrap);
                            $.each(response.schools.grades, function (i, grade) {
                                sel.append($('<option></option>').val(grade).html(grade));
                            });
                        }*/
                        if (response.schools.tracks.length) {
                            var fieldwrap = $("<div class='km_col_4 km_field_wrap km_school_tracks'>").appendTo(parentDiv);
                            fieldwrap.append('<label>Track</label>');
                            var sel = $('<select data-name="track" class="km_input" name="' + track + '">').appendTo(fieldwrap);
                            $.each(response.schools.tracks, function(i, track) {
                                var newtrack = track.replace("track_", "");
                                sel.append($('<option></option>').val(track).html(newtrack));
                            });
                        }
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            } else {
                parentDiv.find('.km_school_grades, .km_school_tracks').remove();
            }
        },
        openClaimForm: function(button, event) {
            event.preventDefault();
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_display_claim_form'
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response);
                } else if (response.status == 'fail') {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        claimStoreCredit: function(button, event) {
            event.preventDefault();
            var formData = new FormData($('#km_claimForm')[0]);
            //formData.set('action', 'km_updateCart');
            $(button).parents('form').parsley($this.settings.parsley_valiation_options).whenValidate({
                group: 'claim_code'
            }).done(function() {
                $(button).prop('disabled', true);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_claimcredit", formData, function(response) {
                    if (response.status == 'success') {
                        $("#store_credit").trigger('click');
                        $this.closepopup();
                    } else {
                        $this.DisplayAlert('error', response.message);
                    }
                    $(button).prop('disabled', false);
                });
            });
        },
        /*checkValidCoupon:function(){
            var formData = new FormData($('#km_purchase_form')[0]);
            $('#km_checkoutcart_detail').addClass('fieldday_ajax_processing');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_updateCart", formData, function (response) {
                if (response.status == 'success') {
                    $('#km_checkoutcart_detail').removeClass('fieldday_ajax_processing').html(response.content);
                    
                }
            });
        }*/
        UpdateCart: function() {
            var formData = new FormData($('#km_purchase_form')[0]);
            //formData.set('action', 'km_updateCart');
            $('#km_checkoutcart_detail').addClass('fieldday_ajax_processing');
            $this.postFormData(fieldday_ajax.ajax_url + "?action=km_updateCart", formData, function(response) {
                if (response.status == 'success') {
                    console.log('successdata');
                    $('#km_checkoutcart_detail').removeClass('fieldday_ajax_processing').html(response.content);
                    /* remove payment options if payment methods*/
                    /* remove payment options if payble amout is 0*/
                    if (response.data.payableAmount == 0) {
                        $('.km_payment_column').hide();
                        $('#_stripeToken').remove();
                        $this.paymentrequired = false;
                        $('.km_payment_column').find('input, textarea, select').removeAttr('required');
                        $('.km_checkout_conf_pricedetail').html(response.data.pricedetail);
                    } else {
                        $this.paymentrequired = true;
                        $('.km_payment_column').show();
                        if (!$('#_stripeToken').length) {
                            $('.km_purchase_form').prepend("<input type='hidden' name='stripeToken' value='' id='_stripeToken'>");
                        }
                        $('.km_payment_column').find('input:not(.optional), textarea:not(.optional), select:not(.optional)').attr('required', true);
                        $('.km_checkout_conf_pricedetail').html(response.data.pricedetail);
                        $('.km_checkout_conf_carddetail').html(response.data.cardinfo);
                    }
                    if (!$('.km_payment_option:checked').length) {
                        $('.km_payment_option').first().prop("checked", true);
                    }
                    if ($('.km_payment_option:checked').val()) {
                        $('.km_payment_wrap').find('input, textarea, select').removeAttr('required');
                        $this.paymentrequired = false;
                        $('#_stripeToken').remove();
                    }
                    $('.km_default_authpickup').html(response.data.authPickups);
                    $this.PhoneInput();
                    $this.kmRemoveLoader();
                } else {
                    $this.kmRemoveLoader();
                    $this.DisplayAlert('error', response.message);
                    //if(response.coupon=='invalid'){ 
                    $('#km_checkoutcart_detail').removeClass('fieldday_ajax_processing');
                    /*}else{
                        $('#km_checkoutcart_detail').html(response.message).removeClass('fieldday_ajax_processing');
                    }*/
                    //$this.paymentrequired = false;
                }
                //$this.fielddaySessionTime();
            });
        },
        PrevStep: function() {
            $('._purchase_steps .km_step:eq(' + $currentstep + ')').removeClass('km_active_step');
            $currentstep--;
            $('.km_single_step').removeClass('km_active_step');
            $('.km_purchase_form_content .km_single_step:eq(' + $currentstep + ')').addClass('km_active_step');
            $this.scrollTo('.km_session_purchase');
        },
        NextStep: function() {
            $currentstep++;
            $('.km_single_step').removeClass('km_active_step');
            $('.km_purchase_form_content .km_single_step:eq(' + $currentstep + ')').addClass('km_active_step');
            $('._purchase_steps .km_step:eq(' + $currentstep + ')').addClass('km_active_step');
            $this.scrollTo('.km_session_purchase');
        },
        DisplayAlert: function(type, message) {
            if (type == 'success' || type == 'error') {
                $('.km_alert_message').removeClass('km_alert_success km_alert_error');
                $('.km_alert_message').html(message).show().addClass('km_bounce km_alert_' + type);
                setTimeout(function() {
                    $(".km_alert_message").hide();
                }, 5000);
            }
        },
        DisplayMessage: function(button, type, message) {
            $(".km_inline_message").remove();
            if (type == 'success' || type == 'error') {
                $(button).parents('form').prepend("<div class='km_inline_message'>" + message + "</div>");
                $(".km_inline_message").show().addClass('km_alert_' + type);
            }
        },
        displayModal: function(response, sizeClass) {
            if (!sizeClass) {
                sizeClass = 'modal-normal';
            }
            if (response.header) {
                $('#km_modal .km_modal_heading').html(response.header).show();
            } else {
                $('#km_modal .km_modal_heading').hide();
            }
            if (response.content) {
                $('#km_modal .km_modal_content').html(response.content);
            }
            if (response.footer) {
                $('#km_modal .km_modal_footer').html(response.footer).show();
            } else {
                $('#km_modal .km_modal_footer').hide();
            }
            if ($('#km_modal .km_modal_content .km_phone_field').length) {
                $('#km_modal .km_modal_content').addClass("km_showoverflow");
            } else {
                $('#km_modal .km_modal_content').removeClass("km_showoverflow");
            }
            $(".km_modal_content").animate({
                scrollTop: 0
            }, "fast");
            $('#km_modal').removeAttr('class').addClass("km_overlay " + sizeClass).show();
            $("body").addClass("body_km_open_true");
        },
        displaySecondModal: function(response, sizeClass) {
            if (!sizeClass) {
                sizeClass = 'modal-normal';
            }
            if (response.header) {
                $('#km_modal_sec .km_modal_heading').html(response.header).show();
            } else {
                $('#km_modal_sec .km_modal_heading').hide();
            }
            if (response.content) {
                $('#km_modal_sec .km_modal_content').html(response.content);
            }
            if (response.footer) {
                $('#km_modal_sec .km_modal_footer').html(response.footer).show();
            } else {
                $('#km_modal_sec .km_modal_footer').hide();
            }
            if ($('#km_modal_sec .km_modal_content .km_phone_field').length) {
                $('#km_modal_sec .km_modal_content').addClass("km_showoverflow");
            } else {
                $('#km_modal_sec .km_modal_content').removeClass("km_showoverflow");
            }
            $("#km_modal_sec .km_modal_content").animate({
                scrollTop: 0
            }, "fast");
            $('#km_modal_sec').removeAttr('class').addClass("km_overlay km_modal " + sizeClass).show();
            $("body").addClass("body_km_open_true");
        },
        processSessionFilters: function(elem, event) {
            if (event && event.target && event.target.id && event.target.id == 'km_location_search') {
                $this.setCookie('km_purchase_location_form', $("#km_location_search").val());
            }
            if ($("#reportrange").hasClass('activebtn')) {
                $("#reportrange").removeClass('activebtn');
            }
            if (elem) {
                if (elem.hasAttributes("data-search-name")) {
                    var search_var = elem.getAttribute("data-search-name");
                }
                if (elem.getAttribute("name") == 'tagId') {
                    console.log('filterclick');
                    console.log(elem);
                    var tab_value = elem.getAttribute("value");
                    $('#km_session_filter_form input[name="tagId"]').val(tab_value);
                }
            }
            //remove active from gifts tab
            if (jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").hasClass('active')) {
                jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").removeClass('active');
                jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").removeClass('km_primary_border');
                jQuery(".km_filter_types #km_wrap_fieldday_all_tab_id").parent().addClass('km_primary_border');
                jQuery(".km_filter_types #km_wrap_fieldday_all_tab_id").parent().addClass('active');
            }
            //remove active from gifts tab end
            $this.removeQueryParam(search_var);
            let isProcessing = false;
            var km_get_utc_string = fieldday.km_get_utc_string_func();
            var km_get_utc_string_time = 'MM-DD-YYYY ' + km_get_utc_string;
            if (isProcessing === false) {
                isProcessing = true;
                var formData = new FormData($('#km_session_filter_form')[0]);
                let element_start_date = document.querySelector('.km_active_filters .km_tags a[data-filter-key="fromDate"]');
                let element_end_date = document.querySelector('.km_active_filters .km_tags a[data-filter-key="toDate"]');
                if (element_start_date || element_end_date) {
                    let dateRangePicker = $('#reportrange').data('daterangepicker');
                    let startDate = dateRangePicker.startDate.format(km_get_utc_string_time);
                    let endDate = dateRangePicker.endDate.format('MM-DD-YYYY 23:59:59');
                    var convertedDate1 = new Date(startDate);
                    var convertedDate2 = new Date(endDate);
                    if (convertedDate1 > convertedDate2) {
                        startDate = dateRangePicker.endDate.format(km_get_utc_string_time);
                        endDate = dateRangePicker.startDate.format('MM-DD-YYYY 23:59:59');
                    }
                    if (element_start_date) {
                        formData.append('filters[fromDate]', startDate);
                    }
                    if (element_end_date) {
                        formData.append('filters[toDate]', endDate);
                    }
                } else {
                    if ($('#reportrange').length > 0 && jQuery("#km_if_session_filter_date").val() != '') {
                        let dateRangePicker = $('#reportrange').data('daterangepicker');
                        let startDate = dateRangePicker.startDate.format(km_get_utc_string_time);
                        let endDate = dateRangePicker.endDate.format('MM-DD-YYYY 23:59:59');
                        var convertedDate1 = new Date(startDate);
                        var convertedDate2 = new Date(endDate);
                        if (convertedDate1 > convertedDate2) {
                            startDate = dateRangePicker.endDate.format(km_get_utc_string_time);
                            endDate = dateRangePicker.startDate.format('MM-DD-YYYY 23:59:59');
                            formData.append('filters[fromDate]', startDate);
                            formData.append('filters[toDate]', endDate);
                        } else {
                            formData.append('filters[fromDate]', startDate);
                            formData.append('filters[toDate]', endDate);
                        }
                    }
                }
                //formData.set('action', 'km_reset_password');
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_filtersession", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_provider_sessions').show();
                        $('.km_provider_merchandise').hide();
                        /*var newUrl = $this.addQueryVar(location.href, 'session_type', tagId);
                         Â history.pushState({}, null, newUrl);*/
                        $('.km_provider_sessions').html(response.content);
                        $this.fielddaySessionTime();
                        isProcessing = false;
                        let totalrows = $(".km_session_single_item").length;
                        if (totalrows == 0) {
                            $('#km_nosession_message').removeClass('km_hidden');
                        } else {
                            $('#km_nosession_message').addClass('km_hidden');
                        }
                        var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
                        var mobile = windowWidth < 1024;
                        if (mobile) {
                            if ($('.removefilterselecter').length) {
                                $('.removefilterselecter').click();
                            }
                        }
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            }
        },
        FilterSessions: function() {
            $('#km_session_search_keyword').on('keyup', function(event) {
                var input = document.getElementById('#km_session_search_keyword');
                clearTimeout($typingTimer);
                $typingTimer = setTimeout(function() {
                    //$this.processSessionFilters(input, event);
                    if ($("#km_session_filter_form").length) {
                        $this.processSessionFilters(input, event);
                    }
                }, 2000);
            });
            jQuery('.typescontent label').click(function() {
                jQuery('.typescontent label').removeClass('active');
                jQuery('.typescontent label').removeClass('km_primary_border');
                jQuery(this).addClass('active');
                jQuery(this).addClass('km_primary_border');
            });
            $('#km_session_search_keyword').on('keydown', function(event) {
                clearTimeout($typingTimer);
            });
            $(document).on('click', '.km_clear_session_filters', function() {
                var form = document.getElementById('km_session_filter_form');
                if (form) {
                    $this.setCookie('km_purchase_location_form', 'all');
                    jQuery("#km_session_filter_form")[0].reset();
                    let start_date = moment();
                    let end_date = moment().add(365, 'days');
                    if (jQuery("#km_if_session_filter_date").length) {
                        jQuery("#km_if_session_filter_date").val('');
                        jQuery("#reportrange span").text("Select Date");
                    }
                    if (jQuery("#reportrange").length) {
                        jQuery("#reportrange span").text('Select Date');
                    }
                    var formData = new FormData(form);
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_filtersession", formData, function(response) {
                        if (response.status == 'success') {
                            jQuery('.km_provider_sessions').show();
                            jQuery('.km_provider_merchandise').hide();
                            jQuery('.km_provider_sessions').html(response.content);
                            $this.fielddaySessionTime();
                            isProcessing = false;
                            let totalrows = jQuery(".km_session_single_item").length;
                            if (totalrows == 0) {
                                jQuery('#km_nosession_message').removeClass('km_hidden');
                            } else {
                                jQuery('#km_nosession_message').addClass('km_hidden');
                            }
                            var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
                            var mobile = windowWidth < 1024;
                            if (mobile) {
                                if (jQuery('.removefilterselecter').length) {
                                    jQuery('.removefilterselecter').click();
                                }
                            }
                        } else if (response.status == 'fail') {
                            $this.DisplayAlert('error', response.message);
                        }
                    });
                }
            });
            $(document).on('click', '.km_reset_filter', function() {
                let filtername = $(this).data('filter-key');
                let filtertype = $('input[data-search-name="' + filtername + '"]').attr('type');
                let resetValue = 'all';
                if (filtername == 'searchKey') {
                    resetValue = '';
                }
                if (filtertype == 'radio') {
                    $('[data-search-name="' + filtername + '"]').prop('checked', false);
                    $('[data-search-name="' + filtername + '"][value="' + resetValue + '"]').prop('checked', true);
                } else {
                    $('[data-search-name="' + filtername + '"]').val(resetValue);
                }
                $this.removeQueryParam(filtername);
                /*var uri = window.location.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }*/
                if (filtername == 'location') {
                    $this.setCookie('km_purchase_location_form', resetValue);
                }
                if (filtername == 'toDate') {
                    $('.km_active_filters .km_tags a[data-filter-key="toDate"]').parent().remove();
                }
                if (filtername == 'fromDate') {
                    jQuery("#km_if_session_filter_date").val('');
                    jQuery("#reportrange span").text("Select Date");
                    $('.km_active_filters .km_tags a[data-filter-key="fromDate"]').parent().remove();
                    $('.km_active_filters .km_tags a[data-filter-key="toDate"]').parent().remove();
                }
                //$this.processSessionFilters();
                if ($("#km_session_filter_form").length) {
                    $this.processSessionFilters();
                }
            });
        },
        mobileSessionTabs: function(elem, event) {
            let tabValue = $(elem).val();
            if (tabValue == 'bankDays') {
                $this.showMerchandise(elem, event);
            } else {
                event.preventDefault();
                $('#km_session_tab_id').val(tabValue);
                // $this.processSessionFilters();
                if ($("#km_session_filter_form").length) {
                    $this.processSessionFilters();
                }
            }
        },
        showMerchandise: function(elem, event) {
            $('.km_session_tab').removeClass('km_active_tab');
            $('.km_session_tab').removeClass('km_primary_color');
            $(event).addClass('km_active_tab');
            $(event).addClass('km_primary_color');
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_get_bankdays'
            }, function(response) {
                if (response.status == 'success') {
                    $('.km_provider_sessions').html(response.content).show();
                } else if (response.status == 'fail') {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        showGiftCards: function(elem, event) {
            if ($("#reportrange").hasClass('activebtn')) {
                $("#reportrange").removeClass('activebtn');
            }
            $('.km_session_tab').removeClass('km_active_tab');
            $('.km_session_tab').removeClass('km_primary_color');
            $(event).addClass('km_active_tab');
            $(event).addClass('km_primary_color');
            $this.makeCall(fieldday_ajax.ajax_url, {
                action: 'km_get_giftcards'
            }, function(response) {
                if (response.status == 'success') {
                    $('.km_provider_sessions').html(response.content).show();
                } else if (response.status == 'fail') {
                    $this.DisplayAlert('error', response.message);
                }
            });
        },
        km_loader: function() {
            if ($('.km_loader_full').length) {
                $('.km_loader_full').show();
            } else {
                $('body').append($this.settings.loader);
                $('.km_loader_full').show();
            }
        },
        kmRemoveLoader: function() {
            $('.km_loader_full').hide();
        },
        km_btn_loader: function(target_id = '') {
            if (target_id && target_id != '') {
                $("#" + target_id).addClass('km_btn_active_loading');
                let i_btn = $("#" + target_id).find('.km_btn_i_cls');
                if (i_btn) {
                    i_btn.removeClass("km_hidden");
                }
            }
        },
        km_btn_RemoveLoader: function(target_id = '') {
            if (target_id && target_id != '') {
                $("#" + target_id).removeClass('km_btn_active_loading');
                let i_btn = $("#" + target_id).find('.km_btn_i_cls');
                if (i_btn) {
                    i_btn.addClass("km_hidden");
                }
            }
        },
        GetQueryString: function(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            if (sURLVariables) {
                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            }
            return false;
        },
        removeQueryParam: function(key) {
            // separating the key-value ('search') portion of the URL from the rest:
            var url = window.location.href;
            var urlParts = url.split('?');
            // if we have only a single array-element, or if the key to remove
            // is not found in the URL, we quit here and return the same unchanged URL:
            if (urlParts.length === 1 || url.indexOf(key) === -1) {
                // there were no parameters, or the
                // key wasn't present
                return url;
            } else {
                // otherwise, we split the key-value string on the '&' characters,
                // for an array of key=value strings:
                var keyValues = urlParts[1].split('&'),
                    // filtering that array:
                    refinedKeyValues = keyValues.filter(function(keyValuePair) {
                        // keeping only those array elements that don't /start with/
                        // the key to be removed:
                        return keyValuePair.indexOf(key) !== 0;
                        // joining the key=value pairs back into a string:
                    }).join('&');
            }
            // returning the refined URL:
            if (refinedKeyValues) {
                var refinedUrl = urlParts[0] + '?' + refinedKeyValues;
            } else {
                var refinedUrl = urlParts[0];
            }
            //return refinedUrl;
            if ("undefined" !== typeof history.pushState) {
                history.pushState({}, "", refinedUrl);
            } else {
                window.location.assign(refinedUrl);
            }
        },
        viewSessionDetail: function(sessionId, type) {
            let tags = '';
            if ($('#km_session_tags').length) {
                tags = $('#km_session_tags').val();
                tags = JSON.parse(tags);
            } else {
                tags = '';
            }
            $this.makeCall(fieldday_ajax.ajax_url, {
                sessionId: sessionId,
                tags: tags,
                type: type,
                'action': 'km_session_detail'
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response, 'modal-large modal-sdetail');
                    $this.initSlickSlider();
                    $this.fielddaySessionTime();
                    $this.addParamToUrl('sessionId', sessionId);
                    $this.kmTooltip();
                } else {
                    $this.DisplayAlert('error', response.message);
                    $this.closepopup();
                }
            });
        },
        addParamToUrl: function(key, value) {
            let url = $this.addQueryVar(fieldday_ajax.permalink, key, value);
            if ("undefined" !== typeof history.pushState) {
                history.pushState({}, "", url);
            } else {
                window.location.assign(url);
            }
        },
        sessionBookingOptions: function(sessionId) {
            let tags = $('#km_session_tags').val();
            $this.makeCall(fieldday_ajax.ajax_url, {
                sessionId: sessionId,
                tags: JSON.parse(tags),
                'action': 'km_session_booking_options'
            }, function(response) {
                if (response.status == 'success') {
                    $this.displayModal(response);
                    $this.initSlickSlider();
                } else {
                    $this.DisplayAlert('error', response.message);
                    $this.closepopup();
                }
            });
        },
        scrollTo: function(element, scrollelement) {
            if (!scrollelement) {
                scrollelement = 'html, body';
            }
            if ($(element).length) {
                $(scrollelement).animate({
                    scrollTop: $(element).offset().top
                }, 1000);
            }
        },
        scrollInModal: function(element, scrollelement) {
            var container = jQuery(element);
            var scrollTo = jQuery(scrollelement);
            var Scrollvalue = '';
            var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
            var mobile = windowWidth < 1024;
            if (mobile) {
                var Scrollvalue = 100;
            } else {
                var Scrollvalue = 15;
            }
            // Calculating new position of scrollbar
            var position = scrollTo.offset().top - container.offset().top + container.scrollTop() - Scrollvalue;
            // Setting the value of scrollbar
            container.scrollTop(position);
        },
        StickyformVisibility: function() {
            var cookiename = $this.getCookie('km_stickyform');
            if (cookiename == 'close') {
                $('.km_sticky_icon').addClass("km_sticky_open");
                $('.km_sticky_icon').removeClass("km_sticky_close ");
                $('.km_sticky_content').addClass('km_hidden_sticky');
            }
        },
        LocationPopUpformVisibility: function() {
            let LocationPopUpform = $this.getCookie('km_purchase_location_form');
            if (fieldday_ajax.isEnabledLocationPopUpPurchasePage && $("#km_session_filter_form").length) {
                if (typeof LocationPopUpform === 'undefined' || LocationPopUpform === null) {
                    $this.postFormData(fieldday_ajax.ajax_url + "?action=km_LocationPopUpformVisibility", [], function(response) {
                        if (response.status == 'success' && response.content != '') {
                            $("body").append(response.content);
                        }
                    });
                } else {
                    setTimeout(function() {
                        $("#km_location_search").val(LocationPopUpform);
                        $this.processSessionFilters();
                    }, 1000);
                }
            }
        },
        SetLocationPopUpformVisibility: function(default_location = 'all') {
            $this.setCookie('km_purchase_location_form', default_location);
            $("#km_location_search").val(default_location);
            $this.processSessionFilters();
            $(".km_locationpopup_pc_overlay").remove();
            $(".km_locationpopup_pc").remove();
        },
        initSlickSlider: function() {
            if ($('.km_slides').length) {
                $(".km_slides:not('.slick-initialized')").slick({
                    dots: false,
                    arrows: true,
                    infinite: false,
                    cssEase: 'linear'
                });
            }
        },
        submitDonation: function(elem, event) {
            event.preventDefault();
            var form = $(elem).parents('form');
            form.parsley($this.settings.parsley_valiation_options).whenValidate({
                group: 'km_donate'
            }).done(function() {
                $(elem).prop('disabled', true);
                $this.StripeProcess(form, function(response) {
                    if (response.error) {
                        $this.DisplayAlert('error', response.error.message);
                        $this.kmRemoveLoader();
                    } else {
                        form.find('.stripe_token').val(response.id);
                        var formData = new FormData(form[0]);
                        //formData.set('action', 'km_reset_password');
                        $(button).prop('disabled', true);
                        $this.postFormData(fieldday_ajax.ajax_url + "?action=km_submit_donation", formData, function(response) {
                            if (response.status == 'success') {
                                form[0].reset();
                                $this.displayModal(response);
                                //grecaptcha.reset(1);
                            } else if (response.status == 'fail') {
                                $this.DisplayAlert('error', response.message);
                            }
                            $(elem).prop('disabled', false);
                        });
                    }
                    $(elem).prop('disabled', false);
                });
            });
        },
        makeCall: function(url, data, callback, hideloader) {
            url = $this.addQueryVar(url, "permalink", fieldday_ajax.permalink);
            url = $this.addQueryVar(url, "_wpnonce", fieldday_ajax._wpnonce);
            $.ajax({
                url: url, // server url
                type: 'POST', //POST or GET
                data: data, // data to send in ajax format or querystring format
                datatype: 'json',
                async: true,
                crossDomain: true,
                beforeSend: function(xhr) {
                    if (!hideloader) {
                        $this.km_loader();
                    }
                },
                success: function(data) {
                    if (!hideloader) {
                        $this.km_loader();
                    }
                    callback(data); // return data in callback
                },
                complete: function() {
                    if (!hideloader) {
                        $this.kmRemoveLoader();
                    }
                },
                error: function(xhr, status, error) {
                    $this.kmRemoveLoader();
                }
            });
        },
        postFormData: function(url, data, callback, hideloader, target_button_id = '') {
            //data.set('permalink', fieldday_ajax.permalink);
            //data.set('_wpnonce', fieldday_ajax._wpnonce);
            if (target_button_id && target_button_id != '') {
                $this.km_btn_loader(target_button_id);
            }
            $this.km_loader();
            url = $this.addQueryVar(url, "permalink", fieldday_ajax.permalink);
            url = $this.addQueryVar(url, "_wpnonce", fieldday_ajax._wpnonce);
            $.ajax({
                url: url, // server url
                type: 'POST', //POST or GET
                data: data, // data to send in ajax format or querystring format
                datatype: 'json',
                beforeSend: function(xhr) {
                    if (!hideloader) {
                        $this.km_loader();
                    }
                    if (target_button_id && target_button_id != '') {
                        $this.km_btn_loader(target_button_id);
                    }
                },
                success: function(data) {
                    /*if (hideloader) {
                        $this.kmRemoveLoader();
                    }*/
                    callback(data); // return data in callback
                },
                complete: function() {
                    if (!hideloader) {
                        $this.kmRemoveLoader();
                    }
                    if (target_button_id && target_button_id != '') {
                        $this.km_btn_RemoveLoader(target_button_id);
                    }
                },
                error: function(xhr, status, error) {
                    $this.kmRemoveLoader();
                    if (target_button_id && target_button_id != '') {
                        $this.km_btn_RemoveLoader(target_button_id);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        },
        addQueryVar: function(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        },
        initilaizeDaterangepicker: function() {
            var start = moment();
            var end = moment().add(365, 'days');

            function cb(start, end) {
                $('#reportrange span').html('Select Date');
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                minDate: moment(),
                ranges: {
                    'Today': [moment(), moment().startOf('hour').add(23, 'hour')],
                    'Next 7 Days': [moment().startOf('hour').add(15, 'hour').add(6, 'days'), moment()],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        },
        SessionlistVeiw: function() {
            $('.km_session_switcher').on('click', function(event) {
                $('.km_session_switcher').removeClass('km_current_layout');
                var style = $(this).data('style');
                $(this).addClass('km_current_layout');
                if (style == 'grid') {
                    $('.km_shadow_right').removeClass('km_session_list');
                } else {
                    $('.km_shadow_right').removeClass('km_session_grid');
                }
                $('.km_shadow_right').addClass('km_session_' + style);
            });
            let isStickyHeader = false;
            $(document).scroll(function() {
                if ($(this).scrollTop() < 50) {
                    isStickyHeader = false;
                }
                if (isStickyHeader && $this.inRange($(this).scrollTop(), 45, 55)) {
                    return;
                }
                if ($(this).scrollTop() > 50) {
                    isStickyHeader = true;
                    $('.km_sessions_header').addClass('km_session_sticky_header');
                } else {
                    isStickyHeader = false;
                    $('.km_sessions_header').removeClass('km_session_sticky_header');
                }
            });
            $('.km_discount_button').on('click', function() {
                $this.setCookie('discount_check', true);
                $('#km_modal_discount').hide();
            });
            $('.km_global_pop_btn').on('click', function(event) {
                event.preventDefault();
                $this.setCookie(fieldday_ajax.global_popup_key, true);
                $('#km_modal_discount_global').hide();
                let link = $(this).attr('href');
                if (link) {
                    window.location.href = link;
                }
            });
            $('.km_session_tab').on('click', function(event) {
                event.preventDefault();
                let tabId = $(this).data('id');
                $('.km_session_tab, .km_session_tab_merchandise').removeClass('km_active_tab');
                $('.km_session_tab, .km_session_tab_merchandise').removeClass('km_primary_color');
                $('#km_session_tab_id').val(tabId);
                $(this).addClass('km_active_tab');
                $(this).addClass('km_primary_color');
                //$this.processSessionFilters();
                if ($("#km_session_filter_form").length) {
                    $this.processSessionFilters();
                }
            });
            /*list filter script start */
            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                if ($(this).hasClass('activebtn')) {
                    $(this).removeClass('activebtn');
                }
                jQuery("#km_if_session_filter_date").val('1');
                //remove active from gifts tab
                if (jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").hasClass('active')) {
                    jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").removeClass('active');
                    jQuery(".km_filter_types #km_wrap_fieldday_gft_tab_id").removeClass('km_primary_border');
                    jQuery(".km_filter_types #km_wrap_fieldday_all_tab_id").parent().addClass('km_primary_border');
                    jQuery(".km_filter_types #km_wrap_fieldday_all_tab_id").parent().addClass('active');
                }
                //remove active from gifts tab end   
                var dateRangePicker = $('#reportrange').data('daterangepicker');
                var km_get_utc_string = fieldday.km_get_utc_string_func();
                var km_get_utc_string_time = 'MM-DD-YYYY ' + km_get_utc_string;
                //var startDate = dateRangePicker.startDate.format('MM-DD-YYYY 00:00:00');
                var startDate = dateRangePicker.startDate.format(km_get_utc_string_time);
                var endDate = dateRangePicker.endDate.format('MM-DD-YYYY 23:59:59');
                var convertedDate1 = new Date(startDate);
                var convertedDate2 = new Date(endDate);
                if (convertedDate1 > convertedDate2) {
                    var startDate = dateRangePicker.endDate.format(km_get_utc_string_time);
                    var endDate = dateRangePicker.startDate.format('MM-DD-YYYY 23:59:59');
                    $('#reportrange span').html(picker.endDate.format('MMMM D, YYYY') + ' - ' + picker.startDate.format('MMMM D, YYYY'));
                } else {
                    $('#reportrange span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
                }
                var formData = new FormData($('#km_session_filter_form')[0]);
                formData.append('filters[fromDate]', startDate);
                formData.append('filters[toDate]', endDate);
                $this.postFormData(fieldday_ajax.ajax_url + "?action=km_filtersession", formData, function(response) {
                    if (response.status == 'success') {
                        $('.km_provider_sessions').show();
                        $('.km_provider_merchandise').hide();
                        $('.km_provider_sessions').html(response.content);
                        $this.fielddaySessionTime();
                        isProcessing = false;
                        let totalrows = $(".km_session_single_item").length;
                        if (totalrows == 0) {
                            $('#km_nosession_message').removeClass('km_hidden');
                        } else {
                            $('#km_nosession_message').addClass('km_hidden');
                        }
                    } else if (response.status == 'fail') {
                        $this.DisplayAlert('error', response.message);
                    }
                });
            });
            var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
            var mobile = windowWidth < 1024;
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            $('#km_events_calendar').fullCalendar({
                views: {
                    day: { // name of view
                        titleFormat: 'YYYY, MM, DD'
                        // other view-specific options here
                    }
                },
                header: {
                    left: '',
                    center: 'title',
                },
                dayRender: function(date, cell) {
                    if (mobile) {
                        var eventdate = date.format('MM-DD-YYYY');
                        var eventweek = $this.convertTimeToLocal(eventdate + " 05:00", "dddd");
                        var datadate = cell.attr('data-date');
                        var hastr = cell.parents('.fc-row').find('.fc-content-skeleton').find('tr').find('td[data-date="' + datadate + '"]').find('.fc-day-number').append('<span class="all-weekday">' + eventweek.slice(0, 3) + '</span>');
                    }
                },
                eventRender: function(event, element, view) {
                    console.log(event);
                },
                events: function(start, end, timezone, callback) {
                    /*var moments = moment().subtract(7, 'days');
                    var ends = moment().add(50, 'days');*/
                    var moment = jQuery('div#km_events_calendar').fullCalendar('getDate');
                    var km_get_utc_string = fieldday.km_get_utc_string_func();
                    var km_get_utc_string_time = 'MM-DD-YYYY ' + km_get_utc_string;
                    //console.log(moment+' / '+ends);
                    jQuery.ajax({
                        url: fieldday_ajax.ajax_url + '?action=km_calenderevents',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            //start: moment.format('MM-DD-YYYY 00:00:00'),
                            start: moment.format(km_get_utc_string_time),
                            end: end.format('MM-DD-YYYY 23:59:59')
                        },
                        success: function(doc) {
                            console.log('successevent: ' + doc);
                            var events = [];
                            $.each(doc, function(i, item) {
                                let startTimeString = doc[i].start_fulldate;
                                let endTimeString = doc[i].end_fulldate;
                                let startDate = $this.convertTimeToLocal(startTimeString, "YYYY-MM-DD");
                                let endDate = $this.convertTimeToLocal(endTimeString, "YYYY-MM-DD");
                                let startTime = $this.convertTimeToLocal(startTimeString, "h:mm a");
                                let endTime = $this.convertTimeToLocal(endTimeString, "h:mm a");
                                events.push({
                                    id: doc[i].id,
                                    title: doc[i].title,
                                    start: startDate,
                                    end: endDate
                                });
                                var selectClass = $('td .fc-day-top');
                                $.each(selectClass, function() {
                                    var dateevent = $(this).attr('data-date');
                                    var eventweek = $this.convertTimeToLocal(dateevent + " 05:00", "dddd");
                                    let indexNumber = $this.settings.DaysArray.indexOf(eventweek);
                                    //var eventweekcount = eventweek.getDay();
                                    if (dateevent <= endDate && dateevent >= startDate) {
                                        $(this).attr('data-weekday', eventweek);
                                        if ($.inArray(indexNumber, doc[i].days) > -1) {
                                            if (mobile) {
                                                $(this).append('<div class="eventtitle km_session_single_item" data-time-stamp-from=\"' + doc[i].starttimestamp + '\" data-time-stamp-to=\"' + doc[i].endtimestamp + '\" ><span class="km_event_time">' + startTime + '-' + endTime + '</span><a class="km_eventclick" href="javascript:void(0);" data_eventid=\"' + doc[i].id + '\" ><span style="color:#' + doc[i].title_color + ';display: block;font-weight: bold;">' + doc[i].title + '</span></a></div>');
                                                var length = $('.eventtitle').length;
                                                var height = document.querySelector('.eventtitle').offsetHeight
                                                $('.fc-view.fc-agendaDay-view.fc-agenda-view .fc-row.fc-week.fc-widget-content').css('height', height * length + 50);
                                            } else {
                                                $(this).find('.fc-day-number').after('<div class="eventtitle km_session_single_item" style="margin: 5px 3px;" data-time-stamp-from=\"' + doc[i].starttimestamp + '\" data-time-stamp-to=\"' + doc[i].endtimestamp + '\" ><span class="km_event_time">' + startTime + '-' + endTime + '</span><a class="km_eventclick" href="javascript:void(0);" data_eventid=\"' + doc[i].id + '\" ><span style="color:#' + doc[i].title_color + ';display: block;font-weight: bold;white-space: break-spaces;">' + doc[i].title + '</span></a></div>');
                                            }
                                        }
                                    }
                                });
                            });
                        } // success
                    }); // ajax
                } //event
            }); // Calendar View 
            /*Detailed Calendar View*/
            $('#km_events_calendar_detailed').fullCalendar({
                views: {
                    day: { // name of view
                        titleFormat: 'YYYY, MM, DD'
                        // other view-specific options here
                    }
                },
                header: {
                    left: '',
                    center: 'title',
                },
                dayRender: function(date, cell) {
                    if (mobile) {
                        var eventdate = date.format('MM-DD-YYYY');
                        var eventweek = $this.convertTimeToLocal(eventdate + " 05:00", "dddd");
                        var datadate = cell.attr('data-date');
                        var hastr = cell.parents('.fc-row').find('.fc-content-skeleton').find('tr').find('td[data-date="' + datadate + '"]').find('.fc-day-number').append('<span class="all-weekday">' + eventweek.slice(0, 3) + '</span>');
                    }
                },
                eventRender: function(event, element, view) {
                    console.log(event);
                    element.attr('title', event.tooltip);
                },
                eventMouseover: function(calEvent, jsEvent) {
                    var tooltip = '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">dasdasds</div>';
                    var $tooltip = $(tooltip).appendTo('body');
                    $(this).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $tooltip.fadeIn('500');
                        $tooltip.fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $tooltip.css('top', e.pageY + 10);
                        $tooltip.css('left', e.pageX + 20);
                    });
                },
                eventMouseout: function(calEvent, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.tooltipevent').remove();
                },
                events: function(start, end, timezone, callback) {
                    /*var moments = moment().subtract(7, 'days');
                    var ends = moment().add(50, 'days');*/
                    var moment = jQuery('div#km_events_calendar_detailed').fullCalendar('getDate');
                    var km_get_utc_string = fieldday.km_get_utc_string_func();
                    var km_get_utc_string_time = 'MM-DD-YYYY ' + km_get_utc_string;
                    jQuery.ajax({
                        url: fieldday_ajax.ajax_url + '?action=km_calenderevents',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            //start: moment.format('MM-DD-YYYY 00:00:00'),
                            start: moment.format(km_get_utc_string_time),
                            end: end.format('MM-DD-YYYY 23:59:59')
                        },
                        success: function(doc) {
                            console.log('successevent: ' + doc);
                            var events = [];
                            $.each(doc, function(i, item) {
                                let startTimeString = doc[i].start_fulldate;
                                let endTimeString = doc[i].end_fulldate;
                                let startDate = $this.convertTimeToLocal(startTimeString, "YYYY-MM-DD");
                                let endDate = $this.convertTimeToLocal(endTimeString, "YYYY-MM-DD");
                                let startTime = $this.convertTimeToLocal(startTimeString, "h:mm a");
                                let endTime = $this.convertTimeToLocal(endTimeString, "h:mm a");
                                events.push({
                                    id: doc[i].id,
                                    title: doc[i].title,
                                    start: startDate,
                                    end: endDate
                                });
                                var selectClass = $('td .fc-day-top');
                                $.each(selectClass, function() {
                                    //$(this).after('<div class="tooltip"></div>'); 
                                    //var myi = true; 
                                    var dateevent = $(this).attr('data-date');
                                    var eventweek = $this.convertTimeToLocal(dateevent + " 05:00", "dddd");
                                    let indexNumber = $this.settings.DaysArray.indexOf(eventweek);
                                    //var eventweekcount = eventweek.getDay();
                                    if (dateevent <= endDate && dateevent >= startDate) {
                                        $(this).attr('data-weekday', eventweek);
                                        if ($.inArray(indexNumber, doc[i].days) > -1) {
                                            //$(this).append('<div class="tooltip">wee'+indexNumber+'</div>');
                                            $(this).addClass('hasEvent');
                                            $(this).find('.fc-day-number').after('<div class="eventtitle km_eventclick km_session_single_item km_hidden km_row" data_eventid=\"' + doc[i].id + '\"  style="margin: 5px 3px;" data-time-stamp-from=\"' + doc[i].starttimestamp + '\" data-time-stamp-to=\"' + doc[i].endtimestamp + '\" ><div class="km_col_8"><i class="fa fa-clock km_primary_color" aria-hidden="true"></i> <span class="km_event_time">' + startTime + '-' + endTime + '</span><a class="km_eventclick km_primary_color" href="javascript:void(0);" data_eventid=\"' + doc[i].id + '\" ><span style="display: block;font-weight: bold;white-space: break-spaces;">' + doc[i].title + '</span></a></div><div class="km_col_4"><span class="km_event_btn km_primary_bg">View Detail</span></div></div>');
                                        }
                                    }
                                    var totalevents = $(this).find('.eventtitle').length;
                                    $(this).attr('total-events', totalevents);
                                });
                            });
                        } // success
                    }); // ajax
                } //event
            }); // Calendar View 
            $(document).ajaxStop(function() {
                $('.fc-future.hasEvent, .fc-today.hasEvent').mouseenter(function() {
                    var totalevents = $(this).attr('total-events');
                    $(this).append('<div class="km-event_tooltip">' + totalevents + ' Available</div>');
                    $(this).find('.fc-day-number').addClass('km_secondary_border');
                });
                $(".fc-future.hasEvent, .fc-today.hasEvent").mouseleave(function() {
                    $(this).find('.km-event_tooltip').remove();
                    $(this).find('.fc-day-number').removeClass('km_secondary_border');
                });
                $('body').on('click', '.fc-future, .fc-today', function(e) {
                    $('.fc-day-number').removeClass('km_secondary_bg');
                    $('.fc-future, .fc-today').removeClass('km-clicked-event');
                    $(this).addClass('km-clicked-event');
                    $(this).find('.fc-day-number').addClass('km_secondary_bg');
                    var nowsession = $('.km_full-sessions').attr('data-day');
                    $('.km_full-sessions').remove();
                    if ($(this).hasClass("hasEvent")) {
                        //e.stopPropagation();
                        e.stopImmediatePropagation();
                        console.log('today-clicked');
                        var Eventdata = $(this).find('.eventtitle').clone();
                        var eventsdate = $(this).data('date');
                        var eventdate = moment(eventsdate).format('DD-MM-YYYY');
                        var datenumber = $(this).find('.fc-day-number').text();
                        if (mobile) {
                            $(this).append('<div class="km_full-sessions"><div class="km_loader_full"></div><h3 class="km_primary_color km_cal_heading">Available Sessions ' + eventdate + '</h3></div>');
                            $(this).find('.km_full-sessions').append(Eventdata);
                        } else {
                            $(this).parents('.fc-week').append('<div class="km_full-sessions"><div class="km_loader_full"></div><h3 class="km_primary_color km_cal_heading">Available Sessions on ' + eventdate + '</h3></div>');
                            $(this).parents('.fc-week').find('.km_full-sessions').append(Eventdata);
                        }
                        $('.km_full-sessions').attr('data-day', datenumber);
                        if (nowsession === datenumber) {
                            $('.km_full-sessions').addClass('km_hidden');
                        } else {
                            $this.km_loader();
                            setTimeout(function() {
                                $('.km_full-sessions .eventtitle').removeClass('km_hidden');
                                $this.kmRemoveLoader();
                            }, 2000);
                        }
                        //$(this).parents('.fc-week').append('<div class="km_full-sessions" style="display: block;"><h2><span>Available Appointments on </span><strong>03.23.2023</strong></h2><div class="timeslot bookedClearFix"><span class="timeslot-time"><span class="timeslot-range"><i class="fa-solid fa-clock"></i> 8:00 am – 9:00 am</span><span class="spots-available">1 space available</span></span><span class="timeslot-people"><button data-calendar-id="25" data-title="" data-timeslot="0800-0900" data-date="2023-03-23" class="new-appt button"><span class="button-timeslot">8:00 am – 9:00 am</span><span class="button-text">Book Appointment</span><span class="spots-available">1 space available</span></button></span></div></div>');
                    }
                });
            });
            $(document).ajaxStop(function() {
                $('body').on('click', '.km_eventclick', function(e) {
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    var sessionId = $(this).attr('data_eventid');
                    $this.makeCall(fieldday_ajax.ajax_url, {
                        sessionId: sessionId,
                        'action': 'km_session_detail'
                    }, function(response) {
                        if (response.status == 'success') {
                            $this.displayModal(response, 'modal-large');
                            $this.initSlickSlider();
                            $this.fielddaySessionTime();
                            $this.kmTooltip();
                        } else {
                            $this.DisplayAlert('error', response.message);
                            $this.closepopup();
                        }
                    });
                });
            });
            /*-- mobile cart view code  --*/
            $(document).ajaxStop(function() {
                $('body').on('click', '.removecartselecter', function(e) {
                    e.stopPropagation();
                    jQuery('#km_cart_items_wrap').css({
                        right: '-370px'
                    });
                    jQuery('#km_cart_items_wrap_mobile').css({
                        top: '5000px'
                    });
                    //$this.setCookie('removeditemsviewed', 'viewed');
                });
            });
            /*-- mobile cart view code  --*/
            /* list filter script end */
            $('body').on('click', '#sharesession', function(e) {
                var inputc = document.body.appendChild(document.createElement("input"));
                //var searchParams = $('.km_booking_type.km_col_3.km_tooltip a').attr('href');
                var searchParams = $(this).parents('.km_package_wrapper').find('.km_booking_type a').attr('href');
                var newParams = searchParams.replace("_id", "sessionId");
                //console.log('',newParams);
                inputc.value = newParams;
                //inputc.focus();
                inputc.select();
                document.execCommand('copy');
                inputc.parentNode.removeChild(inputc);
                $this.DisplayAlert('success', 'Session link has been copied');
                //alert("SessionUrl Copied.");
            });
        },
        convertTimeToLocal: function(timeString, format) {
            return moment.utc(timeString).local().format(format);
        },
        filterByTag: function(elem, event) {
            let tagname = $(elem).prop("tagName");
            if (tagname == 'SELECT') {
                //$this.processSessionFilters();
                if ($("#km_session_filter_form").length) {
                    $this.processSessionFilters();
                }
            } else {
                $('.km_radio_wrap_filterd').removeClass('km_active_filter');
                $('.km_radio_wrap_filterd').removeClass('km_primary_bg');
                $(elem).parents('.km_radio_wrap_filterd').addClass('km_active_filter');
                $(elem).parents('.km_radio_wrap_filterd').addClass('km_primary_bg');
                //$this.processSessionFilters();
                if ($("#km_session_filter_form").length) {
                    $this.processSessionFilters();
                }
            }
        },
        Myaccountpageevents: function() {
            $('.close_before_account_text').on('click', function() {
                $this.setCookie('display_account_help', true);
                $('.km_before_account_text').remove();
            });
            $(".km_my_account_slidefilter_btn a").click(function() {
                if ($(".km_view_all_prctpants_pg_ctm_new").length) {
                    $(".km_view_all_prctpants_pg_ctm_new").toggleClass("open-sidebar");
                }
            });
        },
        radiobuttonevent: function(button, event) {
            var previousValue = $(button).attr('previousValue');
            if (previousValue == 'true') {
                button.checked = false;
                $(button).attr('previousValue', button.checked);
            } else {
                button.checked = true;
                $(button).attr('previousValue', button.checked);
            }
        },
        giftCardswitchevent: function() {
            $("body").on("click", '.km_single_giftcardpopup .km_single_giftdesign img', function(e) {
                e.preventDefault();
                let childIndex = $(this).parent('.km_single_giftdesign').index();
                localStorage.setItem('kmGiftCardPurchaseData_gft_img', childIndex);
                $('.km_single_giftdesign').removeClass('selectedCartItem');
                var selectGiftImage = $(this).data('original');
                var selectGiftImagethumb = $(this).attr('src');
                $('.km_single_giftcardpopup .km_gift_image').attr('src', selectGiftImagethumb);
                $('.km_single_giftcardpopup .km_gift_image').attr('data-original', selectGiftImage);
                $(this).parent('.km_single_giftcardpopup .km_single_giftdesign').addClass('selectedCartItem');
            });
            $("body").on("click", '.km_gift_value', function(e) {
                e.preventDefault();
                $('.giftcardprice').text('');
                $('input[name="km_gift_custom_amount"]').val('');
                $('span.km_gift_value.selectedCartItem').removeClass('km_primary_border');
                $('span.km_gift_value.selectedCartItem').removeClass('selectedCartItem');
                var selectGiftprice = $(this).text();
                if (selectGiftprice.trim() == '') {
                    $('input#km_gift_custom_amount').keyup(function() {
                        selectGiftprice = this.value;
                        $('.a-alert-content').text('');
                        if (/\D/g.test(this.value)) {
                            // Filter non-digits from input value.
                            this.value = this.value.replace(/\D/g, '');
                        } else {
                            var max = parseInt($(this).attr('max'));
                            var min = parseInt($(this).attr('min'));
                            if ($(this).val() > max) {
                                //$('.a-alert-content').text('This is over the $2000 maximum');
                            } else if ($(this).val() < min) {
                                //$('.a-alert-content').text('The minimum amount is $1');
                            }
                            if (selectGiftprice) {
                                var amount = "$" + parseFloat(selectGiftprice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
                            } else {
                                var amount = '';
                            }
                            //var amount = "$" + parseFloat(selectGiftprice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
                            $('.giftcardprice').text(amount);
                            $('.input#km_gift_custom_amount').val(amount);
                            $('input[name="km_gift_custom_amount"]').val(amount);
                        }
                    });
                    $(this).addClass('selectedCartItem');
                    $(this).addClass('km_primary_border');
                } else {
                    $('.giftcardprice').text(selectGiftprice);
                    $('input[name="km_gift_custom_amount"]').val(selectGiftprice.trim());
                    $(this).addClass('selectedCartItem');
                    $(this).addClass('km_primary_border');
                }
            });
            $("body").on("click", '.km_sendoption_value', function(e) {
                e.preventDefault();
                $('span.km_sendoption_value.selectedCartItem').removeClass('km_primary_border');
                $('span.km_sendoption_value.selectedCartItem').removeClass('selectedCartItem');
                $(this).addClass('selectedCartItem');
                $(this).addClass('km_primary_border');
                var sendMethod = jQuery('span.km_sendoption_value.selectedCartItem').text();
                if (sendMethod != 'Email') {
                    $('span#phone_number').css('display', "block");
                    //$('span#email').css('display',"none");
                } else {
                    $('span#phone_number').css('display', "none");
                    //$('span#email').css('display',"block");
                }
            });
        },
        passwordHideShowevent: function() {
            //  const togglePassword = document.querySelector('#togglePassword');
            $("body").on("click", '#togglePassword', function(e) {
                // toggle the type attribute
                var password = document.querySelector("[name='user_password']");
                if (password === null) {
                    password = document.querySelector("[name='user-register-password']");
                }
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye / eye slash icon
                if (type == 'text') {
                    $(this).addClass('fa-eye').removeClass('fa-eye-slash');
                } else {
                    $(this).addClass('fa-eye-slash').removeClass('fa-eye');
                }
            });
        }
    };
    fieldday.initilaize();
})(jQuery);