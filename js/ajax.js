function lightboxjax(url,id){
	//document.getElementById(id).style.display="none";
	ajax(url, 'successmessage');
}

///////////////////////////////ajax chk//////////////
var xmlHttp;
function ajax(url, displayitem){ 
	
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null){
		alert ("Your browser does not support AJAX!");
		return;
	} 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=function stateChanged() { 
									if (xmlHttp.readyState==4){	
										if(xmlHttp.responseText!=''){
											document.getElementById(displayitem).innerHTML=xmlHttp.responseText;
										}
									}
								}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}


function GetXmlHttpObject(){
var xmlHttp=null;
	try  {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
  	}
	catch (e){
		// Internet Explorer
  		try{
    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}
		catch (e){
    		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}
  	}
	return xmlHttp;
}



/*following function calls to show any type of validation in any form*/
function dynamic_form_validation(form_object) {
	
	/*fetching the total number of elements from form*/
	total_elements = (form_object.elements.length);
    
	var email_check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	
	/*running loop to check the elements of form one by one*/
	for(var element_count=0; element_count<total_elements; element_count++) {
			
		/*storing element object*/
		var element_object=form_object.elements[element_count];
		
		/*storing element name*/
		var element_id=element_object.id;		
		
		/*storing element value*/
		var element_value=chktrim(element_object.value);		
		
		/*storing element type*/
		var element_type=element_object.type;		
		/*spliting the element namer*/
		var array_split=element_id.split("_");	
		
		
			
		//alert(element_object+', '+element_id+', '+element_value+', '+element_type+', '+array_split[0]);
		if(array_split[0].indexOf('req')!=-1){
			
			if(element_type=='select-one'){
				if (element_object.options[element_object.selectedIndex].value=="")  {
					alert(array_split[2]);
					element_object.focus();
					return false;
				}
			}
			else if(element_type=='checkbox'){
				if (element_object.checked == false)  {
					alert(array_split[2]);
					element_object.focus();
					return false;
				}
			}
			else{
				if(element_id.indexOf('_tinyMCE')!=-1){
					tinyMCE.triggerSave(true,true);
						var mytextarea = tinyMCE.activeEditor.getContent();
					if(trimspaces(mytextarea)==''){
						alert(split_title[2]);	
						//formElem.focus();
						return false;
					}
				}
				else if(element_value.length<1){
					alert(array_split[2]);
					element_object.focus();
					return false;
				}
				else if(element_id.indexOf('_img')!=-1){
					if(element_value.indexOf('.png')==-1 && element_value.indexOf('.gif')==-1 && element_value.indexOf('.jpg')==-1 && element_value.indexOf('.jpeg')==-1){
						alert(array_split[2]);
						element_object.focus();
						return false;
					}
				}else if(element_id.indexOf('_alpha')!=-1){
					var alpha_check = /^([a-zA-Z\s])+$/;
					if(!alpha_check.test(element_value)){
						alert(array_split[2]);
						element_object.focus();
						return false;
					}
				}else if(element_id.indexOf('_Email-id')!=-1){
					if(!email_check.test(element_value)){
						alert(array_split[2]);
						element_object.focus();
						return false;
					}					
				}
				else if(element_id.indexOf('_int_')!=-1){
					if(!parseInt(element_value)){
						alert("Please enter only integer value");
						element_object.focus();
						return false;
					}
				}else if(element_id.indexOf('_web_')!=-1){
					var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
					if(!urlregex.test(element_value)){	
						alert("Please enter correct website name for ex. http://www.example.com");
						element_object.focus();
						return false;
					}
				}else if(array_split[1].indexOf('length')!=-1){
					var array_split2=array_split[1].split("-");
					if(array_split2[1]>element_value.length || array_split2[2]<element_value.length){
						alert('Password length should be between '+array_split2[1]+' to '+array_split2[2]+' characters');
						element_object.focus();
						return false;
					}
				}else if(element_id.indexOf('_match_')!=-1){
					if(array_split[3]!='req'){
						var fldname=array_split[3];
					}else{
						var fldname=array_split[3]+'_'+array_split[4]+'_'+array_split[5];
					}
					if(element_value!=document.getElementById(fldname).value){
						alert(array_split[2]);
						//element_object.value='';
						element_object.focus();
						return false;
					}
				}
			}
		}
	}
}
function chktrim(inputString) {
     if (typeof inputString != "string") { return inputString; }
     var retValue = inputString;
     var ch = retValue.substring(0, 1);
     while (ch == " ") { 
       retValue = retValue.substring(1, retValue.length);
       ch = retValue.substring(0, 1);
     } 
     ch = retValue.substring(retValue.length-1, retValue.length);
     while (ch == " ") { 
        retValue = retValue.substring(0, retValue.length-1);
        ch = retValue.substring(retValue.length-1, retValue.length);
     }
     while (retValue.indexOf("  ") != -1) { 
        retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length); // Again, there are two spaces in each of the strings
     }
     return retValue; 
}
function defultvalue(myval,defultval,blr){
	if(blr=='Y'){
		if(myval.value=='')
			myval.value=defultval;
	} else{
		if(myval.value==defultval)
			myval.value='';
	}
	var error=myval.name.replace('shall_','error_');
	document.getElementById(error).innerHTML='';
}
function displayHideBox(boxNumber,url){
    if(document.getElementById("LightBox"+boxNumber).style.display=="none") {
        document.getElementById("LightBox"+boxNumber).style.display="block";
        document.getElementById("grayBG").style.display="block";
    } else {
        document.getElementById("LightBox"+boxNumber).style.display="none";
        document.getElementById("grayBG").style.display="none";
    }
    document.deletelightboxfrm.action=url;
}
