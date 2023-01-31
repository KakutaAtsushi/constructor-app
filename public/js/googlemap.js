let href = () => {
    let location = document.getElementById("location").value
    if (location !== "") {
        window.open(`https://www.google.co.jp/maps/place/${location}`);
    }
    else{
        alert("影響発生場所の入力をしてください")
    }
}
