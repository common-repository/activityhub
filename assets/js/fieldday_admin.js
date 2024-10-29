jQuery(document).ready(function(){
    const primary_color = document.querySelector('#km_fieldday_primary_color'); 
    const fielddaySettigsCountry = document.querySelector("#km_admin_user_phone");
    var primary_color_value = jQuery(primary_color).val();
    jQuery(primary_color).css('background',primary_color_value);
    if(primary_color){
    const pickr = new Pickr({
      el: primary_color,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //primary_color.value = pickr.getSelectedColor().toRGBA().toString(0);
      //jQuery(primary_color).css('background',color.toRGBA().toString(0));
    }).on('save', color => {
      primary_color.value = color.toRGBA().toString(0);
      jQuery(primary_color).css('background',color.toRGBA().toString(0));
      pickr.hide();
    });
}
const secondary_color = document.querySelector('#km_fieldday_secondary_color');
    var secondary_color_value = jQuery(secondary_color).val();
    jQuery(secondary_color).css('background',secondary_color_value);

  if(secondary_color){
    const pickr_sec = new Pickr({
      el: secondary_color,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //secondary_color.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      secondary_color.value = color.toRGBA().toString(0);
      jQuery(secondary_color).css('background',color.toRGBA().toString(0));
      pickr_sec.hide();
    });
  }
//text color
const texxt_color = document.querySelector('#km_fieldday_text_color');
    var texxt_color_value = jQuery(texxt_color).val();
    jQuery(texxt_color).css('background',texxt_color_value);

  if(texxt_color){
    const pickr_texxt = new Pickr({
      el: texxt_color,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //secondary_color.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      texxt_color.value = color.toRGBA().toString(0);
      jQuery(texxt_color).css('background',color.toRGBA().toString(0));
      pickr_texxt.hide();
    });
  }
//text color end

//text color secondary
const texxt_color2 = document.querySelector('#km_fieldday_text_color2');
    var texxt_color_value2 = jQuery(texxt_color2).val();
    jQuery(texxt_color2).css('background',texxt_color_value2);

  if(texxt_color2){
    const pickr_texxt2 = new Pickr({
      el: texxt_color2,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //secondary_color.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      texxt_color2.value = color.toRGBA().toString(0);
      jQuery(texxt_color2).css('background',color.toRGBA().toString(0));
      pickr_texxt2.hide();
    });
  }

//text color secondary end


  // Highlight Color
  const highlightcolor = document.querySelector('#km_fieldday_highlightcolor');
    var highlightcolor_value = jQuery(highlightcolor).val();
    jQuery(highlightcolor).css('background',highlightcolor_value);

  if(highlightcolor){
    const pickr_sec = new Pickr({
      el: highlightcolor,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //highlightcolor.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      highlightcolor.value = color.toRGBA().toString(0);
      jQuery(highlightcolor).css('background',color.toRGBA().toString(0));
      pickr_sec.hide();
    });
  }


//km sticky icon color
  const fieldday_sticky_icon_textcolor = document.querySelector('#fieldday_sticky_icon_textcolor');
  var fieldday_sticky_icon_textcolor_value = jQuery(fieldday_sticky_icon_textcolor).val();
  jQuery(fieldday_sticky_icon_textcolor).css('background',fieldday_sticky_icon_textcolor_value);

  if(fieldday_sticky_icon_textcolor){
    const pickr_sec = new Pickr({
      el: fieldday_sticky_icon_textcolor,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //highlightcolor.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      fieldday_sticky_icon_textcolor.value = color.toRGBA().toString(0);
      jQuery(fieldday_sticky_icon_textcolor).css('background',color.toRGBA().toString(0));
      pickr_sec.hide();
    });
  }



  const fieldday_sticky_icon_bg_color = document.querySelector('#fieldday_sticky_icon_bg_color');
  var fieldday_sticky_icon_bg_color_value = jQuery(fieldday_sticky_icon_bg_color).val();
  jQuery(fieldday_sticky_icon_bg_color).css('background',fieldday_sticky_icon_bg_color_value);

  if(fieldday_sticky_icon_bg_color){
    const pickr_sec = new Pickr({
      el: fieldday_sticky_icon_bg_color,
      useAsButton: true,
      theme: 'monolith',

      swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
      ],

      components: {
        preview: true,
        opacity: true,
        hue: true,

        interaction: {
          hex: true,
          rgba: true,
          hsva: false,
          input: true,
          save: true
        }
      }
    }).on('init', pickr => {
      //highlightcolor.value = pickr_sec.getSelectedColor().toRGBA().toString(0);
    }).on('save', color => {
      fieldday_sticky_icon_bg_color.value = color.toRGBA().toString(0);
      jQuery(fieldday_sticky_icon_bg_color).css('background',color.toRGBA().toString(0));
      pickr_sec.hide();
    });
  }
//km sticky icon color end
// initialise plugin
  
  if(fielddaySettigsCountry){
    setTimeout(function() {
      let objectId = 'km_admin_user_phone';
      let oldCountryCode = jQuery("#" + objectId).parents('.km_field_wrap').find('.user_country_code').val();
      if(typeof oldCountryCode=='undefined'){
        oldCountryCode = 'US';
      }
      let iti = window.intlTelInput(fielddaySettigsCountry, {
        initialCountry: oldCountryCode,
        placeholderNumberType: 'FIXED_LINE'
      });
      fielddaySettigsCountry.addEventListener("countrychange", function (e) { 
        let country_code_new = iti.getSelectedCountryData().iso2;
        let dialCode = iti.getSelectedCountryData().dialCode;
        if(jQuery("#" + objectId).length){
          jQuery("#" + objectId).parents('.km_field_wrap').find('.user_country_code').val(country_code_new.toUpperCase());
          jQuery("#" + objectId).parents('.km_field_wrap').find('.user_dial_code').val(dialCode);
        }
      });
    }, 1000);
  }




});