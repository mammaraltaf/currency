import{o,c as l,D as i,b as e,n,t as r,f as c}from"./app-dde26467.js";const h={key:0,"aria-labelledby":"modal-title","aria-modal":"true",class:"relative",style:{"z-index":"999999"},role:"dialog"},m=e("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),g={class:"fixed inset-0 z-10 overflow-y-auto"},u={class:"flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"},f={class:"relative bg-white rounded-lg shadow dark:bg-gray-700"},v={class:"flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"},w={class:"text-xl font-semibold text-gray-900 dark:text-white"},x=e("svg",{"aria-hidden":"true",class:"w-5 h-5",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"clip-rule":"evenodd",d:"M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z","fill-rule":"evenodd"})],-1),y=e("span",{class:"sr-only"},"Close modal",-1),b=[x,y],_={class:"p-2 space-y-6"},p={name:"Modal"},B=Object.assign(p,{props:{isOpen:{type:Boolean,default:!1},header:String,close:Function,width:String},setup(t){return(s,a)=>(o(),l("div",null,[i(s.$slots,"button"),t.isOpen?(o(),l("div",h,[m,e("div",g,[e("div",u,[e("div",{class:n(["relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full",{"sm:max-w-6xl":t.width==="wide","sm:max-w-lg":!t.width}])},[e("div",f,[e("div",v,[e("h3",w,r(t.header),1),e("button",{class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white","data-modal-hide":"defaultModal",type:"button",onClick:a[0]||(a[0]=(...d)=>t.close&&t.close(...d))},b)]),e("div",_,[i(s.$slots,"content")])])],2)])])])):c("",!0)]))}});export{B as _};
