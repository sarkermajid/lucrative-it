//Author Sufia
var fieldName = "";
function cnahgeValuePer(){
	// get nationality value
  document.getElementById("nViewFild").value = "";
  document.getElementById("nViewFild").value = document.getElementById("otherNationality").value;
  //get current location
 // var e = document.getElementById("cboPLocation");
 // var str = e.options[e.selectedIndex].text;
 // document.getElementById("locViewField").value = str;
  
}

//modified by sufia
function personal_info_validation(version) 
{
	var Message=document.getElementById('alertDiv_per');
	var isBlueColor = document.getElementById('isBlueColor').value;
	var MOBILE=document.getElementById('txtMobile').value//form1.txtMobile.value;//
	//var EMAIL_1 =document.getElementById('txtEmail1');//form1.txtEmail1.value;//
	var EMAIL_1 =trim_it(document.getElementById('txtEmail1').value);//form1.txtEmail1.value;//
	
	var msg = personal_common_field_validation(version)
	if (msg != true)
	{
		Message.innerHTML = msg;
	    $("#"+fieldName).parent().addClass("has-error");
		return false;	
	}
	if(isBlueColor == "False")  //for white color user
	{
		msg = personal_w_field_validation(version)
		if (msg != true)
			{
				Message.innerHTML = msg;
				$("#"+fieldName).parent().addClass("has-error");
				 return false;	
			}
	}else                  // for blue color user
	{
		msg = personal_b_field_validation(version)
		if (msg != true)
		{
				Message.innerHTML = msg;
				$("#"+fieldName).parent().addClass("has-error");
				return false;	
		}
	}
	
	if(EMAIL_1 == "" && MOBILE=="")
	{
		if(version == "EN")
		{
			str = showFailAlertMessage('Please fill atleast one required field ');
			Message.innerHTML = str;
		}
		else
		{
			str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;  অথবা <i><strong>ইমেইল</strong></i>&nbsp;   ক্ষেত্রটির যে কোন একটির তথ্য দিন');
			Message.innerHTML = str;
		}
		$("#txtMobile").parent().addClass("has-error");	
		$("#txtEmail1").parent().addClass("has-error");												
		return false;
	}else
	{
		$("#txtMobile").parent().removeClass("has-error");	
		$("#txtEmail1").parent().removeClass("has-error");	
	}
	if(MOBILE != "")
	{
		msg = primaryMobileValidation(MOBILE,version)
		if (msg != true)
		{
				Message.innerHTML = msg;
				$("#"+fieldName).parent().addClass("has-error");
				 return false;	
		}
	}
	
	if(EMAIL_1 != "")
	{
		msg = primaryEmailValidation(EMAIL_1,version)
		if (msg != true)
		{
				Message.innerHTML = msg;
				$("#"+fieldName).parent().addClass("has-error");
				 return false;	
		}
	}
	return true;   
}

function personal_w_field_validation(version)
{
	var PHONE_O=document.getElementById('txtPhone_Off').value//form1.txtPhone_Off.value;//
	var PHONE_H=document.getElementById('txtPhone_H').value//form1.txtPhone_H.value;// txtMobile
	var EMAIL_2 =trim_it(document.getElementById('txtEmail2').value); //form1.txtEmail2.value;//
	if(PHONE_H != "")
	{
		if(!isNaN(PHONE_H)== false)
		  {
		   if(version == "EN")
			{
				str = showFailAlertMessage(' <i><strong>Mobile No</strong></i> contains only numeric value (0-9)');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   অবশ্যই সংখ্যাসূচক হবে (০-৯)');
			}
			fieldName = "txtPhone_H";
			return str;
		}
		if(PHONE_H.indexOf("<script>")> -1)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('Invalid <i><strong>Mobile No</strong></i>');
			
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ক্ষেত্রটিতে সঠিক তথ্য দিন');
			
			}
			fieldName = "txtPhone_H";
			return str;
		}
		
		if(PHONE_H.length > 50)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>Mobile No:</strong></i> Maximum 50 characters');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ৫০ সংখ্যার বেশি হবে না');
			}
			fieldName = "txtPhone_H";
			return str;
		}
		if(PHONE_H.indexOf("'")> -1 || PHONE_H.indexOf("%")> -1 || PHONE_H.indexOf("#")> -1 || PHONE_H.indexOf("@")> -1 || PHONE_H.indexOf("&")> -1)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage("<i><strong>Mobile No</strong></i>  cannot contain ''%'',''#'',''@'',''&'', ''lsquo''");
			}
			else
			{
				str = showFailAlertMessage("<i><strong>মোবাইল নং</strong></i>&nbsp;   ''%'',''#'',''@'',''&'' , ''lsquo'' থাকবে না");
			}
			fieldName = "txtPhone_H";
			return str;
		}
		$("#txtPhone_H").parent().removeClass("has-error");	
	}else
	{
		$("#txtPhone_H").parent().removeClass("has-error");	
	}
	////////////////////////////////end home phone//////////////////
	//////////////////////office phone//////////////////////////////
			
	if(PHONE_O != "")
	{
		if(!isNaN(PHONE_O)== false)
		  {
		   
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>Mobile No</strong></i> contains only numeric value (0-9)');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   অবশ্যই সংখ্যাসূচক হবে (০-৯)');
			}
			fieldName = "txtPhone_H";
			return str;
			
	   }
		if(PHONE_O.indexOf("<script>")> -1)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('Invalid <i><strong>Mobile No</strong></i>');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ক্ষেত্রটিতে সঠিক তথ্য দিন');
			}
			fieldName = "txtPhone_H";
			return str;
			//document.getElementById('txtPhone_H').style.backgroundColor="#FFFFCC";
		}
		
		if(PHONE_O.length > 50)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>Mobile No:</strong></i> Maximum 50 characters');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ৫০ সংখ্যার বেশি হবে না');
			}
			fieldName = "txtPhone_Off";
			return str;	
			//document.getElementById('txtPhone_Off').style.backgroundColor="#FFFFCC";
		}
		if(PHONE_O.indexOf("'")> -1 || PHONE_O.indexOf("%")> -1 || PHONE_O.indexOf("#")> -1 || PHONE_O.indexOf("@")> -1 || PHONE_O.indexOf("&")> -1)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage("<i><strong>Mobile No</strong></i>  cannot contain ''%'',''#'',''@'',''&'', ''lsquo''");
			}
			else
			{
				str = showFailAlertMessage("<i><strong>মোবাইল নং</strong></i>&nbsp;   ''%'',''#'',''@'',''&'' , ''lsquo'' থাকবে না");
			}
			fieldName = "txtPhone_Off";
			return str;	
			//document.getElementById('txtPhone_Off').style.backgroundColor="#FFFFCC";
		}
		$("#txtPhone_Off").parent().removeClass("has-error");	
	}else
	{
		$("#txtPhone_Off").parent().removeClass("has-error");	
	}
	
	if(EMAIL_2 != "")
	 {
	 
		if (isValidEmailaddress(EMAIL_2)==false)
		{
			
			if(version == "EN")
			{
				 str = showFailAlertMessage("Please enter a valid <i><strong>Email Address</strong></i>. Email should not contain ''<i><strong>Space</strong></i>'' , '';''  , '','' & ''||''");
			}
			else
			{
				 str = showFailAlertMessage("সঠিক <i><strong>ইমেইল</strong></i>&nbsp;   লিখুন, ইমেইল এ অবশ্যই ''Space'' , '';''  , '','' & ''||'' থাকবে না");
			}
			fieldName = "txtEmail2";
			return str;		
			
		}
		else if(EMAIL_2.length > 50)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>Email Address:</strong></i> Maximum 50 characters');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>ইমেইল</strong></i>&nbsp;  ৫০ অক্ষরের বেশি হবে না');
			}
			fieldName = "txtEmail2";
			return str;		
			//document.getElementById('txtPhone_Off').style.backgroundColor="#FFFFCC";
		}
		else
		{
		$("#txtEmail2").parent().removeClass("has-error");	
		}
	 
	 }
return true;
	 
}

function personal_b_field_validation(version)
{
	var birthPlace=document.getElementById('birthPlace').value;
	var weight=document.getElementById('weight').value;
	var height=document.getElementById('height').value;
	if(birthPlace != "")
		{
			if(birthPlace.length > 50)    
			{	if(version == "EN")
				{
					str = showFailAlertMessage("Birth place should be 50 character")
				}else
				{
					str = showFailAlertMessage("<i><strong>জন্মস্থান</strong></i>&nbsp; ৫০ অক্ষরের বেশি হবে না।")
				}
				fieldName = "birthPlace";
				return str;
			}
			if(birthPlace.indexOf(";")> -1 )
			{
				if(version == "EN")
				{
					
					str = showFailAlertMessage("<i><strong>Birth Place</strong></i> cannot contain  '';'' or '','' ,''.'' ")
				}else
				{
	
					str = showFailAlertMessage("<i><strong>জন্মস্থান</strong></i>&nbsp;    এ '';'' অথবা '','' ,''.'' থাকবে না")
				}
				fieldName = "birthPlace"
				return str;
			}
		
		if(birthPlace.indexOf("<script>")> -1 )
		  {
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter a valid input ")
				}else
				{
					
					str = showFailAlertMessage("সঠিক তথ্য দিন")
				}
			
			    fieldName = "birthPlace"
						
			    return str; 
		  }
		 $("#birthPlace").parent().removeClass("has-error");
		}
		else
		{
			 $("#birthPlace").parent().removeClass("has-error"); 
		}//birth place
		
		if(weight != "")
		{
			if(isNaN(weight)) 
			{	if(version == "EN")
				{
					str = showFailAlertMessage("Weight (kg) contains only numeric value (0-9)")
				}else
				{
					str = showFailAlertMessage("ওজন (কেজি) অবশ্যই সংখ্যাসূচক হবে (০-৯)")
				}
				fieldName = "weight";
				return str;
			}
			if(weight.length > 6) 
			{	if(version == "EN")
				{
					str = showFailAlertMessage("Weigh (kg) should be 6 character")
				}else
				{
					str = showFailAlertMessage("ওজন	(কেজি) ৬ অক্ষরের বেশি হবে না।")
				}
				fieldName = "weight";
				return str;
			}
			 $("#weight").parent().removeClass("has-error");
		}else
		{
			 $("#weight").parent().removeClass("has-error"); 
		}//weight
		
		if(height != "")
		{
			if(isNaN(height)) 
			{	if(version == "EN")
				{
					str = showFailAlertMessage("Height (meters) contains only numeric value (0-9)")
				}else
				{
					str = showFailAlertMessage("উচ্চতা  (মিটার) অবশ্যই সংখ্যাসূচক হবে (০-৯)")
				}
				fieldName = "height";
				return str;
			}
			if(height.length > 6) 
			{	if(version == "EN")
				{
					str = showFailAlertMessage("Height (kg) should be 6 character")
				}else
				{
					str = showFailAlertMessage("উচ্চতা (মিটার) ৬ অক্ষরের বেশি হবে না।")
				}
				fieldName = "height";
				return str;
			}
			$("#height").parent().removeClass("has-error");
		}else
		{
			 $("#height").parent().removeClass("has-error"); 
		}//height
return true;
}

function personal_common_field_validation(version)
{
	var FirstName=document.getElementById('txtFirstName').value //form1.txtName.value;//
	var LastName=document.getElementById('txtLastName').value
	
	var GENDER=document.getElementById('cboGender').value;//cboGender			
	var MSTATUS=document.getElementById('cboMStatus').value;
	var Fname = document.getElementById('txtFName').value;
	var Mname = document.getElementById('txtMName').value;
	var NATIONALID=document.getElementById('txtNationalId').value
	
	var passportNo=document.getElementById('passportNo').value;
	var issueDate=document.getElementById('issueDate').value;
		
	
	if(document.getElementById('bangladeshi').checked){
		var NATIONALITY=document.getElementById('bangladeshi').value;
	}else
	{
		var NATIONALITY=document.getElementById('otherNationality').value;
	}
	
	if( FirstName.trim()== "")//if( FirstName1 == "")	
	{       
		if(version == "EN")
		{
			str = showFailAlertMessage("<i><strong>First Name</strong></i> cannot be empty")
		}else
		{
			str = showFailAlertMessage("<i><strong>নামের প্রথম অংশ</strong></i>&nbsp;   খালি রাখা যাবে না")
		}
		
		fieldName = "txtFirstName"
		return str;
		
	}else{ 
		if(FirstName.indexOf(";")> -1 )
		{
			if(version == "EN")
			{
				
				str = showFailAlertMessage("<i><strong>First Name</strong></i> cannot contain  '';'' or '','' ,''.'' ")
			}else
			{

				str = showFailAlertMessage("<i><strong>নামের প্রথম অংশ</strong></i>&nbsp;    এ '';'' অথবা '','' ,''.'' থাকবে না")
			}
			fieldName = "txtFirstName"
			return str;
		}
		
		if(FirstName.indexOf("<script>")> -1 )
		  {
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter a valid input ")
				}else
				{
					
					str = showFailAlertMessage("সঠিক তথ্য দিন")
				}
			
			    fieldName = "txtFirstName"
						
			    return str; 
		  }
		
		if(FirstName.length > 50)
		  {
			 if(version == "EN")
				{
					str = showFailAlertMessage("<i><strong>First Name:</strong></i> Maximum 50 characters")
				}else
				{
					str = showFailAlertMessage("<i><strong>নামের প্রথম অংশ</strong></i>&nbsp;  ৫০ অক্ষরের বেশি হবে না")
				}
			
			     fieldName = "txtFirstName"
				 return str;  
		  }
		 
	}
//***************end first Name *******************************/
///////////////////////////////////////////////last name check
if( LastName.trim()!= "")//if( FirstName1 == "")	
	{
		if(LastName.indexOf(";")> -1 )
		{
			if(version == "EN")
			{
				str = showFailAlertMessage("<i><strong>Last Name</strong></i> can not contain '';'' or '','' ,''.'' ")
			}else
			{
				str = showFailAlertMessage("<i><strong>নামের শেষ অংশ</strong></i>&nbsp;   এ '';'' অথবা '','' ,''.'' থাকবে না")
			}
			fieldName = "txtLastName"			
			return str;
		}
		
		if(LastName.indexOf("<script>")> -1 )
		  {
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter a valid input !")
				}else
				{
					str = showFailAlertMessage("সঠিক তথ্য দিন")
				}
			
				fieldName = "txtLastName"
				return str; 
		  }
		
		if(LastName.length > 50)
		  {
			 if(version == "EN")
				{
					str = showFailAlertMessage("<i><strong>Last Name:</strong></i> Maximum 50 characters")
				}else
				{
					str = showFailAlertMessage("<i><strong>নামের শেষ অংশ</strong></i>&nbsp;  ৫০ অক্ষরের বেশি হবে না")
				}
				fieldName = "txtLastName"
				return str;
		  }
		  $("#txtLastName").parent().removeClass("has-error"); 
}else
{
		 $("#txtLastName").parent().removeClass("has-error"); 
}
////////*****************************end last name *******************************//////	 
///////////////////////////////////////////////////////////////father name check
	if(Fname.trim() != "")
	  {
		  if(Fname.indexOf("<script>")> -1 )
		  {
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter a valid input !")
				}else
				{
					str = showFailAlertMessage("সঠিক তথ্য দিন")
				}
				fieldName = "txtFName"
				return str;
		  }
		  
		  if(Fname.length > 50)
		  {
			 if(version == "EN")
				{
					str = showFailAlertMessage("<i><strong>Father's Name:</strong></i> Maximum 50 characters");
				}else
				{
					str = showFailAlertMessage("<i><strong>পিতার নাম</strong></i>&nbsp;   ৫০ অক্ষরের বেশি হবে না")
				}
				fieldName = "txtFName"
				return str; 
		  }
		   $("#txtFName").parent().removeClass("has-error"); 
		  
	  }else
	  {
		 $("#txtFName").parent().removeClass("has-error"); 
	  }
/////***********************end father  name ****************///
////////////////////////////////////////////mother name///
	  
	  if(Mname.trim() != "")
	  {
		  if(Mname.indexOf("<script>")> -1 )
		  {
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter a valid input !");
				}else
				{
					str = showFailAlertMessage("সঠিক তথ্য দিন")
				}
				fieldName = "txtMName"
				return str;
		  }
		  
		  if(Mname.length > 50)
		  {
			 if(version == "EN")
				{
					str = showFailAlertMessage("<i><strong>Mother's Name:</strong></i> Maximum 50 characters ")
				}else
				{
					str = showFailAlertMessage("<i><strong>মাতার নাম</strong></i>&nbsp;  ৫০ অক্ষরের বেশি হবে না")
				}
				fieldName = "txtMName"
				return str;
		  }
		   $("#txtMName").parent().removeClass("has-error"); 
		  
	  }else
	  {
		  $("#txtMName").parent().removeClass("has-error");
	  }
/////////////**************end mother name ***********************************//
///////////////birth date//////////////////////////////////////
		birthDateMsg = birthDateValidation(version);
		if(birthDateMsg != true)
		{
			fieldName = "txtBirthDate"
			return birthDateMsg;
		}
//////***********end birthdate*****************************//
////////////////////////////////////////////////////////gender
if (GENDER=="-1")//Gender
	{
		  if(version == "EN")
		  {
			 str = showFailAlertMessage("Please select <i><strong>Gender</strong></i>")
		  }
		  else
		  {
			  str = showFailAlertMessage('<i><strong>লিঙ্গ</strong></i>&nbsp;   নির্বাচন করুন।')
		  }
		 fieldName = "cboGender";
		 return str;
		
	}else
	{
		$("#cboGender").parent().removeClass("has-error");
	}
//////***********end gender *****************************//
///////////////////////////////////////////// if NATIONALITY==""
	if(NATIONALITY.trim()=="")	
	{       
		if(version == "EN")
		{
			str = showFailAlertMessage('Please select <i><strong>Nationality</strong></i>');
		}
		else
		{
			str = showFailAlertMessage('<i><strong>জাতীয়তা</strong></i>&nbsp;খালি রাখা যাবে না');
		}
		fieldName = "otherNationality";
		return str;
		
	}else
	{
		$("#otherNationality").parent().removeClass("has-error");
	}
//**************************end NATIONALITY *******************************//
///////////////////////////////////// if NATIONAL ID!=""
if(NATIONALID!="")	
	{       
		if(isNaN(NATIONALID))	
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>National ID No</strong></i> contains only numeric value (0-9)');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>জাতীয় পরিচয়পত্র নং</strong></i>&nbsp;   অবশ্যই সংখ্যাসূচক হবে (০-৯)');
			}
			fieldName = "txtNationalId";
		    return str;
		}
		else
		{
			if(NATIONALID.lenght >17)	
			{
				if(version == "EN")
				{
					str = showFailAlertMessage('<i><strong>National ID No:</strong></i> Maximum 17 Numeric Value');
				}
				else
				{
					str = showFailAlertMessage('<i><strong>জাতীয় পরিচয়পত্র নং</strong></i>&nbsp;   ১৭ সংখ্যার বেশি হবে না');
				}
				fieldName = "txtNationalId";
		    	return str;
			}
		}
		$("#txtNationalId").parent().removeClass("has-error");
	  }
//**************************end national Id *******************************//
////////////////////////////////passport ////////////////////////////////////
if(passportNo != "")
	{
		var regex = /^[a-zA-Z0-9]*$/;
		if (!regex.test(passportNo)) 
		 {
			if(version == "EN")
			{
				str = showFailAlertMessage("Please use only letters (A-Z) and numbers (0-9)")
			}else
			{
				str = showFailAlertMessage("পাসপোর্ট নম্বর অবশ্যই অক্ষর (A-Z) এবং সংখ্যাসূচক(0-9) হবে ।")
			}
			fieldName = "passportNo";
			return str;
		}
		if(passportNo.lenght > 20)
		{	
			if(version == "EN")
			{
				str = showFailAlertMessage("Passport no lenght should be 20")
			}else
			{
				str = showFailAlertMessage("invalid passport")
			}
			fieldName = "passportNo";
			return str;
			
		}
		if(issueDate == "")
		{
			if(version == "EN")
			{
				str = showFailAlertMessage("Passport Issue Date cannot be empty.")
			}else
			{
				str = showFailAlertMessage("পাসপোর্ট ইস্যু তারিখ খালি রাখা যাবে না।")
			}
			fieldName = "issueDate";
			return str;
		}
		var strDateType='PID';
		if (isDate(issueDate, strDateType)==false)
		{
				if(version == "EN")
				{
					str = showFailAlertMessage("Please enter the valid <i><strong>Passport Issue Date</strong></i>")
				}
				else
				{
					str = showFailAlertMessage("সঠিক <i><strong>পাসপোর্ট ইস্যু তারিখ</strong></i>&nbsp;   নির্বাচন করুন")
				}
				return str;
	    }
				
		$("#passportNo").parent().removeClass("has-error"); 
		$("#issueDate").parent().removeClass("has-error"); 
		
}else
{
		 $("#passportNo").parent().removeClass("has-error"); 
		  $("#issueDate").parent().removeClass("has-error"); 
}//passport	
if(issueDate != "" && passportNo == "")
{
	if(version == "EN")
	{
		str = showFailAlertMessage("Passport no cannot be empty")
	}else
	{
		str = showFailAlertMessage("পাসপোর্ট নম্বর খালি রাখা যাবে না।")
	}
	fieldName = "passportNo";
	return str;
}
return true;		
}

function birthDateValidation(version)
{
	dt = document.getElementById("txtBirthDate").value;	
			var today = new Date();
				var birthDate = new Date(dt);
				var age = today.getFullYear() - birthDate.getFullYear();
				var m = today.getMonth() - birthDate.getMonth();
				if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
					age--;
				}
			if (dt=="")
               {
					
					 if(version == "EN")
					 {
						str = showFailAlertMessage("Please select the valid <i><strong>Date of Birth</strong></i>")
				     }
					 else
					 {
						 str = showFailAlertMessage("সঠিক <i><strong>জন্ম তারিখ</strong></i>&nbsp;   নির্বাচন করুন")
				     }
					 return str;
					
               }else
			   {
				   $("#txtBirthDate").parent().removeClass("has-error");
				  // return true;
			   }
			  if(age <12 || age > 85)
			  {
				  if(version == "EN")
				  {
					 str = showFailAlertMessage("<i><strong>Age<strong><i> must be between 12 to 85 years")
				  }
				  else
				  {
					 str = showFailAlertMessage("<i><strong>বয়স<strong><i> সীমা অবশ্যই ১২ থেকে ৮৫ এর মধ্যে হতে হবে।")
				  }
				  return str;
				
			 }else
			 {
				 $("#txtBirthDate").parent().removeClass("has-error");
				 //return true;
			 }
					
				
				var strDateType='DOB';
				if (isDate(dt, strDateType)==false)
				{
					if(version == "EN")
					{
						str = showFailAlertMessage("Please enter the valid <i><strong>Date of Birth</strong></i>")
				    }
					else
					{
						str = showFailAlertMessage("সঠিক <i><strong>জন্ম তারিখ</strong></i>&nbsp;   নির্বাচন করুন")
				    }
					return str;
				}else
				{
					$("#txtBirthDate").parent().removeClass("has-error");
					//return true;
				}
return true;
}
function primaryEmailValidation(EMAIL_1,version)
{
	if(EMAIL_1 != "")
	 {
		
		//alert(isValidEmailaddress(EMAIL_1));
		if (isValidEmailaddress(EMAIL_1)==false)
		{ 
			  if(version == "EN")
			  {
				  str = showFailAlertMessage("Please enter a valid <i><strong>Email Address</strong></i>. Email should not contain ''<i><strong>Space</strong></i>'' , '';''  , '','' & ''||''");
				}
			  else
			  {
				str = showFailAlertMessage("সঠিক <i><strong>ইমেইল</strong></i>&nbsp;   লিখুন, ইমেইল এ অবশ্যই ''Space'' , '';''  , '','' & ''||'' থাকবে না");
			 }
			return str;
		}
		 //alert charecter limit
		else if(EMAIL_1.length > 50)
		{
			if(version == "EN")
			{
				str = showFailAlertMessage('<i><strong>Email Address:</strong></i> Maximum 50 characters');
			}
			else
			{
				str = showFailAlertMessage('<i><strong>ইমেইল</strong></i>&nbsp;  ৫০ অক্ষরের বেশি হবে না');
			}
			return str;	
			//document.getElementById('txtPhone_Off').style.backgroundColor="#FFFFCC";
		}
		else
		{
		$("#txtEmail1").parent().removeClass("has-error");	
		}
	 }
	 return true;
}

function primaryMobileValidation(MOBILE,version)
{
	
	if(MOBILE != "")
			{
				if(MOBILE.indexOf("<script>")> -1)
				{
					if(version == "EN")
					{
						str = showFailAlertMessage('Invalid <i><strong>Mobile No</strong></i>');
					}
					else
					{
						str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ক্ষেত্রটিতে সঠিক তথ্য দিন');
					}
					return str;
				}
				
				if(MOBILE.length > 50)
				{
					if(version == "EN")
					{
						str = showFailAlertMessage('<i><strong>Mobile No:</strong></i> Maximum 50 characters');
					}
					else
					{
						str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   ৫০ সংখ্যার বেশি হবে না');
					
					}
					
					return str;
					//document.getElementById('txtMobile').style.backgroundColor="#FFFFCC";
				}
				if(!isNaN(MOBILE)== false)
			      {
				   
					if(version == "EN")
					{
						str = showFailAlertMessage(' <i><strong>Mobile No</strong></i> contains only numeric value (0-9)');
						
					}
					else
					{
						str = showFailAlertMessage('<i><strong>মোবাইল নং</strong></i>&nbsp;   অবশ্যই সংখ্যাসূচক হবে (০-৯)');
						
					}
						
					return str;
					
			   }
				if(MOBILE.indexOf("'")> -1 || MOBILE.indexOf("%")> -1 || MOBILE.indexOf("#")> -1 || MOBILE.indexOf("@")> -1 || MOBILE.indexOf("&")> -1)
				{
					if(version == "EN")
					{
						str = showFailAlertMessage("<i><strong>Mobile No</strong></i>  cannot contain ''%'',''#'',''@'',''&'', ''lsquo''");
						
					}
					else
					{
						str = showFailAlertMessage("<i><strong>মোবাইল নং</strong></i>&nbsp;   ''%'',''#'',''@'',''&'' , ''lsquo'' থাকবে না");
						
					}
					
					return str;
					//document.getElementById('txtMobile').style.backgroundColor="#FFFFCC";
				}
				
	}
	return true;
			
}

//Author : Sufia
function cnahgeValueCai(){
	// get look for value
	//if ($("#levelRadio").is(":checked")) 
	if ($('input[name=optLevel]:checked').length != '0'){
	 document.getElementById("lookForView").value = "";
	 document.getElementById("lookForView").value  = document.querySelector('input[name = "optLevel"]:checked').value + " Level Job";
	}
  //get availebel 
	if ($('input[name=optAvail]:checked').length != '0'){
	  document.getElementById("availView").value = "";
	 document.getElementById("availView").value  = document.querySelector('input[name = "optAvail"]:checked').value ;
	}
}

//modified by sufia
function Career_Application_Validate(version) 
{
 var OBJ=document.getElementById('txtObjective').value
 var Message=document.getElementById('alertDiv_cai');
	if(OBJ.trim()=="")
			{
				if(version == "EN")
				{
					str = showFailAlertMessage("<i><strong>Objective</strong></i> cannot be empty")
				}else
				{
					str = showFailAlertMessage("<i><strong>অবজেক্টিভ</strong></i>&nbsp;   খালি রাখা যাবে না");
				}
			    Message.innerHTML = str;
				return false;
			}
}

function Category_Location_Organization_Validate(version)
{

var PRE_spe_CAT=document.getElementById("selected_blue_Cat").value;
var totalPrefspeCat = document.getElementById("hidCountBlueCat").value;
var Message=document.getElementById('alertDiv_jclo');			
var form1=document.getElementById("form1");
var isBlueColor = document.getElementById('isBlueColor').value;
var bool_value = isBlueColor == "False" ? false : true

if (bool_value)
{
	if(PRE_spe_CAT =="")
		{
			  if(version == "EN")
			  {
				 str = showFailAlertMessage("You have to select at least one <i><strong>Preferred special skills<i><strong>");
			  }
			  else
			  {
				 str = showFailAlertMessage("স্পেশাল স্কিলড ক্যাটাগরি থেকে অন্তত একটি ক্যাটাগরি নির্বাচন করুন");
			  }
			  Message.innerHTML = str;
			  return false;
		 }
}
else
{
	var PRE_func_CAT=document.getElementById("selected_Cat").value;
	var totalPrefFuncCat = document.getElementById("hidCountCat").value;
	var JOB_LOCATION=document.getElementById("selected_Dist").value;
	if(PRE_func_CAT=="" && PRE_spe_CAT =="")
		{
			  if(version == "EN")
			  {
				 str = showFailAlertMessage("You have to select at least one <i><strong>Preferred Category<i><strong>");
			  }
			  else
			  {
				 str = showFailAlertMessage("ফাংশনাল অথবা স্পেশাল স্কিলড ক্যাটাগরি থেকে অন্তত একটি ক্যাটাগরি নির্বাচন করুন");
			  }
			  Message.innerHTML = str;
			  return false;
		 }
}


 
 //if (document.getElementById("optJobArea").checked)
// {	
//	
//	var reLocationType=document.getElementById("optJobArea").value;
//	if (reLocationType=="Selection")
//	{
//		if (JOB_LOCATION=="" && JOB_LOCATION==null)
//			{
//				if (version == "EN")
//				{
//					str = showFailAlertMessage("Please select preferred Job Location!");
//				}else
//				{
//					str = showFailAlertMessage("পছন্দের কাজের স্থান নির্বাচন করুন।");
//				}
//				
//				Message.innerHTML = str;
//				return false;
//			}
//	}
// }
  //ga('send','event','Updateinformation','click','Preferred Areas',1);

}
function Other_relevant_information(version)
{
	var Message=document.getElementById('alertDiv_ori');
	var KEYWORD=document.getElementById('txtKeyword').value//form1.txtKeyword.value;//
	if(KEYWORD=="")
	{
		if (version == "EN")
		{
			str = showFailAlertMessage("<i><strong>Keywords</strong></i> cannot be empty");
		}else
		{
			str = showFailAlertMessage("<i><strong>কীওয়ার্ড</strong></i>&nbsp;  খালি রাখা যাবে না");
		}
		//form1.
		Message.innerHTML = str;
		return false;
	}
}

function trim_it(string_txt)
{
elem = string_txt ; ///document.getElementById(filename) ;
 while(elem.charAt(0)==' ')// Ltrim
	{
	elem = elem.substring(1,elem.length);
	}
 while(elem.charAt(elem.length - 1)==' ') // rtrim
	{
	elem = elem.substring(0,elem.length - 1);
	}
 return elem ;

}


function DisableNationality()
{
		 if ($("#bangladeshi").is(':checked')) {
			 $("#otherNationality").val("Bangladeshi");
			
			$("#otherNationality").prop('disabled', true);
    	 } else {
			  $("#otherNationality").val("");
			 $(" #otherNationality").prop('disabled', false);
    	 }
}

//load location or country name in dorpdown list ////////////////////////////
function LoadLocations(intOption)
	{
	//var strHtml = "";
//	document.getElementById("spnCurrentLocation").innerHTML = "";
//	//strHtml += "<table ><tr><td>" ;
//	strHtml += "<select name='cboPLocation' id='cboPLocation'  class='form-control from-control-modal combo'>"
//	if (intOption == "0")
//	{	strHtml = strHtml + districtList;}
//	else
//	{	strHtml = strHtml + countryList;}
//		
//	strHtml = strHtml + "</select>";
//	strHtml = strHtml + "</td></tr></table >" ;
	document.getElementById("txtCurrentLoc").value = "";
    currentLocation = intOption;
	}  


//Author Porag
function Details_Address_Validate(version,formName,errorMsgDiv) {
	//var LocationVal = document.getElementsByName('presentLocation').value; 
	var LocationVal = $('#'+formName+' input[name=presentLocation]:checked').val(); //Present_Address (Inside or Outside Bangladesh)
	var LocationValPermanent = $('#'+formName+' input[name=permanentLocation]:checked').val();
	var Message=document.getElementById(errorMsgDiv);

	var strPresentDistrict = $('#'+formName+' #present_district').val();
	var strPresentThana = $('#'+formName+' #present_thana').val();
	var strPresentCountry = $('#'+formName+' #present_country_list').val();
	var strPresentVillage = $('#'+formName+' #present_Village').val();

	var strPermanentVillage = $('#'+formName+' #permanent_Village').val();
	var strPermanentDistrict = $('#'+formName+' #permanent_district').val();
	var strPermanentThana = $('#'+formName+' #permanent_thana').val();
	var strPermanentCountry = $('#'+formName+' #permanent_country_list').val();

	if(LocationVal == 0){
		if (strPresentDistrict == '-1'){
			if (version == "EN"){
				str = showFailAlertMessage("Please select <i><strong>District</strong></i>");
				Message.innerHTML = str;
			}
			else{
				str = showFailAlertMessage("<i><strong> জেলা </strong></i>&nbsp;  নির্বাচন করুন");
				Message.innerHTML = str;
			}
			$("#"+formName+" #present_district").parent().addClass("has-error");
			return false;
		}
		else{
			$("#"+formName+" #present_district").parent().removeClass("has-error");
		}

		if (strPresentThana == '-1'){
			if (version == "EN"){
				str = showFailAlertMessage("Please select <i><strong>Thana</strong></i>");
				Message.innerHTML = str;
			}
			else{
				str = showFailAlertMessage("<i><strong> থানা/উপজেলা </strong></i>&nbsp;  নির্বাচন করুন");
				Message.innerHTML = str;
			}
			$("#"+formName+" #present_thana").parent().addClass("has-error");
			return false;
		}
		else{
			$("#"+formName+" #present_thana").parent().removeClass("has-error");
		}
	}
	else if(LocationVal == 1){//For the outside bangladesh 
		if (strPresentCountry == '-1'){
			if (version == "EN"){
				str = showFailAlertMessage("Please select <i><strong>Country</strong></i>");
				Message.innerHTML = str;
			}
			else{
				str = showFailAlertMessage("<i><strong> দেশ </strong></i>&nbsp;  নির্বাচন করুন");
				Message.innerHTML = str;
			}
			$("#"+formName+" #present_country_list").parent().addClass("has-error");
			return false;
		}
		else{
			$("#"+formName+" #present_country_list").parent().removeClass("has-error");
		}
	}else
	{
		if (version == "EN")
		{
				str = showFailAlertMessage("Please give your <i><strong>Present address</strong></i>");
				Message.innerHTML = str;
		}
		else{
				str = showFailAlertMessage("আপনার বর্তমান ঠিকানা দিন");
				Message.innerHTML = str;
		}
		return false;
	}

	//PRESENT_VILLAGE
	if ($.trim(strPresentVillage) == ""){ // if PRESENT_VILLAGE
		if(version == "EN"){
			str = showFailAlertMessage('<i><strong>House No / Road / Village</strong></i> cannot be empty');
			Message.innerHTML = str;
		}
		else{
			str = showFailAlertMessage('<i><strong>বাসা নং / রাস্তা / গ্রাম</strong></i>&nbsp;   ক্ষেত্রটি পূরণ করুন।');
			Message.innerHTML = str;
		}			
		$("#"+formName+" #present_Village").parent().addClass("has-error");
		return false;
	}
	else if (strPresentVillage.length > 150){ 
		if(version == "EN"){
			str = showFailAlertMessage('<i><strong>House No / Road / Village</strong></i>  should be limited of 150 characters');
			Message.innerHTML = str;
		}
		else{
			str = showFailAlertMessage('<i><strong>বাসা নং / রাস্তা / গ্রাম</strong></i>&nbsp;   ১৫০ অক্ষরের বেশি হবে না');
			Message.innerHTML = str;
		}				
		$("#"+formName+" #present_Village").parent().addClass("has-error");
		return false;
	}
	else{
		$("#"+formName+" #present_Village").parent().removeClass("has-error");
	}

	// //PERMANENT_VILLAGE
	// if (strPermanentVillage.length > 250){ // if PERMANENT_VILLAGE
	// 	if(version == "EN"){
	// 		str = showFailAlertMessage('<i><strong>House No/ Road / Village</strong></i>  should be limited of 250 characters');
	// 		Message.innerHTML = str;
	// 	}
	// 	else{
	// 		str = showFailAlertMessage('<i><strong>বাসা নং / রাস্তা / গ্রাম</strong></i>&nbsp;   ২৫০ অক্ষরের বেশি হবে না');
	// 		Message.innerHTML = str;
	// 	}				
	// 	$("#"+formName+" #permanent_Village").parent().addClass("has-error");
	// 	return false;
	// }
	// else{
	// 	$("#"+formName+" #permanent_Village").parent().removeClass("has-error");
	// }

	// //If select Country or District then must select Inside or Outside Bangladesh
	// if (strPermanentDistrict != '-1' || strPermanentCountry != '-1'){
	// 	if ($('#'+formName+' input[name=permanentLocation]:checked').length <= 0) {
	// 		if (version == "EN"){
	// 			str = showFailAlertMessage("Please select <i><strong>country</strong></i>");
	// 			Message.innerHTML = str;
	// 		}
	// 		else{
	// 			str = showFailAlertMessage("<i><strong> দেশ </strong></i>&nbsp;  নির্বাচন করুন");
	// 			Message.innerHTML = str;
	// 		}
	// 	}
	// 	$("#"+formName+" #pr_Option").parent().addClass("has-error");
	// 	return false;
	// }
	// else{
	// 	$("#"+formName+" #pr_Option").parent().removeClass("has-error");
	// }

	//Validation for permanent address
	if($('#'+formName+ ' .same-address').is(':checked')){ 
		console.log('Same as present!');
	}
	else{
		if ($('#'+formName+' input[name=permanentLocation]:checked').length > 0){
			if(LocationValPermanent == 0){
				if (strPermanentDistrict == '-1'){
					if (version == "EN"){
						str = showFailAlertMessage("Please select <i><strong>District</strong></i>");
						Message.innerHTML = str;
					}
					else{
						str = showFailAlertMessage("<i><strong> জেলা </strong></i>&nbsp;  নির্বাচন করুন");
						Message.innerHTML = str;
					}
					$("#"+formName+" #permanent_district").parent().addClass("has-error");
					return false;
				}
				else{
					$("#"+formName+" #permanent_district").parent().removeClass("has-error");
				}
		
				if (strPermanentThana == '-1'){
					if (version == "EN"){
						str = showFailAlertMessage("Please select <i><strong>Thana</strong></i>");
						Message.innerHTML = str;
					}
					else{
						str = showFailAlertMessage("<i><strong> থানা/উপজেলা </strong></i>&nbsp;  নির্বাচন করুন");
						Message.innerHTML = str;
					}
					$("#"+formName+" #permanent_thana").parent().addClass("has-error");
					return false;
				}
				else{
					$("#"+formName+" #permanent_thana").parent().removeClass("has-error");
				}
			}
			else{//For the outside bangladesh 
				if (strPermanentCountry == '-1'){
					if (version == "EN"){
						str = showFailAlertMessage("Please select <i><strong>Country</strong></i>");
						Message.innerHTML = str;
					}
					else{
						str = showFailAlertMessage("<i><strong> দেশ </strong></i>&nbsp;  নির্বাচন করুন");
						Message.innerHTML = str;
					}
					$("#"+formName+" #permanent_country_list").parent().addClass("has-error");
					return false;
				}
				else{
					$("#"+formName+" #permanent_country_list").parent().removeClass("has-error");
				}
			}
			//PERMANENT_VILLAGE
			if ($.trim(strPermanentVillage) == ""){ // if PERMANENT_VILLAGE
				if(version == "EN"){
					str = showFailAlertMessage('<i><strong>House No / Road / Village</strong></i> cannot be empty');
					Message.innerHTML = str;
				}
				else{
					str = showFailAlertMessage('<i><strong>বাসা নং / রাস্তা / গ্রাম</strong></i>&nbsp;   ক্ষেত্রটি পূরণ করুন।');
					Message.innerHTML = str;
				}			
				$("#"+formName+" #permanent_Village").parent().addClass("has-error");
				return false;
			}
			else if (strPermanentVillage.length > 150){ 
				if(version == "EN"){
					str = showFailAlertMessage('<i><strong>House No / Road / Village</strong></i>  should be limited of 150 characters');
					Message.innerHTML = str;
				}
				else{
					str = showFailAlertMessage('<i><strong>বাসা নং / রাস্তা / গ্রাম</strong></i>&nbsp;   ১৫০ অক্ষরের বেশি হবে না');
					Message.innerHTML = str;
				}				
				$("#"+formName+" #permanent_Village").parent().addClass("has-error");
				return false;
			}
			else{
				$("#"+formName+" #permanent_Village").parent().removeClass("has-error");
			}
		}
		else{
			if (strPermanentDistrict != '-1' || strPermanentCountry != '-1' || $.trim(strPermanentVillage) != ""){
				if ($('#'+formName+' input[name=permanentLocation]:checked').length <= 0) {
					if (version == "EN"){
						str = showFailAlertMessage("Please select <i><strong>Country</strong></i>");
						Message.innerHTML = str;
					}
					else{
						str = showFailAlertMessage("<i><strong> দেশ </strong></i>&nbsp;  নির্বাচন করুন");
						Message.innerHTML = str;
					}
				}
				$("#"+formName+" #pr_Option").addClass("has-error");
				return false;
			}
			else{
				$("#"+formName+" #pr_Option").removeClass("has-error");
			}
		}
	}
}

//author: porag
//Location load function 
function GetLoadLocations(LocatonType,status,lang,formName){
	var strHtml = "";
	var e = $("#"+formName+" "+"#"+status+"_district");
	var p = $("#"+formName+" "+"#"+status+"_thana");
	if(LocatonType == 1)
	{
		//var strID = p.options[p.selectedIndex].value;
		var strID = p.val();
	}else
	{
		//var strID = e.options[e.selectedIndex].value;
		var strID = e.val();
	}
	
	$.ajax({
		type: "post",
		url: "https://mybdjobs.bdjobs.com/new_mybdjobs/loadDistrict_ajax.asp" ,
		//data: {"id": strDistrictID},
		data: {
    		id: strID,
    		type: LocatonType,
            strVersion: lang
			},
		dataType: "html",
		cache: false,
		async:false,
		success: function(responseText){
			//console.log("ppp"+responseText);
			if(LocatonType == 1){
				strHtml += "<select name='"+status+"_p_office' id='"+status+"_p_office'  class='form-control'>"
				strHtml = strHtml + responseText;
				// if(lang == "EN"){
				// 	strHtml = strHtml + "<option value='-1'>Other</option>"
				// }else{
				// 	strHtml = strHtml + "<option value='-1'>অন্যান্য</option>"
				// }
				strHtml = strHtml + "</select>";
				$("#"+formName+" "+"#"+status+"_POLocation").html("");
				$("#"+formName+" "+"#"+status+"_POLocation").html(strHtml);
			}
            else{
				strHtml += "<select name='"+status+"_thana' id='"+status+"_thana'  class='form-control' onchange='GetLoadLocations(1,\""+status+"\",\""+lang+"\",\""+formName+"\");'>"
				strHtml = strHtml + responseText;
				strHtml = strHtml + "</select>";
				$("#"+formName+" "+"#"+status+"_thanaLocation").html("");
				$("#"+formName+" "+"#"+status+"_thanaLocation").html(strHtml);
			}
			//console.log(responseText);
		},
		error: function(responseText){
			console.log(responseText);
			//alert(responseText);
		}
	});
}

//author: porag 
//Details_Address pop-up ajax function 
function commonUpdate_ForPopUp(url,formName,divID,lanType)
{
	var type_other=divID.split('_')[0];
	var itemNo=divID.split('_')[1];
	$('#'+formName+ '.btn-primary').prop('disabled', true);
	$('#div_'+type_other+' #'+formName+' .btn-primary').attr("disabled","disabled");
	if(Details_Address_Validate(lanType,'addressFormPopup','alertDiv_adrs_popup') == false)
	{
		$('#div_'+type_other+' #'+formName+' .btn-primary').removeAttr("disabled");
		return false;
	}
	if(url.indexOf("https://mybdjobs.bdjobs.com/new_mybdjobs")==-1)
	{
		url=mainUrl+url;
	}
	$.ajax({
			type: "POST",
			url: url+'?version='+lanType,
			data:   $("#"+formName).serialize(),
			dataType: "html",
			cache: false,
			async:false,
			success: function(responseText){
				//console.log("pppp"+responseText);
				if(responseText.indexOf('added') > -1 || responseText.indexOf('updated') > -1)
					{
						var str;
						$('#editResumeModal').modal('hide');//Hide the modal 
						//setViewMode(divID);
						if(lanType == "EN")
						{
							if(responseText.indexOf('added') > -1)
							{
								str = "The information has been added successfully"
							}else
							{
								str = "The information has been updated successfully"
							}
						}else
						{
							if(responseText.indexOf('added') > -1)
							{
								str = "তথ্য সফলভাবে যুক্ত করা হয়েছে"
							}else
							{
								str = "তথ্য সফলভাবে আপডেট করা হয়েছে"
							}
						}
						
						//var strApplyId=document.getElementById("JOB_CID");
						var destination = document.getElementById("destinationPage");
						
						//if (strApplyId!=null )
//						{
//							if ( strApplyId.value!='')
//							{
//							location.reload(true);
//							}
//						}
						
						if(destination != null)
						{
							if(destination.value != "")
							{
								var destinationval = destination.value;
								window.location.replace(destinationval);
							}
						}
						
						
						if($("#commonForm_"+type_other).length != 0){
								var responseStr = responseText;
								var responseStr = responseStr.substring(responseStr.indexOf(".")+1);
								
								if($('#commonForm_'+type_other+'_'+itemNo).length == 0) {
									d = document.createElement('div');
									$(d).attr('id', 'commonForm_'+type_other+'_'+itemNo);
									$(d).html(responseStr);						//var newForm=$('#commonForm_'+type_other+'_'+itemNo).prepend(str);
									 $("#commonForm_"+type_other).append(d)
								
							  //it doesn't exist
								}
								
								else
								{
									$('#commonForm_'+type_other+'_'+itemNo).html(responseStr);
								}
								$("#div_"+type_other).empty();
								showSuccessAlertMessage(str);
						}
						
						else
						{
							//str=showSuccessAlertMessage(str);
							
							showSuccessAlertMessage(str);
							
							$('#alertDiv_adrs_popup').empty();
						}
						
						
						/*if((type_other == 'per'))
						{
							if($('.collapsed').hasClass('disabled'))
							{
								$('.collapsed').removeClass('disabled')	;
								$('.btn-tab-education').removeClass('disabled')	;
								$('.btn-tab-employment').removeClass('disabled')	;
								$('.btn-tab-others').removeClass('disabled')	;
								$('.btn-tab-photograph').removeClass('disabled')	;
								
							}
							if($('#cboMStatus').hasClass('btn-form-control'))
							{
								$('#cboMStatus').removeClass('btn-form-control');
								$('#cboMStatus').removeClass('hidden');
							}
						}*/
						
						$("#btnAdd_" + type_other).prop('disabled', false);

						//New code 
						//location.reload(true);

					}
				else
					{
						if((type_other == 'spe'))
						{
							$('#noData_spe').css({
								display: 'inline'
							});
							$('.spe_0').empty();
							$("#btnAdd_" + type_other).prop('disabled', false);
						}
						//alert(responseText)
						//var str = responseText;
						var str = showFailAlertMessage(responseText);
						//$('#alertDiv_'+type_other+'_'+itemNo).removeClass("hidden alert-success")
						//$('#alertDiv_'+type_other+'_'+itemNo).addClass("alert-danger");
						
						// $('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).empty();
						// $('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).removeClass("hidden");
						// $('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);

						$('#alertDiv_adrs_popup').empty();
						$('#alertDiv_adrs_popup').removeClass("hidden");
						$('#alertDiv_adrs_popup').html(str);
						
					}
					
					console.log(responseText);
			},
			error: function(responseText){
				console.log(responseText);
				//alert(responseText);
			},
			complete: function() {
			  $('#div_'+type_other+' #'+formName+' .btn-primary').removeAttr("disabled"); // will fire either on success or error
			}
		});
} 


//New Code 02.12.2018
function FormValidation_ForPopUp(lanType) {
	if (Details_Address_Validate(lanType, 'addressFormPopup', 'alertDiv_adrs_popup') == false) {
		//console.log("Validation False !");
		return false;
	} else {
		//console.log("Validation True !");
		$('#alertDiv_adrs_popup').empty();
		$('.modal').addClass('view-mode-wrap');
		$('.modal').removeClass('edit-mode-wrap');
		//$(this).parents('.modal').addClass('view-mode-wrap').removeClass('edit-mode-wrap');
		var viewPresentAddress = "";
		if ($('.present-address .outside').is(':checked')) {
			var present_country_list = $(
				'.present-address #present_country_list option:selected').text();
			var present_Village = $('.present-address #present_Village').val();
			viewPresentAddress = present_Village + ', ' + present_country_list;
		} else {
			var present_district = $('.present-address #present_district option:selected').text();
			var present_thana = $('.present-address #present_thana option:selected').text();
			var present_POLocation = $('.present-address #present_POLocation option:selected').text();
			var presentPoLocationVal = $('.present-address #present_POLocation option:selected').val();
			var present_Village = $('.present-address #present_Village').val();
			if(presentPoLocationVal != "-1"){
				viewPresentAddress = present_Village + ', ' + present_POLocation + ', ' +
				present_thana + ', ' + present_district;
			}else{
				viewPresentAddress = present_Village + ', ' + present_thana + ', ' + present_district;
			}
		}
		$('#editResumeModal .present-address .view-present-address').text(
			viewPresentAddress);

		var viewpermanentAddress = "";
		if ($('#editResumeModal .same-address').is(':checked')) {
			$('#editResumeModal .permanent-address').addClass('hide');
		} else {
			if ($('#addressFormPopup input[name=permanentLocation]:checked').length > 0){
				$('#editResumeModal .permanent-address').removeClass('hide');
				if ($('#addressFormPopup .permanent-address .outside').is(':checked')) {
					var permanent_country_list = $(
						'#addressFormPopup .permanent-address #permanent_country_list option:selected').text();
					var permanent_Village = $('#addressFormPopup .permanent-address #permanent_Village').val();
					viewpermanentAddress = permanent_Village + ', ' + permanent_country_list;

				} else {
					var permanent_district = $(
						'#addressFormPopup .permanent-address #permanent_district option:selected').text();
					var permanent_thana = $(
						'#addressFormPopup .permanent-address #permanent_thana option:selected')
						.text();
					var permanent_POLocation = $(
						'#addressFormPopup .permanent-address #permanent_POLocation option:selected').text();
					var permanentPoLocationVal = $(
						'#addressFormPopup .permanent-address #permanent_POLocation option:selected').val();	
					var permanent_Village = $('#addressFormPopup .permanent-address #permanent_Village').val();
					if(permanentPoLocationVal != "-1"){
						viewpermanentAddress = permanent_Village + ', ' + permanent_POLocation +
						', ' + permanent_thana + ', ' + permanent_district;
					}else{
						viewpermanentAddress = permanent_Village + ', ' + permanent_thana + ', ' + permanent_district;
					}
				}
				$('#editResumeModal .permanent-address .view-permanent-address').text(
					viewpermanentAddress);
			}else{
				$('#editResumeModal .permanent-address .view-permanent-address').text(
					viewpermanentAddress);
			}
		}
	}
}

