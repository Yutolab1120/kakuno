<?php

define('FILENAME', './talk.txt');
date_default_timezone_set('Asia/Tokyo');

$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
$success_message = null;
$error_message = array();
$clean = array();

if ($file_handle = fopen(FILENAME, 'r')) {
    while ($data = fgets($file_handle)) {

        $split_data = preg_split('/\'/', $data);

        $message = array(
            'view_name' => $split_data[1],
            'message' => $split_data[3],
            'post_date' => $split_data[5]
        );
        array_unshift($message_array, $message);
    }
    fclose($file_handle);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="bagelee">

    <!--ogp setting-->
    <meta name="twitter:site" content="@Yutolab1120">
    <meta name="twitter:description" content="Kakuno - 創る・楽しむ">
    <meta name="twitter:title" content="Kakuno">
    <meta name="twitter:url" content="https://kakuno.glitch.me/main.php">
    <meta name="twitter:image" content="https://cdn.glitch.com/9836ae03-7c42-4478-abfb-531d7bcde73e%2Fogp.png?v=1604191224523">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="apple-touch-icon" href="https://cdn.glitch.com/9836ae03-7c42-4478-abfb-531d7bcde73e%2Ficon.png?v=1604191227156" sizes="192x192">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Kakuno ーー つくり、つながる コミュニティー</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400&family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><b>Kakuno</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="write.php" style="color:#2cb696"><i class="fa fa-pencil "></i>&nbsp;つくる</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tubuyaku.php" style="color:#2cb696"><i class="fa fa-commenting-o "></i>&nbsp;つぶやく</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="main.php" style="color:#787c7b"><i class="fa fa-book "></i>&nbsp;さがす <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="talk.php" style="color:#787c7b"><i class="fa fa-newspaper-o "></i>&nbsp;サークル <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <section class="inner">
            <section>
                <div class='foo foo--inside'>

                    <?php if (!empty($success_message)) : ?>
                        <p class="success_message"><?php echo $success_message; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($error_message)) : ?>
                        <ul class="error_message">
                            <?php foreach ($error_message as $value) : ?>
                                <li>・<?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>


                    <section>
                        <?php if (!empty($message_array)) { ?>
                            <?php foreach ($message_array as $value) { ?>
                                <article>
                                    <div class="info">
                                        <div class="title-happy">
                                            <h2><b><?php echo $value['view_name']; ?></b></h2>
                                        </div>
                                        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
                                    </div>
                                    <div class="pp-happy">
                                        <p><?php echo $value['message']; ?></p>
                                    </div>
                                </article>
                            <?php } ?>
                        <?php } ?>
                    </section>

                </div>
            </section>
        </section>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    　<script src="https://kit.fontawesome.com/8ed28237ce.js" crossorigin="anonymous"></script>
    </head>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service_worker.js').then(function() {
                console.log("Service Worker Registered");
            });
        }
    </script>
</body>

</html>