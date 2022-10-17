<?php
    include("userHeader.php");
    include("dbconnection.php");
?>
<body>
    <main>
        <div class="register-form-area">
            <div class="register-form text-center">
                <!-- Login Heading -->
                <div class="register-heading">
                    <span>Edit Profile</span>
                    <p>Edit your Email, name or password here</p>
                </div>
                <?php
                    $current = $_SESSION["id"];
                    if(isset($_POST['submit'])){
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $getUser = mysqli_query($con,"UPDATE * FROM customer WHERE customerID = '$current'");
                        $queryRun = mysqli_fetch_array($getUser);

                        echo "<script> alert('Sucessfully changed');</script>";
                        header('Location: http://localhost/Kid-s-bookstore/index.php');
                    }
                    else{    
                        $getUser = mysqli_query($con,"SELECT * FROM customer WHERE customerID = '$current'");
                        $queryRun = mysqli_fetch_array($getUser);

                        $tempName = $queryRun['full_name'];
                        $tempPassword = $queryRun['password'];
                        $tempEmail = $queryRun['email'];
                    }
                ?>
                <!-- Single Input Fields -->
                <form method="post">
                    <div class="input-box">
                        <div class="single-input-fields">
                            <label>Full name</label>
                            <?php echo "<input type='text' placeholder='Enter full name' id='name' name='name' value='$tempName' required>";?>
                        </div>
                        <div class="single-input-fields">
                            <label>Email Address</label>
                            <?php echo"<input type='email' placeholder='Email address' id='email' name='email' value='$tempEmail' pattern='[a-zA-Z0-9_]+@+[a-z]+.com' title='Example_1@example.com' required>";?>
                        </div>
                        <div class="single-input-fields">
                            <label>Password</label>
                            <?php echo" <input type='password' placeholder='Enter Password' id='password' name='password' value='$tempPassword' required>";?>
                        </div>
                        <div class="single-input-fields">
                            <label>Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" id="conPassword" name="conPassword" onkeyup='check();' required>
                            <span id='message'></span>
                        </div>
                    </div>
                    <!-- form Footer -->
                    <div class="register-footer">
                        <button type="submit" name="submit" class="submit-btn3">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('conPassword').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Matching with password';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not matching with password';
        }
    }
    </script>

<?php
    include("footer.php")
?>

<!-- JS here -->
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<!-- Slick-slider , Owl-Carousel ,slick-nav -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!--wow , counter , waypoint, Nice-select -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/price_rangs.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!--  Plugins, main-Jquery -->	
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
</body>
</html>