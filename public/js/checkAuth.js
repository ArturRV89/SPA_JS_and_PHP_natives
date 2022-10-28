function getCookie(name) {
    let match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)'));
    return match ? match[1] : null;
}
if (!getCookie('user_id') || !getCookie('user_email')) {
    $('.general_page').hide();
}