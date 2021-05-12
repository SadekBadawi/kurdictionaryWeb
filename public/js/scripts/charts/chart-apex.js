$((function(){"use strict";var e=$(".flat-picker"),a="rtl"===$("html").attr("data-textdirection"),o={series1:"#826af9",series2:"#d2b0ff",bg:"#f8d3ff"},t={series1:"#ffe700",series2:"#00d4bd",series3:"#826bf8",series4:"#2b9bf4",series5:"#FFA1A1"},r={series3:"#a4f8cd",series2:"#60f2ca",series1:"#2bdac7"};function s(e,a){for(var o=0,t=[];o<e;){var r="w"+(o+1).toString(),s=Math.floor(Math.random()*(a.max-a.min+1))+a.min;t.push({x:r,y:s}),o++}return t}if(e.length){new Date;e.each((function(){$(this).flatpickr({mode:"range",defaultDate:["2019-05-01","2019-05-10"]})}))}var i=document.querySelector("#line-area-chart"),n={chart:{height:400,type:"area",toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{show:!1,curve:"straight"},legend:{show:!0,position:"top"},grid:{xaxis:{lines:{show:!0}}},colors:[r.series3,r.series2,r.series1],series:[{name:"Visits",data:[100,120,90,170,130,160,140,240,220,180,270,280,375]},{name:"Clicks",data:[60,80,70,110,80,100,90,180,160,140,200,220,275]},{name:"Sales",data:[20,40,30,70,40,60,50,140,120,100,140,180,220]}],xaxis:{categories:["7/12","8/12","9/12","10/12","11/12","12/12","13/12","14/12","15/12","16/12","17/12","18/12","19/12","20/12"]},fill:{opacity:1,type:"solid"},tooltip:{shared:!1},yaxis:{opposite:a}};void 0!==typeof i&&null!==i&&new ApexCharts(i,n).render();var l=document.querySelector("#column-chart"),d={chart:{height:400,type:"bar",stacked:!0,toolbar:{show:!1}},plotOptions:{bar:{columnWidth:"15%",colors:{backgroundBarColors:[o.bg,o.bg,o.bg,o.bg,o.bg],backgroundBarRadius:10}}},dataLabels:{enabled:!1},legend:{show:!1},colors:[o.series1,o.series2],stroke:{show:!0,colors:["transparent"]},grid:{xaxis:{lines:{show:!0}}},series:[{name:"Apple",data:[90,120,55,100,80,125,175,70,88,180]},{name:"Samsung",data:[85,100,30,40,95,90,30,110,62,20]}],xaxis:{categories:["7/12","8/12","9/12","10/12","11/12","12/12","13/12","14/12","15/12","16/12"]},fill:{opacity:1},yaxis:{opposite:a}};void 0!==typeof l&&null!==l&&new ApexCharts(l,d).render();var c=document.querySelector("#scatter-chart"),h={chart:{height:400,type:"scatter",zoom:{enabled:!0,type:"xy"},toolbar:{show:!1}},grid:{xaxis:{lines:{show:!0}}},legend:{show:!1},colors:[window.colors.solid.warning,window.colors.solid.primary,window.colors.solid.success],series:[{name:"Angular",data:[[5.4,170],[5.4,100],[6.3,170],[5.7,140],[5.9,130],[7,150],[8,120],[9,170],[10,190],[11,220],[12,170],[13,230]]},{name:"Vue",data:[[14,220],[15,280],[16,230],[18,320],[17.5,280],[19,250],[20,350],[20.5,320],[20,320],[19,280],[17,280],[22,300],[18,120]]},{name:"React",data:[[14,290],[13,190],[20,220],[21,350],[21.5,290],[22,220],[23,140],[19,400],[20,200],[22,90],[20,120]]}],xaxis:{tickAmount:10,labels:{formatter:function(e){return parseFloat(e).toFixed(1)}}},yaxis:{opposite:a}};void 0!==typeof c&&null!==c&&new ApexCharts(c,h).render();var p=document.querySelector("#line-chart"),m={chart:{height:400,type:"line",zoom:{enabled:!1},toolbar:{show:!1}},series:[{data:[280,200,220,180,270,250,70,90,200,150,160,100,150,100,50]}],markers:{strokeWidth:7,strokeOpacity:1,strokeColors:[window.colors.solid.white],colors:[window.colors.solid.warning]},dataLabels:{enabled:!1},stroke:{curve:"straight"},colors:[window.colors.solid.warning],grid:{xaxis:{lines:{show:!0}}},tooltip:{custom:function(e){return'<div class="px-1 py-50"><span>'+e.series[e.seriesIndex][e.dataPointIndex]+"%</span></div>"}},xaxis:{categories:["7/12","8/12","9/12","10/12","11/12","12/12","13/12","14/12","15/12","16/12","17/12","18/12","19/12","20/12","21/12"]},yaxis:{opposite:a}};void 0!==typeof p&&null!==p&&new ApexCharts(p,m).render();var w=document.querySelector("#bar-chart"),u={chart:{height:400,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0,barHeight:"30%",endingShape:"rounded"}},grid:{xaxis:{lines:{show:!1}}},colors:window.colors.solid.info,dataLabels:{enabled:!1},series:[{data:[700,350,480,600,210,550,150]}],xaxis:{categories:["MON, 11","THU, 14","FRI, 15","MON, 18","WED, 20","FRI, 21","MON, 23"]},yaxis:{opposite:a}};void 0!==typeof w&&null!==w&&new ApexCharts(w,u).render();var x=document.querySelector("#candlestick-chart"),f={chart:{height:400,type:"candlestick",toolbar:{show:!1}},series:[{data:[{x:new Date(15387786e5),y:[150,170,50,100]},{x:new Date(15387804e5),y:[200,400,170,330]},{x:new Date(15387822e5),y:[330,340,250,280]},{x:new Date(1538784e6),y:[300,330,200,320]},{x:new Date(15387858e5),y:[320,450,280,350]},{x:new Date(15387876e5),y:[300,350,80,250]},{x:new Date(15387894e5),y:[200,330,170,300]},{x:new Date(15387912e5),y:[200,220,70,130]},{x:new Date(1538793e6),y:[220,270,180,250]},{x:new Date(15387948e5),y:[200,250,80,100]},{x:new Date(15387966e5),y:[150,170,50,120]},{x:new Date(15387984e5),y:[110,450,10,420]},{x:new Date(15388002e5),y:[400,480,300,320]},{x:new Date(1538802e6),y:[380,480,350,450]}]}],xaxis:{type:"datetime"},yaxis:{tooltip:{enabled:!0},opposite:a},grid:{xaxis:{lines:{show:!0}}},plotOptions:{candlestick:{colors:{upward:window.colors.solid.success,downward:window.colors.solid.danger}},bar:{columnWidth:"40%"}}};void 0!==typeof x&&null!==x&&new ApexCharts(x,f).render();var y=document.querySelector("#heatmap-chart"),b={chart:{height:350,type:"heatmap",toolbar:{show:!1}},plotOptions:{heatmap:{enableShades:!1,colorScale:{ranges:[{from:0,to:10,name:"0-10",color:"#b9b3f8"},{from:11,to:20,name:"10-20",color:"#aba4f6"},{from:21,to:30,name:"20-30",color:"#9d95f5"},{from:31,to:40,name:"30-40",color:"#8f85f3"},{from:41,to:50,name:"40-50",color:"#8176f2"},{from:51,to:60,name:"50-60",color:"#7367f0"}]}}},dataLabels:{enabled:!1},legend:{show:!0},series:[{name:"SUN",data:s(24,{min:0,max:60})},{name:"MON",data:s(24,{min:0,max:60})},{name:"TUE",data:s(24,{min:0,max:60})},{name:"WED",data:s(24,{min:0,max:60})},{name:"THU",data:s(24,{min:0,max:60})},{name:"FRI",data:s(24,{min:0,max:60})},{name:"SAT",data:s(24,{min:0,max:60})}],xaxis:{labels:{show:!1},axisBorder:{show:!1},axisTicks:{show:!1}}};void 0!==typeof y&&null!==y&&new ApexCharts(y,b).render();var g=document.querySelector("#radialbar-chart"),S={chart:{height:350,type:"radialBar"},colors:[t.series1,t.series2,t.series4],plotOptions:{radialBar:{size:185,hollow:{size:"25%"},track:{margin:15},dataLabels:{name:{fontSize:"2rem",fontFamily:"Montserrat"},value:{fontSize:"1rem",fontFamily:"Montserrat"},total:{show:!0,fontSize:"1rem",label:"Comments",formatter:function(e){return"80%"}}}}},stroke:{lineCap:"round"},series:[80,50,35],labels:["Comments","Replies","Shares"]};void 0!==typeof g&&null!==g&&new ApexCharts(g,S).render();var v=document.querySelector("#radar-chart"),k={chart:{height:400,type:"radar",toolbar:{show:!1},dropShadow:{enabled:!1,blur:8,left:1,top:1,opacity:.2}},legend:{show:!1},yaxis:{show:!1},series:[{name:"iPhone 11",data:[41,64,81,60,42,42,33,23]},{name:"Samsung s20",data:[65,46,42,25,58,63,76,43]}],colors:[t.series1,t.series3],xaxis:{categories:["Battery","Brand","Camera","Memory","Storage","Display","OS","Price"]},fill:{opacity:[1,.8]},stroke:{show:!1,width:0},markers:{size:0},grid:{show:!1}};void 0!==typeof v&&null!==v&&new ApexCharts(v,k).render();var D=document.querySelector("#donut-chart"),C={chart:{height:350,type:"donut"},legend:{show:!1},labels:["Operational","Networking","Hiring","R&D"],series:[85,16,50,50],colors:[t.series1,t.series5,t.series3,t.series2],dataLabels:{enabled:!0,formatter:function(e,a){return parseInt(e)+"%"}},plotOptions:{pie:{donut:{labels:{show:!0,name:{fontSize:"2rem",fontFamily:"Montserrat"},value:{fontSize:"1rem",fontFamily:"Montserrat",formatter:function(e){return parseInt(e)+"%"}},total:{show:!0,fontSize:"1.5rem",label:"Operational",formatter:function(e){return"31%"}}}}}},responsive:[{breakpoint:992,options:{chart:{height:380},legend:{position:"bottom"}}},{breakpoint:576,options:{chart:{height:320},plotOptions:{pie:{donut:{labels:{show:!0,name:{fontSize:"1.5rem"},value:{fontSize:"1rem"},total:{fontSize:"1.5rem"}}}}},legend:{show:!1}}},{breakpoint:420,options:{legend:{show:!1}}}]};void 0!==typeof D&&null!==D&&new ApexCharts(D,C).render()}));