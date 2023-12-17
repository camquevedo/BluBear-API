{{--NavBar--}}
@component('components.Api.V1.mailheader', ['config' => $config, 'bannerImage' => $city->bannerImage, 'bannerLink' =>
$city->bannerLink])
@endcomponent
@component('mail::message')
{{--MainText--}}
<div class="main_text">
    <h1>Hola <strong>{{$user->firstName}},</strong></h1>
    <h2>Gracias por unirte</h2>
    <h1>a la comunidad más grande de Latinoamérica en la que podrás disfrutar toda una experiencia alrededor de la
        compra del licor y preparación de tus cócteles favoritos.
    </h1>
</div>
@endcomponent
@component('mail::button', ['url' => $config['mailUrlWeb']])
COMPRAR AHORA
@endcomponent
@component('mail::message')
{{--Benefits--}}
<div class="benefits-container-mail">
    <table class="benefits_mail">
        <tr>
            <th class='border-ben'><br><img class='imabene1'
                    src="{{$config['mailUrlApi'].'/img/extras/benefits-mail-1.png'}}">
                <h1>PAGO <br>CONTRA ENTREGA</h1>
            </th>
            <th class='border-ben'><br><img class='imabene2'
                    src="{{$config['mailUrlApi'].'/img/extras/benefits-mail-2.png'}}">
                <h1>PAGO <br>ONLINE </h1>
            </th>
            <th><br><img class='imabene3' src="{{$config['mailUrlApi'].'/img/extras/benefits-mail-3.png'}}">
                <h1>PAGO <br>SEGURO </h1>
            </th>
        </tr>
    </table>
</div>
<br>
{{--Article--}}
<div class="article_mail">
    <div id="article_mail-container">
        <div class="article_photo">
            <img src="{{$config['mailUrlApi'].'/img/extras/us-mail.png'}}">
        </div>
        <div class="article_text">
            <h1>
                Para todos los amantes de lo que fué esa buena serie animada Digimon, digimon.dev-camquevedo.uk trae a ustedes un nuevo api y una
                nueva experiencia alrededor del listadod de nuestros amados digital mosters.
            </h1>
            @component('mail::button', ['url' => $config['mailUrlWeb'].'/blog/nosotros'])
            NOSOTROS
            @endcomponent
        </div>
    </div>
</div>
@endcomponent
{{-- Footer --}}
@component('components.Api.V1.mailfooter', ['config' => $config, 'address'=>$city->address])
@endcomponent