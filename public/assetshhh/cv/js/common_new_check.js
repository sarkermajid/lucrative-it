/////////////////////////////////////////adding text in another div in autosuggestion system///////////////
///////////////////////////////////Author: Sufia ////////////////////////////////
function getData(strText,systemName)
{
	
	
	var searchID = "";	           
	if (outputdata.length != null) 
	{
		for (var i=0; i < outputdata.length; i++) 
		{
			if (outputdata[i].value.toUpperCase() === strText.toUpperCase()) {
				searchID = outputdata[i].id
			}
    	}
	}
return searchID;
	
}

function getSystemName(systemName,lan,strCheckBoxName)
{
	var system;
	if(systemName == "skill")
	{
		if(lan == "EN")
		{
			system = "skill";
		}else
		{
			system = "দক্ষতা";
		}
	}
	else if (systemName == "exp")
	{
		if(lan == "EN")
		{
		system = "work area";
		}else
		{
			system = "কর্মক্ষেত্র";
		}
	}
	else if (systemName == "location")
	{
		if (strCheckBoxName == "dist")
		{
		  if(lan == "EN")
		  {
			system = "District";
		  }else
		  {
			system = "জেলা";
		  }
		
		}else{
			
			if(lan == "EN")
			{
				system = "Country";
			}else
			{
				system = "দেশ";
			}
		}
		
		
		

	}
	else 
	{
		if(lan == "EN")
		{
		system = "organization";
		}else
		{
			system = "প্রতিষ্ঠান";
		}
	}
	return system
}


//:used for adding text in another div
//:parameter systemName used for knowing which type of system 
//:parameter  newdiv used for fulldivname where textfield exist
//:parameter strCheckBoxName to define the 'well well-sm' div's id name like workDIV12380
//:parameter strAddTagName is the div id name where selected text are exist
//:parameter strHidIdTag textfield name where selected ids are exist like SWorkarea
//:parameter strHiddenCount textfield name where total number of selected text exist
//:parameter subCatId where extra text add
//:parameter SubCatText  text field name
//:parameter langType
//:parameter hiddenIdFName textfield name where autosuggested id exist
//:parameter intCount total number of text thar refer how much text can be added
//:author Sufia Afroz
function addOtherTextInDiv(systemName,newDiv,strCheckBoxName,strAddTagName,strHidIdTag,strHiddenCount,subCatId,SubCatText,langType,hiddenIdFName,intCount)
{
	var system = getSystemName(systemName,langType,strCheckBoxName);
	
	
	
	var ID = "";
	var CatID = "";
	//get the text
	var stringValue = document.getElementById(SubCatText).value;
	stringValue = stringValue.trim();
	
	// get total count which is selected
	if (document.getElementById(strHiddenCount)==null)
	{
		var strCount=0;
	}
	else
	{
		var strCount=document.getElementById(strHiddenCount).value;
	}
	//text validation
	if (systemName != 'organization' && systemName != 'location') 
	if ( otherTextValidation(stringValue, langType,system,SubCatText) == false )
		{
			
			return false;
			//document.getElementById(SubCatText).focus();
		}
		
	
	// get the id of text from hidden field
	
	var stringID = document.getElementById(hiddenIdFName).value;
	//ID = stringID
	if(stringID.trim() == "" || stringID.trim() == null){
		   
		
			var searchID=getData(stringValue,systemName);
			//alert(searchID.trim() != "0" || searchID.trim() != "");
				if (searchID != null && searchID!= ""){
					
					if(strCheckBoxName == "dist")
					{
						if( Number(searchID) > Number(101) )
						{
							alert("Please enter "+system+"'s name");
						 	return false;
						}
					}
					
					if(strCheckBoxName == "over")
					{
						if( Number(searchID) < Number(101) )
						{
							alert("Please enter "+system+"'s name");
						 	return false;
						}
					}
					
					
				 stringID = searchID;
				}else{
					if (systemName == 'exp') 
					{
						stringID = "";
					}
					else if(systemName == 'skill')
					{
						stringID = "";
					}
					else{
						if(langType == "EN"){
 						 	alert("Please enter "+system+"'s name");
						 	return false;
						}
						else{
							alert(system+"টি সঠিক নয়!");
						 	return false;
						}
					}
					
				}
				
		
	}
	// when it is distirct and chossing anywhere in bangladesh then remove all other district name
			if(system == "District" || system == "জেলা")
			{
				 var ids = $("#"+strHidIdTag+"").val();
				 var arr = ids == "" ? [] : ids.split(",");
				
				 
				 if(($.inArray("-1", arr) == -1 && stringID == "-1") || ($.inArray("-1", arr) > -1 && stringID != "-1"))
				 {
					 arr = [];
					 arrNames = [];
					 $("#"+strAddTagName+"").html("");
					 $("#"+strHidIdTag+"").val("");
					 $("#"+strHiddenCount+"").val("0");
				 }
			}
	//after test comment have to ommit
	if (intCount!=0)
	  {
		if(strCount>=parseInt(intCount))
		{
			if(parseInt(intCount)==1)
			{
				if(langType == "EN")
				{
					mess="You cannot add more than 1 current location!";
				}else
				{
					mess="আপনি 1 এর অধিক কাজের সেক্টর যোগ করতে পারবেন না!";
				}
			}
			else if (parseInt(intCount)==2)
			{
				if(langType == "EN")
				{
					mess="You cannot add more than 2 job categories!";
				}else
				{
					mess="আপনি ২ এর অধিক কাজের সেক্টর যোগ করতে পারবেন না!";
				}
			}
			else if (parseInt(intCount)==3)
			{
				if(langType == "EN")
				{
					mess="You cannot add more than 3 areas of experience!";
				}else
				{
					//mess="আপনি ৩ এর অধিক অভিজ্ঞতা যোগ করতে পারবেন না!";
					mess = "আপনি ৩ টির অধিক অভিজ্ঞতা যোগ করতে পারবেন না!";
				}
			}
			else if (parseInt(intCount)==12)
			{
				if(langType == "EN")
				{
					mess="You cannot add more than 12 organizations!";
				}
				else
				{
					mess="আপনি ১২ এর অধিক প্রতিষ্ঠান যুক্ত করতে পারবেন না!";
				}
			}
			else if (parseInt(intCount)==15)
			{
				if(langType == "EN")
				{
					mess="You cannot add more than 15 districts!";
				}else
				{
					mess="আপনি ১৫ এর অধিক জেলা যুক্ত করতে পারবেন না!";
				}
			}
			else if(parseInt(intCount)==10)
			{
				if (strAddTagName=="FilterLocation")
				{
					if(langType == "EN")
					{
						mess="You cannot add more than 10 countries!";
					}else
					{
						mess="আপনি ১০ এর অধিক দেশ যুক্ত করতে পারবেন না!";
					}
				}
				else if(strAddTagName=="FilterItems")
				{
					if(langType == "EN")
					{
						mess="You cannot add more than 10 Companies!";
					}else
					{
						mess="আপনি ১০ এর অধিক কোম্পানি যুক্ত করতে পারবেন না!";
					}
				}
				else if (strAddTagName=="FilterOverseas")
				{
					if(langType == "EN")
					{
						mess="You cannot add more than 10 countries!";
					}else
					{
						mess="আপনি ১০ এর অধিক দেশ যুক্ত করতে পারবেন না!";
					}
				}
				else
				{
					if(langType == "EN"){
						mess="You cannot add more than 10 skills!";
					}
					else
					{
						mess="আপনি ১০ এর অধিক দক্ষতা যুক্ত করতে পারবেন না!";
					}

				}
				
			}
			alert(mess);
			document.getElementById(SubCatText).value="";
			document.getElementById(hiddenIdFName).value="";
			return false;
		}
	  }
	
		
		//var divs = document.getElementsByClassName("well-sm");
		
		var divs = document.querySelectorAll("#"+strAddTagName +"> div");
		
		for (var i = 0; i < divs.length; i++) {
			var div = divs[i];
			var span = div.getElementsByTagName("span")[0];
			if (span) {
				//var strText = span.innerText;
				var strText = $(span).text();
				if(stringValue.toUpperCase() == strText.toUpperCase())
					{
						if(langType == "EN"){
							alert("Already exists!");
							return false;
						}else{
							alert("ইতিমধ্যে এটি যুক্ত করা হয়েছে");
							return false;
						}
					}
			}
		}
				
	//if(otherTextValidation(stringValue, langType)){
	    //create lastcount number 
		if (document.getElementById(strHiddenCount)==null ||document.getElementById(strHiddenCount).value=="")
				{
					var strValue=0;
					str_hidCount="<input id='"+strHiddenCount+"' name='"+strHiddenCount+"' type='hidden' value=''>";
				}
				else
				{
				 var strValue=document.getElementById(strHiddenCount).value;
				 str_hidCount="";
				}
				
				if (document.getElementById("Hid"+strCheckBoxName+strValue+"")==""||document.getElementById("Hid"+strCheckBoxName+strValue+"")==null )
				 {
					 var i=strValue;
				 }
				 else
				 {
					 var i=strValue+1;
					 
				 }
				 //create well well-sm  div
				 if (stringID != "" && stringID!= 0){
				 	addDiv(stringID,strAddTagName,strHidIdTag,strHiddenCount,strCheckBoxName,stringValue);
				 }else{
				 
					div= "<div id='"+strCheckBoxName+"DIV"+stringValue.toUpperCase()+"' class ='well well-sm'><span id='"+stringValue.toUpperCase()+"otherCkString'>"+stringValue+"</span><a href=javascript:removeOtherDiv('"+strHiddenCount+"','"+strCheckBoxName+"','"+ encodeURIComponent(stringValue )+"','"+subCatId+"'); class='btn'>&nbsp;<i class='icon-times-o' ></i></a><input type='hidden' id='Hid"+strCheckBoxName+i+"' name='Hid"+strCheckBoxName+i+"' value="+stringValue+">"+str_hidCount+"</div>";
				
				selectedIdHTML=document.getElementById(strAddTagName);
				selectedIdHTML.innerHTML=selectedIdHTML.innerHTML+div;
		
				strValue=parseInt(strValue)+1;
				
				document.getElementById(strHiddenCount).value=strValue;
				
				 }
				
		
		
				// add sworkarea id
				if (systemName == 'exp' || systemName == 'skill'){
					if(stringID != "" && stringID!= 0){
						var strCompanyId=document.getElementById(strHidIdTag);
						strCompanyId.value=addDivValue(stringID,strHidIdTag,strCompanyId.value);
					}else{
						//var strIdText = ID+ "#" + stringValue;
						var strIdText =  stringValue;
					    var strSubCatID = document.getElementById(subCatId);
					    strSubCatID.value=addDivValue(strIdText,newDiv,strSubCatID.value);
					}
				}else{
						var strCompanyId=document.getElementById(strHidIdTag);
						strCompanyId.value=addDivValue(stringID,strHidIdTag,strCompanyId.value);
				}
				
				
				document.getElementById(SubCatText).value="";
				document.getElementById(hiddenIdFName).value="";
				
	//}
	
}


function otherTextValidation(stringValue,langType,system,SubCatText)
{
	
	if(stringValue == "")
	{
		if(langType == "EN"){
			alert("Please write text in "+system+" field.");
		}else{
			alert("অন্যান্য ক্ষেত্রটি ফাঁকা হতে পারবে না।");
		}
		
		document.getElementById(SubCatText).focus();
		return false;
	}else{
		//if (stringValue.StartsWith(" ") || stringValue.StartsWith("\t")) {
//    		
//		}
		//stringValue = stringValue.replace(/^\s/, '');
		if(stringValue.indexOf(";")> -1 || stringValue.indexOf(",")> -1){
			if(langType == "EN"){
				alert(""+system+" field does not allow ; or ,.");
			}else{
				alert(system+" ক্ষেত্রটিতে  ; অথবা , দেয়া যাবে না");
			}
			return false;
		}else if(stringValue.indexOf("%")> -1)
		{
			if(langType == "EN"){
				alert(""+system+" field does not allow %.");
			}else{
				alert(system+" ক্ষেত্রটিতে % দেয়া যাবে না");
			}
			return false;
		}
		else if(stringValue.indexOf("'")> -1 || stringValue.indexOf('"')> -1)
		{
			if(langType == "EN"){
			 	alert(""+system+" field does not allow \"\ or '.");
			}else{
				alert(system+" ক্ষেত্রটিতে  \"\ অথবা ' দেয়া যাবে না");
			}
			return false;
		}else if(stringValue.length > 80){
			if(langType == "EN"){
				alert(""+system+" field length should be in 80 characters .");
			}else{
				alert(system+" ক্ষেত্রটি অবশ্যই ৮০ অক্ষরের মধ্যে সীমাবদ্ধ হতে হবে");
			}
			return false;
		}else if(/^\s*$/.test(stringValue)){
			if(langType == "EN"){
				alert("Please write text in "+system+" field.");
			}else{
				alert(system+" ক্ষেত্রটি ফাঁকা হতে পারবে না।");
			}
			return false;
		}else if(stringValue.indexOf("--")> -1){
			if(langType == "EN"){
				alert(""+system+" field does not allow --.");
			}else{
				alert(system+" ক্ষেত্রটিতে -- দেয়া যাবে না");
			}
			return false;
		}
		return true;
		
	}
}
function addDivValue(id,strTagName,hid)
{
	//var hid=document.getElementById(strTagName).value;
	
	var str="";
	
	
		if( hid!="")
		{
			//hid=hid.replace(",","");
		  if (hid.length==0)
		  {
			str=","+id+",";
		  }
		  else
		  {
			  str=hid+id+",";
		  }
			
		}
		else
		{
			str=id;
			str=","+str + ",";
		}
	
	//str=","+str + ",";
	return str;
}
function removeDivValue(id,str_TagName)
{
	
	var hid=document.getElementById(""+str_TagName+"").value;
	
	
	var str="";
	if( hid!="")
	{
		var hid_1=String(hid).substr(1,hid.lenght);
		
		var iLen = String(hid_1).length;
		var len= String(hid_1).substring(-iLen, iLen - 1);
	
		var temp = new Array();
		temp = len.split(",");
		
	
		if (temp.indexOf(""+id+"")>-1)
		{
		temp[temp.indexOf(""+id+"")]="";
			for (i in temp)
			{
				if (temp[i]!="" )
				{
				 str=str+temp[i]+",";
				}
				
			}
			
			if (str!="")
			{
			str=","+str;
			}
			else
			{
				str="";
			}
			
		}
		
	}
	else
	{
		str="";
	}
	
	return str;

}





function addDiv(id,strAddTagName,strHidIdTag,strHiddenCount,strCheckBoxName,stringValue)
{
	var stringValue=stringValue;
	checkboxId=document.getElementById(id);
	var str_hidCount="";
	if (document.getElementById(strHiddenCount)==null ||document.getElementById(strHiddenCount).value=="")
	{
		var strValue=0;
		str_hidCount="<input id='"+strHiddenCount+"' name='"+strHiddenCount+"' type='hidden' value=''>";
	}
	else
	{
 	 var strValue=document.getElementById(strHiddenCount).value;
	 str_hidCount="";
	}
	 if (document.getElementById("Hid"+strCheckBoxName+strValue+"")==""||document.getElementById("Hid"+strCheckBoxName+strValue+"")==null )
	 {
		 var i=strValue;
	 }
	 else
	 {
		 
		
		 
		  var i=strValue+1;
		 
	 }
	 
	
	div="<div id='"+strCheckBoxName+"DIV"+id+"' class ='well well-sm'><span>"+stringValue+"</span><a href=javascript:removeDiv("+id+",0,'"+strHidIdTag+"','"+strHiddenCount+"','"+strCheckBoxName+"'); class='btn'>&nbsp;<i class='icon-times-o' ></i></a><input type='hidden' id='Hid"+strCheckBoxName+i+"' name='Hid"+strCheckBoxName+i+"' value="+id+"></div>"+str_hidCount
	
	//numberOfCheckbox=$("input[name='chkBolckCM']").filter(':checked').length;
	
	selectedIdHTML=document.getElementById(strAddTagName);

	selectedIdHTML.innerHTML=selectedIdHTML.innerHTML+div;
	
		strValue=parseInt(strValue)+1;
	 
    document.getElementById(strHiddenCount).value=strValue;
	
		
	//if(numberOfCheckbox>0)
//	{
//		document.getElementById("strHeader").style.display="";
//	}
//	else
//	{
//		document.getElementById("strHeader").style.display="none";
//	}
	//alert(value);
}

function removeDiv(id,hasChkBoxExit,strTag,strHidCount,strCheckBoxName)
{
	
	selectedId=document.getElementById(strCheckBoxName+"DIV"+id);
	
	
	if(selectedId!=null)
	{
		
		document.getElementById(strCheckBoxName+"DIV"+id).outerHTML="";
	}
	//if (parseInt(hasChkBoxExit)==1)
//	{
//		checkboxId=document.getElementById(id+strCheckBoxName);
//		if(checkboxId.checked)
//		{
//			checkboxId.checked=false;
//		}
//		numberOfCheckbox=$("input[name='chkBolckCM']").filter(':checked').length;
//		var strValue=removeDivValue(id,strTag);
//		var strValue_1=document.getElementById(strHidCount).value;
//		strValue_1=parseInt(strValue_1)-1;
//		document.getElementById(strHidCount).value=strValue_1;
//		var strCompanyId=document.getElementById(strTag);
//		//document.getElementById(id+strCheckBoxName).checked=false;
//		strCompanyId.value=strValue;
//		
//	}
//	else
//	{
		var strCompanyId=document.getElementById(strTag);
		  strCompanyId.value=removeDivValue(id,strTag);
		
		var strValue_1=document.getElementById(strHidCount).value;
		strValue_1=parseInt(strValue_1)-1;
		document.getElementById(strHidCount).value=strValue_1;
		
		if(document.getElementById(id+strCheckBoxName) != null){
			//document.getElementById(id+strCheckBoxName).checked=false;
		}
		//strCompanyId.value=strValue;
		
//	}
	
	
	
	
	
}

function removeOtherDiv(strHidCount,strCheckBoxName,subCatString,hiddenStringTag)
{
	
	selectedId=document.getElementById(strCheckBoxName+"DIV"+subCatString.toUpperCase());
	var otherStr=""; 
	//remove the whole div
	if(selectedId!=null)
	{
		
		var spanID = subCatString.toUpperCase()+"otherCkString";
		var otherStr = document.getElementById(spanID).innerHTML;
		document.getElementById(strCheckBoxName+"DIV"+subCatString.toUpperCase()).outerHTML="";
	}
	
		//remove the string from hidden input field
		var strCatString = document.getElementById(hiddenStringTag); 
		var StringId= subCatString;
		strCatString.value = removeDivValue(StringId,hiddenStringTag);
		
		//set the total count in hidden input field
		var strValue_1=document.getElementById(strHidCount).value;
		strValue_1=parseInt(strValue_1)-1;
		document.getElementById(strHidCount).value=strValue_1;
		
}

//function removeDivBn(id,hasChkBoxExit,strTag,strHidCount,strCheckBoxName)
//{
//	
//	selectedId=document.getElementById(strCheckBoxName+"DIV"+id);
//	
//	
//	if(selectedId!=null)
//	{
//		
//		document.getElementById(strCheckBoxName+"DIV"+id).outerHTML="";
//	}
//	if (parseInt(hasChkBoxExit)==1)
//	{
//		checkboxId=document.getElementById(id+strCheckBoxName);
//		if(checkboxId.checked)
//		{
//			checkboxId.checked=false;
//		}
//		numberOfCheckbox=$("input[name='chkBolckCM']").filter(':checked').length;
//		var strValue=removeDivValue(id,strTag);
//		var strValue_1=document.getElementById(strHidCount).value;
//		strValue_1=parseInt(strValue_1)-1;
//		document.getElementById(strHidCount).value=strValue_1;
//		var strCompanyId=document.getElementById(strTag);
//		document.getElementById(id+strCheckBoxName).checked=false;
//		strCompanyId.value=strValue;
//		
//	}
//	else
//	{
//		var strCompanyId=document.getElementById(strTag);
//		  strCompanyId.value=removeDivValue(id,strTag);
//		
//		var strValue_1=document.getElementById(strHidCount).value;
//		strValue_1=parseInt(strValue_1)-1;
//		document.getElementById(strHidCount).value=strValue_1;
//		
//		if(document.getElementById(id+strCheckBoxName) != null){
//			document.getElementById(id+strCheckBoxName).checked=false;
//		}
//		//strCompanyId.value=strValue;
//		
//	}
//	
	
	
/////////////////////////////////////////////////only for category/////////////////////////////////////	
	
//}
//for select checkbox's
//used in preferred job location's  categories
function getChkValue(id,strElementName,strAddTagName,intCount,strHiddenCount,strCheckBoxName)
{
	var jobCategory = "Functional category";
	var jobCategoryBN = "ফাংশনাল ক্যাটাগরি";
	if(strCheckBoxName == "BlueCat")
	{
		jobCategoryBN = "স্পেশাল স্কিলড ক্যাটাগরি"
		jobCategory = "Special Skills"
	}
		
	
	isChecked=document.getElementById(id+strCheckBoxName).checked;
	if (document.getElementById(strHiddenCount)==null)
	{
		var strCount=0;
	}
	else
	{
		var strCount=document.getElementById(strHiddenCount).value;
	}
	
	if(isChecked)
	{
	  if (intCount!=0)
	  {
		if(strCount>=parseInt(intCount))
		{
			if (parseInt(intCount)==3)
			{
				if(lang == "EN")
				{
					mess="You cannot add more than 3 "+jobCategory+"! ";
				}
				else
				{
					mess="আপনি তিনটির বেশি "+jobCategoryBN+" যোগ করতে পারবেন না";
				}
				
				
			}
			else if (parseInt(intCount)==3)
			{
				mess="You cannot add more than 3 area of experience!";
			}
			else if (parseInt(intCount)==12)
			{
				mess="You cannot add more than 12 organization!";
			}
			else if (parseInt(intCount)==15)
			{
				mess="You cannot add more than 15 districts!";
			}
			else if(parseInt(intCount)==10)
			{
				if (strAddTagName=="FilterLocation")
				{
					mess="You cannot add more than 10 countries!";
				}
				else if(strAddTagName=="FilterItems")
				{
					mess="You cannot add more than 10 Companies!";
				}
				else if (strAddTagName=="FilterOverseas")
				{
					mess="You cannot add more than 10 Country!";
				}
				else
				{
					mess="You cannot add more than 10 Skills!";

				}
				
			}
			alert(mess);
			document.getElementById(id+strCheckBoxName).checked=false;
			return false;
		}
	  }
		
		//for(i = 0 ; i < strCount ; i++)// find duplicate
//				{
//					//alert(document.getElementById("Hid"+strCheckBoxName+i+""));
//					if (document.getElementById("Hid"+strCheckBoxName+i+"")=="" || document.getElementById("Hid"+strCheckBoxName+i+"")==null )
//					{
//						
//						i=i+1;
//						var strHidValue=document.getElementById("Hid"+strCheckBoxName+i+"");
//						
//						//addDivForCheckbox(id,strAddTagName,strElementName,strHiddenCount,strCheckBoxName);
//						
//					}
//					else
//					{
//						var strHidValue=document.getElementById("Hid"+strCheckBoxName+i+"")	
//
//					}
//					if(strHidValue!=null)
//					{
//						if (id==strHidValue.value) 
//							{
//								if(lang == "EN")
//								{
//									alert("Already exist!");
//								}else
//								{
//									alert("ইতিমধ্যে এটি যুক্ত করা হয়েছে");
//								}
//								document.getElementById(id+strCheckBoxName).checked=false;
//								
//								return false;
//							}
//					}
//				
//					
//				}//en
				var selectedCat = document.getElementById(strElementName).value;
				var arr =selectedCat.split(",");
				for(i=0; i<arr.length; i++)
				{
					if(arr[i] == id)
					{
						if(lang == "EN")
						{
							alert("Already exist!");
						}else
						{
							alert("ইতিমধ্যে এটি যুক্ত করা হয়েছে");
						}
						document.getElementById(id+strCheckBoxName).checked=false;
						return false;
					}
				}
				
				
		        //if(selectedCat.indexOf(id) != -1)
//				{
//					
//								if(lang == "EN")
//								{
//									alert("Already exist!");
//								}else
//								{
//									alert("ইতিমধ্যে এটি যুক্ত করা হয়েছে");
//								}
//								document.getElementById(id+strCheckBoxName).checked=false;
//								
//								return false;
//						
//				}
		
			addDivForCheckbox(id,strAddTagName,strElementName,strHiddenCount,strCheckBoxName);
				var strCompanyId=document.getElementById(strElementName);
           
			strCompanyId.value=addValue(id,strElementName,strCompanyId.value);
		
		
	}
	else
	{
		removeDivCheckBox(id,1,strElementName,strHiddenCount,strCheckBoxName);
		//strCompanyId.value=addValue(id,strElementName);
		
	}
	
function addDivForCheckbox(id,strAddTagName,strHidIdTag,strHiddenCount,strCheckBoxName)
{
	var stringValue=document.getElementById("Value"+strCheckBoxName+id).innerHTML;
	checkboxId=document.getElementById(id);
	var str_hidCount="";
	if (document.getElementById(strHiddenCount)==null ||document.getElementById(strHiddenCount).value=="")
	{
		var strValue=0;
		str_hidCount="<input id='"+strHiddenCount+"' name='"+strHiddenCount+"' type='hidden' value=''>";
	}
	else
	{
 	 var strValue=document.getElementById(strHiddenCount).value;
	 str_hidCount="";
	}
	 if (document.getElementById("Hid"+strCheckBoxName+strValue+"")==""||document.getElementById("Hid"+strCheckBoxName+strValue+"")==null )
	 {
		 var i=strValue;
	 }
	 else
	 {
		 
		
		 
		  var i=strValue+1;
		 
	 }
	 
	
	div="<div id='"+strCheckBoxName+"DIV"+id+"' class ='well well-sm'>"+stringValue+"<a href=javascript:removeDivCheckBox("+id+",0,'"+strHidIdTag+"','"+strHiddenCount+"','"+strCheckBoxName+"'); class='btn'>&nbsp;<i class='icon-times-o'></i></a><input type='hidden' id='Hid"+strCheckBoxName+i+"' name='Hid"+strCheckBoxName+i+"' value="+id+">"+str_hidCount+"</div>"
	
	numberOfCheckbox=$("input[name='chkBolckCM']").filter(':checked').length;
	
	selectedIdHTML=document.getElementById(strAddTagName);

	selectedIdHTML.innerHTML=selectedIdHTML.innerHTML+div;
	
		strValue=parseInt(strValue)+1;
	 
    document.getElementById(strHiddenCount).value=strValue;
	

   }
}

function removeDivCheckBox(id,hasChkBoxExit,strTag,strHidCount,strCheckBoxName)
{
	
	selectedId=document.getElementById(strCheckBoxName+"DIV"+id);
	
	
	if(selectedId!=null)
	{
		
		document.getElementById(strCheckBoxName+"DIV"+id).outerHTML="";
	}
	if (parseInt(hasChkBoxExit)==1)
	{
		checkboxId=document.getElementById(id+strCheckBoxName);
		if(checkboxId.checked)
		{
			checkboxId.checked=false;
		}
		numberOfCheckbox=$("input[name='chkBolckCM']").filter(':checked').length;
		var strValue=removeValue(id,strTag);
		var strValue_1=document.getElementById(strHidCount).value;
		strValue_1=parseInt(strValue_1)-1;
		document.getElementById(strHidCount).value=strValue_1;
		var strCompanyId=document.getElementById(strTag);
		document.getElementById(id+strCheckBoxName).checked=false;
		strCompanyId.value=strValue;
		
	}
	else
	{
		var strCompanyId=document.getElementById(strTag);
		  strCompanyId.value=removeValue(id,strTag);
		
		var strValue_1=document.getElementById(strHidCount).value;
		strValue_1=parseInt(strValue_1)-1;
		document.getElementById(strHidCount).value=strValue_1;
		
		
		document.getElementById(id+strCheckBoxName).checked=false;
		//strCompanyId.value=strValue;
		
	}

}

function removeValue(id,str_TagName)
{
	
	var hid=document.getElementById(""+str_TagName+"").value;
	
	
	var str="";
	if( hid!="")
	{
		var hid_1=String(hid).substr(1,hid.lenght);
		
		var iLen = String(hid_1).length;
		var len= String(hid_1).substring(-iLen, iLen - 1);
	
		var temp = new Array();
		temp = len.split(",");
		
	
		if (temp.indexOf(""+id+"")>-1)
		{
		temp[temp.indexOf(""+id+"")]="";
			for (i in temp)
			{
				if (temp[i]!="" )
				{
				 str=str+temp[i]+",";
				}
				
			}
			
			if (str!="")
			{
			str=","+str;
			}
			else
			{
				str="";
			}
			
		}
		
	}
	else
	{
		str="";
	}
	
	return str;

}
function addValue(id,strTagName,hid)
{
	//var hid=document.getElementById(strTagName).value;
	
	var str="";
	
	
		if( hid!="")
		{
			//hid=hid.replace(",","");
		  if (hid.length==0)
		  {
			str=","+id+",";
		  }
		  else
		  {
			  str=hid+id+",";
		  }
			
		}
		else
		{
			str=id;
			str=","+str + ",";
		}
	
	//str=","+str + ",";
	return str;
}


