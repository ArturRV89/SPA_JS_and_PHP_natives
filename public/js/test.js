<div className="warning1">
    <table align="center" border="0" cellPadding="5" cellSpacing="0">
        <tbody>
        <tr>
            <td nowrap="">Внимание! Данный сайт может содержать материалы для взрослых.</td>
            <td align="center"><a href="/" className="yes">Мне есть 18 лет</a></td>
            <td width="30">или</td>
            <td align="center"><a rel="nofollow" href="http://ya.ru" className="no">Покинуть сайт</a></td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    function getCookie() {
    var cookies = document.cookie.match ( '(^|;) ?adultconfirmed=([^;]*)(;|$)' );
    if (cookies) {$('.warning1').hide();}
}
    $('.yes').click(function(event) {
    event.preventDefault();
    document.cookie = 'adultconfirmed=yes; path=/; expires=01/01/2100 00:00:00';
    $('.warning1').hide();
});
    getCookie();

</script>