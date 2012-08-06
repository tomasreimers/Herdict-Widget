(function (){
    var herdictListId = "<?php echo($_GET['id']); ?>";
    herdictListId = (herdictListId != "" ? parseInt(herdictListId) : -1);
    // ajax
    var scriptTag = document.createElement('script');
    scriptTag.src = "http://herdict.org/ajax/lists/" + herdictListId + "/view?callback=herdictWidgetDataHandler";
    scriptTag.type = "text/javascript";
    document.getElementsByTagName('head')[0].appendChild(scriptTag);
    document.write("\
        <style type='text/css'>\
            .herdictWidgetSite:after {\
                clear: both;\
                content:'.';\
                display: block;\
                height: 0;\
                visibility: hidden;\
            }\
            .herdictWidget {\
                font-size: 12px;\
                font-family:'helvitica', 'arial', sans-serif;\
            }\
            .herdictWidgetSite, .herdictWidgetBlurb {\
                border-bottom: 1px dotted #666666;\
                margin-top: 5px;\
                padding-bottom: 5px;\
                margin-right:90px;\
            }\
            .herdictWidgetSite > div, .herdictWidgetSite > a {\
                margin-top: 5px;\
                display:block;\
                color:#000;\
            }\
            .herdictWidgetSite > a {\
                text-decoration:none;\
            }\
            .herdictWidgetSite > a:hover {\
                text-decoration:underline;\
            }\
            .herdictWidgetSite img{\
                border: 1px solid #999999;\
                float: left;\
                height: 55px;\
                margin-right: 10px;\
                width: 90px;\
            }\
            .herdictWidgetTitle {\
                overflow: hidden;\
                text-overflow: ellipsis;\
                white-space: nowrap;\
                font-weight:bold;\
            }\
            .herdictWidgetAccessible {\
                color: #669933\
            }\
            .herdictWidgetInaccessible {\
                color: #FF6600\
            }\
            .herdictWidgetHeader{\
                background: url('http://herdict.org/includes/img/global/bg_testbar.png') repeat-x scroll 0 0 transparent;\
                color: #666666;\
                font-size: 14px;\
                height: 30px;\
                line-height: 30px;\
                margin: 10px 20px 23px 0;\
                padding-left: 5px;\
                position: relative;\
            }\
            .herdictWidgetTest {\
                background: url('http://herdict.org/includes/img/global/btn_test_small.png') no-repeat scroll 50% center transparent;\
                color: #FFFFFF;\
                font-size: 14px;\
                font-weight: bold;\
                height: 40px;\
                line-height: 43px;\
                padding-left: 10px;\
                position: absolute;\
                right: -20px;\
                text-transform: uppercase;\
                top: -6px;\
                width: 78px;\
                text-decoration:none;\
            }\
            .herdictWidgetBottom {\
                text-align:center;\
                margin:10px;\
                font-weight:bold;\
            }\
            .herdictWidgetBottom a{\
                color:#165389;\
                margin-left:20px;\
                text-decoration:none;\
            }\
            .herdictWidgetBottom a:hover{\
                text-decoration:underline;\
            }\
            .herdictWidgetFooter {\
                background: url('http://herdict.org/includes/img/interior/bg_list_footer.png') repeat-x scroll 0 0 transparent;\
                padding: 3px 10px 7px 5px;\
            }\
            .herdictWidgetFooter:after {\
                clear: both;\
                content:'.';\
                display: block;\
                height: 0;\
                visibility: hidden;\
            }\
            .herdictWidgetFooter a {\
                display: block;\
                float: left;\
                height: 16px;\
                margin-right: 5px;\
                width: 16px;\
            }\
            .herdictWidgetFooter a.herdictWidgetTwitter {\
                background: url('http://herdict.org/includes/img/global/icon_twitter_dark.png') no-repeat scroll 50% 50% transparent;\
            }\
            .herdictWidgetFooter a.herdictWidgetFacebook {\
                background: url('http://herdict.org/includes/img/global/icon_facebook_dark.png') no-repeat scroll 50% 50% transparent;\
            }\
            .herdictWidgetFooter a.herdictWidgetRSS {\
                background: url('http://herdict.org/includes/img/global/icon_rss_dark.png') no-repeat scroll 50% 50% transparent;\
            }\
        </style>\
    ");
    document.write("<div data-herdict-list-id='"+herdictListId+"' class='herdictWidget'></div>");
})();
// must be public because must be put in url
function herdictWidgetDataHandler(data){
    var widget = "";
    widget += "<div class='herdictWidgetHeader'>";
        widget += data.user.username + "'s List";
        widget += "<a href='http://herdict.org/lists#r=1&rl="+data.id+"' target='_blank' class='herdictWidgetTest'>TEST</a>";
    widget += "</div>";
    widget += "<div class='herdictWidgetBody'>";
        widget += "<div class='herdictWidgetBlurb'>";
            widget += data.description;
        widget += "</div>";
        for (var i = 0; i < (data.userListPages).length; i++){
            var currentSite = data.userListPages[i];
            var displayStr = (i < 5 ? "block" : "none");
            widget += "<div class='herdictWidgetSite' style='display:"+displayStr+";'>";
                widget += "<img alt='' src='http://herdict.org/images/thumbnails/WEB/" + currentSite.page.id + ".png' />";
                widget += "<div class='herdictWidgetTitle'>" + (typeof(currentSite.page.title) === 'undefined'? currentSite.page.url : currentSite.page.title) + "</div>";
                widget += "<a target='_blank' href='http://" + currentSite.page.url + "' class='herdictWidgetURL'>" + currentSite.page.url + "</a>";
                widget += "<div class='herdictWidgetCount'>";
                    widget += "<span class='herdictWidgetAccessible'>" + currentSite.countAccessible + " Accesible</span>";
                    widget += " | ";
                    widget += "<span class='herdictWidgetInaccessible'>" + currentSite.countInaccessible + " Inaccesible</span>";
                widget += "</div>";
            widget += "</div>";
        }
        widget += "<div class='herdictWidgetBottom'>";
            widget += "<a href='#' onclick='herdictWidgetExpandToggle(this)' >EXPAND</a>";
            widget += "<a href='http://herdict.org/explore/indepth#fl=" + data.id + "'>VIEW DASHBOARD</a>";
        widget += "</div>";
    widget += "</div>";
    widget += "<div class='herdictWidgetFooter'>"
        widget += '<a class="herdictWidgetTwitter" title="Tweet this page" target="_blank" href="http://twitter.com/share?url=http%3A%2F%2Fherdict.org%2Fexplore%2Findepth%23fl='+data.id+'"></a>';
        widget += '<a class="herdictWidgetFacebook" title="Share on Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fherdict.org%2Fexplore%2Findepth%23fl='+data.id+'"></a>';
        widget += '<a class="herdictWidgetRSS" href="http://herdict.org/rss/en?fl='+data.id+'"></a>';
    widget += "</div>";
    // select all herdict widgets with this ID
    var nodes = document.querySelectorAll("div[data-herdict-list-id='"+data.id+"']");
    for (var i = 0; i < nodes.length; i++){
        nodes[i].innerHTML = widget;
    }
}
function herdictWidgetExpandToggle(link){
    // make visible
    var children = link.parentNode.parentNode.children;
    for (var i = 0; i < children.length; i++){
        children[i].style.display = "block";
    }
    // remove link
    link.parentNode.removeChild(link);
}