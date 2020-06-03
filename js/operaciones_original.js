// JavaScript Document

function alta_usuario()
	{
		var login=document.frm_nuevo_usuario.txtlogin_usuario.value;	
		var pass=document.frm_nuevo_usuario.txtpassword_usuario.value;
		var confpass=document.frm_nuevo_usuario.txtconfirmar_password_usuario.value;
		var fec_creacion=document.frm_nuevo_usuario.datepicker1.value;
		var fec_vencimiento=document.frm_nuevo_usuario.datepicker2.value;	
		var activo_usuario=document.frm_nuevo_usuario.cmbactivo_usuario.value;	
		var nombre_usuario=document.frm_nuevo_usuario.txtnombre_usuario.value;	

		if(login == "" || login ==0 || login==null)
		{  
		alert("No ha escrito el Login");
		document.frm_nuevo_usuario.txtlogin_usuario.focus();		
		}
	  else
	 	if(pass == "" || pass ==0 || pass==null)
		{  
		alert("No ha escrito el password");
		document.frm_nuevo_usuario.txtpassword_usuario.focus();	
		}
	  else
	 	if(confpass == "" || confpass ==0 || confpass==null)
		{  
		alert("No ha confirmado el password");
		document.frm_nuevo_usuario.txtconfirmar_password_usuario.focus();	
		}		
	  else
	 	if(fec_creacion == "" || fec_creacion ==0 || fec_creacion==null)
		{  
		alert("No ha indicado la fecha de creacion");
		document.frm_nuevo_usuario.datepicker1.focus();	
		}
	  else
	 	if(fec_vencimiento == "" || fec_vencimiento ==0 || fec_vencimiento==null)
		{  
		alert("No ha indicado la fecha de vencimiento");
		document.frm_nuevo_usuario.datepicker2.focus();	
		}	
	  else
	 	if(activo_usuario == "" || activo_usuario ==0 || activo_usuario==null)
		{  
		alert("No ha indicado si el usuario estara o no activo");
		}
	  else
	 	if(nombre_usuario == "" || nombre_usuario ==0 || nombre_usuario==null)
		{  
		alert("No ha indicado el nombre del usuario");
		}																										
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_usuario").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_usuario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
              	alert("Error al guardar el USUARIO");
				}
				else(data=="Y")
				{	
             	alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				
				document.location.href = "usuarios.php";
				//document.location.href ="eliminar_usuario.php";
				
				
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }
     }
	 
function validar_login(formulario)
	{
		//alert(formulario);
		var nombre_formulario=formulario;
		
		var login=document.frm_nuevo_usuario.txtlogin_usuario.value;	

		if(login == "" || login ==0 || login==null)
		{  
		alert("No ha escrito el Login");
		document.frm_nuevo_usuario.txtlogin_usuario.focus();		
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_usuario").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/validar_login.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El LOGIN ya existe, seleccione otro");
				document.frm_nuevo_usuario.txtlogin_usuario.focus();
				}
				
			}
		});
	  }
     }	 
	 
function validar_password()
{
		var pass=document.frm_nuevo_usuario.txtpassword_usuario.value;
		var confpass=document.frm_nuevo_usuario.txtconfirmar_password_usuario.value;
		if(pass!=confpass)
			{
				alert("No coinciden las claves");	
			}
}	

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

function mostrar_lista_usuarios(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowusuarios.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);
}

function modificar_usuario()
{
		var id_usuario_modificar=document.frm_modificar_usuario.txtid_usuario_modificar.value;	
		
		var login=document.frm_modificar_usuario.txtlogin_usuario.value;	
		var pass=document.frm_modificar_usuario.txtpassword_usuario.value;
		var confpass=document.frm_modificar_usuario.txtconfirmar_password_usuario.value;
		var fec_creacion=document.frm_modificar_usuario.datepicker1.value;
		var fec_vencimiento=document.frm_modificar_usuario.datepicker2.value;	
		var activo_usuario=document.frm_modificar_usuario.cmbactivo_usuario.value;	
		//var nombre_usuario=document.frm_modificar_usuario.buscar.value;	
		
		if(login == "" || login ==0 || login==null)
		{  
		alert("No ha escrito el Login");
		document.frm_nuevo_usuario.txtlogin_usuario.focus();		
		}
	  else
	 	if(pass == "" || pass ==0 || pass==null)
		{  
		alert("No ha escrito el password");
		document.frm_nuevo_usuario.txtpassword_usuario.focus();	
		}
	  else
	 	if(confpass == "" || confpass ==0 || confpass==null)
		{  
		alert("No ha confirmado el password");
		document.frm_nuevo_usuario.txtconfirmar_password_usuario.focus();	
		}		
	  else
	 	if(fec_creacion == "" || fec_creacion ==0 || fec_creacion==null)
		{  
		alert("No ha indicado la fecha de creacion");
		document.frm_nuevo_usuario.datepicker1.focus();	
		}
	  else
	 	if(fec_vencimiento == "" || fec_vencimiento ==0 || fec_vencimiento==null)
		{  
		alert("No ha indicado la fecha de vencimiento");
		document.frm_nuevo_usuario.datepicker2.focus();	
		}	
	  else
	 	if(activo_usuario == "" || activo_usuario ==0 || activo_usuario==null)
		{  
		alert("No ha indicado si el usuario estara o no activo");
		}
	else	
		if(id_usuario_modificar == "" || id_usuario_modificar ==0 || id_usuario_modificar==null)
		{  
		alert("No ha escrito el nombre de usuario a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_usuario").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../seguridad/editar_usuario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
              	alert("Error al modificar el USUARIO");
				}
				else(data=="Y")
				{	
             	alert("USUARIO modificado correctamente");
				document.location.href ="usuarios.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }		
}

function consultar_usuario()
{
		var usuario_buscar=document.frm_consultar_usuario.buscar.value;	

		if(usuario_buscar == "" || usuario_buscar ==0 || usuario_buscar==null)
		{  
		alert("No ha escrito el nombre del usuario a buscar");
		document.frm_consultar_usuario.buscar.focus();		
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_consultar_usuario").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/buscar_usuario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];
				var data4=datatotal[4];
				var data5=datatotal[5];
				var data6=datatotal[6];
				var data7=datatotal[7];

				if(data0=="E")
				{	
              	alert("No se encuentra el Usuario");
				}
				else(data0=="Y")
				{	
             	document.frm_consultar_usuario.txtlogin_usuario.value=data1;
				document.frm_consultar_usuario.txtpassword_usuario.value=data2;
				document.frm_consultar_usuario.txtconfirmar_password_usuario.value=data2;
				document.frm_consultar_usuario.cmbactivo_usuario.value=data3;
             	document.frm_consultar_usuario.txtcreacion.value=data5;
				document.frm_consultar_usuario.txtvencimiento.value=data6;
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }	
}

function alta_marca()
{
		var desc_marc=document.frm_nueva_marca.txtnombre_marca.value;	

		if(desc_marc == "" || desc_marc ==0 || desc_marc==null)
		{  
		alert("No ha escrito la marca");
		document.frm_nueva_marca.txtnombre_marca.focus();		
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_marca").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_marca.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La marca ya existe escriba otra");
				document.location.href = "marcas.php";	
				}
				else
				{
				alert("MARCA guardada satisfactoriamente");	
				document.location.href = "marcas.php";	
				}
				
			}
		});
	  }	
}

function mostrar_lista_marcas(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowmarcas.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);
}

function modificar_marca(id_marca)
{
	var id_marca=id_marca;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_marca.php"+'?idmarca='+id_marca;	
}

function eliminar_marca(id_marca)
{
		document.frm_lista_marcas.txtid_marca_eliminar.value=id_marca;
		var id_marca_eliminar=document.frm_lista_marcas.txtid_marca_eliminar.value;
		
		if(id_marca_eliminar == "" || id_marca_eliminar ==0 || id_marca_eliminar==null)
		{  
		alert("No ha seleccionado la marca a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_lista_marcas").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_marca.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }	
}

function modificar_datos_marca()
{
		var id_marca_modificar=document.frm_modificar_marca.txtid_marca.value;
		
		if(id_marca_modificar == "" || id_marca_modificar ==0 || id_marca_modificar==null)
		{  
		alert("No ha seleccionado la marca a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_marca").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_marca.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La marca ha sido modificada");
				document.location.href ="marcas.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_proveedor()
{
  var nombre_agente=document.frm_nuevo_proveedor.txtnombre_agente.value;
  var nombre_empresa=document.frm_nuevo_proveedor.txtnombre_empresa.value;
  var telefono_agente=document.frm_nuevo_proveedor.txttelefono_agente.value;
  var correo_agente=document.frm_nuevo_proveedor.txtcorreo_agente.value;
	if(nombre_agente=="" || nombre_agente==0 || nombre_agente==null)
  		{
			alert("Indique el nombre del agente de venta");
			document.frm_nuevo_proveedor.txtnombre_agente.focus();
		}
	else if(nombre_empresa=="" || nombre_empresa==0 || nombre_empresa==null)
		{
			alert("Indique el nombre de la empresa");
			document.frm_nuevo_proveedor.txtnombre_empresa.focus();			
		}
	else if(telefono_agente=="" || telefono_agente==0 || telefono_agente==null)
		{
			alert("Indique el telefono del agente de venta");
			document.frm_nuevo_proveedor.telefono_agente.focus();			
		}
	else if(correo_agente=="" || correo_agente==0 || correo_agente==null)
		{
			alert("Indique el correo del agente de venta");
			document.frm_nuevo_proveedor.correo_agente.focus();			
		}		
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_proveedor").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_proveedor.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				if(data=="E")
				{	
				document.location.href = "proveedores.php";
				}
				else(data=="Y")
				{	
              	alert("El proveedor se guardo correctamente");
				document.location.href = "proveedores.php";
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }				
}

function mostrar_lista_proveedores(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowproveedores.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);
}

function eliminar_proveedor(id_proveedor)
{
		document.frm_lista_proveedores.txtid_proveedor_eliminar.value=id_proveedor;
		var id_proveedor_eliminar=document.frm_lista_proveedores.txtid_proveedor_eliminar.value;
		
		if(id_proveedor_eliminar == "" || id_proveedor_eliminar ==0 || id_proveedor_eliminar==null)
		{  
		alert("No ha seleccionado el proveedor a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_lista_proveedores").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_proveedor.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El proveedor ha sido eliminado");
				document.location.href = document.location.href;	
				}
				else
				{	
             	alert("El proveedor ha sido eliminado");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function modificar_proveedor(id_proveedor)
{
	var id_proveedor=id_proveedor;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_proveedor.php"+'?idproveedor='+id_proveedor;	
}

function modificar_datos_proveedor()
{
		var id_proveedor_modificar=document.frm_modificar_proveedor.txtid_proveedor_modificar.value
		
		if(id_proveedor_modificar == "" || id_proveedor_modificar ==0 || id_proveedor_modificar==null)
		{  
		alert("No ha seleccionado el proveedor a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_proveedor").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_proveedor.php',
			data: str,
			type: 'post',
			success: function(data){

				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El proveedor ha sido modificado");
				document.location.href ="proveedores.php";
			}
		});
	  }		
}

function agregar_producto_inventario()
{
		var cmbproveedor=document.frm_alta_producto_inventario.cmbproveedor.value;	
		var txtcodigo_barras=document.frm_alta_producto_inventario.txtcodigo_barras.value;
		var txtdescripcion_producto=document.frm_alta_producto_inventario.txtdescripcion_producto.value;
		var cmbmarca=document.frm_alta_producto_inventario.cmbmarca.value;
		var txtcantidad_existencia=document.frm_alta_producto_inventario.txtcantidad_existencia.value;	
		var txtcantidad_comprada=document.frm_alta_producto_inventario.txtcantidad_comprada.value;	
		var txtprecio_compra=document.frm_alta_producto_inventario.txtprecio_compra.value;	
		var txtprecio_venta=document.frm_alta_producto_inventario.txtprecio_venta.value;	
		var txtstock_minimo=document.frm_alta_producto_inventario.txtstock_minimo.value;	
		var txtstock_maximo=document.frm_alta_producto_inventario.txtstock_maximo.value;	
		

		if(cmbproveedor == "" || cmbproveedor ==0 || cmbproveedor==null)
		{  
		alert("No ha escrito el proveedor");
		document.frm_alta_producto_inventario.cmbproveedor.focus();		
		}
	  else
	 	if(txtcodigo_barras == "" || txtcodigo_barras ==0 || txtcodigo_barras==null)
		{  
		alert("No ha escrito el codigo de barras");
		document.frm_alta_producto_inventario.txtcodigo_barras.focus();	
		}
	  else
	 	if(txtdescripcion_producto == "" || txtdescripcion_producto ==0 || txtdescripcion_producto==null)
		{  
		alert("No ha escrito la descripcion del producto");
		document.frm_alta_producto_inventario.txtdescripcion_producto.focus();	
		}		
	  else
	 	if(cmbmarca == "" || cmbmarca ==0 || cmbmarca==null)
		{  
		alert("No ha indicado la marca");
		document.frm_alta_producto_inventario.cmbmarca.focus();	
		}
	  else
	 	if(txtcantidad_existencia == "" || txtcantidad_existencia ==0 || txtcantidad_existencia==null)
		{  
		alert("No ha indicado la cantidad en existencia");
		document.frm_alta_producto_inventario.txtcantidad_existencia.focus();	
		}	
	  else
	 	if(txtcantidad_comprada == "" || txtcantidad_comprada ==0 || txtcantidad_comprada==null)
		{  
		alert("No ha indicado la cantidad comprada");
		document.frm_alta_producto_inventario.txtcantidad_comprada.focus();	
		}
	  else
	 	if(txtprecio_compra == "" || txtprecio_compra ==0 || txtprecio_compra==null)
		{  
		alert("No ha indicado el precio de compra");
		document.frm_alta_producto_inventario.txtprecio_compra.focus();			
		}		
	  else
	 	if(txtprecio_venta == "" || txtprecio_venta ==0 || txtprecio_venta==null)
		{  
		alert("No ha indicado el precio de venta");
		document.frm_alta_producto_inventario.txtprecio_venta.focus();			
		}		
	  else
	 	if(txtstock_minimo == "" || txtstock_minimo ==0 || txtstock_minimo==null)
		{  
		alert("No ha indicado el stock minimo");
		document.frm_alta_producto_inventario.txtstock_minimo.focus();			
		}		
	  else
	 	if(txtstock_maximo == "" || txtstock_maximo ==0 || txtstock_maximo==null)
		{  
		alert("No ha indicado el stock maximo");
		document.frm_alta_producto_inventario.txtstock_maximo.focus();			
		}		
	  else
		    {
			//alert("entro");
			var str = $("#frm_alta_producto_inventario").serialize();
			//alert(str);
			$.ajax({
			 
			url: 'alta_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
              	alert("PRODUCTO guardado correctamente");
				}
				else
				{	
             	//alert("El producto ya existe, capture otro");
				alert("PRODUCTO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				
				document.location.href = "productos.php";
				//document.location.href ="eliminar_usuario.php";
				
				
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }	
}

function mostrar_lista_productos_inventario(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowproductos_inventario.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);
}

function modificar_producto_inventaro(id_producto_inventario)
{
	var id_producto_inventario=id_producto_inventario;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="../mantenimiento/modificar_producto_inventario.php"+'?idproductoinventario='+id_producto_inventario;		
}

function modificar_datos_producto_inventario()
{
		var id_producto_inventario_modificar=document.frm_modificar_producto_inventario.txtid_producto_inventario_modificar.value
		
		if(id_producto_inventario_modificar == "" || id_producto_inventario_modificar ==0 || id_producto_inventario_modificar==null)
		{  
		alert("No ha seleccionado el producto a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_producto_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: 'modificar_datos_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El producto ha sido modificado");
				document.location.href ="productos.php";
				//document.location.href ="mantenimiento/productos.php";
			}
		});
	  }			
}

function eliminar_producto_inventario(id_producto_inventario)
{
		document.frm_lista_productos.txtid_producto_inventario_eliminar.value=id_producto_inventario;
		var id_producto_inventario_eliminar=document.frm_lista_productos.txtid_producto_inventario_eliminar.value;
		
		if(id_producto_inventario_eliminar == "" || id_producto_inventario_eliminar ==0 || id_producto_inventario_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_lista_productos").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El producto ha sido eliminado");
				document.location.href = document.location.href;	
				}
				else
				{	
             	alert("El producto ha sido eliminado");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }			
}

function mostrar_lista_productos_vendidos(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowproductos_vendidos.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);	
}

function buscar_producto_venta_cb()
{
	//alert("entro buscar producto venta");	
	var cb_producto=document.frm_nueva_venta.txtcodigobp.value;	

	if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
	{  
	alert("No ha seleccionado ningun producto");
	document.frm_nueva_venta.txtcodigobp.focus();		
	}
  else
		{
		//alert("entro");
		var str = $("#frm_nueva_venta").serialize();
		//alert(str);
		$.ajax({
		 
		url: '../php/buscar_producto_venta_cb.php',
		data: str,
		type: 'post',
		success: function(data){

			//alert(data);
			/*var datatotal=data.split(",");
			var data0=datatotal[0];
			var data1=datatotal[1];
			var data2=datatotal[2];
			var data3=datatotal[3];		
			var data4=datatotal[4];	
			var data5=datatotal[5];	
			var data6=datatotal[6];	*/							
				
			if(data==0)
			{	
			alert("EL PRODUCTO NO EXISTE");
			}
			else
			{	
			//alert("USUARIO guardado correctamente");
			//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
			//location.href="http://127.0.0.1/siscoh/panel_principal.php";
			//location.reload();
			/*document.frm_nueva_venta.txtid_producto_buscar.value=data1;
			document.frm_nueva_venta.txtcodigo_barras.value=data2;
			document.frm_nueva_venta.txtdescripcion_producto.value=data3;
			document.frm_nueva_venta.txtprecio_producto.value=data4;
			document.frm_nueva_venta.txtprecio_venta.value=data4;
			document.frm_nueva_venta.txtcantidad_existencia_producto_buscar.value=data5;
			document.frm_nueva_venta.txtexistencia_producto.value=data5;		
			document.frm_nueva_venta.txtcaducidad_producto.value=data6;		
			document.frm_nueva_venta.txtcantidad_producto.value=1;
			document.frm_nueva_venta.txtcantidad_producto.focus();*/
			document.location.href ="nueva_venta.php";
			}
			//document.frm_nuevo_usuario.txtcadena.value=data;
		}
	});
  }
}

function buscar_producto_venta_desc(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert("entro buscar producto venta");	
		var descripcion_producto=document.frm_nueva_venta.txtdescripcion_producto.value;	
	
		if(descripcion_producto == "" || descripcion_producto ==0 || descripcion_producto==null)
		{  
		alert("No ha seleccionado ningun producto");
		document.frm_nueva_venta.txtdescripcion_producto.focus();		
		}
	  else
			{
			//alert("entro");
			var str = $("#frm_nueva_venta").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/buscar_producto_venta_desc.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				var data6=datatotal[6];							
				
				if(data0=="E")
				{	
				alert("Error al buscar el producto");
				}
				else(data0=="Y")
				{	
				//alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				document.frm_nueva_venta.txtid_producto_buscar.value=data1;
				document.frm_nueva_venta.txtcodigo_barras.value=data2;
				document.frm_nueva_venta.txtdescripcion_producto.value=data3;
				document.frm_nueva_venta.txtprecio_producto.value=data4;
				document.frm_nueva_venta.txtprecio_venta.value=data4;
				document.frm_nueva_venta.txtcantidad_existencia_producto_buscar.value=data5;
				document.frm_nueva_venta.txtexistencia_producto.value=data5;		
				document.frm_nueva_venta.txtcaducidad_producto.value=data6;		
				document.frm_nueva_venta.txtcantidad_producto.value=1;
				document.frm_nueva_venta.txtcantidad_producto.focus();
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }
	}
}

function guardar_producto_venta(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert(cantidad);	
		var descripcion_producto=document.frm_nueva_venta.txtdescripcion_producto.value;	
	
		if(descripcion_producto == "" || descripcion_producto ==0 || descripcion_producto==null)
		{  
		alert("No ha seleccionado ningun producto");
		document.frm_nueva_venta.txtdescripcion_producto.focus();		
		}
	  else
			{
			//alert("entro");
			var str = $("#frm_nueva_venta").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_producto_venta.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);				
				if(data=="E")
				{	
				alert("Error al guardar el producto");
				}
				else(data=="Y")
				{	
				//alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				document.location.href = document.location.href;	
				document.frm_nueva_venta.txtdescripcion_producto.focus();
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	  }
	}
}

function modificar_producto_venta(id_producto_venta)
{
	//alert(id_producto_venta);
	var id_producto_venta=id_producto_venta;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_producto_venta.php"+'?idproductoventa='+id_producto_venta;			
}

function eliminar_producto_venta(id_producto_venta)
{
		document.frm_nueva_venta.txtid_producto_buscar.value=id_producto_venta;
		var id_producto_venta_eliminar=document.frm_nueva_venta.txtid_producto_buscar.value
		
		if(id_producto_venta_eliminar == "" || id_producto_venta_eliminar ==0 || id_producto_venta_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_venta").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_venta.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function modificar_datos_producto_venta()
{
		var id_producto_venta_modificar=document.frm_modificar_producto_venta.txtid_producto_venta_modificar.value
		
		if(id_producto_venta_modificar == "" || id_producto_venta_modificar ==0 || id_producto_venta_modificar==null)
		{  
		alert("No ha seleccionado el producto a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_producto_venta").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../ventas/modificar_datos_producto_venta.php',
			data: str,
			type: 'post',
			success: function(data){

				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El producto ha sido modificado");
				document.location.href ="nueva_venta.php";
			}
		});
	  }				
}

function eliminar_usuario(id_usuario_eliminar)
{
		document.frm_lista_usuarios.txtid_usuario_buscar.value=id_usuario_eliminar;
		var id_usuario_eliminar=document.frm_lista_usuarios.txtid_usuario_buscar.value;
		
		if(id_usuario_eliminar == "" || id_usuario_eliminar ==0 || id_usuario_eliminar==null)
		{  
		alert("No ha seleccionado el usuario a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_lista_usuarios").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_usuario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }			
}

function editar_usuario(id_usuario_modificar)
{
	var id_usuario_modificar=id_usuario_modificar;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_usuario.php"+'?idusuariomodificar='+id_usuario_modificar;		
}

function guardar_venta()
{
		var total_venta=document.frm_nueva_venta.txttotal_venta.value;
		var pago_venta=document.frm_nueva_venta.txtpago_venta.value;
		var cambio_venta=document.frm_nueva_venta.txtcambio_venta.value;
		var totalpagar=document.frm_nueva_venta.txttotalpagar.value;		
		//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
		
		if(total_venta == "" || total_venta ==0 || total_venta==null)
		{  
		alert("No ha realizado ninguna venta");
		}
		else
			if(pago_venta == "" || pago_venta ==0 || pago_venta==null)
				{
					alert("No ha realizado el cobro de la venta");
				}
		else
			if(cambio_venta == "" || cambio_venta ==0 || cambio_venta==null)
				{
					alert("No ha indicado el cambio de la venta");
				}	
		else
			if(totalpagar == "" || totalpagar ==0 || totalpagar==null)
				{
					alert("No ha indicado el total a pagar");
				}
		/*else
			if(tipopago == "" || tipopago ==0 || tipopago==null)
				{
					alert("No ha indicado la forma a pagar");
				}*/								
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_venta").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_venta.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				
				
				if(data0=="Y")
				{	
             	alert("La venta ha sido guardada");
				document.location.href = "ventas.php";	
				window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
				}
				else
				{	
				alert("La venta ha sido guardada");
             	//alert("La marca ha sido eliminada");
				document.location.href = "ventas.php";	
				}				
			}
		});
	  }				
}

function calcular_cambio_venta(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{	
		var totalpagar=document.frm_nueva_venta.txttotalpagar.value;
		var txtpago_venta=document.frm_nueva_venta.txtpago_venta.value;
		
		if(totalpagar==0)
			{
				alert("No ha realizado ninguna venta");
			}	
		else
			{
				var cambio_venta=txtpago_venta-totalpagar;
				//alert(cambio_venta);
				document.frm_nueva_venta.cambio_venta2.value=cambio_venta.toFixed(2);
				document.frm_nueva_venta.txtcambio_venta.value=cambio_venta.toFixed(2);
				//document.frm_nuevo_usuario.btnguardar_venta.focus();	
			}
	}
}

function corte_caja()
{	
window.open('../reportes/tcpdf/examples/rptcorte_caja.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value + "&usuario_imprimir=" + document.getElementById('txtnombre_usuario').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_ventas()
{	
window.open('../reportes/tcpdf/examples/rptventas.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_productos_faltantes()
{
window.open('reportes/tcpdf/examples/rptproductos_faltantes.php', 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 				
}

function mostrar_lista_inventario_actualizar(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowactualizar_inventario.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);		
}

/*function actualizar_producto_inventaro(id_producto_actualizar)
{
	var id_producto_actualizar=id_producto_actualizar;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="actualizar_producto_inventario.php"+'?idproductoinventarioactualizar='+id_producto_actualizar;			
}*/

function actualizar_datos_producto_inventario()
{
		var id_producto_inventario_actualizar=document.frm_modificar_existencia_producto.txtid_producto_inventario_actualizar.value
		
		if(id_producto_inventario_actualizar == "" || id_producto_inventario_actualizar ==0 || id_producto_inventario_actualizar==null)
		{  
		alert("No ha seleccionado el producto a actualizar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_existencia_producto").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../mantenimiento/actualizar_datos_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La cantidad en existencia del producto ha sido modificado");
				document.location.href ="actualizar_inventario.php";
			}
		});
	  }				
}

function posicionar_cursor()
{
document.frm_nueva_venta.txtcodigo_barras.focus();		
}

function cargar_nuevo_producto()
{
document.location.href ="../nuevo_producto.php";
}

function cargar_nueva_marca()
{
document.location.href ="nueva_marca.php";
}

function cargar_nuevo_proveedor()
{
document.location.href ="nuevo_proveedor.php";
}

function cargar_nuevo_usuario()
{
document.location.href ="nuevo_usuario.php";
}

function mostrar_lista_clientes(nropagina)
{
		//alert(nropagina);
		//alert(nropagina);
       //alert('funcion mostrar_lista_cotizaciones');
	   //alert('palabra a buscar: '+document.getElementById('txtstrBuscar').value);
	   //var nropagina=document.getElementById('txtnum_pag').value;
	   var numero_pagina=nropagina;
	   var contenido;
		banderasis=false;
		banderacred=false;
        //contenido = document.getElementById('contenido');
		contenido = document.getElementById('divcontenidodatos');
		if (typeof filepage!='undefined') 
				document.getElementById('txtfilepageserver').value=filepage;
			else
				document.getElementById('txtfilepageserver').value="";
        ajax=NuevoAjax();
//        ajaxdata.open("GET", "php/combo_valor.server.php?forma=frm_expedientes&ramo=" + document.getElementById('cmbramo').value + "&distrito=" + document.getElementById('txtid_distrito').value,true); 
        ajax.open("GET", "../php/pageshowclientes.server.php?cadena_buscar=" + document.getElementById('txtstrBuscar').value + "&registros_mostrar=" + document.getElementById('cmbregistros').value + "&pag=" + numero_pagina,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
 						contenido.style.textAlign="center"; 
                        contenido.innerHTML = "<img src='img/loading.gif'><p><b>Cargando...</p>";
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
								contenido.style.background="";
	                            contenido.innerHTML = ajax.responseText;
								//refresh_datacontenido(url); 
                        }else if(ajax.status==404){
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La página no existe";
                        }else{
                                contenido.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error:"+ajax.status; 
                        }
                }
        }
        ajax.send(null);
}

function cargar_nuevo_cliente()
{
document.location.href ="nuevo_cliente.php";
}

function alta_cliente()
{
			//alert("entro");
			var str = $("#frm_nuevo_cliente").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_cliente.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				if(data=="E")
				{	
              	alert("Error en el sistema, no se guardo el cliente");
				document.location.href = "clientes.php";				
				}
				else(data=="Y")
				{	
              	alert("El cliente se guardo correctamente");
				document.location.href = "clientes.php";
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
}

function modificar_datos_cliente()
{
		var id_cliente_modificar=document.frm_modificar_cliente.txtid_cliente_modificar.value
		
		if(id_cliente_modificar == "" || id_cliente_modificar ==0 || id_cliente_modificar==null)
		{  
		alert("No ha seleccionado el cliente a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_cliente").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_cliente.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El cliente ha sido modificado");
				document.location.href ="clientes.php";
				//document.location.href ="nuevo_cliente.php";
			}
		});
	  }		
}

function modificar_cliente(id_cliente)
{
	var id_cliente=id_cliente;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_cliente.php"+'?idcliente='+id_cliente;	
}

function eliminar_cliente(id_cliente)
{
		document.frm_lista_clientes.txtid_cliente_eliminar.value=id_cliente;
		var id_cliente_eliminar=document.frm_lista_clientes.txtid_cliente_eliminar.value;
		
		if(id_cliente_eliminar == "" || id_cliente_eliminar ==0 || id_cliente_eliminar==null)
		{  
		alert("No ha seleccionado el cliente a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_lista_clientes").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_cliente.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El cliente ha sido eliminado");
				document.location.href = document.location.href;	
				}
				else
				{	
             	alert("El cliente ha sido eliminado");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function calcular_total_pagar(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{	
		var total_venta=document.frm_nueva_venta.total_venta.value;
		var descuento=document.frm_nueva_venta.descuento.value;
		var comision=document.frm_nueva_venta.txtcomision.value;
		
		if(total_venta==0)
			{
				alert("No ha realizado ninguna venta");
			}	
		else
			{
				var totalpagar=(parseFloat(total_venta)+parseFloat(comision))-descuento;
				document.frm_nueva_venta.txttotalpagar.value=totalpagar;
				document.frm_nueva_venta.totalpagar.value=totalpagar;
				document.frm_nueva_venta.txtpago_venta.focus();	
			}
	}	
}

function buscar_producto_vender()
{
	document.location.href ="buscar_productos_vender.php";				
}

function guardar_producto_venta_buscado(e,cantidad,id_producto) 
{
	//alert(cantidad);
	//alert(id_producto);
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert(cantidad);	
		//var descripcion_producto=document.frm_nueva_venta.txtdescripcion_producto.value;	
		document.frm_nueva_venta.txtid_producto.value=id_producto;
		document.frm_nueva_venta.txtcantidad_producto.value=cantidad;

	
			//alert("entro");
			//var str = $("#frm_lista_productos_buscar").serialize();
			var str = $("#frm_nueva_venta").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_producto_venta_buscar.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);				
				if(data=="E")
				{	
				alert("Error al guardar el producto");
				}
				else(data=="Y")
				{	
				//alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				document.location.href = "nueva_venta.php";	
				//document.frm_nueva_venta.txtdescripcion_producto.focus();
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	}	
}

function cargar_listado_ventas()
{
	document.location.href ="listado_ventas.php";					
}

function cargar_nueva_venta()
{
	document.location.href ="nueva_venta.php";						
}

function vale_devolucion_venta(id_venta)
{
	document.location.href ="vales_devolucion.php"+'?idventa='+id_venta;		
}

function cargar_listado_devoluciones()
{
	document.location.href ="listado_devoluciones.php";						
}

function calcular_comision_banco(tipo_pago)
{
	if(tipo_pago==2)
	{
		var total_venta=document.frm_nueva_venta.txttotal_venta.value;
		var comision_banco=total_venta*0.08;
		document.frm_nueva_venta.txtcomision.value=comision_banco;
	}
	else
	{
		document.frm_nueva_venta.txtcomision.value=0;
	}
}

function cargar_recuperar_clave()
{
	document.location.href ="recuperar_clave.php";	
}

function cargar_registro()
{
	//location.href = location.href + '?var1=32&var2=10';
	//document.location.href ="registro.php"+'?nombrecompleto='+nombre_completo + "&correousuario=" + correo_usuario + "&claveusuario=" + clave_usuario;
	document.location.href ="registro.php";
}

function registro_completo()
	{
		var txtnombre_completo=document.frm_registro.txtnombre_completo.value;	
		var txtcorreo=document.frm_registro.txtcorreo.value;	
		var txtclave=document.frm_registro.txtclave.value;	
		var txtusuario=document.frm_registro.txtusuario.value;	
		var txtnombre_empresa=document.frm_registro.txtnombre_empresa.value;	
		var txtdireccion_empresa=document.frm_registro.txtdireccion_empresa.value;			

		if(txtnombre_completo == "" || txtnombre_completo ==0 || txtnombre_completo==null)
		{  
		alert("No ha escrito su nombre completo");
		}
	  else
	 	if(txtcorreo == "" || txtcorreo ==0 || txtcorreo==null)
		{  
		alert("No ha escrito su correo electronico");
		}
	else
		if(txtclave == "" || txtclave ==0 || txtclave==null)
		{  
		alert("No ha escrito su clave");
		}
	 else
	 	if(txtusuario == "" || txtusuario ==0 || txtusuario==null)
		{  
		alert("No ha escrito su nombre de usuario");
		}
	else
		if(txtnombre_empresa == "" || txtnombre_empresa ==0 || txtnombre_empresa==null)
		{  
		alert("No ha escrito el Nombre de su Empresa");
		}
	  else
	 	if(txtdireccion_empresa == "" || txtdireccion_empresa ==0 || txtdireccion_empresa==null)
		{  
		alert("No ha escrito la direccion de su empresa");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_registro").serialize();
			//alert(str);
			$.ajax({
			 
			url: 'datos_registro.php',
			data: str,
			type: 'get',
			success: function(data){

				//alert(data);
				
				if(data==1)
				{	
				window.location.href="realizacion_pago.php";
				}
				else
				{
				alert("Error al guardar los datos en el sistema");
				}
			
			}
		});
	  }
     }
	 
function imprimir_venta(id_venta)
{	
  var idventa=id_venta;
window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + idventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}
	 
function generar_xml(id_venta)
{
	//alert("entro a generar xml");
	/*document.frm_listado_ventas.txtidventa.value=id_venta;		
	alert(document.frm_listado_ventas.txtidventa.value);
		var str = $("#frm_listado_ventas").serialize();
		alert(str);
		$.ajax({
		 
		url: 'generar_xml.php',
		data: str,
		type: 'get',
		success: function(data){
	
			alert(data);
			
			if(data==1)
			{	
			//window.location.href="realizacion_pago.php";
			alert("se creo el xml correctamente");
			}
			else
			{
			alert("Error al guardar los datos en el sistema");
			}
		
		}
	});*/
		//document.location.href ="generar_xml.php"+'?txtidventa='+id_venta;
		window.open('generar_xml.php?txtidventa=' + id_venta, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			

}

function buscar_producto_comprar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert(cantidad);	
		var txtdescripcion_producto=document.frm_nueva_compra.txtdescripcion_producto.value;	
	
		if(txtdescripcion_producto == "" || txtdescripcion_producto ==0 || txtdescripcion_producto==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			//alert("entro");
			var str = $("#frm_nueva_compra").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/buscar_producto_comprar.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];

				if(data0=="E")
				{	
              	alert("No se encuentra el producto");
				}
				else(data0=="Y")
				{	
             	document.frm_nueva_compra.txtid_producto.value=data1;
             	document.frm_nueva_compra.txtcodigo.value=data2;
				}
				
			}
		});
	  }
	}
}

function agregar_producto_compra()
{
		var txtid_producto=document.frm_nueva_compra.txtid_producto.value
		var txtcantidad_comprar=document.frm_nueva_compra.txtcantidad_comprar.value
		var txtprecio_compra=document.frm_nueva_compra.txtprecio_compra.value		
		
		if(txtid_producto == "" || txtid_producto ==0 || txtid_producto==null)
		{  
		alert("No ha seleccionado el producto a comprar");
		}
		else if(txtcantidad_comprar == "" || txtcantidad_comprar ==0 || txtcantidad_comprar==null)
		{  
		alert("No ha indicado la cantidad a comprar");
		}
		else if(txtprecio_compra == "" || txtprecio_compra ==0 || txtprecio_compra==null)
		{  
		alert("No ha indicado el precio de compra");
		}		
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_compra").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_producto_compra.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function guardar_compra()
{
		var txttotal_compra=document.frm_nueva_compra.txttotal_compra.value;
		var txtnombre_proveedor=document.frm_nueva_compra.txtnombre_proveedor.value;
		//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
		
		if(txttotal_compra == "" || txttotal_compra ==0 || txttotal_compra==null)
		{  
		alert("No ha realizado ninguna compra");
		}
		else
			if(txtnombre_proveedor == "" || txtnombre_proveedor ==0 || txtnombre_proveedor==null)
				{
					alert("No ha captura el nombre del proveedor");
				}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_compra").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_compra.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				
				if(data0=="Y")
				{	
             	alert("La compra ha sido guardada");
				document.location.href = "compras.php";	
				window.open('../reportes/tcpdf/examples/imprimir_compra.php?id_compra=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
				}
				else
				{	
				alert("La compra ha sido guardada");
             	//alert("La marca ha sido eliminada");
				document.location.href = "compras.php";	
				}				
			}
		});
	  }				
}

function modificar_producto_comprado(id_producto)
{
	var id_producto=id_producto;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_producto_comprado.php"+'?idproducto='+id_producto;		
}

function eliminar_producto_comprado(id_producto)
{
		document.frm_nueva_compra.txtid_producto_buscar.value=id_producto;
		var id_producto_compra_eliminar=document.frm_nueva_compra.txtid_producto_buscar.value
		
		if(id_producto_compra_eliminar == "" || id_producto_compra_eliminar ==0 || id_producto_compra_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_compra").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_compra.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function modificar_datos_producto_comprado()
{
		var id_producto_inventario_modificar=document.frm_modificar_producto_inventario.txtid_producto_inventario_modificar.value
		
		if(id_producto_inventario_modificar == "" || id_producto_inventario_modificar ==0 || id_producto_inventario_modificar==null)
		{  
		alert("No ha seleccionado el producto a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_producto_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: 'modificar_datos_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El producto ha sido modificado");
				//document.location.href ="mantenimiento/productos.php";
			}
		});
	  }			
}

function imprimir_compra(id_compra)
{
  var idcompra=id_compra;
window.open('../reportes/tcpdf/examples/imprimir_compra.php?id_compra=' + idcompra, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function cargar_datos_devolucion(id_venta)
{
	var id_venta=id_venta;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="realizar_nueva_devolucion.php"+'?id_venta='+id_venta;		
}

function eliminar_producto_venta_devolucion(id_producto_venta)
{
		document.frm_datos_devolucion.txtid_producto_buscar.value=id_producto_venta;
		var id_producto_venta_eliminar=document.frm_datos_devolucion.txtid_producto_buscar.value
		
		if(id_producto_venta_eliminar == "" || id_producto_venta_eliminar ==0 || id_producto_venta_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_datos_devolucion").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_venta_devolucion.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}				
			}
		});
	  }		
}

function guardar_producto_venta_buscado_devolucion(e,cantidad,id_producto) 
{
	//alert(cantidad);
	//alert(id_producto);
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert(cantidad);	
		//var descripcion_producto=document.frm_nueva_venta.txtdescripcion_producto.value;	
		document.frm_datos_devolucion.txtid_producto.value=id_producto;
		document.frm_datos_devolucion.txtcantidad_producto.value=cantidad;

	
			//alert("entro");
			//var str = $("#frm_lista_productos_buscar").serialize();
			var str = $("#frm_datos_devolucion").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_producto_venta_buscar_devolucion.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);	
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];

				if(data0=="E")
				{	
				alert("Error al guardar el producto");
				}
				else(data0=="Y")
				{	
				//alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				//document.location.href = "realizar_nueva_devolucion.php";	
				document.location.href ="realizar_nueva_devolucion.php"+'?id_venta='+data1;		
				//document.frm_nueva_venta.txtdescripcion_producto.focus();
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	}	
}

function eliminar_producto_venta_datos_devolucion(id_producto_venta)
{
		document.frm_datos_devolucion.txtid_producto_buscar.value=id_producto_venta;
		var id_producto_venta_eliminar=document.frm_datos_devolucion.txtid_producto_buscar.value
		
		if(id_producto_venta_eliminar == "" || id_producto_venta_eliminar ==0 || id_producto_venta_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_datos_devolucion").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_venta_datos_devolucion.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//alert(data);	
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				
				if(data0=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				document.location.href = document.location.href;	
				document.location.href ="realizar_nueva_devolucion.php"+'?id_venta='+data1;		
				}				
			}
		});
	  }		
}

function calcular_cambio_venta_devolucion(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{	
		var importe_devolver=document.frm_datos_devolucion.txtimporte_devolver.value;
		var diferencia=document.frm_datos_devolucion.txtdiferencia.value;
		var txtpago_venta=document.frm_datos_devolucion.txtpago_venta.value;
		
		if(importe_devolver==0)
			{
				alert("No ha realizado ninguna venta");
			}	
		else
			{
				var cambio_venta=txtpago_venta-diferencia;
				//alert(cambio_venta);
				document.frm_datos_devolucion.cambio_venta2.value=cambio_venta.toFixed(2);
				document.frm_datos_devolucion.txtcambio_venta.value=cambio_venta.toFixed(2);
				//document.frm_nuevo_usuario.btnguardar_venta.focus();	
			}
	}
}

function guardar_devolucion()
{
		var pago_venta=document.frm_datos_devolucion.txtpago_venta.value;
		var cambio_venta=document.frm_datos_devolucion.txtcambio_venta.value;
		var diferencia=document.frm_datos_devolucion.txtdiferencia.value;		
		//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
		
		if(pago_venta == "" || pago_venta==null)
				{
					alert("No ha realizado el cobro de la venta");
				}
		else
			if(cambio_venta == "" || cambio_venta==null)
				{
					alert("No ha indicado el cambio de la venta");
				}	
		else
			if(diferencia == "" || diferencia==null)
				{
					alert("No ha indicado el total a pagar");
				}
		/*else
			if(tipopago == "" || tipopago ==0 || tipopago==null)
				{
					alert("No ha indicado la forma a pagar");
				}*/								
	  else
		    {
			//alert("entro");
			var str = $("#frm_datos_devolucion").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_devolucion.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				
				
				if(data0=="Y")
				{	
				//alert("entro a if");
             	alert("La devolucion ha sido guardada");
				document.location.href = "devoluciones.php";	
				window.open('../reportes/tcpdf/examples/imprimir_devolucion.php?id_devolucion=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 				
				
				}
				else
				{	
				//alert("entro a else");				
				alert("La devolucion ha sido guardada");
             	//alert("La marca ha sido eliminada");
				document.location.href = "devoluciones.php";	
				}				
			}
		});
	  }				
}

function alta_caja()
{
		var txtdescripcion_caja=document.frm_nueva_caja.txtdescripcion_caja.value;	
		var txtefectivo_caja=document.frm_nueva_caja.txtefectivo_caja.value;	

		if(txtdescripcion_caja == "" || txtdescripcion_caja ==0 || txtdescripcion_caja==null)
		{  
		alert("No ha escrito la descripcion de la caja");
		}
		else if(txtefectivo_caja == "" || txtefectivo_caja ==0 || txtefectivo_caja==null)
		{  
		alert("No ha captura el efectivo con que aperturara la caja");
		}

	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_caja").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_caja.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La caja ya existe escriba otra");
				document.location.href = "cajas.php";	
				}
				else
				{
				alert("CAJA guardada satisfactoriamente");	
				document.location.href = "cajas.php";	
				}
				
			}
		});
	  }	
}

function modificar_caja(id_caja)
{
	var id_caja=id_caja;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_caja.php"+'?idcaja='+id_caja;	
}

function modificar_datos_caja()
{
		var id_caja_modificar=document.frm_modificar_caja.txtid_caja.value;
		var txtdescripcion_caja=document.frm_modificar_caja.txtdescripcion_caja.value;
		var txtefectivo_caja=document.frm_modificar_caja.txtefectivo_caja.value;
		
		if(id_caja_modificar == "" || id_caja_modificar ==0 || id_caja_modificar==null)
		{  
		alert("No ha seleccionado la caja a modificar");
		}
		else if(txtdescripcion_caja == "" || txtdescripcion_caja ==0 || txtdescripcion_caja==null)
		{  
		alert("No ha indicado la descripcion de la caja");
		}
		else if(txtefectivo_caja == "" || txtefectivo_caja ==0 || txtefectivo_caja==null)
		{  
		alert("No ha indicado el efectivo de la caja");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_caja").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_caja.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La caja ha sido modificada");
				document.location.href ="cajas.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function corte_caja_diario()
{	
window.open('../reportes/tcpdf/examples/rptcorte_caja_diario.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value + "&usuario_imprimir=" + document.getElementById('txtnombre_usuario').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function imprimir_devolucion(id_devolucion)
{
  var id_devolucion=id_devolucion;
window.open('../reportes/tcpdf/examples/imprimir_devolucion.php?id_devolucion=' + id_devolucion, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 				
}

function actualizar_producto_inventario(e,cantidad,id_producto)
{
	//alert(cantidad);
	//alert(id_producto);
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		//alert ('Has pulsado enter');
		//alert(cantidad);	
		//var descripcion_producto=document.frm_nueva_venta.txtdescripcion_producto.value;	
		document.frm_nuevo_actualizacion_inventario.txtid_producto.value=id_producto;
		document.frm_nuevo_actualizacion_inventario.txtcantidad_producto.value=cantidad;

	
			//alert("entro");
			//var str = $("#frm_lista_productos_buscar").serialize();
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_producto_inventario.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);	
				//var datatotal=data.split(",");
				//var data0=datatotal[0];
				//var data1=datatotal[1];

				if(data=="E")
				{	
				alert("Error al guardar el producto");
				}
				else(data=="Y")
				{	
				//alert("USUARIO guardado correctamente");
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				//location.reload();
				//document.location.href = "realizar_nueva_devolucion.php";
				alert("Producto actualizado");
				document.location.href = document.location.href;	
				//document.frm_nueva_venta.txtdescripcion_producto.focus();
				//document.location.href ="eliminar_usuario.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
	}		
}

function guardar_inventario()
{
		var txtnumero_productos_inventaridado=document.frm_nuevo_actualizacion_inventario.txtnumero_productos_inventaridado.value;
		//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
		
		if(txtnumero_productos_inventaridado == "" || txtnumero_productos_inventaridado ==0 || txtnumero_productos_inventaridado==null)
		{  
		alert("No ha actualizado ningun producto para su inventario");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_datos_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				
				
				if(data0=="Y")
				{	
             	alert("El inventario ha sido guardado");
				document.location.href = "inventarios.php";	
				window.open('../reportes/tcpdf/examples/imprimir_inventario.php?id_inventario=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
				}
				else
				{	
				alert("Error al guardar");
             	//alert("La marca ha sido eliminada");
				document.location.href = "inventarios.php";	
				}				
			}
		});
	  }				
}

function imprimir_inventario(id_inventario)
{
  var id_inventario=id_inventario;
window.open('../reportes/tcpdf/examples/imprimir_inventario.php?id_inventario=' + id_inventario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function imprimir_inventario_panel(id_inventario)
{
  var id_inventario=id_inventario;
window.open('reportes/tcpdf/examples/imprimir_inventario.php?id_inventario=' + id_inventario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}