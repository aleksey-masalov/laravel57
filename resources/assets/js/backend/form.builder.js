$(document).ready(function () {
    prepareDeleteForm();

    $(document).ajaxComplete(function () {
        prepareDeleteForm();
    });

    $('body').on('submit', 'form[name=delete-item]', function (e) {
        e.preventDefault();

        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Warning";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "Are you sure you want to delete this item?";

        swal({
            title: title,
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: confirm,
            closeOnConfirm: true
        }, function (confirmed) {
            if (confirmed)
                form.submit();
        });
    });
});

function prepareDeleteForm() {
    $('[data-method]').append(function () {
        if ($(this).find('form').length) {
            return '';
        }

        return '' +
            "\n<form action='" + $(this).attr('href') + "' method='post' name='delete-item' style='display:none'>" +
            "\n<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>" +
            "\n<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>" +
            "\n</form>\n";
    })
    .attr('href', '#')
    .attr('style', 'cursor:pointer;')
    .attr('onclick', '$(this).find("form").submit();');
}
