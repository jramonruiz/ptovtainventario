function corte_caja_diario_resumen()
{	
window.open('../reportes/tcpdf/examples/rptcorte_caja_diario_resumen.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value + "&usuario_imprimir=" + document.getElementById('txtnombre_usuario').value + "&id_usuario=" + document.getElementById('txtid_usuario').value + "&descripcion_caja=" + document.getElementById('txtdescripcion_caja').value + "&descripcion_sucursal=" + document.getElementById('txtdescripcion_sucursal').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_productos_faltantes(id_sucursal,id_usuario)
{
	var id_sucursal=id_sucursal;
	var id_usuario=id_usuario;
window.open('reportes/tcpdf/examples/rptproductos_faltantes.php?id_sucursal='+id_sucursal+'&id_usuario='+id_usuario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 				
//window.open('reportes/examples/rptproductos_faltantes.php?id_sucursal='+id_sucursal+'&id_usuario='+id_usuario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');         
}

function imprimir_inventario_fisico(id_inventario,id_sucursal,id_usuario)
{
  var id_inventario=id_inventario;
  var id_sucursal=id_sucursal;
  var id_usuario=id_usuario;
window.open('reportes/tcpdf/examples/rptreporte_inventario_fisico.php?id_inventario='+id_inventario+'&id_sucursal='+id_sucursal+'&id_usuario='+id_usuario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_articulos(id_sucursal,id_usuario)
{
	var agruparpor=document.frm_reporte_articulos.cmbagrupacion.value;	
  	var id_usuario=id_usuario;	
  	var id_sucursal=id_sucursal;	
  	window.open('../reportes/tcpdf/examples/rptreporte_articulos.php?agruparpor='+agruparpor+'&id_sucursal='+id_sucursal+'&id_usuario='+id_usuario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_compras(id_sucursal,id_usuario)
{
	var agruparpor=document.frm_reporte_compras.cmbagrupacion.value;	
  	var id_usuario=id_usuario;	
  	var id_sucursal=id_sucursal;	
  	window.open('../reportes/tcpdf/examples/rptreporte_compras.php?agruparpor='+agruparpor+'&id_sucursal='+id_sucursal+'&id_usuario='+id_usuario+'&fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_comprobantes(id_sucursal,id_usuario)
{
	var comprobante=document.frm_reporte_comprobantes.cmbcomprobante.value;	
  	var id_usuario=id_usuario;	
  	var id_sucursal=id_sucursal;	
  	window.open('../reportes/tcpdf/examples/rptreporte_comprobantes.php?comprobante='+comprobante+'&id_sucursal='+id_sucursal+'&id_usuario='+id_usuario+'&fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function reporte_valor_inventario(id_sucursal,id_usuario)
{
	var ordenarpor=document.frm_reporte_valor_inventario.cmbordenarpor.value;	
  	var id_usuario=id_usuario;	
  	var id_sucursal=id_sucursal;	
  	window.open('../reportes/tcpdf/examples/rptreporte_valor_inventario.php?ordenarpor='+ordenarpor+'&id_sucursal='+id_sucursal+'&id_usuario='+id_usuario, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes'); 			
}

function codigo_barras_producto_generar()
{
    var txtproductodesc=document.frmgenerador_codigo_barras.txtproductodesc.value;  
    var barcode=document.frmgenerador_codigo_barras.barcode.value;  
    var txtnumero_copias=document.frmgenerador_codigo_barras.txtnumero_copias.value;  

    if(txtproductodesc == "" || txtproductodesc ==0 || txtproductodesc==null)
    {  
    alert("No ha escrito el producto");
    }
    else if(isNaN(barcode))
    {  
    alert("NO SE HA GENERADO EL CODIGO DE BARRAS");
    }
    else
        {
            //alert("entro");
            /*var str = $("#frmgenerador_codigo_barras").serialize();
            alert(str);
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
          });*/
          window.open('reportebarcode/examples/example_027_.php?producto='+txtproductodesc+'&codigobarras='+barcode+'&numerocopias='+txtnumero_copias, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');       
      } 
}

function buscar_barcode_producto(e) {
  //alert("entro");
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
    {
    var descripcion_producto_mod=document.frmgenerador_codigo_barras.txtproductodesc.value;  
  
    if(descripcion_producto_mod == "" || descripcion_producto_mod ==0 || descripcion_producto_mod==null)
    {  
    alert("No ha seleccionado ningun producto");
    }
    else
      {
      var str = $("#frmgenerador_codigo_barras").serialize();
      $.ajax({
       
      url: 'php/buscar_barcode_producto.php',
      data: str,
      type: 'post',
      success: function(data){
  
        //alert(data);
        //echo "1,".$codigo_barras;   
        var datatotal=data.split(",");
        var data0=datatotal[0];
        var data1=datatotal[1];
        
        if(data0==0)
        { 
        alert("Error al buscar el producto");
        }
        else(data0==1)
        { 
        document.frmgenerador_codigo_barras.barcode.value=data1;
        //document.location.href = "barcodes.php?barcode="+data1;  
        }
      }
    });
    }
  }
}

function reporte_desglose_notas()
{ 
window.open('../reportes/tcpdf/examples/rpt_desglose_notas.php?fecha_inicial=' + document.getElementById('datepicker1').value + "&fecha_final=" + document.getElementById('datepicker2').value + "&usuario_imprimir=" + document.getElementById('txtnombre_usuario').value + "&id_usuario=" + document.getElementById('txtid_usuario').value + "&descripcion_caja=" + document.getElementById('txtdescripcion_caja').value + "&descripcion_sucursal=" + document.getElementById('txtdescripcion_sucursal').value + "&id_sucursal=" + document.getElementById('txtid_sucursal').value, 'ventana1' ,'left=10,top=10,width=900,height=600,scrollbars=yes');      
}

function modificar_cantidad_click_modificacion_venta(id_producto_venta,cantidad)
{
  var id_producto=id_producto_venta;
  var cantidad=cantidad;
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
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
            alert(data);

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
            //document.getElementById("txtcantidad_productomodm").selectionEnd = 0;
            document.frmmodificar_venta.txtcantidad_productomodm.select();
            }
            //
        }
      });
      } 
}

function modificar_precio_click_modificacion_venta(id_producto_venta,precio)
{
  var id_producto=id_producto_venta;
  var precio=precio;
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
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

function modificar_descuento_click_modificacion_venta(id_producto_venta,descuento)
{
  var id_producto=id_producto_venta;
  var descuento=descuento;
        //mostrarmodal_modificar();
        var id_fila=document.frmmodificar_venta.txtidfila.value;
        //var nomidpp="idpp"+id_fila;
        //var id_producto=document.frmmodificar_venta.+nomidpp+.value;
        //var id_producto=document.getElementById("idpp"+id_fila).value;
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