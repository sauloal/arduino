(function(b){var a={init:function(c){},ask_which_wishlist:function(e,g){if(b("#wishlist-dialog")[0]){b("#wishlist-dialog").slideUp(100).remove()}if(b("#autonotify-dialog")[0]){b("#autonotify-dialog").slideUp(100).remove()}var d=b("<div />",{id:"wishlist-dialog",style:"display: none; width: 300px"}).addClass("dialog");var c=b("<ul />");var f=b("<a />",{id:"wishlist-dialog-cancel",href:"javascript:void(0)"}).addClass("cancel button").html("Cancel");f.click(function(){b("#wishlist-dialog").slideUp(100,function(){b("#wishlist-dialog").remove()})});var i=this;var h=b(this).offset();d.css({top:h.top+(b(this).height()+10)+"px"});d.css({left:h.left-(parseInt(d.css("width"))-b(this).width()+10)+"px"});d.html("<h3>Select a Wish List</h3>");d.append(c);d.append(f);if(SFECONFIG.auth){b.get("/wish_lists/index.json",function(j){if(j.status){if(j.wish_lists.length<1){b.get("/wish_lists/make",function(k){d.html(k);var l=d.find("form");l.attr("action","/wish_lists/create.json");l.find(".cancel").click(function(){b("#wishlist-dialog").slideUp(100,function(){b("#wishlist-dialog").remove()})});l.submit(function(m){b.post(b(this).attr("action"),b(this).serialize(),function(n){b(d).slideUp(100,function(){b(d).remove();b(i).wishlist("ask_which_wishlist",e,g)})});return false});b("#airlock").append(d);b(d).slideDown(100)})}else{b.each(j.wish_lists,function(n,l){var k=b("<li />");var m=b("<a />",{href:"javascript:void(0)"}).html(l);m.click(function(){b(d).slideUp(100,function(){b(this).wishlist("add_to_wish_list",n,e,g)})});k.append(m);c.append(k)});b("#airlock").append(d);b(d).slideDown(100)}}})}},add_to_wish_list:function(e,c,d){b.post("/wish_lists/"+e+"/add.json",{product_id:c,quantity:d},function(f){if(f.status){if(b("#wl_added_qty_"+c)[0]){b("#wl_added_qty_"+c).html(d);b("#wl_link_"+c).attr("href","/wish_lists/"+e);b("#wl_link_"+c).html(f.wish_list.title);b("#added_to_wish_list_"+c).show("fade")}else{if(b("#airlock").cart("remove",c)){b("#cart_row_"+c).slideUp(100)}}}else{alert("An error occurred adding this item :(")}})}};b.fn.wishlist=function(c){if(a[c]){return a[c].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments)}else{b.error("Method "+c+" does not exist on jQuery.tooltip")}}}})(jQuery);