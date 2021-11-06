<?php

include_once "db.php";

//테이블생성
$query = "CREATE TABLE works( 
        num INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(100),
        thum VARCHAR(100),
        homepage VARCHAR(100),
        summary TEXT,
        alpha VARCHAR(100),
        contents TEXT,
        public VARCHAR(10),
        PRIMARY KEY(num)
)";

//테이블_데이터받는곳
mysqli_query($connect,$query);

if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
}else{
    $mode = $_GET['mode'];
}

if($mode == 'insert'){

    $title = $_POST['title'];
    $thum = $_FILES['thum'];
    $homepage = $_POST['homepage'];
    $summary = $_POST['summary'];
    $alpha = $_POST['alpha'];
    $contents = $_POST['contents'];
    $public = $_POST['public'];
    echo $public;

    @mkdir('./files',0777); 
    $fileName = $thum['name'];
    $tmpName = $thum['tmp_name'];
    move_uploaded_file($tmpName,'./files/'.$fileName);

    $query = "INSERT INTO works(title, thum, homepage, summary, alpha, contents, public) 
    values ('$title', '$fileName', '$homepage', '$summary', '$alpha', '$contents', '$public')";

    mysqli_query($connect,$query);

};

if($mode == 'delete'){
    $num = $_GET['num'];
    $query = "DELETE FROM works WHERE num='$num'";
    mysqli_query($connect, $query);
    // echo $mode;
}

if($mode == 'update'){
    $num = $_POST['num'];

    $title = $_POST['title'];
    $thum = $_FILES['thum'];
    $homepage = $_POST['homepage'];
    $summary = $_POST['summary'];
    $alpha = $_POST['alpha'];
    $contents = $_POST['contents'];
    $public = $_POST['public'];

    $fileName = $thum['name'];
    $tmpName = $thum['tmp_name'];

    if( !empty($fileName)){
        echo "파일이 있습니다";

        $query = "SELECT * FROM works WHERE num='$num'";
        $result = mysqli_query($connect,$query);
        $row = mysqli_fetch_array($result);

        @unlink('./files/'.$row['thum']);
        move_uploaded_file($tmpName,'./files/'.$fileName);

        $query = "UPDATE works SET thum='$fileName' WHERE num='$num'";
        mysqli_query($connect, $query);
    }

    $query = "UPDATE works SET title='$title',homepage='$homepage', summary='$summary', alpha='$alpha', contents='$contents', public='$public' WHERE num='$num'";
    mysqli_query($connect, $query);
}

?>

<script>
   location.href="list.php";
</script>