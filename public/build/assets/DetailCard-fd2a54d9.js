import{o as n,f as l,b as t,t as i,F as a,k as d}from"./app-9f6d90e0.js";const o={class:"flex flex-wrap min-w-min max-w-sm rounded overflow-hidden shadow-lg place-content-center my-4 py-4 bg-white"},m={class:"max-w-1/2 grid grid-cols-1 place-content-center"},c={class:"inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center justify-center"},r={class:"font-bold text-3xl mb-2"},u=["alt","src"],g={class:"flex mb-4 w-4/5"},f={class:"w-1/3 min-h-min min-w-5 bg-digimon-logo-3 grid grid-cols-1 wrap items-center justify-center"},x={class:"mx-auto py-1"},y={class:"inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mx-2 mb-2 flex items-center justify-center"},v={__name:"DetailCard",props:{digimon:{type:Object,required:!0,default:{id:null,name:null,level:null,attribute:null,type:null,image:null}},status:{type:String}},setup(e){return(_,b)=>(n(),l("div",o,[t("div",m,[t("span",c,i(e.digimon.id??"digi-id"),1),t("div",r,i(e.digimon.name??"misigno"),1)]),t("img",{class:"w-full",alt:e.digimon.name??"Sunset in the mountains",src:e.digimon.image??"https://digi-api.com/images/digimon/w/Garummon.png"},null,8,u),t("div",g,[(n(!0),l(a,null,d([{id:"Level",value:e.digimon.level},{id:"Attribute",value:e.digimon.attribute},{id:"Type",value:e.digimon.type}],s=>(n(),l("div",f,[t("div",x,i(s.id),1),t("span",y,i(s.value??"..."),1)]))),256))])]))}};export{v as default};