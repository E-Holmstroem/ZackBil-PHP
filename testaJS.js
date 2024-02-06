let cumbtn = document.getElementById("cumknapp");

cumbtn.addEventListener("click", () => {
    let cum = document.getElementById("cum").value
    console.log(cum);

    document.body.style.width = cum;
})


document.addEventListener('DOMContentLoaded', function () {
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.dataset.comment_id;
            if (confirm("Are you sure you want to delete this comment?")) {
                // You can use AJAX to send a request to the server to delete the comment
                // For simplicity, let's assume there's a delete_comment.php file
                // that handles the deletion

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_comment.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Reload the page or update the comment section as needed
                        location.reload();
                    }
                };
                xhr.send("comment_id=" + commentId);
            }
        });
    });
});

