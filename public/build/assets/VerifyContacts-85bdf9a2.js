import{r as i,d as b,l as d,w as o,o as p,a as t,u as n,Z as x,f as I,b as l,g as _,t as v,H as N,O as P}from"./app-dde26467.js";import{u as F}from"./notification-8eb2a074.js";import{_ as M}from"./GuestLayout-c3b0fdad.js";import O from"./VerifyCode-125be5a8.js";import $ from"./TransactionSteps-9b908beb.js";import{_ as y}from"./FiftyText-6848784f.js";import k from"./CardInfo-b74d2c7e.js";import{u as B}from"./useAPI-162a5f74.js";import"./FlashMessage-95844240.js";import"./NewActionButton-f21ab536.js";import"./Spinner-b5a8aca4.js";/* empty css                                                */import"./_plugin-vue_export-helper-c27b6911.js";import"./ResendEmailCode-c7f9a17e.js";import"./NewTextInput-ecde88cf.js";/* empty css                                                     */import"./NewSelectInput-67f8f5a4.js";import"./Modal-fae5ac53.js";import"./currencies_countries-fbccd8be.js";const D=l("title",null,`
                Fifty-Fifty | Send Money
            `,-1),T={class:"transaction-step-wrapper"},j={class:"transaction-step"},E={name:"VerifyContacts"},re=Object.assign(E,{props:{user:{default:null,type:Object}},setup(a){const u=a;B();const r=i("");b(()=>{r.value=new URLSearchParams(window.location.search).get("source"),console.log("paramSource",r.value)});let e=i(!1);const S=()=>(e.value=!0,{showCardInfoDialog:e});function g(c){return console.log("$isFetchData",c),c==!0&&notification.notify("Success","success"),e.value=!1,{showCardInfoDialog:e}}let s=i("verify-contacts");const f=i(!!u.user.email_verified_at),h=F(),w=async()=>{f.value?P.get("/transaction-info"):h.notify("Please verify your information first","error")},V=()=>{f.value=!0,console.log("paramSource.value",r.value),r.value!="direct"?(s.value="transaction-info",w()):(s.value="card-info",S())};return(c,m)=>(p(),d(M,null,{default:o(()=>[t(n(x),{title:"Fifty-Fifty | Send Money"},{default:o(()=>[D]),_:1}),n(e)?(p(),d(k,{key:0,show:n(e),user:u.user,onClose:m[0]||(m[0]=C=>g(C))},null,8,["show","user"])):I("",!0),l("div",T,[l("div",j,[t($,{currentStep:n(s)},null,8,["currentStep"]),t(y,{variation:"heading-3",class:"mb-2"},{default:o(()=>[_(" Email / Phone Verification ")]),_:1}),t(y,{class:"text-center mb-6"},{default:o(()=>[_(" Email verification code sent to email: "+v(a.user.email)+" and Mobile: "+v(a.user.phone),1)]),_:1}),t(N,{mode:"out-in",name:"fade"},{default:o(()=>[t(O,{user:a.user,onVerified:V},null,8,["user"])]),_:1})])])]),_:1}))}});export{re as default};
