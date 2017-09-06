$(document).ready(function(){var pdheight=$("#h01").height();var pdheight2=$("#h02").height();var pdheight3=$("#h03").height();var pdheight4=$("#h04").height();if(pdheight>135){$("#h01").addClass("dp_maxheight");$("#h01 .dp_pdheight").addClass("dp_abs");};if(pdheight2>120){$("#h02").addClass("dp_maxheight");$("#h02 .dp_pdheight").addClass("dp_abs");};if(pdheight3>120){$("#h03").addClass("dp_maxheight");$("#h03 .dp_pdheight").addClass("dp_abs");};if(pdheight4>120){$("#h04").addClass("dp_maxheight");$("#h04 .dp_pdheight").addClass("dp_abs");};});function scrollDoor(){}

scrollDoor.prototype={sd:function(menus,divs,openClass,closeClass){var _this=this;if(menus.length!=divs.length)

{alert("菜单层数量和内容层数量不一样!");return false;}

for(var i=0;i<menus.length;i++)

{_this.$(menus[i]).value=i;_this.$(menus[i]).onmouseover=function(){for(var j=0;j<menus.length;j++)

{_this.$(menus[j]).className=closeClass;_this.$(divs[j]).style.display="none";}

_this.$(menus[this.value]).className=openClass;_this.$(divs[this.value]).style.display="block";}}},$:function(oid){if(typeof(oid)=="string")

return document.getElementById(oid);return oid;}}

window.onload=function(){var SDmodel=new scrollDoor();SDmodel.sd(["m01","m02"],["c01","c02"],"sd01","sd02");}