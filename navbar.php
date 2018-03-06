    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name='keywords' content='food, shopping, food shopping, buy food, register, sell'>
    <meta name='description' content="We're trying to make shopping easy for both customer and market owners, you can register your market and your products and let people buy in an easy way, and you can register as customer and enjoy the simble way of shopping">
    <script src="https://use.fontawesome.com/53fd01841f.js"></script>
    <link rel="stylesheet" href="<?php echo $_SESSION['de']; ?>/css/index.css?123">
    <link rel='stylesheet' type='text/css' href='<?php echo $_SESSION['de']; ?>/css/user.css?123'>
    <link rel='icon' href='<?php echo $_SESSION['de']; ?>/logo1.png'>
    <link rel="stylesheet" href="<?php echo $_SESSION['de']; ?>/css/font-awesome.css?123">
    <link rel="stylesheet" href="<?php echo $_SESSION['de']; ?>/css/font-awesome.min.css?123">
    <!-- <link href="https://fonts.googleapis.com/css?family=Artifika|Satisfy" rel="stylesheet"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"> -->
    <style>
        <?php 
            if($_SESSION['major'] == 'market_admin')
                echo ".consumer{display:none;}";
         ?>
    </style>
    <script>var de = "<?php echo $_SESSION['de']; ?>";</script>
</head>

<body>

<div id="navbar">
    <ul>
        <?php echo "<li id='menu_li'><div id='menu_btn'><i class=\"fa fa-bars\" aria-hidden=\"true\"></i></div></li>"; ?>
        <li id="logo_li"><div id="logo"><a href="<?php echo $_SESSION['de']; ?>/">Shanta</a></div></li>
        <li id='links_li'><div id='menu'>
                <div id='links'>
                    <div class='link' style='display:inline-block;'><a href="<?php echo $_SESSION['de']; ?>/home/">Home</a></div>
                    <?php 
                        if(isset($products))
                        if(isset($_COOKIE['last_loc']) && isset($products)){
                            $result_g = $GLOBALS['conn']->query("SELECT governorate FROM markets WHERE id='$products'");
                            if($result_g){
                                $row_g = $result_g->fetch_assoc();
                                echo "<p style='display:inline-block;color:#2b2b2b; '> > <a href='$_SESSION[de]/home'>".$row_g['governorate']."</a> > ".$m_name."</p>";
                            }
                        }
                     ?>
                    <div class='link' style='display:inline-block;'><a href="<?php echo $_SESSION['de']; ?>/meals/" alt='View meals and make your list to save your favourite'>Meals</a>
                    </div>
                


    

    <?php
                // echo "<script>console.log('$_SERVER[HTTP_HOST]');</script>";
    if(!empty($_SESSION['user_name'])){
        $user = "<li id='user_li'><div id='user'>
                        <a target='_blank' href='$_SESSION[de]/user'>".htmlspecialchars($_SESSION['user_name'])."</a>
                        <a href='$_SESSION[de]/funcs/?t=logout' style='font-size: 13px;margin-left:0.2rem;padding:0.1rem'>Logout</a>
                    </div></li>";
    }
    else $user='bombgum';

    if(!empty($_SESSION['user_name'])){
        
            echo " 
                </div>
            </li>
               ";
        if($_SESSION['major'] == 'consumer'){
            $res_count = $GLOBALS['conn']->query("SELECT COUNT(num) FROM cache  WHERE user_id='$_COOKIE[user_id]'");
            $ro_count = $res_count->fetch_assoc();
            if(!isset($index))
                echo "
                <li id='search_li'><div id='search'>
                    <div>
                        <input type='search' placeholder='Search for a product' onkeyup='search_out(this)'>
                        <div id='search_out'></div>
                    </div>
                </div></li>
                ";
            echo "
             $user 
                <li id='bill' style='display:inline'>
                    <div id='bill_d' style='margin: 0.4rem;'>

                        <div id='bill_d_sign' class=''>+</div>

                    <div>
                        <div id='bill_n' >".$ro_count['COUNT(num)']."</div>
                        <div><button onclick='xml_bill_trunc()' title='Remove all produucts from cart'>X</button></div>
                        <div id='bill_f_d' style='display:none' onmouseleave=\"document.getElementById('bill_f_d').style.display = 'none'\">
                                <div id='bill_padding'>
                                    <fieldset style='padding:2px;'>
                                        <legend style='text-align: center;font-weight: bold;font-size: 20px;'>Your cart</legend>
                                        <table id='cart'></table>
                                        <!-- <div id='checkout' style='display: none;' onclick='xml_checkout_b()' title='Finish buying and add the selected products to market's list>Checkout</div> -->
                                        <a id='checkout' style='display: none;' href='$_SESSION[de]/cart' title='Finish buying and open the page of the cart'>Open Cart</a>
                                    </fieldset>
                                </div>
                            </div>
                        </div> 
                    </div>
                </li>
            ";
        }
        if($_SESSION['major'] == 'market_admin'){
            echo $user;
            if(isset($_REQUEST['id'])){
                $res_count = $GLOBALS['conn']->query("SELECT COUNT(id) FROM operations  WHERE market_id='$_REQUEST[id]' AND state='not yet'");
                $ro_count = $res_count->fetch_assoc();

                echo "
                <script>document.getElementsByTagName('style')[0].innerHTML += \"#bill_n:before{content:'\\\\f0f3' !important; }\"</script>
                <li id='bill'>
                     <div id='bill_d' title='Requests' >
                        <div>
                            <div id='bill_n' >".$ro_count['COUNT(id)']."</div>
                            
                        </div> 
                     </div>
                </li>
                ";
            }
        }
       
    }
    else echo "
        </div></div></li>
        ";
    
    if(empty($_COOKIE['user_name']) && !isset($sign_p))
        echo "<li id='sign_li'><a id='sign_a' href='$_SESSION[de]/sign'>Register</a></li>";  
    ?>
    </ul>
</div>

<?php 
    if(!isset($meals) && !empty($_SESSION['user_name'])){
    echo " <div id='meals'>
                    <div id='meals_l'><i class='fa fa-cutlery' title='Your meals' onclick='meals_r()'></i></div>
                    <div id='meals_r'>
                        <fieldset>
                            <legend>Your meals</legend>
                            <div id='meals_b'></div>
                            
                            <div id='meals_buttons'>
                                <input type='button' value='Add' title='Add a meal to the list' onclick='meals_add(\"f\")'>
                                <input type='button' value='Random' title='Pick a random meal from the list' onclick='meal_random()'>
                                <input type='button' value='Reset' title='Return all selected to default' onclick='meals_b_f()'>
                            </div>
                        </fieldset>
                    </div>
                    
                </div>
                <script>
                if(document.getElementById('meals_b') != undefined)
                    setTimeout(function(){meals_b_f();},300);
                </script>
                <div id='meals_in' style='display:none;' onclick='meals_in_click()'>
    <div id='meals_in_d' onmouseover='meals_onmouse(\"over\")' onmouseleave='meals_onmouse(\"leave\")'>
        <div id='mleft'></div>
        <p>Meal info.</p>
        <form method='post' action='' onsubmit='meals_add(\"p\");return false;'>
             <input type='text' id='meal_name' name='name' required>
             <input type='hidden' id='meal_color' name='color' required>
             <input type='submit' name='submit'>
        </form>
    </div>
</div>
";}  ?>


<div id="navbar_before"></div>
    
<script src="<?php echo $_SESSION['de']; ?>/js/index.js" type="text/javascript"></script>
<script>
            var m_l = 0;
            if(window.innerWidth < 1000){
                $("logo_li").style.marginLeft = window.innerWidth / 2 - $("menu_btn").scrollWidth - ($("logo_li").offsetWidth / 2) - 5 + "px";
                m_l = window.innerWidth / 2 - $("menu_btn").scrollWidth - ($("logo_li").offsetWidth / 2) - 5;
            }
            if($("user_li") != undefined && !(window.innerWidth < 1000)){
                var l;
                for(var i=0;i<document.getElementsByTagName('li').length;i++){
                    if(document.getElementsByTagName('li')[i] == $('user_li'))
                        l = i;
                }
                var wid = 0;
                for(var i=0;i<=l;i++){
                    element = document.getElementsByTagName('li')[i];
                    var style = element.currentStyle || window.getComputedStyle(element),
                    width = element.offsetWidth, // or use style.width
                    margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight),
                    padding = parseFloat(style.paddingLeft) + parseFloat(style.paddingRight),
                    border = parseFloat(style.borderLeftWidth) + parseFloat(style.borderRightWidth);

                    wid += width + margin + padding + border;
                    // console.log(wid);
                }
                // console.log($("navbar").offsetWidth + " " +(($("navbar").offsetWidth - wid) ) + "px");

                var half_nav = $("navbar").offsetWidth * 0.3;
                wid += half_nav;

                if(($("navbar").offsetWidth - wid) > 1){
                    $("user_li").style.marginLeft = (($("navbar").offsetWidth - wid) ) - 10 + "px";
                    m_l = (($("navbar").offsetWidth - wid) ) - 10;
                }
            }

            if($("bill") != undefined){
                // var l;
                // for(var i=0;i<document.getElementsByTagName('li').length;i++){
                //     if(document.getElementsByTagName('li')[i] == $('bill'))
                //         l = i;
                // }
                // var wid = 0;
                // for(var i=0;i<=l;i++){
                //     var element = document.getElementsByTagName('li')[i];
                //     var style = window.getComputedStyle(element) || element.currentStyle ,width = element.offsetWidth,
                //     margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight),
                //     padding = parseFloat(style.paddingLeft) + parseFloat(style.paddingRight),
                //     border = parseFloat(style.borderLeftWidth) + parseFloat(style.borderRightWidth);
                //     if(window.innerWidth < 1000){
                //         if(element.id != "search_li"){
                //             wid += width + margin - padding + border;
                //         }
                //         else console.log('no search');
                //     }
                //     else   wid += width + margin - padding + border;


                //     console.log(element.id + " " + (width + margin - padding + border));
                // }
                // // if(window.innerWidth < 1000)
                //     // m_l =0;
                // wid += m_l;
                // console.log(($("navbar").offsetWidth - wid));
                // if(($("navbar").offsetWidth - wid) > 1){
                //     $("bill").style.marginLeft = (($("navbar").offsetWidth - wid) ) + "px";
                // }
                // else console.log("negative");
                
                // $("bill").style.marginLeft = (($("navbar").offsetWidth - $("bill").offsetWidth) ) - 20 + "px";
                
            }

            if($("sign_li") != undefined){
                var l;
                for(var i=0;i<document.getElementsByTagName('li').length;i++){
                    if(document.getElementsByTagName('li')[i] == $('sign_li'))
                        l = i;
                }
                var wid = 0;
                for(var i=0;i<=l;i++){
                    element = document.getElementsByTagName('li')[i];
                    var style = element.currentStyle || window.getComputedStyle(element),
                    width = element.offsetWidth, // or use style.width
                    margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight),
                    padding = parseFloat(style.paddingLeft) + parseFloat(style.paddingRight),
                    border = parseFloat(style.borderLeftWidth) + parseFloat(style.borderRightWidth);

                    wid += width + margin - padding + border;
                }
                wid += m_l;
                if(($("navbar").offsetWidth - wid) > 1)
                    $("sign_li").style.marginLeft = (($("navbar").offsetWidth - wid) ) + "px";
            }
            setTimeout(function(){var height = document.getElementById('navbar').clientHeight;
            document.getElementById('navbar_before').style.height = height - 2 + 'px';},110);
            
            for(var i=0;i<document.getElementsByTagName("li").length;i++){
                document.getElementsByTagName("li")[i].minWidth = (window.innerWidth/document.getElementsByTagName("li").length) - 5 + "px";
            }
            
    setTimeout(function(){$("navbar").classList.add("show_nav");},100);


</script>