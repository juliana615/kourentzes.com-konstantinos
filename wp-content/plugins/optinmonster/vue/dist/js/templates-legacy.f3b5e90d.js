"use strict";(self["webpackChunkoptinmonster_wordpress_plugin_vue_app"]=self["webpackChunkoptinmonster_wordpress_plugin_vue_app"]||[]).push([[3],{21440:function(e,t,a){a.r(t),a.d(t,{default:function(){return T}});a(74916),a(64765);var s=function(){var e=this,t=e._self._c;return e.reachedCampaignLimit?t("templates-limit-exceeded"):t("core-page",{attrs:{classes:"templates-wrapper"}},[t("common-page-tabnav",{attrs:{current:"templates",tabs:e.tabs}}),t("h1",[e._v("Select a Campaign Type:")]),t("common-alerts",{attrs:{alerts:e.alerts}}),t("div",{staticClass:"templates-content"},[t("templates-types"),t("templates-filters"),t("div",{staticClass:"omapi-content-area"},[t("templates-upsell-alerts"),e.hasTemplates?t("div",{staticClass:"omapi-template-listing-wrap"},[t("templates-grid",{attrs:{templates:e.selectedTemplates}}),e.isLoading?t("svg-loading",{style:{margin:"0 auto"}}):e._e()],1):e.isLoading?t("div",{staticClass:"archie-loader-wrapper"},[t("div",[t("core-loading",{staticClass:"loader"})],1)]):t("div",{staticClass:"no-templates-available"},[e.validType&&e.search?t("core-feedback",{attrs:{"feedback-type":"templates"}},[t("em",[e._v("No templates found. What kind of template are you looking for?")]),t("em",[e._v("Let us know, so we can help you build more effective campaigns!")])]):t("core-alert",{attrs:{type:e.validType?"info":"warn"}},[t("div",{staticClass:"alert-message"},[e._v(" "+e._s(e.noTemplatesMessage)+" ")])])],1)],1)],1),t("campaigns-modal-create-campaign"),t("templates-modal-not-connected"),t("templates-modal-no-access")],1)},i=[],n=a(86080),r=(a(69826),a(41539),a(26699),a(32023),a(2707),a(57327),a(68309),a(21249),a(9653),a(75472)),o=a.n(r),l=a(11700),p=a.n(l),c=a(27361),m=a.n(c),u=a(20629),d=a(81566),f=a(30727),h={mixins:[d.s,f.v],computed:(0,n.Z)((0,n.Z)((0,n.Z)((0,n.Z)({},(0,u.rn)("templates",["activeType","search","sort","popular","templates"])),(0,u.Se)(["reachedCampaignLimit"])),(0,u.Se)("templates",["typePermitted","featured","filters","filterGamified","validType"])),{},{alerts:function(){return this.$get("$store.state.alerts",[])},isLoading:function(){return this.$store.getters.isLoading("templates")},popularTemplates:function(){var e=this.popular[this.activeType];return e&&e.length?this.order(e):[]},featuredTemplates:function(){var e=this.featured[this.activeType];return e&&e.length?this.order(e):[]},showableTemplates:function(){var e=this,t=function(t,a){return!e.filters[t].length||!e.filters[t].find((function(e){return!a.includes(e)}))},a=["popular","featured"].includes(this.sort)?"".concat(this.sort,"Templates"):"templates",s=this[a].filter((function(t){return""===e.search||t.name.toLowerCase().includes(e.search.toLowerCase())})).filter((function(a){var s="mobile"===e.filters.device?a.mobile:!a.mobile;if(!s)return!1;var i=["goals","categories","tags"];return!i.find((function(e){return!t(e,a[e].map((function(e){return e.id})))}))}));return this.order(s)},selectedTemplates:function(){var e=this;return this.showableTemplates.filter((function(t){return e.filterGamified?t.tags.find((function(e){return 1===e.id})):t.type===e.activeType}))},hasTemplates:function(){return this.selectedTemplates.length},shouldShowUpsells:function(){return!!this.$store.getters.connected&&!this.typePermitted(this.activeType)},noTemplatesMessage:function(){return this.validType?"No templates available for your current selection.":"".concat(p()(this.activeType)," is not a valid type. Please select one of the options above.")}}),created:function(){this.$store.dispatch("campaigns/fetchDashboard")["catch"]((function(){})),this.loadApiScript("omwpapi-templates-apijs",this.$constants.TEMPLATES_PREVIEW_ACCOUNT,this.$constants.TEMPLATES_PREVIEW_USER)},mounted:function(){this.fetchTemplateData()["catch"]((function(){})),this.$bus.$emit("dashboard-view-mounted","templates")},methods:(0,n.Z)((0,n.Z)({},(0,u.nv)("templates",["fetchTemplateData"])),{},{applyFilters:function(e){this.$bus.$emit("applied-bulk-filter"),this.$store.commit("templates/appliedFilters",e)},order:function(e){var t=this;return o()(o()(e,(function(e){return"recent"===t.sort||"featured"===t.sort?-t.$moment(e.created_at).valueOf():e.name})),(function(e){return Number(m()(e,"order",0))}))}})},v=h,g=a(1001),y=(0,g.Z)(v,s,i,!1,null,null,null),T=y.exports},30727:function(e,t,a){a.d(t,{v:function(){return s}});var s={data:function(){return{tabs:{templates:{name:"Templates",route:{path:"templates",params:{tab:"popup"}}},playbooks:{name:"Playbooks",route:{path:"playbooks",params:{}}}}}}}},81566:function(e,t,a){a.d(t,{s:function(){return o}});var s=a(73421),i=a(7977),n=a(35562);const r=(e,t,a)=>{let s=document.getElementById(e);if(s)return s;const r=document.getElementsByTagName("head")[0]||document.documentElement;return s=document.createElement("script"),s.type="text/javascript",s.id=e,s.src=n.Z.apiJs(),s.async=!0,s.dataset.account=t,s.dataset.user=a,(0,i.isProduction)()||(s.dataset.env=(0,i.isDevelopment)()?"dev":i.currentEnv),r.appendChild(s),s},o={created(){this.listenApiLoaded(),(0,s.of)(),(0,s.ge)(),(0,s.O0)(),(0,s.vY)(),(0,s.Kp)(),this.$store.subscribe((e=>{const t=["templates/setLoadingPreview","templates/setPreviewing","templates/filterOptions","templates/templates","templates/permittedTypes","templates/recentTemplates","templates/popular","templates/setApiLoaded"],a=["route/ROUTE_CHANGED"];let s=e.type.startsWith("templates/")&&!t.includes(e.type);s||(s=a.includes(e.type)),s&&this.closeAllPreviews()}))},beforeDestroy(){(0,s.of)(!1),(0,s.ge)(!1),(0,s.vY)(!1),(0,s.O0)(!1),(0,s.Kp)(!1)},methods:{listenApiLoaded(e="addEventListener"){["om.Api.init","om.Main.init","om.Campaigns.init","om.Campaign.init"].forEach((t=>document[e](t,this.setApiLoaded)))},setApiLoaded(){this.listenApiLoaded("removeEventListener"),this.$store.commit("templates/setApiLoaded")},closeAllPreviews(){(0,s.IC)(),this.$store.commit("templates/setLoadingPreview",""),this.$store.commit("templates/setPreviewing","")},loadApiScript(e,t,a){return r(e,t,a)}}}}}]);
//# sourceMappingURL=templates-legacy.f3b5e90d.js.map