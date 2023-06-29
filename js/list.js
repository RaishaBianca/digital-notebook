function addItem(element) {
    var listItem = document.createElement("div");
    listItem.className = "list-item";
    listItem.innerHTML = `
      <input name="list_items[]" type="text" placeholder="Add list item" size="100">
      <div class="add-item" onclick="addItem(this)">+</div>
      <div class="remove-item" onclick="removeItem(this)">-</div>
    `;
    element.parentNode.insertBefore(listItem, element.nextSibling);
  }

  function removeItem(element) {
    element.parentNode.remove();
  }