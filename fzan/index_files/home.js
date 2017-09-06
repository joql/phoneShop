//选项卡切换类
function scrollDoor(){
}
scrollDoor.prototype = {
	sd : function(menus,divs,openClass,closeClass){
		var _this = this;
		if(menus.length != divs.length)
		{
			alert("菜单层数量和内容层数量不一样!");
			return false;
		}
		if(openClass == 'gg02') {
			alert(menus.length);
		}
		for(var i = 0 ; i < menus.length ; i++)
		{
			if(!_this.$(menus[i])) continue;
			_this.$(menus[i]).value = i;
			_this.$(menus[i]).onmouseover = function(){
				for(var j = 0 ; j < menus.length ; j++)
				{
					_this.$(menus[j]).className = closeClass;
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = openClass;
				_this.$(divs[this.value]).style.display = "block";
			}
		}
	},//SDmodel.sd(["n01","n02","n03"],["y01","y02","y03"],"gg01","gg02");
	$ : function(oid){
		if(typeof(oid) == "string")
			return document.getElementById(oid);
			return oid;
	}
}
/**
 * 添加一个参数到url后边
 * @param {[string]} url  [url]
 * @param {[string]} name [参数名]
 * @param {[string]} val  [参数值]
 */
function addUrlPara(url, name, value) {
    var currentUrl = url.split('#')[0];  
    if (/\?/g.test(currentUrl)) {  
    	var re = new RegExp(name+'=[^\?\&]+','gi');
        if (re.test(currentUrl)) {
            currentUrl = currentUrl.replace(re, name + "=" + value);  
        } else {  
            currentUrl += "&" + name + "=" + value;  
        }  
    } else {  
        currentUrl += "?" + name + "=" + value;  
    }  
    if (url.split('#')[1]) {  
    	return currentUrl + '#' + url.split('#')[1];  
    } else {  
    	return currentUrl;  
    }  
}
function slideDown()
{
	var currentBt = $('#slideshow_footbar .slideshow-bt.bt-on');
    if (currentBt.length <= 0) return;
    var nxt = currentBt.get(0).previousSibling;
    slideTo(nxt?nxt:$('#slideshow_footbar .slideshow-bt:last').get(0));
}

function slideTo(o)
{
	if (!o) return;
	var currentIndex = $('#slideshow_footbar .slideshow-bt.bt-on').attr('index'),
		current = $('#slideshow_photo a[index='+currentIndex+']');
	var nxt = $('#slideshow_photo a[index='+$(o).attr('index')+']');
	if (currentIndex == $(o).attr('index')) return;
	
	if (nxt.find('img[imgsrc]').length > 0)
	{
		var img =nxt.find('img[imgsrc]');
		img.attr('src',img.attr('imgsrc')).removeAttr('imgsrc');
	}
	
	$('#slideshow_footbar .slideshow-bt.bt-on').removeClass('bt-on');
	$(o).addClass('bt-on');
	
	nxt.css('z-index',2);
	
	current.css('z-index',3).fadeOut(500,function()
	{
		$(this).css('z-index','1').show();
		var img = nxt.next('a').find('img[imgsrc]');
		if (img.length > 0)
		{
			img.attr('src',img.attr('imgsrc')).removeAttr('imgsrc');
		}
	});
}
//slideshow end


//--------------------------------------------------------- 
function get_live_status(){ /* 首页直播设置 */
	var d = new Date(); //alert(d.getHours());
	if(d.getHours() <19) return; // 到19点才计时

	get_live_status_do();
	interval = window.setInterval(function(){ get_live_status_do(); }, 60000);
	//window.clearInterval(interval);	
}
function get_live_status_do(){
	$.post("/ajax/home_page.php?action=index_live", { key:'v' }, 
	function(data){	//alert(data);
		if(data !="" ){
			var pos=data.indexOf('@');
			var program_id=data.substring(0,pos);
			var tmp=data.substr(pos+1);

			var ps=tmp.indexOf('@');
			var img_url=tmp.substring(0,ps); 
			var title=tmp.substr(ps+1);

			$('#lmhd_live').show(); //显示直播div
			$('#lmhd_default').hide(); //隐藏在路上首图
			//$('#live_title').text(title);
			$('#lmhd_live_url_1').attr('href','/live/'+program_id);//直播链接
			$('#lmhd_live_url_2').attr('href','/live/'+program_id);
			$('#lmhd_live_url_3').attr('href','/live/'+program_id);
			$('#lmhd_live_src').attr('src','/'+img_url);//图片链接
		}else{
			$('#lmhd_live').hide();
			$('#lmhd_default').show();
		}
	});
}
//-------------------------------------------------------------------- 

/*获得车牌栏目车牌头*/
function get_cat_head(id) {
	var cityid = id;
	var head = '';
	if(cityid > 0) {
		$.getJSON('/misc/cararea?pid=' + cityid + '&type=1', function(data){ 
			pre = '';
			$.each(data,function(index, value) { 
				head = head + pre + value; 
				pre = ',';
			});
			$('#showcarhead').text(head);
		});
	} else {
		$('#showcarhead').text();
	}
	return true;
}

$(function(){
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
	$("#topserchfl").hover(function(){
			$(this).addClass("active");	
		},function(){
			$(this).removeClass("active");  	
		}
	); 
	$("#topserchfl2").hover(function(){
			$(this).addClass("active");	
		},function(){
			$(this).removeClass("active");  	
		}
	); 
	$('#topserchfl a').click(function(){
		//文字互换
		var text = $(this).text();
		var now  = $('#topserchfl .ad').text();
		$('#topserchfl .ad').text(text);
		$(this).text(now);
		//name互换
		var action = $(this).attr('name');
		var nowaction = $('#topserchfl .ad').attr('name');
		$('#topserchfl .ad').attr('name',action);
		$(this).attr('name',nowaction);
		$('#topserchfl').removeClass('active');
	});
	$('#topserchfl2 a').click(function(){
		//文字互换
		var text = $(this).text();
		var now  = $('#topserchfl2 .ad').text();
		$('#topserchfl2 .ad').text(text);
		$(this).text(now);
		//name互换
		var action = $(this).attr('name');
		var nowaction = $('#topserchfl2 .ad').attr('name');
		$('#topserchfl2 .ad').attr('name',action);
		$(this).attr('name',nowaction);
		$('#topserchfl2').removeClass('active');
	});
	$('#topsearchbutton').click(function() {
		var haoma = $('#topsearchhaoma').val();
		var action = $('#topserchfl .ad').attr('name');
		if(!haoma) {
			window.location.href = '/'+action+'/';
		} else {
			var regex_mobile = new RegExp(/^(\d*)$/);
			var regex_car = new RegExp(/^(\w*|\d*){1,5}$/);
			var url   ='?key='+haoma;
			
			if(action == 'chepai') {
				if(regex_car.test(haoma)) {
					window.location.href = '/'+action+'/search.htm'+url;
				} else {
					alert('号码格式错误！');
				}
			} else {
				if(regex_mobile.test(haoma)) {
					window.location.href = '/'+action+'/search.htm'+url;
				} else {
					alert('号码格式错误！');
				}
			}
			
		}
	})
	$('#topsearchhaoma').keydown(function(e){
		if(e.keyCode == 13){
			$("#topsearchbutton").click();
		}
	});
	$('#doorbutton').click(function() {
		var haoma = $('#doornumber').val();
		var action = $('#topserchfl2 .ad').attr('name');
		if(!haoma) {
			window.location.href = '/'+action+'/';
		} else {
			var regex_mobile = new RegExp(/^(\d*)$/);
			if(action == 'menpai') {
				if(regex_mobile.test(haoma)) {
					window.location.href = '/u/'+haoma;
				} else {
					alert('门牌号格式错误！');
				}
			} else {
				window.location.href = '/topvip/search.htm?shopname='+haoma;
				
			}
			
		}
	})
	$('#doornumber').keydown(function(e){
		if(e.keyCode == 13){
			$("#doorbutton").click();
		}
	});
	$("#nowpage").addClass("nowpage");
	$("#nav li").hover(function(){
			if(!$(this).hasClass('nowpage')) {
				$(this).addClass("myhover");
				$('.nowpage .childnav').hide();
			}
		},function(){
			if(!$(this).hasClass('nowpage')) {
				$(this).removeClass("myhover");
				$('.nowpage .childnav').show();
			}
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
	
	//搜索结果包含数字变色
	if($('input[name="key"]').val()) {
		var key = $('input[name="key"]').val().toUpperCase();
		$('.searchresultkey').each(function(i,ele){
			var num = $(ele).parent().text();
			var last = key.substr(-1);
			var re  = new RegExp('('+key+last+'{0,})','g');
			var newstr = num.replace(re,'<span class="red">'+"$1"+'</span>');
			$(ele).parent().html(newstr);
		});
	}
	var stype = $('input[name="stype"]').val();
	if(stype!='') {
		var indexs = [];
		var inputs = [];
		$('.fourkey').each(function(t,obj){
			var input = $(obj).val();
			if(input) {
				indexs.push(t);
				inputs.push(input);
			}
		});
		if(indexs.length) {
			$('.searchresultkey').each(function(i,ele){
				var num = $(ele).parent().text();
				if($('.favoritechepai').length) {
					num = $(ele).text();
					num = num.toUpperCase();
				}
				var init = num.length;
				for(var start=0;start<indexs.length;start++) {
					var position = indexs[start]+(num.length-init);
					var input    = inputs[start];
					if(position>0) {
						if(position-1) {
							var pre  = num.substr(0,position);
						} else {
							var pre  = num.substr(0,1);
						}
						var tail = num.substr(position+1);
						num = pre+'<span class="red">'+input+'</span>'+tail;
					} else {
						var tail = num.substr(1);
						num = '<span class="red">'+input+'</span>'+tail;
					}
				}
				if($('.favoritechepai').length) {
					$(ele).html(num);
				} else {
					$(ele).parent().html(num);
				}
			});
		}
	}
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
			$('#myFavorite').append('<div><span class="fright '+module+'"><a href="'+url+'">'+sum+'个</a></span><a href="'+url+'">'+type+'</a></div>');
		} else {
			$('#myFavorite').append('<div><span class="fright '+module+'"><a href="'+url+'">0个</a></span><a href="'+url+'">'+type+'</a></div>');
		}
		if($('.favorite'+module).length) {
			$('.favorite'+module).text(sum);
			$('.favorite'+module).parent().attr('href', url);
		};
	}
	
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
		var t = $('.favorite'+type).text();
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
	//ip定位
	function mylocation() {
		var location = $.cookie('mylocation');
		if(!location) {
			$.ajax({
		        url: "http://api.map.baidu.com/location/ip?ak=vF6jUfrk4dFruzRnC6lfk5CZ",
		        type: 'GET',
		        dataType: 'JSONP',
		        success: function (data) {
			        if(data && data.content) {
						var location = data.content.address_detail.city_code;
						$.cookie('mylocation',location, {path: "/",domain:'jihaoba.com'});
						setlocation(location);
					}
		        }
		    });
		} else {
			setlocation(location);
		}
	}
	function setlocation(location) {
		if(location) {
		    $.getJSON('/misc/mylocation?code='+location,function(info){
				if(info.success) {
					$('#mylocation').html(info.city.name);
					$('#mylocation').parent().attr('href',info.city.url);
				}
			});
		}
	}
	mylocation();

	//选项卡切换
	var SDmodel = new scrollDoor();
	SDmodel.sd(["m01","m02","m03","m04","m05","m06","m07"],["c01","c02","c03","c04","c05","c06","c07"],"sd01","sd02");
	SDmodel.sd(["n01","n02","n03"],["y01","y02","y03"],"gg01","gg02");
	//SDmodel.sd(["mmm01","mmm02"],["ccc01","ccc02"],"ssd01","ssd02");
	//总站头部手机号、店铺搜索切换
	$('#mmm01').on('click', function(){
		$('#mmm01').removeClass('ssd02');
		$('#mmm01').addClass('ssd01');
		$('#mmm02').removeClass('ssd01');
		$('#mmm02').addClass('ssd02');
		$('#ccc01').removeClass('hidden');	
		$('#ccc02').addClass('hidden');	
	});
	$('#mmm02').on('click', function(){
		$('#mmm01').removeClass('ssd01');
		$('#mmm01').addClass('ssd02');
		$('#mmm02').removeClass('ssd02');
		$('#mmm02').addClass('ssd01');
		$('#ccc01').addClass('hidden');	
		$('#ccc02').removeClass('hidden');		
	});
	//省市二级联动菜单
	$('select[name=province]').on('change', function() {
		var pid = $(this).val();
		var city = $("select[name=city]");
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				city.css('display', 'none');
				var option = "<option value='"+pid+"' selected ></option>"; 
				city.append(option);
				get_cat_head(pid);
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
	//400栏目
	SDmodel.sd(["p1","p2","p3"],["d1","d2","d3"],"hdm01","hdm02");
    SDmodel.sd(["ff1","ff2","ff3"],["four1","four2","four3"],"hdm01","hdm02");
    $('#fourchg').click(function() {
    	var p = $(this).attr('p');
    	$.get('/400/modelList.htm', {page:p}, function(data) {
    		if(data.html) {
    			$('#fourModelList').replaceWith(data.html);
    			$('#fourchg').attr('p',data.nextpage);
    		} else {
    			alert('没有更多了');
    		}
    	}, 'json');
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
	var lastkey=0;
	var oldkey;
	$('.fourkey').focus(function(){
		oldkey = $(this).val();
		if(oldkey) {
			oldkey = parseInt(oldkey);
		}
	});
	$('.fourkey').keyup(function(e) {
		var key = e.which;
		if(typeof(oldkey)=="number" && oldkey>=0) {
			if(key>=48 && key<=57) {
				$(this).val(String.fromCharCode(key));
			}
		}
		var i = $('.fourkey').index(this);
		if(key == 8) {
			if(i==0) {
				return;
			}
			var kval = $('.fourkey').eq(i-1).val();
			if(kval) {
				$('.fourkey').eq(i-1).val(kval);
			}
			$('.fourkey').eq(i-1).focus();
			return;
		}
		if(!$('.fourkey').eq(i+1).val() || lastkey-i==1) {
			$('.fourkey').eq(i+1).focus();
		}
		lastkey = i;
	});
	$('.foursort').click(function() {
		var name = $(this).attr('name');
		if(name == 'topprice') {
			name = 'lowprice';
			$(this).attr('name', name);
		} else if(name == 'lowprice') {
			name ='topprice';
			$(this).attr('name',name);
		}
		var url = addUrlPara(window.location.href, 's', name);
		window.location.href=url;
	});
	/***手机号码栏目***/
	$('#tree_letter a').click(function(){
		var letter = $(this).text();
		var top1 = $('#letter'+letter).position().top;
		var top2 = $('#letters ul').position().top;
		var top  = top1-top2;
		if(top!=0) {
			$('#letters').animate({scrollTop: top}, 0); 
		}
	});
	$("#yuding").click(function(){
	    $(".zxyd_ceng").show();
	 });
	 $("#closemodal").click(function(){
	   $(".zxyd_ceng").hide();
	 });
	/**
	 *  车牌
	 */
	if($('#carsearch li').length > 0) {
		SDmodel.sd(["n01","n02"],["y01","y02"],"gg01","gg02");
	}
	
	//生成下部小按钮
	var length = $('#slideshow_photo a').length;
	for(var i = 0; i < length; i++)
	{
		$('<div class="slideshow-bt" index="'+(length-i)+'"></div>').appendTo('#slideshow_footbar');
    }
    $('#slideshow_footbar .slideshow-bt:last').addClass('bt-on');
    $('#slideshow_footbar .slideshow-bt').mouseenter(function(e)
    {
		slideTo(this);
    });

	
    var indexAllowAutoSlide = true;
    $('#slideshow_wrapper').mouseenter(function()
    {
		indexAllowAutoSlide = false;
    }).mouseleave(function()
    {
		indexAllowAutoSlide = true;
    });

	//滚动
    setInterval(function()
    {
		if (indexAllowAutoSlide) slideDown();
    },3000);
    $('#n02').hover(function() {
    	$('input[name="stype"]').val('precision');
    });
    $('#n01').hover(function() {
    	$('input[name="stype"]').val('');
    });
	//根据城市显示车牌号前缀
	$('#carcity').on('change', function() {
		var cityid = $('#carcity').val();
		var head = '';
		if(cityid > 0) {
			$.getJSON('/misc/cararea?pid=' + cityid + '&type=1', function(data){ 
			
				pre = '';
				$.each(data,function(index, value) { 
					head = head + pre + value; 
					pre = ',';
				});
				$('#showcarhead').text(head);
			});
		} else {
			$('#showcarhead').text();
		}
	});
	/**
	 *qq精确搜索
	 */
	 $('#mhQqForm input[type=button].button').on('touch click', function(){	
		var qq = $("#mhQqForm input[name=key]").val();
		var level = $("#mhQqForm select[name=level]").val();
		var price = $('#mhQqForm select[name=price]').val();
		var vip = $('#mhQqForm select[name=vip]').val();
		var secret = $('#mhQqForm select[name=secret]').val();
		var grade = $('#mhQqForm select[name=grade]').val();
		var tail = $('#mhQqForm input[name=tail].dan_active').val();
		var url = '/qq/search.htm?key='+qq+'&level='+level+'&price='+price+'&vip='+vip+'&secret='+secret+'&grade='+grade+'&tail='+tail;
		for(var i = 5; i < 13; i++) {
			var n = $('#mhQqForm input[name=n' + i + '].dan_active');
			if(n.length > 0) {
				url += '&n' + i + '=' + n.val();
			}
		}
		window.location = url;
	});
	/**
	 *页面定制js结束
	 */
	 /**
	 *聚猫商城店铺滚动
	 */
	 if($('.hotlist div').length > 0) {
		  $('.hotlist').bxSlider({
			 auto: true,
			 pager:false,
			 slideWidth: 5000,
			 nextText:'&#xe600;',
			 prevText:'&#xe601;',
			 minSlides: 6,
			 maxSlides: 6,
			 moveSlides:1,
			 slideMargin: 10,
			 infiniteLoop: false,
			 hideControlOnEnd:true
		 });
	 }
	  /**
	 *聚猫商城店铺滚动end
	 */
	/**
	*新闻news
	*/
	if($('#slides ul').length > 0) {
		$('.bxslider').bxSlider({
			auto: true
		});
	}
	/**
	 *固话搜索复选框
	 */
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
	/**
	*固话搜索
	*/
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
		var grade = $('#mhDianhuaForm select[name=grade]').val();
		var price = $('#mhDianhuaForm select[name=price]').val();
		var telephone = $("#mhDianhuaForm input[name=key]").val();
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
		var url = '/dianhua/search.htm?key='+telephone+manager+'&province='+province+'&city='+cityid+grade+price;
		window.location = url;
	});
	/**
	 *qq估价
	 */
	 $('#qqGujiaForm input[type=submit].yjgj').on('touch click', function(){	
		var qq = $("#qqGujiaForm input[name=qq]").val();
		var str = /^[1-9][0-9]{4,12}$/;
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
	 $('#qqJixiongForm input[type=submit].yjgj').on('touch click', function(){	
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
	 *号模评论
	 */
	 $('.haomoPl input[type=button].submit').on('touch mousedown', function() {
		var modelid = $(this).attr('modelid');
		var content = $('#content').val();
		$.getJSON('/home/haomo/discuss?modelid=' + modelid + '&content=' + content, function(result) {
			if(result.result) {
				var pinglun = '<p><span>' + result.nick + '：</span>' + result.content + '</p>';
				$('#model_pl_more_'+modelid).append(pinglun);
				$('.haomoPl input[class=hmpl_k]').val('');
				
			} else {
				if(result.message){
					alert(result.message);
				}
			}
		});
	});
	 /*评论结束*/
	 /**
	 *号模点赞
	 */
	 $('.dianzan').on('touch mousedown', function() {
		var id = $(this).attr('haomoid');
		$.getJSON('/home/haomo/dianzan?id=' + id, function(result) {
			if(result.result) {
				var digs = eval($('#zan'+id).text())+1;
				$('#zan'+id).html(digs);
			}
		});
	});
	 /*
	 *号模瀑布流效果
	 */
	var $model_container = $('#model_container');
	if($model_container.length > 0) {
		$model_container.imagesLoaded(function(){
			$model_container.masonry({
				itemSelector: '.box',
				columnWidth: 0 //每两列之间的间隙为5像素
			});
		});
	}
	
	/*大卡商列表选择城市js*/
	var checkprovince = $('#checkprovince');
	if(checkprovince.length>0) {
		$('#checkprovince').on('change', function() {
			var alias = $(this).val();
			var url = '/topvip/'+alias+'-1.htm';
			window.location = url;
		});
	}
	/*推荐皇冠店铺滚动JS*/
	if($('.ranklist ul').length > 0) {
		$.fn.myScroll = function(options){
	//默认配置
	var defaults = {
		speed:40,  //滚动速度,值越大速度越慢
		rowHeight:36 //每行的高度
	};
	
	var opts = $.extend({}, defaults, options),intId = [];
	
	function marquee(obj, step){
	
		obj.find("ul").animate({
			marginTop: '-=1'
		},0,function(){
				var s = Math.abs(parseInt($(this).css("margin-top")));
				if(s >= step){
					$(this).find("li").slice(0, 1).appendTo($(this));
					$(this).css("margin-top", 0);
				}
			});
		}
		
		this.each(function(i){
			var sh = opts["rowHeight"],speed = opts["speed"],_this = $(this);
			intId[i] = setInterval(function(){
				if(_this.find("ul").height()<=_this.height()){
					clearInterval(intId[i]);
				}else{
					marquee(_this, sh);
				}
			}, speed);

			_this.hover(function(){
				clearInterval(intId[i]);
			},function(){
				intId[i] = setInterval(function(){
					if(_this.find("ul").height()<=_this.height()){
						clearInterval(intId[i]);
					}else{
						marquee(_this, sh);
					}
				}, speed);
			});
		
		});

	}
		$("div.ranklist").myScroll({
		speed:40,
		rowHeight:36
	});

	}

	/**
	 *店铺号搜索
	 */
	 $('#shopidForm input[type=button].serbtnyshi').on('touch click', function(){	
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
	

	if($('#firstpane').length > 0) {
		//幻灯片元素与类“menu_body”段与类“menu_head”时点击
		//$("#firstpane .menu_body:eq(0)").show();
		$("#firstpane p.menu_head").click(function(){
			$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
			$(this).siblings().removeClass("current");
		});
		
		//滑动与类“menu_body”的元素，当鼠标悬停段
		//$("#secondpane .menu_body:eq(0)").show();
		$("#secondpane p.menu_head").mouseover(function(){
			$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
			$(this).siblings().removeClass("current");
		});
	}
	if($('#vippage').length > 0) {
		$('.module').posfixed({
			distance : 0,
			pos : 'top',
			type : 'while',
			hide : false
		});
		$('.gotop').posfixed({
			distance : 10,
			direction : 'bottom',
			type : 'always',
			tag : {
				obj : $('.wrap'),
				direction : 'right',
				distance : 10
			},
			hide : true
		});
	}
	/*新闻中心主页 买家中心和卖家中心*/
	if($('#news01').length > 0) {
		var SDmodel = new scrollDoor();
		SDmodel.sd(["news01","news02"],["new01","new02"],"qh01","qh02");
	}
	/*新闻搜索*/
	 $('#news_search').on('touch click', function(){	
		var key = $("#news_search_value").val();
		if(key != '') {
			var url = '/news/search-'+key+'/1.htm';
			window.location = url;	
		}
	});
	/*经纪人城市联动*/
	$('#escrow_city select[name=province]').on('change', function() {
		var pid = $(this).val();
		var city = $('#escrow_city select[name=cityid]');
		
		var key = $('#searchcondition input[name=key]').val();
		var tail = $('#searchcondition input[name=tail]').val();
		var manager = $('#searchcondition input[name=manager]').val();
		var head = $('#searchcondition input[name=head]').val();
		var pricescope = $('#searchcondition input[name=pricescope]').val();
		var grade = $('#searchcondition input[name=grade]').val();
		var love = $('#searchcondition input[name=love]').val();
		var four = $('#searchcondition input[name=four]').val();
		var month = $('#searchcondition input[name=month]').val();
		var p1 = $('#searchcondition input[name=p1]').val();
		var p2 = $('#searchcondition input[name=p2]').val();
		var p3 = $('#searchcondition input[name=p3]').val();
		var p4 = $('#searchcondition input[name=p4]').val();
		var p5 = $('#searchcondition input[name=p5]').val();
		var p6 = $('#searchcondition input[name=p6]').val();
		var p7 = $('#searchcondition input[name=p7]').val();
		var p8 = $('#searchcondition input[name=p8]').val();
		var p9 = $('#searchcondition input[name=p9]').val();
		var p10 = $('#searchcondition input[name=p10]').val();
		var url = '/escrow/search.htm?manager='+manager+'&head='+head+'&pricescope='+pricescope+'&grade='+grade+'&love='+love+'&four='+four+'&month='+month+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&p8='+p8+'&p9='+p9+'&p10='+p10+'&cityid=';
		
		if(pid > 0) {
			if(pid == 1 || pid == 2 || pid == 3 || pid == 4) {
				city.css('display', 'none');
				url = url+pid;
				window.location.href = url;
			} else {
				city.css('display', '');
				$.getJSON('/misc/city?pid=' + pid, function(json){ 
					$("option", city).remove();
					city.append('<option value="0">选择城市</option>');
					$.each(json,function(index, array) { 
						var option = "<option value='"+array['id']+"'>"+array['name']+"</option>"; 
						city.append(option);
					}); 
				});	
			}
		} else {
			$("option", city).remove();
			var option = '<option value="0">选择城市</option>'; 
			city.append(option); 
		}
	});
	$('#escrow_city select[name=cityid]').on('change', function() {
		var cityid = $(this).val();
		var key = $('#searchcondition input[name=key]').val();
		var tail = $('#searchcondition input[name=tail]').val();
		var manager = $('#searchcondition input[name=manager]').val();
		var head = $('#searchcondition input[name=head]').val();
		var pricescope = $('#searchcondition input[name=pricescope]').val();
		var grade = $('#searchcondition input[name=grade]').val();
		var love = $('#searchcondition input[name=love]').val();
		var four = $('#searchcondition input[name=four]').val();
		var month = $('#searchcondition input[name=month]').val();
		var p1 = $('#searchcondition input[name=p1]').val();
		var p2 = $('#searchcondition input[name=p2]').val();
		var p3 = $('#searchcondition input[name=p3]').val();
		var p4 = $('#searchcondition input[name=p4]').val();
		var p5 = $('#searchcondition input[name=p5]').val();
		var p6 = $('#searchcondition input[name=p6]').val();
		var p7 = $('#searchcondition input[name=p7]').val();
		var p8 = $('#searchcondition input[name=p8]').val();
		var p9 = $('#searchcondition input[name=p9]').val();
		var p10 = $('#searchcondition input[name=p10]').val();
		var url = '/escrow/search.htm?manager='+manager+'&head='+head+'&pricescope='+pricescope+'&grade='+grade+'&love='+love+'&four='+four+'&month='+month+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&p8='+p8+'&p9='+p9+'&p10='+p10+'&cityid=';
		
		if(cityid) {
			url = url+cityid;
			window.location.href = url;	
		}
	});
});