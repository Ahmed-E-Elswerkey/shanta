<div id="footer" >

	<div id='footer_info'>

		<div id='content' class='f_parts'>
			<h4 class='f_header'>Content:</h4>
			<div class='f_details'><a href="./meals.php" title='A list ofmeals you enter or select and we could pick on for you'>Meals</a></div>
			<div class="f_details"><a href="#" title='Coming soon'>Recipies</a></div>

		</div>

		<div id='versions' class='f_parts'>
			<h4 class='f_header'>Versions:</h4>
			<div class="f_details"><a href="./shanta.apk"  download>Android App</a></div>
		</div>

	</div>

	<div id='footer_copy'>&copyCopyrights reserved for Akly team, built by <a target='_blank' href='http://ahmedelswerkey.ezyro.com'>Ahmed Elswerkey</a></div>

</div>

    <script> 
	window.onload = setTimeout(function(){height11();},0);
	document.getElementsByTagName("body")[0].onclick = function(){setTimeout(function(){height11();},300);}
	function height11(){
		var body = document.body,
		    html = document.documentElement;
		var height =  html.scrollHeight || html.offsetHeight || document.getEleentsByTagName("html")[0].scrollHeight;
		    document.getElementById("footer").style.top = height - 40 + "px";
	    }
    </script>

<script type="text/javascript" src="<?php echo $_SESSION['de']; ?>/js/index.js"></script>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

</body>

</html>
