@include("template.header")
<div class="card">
    <div class="row">
        <h2 class="title col-4">工事情報登録</h2>
    </div>
    <form method="POST" action="{{route("construct.store")}}" style="padding:30px">
        @csrf
        <div class="form-group m-3">
            <label for="business_name">事業者名</label>
            <input type="text" class="form-control" id="business_name" value="{{old("business_name")}}"
                   aria-describedby="construct-business_name"
                   placeholder="入力例：株式会社テスト" name="business_name">
        </div>
        <div class="form-group m-3">
            <label for="editor">編集者名</label>
            <input type="text" class="form-control" id="editor" value="{{old("editor")}}"
                   aria-describedby="construct-editor"
                   placeholder="入力例：山田　タロウ" name="editor">
        </div>

        <div class="form-group m-3">
            <label for="location">工事場所</label>
            <input type="text" class="form-control" id="location" value="{{old("location")}}"
                   aria-describedby="construct-location"
                   placeholder="入力例：大阪府東大阪市島之内４丁目３８－５" name="location">
        </div>
        <div class="form-group m-3">
            <label for="exampleInputPassword1">工事内容</label>
            <select class="form-select" aria-label="Default select example" name="detail">
                <option selected>選択してください</option>
                <option value="通行止め">通行止め</option>
                <option value="片側交互通行">片側交互通行</option>
                <option value="車線減少">車線減少</option>
                <option value="幅員減少">幅員減少</option>
                <option value="その他">その他</option>
            </select>
        </div>

        <div class="form-group m-3"  id="items">
            <label for="route">路線</label>
            <input type="text" class="form-control items" id="item-1" value="{{old("item-1")}}"
                   aria-describedby="construct-route"
                   placeholder="入力例：○○線" name="item-1">
        </div>
        <div class="form-group m-3" style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-outline-secondary" onclick="incrementItem('construct')">+ 路線の追加</button>
        </div>

        <div class="form-group m-3">
            <label for="bus_station">最寄りバス停</label>
            <input type="text" class="form-control" id="bus_station" value="{{old("bus_station")}}"
                   aria-describedby="construct-bus_station"
                   placeholder="入力例：枚方駅" name="bus_station">
        </div>
        <div class="form-group m-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="relocation_bus" value=""
                       id="relocation_bus">
                <label class="form-check-label" for="relocation_bus">バス停の移設</label>
            </div>
        </div>
        <div class="form-group m-3">
            <label for="hashtag">ハッシュタグ</label>
            <input type="text" class="form-control" id="hashtag"
                   value="{{!empty(old("hashtag")) ? old("hashtag") : "#"}}"
                   aria-describedby="construct-hashtag"
                   placeholder="#" name="hashtag">
        </div>
        <div class="form-group m-3">
            <label>営業所</label>
            @foreach($offices as $key => $office)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="office-{{$key}}" value="{{$office}}"
                           id="check-{{$key}}">
                    <label class="form-check-label" for="check-{{$key}}">{{$office}}</label>
                </div>
            @endforeach
            <button type="button" onClick="onAllCheck()" id="onChecked" class="btn btn-danger btn-sm mt-4">全営業所をチェックする
            </button>
        </div>
        <div class="form-group m-3 row">
            <label for="remarks">備考</label>
            <textarea class="form-control" id="remarks" aria-describedby="construct-remarks"
                      name="remarks">{{old("remarks")}}</textarea>
        </div>
        <div class="form-group m-3 row">
            <div class="col">
                <label for="started_at">工事開始期間</label>
                <input type="datetime-local" class="form-control" id="started_at" value="{{old("start")}}"
                       aria-describedby="construct-start" name="start">
            </div>
            <div class="col">
                <label for="ended_at">工事終了期間</label><label style="color:red;float: right;">※不明の場合は入力無し</label>
                <input type="datetime-local" class="form-control" id="ended_at" value="{{old("end")}}"
                       aria-describedby="construct-end" name="end">
            </div>
            <div class="col">
                <input type="hidden" id="render_flag" value="false">
                <label for="ended_at">実質作業期間</label>
                <select class="form-select" id="real_work" name="real_work" aria-label="Default select example">
                    <option selected>選択してください</option>
                </select>
            </div>
        </div>
        <div class="form-group" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="flex btn btn-primary">登録する</button>
        </div>
    </form>
</div>
@include("template.footer")
<script src="{{asset("js/checkbox.js")}}"></script>
<script src="{{asset("js/select.js")}}"></script>
<script src="{{asset("js/increment.js")}}"></script>
