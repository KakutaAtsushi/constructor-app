onAllCheck = () => {
    const onCheckedButton = document.getElementById("onChecked");
    const offCheckedButton = document.getElementById("offChecked");
    const check_count = document.getElementsByClassName("form-check-input").length - 1;
    if (onCheckedButton) {
        for (let i = 0; i < check_count; i++) {
            document.getElementById(`check-${i}`).checked = true;
        }
        onCheckedButton.innerText = "全営業所のチェックを外す"
        onCheckedButton.id = "offChecked";
    } else if (offCheckedButton) {
        for (let i = 0; i < check_count; i++) {
            document.getElementById(`check-${i}`).checked = false;
        }
        offCheckedButton.innerText = "全営業所をチェックする"
        offCheckedButton.id = "onChecked";
    }
}
