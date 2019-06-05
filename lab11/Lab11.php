<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here
$conn=mysqli_connect('localhost','root','','travel');//no password
//check connection
if(!$conn){
    echo 'connection error:'.mysqli_connect_error();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                $sql="SELECT * FROM continents";
                //make query & get result
                $result=mysqli_query($conn,$sql);
                //fetch the resulting rows as array
                //Fill this place

                //****** Hint ******
                //display the list of continents

                while($row = $result->fetch_assoc()) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place
                $sql="SELECT * FROM countries";
                //make query & get result
                $result=mysqli_query($conn,$sql);
                //****** Hint ******
                /* display list of countries */
                while($row = $result->fetch_assoc()) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary" action="Lab11.php">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php

            $restrict="";
//          
            if(!isset($_GET["continent"])){
                $_GET["continent"]="0";
            }
            if(!isset($_GET["country"])){
                $_GET["country"]="0";
            }
            $continentRestrict=$_GET["continent"];
            $countryRestrict=$_GET["country"];

            if($_GET["continent"]!="0"){//如果选择了州
                $restrict=$restrict."ContinentCode ="."'$continentRestrict'";
                if($_GET["country"]!="0"){//如果选择了国家
                    $restrict=$restrict." AND CountryCodeISO="."'$countryRestrict'";
                    $sql="SELECT * FROM imagedetails WHERE $restrict" ;
                }
                else{//如果没有选择国家
                    $sql="SELECT * FROM imagedetails WHERE $restrict" ;
                }
            }
            else{//如果没有选择州
                if($_GET["country"]!="0"){//如果选择了国家
                    $restrict=$restrict."CountryCodeISO ="."'$countryRestrict'";
                    $sql="SELECT * FROM imagedetails WHERE $restrict" ;
                }
                else{//如果没有选择国家
                    $sql="SELECT * FROM imagedetails" ;
                }
            }
//            echo $sql;
            ////make query & get result
            $result = mysqli_query($conn, $sql);
//
            while($row = $result->fetch_assoc()) {
//                echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                $url="detail.php?id=".$row['UID'];
                $imgUrl="images/square-medium/".$row['Path'];
                $alt=$row['Title'];
                $caption=$row['Description'];
                echo "<li>";
                echo "<a href=\"$url\" class='img-responsive'>";
                echo "<img src=\"$imgUrl\" alt=\"$alt\">";
                echo "<div class='caption'>";
                echo "<div class='blur'></div>";
                echo "<div class='caption-text'>";
                echo " <p>$caption</p>";
                echo " </div>";
                echo " </div>";
                echo "</a>";
                echo "</li>";
            }

            //Fill this place

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            <li>
              <a href="detail.php?id=????" class="img-responsive">
                <img src="images/square-medium/????" alt="????">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>????</p>
                  </div>
                </div>
              </a>
            </li>        
            */ 
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>