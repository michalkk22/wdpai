const postElements = document.querySelectorAll('.post-list-element');

postElements.forEach(post => {
    post.addEventListener('click', function () {
        const postId = this.getAttribute('data-post-id');

        window.location.href = `/post/${postId}`;
    });
});
