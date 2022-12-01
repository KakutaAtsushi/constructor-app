@include("template.header")
<div class="card">
    <div class="row">
        <h2 class="title col-4">チェックリスト編集</h2>
    </div>
    <form method="POST" action="{{route("checklist.update")}}" style="padding:10px">
        @csrf
        <input type="hidden" name="id" value="{{$checklist->id}}">
        <div class="form-group m-3">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title"
                   value="{{!empty(old("title")) ? old("title") : $checklist->title}}"
                   aria-describedby="checklist-title"
                   placeholder="入力例：テンプレート１" name="title">
        </div>
        <div class="form-group m-3" id="items">
            @foreach($items as $key => $item)
                <label for="item-{{$key+1}}">項目{{$key+1}}</label>
                <input type="text" class="form-control items"
                       value="{{!empty(old("item-" . ($key+1))) ?old("item-" . ($key+1)) : $item}}"
                       id="item-{{$key+1}}" name="item-{{$key+1}}">
            @endforeach
        </div>
        <div class="form-group  m-3" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
    </form>
    <form method="POST" action="{{route("checklist.delete")}}" style="padding: 10px">
        @csrf
        <input type="hidden" value="{{$checklist->id}}" name="id">
        <div class="form-group m-3" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="btn btn-danger">削除する</button>
        </div>
    </form>
</div>
@include("template.footer")
