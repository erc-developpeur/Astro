function addComment() {
    let commentInput = document.getElementById("commentInput");
    let commentText = commentInput.value.trim();

    if (commentText === "") {
        alert("Veuillez écrire un commentaire !");
        return;
    }

    let commentList = document.getElementById("commentList");
    let newComment = document.createElement("div");
    newComment.classList.add("comment");
    newComment.innerText = commentText;

    commentList.appendChild(newComment);
    commentInput.value = ""; // Effacer le champ après l'envoi
}