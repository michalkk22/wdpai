<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/style.css">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/main_nav.js" defer></script>
    <title>startalk</title>
</head>

<body>
    <div class="base-container">
        <nav class="desktop">
            <img src="public/img/logo_small.svg" alt="">
            <h1>startalk</h1>
            <div class="column">
                <button>logout</button>
                <button>create</button>
            </div>
        </nav>
        <nav class="mobile">
            <button>logout</button>
            <img src="public/img/logo_small.svg" alt="">
            <button>post</button>
        </nav>
        <header>
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <img src="public/img/search_icon.svg" alt="">
            </div>
            <div class="category-select">
                <select id="category-select">
                    <option value="">Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->getId(); ?>">
                            <?= ucfirst($category->getName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </header>
        <main>
            <?php foreach ($posts as $post): ?>
                <div class="post-list-element" data-post-id="<?= $post->getId(); ?>">
                    <h3>
                        <?= $post->getTopic(); ?>
                    </h3>
                    <div class="category-and-date">
                        <div class="category">
                            <?= $post->getCategory(); ?>
                        </div>
                        <div class="date">
                            <?= $post->getDatetime(); ?>
                        </div>
                    </div>
                    <div class="post-content">
                        <?= $post->getContent(); ?>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- <div class="post-list-element">
                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                <div class="category-and-date">
                    <div class="category">
                        Category
                    </div>
                    <div class="date">
                        12:00 01.01.2025
                    </div>
                </div>
                <div class="post-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis dapibus massa, sed porta
                    libero aliquet quis. Donec at lobortis nisi.

                    Nullam a felis placerat, commodo leo vel, feugiat enim. Fusce et bibendum ligula. Fusce quis nisi
                    purus. Aenean ornare cursus bibendum. Morbi congue urna eu augue iaculis, ac eleifend massa maximus.
                    Maecenas faucibus ipsum finibus, pellentesque nisl at, finibus ante. Orci varius natoque penatibus
                    et magnis dis parturient montes, nascetur ridiculus mus.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis dapibus massa, sed porta
                    libero aliquet quis. Donec at lobortis nisi.

                    Nullam a felis placerat, commodo leo vel, feugiat enim. Fusce et bibendum ligula. Fusce quis nisi
                    purus. Aenean ornare cursus bibendum. Morbi congue urna eu augue iaculis, ac eleifend massa maximus.
                    Maecenas faucibus ipsum finibus, pellentesque nisl at, finibus ante. Orci varius natoque penatibus
                    et magnis dis parturient montes, nascetur ridiculus mus.
                </div>
            </div> -->
        </main>
    </div>
</body>

</html>

<template id="post-template">
    <div class="post-list-element">
        <h3>
            topic
        </h3>
        <div class="category-and-date">
            <div class="category">
                category
            </div>
            <div class="date">
                date
            </div>
        </div>
        <div class="post-content">
            content
        </div>
    </div>
</template>