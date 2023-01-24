</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        // 1. Permissionの確認
        if (!Push.Permission.has()) {
            // 2. Permissionのリクエスト
            Push.Permission.request(() => {
                console.log("onGranted!!");
            }, () => {
                console.log("onDenied!!");
            });
        } else {
            setInterval(() => {
                axios.get('https://shyu-web.sakura.ne.jp/public/api').then(response => {
                    Push.create(response.data + "が登録されました", {
                        tag: "myTag",
                        timeout: 10000,
                        vibrate: [100, 100, 100],
                        onClick: function (e) {
                            console.log("onClick", e);
                        },
                        onShow: function (e) {
                            console.log("onShow", e);
                        },
                        onClose: function (e) {
                            console.log("onClose", e);
                        },
                        onError: function (e) {
                            console.log("onError", e);
                        }
                    });
                }).catch(error => {
                    console.log(error);
                });
            }, 1000)
        }
    });
</script>
</html>
