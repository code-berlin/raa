(function ($) {
    var FooterWidget = function () {
        this.initialized = false; // Widget is initialized
        this.current_form_selector = '#contact-form';
        this.form = {}; // Categories names
    };

    FooterWidget.prototype = {
        init: function () {
            if (!this.initialized) {
                var that = this;

                this.initialized = true;

                this.$window = $(window);
                this.$main = $('.contact-widget');

                this.fixIE();
                this.getCurrentFormSelector();
                this.bindEvents();
            }
        },
        /*
        * Validates forms
        */
        validateForm: function ($form, name) {
            var invalidFields = 0,
                that = this;

            // Object with array of forms holding form information.
            if (this.form[name] === undefined) {
                this.form[name] = {};
            }

            // Use data-mandatory attribute to tell the method a field must be validated/
            $form.find('[data-mandatory="1"]').each(function () {
                var $this = $(this),
                    value = $this.val(),
                    thisName = $this.attr('name');

                // Validation rules.
                if (value === '' ||
                    (thisName === 'name' && value === 'Name*') ||
                    (thisName === 'email' && value === 'E-Mail*') ||
                    (thisName === 'email' && !that.validateEmail(value)) ||
                    (thisName === 'message' && (value === 'Message*' || value === 'Nachricht*'))
                ) {
                    $this.addClass('empty-field');
                    invalidFields++;
                } else {
                    $this.removeClass('empty-field');
                }
            });

            this.form[name].isValid = (invalidFields === 0);
        },
        /*
        * Validates an email address against a regular expresion.
        */
        validateEmail: function (email) {
            var regex = /\S+@\S+\.\S+/;
            return regex.test(email);
        },
        /*
        * Validates value is numeric
        */
        validateNumeric: function (number) {
            return !isNaN(parseFloat(number)) && isFinite(number);
        },
        getCurrentFormSelector: function () {
            // Set current form selector
            if ($('#form_wrapper').length != 0) {
                this.current_form_selector = '#form_wrapper';
            }
        },
        clearInputs: function(form) {
            // Fix for IE 9: clearing inputs and textarea after the form is submitted
            var $input = $(form + ' input');

            $.each($input, function() {
                var $this = $(this);
                if ($this.attr('type') !== 'submit') {
                    var $current_placeholder = $this.attr("placeholder");
                    $this.val('');
                    $this.val($current_placeholder);
                }
            });

            var $textarea = $(form + ' textarea');
            var $current_placeholder = $textarea.attr("placeholder");

            $textarea.text($current_placeholder);
        },
        fixIE: function () {
            // This magic construction is supposed to get the current browser name
            navigator.sayswho = (function(){
                var ua= navigator.userAgent, tem,
                M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
                if(/trident/i.test(M[1])){
                    tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
                    return 'IE '+(tem[1] || '');
                }
                M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion, '-?'];
                if((tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
                return M.join(' ');
            })();

            // Fix for IE: href="tel:..."
            if (navigator.sayswho.indexOf("IE") == 0 || navigator.sayswho.indexOf("MSIE") == 0) {
                var $phone_box = $('#tel');
                var content = $phone_box.html();
                $phone_box.replaceWith($('<div id="tel">' + content + '</div>'));
            }

            // Fix for IE8-9: contact form placeholders
            if ($(".ie9").length != 0) {
                // Inputs
                if ($(".contact-form input").length != 0) {
                    var $input = $(".contact-form input");
                } else if ($("#form_wrapper input").length != 0) {
                    var $input = $("#form_wrapper input");
                }

                $.each($input, function() {
                    var $this = $(this);
                    var $current_placeholder = $this.attr("placeholder");
                    $this.attr("value", $current_placeholder);
                    $this.focus(function() {
                        if ($this.val() == $current_placeholder) {
                            $this.val("");
                        }
                    })
                    .blur(function() {
                        if (!$this.val()) {
                            $this.val($current_placeholder);
                        }
                    });
                });
                // Textarea
                var $textarea = $("textarea");
                if ($textarea.length != 0) {
                    var $current_placeholder = $textarea.attr("placeholder");
                    $textarea.text($current_placeholder);
                    $textarea.focus(function() {
                        if ($textarea.val() == $current_placeholder) {
                            $textarea.text("");
                        }
                    })
                    .blur(function() {
                        if (!$textarea.val()) {
                            $textarea.text($current_placeholder);
                        }
                    });
                }
            }
        },
        /*
        *   Binds events
        */
        bindEvents: function () {
            var that = this;

            this.$main.on('submit', this.current_form_selector, function (e) {
                var $this = $(this),
                    thisName = $this.attr('data-name');

                that.validateForm($this, thisName);

                // Contact form submission
                if (that.form[thisName].isValid) {
                    $.ajax({
                        url: '/sendemail/contact',
                        type: 'post',
                        data: $this.serialize(),
                        success: function (data) {
                            alert('Vielen Dank für Ihre Kontaktanfrage!');
                            // Fix for IE
                            if (navigator.sayswho.indexOf("IE") == 0 || navigator.sayswho.indexOf("MSIE") == 0) {
                                that.clearInputs(this.current_form_selector);
                            } else {
                                $(this.current_form_selector).find('input[name="name"], input[name="email"], input[name="message"], input[name="url"], textarea').val('');
                            }
                        }
                    });
                }

                e.preventDefault();
            });
        }
    }

    window.footerWidget = new FooterWidget();
})(jQuery);

jQuery(function () {
    window.footerWidget.init();
});
