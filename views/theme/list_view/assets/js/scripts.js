/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $(document).on('click', '.km_listtheme_filter_btn', function (e) { 
        e.preventDefault();
        $('.km_listtheme_filter_btn').not(this).next('.km_listtheme_filter_content').removeClass('activefilter');
        $(this).next('.km_listtheme_filter_content').toggleClass('activefilter');
        $('.km_listtheme_filter_btn').not(this).removeClass('activebtn');
        $(this).toggleClass('activebtn');
    });
    $(document).on('click', '.km_filter_slide #reportrange', function (e) { 
        $(this).toggleClass('activebtn');
        e.preventDefault();
    });



    $(document).mouseup(function (e) {
        var container = $(".km_listtheme_filter_btn");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            //$('.km_listtheme_filter_content').removeClass('activefilter');
            //$('.km_listtheme_filter_btn').removeClass('activebtn');
            
        }

        $(document).ajaxStart(function () {
            $('.km_listtheme_filter_content').removeClass('activefilter');
            $('.km_listtheme_filter_btn').removeClass('activebtn');
        });
    });

    
    jQuery(document).on('click', function(event) {
        if(jQuery(".fieldday_filter_open").length){
            var target = jQuery(event.target);
            if (!target.closest('.daterangepicker').length && !target.closest('#reportrange').length) {
                jQuery("#reportrange").removeClass("activebtn");
            }
        }
    });

    $(document).on('click', '.cancelBtn', function (e) { 
        if(jQuery(".fieldday_filter_open").length){
            jQuery("#reportrange").removeClass("activebtn");
        }
    });
    

    /*$(document).on('click', '#filter_type_types', function (e) {
        e.preventDefault();
        $('.km_bank_type').removeClass('activefilter');
        $('.km_custom_dropdown.filter_list_dropdown').removeClass('activefilter');
        $(this).next('.typescontent').toggleClass('activefilter');
    });

    $(document).on('click', '#filter_type_bankdays', function (e) {
        e.preventDefault();
        $('.typescontent').removeClass('activefilter');
        $('.km_custom_dropdown.filter_list_dropdown').removeClass('activefilter');
        $(this).next('.km_bank_type').toggleClass('activefilter');
    });

    $('#filter_type_month').on('click', function (e) {
        e.preventDefault();
        $('.typescontent').removeClass('activefilter');
        $('.km_bank_type').removeClass('activefilter');

        $(this).next('.km_custom_dropdown.filter_list_dropdown').toggleClass('activefilter');
    });*/
})(jQuery);

