let selectBox = document.getElementById("real_work");
let flag = document.getElementById("render_flag").value;
let editMode = location.search.split("=");
let href_select = location.href.includes("create")
let uri_edit = location.href.includes("edit")

document.getElementById("real_work").addEventListener("click", () => {
    if (!flag) {
        let startedAt = document.getElementById("started_at").value;
        let endedAt = document.getElementById("ended_at").value;
        if (startedAt !== null || endedAt !== null) {
            let startDate = new Date(startedAt);
            let endDate = new Date(endedAt);
            let diffMilliSec = endDate - startDate;
            let diffDays = parseInt(diffMilliSec / 1000 / 60 / 60 / 24);
            console.error(diffDays)
            for (let i = 0; i < diffDays+1; i++) {
                let option = document.createElement("option");
                option.text = i.toString();
                option.value = i.toString();
                option.className = "add_option";
                document.getElementById("real_work").appendChild(option);
            }
            flag = true;
        }
    }
})


document.getElementById("started_at").addEventListener("click", () => {
    if (editMode[1] === "true" || href_select) {

        while (selectBox.firstChild) {
            selectBox.removeChild(selectBox.firstChild);
        }
        let option = document.createElement("option");
        document.getElementById("real_work").appendChild(option);
        flag = false;
    }
})
document.getElementById("ended_at").addEventListener("click", () => {
    if (editMode[1] === "true" || href_select) {

        while (selectBox.firstChild) {
            selectBox.removeChild(selectBox.firstChild);
        }
        let option = document.createElement("option");
        option.text = "選択してください";
        option.value = "0";
        document.getElementById("real_work").appendChild(option);
        flag = false;
    }
})
window.addEventListener("load", function () {

    if (editMode[1] === "true" && uri_edit) {

        let startedAt = document.getElementById("started_at").value;
        let endedAt = document.getElementById("ended_at").value;
        if (startedAt !== null || endedAt !== null) {
            while (selectBox.firstChild) {
                selectBox.removeChild(selectBox.firstChild);
            }
            let startDate = new Date(startedAt);
            let endDate = new Date(endedAt);
            let diffMilliSec = endDate - startDate;
            let diffDays = parseInt(diffMilliSec / 1000 / 60 / 60 / 24);
            let selected = document.getElementById("worktime").value;
            for (let i = 0; i < diffDays; i++) {
                let option = document.createElement("option");
                option.text = i.toString();
                option.value = i.toString();
                option.className = "add_option";
                if(i == selected){option.selected = true;}
                document.getElementById("real_work").appendChild(option);
            }
            flag = true;
        }
    }
})

