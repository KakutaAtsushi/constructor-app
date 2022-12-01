@include("template.header")

<div class="card">
    <div class="row">
        <h2 class="title col-4">チェックリスト管理</h2>
    </div>
    <div class="create">
        <a href="{{route("checklist.create")}}">
            <button type="button" class="btn btn-outline-success">+ 新規作成</button>
        </a>
    </div>
    <div class="card-body" style="margin: 20px; padding: 15px;">
        @if(!empty($checklist))
            @foreach($checklist as $parent_key => $data)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">タイトル：{{$data->title}}</h5>
                        @foreach($items[$parent_key] as $key => $item)
                            <p class="card-text">項目{{$key + 1}}: {{$item}}</p>
                        @endforeach
                        <a href="/checklist/edit/{{$data->id}}">
                            <button type="button" class="btn btn-success btn-lg">編集</button>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <h1>データが存在しません</h1>
        @endif
    </div>
</div>
@include("template.footer")

