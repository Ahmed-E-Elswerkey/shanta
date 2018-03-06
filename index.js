
var home = false;

function toggle(s){
    // console.log("tog");
    if($(s).style.display != "none"){
        $(s).style.display = "none";
    }
    else if($(s).style.display != "block"){
        $(s).style.display = "block";
    }
}
function $(e){
    return document.getElementById(e);
}

function toggle_menu(){
    if($("menu").classList.contains("m_mini")){
        $("menu").classList.remove("m_mini");
        $("menu").classList.add("m_bigi");
    }
    else if($("menu").classList.contains("m_bigi")){
        $("menu").classList.remove("m_bigi");
        $("menu").classList.add("m_mini");
    }
    else 
        $("menu").classList.add("m_mini");
}

window.onload = setTimeout(function(){

    if($("sign_up")!=undefined)
        $("sign_up").style.background = "rgb(32, 78, 117)";

    if($("bill_d") != undefined)
        cart_f("consumer");

    if($("markets_loc") != undefined)
        $("markets_loc").focus();

    if(window.innerWidth < 1000){
        if($("menu") != undefined)
            $("menu").classList.add("m_mini");
    }

    $("menu_btn").addEventListener("click",function(){toggle_menu();});

    if(document.body.clientWidth > 1000 && $("bill_d") != undefined){
        $("bill_d").addEventListener("mouseover",function(){document.getElementById('bill_f_d').style.display = 'block';});
        $("bill_d").addEventListener("mouseleave",function(){document.getElementById('bill_f_d').style.display = 'none';});
    }
    
    if(document.body.clientWidth < 1000){
        var menu = $("menu").outerHTML;
        $("menu").remove();
        $("links_li").remove();
        $("navbar").innerHTML += menu;
        $("menu_btn").addEventListener("click",function(){toggle_menu();});
    }
    if(document.body.clientWidth < 1000 && $("search_li") != undefined && !home){
        var sear = $("search_li").outerHTML;
        $("search_li").remove();
        $("menu").innerHTML += sear;
    }
    if(document.body.clientWidth < 1000 && $("user_li") != undefined){
        var user_li = $("user_li").outerHTML;
        $("user_li").remove();
        console.log("user_remove_and_small_width");
        $("menu").innerHTML += user_li;
    }
    else console.log("width smallelr");
},150);

function body_toggle(e){
    if(e != undefined){
        e.addEventListener("mouseover",function(){element_hover=true;});
        e.addEventListener("mouseleave",function(){element_hover=false;});
    }
}

// Hide element when click on body if not hovering on it
var element_hover = false;
setTimeout(function(){
    document.getElementsByTagName("body")[0].addEventListener("click",function(){hide_element();});
    body_toggle($("meals"));
    body_toggle($("meals_in"));
    body_toggle($("search_out"));
    body_toggle($("menu"));
    body_toggle($("menu_btn"));
    body_toggle($("gys_container"));
    body_toggle($("get_yrslf"));

},110);

function hide_element(){

    if(!element_hover){
        if($("meals") !=undefined)
            meals_right();

        if($("search_out") != undefined)
            $("search_out").innerHTML = "";

        if($("menu") !=undefined)
            if(document.body.clientWidth < 1000)
                if($("menu").classList.contains("m_bigi") || !($("menu").classList.contains("m_mini")) ) {
                    $("menu").classList.remove("m_bigi");
                    $("menu").classList.add("m_mini");
                }
        if($("gys_container") != undefined){
            if($('get_yrslf_info').style.display == "block"){
                $('get_yrslf_info').style.display = "none";
                console.log("asd");
            }
            console.log("asdacvknflkew");
        }
    }
}
function meals_right(){
    if($("meals") != undefined){
        var m_r = $("meals_r").scrollWidth;
        $("meals").style.right = "-" + m_r + "px";
    }
}

function meals_r(){
    var meals = $("meals");
    if(meals.style.right != "0px")
        meals.style.right = "0px";
    else meals_right();
}

function meal_random(){
    var meal = document.querySelectorAll(".meal");
    var ml = meal.length;
    var r;
    r = Math.floor(Math.random()*ml);
    if(r <= ml){
        if(meal[r].style.background != "black")
            meal[r].style.background = 'black';
        else {
            meal[r].style.background = '#bbb';
            setTimeout(function(){meal[r].style.background = 'black';},100);
        }
    }
}

function meals_add(inn){
    var colorr  = ["#de4848","#27b559","#274cb5","#27a1b5","#5e27b5","#a93157","#65a931","#a93131"],i=0,r;
    r = Math.floor(Math.random()*8+1)
    var x = colorr[r];
    x = x.replace('#','');
    $("meal_color").value = x;
    if(inn == 'f'){
        $("meals_in").style.display = 'block';
        meals_pick();
    }
    if(inn == 'p'){
        var n = $("meal_name").value,c = $("meal_color").value;
        xml = new XMLHttpRequest;
        xml.onreadystatechange = function(){
            if(this.status == 200 && this.readyState == 4){
                $("meals_b").innerHTML += "<div class='meal' style='background:#" + c + ";'>" + n + "</div>";
                $("meal_name").value = "";
            }
        }
        xml.open("post",de+"/funcs/?t=meals-add&n=" + n + "&c=" + c,true);
        xml.send();
    }
}

function meals_b_f(){
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function(){
        if(this.status == 200 && this.readyState == 4){
            if(this.responseText.length > 46){
            $("meals_b").innerHTML = this.responseText;
        }
        meals_right();
        }
    }
    xml.open("post",de+"/funcs/?t=meals-b-f",true);
    xml.send();
}

var pickn = 0;
function meals_pick(){
        if(pickn<1){
                var xml = new XMLHttpRequest;
                xml.onreadystatechange = function(){
                        if(this.status == 200 && this.readyState == 4){                                
                                $("mleft").innerHTML = this.responseText;
                                pickn++;
                        }
                }
                xml.open("post",de+"/funcs/?t=meals-pick",true);
                xml.send();
        }
}

function meals_adds(n,c){
        xml = new XMLHttpRequest;
        xml.onreadystatechange = function(){
            if(this.status == 200 && this.readyState == 4){
                $("meals_b").innerHTML += "<div class='meal' style='background:#" + c + ";'>" + n + "</div>";
                $("meal_name").value = "";
            }
        }
        xml.open("post",de+"/funcs/?t=meals-add&n=" + n + "&c=" + c,true);
        xml.send();
}

var onmouse;
function meals_onmouse(j){
    if(j == "over")
        onmouse = true;
    if(j == "leave")
        onmouse = false;
}

function meals_in_click(){
    if(!onmouse)
        $("meals_in").style.display = 'none';
}

function select_change(e){
    for(var i=0;i<15;i++){
        if(document.getElementsByTagName("location")[i])
        {
            document.getElementsByTagName("location")[i].style.display = "none";
        }
        else break;
    }
    if($(e.value + "_loc")!=undefined)
        $(e.value + "_loc").style.display = "inline-block";
}

function sign_toggle(e){
    var inn = $('sign_in_form');
    var up = $('sign_up_form');
    inn.style.display = "none";
    up.style.display = "none";
    var id = e.getAttribute("id");
    $(id + "_form").style.display = "block";
    if(id == "sign_up")
        $("sign_in").style.background = "rgba(0,0,0,0.5)";
    else if(id == "sign_in")
        $("sign_up").style.background = "rgba(0,0,0,0.5)";
    e.style.background = "rgb(32, 78, 117)";
}

function select_market(e){
    xml = new XMLHttpRequest();

    xml.onreadystatechange = function(){
        if(this.status == 200){
            $("location1").innerHTML = this.responseText;
        }
    }
    xml.open("POST",de+"/funcs/?t=market-location&g=" + e.value,true);
    xml.send();
}

function market_type_f(){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
                if(this.status == 200 && this.readyState == 4){
                        $("market_type").innerHTML = this.responseText;
                }
        }
        xml.open("POST",de+"/funcs/?t=market-type-f",true);
        xml.send();
}

function update_market_image(id){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
                if(this.status == 200){
                        window.reload();
                }
        }
        xml.open('post',de+'/funcs/?t=update-market&id=' + id, true);
        xml.send();
}

//for products checking
function checkbox(event){
    // console.log(event.type);
    if(event.getAttribute("data-type") == 'product'){
        var id = event.getAttribute("data-id");
        if(event.checked){
            $("q" + id).disabled = false;
            $('q' + id).value = '1';
            if($('bill_n') != undefined)
                xml_bill_add(event.value);
            else window.location.href = de+"/sign";
        }
        else {
            $('q' + id).value = '';
            $('q' + id).disabled = true;
            xml_bill_remove(event.value);
        }
    }
    else if(event.getAttribute("data-type") == 'quantity'){
        var pro = event.getAttribute('data-product');
        xml_bill_edit(pro,event.value);
    }
}

function bill_pop(s){
    if(s == 'n'){
        $("bill_d_sign").style.display = "block";
        setTimeout(function(){$("bill_d_sign").style.display = 'none';},550)
    }
    if(s == 'm'){
        $('bill_d_sign').classList.add('trunc');
        $('bill_d_sign').innerHTML = "-";
        $("bill_d_sign").style.display = "block";
        setTimeout(function(){$("bill_d_sign").style.display = 'none';$('bill_d_sign').innerHTML = '+';$('bill_d_sign').classList.remove('trunc');},550);
    }
    if(s == 't'){
        $('bill_d_sign').classList.add('trunc');
        $('bill_d_sign').innerHTML = "X";
        $("bill_d_sign").style.display = "block";
        setTimeout(function(){$("bill_d_sign").style.display = 'none';$('bill_d_sign').innerHTML = '+';$('bill_d_sign').classList.remove('trunc');},550);
    }
}

function xml_bill_add(pro){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200){
            $('bill_n').innerHTML = this.responseText;
            cart_f('consumer');
            bill_pop('n');
        }
    }
    xml.open('post',de+'/funcs/?t=bill-add&pro=' + encodeURI(pro),true);
    xml.send();
}

function xml_bill_edit(pro,value){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200){
            cart_f('consumer');
            bill_pop('n');
        }
    }
    xml.open('post',de+'/funcs/?t=bill-edit&pro=' + pro + '&q=' + value,true);
    xml.send();
}

function xml_bill_remove(pro){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200){
            $('bill_n').innerHTML = this.responseText;
            cart_f('consumer');
            bill_pop('m');
        }
    }
    xml.open('post',de+'/funcs/?t=bill-remove&pro=' + pro,true);
    xml.send();
}

function xml_bill_trunc(){
    for(var i=0;i<10000,document.getElementsByClassName('check')[i] != undefined;i++){
        document.getElementsByClassName('check')[i].checked = false;
        var id = document.getElementsByClassName('check')[i].getAttribute('data-id'),
            value = document.getElementsByClassName('check')[i].value;
        $('q' + id).value = '';
        $('q' + id).disabled = true;
        $('q' + id).value = '';
    }
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200){
            $('bill_n').innerHTML = this.responseText;
            cart_f('consumer');
            bill_pop('t');
        }
    }
    xml.open('post',de+'/funcs/?t=bill-trunc',true);
    xml.send();

}
//////////////////////////////////////////////////////
function xml_checkout_b(){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200){
            xml_bill_trunc();
            window.location = de+'/user';
        }
    }
    xml.open('post',de+'/funcs/?t=checkout-b',true);
    xml.send();

}
/////////////////////////////////////////////////////////////////////////////////////////////

function bill_f(){
    var doc = $("bill_f_d");
    if(doc.style.display == 'none') {
        doc.style.display = 'block';
    }
    else {doc.style.display = 'none';}
}
///////////////////////////////////////////////////////////////////////
function cart_f(maj){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200 && $("cart") != undefined) {
            $("cart").innerHTML = this.responseText;
            var str = this.responseText;
            if (str.length > 1) {
                $("checkout").style.display = 'block';
            }
            else
                $("checkout").style.display = 'none';
        }
    }
    xml.open('post',de+'/funcs/?t=cart-f&ma=' + maj,true);
    xml.send();

}
////////////////////////////////////////////////////////////////////////
function markets_f(bid,mid){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200) {
            $("table_"+ bid + "_" + mid).innerHTML = this.responseText;
        }
    }
    xml.open('post',de+'/funcs/?t=markets-f&bid=' + bid + "&mid=" + mid,true);
    xml.send();

}
///////////////////////////////////////////////////
function req_f(bid,mid){
    xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200) {
            $("table_"+ bid + "_" + mid).innerHTML = this.responseText;
        }
    }
    xml.open('post',de+'/funcs/?t=req-f&bid=' + bid + "&mid=" + mid,true);
    xml.send();

}

function myFunction() {

if(document.getElementsByClassName('gta5')[0].style.display == 'none')
  for(var i=0;i<document.getElementsByClassName('gta5').length;i++){
    document.getElementsByClassName('gta5')[i].style.display = 'table-cell';
  }
  
  
if(document.getElementsByClassName('gta5')[0].style.display == 'table-cell')
  for(var i=0;i<document.getElementsByClassName('gta5').length;i++){
      document.getElementsByClassName('gta5')[i].style.display = 'none';
  }
}

//-------------------------------------------------------

function search_out(e){
    var s_str = e.value;
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.status == 200 && s_str.length > 0 && s_str[0] != " "){
            $("search_out").innerHTML = this.responseText;
        }
        else if(s_str < 1){
            $("search_out").innerHTML = "";
        }
    }
    xml.open("post",de+"/funcs/?t=search-out&v=" + s_str,true);
    xml.send();
}