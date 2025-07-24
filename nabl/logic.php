<script>
  $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
			//ABRASION LOGIC
			var abr_index;
			var abr_wt_t_a_1;
			var abr_wt_t_a_2;
            var abr_wt_t_c_1;
            var abr_wt_t_c_2;
			var abr_wt_t_b_1;
			var abr_wt_t_b_2;
			var abr_sample_abr;
			var abr_grading;
			var abr_weight_charge;
			var abr_num_revo;
			var abr_sphere;


$("#btn_auto").click(function(){
		//alert("Estimate Your Bill Successfully");
		
	
		
	var minNumber = -100;
	var maxNumber = 40;
	sp_sample_ca = "13.2 MM";
	var sieve_1="13.2";	
	var sieve_2="11.2";	
	var sieve_3="5.6";	
	var sieve_4="0.180";	
	var sieve_5="Pan";	
			
 	//SPECIFIC GRAVITY CALCULATION
	var sp_temp = randomNumberFromRange(25.00,27.00);
			$('#sp_temp').val(sp_temp.toFixed(2));
			var sp_specific_gravity = randomNumberFromRange(2.80,2.86);  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.05,0.05); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			
			//1
     		 var sp_w_sur_1 = randomNumberFromRange(1980.00,2020.00);    //(B)_1
			 var sp_w_b_a2_1 = randomNumberFromRange(822.00,828.00);    //(A2)_1
			 var sp_w_b_a1_1 = randomNumberFromRange(2180.00,2190.00); // (A1)_1
			
			var sp_wt_st_1 = parseFloat(sp_w_b_a1_1)-parseFloat(sp_w_b_a2_1); // (A)_1
			
			var sp_water_abr = randomNumberFromRange(0.85,0.90);// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.05,0.05)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			var tts = parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1);
			var sp_w_s_1 = parseFloat(sp_specific_gravity_1)*parseFloat(tts);


			//2nd TRAIL
			 var sp_w_sur_2 = randomNumberFromRange(1980.00,2020.00);    //(B)_1
			 var sp_w_b_a2_2 = randomNumberFromRange(822.00,828.00);    //(A2)_1
			 var sp_w_b_a1_2 = randomNumberFromRange(2180.00,2190.00); // (A1)_1
			
			var sp_wt_st_2 = parseFloat(sp_w_b_a1_2)-parseFloat(sp_w_b_a2_2); // (A)_1				
			
			var tts1 = parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2);
			var sp_w_s_2 = parseFloat(sp_specific_gravity_2)*parseFloat(tts1);
			
			
										
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toFixed(1));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toFixed(1));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(1));
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(1));
			
			 $('#sp_w_b_a1_2').val(sp_w_b_a1_2.toFixed(1));
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toFixed(1));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(1));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(1)); 
								
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));
			$('#sp_sample_ca').val(sp_sample_ca);
	
	//ABRASION INDEX
   abr_grading =  $("#abr_grading").val();
			if(abr_grading=="A")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(5000.00, 5000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(5000.00, 5000.00);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
				 var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
							
			}
			else if(abr_grading=="B")
			{
				abr_weight_charge =  randomNumberFromRange(4559.00, 4609.00);
				abr_sphere = 11;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(5000.00, 5000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(5000.00, 5000.00);
					var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
					var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
			else if(abr_grading=="C")
			{
				abr_weight_charge =  randomNumberFromRange(3310.00, 3350.00);
				abr_sphere = 8;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(5000.00, 5000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(5000.00, 5000.00);
					var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
					var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
			else if(abr_grading=="D")
			{
				abr_weight_charge =  randomNumberFromRange(2485.00,2515.00);
				abr_sphere = 6;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(5000.00, 5000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(5000.00, 5000.00);
				var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
				 var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
			else if(abr_grading=="E")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(10000.00, 10000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(10000.00, 10000.00);
				var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
				 var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
			else if(abr_grading=="F")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(10000.00, 10000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(10000.00, 10000.00);
				var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
				 var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
			else if(abr_grading=="G")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('13 - 2 MM');
				 
				 abr_index = randomNumberFromRange(10.00,20.00);
				 abr_wt_t_c_1 = parseFloat(abr_index) + randomNumberFromRange(-0.10,0.10);
				 var tems = (parseFloat(abr_index) * 2);
				 abr_wt_t_c_2 = (parseFloat(tems)-parseFloat(abr_wt_t_c_1));	
				 abr_wt_t_a_1 = randomNumberFromRange(10000.00, 10000.00);
				 abr_wt_t_a_2 = randomNumberFromRange(10000.00, 10000.00);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseFloat(abr_wt_t_a_1))/100;
				 var bb = (parseFloat(abr_wt_t_c_2)*parseFloat(abr_wt_t_a_2))/100;
				 abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(aa);
				 abr_wt_t_b_2 = parseFloat(abr_wt_t_a_2)-parseFloat(bb);
				
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(0));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2.toFixed(0));
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed(0));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				$('#abr_index').val(abr_index.toFixed(2));
			}
           
			//END
			
			//IMPACT VALUE
			//10-09-2018
			var imp_value = randomNumberFromRange(10.00,20.00);
			var imp_value_1 = parseFloat(imp_value) + randomNumberFromRange(-0.10,0.10);
			var tems = (parseFloat(imp_value) * 2);
			var imp_value_2 = (parseFloat(tems)-parseFloat(imp_value_1));
			$('#imp_value').val(imp_value.toFixed(0));
			$('#imp_value_1').val(imp_value_1.toFixed(2));
			$('#imp_value_2').val(imp_value_2.toFixed(2));
			
			var imp_w_m_a_1 = randomNumberFromRange(347.00,350.00);
			var imp_w_m_a_2 = randomNumberFromRange(347.00,350.00);
			
			var imp_w_m_c_1 = ((parseFloat(imp_value_1)*parseFloat(imp_w_m_a_1))/100);
			var imp_w_m_c_2 = ((parseFloat(imp_value_2)*parseFloat(imp_w_m_a_2))/100);
			
			var imp_w_m_d_1 = randomNumberFromRange(0.02,0.05);
			var imp_w_m_d_2 = randomNumberFromRange(0.02,0.04);
			
			var imp_w_m_b_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_c_1));
			var imp_w_m_b_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_c_2));

			
			$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(1));
			$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(1));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(1));
			$('#imp_w_m_d_1').val(imp_w_m_d_1.toFixed(2));
			$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(1));
			$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(1));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(1));			
			$('#imp_w_m_d_2').val(imp_w_m_d_2.toFixed(2));		
	
	
	
	
	
	
					$("#chk_grd").prop("checked", true); 
					$("#chk_impact").prop("checked", true); 
					$("#chk_abr").prop("checked", true); 
					$("#chk_flk").prop("checked", true); 
					$("#chk_sp").prop("checked", true); 
					$("#chk_ll").prop("checked", true); 
					
					var sample_taken=30000;
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(96.00,99.00);
					var pass_sample_3 = randomNumberFromRange(16.00,34.00);
					var pass_sample_4 = randomNumberFromRange(1.00,5.00);
					var pass_sample_5 = randomNumberFromRange(0.00,0.00);
					
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(1));
					$('#cum_ret_2').val(cum_ret_2.toFixed(1));
					$('#cum_ret_3').val(cum_ret_3.toFixed(1));
					$('#cum_ret_4').val(cum_ret_4.toFixed(1));
					$('#cum_ret_5').val(cum_ret_5.toFixed(1));
					
				   
					$('#pass_sample_1').val(pass_sample_1.toFixed(1));
					$('#pass_sample_2').val(pass_sample_2.toFixed(1));
					$('#pass_sample_3').val(pass_sample_3.toFixed(1));
					$('#pass_sample_4').val(pass_sample_4.toFixed(1));
					$('#pass_sample_5').val(pass_sample_5.toFixed(1));
					
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					 $('#sample_taken').val(sample_taken.toFixed(0));


    
  			//FLANKINESS INDEX	   			
					//DISABLE CHECK BOXES
		 $("#chk_f1").prop("checked", true); 
		 $("#chk_f2").prop("checked", true); 
		 $("#chk_f3").prop("checked", true); 
		 $("#chk_f4").prop("checked", true); 		 
		 $("#chk_f5").prop("checked", true); 		 
		 $("#chk_f6").prop("checked", true); 		 
		 $("#chk_f7").prop("checked", true); 		 
		 $("#chk_f8").prop("checked", true); 		 
		  $("#chk_f1").attr("disabled", true);
		  $("#chk_f2").attr("disabled", true);
		  $("#chk_f3").attr("disabled", true);
		  $("#chk_f4").attr("disabled", true);
		  $("#chk_f5").attr("disabled", true);
		  $("#chk_f6").attr("disabled", true);
		  $("#chk_f7").attr("disabled", true);
		  $("#chk_f8").attr("disabled", true);
		  $("#chk_f9").attr("disabled", true);
		  //DISABLE TEXT BOXES 
			/* $("#a5").attr("disabled", true);
			$("#a6").attr("disabled", true);
			$("#a7").attr("disabled", true);
			$("#a8").attr("disabled", true);			 */
			$("#a9").attr("disabled", true);			
			/* $("#b5").attr("disabled", true);
			$("#b6").attr("disabled", true);
			$("#b7").attr("disabled", true);
			$("#b8").attr("disabled", true); */
			$("#b9").attr("disabled", true);
			/* $("#c5").attr("disabled", true);
			$("#c6").attr("disabled", true);
			$("#c7").attr("disabled", true);
			$("#c8").attr("disabled", true); */
			$("#c9").attr("disabled", true);
			/* $("#d5").attr("disabled", true);
			$("#d6").attr("disabled", true);
			$("#d7").attr("disabled", true);
			$("#d8").attr("disabled", true); */
			$("#d9").attr("disabled", true);
			/* $("#e5").attr("disabled", true);
			$("#e6").attr("disabled", true);
			$("#e7").attr("disabled", true);
			$("#e8").attr("disabled", true); */
			$("#e9").attr("disabled", true);
			
			/* $("#aa5").attr("disabled", true);
			$("#aa6").attr("disabled", true);
			$("#aa7").attr("disabled", true);
			$("#aa8").attr("disabled", true); */
			$("#aa9").attr("disabled", true);
			/* $("#bb5").attr("disabled", true);
			$("#bb6").attr("disabled", true);
			$("#bb7").attr("disabled", true);
			$("#bb8").attr("disabled", true); */
			$("#bb9").attr("disabled", true);
			/* $("#dd5").attr("disabled", true);
			$("#dd6").attr("disabled", true);
			$("#dd7").attr("disabled", true);
			$("#dd8").attr("disabled", true); */
			$("#dd9").attr("disabled", true);
		
			var fi_index = randomNumberFromRange(5.00, 15.00);
			$('#fi_index').val(fi_index.toFixed(2));
			var ei_index = randomNumberFromRange(5.00, 15.00);
			$('#ei_index').val(ei_index.toFixed(2));
			
			var combined_index = parseFloat(fi_index)+parseFloat(ei_index);
			$('#combined_index').val(combined_index.toFixed(2));
			
			
			// THICKNESS GAUGAE OF FLAKINESS (E)  (X * Y)/100
			e1 = parseFloat(fi_index)*(parseFloat(7.00)/100);
			e2 = parseFloat(fi_index)*(parseFloat(17.00)/100);
			e3 = parseFloat(fi_index)*(parseFloat(19.00)/100);
			e4 = parseFloat(fi_index)*(parseFloat(24.00)/100);	
			e5 = parseFloat(fi_index)*(parseFloat(12.00)/100);
			e6 = parseFloat(fi_index)*(parseFloat(11.00)/100);
			e7 = parseFloat(fi_index)*(parseFloat(6.00)/100);
			e8 = parseFloat(fi_index)*(parseFloat(4.00)/100);
			e9 = 0;//parseFloat(fi_index)*(parseFloat(7.00)/100);
			
			// Weight B1(gm) (a)
			a1 = randomNumberFromRange(4400.0, 4600.0);
			a2 = randomNumberFromRange(2900.0, 3200.0);
			a3 = randomNumberFromRange(1800.0, 2000.0);
			a4 = randomNumberFromRange(600.0, 750.0);		
			a5 = randomNumberFromRange(300.0, 400.0);
			a6 = randomNumberFromRange(140.0, 200.0);
			a7 = randomNumberFromRange(120.0, 135.0);
			a8 = randomNumberFromRange(75.0, 100.0);
			a9 =  0;//randomNumberFromRange(140.0, 200.0);
			
			suma = parseFloat(a1)+parseFloat(a2)+parseFloat(a3)+parseFloat(a4)+parseFloat(a5)+parseFloat(a6)+parseFloat(a7)+parseFloat(a8)+parseFloat(a9);
			
			b1 = (parseFloat(e1)*parseFloat(suma))/100; 
			b2 = (parseFloat(e2)*parseFloat(suma))/100; 
			b3 = (parseFloat(e3)*parseFloat(suma))/100; 
			b4 = (parseFloat(e4)*parseFloat(suma))/100; 
			b5 = (parseFloat(e5)*parseFloat(suma))/100; 
			b6 = (parseFloat(e6)*parseFloat(suma))/100; 
			b7 = (parseFloat(e7)*parseFloat(suma))/100; 
			b8 = (parseFloat(e8)*parseFloat(suma))/100; 
			b9 = 0;//(parseFloat(e9)*parseFloat(suma))/100; 
			
			c1 = (parseFloat(b1)/parseFloat(a1))*100;
			c2 = (parseFloat(b2)/parseFloat(a2))*100;
			c3 = (parseFloat(b3)/parseFloat(a3))*100;
			c4 = (parseFloat(b4)/parseFloat(a4))*100;
			c5 = (parseFloat(b5)/parseFloat(a5))*100;
			c6 = (parseFloat(b6)/parseFloat(a6))*100;
			c7 = (parseFloat(b7)/parseFloat(a7))*100;
			c8 = (parseFloat(b8)/parseFloat(a8))*100;
			c9 = 0;//(parseFloat(b9)/parseFloat(a9))*100;
			
			d1 = (parseFloat(a1)/parseFloat(suma))*100;
			d2 = (parseFloat(a2)/parseFloat(suma))*100;
			d3 = (parseFloat(a3)/parseFloat(suma))*100;
			d4 = (parseFloat(a4)/parseFloat(suma))*100;
			d5 = (parseFloat(a5)/parseFloat(suma))*100;
			d6 = (parseFloat(a6)/parseFloat(suma))*100;
			d7 = (parseFloat(a7)/parseFloat(suma))*100;
			d8 = (parseFloat(a8)/parseFloat(suma))*100;
			d9 = 0;//(parseFloat(a9)/parseFloat(suma))*100;
			
			dd1 = parseFloat(ei_index)*(parseFloat(7.00)/100);
			dd2 = parseFloat(ei_index)*(parseFloat(17.00)/100);
			dd3 = parseFloat(ei_index)*(parseFloat(19.00)/100);
			dd4 = parseFloat(ei_index)*(parseFloat(24.00)/100);
			dd5 = parseFloat(ei_index)*(parseFloat(12.00)/100);
			dd6 = parseFloat(ei_index)*(parseFloat(11.00)/100);
			dd7 = parseFloat(ei_index)*(parseFloat(6.00)/100);
			dd8 = parseFloat(ei_index)*(parseFloat(4.00)/100);
			dd9 = 0;//parseFloat(ei_index)*(parseFloat(7.00)/100);
			
			
			aa1= (parseFloat(dd1)*parseFloat(suma))/100; 
			aa2= (parseFloat(dd2)*parseFloat(suma))/100; 
			aa3= (parseFloat(dd3)*parseFloat(suma))/100; 
			aa4= (parseFloat(dd4)*parseFloat(suma))/100; 
			aa5= (parseFloat(dd5)*parseFloat(suma))/100; 
			aa6= (parseFloat(dd6)*parseFloat(suma))/100; 
			aa7= (parseFloat(dd7)*parseFloat(suma))/100; 
			aa8= (parseFloat(dd8)*parseFloat(suma))/100; 
			aa9= 0;// (parseFloat(dd9)*parseFloat(suma))/100; 
			
			
			bb1=(parseFloat(aa1)/parseFloat(a1))*100;
			bb2=(parseFloat(aa2)/parseFloat(a2))*100;
			bb3=(parseFloat(aa3)/parseFloat(a3))*100;
			bb4=(parseFloat(aa4)/parseFloat(a4))*100;
			bb5=(parseFloat(aa5)/parseFloat(a5))*100;
			bb6=(parseFloat(aa6)/parseFloat(a6))*100;
			bb7=(parseFloat(aa7)/parseFloat(a7))*100;
			bb8=(parseFloat(aa8)/parseFloat(a8))*100;
			bb9=0;// (parseFloat(aa9)/parseFloat(a9))*100;

			
			
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#a4').val(a4.toFixed(2));
			$('#a5').val(a5.toFixed(2));
			$('#a6').val(a6.toFixed(2));
			$('#a7').val(a7.toFixed(2));
			$('#a8').val(a8.toFixed(2));
			$('#a9').val(a9.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#b3').val(b3.toFixed(2));
			$('#b4').val(b4.toFixed(2));
			$('#b5').val(b5.toFixed(2));			
			$('#b6').val(b6.toFixed(2));			
			$('#b7').val(b7.toFixed(2));			
			$('#b8').val(b8.toFixed(2));			
			$('#b9').val(b9.toFixed(2));			
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			$('#c6').val(c6.toFixed(2));
			$('#c7').val(c7.toFixed(2));
			$('#c8').val(c8.toFixed(2));
			$('#c9').val(c9.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			$('#d6').val(d6.toFixed(2));
			$('#d7').val(d7.toFixed(2));
			$('#d8').val(d8.toFixed(2));
			$('#d9').val(d9.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
			$('#e6').val(e6.toFixed(2));
			$('#e7').val(e7.toFixed(2));
			$('#e8').val(e8.toFixed(2));
			$('#e9').val(e9.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));		
			$('#aa2').val(aa2.toFixed(2));		
			$('#aa3').val(aa3.toFixed(2));		
			$('#aa4').val(aa4.toFixed(2));		
			$('#aa5').val(aa5.toFixed(2));		
			$('#aa6').val(aa6.toFixed(2));		
			$('#aa7').val(aa7.toFixed(2));		
			$('#aa8').val(aa8.toFixed(2));		
			$('#aa9').val(aa9.toFixed(2));		
			
			$('#bb1').val(bb1.toFixed(2));	
			$('#bb2').val(bb2.toFixed(2));	
			$('#bb3').val(bb3.toFixed(2));	
			$('#bb4').val(bb4.toFixed(2));	
			$('#bb5').val(bb5.toFixed(2));	
			$('#bb6').val(bb6.toFixed(2));	
			$('#bb7').val(bb7.toFixed(2));	
			$('#bb8').val(bb8.toFixed(2));	
			$('#bb9').val(bb9.toFixed(2));	
						
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			$('#dd6').val(dd6.toFixed(2));
			$('#dd7').val(dd7.toFixed(2));
			$('#dd8').val(dd8.toFixed(2));
			$('#dd9').val(dd9.toFixed(2));
	<!------------------------------------------------------------------>
			//PASSING RANGE
					var p_ll_1 = randomNumberFromRange(14, 17);
					var p_ll_2 = randomNumberFromRange(18, 19);
					var temp1 = 20 - parseFloat(p_ll_2);
					var temp2 = 20 - parseFloat(p_ll_1);
					var p_ll_3 = 20;
					var p_ll_4 = 20 + parseFloat(temp1);
					var p_ll_5 = 20 + parseFloat(temp2);	

					var mc_ll_1 = randomNumberFromRange(15.00, 17.00);
					var mc_ll_2 = randomNumberFromRange(17.01, 19.00);
					var mc_ll_3 = randomNumberFromRange(20.01, 25.00);
					var tem1 = parseFloat(mc_ll_3) - parseFloat(mc_ll_2);
					var tem2 = parseFloat(mc_ll_3) - parseFloat(mc_ll_1);
					var mc_ll_4 = parseFloat(mc_ll_3)+parseFloat(tem1);
					var mc_ll_5 = parseFloat(mc_ll_3)+parseFloat(tem2);

													

					var liquide_limit = mc_ll_3;
					
						
					var od_ll_1 = randomNumberFromRange(20.00, 25.00);
					var od_ll_2 = randomNumberFromRange(20.00, 25.00);
					var od_ll_3 = randomNumberFromRange(20.00, 25.00);
					var od_ll_4 = randomNumberFromRange(20.00, 25.00);
					var od_ll_5 = randomNumberFromRange(20.00, 25.00);
					
					var con_ll_1 = randomNumberFromRange(25.01, 30.00);
					var con_ll_2 = randomNumberFromRange(25.01, 30.00);
					var con_ll_3 = randomNumberFromRange(25.01, 30.00);
					var con_ll_4 = randomNumberFromRange(25.01, 30.00);
					var con_ll_5 = randomNumberFromRange(25.01, 30.00);
				
					var wtr_ll_1 = (parseFloat(mc_ll_1)*parseFloat(od_ll_1))/100;
					var wtr_ll_2 = (parseFloat(mc_ll_2)*parseFloat(od_ll_2))/100;
					var wtr_ll_3 = (parseFloat(mc_ll_3)*parseFloat(od_ll_3))/100;
					var wtr_ll_4 = (parseFloat(mc_ll_4)*parseFloat(od_ll_4))/100;
					var wtr_ll_5 = (parseFloat(mc_ll_5)*parseFloat(od_ll_5))/100;
			
					var wt_ll_1 = parseFloat(wtr_ll_1)+parseFloat(con_ll_1)+parseFloat(od_ll_1);
					var wt_ll_2 = parseFloat(wtr_ll_2)+parseFloat(con_ll_2)+parseFloat(od_ll_2);
					var wt_ll_3 = parseFloat(wtr_ll_3)+parseFloat(con_ll_3)+parseFloat(od_ll_3);
					var wt_ll_4 = parseFloat(wtr_ll_4)+parseFloat(con_ll_4)+parseFloat(od_ll_4);
					var wt_ll_5 = parseFloat(wtr_ll_5)+parseFloat(con_ll_5)+parseFloat(od_ll_5);
					
					var dy_ll_1 = parseFloat(wt_ll_1)-parseFloat(wtr_ll_1);
					var dy_ll_2 = parseFloat(wt_ll_2)-parseFloat(wtr_ll_2);
					var dy_ll_3 = parseFloat(wt_ll_3)-parseFloat(wtr_ll_3);
					var dy_ll_4 = parseFloat(wt_ll_4)-parseFloat(wtr_ll_4);
					var dy_ll_5 = parseFloat(wt_ll_5)-parseFloat(wtr_ll_5);

					var avg_ll = (parseFloat(mc_ll_1)+parseFloat(mc_ll_2)+parseFloat(mc_ll_4)+parseFloat(mc_ll_5))/4;

					$('#liquide_limit').val(liquide_limit.toFixed(2));
					$('#avg_ll').val(avg_ll.toFixed(2));
					$('#p_ll_1').val(p_ll_1.toFixed(0));
					$('#p_ll_2').val(p_ll_2.toFixed(0));
					$('#p_ll_3').val(p_ll_3.toFixed(0));
					$('#p_ll_4').val(p_ll_4.toFixed(0));
					$('#p_ll_5').val(p_ll_5.toFixed(0));
					$('#mc_ll_1').val(mc_ll_1.toFixed(2));
					$('#mc_ll_2').val(mc_ll_2.toFixed(2));
					$('#mc_ll_3').val(mc_ll_3.toFixed(2));
					$('#mc_ll_4').val(mc_ll_4.toFixed(2));
					$('#mc_ll_5').val(mc_ll_5.toFixed(2));
					var p_pl_1,p_pl_2,p_pl_3,cn_ll_1,cn_ll_2,cn_ll_3,cn_ll_4,cn_ll_5,cn_pl_1,cn_pl_2,cn_pl_3;	
					$('#p_pl_1').val(p_pl_1);
					$('#p_pl_2').val(p_pl_2);
					$('#p_pl_3').val(p_pl_3);

					$('#cn_ll_1').val(cn_ll_1);
					$('#cn_ll_2').val(cn_ll_2);
					$('#cn_ll_3').val(cn_ll_3);
					$('#cn_ll_4').val(cn_ll_4);
					$('#cn_ll_5').val(cn_ll_5);

					$('#cn_pl_1').val(cn_pl_1);
					$('#cn_pl_2').val(cn_pl_2);
					$('#cn_pl_3').val(cn_pl_3);
					
					$('#wt_ll_1').val(wt_ll_1.toFixed(2));
					$('#wt_ll_2').val(wt_ll_2.toFixed(2));
					$('#wt_ll_3').val(wt_ll_3.toFixed(2));
					$('#wt_ll_4').val(wt_ll_4.toFixed(2));
					$('#wt_ll_5').val(wt_ll_5.toFixed(2));

					$('#dy_ll_1').val(dy_ll_1.toFixed(2));
					$('#dy_ll_2').val(dy_ll_2.toFixed(2));
					$('#dy_ll_3').val(dy_ll_3.toFixed(2));
					$('#dy_ll_4').val(dy_ll_4.toFixed(2));
					$('#dy_ll_5').val(dy_ll_5.toFixed(2));

					$('#wtr_ll_1').val(wtr_ll_1.toFixed(2));
					$('#wtr_ll_2').val(wtr_ll_2.toFixed(2));
					$('#wtr_ll_3').val(wtr_ll_3.toFixed(2));
					$('#wtr_ll_4').val(wtr_ll_4.toFixed(2));
					$('#wtr_ll_5').val(wtr_ll_5.toFixed(2));

					$('#con_ll_1').val(con_ll_1.toFixed(2));
					$('#con_ll_2').val(con_ll_2.toFixed(2));
					$('#con_ll_3').val(con_ll_3.toFixed(2));
					$('#con_ll_4').val(con_ll_4.toFixed(2));
					$('#con_ll_5').val(con_ll_5.toFixed(2));

					$('#od_ll_1').val(od_ll_1.toFixed(2));
					$('#od_ll_2').val(od_ll_2.toFixed(2));
					$('#od_ll_3').val(od_ll_3.toFixed(2));
					$('#od_ll_4').val(od_ll_4.toFixed(2));
					$('#od_ll_5').val(od_ll_5.toFixed(2));

					
					var chk_pl = randomNumberFromRange(4.00, 6.00);
					$('#chk_pl').val(chk_pl.toFixed(2));
					
					var plastic_limit = parseFloat(liquide_limit)-parseFloat(chk_pl);
					var avg_pl = plastic_limit;
					$('#avg_pl').val(avg_pl.toFixed(2));
					$('#plastic_limit').val(plastic_limit.toFixed(2));
					
					var mc_pl_1  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var mc_pl_2  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var abc  = parseFloat(mc_pl_1)+parseFloat(mc_pl_2);
					var mc_pl_3  = (parseFloat(avg_pl)*3) - abc;
				
					var od_pl_1 = randomNumberFromRange(20.00, 25.00);
					var od_pl_2 = randomNumberFromRange(20.00, 25.00);
					var od_pl_3 = randomNumberFromRange(20.00, 25.00);

					var con_pl_1 = randomNumberFromRange(26.00, 30.00);
					var con_pl_2 = randomNumberFromRange(26.00, 30.00);
					var con_pl_3 = randomNumberFromRange(26.00, 30.00);

					var wtr_pl_1 = (parseFloat(mc_pl_1)*parseFloat(od_pl_1))/100;
					var wtr_pl_2 = (parseFloat(mc_pl_2)*parseFloat(od_pl_2))/100;
					var wtr_pl_3 = (parseFloat(mc_pl_3)*parseFloat(od_pl_3))/100;
					
					var wt_pl_1 = parseFloat(wtr_pl_1)+parseFloat(con_pl_1)+parseFloat(od_pl_1);
					var wt_pl_2 = parseFloat(wtr_pl_2)+parseFloat(con_pl_2)+parseFloat(od_pl_2);
					var wt_pl_3 = parseFloat(wtr_pl_3)+parseFloat(con_pl_3)+parseFloat(od_pl_3);
					
					var dy_pl_1 = parseFloat(wt_pl_1)-parseFloat(wtr_pl_1);
					var dy_pl_2 = parseFloat(wt_pl_2)-parseFloat(wtr_pl_2);
					var dy_pl_3 = parseFloat(wt_pl_3)-parseFloat(wtr_pl_3);
					
					
					$('#wt_pl_1').val(wt_pl_1.toFixed(2));
					$('#wt_pl_2').val(wt_pl_2.toFixed(2));
					$('#wt_pl_3').val(wt_pl_3.toFixed(2));

					

					$('#dy_pl_1').val(dy_pl_1.toFixed(2));
					$('#dy_pl_2').val(dy_pl_2.toFixed(2));
					$('#dy_pl_3').val(dy_pl_3.toFixed(2));

					

					$('#wtr_pl_1').val(wtr_pl_1.toFixed(2));
					$('#wtr_pl_2').val(wtr_pl_2.toFixed(2));
					$('#wtr_pl_3').val(wtr_pl_3.toFixed(2));

					

					$('#con_pl_1').val(con_pl_1.toFixed(2));
					$('#con_pl_2').val(con_pl_2.toFixed(2));
					$('#con_pl_3').val(con_pl_3.toFixed(2));

					

					$('#od_pl_1').val(od_pl_1.toFixed(2));
					$('#od_pl_2').val(od_pl_2.toFixed(2));
					$('#od_pl_3').val(od_pl_3.toFixed(2));
					
					

					$('#mc_pl_1').val(mc_pl_1.toFixed(2));
					$('#mc_pl_2').val(mc_pl_2.toFixed(2));
					$('#mc_pl_3').val(mc_pl_3.toFixed(2));

			
	<!------------------------------------------------------------------>
});

$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();	
	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save45_0_075_mic_mm.php',
         data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(html){
            $('#display_data').html(html);

        }
    });
}

function saveMetal(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						if(document.getElementById('chk_grd').checked) {
								var chk_grd = "1";
						}
						else{
								var chk_grd = "0";
						}
							//GRADATION DATA FETCH-1
							var sieve_1="53";	
							var sieve_2="45";	
							var sieve_3="22.4";	
							var sieve_4="11.2";	
							var sieve_5="4.75";	
							var sieve_6="2.36";	
							var sieve_7="0.600";	
							var sieve_8="0.075";	
							var sieve_9="Pan";		

							var sample_taken = $('#sample_taken').val();
							var blank_extra = $('#blank_extra').val();
							
							var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
							var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
							var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
							var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
							var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
							var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
							var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
							var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
							var cum_wt_gm_9 = $('#cum_wt_gm_9').val();
															
							var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
							var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
							var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
							var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
							var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
							var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
							var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
							var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
							var ret_wt_gm_9 = $('#ret_wt_gm_9').val();
							
							var cum_ret_1 = $('#cum_ret_1').val();
							var cum_ret_2 = $('#cum_ret_2').val();
							var cum_ret_3 = $('#cum_ret_3').val();
							var cum_ret_4 = $('#cum_ret_4').val();
							var cum_ret_5 = $('#cum_ret_5').val();
							var cum_ret_6 = $('#cum_ret_6').val();
							var cum_ret_7 = $('#cum_ret_7').val();
							var cum_ret_8 = $('#cum_ret_8').val();
							var cum_ret_9 = $('#cum_ret_9').val();
							
							var pass_sample_1 = $('#pass_sample_1').val();
							var pass_sample_2 = $('#pass_sample_2').val();
							var pass_sample_3 = $('#pass_sample_3').val();
							var pass_sample_4 = $('#pass_sample_4').val();
							var pass_sample_5 = $('#pass_sample_5').val();
							var pass_sample_6 = $('#pass_sample_6').val();
							var pass_sample_7 = $('#pass_sample_7').val();
							var pass_sample_8 = $('#pass_sample_8').val();
							var pass_sample_9 = $('#pass_sample_9').val();
						break;
					}
					else
					{
						var chk_grd = "0";	
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						var cum_wt_gm_8 ="0";
						var cum_wt_gm_9 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						var ret_wt_gm_8 ="0";
						var ret_wt_gm_9 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
						var cum_ret_8 ="0";
						var cum_ret_9 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
						var pass_sample_8 ="0";
						var pass_sample_9 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";
					}
														
				}

					//mdd omc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mdd")
					{	
						if(document.getElementById('chk_mdd').checked) {
							var chk_mdd = "1";
						}
						else{
							var chk_mdd = "0";
						}					
						//mdd omc
							var m11 = $('#m11').val();
							var m12 = $('#m12').val();
							var m14 = $('#m13').val();
							var m13 = $('#m14').val();
							var m15 = $('#m15').val();
							var m16 = $('#m16').val();
							
							var m21 = $('#m21').val();
							var m22 = $('#m22').val();
							var m23 = $('#m23').val();
							var m24 = $('#m24').val();
							var m25 = $('#m25').val();
							var m26 = $('#m26').val();
							
							var m31 = $('#m31').val();
							var m32 = $('#m32').val();
							var m33 = $('#m33').val();
							var m34 = $('#m34').val();
							var m35 = $('#m35').val();
							var m36 = $('#m36').val();
							
							var m41 = $('#m41').val();
							var m42 = $('#m42').val();
							var m43 = $('#m43').val();
							var m44 = $('#m44').val();
							var m45 = $('#m45').val();
							var m46 = $('#m46').val();
							
							var m51 = $('#m51').val();
							var m52 = $('#m52').val();
							var m53 = $('#m53').val();
							var m54 = $('#m54').val();
							var m55 = $('#m55').val();
							var m56 = $('#m56').val();
							
							var m61 = $('#m61').val();
							var m62 = $('#m62').val();
							var m63 = $('#m63').val();
							var m64 = $('#m64').val();
							var m65 = $('#m65').val();
							var m66 = $('#m66').val();
							
							var m71 = $('#m71').val();
							var m72 = $('#m72').val();
							var m73 = $('#m73').val();
							var m74 = $('#m74').val();
							var m75 = $('#m75').val();
							var m76 = $('#m76').val();
							
							
							var d11 = $('#d11').val();
							var d12 = $('#d12').val();
							var d13 = $('#d13').val();
							var d14 = $('#d14').val();
							var d15 = $('#d15').val();
							var d16 = $('#d16').val();
							
							var d21 = $('#d21').val();
							var d22 = $('#d22').val();
							var d23 = $('#d23').val();
							var d24 = $('#d24').val();
							var d25 = $('#d25').val();
							var d26 = $('#d26').val();
							
							var d31 = $('#d31').val();
							var d32 = $('#d32').val();
							var d33 = $('#d33').val();
							var d34 = $('#d34').val();
							var d35 = $('#d35').val();
							var d36 = $('#d36').val();
							
							var d41 = $('#d41').val();
							var d42 = $('#d42').val();
							var d43 = $('#d43').val();
							var d44 = $('#d44').val();
							var d45 = $('#d45').val();
							var d46 = $('#d46').val();
							
							var d51 = $('#d51').val();
							var d52 = $('#d52').val();
							var d53 = $('#d53').val();
							var d54 = $('#d54').val();
							var d55 = $('#d55').val();
							var d56 = $('#d56').val();
							
							var d61 = $('#d61').val();
							var d62 = $('#d62').val();
							var d63 = $('#d63').val();
							var d64 = $('#d64').val();
							var d65 = $('#d65').val();
							var d66 = $('#d66').val();
							
							var d71 = $('#d71').val();
							var d72 = $('#d72').val();
							var d73 = $('#d73').val();
							var d74 = $('#d74').val();
							var d75 = $('#d75').val();
							var d76 = $('#d76').val();
							
							var mdd = $('#mdd').val();
							var omc = $('#omc').val();
							var cbr = $('#cbr').val();
						break;
						}
						else
						{
						
							var m11 = "0";
							var m12 = "0";
							var m14 = "0";
							var m13 = "0";
							var m15 = "0";
							var m16 = "0";
							
							var m21 = "0";
							var m22 = "0";
							var m23 = "0";
							var m24 = "0";
							var m25 = "0";
							var m26 = "0";
							
							var m31 = "0";
							var m32 = "0";
							var m33 = "0";
							var m34 = "0";
							var m35 = "0";
							var m36 = "0";
							
							var m41 = "0";
							var m42 = "0";
							var m43 = "0";
							var m44 = "0";
							var m45 = "0";
							var m46 = "0";
							
							var m51 = "0";
							var m52 = "0";
							var m53 = "0";
							var m54 = "0";
							var m55 = "0";
							var m56 = "0";
							
							var m61 = "0";
							var m62 = "0";
							var m63 = "0";
							var m64 = "0";
							var m65 = "0";
							var m66 = "0";
							
							var m71 = "0";
							var m72 = "0";
							var m73 = "0";
							var m74 = "0";
							var m75 = "0";
							var m76 = "0";
							
							
							var d11 = "0";
							var d12 = "0";
							var d13 = "0";
							var d14 = "0";
							var d15 = "0";
							var d16 = "0";
							
							var d21 = "0";
							var d22 = "0";
							var d23 = "0";
							var d24 = "0";
							var d25 = "0";
							var d26 = "0";
							
							var d31 = "0";
							var d32 = "0";
							var d33 = "0";
							var d34 = "0";
							var d35 = "0";
							var d36 = "0";
							
							var d41 = "0";
							var d42 = "0";
							var d43 = "0";
							var d44 = "0";
							var d45 = "0";
							var d46 = "0";
							
							var d51 = "0";
							var d52 = "0";
							var d53 = "0";
							var d54 = "0";
							var d55 = "0";
							var d56 = "0";
							
							var d61 = "0";
							var d62 = "0";
							var d63 = "0";
							var d64 = "0";
							var d65 = "0";
							var d66 = "0";
							
							var d71 = "0";
							var d72 = "0";
							var d73 = "0";
							var d74 = "0";
							var d75 = "0";
							var d76 = "0";
							
							var mdd = "0";
							var omc = "0";
							var cbr = "0";
						}
				
						}
				
				
				//ABRASION VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						if(document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
							}
							else{
								var chk_abr = "0";
							}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_sample_abr = $('#abr_sample_abr').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();		
						break;
					}
					else
					{
						var chk_abr = "0";	
						var abr_sample_abr ="0";
						var abr_wt_t_a_1 ="0";
						var abr_wt_t_b_1 ="0";
						var abr_wt_t_c_1 ="0";
						var abr_wt_t_a_2 ="0";
						var abr_wt_t_b_2 ="0";
						var abr_grading ="0";
						var abr_wt_t_c_2 ="0";
						var abr_index ="0";
						var abr_sphere ="0";
						var abr_num_revo ="0";
						var abr_weight_charge ="0";
					}
				}
				
				//IMPACT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							if(document.getElementById('chk_impact').checked) {
									var chk_impact = "1";
							}
							else{
									var chk_impact = "0";
							}
							//impact value-3
							var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
							var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
							var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
							var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
							var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
							var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
							var imp_value_1 = $('#imp_value_1').val();
							var imp_value_2 = $('#imp_value_2').val();
							var imp_w_m_d_1 = $('#imp_w_m_d_1').val();
							var imp_w_m_d_2 = $('#imp_w_m_d_2').val();
							var imp_value = $('#imp_value').val();
							break;
					}
					else
					{
						var chk_impact = "0";	
						var imp_value ="0";
						var imp_value_1 ="0";
						var imp_value_2 ="0";
						var imp_w_m_a_1 ="0";
						var imp_w_m_b_1 ="0";
						var imp_w_m_c_1 ="0";
						var imp_w_m_d_1 ="0";
						var imp_w_m_a_2 ="0";
						var imp_w_m_b_2 ="0";
						var imp_w_m_c_2 ="0";
						var imp_w_m_d_2 ="0";
					}

				}
								
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();			
						var sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();			
						var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();			
						var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();				
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_sample_ca = $('#sp_sample_ca').val();
						var sp_temp = $('#sp_temp').val(); 
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_b_a1_1 ="0";
						var sp_w_b_a2_1 ="0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_b_a1_2 ="0";
						var sp_w_b_a2_2 ="0";
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

				//CRUSHING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							if(document.getElementById('chk_crushing').checked) {
									var chk_crushing = "1";
								}
								else{
									var chk_crushing = "0";
								}
							//crushing value-4
							var cr_sample_crush = $('#cr_sample_crush').val();
							var cru_value = $('#cru_value').val();
							var cru_value_1 = $('#cru_value_1').val();
							var cru_value_2 = $('#cru_value_2').val();
							var cr_a_1 = $('#cr_a_1').val();
							var cr_a_2 = $('#cr_a_2').val();
							var cr_b_1 = $('#cr_b_1').val();
							var cr_b_2 = $('#cr_b_2').val();
							var cr_c_1 = $('#cr_c_1').val();
							var cr_c_2 = $('#cr_c_2').val();
							break;
					}
					else
					{
						var chk_crushing = "0";	
						var cru_value ="0";
						var cr_sample_crush ="0";
						var cru_value_1 ="0";
						var cr_a_1 ="0";
						var cr_a_2 ="0";
						var cr_b_1 ="0";
						var cr_c_1 ="0";
						var cru_value_2 ="0";
						var cr_b_2 ="0";
						var cr_c_2 ="0";
					}
				}
				
				//SOUNDNESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
							if(document.getElementById('chk_sou').checked) {
								var chk_sou = "1";
							}
							else{
								var chk_sou = "0";
							}
							
							if(document.getElementById('chk_wp').checked) {
								var chk_wp = "1";
							}
							else{
								var chk_wp = "0";
							}
							
							if(document.getElementById('chk_a').checked) {
								var chk_a = "1";
							}
							else{
								var chk_a = "0";
							}
							
							if(document.getElementById('chk_b').checked) {
								var chk_b = "1";
							}
							else{
								var chk_b = "0";
							}
							
							if(document.getElementById('chk_c').checked) {
								var chk_c = "1";
							}
							else{
								var chk_c = "0";
							}
							
							if(document.getElementById('chk_d').checked) {
								var chk_d = "1";
							}
							else{
								var chk_d = "0";
							}
							
							if(document.getElementById('chk_e').checked) {
								var chk_e = "1";
							 }
							else{
								var chk_e = "0";
							}
							//SOUNDNESS-7
							var soundness = $('#soundness').val();	
							var w1= $('#w1').val();	
							var w2= $('#w2').val();	
							var wsum= $('#wsum').val();	
							var ga1 = $('#ga1').val();	
							var ga2 = $('#ga2').val();	
							var gasum = $('#gasum').val();	
							var gb1 = $('#gb1').val();
							var gb2 = $('#gb2').val();
							var gbsum = $('#gbsum').val();
							var gc1 = $('#gc1').val();
							var gc2 = $('#gc2').val();
							var gcsum = $('#gcsum').val();
							var gd1 = $('#gd1').val();
							var gd2 = $('#gd2').val();
							var gdsum = $('#gdsum').val();
							var ge1 = $('#ge1').val();
							var ge2 = $('#ge2').val();
							var gesum = $('#gesum').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var sample_id = $('#sample_id').val();
							var sound_sample = $('#sound_sample').val();
							break;
					}
					else
					{
						var chk_sou = "0";	
						var chk_wp = "0";	
						var chk_a = "0";	
						var chk_b = "0";	
						var chk_c = "0";	
						var chk_d = "0";	
						var chk_e = "0";
						var soundness ="0";			
						var sound_sample ="0";			
						var sample_id ="0";			
						
						var w1 ="0";			
						var w2 ="0";			
						var wsum ="0";			
						
						var ga1 ="0";			
						var ga2 ="0";			
						var gasum ="0";			
						
						var gb1 ="0";			
						var gb2 ="0";			
						var gbsum ="0";			
						
						var gc1 ="0";			
						var gc2 ="0";			
						var gcsum ="0";			
						
						var gd1 ="0";			
						var gd2 ="0";			
						var gdsum ="0";			
						
						var ge1 ="0";			
						var ge2 ="0";			
						var gesum ="0";			
						
						var s1 ="0";			
						var s2  ="0";
					}
				
				}
			
				//FLAKINESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flk")
					{	
								if(document.getElementById('chk_f1').checked) {
									var chk_f1 = "1";
								}
								else{
									var chk_f1 = "0";
								}
								
								if(document.getElementById('chk_f2').checked) {
									var chk_f2 = "1";
								}
								else{
									var chk_f2 = "0";
								}
								
								if(document.getElementById('chk_f3').checked) {
									var chk_f3 = "1";
								}
								else{
									var chk_f3 = "0";
								}
								
								if(document.getElementById('chk_f4').checked) {
									var chk_f4 = "1";
								}
								else{
									var chk_f4 = "0";
								}
								
								
								if(document.getElementById('chk_f5').checked) {
									var chk_f5 = "1";
								}
								else{
									var chk_f5 = "0";
								}


								if(document.getElementById('chk_f6').checked) {
									var chk_f6 = "1";
								}
								else{
									var chk_f6 = "0";
								}

								if(document.getElementById('chk_f7').checked) {
									var chk_f7 = "1";
								}
								else{
									var chk_f7 = "0";
								}
								
								if(document.getElementById('chk_f8').checked) {
									var chk_f8 = "1";
								}
								else{
									var chk_f8 = "0";
								}

								if(document.getElementById('chk_f9').checked) {
									var chk_f9 = "1";
								}
								else{
									var chk_f9 = "0";
								}
								
								if(document.getElementById('chk_flk').checked) {
									var chk_flk = "1";
								}
								else{
									var chk_flk = "0";
												
								}
							//Flakiness INDEX
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var p4 = $('#p4').val();
							var p5 = $('#p5').val();
							var p6 = $('#p6').val();
							var p7 = $('#p7').val();
							var p8 = $('#p8').val();
							var p9 = $('#p9').val();
						
							var fi_index = $('#fi_index').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var suma = $('#suma').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();				
							var b6 = $('#b6').val();				
							var b7 = $('#b7').val();				
							var b8 = $('#b8').val();				
							var b9 = $('#b9').val();				
							
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var c4 = $('#c4').val();
							var c5 = $('#c5').val();
							var c6 = $('#c6').val();
							var c7 = $('#c7').val();
							var c8 = $('#c8').val();
							var c9 = $('#c9').val();
							
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var d4 = $('#d4').val();
							var d5 = $('#d5').val();
							var d6 = $('#d6').val();
							var d7 = $('#d7').val();
							var d8 = $('#d8').val();
							var d9 = $('#d9').val();
							
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();
							var e4 = $('#e4').val();
							var e5 = $('#e5').val();
							var e6 = $('#e6').val();
							var e7 = $('#e7').val();
							var e8 = $('#e8').val();
							var e9 = $('#e9').val();
							
							var ei_index = $('#ei_index').val();
							var aa1 = $('#aa1').val();
							var aa2 = $('#aa2').val();
							var aa3 = $('#aa3').val();
							var aa4 = $('#aa4').val();
							var aa5 = $('#aa5').val();
							var aa6 = $('#aa6').val();
							var aa7 = $('#aa7').val();
							var aa8 = $('#aa8').val();
							var aa9 = $('#aa9').val();
							
							
							var bb1 = $('#bb1').val();
							var bb2 = $('#bb2').val();
							var bb3 = $('#bb3').val();
							var bb4 = $('#bb4').val();
							var bb5 = $('#bb5').val();
							var bb6 = $('#bb6').val();
							var bb7 = $('#bb7').val();
							var bb8 = $('#bb8').val();
							var bb9 = $('#bb9').val();
							
							var dd1 = $('#dd1').val();
							var dd2 = $('#dd2').val();
							var dd3 = $('#dd3').val();
							var dd4 = $('#dd4').val();
							var dd5 = $('#dd5').val();
							var dd6 = $('#dd6').val();
							var dd7 = $('#dd7').val();
							var dd8 = $('#dd8').val();
							var dd9 = $('#dd9').val();
							
							
							var s11 = $('#s11').val();
							var s12 = $('#s12').val();
							var s13 = $('#s13').val();
							var s14 = $('#s14').val();
							var s15 = $('#s15').val();
							var s16 = $('#s16').val();
							var s17 = $('#s17').val();
							var s18 = $('#s18').val();
							var s19 = $('#s19').val();
							
							var combined_index = $('#combined_index').val();
							break;
					}
					else
					{
						var chk_flk = "0";	
						var chk_f1 = "0";
						var chk_f2 = "0";
						var chk_f3 = "0";
						var chk_f4 = "0";
						var chk_f5 = "0";
						var chk_f6 = "0";
						var chk_f7 = "0";
						var chk_f8 = "0";
						var chk_f9 = "0";
						var fi_index ="0";
						var ei_index ="0";
						var combined_index ="0";
						
						var p1 ="0";
						var p2 ="0";
						var p3 ="0";
						var p4 ="0";
						var p5 ="0";
						var p6 ="0";
						var p7 ="0";
						var p8 ="0";
						var p9 ="0";
						 
						var a1 ="0";
						var a2 ="0";
						var a3 ="0";
						var a4 ="0";
						var a5 ="0";
						var a6 ="0";
						var a7 ="0";
						var a8 ="0";
						var a9 ="0";
						var suma ="0";
												
						var b1 ="0";
						var b2 ="0";
						var b3 ="0";
						var b4 ="0";
						var b5 ="0";
						var b6 ="0";
						var b7 ="0";
						var b8 ="0";
						var b9 ="0";
												
						var c1 ="0";
						var c2 ="0";
						var c3 ="0";
						var c4 ="0";
						var c5 ="0";
						var c6 ="0";
						var c7 ="0";
						var c8 ="0";
						var c9 ="0";
												
						var d1 ="0";
						var d2 ="0";
						var d3 ="0";
						var d4 ="0";
						var d5 ="0";
						var d6 ="0";
						var d7 ="0";
						var d8 ="0";
						var d9 ="0";
						
						var e1 ="0";
						var e2 ="0";
						var e3 ="0";
						var e4 ="0";
						var e5 ="0";
						var e6 ="0";
						var e7 ="0";
						var e8 ="0";
						var e9 ="0";
												
						var aa1 ="0";
						var aa2 ="0";
						var aa3 ="0";
						var aa4 ="0";
						var aa5 ="0";
						var aa6 ="0";
						var aa7 ="0";
						var aa8 ="0";
						var aa9 ="0";
						
						var bb1 ="0";	
						var bb2 ="0";
						var bb3 ="0";
						var bb4 ="0";
						var bb5 ="0";
						var bb6 ="0";
						var bb7 ="0";
						var bb8 ="0";
						var bb9 ="0";
						
						var dd1 ="0";
						var dd2 ="0";			
						var dd3 ="0";
						var dd4 ="0";
						var dd5 ="0";
						var dd6 ="0";
						var dd7 ="0";
						var dd8 ="0";
						var dd9 ="0";	
					}
				
				}
				
				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{			//ll and pl
								if(document.getElementById('chk_ll').checked) {
									var chk_ll = "1";
								}
								else{
									var chk_ll = "0";
								}
								
								var chk_pl = $('#chk_pl').val();
								var plastic_limit = $('#plastic_limit').val();
								var liquide_limit = $('#liquide_limit').val();
								
								var p_ll_1 = $('#p_ll_1').val();
								var p_ll_2 = $('#p_ll_2').val();
								var p_ll_3 = $('#p_ll_3').val();
								var p_ll_4 = $('#p_ll_4').val();
								var p_ll_5 = $('#p_ll_5').val();
								
								var p_pl_1 = $('#p_pl_1').val();
								var p_pl_2 = $('#p_pl_2').val();
								var p_pl_3 = $('#p_pl_3').val();
								
								var cn_ll_1 = $('#cn_ll_1').val();
								var cn_ll_2 = $('#cn_ll_2').val();
								var cn_ll_3 = $('#cn_ll_3').val();
								var cn_ll_4 = $('#cn_ll_4').val();
								var cn_ll_5 = $('#cn_ll_5').val();
								
								var cn_pl_1 = $('#cn_pl_1').val();
								var cn_pl_2 = $('#cn_pl_2').val();
								var cn_pl_3 = $('#cn_pl_3').val();
								
								var wt_ll_1 = $('#wt_ll_1').val();
								var wt_ll_2 = $('#wt_ll_2').val();
								var wt_ll_3 = $('#wt_ll_3').val();
								var wt_ll_4 = $('#wt_ll_4').val();
								var wt_ll_5 = $('#wt_ll_5').val();
								
								var wt_pl_1 = $('#wt_pl_1').val();
								var wt_pl_2 = $('#wt_pl_2').val();
								var wt_pl_3 = $('#wt_pl_3').val();
								
								var dy_ll_1 = $('#dy_ll_1').val();
								var dy_ll_2 = $('#dy_ll_2').val();
								var dy_ll_3 = $('#dy_ll_3').val();
								var dy_ll_4 = $('#dy_ll_4').val();
								var dy_ll_5 = $('#dy_ll_5').val();
								
								var dy_pl_1 = $('#dy_pl_1').val();
								var dy_pl_2 = $('#dy_pl_2').val();
								var dy_pl_3 = $('#dy_pl_3').val();
								
								var wtr_ll_1 = $('#wtr_ll_1').val();
								var wtr_ll_2 = $('#wtr_ll_2').val();
								var wtr_ll_3 = $('#wtr_ll_3').val();
								var wtr_ll_4 = $('#wtr_ll_4').val();
								var wtr_ll_5 = $('#wtr_ll_5').val();
								
								var wtr_pl_1 = $('#wtr_pl_1').val();
								var wtr_pl_2 = $('#wtr_pl_2').val();
								var wtr_pl_3 = $('#wtr_pl_3').val();
								
								var con_ll_1 = $('#con_ll_1').val();
								var con_ll_2 = $('#con_ll_2').val();
								var con_ll_3 = $('#con_ll_3').val();
								var con_ll_4 = $('#con_ll_4').val();
								var con_ll_5 = $('#con_ll_5').val();
								
								var con_pl_1 = $('#con_pl_1').val();
								var con_pl_2 = $('#con_pl_2').val();
								var con_pl_3 = $('#con_pl_3').val();
								
								var od_ll_1 = $('#od_ll_1').val();
								var od_ll_2 = $('#od_ll_2').val();
								var od_ll_3 = $('#od_ll_3').val();
								var od_ll_4 = $('#od_ll_4').val();
								var od_ll_5 = $('#od_ll_5').val();
								
								var od_pl_1 = $('#od_pl_1').val();
								var od_pl_2 = $('#od_pl_2').val();
								var od_pl_3 = $('#od_pl_3').val();
								
								var mc_ll_1 = $('#mc_ll_1').val();
								var mc_ll_2 = $('#mc_ll_2').val();
								var mc_ll_3 = $('#mc_ll_3').val();
								var mc_ll_4 = $('#mc_ll_4').val();
								var mc_ll_5 = $('#mc_ll_5').val();
								
								var mc_pl_1 = $('#mc_pl_1').val();
								var mc_pl_2 = $('#mc_pl_2').val();
								var mc_pl_3 = $('#mc_pl_3').val();
								var avg_ll = $('#avg_ll').val();
								var avg_pl = $('#avg_pl').val();
								
							break;
					}
					else
					{
						var chk_ll = "0";	
						var chk_pl = $('#chk_pl').val();
								var plastic_limit = $('#plastic_limit').val();
								var liquide_limit = $('#liquide_limit').val();
								
								var p_ll_1 = "0";
								var p_ll_2 = "0";
								var p_ll_3 = "0";
								var p_ll_4 = "0";
								var p_ll_5 = "0";
								
								var p_pl_1 = "0";
								var p_pl_2 = "0";
								var p_pl_3 = "0";
								
								var cn_ll_1 = "0";
								var cn_ll_2 = "0";
								var cn_ll_3 = "0";
								var cn_ll_4 = "0";
								var cn_ll_5 = "0";
								
								var cn_pl_1 = "0";
								var cn_pl_2 = "0";
								var cn_pl_3 = "0";
								
								var wt_ll_1 = "0";
								var wt_ll_2 = "0";
								var wt_ll_3 = "0";
								var wt_ll_4 = "0";
								var wt_ll_5 = "0";
								
								var wt_pl_1 = "0";
								var wt_pl_2 = "0";
								var wt_pl_3 = "0";
								
								var dy_ll_1 = "0";
								var dy_ll_2 = "0";
								var dy_ll_3 = "0";
								var dy_ll_4 = "0";
								var dy_ll_5 = "0";
								
								var dy_pl_1 = "0";
								var dy_pl_2 = "0";
								var dy_pl_3 = "0";
								
								var wtr_ll_1 = "0";
								var wtr_ll_2 = "0";
								var wtr_ll_3 = "0";
								var wtr_ll_4 = "0";
								var wtr_ll_5 = "0";
								
								var wtr_pl_1 = "0";
								var wtr_pl_2 = "0";
								var wtr_pl_3 = "0";
								
								var con_ll_1 = "0";
								var con_ll_2 = "0";
								var con_ll_3 = "0";
								var con_ll_4 = "0";
								var con_ll_5 = "0";
								
								var con_pl_1 = "0";
								var con_pl_2 = "0";
								var con_pl_3 = "0";
								
								var od_ll_1 = "0";
								var od_ll_2 = "0";
								var od_ll_3 = "0";
								var od_ll_4 = "0";
								var od_ll_5 = "0";
								
								var od_pl_1 = "0";
								var od_pl_2 = "0";
								var od_pl_3 = "0";
								
								var mc_ll_1 = "0";
								var mc_ll_2 = "0";
								var mc_ll_3 = "0";
								var mc_ll_4 = "0";
								var mc_ll_5 = "0";
								
								var mc_pl_1 = "0";
								var mc_pl_2 = "0";
								var mc_pl_3 = "0";
								var avg_ll = "0";
								var avg_pl = "0";
					}
				
				}
				
				//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_alkali').checked) {
									var chk_alkali = "1";
								}
								else{
									var chk_alkali = "0";
								}
							var alkali_value = $('#alkali_value').val();
							break;
					}
					else
					{
						var chk_alkali = "0";	
						var alkali_value = "0";	
					}	
				}

				//FINEVALUES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{						
							if(document.getElementById('chk_fines').checked) {
									var chk_fines = "1";
								}
								else{
									var chk_fines = "0";
								}
							//alkali strip and fines_value
							var fines_value = $('#fines_value').val();
							var f_a_1 = $('#f_a_1').val();
							var f_a_2 = $('#f_a_2').val();
							var f_b_1 = $('#f_b_1').val();
							var f_b_2 = $('#f_b_2').val();
							var f_c_1 = $('#f_c_1').val();
							var f_c_2 = $('#f_c_2').val();
							var f_d_1 = $('#f_d_1').val();
							var f_d_2 = $('#f_d_2').val();
							var f_e_1 = $('#f_e_1').val();
							var f_e_2 = $('#f_e_2').val();
							break;
					}
					else
					{
						var chk_fines = "0";	
						var fines_value = "0";	
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var f_e_1 = "0";
						var f_e_2 = "0";
				}	
				}

				//STRIPPING VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_strip').checked) {
									var chk_strip = "1";
								}
								else{
									var chk_strip = "0";
								}
								var stripping_value = $('#stripping_value').val();
							break;
					}
					else
					{
						var chk_strip = "0";	
						
					}	
				}
			


				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+
				
				
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						if(document.getElementById('chk_grd').checked) {
								var chk_grd = "1";
						}
						else{
								var chk_grd = "0";
						}
							//GRADATION DATA FETCH-1
							var sieve_1="53";	
							var sieve_2="45";	
							var sieve_3="22.4";	
							var sieve_4="11.2";	
							var sieve_5="4.75";	
							var sieve_6="2.36";	
							var sieve_7="0.600";	
							var sieve_8="0.075";	
							var sieve_9="Pan";		

							var sample_taken = $('#sample_taken').val();
							var blank_extra = $('#blank_extra').val();
							
							var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
							var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
							var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
							var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
							var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
							var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
							var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
							var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
							var cum_wt_gm_9 = $('#cum_wt_gm_9').val();
															
							var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
							var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
							var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
							var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
							var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
							var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
							var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
							var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
							var ret_wt_gm_9 = $('#ret_wt_gm_9').val();
							
							var cum_ret_1 = $('#cum_ret_1').val();
							var cum_ret_2 = $('#cum_ret_2').val();
							var cum_ret_3 = $('#cum_ret_3').val();
							var cum_ret_4 = $('#cum_ret_4').val();
							var cum_ret_5 = $('#cum_ret_5').val();
							var cum_ret_6 = $('#cum_ret_6').val();
							var cum_ret_7 = $('#cum_ret_7').val();
							var cum_ret_8 = $('#cum_ret_8').val();
							var cum_ret_9 = $('#cum_ret_9').val();
							
							var pass_sample_1 = $('#pass_sample_1').val();
							var pass_sample_2 = $('#pass_sample_2').val();
							var pass_sample_3 = $('#pass_sample_3').val();
							var pass_sample_4 = $('#pass_sample_4').val();
							var pass_sample_5 = $('#pass_sample_5').val();
							var pass_sample_6 = $('#pass_sample_6').val();
							var pass_sample_7 = $('#pass_sample_7').val();
							var pass_sample_8 = $('#pass_sample_8').val();
							var pass_sample_9 = $('#pass_sample_9').val();
						break;
					}
					else
					{
						var chk_grd = "0";	
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						var cum_wt_gm_8 ="0";
						var cum_wt_gm_9 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						var ret_wt_gm_8 ="0";
						var ret_wt_gm_9 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
						var cum_ret_8 ="0";
						var cum_ret_9 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
						var pass_sample_8 ="0";
						var pass_sample_9 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";
					}
														
				}

			
					//mdd omc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mdd")
					{	
						if(document.getElementById('chk_mdd').checked) {
							var chk_mdd = "1";
						}
						else{
							var chk_mdd = "0";
						}					
						//mdd omc
							var m11 = $('#m11').val();
							var m12 = $('#m12').val();
							var m14 = $('#m13').val();
							var m13 = $('#m14').val();
							var m15 = $('#m15').val();
							var m16 = $('#m16').val();
							
							var m21 = $('#m21').val();
							var m22 = $('#m22').val();
							var m23 = $('#m23').val();
							var m24 = $('#m24').val();
							var m25 = $('#m25').val();
							var m26 = $('#m26').val();
							
							var m31 = $('#m31').val();
							var m32 = $('#m32').val();
							var m33 = $('#m33').val();
							var m34 = $('#m34').val();
							var m35 = $('#m35').val();
							var m36 = $('#m36').val();
							
							var m41 = $('#m41').val();
							var m42 = $('#m42').val();
							var m43 = $('#m43').val();
							var m44 = $('#m44').val();
							var m45 = $('#m45').val();
							var m46 = $('#m46').val();
							
							var m51 = $('#m51').val();
							var m52 = $('#m52').val();
							var m53 = $('#m53').val();
							var m54 = $('#m54').val();
							var m55 = $('#m55').val();
							var m56 = $('#m56').val();
							
							var m61 = $('#m61').val();
							var m62 = $('#m62').val();
							var m63 = $('#m63').val();
							var m64 = $('#m64').val();
							var m65 = $('#m65').val();
							var m66 = $('#m66').val();
							
							var m71 = $('#m71').val();
							var m72 = $('#m72').val();
							var m73 = $('#m73').val();
							var m74 = $('#m74').val();
							var m75 = $('#m75').val();
							var m76 = $('#m76').val();
							
							
							var d11 = $('#d11').val();
							var d12 = $('#d12').val();
							var d13 = $('#d13').val();
							var d14 = $('#d14').val();
							var d15 = $('#d15').val();
							var d16 = $('#d16').val();
							
							var d21 = $('#d21').val();
							var d22 = $('#d22').val();
							var d23 = $('#d23').val();
							var d24 = $('#d24').val();
							var d25 = $('#d25').val();
							var d26 = $('#d26').val();
							
							var d31 = $('#d31').val();
							var d32 = $('#d32').val();
							var d33 = $('#d33').val();
							var d34 = $('#d34').val();
							var d35 = $('#d35').val();
							var d36 = $('#d36').val();
							
							var d41 = $('#d41').val();
							var d42 = $('#d42').val();
							var d43 = $('#d43').val();
							var d44 = $('#d44').val();
							var d45 = $('#d45').val();
							var d46 = $('#d46').val();
							
							var d51 = $('#d51').val();
							var d52 = $('#d52').val();
							var d53 = $('#d53').val();
							var d54 = $('#d54').val();
							var d55 = $('#d55').val();
							var d56 = $('#d56').val();
							
							var d61 = $('#d61').val();
							var d62 = $('#d62').val();
							var d63 = $('#d63').val();
							var d64 = $('#d64').val();
							var d65 = $('#d65').val();
							var d66 = $('#d66').val();
							
							var d71 = $('#d71').val();
							var d72 = $('#d72').val();
							var d73 = $('#d73').val();
							var d74 = $('#d74').val();
							var d75 = $('#d75').val();
							var d76 = $('#d76').val();
							
							var mdd = $('#mdd').val();
							var omc = $('#omc').val();
							var cbr = $('#cbr').val();
						break;
						}
						else
						{
						
							var m11 = "0";
							var m12 = "0";
							var m14 = "0";
							var m13 = "0";
							var m15 = "0";
							var m16 = "0";
							
							var m21 = "0";
							var m22 = "0";
							var m23 = "0";
							var m24 = "0";
							var m25 = "0";
							var m26 = "0";
							
							var m31 = "0";
							var m32 = "0";
							var m33 = "0";
							var m34 = "0";
							var m35 = "0";
							var m36 = "0";
							
							var m41 = "0";
							var m42 = "0";
							var m43 = "0";
							var m44 = "0";
							var m45 = "0";
							var m46 = "0";
							
							var m51 = "0";
							var m52 = "0";
							var m53 = "0";
							var m54 = "0";
							var m55 = "0";
							var m56 = "0";
							
							var m61 = "0";
							var m62 = "0";
							var m63 = "0";
							var m64 = "0";
							var m65 = "0";
							var m66 = "0";
							
							var m71 = "0";
							var m72 = "0";
							var m73 = "0";
							var m74 = "0";
							var m75 = "0";
							var m76 = "0";
							
							
							var d11 = "0";
							var d12 = "0";
							var d13 = "0";
							var d14 = "0";
							var d15 = "0";
							var d16 = "0";
							
							var d21 = "0";
							var d22 = "0";
							var d23 = "0";
							var d24 = "0";
							var d25 = "0";
							var d26 = "0";
							
							var d31 = "0";
							var d32 = "0";
							var d33 = "0";
							var d34 = "0";
							var d35 = "0";
							var d36 = "0";
							
							var d41 = "0";
							var d42 = "0";
							var d43 = "0";
							var d44 = "0";
							var d45 = "0";
							var d46 = "0";
							
							var d51 = "0";
							var d52 = "0";
							var d53 = "0";
							var d54 = "0";
							var d55 = "0";
							var d56 = "0";
							
							var d61 = "0";
							var d62 = "0";
							var d63 = "0";
							var d64 = "0";
							var d65 = "0";
							var d66 = "0";
							
							var d71 = "0";
							var d72 = "0";
							var d73 = "0";
							var d74 = "0";
							var d75 = "0";
							var d76 = "0";
							
							var mdd = "0";
							var omc = "0";
							var cbr = "0";
						}
				
						}
				
				
				//ABRASION VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						if(document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
							}
							else{
								var chk_abr = "0";
							}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_sample_abr = $('#abr_sample_abr').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();		
						break;
					}
					else
					{
						var chk_abr = "0";	
						var abr_sample_abr ="0";
						var abr_wt_t_a_1 ="0";
						var abr_wt_t_b_1 ="0";
						var abr_wt_t_c_1 ="0";
						var abr_wt_t_a_2 ="0";
						var abr_wt_t_b_2 ="0";
						var abr_grading ="0";
						var abr_wt_t_c_2 ="0";
						var abr_index ="0";
						var abr_sphere ="0";
						var abr_num_revo ="0";
						var abr_weight_charge ="0";
					}
				}
				
				//IMPACT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							if(document.getElementById('chk_impact').checked) {
									var chk_impact = "1";
							}
							else{
									var chk_impact = "0";
							}
							//impact value-3
							var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
							var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
							var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
							var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
							var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
							var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
							var imp_value_1 = $('#imp_value_1').val();
							var imp_value_2 = $('#imp_value_2').val();
							var imp_w_m_d_1 = $('#imp_w_m_d_1').val();
							var imp_w_m_d_2 = $('#imp_w_m_d_2').val();
							var imp_value = $('#imp_value').val();
							break;
					}
					else
					{
						var chk_impact = "0";	
						var imp_value ="0";
						var imp_value_1 ="0";
						var imp_value_2 ="0";
						var imp_w_m_a_1 ="0";
						var imp_w_m_b_1 ="0";
						var imp_w_m_c_1 ="0";
						var imp_w_m_d_1 ="0";
						var imp_w_m_a_2 ="0";
						var imp_w_m_b_2 ="0";
						var imp_w_m_c_2 ="0";
						var imp_w_m_d_2 ="0";
					}

				}
								
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();			
						var sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();			
						var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();			
						var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();				
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_sample_ca = $('#sp_sample_ca').val();
						var sp_temp = $('#sp_temp').val(); 
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_b_a1_1 ="0";
						var sp_w_b_a2_1 ="0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_b_a1_2 ="0";
						var sp_w_b_a2_2 ="0";
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

				//CRUSHING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							if(document.getElementById('chk_crushing').checked) {
									var chk_crushing = "1";
								}
								else{
									var chk_crushing = "0";
								}
							//crushing value-4
							var cr_sample_crush = $('#cr_sample_crush').val();
							var cru_value = $('#cru_value').val();
							var cru_value_1 = $('#cru_value_1').val();
							var cru_value_2 = $('#cru_value_2').val();
							var cr_a_1 = $('#cr_a_1').val();
							var cr_a_2 = $('#cr_a_2').val();
							var cr_b_1 = $('#cr_b_1').val();
							var cr_b_2 = $('#cr_b_2').val();
							var cr_c_1 = $('#cr_c_1').val();
							var cr_c_2 = $('#cr_c_2').val();
							break;
					}
					else
					{
						var chk_crushing = "0";	
						var cru_value ="0";
						var cr_sample_crush ="0";
						var cru_value_1 ="0";
						var cr_a_1 ="0";
						var cr_a_2 ="0";
						var cr_b_1 ="0";
						var cr_c_1 ="0";
						var cru_value_2 ="0";
						var cr_b_2 ="0";
						var cr_c_2 ="0";
					}
				}
				
					//SOUNDNESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
							if(document.getElementById('chk_sou').checked) {
								var chk_sou = "1";
							}
							else{
								var chk_sou = "0";
							}
							
							if(document.getElementById('chk_wp').checked) {
								var chk_wp = "1";
							}
							else{
								var chk_wp = "0";
							}
							
							if(document.getElementById('chk_a').checked) {
								var chk_a = "1";
							}
							else{
								var chk_a = "0";
							}
							
							if(document.getElementById('chk_b').checked) {
								var chk_b = "1";
							}
							else{
								var chk_b = "0";
							}
							
							if(document.getElementById('chk_c').checked) {
								var chk_c = "1";
							}
							else{
								var chk_c = "0";
							}
							
							if(document.getElementById('chk_d').checked) {
								var chk_d = "1";
							}
							else{
								var chk_d = "0";
							}
							
							if(document.getElementById('chk_e').checked) {
								var chk_e = "1";
							 }
							else{
								var chk_e = "0";
							}
							//SOUNDNESS-7
							var soundness = $('#soundness').val();	
							var w1= $('#w1').val();	
							var w2= $('#w2').val();	
							var wsum= $('#wsum').val();	
							var ga1 = $('#ga1').val();	
							var ga2 = $('#ga2').val();	
							var gasum = $('#gasum').val();	
							var gb1 = $('#gb1').val();
							var gb2 = $('#gb2').val();
							var gbsum = $('#gbsum').val();
							var gc1 = $('#gc1').val();
							var gc2 = $('#gc2').val();
							var gcsum = $('#gcsum').val();
							var gd1 = $('#gd1').val();
							var gd2 = $('#gd2').val();
							var gdsum = $('#gdsum').val();
							var ge1 = $('#ge1').val();
							var ge2 = $('#ge2').val();
							var gesum = $('#gesum').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var sample_id = $('#sample_id').val();
							var sound_sample = $('#sound_sample').val();
							break;
					}
					else
					{
						var chk_sou = "0";	
						var chk_wp = "0";	
						var chk_a = "0";	
						var chk_b = "0";	
						var chk_c = "0";	
						var chk_d = "0";	
						var chk_e = "0";
						var soundness ="0";			
						var sound_sample ="0";			
						var sample_id ="0";			
						
						var w1 ="0";			
						var w2 ="0";			
						var wsum ="0";			
						
						var ga1 ="0";			
						var ga2 ="0";			
						var gasum ="0";			
						
						var gb1 ="0";			
						var gb2 ="0";			
						var gbsum ="0";			
						
						var gc1 ="0";			
						var gc2 ="0";			
						var gcsum ="0";			
						
						var gd1 ="0";			
						var gd2 ="0";			
						var gdsum ="0";			
						
						var ge1 ="0";			
						var ge2 ="0";			
						var gesum ="0";			
						
						var s1 ="0";			
						var s2  ="0";
					}
				
				}
			
				//FLAKINESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flk")
					{	
								if(document.getElementById('chk_f1').checked) {
									var chk_f1 = "1";
								}
								else{
									var chk_f1 = "0";
								}
								
								if(document.getElementById('chk_f2').checked) {
									var chk_f2 = "1";
								}
								else{
									var chk_f2 = "0";
								}
								
								if(document.getElementById('chk_f3').checked) {
									var chk_f3 = "1";
								}
								else{
									var chk_f3 = "0";
								}
								
								if(document.getElementById('chk_f4').checked) {
									var chk_f4 = "1";
								}
								else{
									var chk_f4 = "0";
								}
								
								
								if(document.getElementById('chk_f5').checked) {
									var chk_f5 = "1";
								}
								else{
									var chk_f5 = "0";
								}


								if(document.getElementById('chk_f6').checked) {
									var chk_f6 = "1";
								}
								else{
									var chk_f6 = "0";
								}

								if(document.getElementById('chk_f7').checked) {
									var chk_f7 = "1";
								}
								else{
									var chk_f7 = "0";
								}
								
								if(document.getElementById('chk_f8').checked) {
									var chk_f8 = "1";
								}
								else{
									var chk_f8 = "0";
								}

								if(document.getElementById('chk_f9').checked) {
									var chk_f9 = "1";
								}
								else{
									var chk_f9 = "0";
								}
								
								if(document.getElementById('chk_flk').checked) {
									var chk_flk = "1";
								}
								else{
									var chk_flk = "0";
												
								}
							//Flakiness INDEX
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var p4 = $('#p4').val();
							var p5 = $('#p5').val();
							var p6 = $('#p6').val();
							var p7 = $('#p7').val();
							var p8 = $('#p8').val();
							var p9 = $('#p9').val();
						
							var fi_index = $('#fi_index').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var suma = $('#suma').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();				
							var b6 = $('#b6').val();				
							var b7 = $('#b7').val();				
							var b8 = $('#b8').val();				
							var b9 = $('#b9').val();				
							
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var c4 = $('#c4').val();
							var c5 = $('#c5').val();
							var c6 = $('#c6').val();
							var c7 = $('#c7').val();
							var c8 = $('#c8').val();
							var c9 = $('#c9').val();
							
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var d4 = $('#d4').val();
							var d5 = $('#d5').val();
							var d6 = $('#d6').val();
							var d7 = $('#d7').val();
							var d8 = $('#d8').val();
							var d9 = $('#d9').val();
							
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();
							var e4 = $('#e4').val();
							var e5 = $('#e5').val();
							var e6 = $('#e6').val();
							var e7 = $('#e7').val();
							var e8 = $('#e8').val();
							var e9 = $('#e9').val();
							
							var ei_index = $('#ei_index').val();
							var aa1 = $('#aa1').val();
							var aa2 = $('#aa2').val();
							var aa3 = $('#aa3').val();
							var aa4 = $('#aa4').val();
							var aa5 = $('#aa5').val();
							var aa6 = $('#aa6').val();
							var aa7 = $('#aa7').val();
							var aa8 = $('#aa8').val();
							var aa9 = $('#aa9').val();
							
							
							var bb1 = $('#bb1').val();
							var bb2 = $('#bb2').val();
							var bb3 = $('#bb3').val();
							var bb4 = $('#bb4').val();
							var bb5 = $('#bb5').val();
							var bb6 = $('#bb6').val();
							var bb7 = $('#bb7').val();
							var bb8 = $('#bb8').val();
							var bb9 = $('#bb9').val();
							
							var dd1 = $('#dd1').val();
							var dd2 = $('#dd2').val();
							var dd3 = $('#dd3').val();
							var dd4 = $('#dd4').val();
							var dd5 = $('#dd5').val();
							var dd6 = $('#dd6').val();
							var dd7 = $('#dd7').val();
							var dd8 = $('#dd8').val();
							var dd9 = $('#dd9').val();
							
							
							var s11 = $('#s11').val();
							var s12 = $('#s12').val();
							var s13 = $('#s13').val();
							var s14 = $('#s14').val();
							var s15 = $('#s15').val();
							var s16 = $('#s16').val();
							var s17 = $('#s17').val();
							var s18 = $('#s18').val();
							var s19 = $('#s19').val();
							
							var combined_index = $('#combined_index').val();
							break;
					}
					else
					{
						var chk_flk = "0";	
						var chk_f1 = "0";
						var chk_f2 = "0";
						var chk_f3 = "0";
						var chk_f4 = "0";
						var chk_f5 = "0";
						var chk_f6 = "0";
						var chk_f7 = "0";
						var chk_f8 = "0";
						var chk_f9 = "0";
						var fi_index ="0";
						var ei_index ="0";
						var combined_index ="0";
						
						var p1 ="0";
						var p2 ="0";
						var p3 ="0";
						var p4 ="0";
						var p5 ="0";
						var p6 ="0";
						var p7 ="0";
						var p8 ="0";
						var p9 ="0";
						 
						var a1 ="0";
						var a2 ="0";
						var a3 ="0";
						var a4 ="0";
						var a5 ="0";
						var a6 ="0";
						var a7 ="0";
						var a8 ="0";
						var a9 ="0";
						var suma ="0";
												
						var b1 ="0";
						var b2 ="0";
						var b3 ="0";
						var b4 ="0";
						var b5 ="0";
						var b6 ="0";
						var b7 ="0";
						var b8 ="0";
						var b9 ="0";
												
						var c1 ="0";
						var c2 ="0";
						var c3 ="0";
						var c4 ="0";
						var c5 ="0";
						var c6 ="0";
						var c7 ="0";
						var c8 ="0";
						var c9 ="0";
												
						var d1 ="0";
						var d2 ="0";
						var d3 ="0";
						var d4 ="0";
						var d5 ="0";
						var d6 ="0";
						var d7 ="0";
						var d8 ="0";
						var d9 ="0";
						
						var e1 ="0";
						var e2 ="0";
						var e3 ="0";
						var e4 ="0";
						var e5 ="0";
						var e6 ="0";
						var e7 ="0";
						var e8 ="0";
						var e9 ="0";
												
						var aa1 ="0";
						var aa2 ="0";
						var aa3 ="0";
						var aa4 ="0";
						var aa5 ="0";
						var aa6 ="0";
						var aa7 ="0";
						var aa8 ="0";
						var aa9 ="0";
						
						var bb1 ="0";	
						var bb2 ="0";
						var bb3 ="0";
						var bb4 ="0";
						var bb5 ="0";
						var bb6 ="0";
						var bb7 ="0";
						var bb8 ="0";
						var bb9 ="0";
						
						var dd1 ="0";
						var dd2 ="0";			
						var dd3 ="0";
						var dd4 ="0";
						var dd5 ="0";
						var dd6 ="0";
						var dd7 ="0";
						var dd8 ="0";
						var dd9 ="0";	
					}
				
				}
				
				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{			//ll and pl
								if(document.getElementById('chk_ll').checked) {
									var chk_ll = "1";
								}
								else{
									var chk_ll = "0";
								}
								
								var chk_pl = $('#chk_pl').val();
								var plastic_limit = $('#plastic_limit').val();
								var liquide_limit = $('#liquide_limit').val();
								
								var p_ll_1 = $('#p_ll_1').val();
								var p_ll_2 = $('#p_ll_2').val();
								var p_ll_3 = $('#p_ll_3').val();
								var p_ll_4 = $('#p_ll_4').val();
								var p_ll_5 = $('#p_ll_5').val();
								
								var p_pl_1 = $('#p_pl_1').val();
								var p_pl_2 = $('#p_pl_2').val();
								var p_pl_3 = $('#p_pl_3').val();
								
								var cn_ll_1 = $('#cn_ll_1').val();
								var cn_ll_2 = $('#cn_ll_2').val();
								var cn_ll_3 = $('#cn_ll_3').val();
								var cn_ll_4 = $('#cn_ll_4').val();
								var cn_ll_5 = $('#cn_ll_5').val();
								
								var cn_pl_1 = $('#cn_pl_1').val();
								var cn_pl_2 = $('#cn_pl_2').val();
								var cn_pl_3 = $('#cn_pl_3').val();
								
								var wt_ll_1 = $('#wt_ll_1').val();
								var wt_ll_2 = $('#wt_ll_2').val();
								var wt_ll_3 = $('#wt_ll_3').val();
								var wt_ll_4 = $('#wt_ll_4').val();
								var wt_ll_5 = $('#wt_ll_5').val();
								
								var wt_pl_1 = $('#wt_pl_1').val();
								var wt_pl_2 = $('#wt_pl_2').val();
								var wt_pl_3 = $('#wt_pl_3').val();
								
								var dy_ll_1 = $('#dy_ll_1').val();
								var dy_ll_2 = $('#dy_ll_2').val();
								var dy_ll_3 = $('#dy_ll_3').val();
								var dy_ll_4 = $('#dy_ll_4').val();
								var dy_ll_5 = $('#dy_ll_5').val();
								
								var dy_pl_1 = $('#dy_pl_1').val();
								var dy_pl_2 = $('#dy_pl_2').val();
								var dy_pl_3 = $('#dy_pl_3').val();
								
								var wtr_ll_1 = $('#wtr_ll_1').val();
								var wtr_ll_2 = $('#wtr_ll_2').val();
								var wtr_ll_3 = $('#wtr_ll_3').val();
								var wtr_ll_4 = $('#wtr_ll_4').val();
								var wtr_ll_5 = $('#wtr_ll_5').val();
								
								var wtr_pl_1 = $('#wtr_pl_1').val();
								var wtr_pl_2 = $('#wtr_pl_2').val();
								var wtr_pl_3 = $('#wtr_pl_3').val();
								
								var con_ll_1 = $('#con_ll_1').val();
								var con_ll_2 = $('#con_ll_2').val();
								var con_ll_3 = $('#con_ll_3').val();
								var con_ll_4 = $('#con_ll_4').val();
								var con_ll_5 = $('#con_ll_5').val();
								
								var con_pl_1 = $('#con_pl_1').val();
								var con_pl_2 = $('#con_pl_2').val();
								var con_pl_3 = $('#con_pl_3').val();
								
								var od_ll_1 = $('#od_ll_1').val();
								var od_ll_2 = $('#od_ll_2').val();
								var od_ll_3 = $('#od_ll_3').val();
								var od_ll_4 = $('#od_ll_4').val();
								var od_ll_5 = $('#od_ll_5').val();
								
								var od_pl_1 = $('#od_pl_1').val();
								var od_pl_2 = $('#od_pl_2').val();
								var od_pl_3 = $('#od_pl_3').val();
								
								var mc_ll_1 = $('#mc_ll_1').val();
								var mc_ll_2 = $('#mc_ll_2').val();
								var mc_ll_3 = $('#mc_ll_3').val();
								var mc_ll_4 = $('#mc_ll_4').val();
								var mc_ll_5 = $('#mc_ll_5').val();
								
								var mc_pl_1 = $('#mc_pl_1').val();
								var mc_pl_2 = $('#mc_pl_2').val();
								var mc_pl_3 = $('#mc_pl_3').val();
								var avg_ll = $('#avg_ll').val();
								var avg_pl = $('#avg_pl').val();
								
							break;
					}
					else
					{
						var chk_ll = "0";	
						var chk_pl = $('#chk_pl').val();
								var plastic_limit = $('#plastic_limit').val();
								var liquide_limit = $('#liquide_limit').val();
								
								var p_ll_1 = "0";
								var p_ll_2 = "0";
								var p_ll_3 = "0";
								var p_ll_4 = "0";
								var p_ll_5 = "0";
								
								var p_pl_1 = "0";
								var p_pl_2 = "0";
								var p_pl_3 = "0";
								
								var cn_ll_1 = "0";
								var cn_ll_2 = "0";
								var cn_ll_3 = "0";
								var cn_ll_4 = "0";
								var cn_ll_5 = "0";
								
								var cn_pl_1 = "0";
								var cn_pl_2 = "0";
								var cn_pl_3 = "0";
								
								var wt_ll_1 = "0";
								var wt_ll_2 = "0";
								var wt_ll_3 = "0";
								var wt_ll_4 = "0";
								var wt_ll_5 = "0";
								
								var wt_pl_1 = "0";
								var wt_pl_2 = "0";
								var wt_pl_3 = "0";
								
								var dy_ll_1 = "0";
								var dy_ll_2 = "0";
								var dy_ll_3 = "0";
								var dy_ll_4 = "0";
								var dy_ll_5 = "0";
								
								var dy_pl_1 = "0";
								var dy_pl_2 = "0";
								var dy_pl_3 = "0";
								
								var wtr_ll_1 = "0";
								var wtr_ll_2 = "0";
								var wtr_ll_3 = "0";
								var wtr_ll_4 = "0";
								var wtr_ll_5 = "0";
								
								var wtr_pl_1 = "0";
								var wtr_pl_2 = "0";
								var wtr_pl_3 = "0";
								
								var con_ll_1 = "0";
								var con_ll_2 = "0";
								var con_ll_3 = "0";
								var con_ll_4 = "0";
								var con_ll_5 = "0";
								
								var con_pl_1 = "0";
								var con_pl_2 = "0";
								var con_pl_3 = "0";
								
								var od_ll_1 = "0";
								var od_ll_2 = "0";
								var od_ll_3 = "0";
								var od_ll_4 = "0";
								var od_ll_5 = "0";
								
								var od_pl_1 = "0";
								var od_pl_2 = "0";
								var od_pl_3 = "0";
								
								var mc_ll_1 = "0";
								var mc_ll_2 = "0";
								var mc_ll_3 = "0";
								var mc_ll_4 = "0";
								var mc_ll_5 = "0";
								
								var mc_pl_1 = "0";
								var mc_pl_2 = "0";
								var mc_pl_3 = "0";
								var avg_ll = "0";
								var avg_pl = "0";
					}
				
				}
				
					//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_alkali').checked) {
									var chk_alkali = "1";
								}
								else{
									var chk_alkali = "0";
								}
							var alkali_value = $('#alkali_value').val();
							break;
					}
					else
					{
						var chk_alkali = "0";	
						var alkali_value = "0";	
					}	
				}

				//FINEVALUES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{						
							if(document.getElementById('chk_fines').checked) {
									var chk_fines = "1";
								}
								else{
									var chk_fines = "0";
								}
							//alkali strip and fines_value
							var fines_value = $('#fines_value').val();
							var f_a_1 = $('#f_a_1').val();
							var f_a_2 = $('#f_a_2').val();
							var f_b_1 = $('#f_b_1').val();
							var f_b_2 = $('#f_b_2').val();
							var f_c_1 = $('#f_c_1').val();
							var f_c_2 = $('#f_c_2').val();
							var f_d_1 = $('#f_d_1').val();
							var f_d_2 = $('#f_d_2').val();
							var f_e_1 = $('#f_e_1').val();
							var f_e_2 = $('#f_e_2').val();
							break;
					}
					else
					{
						var chk_fines = "0";	
						var fines_value = "0";	
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var f_e_1 = "0";
						var f_e_2 = "0";
				}	
				}

				//STRIPPING VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_strip').checked) {
									var chk_strip = "1";
								}
								else{
									var chk_strip = "0";
								}
								var stripping_value = $('#stripping_value').val();
							break;
					}
					else
					{
						var chk_strip = "0";	
						
					}	
				}
			
			
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save45_0_075_mic_mm.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
		$('#btn_save').hide();
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
		window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
	
        }
    });
}

function editData(id){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no= $('#job_no').val();
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>save45_0_075_mic_mm.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						
						var chk_grd = data.chk_grd;
						if(chk_grd=="1")
						{
						   $("#chk_grd").prop("checked", true); 
						}else{
							$("#chk_grd").prop("checked", false); 
						}
								//GRADATION DATA FETCH-1
						$('#sample_taken').val(data.sample_taken);
						
						$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
						$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
						$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
						$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
						$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
						$('#cum_wt_gm_6').val(data.cum_wt_gm_6);
						$('#cum_wt_gm_7').val(data.cum_wt_gm_7);
						$('#cum_wt_gm_8').val(data.cum_wt_gm_8);
						$('#cum_wt_gm_9').val(data.cum_wt_gm_9);
						
						$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
						$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
						$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
						$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
						$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
						$('#ret_wt_gm_6').val(data.ret_wt_gm_6);
						$('#ret_wt_gm_7').val(data.ret_wt_gm_7);
						$('#ret_wt_gm_8').val(data.ret_wt_gm_8);
						$('#ret_wt_gm_9').val(data.ret_wt_gm_9);
						
						$('#cum_ret_1').val(data.cum_ret_1);
						$('#cum_ret_2').val(data.cum_ret_2);
						$('#cum_ret_3').val(data.cum_ret_3);
						$('#cum_ret_4').val(data.cum_ret_4);
						$('#cum_ret_5').val(data.cum_ret_5);
						$('#cum_ret_6').val(data.cum_ret_6);
						$('#cum_ret_7').val(data.cum_ret_7);
						$('#cum_ret_8').val(data.cum_ret_8);
						$('#cum_ret_9').val(data.cum_ret_9);
						
						$('#pass_sample_1').val(data.pass_sample_1);
						$('#pass_sample_2').val(data.pass_sample_2);
						$('#pass_sample_3').val(data.pass_sample_3);
						$('#pass_sample_4').val(data.pass_sample_4);
						$('#pass_sample_5').val(data.pass_sample_5);
						$('#pass_sample_6').val(data.pass_sample_6);
						$('#pass_sample_7').val(data.pass_sample_7);
						$('#pass_sample_8').val(data.pass_sample_8);
						$('#pass_sample_9').val(data.pass_sample_9);
						
						$('#blank_extra').val(data.blank_extra);
						
						sieve_1=data.sieve_1;
						sieve_2=data.sieve_2;
						sieve_3=data.sieve_3;
						sieve_4=data.sieve_4;
						sieve_5=data.sieve_5;
						sieve_6=data.sieve_6;
						sieve_7=data.sieve_7;
						sieve_8=data.sieve_8;
						sieve_9=data.sieve_9;
						break;
					}
					else
					{
						/*var chk_grd = "0";	
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";*/
					}
														
				}
			
			//CBR MDD OMC
					for(var i=0;i<aa.length;i++)
						{
							if(aa[i]=="mdd")
							{
								
									$('#mdd').val(data.mdd);
					$('#omc').val(data.omc);
					$('#cbr').val(data.cbr);
					
					$('#d11').val(data.d11);
					$('#d12').val(data.d12);
					$('#d13').val(data.d13);					
					$('#d14').val(data.d14);					
					$('#d15').val(data.d15);
					$('#d16').val(data.d16);
					
					$('#m11').val(data.m11);
					$('#m12').val(data.m12);
					$('#m13').val(data.m13);					
					$('#m14').val(data.m14);					
					$('#m15').val(data.m15);
					$('#m16').val(data.m16);
					
					
					$('#d21').val(data.d21);
					$('#d22').val(data.d22);
					$('#d23').val(data.d23);					
					$('#d24').val(data.d24);					
					$('#d25').val(data.d25);
					$('#d26').val(data.d26);
					
					$('#m21').val(data.m21);
					$('#m22').val(data.m22);
					$('#m23').val(data.m23);					
					$('#m24').val(data.m24);					
					$('#m25').val(data.m25);
					$('#m26').val(data.m26);
					
					
					
					$('#d31').val(data.d31);
					$('#d32').val(data.d32);
					$('#d33').val(data.d33);					
					$('#d34').val(data.d34);					
					$('#d35').val(data.d35);
					$('#d36').val(data.d36);
					
					$('#m31').val(data.m31);
					$('#m32').val(data.m32);
					$('#m33').val(data.m33);					
					$('#m34').val(data.m34);					
					$('#m35').val(data.m35);
					$('#m36').val(data.m36);
					
					
					$('#d41').val(data.d41);
					$('#d42').val(data.d42);
					$('#d43').val(data.d43);					
					$('#d44').val(data.d44);					
					$('#d45').val(data.d45);
					$('#d46').val(data.d46);
					
					$('#m41').val(data.m41);
					$('#m42').val(data.m42);
					$('#m43').val(data.m43);					
					$('#m44').val(data.m44);					
					$('#m45').val(data.m45);
					$('#m46').val(data.m46);
					
					
					$('#d51').val(data.d51);
					$('#d52').val(data.d52);
					$('#d53').val(data.d53);					
					$('#d54').val(data.d54);					
					$('#d55').val(data.d55);
					$('#d56').val(data.d56);
					
					$('#m51').val(data.m51);
					$('#m52').val(data.m52);
					$('#m53').val(data.m53);					
					$('#m54').val(data.m54);					
					$('#m55').val(data.m55);
					$('#m56').val(data.m56);
					
					$('#d61').val(data.d61);
					$('#d62').val(data.d62);
					$('#d63').val(data.d63);					
					$('#d64').val(data.d64);					
					$('#d65').val(data.d65);
					$('#d66').val(data.d66);
					
					$('#m61').val(data.m61);
					$('#m62').val(data.m62);
					$('#m63').val(data.m63);					
					$('#m64').val(data.m64);					
					$('#m65').val(data.m65);
					$('#m66').val(data.m66);
					
					
					$('#d71').val(data.d71);
					$('#d72').val(data.d72);
					$('#d73').val(data.d73);					
					$('#d74').val(data.d74);					
					$('#d75').val(data.d75);
					$('#d76').val(data.d76);
					
					$('#m71').val(data.m71);
					$('#m72').val(data.m72);
					$('#m73').val(data.m73);					
					$('#m74').val(data.m74);					
					$('#m75').val(data.m75);
					$('#m76').val(data.m76);
				
							
						var chk_mdd = data.chk_mdd;
						if(chk_mdd=="1")
						{
						   $("#chk_mdd").prop("checked", true); 
						}else{
							$("#chk_mdd").prop("checked", false); 
						}	
						break;
				}
				else
				{
				/*var m11 = "0";
						var m12 = "0";
						var m14 = "0";
						var m13 = "0";
						var m15 = "0";
						var m16 = "0";
						
						var m21 = "0";
						var m22 = "0";
						var m23 = "0";
						var m24 = "0";
						var m25 = "0";
						var m26 = "0";
						
						var m31 = "0";
						var m32 = "0";
						var m33 = "0";
						var m34 = "0";
						var m35 = "0";
						var m36 = "0";
						
						var m41 = "0";
						var m42 = "0";
						var m43 = "0";
						var m44 = "0";
						var m45 = "0";
						var m46 = "0";
						
						var m51 = "0";
						var m52 = "0";
						var m53 = "0";
						var m54 = "0";
						var m55 = "0";
						var m56 = "0";
						
						var m61 = "0";
						var m62 = "0";
						var m63 = "0";
						var m64 = "0";
						var m65 = "0";
						var m66 = "0";
						
						var m71 = "0";
						var m72 = "0";
						var m73 = "0";
						var m74 = "0";
						var m75 = "0";
						var m76 = "0";
						
						
						var d11 = "0";
						var d12 = "0";
						var d13 = "0";
						var d14 = "0";
						var d15 = "0";
						var d16 = "0";
						
						var d21 = "0";
						var d22 = "0";
						var d23 = "0";
						var d24 = "0";
						var d25 = "0";
						var d26 = "0";
						
						var d31 = "0";
						var d32 = "0";
						var d33 = "0";
						var d34 = "0";
						var d35 = "0";
						var d36 = "0";
						
						var d41 = "0";
						var d42 = "0";
						var d43 = "0";
						var d44 = "0";
						var d45 = "0";
						var d46 = "0";
						
						var d51 = "0";
						var d52 = "0";
						var d53 = "0";
						var d54 = "0";
						var d55 = "0";
						var d56 = "0";
						
						var d61 = "0";
						var d62 = "0";
						var d63 = "0";
						var d64 = "0";
						var d65 = "0";
						var d66 = "0";
						
						var d71 = "0";
						var d72 = "0";
						var d73 = "0";
						var d74 = "0";
						var d75 = "0";
						var d76 = "0";
						
						var mdd = "0";
						var omc = "0";
						var cbr = "0";*/
				}

			}
		
			//flakiness
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="flk")
				{	
						$('#p1').val(data.p1);
						$('#p2').val(data.p2);
						$('#p3').val(data.p3);
						$('#p4').val(data.p4);
						$('#p5').val(data.p5);
						$('#p6').val(data.p6);
						$('#p7').val(data.pa7);
						$('#p8').val(data.p8);
						$('#p9').val(data.p9);
						
						$('#fi_index').val(data.fi_index);
						$('#a1').val(data.a1);
						$('#a2').val(data.a2);
						$('#a3').val(data.a3);
						$('#a4').val(data.a4);
						$('#a5').val(data.a5);
						$('#a6').val(data.a6);
						$('#a7').val(data.a7);
						$('#a8').val(data.a8);
						$('#a9').val(data.a9);
						$('#suma').val(data.suma);

						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#b4').val(data.b4);
						$('#b5').val(data.b5);
						$('#b6').val(data.b6);
						$('#b7').val(data.b7);
						$('#b8').val(data.b8);
						$('#b9').val(data.b9);
						
											
						$('#c1').val(data.c1);
						$('#c2').val(data.c2);
						$('#c3').val(data.c3);					
						$('#c4').val(data.c4);					
						$('#c5').val(data.c5);					
						$('#c6').val(data.c6);					
						$('#c7').val(data.c7);					
						$('#c8').val(data.c8);					
						$('#c9').val(data.c9);					
						
						$('#d1').val(data.d1);
						$('#d2').val(data.d2);
						$('#d3').val(data.d3);					
						$('#d4').val(data.d4);					
						$('#d5').val(data.d5);					
						$('#d6').val(data.d6);					
						$('#d7').val(data.d7);					
						$('#d8').val(data.d8);					
						$('#d9').val(data.d9);					
						
						$('#e1').val(data.e1);
						$('#e2').val(data.e2);
						$('#e3').val(data.e3);									
						$('#e4').val(data.e4);									
						$('#e5').val(data.e5);									
						$('#e6').val(data.e6);									
						$('#e7').val(data.e7);									
						$('#e8').val(data.e8);									
						$('#e9').val(data.e9);									
						
						$('#ei_index').val(data.ei_index);									
					
						$('#aa1').val(data.aa1);
						$('#aa2').val(data.aa2);
						$('#aa3').val(data.aa3);
						$('#aa4').val(data.aa4);
						$('#aa5').val(data.aa5);			
						$('#aa6').val(data.aa6);			
						$('#aa7').val(data.aa7);			
						$('#aa8').val(data.aa8);			
						$('#aa9').val(data.aa9);			

						$('#bb1').val(data.bb1);
						$('#bb2').val(data.bb2);
						$('#bb3').val(data.bb3);
						$('#bb4').val(data.bb4);
						$('#bb5').val(data.bb5);			
						$('#bb6').val(data.bb6);			
						$('#bb7').val(data.bb7);			
						$('#bb8').val(data.bb8);			
						$('#bb9').val(data.bb9);			
											
						
						$('#dd1').val(data.dd1);
						$('#dd2').val(data.dd2);
						$('#dd3').val(data.dd3);					
						$('#dd4').val(data.dd4);					
						$('#dd5').val(data.dd5);					
						$('#dd6').val(data.dd6);					
						$('#dd7').val(data.dd7);					
						$('#dd8').val(data.dd8);					
						$('#dd9').val(data.dd9);					
						
						$('#combined_index').val(data.combined_index);					
						
					
						var chk_f1,chk_f2,chk_f3,chk_f4,chk_f5,chk_f6,chk_f7,chk_f8,chk_f9;
						chk_f1 = data.chk_f1;
						chk_f2 = data.chk_f2;
						chk_f3 = data.chk_f3;
						chk_f4 = data.chk_f4;
						chk_f5 = data.chk_f5;
						chk_f6 = data.chk_f6;
						chk_f7 = data.chk_f7;
						chk_f8 = data.chk_f8;
						chk_f9 = data.chk_f9;
						
						
						$('#s11').val(data.s11);
						$('#s12').val(data.s12);
						$('#s13').val(data.s13);
						$('#s14').val(data.s14);
						$('#s15').val(data.s15);
						$('#s16').val(data.s16);
						$('#s17').val(data.s17);
						$('#s18').val(data.s18);
						$('#s19').val(data.s19);
						
						
						
						if(chk_f1=="1")
						{
						   $("#chk_f1").prop("checked", true); 
						}
						else
						{
							$("#chk_f1").prop("checked", false); 
						}
						
						if(chk_f2=="1")
						{
						   $("#chk_f2").prop("checked", true); 
						}
						else
						{
							$("#chk_f2").prop("checked", false); 
						}
						
						if(chk_f3=="1")
						{
						   $("#chk_f3").prop("checked", true); 
						}
						else
						{
							$("#chk_f3").prop("checked", false); 
						}
						
						if(chk_f4=="1")
						{
						   $("#chk_f4").prop("checked", true); 
						}
						else
						{
							$("#chk_f4").prop("checked", false); 
						}
						
						if(chk_f5=="1")
						{
						   $("#chk_f5").prop("checked", true); 
						}
						else
						{
							$("#chk_f5").prop("checked", false); 
						}

						if(chk_f6=="1")
						{
						   $("#chk_f6").prop("checked", true); 
						}
						else
						{
							$("#chk_f6").prop("checked", false); 
						}

						if(chk_f7=="1")
						{
						   $("#chk_f7").prop("checked", true); 
						}
						else
						{
							$("#chk_f7").prop("checked", false); 
						}

						if(chk_f8=="1")
						{
						   $("#chk_f8").prop("checked", true); 
						}
						else
						{
							$("#chk_f8").prop("checked", false); 
						}

						if(chk_f9=="1")
						{
						   $("#chk_f9").prop("checked", true); 
						}
						else
						{
							$("#chk_f9").prop("checked", false); 
						}
						
						
						var chk_flk = data.chk_flk;	
						if(chk_flk=="1")
						{
						   $("#chk_flk").prop("checked", true); 
						}else{
							$("#chk_flk").prop("checked", false); 
						}
						break;
				}
				else
				{
					/*var chk_flk = "0";	
					var chk_f1 = "0";
					var chk_f2 = "0";
					var chk_f3 = "0";
					var chk_f4 = "0";
					var chk_f5 = "0";
					var chk_f6 = "0";
					var chk_f7 = "0";
					var chk_f8 = "0";
					var chk_f9 = "0";
					var fi_index ="0";
					var ei_index ="0";
					var combined_index ="0";
					 
					var a1 ="0";
					var a2 ="0";
					var a3 ="0";
					var a4 ="0";
					var a5 ="0";
					var a6 ="0";
					var a7 ="0";
					var a8 ="0";
					var a9 ="0";
					var suma ="0";
											
					var b1 ="0";
					var b2 ="0";
					var b3 ="0";
					var b4 ="0";
					var b5 ="0";
					var b6 ="0";
					var b7 ="0";
					var b8 ="0";
					var b9 ="0";
											
					var c1 ="0";
					var c2 ="0";
					var c3 ="0";
					var c4 ="0";
					var c5 ="0";
					var c6 ="0";
					var c7 ="0";
					var c8 ="0";
					var c9 ="0";
											
					var d1 ="0";
					var d2 ="0";
					var d3 ="0";
					var d4 ="0";
					var d5 ="0";
					var d6 ="0";
					var d7 ="0";
					var d8 ="0";
					var d9 ="0";
					
					var e1 ="0";
					var e2 ="0";
					var e3 ="0";
					var e4 ="0";
					var e5 ="0";
					var e6 ="0";
					var e7 ="0";
					var e8 ="0";
					var e9 ="0";
											
					var aa1 ="0";
					var aa2 ="0";
					var aa3 ="0";
					var aa4 ="0";
					var aa5 ="0";
					var aa6 ="0";
					var aa7 ="0";
					var aa8 ="0";
					var aa9 ="0";
					
					var bb1 ="0";	
					var bb2 ="0";
					var bb3 ="0";
					var bb4 ="0";
					var bb5 ="0";
					var bb6 ="0";
					var bb7 ="0";
					var bb8 ="0";
					var bb9 ="0";
					
					var dd1 ="0";
					var dd2 ="0";			
					var dd3 ="0";
					var dd4 ="0";
					var dd5 ="0";
					var dd6 ="0";
					var dd7 ="0";
					var dd8 ="0";
					var dd9 ="0";*/	
				}
			
			}
	
			//sp and water
			for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	var chk_sp = data.chk_sp;
							if(chk_sp=="1")
							{
							   $("#chk_sp").prop("checked", true); 
							}else{
								$("#chk_sp").prop("checked", false); 
							}
						//specific gravity and water abr
						$('#sp_sample_ca').val(data.sp_sample_ca);
						$('#sp_w_b_a1_1').val(data.sp_w_b_a1_1);
						$('#sp_w_b_a1_2').val(data.sp_w_b_a1_2);
						$('#sp_w_b_a2_1').val(data.sp_w_b_a2_1);
						$('#sp_w_b_a2_2').val(data.sp_w_b_a2_2);	
						$('#sp_w_sur_1').val(data.sp_w_sur_1);
						$('#sp_w_sur_2').val(data.sp_w_sur_2);	
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);		
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);								
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);										
						$('#sp_specific_gravity').val(data.sp_specific_gravity);										
						$('#sp_water_abr').val(data.sp_water_abr);										
						$('#sp_water_abr_1').val(data.sp_water_abr_1);										
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						$('#sp_temp').val(data.sp_temp); 
						break;
					}
					else
					{
						/* var chk_sp = "0";
						var sp_w_b_a1_1 ="0";
						var sp_w_b_a2_1 ="0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_b_a1_2 ="0";
						var sp_w_b_a2_2 ="0";
						var sp_w_sur_2 ="0";
						var sp_w_s_2 ="0";
						var sp_wt_st_2 ="0";										
						var sp_specific_gravity_1 ="0";
						var sp_specific_gravity_2 ="0";
						var sp_specific_gravity ="0";
						var sp_water_abr_1 ="0";
						var sp_water_abr_2 ="0";
						var sp_water_abr ="0";
						var sp_sample_ca ="0"; */
					}
				
				}

			
			//impact
			for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							//impact value
							$('#imp_w_m_a_1').val(data.imp_w_m_a_1);
							$('#imp_w_m_a_2').val(data.imp_w_m_a_2);				
							$('#imp_w_m_b_1').val(data.imp_w_m_b_1);
							$('#imp_w_m_b_2').val(data.imp_w_m_b_2);				
							$('#imp_w_m_c_1').val(data.imp_w_m_c_1);
							$('#imp_w_m_c_2').val(data.imp_w_m_c_2);
							$('#imp_value_1').val(data.imp_value_1);
							$('#imp_value_2').val(data.imp_value_2);
							$('#imp_value').val(data.imp_value);
							$('#imp_w_m_d_1').val(data.imp_w_m_d_1);
							$('#imp_w_m_d_2').val(data.imp_w_m_d_2);
					
							var chk_impact = data.chk_impact;
							if(chk_impact=="1")
							{
							   $("#chk_impact").prop("checked", true); 
							}else{
								$("#chk_impact").prop("checked", false); 
							}	
							break;
					}
					else
					{
						/* var chk_impact = "0";	
						var imp_value ="0";
						var imp_value_1 ="0";
						var imp_value_2 ="0";
						var imp_w_m_a_1 ="0";
						var imp_w_m_b_1 ="0";
						var imp_w_m_c_1 ="0";
						var imp_w_m_d_1 ="0";
						var imp_w_m_a_2 ="0";
						var imp_w_m_b_2 ="0";
						var imp_w_m_c_2 ="0";
						var imp_w_m_d_2 ="0"; */
					}

				}

			//crushing
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							$('#cr_a_1').val(data.cr_a_1);
							$('#cr_a_2').val(data.cr_a_2);			
							$('#cr_b_1').val(data.cr_b_1);
							$('#cr_b_2').val(data.cr_b_2);
							$('#cr_c_1').val(data.cr_c_1);
							$('#cr_c_2').val(data.cr_c_2);
							$('#cru_value_1').val(data.cru_value_1);
							$('#cru_value_2').val(data.cru_value_2);
							$('#cru_value').val(data.cru_value);
							$('#cru_sample_crush').val(data.cru_sample_crush);
							
							var chk_crushing = data.chk_crushing;
							if(chk_crushing=="1")
							{
							   $("#chk_crushing").prop("checked", true); 
							}else{
								$("#chk_crushing").prop("checked", false); 
							}
							break;
					}
					else
					{
						/* var chk_crushing = "0";	
						var cru_value ="0";
						var cr_sample_crush ="0";
						var cru_value_1 ="0";
						var cr_a_1 ="0";
						var cr_a_2 ="0";
						var cr_b_1 ="0";
						var cr_c_1 ="0";
						var cru_value_2 ="0";
						var cr_b_2 ="0";
						var cr_c_2 ="0"; */
					}
				}
					
			
			//soundness
			for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
							//SOUNDNESS
							$('#soundness').val(data.soundness);
							$('#sample_id').val(data.sample_id);
							$('#sound_sample').val(data.sound_sample);
							$('#w1').val(data.w1);
							$('#w2').val(data.w2);
							$('#wsum').val(data.wsum);
							$('#ga1').val(data.ga1);
							$('#ga2').val(data.ga2);
							$('#gasum').val(data.gasum);
							$('#gb1').val(data.gb1);
							$('#gb2').val(data.gb2);
							$('#gbsum').val(data.gbsum);
							$('#gc1').val(data.gc1);
							$('#gc2').val(data.gc2);
							$('#gcsum').val(data.gcsum);
							$('#gd1').val(data.gd1);
							$('#gd2').val(data.gd2);
							$('#gdsum').val(data.gdsum);
							$('#ge1').val(data.ge1);
							$('#ge2').val(data.ge2);
							$('#gesum').val(data.gesum);
							$('#s1').val(data.s1);
							$('#s2').val(data.s2);
							var chk_wp,chk_a,chk_b,chk_c,chk_d,chk_e;
							chk_wp = data.chk_wp;
							chk_a = data.chk_a;
							chk_b = data.chk_b;
							chk_c = data.chk_c;
							chk_d = data.chk_d;
							chk_e = data.chk_e;
							if(chk_wp=="1")
							{
							   $("#chk_wp").prop("checked", true); 
							}
							else
							{
								$("#chk_wp").prop("checked", false); 
							}
							
							if(chk_a=="1")
							{
							   $("#chk_a").prop("checked", true); 
							}
							else
							{
								$("#chk_a").prop("checked", false); 
							}
							
							if(chk_a=="1")
							{
							   $("#chk_a").prop("checked", true); 
							}
							else
							{
								$("#chk_a").prop("checked", false); 
							}
							
							if(chk_b=="1")
							{
							   $("#chk_b").prop("checked", true); 
							}
							else
							{
								$("#chk_b").prop("checked", false); 
							}
							
							if(chk_c=="1")
							{
							   $("#chk_c").prop("checked", true); 
							}
							else
							{
								$("#chk_c").prop("checked", false); 
							}
							
							if(chk_d=="1")
							{
							   $("#chk_d").prop("checked", true); 
							}
							else
							{
								$("#chk_d").prop("checked", false); 
							}
							
							if(chk_e=="1")
							{
							   $("#chk_e").prop("checked", true); 
							}
							else
							{
								$("#chk_e").prop("checked", false); 
							}
							
							var chk_sou = data.chk_sou;
							if(chk_sou=="1")
							{
							   $("#chk_sou").prop("checked", true); 
							}else{
								$("#chk_sou").prop("checked", false); 
							}
							break;
					}
					else
					{
						/* var chk_sou = "0";	
						var chk_wp = "0";	
						var chk_a = "0";	
						var chk_b = "0";	
						var chk_c = "0";	
						var chk_d = "0";	
						var chk_e = "0";
						var soundness ="0";			
						var sound_sample ="0";			
						var sample_id ="0";			
						
						var w1 ="0";			
						var w2 ="0";			
						var wsum ="0";			
						
						var ga1 ="0";			
						var ga2 ="0";			
						var gasum ="0";			
						
						var gb1 ="0";			
						var gb2 ="0";			
						var gbsum ="0";			
						
						var gc1 ="0";			
						var gc2 ="0";			
						var gcsum ="0";			
						
						var gd1 ="0";			
						var gd2 ="0";			
						var gdsum ="0";			
						
						var ge1 ="0";			
						var ge2 ="0";			
						var gesum ="0";			
						
						var s1 ="0";			
						var s2  ="0"; */
					}
				
				}
			
			//LIQUIDE LIMIT
			for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{
						$('#p_ll_1').val(data.p_ll_1);
						$('#p_ll_2').val(data.p_ll_2);
						$('#p_ll_3').val(data.p_ll_3);
						$('#p_ll_4').val(data.p_ll_4);
						$('#p_ll_5').val(data.p_ll_5);

						$('#p_pl_1').val(data.p_pl_1);
						$('#p_pl_2').val(data.p_pl_2);
						$('#p_pl_3').val(data.p_pl_3);
						
						$('#cn_ll_1').val(data.cn_ll_1);
						$('#cn_ll_2').val(data.cn_ll_2);
						$('#cn_ll_3').val(data.cn_ll_3);
						$('#cn_ll_4').val(data.cn_ll_4);
						$('#cn_ll_5').val(data.cn_ll_5);

						$('#cn_pl_1').val(data.cn_pl_1);
						$('#cn_pl_2').val(data.cn_pl_2);
						$('#cn_pl_3').val(data.cn_pl_3);
						
						$('#wt_ll_1').val(data.wt_ll_1);
						$('#wt_ll_2').val(data.wt_ll_2);
						$('#wt_ll_3').val(data.wt_ll_3);
						$('#wt_ll_4').val(data.wt_ll_4);
						$('#wt_ll_5').val(data.wt_ll_5);

						$('#wt_pl_1').val(data.wt_pl_1);
						$('#wt_pl_2').val(data.wt_pl_2);
						$('#wt_pl_3').val(data.wt_pl_3);
						
						
						$('#dy_ll_1').val(data.dy_ll_1);
						$('#dy_ll_2').val(data.dy_ll_2);
						$('#dy_ll_3').val(data.dy_ll_3);
						$('#dy_ll_4').val(data.dy_ll_4);
						$('#dy_ll_5').val(data.dy_ll_5);

						$('#dy_pl_1').val(data.dy_pl_1);
						$('#dy_pl_2').val(data.dy_pl_2);
						$('#dy_pl_3').val(data.dy_pl_3);
						
						$('#wtr_ll_1').val(data.wtr_ll_1);
						$('#wtr_ll_2').val(data.wtr_ll_2);
						$('#wtr_ll_3').val(data.wtr_ll_3);
						$('#wtr_ll_4').val(data.wtr_ll_4);
						$('#wtr_ll_5').val(data.wtr_ll_5);

						$('#wtr_pl_1').val(data.wtr_pl_1);
						$('#wtr_pl_2').val(data.wtr_pl_2);
						$('#wtr_pl_3').val(data.wtr_pl_3);
						
						$('#con_ll_1').val(data.con_ll_1);
						$('#con_ll_2').val(data.con_ll_2);
						$('#con_ll_3').val(data.con_ll_3);
						$('#con_ll_4').val(data.con_ll_4);
						$('#con_ll_5').val(data.con_ll_5);

						$('#con_pl_1').val(data.con_pl_1);
						$('#con_pl_2').val(data.con_pl_2);
						$('#con_pl_3').val(data.con_pl_3);
						
						
						$('#od_ll_1').val(data.od_ll_1);
						$('#od_ll_2').val(data.od_ll_2);
						$('#od_ll_3').val(data.od_ll_3);
						$('#od_ll_4').val(data.od_ll_4);
						$('#od_ll_5').val(data.od_ll_5);

						$('#od_pl_1').val(data.od_pl_1);
						$('#od_pl_2').val(data.od_pl_2);
						$('#od_pl_3').val(data.od_pl_3);
						
						$('#mc_ll_1').val(data.mc_ll_1);
						$('#mc_ll_2').val(data.mc_ll_2);
						$('#mc_ll_3').val(data.mc_ll_3);
						$('#mc_ll_4').val(data.mc_ll_4);
						$('#mc_ll_5').val(data.mc_ll_5);

						$('#mc_pl_1').val(data.mc_pl_1);
						$('#mc_pl_2').val(data.mc_pl_2);
						$('#mc_pl_3').val(data.mc_pl_3);
						
						$('#avg_ll').val(data.avg_ll);
						$('#avg_pl').val(data.avg_pl);
						$('#chk_pl').val(data.chk_pl);
						$('#plastic_limit').val(data.plastic_limit);
						$('#liquide_limit').val(data.liquide_limit);
							var chk_ll = data.chk_ll;
						if(chk_ll=="1")
						{
						   $("#chk_ll").prop("checked", true); 
						}else{
							$("#chk_ll").prop("checked", false); 
						}	
						break;
					}
					else
					{
						
					}
				}
			
			//ABRASION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						$('#abr_index').val(data.abr_index);			
						$('#abr_wt_t_a_1').val(data.abr_wt_t_a_1);			
						$('#abr_wt_t_b_1').val(data.abr_wt_t_b_1);			
						$('#abr_wt_t_c_1').val(data.abr_wt_t_c_1);			
						$('#abr_sample_abr').val(data.abr_sample_abr);
						$('#abr_grading').val(data.abr_grading);	
						$('#abr_weight_charge').val(data.abr_weight_charge);	
						$('#abr_num_revo').val(data.abr_num_revo);	
						$('#abr_sphere').val(data.abr_sphere);	
						$('#abr_wt_t_a_2').val(data.abr_wt_t_a_2);			
						$('#abr_wt_t_b_2').val(data.abr_wt_t_b_2);			
						$('#abr_wt_t_c_2').val(data.abr_wt_t_c_2);
							var chk_abr = data.chk_abr;
						if(chk_abr=="1")
						{
						   $("#chk_abr").prop("checked", true); 
						}else{
							$("#chk_abr").prop("checked", false); 
						}	
						break;
					}
					else
					{
						/* var chk_abr = "0";	
						var abr_sample_abr ="0";
						var abr_wt_t_a_1 ="0";
						var abr_wt_t_b_1 ="0";
						var abr_wt_t_c_1 ="0";
						var abr_wt_t_a_2 ="0";
						var abr_wt_t_b_2 ="0";
						var abr_wt_t_c_2 ="0";
						var abr_index ="0";
						var abr_sphere ="0";
						var abr_num_revo ="0";
						var abr_weight_charge ="0"; */
					}
				}
			
				//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							$('#alkali_value').val(data.alkali_value);			
							var chk_alkali = data.chk_alkali;
							if(chk_alkali=="1")
							{
							   $("#chk_alkali").prop("checked", true); 
							}else{
								$("#chk_alkali").prop("checked", false); 
							}
							break;
					}
					else
					{
						/* var chk_alkali = "0";	
						var alkali_value = "0";	 */
					}	
				}

				//FINES
				for(var i=0;i<aa.length;i++)
					{
						if(aa[i]=="fin")
						{						
								$('#fines_value').val(data.fines_value);			
								var chk_fines = data.chk_fines;
								if(chk_fines=="1")
								{
								   $("#chk_fines").prop("checked", true); 
								}else{
									$("#chk_fines").prop("checked", false); 
								}
								$('#fines_value').val(data.fines_value);
								$('#f_a_1').val(data.f_a_1);
								$('#f_a_2').val(data.f_a_2);
								$('#f_b_1').val(data.f_b_1);
								$('#f_b_2').val(data.f_b_2);
								$('#f_c_1').val(data.f_c_1);
								$('#f_c_2').val(data.f_c_2);
								$('#f_d_1').val(data.f_d_1);
								$('#f_d_2').val(data.f_d_2);
								$('#f_e_1').val(data.f_e_1);
								$('#f_e_2').val(data.f_e_2);
								break;
						}
						else
						{
							
						}	
					}
				
				//STRIPPING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{						
							$('#stripping_value').val(data.stripping_value);			
							var chk_strip = data.chk_strip;
							if(chk_strip=="1")
							{
							   $("#chk_strip").prop("checked", true); 
							}else{
								$("#chk_strip").prop("checked", false); 
							}
							break;
					}
					else
					{
						/* var chk_alkali = "0";	
						var alkali_value = "0";	 */
					}	
				}

				
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


