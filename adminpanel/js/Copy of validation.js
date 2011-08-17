// JavaScript Document

var arVersion = navigator.appVersion.split("MSIE")
var version = parseFloat(arVersion[1])

function fixPNG(myImage)
{
   if ((version >= 5.5) && (version < 7) && (document.body.filters))
   {
      var imgID = (myImage.id) ? "id='" + myImage.id + "' " : ""
   var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : ""
   var imgTitle = (myImage.title) ?
              "title='" + myImage.title  + "' " : "title='" + myImage.alt + "' "
   var imgStyle = "display:inline-block;" + myImage.style.cssText
   var strNewHTML = "<span " + imgID + imgClass + imgTitle
                 + " style=\"" + "width:" + myImage.width
                 + "px; height:" + myImage.height
                 + "px;" + imgStyle + ";"
                 + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
                 + "(src=\'" + myImage.src + "\', sizingMethod='scale');\"></span>"
   myImage.outerHTML = strNewHTML     }
}

function Global_validate(obj)
  {
    var len=obj.length;
	for(i=0;i<len;i++)
	  {
	    if(obj.elements[i].title!='' && obj.elements[i].value=='' && obj.elements[i].disabled==false)
		  {
		    alert(obj.elements[i].title);
			obj.elements[i].focus();
			return false;
		  }
	  }
	return true;
  }
    function survey_filter_submit_frm(what)
{
	var survey_filter_val=what.value;
	
	location.href=("./?pulse=5&pi=4&pr_filter_id="+survey_filter_val);
}
  		function trimspaces(str)
		{
			while((str.indexOf(' ',0) == 0) && (str.length > 1))
			{
				str = str.substring(1, str.length);
			}
			while((str.lastIndexOf(' ') == (str.length - 1) && (str.length > 1)))
			{
				str = str.substring(0,(str.length - 1));
			}
			if((str.indexOf(' ',0) == 0) && (str.length == 1)) str = '';
			return str;
		}
		  
		function validate_form(Obj)
		{
				for ( i = 0; i < Obj.elements.length; i++) {
						formElem = Obj.elements[i];
						//alert(formElem.type);
						//alert(formElem.value);
						
						switch (formElem.type) {
								case 'text':
								case 'password':
								case 'select-one':
								case 'textarea':
								case 'file':
								case 'checkbox':
								case 'select-multiple':
										split_title=formElem.title.split("::");

										if(split_title[0]!='' && trimspaces(formElem.value)=='' && split_title[0]!='ImageFile' && split_title[0]!='docFile' && split_title[0]!='Description'){
											alert(split_title[1]);
											formElem.focus();
											return false;
										}
										
										if(split_title[0]=='Pincode'){
											if (/^[0-9]+$/.test(formElem.value)){
											}else{
												alert('Pincode contain only numeric values.');
												formElem.focus();
												return false;
											}
										}
										if(split_title[0]=='Start Code'){
											if (/^[0-9]+$/.test(formElem.value)){
											}else{
												alert('Start Code contain only numeric values.');
												formElem.focus();
												return false;
											}
										}
										if(split_title[0]=='End Code'){
											if (/^[0-9]+$/.test(formElem.value)){
											}else{
												alert('End Code contain only numeric values.');
												formElem.focus();
												
												return false;
											}
											if(document.getElementById('txtStartCode').value>=document.getElementById('txtEndCode').value ){
												alert("Please enter start value less than end value.");
												return false;
											}
											
										}
										if(split_title[0]=='Fill36' && (trimspaces(formElem.value)=='select' || trimspaces(formElem.value)=='0')){
										if(trimspaces(formElem.value)==0){
											return true;
										}
										alert(split_title[1]);
										formElem.focus();
										return false;
										}
										
										if(split_title[0]=='Phone')
										{
											if(trimspaces(formElem.value)=='')
											{
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
											if (/^[0-9\-]{6,20}$/.test(formElem.value)){
												}else{
												alert('Please enter valid phone number.');
												formElem.focus();
												return false;	
											}
										}
										if(split_title[0]=='Mobile')
										{
											if(trimspaces(formElem.value)=='')
											{
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
											if (/^[0-9\-]{6,20}$/.test(formElem.value)){
												}else{
												alert('Please enter valid mobile.');
												formElem.focus();
												return false;	
											}
										}
										if(split_title[0]=='Code'  && isNaN(formElem.value)){
											alert('Please enter numeric value for code.');
											formElem.focus();
											return false;
										}
										
										if(split_title[0]=='Phone1' ){
											if(trimspaces(formElem.value)=='')
											{
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
											if (/^\d{3}-\d{3}-\d{4}$/.test(formElem.value)){
												}else{
													alert('Please enter valid phone number.');
													formElem.focus();
													return false;
											}
										}
										if(split_title[0]=='Email' ){
											if(trimspaces(formElem.value)=='')
											{
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
											if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(formElem.value)){
												}else{
													alert('Invalid E-mail Address, Please re-enter.');
													formElem.focus();
													return false;
											}
										}
										if(split_title[0]=='Confirm Email' ){
											if(trimspaces(formElem.value)!=''){
												
												if(document.getElementById('confirmEmail').value!=document.getElementById('email').value ){
													alert("Email and confirm email does not match.");
													return false;
												}
											}else {
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
										}
										if(split_title[0]=='PayPal Id' ){
											if(trimspaces(formElem.value)=='')
											{
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
											if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(formElem.value)){
												}else{
													alert('Invalid PayPal Id, Please re-enter.');
													formElem.focus();
													return false;
											}
										}
										if(split_title[0]=='Password' && trimspaces(formElem.value)==''){
											alert(split_title[1]);
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Password' ){
											if(formElem.value !='')
											{
												var strLength = formElem.value.length;
												var spaceindex = formElem.value.lastIndexOf(' ');
												if(strLength < 6)
												{
													alert("Please enter password of at least 6 characters.");
													formElem.focus();
													return false;
												}
												if(spaceindex!='-1')
												{
													alert("Please remove space from password");
													formElem.focus();
													return false;
												}
											}
										}
										if(split_title[0]=='OldPassword' && trimspaces(formElem.value)==''){
										alert(split_title[1]);
										formElem.focus();
										return false;
										}
										if(split_title[0]=='OldPassword' ){
											if(formElem.value !='')
											{
												var strLength = formElem.value.length;
												var spaceindex = formElem.value.lastIndexOf(' ');
												if(strLength < 6)
												{
													alert("Please enter old password of at least 6 characters.");
													formElem.focus();
													return false;
												}
												if(spaceindex!='-1')
												{
													alert("Please remove space from old password.");
													formElem.focus();
													return false;
												}
											}
										}
										if(split_title[0]=='NewPassword' && trimspaces(formElem.value)==''){
											alert(split_title[1]);
											formElem.focus();
											return false;
										}
										if(split_title[0]=='NewPassword' ){
											if(formElem.value !='')
											{
												var strLength = formElem.value.length;
												var spaceindex = formElem.value.lastIndexOf(' ');
												if(strLength < 6)
												{
													alert("Please enter new password of at least 6 characters.");
													formElem.focus();
													return false;
												}
												if(spaceindex!='-1')
												{
													alert("Please remove space from new password.");
													formElem.focus();
													return false;
												}
											}
										}
										if(split_title[0]=='ConfirmPassword' ){
											if(trimspaces(formElem.value)!=''){
												if(document.getElementById('txtConfirmPassword').value!=document.getElementById('txtNewPassword').value ){
													alert("New password and confirm password does not match.");
													return false;
												}
											}else {
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
										}
										if(split_title[0]=='Confirm Password' ){
											if(trimspaces(formElem.value)!=''){
												
												if(document.getElementById('txtConfirmPassword').value!=document.getElementById('txtPassword1').value ){
													alert("Password and confirm password does not match.");
													return false;
												}
											}else {
												alert(split_title[1]);
												formElem.focus();
												return false;
											}
										}
										if(split_title[0]=='Description' ){
											  tinyMCE.triggerSave(true,true);
  											  var mytextarea = tinyMCE.getContent();
											  //alert(mytextarea);
											  if(mytextarea==''){
												alert(split_title[1]);
													return false;	
											  }
										}
										if(split_title[0]=='Price'  && isNaN(formElem.value)){
											alert('Please enter numeric value for price.');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='PinCode'  && isNaN(formElem.value)){
											alert('Please enter valid pincode.');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Starting Price'  && isNaN(formElem.value)){
											alert('Please enter numeric value for starting price.');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Size'  && isNaN(formElem.value)){
											alert('Please enter numeric value for size.');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Price'  && parseInt(formElem.value)<0){
											alert('Please enter positive value for price');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Size'  && parseInt(formElem.value)<0){
											alert('Please enter positive value for size');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='Starting Price'  && parseInt(formElem.value)<0){
											alert('Please enter positive value for starting price');
											formElem.focus();
											return false;
										}
										if(split_title[0]=='File' && trimspaces(formElem.value)!='')
										{
											var jpeg_file=formElem.value;
											
											if((jpeg_file.lastIndexOf(".jpg")==-1) && (jpeg_file.lastIndexOf(".jpeg")==-1) && (jpeg_file.lastIndexOf(".JPG")==-1) && (jpeg_file.lastIndexOf(".JPEG")==-1) && (jpeg_file.lastIndexOf(".GIF")==-1) && (jpeg_file.lastIndexOf(".gif")==-1) && (jpeg_file.lastIndexOf(".png")==-1) && (jpeg_file.lastIndexOf(".PNG")==-1)) {
  								 				//alert(jpeg_file.lastIndexOf(".jpg"));
												alert("Please upload only jpg, jpeg, gif, png extention file");
 								  				return false;
											}
											
										}
										if(split_title[0]=='ImageFile' && trimspaces(formElem.value)!='')
										{
											var jpeg_file=formElem.value;
											
											if((jpeg_file.lastIndexOf(".jpg")==-1) && (jpeg_file.lastIndexOf(".jpeg")==-1) && (jpeg_file.lastIndexOf(".JPG")==-1) && (jpeg_file.lastIndexOf(".JPEG")==-1) && (jpeg_file.lastIndexOf(".GIF")==-1) && (jpeg_file.lastIndexOf(".gif")==-1) && (jpeg_file.lastIndexOf(".png")==-1) && (jpeg_file.lastIndexOf(".PNG")==-1)) {
  								 				//alert(jpeg_file.lastIndexOf(".jpg"));
												alert("Please upload only jpg, jpeg, gif, png extention file");
 								  				return false;
											}
											
										}
										if(split_title[0]=='docFile' && trimspaces(formElem.value)!='')
										{
											var pdf_file=formElem.value;
											
											if((pdf_file.lastIndexOf(".pdf")==-1) && (pdf_file.lastIndexOf(".PDF")==-1)) 
											{
												alert("Please upload only pdf extention file");
 								  				return false;
											}
										 }
										
									break;
								}
						}//end of for loop
						return true;
		}  

function CheckAll1(obj,name){
	var flag=0;
	var count = obj.elements.length;
	for (i=0; i < count; i++) 
	{
		if(obj.elements[i].type == 'checkbox')
			if(obj.elements[i].checked == true)
			flag=flag+1;
	}
	if(flag>0){
		if(confirm("Are you sure to delete selected "+name+"?"))
		{
			document.getElementById('token').value = "deleteall";
			obj.submit();   
		} else {
			var count = obj.elements.length;
			for (i=0; i < count; i++) 
			{
				obj.elements[i].checked =0;
				flag=false;
			}return false;	
		}
	}else {
		alert("Please select at least one "+name+".");
		return false;
	}
}

function checkall(num,validans){
	//alert('hi'+num);
	var flag=0;
	for(k=1;k<=num;k++){
		if(document.getElementById('chk_'+k).checked==true){
			flag=1;
		}
	}
	if(flag==0){
		alert(validans);
		return false;
	}
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
					if(element_id.indexOf('.png')==-1 && element_id.indexOf('.gif')==-1 && element_id.indexOf('.jpg')==-1 && element_id.indexOf('.jpeg')==-1){
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
						alert("Please enter numberic value value");
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

function selectallsuboption(typ){
	var aval='';
	var sval='';
	var oval='';
	var rval='';
	if(typ=='A'){
		var listbox = document.getElementById('articlebox');
		for(var count=0; count < listbox.options.length; count++) {
			aval+=listbox.options[count].value+'~';
		}
		var listbox1 = document.getElementById('sectionbox');
		for(var count=0; count < listbox1.options.length; count++) {
			sval+=listbox1.options[count].value+'~';
		}
		var listbox3 = document.getElementById('orderbox');
		for(var count=0; count < listbox3.options.length; count++) {
			oval+=listbox3.options[count].value+'~';
		}
		document.getElementById('sectionhidden').value=sval;
		document.getElementById('articlehidden').value=aval;
		document.getElementById('orderhidden').value=oval;
	}else if(typ=='R'){
		var listbox = document.getElementById('sectionbox');
		for(var count=0; count < listbox.options.length; count++) {
			rval+=listbox.options[count].value+'~';
		}
		document.getElementById('rulehidden').value=rval;
	}
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
										if(displayitem == 'messageerror3'){
											if(xmlHttp.responseText=='')
												document.getElementById('submitdisplay').style.display='';
											else
												document.getElementById('submitdisplay').style.display='none';
												
											document.getElementById('act_suggest').innerHTML='';
											document.getElementById(displayitem).innerHTML=xmlHttp.responseText;
										}else if(displayitem == 'messageerror'){
											/*if(xmlHttp.responseText=='')
												document.getElementById('actsdisplay1').style.display='';
											else
												document.getElementById('actsdisplay1').style.display='none';
											*/
												
											document.getElementById('act_suggest').innerHTML='';
											document.getElementById(displayitem).innerHTML=xmlHttp.responseText;
										}else if(displayitem == 'messageerror1'){
											if(xmlHttp.responseText=='')
												document.getElementById('actsdisplay3').style.display='';
											else
												document.getElementById('actsdisplay3').style.display='none';
											document.getElementById('messageerror').innerHTML=xmlHttp.responseText;	
										}else if(xmlHttp.responseText!=''){
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







var searchReq = GetXmlHttpObject();
function searchSuggest(url, displayitem, valueof) {
	
    if (searchReq.readyState == 4 || searchReq.readyState == 0) {
	    
        searchReq.open("GET", url, true);
        searchReq.onreadystatechange = function handleSearchSuggest() {
										    if (searchReq.readyState == 4) {
										        var ss = document.getElementById(displayitem)
										        ss.innerHTML = '';
										        var str = searchReq.responseText.split("\n");
										        for(i=0; i < str.length - 1; i++) {
											       var k=1+i;
											       var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
										            suggest += 'onmouseout="javascript:suggestOut(this);" ';
										            suggest += 'onclick="javascript:setSearch(this.innerHTML, \''+valueof+'\',\''+displayitem+'\');" ';
										            suggest += 'class="suggest_link"  onKeyPress="javascript:setSearch(this.innerHTML);" tabindex="'+k+'">' +str[i]+'</div>';
										            ss.innerHTML += suggest;
										            
										        }
										    }
										}
		searchReq.send(null);
    }        
}





//Mouse over function
function suggestOver(div_value) {
    div_value.className = 'suggest_link_over';
}
 
//Mouse out function
function suggestOut(div_value) {
    div_value.className = 'suggest_link';
}

//Click function
function setSearch(value, valueof, displayon) {
	
	if(value.indexOf("----------")>-1){
		var splt=value.split("----------");
		value=splt[0];
	}
    document.getElementById(valueof).value = value;
    document.getElementById(displayon).innerHTML = '';
}

////////////////////////////////end ajax chk//////////////

function MoveUp(lst){
	if(lst.selectedIndex == -1)
		alert('Please select an Item to move up.');
	else{
		if(lst.selectedIndex == 0){
			alert('First element cannot be moved up');
			return false
		}
		else{
			var tempValue = lst.options[lst.selectedIndex].value;
			var tempIndex = lst.selectedIndex-1;
			lst.options[lst.selectedIndex].value = lst.options[lst.selectedIndex-1].value;
			lst.options[lst.selectedIndex-1].value = tempValue;
			var tempText = lst.options[lst.selectedIndex].text;
			lst.options[lst.selectedIndex].text = lst.options[lst.selectedIndex-1].text;
			lst.options[lst.selectedIndex-1].text = tempText;
			lst.selectedIndex = tempIndex;
		}
	}
	return false;
}
function MoveDown(lst){
	if(lst.selectedIndex == -1)
		alert('Please select an Item to move down');
	else{
		
		if(lst.selectedIndex == lst.options.length-1)
			alert('Last element cannot be moved down');
		else
		{
			var tempValue = lst.options[lst.selectedIndex].value;
			var tempIndex = lst.selectedIndex+1;
			lst.options[lst.selectedIndex].value = lst.options[lst.selectedIndex+1].value;
			lst.options[lst.selectedIndex+1].value = tempValue;
			var tempText = lst.options[lst.selectedIndex].text;
			lst.options[lst.selectedIndex].text = lst.options[lst.selectedIndex+1].text;
			lst.options[lst.selectedIndex+1].text = tempText;
			lst.selectedIndex = tempIndex;
		}
	}
	return false;
}

function section(typ,url,displayitem){
	if(document.frm.shall_type[0].checked==true){
		url=url+'&t=S';
	}else if(document.frm.shall_type[1].checked==true){
		url=url+'&t=A';
	}else {
		url=url+'&t=O';
	}
	
	if(typ=="tip"){
		searchSuggest(url,displayitem);
	}else{
		ajax(url,displayitem);
	}
}
function judgment(url,itemno){
	
	for(k=1;k<=8;k++){
		if(k > itemno){
			if(k<=3)
				document.getElementById("displayitem"+k).innerHTML="";
				
			document.getElementById("judgmentfld"+k).style.display="none";
		}
		if(itemno>=4)
			document.getElementById("judgmentfld"+k).style.display="";
	}
	
		
	document.getElementById("judgmentfld"+itemno).style.display="";
	if(itemno<=3)
		ajax(url,"displayitem"+itemno);
}