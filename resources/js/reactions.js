const articleLikeBtn = document.getElementById("article-like");
const bookmarkBtn = document.getElementById("bookmark");
const commentBtn = document.getElementById("comment-btn");
const addCommentInput = document.getElementById("add-comment");
const commentLikeBtns = document.querySelectorAll(".comment-like-button");

function addReaction(api,btn,color) {
    fetch(api, {
        method: "post",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        credentials: 'include',
    }).then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.currentStatus) {
                btn.dataset.state = "true"
            } else {
                btn.dataset.state = "false"
            }
        });

    if (btn.dataset.state == "false" || !btn.dataset.state || btn.dataset.state == 0) {
        btn.classList.toggle(`text-${color}-500`);
        btn.children[1].textContent++;
        btn.dataset.state = "true"
    } else {
        btn.classList.toggle(`text-${color}-500`);
        console.log(!btn.dataset.state ? "yess" : "nooo");
        btn.children[1].textContent--;
        btn.dataset.state = "false"
    }
}

function pressAnimation(btn) {
    btn.addEventListener("mousedown", () => {
        btn.classList.add("scale-90");
    })
    btn.addEventListener("mouseup", () => {
        btn.classList.remove("scale-90");
    })
}

function addLike() {
    addReaction(`/article/${articleLikeBtn.dataset.articleId}/like`, articleLikeBtn, "red");
}

function addBookmark() {
    addReaction(`/article/${bookmarkBtn.dataset.articleId}/bookmark`, bookmarkBtn, "yellow");
}

function addCommentLike(btn) {
    addReaction(`/comment/${btn.dataset.commentId}/like`, btn, "red");
}

pressAnimation(articleLikeBtn);
pressAnimation(bookmarkBtn);
pressAnimation(commentBtn);

articleLikeBtn.addEventListener("click", addLike);
bookmarkBtn.addEventListener("click", addBookmark);
commentLikeBtns.forEach(btn => {
        pressAnimation(btn);
    btn.addEventListener("click", () => {
        addCommentLike(btn)
    })
})
commentBtn.addEventListener("click", () => {
    addCommentInput.focus();
})