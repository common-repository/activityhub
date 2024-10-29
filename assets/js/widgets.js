/*
 *
 * fieldday front end widget javascript
 *
 * @since 1.3.0
 *
 */
var KmWidget;
(function ($) {
    var $this;
    KmWidget = {
        settings: {

        },
        initilaize: function () {
            $this = KmWidget;
            $(document).ready(function () {
                $this.onInitMethods();
            });
            $(window).on('elementor/frontend/init', function() {
            if (elementorFrontend.isEditMode()) { 
                elementor.hooks.addAction( 'panel/open_editor/widget', function( panel, model, view ) { 
                  if (model.attributes.widgetType==="elementor-activity-sessions") {
                    const $this = $( panel.$el );
                    $this.on('change','select[data-setting="activity_ids"]',function () { 
                        var activity_id = $this.find('select[data-setting="activity_ids"]').val();
                        fieldday.makeCall(fieldday_ajax.ajax_url, {action: 'km_getactivity_sessions',activity_id: activity_id }, function( response){
                            if(response.status == 'success') { 
                                $this.find('select[data-setting="sessions_ids"]').val('');
                                $this.find('.select2 ul').html('');
                                $this.find('.select2-selection__clear').click(); 
                                $this.find('.select2-selection__choice__remove').click();
                                $this.find('select[data-setting="sessions_ids"]').html(response.content);
                                setTimeout(function() {  $this.find('.select2-selection__choice__remove').click();}, 2000);
                            }else {
                                fieldday.DisplayAlert('error', response.message);
                            }
                        });

                    });
                   }
                } );
            } 
            });

        },
        onInitMethods: function() {
            $this.resizeTiles();
        },
        resizeTiles:function() {
            let height = "";
            if($('.km_featured_session_content').length) {
                $('.km_featured_session_content').each(function(){
                    if($(this).outerHeight() > height) {
                       height = $(this).outerHeight();
                       $('.km_featured_single, .km_featured_session_img img').css('min-height', height);
                    }
                });
            }
        },
    };
    KmWidget.initilaize();
})(jQuery);