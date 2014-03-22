tinymce.PluginManager.add("link",function(e){function t(t){return function(){var n=e.settings.link_list;"string"==typeof n?tinymce.util.XHR.send({url:n,success:function(e){t(tinymce.util.JSON.parse(e))}}):t(n)}}function n(t){function n(e){var t=f.find("#text");(!t.value()||e.lastControl&&t.value()==e.lastControl.text())&&t.value(e.control.text()),f.find("#href").value(e.control.value())}function l(){var n=[{text:"None",value:""}];return tinymce.each(t,function(t){n.push({text:t.text||t.title,value:e.convertURL(t.value||t.url,"href"),menu:t.menu})}),n}function i(t,n,l){var i,a=[];return tinymce.each(e.settings[t]||l,function(e){var t={text:e.text||e.title,value:e.value};a.push(t),(p[n]===e.value||!i&&e.selected)&&(i=t)}),i&&!p[n]&&(p[n]=i.value,i.selected=!0),a}function a(t){var l=[];return tinymce.each(e.dom.select("a:not([href])"),function(e){var n=e.name||e.id;n&&l.push({text:n,value:"#"+n,selected:-1!=t.indexOf("#"+n)})}),l.length?(l.unshift({text:"None",value:""}),{name:"anchor",type:"listbox",label:"Anchors",values:l,onselect:n}):void 0}function r(){v&&v.value(e.convertURL(this.value(),"href")),!c&&0===p.text.length&&d&&this.parent().parent().find("#text")[0].value(this.value())}function o(e){var t=k.getContent();if(/</.test(t)&&(!/^<a [^>]+>[^<]+<\/a>$/.test(t)||-1==t.indexOf("href=")))return!1;if(e){var n,l=e.childNodes;if(0===l.length)return!1;for(n=l.length-1;n>=0;n--)if(3!=l[n].nodeType)return!1}return!0}var s,u,c,f,d,h,v,x,g,m,p={},k=e.selection,y=e.dom;s=k.getNode(),u=y.getParent(s,"a[href]"),d=o(),p.text=c=u?u.innerText||u.textContent:k.getContent({format:"text"}),p.href=u?y.getAttrib(u,"href"):"",p.target=u?y.getAttrib(u,"target"):e.settings.default_link_target||null,p.rel=u?y.getAttrib(u,"rel"):null,p["class"]=u?y.getAttrib(u,"class"):null,d&&(h={name:"text",type:"textbox",size:40,label:"Text to display",onchange:function(){p.text=this.value()}}),t&&(v={type:"listbox",label:"Link list",values:l(),onselect:n,value:e.convertURL(p.href,"href"),onPostRender:function(){v=this}}),e.settings.target_list!==!1&&(g={name:"target",type:"listbox",label:"Target",values:i("target_list","target",[{text:"None",value:""},{text:"New window",value:"_blank"}])}),e.settings.rel_list&&(x={name:"rel",type:"listbox",label:"Rel",values:i("rel_list","rel",[{text:"None",value:""}])}),e.settings.link_class_list&&(m={name:"class",type:"listbox",label:"Class",values:i("link_class_list","class")}),f=e.windowManager.open({title:"Insert link",data:p,body:[{name:"href",type:"filepicker",filetype:"file",size:40,autofocus:!0,label:"Url",onchange:r,onkeyup:r},h,a(p.href),v,x,g,m],onSubmit:function(t){function n(t,n){var l=e.selection.getRng();window.setTimeout(function(){e.windowManager.confirm(t,function(t){e.selection.setRng(l),n(t)})},0)}function l(){u?(e.focus(),d&&p.text!=c&&(u.innerText=p.text),y.setAttribs(u,{href:i,target:p.target?p.target:null,rel:p.rel?p.rel:null,"class":p["class"]?p["class"]:null}),k.select(u),e.undoManager.add()):d?e.insertContent(y.createHTML("a",{href:i,target:p.target?p.target:null,rel:p.rel?p.rel:null,"class":p["class"]?p["class"]:null},y.encode(p.text))):e.execCommand("mceInsertLink",!1,{href:i,target:p.target,rel:p.rel?p.rel:null})}var i;return p=tinymce.extend(p,t.data),(i=p.href)?i.indexOf("@")>0&&-1==i.indexOf("//")&&-1==i.indexOf("mailto:")?void n("The URL you entered seems to be an email address. Do you want to add the required mailto: prefix?",function(e){e&&(i="mailto:"+i),l()}):/^\s*www\./i.test(i)?void n("The URL you entered seems to be an external link. Do you want to add the required http:// prefix?",function(e){e&&(i="http://"+i),l()}):void l():void e.execCommand("unlink")}})}e.addButton("link",{icon:"link",tooltip:"Insert/edit link",shortcut:"Ctrl+K",onclick:t(n),stateSelector:"a[href]"}),e.addButton("unlink",{icon:"unlink",tooltip:"Remove link",cmd:"unlink",stateSelector:"a[href]"}),e.addShortcut("Ctrl+K","",t(n)),this.showDialog=n,e.addMenuItem("link",{icon:"link",text:"Insert link",shortcut:"Ctrl+K",onclick:t(n),stateSelector:"a[href]",context:"insert",prependToContext:!0})});