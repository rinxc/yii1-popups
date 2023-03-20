let popupsAnimID = $('#Popups_animation').data('id');
let popups = new Popups({
    title: $('#Popups_title').html(),
    content: $('#Popups_content').html(),
    cssStyleID:'main',
    cssStyleURL: popupsAnimationUrl.main,
    cssAnimID: popupsAnimID,
    cssAnimURL: popupsAnimationUrl[popupsAnimID]
});

function showPopups() {
    popups.openPopup();
}