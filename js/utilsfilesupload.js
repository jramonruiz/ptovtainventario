var vault = null;
function doOnLoad() {
            preLoadImages();
            vault = new dhtmlXVaultObject();
            vault.setServerHandlers( pathfiles + "UploadHandler.php", pathfiles + "GetInfoHandler.php", pathfiles + "GetIdHandler.php");
            vault.create("vault1");
			//alert("handlers: " + pathfiles + "UploadHandler.php");
	}

function preLoadImages(){
		var imSrcAr = new Array("btn_add.gif","btn_clean.gif","btn_upload.gif","ico_file.png","ico_image.png","ico_sound.png","ico_video.png","ico_zip.png","pb_back.gif","pb_demoUload.gif","pb_empty.gif");
		var imAr = new Array(0);
		for(var i=0;i<imSrcAr.length;i++){
			imAr[imAr.length] = new Image();
			imAr[imAr.length-1].src = pathfiles + "imgs/" +imSrcAr[i];
		}
	}
