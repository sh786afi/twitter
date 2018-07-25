<footer class="footer">
   <p>&copy; My Website 2018</p>
</footer>
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="loginmodaltitle">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" role="alert" id="LoginAlert"></div>
        <form>
           <input type="hidden" name="LoginActive" id="loginactive" value="1">
            <div class="form-group">
                <label for="email">Emaill</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <a href="#" id="togglelogin">Sign Up</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="loginSignupButton">Login</button>
        </div>
        </div>
    </div>
    </div>
    <script>
        $("#togglelogin").click(function(){
            if($("#loginactive").val()=="1"){
                $("#loginactive").val("0");
                $("#loginmodaltitle").html("Sign Up");
                $("#loginSignupButton").html("Sign Up");
                $("#togglelogin").html("Login");
            }
            else{
                $("#loginactive").val("1");
                $("#loginmodaltitle").html("Login");
                $("#loginSignupButton").html("Login");
                $("#togglelogin").html("Sign Up");
            }
        });

        $("#loginSignupButton").click(function(){

            $.ajax({
                type:"POST",
                url:"actions.php?action=loginSignUp",
                data:"email=" + $("#email").val() + "&password=" + $("#password").val() + "&LoginActive=" 
                + $("#loginactive").val(),
                    success: function(result){
                        if(result==1){
                            window.location.assign("http://localhost/WebDeveloperCourse/Twitter/");
                        }
                        else{
                            $("#LoginAlert").html(result).show();
                        }
                    }
            });
        });
        $(".toggleFollow").click(function(){
            var id=$(this).attr("data-userId");
            $.ajax({
                type:"POST",
                url:"actions.php?action=toggleFollow",
                data:"userid=" + id,
                    success: function(result){
                    
                       if(result == "1"){
                           $("a[data-userId='"+ id +"']").html("Follow");
                       } 
                       else if(result == "2"){
                        $("a[data-userId='"+ id +"']").html("Unfollow");

                       }
                    }
            });

        });
        $("#postTweetButton").click(function(){
            $.ajax({
                type:"POST",
                url:"actions.php?action=postTweet",
                data:"tweetContent=" + $("#tweetContent").val(),
                    success: function(result){
                   
                    if(result=="1"){
                        $("#tweetSucess").show();
                        $("#tweetFail").hide();
                    }
                    else if(result != ""){
                        $("#tweetFail").html(result).show();
                        $("#tweetSucess").hide();
                    }                       
                    }
            });
        });
    </script>


  </body>
</html>