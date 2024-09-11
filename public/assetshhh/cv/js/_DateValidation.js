// Declaring valid date character, minimum year and maximum year
var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
	tmpYear = parseInt(year)
    return (((tmpYear % 4 == 0) && ( (!(tmpYear % 100 == 0)) || (tmpYear % 400 == 0))) ? 29 : 28 );
}
//function DaysArray(n) {
//	for (var i = 1; i <= n; i++) {
//		this[i] = 31;
//		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
//		if (i==2) {this[i] = 29}
//   } 
//   return this;
//}

function DaysArray(n) {
	var my_array = [];
	for (var i = 1; i <= n; i++) {
		 my_array.push = 31;
		if (i==4 || i==6 || i==9 || i==11) { my_array.push = 30}
		if (i==2) { my_array.push = 29}
   } 
   return  my_array;
}

function isDate(dtStr, strDateType){
	var daysInMonth = DaysArray(12);
	var pos1=dtStr.indexOf(dtCh);
	var pos2=dtStr.indexOf(dtCh,pos1+1);
	var strMonth=dtStr.substring(0,pos1);
	var strDay=dtStr.substring(pos1+1,pos2);
	var strYear=dtStr.substring(pos2+1);
	
	strYr=strYear;
	
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	
	month=parseInt(strMonth);
	day=parseInt(strDay);
	year=parseInt(strYr);
	
	/*THIS MESSAGE WILL NEVER DISPLAY IF DATE IS TAKEN FROM DROPDOWN LIST:*/
	if (pos1==-1 || pos2==-1){
		//alert("The date format should be : mm/dd/yyyy")		
		if (strDateType=="DOB")
		{
			if(lang == "EN")
			{
				alert("Please enter a valid Date of Birth.");
			}else
			{
				alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
			}
		}
		
		
		if (strDateType=="ProQualification")
		{
			alert("Please enter a valid Date in Professional Qualificaton.");
		}
		if (strDateType=="Experience")
		{
			alert("Please enter a valid Date in Experience.");
		}
		if (strDateType=="other")
		{
			alert("Please enter a valid Date");
		}
		
		return false;
	}
	
	if (strMonth.length<1 || month<1 || month>12){
		//alert("Please enter a valid month")
		if (strDateType=="DOB")
		{
			if(lang == "EN")
			{
				alert("Please enter a valid Date of Birth.");
			}else
			{
				alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
			}
		}
		
		
		
		if (strDateType=="ProQualification")
		{
			alert("Please enter a valid Date in Professional Qualificaton.");
		}
		
		if (strDateType=="Experience")
		{
			alert("Please enter a valid Date in Experience.");
		}
		if (strDateType=="other")
		{
			alert("Please enter a valid Date");
		}
		
		return false;
	}
	//|| (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		//alert("Please enter a valid day")
		if (strDateType=="DOB")
		{
			if(lang == "EN")
			{
				alert("Please enter a valid Date of Birth.");
			}else
			{
				alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
			}
		}

		if (strDateType=="ProQualification")
		{
			alert("Please enter a valid Date in Professional Qualificaton.");
		}

		if (strDateType=="Experience")
		{
			alert("Please enter a valid Date in Experience.");
		}
		if (strDateType=="other")
		{
			alert("Please enter a valid Date");
		}
		return false;
	}
	
	/*THIS MESSAGE WILL NEVER DISPLAY IF 4 DIGIT YEAR IS TAKEN FROM DROPDOWN LIST:*/
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		//alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		if (strDateType=="DOB")
		{
			if(lang == "EN")
			{
				alert("Please enter a valid Date of Birth.");
			}else
			{
				alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
			}
		}
		
		if (strDateType=="ProQualification")
		{
			alert("Please enter a valid Date in Professional Qualificaton.");
		}

		if (strDateType=="Experience")
		{
			alert("Please enter a valid Date in Experience.");
		}
		if (strDateType=="other")
		{
			alert("Please enter a valid Date");
		}

		return false;
	}
	
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){		
		if (strDateType=="DOB")
		{
			if(lang == "EN")
			{
				alert("Please enter a valid Date of Birth.");
			}else
			{
				alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
			}
		}

		if (strDateType=="ProQualification")
		{
			alert("Please enter a valid Date in Professional Qualificaton.");
		}

		if (strDateType=="Experience")
		{
			alert("Please enter a valid Date in Experience.");
		}
		if (strDateType=="other")
		{
			alert("Please enter a valid Date");
		}
		return false;
	}
	return true;
}




function isDate_bn(dtStr, strDateType){
	var daysInMonth = DaysArray(12);
	var pos1=dtStr.indexOf(dtCh);
	var pos2=dtStr.indexOf(dtCh,pos1+1);
	var strMonth=dtStr.substring(0,pos1);
	var strDay=dtStr.substring(pos1+1,pos2);
	var strYear=dtStr.substring(pos2+1);
	
	strYr=strYear;
	
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	
	month=parseInt(strMonth);
	day=parseInt(strDay);
	year=parseInt(strYr);
	
	/*THIS MESSAGE WILL NEVER DISPLAY IF DATE IS TAKEN FROM DROPDOWN LIST:*/
	if (pos1==-1 || pos2==-1){
		//alert("The date format should be : mm/dd/yyyy")		
		if (strDateType=="DOB")
		{
			alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
		}
		
		if (strDateType=="ProQualification")
		{
			alert("পেশাগত যোগ্যতাতে সঠিক তারিখ প্রদান করুন। ");
		}
		if (strDateType=="Experience")
		{
			alert("কর্মসংস্থান ইতিহাসে সঠিক তারিখ প্রদান করুন।");
		}
		
		return false;
	}
	
	if (strMonth.length<1 || month<1 || month>12){
		//alert("Please enter a valid month")
		if (strDateType=="DOB")
		{
			alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
		}
		
		if (strDateType=="ProQualification")
		{
			alert("পেশাগত যোগ্যতাতে সঠিক তারিখ প্রদান করুন। ");
		}
		
		if (strDateType=="Experience")
		{
			alert("কর্মসংস্থান ইতিহাসে সঠিক তারিখ প্রদান করুন।");
		}
		
		return false;
	}
	
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		//alert("Please enter a valid day")
		if (strDateType=="DOB")
		{
			alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
		}

		if (strDateType=="ProQualification")
		{
			alert("পেশাগত যোগ্যতাতে সঠিক তারিখ প্রদান করুন। ");
		}

		if (strDateType=="Experience")
		{
			alert("কর্মসংস্থান ইতিহাসে সঠিক তারিখ প্রদান করুন।");
		}
		return false;
	}
	
	/*THIS MESSAGE WILL NEVER DISPLAY IF 4 DIGIT YEAR IS TAKEN FROM DROPDOWN LIST:*/
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		//alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		if (strDateType=="DOB")
		{
			alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
		}
		
		if (strDateType=="ProQualification")
		{
			alert("পেশাগত যোগ্যতাতে সঠিক তারিখ প্রদান করুন। ");
		}

		if (strDateType=="Experience")
		{
			alert("কর্মসংস্থান ইতিহাসে সঠিক তারিখ প্রদান করুন।");
		}

		return false;
	}
	
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){		
		if (strDateType=="DOB")
		{
			alert("সঠিক জন্ম তারিখ নির্বাচন করুন।");
		}

		if (strDateType=="ProQualification")
		{
			alert("পেশাগত যোগ্যতাতে সঠিক তারিখ প্রদান করুন। ");
		}

		if (strDateType=="Experience")
		{
			alert("কর্মসংস্থান ইতিহাসে সঠিক তারিখ প্রদান করুন।");
		}
		return false;
	}
	return true;
}
/*function ValidateForm(cboDay, cboMonth, cboYear, strMessageType){
	
	var dt = cboMonth + "/" + cboDay + "/" + cboYear;
	if (isDate(dt, strMessageType)==false){
		cboDay.focus();
		return false;
	}
    return true;
 }*/
/*function ValidateForm(strDateType, Counter, Column ){		
	var dt;
	var dd = '';
	var mm = '';
	var yy = '';
	
	if (Column == '1')
	{
		for (i=1; i<=Counter;i++)
		{
			dd = document.getElementById('cboDay' + Counter + '').value;
			mm = document.getElementById('cboDay' + Counter + '').value;
			yy = document.getElementById('cboYear'+ Counter + '').value;
		
			dt = mm + "/" + dd + "/" + yy;
	
			if (isDate(dt, strDateType)==false){
				document.getElementById('cboDay' + Counter + '').focus();
				return false
			}
    		return true;
		}
	}
 }*/