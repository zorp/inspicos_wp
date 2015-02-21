//hide error messages
jQuery(document).ready(function(){
	jQuery('#contactNameError').hide();
	jQuery('#emailError').hide();
	jQuery('#phoneError').hide();
	jQuery('#formValFaild').hide();
	jQuery('#contactNameNotFilledError').hide();
	jQuery('#emailNotFilledError').hide();
	jQuery('#phoneNotFilledError').hide();
	jQuery('#commentsNotFilledError').hide();
});

//Name validation
jQuery('#contactName').keyup( function() {
	jQuery('#contactNameError').fadeOut(1000);
	jQuery('#contactNameNotFilledError').hide();
	var regExp = /^[a-zA-Z\s]*$/;
	var name = jQuery('#contactName').val();
	if (!regExp.test(name)) {
		jQuery('#contactNameError').css('color', '#e53b51').slideDown(1000);
	};
});
//Email validation
jQuery('#email').keyup( function() {
jQuery('#emailNotFilledError').hide();
});
jQuery('#email').change( function() {
	jQuery('#emailError').fadeOut(1000);
	var regExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var email = jQuery('#email').val();
	if (!regExp.test(email)) {
		jQuery('#emailError').css('color', '#e53b51').slideDown(1000);
	};
});
// Phone validation
jQuery('#phone').keyup( function() {
	jQuery('#phoneError').fadeOut(1000);
	jQuery('#phoneNotFilledError').hide();
	var regExp = /^[0-9]*$/;
	var phone = jQuery('#phone').val();
	if (!regExp.test(phone)) {
		jQuery('#phoneError').css('color', '#e53b51').slideDown(1000);
	};
});
jQuery('#textarea-message').keyup( function() {
	jQuery('#commentsNotFilledError').hide();
});

// submit vadidation
jQuery('#submit').click( function(e) {
	var nameVal = 0;
	var emailVal = 0;
	var phoneVal = 0;
	var commentsVal = 0;
	var formVal = 0;
	var name = jQuery('#contactName').val();
	var email = jQuery('#email').val();
	var phone = jQuery('#phone').val();
	var comments = jQuery('#textarea-message').val();
	var regExpName = /^[a-zA-Z\s]*$/;
	var regExpEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var regExpPhone = /^[0-9]*$/;
	if (!regExpName.test(name) || (name == '')) {
		jQuery('#contactNameNotFilledError').css('color', '#e53b51').slideDown(1000);
		nameVal = 1;
	};
	if (!regExpEmail.test(email)) {
		jQuery('#emailNotFilledError').css('color', '#e53b51').slideDown(1000);
		emailVal = 1;
	};
	if ((!regExpPhone.test(phone) && (phone != null)) || (phone == '')) {
		jQuery('#phoneNotFilledError').css('color', '#e53b51').slideDown(1000);
		phoneVal = 1;
	};
	if (comments == '') {
		jQuery('#commentsNotFilledError').css('color', '#e53b51').slideDown(1000);
		commentsVal = 1;
	};
	formVal = nameVal + emailVal + phoneVal + commentsVal;
	if (formVal > 0) {
		jQuery('#formValFaild').fadeIn();
		e.preventDefault();
	} else {
		jQuery('#formValFaild').fadeOut();
		jQuery('#contact-form').submit();
	};
});
