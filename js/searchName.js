
$(document).ready(function () {
    var name=$("#name").text();
    //alert(name);
    show(1,5,name);
    $(".pagination").find("li").each(function() {
            $(this).click(function () {
                var a=$(this).find("a");
                var num=$(a).text();
                show(num,5,name);
            });
        }
    );
    bag();

});

function show( num, pageCount,name){
    $.post("list.php",{"page":num,"pageCount":pageCount,"name":name,"type":3},function(data){
        //alert(data);
        var content=$("#show");
        content.empty();
        //content.append(data);
        var arr = eval('(' + data +')');

        //var cont='<table>';
        for(var i=0;i<$(arr).length;i++){
            var cont='<div class="col-sm-3"><table>';
            cont = cont + '<tr><td><img class="img-rounded" src="items/'+arr[i]['id']+'.jpg"/></td></tr>';
            cont = cont + '<tr><td>' + arr[i]['name'] + '</td></tr>';
            cont = cont + '<tr><td>' + arr[i]['position'] + '</td></tr>';
            cont = cont + '<tr><td>' + arr[i]['type'] + '</td></tr>';
            cont = cont + '<tr><td>$' + arr[i]['price'] + '</td></tr>';
            cont = cont + '<tr><td><button type="button" class="btn btn-default btn-block" onclick="cart('+arr[i]['id']+')">Add To Cart</button></td></tr>';
            //cont = cont + '</table>';
            cont = cont + '</table></div>';
            content.append(cont);
        }
        //cont = cont + '</table>';
        //content.append(cont);
    });
}

function bag(){
    $.post("bag.php",{},function(data){
        $("#bag").text(data);
    });
}

function cart(id){
    $.post("addCart.php",{"id":id},function(data){
        alert("success add in the cart");
    });
    bag();
}