$( document ).ready(function() {
    $(".alert-success").delay(5000).slideUp(300);
    $(".alert-danger").delay(5000).slideUp(300);

    // Delete modal
    $('.button-delete').on('click', function (e) {
        var button = $(this),
            modal = $('#delete-modal'),
            form_url = button.data("url"),
            title_modal = "Weet u zeker dat u " + button.data("name") + " " + button.data("last_name") + " wilt verwijderen?",
            title_button = "Verwijder " + button.data("name") + " " + button.data("last_name"),
            modal_text = "U staat op het punt om een " + button.data("object") + " permanent te verwijderen. Weet u dat zeker?";

        modal.find("form.delete-form-modal").removeAttr('action');
        modal.find("#delete-modal-title").empty();
        modal.find("button.button-delete-modal").removeAttr('title');
        modal.find(".modal-body p").empty();

        modal.find("form.delete-form-modal").attr('action', form_url);
        modal.find("#delete-modal-title").append(title_modal);
        modal.find("button.button-delete-modal").attr('title', title_button);
        modal.find(".modal-body p").append(modal_text);
    });

    //Result amount
    $('.result-amount-select').on('change', function () {
        $(this).find("option:selected").each(function () {
            var value = $(this).attr('value');

            Cookies.set('result_amount', value, {expires: 7});
            $(this).parent().parent().parent().submit();
        });
    })
});
