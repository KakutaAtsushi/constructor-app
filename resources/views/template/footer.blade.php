</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
<script>
    construct_notify = () => {
            axios.get('https://shyu-web.sakura.ne.jp/public/remind').then(async response => {
                console.error("success")
            }).catch(error => {
                console.log(error);
            })
    }
            setInterval(async () => {
                await construct_notify()
            }, 1000)
        })
</script>
</html>
