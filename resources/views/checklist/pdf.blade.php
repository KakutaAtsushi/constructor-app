<html>
<body>
<style>
    @font-face {
        font-family: ipag;
        font-style: normal;
        font-weight: normal;
        src: url('{{ storage_path('fonts/ipag.ttf')}}');
    }

    body {
        font-family: ipag, serif;
    }
    .pdf{
        border: solid;
        padding:15px;
        margin-top: 15px;
    }
</style>
        <div>
            <p style="margin:5px">タイトル:{{$title}}</p>
            @foreach($items as $key => $item)
                <div style="height: 20px;">
                    <div style="margin:10px; margin-top:20px;">
                        <p  class="pdf">項目{{$key+1}}: @if($item === "")@else{{$item}}@endif</p>
                    </div>
                </div>
            @endforeach
        </div>
</body>
</html>
