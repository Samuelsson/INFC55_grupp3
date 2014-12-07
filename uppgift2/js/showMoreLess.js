// Customized from the following source: http://shakenandstirredweb.com/240/jquery-moreless-text 
function activateShowMoreLess() {
    // The height of the content block when it's not expanded
    var adjustheight = 80;
    // The "more" link text
    var moreText = "+ Show more";
    // The "less" link text
    var lessText = "- Show less";

    // Sets the .more-block div to the specified height and hides any content that overflows
    $(".more-less .more-block").css('height', adjustheight).css('overflow', 'hidden');

    // The section added to the bottom of the "more-less" div
    $(".more-less").append('<a href="#" class="adjust" rel="nofollow"></a>');
    // Set the "More" text
    $("a.adjust").text(moreText);

    $(".adjust").toggle(function () {
        $(this).parents("div:first").find(".more-block").css('height', 'auto').css('overflow', 'visible');
        // Hide the [...] when expanded
        $(this).parents("div:first").find("p.continued").css('display', 'none');
        $(this).text(lessText);
    }, function () {
        $(this).parents("div:first").find(".more-block").css('height', adjustheight).css('overflow', 'hidden');
        $(this).parents("div:first").find("p.continued").css('display', 'block');
        $(this).text(moreText);
    });
}