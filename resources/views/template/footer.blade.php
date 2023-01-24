</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
<script>
// window.addEventListener('DOMContentLoaded', function(){
//   setInterval(() => {
//
//   axios.get('https://shyu-web.sakura.ne.jp/public/api').then(response => {
//     alert(response.data+"が登録されました");
//
//
//   }).catch(error => {
//
//     console.log(error);
//   });
//   }, 1000)
// });
</script>
<script>
    $(document).ready(()=>{
        console.log("Ready!!");

        // ボタンイベント
        $("#my_btn").click(()=>{
            console.log("Push");

            // 1. Permissionの確認
            if(!Push.Permission.has()){
                // 2. Permissionのリクエスト
                Push.Permission.request(()=>{
                    console.log("onGranted!!");
                    const status = Push.Permission.get();// Status
                    $("#my_status").text(status);
                }, ()=>{
                    console.log("onDenied!!");
                    const status = Push.Permission.get();// Status
                    $("#my_status").text(status);
                });
            }else{
                // 3. Notificationの実行
                Push.create("こんにちは!!", {
                    body: "ゆっくり霊夢です!!",
                    tag: "myTag",
                    timeout: 12000,
                    vibrate: [100, 100, 100],
                    onClick: function(e){
                        console.log("onClick", e);
                    },
                    onShow: function(e){
                        console.log("onShow", e);
                    },
                    onClose: function(e){
                        console.log("onClose", e);
                    },
                    onError: function(e){
                        console.log("onError", e);
                    }
                });
            }
        });
    });
</script>
</html>
