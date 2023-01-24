</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
<script>
    construct_notify = () => {
        Push.close('myTag');
            axios.get('https://shyu-web.sakura.ne.jp/public/remind').then(async response => {
                if (response.data !== false) {
                    await Push.create("工事の三日前になりました", {
                        body: response.data["location"],
                        tag: "test",
                        timeout: 7000,
                        vibrate: [100, 100, 100],
                        onClick: function (e) {
                            window.open(`https://shyu-web.sakura.ne.jp/public/construct/edit/${response.data["id"]}`);
                        },
                    })
                    Push.close('test');
                }
                return null;
            }).catch(error => {
                console.log(error);
            })
    }
    office_notify = () => {
        axios.get('https://shyu-web.sakura.ne.jp/public/api').then(async response => {
            if (response.data !== false) {
                Push.close('test');
                await Push.create("営業所が登録されました", {
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
            return null;
        }).catch(error => {
            console.log(error);
        });
    }
    window.addEventListener('DOMContentLoaded', async () => {
            // 1. Permissionの確認
            if (!Push.Permission.has()) {
                // 2. Permissionのリクエスト
                Push.Permission.request(() => {
                    console.log("onGranted!!");
                }, () => {
                    console.log("onDenied!!");
                });
            } else {
                setInterval(async () => {
                    await construct_notify()
                    await office_notify()
                }, 1000)
            }
        }
    )
</script>
</html>
