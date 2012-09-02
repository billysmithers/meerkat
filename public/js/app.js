$(document).ready(function()
{
    //hide unloaded images and display placeholder
    $('img').each(function()
    {
        var img = this;
        if (img.complete)
        {
            if (typeof img.naturalWidth != 'undefined' && img.naturalWidth == 0)
            {
                $(img).hide();
                $(img).parents('div.product-image').addClass('no-image').text('Awaiting image');
            }
        }
        else
        {
            $(img).error(function()
            {
                $(img).hide();
                $(img).parents('div.product-image').addClass('no-image').text('Awaiting image');
            });
        }
    });
});