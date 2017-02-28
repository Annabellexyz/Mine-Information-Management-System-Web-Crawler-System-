function showAd()
{
	if (!loader)
	{
		if (typeof(showAd_Timer) == "number")
			clearTimeout(showAd_Timer);
		showAd_Timer = setTimeout("showAd()", 200);
		return;
	}
	Head_ad.innerHTML = (new Date().getSeconds() % 2 == 0) ? Head_398_42 : Head_398_42_2;
	if (typeof(topwordAd) == "string")
		topword_ad.innerHTML = topwordAd;
	var ad_str = "";
	for (var i=0;i<L_100_60.length;++i){ad_str += L_100_60[i];}
	l_gg.innerHTML = ad_str;
	ad_str = "";
	for (var i=0;i<R_100_60.length;++i){ad_str += R_100_60[i];}
	r_gg.innerHTML = ad_str;
	c_gg0.innerHTML = C_180_32[0];
	c_gg1.innerHTML = C_180_32[1];
	c_gg2.innerHTML = C_180_32[2];
}
showAd_Timer = setTimeout("showAd()", 200);