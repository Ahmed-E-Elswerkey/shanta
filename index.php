<?php 

    include_once 'initi.php';

    //else header("Location: ./sign.php");

 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Shanta | Main</title>

	<link rel="stylesheet" type="text/css" href="./css/home.css">
    
<?php $index = "main"; include_once 'navbar.php'; ?>

    <div id='intro'>

        

		

			<h1>We offer customers help to search and find products easily, and the shops owners to sell more and make the honest ones more recognizable.</h1>

			<br><br>

            <h3>

			<?php 

				$result = $GLOBALS['conn']->query("SELECT count(id) as num FROM products;");

				if($result){

					$row = $result->fetch_assoc();

					echo "More than <span>".$row['num']."</span> Product";					

				}

				$result = $GLOBALS['conn']->query("SELECT count(id) as num FROM markets");

				if($result){

					$row1 = $result->fetch_assoc();

					echo " in <span>".$row1['num']."</span> market."; 

				}



			 ?>

            </h3>

        <ul>

    		<li id='search_li'>

                <div id="search" style="width:40%;height:40%;margin:7% 30% 0">

	                <div>

	                    <input type="search" style='text-align:center;' placeholder='Search for a product' onkeyup='search_out(this)'>

	                    <div id='search_out' style="top:114%;width:100%;"></div>

	                </div>

                </div>

            </li>

            <li>
            	<div>
            		<a href="<?php echo $_SESSION['de']; ?>/meals"></a>
            	</div>
            </li>

        </ul>

    </div> 



    <!--  -->



<script src='./js/home.js'></script>

<script>home = true;</script>

<?php include_once 'footer.php'; ?>
