<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    @if(!empty($calendar_bool))
        @include("template.calendar_js")
    @endif
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route("construct")}}">工事情報管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route("checklist")}}">チェックリスト管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route("calendar")}}" tabindex="-1" >カレンダー</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

