<?php session_start();?>

<link rel='stylesheet' href='../style/style.css'>

<?php 
    include('./header.php');
    include('./db.php');

    if(isset($_GET['post_id'])){
        $post_id= $_GET['post_id'];
        $req = $db->query("SELECT * FROM posts WHERE id=$post_id");
        $data = $req -> fetch();
?>
<div id='itempage_wrapper'>
    <div id='item_title'> Title : <?php echo $data['title']; ?> </div><br/>
    <div id='item_price'> Price : <?php echo $data['price']; ?> </div><br/>
    <div id='item_location'> Location : <?php echo $data['town']." - ". $data['district']; ?></div><br/>
    <div id='item_desc'> Description: <br/><?php echo $data['description']; ?> </div><br/>
    <div id='item_pic'> <?php echo $data['img'];?> </div>
</div>
<?php
    }
    else{
        echo "ACCESS DENIED <br/> Please specify which item you want to access to";
        // header("location: index.php");
    }
?>

<?php 
// ------------ beginning of comment section ------ 

$req2 = $db -> query("SELECT c.* , u.username FROM comments c 
                        JOIN users u ON c.user_id= u.id 
                        WHERE c.post_id=10 
                        ORDER BY c.dateComment");

?>

<div id="comments_wrapper">
    <ul id="comments_list">
        <?php
        while ($data2 = $req2 -> fetch()){
            $comment_text= $data2['comment_text'];
            $username= $data2['username'];
            $dateComment= $data2['dateComment'];
        echo "<li class='each_comment'><span class='comment_username'><strong>".$username."</strong></span><span class='comment_date'> (".$dateComment.")</span><br/> <span class='comment_text'>".$comment_text."</span></li><br/>";
        };
        ?>
    </ul>
    <?php 
    if(isset($_SESSION['user_id']) AND isset($_SESSION['username'])) {
        echo '<form action="itempage.php?post_id='.$post_id.'" method="POST" id="comment_form">
        <input type="text" name="comment" id="comment_text" style=width:300px placeholder="leave your comment here"/>
        <input type="submit" name="submit" id="comment_submit" value="Enter">
        </form>';

        $comment_text= (isset($_POST['comment'])? $_POST['comment'] : "");
        $user_id= $_SESSION['user_id']; 
        $username= $_SESSION['username'];

        if($comment_text !== ""){
            $comment_text= $_POST['comment'];
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
    }  
    
   
    ?>
</div>

<!-- <script src="../js/script.js">
</script> -->
<script> 
var comment_submit = document.getElementById("comment_submit");

comment_submit.addEventListener('click',function(e){

    var comment_text = document.getElementById("comment_text");
  
    comment_text.style.background = 'none';

    if (comment_text.value === ""){
        
        alert('Please write something for comment');
        comment_text.style.background= 'pink';
        comment_text.focus();

        e.preventDefault();
    }
    
});
</script>
