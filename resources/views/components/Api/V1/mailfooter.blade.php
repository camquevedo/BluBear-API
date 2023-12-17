<?php
$year = date('Y'); ?>
@component('mail::message')
    <div class="main_text" style="margin-top:10%">
        <h1>
            Salud,
            <br>
            <strong>El equipo de <u><a href="{{ $config['mailUrlWeb'] }}"
                        style="text-decoration: none;">digimon.dev-camquevedo.uk</a></u></strong>
        </h1>
    </div>
@endcomponent()
{{-- Footer --}}
<div class="icons">
    <div id="icons-container">
        <div class="partner_mail">
            RESPALDADOS POR
            <img src="{{ $config['mailUrlApi'] . '/img/extras/Respaldos.png' }}">
        </div>
        <div class="social_mail">
            SIGUENOS <br>
            <div class="social_mail_links">
                <a href="{{ $config['facebookUrl'] }}" target="_blank" class="fa"><img class='fa-fb'
                        src="{{ $config['mailUrlApi'] . '/img/extras/social-fb.png' }}"></a>
                <a href="{{ $config['twitterUrl'] }}" target="_blank" class="fa"><img class='fa-ig'
                        src="{{ $config['mailUrlApi'] . '/img/extras/social-tw.png' }}"></a>
                <a href="{{ $config['instagramUrl'] }}" target="_blank" class="fa"><img class='fa-tw'
                        src="{{ $config['mailUrlApi'] . '/img/extras/social-ig.png' }}"></a>
                <a href="{{ $config['youtubeUrl'] }}" target="_blank" class="fa"><img class='fa-yt'
                        src="{{ $config['mailUrlApi'] . '/img/extras/social-yt.png' }}"></a>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <table class="footer" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-cell-foot" align="center">
                <div class="footext">
                    CAMILO-QUEVEDO {{ $year }} - Todos los derechos reservados <br>
                    {{ $address }} <br><br>
                    Lee nuestra <strong> <u><a href="{{ $config['mailUrlWeb'] . '/blog/nosotros' }}">Política de
                                privacidad</a></u></strong> y los <strong> <u><a
                                href="{{ $config['mailUrlWeb'] . '/blog/terminos-condiciones' }}">Términos y
                                condiciones.</a></u></strong><br>
                    Recibiste este correo electrónico porque realizaste una accion en <strong> <u><a
                                href="{{ $config['mailUrlWeb'] }}">digimon.dev-camquevedo.uk</a></u></strong>.
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="footer2">
    <table class="footer2" width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-cell-foot2">
                <div class="footext">
                    DISFRUTA RESPONSABLEMENTE
                    <br>
                    El contenido acá presente no es propiedad intelectual propia.
                    <br>
                    Contenido Digimon pertenese a Bandai
                </div>
            </td>
        </tr>
    </table>
</div>
