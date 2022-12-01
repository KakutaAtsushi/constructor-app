@include("template.header")

<div class="card">
    <div class="row">
        <div class="col-4">
            <h2 class="title">工事情報管理</h2>
        </div>
        <form style="display:flex; align-items: center" class="col-8">
            <input type="text" value="{{request("search")}}" class="form-control" name="search" style="width:70%; height: 35px;">
            <button type="submit" class="btn btn-outline-dark" style=" width:100px; height: 35px;">#タグ検索</button>
        </form>
    </div>
    <div class="create">
        <a href="{{route("construct.create")}}">
            <button type="button" class="btn btn-outline-success">+ 新規作成</button>
        </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">＃タグ</th>
                <th scope="col">工事場所</th>
                <th scope="col">営業所</th>
                <th scope="col">工事内容</th>
                <th scope="col">工事開始日</th>
                <th scope="col">工事終了日</th>
                <th scope="col">GoogleMapで見る</th>
            </tr>
            </thead>
            <tbody>
            @foreach($constructs as $construct)
                <tr>
                    <td>{{$construct->hashtag}}</td>
                    <td>{{$construct->location}}</td>
                    <td>{{$construct->office}}</td>
                    <td>{{$construct->detail}}</td>
                    <td>{{$construct->started_at}}</td>
                    <td>{{$construct->ended_at}}</td>
                    <td><a href="/construct/edit/{{$construct->id}}">GoogleMap / 編集</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include("template.footer")

