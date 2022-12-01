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
