@include("template.header")
<div class="card">
    <div class="row">
        <h2 class="title col-4">工事情報登録</h2>
    </div>
    <form method="POST" action="{{route("construct.store")}}" style="padding:30px">
        @csrf
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
        <div class="form-group m-3">
            <label for="hashtag">ハッシュタグ</label>
            <input type="text" class="form-control" id="hashtag" value="{{!empty(old("hashtag")) ? old("hashtag") : "#"}}"
                   aria-describedby="construct-hashtag"
                   placeholder="#" name="hashtag">
        </div>
        <div class="form-group m-3">
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
            <div class="col">
                <label for="started_at">工事開始期間</label>
                <input type="date" class="form-control" id="started_at" value="{{old("start")}}"
                       aria-describedby="construct-start" name="start">
            </div>
            <div class="col">
                <label for="ended_at">工事終了期間</label>
                <input type="date" class="form-control" id="ended_at" value="{{old("end")}}"
                       aria-describedby="construct-end" name="end">
            </div>
        </div>
        <div class="form-group" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="flex btn btn-primary">登録する</button>
        </div>
    </form>
</div>
@include("template.footer")
<script>
    onAllCheck = () => {
        const onCheckedButton = document.getElementById("onChecked");
        const offCheckedButton = document.getElementById("offChecked");
        const check_count = document.getElementsByClassName("form-check-input").length;
        if (onCheckedButton) {
            for (let i = 0; i < check_count; i++) {
                document.getElementById(`check-${i}`).checked = true;
            }
            onCheckedButton.innerText = "全営業所のチェックを外す"
            onCheckedButton.id = "offChecked";
        } else if (offCheckedButton) {
            for (let i = 0; i < check_count; i++) {
                document.getElementById(`check-${i}`).checked = false;
            }
            offCheckedButton.innerText = "全営業所をチェックする"
            offCheckedButton.id = "onChecked";
        }
    }
</script>
