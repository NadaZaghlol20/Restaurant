
var d5 = document.getElementById('more'),
    d6 = document.getElementById('hiddenMore'),
    d7 = document.getElementById('hiddenMore2'),
    d8 = document.getElementById('hiddenMore3'),
    d9 = document.getElementById('hiddenMore4'),
    d10 = document.getElementById('more2'),
    d11 = document.getElementById('more3'),
    d12 = document.getElementById('more4'),
    d13 = document.getElementById('hiddenMore5'),
    d14 = document.getElementById('hiddenMore6'),
    d15 = document.getElementById('hiddenMore7'),
    d16 = document.getElementById('hiddenMore8'),
    d17 = document.getElementById('hiddenMore9'),
    d18 = document.getElementById('more5'),
    d19 = document.getElementById('more6'),
    d20 = document.getElementById('more7'),
    d21 = document.getElementById('more8'),
    d22 = document.getElementById('more9');

$(window).on("scroll",function(){
    if($(window).scrollTop()>=300)
    {
        $('#goUPButton').slideDown(700);
    }
    else
    {
        $('#goUPButton').slideUp(700); 
    }
}) ;
function goUP(){
    window.scrollTo(0,0); 
};
d5.onclick=function(){
    if(d5.innerHTML=="....Show More")
        {
            d6.style.display="inline";
            d5.innerHTML="....Hide";    
        }
    else
        {
            d6.style.display="none";
            d5.innerHTML="....Show More" ;           
        }
    
}
d10.onclick=function(){
    if(d10.innerHTML=="....Show More")
        {
            d7.style.display="inline";
            d10.innerHTML="....Hide";    
        }
    else
        {
            d7.style.display="none";
            d10.innerHTML="....Show More" ;           
        }
    
}
d11.onclick=function(){
    if(d11.innerHTML=="....Show More")
        {
            d8.style.display="inline";
            d11.innerHTML="....Hide";    
        }
    else
        {
            d8.style.display="none";
            d11.innerHTML="....Show More";            
        }
    
}
d12.onclick=function(){
    if(d12.innerHTML=="....Show More")
        {
            d9.style.display="inline";
            d12.innerHTML="....Hide";    
        }
    else
        {
            d9.style.display="none";
            d12.innerHTML="....Show More";            
        }
    
}
d18.onclick=function(){
    if(d18.innerHTML=="....Show More")
        {
            d13.style.display="inline";
            d18.innerHTML="....Hide";    
        }
    else
        {
            d13.style.display="none";
            d18.innerHTML="....Show More";            
        }
    
}
d19.onclick=function(){
    if(d19.innerHTML=="....Show More")
        {
            d14.style.display="inline";
            d19.innerHTML="....Hide";    
        }
    else
        {
            d14.style.display="none";
            d19.innerHTML="....Show More";            
        }
    
}
d20.onclick=function(){
    if(d20.innerHTML=="....Show More")
        {
            d15.style.display="inline";
            d20.innerHTML="....Hide";    
        }
    else
        {
            d15.style.display="none";
            d20.innerHTML="....Show More";            
        }
    
}
d21.onclick=function(){
    if(d21.innerHTML=="....Show More")
        {
            d16.style.display="inline";
            d21.innerHTML="....Hide";    
        }
    else
        {
            d16.style.display="none";
            d21.innerHTML="....Show More";            
        }
    
}
d22.onclick=function(){
    if(d22.innerHTML=="....Show More")
        {
            d17.style.display="inline";
            d22.innerHTML="....Hide";    
        }
    else
        {
            d17.style.display="none";
            d22.innerHTML="....Show More";            
        }
    
}
$(document).ready(function(){
    $(".wish-icon i").click(function(){
        $(this).toggleClass("fa-heart fa-heart-o");
    });
    $('.datepicker').pickadate({
        editable: true
    })
});	











