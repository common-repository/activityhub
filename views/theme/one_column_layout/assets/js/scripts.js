/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    
    $(document).on('click', '.km_onecolumntheme_filter_btn', function (e) {
        e.preventDefault();
        $('.km_onecolumntheme_filter_content').removeClass('activefilter');
        $('.km_custom_dropdown.filter_list_dropdown').removeClass('activefilter');
        $(this).next('.km_onecolumntheme_filter_content').toggleClass('activefilter');
    });
     $(document).mouseup(function (e) {
        var container = $(".km_onecolumntheme_filter_content");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.km_onecolumntheme_filter_content').removeClass('activefilter');
            
        }

        $(document).ajaxStart(function () {
            $('.km_onecolumntheme_filter_content').removeClass('activefilter');
            
        });
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

