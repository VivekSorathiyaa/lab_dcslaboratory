

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

function cal_sand(report_no,job_no,lab_no,test_list,base_urls)
{

			var temp = test_list;
				var tes_1= temp.split(",");
				
				//gradation
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="grd")
					{
						var chk_grd = "1";
						
						var sieve_1="10.00 (mm)";	
						var sieve_2="4.75 (mm)";	
						var sieve_3="2.36 (mm)";	
						var sieve_4="1.18 (mm)";	
						var sieve_5="0.600 (mm)";
						var sieve_6="0.300 (mm)";
						var sieve_7="0.150 (mm)";
						var sample_taken=1000;
								
						var grd_zone = "Zone II";
						
						if(grd_zone=="Zone I")
					{
						//PASSING RANGE
						var pass_1 = randomNumberFromRange(100, 100).toFixed(2);
						var pass_2 = randomNumberFromRange(91.00,99.00).toFixed(2);
						var pass_3 = randomNumberFromRange(65.00,89.00).toFixed(2);
						var pass_4 = randomNumberFromRange(34.00,63.00).toFixed(2);
						var pass_5 = randomNumberFromRange(18.00,30.00).toFixed(2);
						var pass_6 = randomNumberFromRange(7.00,16.00).toFixed(2);
						var pass_7 = randomNumberFromRange(0.50,6.00).toFixed(2);
						
					}
					else if(grd_zone=="Zone II")
					{
						//PASSING RANGE
						var pass_1 = randomNumberFromRange(100, 100).toFixed(2);
						var pass_2 = randomNumberFromRange(91.00,99.00).toFixed(2);
						var pass_3 = randomNumberFromRange(80.00,89.00).toFixed(2);
						var pass_4 = randomNumberFromRange(59.00,78.00).toFixed(2);
						var pass_5 = randomNumberFromRange(36.00,57.00).toFixed(2);
						var pass_6 = randomNumberFromRange(10.00,29.00).toFixed(2);
						var pass_7 = randomNumberFromRange(0.50,8.00).toFixed(2);
				
					}
					else if(grd_zone=="Zone III")
					{
						//PASSING RANGE
						var pass_1 = randomNumberFromRange(100, 100).toFixed(2);
						var pass_2 = randomNumberFromRange(93.00,99.00).toFixed(2);
						var pass_3 = randomNumberFromRange(86.00,92.00).toFixed(2);
						var pass_4 = randomNumberFromRange(76.00,85.00).toFixed(2);
						var pass_5 = randomNumberFromRange(61.00,75.00).toFixed(2);
						var pass_6 = randomNumberFromRange(13.00,39.00).toFixed(2);
						var pass_7 = randomNumberFromRange(0.50,7.00).toFixed(2);
						
					}
					else if(grd_zone=="Zone IV")
					{
						//PASSING RANGE
						var pass_1 = randomNumberFromRange(100, 100).toFixed(2);
						var pass_2 = randomNumberFromRange(98.00,100.00).toFixed(2);
						var pass_3 = randomNumberFromRange(95.50,97.50).toFixed(2);
						var pass_4 = randomNumberFromRange(90.50,94.50).toFixed(2);
						var pass_5 = randomNumberFromRange(81.00,90.00).toFixed(2);
						var pass_6 = randomNumberFromRange(16.00,49.00).toFixed(2);
						var pass_7 = randomNumberFromRange(0.50,14.00).toFixed(2);
						
					}
						
					
					var pass_sample_1 = pass_1.toFixed(2);
					var pass_sample_2 = pass_2.toFixed(2);
					var pass_sample_3 = pass_3.toFixed(2);
					var pass_sample_4 =	pass_4.toFixed(2);		
					var pass_sample_5 = pass_5.toFixed(2);
					var pass_sample_6 = pass_6.toFixed(2);
					var pass_sample_7 = pass_7.toFixed(2);
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-(+pass_sample_1);
					var cum_ret_2 = 100-(+pass_sample_2);
					var cum_ret_3 = 100-(+pass_sample_3);
					var cum_ret_4 = 100-(+pass_sample_4);
					var cum_ret_5 = 100-(+pass_sample_5);
					var cum_ret_6 = 100-(+pass_sample_6);
					var cum_ret_7 = 100-(+pass_sample_7);
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = ((cum_ret_1.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_2 = ((cum_ret_2.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_3 = ((cum_ret_3.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_4 = ((cum_ret_4.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_5 = ((cum_ret_5.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_6 = ((cum_ret_6.toFixed(2))*(+sample_taken))/100;
					var ret_wt_gm_7 = ((cum_ret_7.toFixed(2))*(+sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1.toFixed(2);
					var cum_wt_gm_2 = (+ret_wt_gm_2.toFixed(2))-(+ret_wt_gm_1.toFixed(2));
					var cum_wt_gm_3 = (+ret_wt_gm_3.toFixed(2))-(+ret_wt_gm_2.toFixed(2));
					var cum_wt_gm_4 = (+ret_wt_gm_4.toFixed(2))-(+ret_wt_gm_3.toFixed(2));
					var cum_wt_gm_5 = (+ret_wt_gm_5.toFixed(2))-(+ret_wt_gm_4.toFixed(2));
					var cum_wt_gm_6 = (+ret_wt_gm_6.toFixed(2))-(+ret_wt_gm_5.toFixed(2));
					var cum_wt_gm_7 = (+ret_wt_gm_7.toFixed(2))-(+ret_wt_gm_6.toFixed(2));

						var sums = (+cum_ret_2.toFixed(2))+(+cum_ret_3.toFixed(2))+(+cum_ret_4.toFixed(2))+(+cum_ret_5.toFixed(2))+(+cum_ret_6.toFixed(2))+(+cum_ret_7.toFixed(2));
				
						var fm = (+sums)/100;
						var grd_fm = fm.toFixed(2);
						
								
								
								
								
								//(SUM OF CUM. WAIGHT)
						var blank_extra = (+cum_wt_gm_1.toFixed(2))+(+cum_wt_gm_2.toFixed(2))+(+cum_wt_gm_3.toFixed(2))+(+cum_wt_gm_4.toFixed(2))+(+cum_wt_gm_5.toFixed(2))+(+cum_wt_gm_6.toFixed(2))+(+cum_wt_gm_7.toFixed(2));
						
					
								
						break;
					}
					else
					{
						var chk_grd = "0";
						var grd_zone = "0";	
						var chk_fm = "0";
						var grd_fm = "0";
						
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";
						 
						
					}
				
				}
				
				//sp & wtr
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="sil")
					{
						var chk_silt = "1";
						var silt_1 = 200;
						var silt_2 = randomNumberFromRange(196.2, 197.6);
						var silt_content = (((parseFloat(silt_1)-parseFloat(silt_2))*100)/parseFloat(silt_2));
						
						
						break;
					}
					else
					{
							var chk_silt = "0";
							var silt_1 = "0";
							var silt_2 = "0";
							var silt_content = "0";
							
							
					}
				}


				//sp & wtr
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="wtr")
					{
						var sp_sample_ca = "FINE AGG.";
						var chk_sp = "1";
						var sp_temp = 500;	
						var sp_specific_gravity = randomNumberFromRange(2.610,2.670).toFixed(3);  //(sp_specific_gravity)
						var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010,0.010); //(sp_specific_gravity_1)_1
						 var tems1 = (parseFloat(sp_specific_gravity) * 2);
						var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
						var sp_water_abr = randomNumberFromRange(1.41,1.55).toFixed(2);// (sp_water_abr)_1
						var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02,0.02)////(sp_water_abr_1)_1
						 var tems11 = (parseFloat(sp_water_abr) * 2);
						var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));
						var sp_wt_st_1 = 500;
						var sp_wt_st_2 = 500;
						
					
						
						var equp1  = sp_wt_st_1 * 100;
						var equp2  = sp_wt_st_2 * 100;
						var eqdn1  = (+sp_water_abr_1) + 100;
						var eqdn2  = (+sp_water_abr_2) + 100;
						var sp_w_s_1 = equp1 / eqdn1;
						var sp_w_s_2 = equp2 / eqdn2;													
						var sp_w_sur_1 = (+sp_wt_st_1) - ((+sp_w_s_1) / (+sp_specific_gravity_1));
						var sp_w_sur_2 = (+sp_wt_st_2) - ((+sp_w_s_2) / (+sp_specific_gravity_2));						
						
						
						break;
					}
					else
					{
							var chk_sp = "0";
							var sp_w_sur_1 ="0";
							var sp_w_s_1 ="0";
							var sp_wt_st_1 ="0";						
							
							var sp_w_sur_2 ="0";
							var sp_w_s_2 ="0";
							var sp_wt_st_2 ="0";										
							var sp_specific_gravity_1 ="0";
							var sp_specific_gravity_2 ="0";
							var sp_specific_gravity ="0";
							var sp_water_abr_1 ="0";
							var sp_water_abr_2 ="0";
							var sp_water_abr ="0";
							var sp_sample_ca ="0";
							var sp_temp ="0";
						
							
							
					}
				}
				
				
				//density
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="den")
					{

						
					var chk_den ="1";
					var bdl = randomNumberFromRange(1.62,1.69).toFixed(2);
					var vol = 3.05;
					var avg_wom = parseFloat(bdl) * vol;
					var m21 = 2.70;
					var m22 = 2.70;
					var m23 = 2.70;
					
					var wom1 = avg_wom + randomNumberFromRange(-0.20,0.10);
					var wom2 = avg_wom - randomNumberFromRange(-0.30,0.10);
					var wom3 = avg_wom + randomNumberFromRange(-0.10,0.10);
					
					var m11 = m21 + wom1;
					var m12 = m22 + wom2;
					var m13 = m23 + wom3;

					
					break;
					}
					else
					{
						var chk_den="0";
						var bdl="0";
						var vol="0";
						var avg_wom="0";
						var m21="0";
						var m22="0";
						var m23="0";
						var m11="0";
						var m12="0";
						var m13="0";
						var wom1="0";
						var wom2="0";
						var wom3="0";
						
					}
				
				}
				
				//sp & wtr
				for(var i=0;i<tes_1.length;i++)
				{
					if(tes_1[i]=="sou")
					{
						var chk_sou = "1";
						var go1 = 5.0;
						var go2 = 11.4;
						var go3 = 26.0;
						var go4 = 25.2;
						var go5 = 17.0;
						var go6 = 10.8;
						var go7 = 4.6;
						
						var wt1 = "-";
						var wt2 = "-";
						var wt3 = 100;
						var wt4 = 100;
						var wt5 = 100;
						var wt6 = 100;
						var wt7 = "-";	
						
					
						var wa1 = "-";
						var wa2 = "-";
						var wa3 = randomNumberFromRange(0.20,0.50).toFixed(2);
						var wa4 = randomNumberFromRange(0.20,0.50).toFixed(2);
						var wa5 = randomNumberFromRange(0.20,0.50).toFixed(2);
						var wa6 = randomNumberFromRange(0.20,0.50).toFixed(2);
						var wa7 = randomNumberFromRange(0.20,0.50).toFixed(2);
						
						var soundness = (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
						$('#soundness').val(soundness.toString().substring(0, soundness.toString().indexOf(".") + 3));
												
						
						var eqa3 = (+wa3)/(+go3);
						var eqa4 = (+wa4)/(+go4);
						var eqa5 = (+wa5)/(+go5);
						var eqa6 = (+wa6)/(+go6);
						
						var pp3 = (+eqa3)*100;
						var pp4 = (+eqa4)*100;
						var pp5 = (+eqa5)*100;
						var pp6 = (+eqa6)*100;
						
					
						
						break;
					}
					else
					{
							var chk_silt = "0";
							var soundness = "0";
							var pp1 = "0";
							var pp2 = "0";
							var pp3 = "0";
							var pp4 = "0";
							var pp5 = "0";
							var pp6 = "0";
							var pp7 = "0";
							var wa1 = "0";
							var wa2 = "0";
							var wa3 = "0";
							var wa4 = "0";
							var wa5 = "0";
							var wa6 = "0";
							var wa7 = "0";
							var go1 = "0";
							var go2 = "0";
							var go3 = "0";
							var go4 = "0";
							var go5 = "0";
							var go6 = "0";
							var go7 = "0";
							var wt1 = "0"; 
							var wt2 = "0"; 
							var wt3 = "0"; 
							var wt4 = "0"; 
							var wt5 = "0"; 
							var wt6 = "0"; 
							var wt7 = "0"; 
							
							
					}
				}
	
					
				var type="add";
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grd='+chk_grd+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&sieve_6='+sieve_6+'&sieve_7='+sieve_7+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&cum_wt_gm_6='+cum_wt_gm_6+'&cum_wt_gm_7='+cum_wt_gm_7+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&ret_wt_gm_6='+ret_wt_gm_6+'&ret_wt_gm_7='+ret_wt_gm_7+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&cum_ret_6='+cum_ret_6+'&cum_ret_7='+cum_ret_7+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&pass_sample_6='+pass_sample_6+'&pass_sample_7='+pass_sample_7+'&blank_extra='+blank_extra+'&sample_taken='+sample_taken+'&grd_zone='+grd_zone+'&chk_fm='+chk_fm+'&grd_fm='+grd_fm+'&chk_silt='+chk_silt+'&silt_content='+silt_content+'&sp_temp='+sp_temp+'&silt_1='+silt_1+'&silt_2='+silt_2+'&chk_sp='+chk_sp+'&sp_sample_ca='+sp_sample_ca+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&chk_den='+chk_den+'&m11='+m11+'&m12='+m12+'&m13='+m13+'&m21='+m21+'&m22='+m22+'&m23='+m23+'&wom1='+wom1+'&wom2='+wom2+'&wom3='+wom3+'&avg_wom='+avg_wom+'&vol='+vol+'&bdl='+bdl+'&chk_sou='+chk_sou+'&soundness='+soundness+'&go1='+go1+'&go2='+go2+'&go3='+go3+'&go4='+go4+'&go5='+go5+'&go6='+go6+'&go7='+go7+'&wt1='+wt1+'&wt2='+wt2+'&wt3='+wt3+'&wt4='+wt4+'&wt5='+wt5+'&wt6='+wt6+'&wt7='+wt7+'&pp1='+pp1+'&pp2='+pp2+'&pp3='+pp3+'&pp4='+pp4+'&pp5='+pp5+'&pp6='+pp6+'&pp7='+pp7+'&wa1='+wa1+'&wa2='+wa2+'&wa3='+wa3+'&wa4='+wa4+'&wa5='+wa5+'&wa6='+wa6+'&wa7='+wa7+'&chk_finer='+chk_finer+'&finer_a='+finer_a+'&finer_b='+finer_b+'&avg_finer='+avg_finer;
				
				$.ajax({
			type: 'POST',
			url: base_urls+'save_sand.php',
			data: billData,
			dataType: 'JSON',
			success:function(msg){
		
        }
    });

	
				
}
	
