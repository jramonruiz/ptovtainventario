function tecla(e)
{
    var evt = e ? e : event;
    var key = window.Event ? evt.which : evt.keyCode;
    //alert (key);
    if(key==118) //F7 CANTIDAD
      {
        mostrarmodal_modificar();
      }
    else if(key==121) // F10 ELIMINAR
    {
      mostrarmodal_eliminar();
    }
    else if(key==113) // F2 COBRAR
    {
      mostrarmodal_cobrar();
    }
    else if(key==123) // F12 RETIRAR
    {
      mostrarmodal_retirar();
    }
    else if(key==114) // F3 PRECIO
    {
      mostrarmodal_precio();
    }
    else if(key==119) // F8 DESCUENTO
    {
      mostrarmodal_descuento();
    }
    else if(key==115) // F4 OPERACION
    {
      mostrarmodal_operacion();
    }
}
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

				//alert(data);

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
			var datatotal=data.split(",");
			var data0=datatotal[0];
			var data1=datatotal[1];
									
				
			if(data0==0)
			{	
			alert("EL PRODUCTO NO EXISTE");
			}
			else
			{	
			//document.location.href ="nueva_venta.php";
			document.location.href='nueva_venta.php?id_area_venta='+data1;
			}
			//document.frm_nuevo_usuario.txtcadena.value=data;
		}
	});
  }
}

/*function buscar_producto_venta_cb2(cadbus)
{
  //alert(cadbus);
  if(isNaN(cadbus))
  	{
  		//alert("DESCRIPCION DEL PRODUCTO");
  		var descripcion_producto_mod=document.frm_nueva_venta.txtproductodesc.value;	
	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_nueva_venta").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frm_nueva_venta.txtid_productomod.value=data1;
				document.frm_nueva_venta.txtdescripcion_productomod.value=data3;
				document.frm_nueva_venta.txtexistencia_productomod.value=data5;
				document.frm_nueva_venta.txtprecio_venta_mod.value=data4;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				}
			}
		});
	  }
  	}
  else
  	{
  		//alert("CODIGO DE BARRAS AQUI SERIA LA VENTA RAPIDA");
  			var cb_producto=document.frm_nueva_venta.txtproductodesc.value;	

				if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
				{  
				alert("No ha seleccionado ningun producto");
				document.frm_nueva_venta.txtproductodesc.focus();		
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
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
												
							
						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.location.href='nueva_venta.php?id_area_venta='+data1;
						}
						//document.frm_nuevo_usuario.txtcadena.value=data;
					}
				});
			  }
  	}
}*/

function buscar_producto_venta_cb2(cadbus)
{
  //alert(cadbus);
  var ventadirecta=document.frm_nueva_venta.txtventa_directa.value;
  if(isNaN(cadbus))
  	{
  		var descripcion_producto_mod=document.frm_nueva_venta.txtproductodesc.value;	
  			
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_nueva_venta").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				var data6=datatotal[6];			
				var data7=datatotal[7];	
				
				if(data0==0)
				{	
				alert("No se encuentra el producto buscado");
				}
				else
				{	
				document.frm_nueva_venta.txtid_productomod.value=data1;
				document.frm_nueva_venta.txtdescripcion_productomod.value=data3;
				document.frm_nueva_venta.txtexistencia_productomod.value=data5;
				document.frm_nueva_venta.txtprecio_venta_mod.value=data4;
				document.frm_nueva_venta.txtdescto_salon.value=data6;
				document.frm_nueva_venta.txtdescto_mayorista.value=data7;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				document.frm_nueva_venta.txtcantidad_productomod.select();
				}
			}
		});
	  }
  	}
  else
  	{
  		if(ventadirecta==0)
  			{
		  			//alert("CODIGO DE BARRAS AQUI SERIA LA VENTA RAPIDA");
		  			var cb_producto=document.frm_nueva_venta.txtproductodesc.value;	

						if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
						{  
						alert("No ha seleccionado ningun producto");
						document.frm_nueva_venta.txtproductodesc.focus();		
						}
					  else
						{
						var str = $("#frm_nueva_venta").serialize();
						$.ajax({
						 
						url: '../php/buscar_producto_venta_cb.php',
						data: str,
						type: 'post',
						success: function(data){
				
							//alert(data);
							//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
							var datatotal=data.split(",");
							var data0=datatotal[0];
							var data1=datatotal[1];
							var data2=datatotal[2];
							var data3=datatotal[3];	
							var data4=datatotal[4];			
							var data5=datatotal[5];	
							var data6=datatotal[6];			
							var data7=datatotal[7];	
							
							if(data0==0)
							{	
							alert("No se encuentra el producto buscado");
							}
							else
							{	
							document.frm_nueva_venta.txtid_productomod.value=data1;
							document.frm_nueva_venta.txtdescripcion_productomod.value=data3;
							document.frm_nueva_venta.txtexistencia_productomod.value=data5;
							document.frm_nueva_venta.txtprecio_venta_mod.value=data4;
							document.frm_nueva_venta.txtdescto_salon.value=data6;
							document.frm_nueva_venta.txtdescto_mayorista.value=data7;
							//alert("focus");
							//document.getElementById("txtdescuento_productomod").focus();
							$('#exampleModalLong').modal();
							//$("#txtdescuento_productomod").focus();
							$('#exampleModalLong').on('shown.bs.modal', function () {
								   $("#txtcantidad_productomod").focus();
								});
							document.frm_nueva_venta.txtcantidad_productomod.select();
							}
						}
					});
				  }
			}
		else
			{
			  			//alert("CODIGO DE BARRAS AQUI SERIA LA VENTA RAPIDA");
			  			var cb_producto=document.frm_nueva_venta.txtproductodesc.value;	

						if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
						{  
						alert("No ha seleccionado ningun producto");
						document.frm_nueva_venta.txtproductodesc.focus();		
						}
					  else
						{
						var str = $("#frm_nueva_venta").serialize();
						$.ajax({
						 
						url: '../php/buscar_producto_venta_cb_ventadirecta.php',
						data: str,
						type: 'post',
						success: function(data){
				
							//alert(data);
							//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
							var datatotal=data.split(",");
							var data0=datatotal[0];
							var data1=datatotal[1];
							
							if(data0==0)
							{	
								alert("No se encuentra el producto buscado");
							}
							else(data0==1)
							{	
								document.location.href='nueva_venta.php?id_area_venta='+data1;	
							}
						}
					});
				  }				
			}
  	}
}

/*function buscar_producto_venta_cb2_modventa(cadbus)
{
  var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
  var txtid_venta=document.frmmodificar_venta.txtid_venta.value;
  //alert(cadbus);
  if(isNaN(cadbus))
  	{
  		//alert("DESCRIPCION DEL PRODUCTO");
  		var descripcion_producto_mod=document.frmmodificar_venta.txtproductodesc.value;	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{

			var str = $("#frmmodificar_venta").serialize();

			alert(str);

			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				var data6=datatotal[6];			
				var data7=datatotal[7];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frmmodificar_venta.txtid_productomod.value=data1;
				document.frmmodificar_venta.txtdescripcion_productomod.value=data3;
				document.frmmodificar_venta.txtexistencia_productomod.value=data5;
				document.frmmodificar_venta.txtprecio_venta_mod.value=data4;
				document.frmmodificar_venta.txtdescto_salon.value=data6;
				document.frmmodificar_venta.txtdescto_mayorista.value=data7;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				document.frmmodificar_venta.txtcantidad_productomod.select();
				}
			}
		});
	  }
  	}
  else
  	{
  		//alert("CODIGO DE BARRAS");
  			var cb_producto=document.frmmodificar_venta.txtproductodesc.value;	

				if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
				{  
				alert("No ha seleccionado ningun producto");
				document.frmmodificar_venta.txtproductodesc.focus();		
				}
			  else
					{
					//alert("entro");
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/buscar_producto_venta_cb2_modventa.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
												
							
						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						//document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+"&id_venta="+txtid_venta; 
						document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+"&id_venta="+0; 
						}
						//document.frm_nuevo_usuario.txtcadena.value=data;
					}
				});
			  }
  	}
}*/

function buscar_producto_venta_cb2_modventa(cadbus)
{
  var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
  var txtid_venta=document.frmmodificar_venta.txtid_venta.value;
  //alert(cadbus);
  if(isNaN(cadbus))
  	{
  		//alert("DESCRIPCION DEL PRODUCTO");
  		var descripcion_producto_mod=document.frmmodificar_venta.txtproductodesc.value;	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{

			var str = $("#frmmodificar_venta").serialize();

			//alert(str);

			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				var data6=datatotal[6];			
				var data7=datatotal[7];	
				
				if(data0==0)
				{	
				alert("No se encuentra el producto buscado");
				}
				else
				{	
				document.frmmodificar_venta.txtid_productomod.value=data1;
				document.frmmodificar_venta.txtdescripcion_productomod.value=data3;
				document.frmmodificar_venta.txtexistencia_productomod.value=data5;
				document.frmmodificar_venta.txtprecio_venta_mod.value=data4;
				document.frmmodificar_venta.txtdescto_salon.value=data6;
				document.frmmodificar_venta.txtdescto_mayorista.value=data7;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				document.frmmodificar_venta.txtcantidad_productomod.select();
				}
			}
		});
	  }
  	}
  else
  	{
  		//alert("CODIGO DE BARRAS");
  			var cb_producto=document.frmmodificar_venta.txtproductodesc.value;	

				if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
				{  
				alert("No ha seleccionado ningun producto");
				document.frmmodificar_venta.txtproductodesc.focus();		
				}
			  else
				{

					var str = $("#frmmodificar_venta").serialize();

								//alert(str);

								$.ajax({
								 
								url: '../php/buscar_producto_venta_mod_codigobarras.php',
								data: str,
								type: 'post',
								success: function(data){
						
									//alert(data);
									//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
									var datatotal=data.split(",");
									var data0=datatotal[0];
									var data1=datatotal[1];
									var data2=datatotal[2];
									var data3=datatotal[3];	
									var data4=datatotal[4];			
									var data5=datatotal[5];	
									var data6=datatotal[6];			
									var data7=datatotal[7];	
									
									if(data0==0)
									{	
									alert("No se encuentra el producto buscado");
									}
									else
									{	
									document.frmmodificar_venta.txtid_productomod.value=data1;
									document.frmmodificar_venta.txtdescripcion_productomod.value=data3;
									document.frmmodificar_venta.txtexistencia_productomod.value=data5;
									document.frmmodificar_venta.txtprecio_venta_mod.value=data4;
									document.frmmodificar_venta.txtdescto_salon.value=data6;
									document.frmmodificar_venta.txtdescto_mayorista.value=data7;
									//alert("focus");
									//document.getElementById("txtdescuento_productomod").focus();
									$('#exampleModalLong').modal();
									//$("#txtdescuento_productomod").focus();
									$('#exampleModalLong').on('shown.bs.modal', function () {
										   $("#txtcantidad_productomod").focus();
										});
									document.frmmodificar_venta.txtcantidad_productomod.select();
									}
								}
							});					
					
				}
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
		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value
		
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
				//document.location.href = document.location.href;	
				document.location.href ="nueva_venta.php?id_area_venta="+txtid_areaventa;
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href ="nueva_venta.php?id_area_venta="+txtid_areaventa;
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
				setTimeout(function () { window.print(); }, 500);
        		window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }		
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
		
			//alert("entro");
			var str = $("#frm_listado_ventas").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/buscar_areaventa_enuso.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);

				var datatotal=data.split(",");
				var data0=datatotal[0];//id_area_venta_usar
				var data1=datatotal[1];//id_area_venta_uso
				
				if(data0=="Y")
				{	
             	//alert("La caja ya existe escriba otra");
				document.location.href = "nueva_venta.php?id_area_venta="+data1;	
				}
				else
				{
				//alert("CAJA guardada satisfactoriamente");	
				document.location.href = "nueva_venta.php?id_area_venta="+data1;	
				}
				
			}
		});
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
/**************************************
  Editado por ipatas 17/10/18
**************************************/
	 
function imprimir_venta(id_venta,folioidventa,idultimaventa){	
  var idventa=id_venta;
  var folioidventa=folioidventa;
  var idultimaventa=idultimaventa;
 var ventana1;
 var ventana3;
 ventana1 = window.open('../reportes/tcpdf/examples/imprimir_venta.php?idultimaventa=' + idultimaventa + '&folioidventa=' + folioidventa + '&idventa=' + idventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  
setTimeout(function(){ ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa + '&folioidventa=' + folioidventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  },5000);
setTimeout(function(){ ventana1.close(); ventana3.close(); },9000);
//ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 
//setTimeout(function(){ ventana3.close(); },5000);
 /* window.print();
  console.log("Imprimir...");
  window.close();

  window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
						document.location.href = "ventas.php";*/
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
		else if(isNaN(txtefectivo_caja))
		{  
		alert("Lo que capturo en EFECTIVO NO ES UN NUMERO");
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

function cantidad_producto_buscadomod(e) {
	//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var descripcion_producto_mod=document.frm_nueva_venta.txtproductodesc.value;	
	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_nueva_venta").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frm_nueva_venta.txtid_productomod.value=data1;
				document.frm_nueva_venta.txtdescripcion_productomod.value=data3;
				document.frm_nueva_venta.txtexistencia_productomod.value=data5;
				document.frm_nueva_venta.txtprecio_venta_mod.value=data4;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				}
			}
		});
	  }
	}
}

function disparaBotton(){
	var b = document.frm_nueva_venta.buttonClick;
	b.click();
}

function guardar_producto_venta_buscado_mod(e,cantidad) {
  console.log("Funcion");	
  var cant=document.frm_nueva_venta.txtcantidad_productomod.value;
  var descu=document.frm_nueva_venta.txtdescuento_productomod.value;
  var precvta=document.frm_nueva_venta.txtprecio_venta_mod.value;
  tecla = (document.all) ? e.keyCode : e.which;
  console.log("Tecla: " + tecla);
  if (tecla==13)
  	{
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else if(isNaN(descu))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else if(isNaN(precvta))
		{  
		alert("Lo que capturo en PRECIO DE VENTA NO ES UN NUMERO");
		}
		else
			{
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_producto_venta_buscar_modal.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];				

						if(data0==null)
						{	
						alert("Error al guardar el producto");
						}
						else{	

							/* var obj = JSON.parse(data);
						     console.log(obj);
						     $('#exampleModalLong').modal('hide');
						     $('#listProd').append(
						     	+'<tr>'
                                +'<td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta('+ obj.id_producto +');" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>'
                                +'<td class="mailbox-subject" id="list_descp"><b>'+ obj.descripcion +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_cant"><b>'+ obj.cantidad +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_precio"><b>'+ obj.precio_venta +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_desc"><b>' + obj.descuento +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_neto"><b>' + obj.precio_neto +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_subt"><b>' + obj.importe +'</b></td>'
                        		+'</tr>');*/
                        	 document.location.href='nueva_venta.php?id_area_venta='+data1;
						  }
						}
				});
			}
	}	
}

function eliminar_cantidad_producto_porvender(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frm_nueva_venta.txtcantidad_productomode.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/eliminar_cantidad_producto_porvender.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("No se puede eliminar mas cantidad del producto que lo comprado");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
						}
					}
				});
			}
	}	
}

function modificar_cantidad_producto_porvender(e,cantidad)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frm_nueva_venta.txtcantidad_productomodm.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;

  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_cantidad_producto_porvender.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
						}
					}
				});
			}
	}	
}

function guardar_retiro(e,cantidad)
{
  var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
			//alert("entro");
			//var str = $("#frm_lista_productos_buscar").serialize();
			var str = $("#frm_nueva_venta").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_retiro.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];

				if(data0==0)
				{	
				alert("Error al guardar el producto");
				}
				else(data0==1)
				{	
				//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
				//location.href="http://127.0.0.1/siscoh/panel_principal.php";
				window.open('../reportes/tcpdf/examples/imprimir_comprobante_retiro.php?id_retiro=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 
				//document.location.href = "ventas.php";	
				document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
				}
			}
		});
	}	
}

function calcular_cambio_venta_modal(e,cantidad)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var totalpagar=document.frm_nueva_venta.txttotalpagar_modal.value;
		var txtpago_venta=document.frm_nueva_venta.txtimporte_recibido.value;
		var cambioventamodal=0.00;
		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
		
		if(totalpagar==0)
			{
				alert("No ha realizado ninguna venta");
			}	
		else
			{
						var cambio_venta=txtpago_venta-totalpagar;
						var str = $("#frm_nueva_venta").serialize();
						//var str = id_marca;
						//alert(str);
						$.ajax({
						url: '../php/guardar_numero_pago.php',
						data: str,
						type: 'post',
						success: function(data){
						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];
							if(data0=="Y")
							{	
								if(data1==0)
									{
										//alert(cambio_venta);
										//document.frm_nueva_venta.cambio_venta2.value=cambio_venta.toFixed(2);
										//document.frm_nueva_venta.txtcambio_ventamodal.value=cambio_venta.toFixed(2);
										//cambioventamodal=cambio_venta.toFixed(2);
										//document.frm_nuevo_usuario.btnguardar_venta.focus();	
										document.frm_nueva_venta.txtcambio_ventamodal.value=data2;
										$('#exampleModalLongcambio').modal();
										$('#exampleModalLongcambio').on('shown.bs.modal', function () {
								             $("#txtcambio_ventamodal").focus();
								          });
									}
								else
									{
										alert("Debe de cumbrir el total de la venta");
										document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
										$('#exampleModalLongcobrar').modal()
										  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
										             $("#txtmetodo_pago").focus();
										          });
									}
							}
							else
							{	
								alert("Error al guardar el pago");
							}	
						}			
					});
			}
	}	
}

function guardar_venta_modal(e)
{
 tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var total_venta=document.frm_nueva_venta.txttotal_venta.value;
				var pago_venta=document.frm_nueva_venta.txtimporte_recibido.value;
				var cambio_venta=document.frm_nueva_venta.txtcambio_ventamodal.value;
				var totalpagar=document.frm_nueva_venta.txttotalpagar_modal.value;		
				//var txtfaltanteventa=document.frm_nueva_venta.txtfaltanteventa.value;
				//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
				
				if(total_venta == "" || total_venta ==0 || total_venta==null)
				{  
				alert("No ha realizado ninguna venta");
				}
				/*else
					if(txtfaltanteventa<0)
						{
							alert("No ha realizado el cobro de la venta");
						}
				else
					if(cambio_venta == "" || cambio_venta <0 || cambio_venta==null)
						{
							alert("No ha indicado el cambio de la venta");
						}	
				else
					if(totalpagar == "" || totalpagar ==0 || totalpagar==null)
						{
							alert("No ha indicado el total a pagar");
						}*/
			  else
				    {
					//alert("entro");
					var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_venta_modal.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];//id
						var data2=datatotal[2];//tipo de operacion ticket o ajuste de salida
						var data3=datatotal[3];//ultimo registro de la tabla ventas

						var folioidventa;
							if(data2==1)
								{
									folioidventa='T'+data1;
								}
							else
								{
									folioidventa='AS'+data1;
								}
						
						if(data0=="Y")
						{	
							var idventa=data1;
	  						var folioidventa=folioidventa;
	  						var idultimaventa=data3;

		             	//alert("La venta ha sido guardada");
		             	//if (confirm("\xBFDesea imprimir el ticket de la venta?"))
						//{
					       /*window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
					       setTimeout(function () { window.print(); }, 500);
        					window.onfocus = function () { setTimeout(function () { window.close(); }, 500); } */
        					
        					//var ventana1;
							//var ventana3;
							/*ventana1 = window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1 + '&folioidventa=' + folioidventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  
							setTimeout(function(){ ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa + '&folioidventa=' + folioidventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  },5000);
							setTimeout(function(){ ventana1.close(); ventana3.close(); },9000);			*/
							
							//imprimir_venta(data1,folioidventa,data3);
							window.open('../reportes/tcpdf/examples/imprimir_venta.php?idultimaventa=' + idultimaventa + '&folioidventa=' + folioidventa + '&idventa=' + idventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  
							//window.open('../reportes/tcpdf/examples/rptcorte_caja_diario_resumen.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value + "&usuario_imprimir=" + document.getElementById('txtnombre_usuario').value + "&id_usuario=" + document.getElementById('txtid_usuario').value + "&descripcion_caja=" + document.getElementById('txtdescripcion_caja').value + "&descripcion_sucursal=" + document.getElementById('txtdescripcion_sucursal').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			

						//}	
						document.location.href = "ventas.php";	
						//window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
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
}

function calcular_total_pagar_venta(e,descuento)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var totalpagar=document.frm_nueva_venta.txttotalpagar_modal_sindesc.value;
		var txtdescuento_venta=document.frm_nueva_venta.txtdescuento_venta.value;

  		if(isNaN(txtdescuento_venta))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else
			{	
						var descpor=(totalpagar*txtdescuento_venta)/100;
						var totvtadescto=totalpagar-descpor;
						document.frm_nueva_venta.txttotalpagar_modal.value=totvtadescto.toFixed(2);
						//document.frm_nuevo_usuario.btnguardar_venta.focus();	
			}
	}
}

function modificar_descuento_producto_porvender(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtdescuento_productomoddesc=document.frm_nueva_venta.txtdescuento_productomoddesc.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;

  		if(isNaN(txtdescuento_productomoddesc))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_descuento_producto_porvender.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
						}
					}
				});
			}
	}	
}


function cambiar_precio_producto_porvender(e,cantidad) 
{
  //alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtprecio_productomodprec=document.frm_nueva_venta.txtprecio_productomodprec.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;

  		if(isNaN(txtprecio_productomodprec))
		{  
		alert("Lo que capturo en PRECIO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_precio_producto_porvender.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
						}
					}
				});
			}
	}	
}

function alta_impuesto()
{
		var txtnombre_impuesto=document.frm_nuevo_impuesto.txtnombre_impuesto.value;	
		var txtporcentaje=document.frm_nuevo_impuesto.txtporcentaje.value;	

		if(txtnombre_impuesto == "" || txtnombre_impuesto ==0 || txtnombre_impuesto==null)
		{  
		alert("No ha escrito el impuesto");
		}
		else if(isNaN(txtporcentaje))
		{  
		alert("Lo que capturo en PORCENTAJE NO ES UN NUMERO");
		}
		
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_impuesto").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_impuesto.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El impuesto ya existe");
				document.location.href = "impuestos.php";	
				}
				else
				{
				alert("IMPUESTO guardada satisfactoriamente");	
				document.location.href = "impuestos.php";	
				}
				
			}
		});
	  }	
}

function modificar_datos_impuesto()
{
		var txtid_impuesto=document.frm_modificar_impuesto.txtid_impuesto.value;
		var txtnombre_impuesto=document.frm_modificar_impuesto.txtnombre_impuesto.value;
		var txtporcentaje=document.frm_modificar_impuesto.txtporcentaje.value;
		
		if(txtid_impuesto == "" || txtid_impuesto ==0 || txtid_impuesto==null)
		{  
		alert("No ha seleccionado el impuesto a modificar");
		}
		else if(txtnombre_impuesto == "" || txtnombre_impuesto ==0 || txtnombre_impuesto==null)
		{  
		alert("No ha escrito el nombre del impuesto");
		}
		else if(isNaN(txtporcentaje))
		{  
		alert("Lo que capturo en PORCENTAJE NO ES UN NUMERO");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_impuesto").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_impuesto.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El impuesto ha sido modificado");
				document.location.href ="impuestos.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function modificar_impuesto(id_impuesto)
{
	var id_impuesto=id_impuesto;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_impuesto.php"+'?idimpuesto='+id_impuesto;	
}

function alta_metodo_pago()
{
		var txtnombre_metodo_pago=document.frm_nuevo_metodo_pago.txtnombre_metodo_pago.value;	

		if(txtnombre_metodo_pago == "" || txtnombre_metodo_pago ==0 || txtnombre_metodo_pago==null)
		{  
		alert("No ha escrito el metodo de pago");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_metodo_pago").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_metodo_pago.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El metodo de pago ya existe escriba otro");
				document.location.href = "metodospago.php";	
				}
				else
				{
				alert("METODO DE PAGO guardada satisfactoriamente");	
				document.location.href = "metodospago.php";	
				}
				
			}
		});
	  }	
}

function modificar_metodo_pago(id_metodo_pago)
{
	var id_metodo_pago=id_metodo_pago;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_metodo_pago.php"+'?idmetodopago='+id_metodo_pago;	
}

function modificar_datos_metodo_pago()
{
		var txtid_metodo_pago=document.frm_modificar_metodo_pago.txtid_metodo_pago.value;
		
		if(txtid_metodo_pago == "" || txtid_metodo_pago ==0 || txtid_metodo_pago==null)
		{  
		alert("No ha seleccionado el metodo de pago a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_metodo_pago").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_metodo_pago.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El metodo de pago ha sido modificada");
				document.location.href ="metodospago.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_unidad_medida()
{
		var txtnombre_unidad_medida=document.frm_nuevo_unidad_medida.txtnombre_unidad_medida.value;	

		if(txtnombre_unidad_medida == "" || txtnombre_unidad_medida ==0 || txtnombre_unidad_medida==null)
		{  
		alert("No ha escrito la unidad de medida");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_unidad_medida").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_unidad_medida.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La unidad de medida ya existe escriba otro");
				document.location.href = "unidadesmedida.php";	
				}
				else
				{
				alert("UNIDAD DE MEDIDA guardada satisfactoriamente");	
				document.location.href = "unidadesmedida.php";	
				}
				
			}
		});
	  }	
}

function modificar_unidad_medida(id_unidad_medida)
{
	var id_unidad_medida=id_unidad_medida;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_unidad_medida.php"+'?idunidadmedida='+id_unidad_medida;	
}

function modificar_datos_unidad_medida()
{
		var txtid_unidad_medida=document.frm_modificar_unidad_medida.txtid_unidad_medida.value;
		
		if(txtid_unidad_medida == "" || txtid_unidad_medida ==0 || txtid_unidad_medida==null)
		{  
		alert("No ha seleccionado la unidad de medida a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_unidad_medida").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_unidad_medida.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La unidad de medida ha sido modificada");
				document.location.href ="unidadesmedida.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_ubicacion()
{
		var txtnombre_ubicacion=document.frm_nueva_ubicacion.txtnombre_ubicacion.value;	

		if(txtnombre_ubicacion == "" || txtnombre_ubicacion ==0 || txtnombre_ubicacion==null)
		{  
		alert("No ha escrito la ubicacion");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_ubicacion").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_ubicacion.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La ubicacion ya existe escriba otro");
				document.location.href = "ubicaciones.php";	
				}
				else
				{
				alert("UBICACION guardada satisfactoriamente");	
				document.location.href = "ubicaciones.php";	
				}
				
			}
		});
	  }	
}

function modificar_ubicacion(id_ubicacion)
{
	var id_ubicacion=id_ubicacion;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_ubicacion.php"+'?idubicacion='+id_ubicacion;	
}

function modificar_datos_ubicacion()
{
		var txtid_ubicacion=document.frm_modificar_ubicacion.txtid_ubicacion.value;
		
		if(txtid_ubicacion == "" || txtid_ubicacion ==0 || txtid_ubicacion==null)
		{  
		alert("No ha seleccionado la ubicacion a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_ubicacion").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_ubicacion.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La ubicacion ha sido modificada");
				document.location.href ="ubicaciones.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_area_venta()
{
		var txtnombre_areaventa=document.frm_nueva_areaventa.txtnombre_areaventa.value;	
		var txtnombre_caja=document.frm_nueva_areaventa.txtnombre_caja.value;	

		if(txtnombre_areaventa == "" || txtnombre_areaventa ==0 || txtnombre_areaventa==null)
		{  
		alert("No ha escrito la area de venta");
		}
		else if(txtnombre_caja == "" || txtnombre_caja ==0 || txtnombre_caja==null)
		{  
		alert("No ha escrito la caja");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_areaventa").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_area_venta.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La area de venta ya existe escriba otro");
				document.location.href = "areasventa.php";	
				}
				else
				{
				alert("AREA DE VENTA guardada satisfactoriamente");	
				document.location.href = "areasventa.php";	
				}
				
			}
		});
	  }	
}

function modificar_area_venta(id_area_venta)
{
	var id_area_venta=id_area_venta;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_area_venta.php"+'?idareaventa='+id_area_venta;	
}

function modificar_datos_area_venta()
{
		var txtid_areaventa=document.frm_modificar_area_venta.txtid_areaventa.value;
		
		if(txtid_areaventa == "" || txtid_areaventa ==0 || txtid_areaventa==null)
		{  
		alert("No ha seleccionado la area de venta a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_area_venta").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_area_venta.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La area de venta ha sido modificada");
				document.location.href ="areasventa.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_sucursal()
{
		var txtdescripcion_sucursal=document.frm_nueva_sucursal.txtdescripcion_sucursal.value;	
		var txtcalle=document.frm_nueva_sucursal.txtcalle.value;	
		var txtnumero_exterior=document.frm_nueva_sucursal.txtnumero_exterior.value;	
		var txtcolonia=document.frm_nueva_sucursal.txtcolonia.value;	
		var txttelefono=document.frm_nueva_sucursal.txttelefono.value;	

		if(txtdescripcion_sucursal == "" || txtdescripcion_sucursal ==0 || txtdescripcion_sucursal==null)
		{  
		alert("No ha escrito el nombre de la sucursal");
		}
		else if(txtcalle == "" || txtcalle ==0 || txtcalle==null)
		{  
		alert("No ha escrito la calle");
		}
		else if(txtnumero_exterior == "" || txtnumero_exterior ==0 || txtnumero_exterior==null)
		{  
		alert("No ha escrito el numero exterior");
		}
		else if(txtcolonia == "" || txtcolonia ==0 || txtcolonia==null)
		{  
		alert("No ha escrito la colonia");
		}
		else if(txttelefono == "" || txttelefono ==0 || txttelefono==null)
		{  
		alert("No ha escrito el telefono");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_sucursal").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_sucursal.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La sucursal ya existe escriba otro");
				document.location.href = "sucursales.php";	
				}
				else
				{
				alert("SUCURSAL guardada satisfactoriamente");	
				document.location.href = "sucursales.php";	
				}
				
			}
		});
	  }	
}

function modificar_sucursal(id_sucursal)
{
	var id_sucursal=id_sucursal;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_sucursal.php"+'?idsucursal='+id_sucursal;	
}

function modificar_datos_sucursal()
{
		var txtid_sucursal_modificar=document.frm_modificar_sucursal.txtid_sucursal_modificar.value;
		
		if(txtid_sucursal_modificar == "" || txtid_sucursal_modificar ==0 || txtid_sucursal_modificar==null)
		{  
		alert("No ha seleccionado la sucursal a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_sucursal").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_sucursal.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La sucursal ha sido modificada");
				document.location.href ="sucursales.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_departamento()
{
		var txtdesc_departamento=document.frm_nuevo_departamento.txtdesc_departamento.value;	

		if(txtdesc_departamento == "" || txtdesc_departamento ==0 || txtdesc_departamento==null)
		{  
		alert("No ha escrito el departamento");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_departamento").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_departamento.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("El departamento ya existe escriba otro");
				document.location.href = "departamentos.php";	
				}
				else
				{
				alert("DEPARTAMENTO guardada satisfactoriamente");	
				document.location.href = "departamentos.php";	
				}
				
			}
		});
	  }	
}

function modificar_departamento(id_departamento)
{
	var id_departamento=id_departamento;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_departamento.php"+'?iddepartamento='+id_departamento;	
}

function modificar_datos_departamento()
{
		var txtid_departamento=document.frm_modificar_departamento.txtid_departamento.value;
		
		if(txtid_departamento == "" || txtid_departamento ==0 || txtid_departamento==null)
		{  
		alert("No ha seleccionado el departamento a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_departamento").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_departamento.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La departamento ha sido modificada");
				document.location.href ="departamentos.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}


function nueva_cuenta_bancaria_proveedor(id_proveedor)
{
	var id_proveedor=id_proveedor;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="nueva_cuenta_bancaria_proveedor.php"+'?idproveedor='+id_proveedor;	
}

function alta_cuenta_bancaria_proveedor()
{
		var txtnumero_cuentabp=document.frm_nueva_cuenta_bancaria_proveedor.txtnumero_cuentabp.value;	
		var txtbancop=document.frm_nueva_cuenta_bancaria_proveedor.txtbancop.value;	

		if(txtnumero_cuentabp == "" || txtnumero_cuentabp ==0 || txtnumero_cuentabp==null)
		{  
		alert("No ha escrito el numero de cuenta");
		}
		else if(txtbancop == "" || txtbancop ==0 || txtbancop==null)
		{  
		alert("No ha escrito el banco");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_cuenta_bancaria_proveedor").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_cuenta_bancaria_proveedor.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La cuenta ya existe escriba otro");
				document.location.href = "proveedores.php";	
				}
				else
				{
				alert("CUENTA BANCARIA guardada satisfactoriamente");	
				document.location.href = "proveedores.php";	
				}
				
			}
		});
	  }	
}

function modificar_cuenta_bancaria_proveedor(id_cuenta_bancariap)
{
	var id_cuenta_bancariap=id_cuenta_bancariap;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_cuenta_bancaria_proveedor.php"+'?idcuentabancariap='+id_cuenta_bancariap;	
}

function modificar_datos_cuenta_bancaria_proveedor()
{
		var txtid_cuentabancariap=document.frm_modificar_cuenta_bancaria_proveedor.txtid_cuentabancariap.value;
		
		if(txtid_cuentabancariap == "" || txtid_cuentabancariap ==0 || txtid_cuentabancariap==null)
		{  
		alert("No ha seleccionado la cuenta bancaria");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_cuenta_bancaria_proveedor").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_cuenta_bancaria_proveedor.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La cuenta bancaria ha sido modificada");
				document.location.href ="proveedores.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function alta_cuenta_pagar()
{
		var txtnombre_proveedor=document.frm_nueva_cuenta_pagar.txtnombre_proveedor.value;	
		var txtdocumento_pagar=document.frm_nueva_cuenta_pagar.txtdocumento_pagar.value;	
		var txttotal_pagar=document.frm_nueva_cuenta_pagar.txttotal_pagar.value;	
		var txtdescuento_pronto_pago=document.frm_nueva_cuenta_pagar.txtdescuento_pronto_pago.value;	
		var txtfecha_proximo_pago=document.frm_nueva_cuenta_pagar.datepicker1.value;	

		if(txtnombre_proveedor == "" || txtnombre_proveedor ==0 || txtnombre_proveedor==null)
		{  
		alert("No ha escrito el nombre del proveedor");
		}
		else if(txtdocumento_pagar == "" || txtdocumento_pagar ==0 || txtdocumento_pagar==null)
		{  
		alert("No ha escrito el numero de documento o factura");
		}
		else if(txttotal_pagar == "" || txttotal_pagar ==0 || txttotal_pagar==null)
		{  
		alert("No ha escrito el total a pagar del documento o factura");
		}
		else if(txtdescuento_pronto_pago == "" || txtdescuento_pronto_pago ==0 || txtdescuento_pronto_pago==null)
		{  
		alert("No ha escrito el monto por pronto pago");
		}
		else if(txtfecha_proximo_pago == "" || txtfecha_proximo_pago ==0 || txtfecha_proximo_pago==null)
		{  
		alert("No ha indicado la fecha del proximo pago");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_cuenta_pagar").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_cuenta_pagar.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
             	alert("La cuenta ya existe escriba otro");
				document.location.href = "cuentasporpagar.php";	
				}
				else
				{
				alert("CUENTA guardada satisfactoriamente");	
				document.location.href = "cuentasporpagar.php";	
				}
				
			}
		});
	  }	
}

function nuevo_abono(id_cuenta_pagar,id_proveedor)
{
	var id_cuenta_pagar=id_cuenta_pagar;
	var id_proveedor=id_proveedor;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="nuevo_abono.php"+'?idcuentapagar='+id_cuenta_pagar+'&idproveedor='+id_proveedor;	

}

function alta_abono()
{
		var txtid_cuenta_pagar=document.frm_nuevo_abono.txtid_cuenta_pagar.value;	
		var txttipo_pago=document.frm_nuevo_abono.txttipo_pago.value;	
		var txtimporte_abono=document.frm_nuevo_abono.txtimporte_abono.value;	

		if(txtid_cuenta_pagar == "" || txtid_cuenta_pagar ==0 || txtid_cuenta_pagar==null)
		{  
		alert("No ha seleccionado la cuenta a pagar");
		}
		else if(txttipo_pago == "" || txttipo_pago ==0 || txttipo_pago==null)
		{  
		alert("No ha seleccionado el tipo de pago");
		}
		else if(txtimporte_abono == "" || txtimporte_abono ==0 || txtimporte_abono==null)
		{  
		alert("No ha escrito el importe del documento o factura");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_abono").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_abono.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
             	alert("El abono ya existe capture otro");
				document.location.href = "cuentasporpagar.php";	
				}
				else
				{
				alert("ABONO guardada satisfactoriamente");	
				document.location.href = "cuentasporpagar.php";	
				}
				
			}
		});
	  }	
}

function modificar_cuenta_pagar(id_cuenta_pagar)
{
	var id_cuenta_pagar=id_cuenta_pagar;
	var id_proveedor=id_proveedor;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_cuenta_pagar.php"+'?idcuentapagar='+id_cuenta_pagar;	

}

function cuentaspagarproveedor(id_proveedor)
{
	var id_proveedor=id_proveedor;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="cuentaspagarproveedor.php"+'?idproveedor='+id_proveedor;	
}

function modificar_datos_cuenta_pagar()
{
		var txtid_cuenta_pagar_modificar=document.frm_modificar_cuenta_pagar.txtid_cuenta_pagar_modificar.value;
		
		if(txtid_cuenta_pagar_modificar == "" || txtid_cuenta_pagar_modificar ==0 || txtid_cuenta_pagar_modificar==null)
		{  
		alert("No ha seleccionado la cuenta a pagar a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_cuenta_pagar").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../mantenimiento/modificar_datos_cuenta_pagar.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La cuenta a pagar ha sido modificada");
				document.location.href ="cuentasporpagar.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }		
}

function cuentascobrarcliente(id_cliente)
{
	var id_cliente=id_cliente;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="cuentascobrarcliente.php"+'?id_cliente='+id_cliente;	
}

function nuevo_abono_cobrar(id_venta,id_cliente,folio_venta)
{
	var id_venta=id_venta;
	var id_cliente=id_cliente;
	var folio_venta=folio_venta;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="nuevo_abono_cobrar.php"+'?idventa='+id_venta+'&idcliente='+id_cliente+'&folioventa='+folio_venta;
}

function alta_abono_cobrar()
{
		var txtid_venta=document.frm_nuevo_abono_cobrar.txtid_venta.value;	
		var txttipo_pago=document.frm_nuevo_abono_cobrar.txttipo_pago.value;	
		var txtimporte_abono=document.frm_nuevo_abono_cobrar.txtimporte_abono.value;	

		if(txtid_venta == "" || txtid_venta ==0 || txtid_venta==null)
		{  
		alert("No ha seleccionado la cuenta a cobrar");
		}
		else if(txttipo_pago == "" || txttipo_pago ==0 || txttipo_pago==null)
		{  
		alert("No ha seleccionado el tipo de pago");
		}
		else if(txtimporte_abono == "" || txtimporte_abono ==0 || txtimporte_abono==null)
		{  
		alert("No ha escrito el importe del documento o factura");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_abono_cobrar").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_abono_cobrar.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="E")
				{	
             	alert("El abono ya existe capture otro");
				document.location.href = "cuentasporcobrar.php";	
				}
				else
				{
				alert("ABONO guardada satisfactoriamente");	
				document.location.href = "cuentasporcobrar.php";	
				}
				
			}
		});
	  }	
}

function verificar_precio(e) {
	//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var descripcion_producto_mod=document.frm_verificador_precios.txtproductodesc.value;	
	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_verificador_precios").serialize();
			$.ajax({
			 
			url: '../php/verificar_precio.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frm_verificador_precios.txtdescripcion_productomod.value=data3;
				document.frm_verificador_precios.txtexistencia_productomod.value=data5;
				document.frm_verificador_precios.txtprecio_venta_mod.value=data4;
				$('#exampleModalLong_verificador').modal();
				}
			}
		});
	  }
	}
}

function consultar_producto_inventario_fisico(e) {
	//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var descripcion_producto_mod=document.frm_nuevo_actualizacion_inventario.txtproductodesc.value;	
	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			$.ajax({
			 
			url: '../php/consultar_producto_inventario_fisico.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frm_nuevo_actualizacion_inventario.txtid_productoinventario.value=data1;
				document.frm_nuevo_actualizacion_inventario.txtdescripcion_productomod.value=data3;
				$('#exampleModalLong_inventariofisico').modal();
				}
			}
		});
	  }
	}
}

function agregar_producto_inventario_fisico(e)
{
 tecla = (document.all) ? e.keyCode : e.which;
 var txtid_productoinventario=document.frm_nuevo_actualizacion_inventario.txtid_productoinventario.value;
  if (tecla==13)
  	{		
		
		if(txtid_productoinventario == "" || txtid_productoinventario ==0 || txtid_productoinventario==null)
		{  
		alert("No ha seleccionado el producto a actualizar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../mantenimiento/agregar_producto_inventario_fisico.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);

				//document.frm_modificar_marca.txtcadena.value=data;
				//alert("La cantidad en existencia del producto ha sido modificado");
				document.location.href ="inventariosfisico.php";
			}
		});
	  }	
	}			
}

function guardar_inventario_fisico()
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
			 
			url: '../php/guardar_datos_inventario_fisico.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);				
				
				if(data=="Y")
				{	
             	alert("El inventario ha sido guardado");
				document.location.href = "inventariosfisico.php";	
				}
				else
				{	
				alert("El inventario ha sido guardado");
				document.location.href = "inventariosfisico.php";
             	//alert("La marca ha sido eliminada");
				//document.location.href = "inventarios.php";	
				}				
			}
		});
	  }				
}

function cantidad_producto_buscadomod_compra(e) {
	//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var descripcion_producto_comprar=document.frm_nueva_compra.txtproductodesc.value;	
	
		if(descripcion_producto_comprar == "" || descripcion_producto_comprar ==0 || descripcion_producto_comprar==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frm_nueva_compra").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_comprar_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frm_nueva_compra.txtid_productomodcom.value=data1;
				document.frm_nueva_compra.txtdescripcion_productomodcom.value=data3;
				document.frm_nueva_compra.txtexistencia_productomodcom.value=data5;
				document.frm_nueva_compra.txtprecio_compra_modcom.value=data4;
				document.frm_nueva_compra.txtnuevo_precio_compra_modcom.value=data4;
				$('#exampleModalLong_compra').modal();
				$('#exampleModalLong_compra').on('shown.bs.modal', function () {
		             $("#txtcantidad_productomodcom").focus();
		          });
				}
			}
		});
	  }
	}
}

function guardar_producto_compra_buscado_mod(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  var cant=document.frm_nueva_compra.txtcantidad_productomodcom.value;
  var descu=document.frm_nueva_compra.txtdescuento_productomodcom.value;
  var nvopreccom=document.frm_nueva_compra.txtnuevo_precio_compra_modcom.value;
  if (tecla==13)
  	{
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else if(isNaN(descu))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else if(isNaN(nvopreccom))
		{  
		alert("Lo que capturo en PRECIO DE COMPRA NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_compra").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_producto_compra_buscar_modal.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_compra.php";	
						}
					}
				});
			}
	}	
}

function eliminar_cantidad_producto_porcomprar(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frm_nueva_compra.txtcantidad_productomode.value;
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_compra").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/eliminar_cantidad_producto_porcomprar.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_compra.php";	
						}
					}
				});
			}
	}	
}

function cambiar_precio_producto_porcomprar(e,cantidad) 
{
  //alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtprecio_productomodprec=document.frm_nueva_compra.txtprecio_productomodprec.value;
  		if(isNaN(txtprecio_productomodprec))
		{  
		alert("Lo que capturo en PRECIO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_compra").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_precio_producto_porcomprar.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_compra.php";	
						}
					}
				});
			}
	}	
}

function modificar_cantidad_producto_porcomprar(e,cantidad)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frm_nueva_compra.txtcantidad_productomodm.value;
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_compra").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_cantidad_producto_porcomprar.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_compra.php";	
						}
					}
				});
			}
	}	
}

function guardar_compra_modal(e)
{
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var txttotal_compra=document.frm_nueva_compra.txttotal_compra.value;
				var txtnombre_proveedor=document.frm_nueva_compra.txtnombre_proveedor.value;
				var txtnumero_documento=document.frm_nueva_compra.txtnumero_documento.value;
				var datepicker1=document.frm_nueva_compra.datepicker1.value;		
				var cmbtipo_movimiento=document.frm_nueva_compra.cmbtipo_movimiento.value;		
				//var tipopago=document.frm_nueva_compra.cmbtipo_cobro.value;		
				
				if(txttotal_compra == "" || txttotal_compra ==0 || txttotal_compra==null)
				{  
				alert("No ha realizado ninguna compra");
				}
				else
					if(txtnombre_proveedor == "" || txtnombre_proveedor ==0 || txtnombre_proveedor==null)
						{
							alert("No ha seleccionado ningun proveedor");
						}
				else
					if(txtnumero_documento == "" || txtnumero_documento ==0 || txtnumero_documento==null)
						{
							alert("No ha indicado el numero o factura del documento");
						}	
				else
					if(datepicker1 == "" || datepicker1 ==0 || datepicker1==null)
						{
							alert("No ha indicado la fecha del documento");
						}
				else
					if(cmbtipo_movimiento == "" || cmbtipo_movimiento ==0 || cmbtipo_movimiento==null)
						{
							alert("No ha indicado el tipo de compra");
						}		
				/*else
					if(tipopago == "" || tipopago ==0 || tipopago==null)
						{
							alert("No ha indicado la forma a pagar");
						}*/								
			  else
				    {
					//alert("entro");
					var str = $("#frm_nueva_compra").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_compra_modal.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						
						if(data0=="Y")
						{	
		             	//alert("La venta ha sido guardada");
		             	if (confirm("\xBFDesea imprimir el ticket de la compra?"))
						{
					       window.open('../reportes/tcpdf/examples/imprimir_compra.php?id_compra=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
					       setTimeout(function () { window.print(); }, 500);
        					window.onfocus = function () { setTimeout(function () { window.close(); }, 500); } 			
						}	
						document.location.href = "compras.php";	
						//window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
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
}

function tipo_operacion(id_operacion)
{
  var tipo_operacion=id_operacion;
  //alert(tipo_operacion);
  if(tipo_operacion==1)
  {
    document.getElementById('txtcliente').style.display = 'block';
    document.getElementById('txtdescuento_venta').style.display = 'block';
    document.getElementById('txtmetodo_pago').style.display = 'block';
    //document.getElementById('txtreferencia').style.display = 'block';
    document.getElementById('txtimporte_recibido').style.display = 'block';
  }
  else
  {
  	document.getElementById('txtcliente').style.display = 'none';
    document.getElementById('txtdescuento_venta').style.display = 'none';
    document.getElementById('txtmetodo_pago').style.display = 'none';
    //document.getElementById('txtreferencia').style.display = 'none';
    document.getElementById('txtimporte_recibido').style.display = 'none';
  }
}

function buscar_cliente_descuento(e)
{
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var txtcliente=document.frm_nueva_venta.txtcliente.value;
				var totalpagar=document.frm_nueva_venta.txttotalpagar_modal_sindesc.value;
				var cmbtipo_operacionsel=document.frm_nueva_venta.cmbtipo_operacionsel.value;
				var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;

				if(txtcliente == "" || txtcliente ==0 || txtcliente==null)
				{  
				alert("No ha seleccionado el cliente");
				}
			  else
				    {
					//alert("entro");
					var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/buscar_cliente_descuento.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];//respuesta
						var data1=datatotal[1];//id_cliente
						var data2=datatotal[2];//nombre_cliente
						var data3=datatotal[3];//descuento
						
						
						if(data0=="Y")
						{	
							document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa+"&id_tipo_movimiento="+cmbtipo_operacionsel+"&nombre_cliente="+data2;	
						}
						else
						{	
							//alert("La compra ha sido guardada");
			             	//alert("La marca ha sido eliminada");
							document.location.href = "compras.php";	
						}				
					}
				});
			  }	
	}	
}

function guardar_ajuste_salida(e)
{
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var totalpagar=document.frm_nueva_venta.txttotalpagar_modal.value;		
				//var tipopago=document.frm_nueva_venta.cmbtipo_cobro.value;		
				
				if(totalpagar == "" || totalpagar ==0 || totalpagar==null)
				{  
				alert("No ha realizado ninguna venta");
				}
			  else
				    {
					//alert("entro");
					var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_ajuste_salida.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						
						if(data0=="Y")
						{	
		             	//alert("La venta ha sido guardada");
		             	window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
						document.location.href = "ventas.php";	
						//window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
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
}

function nueva_area_venta_usar()
{
var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/nueva_area_venta_usar.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						if(data0=="Y")
						{	
		             	document.location.href = "nueva_venta.php?id_area_venta="+data1;	
						}
						else
						{	
						alert("No se puede activar otra area de venta porque no esta dado de alta");
						document.location.href = "nueva_venta.php?id_area_venta="+data1;	
						}				
					}
				});	
}

function cancelar_venta_areaventa()
{
var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/cancelar_venta_areaventa.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						if(data0=="Y")
						{	
							if(data1==0)
							{
								document.location.href = "ventas.php";	
							}	
							else
							{
								document.location.href = "nueva_venta.php?id_area_venta="+data1;	
							}
						}
						else
						{	
						document.location.href = "nueva_venta.php?id_area_venta="+data1;	
						}				
					}
				});	

}

function modificar_monto_caja()
{
var str = $("#frm_modificar_monto_caja").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../catalogos/modificar_monto_caja.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						//var datatotal=data.split(",");
						//var data0=datatotal[0];
						//var data=datatotal[1];
						
						if(data=="Y")
						{	
							document.location.href = "../panel_principal.php";	
						}
						else
						{	
							document.location.href = "../panel_principal.php";	
						}				
					}
				});						
}

////// PARA MODIFICAR VENTA ///////////////

function modificar_venta(id_venta_modificar,id_venta)
{
	var id_venta_modificar=id_venta_modificar;
	var id_venta=id_venta;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_venta.php"+'?id_venta_modificar='+id_venta_modificar+'&id_venta='+id_venta;
}

function guardar_producto_venta_buscado_modventa(e,cantidad) {
  console.log("Funcion");	
  var cant=document.frmmodificar_venta.txtcantidad_productomod.value;
  var descu=document.frmmodificar_venta.txtdescuento_productomod.value;
  var precvta=document.frmmodificar_venta.txtprecio_venta_mod.value;
  tecla = (document.all) ? e.keyCode : e.which;
  console.log("Tecla: " + tecla);
  if (tecla==13)
  	{
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else if(isNaN(descu))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else if(isNaN(precvta))
		{  
		alert("Lo que capturo en PRECIO DE VENTA NO ES UN NUMERO");
		}
		else
			{
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_producto_venta_buscar_modal_modventa.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];				

						if(data0==null)
						{	
						alert("Error al guardar el producto");
						}
						else{	

							/* var obj = JSON.parse(data);
						     console.log(obj);
						     $('#exampleModalLong').modal('hide');
						     $('#listProd').append(
						     	+'<tr>'
                                +'<td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta('+ obj.id_producto +');" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>'
                                +'<td class="mailbox-subject" id="list_descp"><b>'+ obj.descripcion +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_cant"><b>'+ obj.cantidad +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_precio"><b>'+ obj.precio_venta +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_desc"><b>' + obj.descuento +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_neto"><b>' + obj.precio_neto +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_subt"><b>' + obj.importe +'</b></td>'
                        		+'</tr>');*/
                        	 document.location.href='modificar_venta.php?id_venta_modificar='+data1+'&id_venta='+0;
						  }
						}
				});
			}
	}	
}

function eliminar_cantidad_producto_porvender_modventa(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frmmodificar_venta.txtcantidad_productomode.value;
  		var id_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/eliminar_cantidad_producto_porvender_modventa.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("No se puede eliminar mas cantidad del producto de lo vendido");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "modificar_venta.php?id_venta_modificar="+id_venta_modificar+'&id_venta='+0;	
						}
					}
				});
			}
	}	
}

function modificar_cantidad_producto_porvender_modventa(e,cantidad)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var cant=document.frmmodificar_venta.txtcantidad_productomodm.value;
  		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;

  		if(isNaN(cant))
		{  
		alert("Lo que capturo en CANTIDAD NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_cantidad_producto_porvender_modventa.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
						}
					}
				});
			}
	}	
}

function cambiar_precio_producto_porvender_modventa(e,cantidad) 
{
  //alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtprecio_productomodprec=document.frmmodificar_venta.txtprecio_productomodprec.value;
  		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;


  		if(isNaN(txtprecio_productomodprec))
		{  
		alert("Lo que capturo en PRECIO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_precio_producto_porvender_modventa.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
						}
					}
				});
			}
	}	
}

function modificar_descuento_producto_porvender_modventa(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtdescuento_productomoddesc=document.frmmodificar_venta.txtdescuento_productomoddesc.value;
  		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;

  		if(isNaN(txtdescuento_productomoddesc))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_descuento_producto_porvender_modventa.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
						}
					}
				});
			}
	}	
}

function buscar_cliente_descuento_modventa(e)
{
tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var txtcliente=document.frmmodificar_venta.txtcliente.value;
				var totalpagar=document.frmmodificar_venta.txttotalpagar_modal_sindesc.value;

				if(txtcliente == "" || txtcliente ==0 || txtcliente==null)
				{  
				alert("No ha seleccionado el cliente");
				}
			  else
				    {
					//alert("entro");
					var str = $("#frmmodificar_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/buscar_cliente_descuento.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						
						if(data0=="Y")
						{	
			             	var descpor=(totalpagar*data1)/100;
							var totvtadescto=totalpagar-descpor;
							document.frmmodificar_venta.txtdescuento_venta.value=data1;	
							document.frmmodificar_venta.txttotalpagar_modal.value=totvtadescto.toFixed(2);	
							document.frmmodificar_venta.txtimporte_recibido.value=totvtadescto.toFixed(2);	
						}
						else
						{	
							//alert("La compra ha sido guardada");
			             	//alert("La marca ha sido eliminada");
							document.location.href = "compras.php";	
						}				
					}
				});
			  }	
	}	
}

function calcular_cambio_venta_modal_modventa(e,cantidad)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var totalpagar=document.frmmodificar_venta.txttotalpagar_modal.value;
		var txtpago_venta=document.frmmodificar_venta.txtimporte_recibido.value;
		var txtpago_venta=document.frmmodificar_venta.txtimporte_recibido.value;
		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
		
		if(totalpagar==0)
			{
				alert("No ha realizado ninguna venta");
			}	
		else
			{
				var cambio_venta=txtpago_venta-totalpagar;
						var str = $("#frmmodificar_venta").serialize();
						//var str = id_marca;
						//alert(str);
						$.ajax({
						url: '../php/guardar_numero_pago_modventa.php',
						data: str,
						type: 'post',
						success: function(data){
						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];



							if(data0=="Y")
							{	
								if(data1==0)
									{
										document.frmmodificar_venta.txtcambio_ventamodal.value=data2;
										$('#exampleModalLongcambio').modal();
										$('#exampleModalLongcambio').on('shown.bs.modal', function () {
											document.frmmodificar_venta.txtcambio_ventamodal.value=data2;
								             $("#txtcambio_ventamodal").focus();
								          });
									}
								else
									{
										alert("Debe de cumbrir el total de la venta");
										document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+"&id_venta=0";	
										$('#exampleModalLongcobrar').modal()
										  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
										             $("#txtmetodo_pago").focus();
										          });
									}
							}
							else
							{	
								alert("Error al guardar el pago");
							}	
						}			
					});					
			}
	}	
}

function guardar_venta_modal_modventa(e)
{
 tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
				var total_venta=document.frmmodificar_venta.txttotal_venta.value;
				var pago_venta=document.frmmodificar_venta.txtimporte_recibido.value;
				var cambio_venta=document.frmmodificar_venta.txtcambio_ventamodal.value;
				var totalpagar=document.frmmodificar_venta.txttotalpagar_modal.value;		
				//var tipopago=document.frmmodificar_venta.cmbtipo_cobro.value;		
				
				if(total_venta == "" || total_venta ==0 || total_venta==null)
				{  
				alert("No ha realizado ninguna venta");
				}
				else
					if(pago_venta == "" || pago_venta <0 || pago_venta==null)
						{
							alert("No ha realizado el cobro de la venta");
						}
				else
					if(cambio_venta == "" || cambio_venta <0 || cambio_venta==null)
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
					var str = $("#frmmodificar_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/guardar_venta_modal_modventa.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];//tipo de operacion ticket o ajuste de salida
						var data3=datatotal[3];//ultimo id de la tabla ventas
						
						
						if(data0=="Y")
						{	
		             	//alert("La venta ha sido guardada");
		             	if (confirm("\xBFDesea imprimir el ticket de la venta?"))
						{
					       /*window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
					       setTimeout(function () { window.print(); }, 500);
        					window.onfocus = function () { setTimeout(function () { window.close(); }, 500); } */
        					var ventana1;
							var ventana3;
							var folioidventa;
							if(data2==1)
								{
									folioidventa='T'+data1;
								}
							else
								{
									folioidventa='AS'+data1;
								}
							ventana1 = window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1 + '&folioidventa=' + folioidventa + '&idultimaventa=' + data3, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  
							
							/*setTimeout(function(){ ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa + '&folioidventa=' + folioidventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  },5000);
							setTimeout(function(){ ventana1.close(); ventana3.close(); },9000);*/						
						}	
						document.location.href = "ventas.php";	
						//window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
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
}

function eliminar_producto_venta_modventa(id_producto_venta)
{
		document.frmmodificar_venta.txtid_producto_buscar.value=id_producto_venta;
		var id_producto_venta_eliminar=document.frmmodificar_venta.txtid_producto_buscar.value
		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
		
		if(id_producto_venta_eliminar == "" || id_producto_venta_eliminar ==0 || id_producto_venta_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frmmodificar_venta").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_venta_modventa.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
				}				
			}
		});
	  }		
}

function cantidad_producto_buscadomod_modventa(e) {
	//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
		var descripcion_producto_mod=document.frmmodificar_venta.txtproductodesc.value;	
	
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto");
		}
	  else
			{
			var str = $("#frmmodificar_venta").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				
				if(data0==0)
				{	
				alert("Error al buscar el producto");
				}
				else(data0==1)
				{	
				document.frmmodificar_venta.txtid_productomod.value=data1;
				document.frmmodificar_venta.txtdescripcion_productomod.value=data3;
				document.frmmodificar_venta.txtexistencia_productomod.value=data5;
				document.frmmodificar_venta.txtprecio_venta_mod.value=data4;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomod").focus();
					});
				}
			}
		});
	  }
	}
}

function buscar_producto_venta_cb_modventa()
{
	//alert("entro buscar producto venta");	
	var cb_producto=document.frmmodificar_venta.txtcodigobp.value;	
	var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;

	if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
	{  
	alert("No ha seleccionado ningun producto");
	document.frmmodificar_venta.txtcodigobp.focus();		
	}
  else
		{
		//alert("entro");
		var str = $("#frmmodificar_venta").serialize();
		//alert(str);
		$.ajax({
		 
		url: '../php/buscar_producto_venta_cb.php',
		data: str,
		type: 'post',
		success: function(data){

			//alert(data);
			var datatotal=data.split(",");
			var data0=datatotal[0];
			var data=datatotal[1];

			if(data0==0)
			{	
			alert("EL PRODUCTO NO EXISTE");
			}
			else
			{	
			//document.location.href ="nueva_venta.php";
			document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
			}
			//document.frm_nuevo_usuario.txtcadena.value=data;
		}
	});
  }
}


function pasar_venta_a(id_venta_modificar)
{
	var id_venta_modificar=id_venta_modificar;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="pasar_a.php"+'?id_venta_modificar='+id_venta_modificar;
}


function pasar_venta()
{
var str = $("#frmpasar_venta_a").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/pasar_venta.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						//var datatotal=data.split(",");
						//var data0=datatotal[0];
						//var data=datatotal[1];
						
						if(data=="Y")
						{	
							document.location.href = "ventas.php";	
						}
						else
						{	
							document.location.href = "ventas.php";	
						}				
					}
				});							
}

function seleccionar_tipo_operacion(e,operacion)
{
//alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtoperacion=document.frm_nueva_venta.txtoperacion.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
  		var txtnombrecliente=document.frm_nueva_venta.txtnombrecliente.value;


  		if(txtoperacion == "" || txtoperacion ==0 || txtoperacion==null)
		{  
		alert("No ha seleccionado el tipo de operacion");
		}
		else
		{
			/*if(txtoperacion=="TICKET")
				{
					//alert(txtoperacion);
					document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa+"&id_tipo_movimiento="+1+"&nombre_cliente="+txtnombrecliente;	
				}	
			else
				{
					//alert(txtoperacion);
					document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa+"&id_tipo_movimiento="+2+"&nombre_cliente="+txtnombrecliente;	
				}	*/
				var str = $("#frm_nueva_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/seleccionar_tipo_operacion.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						//var datatotal=data.split(",");
						//var data0=datatotal[0];
						//var data=datatotal[1];
						
						if(data==1)
						{	
								if(txtoperacion=="TICKET")
									{
										//alert(txtoperacion);
										document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa+"&id_tipo_movimiento="+1+"&nombre_cliente="+txtnombrecliente;	
									}	
								else
									{
										//alert(txtoperacion);
										document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa+"&id_tipo_movimiento="+2+"&nombre_cliente="+txtnombrecliente;	
									}
						}
						else
						{	
							alert("Error al guardar");
						}				
					}
				});							
		}
	}		
}

function cargar_pagos_venta(numeropagosventa,montocapturado)
{
	var txtnumeropagosventa=numeropagosventa;
	var montocapturado=montocapturado;
	var txttotalpagar_modal=document.frm_nueva_venta.txttotalpagar_modal.value;
	//alert(txtnumeropagosventa);
	if(txtnumeropagosventa!=0)
		{
			$('#exampleModalLongcobrar').modal()
			$('#exampleModalLongcobrar').on('shown.bs.modal', function () {
			    $("#txtmetodo_pago").focus();
			    });
		}

		var cambioventampagos=txttotalpagar_modal-montocapturado;
		document.frm_nueva_venta.txtcambio_ventamodal.value=cambioventampagos.toFixed(2);
		if(cambioventampagos<1)
		{
			$('#exampleModalLongcambio').modal();
			$('#exampleModalLongcambio').on('shown.bs.modal', function () {
			   $("#txtcambio_ventamodal").focus();
			    });
		}
}

function cargar_pagos_venta_modificar(numeropagosventa,montocapturado)
{
	var txtnumeropagosventa=numeropagosventa;
	var montocapturado=montocapturado;
	var txttotalpagar_modal=document.frmmodificar_venta.txttotalpagar_modal.value;
	//alert(txtnumeropagosventa);
	if(txtnumeropagosventa!=0)
		{
			$('#exampleModalLongcobrar').modal()
			$('#exampleModalLongcobrar').on('shown.bs.modal', function () {
			    $("#txtmetodo_pago").focus();
			    });
		}

		var cambioventampagos=txttotalpagar_modal-montocapturado;
		document.frmmodificar_venta.txtcambio_ventamodal.value=cambioventampagos.toFixed(2);
		if(cambioventampagos<1)
		{
			$('#exampleModalLongcambio').modal();
			$('#exampleModalLongcambio').on('shown.bs.modal', function () {
			   $("#txtcambio_ventamodal").focus();
			    });
		}
}

function no_cancelar_venta()
{
var str = $("#frmmodificar_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/no_cancelar_venta.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						
						if(data0=="Y")
						{	
						document.location.href = "ventas.php";		
						}
						else
						{	
						document.location.href = "ventas.php";	
						}				
					}
				});		
}

function quitar_merma(id_venta_modificar)
{
	var id_venta_modificar=id_venta_modificar;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="quitar_merma.php"+'?id_venta_modificar='+id_venta_modificar;
}

function cancelar_venta_merma()
{
var str = $("#frmquitar_merma").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
					 
					url: '../php/cancelar_venta_merma.php',
					data: str,
					type: 'post',
					success: function(data){

						//alert(data);
						//var datatotal=data.split(",");
						//var data0=datatotal[0];
						//var data=datatotal[1];
						
						if(data=="Y")
						{	
							document.location.href = "ventas.php";	
						}
						else
						{	
							document.location.href = "ventas.php";	
						}				
					}
				});							
}

function alta_categoria()
{
		var txtdesc_categoria=document.frm_nueva_categoria.txtdesc_categoria.value;	

		if(txtdesc_categoria == "" || txtdesc_categoria ==0 || txtdesc_categoria==null)
		{  
		alert("No ha escrito el categoria");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nueva_categoria").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../php/alta_categoria.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data=="Y")
				{	
             	alert("La categoria ya existe escriba otro");
				document.location.href = "categorias.php";	
				}
				else
				{
				alert("CATEGORIA guardada satisfactoriamente");	
				document.location.href = "categorias.php";	
				}
				
			}
		});
	  }	
}

function modificar_categoria(id_categoria)
{
	var id_categoria=id_categoria;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="modificar_categoria.php"+'?idcategoria='+id_categoria;	
}

function modificar_datos_categoria()
{
		var txtid_categoria=document.frm_modificar_categoria.txtid_categoria.value;
		
		if(txtid_categoria == "" || txtid_categoria ==0 || txtid_categoria==null)
		{  
		alert("No ha seleccionado la categoria a modificar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_modificar_categoria").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../catalogos/modificar_datos_categoria.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("La categoria ha sido modificada");
				document.location.href ="categorias.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }	
}

function capturar_numero_factura(id_venta)
{
	var id_venta=id_venta;
	document.location.href ="capturar_numero_factura.php"+'?id_venta='+id_venta;
}

function guardar_numero_factura()
{
		var datepicker1=document.frmcapturar_numero_factura.datepicker1.value;
		var txtnumero_factura=document.frmcapturar_numero_factura.txtnumero_factura.value;
		
		if(txtnumero_factura == "" || txtnumero_factura ==0 || txtnumero_factura==null)
		{  
		alert("No ha captura el numero de la factura");
		}
		else if(datepicker1 == "" || datepicker1 ==0 || datepicker1==null)
		{  
		alert("No ha capturado la fecha de la factura");
		}
	  else
		{
			//alert("entro");
			var str = $("#frmcapturar_numero_factura").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/guardar_numero_factura.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				//document.frm_modificar_marca.txtcadena.value=data;
				alert("El numero de factura ha sido guardada correctamente");
				document.location.href ="ventas.php";
				//document.location.href ="nueva_marca.php";
			}
		});
	  }		
}

function imprimir_vent_listado(id_venta,folioidventa){	
  var idventa=id_venta;
  var folioidventa=folioidventa;
  var idultimaventa=id_venta;
 var ventana1;
 var ventana3;
 ventana1 = window.open('../reportes/tcpdf/examples/imprimir_venta.php?idultimaventa=' + idultimaventa + '&folioidventa=' + folioidventa + '&idventa=' + idventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  

/*setTimeout(function(){ ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa + '&folioidventa=' + folioidventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  },5000);
setTimeout(function(){ ventana1.close(); ventana3.close(); },9000);*/

//ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 
//setTimeout(function(){ ventana3.close(); },5000);
 /* window.print();
  console.log("Imprimir...");
  window.close();

  window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
						document.location.href = "ventas.php";*/
}

function permisos(id_usuario)
{
	var id_usuario=id_usuario;
	//location.href = location.href + '?var1=32&var2=10';
	document.location.href ="configurar_accesos.php"+'?idusuariomodificar='+id_usuario;		
}

function configurar_acceso_usuario()
{
			//alert("entro");
			var str = $("#frmconfigurar_accesos").serialize();
			//alert(str);
			$.ajax({
			 
			url: '../seguridad/configurar_acceso_usuario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);
				
				if(data==0)
				{	
              	alert("Error al modificar el USUARIO");
				}
				else
				{	
             	alert("USUARIO modificado correctamente");
				document.location.href ="usuarios.php";
				}
				//document.frm_nuevo_usuario.txtcadena.value=data;
			}
		});
}

function tecla_idproducto(e,id_producto)
{
    tecla = (document.all) ? e.keyCode : e.which;
    var id_producto=id_producto;
    //alert (key);
    if(tecla==118) //F7 CANTIDAD
      {
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomodm.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongmod').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongmod').on('shown.bs.modal', function () {
							   $("#txtcantidad_productomodm").focus();
							});
						//document.getElementById("txtcantidad_productomodm").selectionEnd = 0;
						document.frm_nueva_venta.txtcantidad_productomodm.select();
						}
						//
				}
			});
		  }	
      }
    else if(tecla==121) // F10 ELIMINAR
    {
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        var id_producto_venta=id_producto;
        var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
							/*//document.location.href ="nueva_venta.php";
							document.frm_nueva_venta.txtdescripcion_productomode.value=data1;
							//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
							$('#exampleModalLongeli').modal();
							//$("#txtdescuento_productomod").focus();
							$('#exampleModalLongeli').on('shown.bs.modal', function () {
								   $("#txtcantidad_productomode").focus();
								});
							document.frm_nueva_venta.txtcantidad_productomode.select();*/
							if (confirm("\xBFDesea eliminar el producto: "+data1+" ? "))
								{
								       document.frm_nueva_venta.txtid_producto_buscar.value=id_producto_venta;
										var id_producto_venta_eliminar=document.frm_nueva_venta.txtid_producto_buscar.value
								       //alert("PROCESO DE ELIMINACION");
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
											//document.location.href = document.location.href;	
											document.location.href ="nueva_venta.php?id_area_venta="+txtid_areaventa;
											}
											else
											{	
							             	//alert("La marca ha sido eliminada");
											//document.location.href = document.location.href;	
											document.location.href ="nueva_venta.php?id_area_venta="+txtid_areaventa;
											}				
										}
									});
								}
						}
						
				}
			});
		  }	
    }
    else if(tecla==115) // F4 PRECIO
    {
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomodprecio.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongprecio').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongprecio').on('shown.bs.modal', function () {
							   $("#txtprecio_productomodprec").focus();
							});
						document.frm_nueva_venta.txtprecio_productomodprec.select();
						}
						
				}
			});
		  }	
    }
    else if(tecla==119) // F8 DESCUENTO
    {
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomoddescuento.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongdescuento').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongdescuento').on('shown.bs.modal', function () {
							   $("#txtdescuento_productomoddesc").focus();
							});
						document.frm_nueva_venta.txtdescuento_productomoddesc.select();
						}
						
				}
			});
		  }	
    }
    else if(tecla==113) // F2 COBRAR
    {
	  $('#exampleModalLongcobrar').modal()
	  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
	             $("#txtimporte_recibido").focus();
	          });
	  document.frm_nueva_venta.txtimporte_recibido.select();
	}
    else if(tecla==120) // F9 RETIRAR
    {
	  $('#exampleModalLongretirar').modal()
	  $('#exampleModalLongretirar').on('shown.bs.modal', function () {
	             $("#txtmotivo_retiro").focus();
	          });
    }
     else if(tecla==114) // F3 OPERACION
    {
	  $('#exampleModalLongoperacion').modal()
	  $('#exampleModalLongoperacion').on('shown.bs.modal', function () {
	             $("#txtoperacion").focus();
	          });
    }
    else if(tecla==117) // F6 CLIENTES
    {
	  $('#exampleModalLongclientes').modal()
	  $('#exampleModalLongclientes').on('shown.bs.modal', function () {
	             $("#txtcliente").focus();
	          });
    }    
    else if(tecla==17) // TECLA CONTROL CTRL
    {
      $('#exampleModalLongdescuentotodo').modal()
 	  $('#exampleModalLongdescuentotodo').on('shown.bs.modal', function () {
             $("#txtdescuento_todo").focus();
          });
  		document.frm_nueva_venta.txtdescuento_todo.select();
    }
}

function tecla_idproducto_modificacion_venta(e,id_producto)
{
    tecla = (document.all) ? e.keyCode : e.which;
    var id_producto=id_producto;
    //alert (key);
    if(tecla==118) //F7 CANTIDAD
      {
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frmmodificar_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frmmodificar_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista_modventa.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frmmodificar_venta.txtdescripcion_productomodm.value=data1;
						//document.frmmodificar_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongmod').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongmod').on('shown.bs.modal', function () {
							   $("#txtcantidad_productomodm").focus();
							});
						document.frmmodificar_venta.txtcantidad_productomodm.select();
						}
						
				}
			});
		  }	
      }
    else if(tecla==121) // F10 ELIMINAR
    {
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frmmodificar_venta.txtidproductonavegando.value=id_producto;
        

        document.frmmodificar_venta.txtid_producto_buscar.value=id_producto;
		var id_producto_venta_eliminar=document.frmmodificar_venta.txtid_producto_buscar.value;
		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;


	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {					
					var str = $("#frmmodificar_venta").serialize();
					//var str = id_marca;
					//alert(str);
					$.ajax({
						url: '../php/buscar_producto_enlista_modventa.php',
						data: str,
						type: 'post',
						success: function(data){
						//alert(data);
								var datatotal=data.split(",");
								var data0=datatotal[0];
								var data1=datatotal[1];
								var data2=datatotal[2];

								if(data0==0)
									{	
										alert("EL PRODUCTO NO EXISTE");
									}
								else
									{	
										/*//document.location.href ="nueva_venta.php";
										document.frmmodificar_venta.txtdescripcion_productomode.value=data1;
										//document.frmmodificar_venta.txtcantidad_productomodm.value=data2;
										$('#exampleModalLongeli').modal();
										//$("#txtdescuento_productomod").focus();
										$('#exampleModalLongeli').on('shown.bs.modal', function () {
										   $("#txtcantidad_productomode").focus();
										});*/
										if (confirm("\xBFDesea eliminar el producto: "+data1+" ? "))
											{
													document.frmmodificar_venta.txtid_producto_buscar.value=id_producto;
													var id_producto_venta_eliminar=document.frmmodificar_venta.txtid_producto_buscar.value
													var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
													var str = $("#frmmodificar_venta").serialize();
													//var str = id_marca;
													//alert(str);
													$.ajax({
													 
													url: '../php/baja_producto_venta_modventa.php',
													data: str,
													type: 'post',
													success: function(data){

														//alert(data);
														
														if(data=="Y")
														{	
										             	//alert("La marca ha sido eliminada");
														//document.location.href = document.location.href;	
														document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
														}
														else
														{	
										             	//alert("La marca ha sido eliminada");
														//document.location.href = document.location.href;	
														document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
														}				
													}
												});
											}
									}
							}
						});
				//alert("entro");
		 	 }	
    }
    else if(tecla==115) // F4 PRECIO
    {
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frmmodificar_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frmmodificar_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista_modventa.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frmmodificar_venta.txtdescripcion_productomodprecio.value=data1;
						//document.frmmodificar_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongprecio').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongprecio').on('shown.bs.modal', function () {
							   $("#txtprecio_productomodprec").focus();
							});
						document.frmmodificar_venta.txtprecio_productomodprec.select();
						}
						
				}
			});
		  }	
    }
    else if(tecla==119) // F8 DESCUENTO
    {
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frmmodificar_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frmmodificar_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista_modventa.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frmmodificar_venta.txtdescripcion_productomoddescuento.value=data1;
						//document.frmmodificar_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongdescuento').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongdescuento').on('shown.bs.modal', function () {
							   $("#txtdescuento_productomoddesc").focus();
							});
						document.frmmodificar_venta.txtdescuento_productomoddesc.select();
						}
						
				}
			});
		  }	
    }
    else if(tecla==113) // F2 COBRAR
    {
	  $('#exampleModalLongcobrar').modal()
	  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
	             $("#txtimporte_recibido").focus();
	          });
	  document.frmmodificar_venta.txtimporte_recibido.select();
	}
    else if(tecla==120) // F9 RETIRAR
    {
	  $('#exampleModalLongretirar').modal()
	  $('#exampleModalLongretirar').on('shown.bs.modal', function () {
	             $("#txtmotivo_retiro").focus();
	          });
    }
     else if(tecla==114) // F3 OPERACION
    {
	  $('#exampleModalLongoperacion').modal()
	  $('#exampleModalLongoperacion').on('shown.bs.modal', function () {
	             $("#txtoperacion").focus();
	          });
    }
    else if(tecla==117) // F6 CLIENTES
    {
	  $('#exampleModalLongclientes').modal()
	  $('#exampleModalLongclientes').on('shown.bs.modal', function () {
	             $("#txtcliente").focus();
	          });
    }  
    else if(tecla==17) // TECLA CONTROL CTRL
    {
      $('#exampleModalLongdescuentotodo').modal()
 	  $('#exampleModalLongdescuentotodo').on('shown.bs.modal', function () {
             $("#txtdescuento_todo").focus();
          });
  		document.frmmodificar_venta.txtdescuento_todo.select();
    }
}

function modificar_descuento_todo(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtdescuento_todo=document.frm_nueva_venta.txtdescuento_todo.value;
  		var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;

  		if(isNaN(txtdescuento_todo))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_descuento_todo.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
						}
					}
				});
			}
	}	
}

function modificar_descuento_todo_modificacion(e,cantidad) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  	{
  		var txtdescuento_todo=document.frmmodificar_venta.txtdescuento_todo.value;
  		var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;

  		if(isNaN(txtdescuento_todo))
		{  
		alert("Lo que capturo en DESCUENTO NO ES UN NUMERO");
		}
		else
			{
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frmmodificar_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/modificar_descuento_todo_modificacion.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+'&id_venta='+0;	
						}
					}
				});
			}
	}	
}

function activar_venta_directa(valor)
{
	var valor=valor;
	//alert(valor);
	document.frm_nueva_venta.txtventa_directa.value=valor;
	var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
	var str = $("#frm_nueva_venta").serialize();
						//var str = id_marca;
						//alert(str);
						$.ajax({
						 
						url: '../php/activa_venta_directa.php',
						data: str,
						type: 'post',
						success: function(data){

							//alert(data);
							//var datatotal=data.split(",");
							//var data0=datatotal[0];
							//var data=datatotal[1];
							
							if(data=="Y")
							{	
								document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
							}
							else
							{	
								document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa;	
							}				
						}
					});							
}

function imprimir_vent_listado_merma(id_venta,folioidventa){	
  var idventa=id_venta;
  var folioidventa=folioidventa;
  var idultimaventa=id_venta;
 var ventana1;
 var ventana3;
 ventana1 = window.open('../reportes/tcpdf/examples/imprimir_venta.php?idultimaventa=' + idultimaventa + '&folioidventa=' + folioidventa + '&idventa=' + idventa, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  

/*setTimeout(function(){ ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa + '&folioidventa=' + folioidventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes');  },5000);
setTimeout(function(){ ventana1.close(); ventana3.close(); },9000);*/

//ventana3 = window.open('../reportes/tcpdf/examples/imprimir_venta2.php?id_venta=' + idventa, 'ventana3' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 
//setTimeout(function(){ ventana3.close(); },5000);
 /* window.print();
  console.log("Imprimir...");
  window.close();

  window.open('../reportes/tcpdf/examples/imprimir_venta.php?id_venta=' + data1, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');
						document.location.href = "ventas.php";*/
}

function modificar_cantidad_click(id_producto_venta,cantidad)
{
	var id_producto=id_producto_venta;
	var cantidad=cantidad;
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			 {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomodm.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongmod').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongmod').on('shown.bs.modal', function () {
							   $("#txtcantidad_productomodm").focus();
							});
						//document.getElementById("txtcantidad_productomodm").selectionEnd = 0;
						document.frm_nueva_venta.txtcantidad_productomodm.select();
						}
						//
				}
			});
		  }	
}

function modificar_precio_click(id_producto_venta,precio)
{
	var id_producto=id_producto_venta;
	var precio=precio;
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			{
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomodprecio.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongprecio').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongprecio').on('shown.bs.modal', function () {
							   $("#txtprecio_productomodprec").focus();
							});
						document.frm_nueva_venta.txtprecio_productomodprec.select();
						}
						
				}
			});
		  }	
}

function modificar_descuento_click(id_producto_venta,descuento)
{
	var id_producto=id_producto_venta;
	var descuento=descuento;
        //mostrarmodal_modificar();
        var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_venta.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			    {
				//alert("entro");
				var str = $("#frm_nueva_venta").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlista.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_venta.txtdescripcion_productomoddescuento.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongdescuento').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongdescuento').on('shown.bs.modal', function () {
							   $("#txtdescuento_productomoddesc").focus();
							});
						document.frm_nueva_venta.txtdescuento_productomoddesc.select();
						}
						
				}
			});
		  }	
}

function buscar_producto_comprar_desc_codbarras(cadbus)
{
  if(isNaN(cadbus))
  	{
  		var descripcion_producto_mod=document.frm_nueva_compra.txtproductodesc.value;	
  			
		if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
		{  
		alert("No ha seleccionado ningun producto1");
		}
	  else
			{
			var str = $("#frm_nueva_compra").serialize();
			$.ajax({
			 
			url: '../php/buscar_producto_venta_mod.php',
			data: str,
			type: 'post',
			success: function(data){
	
				//alert(data);
				//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
				var datatotal=data.split(",");
				var data0=datatotal[0];
				var data1=datatotal[1];
				var data2=datatotal[2];
				var data3=datatotal[3];	
				var data4=datatotal[4];			
				var data5=datatotal[5];	
				var data6=datatotal[6];			
				var data7=datatotal[7];	
				var data8=datatotal[8];
				
				if(data0==0)
				{	
				alert("No se encuentra el producto buscado");
				}
				else
				{	
				document.frm_nueva_compra.txtid_productomodcom.value=data1;
				document.frm_nueva_compra.txtdescripcion_productomodcom.value=data3;
				document.frm_nueva_compra.txtexistencia_productomodcom.value=data5;
				document.frm_nueva_compra.txtprecio_venta_modcom.value=data4;
				document.frm_nueva_compra.txtprecio_compra_modcom.value=data8;
				document.frm_nueva_compra.txtnuevo_precio_compra_modcom.value=data8;
				//alert("focus");
				//document.getElementById("txtdescuento_productomod").focus();
				$('#exampleModalLong_compra').modal();
				//$("#txtdescuento_productomod").focus();
				$('#exampleModalLong_compra').on('shown.bs.modal', function () {
					   $("#txtcantidad_productomodcom").focus();
					});
				document.frm_nueva_compra.txtcantidad_productomodcom.select();
				}
			}
		});
	  }
  	}
  else
  	{
		  			var cb_producto=document.frm_nueva_compra.txtproductodesc.value;	

						if(cb_producto == "" || cb_producto ==0 || cb_producto==null)
						{  
						alert("No ha seleccionado ningun producto2");
						document.frm_nueva_compra.txtproductodesc.focus();		
						}
					  else
						{
						var str = $("#frm_nueva_compra").serialize();
						$.ajax({
						 
						url: '../php/buscar_producto_venta_cb.php',
						data: str,
						type: 'post',
						success: function(data){
				
							//alert(data);
							//echo "1,".$id_producto_buscar.",".$codigo_barras.",".$descripcion.",".$precio_venta.",".$cantidad_existencia;		
							var datatotal=data.split(",");
							var data0=datatotal[0];
							var data1=datatotal[1];
							var data2=datatotal[2];
							var data3=datatotal[3];	
							var data4=datatotal[4];			
							var data5=datatotal[5];	
							var data6=datatotal[6];			
							var data7=datatotal[7];	
							var data8=datatotal[8];
							
							if(data0==0)
							{	
							alert("No se encuentra el producto buscado");
							}
							else
							{	
							document.frm_nueva_compra.txtid_productomodcom.value=data1;
							document.frm_nueva_compra.txtdescripcion_productomodcom.value=data3;
							document.frm_nueva_compra.txtexistencia_productomodcom.value=data5;
							document.frm_nueva_compra.txtprecio_venta_modcom.value=data4;
							document.frm_nueva_compra.txtprecio_compra_modcom.value=data8;
							document.frm_nueva_compra.txtnuevo_precio_compra_modcom.value=data8;
							//alert("focus");
							//document.getElementById("txtdescuento_productomod").focus();
							$('#exampleModalLong_compra').modal();
							//$("#txtdescuento_productomod").focus();
							$('#exampleModalLong_compra').on('shown.bs.modal', function () {
								   $("#txtcantidad_productomodcom").focus();
								});
							document.frm_nueva_compra.txtcantidad_productomodcom.select();
							}
						}
					});
				  }
  	}	
}

function eliminar_producto_compra(id_producto_compra)
{
	if (confirm("\xBFDesea eliminar el producto?"))
	{
		document.frm_nueva_compra.txtid_producto_buscar.value=id_producto_compra;
		var id_producto_compra_eliminar=document.frm_nueva_compra.txtid_producto_buscar.value;
		
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
				//document.location.href = document.location.href;	
				document.location.href ="nueva_compra.php";
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href ="nueva_compra.php";
				}				
			}
		});
	  }	
	}	
}

function modificar_cantidad_comprada_click(id_producto_compra,cantidad)
{
	var id_producto=id_producto_compra;
	var cantidad=cantidad;
        //mostrarmodal_modificar();
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_compra.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			 {
				//alert("entro");
				var str = $("#frm_nueva_compra").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlistacomprado.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_compra.txtdescripcion_productomodm.value=data1;
						//document.frm_nueva_venta.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongmod').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongmod').on('shown.bs.modal', function () {
							   $("#txtcantidad_productomodm").focus();
							});
						//document.getElementById("txtcantidad_productomodm").selectionEnd = 0;
						document.frm_nueva_compra.txtcantidad_productomodm.select();
						}
						//
				}
			});
		  }	
}

function modificar_precio_compra_click(id_producto_compra,precio_compra)
{
	var id_producto=id_producto_compra;
	var precio=precio_compra;
        //mostrarmodal_modificar();
        //var id_fila=document.frm_nueva_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frm_nueva_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
        document.frm_nueva_compra.txtidproductonavegando.value=id_producto;
        //alert(id_producto);

	        if(id_producto == "" || id_producto ==0 || id_producto==null)
			{  
			alert("No hay ningun producto");
			}
		  else
			{
				//alert("entro");
				var str = $("#frm_nueva_compra").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/buscar_producto_enlistacomprado.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];

						if(data0==0)
						{	
						alert("EL PRODUCTO NO EXISTE");
						}
						else
						{	
						//document.location.href ="nueva_venta.php";
						document.frm_nueva_compra.txtdescripcion_productomodprecio.value=data1;
						//document.frm_nueva_compra.txtcantidad_productomodm.value=data2;
						$('#exampleModalLongprecio').modal();
						//$("#txtdescuento_productomod").focus();
						$('#exampleModalLongprecio').on('shown.bs.modal', function () {
							   $("#txtprecio_productomodprec").focus();
							});
						document.frm_nueva_compra.txtprecio_productomodprec.select();
						}
						
				}
			});
		  }	
}

function agregar_cantidad_producto_buscado(e,cantidad,id_producto)
{
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==13)
	{
	var cantidad=cantidad;
	var id_producto=id_producto;
	document.frm_nueva_venta.txtid_producto.value=id_producto;
	document.frm_nueva_venta.txtcantidad_productobuslis.value=cantidad;
					//alert("entro");
//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_venta").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/agregar_cantidad_producto_buscado.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);
						var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];				

						if(data0==null)
						{	
						alert("Error al guardar el producto");
						}
						else{	

							/* var obj = JSON.parse(data);
						     console.log(obj);
						     $('#exampleModalLong').modal('hide');
						     $('#listProd').append(
						     	+'<tr>'
                                +'<td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta('+ obj.id_producto +');" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>'
                                +'<td class="mailbox-subject" id="list_descp"><b>'+ obj.descripcion +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_cant"><b>'+ obj.cantidad +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_precio"><b>'+ obj.precio_venta +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_desc"><b>' + obj.descuento +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_neto"><b>' + obj.precio_neto +'</b></td>'
                          		+'<td class="mailbox-subject" id="list_subt"><b>' + obj.importe +'</b></td>'
                        		+'</tr>');*/
                        	 document.location.href='nueva_venta.php?id_area_venta='+data1;
						  }
						}
				});
	}
}

function agregar_cantidad_producto_buscado_compra(e,cantidad,id_producto)
{
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==13)
	{
	var cantidad=cantidad;
	var id_producto=id_producto;
	document.frm_nueva_compra.txtid_producto.value=id_producto;
	document.frm_nueva_compra.txtcantidad_productobuslis.value=cantidad;
					//alert("entro");
					//var str = $("#frm_lista_productos_buscar").serialize();
					var str = $("#frm_nueva_compra").serialize();
					//alert(str);
					$.ajax({
					 
					url: '../php/agregar_cantidad_producto_buscado_compra.php',
					data: str,
					type: 'post',
					success: function(data){
			
						//alert(data);				
						if(data==0)
						{	
						alert("Error al guardar el producto");
						}
						else(data==1)
						{	
						//self.frames['principal'].location.href = '../seguridad/nuevo_usuario.php';
						//location.href="http://127.0.0.1/siscoh/panel_principal.php";
						document.location.href = "nueva_compra.php";	
						}
					}
				});
	}
}

function agregar_cantidad_producto_buscado_inventario(e,cantidad,id_producto)
{
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==13)
	{
	var cantidad=cantidad;
	var id_producto=id_producto;
	document.frm_nuevo_actualizacion_inventario.txtid_producto.value=id_producto;
	document.frm_nuevo_actualizacion_inventario.txtcantidad_productobuslis.value=cantidad;
					//alert("entro");
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../mantenimiento/agregar_cantidad_producto_buscado_inventario.php',
			data: str,
			type: 'post',
			success: function(data){

				//alert(data);

				//document.frm_modificar_marca.txtcadena.value=data;
				//alert("La cantidad en existencia del producto ha sido modificado");
				document.location.href ="inventariosfisico.php";
			}
		});
	}
}

function eliminar_producto_inventario_fisico(id_producto_compra)
{
	if (confirm("\xBFDesea eliminar el producto?"))
	{
		document.frm_nuevo_actualizacion_inventario.txtid_producto_buscar.value=id_producto_compra;
		var id_producto_inventario_eliminar=document.frm_nuevo_actualizacion_inventario.txtid_producto_buscar.value;
		
		if(id_producto_inventario_eliminar == "" || id_producto_inventario_eliminar ==0 || id_producto_inventario_eliminar==null)
		{  
		alert("No ha seleccionado el producto a eliminar");
		}
	  else
		    {
			//alert("entro");
			var str = $("#frm_nuevo_actualizacion_inventario").serialize();
			//var str = id_marca;
			//alert(str);
			$.ajax({
			 
			url: '../php/baja_producto_inventario_fisico.php',
			data: str,
			type: 'post',
			success: function(data){

				alert(data);
				
				if(data=="Y")
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href ="inventariosfisico.php";
				}
				else
				{	
             	//alert("La marca ha sido eliminada");
				//document.location.href = document.location.href;	
				document.location.href ="inventariosfisico.php";
				}				
			}
		});
	  }	
	}	
}

function guardar_numero_folio_iniciar()
{
	var numerofolio=document.frm_principal.txtnumero_folioiniciar.value;
	if(numerofolio == "" || numerofolio ==0 || numerofolio==null)
			{  
			alert("EL numero de folio debe ser mayor a 0");
			}
		  else
			{
				//alert("entro");
				var str = $("#frm_principal").serialize();
				//var str = id_marca;
				alert(str);
				$.ajax({
				 
				url: 'php/guardar_numero_folio_iniciar.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						/*var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];*/

						if(data==0)
						{	
						alert("Error al actualizar el numero de folio");
						}
						else
						{	
						document.location.href ="panel_principal.php";
						}
						
				}
			});
		  }	
}

function calcular_precio_venta_porcentaje()
{
	var valor_porcentaje=document.frm_alta_producto_inventario.txtporcentaje_ganancia.value;
	var txtprecio_compra=document.frm_alta_producto_inventario.txtprecio_compra.value;
	var precioventasr;
	var precioventa;
	if(valor_porcentaje == "" || valor_porcentaje ==0 || valor_porcentaje==null)
			{  
			alert("El porcentaje de ganancia debe ser mayor a 0");
			$("#txtporcentaje_ganancia").focus();
			}
	else if(txtprecio_compra == "" || txtprecio_compra ==0 || txtprecio_compra==null)
			{  
			alert("El precio de compra debe ser mayor a 0");
			$("#txtprecio_compra").focus();
			}
	else
			{
				porcganan=(parseInt(txtprecio_compra)*parseInt(valor_porcentaje))/100;
				precioventasr=parseInt(txtprecio_compra)+parseInt(porcganan);
				//parseFloat(Math.round(278.6 * 100) / 100).toFixed(2);
				precioventa=parseFloat(precioventasr).toFixed(2);
				document.frm_alta_producto_inventario.txtprecio_venta.value=precioventa;
			}
}

function calcular_precio_venta_porcentaje_mod()
{
	var valor_porcentaje=document.frm_modificar_producto_inventario.txtporcentaje_ganancia.value;
	var txtprecio_compra=document.frm_modificar_producto_inventario.txtprecio_compra.value;
	var precioventasr;
	var precioventa;
	if(valor_porcentaje == "" || valor_porcentaje ==0 || valor_porcentaje==null)
			{  
			alert("El porcentaje de ganancia debe ser mayor a 0");
			$("#txtporcentaje_ganancia").focus();
			}
	else if(txtprecio_compra == "" || txtprecio_compra ==0 || txtprecio_compra==null)
			{  
			alert("El precio de compra debe ser mayor a 0");
			$("#txtprecio_compra").focus();
			}
	else
			{ 
				porcganan=(parseInt(txtprecio_compra)*parseInt(valor_porcentaje))/100;
				precioventasr=parseInt(txtprecio_compra)+parseInt(porcganan);
				//precioventa=Math.round(precioventasr);
				precioventa=parseFloat(precioventasr).toFixed(2);
				document.frm_modificar_producto_inventario.txtprecio_venta.value=precioventa;
			}
}

function actualizar_aviso()
{
				///alert("entro");
				var str = $("#frm_nuevo_aviso").serialize();
				//var str = id_marca;
				//alert(str);
				$.ajax({
				 
				url: '../php/actualizar_aviso_ticket.php',
				data: str,
				type: 'post',
				success: function(data){
						//alert(data);

						/*var datatotal=data.split(",");
						var data0=datatotal[0];
						var data1=datatotal[1];
						var data2=datatotal[2];*/

						if(data==0)
						{	
						alert("Error al actualizar el aviso");
						}
						else
						{	
						alert("El aviso se ha guardado correctamente");
						document.location.href ="../panel_principal.php";
						}
						
				}
			});
}