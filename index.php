<?php
    include_once '../initi.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Shanta | User page</title>


    <?php
        include_once '../navbar.php';
        if($_SESSION['user_name']){
            if($_SESSION['major'] == 'consumer'){
                $res_id = $GLOBALS['conn']->query("SELECT distinct id FROM bags WHERE user_id='$_SESSION[user_id]' ORDER BY id DESC");
                if($res_id){
                    $row_id = $res_id->fetch_assoc();
                    if($row_id){
                        $bid = $row_id['id'];
                        echo "
                        <div id='bags'>
                            <div class='bag'>
                                <div class='bag_label' data-label='$bid'>Bag $bid</div>
                                    <div id='bag_body_$bid' class='bag_body'>
                        ";
                        $res_markets = $GLOBALS['conn']->query("SELECT DISTINCT market_id FROM bags WHERE user_id='$_SESSION[user_id]' AND id='$bid'");
                        while($row_markets = $res_markets->fetch_assoc()){
                            $mid = $row_markets['market_id'];
                            $res_oppp = $GLOBALS['conn']->query("SELECT state FROM operations WHERE bag_id='$bid' AND market_id='$mid'");
                            $m_name = $GLOBALS['conn']->query("SELECT name FROM markets WHERE id='$mid'");
                            if($res_oppp && $m_name){
                                $row_oppp = $res_oppp->fetch_assoc();
                                $row_m_name = $m_name->fetch_assoc();
                                echo "
                                        <div class='market_bag'>
                                            <div class='market_label' data-label='".$bid."_".$mid."' onclick='markets_f(".$bid.",".$mid.")'><a href='../products/?id=$mid' alt='Name of the market' title='Name of the market'>$row_m_name[name]</a></div>
                                                <div id='market_body_".$bid."_".$mid."' class='market_body'>
                                                    <script>setTimeout(function(){markets_f(".$bid.",".$mid.");},300);</script>
                                                    <table id='table_".$bid."_".$mid."'></table>
                                                    <div class='bag_state ".$row_oppp['state']."'>".$row_oppp['state']."</div>
                                                </div>
                                        </div>
                                ";}
                        }
                        echo "</div></div>";
                    }
                    while($row_id=$res_id->fetch_assoc()){
                        $bid = $row_id['id'];
                        echo "
                            <div class='bag'>
                                <div class='bag_label' data-label='$bid'>Bag $bid</div>
                                    <div id='bag_body_$bid' class='bag_body'>
                        ";
                        $res_markets = $GLOBALS['conn']->query("SELECT DISTINCT market_id FROM bags WHERE user_id='$_SESSION[user_id]' AND id='$bid'");
                        // if($res_markets){
                        //     $row_markets = $res_markets->fetch_assoc();
                        //     $mid = $row_markets['market_id'];
                        //     $res_oppp = $GLOBALS['conn']->query("SELECT state FROM operations WHERE bag_id='$bid' AND market_id='$mid'");
                        //     $m_name = $GLOBALS['conn']->query("SELECT name FROM markets WHERE id='$mid'");
                        //     if($res_oppp && $m_name){
                        //         $row_oppp = $res_oppp->fetch_assoc();
                        //         $row_m_name = $m_name->fetch_assoc();
                        //         echo "
                        //                 <div class='market_bag'>
                        //                     <div class='market_label' data-label='".$bid."_".$mid."' onclick='markets_f(".$bid.",".$mid.")'><a href='../products/?id=$mid'>$row_m_name[name]</a></div>
                        //                         <div id='market_body_".$bid."_".$mid."' class='market_body'>
                        //                             <table id='table_".$bid."_".$mid."'></table>
                        //                             <div class='bag_state ".$row_oppp['state']."'>".$row_oppp['state']."</div>
                        //                         </div>
                        //                 </div>
                        //         ";}
                        // }
                        while($row_markets = $res_markets->fetch_assoc()){
                            $mid = $row_markets['market_id'];
                            $res_oppp = $GLOBALS['conn']->query("SELECT state FROM operations WHERE bag_id='$bid' AND market_id='$mid'");
                            $m_name = $GLOBALS['conn']->query("SELECT name FROM markets WHERE id='$mid'");
                            if($res_oppp && $m_name){
                                $row_oppp = $res_oppp->fetch_assoc();
                                $row_m_name = $m_name->fetch_assoc();
                                echo "
                                        <div class='market_bag'>
                                            <div class='market_label' data-label='".$bid."_".$mid."' onclick='markets_f(".$bid.",".$mid.")'><a href='../products/?id=$mid' alt='Name of the market' title='Name of the market'>$row_m_name[name]</a></div>
                                                <div id='market_body_".$bid."_".$mid."' class='market_body'>
                                                    <table id='table_".$bid."_".$mid."'></table>
                                                    <div class='bag_state ".$row_oppp['state']."'>".$row_oppp['state']."</div>
                                                </div>
                                        </div>
                                ";
                            }
                        }
                        echo "</div></div>";
                    }
                }

            }
            else if($_SESSION['major'] == 'market_admin'){
                if(!isset($_REQUEST['id']))
                    header("Location: $_SESSION[de]");
                $res_id = $GLOBALS['conn']->query("SELECT distinct id FROM bags WHERE market_id='$_REQUEST[id]' ORDER BY id DESC");
                if($res_id){
                    $mid = $_REQUEST['id'];
                    // $row_id = $res_id->fetch_assoc();
                    // if($row_id){
                    //     $bid = $row_id['id'];
                    //     echo "
                    //     <div id='m_bags'>
                    //         <div class='m_bag' onclick=\"m_bag('".$bid."')\">
                    //             <div class='m_bag_label' data-label='$bid'>Bag $bid</div>
                    //                 <div id='bag_body_$bid' class='m_bag_body'>
                    //     ";
                    //     $res_markets = $GLOBALS['conn']->query("SELECT DISTINCT user_id FROM bags WHERE market_id='$_REQUEST[id]' AND id='$bid'");
                    //     $res_opp = $GLOBALS['conn']->query("SELECT state FROM operations WHERE market_id='$_REQUEST[id]' AND bag_id='$bid'");
                    //     $row_opp = $res_opp->fetch_assoc();
                    //     // if($res_markets && $res_opp){
                    //     //     $row_markets = $res_markets->fetch_assoc();
                    //     //     $uid = $row_markets['user_id'];
                    //     //     $res_u = $GLOBALS['conn']->query("SELECT name FROM users WHERE id='$uid'");
                    //     //     $row_u = $res_u->fetch_assoc();
                    //     //     echo "
                    //     //                 <div class='m_user_bag'>
                    //     //                     <div class='m_user_label' data-label='".$bid."_".$mid."'>User: ".$row_u['name']."</div>
                    //     //                         <div class='bag_state ".$row_opp['state']."' id='bag_state_".$bid."'>".$row_opp['state']."</div>
                    //     //                         <div id='market_body_".$bid."' class='m_market_body'>
                    //     //                         <h2>Bag $bid</h2>

                    //     //                             <table id='table_".$bid."_".$mid."'></table>
                    //     //                             <script>setTimeout(function(){req_f(".$bid.",".$mid.");},300);</script>
                    //     //                             <button onclick='bag_done(".$bid.")'>Done</button>
                    //     //                         </div>
                    //     //                 </div>
                    //     //     ";
                    //     // }
                    //     while($row_markets = $res_markets->fetch_assoc()){
                    //         $res_u = $GLOBALS['conn']->query("SELECT name FROM users WHERE id='$uid'");
                    //         $row_u = $res_u->fetch_assoc();
                    //         echo "
                    //                     <div class='m_user_bag'>
                    //                         <div class='m_user_label' data-label='".$bid."_".$mid."'>User: ".$row_u['name']."</div>
                    //                             <div class='bag_state ".$row_opp['state']."' id='bag_state_".$bid."'>".$row_opp['state']."</div>
                    //                             <div id='market_body_".$bid."' class='m_market_body'>
                    //                             <h2>Bag $bid</h2>

                    //                                 <table id='table_".$bid."_".$mid."'></table>
                    //                                 <script>setTimeout(function(){req_f(".$bid.",".$mid.");},300);</script>
                    //                                 <button onclick='bag_done(".$bid.")'>Done</button>
                    //                             </div>
                    //                     </div>
                    //         ";
                    //     }
                    //     echo "</div></div>";
                    // }
                    while($row_id=$res_id->fetch_assoc()){
                        $bid = $row_id['id'];
                        echo "
                            <div class='m_bag' onclick=\"m_bag('".$bid."')\">
                                <div class='m_bag_label' data-label='$bid'>Bag $bid</div>
                                    <div id='bag_body_$bid' class='m_bag_body'>
                        ";
                        $res_markets = $GLOBALS['conn']->query("SELECT DISTINCT user_id FROM bags WHERE market_id='$_REQUEST[id]' AND id='$bid'");
                        $res_opp = $GLOBALS['conn']->query("SELECT state FROM operations WHERE market_id='$_REQUEST[id]' AND bag_id='$bid'");
                        $row_opp = $res_opp->fetch_assoc();
                        // if($res_markets && $res_opp){
                        //     $row_markets = $res_markets->fetch_assoc();
                        //     $uid = $row_markets['user_id'];
                        //     $res_u = $GLOBALS['conn']->query("SELECT name FROM users WHERE id='$uid'");
                        //     $row_u = $res_u->fetch_assoc();
                        //     echo "
                        //                 <div class='m_user_bag'>
                        //                     <div class='m_user_label' data-label='".$bid."_".$mid."'>User: ".$row_u['name']."</div>
                        //                         <div class='bag_state ".$row_opp['state']."' id='bag_state_".$bid."'>".$row_opp['state']."</div>
                        //                         <div id='market_body_".$bid."' class='m_market_body'>
                        //                             <h2>Bag $bid</h2>

                        //                             <table id='table_".$bid."_".$mid."'></table>
                        //                             <script>setTimeout(function(){req_f(".$bid.",".$mid.");},300);</script>
                        //                             <button onclick='bag_done(".$bid.")'>Done</button>
                        //                         </div>
                        //                 </div>
                        //     ";
                        // }
                        while($row_markets = $res_markets->fetch_assoc()){
                           $uid = $row_markets['user_id'];
                           $res_u = $GLOBALS['conn']->query("SELECT name FROM users WHERE id='$uid'");
                            $row_u = $res_u->fetch_assoc();
                            echo "
                                        <div class='m_user_bag'>
                                            <div class='m_user_label' data-label='".$bid."_".$mid."'>User: ".$row_u['name']."</div>
                                                <div class='bag_state ".$row_opp['state']."' id='bag_state_".$bid."'>".$row_opp['state']."</div>
                                                <div id='market_body_".$bid."' class='m_market_body'>
                                                    <h2>Bag $bid</h2>

                                                    <table id='table_".$bid."_".$mid."'></table>
                                                    <script>setTimeout(function(){req_f(".$bid.",".$mid.");},300);</script>
                                                    <button onclick='bag_done(".$bid.")'>Done</button>
                                                </div>
                                        </div>
                            ";
                        }
                        echo "</div></div>";
                    }
                }

            }
            echo "</div></div>";
        }
        else header("Location: $_SESSION[de]/sign");

        echo "<script src='../js/user.js'></script>";
        
        include_once '../footer.php';

        ?>
    