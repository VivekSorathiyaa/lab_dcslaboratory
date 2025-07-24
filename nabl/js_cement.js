

function randomNumberFromRange(min,max)
{
	//return Math.floor(Math.random()*(max-min+1)+min);
	return Math.random() * (max - min) + min;
}
function rand(min, max) {
  var offset = min;
  var range = (max - min) + 1;

  var randomNumber = Math.floor( Math.random() * range) + offset;
  return randomNumber;
}
function timeConvert(n) {
	var num = n;
	var hours = (num / 60);
	var rhours = Math.floor(hours);
	var minutes = (hours - rhours) * 60;
	var rminutes = Math.round(minutes);
	return rhours + "," + rminutes ;
	}
function cal_span_cement(report_no,job_no,lab_no,test_list,type_of_cement,grades,cement_brand,week_number,rec_sample_date,base_urls)
{

			var temp = test_list;
				var tes_1= temp.split(",");
				var final_consistency ="";
				var dts = rec_sample_date;
				//consistency
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="con")
					{
						var chk_con = "1";
						var con_temp = randomNumberFromRange(26.0,28.0).toFixed(1);
						var con_date_test = dts;
						var con_humidity = randomNumberFromRange(65,69).toFixed();
						var con_weight = 400.00;
						
						
						var t = randomNumberFromRange(1,50);
						if(t%2==0)
						{	
	
							if(grades=="53 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							else if (grades=="43 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);	
							}
							else if (grades=="33 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);	
							}
							else if (grades=="PPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							else if (grades=="OPC - 43 S")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							else if (grades=="OPC - 53 S")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							else if (grades=="PORTLAND SLAG")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							var ab = parseInt(items.length) - 1;
							
							var randomNumber = rand(0, ab);
							
							var randomItem = items[randomNumber];		
							final_consistency = randomItem;
							var wtr_4 = final_consistency;
							var reading_4 = randomNumberFromRange(5.00, 7.00);
							var vol_4 = (parseFloat(wtr_4) * parseFloat(con_weight))/100;
							
							
							
							var wtr_1 = parseFloat(wtr_4) - 1.5;
							var wtr_3 = parseFloat(wtr_4) - 1.0;
							var wtr_2 = parseFloat(wtr_4) - 0.5;
							var reading_1 = randomNumberFromRange(11.00, 12.00);
							var reading_3 = randomNumberFromRange(9.00, 10.00);
							var reading_2 = randomNumberFromRange(8.00, 9.00);
							var vol_3 = (parseFloat(wtr_3) * parseFloat(con_weight))/100;
							var vol_1 = (parseFloat(wtr_1) * parseFloat(con_weight))/100;
							var vol_2 = (parseFloat(wtr_2) * parseFloat(con_weight))/100;
							
						}
						else
						{
									
							if(grades=="53 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);		
							}
							else if (grades=="43 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);	
							}
							else if (grades=="33 OPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);		
							}
							else if (grades=="PPC")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);
							}
							else if (grades=="OPC - 43 S")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);		
							}
							else if (grades=="OPC - 53 S")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);	
							}
							else if (grades=="PORTLAND SLAG")
							{
								var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);	
							}			
							var abss = parseInt(items1.length) - 1; 
							var randomNumber = rand(0, abss);
							var randomItem = items1[randomNumber];		
							var final_consistency = randomItem;
							
							var wtr_4 = final_consistency;
							var reading_4 = randomNumberFromRange(5.00, 7.00);
							var vol_4 = (parseFloat(wtr_4) * parseFloat(con_weight))/100;
							
							var wtr_1 = parseFloat(wtr_4) - 1.5;
							var wtr_2 = parseFloat(wtr_4) - 1.0;
							var wtr_3 = parseFloat(wtr_4) - 0.5;
							var reading_1 = randomNumberFromRange(11.00, 12.00);
							var reading_2 = randomNumberFromRange(9.00, 10.00);
							var reading_3 = randomNumberFromRange(8.00, 9.00);
							var vol_3 = (parseFloat(wtr_3) * parseFloat(con_weight))/100;
							var vol_1 = (parseFloat(wtr_1) * parseFloat(con_weight))/100;
							var vol_2 = (parseFloat(wtr_2) * parseFloat(con_weight))/100;
							
							
						}
							var vol_5 ="";
							var vol_6 ="";
							var vol_7 ="";
							var reading_5 ="";
							var reading_6 ="";
							var reading_7 ="";
							var wtr_5 ="";
							var wtr_6 ="";
							var wtr_7 ="";
							var remark_1="";
							var remark_2="";
							var remark_3="";
							var remark_4="";
							var remark_5="";
							var remark_6="";
							var remark_7="";
							
								
								break;
					}
					else
					{
						var chk_con = "0";
						var con_temp = "0";
						var con_date_test = "";
						var con_humidity = "0";
						var con_weight = "0";
						var vol_1 = "0";
						var vol_2 = "0";
						var vol_3 = "0";
						var vol_4 = "0";
						var reading_1 = "0";
						var reading_2 = "0";
						var reading_3 = "0";
						var reading_4 = "0";
						var wtr_1 = "0";
						var wtr_2 = "0";
						var wtr_3 = "0";
						var wtr_4 = "0";
						var vol_5 ="";
						var vol_6 ="";
						var vol_7 ="";
						var reading_5 ="";
						var reading_6 ="";
						var reading_7 ="";
						var wtr_5 ="";
						var wtr_6 ="";
						var wtr_7 ="";
						var remark_1="";
						var remark_2="";
						var remark_3="";
						var remark_4="";
						var remark_5="";
						var remark_6="";
						var remark_7="";
						
						
					}
				
				}
				
				//setting time
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="set")
					{
						var chk_set = "1";
						var set_temp = randomNumberFromRange(26.0,28.0).toFixed(1);
						var set_weight = 400;
							
						var top = 1;
						var date_input = dts.split('-');				
						var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
						var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
						var dd = newdate.getDate();
						var mm = newdate.getMonth() + 1;
						var y = newdate.getFullYear();
						if(mm <= 9)
						mm = '0'+mm;
						if(dd <= 9)
						dd = '0'+dd;
						var someFormattedDate = dd + '/' + mm + '/' + y;				
						var set_date_test = someFormattedDate;	
						
						var set_humidity = randomNumberFromRange(65,69);
						var set_wtr = (0.85 * parseFloat(final_consistency))*4;
						
						
								
							if(grades=="53 OPC")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;		
							}
							else if (grades=="43 OPC")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}
							else if (grades=="33 OPC")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}
							else if (grades=="PPC")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}
							else if (grades=="OPC - 43 S")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}
							else if (grades=="OPC - 53 S")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}	
							else if (grades=="PORTLAND SLAG")
							{
								var initial_time = Array(100,105,110,115,120,125,130,135,140,145,150);
								var df = Array(60,65,70,75,80);
								var abss2 = parseInt(df.length) - 1;
								var random1 = rand(0, abss2);
								var items33 = df[random1];
								var final_time = items33;
							}	
						
						
						var intitalq =  timeConvert(randomItem1);
						var finals =  timeConvert(final_time1);
						
						var a_time_hr = randomNumberFromRange(10, 13).toFixed();
						var a_time_min = randomNumberFromRange(0, 55).toFixed();
						var a_times = a_time_hr+":"+a_time_min+":00";
						var hr_b = intitalq;
						var hr_c = finals;			
						break;
					}
					else
					{
							var chk_set = "0";
							var set_date_test = "0";
							var set_humidity = "0";
							var set_wtr = "0";
							var initial_time = "0";
							var final_time = "0";
							var hr_a = "0";
							var hr_b = "0";
							var hr_c = "0";
							
							
					}
				}
				
				
				//compressive Strength				
				for(var ii=0;ii<tes_1.length;ii++)
				{
					if(tes_1[ii]=="com")
					{
						var chk_com="1";
						var com_temp = randomNumberFromRange(26.0,28.0).toFixed(1);
						
						
						var date_input9 = dts.split('-');				
						var date9 = new Date(date_input9[2], date_input9[1]- 1, date_input9[0]);					
						var newdate9 = new Date(date9.getFullYear(), date9.getMonth(), date9.getDate() + 2);
						var dd9 = newdate9.getDate();
						var mm9 = newdate9.getMonth() + 1;
						var y9 = newdate9.getFullYear();
						if(mm9 <= 9)
						mm9 = '0'+mm9;
						if(dd9 <= 9)
						dd9 = '0'+dd9;
						var someFormattedDate9 = dd9 + '/' + mm9 + '/' + y9;				
						var com_date_test = someFormattedDate9;	
						
						
						
						
						
						
						
						
						var com_humidity = randomNumberFromRange(65,69).toFixed();
						
						var weight_of_cement = 200;
						
						var weight_of_sand = 600;
						
						var temp2 = ((parseFloat(final_consistency)/4)+3);
						var weight_of_water = (parseFloat(temp2)*8);
						

						var caste_date1 = com_date_test;
						var caste_date2 = com_date_test;
						var caste_date3 = com_date_test;
					
						var day_1 = 3;
						var day_2 = 7;
						var day_3 = 28;
						
						var l1=70.6;
						var l2=70.6;
						var l3=70.6;
						var l4=70.6;
						var l5=70.6;
						var l6=70.6;
						var l7=70.6;
						var l8=70.6;
						var l9=70.6;
						var b1=70.6;
						var b2=70.6;
						var b3=70.6;
						var b4=70.6;
						var b5=70.6;
						var b6=70.6;
						var b7=70.6;
						var b8=70.6;
						var b9=70.6;
						var h1=70.6;
						var h2=70.6;
						var h3=70.6;
						var h4=70.6;
						var h5=70.6;
						var h6=70.6;
						var h7=70.6;
						var h8=70.6;
						var h9=70.6;
						
						if(grades=="53 OPC")
						{
							var sp_1 = 27;
							var avg_com_1 = randomNumberFromRange(28.00, 32.50);
							var sp_2 = 37;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 53;
							var avg_com_3 = randomNumberFromRange(53.50, 55.50);
						}
						else if (grades=="43 OPC")
						{
							var sp_1 = 23;
							var avg_com_1 = randomNumberFromRange(28.00, 32.00);
							var sp_2 = 33;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 43;
							var avg_com_3 = randomNumberFromRange(43.50, 45.50);
						}
						else if (grades=="33 OPC")
						{
							var sp_1 = 16;
							var avg_com_1 = randomNumberFromRange(28.00, 32.000);
							var sp_2 = 22;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 33;
							var avg_com_3 = randomNumberFromRange(54.00, 58.50);
						}
						else if (grades=="PPC")
						{
							var sp_1 = 16;
							var avg_com_1 = randomNumberFromRange(16.50, 18.50);
							var sp_2 = 22;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 33;
							var avg_com_3 = randomNumberFromRange(54.00, 58.50);
						}
						else if (grades=="OPC - 43 S")
						{
							var sp_1 = 16;
							var avg_com_1 = randomNumberFromRange(23.50, 25.50);
							var sp_2 = 43;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 43;
							var avg_com_3 = randomNumberFromRange(54.00, 58.50);
						}
						else if (grades=="OPC - 53 S")
						{
							var sp_1 = 16;
							var avg_com_1 = randomNumberFromRange(28.00, 30.50);
							var sp_2 = 53;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 53;
							var avg_com_3 = randomNumberFromRange(54.00, 58.50);
						}
						else if (grades=="PORTLAND SLAG")
						{
							var sp_1 = 16;
							var avg_com_1 = randomNumberFromRange(17.00, 18.50);
							var sp_2 = 22;
							var avg_com_2 = randomNumberFromRange(38.00, 43.50);
							var sp_3 = 33;
							var avg_com_3 = randomNumberFromRange(54.00, 58.50);
						}
									

						var com_1 = parseFloat(avg_com_1) + 0.34;
						var com_2 = parseFloat(avg_com_1) - 0.56;
						var com_3 = parseFloat(avg_com_1) + 0.22;
						var com_4 = parseFloat(avg_com_2) + 0.32;
						var com_5 = parseFloat(avg_com_2) - 0.78;
						var com_6 = parseFloat(avg_com_2) + 0.46;
						var com_7 = parseFloat(avg_com_3) + 0.32;
						var com_8 = parseFloat(avg_com_3) - 0.78;
						var com_9 = parseFloat(avg_com_3) + 0.46;
						
						var area_1 = parseFloat(l1) * parseFloat(b1);
						var area_2 = parseFloat(l2) * parseFloat(b2);
						var area_3 = parseFloat(l3) * parseFloat(b3);
						var area_4 = parseFloat(l4) * parseFloat(b4);
						var area_5 = parseFloat(l5) * parseFloat(b5);
						var area_6 = parseFloat(l6) * parseFloat(b6);
						var area_7 = parseFloat(l7) * parseFloat(b7);
						var area_8 = parseFloat(l8) * parseFloat(b8);
						var area_9 = parseFloat(l9) * parseFloat(b9);
						
						var load_1 = (parseFloat(area_1) *  parseFloat(com_1)) / 1000;
						var load_2 = (parseFloat(area_2) *  parseFloat(com_2)) / 1000;
						var load_3 = (parseFloat(area_3) *  parseFloat(com_3)) / 1000;
						var load_4 = (parseFloat(area_4) *  parseFloat(com_4)) / 1000;
						var load_5 = (parseFloat(area_5) *  parseFloat(com_5)) / 1000;
						var load_6 = (parseFloat(area_6) *  parseFloat(com_6)) / 1000;
						var load_7 = (parseFloat(area_7) *  parseFloat(com_7)) / 1000;
						var load_8 = (parseFloat(area_8) *  parseFloat(com_8)) / 1000;
						var load_9 = (parseFloat(area_9) *  parseFloat(com_9)) / 1000;
						
						
						
						var top2 = parseInt(day_1);
						var date_input2 = caste_date1.split('/');				
						var date2 = new Date(date_input2[2], date_input2[1]- 1, date_input2[0]);					
						var newdate2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate() + top2);
						var dd2 = newdate2.getDate();
						var mm2 = newdate2.getMonth() + 1;
						var y2 = newdate2.getFullYear();
						if(mm2 <= 9)
						mm2 = '0'+mm2;
						if(dd2 <= 9)
						dd2 = '0'+dd2;
						var someFormattedDate2 = dd2 + '/' + mm2 + '/' + y2;
						var test_date1 = someFormattedDate2;

						var top3 = parseInt(day_2);
						var date_input3 = caste_date2.split('/');				
						var date3 = new Date(date_input3[2], date_input3[1]- 1, date_input3[0]);					
						var newdate3 = new Date(date3.getFullYear(), date3.getMonth(), date3.getDate() + top3);
						var dd3 = newdate3.getDate();
						var mm3 = newdate3.getMonth() + 1;
						var y3 = newdate3.getFullYear();
						if(mm3 <= 9)
						mm3 = '0'+mm3;
						if(dd3 <= 9)
						dd3 = '0'+dd3;
						var someFormattedDate3 = dd3 + '/' + mm3 + '/' + y3;
						var test_date2 = someFormattedDate3;
						
						var top4 = parseInt(day_3);
						var date_input4 = caste_date3.split('/');				
						var date4 = new Date(date_input4[2], date_input4[1]- 1, date_input4[0]);					
						var newdate4 = new Date(date4.getFullYear(), date4.getMonth(), date4.getDate() + top4);
						var dd4 = newdate4.getDate();
						var mm4 = newdate4.getMonth() + 1;
						var y4 = newdate4.getFullYear();
						if(mm4 <= 9)
						mm4 = '0'+mm4;
						if(dd4 <= 9)
						dd4 = '0'+dd4;
						var someFormattedDate4 = dd4 + '/' + mm4 + '/' + y4;
						var test_date3 = someFormattedDate4;
						
						
						
						
								break;
					}
					else
					{
						var chk_com = "0";
						
						var com_temp = "0";
						var com_humidity = "0";
						var weight_of_cement = "0";
						var weight_of_sand = "0";
						var weight_of_water = "0";
						var com_date_test = "";
						var caste_date1 = "";
						var test_date1 = "";
						var sp_1 = "0";
						var day_1 = "0";
						var avg_com_1 = "0";
						var com_1 = "0";
						var com_2 = "0";
						var com_3 = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var h1 = "0";
						var h2 = "0";
						var h3 = "0";
						var area_1 ="0";
						var area_2 ="0";
						var area_3 ="0";
						var load_1 ="0";
						var load_2 ="0";
						var load_3 ="0";
						var caste_date2= "";
						var test_date2= "";
						var sp_2="0";
						var day_2="0";
						var avg_com_2="0";
						var com_4 ="0";
						var com_5 ="0";
						var com_6 ="0";
						var l4 = "0";
						var l5 = "0";
						var l6 = "0";
						var b4 = "0";
						var b5 = "0";
						var b6 = "0";
						var h4 = "0";
						var h5 = "0";
						var h6 = "0";
						var area_4 = "0";
						var area_5 = "0";
						var area_6 = "0";
						var load_4 = "0";
						var load_5 = "0";
						var load_6 = "0";
						var caste_date3 = "";
						var test_date3 = "";
						var sp_3 = "0";
						var day_3 = "0";
						var avg_com_3 = "0";
						var com_7 ="0";
						var com_8 ="0";
						var com_9 ="0";
						var l7 = "0";
						var l8 = "0";
						var l9 = "0";
						var b7 = "0";
						var b8 = "0";
						var b9 = "0";
						var h7 = "0";
						var h8 = "0";
						var h9 = "0";
						var area_7 = "0";
						var area_8 = "0";
						var area_9 = "0";
						var load_7 = "0";
						var load_8 = "0";
						var load_9 = "0";
						
					
							
					}
				}
				
				//soundness
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="sou")
					{

						
					var chk_sou ="1";
					
					var sou_temp = randomNumberFromRange(26.0,28.0);
					var top5 = 2;
					var date_input5 = dts.split('-');			
					var date5 = new Date(date_input5[2], date_input5[1]- 1, date_input5[0]);					
					var newdate5 = new Date(date5.getFullYear(), date5.getMonth(), date5.getDate() + top5);
					var dd5 = newdate5.getDate();
					var mm5 = newdate5.getMonth() + 1;
					var y5 = newdate5.getFullYear();
					if(mm5 <= 9)
					mm5 = '0'+mm5;
					if(dd5 <= 9)
					dd5 = '0'+dd5;
					var someFormattedDate5 = dd5 + '/' + mm5 + '/' + y5;				
				
					 var sou_date_test = someFormattedDate5;
					var sou_humidity = randomNumberFromRange(65,69); 
					var sou_weight = 200;
					var sou_water = (0.78 * parseFloat(final_consistency))*2;
						
					var items123 = randomNumberFromRange(0.60,1.20).toFixed(2);		
					var soundness = items123;
					
					
					var diff_1 = parseFloat(soundness) + randomNumberFromRange(-0.08,0.07);
					var diff_2 = (parseFloat(soundness)*2) - parseFloat(diff_1);
			
					var dis_2_1 = randomNumberFromRange(9.00, 12.00);
					var dis_2_2 = randomNumberFromRange(9.00, 12.00);
					
					var dis_1_1 = parseFloat(dis_2_1) - parseFloat(diff_1);
					var dis_1_2 = parseFloat(dis_2_2) - parseFloat(diff_2);


					
					break;
					}
					else
					{
						var chk_sou="0";
						var sou_temp="0";
						var sou_date_test="";
						var sou_humidity="0";
						var sou_weight="0";
						var soundness="0";
						var sou_water="0";
						var diff_1="0";
						var diff_2="0";
						var dis_2_1="0";
						var dis_2_2="0";
						var dis_1_1="0";
						var dis_1_2="0";
						
						
					}
				
				}
	
				//fineness
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="fin")
					{
						var chk_fines="1";
						var constant_k = 0.29;							
						
										
						var constant_k_1 = parseFloat(constant_k);	
							if(grades=="53 OPC")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="43 OPC")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="33 OPC")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="PPC")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="OPC - 43 S")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="OPC - 53 S")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							else if (grades=="PORTLAND SLAG")
							{
								var ss_area = randomNumberFromRange(230, 350).toFixed(0);
							}
							
							//$('#ss_area').val(ss_area.toFixed(0));
							var fines_val2 = randomNumberFromRange(3.11,3.17).toFixed(2);
							//$('#fines_val2').val(fines_val2);
							
							
							var eq1 = (+fines_val2) * (+ss_area);
							var eq2 = 521.08 * (+constant_k);
							var anss = eq1 / eq2;
							var avg_fines_time = anss * anss;
							var fines_val1 = anss;														
							var rvg = avg_fines_time;
							
							var tt = randomNumberFromRange(0,9).toFixed(0);
							if(tt%2==0)
							{
							var fines_t_1 = (+rvg) + 0.17;
							var fines_t_2 = (+rvg) - 0.30;
							var fines_t_3 = (+rvg) + 0.13;
							}
							else
							{
							var fines_t_1 = (+rvg) - 0.13;
							var fines_t_2 = (+rvg) + 0.25;
							var fines_t_3 = (+rvg) - 0.12;	
							}
							
							
						break;
					}
					else
					{
						var chk_fines="0";
						var constant_k_1="0";
						var constant_k="0";
						var ss_area="0";
						var avg_fines_time="0";
						var fines_t_1="0";
						var fines_t_2="0";
						var fines_t_3="0";										
						var final_val1="0";
						var final_val2="0";
						
					}
				}
				
				//dencity
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="den")
					{
						var chk_den="1";
						var den_temp = randomNumberFromRange(26.0,28.0);
						
						var top6 = 1;
						var date_input6 = dts.split('-');							
						var date6 = new Date(date_input6[2], date_input6[1]- 1, date_input6[0]);					
						var newdate6 = new Date(date6.getFullYear(), date6.getMonth(), date6.getDate() + top6);
						var dd6 = newdate6.getDate();
						var mm6 = newdate6.getMonth() + 1;
						var y6 = newdate6.getFullYear();
						if(mm6 <= 9)
						mm6 = '0'+mm6;
						if(dd6 <= 9)
						dd6 = '0'+dd6;
						var someFormattedDate6 = dd6 + '/' + mm6 + '/' + y6;				
						var den_date_test = someFormattedDate6;
						
						var den_humidity = randomNumberFromRange(65,69);
								
						if(grades=="53 OPC")
						{
							var density = randomNumberFromRange(3.14,3.16);
						}
						else if (grades=="43 OPC")
						{
							var density = randomNumberFromRange(3.14,3.16);
						}
						else if (grades=="33 OPC")
						{
							var density = randomNumberFromRange(3.14,3.16);
						}
						else if (grades=="PPC")
						{
							var density = randomNumberFromRange(2.84,2.86);
						}
						else if (grades=="OPC - 43 S")
						{
							var density = randomNumberFromRange(3.14,3.16);
						}
						else if (grades=="OPC - 53 S")
						{
							var density = randomNumberFromRange(3.14,3.16);
						}
						else if (grades=="PORTLAND SLAG")
						{
							var density = randomNumberFromRange(2.80,2.82);
						}
						
						
						var den_displaced = 64/parseFloat(density);
						var den_intial = randomNumberFromRange(0.1, 0.9);
						var den_final = parseFloat(den_intial) + parseFloat(den_displaced);
						var den_m2="";
						var den_m3="";
						var den_d="";
						var den_volume="";
						var den_weight="";
						break;
					}
					else
					{
						var chk_den="0";
						var den_temp="0";
						var den_date_test="";
						var den_humidity="0";
						var den_final="0";
						var den_intial="0";
						var den_displaced="0";
						var density="0";
						var den_m2="";
						var den_m3="";
						var den_d="";
						var den_volume="";
						var den_weight="";
						
						
					}
				}
			
				//chemical
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="che")
					{
						var chk_che="1";
						
						if(type_of_cement=="opc")
						{
						var chem_1 = randomNumberFromRange(0.82, 1.00);
						var chem_2 = randomNumberFromRange(0.80, 0.99);
						var chem_3 = randomNumberFromRange(1.30, 1.60);
						var chem_4 = randomNumberFromRange(2.0, 4.0);
						var chem_5 = randomNumberFromRange(2.0, 3.0);
						var chem_6 = randomNumberFromRange(1.80, 2.00);
						}
						else
						{
						var chem_1 = randomNumberFromRange(0.82, 1.00);
						var chem_2 = randomNumberFromRange(0.80, 0.99);
						var chem_3 = randomNumberFromRange(1.30, 1.60);
						var chem_4 = randomNumberFromRange(2.0, 4.0);
						var chem_5 = randomNumberFromRange(2.0, 4.0);
						var chem_6 = randomNumberFromRange(1.80, 2.00);	
						}
						
						var chk_1 = "0";	
						var chk_2 = "0";	
						var chk_3 = "0";	
						var chk_4 ="0";
						var chk_5 ="0";
						var chk_6 ="0";									
						var chk_7 = "0";	
						var chk_8 = "0";	
						var chk_9 = "0";	
						var chk_10 ="0";
						var chk_11 ="0";
						var chk_12 ="0";

						var ch_s_d1 = "00/00/0000";
						var ch_s_d2 = "00/00/0000";
						var ch_s_w = "0";
						var ch_s_w1 = "0";
						var ch_s_w2 = "0";
						var ch_s_w3 = "0";
						var ch_s_hf = "0";
						var ch_s_r1 = "0";
						var ch_s_r2 = "0";
						var ch_s_r = "0";
						var ch_s_per = "0";

						var ch_ro_d1 = "00/00/0000";
						var ch_ro_d2 = "00/00/0000";
						var ch_ro_w = "0";
						var ch_ro_w1 = "0";
						var ch_ro_w2 = "0";
						var ch_ro_w3 = "0";
						var ch_ro_hf = "0";
						var ch_ro_r1 = "0";
						var ch_ro_r2 = "0";
						var ch_ro_r = "0";
						var ch_ro_per = "0";

						var ch_co_d1 = "00/00/0000";
						var ch_co_d2 = "00/00/0000";
						var ch_co_w = "0";
						var ch_co_w1 = "0";
						var ch_co_w2 = "0";
						var ch_co_r = "0";
						var ch_co_per = "0";

						var ch_mg_d1 = "00/00/0000";
						var ch_mg_d2 = "00/00/0000";
						var ch_mg_w = "0";
						var ch_mg_w1 = "0";
						var ch_mg_w2 = "0";
						var ch_mg_r = "0";
						var ch_mg_per = "0";

						var ch_ir_d1 = "00/00/0000";
						var ch_ir_d2 = "00/00/0000";
						var ch_ir_w = "0";
						var ch_ir_w1 = "0";
						var ch_ir_w2 = "0";
						var ch_ir_r = "0";
						var ch_ir_per = "0";

						var ch_sa_d1 = "00/00/0000";
						var ch_sa_d2 = "00/00/0000";
						var ch_sa_w = "0";
						var ch_sa_w1 = "0";
						var ch_sa_w2 = "0";
						var ch_sa_r = "0";
						var ch_sa_per = "0";

						var ch_lo_d1 = "00/00/0000";
						var ch_lo_d2 = "00/00/0000";
						var ch_lo_w = "0";
						var ch_lo_w1 = "0";
						var ch_lo_w2 = "0";
						var ch_lo_w3 = "0";
						var ch_lo_r = "0";
						var ch_lo_per = "0";
					
						var ch_fo_d1 = "00/00/0000";
						var ch_fo_d2 = "00/00/0000";
						var ch_fo_w = "0";
						var ch_fo_v = "0";					
						var ch_fo_r = "0";
						var ch_fo_per = "0";

						var ch_ao_d1 = "00/00/0000";
						var ch_ao_d2 = "00/00/0000";
						var ch_ao_w = "0";
						var ch_ao_v = "0";					
						var ch_ao_r = "0";
						var ch_ao_per = "0";

						var ch_ch_d1 = "00/00/0000";
						var ch_ch_d2 = "00/00/0000";
						var ch_ch_w = "0";
						var ch_ch_x = "0";					
						var ch_ch_y = "0";				
						var ch_ch_r = "0";
						var ch_ch_per = "0";

						var ch_na_d1 = "00/00/0000";
						var ch_na_d2 = "00/00/0000";
						var ch_na_w = "0";				
						var ch_na_r = "0";
						var ch_na_per = "0";

						var ch_ko_d1 = "00/00/0000";
						var ch_ko_d2 = "00/00/0000";
						var ch_ko_w = "0";			
						var ch_ko_r = "0";
						var ch_ko_per = "0";
						
					break;
					}
					else
					{
						var chk_che="0";
						var chem_1="0";
						var chem_2="0";
						var chem_3="0";
						var chem_4="0";
						var chem_5="0";
						var chem_6="0";
						
						var chk_1 = "0";	
						var chk_2 = "0";	
						var chk_3 = "0";	
						var chk_4 ="0";
						var chk_5 ="0";
						var chk_6 ="0";									
						var chk_7 = "0";	
						var chk_8 = "0";	
						var chk_9 = "0";	
						var chk_10 ="0";
						var chk_11 ="0";
						var chk_12 ="0";

						var ch_s_d1 = "00/00/0000";
						var ch_s_d2 = "00/00/0000";
						var ch_s_w = "0";
						var ch_s_w1 = "0";
						var ch_s_w2 = "0";
						var ch_s_w3 = "0";
						var ch_s_hf = "0";
						var ch_s_r1 = "0";
						var ch_s_r2 = "0";
						var ch_s_r = "0";
						var ch_s_per = "0";

						var ch_ro_d1 = "00/00/0000";
						var ch_ro_d2 = "00/00/0000";
						var ch_ro_w = "0";
						var ch_ro_w1 = "0";
						var ch_ro_w2 = "0";
						var ch_ro_w3 = "0";
						var ch_ro_hf = "0";
						var ch_ro_r1 = "0";
						var ch_ro_r2 = "0";
						var ch_ro_r = "0";
						var ch_ro_per = "0";

						var ch_co_d1 = "00/00/0000";
						var ch_co_d2 = "00/00/0000";
						var ch_co_w = "0";
						var ch_co_w1 = "0";
						var ch_co_w2 = "0";
						var ch_co_r = "0";
						var ch_co_per = "0";

						var ch_mg_d1 = "00/00/0000";
						var ch_mg_d2 = "00/00/0000";
						var ch_mg_w = "0";
						var ch_mg_w1 = "0";
						var ch_mg_w2 = "0";
						var ch_mg_r = "0";
						var ch_mg_per = "0";

						var ch_ir_d1 = "00/00/0000";
						var ch_ir_d2 = "00/00/0000";
						var ch_ir_w = "0";
						var ch_ir_w1 = "0";
						var ch_ir_w2 = "0";
						var ch_ir_r = "0";
						var ch_ir_per = "0";

						var ch_sa_d1 = "00/00/0000";
						var ch_sa_d2 = "00/00/0000";
						var ch_sa_w = "0";
						var ch_sa_w1 = "0";
						var ch_sa_w2 = "0";
						var ch_sa_r = "0";
						var ch_sa_per = "0";

						var ch_lo_d1 = "00/00/0000";
						var ch_lo_d2 = "00/00/0000";
						var ch_lo_w = "0";
						var ch_lo_w1 = "0";
						var ch_lo_w2 = "0";
						var ch_lo_w3 = "0";
						var ch_lo_r = "0";
						var ch_lo_per = "0";
					
						var ch_fo_d1 = "00/00/0000";
						var ch_fo_d2 = "00/00/0000";
						var ch_fo_w = "0";
						var ch_fo_v = "0";					
						var ch_fo_r = "0";
						var ch_fo_per = "0";

						var ch_ao_d1 = "00/00/0000";
						var ch_ao_d2 = "00/00/0000";
						var ch_ao_w = "0";
						var ch_ao_v = "0";					
						var ch_ao_r = "0";
						var ch_ao_per = "0";

						var ch_ch_d1 = "00/00/0000";
						var ch_ch_d2 = "00/00/0000";
						var ch_ch_w = "0";
						var ch_ch_x = "0";					
						var ch_ch_y = "0";				
						var ch_ch_r = "0";
						var ch_ch_per = "0";

						var ch_na_d1 = "00/00/0000";
						var ch_na_d2 = "00/00/0000";
						var ch_na_w = "0";				
						var ch_na_r = "0";
						var ch_na_per = "0";

						var ch_ko_d1 = "00/00/0000";
						var ch_ko_d2 = "00/00/0000";
						var ch_ko_w = "0";			
						var ch_ko_r = "0";
						var ch_ko_per = "0";
						
						
						
					}
				}
						
				var type="add";
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&cement_grade='+cement_grade+'&type_of_cement='+type_of_cement+'&cement_brand='+cement_brand+'&week_number='+week_number+'&chk_con='+chk_con+'&con_date_test='+con_date_test+'&report_date='+report_date+'&con_temp='+con_temp+'&con_humidity='+con_humidity+'&con_weight='+con_weight+'&vol_1='+vol_1+'&vol_2='+vol_2+'&vol_3='+vol_3+'&vol_4='+vol_4+'&vol_5='+vol_5+'&vol_6='+vol_6+'&vol_7='+vol_7+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&wtr_4='+wtr_4+'&wtr_5='+wtr_5+'&wtr_6='+wtr_6+'&wtr_7='+wtr_7+'&reading_1='+reading_1+'&reading_2='+reading_2+'&reading_3='+reading_3+'&reading_4='+reading_4+'&reading_5='+reading_5+'&reading_6='+reading_6+'&reading_7='+reading_7+'&remark_1='+remark_1+'&remark_2='+remark_2+'&remark_3='+remark_3+'&remark_4='+remark_4+'&remark_5='+remark_5+'&remark_6='+remark_6+'&remark_7='+remark_7+'&final_consistency='+final_consistency+'&chk_sou='+chk_sou+'&sou_date_test='+sou_date_test+'&sou_humidity='+sou_humidity+'&sou_temp='+sou_temp+'&sou_water='+sou_water+'&sou_weight='+sou_weight+'&soundness='+soundness+'&dis_1_1='+dis_1_1+'&dis_1_2='+dis_1_2+'&dis_2_1='+dis_2_1+'&dis_2_2='+dis_2_2+'&diff_1='+diff_1+'&diff_2='+diff_2+'&chk_set='+chk_set+'&set_date_test='+set_date_test+'&set_weight='+set_weight+'&set_weight='+set_weight+'&set_temp='+set_temp+'&set_wtr='+set_wtr+'&set_humidity='+set_humidity+'&hr_a='+hr_a+'&hr_b='+hr_b+'&hr_c='+hr_c+'&initial_time='+initial_time+'&final_time='+final_time+'&chk_den='+chk_den+'&den_date_test='+den_date_test+'&den_temp='+den_temp+'&den_humidity='+den_humidity+'&den_intial='+den_intial+'&den_final='+den_final+'&den_displaced='+den_displaced+'&density='+density+'&den_m2='+den_m2+'&den_m3='+den_m3+'&den_d='+den_d+'&den_volume='+den_volume+'&den_weight='+den_weight+'&chk_fines='+chk_fines+'&fines_t_1='+fines_t_1+'&fines_t_2='+fines_t_2+'&fines_t_3='+fines_t_3+'&avg_fines_time='+avg_fines_time+'&constant_k='+constant_k+'&constant_k_1='+constant_k_1+'&ss_area='+ss_area+'&chk_com='+chk_com+'&com_date_test='+com_date_test+'&com_temp='+com_temp+'&com_humidity='+com_humidity+'&weight_of_cement='+weight_of_cement+'&weight_of_sand='+weight_of_sand+'&weight_of_water='+weight_of_water+'&sp_1='+sp_1+'&sp_2='+sp_2+'&sp_3='+sp_3+'&caste_date1='+caste_date1+'&caste_date2='+caste_date2+'&caste_date3='+caste_date3+'&test_date1='+test_date1+'&test_date2='+test_date2+'&test_date3='+test_date3+'&day_1='+day_1+'&day_2='+day_2+'&day_3='+day_3+'&avg_com_1='+avg_com_1+'&avg_com_2='+avg_com_2+'&avg_com_3='+avg_com_3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&b6='+b6+'&b7='+b7+'&b8='+b8+'&b9='+b9+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&area_1='+area_1+'&area_2='+area_2+'&area_3='+area_3+'&area_4='+area_4+'&area_5='+area_5+'&area_6='+area_6+'&area_7='+area_7+'&area_8='+area_8+'&area_9='+area_9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&chk_che='+chk_che+'&chem_1='+chem_1+'&chem_2='+chem_2+'&chem_3='+chem_3+'&chem_4='+chem_4+'&chem_5='+chem_5+'&chem_6='+chem_6+'&chk_1='+chk_1+'&chk_2='+chk_2+'&chk_3='+chk_3+'&chk_4='+chk_4+'&chk_5='+chk_5+'&chk_6='+chk_6+'&chk_7='+chk_7+'&chk_8='+chk_8+'&chk_9='+chk_9+'&chk_10='+chk_10+'&chk_11='+chk_11+'&chk_12='+chk_12+'&ch_s_d1='+ch_s_d1+'&ch_s_d2='+ch_s_d2+'&ch_s_w='+ch_s_w+'&ch_s_w1='+ch_s_w1+'&ch_s_w2='+ch_s_w2+'&ch_s_w3='+ch_s_w3+'&ch_s_hf='+ch_s_hf+'&ch_s_r1='+ch_s_r1+'&ch_s_per='+ch_s_per+'&ch_s_r2='+ch_s_r2+'&ch_s_r='+ch_s_r+'&ch_ro_d1='+ch_ro_d1+'&ch_ro_d2='+ch_ro_d2+'&ch_ro_w='+ch_ro_w+'&ch_ro_w1='+ch_ro_w1+'&ch_ro_w2='+ch_ro_w2+'&ch_ro_w3='+ch_ro_w3+'&ch_ro_hf='+ch_ro_hf+'&ch_ro_r1='+ch_ro_r1+'&ch_ro_per='+ch_ro_per+'&ch_ro_r2='+ch_ro_r2+'&ch_ro_r='+ch_ro_r+'&ch_co_d1='+ch_co_d1+'&ch_co_d2='+ch_co_d2+'&ch_co_w='+ch_co_w+'&ch_co_w1='+ch_co_w1+'&ch_co_w2='+ch_co_w2+'&ch_co_per='+ch_co_per+'&ch_co_r='+ch_co_r+'&ch_mg_d1='+ch_mg_d1+'&ch_mg_d2='+ch_mg_d2+'&ch_mg_w='+ch_mg_w+'&ch_mg_w1='+ch_mg_w1+'&ch_mg_w2='+ch_mg_w2+'&ch_mg_per='+ch_mg_per+'&ch_mg_r='+ch_mg_r+'&ch_ir_d1='+ch_ir_d1+'&ch_ir_d2='+ch_ir_d2+'&ch_ir_w='+ch_ir_w+'&ch_ir_w1='+ch_ir_w1+'&ch_ir_w2='+ch_ir_w2+'&ch_ir_per='+ch_ir_per+'&ch_ir_r='+ch_ir_r+'&ch_sa_d1='+ch_sa_d1+'&ch_sa_d2='+ch_sa_d2+'&ch_sa_w='+ch_sa_w+'&ch_sa_w1='+ch_sa_w1+'&ch_sa_w2='+ch_sa_w2+'&ch_sa_per='+ch_sa_per+'&ch_sa_r='+ch_sa_r+'&ch_lo_d1='+ch_lo_d1+'&ch_lo_d2='+ch_lo_d2+'&ch_lo_w='+ch_lo_w+'&ch_lo_w1='+ch_lo_w1+'&ch_lo_w2='+ch_lo_w2+'&ch_lo_w3='+ch_lo_w3+'&ch_lo_per='+ch_lo_per+'&ch_lo_r='+ch_lo_r+'&ch_fo_d1='+ch_fo_d1+'&ch_fo_d2='+ch_fo_d2+'&ch_fo_w='+ch_fo_w+'&ch_fo_v='+ch_fo_v+'&ch_fo_per='+ch_fo_per+'&ch_fo_r='+ch_fo_r+'&ch_ao_d1='+ch_ao_d1+'&ch_ao_d2='+ch_ao_d2+'&ch_ao_w='+ch_ao_w+'&ch_ao_v='+ch_ao_v+'&ch_ao_per='+ch_ao_per+'&ch_ao_r='+ch_ao_r+'&ch_ch_d1='+ch_ch_d1+'&ch_ch_d2='+ch_ch_d2+'&ch_ch_w='+ch_ch_w+'&ch_ch_x='+ch_ch_x+'&ch_ch_y='+ch_ch_y+'&ch_ch_per='+ch_ch_per+'&ch_ch_r='+ch_ch_r+'&ch_na_d1='+ch_na_d1+'&ch_na_d2='+ch_na_d2+'&ch_na_w='+ch_na_w+'&ch_na_per='+ch_na_per+'&ch_na_r='+ch_na_r+'&ch_ko_d1='+ch_ko_d1+'&ch_ko_d2='+ch_ko_d2+'&ch_ko_w='+ch_ko_w+'&ch_ko_per='+ch_ko_per+'&ch_ko_r='+ch_ko_r+'&fines_val1='+fines_val1+'&fines_val2='+fines_val2+'&den_intial1='+den_intial1+'&den_final1='+den_final1+'&den_displaced1='+den_displaced1+'&density1='+density1+'&avg_density='+avg_density;
				
				$.ajax({
			type: 'POST',
			url: base_urls+'saveCement_span.php',
			data: billData,
			dataType: 'JSON',
			success:function(msg){
		
        }
    });

	
				
}
	
