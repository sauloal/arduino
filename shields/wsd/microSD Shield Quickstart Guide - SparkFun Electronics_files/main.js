(function(b){var a={init:function(c){b(document).ready(function(){b(this).sfe("domready")});b("html").click(function(d){if(!b(d.target).hasClass("button")&&!b(d.target).parents().is(".dialog")){b(".dialog:visible").each(function(){b(this).slideUp(100)})}if(!b(d.target).parents().is(".header-sub-menu")&&!b(d.target).parents().is(".header-menu-item")){b(".header-sub-menu").each(function(){b(this).prev().removeClass("active");b(this).hide()})}})},domready:function(){b("#airlock").currency("render");b("#category_menu_list").find(".arrow").each(function(c,d){if(""==b(this).html()){return}b(d).click(function(){b(this).sfe("toggle_menu")})});this.sfe("render_collapsible")},toggle_menu:function(){var c=b(this).siblings().filter("ul");if(b(c).is(":visible")){b.cookie(this.parent().attr("id")+"_collapsed",true);this.html("&#9658; ")}else{b.cookie(this.parent().attr("id")+"_collapsed",false);this.html("&#9660; ")}c.toggle()},render_collapsible:function(){this.find("h1.collapsible, h2.collapsible").each(function(d,c){var e;e=b.cookie(c.id+"_collapsed");if(e===null){e="true"}if(e=="true"&&b(c).hasClass("closed")){e=false}if(!b(c).find("span.arrow")){c=new Element("span");b(c).insert(({top:c}));c.addClassName("arrow")}if("true"==e){b(c).find("span.arrow").html("&#9660; ").addClass("visible")}else{b(c).find("span.arrow").html("&#9658; ").removeClass("visible");b(c).next().toggle()}b(c).click(function(f){b(f.target).sfe("toggle_collapsible")})})},toggle_collapsible:function(){var c=this.closest(".collapsible").next();if(c.is(":visible")){if(this.hasClass("arrow")){this.html("&#9658; ")}else{this.find(".arrow").html("&#9658; ")}visible=b.cookie(this.closest(".collapsible").attr("id")+"_collapsed",false)}else{if(this.hasClass("arrow")){this.html("&#9660; ")}else{this.find(".arrow").html("&#9660; ")}visible=b.cookie(this.closest(".collapsible").attr("id")+"_collapsed",true)}c.toggle()},mind_feedback:function(){b.post("/feedback/mind.json",b(this).closest("form").serialize(),function(c){if(c.status==true){b("#feedback").effect("highlight",{},1500);b("#feedback").html("Thanks for your feedback!");return(true)}else{errors=c.errors;b("form#feedback div.error").each(function(){b(this).hide()});if(undefined!=errors.feedback){b("#error_feedback").html(errors.feedback);b("#error_feedback").show()}else{if(undefined!=errors.feedback_text){b("#error_feedback_text").html(errors.feedback_text);b("#error_feedback_text").show();b("#feedback_textarea").focus();b("#feedback_textarea").effect("highlight")}else{if(undefined!=errors.feedback_email){b("#error_feedback_email").html(errors.feedback_email);b("#error_feedback_email").show();b("#feedback_email").focus();b("#feedback_email").effect("highlight")}}}}}).error(function(){alert("there was an unknown error submitting your feedback, sorry for the inconvenience :(")})},track_link:function(e,d,g,c,f){if(undefined!=f&&!isNaN(parseInt(f*1))){_gaq.push(["_trackEvent",d,g,c,f])}else{if(undefined!=c){_gaq.push(["_trackEvent",d,g,c])}else{if(undefined!=g){_gaq.push(["_trackEvent",d,g])}}}setTimeout('document.location = "'+e.href+'"',100)},validate_alias:function(c,d){var e=b("#"+d);b.post("/account/alias_free.json",{q:c},function(f){if(f.result){b(e).addClass("success");b(e).removeClass("fail")}else{b(e).addClass("fail");b(e).removeClass("success")}})},populate_zones:function(e){var c=b(this);var d=c.attr("id");b.get("/zones.json",{country:e},function(h){if(h.length>1){var f=c.val();c.replaceWith(b("<select />",{name:"zone"}).attr("id",d));var g=b("#"+d);b.each(h,function(){var i=b("<option />",{value:this.name});if(f&&((f==this.name)||(f==this.code))){i.attr("selected","selected")}i.html(this.name);b(g).append(i)})}else{c.replaceWith(b("<input />",{type:"text",name:"zone"}).attr("id",d))}})}};b.fn.sfe=function(c){if(a[c]){return a[c].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments)}else{b.error("Method "+c+" does not exist on jQuery.tooltip")}}}})(jQuery);