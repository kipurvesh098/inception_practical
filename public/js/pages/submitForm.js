$(document).ready(function () {
    $('#parsley-submit-form').parsley();
     
    $('#submit-form').submit(function () {
        if (true)
        {
            $('#submitBtn').attr('disabled',true);
            $('#AjaxLoaderDiv').fadeIn('slow');

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (result)
                {
                    $('#submitBtn').attr('disabled',false);
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1)
                    {
                        $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                        window.location = $('#submit-form').attr('redirect-url');
                    }
                    else
                    {
                        $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                    }
                },
                error: function (error)
                {
                    $('#submitBtn').attr('disabled',false);
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    $.bootstrapGrowl("Internal Server Error!", {type: 'danger', delay: 4000});
                }
            });
        }
        return false;
    });
   
    $('#parsley-submit-form').submit(function () {
        if ($(this).parsley('validate'))
        {
            $('#submitBtn').attr('disabled',true);
            $('#AjaxLoaderDiv').fadeIn('slow');

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (result)
                {
                    $('#submitBtn').attr('disabled',false);
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1)
                    {
                        $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                        window.location = $('#parsley-submit-form').attr('redirect-url');
                    }
                    else
                    {
                        $.bootstrapGrowl(result.msg, {type: 'danger error-msg', delay: 4000});
                    }
                },
                error: function (error)
                {
                    $('#submitBtn').attr('disabled',false);
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    $.bootstrapGrowl("Internal Server Error!", {type: 'danger error-msg', delay: 4000});
                }
            });
        }
        return false;
    });
});