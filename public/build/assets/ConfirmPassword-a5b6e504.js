import{T as m,l as n,w as a,o as d,a as e,u as o,Z as c,b as r,g as p,n as f,q as u}from"./app-dde26467.js";import{_}from"./GuestLayout-c3b0fdad.js";import{_ as w}from"./PrimaryButton-5a75b29d.js";import{_ as x}from"./TextInput-f981937c.js";import"./FlashMessage-95844240.js";import"./notification-8eb2a074.js";import"./NewActionButton-f21ab536.js";import"./Spinner-b5a8aca4.js";/* empty css                                                */import"./_plugin-vue_export-helper-c27b6911.js";const b=r("title",null,`
                Confirm Password
            `,-1),h=r("div",{class:"flex flex-col m-auto mt-32 max-w-sm"},[r("div",{class:"mb-4 text-base text-gray-600 dark:text-gray-400"}," This is a secure area of the application. Please confirm your password before continuing. ")],-1),g=["onSubmit"],y={class:"flex justify-start mt-10"},z={__name:"ConfirmPassword",setup(C){const s=m({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(V,t)=>(d(),n(_,null,{default:a(()=>[e(o(c),{title:"Confirm Password"},{default:a(()=>[b]),_:1}),h,r("form",{class:"flex flex-col m-auto mt-8 max-w-sm",onSubmit:u(i,["prevent"])},[r("div",null,[e(x,{id:"password",modelValue:o(s).password,"onUpdate:modelValue":t[0]||(t[0]=l=>o(s).password=l),errors:o(s).errors.password?[o(s).errors.password]:[],autocomplete:"current-password",autofocus:"",class:"mt-1 block w-full",label:"Password",required:"",title:"password",type:"password"},null,8,["modelValue","errors"])]),r("div",y,[e(w,{class:f({"opacity-25":o(s).processing}),disabled:o(s).processing},{default:a(()=>[p(" Confirm ")]),_:1},8,["class","disabled"])])],40,g)]),_:1}))}};export{z as default};
