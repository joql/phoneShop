;(function(global){
    global.Ta=global.Ta||{};
    Ta.hack=function(){
        return {
            params:'',
            conf:{sid:35791314,pf:1,logo:255,hot:{}}        };
    };
})(this);

(function(h,k){function w(c){c+="";var a,b,d,e,f,g;d=c.length;b=0;for(a="";b<d;){e=c.charCodeAt(b++)&255;if(b==d){a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e>>2);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e&3)<<4);a+="==";break}f=c.charCodeAt(b++);if(b==d){a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e>>2);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e&3)<<4|(f&240)>>
4);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((f&15)<<2);a+="=";break}g=c.charCodeAt(b++);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(e>>2);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((e&3)<<4|(f&240)>>4);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt((f&15)<<2|(g&192)>>6);a+="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(g&63)}return a}function m(c){return(c=
document.cookie.match(new RegExp("(?:^|;\\s)"+c+"=(.*?)(?:;\\s|$)")))?c[1]:""}function q(c,a,b){var d=window.location.host,e={"com.cn":1,"net.cn":1,"gov.cn":1,"com.hk":1,"co.nz":1,"org.cn":1,"edu.cn":1},f=d.split(".");2<f.length&&(d=(e[f.slice(-2).join(".")]?f.slice(-3):f.slice(-2)).join("."));document.cookie=c+"="+a+";path=/;domain="+d+(b?";expires="+b:"")}function n(c){var a,b,d,e={};void 0===c?(d=window.location,c=d.host,a=d.pathname,b=d.search.substr(1),d=d.hash):(d=c.match(/\w+:\/\/((?:[\w-]+\.)+\w+)(?:\:\d+)?(\/[^\?\\\"\'\|\:<>]*)?(?:\?([^\'\"\\<>#]*))?(?:#(\w+))?/i)||
[],c=d[1],a=d[2],b=d[3],d=d[4]);void 0!==d&&(d=encodeURI(d.replace(/\"|\'|\<|\>/ig,"M")));if(b)for(var f=b.split("&"),g=0,h=f.length;g<h;g++)if(-1!=f[g].indexOf("=")){var l=f[g].indexOf("="),k=f[g].slice(0,l),l=f[g].slice(l+1);e[k]=l}return{host:c,path:a,search:b,hash:d,param:e}}function r(c){return(c||"")+Math.round(2147483647*(Math.random()||.5))*+new Date%1E10}function p(c,a){var b=document.createElement("script"),d=document.getElementsByTagName("script")[0];b.src=c;b.type="text/javascript";b.onload=
b.onerror=b.onreadystatechange=function(){/loaded|complete|undefined/.test(b.readyState)&&(b.onload=b.onerror=b.onreadystatechange=null,b.parentNode.removeChild(b),b=void 0,a())};d.parentNode.insertBefore(b,d)}function x(){var c=n(),a={dm:c.host,pvi:"",si:"",url:c.path,arg:encodeURIComponent(c.search||""),ty:1};a.pvi=function(){var b=m("pgv_pvi");b||(a.ty=0,b=r(),q("pgv_pvi",b,"Sun, 18 Jan 2038 00:00:00 GMT;"));return b}();a.si=function(){var a=m("pgv_si");a||(a=r("s"),q("pgv_si",a));return a}();
return a}function y(){var c=n(document.referrer),a=n();return{rdm:c.host,rurl:c.path,rarg:encodeURIComponent(c.search||""),adt:a.param.ADTAG||a.param.adtag}}function z(){try{var c=navigator,a=screen||{width:"",height:"",colorDepth:""},b=document.body,d=a.width+"x"+a.height,e=a.colorDepth+"-bit",f=(c.language||c.userLanguage).toLowerCase(),g=c.javaEnabled()?1:0,h=(new Date).getTimezoneOffset()/60,a="";b&&b.addBehavior&&(b.addBehavior("#default#clientCaps"),a=b.connectionType);var b={fl:"",scr:d,scl:e,
lg:f,jv:g,tz:h,ct:a},l,k,m,n;if((l=c.plugins)&&(k=l.length))for(c=0;c<k;c++){if(m=l[c].description.match(/Shockwave Flash ([\d\.]+) \w*/))b.fl=m[1]}else n=(new ActiveXObject("ShockwaveFlash.ShockwaveFlash")).GetVariable("$version"),b.fl=n.replace(/^.*\s+(\d+)\,(\d+).*$/,"$1.$2")}catch(p){return{}}return b}function A(){var c={};if("undefined"!=typeof _taadHolders&&0<_taadHolders.length)for(var a=0,b=_taadHolders,d=b.length;a<d;a++)c[b[a]]=c[b[a]]?c[b[a]]+1:1;var a=[],e;for(e in c)c.hasOwnProperty(e)&&
a.push(e+"*"+c[e]);return{ext:"adid="+a.join(":")}}function B(){var c=[],a=m(t.gdt.c_id);a&&c.push("ty="+t.gdt.key+";ck=1;id="+a);return{pf:c.join("|")}}function u(c){c=c||{};c.conf&&function(){var a=c.conf,b;for(b in a)a.hasOwnProperty(b)&&(h[b]=a[b])}();h.sid&&(Ta[h.sid]||p("http://t.gdt.qq.com/conv/brand/"+h.sid+"/script?url="+encodeURIComponent(location.href),function(){for(var a=[],b=0,d=[x(),y(),{r2:h.sid,r3:"undefined"==typeof _speedMark?"-1":new Date-_speedMark,r4:h.pf||1},z(),A(),B(),{random:+new Date}],
e=d.length;b<e;b++)for(var f in d[b])d[b].hasOwnProperty(f)&&a.push(f+"="+(d[b][f]||""));c.params&&a.push(c.params);var a=Ta.src=("https:"==document.location.protocol?"https://pingtas":"http://pingtcss")+".qq.com/pingd?"+a.join("&"),g=new Image;Ta[h.sid]=g;g.onload=g.onerror=g.onabort=function(){g=g.onload=g.onerror=g.onabort=null;Ta[h.sid]=!0};g.src=a;(1*!h.pf||h.hot.isValid)&&C(a);h.logo&&255!=h.logo&&D(h.logo)}))}function v(c,a){var b=Ta.src.replace(/ext=[^&]*/,function(){return"ext="+("evtid"==
a?"ty=0;evtid=":"adid=")+c}).replace(/r2=([^&]*)/,function(a,b){return"r2=a"+b});(new Image(1,1)).src=b}function C(c){var a=window.location,b=a.host+a.pathname,d=a.pathname,e=function(){p(("https:"==document.location.protocol?"https://":"http://")+"tajs.qq.com/ping_hotclick_min.js",function(){window.hotclick&&(new hotclick(c)).watchClick()})};1*h.pf?(new RegExp(b)).test(h.hot.url)&&e():(a=h.sid,p("http://tcss.qq.com/heatmap/"+a%100+"/"+w(a)+".js?random="+ +new Date,function(){var a;if(window._Cnf&&
(a=window._Cnf.url)){a=a.split("|");for(var b=0;b<a.length;b++)if(a[b]==d){e();break}}}))}function D(c){var a={9:"\u817e\u8baf\u5206\u6790",10:"\u7f51\u7ad9\u7edf\u8ba1",df:'<img src="'+(("https:"==document.location.protocol?"https:":"http:")+"//tajs.qq.com/icon/toss_"+c+".gif")+'" border="0" />'};document.write(['<a href="http://ta.qq.com?ADTAG=FROUM.FOOTER.CLICK.ICON" title="\u817e\u8baf\u5206\u6790" target="_blank">',a[c]||a.df,"</a>"].join(""))}var t={afs:{key:1,id:"ssid",c_id:"pgv_afsid",fr:"hash"},
afc:{key:2,id:"__tacid",c_id:"pgv_afcid",fr:"param"},gdt:{key:11,id:"qz_gdt",c_id:"pgv_gdtid",fr:"param"}};k.pgvSendClick=v;k.taClick=v;k.Ta=k.Ta||{};Ta.pgv=u;!Ta.async&&u(Ta.hack?Ta.hack():"")})({sid:"",pf:"",hot:{url:"",isValid:!1}},this);