document.writeln("<script type='text/javascript' src='info.php'></script>");

function userreload() 
{
	reload_js('info.php');
	//if(document.getElementById('here').innerHTML!="Zaloguj się!")
	//{
		//document.getElementById('logout').style.display="inline";
	//}	

	
}
function reload_js(src) 
{
     	//alert("OK");
     $('script[src="' + src + '"]').remove();
     $('<script>').attr('src', src).appendTo('head');
}
$(function()
{
	
    setInterval(userreload, 1000);
	
})	
