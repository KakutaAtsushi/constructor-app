@include("template.header")
<div class="form-group row" style="margin-left:750px;">
    <div class="col-6">
        <input type="date" id="search_date" class="col-4 form-control">
    </div>
    <div class="col-6">
        <button type="button" onClick="searchDate()" id="search_btn" class="col-4 btn btn-primary">検索</button>
    </div>
</div>
<div id='calendar' class="p-5"></div>
@include("template.footer")
<script>
    const searchDate = () => {
        let date = document.getElementById("search_date").value
        let data = document.querySelector('[data-date="' + date + '"]')
        data.firstElementChild.firstElementChild.firstElementChild.click();
        document.getElementById("search_btn").disabled = true;
    }
</script>
