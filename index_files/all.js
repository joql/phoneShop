function regist(){$(".list_1 span").click(function(){if($(this).attr("class")=="select"){$(this).removeClass("select");$(this).parent().parent().find(".checkbox").val("")}else{$(this).addClass("select");$(this).parent().parent().find(".checkbox").val($(this).attr("data-id"))}});$(".list_1 div,.list_2 div").each(function(){var div=$(this);var p=div.find("p");var li=div.find("ul>li");div.click(function(event){event.stopPropagation();if(div.hasClass("hidden")){$(this).attr("class","block").parent().siblings().children("div").attr("class","hidden").parents("tr").siblings().children().children().children("div").attr("class","hidden")}else{div.attr("class","hidden")}return false});li.click(function(event){event.stopPropagation();$(this).parent().siblings("p").html($(this).html());div.attr("class","hidden");var keyNum=$(this).attr("data-id");$(this).parent().parent().find(".hidden_field").val(keyNum);if(keyNum){$(this).parent().parent().parent().find("label span").addClass("select");var checkNum=$(this).parent().parent().parent().find("label span").attr("data-id");$(this).parent().parent().parent().find(".checkbox").val(checkNum)}else{$(this).parent().parent().parent().find("label span").removeClass("select");$(this).parent().parent().parent().find(".checkbox").val("")}});$(document).click(function(){div.attr("class","hidden")})});$("#Appuser_needother").blur(function(){if($(this).val()!=""){$(this).parent().find("label span").addClass("select");var checkNum=$(this).parent().find("label span").attr("data-id");$(this).parent().find(".checkbox").val(checkNum)}else{$(this).parent().find("label span").removeClass("select");$(this).parent().find(".checkbox").val("")}})}function share(){$(".upload_class a,.share_class a,.share_sort a").each(function(){$(this).click(function(){$(this).addClass("click").siblings("a").removeClass("click");$("#sort_id").val($(this).attr("data-val"))})});$(".clear,.upload_close,.alert_close").click(function(){$(".upload_bg,.share_upload,.alert_show").hide()})}function addSum(tag,click,show){$(tag).each(function(){var emSum;$(this).find(click).click(function(index){var goods=$(this).parents(tag);emSum=goods.find(show).text();emSum++;goods.find(show).text(emSum)})})};