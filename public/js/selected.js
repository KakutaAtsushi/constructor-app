window.addEventListener("load", () => {
    const url = new URL(window.location);
    const paramsArray = url.search.split("=");
    const params = decodeURI(paramsArray[1]);
    document.getElementById(params).selected = true;
})
