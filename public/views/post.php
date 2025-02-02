<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/style.css">
    <title>startalk</title>
</head>

<body>
    <!-- <script type="text/javascript" src="./public/js/textarea_rows_adjuster.js"></script> -->
    <div class="base-container">
        <nav class="desktop">
            <img src="/public/img/logo_small.svg" alt="" onclick="window.location.href='/main'">
            <h1 onclick="window.location.href='/main'">startalk</h1>
            <button onclick="window.location.href='/logout'">logout</button>
        </nav>
        <nav class="mobile">
            <button onclick="window.location.href='/main'">back</button>
            <img src="/public/img/logo_small.svg" alt="" onclick="window.location.href='/main'">
            <button class="placeholder"></button>
        </nav>
        <main>
            <div class="post">
                <!-- TODO display email -->
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
                <div class="post-fullcontent">
                    <?= $post->getContent(); ?>
                </div>

                <?php if ($_SESSION['user_id'] == $post->getOwnerId() || $_SESSION['is_admin']): ?>
                    <div class="right">
                        <form class="delete-post-form" action="/deletePost" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post->getId(); ?>">
                            <button type="submit" class="reverse-color">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            <div class="comment-form-container">
                <form class="comment-form" action="/createComment" method="POST">
                    <input type="hidden" name="post_id" value="<?= $post->getId(); ?>">
                    <textarea class="post-textarea" name="text" id="text"
                        placeholder="Write your answer here..."></textarea>
                    <div>
                        <button type="submit" class="reverse-color">submit</button>
                    </div>
                </form>
            </div>
            <div class="comments-container">
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" data-comment-id="<?= $comment->getId(); ?>">
                        <h3>
                            <?= $comment->getAuthor(); ?>
                        </h3>
                        <div class="date">
                            <?= $comment->getDatetime(); ?>
                        </div>
                        <div class="comment-content">
                            <?= $comment->getText(); ?>
                        </div>
                        <?php if ($_SESSION['user_id'] == $comment->getAuthorId() || $_SESSION['is_admin']): ?>
                            <form class="delete-comment-form" action="/deleteComment" method="POST">
                                <input type="hidden" name="comment_id" value="<?= $comment->getId(); ?>">
                                <input type="hidden" name="post_id" value="<?= $post->getId(); ?>">
                                <button type="submit" class="reverse-color">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <!-- <div class="comment">
                    <h3>VeryCoolNickname</h3>
                    <div class="date">
                        12:00 01.01.2025
                    </div>
                    <div class="comment-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis dapibus massa, sed
                        porta libero aliquet quis. Donec at lobortis nisi.
                    </div>
                </div> -->
            </div>
        </main>
    </div>
</body>

</html>