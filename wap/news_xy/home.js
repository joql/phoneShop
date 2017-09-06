var codewait = 60;
var triggerobj = {};
function codecountdown() {
	if (codewait == 0) {
		$("#sendcodegetbtn").attr("disabled", false);
		$("#sendcodegetbtn").html("再次发送");
		codewait = 60;
	} else {
		$("#sendcodegetbtn").html(codewait + "s后再次发送");
		codewait--;
		setTimeout(function() {
			codecountdown()
		}, 1000)
	}
}
$(function() {
	/*
	 *顶部导航
	 */
	$('.menu.icon').on('touch mousedown', function(){
		if($('.pop-nav').css('display') == 'none') {
			$('.pop-nav').css('display', '');
		} else {
			$('.pop-nav').css('display', 'none');
		}
	});
	$('.pop-nav.zhezhao').on('touch mousedown', function(){
		if($('.pop-nav').css('display') == 'none') {
			$('.pop-nav').css('display', '');
		} else {
			$('.pop-nav').css('display', 'none');
		}
	});
	if($('.swiper-slide').length) {
		/*轮播切换
		 */
		var topSlideSwiper = new Swiper('#top-slide',{
			pagination : '#top-slide .swiper-pagination',
			autoplay: 3000
		})
		/*首页搜索tab切换
		 */
		var homeSearchTabsSwiper = new Swiper('#search_tabs-container',{
			speed:300,
			onSlideChangeStart: function(){
				$("#homeSearch .tabs .active").removeClass('active');
				$("#homeSearch .tabs li").eq(homeSearchTabsSwiper.activeIndex).addClass('active');
			}
		});
		/*$("#homeSearch .tabs li").on('touchstart mousedown',function(e){
			e.preventDefault();
			$("#homeSearch .tabs .active").removeClass('active');
			$(this).addClass('active');
			homeSearchTabsSwiper.slideTo($(this).index());
		});
		$("#homeSearch .tabs a").click(function(e){
			e.preventDefault();
		});*/
		/*首页新闻tab切换
		 */
		var homeNewtabsSwiper = new Swiper('#new-tabs-container',{
			speed:300,
			onSlideChangeStart: function(){
				$(".new-tabs .active").removeClass('active');
				$(".new-tabs a").eq(homeNewtabsSwiper.activeIndex).addClass('active');  
			}
		});
		$(".new_index .new-tabs a").on('touchstart mousedown',function(e){
			e.preventDefault();
			$(".new-tabs .active").removeClass('active');
			$(this).addClass('active');
			homeNewtabsSwiper.slideTo( $(this).index() );
		});
		$(".new_index .new-tabs a").click(function(e){
			e.preventDefault();
		});
	
		/*
		 * 手机主页搜索切换
		 */
		var mobileSearch_slide = new Swiper('#mobileSearch_slide',{
			speed:500,
			onSlideChangeStart: function(){
				$("#mobileSearch .tabs .active").removeClass('active');
				$("#mobileSearch .tabs a").eq(mobileSearch_slide.activeIndex).addClass('active');
			}
		})
		$("#mobileSearch .tabs a").on('touchstart mousedown', function(e){
			e.preventDefault();
			$("#mobileSearch .tabs .active").removeClass('active');
			$(this).addClass('active');
			mobileSearch_slide.slideTo( $(this).index() );
		})
		$("#mobileSearch .tabs a").click(function(e){
			e.preventDefault();
		})
		if(typeof(precisionSearchMobie) != "undefined" && precisionSearchMobie) {
			mobileSearch_slide.slideTo(1);
		}
		/*
		 *联系我们及号码订购
		 */
		var contactTabsSwiper = new Swiper('#contact-tabs-container',{
			speed:500,
			onSlideChangeStart: function(){
				$(".contact-tabs .active").removeClass('active');
				$(".contact-tabs a").eq(contactTabsSwiper.activeIndex).addClass('active');  
			}
		});
		$(".contact-tabs a").on('touchstart mousedown',function(e){
			e.preventDefault();
			$(".contact-tabs .active").removeClass('active');
			$(this).addClass('active');
			contactTabsSwiper.slideTo( $(this).index() );
		});
		$(".contact-tabs a").click(function(e){
			e.preventDefault();
		});
	}
	
	$('#news_more').on('touch mousedown', function() {
		var classid = $(this).attr('classid');
		var page = $('#noticelist').attr('page');
		var url_tail = classid + '_' + page + '.htm';
		$.getJSON('/news/more_index_' + url_tail, function(result) {
			if(result.html) {
				$('#noticelist').append(result.html);
			}
			if(result.nextpage > 0) {
				$('#noticelist').attr('page', result.nextpage);
			} else {
				$(this).remove();
			}
		});
	});
	$('#notice_more').on('touch mousedown', function() {
		var classid = $(this).attr('classid');
		var page = $('#newslist').attr('page');
		var url_tail = classid + '_' + page + '.htm';
		$.getJSON('/news/more_index_' + url_tail, function(result) {
			if(result.html) {
				$('#newslist').append(result.html);
			}
			if(result.nextpage > 0) {
				$('#newslist').attr('page', result.nextpage);
			} else {
				$(this).remove();
			}
		});
	});
	/*
	 *新闻列表页更多
	 */
	$('#news_list_more').on('touch mousedown', function() {
		var classid = $(this).attr('classid');
		var page = $('#news_list_ul').attr('page');
		var url_tail = classid + '_' + page + '_1.htm';
		$.getJSON('/news/more_' + url_tail, function(result) {
			if(result.html) {
				$('#news_list_ul').append(result.html);
			}
			if(result.nextpage > 0) {
				$('#news_list_ul').attr('page', result.nextpage);
			} else {
				$(this).remove();
			}
		});
	});
	/**
	 *号码搜索页面更多
	 */
	$('#mobile_search_more').on('touch mousedown', function() {
		$.getJSON($(this).attr('url'), function(result) {
			if(result.html) {
				$('#mobile_search_more_list').append(result.html);
			}
			if(result.nextpage) {
				$('#mobile_search_more').attr('url', result.nextpage);
			} else {
				$('#mobile_search_more').remove();
			}
		});
	});
	/**
	 *复选框
	 */
	$('input[type=checkbox].dan').each(function(index,item) {
		$(this).on('touch click', function() {
			if(!$(this).hasClass('dan_active')) {
				$(this).addClass('dan_active');
			} else if($(this).hasClass('dan_active')) {
				$(this).removeClass('dan_active');
			}
			return true;
		});
	});
	//输入手机号弹层
	$('#sendcodePoP a.close').on('touch click', function(){
		$('#sendcodePoP').hide();
	});
	//获取手机验证码
	$('#sendcodegetbtn').on('touch click', function() {
		var mobile = $('#sendcodemobile').val();
		var mobilepreg=/[0-9*]{11}/;
		if(!mobilepreg.exec(mobile)){
			alert('手机号码格式错误！');
			$('#sendcodemobile').focus();
			return false;
		}
		$("#sendcodegetbtn").attr("disabled", true);
		$("#sendcodegetbtn").html("已发送");
		codecountdown();
		$.get('/sendcode?mobile='+mobile, function(result) {
			if(!result.success) {
				alert(result.msg);
			}
		}, 'json');
	});
	//验证手机验证码
	$('#sendcodesubmit').on('touch click', function() {
		var mobile = $('#sendcodemobile').val();
		var code = $('#usercode').val();
		var mobilepreg=/[0-9*]{11}/;
		if(!mobilepreg.exec(mobile)){
			alert('手机号码格式错误！');
			$('#usermobile').focus();
			return false;
		}
		if(!code || !/\d{6}/.test(code)) {
			alert('验证码错误！');
			$('#usercode').focus();
			return false;
		}
		$.get('/getcode?mobile='+mobile+'&code='+code, function(result) {
			if(result.success) {
				$('#sendcodePoP').hide();
				$.cookie('check_status', 1);
				triggerobj.trigger('click');
			} else {
				alert(result.msg);
			}
		}, 'json');
	});
	/**
	 *模糊搜索功能
	 */
	$('#fuzzyMobileForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		if(pid > 0) {
			$.getJSON('/misc/city?pid=' + pid, function(json){ 
				var city = $("#fuzzyMobileForm select[name=city]");
				$("option", city).remove();
				$.each(json,function(index, array) { 
					var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
					city.append(option); 
				}); 
			});
		} else {
			var city = $("#fuzzyMobileForm select[name=city]");
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	$('#fuzzyMobileForm input[type=button].button').on('touch click', function(){
		//if($.cookie('check_status') != 1) {
			//triggerobj = $(this);
			//$('#sendcodePoP').show();
			//return false;
		//}
		var m1 = 0;
		if($('#fuzzyMobileForm input[type=checkbox][name=m1].dan_active').length) {
			m1 = $('#fuzzyMobileForm input[type=checkbox][name=m1].dan_active').val();
		}
		var m2 = 0;
		if($('#fuzzyMobileForm input[type=checkbox][name=m2].dan_active').length) {
			m2 = $('#fuzzyMobileForm input[type=checkbox][name=m2].dan_active').val();
		}
		var m3 = 0;
		if($('#fuzzyMobileForm input[type=checkbox][name=m3].dan_active').length) {
			m3 = $('#fuzzyMobileForm input[type=checkbox][name=m3].dan_active').val();
		}
		var m4 = 0;
		if($('#fuzzyMobileForm input[type=checkbox][name=m4].dan_active').length) {
			m4 = $('#fuzzyMobileForm input[type=checkbox][name=m4].dan_active').val();
		}
		var province = $('#fuzzyMobileForm select[name=province]').val();
		var cityid = $("#fuzzyMobileForm select[name=city]").val();
		var mobile = $("#fuzzyMobileForm input[type=number]").val();
		var manager = '&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4;
		var url = '/shouji/search.htm?stype=first&mobile='+mobile+'&province='+province+'&city='+cityid+manager;
		if($("#fuzzyMobileForm select[name=grade]").length > 0) {
			url += '&grade='+$("#fuzzyMobileForm select[name=grade]").val();
		}
		if($("#fuzzyMobileForm select[name=pricescope]").length > 0) {
			url += '&pricescope='+$("#fuzzyMobileForm select[name=pricescope]").val();
		}
		window.location = url;
	});
	
	/**
	 *精确搜索
	 */
	$('#mobileForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		if(pid > 0) {
			$.getJSON('/misc/city?pid=' + pid, function(json){ 
				var city = $("#mobileForm select[name=city]");
				$("option", city).remove();
				$.each(json,function(index, array) { 
					var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
					city.append(option); 
				}); 
			});
		} else {
			var city = $("#mobileForm select[name=city]");
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	if($('#mobileForm input[type=number]').length > 0) {
		var oldkey;
		for(var i = 1; i < 11; i++) {
			$('#mobileForm input[name=p' + i + ']').bind('focus', function() {
				oldkey = $(this).val();
				if(oldkey) {
					oldkey = parseInt(oldkey);
				}
			});
			$('#mobileForm input[name=p' + i + ']').bind('keyup', function(event) {
				var val = parseInt($(this).val());
				if(val < 0 || val > 9) {
					$(this).val('');
				}
				var index = parseInt($(this).attr('name').replace('p', ''));
				var next = index + 1;
				var pre = index - 1;
				if (event.which == 8) {
					if($(this).val().length > 0) {
						$(this).val('');
					} else {
						$('#mobileForm input[name=p' + pre + ']').focus().val('');
					}
				} else if (event.which == 37) {//左
					$('#mobileForm input[name=p' + pre + ']').focus();
				} else if (event.which == 39) {//右
					$('#mobileForm input[name=p' + next + ']').focus();
				} else {
					if(typeof(oldkey) == 'number' && oldkey >=0) {
						if(event.which >=48 && event.which<=57) {
							var num = String.fromCharCode(event.which);
						} else {
							var num = '';	
						}
					} else {
						var num = $(this).val();
					}
					num = num.replace(/[^\d]/g, '');
					$(this).val(num);
					if(num != '') {
						$('#mobileForm input[name=p' + next + ']').focus();
					}
				}
			});
		}
	}
	$('#mobileForm input[type=button].button').on('touch click', function(){
		//if($.cookie('check_status') != 1) {
			//triggerobj = $(this);
			//$('#sendcodePoP').show();
			//return false;
		//}
		var m1 = 0;
		if($('#mobileForm input[type=checkbox][name=m1].dan_active').length) {
			m1 = $('#mobileForm input[type=checkbox][name=m1].dan_active').val();
		}
		var m2 = 0;
		if($('#mobileForm input[type=checkbox][name=m2].dan_active').length) {
			m2 = $('#mobileForm input[type=checkbox][name=m2].dan_active').val();
		}
		var m3 = 0;
		if($('#mobileForm input[type=checkbox][name=m3].dan_active').length) {
			m3 = $('#mobileForm input[type=checkbox][name=m3].dan_active').val();
		}
		var m4 = 0;
		if($('#mobileForm input[type=checkbox][name=m4].dan_active').length) {
			m4 = $('#mobileForm input[type=checkbox][name=m4].dan_active').val();
		}
		var manager = 'm1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4;
		var url = '/shouji/search.htm?stype=precision&'+manager;
		for(var i = 1; i < 11; i++) {
			n = $('#mobileForm input[name=p' + i + ']').val();
			if(n.length > 0) {
				url += '&p' + i + '=' + n;
			}
		}
		if($('#mobileForm select[name=province]').length > 0) {
			url += '&province='+ $('#mobileForm select[name=province]').val();
		}
		if($("#mobileForm select[name=city]").length > 0) {
			url += '&city='+$("#mobileForm select[name=city]").val();
		}
		if($("#mobileForm select[name=grade]").length > 0) {
			url += '&grade='+$("#mobileForm select[name=grade]").val();
		}
		if($("#mobileForm select[name=pricescope]").length > 0) {
			url += '&pricescope='+$("#mobileForm select[name=pricescope]").val();
		}
		window.location = url;
	});

	//电话号码模糊搜索
	$('#mhDianhuaForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		var city = $("#mhDianhuaForm select[name=city]");
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				$('#showcity').css('display', 'none');
				var option = "<option value='"+pid+"' selected ></option>"; 
				city.append(option);
			} else {
				$('#showcity').css('display', '');
				$.getJSON('/misc/city?pid=' + pid, function(json){ 
					$("option", city).remove();
					$.each(json,function(index, array) { 
						var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
						city.append(option); 
					}); 
				});
			}
		} else {
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	$('#mhDianhuaForm input[type=button].button').on('touch click', function(){	
		var manager = '';
		if($('#mhDianhuaForm input[type=checkbox][name=m1].dan_active').length) {
			var m1 = $('#mhDianhuaForm input[type=checkbox][name=m1].dan_active').val();
			manager += '&m1=' + m1;
		}
		if($('#mhDianhuaForm input[type=checkbox][name=m2].dan_active').length) {
			var m2 = $('#mhDianhuaForm input[type=checkbox][name=m2].dan_active').val();
			manager += '&m2=' + m2;
		}
		if($('#mhDianhuaForm input[type=checkbox][name=m3].dan_active').length) {
			var m3 = $('#mhDianhuaForm input[type=checkbox][name=m3].dan_active').val();
			manager += '&m3=' + m3;
		}
		
		var province = $('#mhDianhuaForm select[name=province]').val();
		var cityid = $("#mhDianhuaForm select[name=city]").val();
		var telephone = $("#mhDianhuaForm input[type=number]").val();
		var grade = $('#mhDianhuaForm select[name=grade]').val();
		var price = $('#mhDianhuaForm select[name=price]').val();
		if(!grade) {
			grade = '';
		} else {
			grade = '&grade='+grade;
		}
		if(!price) {
			price = '';
		} else {
			price = '&price='+price;
		}
		var url = '/dianhua/search.htm?telephone='+telephone+manager+'&province='+province+'&city='+cityid+grade+price;
		window.location = url;
	});
	
	/**
	 *400Js start
	 */
	var fourSearch_slide = new Swiper('#fourSearch_slide',{
		speed:500,
		onSlideChangeStart: function(){
			$("#fourSearch .tabs .active").removeClass('active');
			$("#fourSearch .tabs a").eq(fourSearch_slide.activeIndex).addClass('active');
		}
	});
	$("#fourSearch .tabs a").on('touchstart mousedown', function(e){
		e.preventDefault();
		$("#fourSearch .tabs .active").removeClass('active');
		$(this).addClass('active');
		fourSearch_slide.slideTo( $(this).index() );
	})
	if(typeof(precisionSearchFour) != "undefined" && precisionSearchFour) {
		fourSearch_slide.slideTo(1);
	}
	$("#fourSearch .tabs a").click(function(e){
		e.preventDefault();
	});
	
	$('#fuzzyFourForm input[type=button].button').on('touch click', function(){
		var manager = '';
		var m1 = 0;
		if($('#fuzzyFourForm input[type=checkbox][name=m1].dan_active').length) {
			m1 = $('#fuzzyFourForm input[type=checkbox][name=m1].dan_active').val();
			manager += '&m1='+m1;
		}
		var m2 = 0;
		if($('#fuzzyFourForm input[type=checkbox][name=m2].dan_active').length) {
			m2 = $('#fuzzyFourForm input[type=checkbox][name=m2].dan_active').val();
			manager += '&m2='+m2;
		}
		var m3 = 0;
		if($('#fuzzyFourForm input[type=checkbox][name=m3].dan_active').length) {
			m3 = $('#fuzzyFourForm input[type=checkbox][name=m3].dan_active').val();
			manager += '&m3='+m3;
		}
		if(manager.length < 1) {
			manager += '&';
		}
		var name = '';
		var head = '';
		var h1 = 0;
		name = 'h1';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h1 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h1;
		}
		var h2 = 0;
		name = 'h2';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h2 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h2;
		}
		var h3 = 0;
		name = 'h3';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h3 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h3;
		}
		var h4 = 0;
		name = 'h4';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h4 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h4;
		}
		var h5 = 0;
		name = 'h5';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h5 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h5;
		}
		var h6 = 0;
		name = 'h6';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h6 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h6;
		}
		var h7 = 0;
		name = 'h7';
		if($('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h7 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h7;
		}
		var key = $("#fuzzyFourForm input[type=number]").val();
		var url = '/400/search.htm?stype=first&key='+key;
		if(manager.length > 1) {
			url += manager;
		}
		if(head.length > 1) {
			url += head;
		}
		if($("#fuzzyFourForm select[name=grade]").length > 0) {
			url += '&grade='+$("#fuzzyFourForm select[name=grade]").val();
		}
		if($("#fuzzyFourForm select[name=pricescope]").length > 0) {
			url += '&pricescope='+$("#fuzzyFourForm select[name=pricescope]").val();
		}
		if($("#fuzzyFourForm select[name=aprm]").length > 0) {
			url += '&aprm='+$("#fuzzyFourForm select[name=aprm]").val();
		}
		window.location = url;
	});
	
	/**
	 *精确搜索
	 */
	if($('#fourForm input[type=number]').length > 0) {
		var oldfour;
		for(var i = 1; i < 8; i++) {
			$('#fourForm input[name=p' + i + ']').bind('focus', function() {
				oldfour = $(this).val();
				if(oldfour) {
					oldfour = parseInt(oldfour);
				}
			});
			$('#fourForm input[name=p' + i + ']').bind('keyup', function(event) {
				var val = parseInt($(this).val());
				if(val < 0 || val > 9) {
					$(this).val('');
				}
				var index = parseInt($(this).attr('name').replace('p', ''));
				var next = index + 1;
				var pre = index - 1;
				if (event.which == 8) {
					if($(this).val().length > 0) {
						$(this).val('');
					} else {
						$('#fourForm input[name=p' + pre + ']').focus().val('');
					}
				} else if (event.which == 37) {//左
					$('#fourForm input[name=p' + pre + ']').focus();
				} else if (event.which == 39) {//右
					$('#fourForm input[name=p' + next + ']').focus();
				} else {
					if(typeof(oldfour) == 'number' && oldfour >=0) {
						if(event.which >=48 && event.which<=57) {
							var num = String.fromCharCode(event.which);
						}
					} else {
						var num = $(this).val();
					}
					num = num.replace(/[^\d]/g, '');
					$(this).val(num);
					if(num != '') {
						$('#fourForm input[name=p' + next + ']').focus();
					}
				}
			});
		}
	}
	
	$('#fourForm input[type=button].button').on('touch click', function(){
		var manager = '';
		var m1 = 0;
		if($('#fourForm input[type=checkbox][name=m1].dan_active').length) {
			m1 = $('#fourForm input[type=checkbox][name=m1].dan_active').val();
			manager += '&m1='+m1;
		}
		var m2 = 0;
		if($('#fourForm input[type=checkbox][name=m2].dan_active').length) {
			m2 = $('#fourForm input[type=checkbox][name=m2].dan_active').val();
			manager += '&m2='+m2;
		}
		var m3 = 0;
		if($('#fourForm input[type=checkbox][name=m3].dan_active').length) {
			m3 = $('#fourForm input[type=checkbox][name=m3].dan_active').val();
			manager += '&m3='+m3;
		}
		if(manager.length < 1) {
			manager += '&';
		}
		var name = '';
		var head = '';
		var h1 = 0;
		name = 'h1';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h1 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h1;
		}
		var h2 = 0;
		name = 'h2';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h2 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h2;
		}
		var h3 = 0;
		name = 'h3';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h3 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h3;
		}
		var h4 = 0;
		name = 'h4';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h4 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h4;
		}
		var h5 = 0;
		name = 'h5';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h5 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h5;
		}
		var h6 = 0;
		name = 'h6';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h6 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h6;
		}
		var h7 = 0;
		name = 'h7';
		if($('#fourForm input[type=checkbox][name='+name+'].dan_active').length) {
			h7 = $('#fuzzyFourForm input[type=checkbox][name='+name+'].dan_active').val();
			head += '&'+name+'='+h7;
		}
		var url = '/400/search.htm?stype=precision';
		if(manager.length > 1) {
			url += manager;
		}
		if(head.length > 1) {
			url += head;
		}
		if($("#fourForm select[name=grade]").length > 0) {
			url += '&grade='+$("#fourForm select[name=grade]").val();
		}
		if($("#fourForm select[name=pricescope]").length > 0) {
			url += '&pricescope='+$("#fourForm select[name=pricescope]").val();
		}
		if($("#fourForm select[name=aprm]").length > 0) {
			url += '&aprm='+$("#fourForm select[name=aprm]").val();
		}
		for(var i = 1; i < 8; i++) {
			var n = $('#fourForm input[name=p' + i + ']').val();
			if(n.length > 0) {
				url += '&p' + i + '=' + n;
			}
		}
		window.location = url;
	});
	/**
	 *400Js END
	 */
	 /**
	 *qq精确搜索
	 */
	 $('#mhQqForm input[type=button].button').on('touch click', function(){	
		var qq = $("#mhQqForm input[type=number]").val();
		var level = $("#mhQqForm select[name=level]").val();
		var price = $('#mhQqForm select[name=price]').val();
		var vip = $('#mhQqForm select[name=vip]').val();
		var secret = $('#mhQqForm select[name=secret]').val();
		var grade = $('#mhQqForm select[name=grade]').val();
		var tail = $('#mhQqForm input[name=tail].dan_active').val();
		
		if(!level) {
			level = 0;
		}
		if(!price) {
			price = -1;
		}
		if(!vip) {
			vip = -1;
		}
		if(!secret) {
			secret = -1;
		}
		if(!grade) {
			grade = -1;
		}
		if(!tail) {
			tail = 0;
		}
		var url = '/qq/search.htm?qq='+qq+'&level='+level+'&price='+price+'&vip='+vip+'&secret='+secret+'&grade='+grade+'&tail='+tail;
		for(var i = 5; i < 13; i++) {
			var n = $('#mhQqForm input[name=n' + i + '].dan_active');
			if(n.length > 0) {
				url += '&n' + i + '=' + n.val();
			}
		}
		window.location = url;
	});
	 /**
	 *qq精确搜索结束
	 */
	/**
	 *车牌Js Start
	 */
	var carSearch_slide = new Swiper('#carSearch_slide',{
		speed:500,
		onSlideChangeStart: function(){
			$("#carSearch .tabs .active").removeClass('active');
			$("#carSearch .tabs a").eq(carSearch_slide.activeIndex).addClass('active');
		}
	});
	$("#carSearch .tabs a").on('touchstart mousedown', function(e){
		e.preventDefault();
		$("#carSearch .tabs .active").removeClass('active');
		$(this).addClass('active');
		carSearch_slide.slideTo( $(this).index() );
	})
	if(typeof(precisionSearchCar) != "undefined" && precisionSearchCar) {
		carSearch_slide.slideTo(1);
	}
	$("#carSearch .tabs a").click(function(e){
		e.preventDefault();
	});
	
	$('select[name=province]').bind('change', function(){
		var province = $(this);
		var pid = $(this).val();
		if(pid > 0) {
			var type = $(this).find("option").not(function(){ return !this.selected }).attr('type');
			$.getJSON('/misc/citycarhead?pid=' + pid+'&type='+type, function(json){ 
				var city = province.parent().find('select[name=city]');
				$("option", city).remove();
				if(type == 2) {
					$.each(json.citys, function(index, item) {
						if(index < 1) {
							var html = '';
							var heads = item.plate.split(',');
							for(var i = 0; i < heads.length; i++) {
								var v = heads[i].split('|');
								html += '<input class="dan dan_active" type="checkbox" value="'+v[1]+'" />'+v[0];
							}
							province.parent().parent().find(".carsearheadscheckbox").html(html);
							province.parent().parent().find(".carsearheadscheckbox input[type=checkbox].dan").each(function(index,item) {
								$(this).on('touch click', function() {
									if(!$(this).hasClass('dan_active')) {
										$(this).addClass('dan_active');
									} else if($(this).hasClass('dan_active')) {
										$(this).removeClass('dan_active');
									}
									return true;
								});
							});
						}
						var option = "<option value='"+item['id']+"' plate='"+item['plate']+"'>"+item['name']+"</option>"; 
						city.append(option); 
					});
				} else {
					var option = '<option value="-1" plate="">不限城市</option>'; 
					city.append(option);
					var html = '';
					$.each(json.heads, function(index, item) {
						html += '<input class="dan dan_active" type="checkbox" value="'+item.val+'" />'+item.name;
					});
					province.parent().parent().find(".carsearheadscheckbox").html(html);
					province.parent().parent().find(".carsearheadscheckbox input[type=checkbox].dan").each(function(index,item) {
						$(this).on('touch click', function() {
							if(!$(this).hasClass('dan_active')) {
								$(this).addClass('dan_active');
							} else if($(this).hasClass('dan_active')) {
								$(this).removeClass('dan_active');
							}
							return true;
						});
					});
				}
			});
		} else {
			var city = $(this).parent().find('select[name=city]');
			$("option", city).remove();
			var option = '<option value="-1" plate="">不限城市</option>'; 
			city.append(option);
			$(this).parent().parent().find(".carsearheadscheckbox").html('不限号段');
		}
	});
	$('select[name=city]').bind('change', function() {
		if($(this).val() > 0) {
			var html = '';
			var heads = $(this).find("option").not(function(){ return !this.selected }).attr('plate');
			heads = heads.split(',');
			for(var i = 0; i < heads.length; i++) {
				var item = heads[i].split('|');
				html += '<input class="dan dan_active" type="checkbox" value="'+item[1]+'" />'+item[0];
			}
			$(this).parent().parent().find(".carsearheadscheckbox").html(html);
			$(this).parent().parent().find(".carsearheadscheckbox input[type=checkbox].dan").each(function(index,item) {
				$(this).on('touch click', function() {
					if(!$(this).hasClass('dan_active')) {
						$(this).addClass('dan_active');
					} else if($(this).hasClass('dan_active')) {
						$(this).removeClass('dan_active');
					}
					return true;
				});
			});
		}
	});
	$('#fuzzyCarForm input[type=text]').on('keyup change', function(){
		var num = $(this).val();
		num.replace(/[^\w]/g, '');
		num = num.toUpperCase();
		$(this).val(num);
	});
	$('#fuzzyCarForm input[type=button].button').on('touch click', function(){
		var url = '/chepai/search.htm?key=' + $('#fuzzyCarForm input[type=text]').val();
		var pid = $('#fuzzyCarForm select[name=province]').val();
		var cityid = $('#fuzzyCarForm select[name=city]').val();
		url += '&cityid='+cityid+'&pid='+pid;
		var i=1;
		$("#fuzzyCarForm .carsearheadscheckbox input[type=checkbox].dan_active").each(function(index,item) {
			url += '&h' + i + '=' + $(this).val();
			i+= 1;
		});
		window.location = url;
	});
	
	/**
	 *精确搜索
	 */
	if($('#carForm input[type=text]').length > 0) {
		for(var i = 1; i < 6; i++) {
			var oldcar;
			$('#carForm input[name=p' + i + ']').bind('focus', function() {
				oldcar = $(this).val();
			});
			$('#carForm input[name=p' + i + ']').bind('keyup', function(event) {
				var val = parseInt($(this).val());
				var index = parseInt($(this).attr('name').replace('p', ''));
				var next = index + 1;
				var pre = index - 1;
				if (event.which == 8) {
					if($(this).val().length > 0) {
						$(this).val('');
					} else {
						$('#carForm input[name=p' + pre + ']').focus().val('');
					}
				} else if (event.which == 37) {//左
					$('#carForm input[name=p' + pre + ']').focus();
				} else if (event.which == 39) {//右
					$('#carForm input[name=p' + next + ']').focus();
				} else {
					if(typeof(oldcar) != 'undefined' && oldcar) {
						var num = String.fromCharCode(event.which);
					} else {
						var num = $(this).val();
					}
					num = num.replace(/[^\w]/g, '');
					num = num.toUpperCase();
					$(this).val(num);
					if(num != '') {
						$('#carForm input[name=p' + next + ']').focus();
					}
				}
			});
		}
	}
	
	$('#carForm input[type=button].button').on('touch click', function(){
		var url = '/chepai/search.htm?stype=precision';
		var pid = $('#carForm select[name=province]').val();
		var cityid = $('#carForm select[name=city]').val();
		url += '&cityid='+cityid+'&pid='+pid;
		for(var i = 1; i < 6; i++) {
			var n = $('#carForm input[name=p' + i + ']').val();
			if(n.length > 0) {
				url += '&p' + i + '=' + n;
			}
		}
		var i=1;
		$("#carForm .carsearheadscheckbox input[type=checkbox].dan_active").each(function(index,item) {
			url += '&h' + i + '=' + $(this).val();
			i+= 1;
		});
		window.location = url;
	});
	/**
	 *车牌Js END
	 */
	 /**
	 *号码定制城市效果
	 */
	 $('#bookForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		var city = $("#bookForm select[name=city]");
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				$('#showcity').css('display', 'none');
				var option = "<option value='"+pid+"' selected ></option>"; 
				city.append(option);
			} else {
				$('#showcity').css('display', '');
				$.getJSON('/misc/city?pid=' + pid, function(json){
					$("option", city).remove();
					$.each(json,function(index, array) { 
						var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
						city.append(option); 
					}); 
				});	
			}
		} else {
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	 /**
	 *号模点赞
	 */
	 $('.dianzan').on('touch mousedown', function() {
		var id = $(this).attr('haomoid');
		$.getJSON('/mobile/haomo/dianzan?id=' + id, function(result) {
			if(result.result) {
				var digs = eval($('#zan'+id).text())+1;
				$('#zan'+id).html(digs);
			}
		});
	});
	 /**
	 *号模评论
	 */
	 $('.haomoPl input[type=button].pl').on('touch mousedown', function() {
		var modelid = $(this).attr('modelid');
		var content = $('#content_'+modelid).val();
		$.getJSON('/mobile/haomo/discuss?modelid=' + modelid + '&content=' + content, function(result) {
			if(result.result) {
				var pinglun = '<p><span>' + result.nick + '：</span>' + result.content + '</p>';
				$('#model_pl_more_'+modelid).append(pinglun);
				$('.haomoPl input[class=py]').val('');
				
			} else {
				if(result.message){
					alert(result.message);
				}
			}
		});
	});
	$('a.nofinished').on('touch click', function() {
		$('#nofinished').show();
	});
	$('#nofinished a.close').on('touch click', function(){
		$('#nofinished').hide();
	});
	var logging = false;
	$('a.loginer').on('touch click', function() {
		if(!$(this).hasClass('active')) {
			//$('#login_pop').show();
		}
	});
	$('#login_pop a.close').on('touch click', function(){
		$('#login_pop').hide();
	});
	$('#login_pop input[type=submit].btn').on('click', function(){
		if(!logging) {
			var username = $('#login_pop input[name=username]').val();
			var password = $('#login_pop input[name=password]').val();
			if(username.length < 1) {
				alert('请输入手机号/门牌号!');
				return false;
			}
			if(password.length < 5) {
				alert('请输入密码!');
				return false;
			}
			logging = true;
			$.post('/logging?ajax=1', { username: username, password: password}, function(result){
				if(result.success == true) {
					alert(result.msg);
				}
				logging = false;
			});
		}
	});
	/**
	 *qq估价
	 */
	 $('#qqGujiaForm input[type=submit].jx-btn').on('touch click', function(){	
		var str = /^[1-9][0-9]{4,12}$/;
		var qq = $("#qqGujiaForm input[name=qq]").val();
		if(!str.exec(qq)){
			alert('qq号码格式错误！');
			return false;
		}
		var level = 0;
		level = $("#qqGujiaForm select[name=level]").val();
		var url = '/qq/gujia/'+qq+'-'+level+'.htm';
		window.location = url;
		return false;
	});
	 /**
	 *qq估价结束
	 */ 
	 /**
	 *qq吉凶
	 */
	 $('#qqJixiongForm input[type=submit].jx-btn').on('touch click', function(){	
		var qq = $("#qqJixiongForm input[name=qq]").val();
		var str = /^[1-9][0-9]{4,12}$/;
		if(!str.exec(qq)){
			alert('qq号码格式错误！');
			return false;
		}
		var url = '/qq/jixiong/'+qq+'.htm';
		window.location = url;
		return false;
	});
	 /**
	 *qq吉凶结束
	 */
	 /**
	 *区号城市搜索
	 */ 
	 $('#quhaoForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		var city = $("#quhaoForm select[name=city]");
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				$('#showcity').css('display', 'none');
				var option = "<option value='"+pid+"' selected ></option>"; 
				city.append(option);
			} else {
				$('#showcity').css('display', '');
				$.getJSON('/misc/city?pid=' + pid, function(json){ 
					$("option", city).remove();
					$.each(json,function(index, array) { 
						var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
						city.append(option); 
					}); 
				});	
			}
			
		} else {
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	 /*
	 *区号城市搜索结束
	 */
	 /**
	 *店铺号搜索
	 */
	 $('#shopidForm input[type=button].button').on('touch click', function(){	
		var key = $("#shopidForm input[name=key]").val();
		var grade = $("#shopidForm select[name=grade]").val();
		var havefour = $('#shopidForm input[name=havefour].dan_active').val();
		var location = $('#shopidForm select[name=location]').val();
		if(!havefour) {
			havefour = 0;
		}
		var url = '/shopid/?key='+key+'&grade='+grade+'&havefour='+havefour+'&location='+location;
		for(var i = 1; i < 7; i++) {
			var n = $('#shopidForm input[name=n' + i + '].dan_active');
			if(n.length > 0) {
				url += '&n' + i + '=' + n.val();
			}
		}
		window.location = url;
	});
	 /**
	 *店铺号搜索结束
	 */
	 
	 /**
	 *收购
	 */
	 $('#chushou select[name=province]').on('change', function() {
		var pid = $(this).val();
		if(pid > 0) {
			$.getJSON('/misc/city?pid=' + pid, function(json){ 
				var city = $("#chushou select[name=city]");
				$("option", city).remove();
				$.each(json,function(index, array) { 
					var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
					city.append(option); 
				}); 
			});
		} else {
			var city = $("#chushou select[name=city]");
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	/**
	 *手机号码估价
	 */
	 $('#mobileGujiaForm input[type=submit]').on('touch click', function(){	
		var str =/^1[3|4|5|7|8][0-9]{9}$/;
		var mobile = $("#mobileGujiaForm input[name=mobile]").val();
		if(!str.exec(mobile)){
			alert('请输入正确的手机号码！');
			return false;
		}
		var url = '/gujia/' + mobile + '.htm';
		window.location = url;
		return false;
	});
	/**
	 *手机号码吉凶
	 */
	 $('#mobileJixiongForm input[type=submit]').on('touch click', function(){	
		var str =/^1[3|4|5|7|8][0-9]{9}$/;
		var mobile = $("#mobileJixiongForm input[name=mobile]").val();
		if(!str.exec(mobile)){
			alert('请输入正确的手机号码！');
			return false;
		}
		var url = '/jixiong/' + mobile + '.htm';
		window.location = url;
		return false;
	});
	/**
	 *手机号码归属地
	 */
	 $('#mobileAttributionForm input[type=submit]').on('touch click', function(){	
		var str =/^1[3|4|5|7|8][0-9]{9}$/;
		var mobile = $("#mobileAttributionForm input[name=mobile]").val();
		if(!str.exec(mobile)){
			alert('请输入正确的手机号码！');
			return false;
		}
		var url = '/guishudi/' + mobile + '.htm';
		window.location = url;
		return false;
	});
	
	/**
	 *经纪人搜索功能
	 */
	if($('#gradew').length>0) {
		$('#gradew li').on('touch click', function() {
			var key = $("#escrowform input[name=key]").val();
			var userid = $("#escrowform input[name=userid]").val();
			var manager = $("#escrowform input[name=manager]").val();
			var pricescope = $("#escrowform input[name=pricescope]").val();
			var grade = $("#escrowform input[name=grade]").val();
			
			if(userid < 1) {
				var url = '/escrow/search.htm?manager='+manager+'&pricescope='+pricescope+'&grade='+grade+'&key='+key;
			} else {
				var url = '/escrow/'+userid+'/search.htm?manager='+manager+'&pricescope='+pricescope+'&grade='+grade+'&key='+key;
			}
			var pid = $(this).attr('pid');
			var city = $("#gradet");
			city.html('');
			if(pid > 0) {
				if(pid < 5) {
					window.location = url + '&cityid='+pid;
				} else {
					$.getJSON('/misc/city?pid=' + pid, function(json){
						$.each(json,function(index, array) { 
							var option = '<li><a href="'+url+'&cityid='+array['id']+'">' + array['name'] + '</a></li>'; 
							city.append(option); 
						}); 
					});	
				}
			} else {
				window.location = url + '&cityid=0';
			}
			return false;
		});
	}
	$('#escrowform input[type=button].button').on('touch click', function(){
		var tail = 0;
		if($('#escrowform input[type=checkbox][name=tail].dan_active').length) {
			tail = 1;
		}
		var key = $("#escrowform input[name=key]").val();
		var cityid = $("#escrowform input[name=cityid]").val();
		var manager = $("#escrowform input[name=manager]").val();
		var pricescope = $("#escrowform input[name=pricescope]").val();
		var grade = $("#escrowform input[name=grade]").val();
		var url = '/escrow/search.htm?cityid='+cityid+'&manager='+manager+'&pricescope='+pricescope+'&grade='+grade+'&key='+key+'&tail='+tail;
		window.location = url;	
	});
	
		
	/*内部手机号搜索*/
	$('#sjblurForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		if(pid > 0) {
			$.getJSON('/misc/city?pid=' + pid, function(json){ 
				var city = $("#sjblurForm select[name=city]");
				$("option", city).remove();
				var option = '<option value="0">选择城市</option>';
				city.append(option);
				$.each(json,function(index, array) { 
					option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
					city.append(option); 
				}); 
			});
		} else {
			var city = $("#sjblurForm select[name=city]");
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	$('#sjprcciseForm select[name=province]').on('change', function() {
		var pid = $(this).val();
		if(pid > 0) {
			$.getJSON('/misc/city?pid=' + pid, function(json){ 
				var city = $("#sjprcciseForm select[name=city]");
				$("option", city).remove();
				var option = '<option value="0">选择城市</option>';
				city.append(option);
				$.each(json,function(index, array) { 
					option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
					city.append(option); 
				}); 
			});
		} else {
			var city = $("#sjprcciseForm select[name=city]");
			$("option", city).remove();
			var option = '<option value="-1">不限城市</option>'; 
			city.append(option); 
		}
	});
	if($('#sjprcciseForm input[type=number]').length > 0) {
		var oldkey;
		for(var i = 1; i < 11; i++) {
			$('#sjprcciseForm input[name=p' + i + ']').bind('focus', function() {
				oldkey = $(this).val();
				if(oldkey) {
					oldkey = parseInt(oldkey);
				}
			});
			$('#sjprcciseForm input[name=p' + i + ']').bind('keyup', function(event) {
				var val = parseInt($(this).val());
				if(val < 0 || val > 9) {
					$(this).val('');
				}
				var index = parseInt($(this).attr('name').replace('p', ''));
				var next = index + 1;
				var pre = index - 1;
				if (event.which == 8) {
					if($(this).val().length > 0) {
						$(this).val('');
					} else {
						$('#sjprcciseForm input[name=p' + pre + ']').focus().val('');
					}
				} else if (event.which == 37) {//左
					$('#sjprcciseForm input[name=p' + pre + ']').focus();
				} else if (event.which == 39) {//右
					$('#sjprcciseForm input[name=p' + next + ']').focus();
				} else {
					if(typeof(oldkey) == 'number' && oldkey >=0) {
						if(event.which >=48 && event.which<=57) {
							var num = String.fromCharCode(event.which);
						} else {
							var num = '';	
						}
					} else {
						var num = $(this).val();
					}
					num = num.replace(/[^\d]/g, '');
					$(this).val(num);
					if(num != '') {
						$('#sjprcciseForm input[name=p' + next + ']').focus();
					}
				}
			});
		}
	}
	/*运营商号码*/
	$('#operatorsform input[type=button].button').on('touch click', function(){
		var tail = 0;
		if($('#operatorsform input[type=checkbox][name=tail].dan_active').length) {
			tail = 1;
		}
		var key = $("#operatorsform input[name=key]").val();
		var cityid = $("#operatorsform input[name=cityid]").val();
		var pricescope = $("#operatorsform input[name=pricescope]").val();
		var grade = $("#operatorsform input[name=grade]").val();
		var operatorsid = $("#operatorsform input[name=operatorsid]").val();
		var url = '/operators-'+operatorsid+'/search.htm?cityid='+cityid+'&pricescope='+pricescope+'&grade='+grade+'&key='+key+'&tail='+tail;
		window.location = url;	
	});
	if($('#operatorscity').length>0) {
		$('#operatorscity li').on('touch click', function() {
			var key = $("#operatorsform input[name=key]").val();
			var operatorsid = $("#operatorsform input[name=operatorsid]").val();
			var pricescope = $("#operatorsform input[name=pricescope]").val();
			var grade = $("#operatorsform input[name=grade]").val();
			
			var url = '/operators-'+operatorsid+'/search.htm?pricescope='+pricescope+'&grade='+grade+'&key='+key;
			var pid = $(this).attr('pid');
			var city = $("#gradet");
			city.html('');
			if(pid > 0) {
				if(pid < 5) {
					window.location = url + '&cityid='+pid;
				} else {
					$.getJSON('/misc/city?pid=' + pid, function(json){
						$.each(json,function(index, array) { 
							var option = '<li><a href="'+url+'&cityid='+array['id']+'">' + array['name'] + '</a></li>'; 
							city.append(option); 
						}); 
					});	
				}
			} else {
				window.location = url + '&cityid=0';
			}
			return false;
		});
	}
});