import{r as h,k as b,d as N,O as u,l as d,w as c,o as n,a as o,u as g,Z as w,b as i,c as f,g as _,t as v}from"./app-dde26467.js";import{_ as V}from"./GuestLayout-c3b0fdad.js";import{N as B}from"./NewActionButton-f21ab536.js";import{_ as $}from"./NewTextInput-ecde88cf.js";import x from"./DirectTransactionStages-80882b74.js";import F from"./OppositeTransactionStages-ab7d389a.js";import{u as O}from"./notification-8eb2a074.js";import{_ as y}from"./FiftyText-6848784f.js";import"./FlashMessage-95844240.js";import"./Spinner-b5a8aca4.js";/* empty css                                                */import"./_plugin-vue_export-helper-c27b6911.js";/* empty css                                                     */import"./PaymentToReceiverCompleted-2fddfa6f.js";import"./Modal-fae5ac53.js";import"./useAPI-162a5f74.js";import"./useHelpers-046d81e5.js";import"./countries-4c15b513.js";import"./currencies_countries-fbccd8be.js";import"./Initialized-794107e1.js";import"./PairingPending-54b055f9.js";import"./PairingComplete-8de75be1.js";import"./PaymentToOppositeReceiverPending-da1ca6a4.js";import"./FullReceiverItem-54309a1f.js";import"./UploadPaymentProof-6138e35b.js";import"./PaymentToOppositeReceiverConfirmed-5522a2a3.js";import"./TransactionCompleted-03bbe47d.js";import"./TransactionStage-f666b3aa.js";const U=i("title",null,`
                Fifty-Fifty | Transaction
            `,-1),I={class:"timeline-wrapper"},S={class:"timeline relative"},j={key:0,class:"track-steps-wrapper"},C={class:"transaction-info"},E={key:1,class:"track-form-wrapper"},M={name:"Timeline"},pt=Object.assign(M,{props:{transaction:{default:null,type:Object}},setup(e){const l=e;console.log(l.transaction);const k=O(),m=h(""),T=()=>{u.get("/track-transaction?transaction="+m.value)},t=b({}),p=a=>{t.value=a};return N(()=>{var a;t.value=l.transaction,Echo.channel("transaction-channel-"+((a=l.transaction)==null?void 0:a.id)).listen("TransactionUpdated",r=>{k.notify("Transaction has been updated.","success"),u.get("/track-transaction?transaction="+r.transactionId)})}),(a,r)=>(n(),d(V,null,{default:c(()=>[o(g(w),{title:"Fifty-Fifty | Send Money"},{default:c(()=>[U]),_:1}),i("div",I,[i("div",S,[t.value?(n(),f("div",j,[o(y,{variation:"heading-3"},{default:c(()=>{var s;return[_(v((s=e.transaction.user)==null?void 0:s.first_name)+", your money is on its way ",1)]}),_:1}),i("div",C,[o(y,null,{default:c(()=>[_(" Transaction #: ")]),_:1}),i("span",null,v(e.transaction.id),1)]),e.transaction.type==="direct"?(n(),d(x,{key:0,transaction:t.value,onTransactionUpdated:p},null,8,["transaction"])):(n(),d(F,{key:1,transaction:t.value,onTransactionUpdated:p},null,8,["transaction"]))])):(n(),f("div",E,[o($,{modelValue:m.value,"onUpdate:modelValue":r[0]||(r[0]=s=>m.value=s),label:"Transaction Number",placeholder:"Transaction Number (12 chars)",required:"",title:"transactionId"},null,8,["modelValue"]),o(B,{onClick:T,title:"Track",class:"track-form-action-button"})]))])])]),_:1}))}});export{pt as default};
