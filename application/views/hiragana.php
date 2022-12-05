<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('ressources/style/quiz.css') ?>" type="text/css">
    <title>Hiragana Quiz</title>
</head>

<body>
    <div class="main">
        <div class="center column">
            <h1>Hiragana Quiz</h1>
            <div class="score center">
                <p class="try">try: <?= $try ?></p>
                <p class="good">good: <?= $good ?></p>
                <p class="error">error: <?= $try - $good ?></p>
            </div>
        </div>

        <div class="center quiz">
            <form class="center column" method="post" action="<?= site_url('Hiragana/checkResponse') ?>">
                <input type="hidden" value="<?= $hiragana ?>" name="hiragana" />
                <p class="center"><?= $hiragana ?></p>
                <input class="text-input" name="response" autofocus> </input>
                <input class="button" type="submit" value="Submit">
            </form>
        </div>

        <?php if (isset($correct)) : ?>
            <div class="center">
                <?php if ($correct) : ?>
                    <p>Correct!</p>
                <?php else : ?>
                    <p><?= $message ?></p>
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>
</body>

</html>