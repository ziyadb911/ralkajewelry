<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Ralka Jewelry</title>
{{-- icon --}}
<link href="{{ URL::asset('img/favicon.png') }}" rel="icon">
<link href="{{ URL::asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
{{-- jquery --}}
<script src="{{ URL::asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
{{-- semantic --}}
<link rel="stylesheet" href="{{ URL::asset('vendor/semantic/semantic.min.css') }}" />
<script src="{{ URL::asset('vendor/semantic/semantic.min.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body {
        //background: #BEBEBE;
    }

    .pusher>.full.height {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;

    }

    .pusher>.full.height {
        background-color: #FFFFFF;
    }

    .full.height>.tocc {
        position: relative;
        z-index: 1;
        background-color: #1b1c1d;
        width: 250px;
        -webkit-box-flex: 0;
        -webkit-flex: 0 0 auto;
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
    }

    .full.height>.tocc .ui.menu {
        border-radius: 0;
        border-width: 0 1px 0 0;
        box-shadow: none;
        margin: 0;
        width: inherit;
        overflow: hidden;
        will-change: transform;
    }

    .article {
        -webkit-box-flex: 1;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-width: 0px;
        padding-top: 2rem;
        padding-bottom: 1.5em;
    }

    .submenuadmin {
        left: 0px;
        //top: -798px;
        width: 250px !important;
        min-height: 100vh !important;
        margin-top: 0px;
        z-index: 15 !important;
        padding-top: 1rem;
    }

    .article>.container {
        margin-left: 2em !important;
        margin-right: 2em !important;
        width: auto !important;
        //max-width: 960px !important;
    }

    .ui.fixed.menu,
    .ui.fixed.menu .toc.item {
        display: none;
    }

    .ui.small.image.squared {
        height: 150px;
    }

    .ui.small.image.squared img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    @media only screen and (max-width: 800px) {
        .tocc {
            display: none !important;
        }

        .ui.fixed.menu,
        .ui.fixed.menu .toc.item {
            display: block;
        }

        .pusher>.full.height {
            padding-top: 3em;
        }
    }

</style>
