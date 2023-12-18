import{z as w,A as h,C as v,h as x,o as u,c as g,a as l,w as n,i as c,D as i,b as t,E as r,n as b,r as y,g as _,J as k,f as B}from"./app-9f6d90e0.js";const C={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},E=t("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1),S=[E],V={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:a}){const s=e,f=a;w(()=>s.show,()=>{s.show?document.body.style.overflow="hidden":document.body.style.overflow=null});const d=()=>{s.closeable&&f("close")},m=o=>{o.key==="Escape"&&s.show&&d()};h(()=>document.addEventListener("keydown",m)),v(()=>{document.removeEventListener("keydown",m),document.body.style.overflow=null});const p=x(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"})[s.maxWidth]);return(o,z)=>(u(),g(k,{to:"body"},[l(r,{"leave-active-class":"duration-200"},{default:n(()=>[c(t("div",C,[l(r,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:n(()=>[c(t("div",{class:"fixed inset-0 transform transition-all",onClick:d},S,512),[[i,e.show]])]),_:1}),l(r,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:n(()=>[c(t("div",{class:b(["mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",p.value])},[e.show?y(o.$slots,"default",{key:0}):_("",!0)],2),[[i,e.show]])]),_:3})],512),[[i,e.show]])]),_:3})]))}},$=["type"],W={__name:"SecondaryButton",props:{type:{type:String,default:"button"}},setup(e){return(a,s)=>(u(),B("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"},[y(a.$slots,"default")],8,$))}};export{V as _,W as a};
