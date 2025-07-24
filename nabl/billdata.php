<script>
				
	
function saveMetal(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var grade = $('#grade').val();
				var dia = $('#dia').val();
				var brand = $('#brand').val();
				var chk_phy = $('#chk_phy').val();
				var chk1 = $('#chk1').val();
				var chk2 = $('#chk2').val();
				var chk3 = $('#chk3').val();
				var chk4 = $('#chk4').val();
				var chk5 = $('#chk5').val();
				var chk6 = $('#chk6').val();
				var chk7 = $('#chk7').val();
				var labno1 = $('#labno1').val();
				var labno2 = $('#labno2').val();
				var labno3 = $('#labno3').val();
				var labno4 = $('#labno4').val();
				var labno5 = $('#labno5').val();
				var labno6 = $('#labno6').val();
				var labno7 = $('#labno7').val();
				var dia_1 = $('#dia_1').val();
				var dia_2 = $('#dia_2').val();
				var dia_3 = $('#dia_3').val();
				var dia_4 = $('#dia_4').val();
				var dia_5 = $('#dia_5').val();
				var dia_6 = $('#dia_6').val();
				var dia_7 = $('#dia_7').val();
				var w_1 = $('#w_1').val();
				var w_2 = $('#w_2').val();
				var w_3 = $('#w_3').val();
				var w_4 = $('#w_4').val();
				var w_5 = $('#w_5').val();
				var w_6 = $('#w_6').val();
				var w_7 = $('#w_7').val();
				var l_1 = $('#l_1').val();
				var l_2 = $('#l_2').val();
				var l_3 = $('#l_3').val();
				var l_4 = $('#l_4').val();
				var l_5 = $('#l_5').val();
				var l_6 = $('#l_6').val();
				var l_7 = $('#l_7').val();
				var cs_1 = $('#cs_1').val();
				var cs_2 = $('#cs_2').val();
				var cs_3 = $('#cs_3').val();
				var cs_4 = $('#cs_4').val();
				var cs_5 = $('#cs_5').val();
				var cs_6 = $('#cs_6').val();
				var cs_7 = $('#cs_7').val();
				var gl_1 = $('#gl_1').val();
				var gl_2 = $('#gl_2').val();
				var gl_3 = $('#gl_3').val();
				var gl_4 = $('#gl_4').val();
				var gl_5 = $('#gl_5').val();
				var gl_6 = $('#gl_6').val();
				var gl_7 = $('#gl_7').val();
				var yp_1 = $('#yp_1').val();
				var yp_2 = $('#yp_2').val();
				var yp_3 = $('#yp_3').val();
				var yp_4 = $('#yp_4').val();
				var yp_5 = $('#yp_5').val();
				var yp_6 = $('#yp_6').val();
				var yp_7 = $('#yp_7').val();
				var up_1 = $('#up_1').val();
				var up_2 = $('#up_2').val();
				var up_3 = $('#up_3').val();
				var up_4 = $('#up_4').val();
				var up_5 = $('#up_5').val();
				var up_6 = $('#up_6').val();
				var up_7 = $('#up_7').val();
				var ys_1 = $('#ys_1').val();
				var ys_2 = $('#ys_2').val();
				var ys_3 = $('#ys_3').val();
				var ys_4 = $('#ys_4').val();
				var ys_5 = $('#ys_5').val();
				var ys_6 = $('#ys_6').val();
				var ys_7 = $('#ys_7').val();
				var ten_1 = $('#ten_1').val();
				var ten_2 = $('#ten_2').val();
				var ten_3 = $('#ten_3').val();
				var ten_4 = $('#ten_4').val();
				var ten_5 = $('#ten_5').val();
				var ten_6 = $('#ten_6').val();
				var ten_7 = $('#ten_7').val();
				var og_1 = $('#og_1').val();
				var og_2 = $('#og_2').val();
				var og_3 = $('#og_3').val();
				var og_4 = $('#og_4').val();
				var og_5 = $('#og_5').val();
				var og_6 = $('#og_6').val();
				var og_7 = $('#og_7').val();
				var fg_1 = $('#fg_1').val();
				var fg_2 = $('#fg_2').val();
				var fg_3 = $('#fg_3').val();
				var fg_4 = $('#fg_4').val();
				var fg_5 = $('#fg_5').val();
				var fg_6 = $('#fg_6').val();
				var fg_7 = $('#fg_7').val();
				var elo_1 = $('#elo_1').val();
				var elo_2 = $('#elo_2').val();
				var elo_3 = $('#elo_3').val();
				var elo_4 = $('#elo_4').val();
				var elo_5 = $('#elo_5').val();
				var elo_6 = $('#elo_6').val();
				var elo_7 = $('#elo_7').val();
				var bend_1 = $('#bend_1').val();
				var bend_2 = $('#bend_2').val();
				var bend_3 = $('#bend_3').val();
				var bend_4 = $('#bend_4').val();
				var bend_5 = $('#bend_5').val();
				var bend_6 = $('#bend_6').val();
				var bend_7 = $('#bend_7').val();
				var rebend_1 = $('#rebend_1').val();
				var rebend_2 = $('#rebend_2').val();
				var rebend_3 = $('#rebend_3').val();
				var rebend_4 = $('#rebend_4').val();
				var rebend_5 = $('#rebend_5').val();
				var rebend_6 = $('#rebend_6').val();
				var rebend_7 = $('#rebend_7').val();
				var chk_chem = $('#chk_chem').val();
				var cmax1 = $('#cmax1').val();
				var cmax2 = $('#cmax2').val();
				var cmax3 = $('#cmax3').val();
				var cmax4 = $('#cmax4').val();
				var cmax5 = $('#cmax5').val();
				var cmax6 = $('#cmax6').val();
				var cmax7 = $('#cmax7').val();
				var pmax1 = $('#pmax1').val();
				var pmax2 = $('#pmax2').val();
				var pmax3 = $('#pmax3').val();
				var pmax4 = $('#pmax4').val();
				var pmax5 = $('#pmax5').val();
				var pmax6 = $('#pmax6').val();
				var pmax7 = $('#pmax7').val();
				var smax1 = $('#smax1').val();
				var smax2 = $('#smax2').val();
				var smax3 = $('#smax3').val();
				var smax4 = $('#smax4').val();
				var smax5 = $('#smax5').val();
				var smax6 = $('#smax6').val();
				var smax7 = $('#smax7').val();
				var wtg1 = $('#wtg1').val();
				var wtg2 = $('#wtg2').val();
				var wtg3 = $('#wtg3').val();
				var wtg4 = $('#wtg4').val();
				var wtg5 = $('#wtg5').val();
				var wtg6 = $('#wtg6').val();
				var wtg7 = $('#wtg7').val();
				
				
							billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade='+grade+'&dia='+dia+'&brand='+brand+'&chk_phy='+chk_phy+'&chk1='+chk1+'&chk2='+chk2+'&chk3='+chk3+'&chk4='+chk4+'&chk5='+chk5+'&chk6='+chk6+'&chk7='+chk7+'&labno1='+labno1+'&labno2='+labno2+'&labno3='+labno3+'&labno4='+labno4+'&labno5='+labno5+'&labno6='+labno6+'&labno7='+labno7+'&dia_1='+dia_1+'&dia_2='+dia_2+'&dia_3='+dia_3+'&dia_4='+dia_4+'&dia_5='+dia_5+'&dia_6='+dia_6+'&dia_7='+dia_7+'&w_1='+w_1+'&w_2='+w_2+'&w_3='+w_3+'&w_4='+w_4+'&w_5='+w_5+'&w_6='+w_6+'&w_7='+w_7+'&l_1='+l_1+'&l_2='+l_2+'&l_3='+l_3+'&l_4='+l_4+'&l_5='+l_5+'&l_6='+l_6+'&l_7='+l_7+'&cs_1='+cs_1+'&cs_2='+cs_2+'&cs_3='+cs_3+'&cs_4='+cs_4+'&cs_5='+cs_5+'&cs_6='+cs_6+'&cs_7='+cs_7+'&gl_1='+gl_1+'&gl_2='+gl_2+'&gl_3='+gl_3+'&gl_4='+gl_4+'&gl_5='+gl_5+'&gl_6='+gl_6+'&gl_7='+gl_7+'&yp_1='+yp_1+'&yp_2='+yp_2+'&yp_3='+yp_3+'&yp_4='+yp_4+'&yp_5='+yp_5+'&yp_6='+yp_6+'&yp_7='+yp_7+'&up_1='+up_1+'&up_2='+up_2+'&up_3='+up_3+'&up_4='+up_4+'&up_5='+up_5+'&up_6='+up_6+'&up_7='+up_7+'&ys_1='+ys_1+'&ys_2='+ys_2+'&ys_3='+ys_3+'&ys_4='+ys_4+'&ys_5='+ys_5+'&ys_6='+ys_6+'&ys_7='+ys_7+'&ten_1='+ten_1+'&ten_2='+ten_2+'&ten_3='+ten_3+'&ten_4='+ten_4+'&ten_5='+ten_5+'&ten_6='+ten_6+'&ten_7='+ten_7+'&og_1='+og_1+'&og_2='+og_2+'&og_3='+og_3+'&og_4='+og_4+'&og_5='+og_5+'&og_6='+og_6+'&og_7='+og_7+'&fg_1='+fg_1+'&fg_2='+fg_2+'&fg_3='+fg_3+'&fg_4='+fg_4+'&fg_5='+fg_5+'&fg_6='+fg_6+'&fg_7='+fg_7+'&elo_1='+elo_1+'&elo_2='+elo_2+'&elo_3='+elo_3+'&elo_4='+elo_4+'&elo_5='+elo_5+'&elo_6='+elo_6+'&elo_7='+elo_7+'&bend_1='+bend_1+'&bend_2='+bend_2+'&bend_3='+bend_3+'&bend_4='+bend_4+'&bend_5='+bend_5+'&bend_6='+bend_6+'&bend_7='+bend_7+'&rebend_1='+rebend_1+'&rebend_2='+rebend_2+'&rebend_3='+rebend_3+'&rebend_4='+rebend_4+'&rebend_5='+rebend_5+'&rebend_6='+rebend_6+'&rebend_7='+rebend_7+'&chk_chem='+chk_chem+'&cmax1='+cmax1+'&cmax2='+cmax2+'&cmax3='+cmax3+'&cmax4='+cmax4+'&cmax5='+cmax5+'&cmax6='+cmax6+'&cmax7='+cmax7+'&pmax1='+pmax1+'&pmax2='+pmax2+'&pmax3='+pmax3+'&pmax4='+pmax4+'&pmax5='+pmax5+'&pmax6='+pmax6+'&pmax7='+pmax7+'&smax1='+smax1+'&smax2='+smax2+'&smax3='+smax3+'&smax4='+smax4+'&smax5='+smax5+'&smax6='+smax6+'&smax7='+smax7+'&wtg1='+wtg1+'&wtg2='+wtg2+'&wtg3='+wtg3+'&wtg4='+wtg4+'&wtg5='+wtg5+'&wtg6='+wtg6+'&wtg7='+wtg7;
					
	}
	else if (type == 'edit'){
		
			var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var grade = $('#grade').val();
				var dia = $('#dia').val();
				var brand = $('#brand').val();
				var chk_phy = $('#chk_phy').val();
				var chk1 = $('#chk1').val();
				var chk2 = $('#chk2').val();
				var chk3 = $('#chk3').val();
				var chk4 = $('#chk4').val();
				var chk5 = $('#chk5').val();
				var chk6 = $('#chk6').val();
				var chk7 = $('#chk7').val();
				var labno1 = $('#labno1').val();
				var labno2 = $('#labno2').val();
				var labno3 = $('#labno3').val();
				var labno4 = $('#labno4').val();
				var labno5 = $('#labno5').val();
				var labno6 = $('#labno6').val();
				var labno7 = $('#labno7').val();
				var dia_1 = $('#dia_1').val();
				var dia_2 = $('#dia_2').val();
				var dia_3 = $('#dia_3').val();
				var dia_4 = $('#dia_4').val();
				var dia_5 = $('#dia_5').val();
				var dia_6 = $('#dia_6').val();
				var dia_7 = $('#dia_7').val();
				var w_1 = $('#w_1').val();
				var w_2 = $('#w_2').val();
				var w_3 = $('#w_3').val();
				var w_4 = $('#w_4').val();
				var w_5 = $('#w_5').val();
				var w_6 = $('#w_6').val();
				var w_7 = $('#w_7').val();
				var l_1 = $('#l_1').val();
				var l_2 = $('#l_2').val();
				var l_3 = $('#l_3').val();
				var l_4 = $('#l_4').val();
				var l_5 = $('#l_5').val();
				var l_6 = $('#l_6').val();
				var l_7 = $('#l_7').val();
				var cs_1 = $('#cs_1').val();
				var cs_2 = $('#cs_2').val();
				var cs_3 = $('#cs_3').val();
				var cs_4 = $('#cs_4').val();
				var cs_5 = $('#cs_5').val();
				var cs_6 = $('#cs_6').val();
				var cs_7 = $('#cs_7').val();
				var gl_1 = $('#gl_1').val();
				var gl_2 = $('#gl_2').val();
				var gl_3 = $('#gl_3').val();
				var gl_4 = $('#gl_4').val();
				var gl_5 = $('#gl_5').val();
				var gl_6 = $('#gl_6').val();
				var gl_7 = $('#gl_7').val();
				var yp_1 = $('#yp_1').val();
				var yp_2 = $('#yp_2').val();
				var yp_3 = $('#yp_3').val();
				var yp_4 = $('#yp_4').val();
				var yp_5 = $('#yp_5').val();
				var yp_6 = $('#yp_6').val();
				var yp_7 = $('#yp_7').val();
				var up_1 = $('#up_1').val();
				var up_2 = $('#up_2').val();
				var up_3 = $('#up_3').val();
				var up_4 = $('#up_4').val();
				var up_5 = $('#up_5').val();
				var up_6 = $('#up_6').val();
				var up_7 = $('#up_7').val();
				var ys_1 = $('#ys_1').val();
				var ys_2 = $('#ys_2').val();
				var ys_3 = $('#ys_3').val();
				var ys_4 = $('#ys_4').val();
				var ys_5 = $('#ys_5').val();
				var ys_6 = $('#ys_6').val();
				var ys_7 = $('#ys_7').val();
				var ten_1 = $('#ten_1').val();
				var ten_2 = $('#ten_2').val();
				var ten_3 = $('#ten_3').val();
				var ten_4 = $('#ten_4').val();
				var ten_5 = $('#ten_5').val();
				var ten_6 = $('#ten_6').val();
				var ten_7 = $('#ten_7').val();
				var og_1 = $('#og_1').val();
				var og_2 = $('#og_2').val();
				var og_3 = $('#og_3').val();
				var og_4 = $('#og_4').val();
				var og_5 = $('#og_5').val();
				var og_6 = $('#og_6').val();
				var og_7 = $('#og_7').val();
				var fg_1 = $('#fg_1').val();
				var fg_2 = $('#fg_2').val();
				var fg_3 = $('#fg_3').val();
				var fg_4 = $('#fg_4').val();
				var fg_5 = $('#fg_5').val();
				var fg_6 = $('#fg_6').val();
				var fg_7 = $('#fg_7').val();
				var elo_1 = $('#elo_1').val();
				var elo_2 = $('#elo_2').val();
				var elo_3 = $('#elo_3').val();
				var elo_4 = $('#elo_4').val();
				var elo_5 = $('#elo_5').val();
				var elo_6 = $('#elo_6').val();
				var elo_7 = $('#elo_7').val();
				var bend_1 = $('#bend_1').val();
				var bend_2 = $('#bend_2').val();
				var bend_3 = $('#bend_3').val();
				var bend_4 = $('#bend_4').val();
				var bend_5 = $('#bend_5').val();
				var bend_6 = $('#bend_6').val();
				var bend_7 = $('#bend_7').val();
				var rebend_1 = $('#rebend_1').val();
				var rebend_2 = $('#rebend_2').val();
				var rebend_3 = $('#rebend_3').val();
				var rebend_4 = $('#rebend_4').val();
				var rebend_5 = $('#rebend_5').val();
				var rebend_6 = $('#rebend_6').val();
				var rebend_7 = $('#rebend_7').val();
				var chk_chem = $('#chk_chem').val();
				var cmax1 = $('#cmax1').val();
				var cmax2 = $('#cmax2').val();
				var cmax3 = $('#cmax3').val();
				var cmax4 = $('#cmax4').val();
				var cmax5 = $('#cmax5').val();
				var cmax6 = $('#cmax6').val();
				var cmax7 = $('#cmax7').val();
				var pmax1 = $('#pmax1').val();
				var pmax2 = $('#pmax2').val();
				var pmax3 = $('#pmax3').val();
				var pmax4 = $('#pmax4').val();
				var pmax5 = $('#pmax5').val();
				var pmax6 = $('#pmax6').val();
				var pmax7 = $('#pmax7').val();
				var smax1 = $('#smax1').val();
				var smax2 = $('#smax2').val();
				var smax3 = $('#smax3').val();
				var smax4 = $('#smax4').val();
				var smax5 = $('#smax5').val();
				var smax6 = $('#smax6').val();
				var smax7 = $('#smax7').val();
				var wtg1 = $('#wtg1').val();
				var wtg2 = $('#wtg2').val();
				var wtg3 = $('#wtg3').val();
				var wtg4 = $('#wtg4').val();
				var wtg5 = $('#wtg5').val();
				var wtg6 = $('#wtg6').val();
				var wtg7 = $('#wtg7').val();

				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade='+grade+'&dia='+dia+'&brand='+brand+'&chk_phy='+chk_phy+'&chk1='+chk1+'&chk2='+chk2+'&chk3='+chk3+'&chk4='+chk4+'&chk5='+chk5+'&chk6='+chk6+'&chk7='+chk7+'&labno1='+labno1+'&labno2='+labno2+'&labno3='+labno3+'&labno4='+labno4+'&labno5='+labno5+'&labno6='+labno6+'&labno7='+labno7+'&dia_1='+dia_1+'&dia_2='+dia_2+'&dia_3='+dia_3+'&dia_4='+dia_4+'&dia_5='+dia_5+'&dia_6='+dia_6+'&dia_7='+dia_7+'&w_1='+w_1+'&w_2='+w_2+'&w_3='+w_3+'&w_4='+w_4+'&w_5='+w_5+'&w_6='+w_6+'&w_7='+w_7+'&l_1='+l_1+'&l_2='+l_2+'&l_3='+l_3+'&l_4='+l_4+'&l_5='+l_5+'&l_6='+l_6+'&l_7='+l_7+'&cs_1='+cs_1+'&cs_2='+cs_2+'&cs_3='+cs_3+'&cs_4='+cs_4+'&cs_5='+cs_5+'&cs_6='+cs_6+'&cs_7='+cs_7+'&gl_1='+gl_1+'&gl_2='+gl_2+'&gl_3='+gl_3+'&gl_4='+gl_4+'&gl_5='+gl_5+'&gl_6='+gl_6+'&gl_7='+gl_7+'&yp_1='+yp_1+'&yp_2='+yp_2+'&yp_3='+yp_3+'&yp_4='+yp_4+'&yp_5='+yp_5+'&yp_6='+yp_6+'&yp_7='+yp_7+'&up_1='+up_1+'&up_2='+up_2+'&up_3='+up_3+'&up_4='+up_4+'&up_5='+up_5+'&up_6='+up_6+'&up_7='+up_7+'&ys_1='+ys_1+'&ys_2='+ys_2+'&ys_3='+ys_3+'&ys_4='+ys_4+'&ys_5='+ys_5+'&ys_6='+ys_6+'&ys_7='+ys_7+'&ten_1='+ten_1+'&ten_2='+ten_2+'&ten_3='+ten_3+'&ten_4='+ten_4+'&ten_5='+ten_5+'&ten_6='+ten_6+'&ten_7='+ten_7+'&og_1='+og_1+'&og_2='+og_2+'&og_3='+og_3+'&og_4='+og_4+'&og_5='+og_5+'&og_6='+og_6+'&og_7='+og_7+'&fg_1='+fg_1+'&fg_2='+fg_2+'&fg_3='+fg_3+'&fg_4='+fg_4+'&fg_5='+fg_5+'&fg_6='+fg_6+'&fg_7='+fg_7+'&elo_1='+elo_1+'&elo_2='+elo_2+'&elo_3='+elo_3+'&elo_4='+elo_4+'&elo_5='+elo_5+'&elo_6='+elo_6+'&elo_7='+elo_7+'&bend_1='+bend_1+'&bend_2='+bend_2+'&bend_3='+bend_3+'&bend_4='+bend_4+'&bend_5='+bend_5+'&bend_6='+bend_6+'&bend_7='+bend_7+'&rebend_1='+rebend_1+'&rebend_2='+rebend_2+'&rebend_3='+rebend_3+'&rebend_4='+rebend_4+'&rebend_5='+rebend_5+'&rebend_6='+rebend_6+'&rebend_7='+rebend_7+'&chk_chem='+chk_chem+'&cmax1='+cmax1+'&cmax2='+cmax2+'&cmax3='+cmax3+'&cmax4='+cmax4+'&cmax5='+cmax5+'&cmax6='+cmax6+'&cmax7='+cmax7+'&pmax1='+pmax1+'&pmax2='+pmax2+'&pmax3='+pmax3+'&pmax4='+pmax4+'&pmax5='+pmax5+'&pmax6='+pmax6+'&pmax7='+pmax7+'&smax1='+smax1+'&smax2='+smax2+'&smax3='+smax3+'&smax4='+smax4+'&smax5='+smax5+'&smax6='+smax6+'&smax7='+smax7+'&wtg1='+wtg1+'&wtg2='+wtg2+'&wtg3='+wtg3+'&wtg4='+wtg4+'&wtg5='+wtg5+'&wtg6='+wtg6+'&wtg7='+wtg7;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_10.php',
         data: billData,
		dataType: 'JSON',
        success:function(msg){
		$('#btn_save').hide();
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
		//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
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
        url: '<?php echo $base_url; ?>save_10.php',
         data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#grade').val(data.grade);
            $('#dia').val(data.dia);
            $('#brand').val(data.brand);
            $('#chk_phy').val(data.chk_phy);
            $('#chk1').val(data.chk1);
            $('#chk2').val(data.chk2);
            $('#chk3').val(data.chk3);
            $('#chk4').val(data.chk4);
            $('#chk5').val(data.chk5);
            $('#chk6').val(data.chk6);
            $('#chk7').val(data.chk7);
            $('#labno1').val(data.labno1);
            $('#labno2').val(data.labno2);
            $('#labno3').val(data.labno3);
            $('#labno4').val(data.labno4);
            $('#labno5').val(data.labno5);
            $('#labno6').val(data.labno6);
            $('#labno7').val(data.labno7);
            $('#dia_1').val(data.dia_1);
            $('#dia_2').val(data.dia_2);
            $('#dia_3').val(data.dia_3);
            $('#dia_4').val(data.dia_4);
            $('#dia_5').val(data.dia_5);
            $('#dia_6').val(data.dia_6);
            $('#dia_7').val(data.dia_7);
            $('#w_1').val(data.w_1);
            $('#w_2').val(data.w_2);
            $('#w_3').val(data.w_3);
            $('#w_4').val(data.w_4);
            $('#w_5').val(data.w_5);
            $('#w_6').val(data.w_6);
            $('#w_7').val(data.w_7);
            $('#l_1').val(data.l_1);
            $('#l_2').val(data.l_2);
            $('#l_3').val(data.l_3);
            $('#l_4').val(data.l_4);
            $('#l_5').val(data.l_5);
            $('#l_6').val(data.l_6);
            $('#l_7').val(data.l_7);
            $('#cs_1').val(data.cs_1);
            $('#cs_2').val(data.cs_2);
            $('#cs_3').val(data.cs_3);
            $('#cs_4').val(data.cs_4);
            $('#cs_5').val(data.cs_5);
            $('#cs_6').val(data.cs_6);
            $('#cs_7').val(data.cs_7);
            $('#gl_1').val(data.gl_1);
            $('#gl_2').val(data.gl_2);
            $('#gl_3').val(data.gl_3);
            $('#gl_4').val(data.gl_4);
            $('#gl_5').val(data.gl_5);
            $('#gl_6').val(data.gl_6);
            $('#gl_7').val(data.gl_7);
            $('#yp_1').val(data.yp_1);
            $('#yp_2').val(data.yp_2);
            $('#yp_3').val(data.yp_3);
            $('#yp_4').val(data.yp_4);
            $('#yp_5').val(data.yp_5);
            $('#yp_6').val(data.yp_6);
            $('#yp_7').val(data.yp_7);
            $('#up_1').val(data.up_1);
            $('#up_2').val(data.up_2);
            $('#up_3').val(data.up_3);
            $('#up_4').val(data.up_4);
            $('#up_5').val(data.up_5);
            $('#up_6').val(data.up_6);
            $('#up_7').val(data.up_7);
            $('#ys_1').val(data.ys_1);
            $('#ys_2').val(data.ys_2);
            $('#ys_3').val(data.ys_3);
            $('#ys_4').val(data.ys_4);
            $('#ys_5').val(data.ys_5);
            $('#ys_6').val(data.ys_6);
            $('#ys_7').val(data.ys_7);
            $('#ten_1').val(data.ten_1);
            $('#ten_2').val(data.ten_2);
            $('#ten_3').val(data.ten_3);
            $('#ten_4').val(data.ten_4);
            $('#ten_5').val(data.ten_5);
            $('#ten_6').val(data.ten_6);
            $('#ten_7').val(data.ten_7);
            $('#og_1').val(data.og_1);
            $('#og_2').val(data.og_2);
            $('#og_3').val(data.og_3);
            $('#og_4').val(data.og_4);
            $('#og_5').val(data.og_5);
            $('#og_6').val(data.og_6);
            $('#og_7').val(data.og_7);
            $('#fg_1').val(data.fg_1);
            $('#fg_2').val(data.fg_2);
            $('#fg_3').val(data.fg_3);
            $('#fg_4').val(data.fg_4);
            $('#fg_5').val(data.fg_5);
            $('#fg_6').val(data.fg_6);
            $('#fg_7').val(data.fg_7);
            $('#elo_1').val(data.elo_1);
            $('#elo_2').val(data.elo_2);
            $('#elo_3').val(data.elo_3);
            $('#elo_4').val(data.elo_4);
            $('#elo_5').val(data.elo_5);
            $('#elo_6').val(data.elo_6);
            $('#elo_7').val(data.elo_7);
            $('#bend_1').val(data.bend_1);
            $('#bend_2').val(data.bend_2);
            $('#bend_3').val(data.bend_3);
            $('#bend_4').val(data.bend_4);
            $('#bend_5').val(data.bend_5);
            $('#bend_6').val(data.bend_6);
            $('#bend_7').val(data.bend_7);
            $('#rebend_1').val(data.rebend_1);
            $('#rebend_2').val(data.rebend_2);
            $('#rebend_3').val(data.rebend_3);
            $('#rebend_4').val(data.rebend_4);
            $('#rebend_5').val(data.rebend_5);
            $('#rebend_6').val(data.rebend_6);
            $('#rebend_7').val(data.rebend_7);
            $('#chk_chem').val(data.chk_chem);
            $('#cmax1').val(data.cmax1);
            $('#cmax2').val(data.cmax2);
            $('#cmax3').val(data.cmax3);
            $('#cmax4').val(data.cmax4);
            $('#cmax5').val(data.cmax5);
            $('#cmax6').val(data.cmax6);
            $('#cmax7').val(data.cmax7);
            $('#pmax1').val(data.pmax1);
            $('#pmax2').val(data.pmax2);
            $('#pmax3').val(data.pmax3);
            $('#pmax4').val(data.pmax4);
            $('#pmax5').val(data.pmax5);
            $('#pmax6').val(data.pmax6);
            $('#pmax7').val(data.pmax7);
            $('#smax1').val(data.smax1);
            $('#smax2').val(data.smax2);
            $('#smax3').val(data.smax3);
            $('#smax4').val(data.smax4);
            $('#smax5').val(data.smax5);
            $('#smax6').val(data.smax6);
            $('#smax7').val(data.smax7);
            $('#wtg1').val(data.wtg1);
            $('#wtg2').val(data.wtg2);
            $('#wtg3').val(data.wtg3);
            $('#wtg4').val(data.wtg4);
            $('#wtg5').val(data.wtg5);
            $('#wtg6').val(data.wtg6);
            $('#wtg7').val(data.wtg7);
		

				
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}

			
				
				 
				 
				 
				 
				 
							
					
	
	
	
	
	
	
	
				
				
    </script>