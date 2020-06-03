// JavaScript Document

function NuevoAjax(){
        var xmlhttp=false;
        try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
                try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }catch(E){
                        xmlhttp = false;
                }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}

function alta()
	{
		var login=document.frm_login.txtusuario.value;	
		var pass=document.frm_login.txtclave.value;	

		if(login == "" || login ==0 || login==null)
		{  
		alert("No ha escrito el Login");
		document.frm_login.username.focus();		
		}
	  else
	 	if(pass == "" || pass ==0 || pass==null)
		{  
		alert("No ha escrito el password");
		document.frm_login.txtclave.focus();	
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_login").serialize();
			//alert(str);
			$.ajax({
			 
			url: 'login.php',
			data: str,
			type: 'get',
			success: function(data){

				//alert(data);
				
				if(data=="no")
				{	
              	alert("Login y Password incorrectos");
				}
				else
				if(data=="de")
				{	
             	alert("La cuenta ha sido desactivada, contacte al Administrador del Sistema");
				}
				else
				if(data=="ve")
				{	
             	alert("Tu cuenta ha caducado, esta vencida, contacte al Administrador del Sistema");
				}else
				if(data=="si")
				{	
             	alert("Bienvenido al Sistema");
				window.location.href="panel_principal.php";
				}
				else
				{
				 alert(data);	
				}
			
			}
		});
	  }
     }

function cerrarsession()
{
	if (confirm("\xBFEst\xE1 seguro de salir del sistema?"))
	{
        ajaxdata=NuevoAjax();
        ajaxdata.open("get", "php/sessionexit.server.php" ,true); 
        ajaxdata.onreadystatechange=function(){
                if(ajaxdata.readyState==4){
                        if(ajaxdata.status==200){
								document.location=ajaxdata.responseText;
						}
                }
        }
        ajaxdata.send(null);
	}
}

function cerrarsession_modulos()
{
	//alert("entro a cerrarsesion_modulos");
	if (confirm("\xBFEst\xE1 seguro de salir del sistema?"))
	{
        ajaxdata=NuevoAjax();
        ajaxdata.open("get", "../php/sessionexit_modulos.server.php" ,true); 
        ajaxdata.onreadystatechange=function(){
                if(ajaxdata.readyState==4){
                        if(ajaxdata.status==200){
								document.location=ajaxdata.responseText;
						}
                }
        }
        ajaxdata.send(null);
	}
}

function accesar_conenter(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
			var login=document.frm_login.txtusuario.value;	
			var pass=document.frm_login.txtclave.value;	

			if(login == "" || login ==0 || login==null)
			{  
			alert("No ha escrito el Login");
			document.frm_login.username.focus();		
			}
		  else
		 	if(pass == "" || pass ==0 || pass==null)
			{  
			alert("No ha escrito el password");
			document.frm_login.txtclave.focus();	
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_login").serialize();
				//alert(str);
				$.ajax({
				 
				url: 'login.php',
				data: str,
				type: 'get',
				success: function(data){

					//alert(data);
					
					if(data=="no")
					{	
	              	alert("Login y Password incorrectos");
					}
					else
					if(data=="de")
					{	
	             	alert("La cuenta ha sido desactivada, contacte al Administrador del Sistema");
					}
					else
					if(data=="ve")
					{	
	             	alert("Tu cuenta ha caducado, esta vencida, contacte al Administrador del Sistema");
					}else
					if(data=="si")
					{	
	             	alert("Bienvenido al Sistema");
					window.location.href="panel_principal.php";
					}
					else
					{
					 alert(data);	
					}
				
				}
			});
		  }  		
	}	
}
