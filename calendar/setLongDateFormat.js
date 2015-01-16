function fnSetDateFormat(oDateFormat)
{
	/*
  oDateFormat['FullYear'];		//Example = 2007
	oDateFormat['Year'];			//Example = 07
	oDateFormat['FullMonthName'];	//Example = January
	oDateFormat['MonthName'];		//Example = Jan
	oDateFormat['Month'];			//Example = 01
	oDateFormat['Date'];			//Example = 01
	oDateFormat['FullDay'];			//Example = Sunday
	oDateFormat['Day'];				//Example = Sun
	oDateFormat['Hours'];			//Example = 01
	oDateFormat['Minutes'];			//Example = 01
	oDateFormat['Seconds'];			//Example = 01
  */
	var sDateString;
  //mmm dd, yyyy
	sDateString =  oDateFormat['FullYear']+"-"+oDateFormat['Month'] +"-"+ oDateFormat['Date'];
	return sDateString;
}
