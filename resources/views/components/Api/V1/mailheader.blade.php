{{-- NavBar --}}
<div class="mail_navigation-bar">
    <div id="mail_navigation-container">
        <div class="logo_nav">
            <a href="{{ $config['mailUrlWeb'] }}">
                <img class="logo" src="{{ $config['mailUrlApi'] . '/img/logo.png' }}">
        </div>
        <div class="text_nav">
            <ul>
                <li><a href="{{ $config['mailUrlWeb'] . '/dashboard' }}" class='border'>Dashboard</a></li>
                <li><a href="{{ $config['mailUrlWeb'] . '/digimons' }}">Digimons</a></li>
            </ul>
        </div>
    </div>
</div>
{{-- Banner --}}
<div class="banner">
    <a href="{{ $config['mailUrlWeb'] . '/' . $bannerLink }}"><img
            src="{{ $config['mailUrlApi'] . '/' . $bannerImage }}"></a>
</div>
