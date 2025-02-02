<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/style.css">
    <title>startalk</title>
</head>

<body>
    <script type="text/javascript" src="./public/js/textarea_rows_adjuster.js"></script>
    <div class="base-container">
        <nav class="desktop">
            <img src="public/img/logo_small.svg" alt="" onclick="window.location.href='/main'">
            <h1 onclick="window.location.href='/main'">startalk</h1>
            <button onclick="window.location.href='/logout'">logout</button>
        </nav>
        <nav class="mobile">
            <button onclick="window.location.href='/main'">back</button>
            <img src="public/img/logo_small.svg" alt="" onclick="window.location.href='/main'">
            <button class="placeholder">create</button>
        </nav>
        <main>
            <div class="create">
                <form class="create-form" action="createPost" method="POST">
                    <div class="message">
                        <?php if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <h4>Topic</h4>
                    <div class="topic-textarea-container">
                        <textarea class="topic-textarea" name="topic" id="topic" maxlength="120"
                            placeholder="Enter your topic here..."></textarea>
                    </div>
                    <h4>Category</h4>
                    <div class="category-select">
                        <select id="category-select" name="category">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->getName(); ?>">
                                    <?= ucfirst($category->getName()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <h4>Text</h4>
                    <div class="create-textarea-container">
                        <textarea class="post-textarea" name="content" id="content"
                            placeholder="Enter text here..."></textarea>
                        <div>
                            <button type="submit" class="reverse-color">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>