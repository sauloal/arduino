// w

// When the DOM has loaded, init the form link.
$(document).ready(function()
    {
        $('.fslideshow').show();
        $('.fslideshow').cycle({
            fx: 'scrollLeft', // choose your transition type, ex: fade, scrollUp, shuffle, etc...   
            timeout: 80,
            random: 1,
            width:  90
       });
        $('#fpsocial').delay(1500).slideDown();
        add_dynamic();
        //SyntaxHighlighter.config.toolbar = false;
        
        //SyntaxHighlighter.all()
        $.ajaxSetup ({
            cache: false
        });

        var loadUrl = "/jsutil/preview/";
        $("#preview").click(function(){
            $("#loading").html("<img src='/media/img/spin.gif' alt='loading...' />");

            $('#result').show('fast');
            var title = '';
            if ($("#id_name").length != 0) {
                title = $("#id_name").val().replace(/-/g,' ')
            }
            var content = $("#id_content").val();
            if ($("#id_content").length == 0) {
                var content = $("#id_body").val();
                if ($("#id_body").length == 0) {
                    var content = $("#id_comment").val();
                }


            }
                       
            $("#resultcontent").load(loadUrl, {title:title, content:content},
            function(){
                $("#loading").html("");
            });

        });

        $("#bpreview").click(function(){
            $("#loading").html("<img src='/media/img/spin.gif' alt='loading...' />");
            var title = '';
            $('#result').show('fast');
            var content =  $("#id_preview").val() + $("#id_body").val();
                       
            $("#resultcontent").load(loadUrl, {title:title, content:content},
            function(){
                $("#loading").html("");
            });

        });



   }         
);


function setCookie(cookieName,cookieValue,nDays) {
     var today = new Date();
     var expire = new Date();
     if (nDays==null || nDays==0) nDays=1;
     expire.setTime(today.getTime() + 3600000*24*nDays);
     document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString();
}


function getSelText()
{
    var txt = '';
     if (window.getSelection)
    {
        txt = window.getSelection();
             }
    else if (document.getSelection)
    {
        txt = document.getSelection();
            }
    else if (document.selection)
    {
        txt = document.selection.createRange().text;
            }
    return txt
}

function add_dynamic() {
    var quoteLinks = $(".quotelink");
    quoteLinks
    .click(
        function( objEvent ){
           var postId = $(objEvent.target);
           var quoteBody = getSelText().toString();

           if (quoteBody.length == 0) {
                quoteBody = $(postId).parent().parent().find(".comment-messagebody").html();
           }
           var quoteAuthor = $(postId).parent().parent().parent().find(".authortext").html();
           var quoteDate = $(postId).parent().parent().parent().find(".updated").html();
           tinyMCE.execInstanceCommand('id_body', 'mceInsertContent', 0, '<blockquote class="quote"><span class="quoteheader">' + quoteAuthor + 
                ' wrote:</span><br/> ' + quoteBody + '</blockquote>');
        }
    );

    var quoteLinks2 = $(".quotelink2");
    quoteLinks2
    .click(
        function( objEvent ){
           var postId = $(objEvent.target);
           var quoteBody = getSelText().toString();

           if (quoteBody.length == 0) {
                quoteBody = unescape($(postId).parent().parent().find(".comment-wikitext").text());
           }
           var quoteAuthor = $(postId).parent().parent().parent().find(".authorusername").html();
           var quoteDate = $(postId).parent().parent().parent().find(".updated").html();
           insertAtCaret('id_content', "\n<<quote " + quoteAuthor + ">>\n" + quoteBody + "\n<</quote>>\n");
        }
    );
    var quoteLinks3 = $(".quotelink3");
    quoteLinks3
    .click(
        function( objEvent ){
           var postId = $(objEvent.target);
           var quoteBody = getSelText().toString();

           if (quoteBody.length == 0) {
                quoteBody = unescape($(postId).parent().parent().find(".comment-wikitext").text());
           }
           var quoteAuthor = $(postId).parent().parent().parent().find(".authorusername").html();
           var quoteDate = $(postId).parent().parent().parent().find(".updated").html();
           insertAtCaret('id_body', "\n<<quote " + quoteAuthor + ">>\n" + quoteBody + "\n<</quote>>\n");
        }
    );
}

function confirmpost(url, conftext) {
var agree = confirm(conftext);
if (agree) {
    $.post(url);
    window.location.reload();
    return true;
    }
else
    return false;
}

function favourite(obj, id,app,name,model){
   $.get("/favourite/", { id: id, a:app, n:name, m:model}, 
       function(data){
        if (data == '1') {
            $(obj).attr('src', '/media/img/icons/star.png') ;
        }else { 
            $(obj).attr('src', '/media/img/icons/greystar.png');
        
        }
   });
}
  
function insertAtCaret(areaId,ins) {
    //modified to work with the filebrowser popup:
    if (window.opener) {
        var el = window.opener.document.getElementById(areaId);
    } else {
        var el = document.getElementById(areaId);
    }
    if (el.setSelectionRange){
        el.value = el.value.substring(0,el.selectionStart) + ins + el.value.substring(el.selectionStart,el.selectionEnd) + el.value.substring(el.selectionEnd,el.value.length);
    }
    else if (window.opener.document.selection && window.opener.document.selection.createRange) {
        el.focus();
        var range = window.opener.document.selection.createRange();
        range.text = ins + range.text;
    }
}



