function AlertConfirm(msg, targetUrl) {
    bootbox.dialog({
        message: msg == undefined ? "" : msg,
        buttons: {
            success: {
                label: lang.yes,
                className: "btn btn-danger",
                callback: function () {
                window.location.href = targetUrl
                },
            },
            exit: {
                label: lang.no,
                className: "btn btn-primary",
            }
        },
    })
    return false
}

function DiableSubmitButton(obj){
    obj.disabled = true;
    $(obj).prop('disabled', true);
    $(obj).parents('form').submit();
    return true;
}