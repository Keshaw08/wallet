function disableScreen() {
    var div= document.createElement("div");
    div.className += "disabled_screen";
    document.body.appendChild(div);
}

function widraw(){
    var a=document.getElementById("current_amount").textContent;
    var pin=prompt("Enter PIN");
    if(pin==1111){
        var b=prompt("Enter Amount")
        a=parseInt(a)
        if(b<=a){
            var d=parseInt(a)-parseInt(b);
            document.getElementById("current_amount").innerHTML=d;
            confirm("Transaction Sucessfull!");
        }
        else{
            alert("Enter Valid Amount!!");
        }
    }
    else{
        alert("Enter Valid Pin!!");
    }
}

function add(){
    var a=document.getElementById("current_amount").textContent;
    var pin=prompt("Enter PIN");
    if(pin==1111){
        var b=prompt("Enter Amount")
        if(b<1000000){
            var d=parseInt(a)+parseInt(b);
            document.getElementById("current_amount").innerHTML=d;
            confirm("Transaction Sucessfull!");
        }
        else{
            alert("Enter Valid Amount!!");
        }
    }
    else{
        alert("Enter Valid Pin!!");
    }
}

