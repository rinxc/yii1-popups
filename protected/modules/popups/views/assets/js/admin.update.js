let popupsAnimID = $('#Popups_animation').find(":selected").val();
let popups = new Popups({
    title: $('#Popups_title').val(),
    content: $('#Popups_content').val(),
    cssStyleID:'main',
    cssStyleURL: popupsAnimationUrl.main,
    cssAnimID: popupsAnimID,
    cssAnimURL: popupsAnimationUrl[popupsAnimID]
});

function showPopups() {
    let popupsAnimID = $('#Popups_animation').find(":selected").val()
    popups.setSettings({
        title: $('#Popups_title').val(),
        content: $('#Popups_content').val(),
        cssAnimID: popupsAnimID,
        cssAnimURL: popupsAnimationUrl[popupsAnimID]
    });
    popups.openPopup();
}

if($.fn.select2) {
    $('.select2').select2({
        placeholder: '',
        allowClear: true
    });
}