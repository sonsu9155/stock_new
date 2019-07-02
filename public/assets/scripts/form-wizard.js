var FormWizard = function () {

    return {
        //main function to initiate the module
        init: function () {

            if (!jQuery().bootstrapWizard) {
                return;
            }

          


           

            var handleTitle = function(tab, navigation, index) {

            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                //'nextSelector': '.button-next',
                //'previousSelector': '.button-previous',
               
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;

                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            //$('#form_wizard_1').find('.button-previous').hide();
            //$('#form_wizard_1 .button-submit').click(function () {
            //    alert('Finished! Hope you like it :)');
            //}).hide();
        }

    };

}();