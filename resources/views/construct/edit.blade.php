@include("template.header")

<div class="card mb-3">
    <div class="row">
        <h2 class="title col-4">@if($edit_mode)GoogleMapで見る（編集中） @else GoogleMapで見る@endif</h2>
    </div>
    <form method="POST" action="{{route("construct.update")}}">
        @csrf
        <div class="form-group iframe">
            <iframe src="https://www.google.com/maps?output=embed&q={{$construct_data->location}}&z=15"
                    width="1000"
                    height="650"
                    frameborder="0"
                    style="border:0"
                    allowfullscreen>
            </iframe>
        </div>
        <input type="hidden" value="{{$construct_data->id}}" name="construct_id">
        <div class="form-group m-3">
            <label for="location">工事場所</label>
            <input type="text" class="form-control" id="location" value="{{$construct_data->location}}"
                   aria-describedby="construct-location" name="location" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="editor">編集者</label>
            <input type="text" class="form-control" id="editor" value="{{$construct_data->editor}}"
                   aria-describedby="construct-editor" name="editor" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="business_name">事業者</label>
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
            <label style="color:red; font-weight: bold">バス停の移設:</label>@if($construct_data->bus_relocation_flag === 1) 必要 @else 必要なし @endif
        </div>
        <div class="form-group m-3">
            <label for="office">営業所</label>
            <input type="text" class="form-control" id="office" value="{{$construct_data->office}}"
                   aria-describedby="construct-office" name="office" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="detail">工事内容</label>
            <input type="text" class="form-control" id="detail" value="{{$construct_data->detail}}"
                   aria-describedby="construct-detail" name="detail" @if($edit_mode) @else readonly @endif>
        </div>
        <div class="form-group m-3">
            <label for="started_at">工事開始日</label>
            <input type="text" class="form-control" id="started_at" value="{{$construct_data->started_at}}"
                   aria-describedby="construct-started_at" name="started_at" @if($edit_mode) @else readonly @endif>
        </div>
        @if(!empty($construct_data->real_work_time))
            <div class="form-group m-3">
                <input type="text" class="form-control" id="real_work_time" value="内{{$construct_data->real_work_time}}日"
                       aria-describedby="construct-real_work_time" name="real_work_time" @if($edit_mode) @else readonly @endif>
            </div>
        @endif
        <div class="form-group m-3">
            <label for="ended_at">工事終了日</label>
            <input type="text" class="form-control" id="ended_at" value="{{$construct_data->ended_at}}"
                   aria-describedby="construct-ended_at" name="ended_at" @if($edit_mode) @else readonly @endif>
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

<script>
    const editButton = id => {
        document.location.href = `/construct/edit/${id}?edit_mode=true`
    }
</script>
