import{d as h,G as x,A as c,r as w,o as g,c as _,b as i,D as l,m as y,v as b,a as C,w as f,n as u,u as s,H as $,l as k,z as m}from"./app-dde26467.js";const E={class:"relative"},B={__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:()=>["py-1","bg-white dark:bg-gray-700"]}},setup(a){const t=a,o=n=>{e.value&&n.key==="Escape"&&(e.value=!1)};h(()=>document.addEventListener("keydown",o)),x(()=>document.removeEventListener("keydown",o));const d=c(()=>({48:"w-48"})[t.width.toString()]),v=c(()=>t.align==="left"?"origin-top-left left-0":t.align==="right"?"origin-top-right right-0":"origin-top"),e=w(!1);return(n,r)=>(g(),_("div",E,[i("div",{onClick:r[0]||(r[0]=p=>e.value=!e.value)},[l(n.$slots,"trigger")]),y(i("div",{class:"fixed inset-0 z-40",onClick:r[1]||(r[1]=p=>e.value=!1)},null,512),[[b,e.value]]),C($,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:f(()=>[y(i("div",{class:u(["absolute z-50 mt-2 rounded-md shadow-lg",[s(d),s(v)]]),style:{display:"none"},onClick:r[2]||(r[2]=p=>e.value=!1)},[i("div",{class:u(["rounded-md ring-1 ring-black ring-opacity-5",a.contentClasses])},[l(n.$slots,"content")],2)],2),[[b,e.value]])]),_:3})]))}},D={__name:"DropdownLink",setup(a){return(t,o)=>(g(),k(s(m),{class:"block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"},{default:f(()=>[l(t.$slots,"default")]),_:3}))}},L={__name:"ResponsiveNavLink",props:["href","active"],setup(a){const t=a,o=c(()=>t.active?"block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-left text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out":"block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out");return(d,v)=>(g(),k(s(m),{href:a.href,class:u(s(o))},{default:f(()=>[l(d.$slots,"default")]),_:3},8,["href","class"]))}};export{D as _,B as a,L as b};
