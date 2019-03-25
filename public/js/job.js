
$(document).ready(function() {



    $('.js-select-language').val($('.js-select-language').data("prevalue"));
    $('.js-select-filter').val($('.js-select-filter').data("prevalue"));
    $('.js-select-location-filter').val($('.js-select-location-filter').data("prevalue"));
    $('.js-select-title-filter').val($('.js-select-title-filter').data("prevalue"));


    $('.js-select-state').each(function () {
        if ($(this).data('prevalue')) {
            $(this).val($(this).data('prevalue'));
        }
    })


    $('.js-get-list-basic').on('click', function(){
        getBasicData('English');
    });


    $('.js-get-list-basic-german').on('click', function(){
        getBasicData('German');
    });

    $('.js-check-company').on('click', function(){
        getBasicData('All',true);
    });



    // change application state start
    $('.js-select-state').on('change', function(e) {

        var optionSelected = $(this).find("option:selected").val();
        var ajaxUrl = $(this).data('url');

        $.ajax({
            url: ajaxUrl,
            data: {
                state : optionSelected
            },
            success: function (data) {

                showAlert(data['result'], data['resultMent'], data['resultId']);
            }
        });
    });
    // change application state end

    var lastEtc;

    $('.js-etc-textarea').focus(function(e) {
        lastEtc = $(this).val();
    });

    // change application state start
    $('.js-etc-textarea').blur(function(e) {

        var etcValue = $(this).val();
        var ajaxUrl = $(this).data('url');

        if (lastEtc == etcValue) {
            return;
        }

        $.ajax({
            url: ajaxUrl,
            data: {
                etcValue : etcValue
            },
            success: function (data) {
                showAlert(data['result'], data['resultMent']);
            }
        });
    });
    // change application state end

    function showAlert(title, ment, id) {

        $alertHtml = "    <div class='alert alert-warning alert-dismissible fade show js-result-alert' id='alert_"+id+"' role='alert'>\n" +
            "            <strong class='js-title'>"+title+"</strong> <span class='js-ment'> "+ment+"</span>\n" +
            "        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>\n" +
            "            <span aria-hidden='true'>&times;</span>\n" +
            "        </button>\n" +
            "        </div>";

        $('.js-alert-top').append(
            $alertHtml
        );

        setTimeout(function () {
            $('#alert_'+id).alert('close')
        }, 2000)
    }


    function getBasicData(language, checkCompany) {

        var companyName = $('.js-search-q').val();

        $('.js-search-form').trigger("reset");

        if(checkCompany){
            $('.js-search-q').val(companyName);
        }else{
            $('.js-search-q').val('');
            $('.js-select-location-filter').val('Berlin');
            $('.js-select-filter').val('notApply');
            $('.js-select-language').val(language);
        }

        $('.js-search-form').submit();
    }

});
