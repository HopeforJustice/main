(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["redirects-Redirects-vue","redirects-lite-Redirects-vue","redirects-pro-Redirects-vue","redirects-pro-RedirectsActivate-vue"],{"50e1":function(t,e,s){"use strict";var i=s("dd0c"),r=s.n(i);r.a},"50f0":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-redirects"},[s("core-card",{attrs:{slug:"addNewRedirection","header-text":t.strings.addNewRedirection}},[s("core-blur",[s("core-add-redirection",{attrs:{type:t.$constants.REDIRECT_TYPES[0].value,query:t.$constants.REDIRECT_QUERY_PARAMS[0].value,slash:t.options.defaults.ignoreSlash,case:t.options.defaults.ignoreCase}})],1)],1),s("core-blur",[s("base-wp-table",{attrs:{filters:t.filters,totals:t.totals.main,columns:t.columns,rows:[],"search-label":t.strings.searchUrls,"bulk-options":t.bulkOptions,"additional-filters":t.additionalFilters}})],1),s("cta",{attrs:{"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-redirects","cta-button-action":"","cta-button-loading":t.activationLoading,"same-tab":"","button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getDocUrl("redirects"),"feature-list":[t.strings.serverRedirects,t.strings.automaticRedirects,t.strings.redirectMonitoring,t.strings.monitoring404]},on:{"cta-button-click":t.activateAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.failed?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})],1)},r=[],n=(s("99af"),s("4de4"),s("7db0"),s("c740"),s("d3b7"),s("3ca3"),s("ddb0"),s("5530")),a=s("2f62"),o=s("9c0e"),l={mixins:[o["d"]],data:function(){return{strings:{addNewRedirection:this.$t.__("Add New Redirection",this.$td),searchUrls:this.$t.__("Search URLs",this.$td),ctaButtonText:this.$t.__("Activate Redirects",this.$tdPro),ctaHeader:this.$t.__("Enable Redirects on your Site",this.$tdPro),serverRedirects:this.$t.__("Fast Server Redirects",this.$td),automaticRedirects:this.$t.__("Automatic Redirects",this.$td),redirectMonitoring:this.$t.__("Redirect Monitoring",this.$td),monitoring404:this.$t.__("404 Monitoring",this.$td),ctaDescription:this.$t.__("Our Redirection Manager allows you to easily create and manage redirects for your broken links to avoid confusing search engines and users, as well as losing valuable backlinks. It even automatically sends users and search engines from your old URLs to your new ones.",this.$td)},bulkOptions:[{label:"",value:""}],failed:!1,activationLoading:!1}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(a["e"])("redirects",["filters","totals","options"])),Object(a["e"])(["addons"])),{},{columns:function(){var t=[{slug:"source_url",label:this.$t.__("Source URL",this.$td)},{slug:"target_url",label:this.$t.__("Target URL",this.$td)},{slug:"hits",label:this.$t.__("Hits",this.$td),width:"97px"},{slug:"type",label:this.$t.__("Type",this.$td),width:"100px"},{slug:"group",label:this.$t.__("Group",this.$td),width:"150px"},{slug:"enabled",label:this.$constants.GLOBAL_STRINGS.enabled,width:"80px"}];if("server"===this.options.main.method){var e=t.findIndex((function(t){return"hits"===t.slug}));-1!==e&&this.$delete(t,e)}return t},additionalFilters:function(){return[{label:this.$t.__("Filter by Group",this.$td),name:"group",options:[{label:this.$t.__("All Groups",this.$td),value:"all"}].concat(this.$constants.REDIRECT_GROUPS)}]}}),methods:Object(n["a"])(Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(a["b"])("redirects",["filter","getRedirectOptions"])),Object(a["b"])(["installPlugins"])),Object(a["d"])(["updateAddon"])),{},{activateAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var e=this.addons.find((function(t){return"aioseo-redirects"===t.sku}));this.installPlugins([{plugin:e.basename}]).then((function(s){if(t.activationLoading=!1,s.body.failed.length)t.failed=!0;else{var i=[t.filter({slug:"all"}),t.filter({slug:"logs"}),t.filter({slug:"404"}),t.getRedirectOptions()];Promise.all(i).then((function(){e.isActive=!0,t.updateAddon(e)}))}})).catch((function(){t.activationLoading=!1}))},getColumnLabel:function(t){return 0===t?this.$t.__("Pass through",this.$td):t}})},d=l,c=(s("d1fc"),s("2877")),u=Object(c["a"])(d,i,r,!1,null,null,null);e["default"]=u.exports},"5e56":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-redirects"},[s("core-card",{attrs:{slug:"addNewRedirection","header-text":t.strings.addNewRedirection}},[s("core-blur",[s("core-add-redirection",{attrs:{type:t.$constants.REDIRECT_TYPES[0].value,query:t.$constants.REDIRECT_QUERY_PARAMS[0].value,slash:t.options.defaults.ignoreSlash,case:t.options.defaults.ignoreCase}})],1)],1),s("core-blur",[s("base-wp-table",{attrs:{filters:t.filters,totals:t.totals.main,columns:t.columns,rows:[],"search-label":t.strings.searchUrls,"bulk-options":t.bulkOptions,"additional-filters":t.additionalFilters}})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("redirects","redirects-upsell"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("redirects",null,"home"),"feature-list":[t.strings.serverRedirects,t.strings.automaticRedirects,t.strings.redirectMonitoring,t.strings.monitoring404]},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.$isPro&&t.$addons.requiresUpgrade("aioseo-redirects")&&t.$addons.currentPlans("aioseo-redirects")?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.thisFeatureRequires)+" "),s("strong",[t._v(t._s(t.$addons.currentPlans("aioseo-redirects")))])]):t._e(),t._v(" "+t._s(t.strings.redirectsDescription)+" ")]},proxy:!0}])})],1)},r=[],n=(s("99af"),s("c740"),s("5530")),a=s("2f62"),o=s("9c0e"),l={mixins:[o["d"]],data:function(){return{strings:{addNewRedirection:this.$t.__("Add New Redirection",this.$td),searchUrls:this.$t.__("Search URLs",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Redirects",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Redirects are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),serverRedirects:this.$t.__("Fast Server Redirects",this.$td),automaticRedirects:this.$t.__("Automatic Redirects",this.$td),redirectMonitoring:this.$t.__("Redirect Monitoring",this.$td),monitoring404:this.$t.__("404 Monitoring",this.$td),redirectsDescription:this.$t.__("Our Redirection Manager allows you to easily create and manage redirects for your broken links to avoid confusing search engines and users, as well as losing valuable backlinks. It even automatically sends users and search engines from your old URLs to your new ones.",this.$td),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td)},bulkOptions:[{label:"",value:""}]}},computed:Object(n["a"])(Object(n["a"])({},Object(a["e"])("redirects",["filters","totals","options"])),{},{columns:function(){var t=[{slug:"source_url",label:this.$t.__("Source URL",this.$td)},{slug:"target_url",label:this.$t.__("Target URL",this.$td)},{slug:"hits",label:this.$t.__("Hits",this.$td),width:"97px"},{slug:"type",label:this.$t.__("Type",this.$td),width:"100px"},{slug:"group",label:this.$t.__("Group",this.$td),width:"150px"},{slug:"enabled",label:this.$constants.GLOBAL_STRINGS.enabled,width:"80px"}];if("server"===this.options.main.method){var e=t.findIndex((function(t){return"hits"===t.slug}));-1!==e&&this.$delete(t,e)}return t},additionalFilters:function(){return[{label:this.$t.__("Filter by Group",this.$td),name:"group",options:[{label:this.$t.__("All Groups",this.$td),value:"all"}].concat(this.$constants.REDIRECT_GROUPS)}]}}),methods:Object(n["a"])(Object(n["a"])({},Object(a["b"])("redirects",["filter","bulk","paginate","search","delete"])),{},{getColumnLabel:function(t){return 0===t?this.$t.__("Pass through",this.$td):t}})},d=l,c=(s("9878"),s("2877")),u=Object(c["a"])(d,i,r,!1,null,null,null);e["default"]=u.exports},"75f1":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-redirects-main"},[t.isUnlicensed||!t.$addons.isActive("aioseo-redirects")||t.$addons.requiresUpgrade("aioseo-redirects")?t._e():s("redirects"),t.isUnlicensed||t.$addons.isActive("aioseo-redirects")||!t.$addons.canActivate("aioseo-redirects")||t.$addons.requiresUpgrade("aioseo-redirects")?t._e():s("redirects-activate"),t.isUnlicensed||t.$addons.requiresUpgrade("aioseo-redirects")?s("redirects-lite"):t._e()],1)},r=[],n=s("5530"),a=s("2f62"),o=s("f9ef"),l=s("50f0"),d=s("5e56"),c={components:{Redirects:o["default"],RedirectsActivate:l["default"],RedirectsLite:d["default"]},data:function(){return{strings:{locationsSettings:this.$t.__("Redirects Settings",this.$td)}}},computed:Object(n["a"])(Object(n["a"])({},Object(a["c"])(["isUnlicensed"])),Object(a["e"])(["options","settings"]))},u=c,h=s("2877"),g=Object(h["a"])(u,i,r,!1,null,null,null);e["default"]=g.exports},9878:function(t,e,s){"use strict";var i=s("aa64"),r=s.n(i);r.a},aa64:function(t,e,s){},cdd4:function(t,e,s){},d1fc:function(t,e,s){"use strict";var i=s("cdd4"),r=s.n(i);r.a},dd0c:function(t,e,s){},f9ef:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-redirects"},[s("core-card",{attrs:{slug:"addNewRedirection","header-text":t.strings.addNewRedirection}},[s("core-add-redirection",{attrs:{type:t.getDefaultRedirectType,query:t.getDefaultQueryParam,slash:t.options.defaults.ignoreSlash,case:t.options.defaults.ignoreCase},on:{"added-redirect":t.refreshTable}})],1),s("base-wp-table",{key:t.wpTableKey,attrs:{filters:t.filters,totals:t.totals.main,columns:t.columns,rows:t.rows,loading:t.wpTableLoading,"search-label":t.strings.searchUrls,"bulk-options":t.bulkOptions,"additional-filters":t.additionalFilters},on:{"filter-table":t.filterTable,"process-bulk-action":t.processBulkAction,"process-additional-filters":t.processAdditionalFilters,paginate:t.processPagination,search:t.processSearch},scopedSlots:t._u([{key:"source_url",fn:function(e){var i=e.row,r=e.index,n=e.column,a=e.editRow;return[s("strong",[s("a",{staticClass:"edit-link",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),a(r)}}},[t._v(t._s(n))])]),s("div",{staticClass:"row-actions"},[s("span",{staticClass:"edit"},[s("a",{attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),a(r)}}},[t._v(t._s(t.strings.edit))]),t._v(" | ")]),i.regex?t._e():s("span",{staticClass:"test"},[s("a",{attrs:{href:t.$aioseo.urls.mainSiteUrl+n,target:"_blank"}},[t._v(t._s(t.strings.checkRedirect))]),t._v(" | ")]),s("span",{staticClass:"trash"},[s("a",{staticClass:"submitdelete",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.maybeDeleteRow(r)}}},[t._v(t._s(t.strings.delete))])])])]}},{key:"type",fn:function(e){var s=e.column;return[t._v(" "+t._s(t.getColumnLabel(s))+" ")]}},{key:"enabled",fn:function(e){var i=e.column,r=e.row;return[s("base-toggle",{attrs:{value:i},on:{input:function(e){return t.toggleInput(r,i)}}})]}},{key:"edit-row",fn:function(t){var e=t.row,i=t.editRow;return[s("core-add-redirection",{attrs:{edit:"",url:{id:e.id,url:e.source_url,regex:e.regex,ignoreSlash:e.ignore_slash,ignoreCase:e.ignore_case,showOptions:!0,errors:[],warnings:[]},target:e.target_url,type:e.type,query:e.query_param},on:{cancel:function(t){return i(null)}}})]}}])}),t.showDeleteModal?s("core-modal",{attrs:{"no-header":""},scopedSlots:t._u([{key:"body",fn:function(){return[s("div",{staticClass:"aioseo-modal-body"},[s("button",{staticClass:"close",on:{click:function(e){e.stopPropagation(),t.showDeleteModal=!1}}},[s("svg-close",{on:{click:function(e){t.showDeleteModal=!1}}})],1),s("h3",[t._v(t._s(t.areYouSureDeleteRedirect))]),s("div",{staticClass:"reset-description",domProps:{innerHTML:t._s(t.strings.actionCannotBeUndone)}}),s("base-button",{attrs:{type:"blue",size:"medium",loading:t.deletingRow},on:{click:t.processDeleteRow}},[t._v(" "+t._s(t.yesDeleteRedirect)+" ")]),s("base-button",{attrs:{type:"gray",size:"medium"},on:{click:function(e){t.showDeleteModal=!1}}},[t._v(" "+t._s(t.strings.noChangedMind)+" ")])],1)]},proxy:!0}],null,!1,1995483884)}):t._e()],1)},r=[],n=(s("99af"),s("4de4"),s("7db0"),s("c740"),s("ac1f"),s("841c"),s("5530")),a=s("2f62"),o=s("9c0e"),l={mixins:[o["d"]],data:function(){return{deletingRow:!1,showDeleteModal:!1,shouldDeleteRow:null,wpTableKey:0,wpTableLoading:!1,strings:{addNewRedirection:this.$t.__("Add New Redirection",this.$td),searchUrls:this.$t.__("Search URLs",this.$td),edit:this.$t.__("Edit",this.$td),checkRedirect:this.$t.__("Check Redirect",this.$td),delete:this.$t.__("Delete",this.$td),areYouSureDeleteRedirect:this.$t.__("Are you sure you want to delete this redirect?",this.$td),areYouSureDeleteRedirects:this.$t.__("Are you sure you want to delete these redirects?",this.$td),actionCannotBeUndone:this.$t.__("This action cannot be undone.",this.$td),yesDeleteRedirect:this.$t.__("Yes, I want to delete this redirect",this.$td),yesDeleteRedirects:this.$t.__("Yes, I want to delete these redirects",this.$td),noChangedMind:this.$t.__("No, I changed my mind",this.$td)},bulkOptions:[{label:this.$t.__("Enable",this.$td),value:"enable"},{label:this.$t.__("Disable",this.$td),value:"disable"},{label:this.$t.__("Reset Hits",this.$td),value:"reset-hits"},{label:this.$t.__("Delete",this.$td),value:"delete"}]}},watch:{rows:{deep:!0,handler:function(){this.wpTableKey+=1}}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(a["c"])("redirects",["rows","getCurrentFilter"])),Object(a["e"])("redirects",["filters","totals","options","selectedFilters"])),{},{areYouSureDeleteRedirect:function(){return Array.isArray(this.shouldDeleteRow)?this.strings.areYouSureDeleteRedirects:this.strings.areYouSureDeleteRedirect},yesDeleteRedirect:function(){return Array.isArray(this.shouldDeleteRow)?this.strings.yesDeleteRedirects:this.strings.yesDeleteRedirect},columns:function(){var t=[{slug:"source_url",label:this.$t.__("Source URL",this.$td)},{slug:"target_url",label:this.$t.__("Target URL",this.$td)},{slug:"hits",label:this.$t.__("Hits",this.$td),width:"97px"},{slug:"type",label:this.$t.__("Type",this.$td),width:"100px"},{slug:"group",label:this.$t.__("Group",this.$td),width:"150px"},{slug:"enabled",label:this.$constants.GLOBAL_STRINGS.enabled,width:"80px"}];if("server"===this.options.main.method){var e=t.findIndex((function(t){return"hits"===t.slug}));-1!==e&&this.$delete(t,e)}return t},getDefaultRedirectType:function(){var t=this.getJsonValue(this.options.defaults.redirectType);return t||(t=this.$constants.REDIRECT_TYPES[0]),t.value},getDefaultQueryParam:function(){var t=this.getJsonValue(this.options.defaults.queryParam);return t||(t=this.$constants.REDIRECT_QUERY_PARAMS[0]),t.value},additionalFilters:function(){return[{label:this.$t.__("Filter by Group",this.$td),name:"group",options:[{label:this.$t.__("All Groups",this.$td),value:"all"}].concat(this.$constants.REDIRECT_GROUPS)}]}}),methods:Object(n["a"])(Object(n["a"])({},Object(a["b"])("redirects",["filter","bulk","paginate","search","delete"])),{},{filterTable:function(t){var e=this;this.wpTableLoading=!0,this.filter(t).then((function(){e.wpTableLoading=!1}))},refreshTable:function(){this.filterTable({slug:"all"})},toggleInput:function(t,e){var s=this;this.wpTableLoading=!0,this.bulk({action:e?"disable":"enable",rowIds:[t.id]}).then((function(){s.wpTableLoading=!1}))},processBulkAction:function(t){var e=this,s=t.action,i=t.selectedRows;if(i.length){if("delete"===s)return this.shouldDeleteRow=i,void(this.showDeleteModal=!0);this.wpTableLoading=!0,this.bulk({action:s,rowIds:i}).then((function(){e.wpTableLoading=!1}))}},processAdditionalFilters:function(t){var e=t.filters,s=this.getCurrentFilter||{slug:"all"};this.filterTable({slug:s.slug,additional:e})},processPagination:function(t,e){var s=this;this.wpTableLoading=!0;var i=e?"search":"paginate";this[i]({searchTerm:e,page:t,additional:this.selectedFilters}).then((function(){s.wpTableLoading=!1}))},processSearch:function(t){var e=this;this.wpTableLoading=!0,this.search({searchTerm:t,page:1}).then((function(){e.wpTableLoading=!1}))},getColumnLabel:function(t){return 0===t?this.$t.__("Pass through",this.$td):t},maybeDeleteRow:function(t){var e=this.rows.find((function(e,s){return s===t}));e&&(this.showDeleteModal=!0,this.shouldDeleteRow=e.id)},processDeleteRow:function(){var t=this;if(this.deletingRow=!0,Array.isArray(this.shouldDeleteRow))return this.bulk({action:"delete",rowIds:this.shouldDeleteRow}).then((function(){t.deletingRow=!1,t.showDeleteModal=!1,t.shouldDeleteRow=null,t.refreshTable()}));this.delete(this.shouldDeleteRow).then((function(){t.deletingRow=!1,t.showDeleteModal=!1,t.shouldDeleteRow=null,t.refreshTable()}))}})},d=l,c=(s("50e1"),s("2877")),u=Object(c["a"])(d,i,r,!1,null,null,null);e["default"]=u.exports}}]);