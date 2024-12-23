<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<head>
	<!-- <link href="style.css" rel="stylesheet" /> -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>	
	</head>
	<body>
	
  		<button type ="submit"><a href="/comment">Comment</a></button>
  		<button type ="submit"><a href="/authorization">Sing in</a></button>
  		<button type ="submit"><a href="/registration">Create account</a></button>
  	<form action="" method="POST">
	  <input type="hidden" name="logout" value="true" />
		<button type="submit">Sing out</button>
	</form>
		<?php include 'application/views/'.$content_view; ?>
	</body>
</html>

<?php
if (isset($_POST['logout'])) {
	unset($_SESSION['user_email']);
	session_destroy();
}
?>
