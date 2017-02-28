document.writeln('<script language="javascript" src="banner/scrollnews.js"></' + 'script>');
document.writeln('<table border="0" id="tbNews" style="position:absolute;" align="center" width="100%" style="font-size: 12px; LETTER-SPACING: 2px"><tbody></tbody></table>');

var tbNewsObj = document.getElementById("tbNews");
function CreateScroll()
{
	var tr,td,trAd
	var newsList= news.split('|');
	var adList = ad.split('|');
	var cur=0;
	
	for(var i=0;i<newsList.length;i++)
	{
		tr=document.createElement("tr");
		td=document.createElement("td");
		tr.heigth=18;
		td.align="center";
		td.innerHTML = newsList[i];
		tr.appendChild(td);
		
		trAd=document.createElement("tr");
		trAd.style.display="none";
		td=document.createElement("td");
		trAd.heigth=18;
		
		cur=(cur +1)%adList.length;
		td.innerHTML=adList[cur];
		td.align="center"
		trAd.appendChild(td);
		if(i>1)
		{
			tr.style.display="none";
		}
		
		tbNewsObj.tBodies[0].appendChild(tr);
		tbNewsObj.tBodies[0].appendChild(trAd);
	}
	tbNewsObj.style.top=-18;
	ScrollNews();
}

var ScrollNews_Timer;

function ScrollNews()
{
	tbNewsObj.rows[2].style.display="";
	var pos= parseInt(document.getElementById("tbNews").style.top);
	pos-=3;
	if(pos>-36	)
	{
		tbNewsObj.style.top=pos;
		if (typeof(ScrollNews_Timer) == "number")
			clearTimeout(ScrollNews_Timer);
		ScrollNews_Timer = setTimeout("ScrollNews()",30);
	}
	else
	{
		tr = tbNewsObj.rows[0];
		tr.style.display="none";
		tbNewsObj.tBodies[0].appendChild(tr);
		tbNewsObj.style.top=-18;
		if (typeof(ScrollNews_Timer) == "number")
			clearTimeout(ScrollNews_Timer);
		ScrollNews_Timer = setTimeout("ScrollNews()",5000);
		
	}
}