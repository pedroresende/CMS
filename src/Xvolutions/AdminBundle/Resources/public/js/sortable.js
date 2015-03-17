$(document).ready(function ()
{
    var url = $(this).attr('id');
    $('#sortable').sortable({
        stop: function (e, ui) {
            var data = [];
            data.push($.map($(this).find('li'), function (el) {
                return $(el).attr('id');
            }));
            $.ajax(
                    {
                        type: "POST",
                        url: url,
                        data: JSON.stringify(data),
                        async: true,
                        cache: false,
                        success: function (data, result)
                        {
                            var text = result;
                            $("#text").text(text);
                            $("#status").fadeIn(
                                    'slow',
                                    function ()
                                    {
                                        $("#status").css("display", "block");
                                        $("#status").delay(1500);
                                        $("#status").fadeOut(
                                                'slow',
                                                function ()
                                                {
                                                    $("#status").slideUp(1500);
                                                }
                                        );
                                    }
                            );
                        },
                        dataType: "json"
                    }
            );
        }
    });
});