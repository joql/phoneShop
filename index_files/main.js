
//--------------------------------------------------------- 
$(function(){
	$(".menu li").hover(function(){
			$(this).addClass("hover");
			$(this).children("ul li").attr('class','');
		},function(){
			$(this).removeClass("hover");  
			$(this).children("ul li").attr('class','');
		}
	); 

	//登陆用户头部显示登陆信息
	$.get('/misc/loginuser', '', function(data) {
		if(data.success) {
			$('#loginusername').html(data.user.msg);
			$('#havelogin').css('display','');
			$('#nologin').css('display','none');
		} else {
			$('#havelogin').css('display','none');
			$('#nologin').css('display','');
		}
	}, 'json');
	//显示隐藏层
	$("#yuding").click(function(){
	    $(".zxyd_ceng").show();
	 });
	 $("#closemodal").click(function(){
	   $(".zxyd_ceng").hide();
	 });
	//顶部我的收藏
	var favoritedianhua = $.cookie('favoritedianhua');
	var favorite400     = $.cookie('favorite400');
	var favoritechepai  = $.cookie('favoritechepai');
	var favoriteqq      = $.cookie('favoriteqq');
	var favoriteshouji  = $.cookie('favoriteshouji');
	if(favoriteshouji) {
		$.removeCookie('favoriteshouji', {path : "/"});
		$.cookie('favoriteshouji', favoriteshouji,{expires:10*365,path: "/",domain:'jihaoba.com'});
	}
	if(favorite400) {
		$.removeCookie('favorite400', {path : "/"});
		$.cookie('favorite400', favorite400,{expires:10*365,path: "/",domain:'jihaoba.com'});
	}
	if(favoritechepai) {
		$.removeCookie('favoritechepai', {path : "/"});
		$.cookie('favoritechepai', favoritechepai,{expires:10*365,path: "/",domain:'jihaoba.com'});
	}
	if(favoritedianhua) {
		$.removeCookie('favoritedianhua', {path : "/"});
		$.cookie('favoritedianhua', favoritedianhua,{expires:10*365,path: "/",domain:'jihaoba.com'});
	}
	if(favoriteqq) {
		$.removeCookie('favoriteqq', {path : "/"});
		$.cookie('favoriteqq', favoriteqq,{expires:10*365,path: "/",domain:'jihaoba.com'});
	}
	function appendFavorite(favoritestr,type,module) {
		var url = '/'+module+'/search.htm?favorite=1&rand='+Math.random();
		var sum = 0;
		if(favoritestr) {
			var favorite = favoritestr.split('!');
			sum = favorite.length-1;
			if(sum<0) {
				sum = 0;
			}
			$('#myFavorite').append('<div><span class="fright '+module+'"><a href="'+url+'" target="_blank">'+sum+'个</a></span><a href="'+url+'">'+type+'</a></div>');
		} else {
			$('#myFavorite').append('<div><span class="fright '+module+'"><a href="'+url+'" target="_blank">0个</a></span><a href="'+url+'" target="_blank">'+type+'</a></div>');
		}
		if($('.favorite'+module).length) {
			$('.favorite'+module).text(sum);
			$('.favorite'+module).parent().attr('href', url);
		};
	}
	
	//appendFavorite(favoriteshouji,'手机号码','shouji');
	appendFavorite(favoritedianhua,'固定电话','dianhua');
	appendFavorite(favoritechepai,'车牌靓号','chepai');
	appendFavorite(favoriteqq,'QQ靓号','qq');
	appendFavorite(favorite400,'400电话','400');
	//收藏号码cookie
	var addFavorite = function() {
		var type = $(this).attr('type');
		var key  = $(this).attr('key');
		var values = $.cookie('favorite'+type);
		if(values) {
			if(values.indexOf('!'+key)==-1) {
				values += '!'+key;
			}
		} else {
			values  = '!'+key;
		}
		$.cookie('favorite'+type,values, {expires:10*365,path: "/",domain:'jihaoba.com'});
		$(this).removeClass('addFavorite');
		$(this).addClass('removeFavorite');
		$(this).text('已收藏');
		$(this).unbind('click');
		$(this).bind('click',removeFavorite);
		var t = $('#myFavorite .'+type).text();
		var t = parseInt(t)+1;
		$('#myFavorite .'+type+' a').text(t+'个');
		$('.favorite'+type).text(t);
	}
	var removeFavorite = function() {
		var type = $(this).attr('type');
		var key  = $(this).attr('key');
		var values = $.cookie('favorite'+type);
		if(values && values.indexOf('!'+key)!=-1) {
			values = values.replace('!'+key,'');
		}
		$.cookie('favorite'+type,values, {expires:10*365,path: "/",domain:'jihaoba.com'});
		$(this).removeClass('removeFavorite');
		$(this).addClass('addFavorite');
		$(this).text('收藏');
		$(this).unbind('click');
		$(this).bind('click',addFavorite);

		var t = $('.favorite'+type).text();
		var t = parseInt(t)-1;
		if(t>=0) {
			$('#myFavorite .'+type+' a').text(t+'个');
			$('.favorite'+type).text(t);
		}
	}
	if($('.addFavorite').length) {
		var type = $('.addFavorite').eq(0).attr('type');
		var values = $.cookie('favorite'+type);
		var favorites = [];
		if(values) {
			favorites = values.split('!');
		}
		$('.addFavorite').each(function(i,ele){
			var key = $(ele).attr('key');
			for(var i=0;i<favorites.length;i++) {
				var v = favorites[i];
				if(v == key) {
					$(ele).text('已收藏');
					$(ele).removeClass('addFavorite');
					$(ele).addClass('removeFavorite');
					$(ele).bind('click',removeFavorite);
				}
			}
		});
		$('.addFavorite').bind('click',addFavorite);
	}
	 
});