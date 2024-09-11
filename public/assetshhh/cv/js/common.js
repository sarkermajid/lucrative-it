(function ($) {
    "use strict";
    $(document).ready(function () {
        $(function () {

/* ========================================================================== */
/* =========> Toggle Menu Activate
/* ========================================================================== */
$( "#clickble" ).click(function(e) {
$( this).next().toggleClass( "active_bar" );
$( this).next().slideToggle( "slow" );
e.preventDefault();
});
$( ".menu_toggle" ).click(function(e) {
$( this).next().slideToggle( "slow" );
e.preventDefault();
});


      });
    });
})(jQuery);

//Email validation function
//Author : Sufia
//Param : Email ID
//Return : valid->true or invalid->false
function isValidEmailaddress(EmailAddress)
{
   //alert(EmailAddress);
   
	  // var filter=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	   var filter=/^[_a-zA-Z0-9-\s]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/;
	  //alert(filter.test(EmailAddress.value));
	 if (filter.test(EmailAddress)) 
	 {
		return true;
	 }else{
		 return false;
	 }
   
}
// for numeric validation
// Author : Rumana
function blockNonNumbers(obj,e, allowDecimal, allowNegative)
// for numeric validation

{
var key;
var isCtrl = false;
var keychar;
var reg;

if(window.event) {
key = e.keyCode;
isCtrl = window.event.ctrlKey
}
else if(e.which) {
key = e.which;
isCtrl = e.ctrlKey;
}

if (isNaN(key)) return true;

keychar = String.fromCharCode(key);

// check for backspace or delete, or if Ctrl was pressed
if (key == 8 || isCtrl)
{
return true;
}

reg = /\d/;
var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;

return isFirstN || isFirstD || reg.test(keychar);
}
//end function


// extract non-numeric character from input field
//author: Rumana
function extractNumber(obj, decimalPlaces, allowNegative)

{ 
	var temp = obj.value;
	
	// avoid changing things if already formatted correctly
	var reg0Str = '[0-9]*';
	if (decimalPlaces > 0) {
		reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
	} else if (decimalPlaces < 0) {
		reg0Str += '\\.?[0-9]*';
	}
	reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
	reg0Str = reg0Str + '$';
	var reg0 = new RegExp(reg0Str);
	if (reg0.test(temp)) return true;

	// first replace all non numbers
	var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
	var reg1 = new RegExp(reg1Str, 'g');
	temp = temp.replace(reg1, '');

	if (allowNegative) {
		// replace extra negative
		var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
		var reg2 = /-/g;
		temp = temp.replace(reg2, '');
		if (hasNegative) temp = '-' + temp;
	}
	
	if (decimalPlaces != 0) {
		var reg3 = /\./g;
		var reg3Array = reg3.exec(temp);
		if (reg3Array != null) {
			// keep only first occurrence of .
			//  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
			var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
			reg3Right = reg3Right.replace(reg3, '');
			reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
			temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
		}
	}
	
	obj.value = temp;
}


function confirmation(ID,tableName)
{

msg="Are you sure, you want to delete this record?";
	var t=window.confirm(msg);
if (t)
 {
	 //location.href="delete.asp?id="+ID+"&tbl="+tableName+"&userID="+uID;
	 location.href="https://mybdjobs.bdjobs.com/mybdjobs/delete.asp?id="+ID+"&tbl="+tableName;
 }
else
{return false;}
}

function CompareDateIsInValid(cBigDate,cSmallDate)
	{

	var bDay;
	var bMon;
	var bYear;
	
	var sDay;
	var sMon;
	var sYear;
//	alert('Into validation');
	//var listArray = stringList.split(",");
	var bArray = cBigDate.split("/");
	var sArray = cSmallDate.split("/");
	
	 bMon=bArray[0];
	 bDay=bArray[1];
	 bYear=bArray[2];
	
	 sMon=sArray[0];
	 sDay=sArray[1];
	 sYear=sArray[2];
	
	if (parseInt(sYear) > parseInt(bYear))
		{
		return true;
		}
	else if(parseInt(sYear) < parseInt(bYear))
		{
			return false;			
		}
	else if(parseInt(sYear) == parseInt(bYear))
		{
			if (parseInt(sMon) > parseInt(bMon))
				{
				return true;
				}
			else if(parseInt(sMon) < parseInt(bMon))
				{
				return false;
				}
			else if(parseInt(sMon) == parseInt(bMon))
				{
					if (parseInt(sDay) > parseInt(bDay))
						{
							return true;
						}
					else
						{
							return false;
						}


				}


		}


	}

function inputFieldValidation(type_other,itemNo)
{
	var enableFormSubmit = true;
	var strErrorMsg = "<strong>Please fill the required field(s)</strong><ul>";
	
	 $('#'+type_other+'Form_'+itemNo+' .jqValidate_'+type_other).each(function() 
	 {
	   var dat = $(this).val();
		  var $this = $(this);
		  var name = $this.attr('name');
		  var inputName=name.slice(3,name.length);
		  if(inputName.indexOf("Date")>0)
		  {
			  inputName = inputName.substring(0,inputName.indexOf("Date")) + " " + inputName.substr(inputName.indexOf("Date"));
		  }
		   if(inputName.indexOf("No")>0)
		  {
			  inputName = inputName.substring(0,inputName.indexOf("No")) + " " + inputName.substr(inputName.indexOf("No"));
		  }
		  var hasError=false;
		  var charectersLimit=parseInt($this.attr('id'));
		  if ($this.hasClass("mandatory"))
		  {
			  	
			  	   
				  if( $this.val()=="Select" ) 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please select <i><strong>' + inputName + '</strong></i> Proficiency. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if( inputName=="Certification" && $this.val()=="" ) 
				  {
					  enableFormSubmit = false;
					    strErrorMsg += '<li> <i><strong>' + inputName + ' Title</strong></i> cannot be empty. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if( inputName=="Title"  && $this.val()=="") 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please enter <i><strong> Training ' + inputName + '</strong></i>. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if( inputName=="Year" && $this.val()=="" ) 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please enter <i><strong>Training ' + inputName + '</strong></i>. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if( inputName=="Institute" && $this.val()=="" ) 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please enter <i><strong>' + inputName + ' Name </strong></i>. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if( $this.val()=="Year" ) 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please enter <i><strong>' + inputName + ' Year </strong></i>. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if ($this.hasClass("datepicker") && $this.val().trim()=="")
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li>Please select <i><strong>' + inputName + '</strong></i>. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
				  else if($this.val().trim()=="" ) 
				  {
					  enableFormSubmit = false;
					  strErrorMsg += '<li> <i><strong>' + inputName + '</strong></i> cannot be empty. </li>';
					  $this.parent().addClass("has-error");
					  hasError=true;
				  }
			}
			
			if ($this.hasClass("numeric") && $this.val().trim()!=""){
				if (isNaN($this.val()) || ($this.val() != parseInt($this.val(), 10))){
					enableFormSubmit = false;
				    strErrorMsg += '<li> <i><strong>' + inputName + '</strong></i> field allows only numeric values. </li>';
				    $this.parent().addClass("has-error");
				    hasError=true;	
				}
			}
			  
		   if ($this.val().trim().length>charectersLimit)
			{
				 enableFormSubmit = false;
				 strErrorMsg += '<li> <i><strong>' + inputName + '</strong></i> field should be limited of '+charectersLimit+' characters. </li>';
				 $this.parent().addClass("has-error");
				  hasError=true;
			}
			
			if ($this.hasClass("datepicker") && $this.val().trim()!=""){
				var CUR_DATE=document.getElementById('hCurrentDate').value;
				var value = $this.val();
				var toDateSelector = '#'+type_other+'Form_'+itemNo+' .toDate';
				var toDate = $(toDateSelector).val();
				var name = $(toDateSelector).attr('name');
				var toDateName=name.slice(3,name.length);
				if(toDateName.indexOf("Date")>0)
		        {
			  		toDateName = toDateName.substring(0,toDateName.indexOf("Date")) + " " + toDateName.substr(toDateName.indexOf("Date"));
		        }
				
				/*if (value =='-1' || value.trim()=='' ){
					enableFormSubmit = false;
				    strErrorMsg += '<li> Invalid' + inputName + '</li>';
				    $this.parent().addClass("has-error");
				    hasError=true;	
				}*/
				if($this.hasClass("fromDate") && (value == toDate))
				{
					enableFormSubmit = false;
				    strErrorMsg += '<li> <i><strong>' + inputName + '</strong></i> and <i><strong>'+ toDateName +'</strong></i> cannot be equal.</li>';
				    $this.parent().addClass("has-error");
				    hasError=true;
				}
				
				if (checkdate(value,"/")==false){
					enableFormSubmit = false;
				    strErrorMsg += '<li> Enter <i><strong> ' + inputName + ' </strong></i> at this mm/dd/yyyy format. </li>';
				    $this.parent().addClass("has-error");
				    hasError=true;
				}
				
				if (!$this.hasClass('greater') && CompareDateIsInValid(CUR_DATE,value)){
					enableFormSubmit = false;
				    strErrorMsg += '<li> <i><strong> ' + inputName + '</strong></i> cannot be greater than Current date.</li>';
					
				    $this.parent().addClass("has-error");
				    hasError=true;
				}
				
				if ($this.hasClass("fromDate") && CompareDateIsInValid(toDate,value)){
					enableFormSubmit = false;
				    strErrorMsg += '<li> <i><strong>' + inputName + '</strong></i> cannot be greater than '+ toDateName +'.</li>';
				    $this.parent().addClass("has-error");
				    hasError=true;
				}
			}
			
			if ( hasError==false)
			{
				
			  $this.parent().removeClass("has-error")
			}
		});
	  
	 if(!enableFormSubmit) 
	  {
		  //alert(errorMessage);
		  $('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).removeClass("hidden");
		  
		  strErrorMsg+="</ul>"
		  var str=showFailAlertMessage(strErrorMsg)
		  $('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);
	  }
	  
	  else
	  {
		  if (!$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).is("hidden"))
		  {
			$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).addClass(" hidden");
			
		   }
	  }
	   return enableFormSubmit;
}


function showFailAlertMessage(strMsg)
{
	var msgDiv = "<div class='alert alert-danger alert-dismissible m-t-20 m-b-0' role='alert'>";
	    msgDiv = msgDiv + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
		msgDiv = msgDiv + strMsg;
		msgDiv = msgDiv + "</div>";
		
		return msgDiv;
}

function checkdate(dtDate,strSeparator)
{
	var strDate;
	var strDateArray;
	var strDay;
	var strMonth;
	var strYear;
	var intday;
	var intMonth;
	var intYear;
	//var strSeparatorArray = new Array("-"," ","/",".");
//	var intElementNr;
	strDate = dtDate;
	var d = new Date(strDate);
    if( isNaN(d.valueOf()))
	{
		return false;
	};
	strDateArray = strDate.split(strSeparator);

	strMonth = strDateArray[0];
	strDay = strDateArray[1];
	strYear = strDateArray[2];

	intday = parseInt(strDay);
	intMonth = parseInt(strMonth);
	intYear = parseInt(strYear);

	if (intMonth>12 || intMonth<1)
	{
		return false;
	}

	if (intday>31 || intday<1)
	{
		return false;
	}

	if (intYear<1)
	{
		return false;
	}

	if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intday > 31 || intday < 1)) 
	{
	return false;
	}

	if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intday > 30 || intday < 1))
	{
		return false;
	}

	if (intMonth == 2)
	{
		if (intday < 1)
			{
				return false;
			}
		if (LeapYear(intYear) == true)
		{
			if (intday > 29)
			{
				return false;
			}
		}
	else
		{
		if (intday > 28)
			{
				return false;
			}
		}
	}
	return true;
}

function LeapYear(intYear)
{
	if (intYear % 100 == 0)
	{
		if (intYear % 400 == 0) { return true; }
	}
	else
	{
		if ((intYear % 4) == 0) { return true; }
	}
	return false;
}// JavaScript Document

//for successfull message
//$(document).on("click",".confirmation-message .close",function(){
//               $( ".confirmation-message").animate({
//                opacity: 1,
//                bottom: "-50",
//                display: "block"
//              }, function() {
//              });
//               $(this).parents('div.confirmation-message').fadeOut();
//             });
			 
function countLetter(textareanm , maxChar , spanName , MessageCaption , shouldShowSpan )
{

span_area = document.getElementById(spanName) ;
txtara = document.getElementById(textareanm)   ;
ev_v =  txtara.value ;
tfVal = parseInt(ev_v.length) ; 
maxChar = parseInt(maxChar) ; 




if(tfVal != 0){
window.status = tfVal ; 
if(lang == "EN"){
	shouldShowSpan == 1 ? span_area.innerHTML = "You wrote <b>"+tfVal+"</b> character(s)" : "" ;
}
else
{
	shouldShowSpan == 1 ? span_area.innerHTML = "আপনি <b>"+replaceTOBangla(tfVal)+"</b> অক্ষর লিখেছেন" : "" ;
}

	 if(tfVal >= ( maxChar + 1 ) ) 
	 {
		if(lang == "EN")
		{
			alert("Please stop writing on "+MessageCaption +", you are crossing the "+maxChar+" letter limit !") ;
		}
		else
		{
			alert(MessageCaption+" "+replaceTOBangla(maxChar)+ " অক্ষরের বেশি হবে না")
		}
		
		
		txtara.focus() ;
	 }// if(tfVal >= ( maxChar + 1 ) ) 
	 if(tfVal > maxChar )
	 {
	   nb =  txtara.value.substr(0, maxChar ) ;
	   txtara.value =  nb ;
	   if(lang == "EN"){
	   	shouldShowSpan == 1 ? span_area.innerHTML ="You wrote <b>"+nb.length+"</b> character(s)" : "" ;
	   }else
	   {
		   shouldShowSpan == 1 ? span_area.innerHTML ="আপনি <b>"+replaceTOBangla(nb.length)+"</b> অক্ষর লিখেছেন" : "" ;
	   }
	  }//if(tfVal > maxChar )
 
}//if(tfVal != 0)
else{
 window.status = "" ;
  shouldShowSpan == 1 ? span_area.innerHTML = "" : "" ;
 
        }//else of if(tfVal != 0)


}//end countLetter fnc// JavaScript Document
			 

function replaceTOBangla(strEnItem)
{
	
	//response.Write(stryear)
	var replaceBangla=[];
	    replaceBangla[0]="০";
		replaceBangla[1]="১";
		replaceBangla[2]="২";
		replaceBangla[3]="৩";
		replaceBangla[4]="৪";
		replaceBangla[5]="৫";
		replaceBangla[6]="৬";
		replaceBangla[7]="৭";
		replaceBangla[8]="৮";
		replaceBangla[9]="৯";
		
		 var sNumber = strEnItem.toString();
			var arrStringNumber=[];
		for (var i = 0, len = sNumber.length; i < len; i += 1) {
			arrStringNumber.push(+sNumber.charAt(i));
			}
	  	
		
	 var strBnItem="";
	 //response.Write(ubound(arrStringNumber))
	 //response.End()
	  for (var j=0,len=arrStringNumber.length; j<len;j += 1){
	   
	  
	  	strBnItem=strBnItem+replaceBangla[arrStringNumber[j]]
	   
	  }
	
	
		return strBnItem;
	
}			 
			 

              
