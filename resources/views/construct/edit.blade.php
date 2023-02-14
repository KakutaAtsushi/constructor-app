@include("template.header")

<div class="card mb-3">
    <div class="row">
        <h2 class="title col-4">@if($edit_mode)工事情報編集（編集中） @else 工事情報編集@endif</h2>
    </div>
    <form method="POST" action="{{route("construct.update")}}">
        @csrf
        <input type="hidden" value="{{$construct_data->id}}" name="construct_id">
        <div class="form-group m-3">
            <label for="location">影響発生場所</label>
            <input type="text" class="form-control" id="location" value="{{$construct_data->location}}"
                   aria-describedby="construct-location" name="location" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="coordinate">座標</label>
            <input type="text" class="form-control" id="coordinate" value="{{$construct_data->coordinate}}"
                   aria-describedby="construct-coordinate"
                   name="coordinate"  @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3" style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-outline-secondary" onclick="href()" @if($edit_mode) @else disabled @endif>GoogleMapを開く
            </button>
        </div>
        <div class="form-group m-3 row">
            <label for="editor">情報登録者</label>
            <div class="col">
                <label for="department">部署</label>
                <input type="text" class="form-control" id="department"
                       value="{{$construct_data->department}}"
                       aria-describedby="construct-start" name="department" @if($edit_mode) @else readonly @endif>
            </div>
            <div class="col">
                <label for="username">氏名</label>
                <input type="text" class="form-control" id="username" value="{{$construct_data->username}}"
                       aria-describedby="construct-end" name="username" @if($edit_mode) @else readonly @endif>
            </div>
        </div>
        <div class="form-group m-3">
            <label for="business_name">工事担当者</label>
            <input type="text" class="form-control" id="business_name" value="{{$construct_data->business_name}}"
                   aria-describedby="construct-editor" name="business_name" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="route">路線</label>
            <input type="text" class="form-control" id="route" value="{{$construct_data->route}}"
                   aria-describedby="construct-route" name="route" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="route">最寄りバス停</label>
            <input type="text" class="form-control" id="bus_station" value="{{$construct_data->bus_station}}"
                   aria-describedby="construct-route" name="bus_station" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-check m-3 form-group">
            <div class="checkbox-inline">
                <input type="checkbox" class="form-check-input" name="relocation_bus" value="1"
                       id="relocation_bus" @if($construct_data->bus_relocation_flag === 1) checked @endif  @if($edit_mode) @else disabled @endif>
                <label class="form-check-label" for="relocation_bus">バス停の移設</label>
            </div>
            <div class="checkbox-inline">
                <input type="checkbox" class="form-check-input" name="stopped_bus" value="1"
                       id="stopped_bus" @if($construct_data->stopped_bus_flag === 1) checked @endif  @if($edit_mode) @else disabled @endif>
                <label class="form-check-label" for="stopped_bus">バス停の休止</label>
            </div>
            <div class="checkbox-inline">
                <input type="checkbox" class="form-check-input" name="detour" value="1"
                       id="detour" @if($construct_data->detour_flag === 1) checked @endif  @if($edit_mode) @else disabled @endif>
                <label class="form-check-label" for="detour">迂回運転</label>
            </div>
        </div>
        <div class="form-group m-3">
            <label for="office">営業所</label>
            @foreach($offices as $key => $office)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="office-{{$key}}" value="{{$office}}"
                           id="check-{{$key}}" @if($edit_mode) @else disabled @endif @if($construct_office_ids !==[])@foreach($construct_office_ids as $ids) @if($key+1 === $ids) checked @endif @endforeach @endif>
                    <label class="form-check-label" for="check-{{$key}}">{{$office}}</label>
                </div>
            @endforeach
        </div>
        <div class="form-group m-3">
            <label for="exampleInputPassword1">障害内容</label>
            <select class="form-select" aria-label="Default select example" name="detail" @if($edit_mode) @else disabled @endif>
                <option value="無し" @if($construct_data->detail === "無し") selected @endif>無し</option>
                <option value="通行止め" @if($construct_data->detail === "通行止め") selected @endif>通行止め</option>
                <option value="片側交互通行" @if($construct_data->detail === "片側交互通行") selected @endif>片側交互通行</option>
                <option value="車線減少" @if($construct_data->detail === "車線減少") selected @endif>車線減少</option>
                <option value="幅員減少" @if($construct_data->detail === "幅員減少") selected @endif>幅員減少</option>
                <option value="その他" @if($construct_data->detail === "その他") selected @endif>その他</option>
            </select>
        </div>
        <div class="form-group m-3" id="items">
            <label for="news">お知らせ</label>
            <input type="text" class="form-control items" id="news" value="{{old("news")}}"
                   aria-describedby="news"
                   placeholder="お知らせ" name="news" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="started_at">工事開始日</label>
            <input type="datetime-local" class="form-control" id="started_at" value="{{$construct_data->started_at}}"
                   aria-describedby="construct-started_at" name="started_at" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <input type="hidden" id="selected" value="@if(!empty($construct_data->real_work_time)) {{$construct_data->real_work_time}} @endif">
            <input type="hidden" id="render_flag" value="false">

            <label for="ended_at">実質作業期間</label>
            <input type="hidden" id="worktime" value="{{$construct_data->real_work_time}}">
                <select class="form-select" id="real_work" name="real_work" aria-label="Default select example" @if($edit_mode) @else disabled @endif>
                    <option value="0" @if(!isset($construct_data->real_work_time)) selected @endif>0</option>
                    <option value="" @if(isset($construct_data->real_work_time)) selected @endif>{{$construct_data->real_work_time}}</option>
                </select>
        </div>
        <div class="form-group m-3">
            <label for="ended_at">工事終了日</label>
            <input type="datetime-local" class="form-control" id="ended_at" value="{{$construct_data->ended_at}}"
                   aria-describedby="construct-ended_at" name="ended_at" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3 row">
            <label for="notify_time">リマインド期間</label>
            <input type="number" class="form-control" min="0" max="365" value="{{$construct_data->notify_time}}" id="notify_time" aria-describedby="construct-notify_time"
                   name="notify_time"  @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3 row">
            <label for="remarks">備考</label>
            <input type="text" class="form-control" min="0" max="365" value="{{$construct_data->remarks}}" id="remarks" aria-describedby="construct-remarks"
                   name="remarks"  @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group iframe">
{{--            <iframe src="https://www.google.com/maps?output=embed&q={{$construct_data->location}}&z=15"--}}
            <iframe src="https://www.google.com/maps?output=embed&q={{$construct_data->coordinate ?? $construct_data->location}}"
                    width="1000"
                    height="650"
                    style="border:0"
                    allowfullscreen>
            </iframe>

        </div>
        @if($edit_mode)
            <div class="form-group m-3" style="text-align:right; margin-right: 40px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">更新する</button>
            </div>
        @else
            <div class="form-group m-3" style="text-align:right; margin-right: 40px; margin-top: 30px;">
                <button type="button" class="btn btn-warning" onclick="editButton({{$construct_data->id}})">編集する
                </button>
            </div>
        @endif
    </form>
    <form method="POST" action="{{route("construct.delete")}}">
        @csrf
        <input type="hidden" value="{{$construct_data->id}}" name="construct_id">
        <div class="form-group m-3" style="text-align:right; margin-right: 40px; margin-top: 30px;">
            <button type="submit" class="btn btn-danger">削除する</button>
        </div>
    </form>
</div>

@include("template.footer")
<script src="{{asset("js/select.js")}}"></script>
<script src="{{asset("js/googlemap.js")}}"></script>
<script>
    const editButton = id => {
        document.location.href = `/public/construct/edit/${id}?edit_mode=true`
    }
</script>
