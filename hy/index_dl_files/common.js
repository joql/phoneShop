$(document).ready(function(){
	$(".menu li").hover(function(){
			$(this).addClass("hover");
			$(this).children("ul li").attr('class','');
		},function(){
			$(this).removeClass("hover");  
			$(this).children("ul li").attr('class','');
		}
	); 
	$("#citydw").hover(function(){
			$(this).addClass("hover");	
		},function(){
			$(this).removeClass("hover");  	
		}
	);
	$("#serchfl").hover(function(){
			$(this).addClass("active");	
		},function(){
			$(this).removeClass("active");  	
		}
	); 
	$("#nowpage").addClass("nowpage");
	$("#nav li").hover(function(){
			$(this).addClass("myhover");
			$("#nowpage").removeClass("nowpage");	
		},function(){
			$(this).removeClass("myhover");
			$("#nowpage").addClass("nowpage");	
		}
	); 
		if($("#nowpage>div").length!=0){
			$("#bj").css("display","block");
			};
	$("#nav li").hover(function(){
			if($(".myhover>div").length!=0){
			$("#bj").css("display","block");
			}
			if($(".myhover>div").length==0){
			$("#bj").css("display","none");
			}
		},function(){
			if($("#nowpage>div").length!=0){
			$("#bj").css("display","block");
			}
			if($("#nowpage>div").length==0){
			$("#bj").css("display","none");
			}
		}
	);
	
	//省市二级联动菜单
	$('#search_province').on('change', function() {
		var pid = $(this).val();
		var city = $("select[name=city]");
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				city.css('display', 'none');
				var option = "<option value='"+pid+"' selected ></option>"; 
				city.append(option);
			} else {
				city.css('display', '');
				$.getJSON('/misc/city?pid=' + pid, function(json){ 
					$("option", city).remove();
					$.each(json,function(index, array) { 
						var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
						city.append(option);
						if(index == 0 && $('#carcity').length > 0) {
							get_cat_head(array['id']);
						}
					}); 
				});	
			}
		} else {
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	$(".sj_mh").hover(function(){
			$(this).addClass("sj_zxz");
			$(this).removeClass("sj_yxz");
			$(".sj_mh").not(this).addClass("sj_yxz");
			$(".sj_mh").not(this).removeClass("sj_zxz");
			var cla = $('#dwss').hasClass('sj_zxz');
			if(cla) {
				$('input[name="stype"]').val('precision');
			} else {
				$('input[name="stype"]').val('');
			}
		},function(){
			
		}
	);
	$('input[type=checkbox].wenbenksty').each(function(index,item) {
		$(this).on('touch click', function() {					   
			if(!$(this).hasClass('dan_active')) {
				$(this).addClass('dan_active');
				$(this).prop('checked', true);
			} else if($(this).hasClass('dan_active')) {
				$(this).removeClass('dan_active');
				$(this).prop('checked', false);
			}
			return true;
		});
	});
})
function msg_info(msg, okfunc, cancelfunc) {
	if($('#msgInfoModal').length < 1) {
		$('body').append('<div id="msgInfoModal" class="modal fade">' +
		  '<div class="modal-dialog modal-sm">' +
		    '<div class="modal-content">' +
		    	'<div class="modal-header"><h4 class="modal-title">温馨提醒</h4></div>'+
                '<div class="modal-body"><strong></strong></div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>'+
                    '<button type="button" class="btn btn-primary" id="confirmdelete">确定</button>'+
                '</div>'+
                '</div>'+
		  '</div>'+
		'</div>');
	}
	$('#msgInfoModal .modal-dialog .modal-body').html(msg);
	if(okfunc != undefined) {
		$('#msgInfoModal .modal-dialog .modal-footer .btn-primary').bind('click', function(){
			okfunc();
			$('#msgInfoModal').modal('hide');
		});
	}
	if(cancelfunc != undefined) {
		$('#msgInfoModal .modal-dialog .modal-footer .btn-default').bind('click', cancelfunc);
	}
	$('#msgInfoModal').modal('show');
}
function msg_error(msg, btnfunc) {
	if($('#msgErrorModal').length < 1) {
		$('body').append('<div id="msgErrorModal" class="modal fade">' +
		  '<div class="modal-dialog modal-sm">' +
		    '<div class="modal-content">' +
		    	'<div class="modal-header">'+
		        '<h4 class="modal-title">错误提示</h4>'+
		    '</div>'+
		    '<div class="modal-body"></div>'+
		    '<div class="modal-footer">'+
		        '<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>'+
		    '</div>'+
		    '</div>'+
		  '</div>'+
		'</div>');
	}
	$('#msgErrorModal .modal-dialog .modal-body').html(msg);
	if(btnfunc != undefined) {
		$('#msgErrorModal .modal-dialog .modal-footer .btn-default').bind('click', btnfunc);
	}
	$('#msgErrorModal').modal('show');
}
/*确认弹窗*/
function msg_alert(msg, btnfunc) {
	if($('#msgErrorModal').length < 1) {
		$('body').append('<div id="msgErrorModal" class="modal fade">' +
		  '<div class="modal-dialog modal-sm">' +
		    '<div class="modal-content">' +
		    	'<div class="modal-header">'+
		        '<h4 class="modal-title">温馨提示</h4>'+
		    '</div>'+
		    '<div class="modal-body"></div>'+
		    '<div class="modal-footer">'+
		        '<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>'+
		    '</div>'+
		    '</div>'+
		  '</div>'+
		'</div>');
	}
	$('#msgErrorModal .modal-dialog .modal-body').html(msg);
	if(btnfunc != undefined) {
		$('#msgErrorModal .modal-dialog .modal-footer .btn-default').bind('click', btnfunc);
	}
	$('#msgErrorModal').modal('show');
}