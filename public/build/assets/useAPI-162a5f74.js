import{r as i,k as c}from"./app-dde26467.js";function f(){const o=i(!1),e=c({}),n=s=>{var t,a;((t=s.response)==null?void 0:t.status)===422?e.value=s.response.data.errors:((a=s.response)==null?void 0:a.status)===419?u():e.value=s},r=()=>{o.value=!0,e.value={}},l=()=>{o.value=!1},u=()=>{window.location=window.location.href};return{handleErrors:n,requestCompleted:l,startRequest:r,isLoading:o,errors:e}}export{f as u};
