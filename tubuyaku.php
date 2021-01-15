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


if (!empty($_POST['btn_submit'])) {


    if (empty($_POST['view_name'])) {
        $error_message[] = '名前を入力してください。';
    } else {
        $clean['view_name'] = htmlspecialchars($_POST['view_name'], ENT_QUOTES);
    }


    if (empty($_POST['message'])) {
        $error_message[] = 'つぶやきを入力してください。';
    } else {
        $clean['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);
        $clean['message'] = preg_replace('/\\r\\n|\\n|\\r/', '<br>', $clean['message']);
    }

    if (empty($error_message)) {

        if ($file_handle = fopen(FILENAME, "a")) {


            $now_date = date("Y-m-d H:i:s");


            $data = "'" . $clean['view_name'] . "','" . $clean['message'] . "','" . $now_date . "'\n";


            fwrite($file_handle, $data);


            fclose($file_handle);

            $success_message = 'つぶやきを投稿しました。';
        }
    }
}

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

    <!--ogp setting-->
    <meta name="twitter:site" content="@Yutolab1120">
    <meta name="twitter:description" content="Kakuno - 創る・楽しむ">
    <meta name="twitter:title" content="Kakuno">
    <meta name="twitter:url" content="https://kakuno.glitch.me/main.php">
    <meta name="twitter:image" content="https://cdn.glitch.com/9836ae03-7c42-4478-abfb-531d7bcde73e%2Fogp.png?v=1604191224523">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>新規つぶやき作成 | Kakuno</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400&family=Press+Start+2P&display=swap" rel="stylesheet">
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
    <br>

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
                    <form method="post">
                        <div>
                            <br><label class="title" for="view_name"><b>
                                    <h5 style="font-size:15px; color:#a1a1a1;" id="inputlength"><i class="fa fa-keyboard-o ">&nbsp;0文字</i></h5>
                                </b></label><br><br>
                            <input class="tt_input" id="view_name" type="text" name="view_name" value="" style="border:none; font-weight:bolder ;" placeholder="表示名">

                        </div>
                        <div>
                            <label class="kiji" for="message"><b></b></label>
                            <textarea class="kiji_input" id="message" name="message11" style="border:none" placeholder="最近の出来事をつぶやいてみましょう。" onkeyup="ShowLength(value);"></textarea>
                        </div>
                        <input type="submit" name="btn_submit" value="つぶやく"><br><br>
                    </form>


                </div>
            </section>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8ed28237ce.js" crossorigin="anonymous"></script>
    <script>
        function ShowLength(str) {
            document.getElementById("inputlength").innerHTML = '<i class="fa fa-keyboard-o ">&nbsp;' + str.length + "文字";
        }
    </script>
</body>

</html>