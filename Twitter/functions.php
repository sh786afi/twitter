<?php
 
    session_start();
    $link=mysqli_connect("localhost","root","","Twitter");
    if(mysqli_connect_error()){
        die( "There was error in connecting to DB");
    }
    if(isset($_GET['function'])=="logout"){
        session_unset();    
    }
    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );
    
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }
    
        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }
    function displayTweets($type){
        global $link;
        if($type=='public'){
            
            $whereClause="";
        }
        else if($type=='isFollowing'){
            $query="SELECT * FROM isFollowing WHERE follower=".mysqli_real_escape_string($link,$_SESSION['id']);
            $result=mysqli_query($link,$query);
            $whereClause="";
            while($row=mysqli_fetch_assoc($result)){
                if($whereClause=="") $whereClause="WHERE" ;
                else $whereClause.="OR"; 
             $whereClause.= " userid= ".$row['isFollowing'];
            }  
        }
        else if($type=='yourtweets'){
            $whereClause="WHERE userid=".mysqli_real_escape_string($link,$_SESSION['id']); 
        }
        else if($type=='search'){
            $whereClause="WHERE tweet LIKE '%".mysqli_real_escape_string($link,$_GET['q'])."%'";
        }
        else if(is_numeric($type)){
            $whereClause="";
            echo $type;
        }
        $query="SELECT * FROM tweets ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        $result=mysqli_query($link, $query);
        if($result){
            if(mysqli_num_rows($result) ==0){
                echo "There are no Tweets to Display";
            } 
            else{
                while($row=mysqli_fetch_assoc($result)){
                    $userQuery="SELECT * FROM users WHERE id=".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                    $userQueryResult=mysqli_query($link, $userQuery);
                    $user=mysqli_fetch_assoc($userQueryResult);
                    echo "<div class='tweet'> <p>".$user['email']."<span class='time'> ".time_since(time() - strtotime($row['datetime']))." ago</span></p>";
                    echo "<p>".$row['tweet']."</p>";
                    echo "<p><a href='#' class='toggleFollow' data-userId='".$row['userid']."'>";
                    $isFollowingQuery="SELECT * FROM isFollowing WHERE follower=".mysqli_real_escape_string($link,$_SESSION['id']).
                    " AND isFollowing =".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                    $isFollowingQueryResult=mysqli_query($link,$isFollowingQuery);
                    
                
                    if(mysqli_num_rows($isFollowingQueryResult) > 0){
                        echo "Unfollow";
                        }
                    else{
                        echo "Follow";
                        }
            
                    echo "</a></p></div></p>";
                }
            }
        }

        
    }
    function displaySearch(){
        echo '<form class="form-inline">
    <div class="form-group">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" class="form-control mb-2 mr-sm-2" id="search" placeholder="Search">
      </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>
      </form>';
    }
    function displayTweetBox(){
        if(isset($_SESSION['id'])>0){
            echo '
            <div id="tweetSucess" class="alert alert-success">Your Tweet Was Posted Successfully</div>
            <div id="tweetFail" class="alert alert-danger"></div>
            <div class="form-inline">
        <div class="form-group">
            <textarea type="text" class="form-control mb-2 mr-sm-2" id="tweetContent"></textarea>
          </div>
        <button  id="postTweetButton" class="btn btn-primary mb-2">Post Tweets</button>
          </div>';
        }
    }
    function displayUsers(){
        global $link;
        $query="SELECT * FROM users  LIMIT 10";
        $result=mysqli_query($link, $query);
        while($row=mysqli_fetch_assoc($result)){
            echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>". $row['email']."</a></p>";

        }
    }

?>