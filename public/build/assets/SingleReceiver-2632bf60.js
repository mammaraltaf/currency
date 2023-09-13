import{_ as r}from"./AdminLayout-f2e9409d.js";import{c as m,a as o,w as i,u as c,F as v,o as f,Z as h,b as s,g as d,t,O as u}from"./app-dde26467.js";import{u as p}from"./useHelpers-046d81e5.js";import{_ as b}from"./SimpleButton-d9f0bb01.js";import"./ResponsiveNavLink-7e84a44d.js";import"./notification-8eb2a074.js";import"./FlashMessage-95844240.js";import"./CustomSidebar-f7543e53.js";import"./SidebarElement-9f0fe621.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./countries-4c15b513.js";import"./Spinner-b5a8aca4.js";/* empty css                                                */const x=s("title",null,`
            Single Receiver
        `,-1),w={class:"ml-4 md:ml-16"},g={class:"mt-16 mb-8 text-xl flex items-center justify-between"},k=s("span",{class:"text-gray-500"},"receiver:",-1),y={class:"mb-12 flex flex-col mt-12"},B={class:"flex mt-2"},C=s("div",{class:"w-48"},"First name:",-1),O={class:"font-semibold"},S={class:"flex mt-2"},j=s("div",{class:"w-48"},"Last name:",-1),F={class:"font-semibold"},N={class:"flex mt-2"},V=s("div",{class:"w-48"},"Email:",-1),$={class:"font-semibold"},E={class:"flex mt-2"},L=s("div",{class:"w-48"},"Phone:",-1),R={class:"font-semibold"},q={class:"flex mt-2"},A=s("div",{class:"w-48"},"Country:",-1),D={class:"font-semibold"},H={class:"flex mt-2"},I=s("div",{class:"w-48"},"Bank:",-1),J={class:"font-semibold"},P={class:"flex mt-2"},T=s("div",{class:"w-48"},"Account number:",-1),Z={class:"font-semibold"},z={class:"flex mt-2"},G=s("div",{class:"w-48"},"Branch number:",-1),K={class:"font-semibold"},M={class:"flex mt-2"},Q=s("div",{class:"w-48"},"Info / Comments:",-1),U={class:"font-semibold max-w-3xl"},W={class:"flex mt-2"},X=s("div",{class:"w-48"},"Bank:",-1),Y={class:"font-semibold"},ss={class:"flex mt-2"},es=s("div",{class:"w-48"},"Joined at:",-1),ts={class:"font-semibold"},os={name:"Singlereceiver"},bs=Object.assign(os,{props:{receiver:{required:!0,type:Object}},setup(l){const e=l,_=p();return(a,n)=>(f(),m(v,null,[o(c(h),{title:"Single Receiver"},{default:i(()=>[x]),_:1}),o(r,null,{default:i(()=>[s("div",w,[s("div",g,[s("div",null,[k,d(" "+t(e.receiver.first_name)+" "+t(e.receiver.last_name),1)])]),s("div",y,[s("div",B,[C,s("div",O,t(e.receiver.first_name),1)]),s("div",S,[j,s("div",F,t(e.receiver.last_name),1)]),s("div",N,[V,s("div",$,t(e.receiver.email),1)]),s("div",E,[L,s("div",R,t(e.receiver.phone),1)]),s("div",q,[A,s("div",D,t(c(_).getCountryLabelByCode(e.receiver.country))+" ("+t(e.receiver.country)+") ",1)]),s("div",H,[I,s("div",J,t(e.receiver.bank),1)]),s("div",P,[T,s("div",Z,t(e.receiver.account_number),1)]),s("div",z,[G,s("div",K,t(e.receiver.branch_number),1)]),s("div",M,[Q,s("div",U,t(e.receiver.banking_info),1)]),s("div",W,[X,s("div",Y,t(e.receiver.bank),1)]),s("div",ss,[es,s("div",ts,t(e.receiver.created_at),1)])]),o(b,{onClick:n[0]||(n[0]=is=>c(u).get(a.route("receivers.page")))},{default:i(()=>[d(" Back to receivers list ")]),_:1})])]),_:1})],64))}});export{bs as default};
