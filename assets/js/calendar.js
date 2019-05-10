
// カレンダー生成
function setCalendar(yy,mm) {

	// 年月のセット
	if (!yy && !mm) {
		var yy = new Date().getFullYear();
		var mm = new Date().getMonth();
		mm = mm -(-1);
	}

	var zdate = new Date(yy,mm-1,0); // 前月末
	var tdate = new Date(yy,mm,0); // 当月末
	zedd = zdate.getDate(); // 前月末日
	zedy = zdate.getDay(); // 前月末曜日
	tedd = tdate.getDate(); // 当月末日
	tedy = tdate.getDay(); // 当月末曜日

	// カレンダーに埋める数字を配列daysに格納する（5行で済めば35要素、6行なら42要素）
	var days = [];

	// 前月末が土曜日以外（日曜日から0,1,2・・・土曜日が6）
	if (zedy != 6) {
		// 前月最終日曜日から月末曜日までの日付
		for (var i=zedy; i>=0; i--) {
			days[zedy-i] = (zedd - i);
		}
		// 当月日付
		for (var i=1; i<=tedd; i++) {
			days[zedy+i] = i;
		}
		// 当月末が35番目までに終了
		if ((zedy + tedd) <= 34) {
			// 翌月日付
			for (var i=1; i<35-zedy-tedd; i++) {
				days[zedy+tedd+i] = i;
			}
		// 当月末が35番目を超えて終了
		} else if((zedy + tedd) > 34) {
			// 翌月日付
			for (var i=1; i<42-zedy-tedd; i++) {
				days[zedy+tedd+i] = i;
			}
		}

	// 前月末が土曜日（何月であろうと5行で足りる）
	} else if(zedy == 6) {
		// 当月日付
		for (var i=1; i<=tedd; i++) {
			days[i-1] = i;
		}
		// 翌月日付
		for (var i=0; i<35-tedd; i++) {
			days[tedd+i] = i + 1;
		}
	}

	var dObj = new Date();
	var ty = String(dObj.getFullYear());
	var tm = String(100 + dObj.getMonth() + 1).substr(1,2);

	// 今月のURL
	tourl = 'index?year=' + ty + '&month=' + tm;

	// 前月の取得
	if (mm != 1) {
		bckmm = mm-1;
		bckyy = yy
	} else if (mm == 1) {
		bckmm = 12;
		bckyy = yy - 1;
	}

	// 前月のURL
	bckurl = 'index?year=' + bckyy + '&month=' + ("0" + bckmm).slice(-2);

	// 翌月の取得
	if (mm != 12) {
		yokmm = parseInt(mm) + 1;
		yokyy = yy;
	} else if (mm == 12) {
		yokmm = 1;
		yokyy = parseInt(yy) + 1;
	}

	// 翌月のURL
	yokurl = 'index?year=' + yokyy + '&month=' + ("0" + yokmm).slice(-2);

	// 描画
	out = "<div class='row'>";
	out += "	<div style='width:10%;float:left;margin-top:10px;'>";
	out += "		<a class='btn btn-default btn-sm pull-left' href='" + bckurl + "'><<</a>";
	out += "	</div>";
	out += "	<div style='width:80%;float:left;text-align:center;'>";
	out += "		<a href='" + tourl + "'><font size='6' color='#646464'>" + yy+'年 '+mm+'月' + "</font></a>";
	out += "	</div>";
	out += "	<div style='width:10%;float:left;text-align:right;margin-top:10px;'>";
	out += "		<a class='btn btn-default btn-sm' href='" + yokurl + "'>>></a>";
	out += "	</div>";
	out += "</div>";

	// 曜日
	out += "<div class='row'>";
	out += "<table>";
	var youbi = ["日", "月", "火", "水", "木", "金", "土"];
	out += "<tr>";
	for (var i in youbi) {
		if(i == 0){
			// 日曜日
			fontcolor = "#ED5565";
		}else if(i == 6){
			// 土曜日
			fontcolor = "#008fde";
		}else{
			fontcolor = "#646464";
		}
		out += "<th class='thlink'><font color='" + fontcolor + "'>" + youbi[i] + "</font></th>";
	}

	var bckflg = false;
	var yokflg = false;

	// 行数を計算する
	var row = days.length / 7;

	// 行数分だけループ
	for (var i=1; i<=row; i++) {

		// 曜日
		y = 0;

		out += "<tr>";
		for (var j=7*i-6; j<=7*i; j++) {

			// 前月 OR 翌月の判定
			if(bckflg == true && yokflg == false){
				if(days[j-1] == 1){
					yokflg = true;
				}
			}else if(bckflg == false){
				if(days[j-1] > 1){
					bckflg = false;
				}else if(days[j-1] == 1){
					bckflg = true;
				}
			}

			if(bckflg == false && yokflg == false){
				if(y == 0){
					// 日曜日
					fontcolor = "#ff8787";
				}else if(y == 6){
					// 土曜日
					fontcolor = "#8fc4ff";
				}else{
					fontcolor = "#a09b9d";
				}

				// 前月
				out += "<td class='tdlink' style='background-color:#f0f0f0;'>";
				out += "	<div class='list-group'>";
				out += "		<div class='calday'><font color='" + fontcolor + "'>" + days[j-1] + "</font></div>";
				out += "		<div id='" + bckyy + '-' + ("0" + bckmm).slice(-2) + '-' + ("0" + days[j-1]).slice(-2) + "'>";
			}else if(bckflg == true && yokflg == false){
				if(y == 0){
					// 日曜日
					fontcolor = "#ED5565";
					backcolor = "#ffd2d2";
				}else if(y == 6){
					// 土曜日
					fontcolor = "#008fde";
					backcolor = "#e4f1fd";
				}else{
					fontcolor = "#000000";
					backcolor = "#f9f9f9";
				}

				// 今月
				out += "<td class='tdlink' style='background-color:" + backcolor + ";'>";
				out += "	<div class='list-group'>";
				out += "	<div class='calday'><font color='" + fontcolor + "'>" + days[j-1] + "</font></div>";
				out += "	<div id='" + yy + '-' + ("0" + mm).slice(-2) + '-' + ("0" + days[j-1]).slice(-2) + "'>";
			}else if(bckflg == true && yokflg == true){
				if(y == 0){
					// 日曜日
					fontcolor = "#ff8787";
				}else if(y == 6){
					// 土曜日
					fontcolor = "#8fc4ff";
				}else{
					fontcolor = "#a09b9d";
				}

				// 翌月
				out += "<td class='tdlink' style='background-color:#f0f0f0;'>";
				out += "	<div class='list-group'>";
				out += "	<div class='calday'><font color='" + fontcolor + "'>" + days[j-1] + "</font></div>";
				out += "	<div id='" + yokyy + '-' + ("0" + yokmm).slice(-2) + '-' + ("0" + days[j-1]).slice(-2) + "'>";
			}

			out += "	</div>";
			out += "</div>";
			out += "</td>";

			// 曜日
			y++;
		}
		out += "</tr>";
	}
	out += "</table>";
	out += "</div>";

	document.getElementById("result").innerHTML = out;
}
