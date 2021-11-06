<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="write.js"></script>
    <script type="text/javascript" src="smart2/js/HuskyEZCreator.js" charset="utf-8"></script>
</head>
<body>

<?php

include_once "db.php";

    $title = '';
    $thum = '';
    $summary = '';
    $homepage = '';
    $alpha = '';
    $contents = '';
    $mode = 'insert';

    if(isset($_GET['mode'])){
        $mode = 'update';
        $num = $_GET['num'];
        $query = "SELECT * FROM works WHERE num='$num'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result); 

        $title = $row['title'];
        $thum = $row['thum'];
        $homepage = $row['homepage'];
        $summary = $row['summary'];
        $alpha = $row['alpha'];
        $contents = $row['contents'];
       
        if($row['public'] == 'on') $public = 'checked';
    }
?>

    <form action="res.php" method="post" enctype="multipart/form-data">
        <table>
            <caption>PORTFOLIO</caption>
            <tr>
                <th>title</th>
                <td><input type="text" name="title" value="<?=$title?>" alpha="110"></td>
            </tr>
            <tr>
                <th>img</th>
                <td><input type="file" name="thum"><?=$thum?></td>
            </tr>
            <tr>
                <th>summary</th>
                <td><textarea name="summary"><?=$summary?></textarea></td>
            </tr>
            <tr>
                <th>homepage</th>
                <td><input type="text" name="homepage" value="<?=$homepage?>" alpha="110"></td>
            </tr>
            <tr>
                <th>alpha</th>
                <td><input type="text" name="alpha" value="<?=$alpha?>" size="110"></td>
            </tr>
            <tr>
                <th>contents</th>
                <td><textarea name="contents" id="ir1"><?=$contents?></textarea></td>
            </tr>
            <tr>
                <th>checkbox</th>
                <td><input type="checkbox" name="public" <?=isset($public) ? $public : ''?>></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="저장"></td>
            </tr>
        </table>
        <input type="hidden" name="mode" value="<?=$mode?>">
        <input type="hidden" name="num" value="<?=$num?>">
    </form>


    
    <style>
        table{
            width: 80%;
            border-collapse: collapse; 
            margin:0 auto;
            padding: 0;
        }
       caption{
           background-color: #dbd5c9; 
           color: #f93700; font-size: 2em; 
           padding: 15px;
        }
        th{
            width: 25%;
            background-color: #dbd5c9;
            color: #fff;
        }
        td{
            width:75%;
        }
        th,td{
            padding: 20px; 
            border: 1px solid #ddd; 
            border-width: 1px 0 1px;
        }
        textarea{
            width:780px; 
            height: 300px;
        }
    </style>


</body>
</html>