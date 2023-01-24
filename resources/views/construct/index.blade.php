@include("template.header")

<div class="card">
    <div class="row">
        <div class="col-4">
            <h2 class="title">工事情報管理</h2>
        </div>
        <form style="display:flex; align-items: center" class="col-4">
            <select class="form-select" aria-label="Default select example" name="search" style="width:70%; height: 35px;">
                <option value="" selected>選択してください</option>
                @foreach($offices as $office)
                    <option id="{{$office}}" value="{{$office}}">{{$office}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-dark" style="font-size:12px; width:100px; height: 35px;">#営業所検索</button>
        </form>
        <button id="my_btn">Push</button>
        <form style="display:flex; align-items: center" class="col-4">
            <input type="text" value="{{old("search")}}" class="form-control" name="search" style="width:70%; height: 35px;">
            <button type="submit" class="btn btn-outline-dark" style="font-size:12px; width:100px; height: 35px;margin-right: 15px;">#タグ検索</button>
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
                <th scope="col">位置を確認する</th>
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
                    <td><a href="/public/construct/edit/{{$construct->id}}">詳細確認</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include("template.footer")
<script src="{{asset("js/selected.js")}}"></script>

