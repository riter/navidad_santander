/*
 * Dandelion Admin v1.1 - Login JS
 *
 * This file is part of Dandelion Admin, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 25, 2012
 * Last Update:
 * June 11, 2012
 *
 */

(function($) {
	$(document).ready(function(e) {
		$("#da-login-form").validate({
			rules: {
				"data[User][username]": {
					required: true
				}, 
				"data[User][password]": {
					required: true
				}
			},
            messages: {
                "data[User][username]": {
                    required: "Username requerido"
                },
                "data[User][password]": {
                    required: "Password requerido"
                }
            }
		});
		
		/* Placeholder */
		if($.fn.placeholder) {
			$('[placeholder]').placeholder();
		}
	});
}) (jQuery);