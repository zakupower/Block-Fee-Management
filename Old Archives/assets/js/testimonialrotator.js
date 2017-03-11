
(function($) {

    $.fn.testimonialrotator = function(o) {
		
        var defaults = {
            settings_slideshowTime : '5' //in seconds
            , settings_autoHeight : 'on'
            , settings_skin : 'skin_default'
            , design_transition : 'fade'
            , design_testwrapper : ''
        }
		
        o = $.extend(defaults, o);
        this.each( function(){
            var cthis = jQuery(this);
            var cchildren = cthis.children();
            var currNr=-1;
            var timebuf=0;
            var slideshowTime = parseInt(o.settings_slideshowTime);
            var i=0;
            var padt = 0
            , padb = 0
            , cargh = 0
            ;
            var the_skin = 'skin_default'
            ;
            init();
            
                        
            function init(){
               // console.log(cthis.css('height'))
               // cchildren.eq(0).css('position', 'absolute');
               if(cthis.attr('class').indexOf('skin_') == -1){
                    cthis.addClass(o.settings_skin);
                }
                
                if(cthis.attr('class').indexOf('skin_arrowbox') > -1){ the_skin = 'skin_arrowbox'; }
                if(cthis.attr('class').indexOf('skin_eos') > -1){ the_skin = 'skin_eos'; }
                if(cthis.attr('class').indexOf('skin_avatar') > -1){ the_skin = 'skin_avatar'; }
                if(cthis.attr('class').indexOf('skin_aurora') > -1){ the_skin = 'skin_aurora'; }
                
                
                    if(the_skin=='skin_aurora'){
                        o.design_transition = 'aurora';
                        o.settings_autoHeight = 'off';
                        var aux = cthis.html();
                        cthis.html('<div class="tests-con"><div class="tests-inner">' + aux + '</div></div>');
                        cthis.prepend('<div class="thumbmenu-con"></div>');
                        cchildren = cthis.children('.tests-con').children('.tests-inner').children();
                        for(i=0;i<cchildren.length;i++){
                            var _c = cchildren.eq(i);
                            _c.css('left', i * cthis.width())
                            var aux = '<div class="thumbmenu-item-con"><div class="thumbmenu-item" style="background-image:url(' + _c.find('.testauthoravatar').attr('data-img') + ')"></div></div>';
                            cthis.find('.thumbmenu-con').append(aux);
                        }
                        var aux2 = 100 / cchildren.length;
                        aux2 += '%';
                        cthis.find('.thumbmenu-item-con').css('width', (aux2))
                        cthis.find('.thumbmenu-item-con').eq(0).addClass('active');
                    }
                
                
                for(i=0;i<cchildren.length;i++){
                    var _c = cchildren.eq(i);
                    if(_c.hasClass('testimonial-tobe')){
                        _c.removeClass('testimonial-tobe').addClass('testimonial');
                    }
                    //console.log(o.design_testwrapper, _c);
                    if(o.design_testwrapper!=''){
                        _c.wrap('<div class="' + o.design_testwrapper + '"></div>');
                    }
                    _c.append('<div class="clear"></div>');
                    if(the_skin=='skin_eos'){
                        //console.log(_c.children('.testauthor'), _c.children('.testtext'));
                        _c.children('.testtext').after(_c.children('.testauthor'));
                    }
                    if(the_skin=='skin_avatar'){
                        //console.log(_c.children('.testauthor'), _c.children('.testtext'));
                        var aux = '<img src="' + _c.find('.testauthoravatar').attr('data-img') + '"/>';
                        //console.log(_c, _c.find('.testauthoravatar'), aux);
                        _c.find('.testauthoravatar').append('<img src="' + _c.find('.testauthoravatar').attr('data-img') + '"/>');
                    }
                    //console.log(_c);
                }
                
                
                    //cthis.append('<div class="clear"></div>');    
                    
                        
                if(o.design_transition=='none'){
                    cchildren.css({
                        'position' : 'relative'
                        , 'display' : 'inline-block'
                    })
                }
                if(o.design_transition=='fade' || o.design_transition=='blur'){
                    setInterval(tick, 1000);
                    gotoItem(0);
                }
                if(o.design_transition=='aurora'){
                    cchildren.css({
                        'position' : 'absolute'
                        , 'display' : 'block'
                    })
                    
                    cthis.find('.thumbmenu-con').children().mouseover(aurora_onmouseover)
                }
                $(window).resize(handleResize);
            }
            function aurora_onmouseover(){
                var _t = jQuery(this);
                var ind = _t.parent().children().index(_t);
                _t.parent().children().removeClass('active');
                _t.addClass('active');
                
                cchildren.addClass('faded');
                cchildren.eq(ind).removeClass('faded');
                var aix = ind*cthis.width();
                cthis.find('.tests-inner').css('left', -aix)
                //console.log(aix);
            }
            function handleResize(){
                var _t = jQuery(this);
                
                if(o.design_transition=='aurora'){
                    
                    for(i=0;i<cchildren.length;i++){
                    var _c = cchildren.eq(i);
                    _c.css('left', i * cthis.width())
                    }
                }
                
                if(o.settings_autoHeight=='on'){
                    cargh = cchildren.eq(currNr).height();
                    //console.log(cchildren);
                    padt = parseInt(cchildren.eq(currNr).css('padding-top'),10);
                    padb = parseInt(cchildren.eq(currNr).css('padding-bottom'),10);
                    cargh += padt + padb;
                    cthis.animate({
                        'height' : cargh
                        }).css('overflow', 'visible');
                }
            }
            function tick(){
                timebuf++;
                if(timebuf>slideshowTime){
                    timebuf=0;
                    gotoNext();
                }
            }
            function gotoNext(){
                var aux=currNr+1;
                if(aux>cchildren.length-1){
                    aux=0;
                }
                gotoItem(aux);
            }
            function gotoItem(arg){
                if(o.design_transition=='none'){
                    return;
                }
                //console.log(cthis, o.design_transition);
                if(o.design_transition=='blur'){
                if(currNr>-1){
                    cchildren.eq(currNr).addClass('animating');
                    cchildren.eq(currNr).animate({
                        'opacity' : 0
                    }, { queue:false, duration:1500 })
                    
                    cchildren.delay(300).eq(arg).removeClass('animating');
                     cchildren.eq(arg).css({
                         'display' : 'inline-block', 'opacity' : 0
                     });
                }
                    cchildren.delay(300).eq(arg).animate({
                        'opacity' : 1
                    }, { queue:false, duration:2000 })
                }
                if(o.design_transition=='fade'){
                if(currNr>-1){
                    cchildren.eq(currNr).fadeOut('slow');
                }
                cchildren.eq(arg).fadeIn('slow');
                }
                if(o.settings_autoHeight=='on'){
                    cargh = cchildren.eq(arg).height();
                    padt = parseInt(cchildren.eq(arg).css('padding-top'),10);
                    padb = parseInt(cchildren.eq(arg).css('padding-bottom'),10);
                    cargh += padt + padb;
                    cthis.animate({
                        'height' : cargh
                        }).css('overflow', 'visible');
                }
                currNr=arg;
                
            }
            return this;
        })
    }
})(jQuery)
	