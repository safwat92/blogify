window.addEventListener("load", () => {
    const sortForm = document.getElementById("sort-form");
    const sortSelect = document.getElementById("sort");
    const orderBtn = document.getElementById("order");
    const btnTextWrapper = document.querySelector("#order > span");
    const btnIcon = document.querySelector("#order > i");
    const orderInput = document.getElementById("order-input");
    const tagBtns = document.querySelectorAll(".tag");

    sortSelect.onchange = () => {
        sortForm.submit();
    }
    
    orderBtn.onclick = () => {
        if (sortSelect.value == 'default') {
            alert("please select filter to sort!");
            return;
        }

        let inputValue = btnTextWrapper.textContent;
        btnTextWrapper.textContent = inputValue == "Ascending" ? "Descending" : "Ascending";
        orderInput.value = inputValue == "Ascending" ? "descending" : "ascending";
        orderBtn.classList.toggle("text-red-500");
        orderBtn.classList.toggle("border-red-500");
        btnIcon.classList.toggle("fa-arrow-down");

        if (sortSelect.value != 'default') {
            sortForm.submit();
        }
    }

    tagBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            let tagInput = document.createElement("input");
            tagInput.type = "hidden";
            tagInput.name = "tag";
            tagInput.value = btn.children[0].dataset.tag;
            btn.appendChild(tagInput);
            sortForm.submit();
        })
    })

    // highlight selected tag
    const urlParams = new URLSearchParams(window.location.search);
    const tags = urlParams.get('tag');
    const selectedTag = document.querySelector(`[data-tag="${tags}"]`);
    if (selectedTag) {
        selectedTag.classList.add("border-green-500", "text-green-500");
    }

})
