@include("template.header")
<div class="card">
    <div class="row">
        <h2 class="title col-4">チェックリスト登録</h2>
    </div>
    <form method="POST" action="{{route("checklist.store")}}" style="padding:30px">
        @csrf
        <div class="form-group m-3">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" value="{{old("title")}}"
                   aria-describedby="checklist-title"
                   placeholder="入力例：テンプレート１" name="title">
        </div>
        <div class="form-group m-3" id="items">
            <label for="item-1">項目１</label>
            <input type="text" class="form-control items" value=""
                   id="item-1" name="item-1">
        </div>
        <div class="form-group m-3">
            <button type="button" onClick="incrementItem('checklist')" id="increment" class="btn btn-outline-success btn-sm mt-4">
                +　項目を追加
            </button>
        </div>
        <div class="form-group" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="flex btn btn-primary">登録する</button>
        </div>
    </form>
</div>
@include("template.footer")
<script src="{{asset("js/increment.js")}}"></script>
