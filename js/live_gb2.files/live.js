function Update_Live(bh, IsStart, live_a, live_b, a_r, b_r, TStart_Time, Banc, resume, Start_Time, sf, lbsf)
{
	if (typeof(live_f.sDt) != "object" || typeof(live_f.sDt2) != "object") return;
	if (typeof(live_f.sDt[bh]) != "object" || typeof(live_f.sDt2[bh]) != "object") return;
	if (typeof(live_f.ObjArr[bh]) != "object")
		live_f.ObjArr[bh] = new live_f.ElementObj(bh);
	if (live_f.ObjArr[bh].row == null || live_f.ObjArr[bh].row.style.display == "none") return;
	//try
	//{
		var speakgoal = false, speakst = false, speakht = false, speakft = false, speakAred = false, speakBred = false, speakAinefficacy = false, speakBinefficacy = false;
		var resume_v = (resume != "") ? ChangeRsmEncode(resume) : "";
		if (resume_v != "")
		{
			if (resume_v != live_f.sDt2[bh][7])
			{
				live_f.sDt2[bh][7] = resume_v;
				live_f.ObjArr[bh].resume.style.display = "";
				live_f.ObjArr[bh].resume_td.innerHTML = resume_v;
			}
		}
		else
		{
			live_f.sDt2[bh][7] = "";
			live_f.ObjArr[bh].resume.style.display = "none";
			live_f.ObjArr[bh].resume_td.innerHTML = "";
		}
		
		if (live_f.sDt2[bh][0] != IsStart)
		{
			live_f.sDt2[bh][0] = IsStart;
			var State = ChangeState(IsStart);
			live_f.ObjArr[bh].pstatus.innerHTML = State;
			if (IsStart == 4 || IsStart == 10 || IsStart == 12 || IsStart == 16)
			{
				live_f.ObjArr[bh].pstatus.style.color = "#FF0000";
				speakft = true;
			}
			else if (IsStart == 5 || IsStart == 6 || IsStart == 13 || IsStart == 14)
			{
				live_f.ObjArr[bh].pstatus.style.color = "#364DA3";
				if (IsStart != 5)
				{
					live_f.ObjArr[bh].lA.innerHTML = "";
					live_f.ObjArr[bh].lB.innerHTML = "";
					live_f.ObjArr[bh].ptime.style.display = "none";
					live_f.ObjArr[bh].score.style.display = "none";
					live_f.ObjArr[bh].rA.style.display = "none";
					live_f.ObjArr[bh].rB.style.display = "none";
					live_f.ObjArr[bh].hscore.innerHTML = "";
					setTimeout("MoveGame(" + bh + ")", 60000);
				}
			}
			else
			{
				live_f.ObjArr[bh].pstatus.style.color = "#000000";
				if (IsStart == 1)
					speakst = true;
				else if (IsStart == 2)
					speakht = true;
			}
				
			if (IsStart != 17)
			{
				InsertInfo(State,
						   Replace_Team_name(live_f.sDt[bh][2]),
						   live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2],
						   Replace_Team_name(live_f.sDt[bh][3]) + "&nbsp;");
			}
			if (IsStart == 6 || IsStart == 13 || IsStart == 14)
			{
				return;
			}
		}
	
		if (Start_Time != "")
		{
			live_f.sDt2[bh][8] = Start_Time;
			if (timezone_TZ != "+0800")
				Start_Time = AmountTimeDiff(Start_Time, 0);
			var TmpValue = Start_Time.split(",");
			if (TmpValue.length == 6)
				live_f.ObjArr[bh].stime.innerHTML = TmpValue[3] + ":" + TmpValue[4];
		}
			
		if (IsStart == 17)
		{
			live_f.ObjArr[bh].lA.innerHTML = "";
			live_f.ObjArr[bh].lB.innerHTML = "";
			if (live_f.sDt2[bh][6].indexOf("-") != -1)
			{
				live_f.ObjArr[bh].hscore.innerHTML = "";
				live_f.sDt2[bh][6] = "";
			}
			live_f.ObjArr[bh].rA.style.display = "none";
			live_f.ObjArr[bh].rB.style.display = "none";
			live_f.ObjArr[bh].ptime.style.display = "none";
			live_f.ObjArr[bh].score.style.display = "";
			live_f.ObjArr[bh].ptime.innerHTML = "0'";
		}
		else
		{
			if ((IsStart >= 1 && IsStart <= 4) || IsStart == 15)
			{
				if (IsStart == 1 || IsStart == 3)
				{
					if (TStart_Time != "")
					{
						var GetBeginTime = TStart_Time.split(",");
						if (GetBeginTime.length == 6)
						{
							TStart_Time = new Date(GetBeginTime[0], parseFloat(GetBeginTime[1])-1, GetBeginTime[2], GetBeginTime[3], GetBeginTime[4], GetBeginTime[5]);
							live_f.sDt2[bh][5] = TStart_Time;
						}
					}
					live_f.ObjArr[bh].ptime.style.display = "";
				}
				else
				{
					live_f.ObjArr[bh].ptime.style.display = "none";
				}
				if (live_f.ObjArr[bh].lA.innerHTML == "")
				{
					live_f.sDt2[bh][1] = 0;
					live_f.ObjArr[bh].lA.innerHTML = "0";
				}
				if (live_f.ObjArr[bh].lB.innerHTML == "")
				{ 
					live_f.sDt2[bh][2] = 0;
					live_f.ObjArr[bh].lB.innerHTML = "0";
				}
			}
			else
			{
				live_f.ObjArr[bh].ptime.style.display = "none";
			}
			
			if (live_a != live_f.sDt2[bh][1])
			{
				if (live_a < live_f.sDt2[bh][1])
					speakAinefficacy = true;
					
				live_f.sDt2[bh][1] = live_a;
				GoalSound = true;
				live_f.ObjArr[bh].lA.style.color = "#FF0000";
				live_f.ObjArr[bh].lA.innerHTML = live_a;
				live_f.ObjArr[bh].teamA.className = "l5_goal";
				clearTimeout(laT1[bh]);
				laT1[bh] = setTimeout("set_Attribute(" + bh + ", 'lA', 'style.color', '#000000')", 180000);
				clearTimeout(laT2[bh]);
				laT2[bh] = setTimeout("set_Attribute(" + bh + ", 'teamA', 'className', 'l5')", 180000);
				if (SelectGoalTips)
				{
					Gold(0,
						"<font color=red>" + live_f.sDt2[bh][1] + "</font>-" + live_f.sDt2[bh][2], 
						"<font color=red>" + Replace_Team_name(live_f.sDt[bh][2]) + "</font>", 
						Replace_Team_name(live_f.sDt[bh][3]),
						live_f.sDt[bh][0] + (live_f.ObjArr[bh].ptime.style.display == "" ? "[" + live_f.ObjArr[bh].ptime.innerHTML + "]": ""), 
						"#" + live_f.sDt[bh][1]);
				}
				InsertInfo("<img src=http://img.7m.cn/icon/goal.gif>&nbsp;",
				  		   "<font color=red>" + Replace_Team_name(live_f.sDt[bh][2]) + "</font>",
				  		   "<font color=red>" + live_f.sDt2[bh][1] + "</font>-" + live_f.sDt2[bh][2],
				  		   Replace_Team_name(live_f.sDt[bh][3]) + "&nbsp;");
				speakgoal = true;
			}
	
			if (live_b != live_f.sDt2[bh][2])
			{
				if (live_b < live_f.sDt2[bh][2])
					speakBinefficacy = true;
					
				live_f.sDt2[bh][2] = live_b;
				GoalSound = true;
				live_f.ObjArr[bh].lB.style.color = "#FF0000";
				live_f.ObjArr[bh].lB.innerHTML = live_b;
				live_f.ObjArr[bh].teamB.className = "l7_goal";
				clearTimeout(lbT1[bh]);
				lbT1[bh] = setTimeout("set_Attribute(" + bh + ", 'lB', 'style.color', '#000000')", 180000);
				clearTimeout(lbT2[bh]);
				lbT2[bh] = setTimeout("set_Attribute(" + bh + ", 'teamB', 'className', 'l7')", 180000);
				if (SelectGoalTips)
				{
					Gold(1,
						live_f.sDt2[bh][1] + "-<font color=red>" + live_f.sDt2[bh][2] + "</font>", 
						Replace_Team_name(live_f.sDt[bh][2]), 
						"<font color=red>" + Replace_Team_name(live_f.sDt[bh][3]) + "</font>", 
						live_f.sDt[bh][0] + (live_f.ObjArr[bh].ptime.style.display == "" ? "[" + live_f.ObjArr[bh].ptime.innerHTML + "]": ""), 
						"#" + live_f.sDt[bh][1]);	
				}
				InsertInfo("<img src=http://img.7m.cn/icon/goal.gif>&nbsp;",
						   Replace_Team_name(live_f.sDt[bh][2]),
						   live_f.sDt2[bh][1] + "-<font color=red>" + live_f.sDt2[bh][2] + "</font>",
						   "<font color=red>" + Replace_Team_name(live_f.sDt[bh][3]) + "</font>&nbsp;");
				speakgoal = true;
			}
			
			if ((IsStart >= 1 && IsStart <= 3) || IsStart == 5 || (IsStart >=7 && IsStart <= 9) || IsStart == 11)
			{
				live_f.ObjArr[bh].rA.style.display = "";
				live_f.ObjArr[bh].rB.style.display = "";
				live_f.ObjArr[bh].score.style.display = "";
				if (IsStart == 2)
				{
					live_f.ObjArr[bh].ptime.innerHTML = "46'";
					live_f.ObjArr[bh].hscore.innerHTML = live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2];
					live_f.sDt2[bh][6] = live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2];
				}
			}
			else if (IsStart == 4 || IsStart == 12 || IsStart == 15)
			{
				live_f.ObjArr[bh].ptime.style.display = "none";
				live_f.ObjArr[bh].score.style.display = "";
			}
			if (IsStart == 4 || IsStart == 6 || IsStart == 10 || (IsStart >= 12 && IsStart <= 15))
				setTimeout("MoveGame(" + bh + ")", 60000);
			
			if (a_r > 0)
			{
				if (live_f.sDt2[bh][3] != a_r)
				{
					live_f.sDt2[bh][3] = a_r;
					live_f.ObjArr[bh].rA.innerHTML = "<img src=http://img.7m.cn/icon/" + a_r + ".gif>&nbsp;";
					InsertInfo("<img src=http://img.7m.cn/icon/" + a_r + ".gif>&nbsp;",
							   "<font color=red>" + Replace_Team_name(live_f.sDt[bh][2]) + "</font>",
							   live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2],
							   Replace_Team_name(live_f.sDt[bh][3]) + "&nbsp;");
					speakAred = true;
				}
			}
			else
			{
				live_f.sDt2[bh][3] = a_r;
				live_f.ObjArr[bh].rA.innerHTML = "";
			}
			
			if (b_r > 0)
			{
				if (live_f.sDt2[bh][4] != b_r)
				{
					live_f.sDt2[bh][4] = b_r;
					live_f.ObjArr[bh].rB.innerHTML = "&nbsp;<img src=http://img.7m.cn/icon/" + b_r + ".gif>";
					InsertInfo("<img src=http://img.7m.cn/icon/" + b_r + ".gif>&nbsp;",
							   Replace_Team_name(live_f.sDt[bh][2]),
							   live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2],
							   "<font color=red>" + Replace_Team_name(live_f.sDt[bh][3]) + "</font>&nbsp;");
					speakBred = true;
				}
			}
			else
			{
				live_f.sDt2[bh][4] = b_r;
				live_f.ObjArr[bh].rB.innerHTML = "";
			}
			
			if (Banc != "")
			{
				if (Banc == "-")
					Banc = "";
				live_f.sDt2[bh][6] = Banc;
				live_f.ObjArr[bh].hscore.innerHTML = Banc;
			}
		}
		if (typeof(voiArr[bh]) == "number")
		{
			if (speakgoal || speakst || speakht || speakft)
			{
				if (speakAinefficacy || !speakBinefficacy)
					SetVoiLs(live_f.sDt[bh][9]);
				
				if (speakAinefficacy)
					SetVoiLs("#WX");
					
				if (speakBinefficacy)
				{
					SetVoiLs(live_f.sDt[bh][10]);
					SetVoiLs("#WX");
				}
				else
				{
					if (!speakAinefficacy && speak_away == 1)
					{
						SetVoiLs("#VS");
						SetVoiLs(live_f.sDt[bh][10]);
					}
				}
			}
				
			if (speakgoal || speakht || speakft)
				SetVoiLs("#" + live_f.sDt2[bh][1] + "-" + live_f.sDt2[bh][2]);
				
			if (speakst)
				SetVoiLs("#ST");
			else if (speakht)
				SetVoiLs("#HT");
			else if (speakft)
				SetVoiLs("#FT");
			
			if (speakAred)
			{
				SetVoiLs(live_f.sDt[bh][9]);
				SetVoiLs("#" + live_f.sDt2[bh][3] + "r");
			}
			if (speakBred)
			{
				SetVoiLs(live_f.sDt[bh][10]);
				SetVoiLs("#" + live_f.sDt2[bh][4] + "r");
			}
		}
	//}
	//catch(e){}
}