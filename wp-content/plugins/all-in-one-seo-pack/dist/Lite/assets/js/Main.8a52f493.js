import{B as c}from"./links.96350b09.js";import{a as r}from"./addons.8cbf7505.js";import{o,c as s,r as m,d as u,w as _,b as l,D as d}from"./vue.runtime.esm-bundler.b39e1078.js";import{_ as i}from"./_plugin-vue_export-helper.b97bdf23.js";import"./index.0eabb636.js";import"./Caret.164d8058.js";/* empty css                                            *//* empty css                                              */import"./default-i18n.3881921e.js";import"./constants.1758f66e.js";import{R as f,a as g}from"./RequiresUpdate.510c2cde.js";/* empty css                                              */import{C as h}from"./Index.7852805c.js";import{a as x}from"./Header.13c036e3.js";import k from"./Overview.75d6bdac.js";import"./isArrayLikeObject.22a096cb.js";import"./upperFirst.8df5cd57.js";import"./_stringToArray.4de3b1f3.js";import"./toString.0891eb3e.js";import"./RequiresUpdate.c97bbc29.js";import"./license.2c6d1a81.js";import"./allowed.d1284ad6.js";/* empty css             */import"./params.f0608262.js";import"./Ellipse.59d453c8.js";import"./LicenseKeyBar.d79b3571.js";import"./LogoGear.c42c709f.js";import"./Logo.1077fe36.js";import"./Support.a273228a.js";import"./Tabs.1b6fc1bb.js";import"./TruSeoScore.29220195.js";import"./Information.70c6532e.js";import"./Slide.cdf6c622.js";import"./Date.4983eb14.js";import"./Exclamation.2f8bed1f.js";import"./Url.254614f3.js";import"./Gear.a85d4a2b.js";import"./AnimatedNumber.b765a5ab.js";import"./numbers.c7cb4085.js";import"./AddonConditions.53c2ef1f.js";import"./Index.f7bbb33f.js";import"./Row.5242dafa.js";import"./Blur.8cc39c73.js";import"./Card.74f1c881.js";import"./Tooltip.6979830f.js";import"./InternalOutbound.4ce419f7.js";import"./DonutChartWithLegend.75733bae.js";import"./SeoSiteScore.4c797f42.js";import"./Row.d3be1f0a.js";import"./RequiredPlans.8c8a85d4.js";const v={};function $(t,n){return o(),s("div")}const A=i(v,[["render",$]]),b={};function y(t,n){return o(),s("div")}const S=i(b,[["render",y]]),w={};function R(t,n){return o(),s("div")}const T=i(w,[["render",R]]),C={};function B(t,n){return o(),s("div")}const L=i(C,[["render",B]]);const M={setup(){return{linkAssistantStore:c()}},components:{CoreMain:h,CoreProcessingPopup:x,DomainsReport:A,LinksReport:S,Overview:k,PostReport:T,Settings:L},mixins:[f,g],data(){return{strings:{pageName:this.$t.__("Link Assistant",this.$td)}}},computed:{excludedTabs(){const t=(r.isActive("aioseo-link-assistant")?this.getExcludedUpdateTabs("aioseo-link-assistant"):this.getExcludedActivationTabs("aioseo-link-assistant"))||[];return t.push("post-report"),t}},mounted(){window.aioseoBus.$on("changes-saved",()=>{this.linkAssistantStore.getMenuData()}),this.$isPro&&this.linkAssistantStore.suggestionsScan.percent!==100&&r.isActive("aioseo-link-assistant")&&!r.requiresUpgrade("aioseo-link-assistant")&&r.hasMinimumVersion("aioseo-link-assistant")&&this.linkAssistantStore.pollSuggestionsScan()}},P={class:"aioseo-link-assistant"};function D(t,n,U,q,e,a){const p=m("core-main");return o(),s("div",P,[u(p,{"page-name":e.strings.pageName,"exclude-tabs":a.excludedTabs,showTabs:t.$route.name!=="post-report"},{default:_(()=>[(o(),l(d(t.$route.name)))]),_:1},8,["page-name","exclude-tabs","showTabs"])])}const Pt=i(M,[["render",D]]);export{Pt as default};
