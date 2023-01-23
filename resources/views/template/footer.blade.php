</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
<script>
window.addEventListener('DOMContentLoaded', function(){
  setInterval(() => {

  axios.get('https://shyu-web.sakura.ne.jp/public/api').then(response => {
    alert(response.data+"が登録されました");


  }).catch(error => {
  
    console.log(error);
  });
  }, 1000)
});
</script>
</html>
