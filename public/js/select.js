let selectBox = document.getElementById("real_work");
let flag = document.getElementById("render_flag").value;
let editMode = location.search.split("=");
let href = location.href.includes("create")
document.getElementById("real_work").addEventListener("click", () => {
    if (!flag) {
        let startedAt = document.getElementById("started_at").value;
        let endedAt = document.getElementById("ended_at").value;
        if (startedAt !== null || endedAt !== null) {
            let startDate = new Date(startedAt);
            let endDate = new Date(endedAt);
            let diffMilliSec = endDate - startDate;
            let diffDays = parseInt(diffMilliSec / 1000 / 60 / 60 / 24);
            if (!Math.sign(diffDays)) {
                return;
            }
            for (let i = 0; i < diffDays; i++) {
                let option = document.createElement("option");
                option.text = (i + 1).toString();
                option.value = (i + 1).toString();
                option.className = "add_option";

                document.getElementById("real_work").appendChild(option);
            }
            flag = true;
        }
    }
})


document.getElementById("started_at").addEventListener("click", () => {
    if (editMode[1] === "true" || href) {

        while (selectBox.firstChild) {
            selectBox.removeChild(selectBox.firstChild);
        }
        let option = document.createElement("option");
        option.text = "選択してください";
        document.getElementById("real_work").appendChild(option);
        flag = false;
    }
})
document.getElementById("ended_at").addEventListener("click", () => {
    if (editMode[1] === "true" || href) {

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

    if (editMode[1] === "true") {

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
            if (!Math.sign(diffDays)) {
                return;
            }
            let selected = document.getElementById("worktime").value;
            for (let i = 0; i < diffDays; i++) {
                let option = document.createElement("option");
                option.text = (i + 1).toString();
                option.value = (i + 1).toString();
                option.className = "add_option";
                if(i+1 == selected){option.selected = true;}

                document.getElementById("real_work").appendChild(option);
            }
            flag = true;
        }
    }
})

