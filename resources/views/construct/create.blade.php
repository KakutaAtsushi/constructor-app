@include("template.header")
<div class="card">
    <div class="row">
        <h2 class="title col-4">路線障害情報登録</h2>
    </div>
    <form method="POST" action="{{route("construct.store")}}" style="padding:30px">
        @csrf
        <div class="form-group m-3">
            <label for="business_name">工事担当者</label>
            <input type="text" class="form-control" id="business_name" value="{{old("business_name")}}"
                   aria-describedby="construct-business_name"
                   placeholder="入力例：株式会社テスト" name="business_name" required>
        </div>
        <div class="form-group m-3 row">
            <label for="editor">情報登録者</label>
            <div class="col">
                <label for="department">部署</label>
                <input type="text" class="form-control" id="department" value="{{old("department")}}"
                       aria-describedby="construct-start" name="department" required>
            </div>
            <div class="col">
                <label for="username">氏名</label>
                <input type="text" class="form-control" id="username" value="{{old("username")}}"
                       aria-describedby="construct-end" name="username" required>
            </div>
        </div>

        <div class="form-group m-3">
            <label for="location">影響発生場所</label>
            <input type="text" class="form-control" id="location" value="{{old("location")}}"
                   aria-describedby="construct-location"
                   placeholder="入力例：大阪府東大阪市島之内４丁目３８－５" name="location" required>
        </div>
        <div class="form-group m-3" style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-outline-secondary" onclick="href()">GoogleMapを開く
            </button>
        </div>
        <div class="form-group m-3">
            <label for="coordinate">座標</label>
            <input type="text" class="form-control" id="coordinate" value="{{old("coordinate")}}"
                   aria-describedby="construct-coordinate"
                   placeholder="入力例：35.8076097,139.9349548" name="coordinate" >
        </div>

        <div class="form-group m-3">
            <label for="exampleInputPassword1">障害内容</label>
            <select class="form-select" aria-label="Default select example" name="detail">
                <option selected value="無し">選択してください</option>
                <option value="通行止め">通行止め</option>
                <option value="片側交互通行">片側交互通行</option>
                <option value="車線減少">車線減少</option>
                <option value="幅員減少">幅員減少</option>
                <option value="その他">その他</option>
            </select>
        </div>

        <div class="form-group m-3" id="items">
            <label for="route">路線</label>
            <input type="text" class="form-control items" id="item-1" value="{{old("item-1")}}"
                   aria-describedby="construct-route"
                   placeholder="入力例：○○線" name="item-1" required>
        </div>
        <div class="form-group m-3" style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-outline-secondary" onclick="incrementItem('construct')">+ 路線の追加
            </button>
        </div>

        <div class="form-group m-3">
            <label for="bus_station">最寄りバス停</label>
            <input type="text" class="form-control" id="bus_station" value="{{old("bus_station")}}"
                   aria-describedby="construct-bus_station"
                   placeholder="入力例：枚方駅" name="bus_station" required>
        </div>
        <div class="form-group m-3">
            <div class="form-check form-group">
                <div class="checkbox-inline">
                    <input type="checkbox" class="form-check-input" name="relocation_bus" value="1"
                           id="relocation_bus">
                    <label class="form-check-label" for="relocation_bus">バス停の移設</label>
                </div>
                <div class="checkbox-inline">
                    <input type="checkbox" class="form-check-input" name="stopped_bus" value="1"
                           id="stopped_bus">
                    <label class="form-check-label" for="stopped_bus">バス停の休止</label>
                </div>
                <div class="checkbox-inline">
                    <input type="checkbox" class="form-check-input" name="detour" value="1"
                           id="detour">
                    <label class="form-check-label" for="detour">迂回運転</label>
                </div>
            </div>
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
                       aria-describedby="construct-start" name="start" required>
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
                    <option value="" selected>選択してください</option>
                </select>
            </div>
        </div>
        <div class="form-group m-3 row">
            <label for="notify_time">リマインド期間</label>
            <input type="number" value="{{old("notify_time")}}" min="0" max="365" class="form-control" id="notify_time" aria-describedby="construct-notify_time"
                   name="notify_time">
        </div>
        <div class="form-group" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="flex btn btn-primary">登録する</button>
        </div>
    </form>
</div>
@include("template.footer")
<script src="{{asset("js/googlemap.js")}}"></script>
<script src="{{asset("js/checkbox.js")}}"></script>
<script src="{{asset("js/select.js")}}"></script>
<script src="{{asset("js/increment.js")}}"></script>
