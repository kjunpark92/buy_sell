<?php session_start(); print_r($_REQUEST);?>

<link rel='stylesheet' href='../style/style.css'>

<?php 
    include('./header.php');
    include('./db.php');

    if(isset($_GET['post_id'])){
        $post_id= $_GET['post_id'];
        $req = $db->query("SELECT * FROM posts WHERE id=$post_id");
        $data = $req -> fetch();
    }
    else{
        echo "ACCESS DENIED <br/> Please specify which item you want to access to";
        // header("location: index.php");
    }

?>

<div id='itempage_wrapper'>
    <div id='item_title'> Title : <?php echo $data['title']; ?> </div><br/>
    <div id='item_price'> Price : <?php echo $data['price']; ?> </div><br/>
    <div id='item_location'> Location : <?php echo $data['town']." - ". $data['district']; ?></div><br/>
    <div id='item_desc'> Description: <br/><?php echo $data['description']; ?> </div><br/>
    <div id='item_pic'> <?php echo $data['img'];?> </div>
</div>



<?php 
// ------------ beginning of comment section ------ 

$req2 = $db -> query("SELECT c.* , u.username FROM comments c 
                        JOIN users u ON c.user_id= u.id 
                        WHERE c.post_id=$post_id
                        ORDER BY c.dateComment");

$data2= $req2->fetch();

$comment_text= $data2['comment_text'];
$username= $data2['username'];
$dateComment= $data2['dateComment'];
?>

<div id="comments_wrapper">
    <ul id="comments_list">
        <?php
        while ($data2 = $req2 -> fetch()){
        echo "<li><span class='comment_username'><strong>".$username."</strong></span><span class='comment_text'>  ".$comment_text."</span><span class='comment_date'>  ".$dateComment."</span></li><br/>";
    };
    ?>
    </ul>
    <?php 
    if(isset($_COOKIE['id']) AND isset($_COOKIE['user_id'])) {
        echo '<form action="itempage.php?post_id='.$post_id.'" method="POST">
        <input type="text" name="comment" style=width:300px placeholder="leave your comment here"/>
        <input type="submit" name="submit" value="Enter">
        </form>';

        $comment_text= $_POST['comment'];
        $user_id= $_COOKIE['user_id']; //has to be changed to session['user_id']
        $username= $_COOKIE['username'];//has to be changed to session['username']
       
        echo $user_id; echo $username;

        if(!empty($comment_text)){
            
            date_default_timezone_set('Asia/Seoul');
            $now = new DateTime();
            $now_format= date_format($now, 'Y-m-d H:i:s');
       
            $req3 = $db->prepare("INSERT INTO comments(comment_text, dateComment, user_id, post_id) VALUES (:comment, :timestamp, :user_id, :post_id)");
          
            $req3 -> execute(array(
                'comment' => $comment_text, 
                'timestamp'=> $now_format, 
                'user_id'=> $user_id, 
                'post_id'=>$post_id
            ));
            
        }
        else {
            echo 'Please write something for a comment';
        }
    }  
    //-- for if isset condition-- uncommnet this later
   
    ?>
</div>

<?php
?>



<script src="../js/script.js">
</script>
