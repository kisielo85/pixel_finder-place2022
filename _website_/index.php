<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pixel_finder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>super duper pixel finder 2000</h1>
    <form action="" method="GET">
        <div class="box">
            u/<input type="text" name='nick' maxlength="20" autocomplete="off">
            <input type="submit" value="find">
        </div>
    </form>
    <?php

    session_start();
        if (isset($_SESSION['loop'])){
            $_SESSION['loop']=5;
        }

    if (isset($_GET['nick'])){
        $nick=$_GET['nick'];
        if (strlen($nick)>20){
            $nick=substr($nick,0,20);
        }
        $ch = array('\\','/',':','*','?','"','<','>','|',' ');
        $nick=str_replace($ch,'',$nick);
        $postdata = http_build_query(
            array(
                'name' => $nick,
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents('http://localhost:2137/', false, $context);//change localhost to ip with python server
        header("Location: result.php?nick=$nick");
    }
    ?>
    
</body>
</html>