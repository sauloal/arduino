(function(b){var a={init:function(c){},post:function(c){c.preventDefault();if((b(this).find("textarea").val().replace(" ","").replace(/(<([^>]+)>)/ig,""))===""){alert("you must enter a comment!");return(false)}b(this).find('input[type="submit"]').attr("disabled","disabled");b.post(b(this).attr("action"),b(this).serialize(),function(d){b("#comments_container").html(d.html);b("#comment-"+d.comment_id).effect("highlight");b("#airlock").trigger("comments_updated")}).error(function(){alert("we were unable to save your comment, please try again in a few minutes")})},hide:function(c){b.post("/comment/hide.json",{comment_id:c},function(d){if(!d.status){alert(d.message);return}b("#comment-"+c).addClass("moderated");b("#comment-show-"+c).show();b("#comment-hide-"+c).hide()})},show:function(c){b.post("/comment/show.json",{comment_id:c},function(d){if(!d.status){alert(d.message);return}b("#comment-"+c).removeClass("moderated");b("#comment-show-"+c).hide();b("#comment-hide-"+c).show()})},toggle_help:function(d){if(-1==d){var c=b("#formatting_help"),e=b("#formatting_help_link")}else{var c=b("#comment-"+d).find(".formatting-help"),e=b("#comment-"+d).find(".formatting-help-link")}if(c.is(":visible")){e.html("formatting help");c.hide()}else{e.html("hide help");c.show()}},rate:function(c){b.post("/comment/rate.json",{comment_id:c},function(d){if(!d.status){alert(d.message);return}b("#comment-rated-"+c).toggle();b("#comment-unrated-"+c).toggle();b("#comment-rating-"+c).html(d.rating)})},toggle_reply_form:function(c){if(b("#comment-reply-form-"+c).size()>0){b("#comment-reply-form-"+c).toggle();return}var d=b("#comment-reply-form").clone();var e=b("#comment-"+c);d=d.html().replace(/COMMENT_ID/g,c);b(e).find(".comment-text").first().append(d);d=b("#comment-reply-form-"+c);d.bind("submit",function(f){b(this).comment("post",f)});d.find("textarea").focus()},edit:function(c){b.get("/comment/"+c+".json",function(f){var e=b("#comment-edit-form").clone(),g=b("#comment-"+c);e.find("textarea").text(f.text);e=e.html().replace(/COMMENT_ID/g,c);g.find(".comment-text").eq(0).html(e);var d=g.find('a[name="cancel-button"]').eq(0);d.click(function(){g.find(".comment-text").eq(0).html(f.html);return(false)});e=b("#comment-edit-form-"+c);e.bind("submit",function(h){b.post("/comment/update.json",e.serialize(),function(i){b("#comments_container").html(i.html);b("#comment-"+i.comment_id).effect("highlight")}).error(function(){alert("we were unable to update your comment, please try again in a few minutes")});return false})})},report:function(c){if(!confirm("You are about to report a comment as potentially abusive to the SparkFun moderators.\n\nContinue?")){return(false)}b.post("/comment/report.json",{comment_id:c},function(d){alert("Thanks, this comment has been reported to the SparkFun moderators.")})}};b.fn.comment=function(c){if(a[c]){return a[c].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments)}else{b.error("Method "+c+" does not exist on jQuery.tooltip")}}}})(jQuery);