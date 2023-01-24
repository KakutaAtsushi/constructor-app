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
                    Push.close('myTag');
                    new Promise((resolve) => {
                        axios.get('https://shyu-web.sakura.ne.jp/public/remind').then(response => {
                            console.debug(response.data)
                            if (response.data === false) {
                                Push.create("工事の三日前になりました", {
                                    body: response.data["location"],
                                    tag: "test",
                                    timeout: 7000,
                                    vibrate: [100, 100, 100],
                                    onClick: function (e) {
                                        window.open(`https://shyu-web.sakura.ne.jp/public/construct/edit/${response.data["id"]}`);
                                    },
                                })
                                Push.close('test');
                                resolve();
                            }
                        }).catch(error => {
                            console.log(error);
                            resolve();
                        })
                    }).then(() => {
                        axios.get('https://shyu-web.sakura.ne.jp/public/api').then(response => {
                            if (response.data === false) {
                                Push.close('test');
                                Push.create("営業所が登録されました", {
                                    body: response.data["office"],
                                    tag: "myTag",
                                    timeout: 7000,
                                    vibrate: [100, 100, 100],
                                    onClick: function (e) {
                                        window.open(`https://shyu-web.sakura.ne.jp/public/construct/edit/${response.data["id"]}`);
                                    },
                                });
                                Push.close('myTag');
                            }
                        }).catch(error => {
                            console.log(error);
                        });
                    });
                }, 1000)
            }
        }
    )
</script>
</html>
