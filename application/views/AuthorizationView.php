<form id="registrationForm" action="/authorization/hashing" method="post">
  
  <div class="container">
    <label for="email"><b>Username</b></label>
    <input type="email" placeholder="Username it`s Email" name="email" require>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" require>

    <button onclick="addHashPass()" class="relocate" type="submit">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
  <p>Don`t have an account? <a href="https://vitalyswipe-tinymvc.local/registration">Sign up</a>.</p>

    <button type="button" class="cancelbtn">Cancel</button>
  </div>
</form>

<script>
function addHashPass()
    {
      // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      // console.log($password);
    }
    
// window.location.href = "https://vitalyswipe-tinymvc.local/comment";
     
</script> 










<style>
  /* Bordered form */
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=email], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
</style>