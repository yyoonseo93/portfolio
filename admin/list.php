<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <article>
        <h2>PORTFOLIO</h2>
        <div id="list">
        <?php

            $root = $_SERVER['DOCUMENT_ROOT'];
            include_once $root."/admin/db.php";
            $query = "SELECT * FROM works ORDER BY num ASC";
            $result = mysqli_query($connect,$query);
        
            //json create
            $array = array();
            while( $row =mysqli_fetch_array($result) ){
                array_push(
                    $array,array(
                        "num"=>$row['num'],
                        "title"=>$row['title'],
                        "alpha"=>$row['alpha'],
                        "homepage"=>$row['homepage'],
                        "thum"=>$row['thum'],
                        "summary"=>$row['summary'],
                        "contents"=>$row['contents'],
                        "public"=>$row['public']
                    )
                );
            }

            @mkdir('../data');
            $json = json_encode($array);
            $bytes = file_put_contents("../data/work.json", $json); 
            //json create END


            $result = mysqli_query($connect,$query);
            while($row = mysqli_fetch_array($result)){

        ?>

        <div data-num="<?=$row['num']?>">
            <h1><?=$row['title']?></h1>
            <div id="listtxt">
                <video src="./files/<?=$row['thum']?>" alt="">
                <p><?=$row['summary']?></p>
                <p><?=$row['homepage']?></p>
            </div>
            <div id="main">
                <p><?=$row['alpha']?></p>
            </div>
            <div>
                <p><?=$row['contents']?></p>
            </div>
    
            <a href="write.php?mode=update&num=<?=$row['num']?>">수정</a>
            <a href="res.php?mode=delete&num=<?=$row['num']?>">삭제</a>
        </div>
        <?php } ?>
        </div>
    </article>

    <style>
        article{
            width: 90%;
            margin: 0 auto;
        }
        #list{
            display: flex;
        }
        ul,li{
            list-style: none;
            margin: 0;
            padding: 20px 0 5px;
        }  
        h1{
            margin: 0;
            color: #F93700;
            font-size: 1.2em;
            text-align: start;
            line-height: 2;
            padding: 20px 0;
        } 
        li{
            text-align: end;
            width: 30%;
            border-bottom: 1px solid #DBD5C9;
            color: #5E6554;
            font-size: 0.9em;
        }
        img{
            width: 400px;
            overflow: hidden;
        }
        video{
            width: 30%; height: 50%;
        }
        p{
            width: 30%;
            font-size: 0.8em;
            color: #5E6554;
            line-height: 2;
            display: block;
        }

    </style>
    
</body>
</html>