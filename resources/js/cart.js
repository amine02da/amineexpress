(function ($) {
    $("quantity").on("change", function () {
        $.ajax({
            url: "cart/" + $(this).data("id"),
            methode: "put",
            data: {
                quantity: $(this).val(),
                __token: csrf_token,
            },
        });
    });
})(jQuery);