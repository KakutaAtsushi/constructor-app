const incrementItem = (pages) => {
    let item_count = $(".items").length;
    let item_label = $("<label>", {
        for: `item-${item_count + 1}`,
        text: pages !== "construct" ? `項目${item_count + 1}` : `路線${item_count + 1}`
    })
    let item = $("<input>", {
        class: "form-control items",
        name: `item-${item_count + 1}`,
        id: `item-${item_count + 1}`,
    })
    $(`#items`).append(item_label).append(item)
}
