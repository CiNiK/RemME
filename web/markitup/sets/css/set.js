// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// CSS set by Kevin Papst
// http://www.kevinpapst.de/
// Initially written for the BIGACE CMS:
// http://www.bigace.de/
// ----------------------------------------------------------------------------
// Basic CSS set. Feel free to add more tags
// ----------------------------------------------------------------------------
function decorate(el,prop,val,opval){
	var style = ($(el.textarea).css(prop) == val) ? opval : val;
	$(el.textarea).css(prop,style);
}
mySettings = {
	onEnter:			{},
	onShiftEnter:		{keepDefault:false, placeHolder:'Your comment here', openWith:'\n\/* ', closeWith:' *\/'},
	onCtrlEnter:		{keepDefault:false, placeHolder:"classname", openWith:'\n.', closeWith:' { \n'},
	onTab:				{keepDefault:false, openWith:'  '},
	markupSet:  [	
		{ name:'Fonts', className:'font'},
		{separator:'---------------' },
		{name:'Bold', className:'bold', key:'B', replaceWith:function(h){decorate(h,'font-weight','bold','normal')}},
		{name:'Italic', className:'italic', key:'I', replaceWith:function(h){decorate(h,'font-style','italic','normal')}},
		{name:'Stroke through',  className:'stroke', key:'S', replaceWith:function(h){decorate(h,'text-decoration','line-through','none');}},
		{separator:'---------------' },
		{name:'Left', className:'left', replaceWith:function(h){$(h.textarea).css('text-align','left');}},
		{name:'Center', className:'center', replaceWith:function(h){$(h.textarea).css('text-align','center');}},
		{name:'Right', className:'right', replaceWith:function(h){$(h.textarea).css('text-align','right');}},
		{name:'Justify', className:'justify', replaceWith:function(h){$(h.textarea).css('text-align','justify');}},
		{separator:'---------------' },
		{name:'Colors', 
			className:'colors', 
			beforeInsert:function() { 
                 $("#colorPlugin").toggle().css("zIndex", 11);
            } 
        },
	]
}
