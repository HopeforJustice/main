import{V as c}from"./js/vueComponentNormalizer.67c9b86e.js";import"./js/index.499c6591.js";import{T as w}from"./js/index.a14fb857.js";import{s as i}from"./js/index.c630c4a6.js";import{k as f,m as u}from"./js/attachments.90c241a0.js";import{i as g}from"./js/isEqual.a6913dc6.js";import{i as h}from"./js/isEmpty.e3b1708a.js";import{s,_ as r}from"./js/default-i18n.0e73c33c.js";import{A as y}from"./js/App.4f8faebd.js";import"./js/client.90beecd8.js";import"./js/_commonjsHelpers.10c44588.js";import"./js/translations.3bc9d58c.js";import"./js/Caret.eeb84d06.js";import"./js/constants.e179df36.js";import"./js/isArrayLikeObject.44af21ce.js";import"./js/helpers.8308b279.js";import"./js/portal-vue.esm.18ed59c3.js";import"./js/vuex.esm.19624049.js";import"./js/cleanForSlug.652f2bfe.js";import"./js/html.9a057d5c.js";import"./js/_baseIsEqual.e22c67bc.js";import"./js/_getTag.3036b7b0.js";/* empty css                */import"./js/params.bea1a08d.js";import"./js/WpTable.61e73015.js";import"./js/Index.cb09fd7a.js";import"./js/JsonValues.08065e69.js";import"./js/SaveChanges.68e73792.js";import"./js/SettingsRow.d7400549.js";import"./js/Row.2d17f2cd.js";import"./js/Checkbox.1903802a.js";import"./js/Checkmark.cdcd77fe.js";import"./js/LicenseKeyBar.970cb266.js";import"./js/LogoGear.24cd9dcf.js";import"./js/Tabs.2c3e6ab7.js";import"./js/TruSeoScore.98a47fd6.js";import"./js/Information.be119534.js";import"./js/Slide.9538a421.js";import"./js/Index.3922afda.js";import"./js/ProBadge.3e5c17e9.js";import"./js/External.98cc7a29.js";import"./js/Exclamation.9f3b358f.js";import"./js/Gear.7c17fabe.js";import"./js/Tooltip.d723c3c3.js";import"./js/Plus.92a90910.js";import"./js/MaxCounts.5a7ca2fd.js";import"./js/RadioToggle.2a5182bd.js";import"./js/GoogleSearchPreview.5fb6bc89.js";import"./js/HtmlTagsEditor.3b1bfa98.js";import"./js/Editor.c1c0327b.js";import"./js/UnfilteredHtml.5b4a03af.js";import"./js/Mobile.2ba6728d.js";import"./js/popup.25df8419.js";import"./js/Index.1a08fa56.js";import"./js/Table.12a616e0.js";import"./js/Affiliate.43fb11f5.js";import"./js/Blur.920c6287.js";import"./js/Index.dfac14e0.js";import"./js/RequiredPlans.45ec8f47.js";import"./js/Image.114d3975.js";import"./js/Img.68436b24.js";import"./js/FacebookPreview.f31f85a9.js";import"./js/Profile.509489df.js";import"./js/TwitterPreview.dcbc91e0.js";import"./js/Book.4f237719.js";import"./js/Settings.cba15e05.js";import"./js/Build.b2521419.js";import"./js/Redirects.fd9cc12f.js";import"./js/Card.184c54d2.js";import"./js/Datepicker.8ae88795.js";import"./js/NewsChannel.3e9f320f.js";import"./js/Radio.955e0694.js";import"./js/Textarea.e385048b.js";import"./js/Eye.b855766c.js";class k extends window.$e.modules.hookUI.Base{constructor(o,e,n){super(),this.hook=o,this.id=e,this.callback=n}getCommand(){return this.hook}getId(){return this.id}apply(){return this.callback()}}class _ extends window.$e.modules.hookData.Base{constructor(o,e,n){super(),this.hook=o,this.id=e,this.callback=n}getCommand(){return this.hook}getId(){return this.id}apply(){return this.callback()}}function a(t,o,e){window.$e.hooks.registerUIAfter(new k(t,o,e))}function E(t,o,e){window.$e.hooks.registerDataAfter(new _(t,o,e))}let m={};const p=()=>{const t=window.elementor.documents.getCurrent();if(!["wp-post","wp-page"].includes(t.config.type))return;const o={...m},e=f();g(o,e)||(m=e,u())},$=()=>{h(i.state.currentPost)||window.elementor.config.document.id===window.elementor.config.document.revisions.current_id&&i.dispatch("saveCurrentPost",i.state.currentPost)},b=()=>{window.$e.internal("document/save/set-is-modified",{status:!0})},v=()=>{a("editor/documents/attach-preview","aioseo-content-scraper-attach-preview",p),a("document/save/set-is-modified","aioseo-content-scraper-on-modified",p),E("document/save/save","aioseo-save",$),window.aioseoBus.$on("postSettingsUpdated",b)},A=()=>{if(window.elementor.config.user.introduction["aioseo-introduction"]===!0)return;const t=new window.elementorModules.editor.utils.Introduction({introductionKey:"aioseo-introduction",dialogType:"alert",dialogOptions:{id:"aioseo-introduction",headerMessage:s(r("New: %1$s %2$s integration","all-in-one-seo-pack"),"AIOSEO","Elementor"),message:s(r("You can now manage your SEO settings inside of %1$s via %2$s before you publish your post!","all-in-one-seo-pack"),"Elementor","All in One SEO"),position:{my:"center center",at:"center center"},strings:{confirm:r("Got It!","all-in-one-seo-pack")},hide:{onButtonClick:!1},onConfirm:()=>{t.setViewed(),t.getDialog().hide()}}});t.show()};c.prototype.$truSeo=new w;const I=()=>{let t=window.elementor.getPreferences("ui_theme")||"auto";t==="auto"&&(t=matchMedia("(prefers-color-scheme: dark)").matches?"dark":"light"),document.body.classList.forEach(o=>{o.startsWith("aioseo-elementor-")&&document.body.classList.remove(o)}),document.body.classList.add("aioseo-elementor-"+t)},C=()=>{window.$e.routes.on("run:after",function(t,o){I(),o==="panel/page-settings/aioseo"&&(new c({store:i,data:{tableContext:window.aioseo.currentPost.context,screenContext:"sidebar"},render:e=>e(y)}).$mount("#elementor-panel-page-settings-controls"),document.getElementById("elementor-panel-page-settings").classList.add("edit-post-sidebar","aioseo-elementor-panel"),u())})},S=()=>{const t=window.elementor.modules.layouts.panel.pages.menu.Menu,o=window.elementor.getPreferences("ui_theme");t.addItem({name:"aioseo",icon:"aioseo aioseo-element-menu-icon aioseo-element-menu-icon-"+o,title:"All in One SEO",type:"page",callback:()=>{try{window.$e.routes.run("panel/page-settings/aioseo")}catch{window.$e.routes.run("panel/page-settings/settings"),window.$e.routes.run("panel/page-settings/aioseo")}}},"more")},d=()=>{S(),C(),A(),v()};let l=!1;window.elementor&&(setTimeout(d),l=!0);(function(t){l||t(window).on("elementor:init",()=>{window.elementor.on("panel:init",()=>{setTimeout(d)})})})(window.jQuery);