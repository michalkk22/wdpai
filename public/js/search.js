const search = document.querySelector('input[placeholder="Search"]');
const postContainer = document.querySelector('main');

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = { search: this.value };

        if (this.value.trim() === "") {
            fetch('/main')
                .then(response => response.text()) // Get HTML as a string
                .then(html => {
                    const temp = document.createElement('div'); // Create a temporary container
                    temp.innerHTML = html; // Insert fetched HTML

                    const newPosts = temp.querySelectorAll('.post-list-element'); // Select posts
                    postContainer.innerHTML = ""; // Clear old posts

                    newPosts.forEach(post => postContainer.appendChild(post)); // Append new posts
                });
        }

        fetch('/search', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (posts) {
            postContainer.innerHTML = "";
            loadPosts(posts);
        });
    }
});

function loadPosts(posts) {
    posts.forEach(post => {
        console.log(post);
        createPost(post);
    });
}

function createPost(post) {
    const template = document.querySelector('#post-template');

    const clone = template.content.cloneNode(true);

    const topic = clone.querySelector('h3');
    topic.innerHTML = post.topic;
    const category = clone.querySelector('.category');
    category.innerHTML = post.category;
    const date = clone.querySelector('.date');
    date.innerHTML = post.datetime;
    const content = clone.querySelector('.post-content');
    content.innerHTML = post.content;

    postContainer.appendChild(clone);
}

// category-search
const categorySelect = document.getElementById('category-select');

categorySelect.addEventListener("change", function () {
    const categoryId = this.value;

    if (!categoryId) {
        // If no category is selected, fetch all posts (just like with the empty search input)
        fetch('/main')
            .then(response => response.text())
            .then(html => {
                const temp = document.createElement('div');
                temp.innerHTML = html;
                const newPosts = temp.querySelectorAll('.post-list-element');
                postContainer.innerHTML = "";
                newPosts.forEach(post => postContainer.appendChild(post));
            });
    } else {
        // Fetch posts for the selected category
        const data = { categoryId: categoryId };

        fetch('/categorySearch', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
            .then(posts => {
                postContainer.innerHTML = "";
                loadPosts(posts);
            });
    }
});
