tinymce.PluginManager.add("preview",function(e){var t=e.settings;e.addCommand("mcePreview",function(){e.windowManager.open({title:"Preview",width:parseInt(e.getParam("plugin_preview_width","650"),10),height:parseInt(e.getParam("plugin_preview_height","500"),10),html:'<iframe src="javascript:\'\'" frameborder="0"></iframe>',buttons:{text:"Close",onclick:function(){this.parent().parent().close()}},onPostRender:function(){var i,n=this.getEl("body").firstChild.contentWindow.document,a="";e.settings.document_base_url!=e.documentBaseUrl&&(a+='<base href="'+e.documentBaseURI.getURI()+'">'),tinymce.each(e.contentCSS,function(t){a+='<link type="text/css" rel="stylesheet" href="'+e.documentBaseURI.toAbsolute(t)+'">'});var r=t.body_id||"tinymce";-1!=r.indexOf("=")&&(r=e.getParam("body_id","","hash"),r=r[e.id]||r);var d=t.body_class||"";-1!=d.indexOf("=")&&(d=e.getParam("body_class","","hash"),d=d[e.id]||"");var o=e.settings.directionality?' dir="'+e.settings.directionality+'"':"";i="<!DOCTYPE html><html><head>"+a+'</head><body id="'+r+'" class="mce-content-body '+d+'"'+o+">"+e.getContent()+"</body></html>",n.open(),n.write(i),n.close()}})}),e.addButton("preview",{title:"Preview",cmd:"mcePreview"}),e.addMenuItem("preview",{text:"Preview",cmd:"mcePreview",context:"view"})});