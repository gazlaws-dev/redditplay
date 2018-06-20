<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="image_src" href="Icon.png">
    <title>Reddit to Youtube Playlist</title>
    <meta name="description" content="Create youtube playlists from subreddit posts">

    <link rel="stylesheet" href="main.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!--Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Vollkorn|Roboto:300" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type='text/javascript'>
        function addFields(redditString) {
            var input = document.getElementById("subredditInput");
            input.value = input.value + "+" + redditString;
        }

    </script>


</head>

<body class="bg">

    <h1 class="center logo">
        <a href="http://redditplay.ml"><img src="Icon.png" height="100" width="120"/></a>
        <a href="http://redditplay.ml">RedditPlay.ml</a>
        <br><small>Reddit links to YouTube playlist</small>
    </h1>

    <div class="container">

        <div class="col-sm-3">


            <p class="grey">
                Choose subreddits from the list, or type in your own!
            </p>
            <form action="getplaylist.php" method="get" id="myForm">
                <input id="subredditInput" type="text" class="btn-block" name="subreddit" placeholder=" eg: ListenToThis">
                <input class="btn btn-block" type="submit" value="Create Playlist">
            </form>

            <a href="#" rel="noopener noreferrer" target="_blank" class="btn mybtndisabled btn-block disabled"> </a>

            <?php
				
				include 'db_connection.php';
				#$dbconnect = mysqli_connect($hostname,$username,$password,$database);
				$dbconnect = OpenCon();

				if ($dbconnect->connect_error) {
				  die("Database connection failed: " . $dbconnect->connect_error);
				}

				$sql="SELECT Genre,Name FROM tSubreddits Order By ListOrder";
				$query = mysqli_query($dbconnect, $sql)
                        or die (mysqli_error($dbconnect));
                $newgenre= "";
				$tableCount = 0;
				while ($row = mysqli_fetch_array($query)) {
				    if($newgenre == ""){
				        echo "<div class=\"panel-group\">
								<div class=\"panel panel-default\">
								    <div class=\"panel-heading\">
								        <h4 class=\"panel-title\">
                                            <a data-toggle=\"collapse\" href=\"#collapse" .$tableCount ."\">". $row["Genre"]."</a>
								        </h4>
								    </div>
								    <div id=\"collapse".$tableCount."\" class=\"panel-collapse collapse in\">
											<ul class=\"list-group\">
											  <li class=\"list-group-item\"> <a href=\"#\" onclick=\"addFields('" .$row["Name"]. "');\">" . $row["Name"]. "</a></li>"
										   ;
							   
								$newgenre = $row["Genre"];
								$tableCount++;
								
				    } elseif($row["Genre"] !== $newgenre){
								
                        echo " </ul>
                                    <div class=\"panel-footer\"></div>
                                  </div>
                                </div>
                              </div>";
                        $newgenre = $row["Genre"];
                        $tableCount++;

                        if($tableCount == 2){ 
                            echo "</div>
                            <div class=\"col-sm-3\">";

                        } elseif($tableCount == 3){
                            echo "</div>
                            <div class=\"col-sm-3\">";										
                        }
                         elseif($tableCount == 8){
                            echo "</div>
                            <div class=\"col-sm-3\">";										
                        }
                        echo "<div class=\"panel-group\">
                                <div class=\"panel panel-default\">
                                  <div class=\"panel-heading\">
                                    <h4 class=\"panel-title\">
                                      <a data-toggle=\"collapse\" href=\"#collapse" .$tableCount ."\">". $row["Genre"]."</a>
                                    </h4>
                                  </div>
                                  <div id=\"collapse".$tableCount."\" class=\"panel-collapse collapse in\">
                                    <ul class=\"list-group\">
                                       <li class=\"list-group-item\"> <a href=\"#\" onclick=\"addFields('" .$row["Name"]. "');\">" . $row["Name"]. "</a></li>"
                             ;
								
							} else { echo "
								<li class=\"list-group-item\"> <a href=\"#\" onclick=\"addFields('" .$row["Name"]. "');\">" . $row["Name"]. "</a></li>"
								;
							   }
						   
						}
						echo "</ul>
											<div class=\"panel-footer\"></div>
										  </div>
										</div>
									  </div>"
							;
					
				#mysqli_close($dbconnect);
				CloseCon($conn);
				?>

        </div>
    </div>


</body>

</html>
