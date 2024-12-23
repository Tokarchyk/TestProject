<?php
  session_start();

  if (isset($_SESSION['login_message'])) {
        echo htmlspecialchars($_SESSION['login_message']);
    // unset($_SESSION['login_message']);
  }
?>
<form onsubmit="event.preventDefault();" 
    action="/comment/store" method="POST">
    <?php 
        if (array_key_exists('user_email', $_SESSION) && !empty($_SESSION['user_email'])) { ?>
        <label for="email">Email:</label>
        <input type="hidden" name="user_email" value="<?php echo $_SESSION['user_email']; ?>" />
    <?php }; ?>
    <?php
        if(array_key_exists('user_email', $_SESSION) && !empty($_SESSION['user_email'])) {
    ?>
    <label for="comment">Comment:</label>
    <textarea  style="display:block" id="comment" name="comment" placeholder="Write the text" rows="4"></textarea>
    <?php } else{ ?>
        <a href="/authorization">Sing in!</a>
    <?php }; ?>
    <button id="refreshBtn" onclick="getComment()" type="submit" name="btn_send">
        Send message
    </button> 
</form>
<script>
    function getComment() {
        event.preventDefault();

        const inputEmail = $("#email").val();
        const txtComment = $("#comment").val();
        
        
        let formdata = {
            email: inputEmail,
            comment: txtComment,  
        };

        $.ajax({
            url: '/comment/store',
            method: 'post',  
            data: formdata,    
            success: function() {
                $("#comments-list").append(inputEmail + ' - ' + txtComment);
            }
        });
        
    }
    
    function deleteComment(id)
    {
        $.ajax({
            url: '/comment/delete/',
            method: 'post',
            data: {id: id},
            success: function(data) {
                $('#comment-' + id).remove();
            }
        });
    }

    function updateComment(id)
    {
        const comment = document.querySelector("#comment-" + id + " .update-comment-").value;
        $.ajax({
            url: '/comment/update/',
            method: 'post',
            data: {id: id, comment: comment},
            success: function(data) {
                // add method textContent 
                document.querySelector("#comment-" + id + " .new-comment").innerHTML = comment;
                
                // hide save,cance,input
                document.querySelector("#comment-" + id + " .div-update-comment-").style.display = 'none'; // input
                document.querySelector("#comment-" + id + " .btn-save").style.display = 'none'; // button save 
                document.querySelector("#comment-" + id + " .btn-cancel").style.display = 'none'; // button cancel
                // show btn- delete & Edit
                document.querySelector("#comment-" + id + " .btn-del").style.display = 'block'; // button Delete
                document.querySelector("#comment-" + id + " .showEdit").style.display = 'block'; // button Edit
                document.querySelector("#comment-" + id + " .new-comment").style.display = 'block'; // span
            }
        });
    }

    function showEdit(id) {
        document.querySelector("#comment-" + id + " .new-comment").style.display = 'none'; // span
        document.querySelector("#comment-" + id + " .div-update-comment-").style.display = 'block'; // input
        document.querySelector("#comment-" + id + " .btn-del").style.display = 'none'; // button Delete
        document.querySelector("#comment-" + id + " .showEdit").style.display = 'none'; // button Edit
        document.querySelector("#comment-" + id + " .btn-save").style.display = 'block'; // button save 
        document.querySelector("#comment-" + id + " .btn-cancel").style.display = 'block'; // button cancel
    }

    function hideEdit(id) {
        document.querySelector("#comment-" + id + " .new-comment").style.display = 'block'; // span
        document.querySelector("#comment-" + id + " .div-update-comment-").style.display = 'none'; // input
        document.querySelector("#comment-" + id + " .btn-del").style.display = 'block'; // button Delete
        document.querySelector("#comment-" + id + " .showEdit").style.display = 'block'; // button Edit
        document.querySelector("#comment-" + id + " .btn-save").style.display = 'none'; // button save 
        document.querySelector("#comment-" + id + " .btn-cancel").style.display = 'none'; // button cancel
    }
</script>

<h1>LAST COMMENTS</h1>

<div id="comments-list">
<?php
    foreach ($data as $row) {
    echo '<div  id="comment-' . $row['id'] . '">';
    echo 'ID - ' . $row['id'] . ' ' . $row['email'] . ' - ';
    echo '<span style="display:block" class="new-comment"> '.$row['comment'] .'</span>';
        if (array_key_exists('user_email', $_SESSION) && !empty($_SESSION['user_email'])) {
            if ($_SESSION['user_email'] === $row['email']){
                echo '<button class="btn-del" style="display:block" onclick="deleteComment(' . $row['id'] . ')" type="button">Delete</button>'; 
                echo '<button class="showEdit" style="display:block" onclick="showEdit(' . $row['id'] . ')">Edit</button>';
                echo '<div style="display:none" class="div-update-comment-">';
                echo '<input  type="text" class="update-comment-" value="' . htmlspecialchars($row['comment']) . '">';
                echo '<button class="btn-save" onclick="updateComment(' . $row['id'] . ')" type="button" >Save</button>';
                echo '<button class="btn-cancel" onclick="hideEdit(' . $row['id'] . ')">Cancel</button>';
                echo '</div>';
            }
        } else {
        echo 'Please <a href="https://vitalyswipe-tinymvc.local/authorization">Sing in!</a>';
        }
    echo '<br><hr>';
    echo '</div>';
    }
    ?>
</div>

<style>
    .btn-del {
        background-color: red;
        color: #ffffff; 
    }
</style>



