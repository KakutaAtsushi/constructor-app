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
    }
</style>
        <div>
            <p style="margin:5px">タイトル:{{$title}}</p>
            @foreach($items as $key => $item)
                <div style="width:200px;height: 100px; ">
                    <div style="margin:2px; padding:1px" class="pdf">
                        <p>項目{{$key+1}}: @if($item === "")無し@else{{$item}}@endif</p>
                    </div>
                </div>
            @endforeach
        </div>
</body>
</html>
