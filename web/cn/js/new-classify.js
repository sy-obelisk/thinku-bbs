
function Dsy(){
	this.Items = {};
	this.Inums = {};
}
Dsy.prototype.add = function(id,iArray,iNum){
	this.Items[id] = iArray; // option名称
	this.Inums[id] = iNum; // value值
}
Dsy.prototype.Exists = function(id){
	if(typeof(this.Items[id]) == "undefined") return false;
	return true;
}

function change(v){
	var str="0";
	for(i=0;i<v;i++){
		str+=("_"+(document.getElementById(s[i]).selectedIndex-1));
	};
	var ss=document.getElementById(s[v]);
	if(str.indexOf('0_4') >= 0){
		$('#upBtn').show();
	} else {
    $('#upBtn').hide();
	}
	with(ss){
		length = 0;
		options[0]=new Option(opt0[v],opt0[v]);
		if(v && document.getElementById(s[v-1]).selectedIndex>0 || !v){
			if(dsy.Exists(str)){
				ar = dsy.Items[str];
				arNum = dsy.Inums[str];
				for(i=0;i<ar.length;i++){
					options[length]=new Option(ar[i],arNum[i]);
				}//end for
				if(v){
					options[0].selected = true;
				}
        document.getElementsByTagName('select')[2].style.visibility = 'hidden';
				document.getElementsByTagName('select')[v].style.visibility = 'visible';
			}
		}//end if v
		if(++v<s.length){change(v);}
	}//End with
}

var dsy = new Dsy();

// dsy.add("0",["留学","考试","职业","生活"],["0","1","2","3"]);
dsy.add("0_0_0",["签证","答疑","院校项目","实习就业","面试"],["16","17","18","19","20"]);
dsy.add("0_0_1",["签证","答疑","院校项目","实习就业","面试"],["21","22","23","24","25"]);
dsy.add("0_0_2",["签证","答疑","院校项目","实习就业","面试"],["26","27","28","29","30"]);
dsy.add("0_0_3",["签证","答疑","院校项目","实习就业","面试"],["31","32","33","34","35"]);
dsy.add("0_0_4",["签证","答疑","院校项目","实习就业","面试"],["36","37","38","39","40"]);
dsy.add("0_0_5",["签证","答疑","院校项目","实习就业","面试"],["42","42","43","44","45"]);
dsy.add("0_0_6",["签证","答疑","院校项目","实习就业","面试"],["46","47","48","49","50"]);
dsy.add("0_0_7",["签证","答疑","院校项目","实习就业","面试"],["51","52","53","54","55"]);
dsy.add("0_0",["美国","英国","澳洲","加拿大","香港","新加坡","法国","其他"],["6","7","8","9","10","11","12","13"]);
dsy.add("0_1_0",["答疑","备考经验","资料下载"],["61","62","63"]);
dsy.add("0_1_1",["答疑","备考经验","资料下载"],["64","65","66"]);
dsy.add("0_1_2",["答疑","备考经验","资料下载"],["67","68","69"]);
dsy.add("0_1_3",["答疑","备考经验","资料下载"],["70","71","72"]);
dsy.add("0_1_4",["答疑","备考经验","资料下载"],["73","74","75"]);
dsy.add("0_1",["GMAT","GRE","托福","雅思","SAT"],["56","57","58","59","60"]);
dsy.add("0_2",["金融","大商科","会计","理工科","文科艺术类"],["76","77","78","79","80"]);
dsy.add("0_3",["美国","英国","澳洲","加拿大","香港","新加坡","法国","其他"],["81","82","83","84","85","86","87","88"]);
dsy.add("0_4_0",["院校排名","专业解读","选校方案","留学课件+视频"],["94","95","96","97"]);
dsy.add("0_4_1",["听力资料下载","口语资料下载","阅读资料下载","写作资料下载","TPO资料下载","托福雅思"],["98","99","100","101","102"]);
dsy.add("0_4_2",["SC资料下载","CR资料下载","RC资料下载","作文/IR资料下载","GMAT资料下载"],["103","104","105","106"]);
dsy.add("0_4_3",["阅读资料下载","文法资料下载","数学资料下载","SAT资料下载"],["107","108","109"]);
dsy.add("0_4_4",["GRE备考资料","GRE机经"],["110","111"]);
dsy.add("0_4",["留学","托福雅思","GMAT","SAT","GRE"],["91","90","89","92","93"]);
dsy.add("0",["留学","考试","职业","生活","资料下载"],["2","3","4","5","14"]);

var s=["clsFirst","clsSecond","clsThird"];//三个select的name
var opt0 = ["帖子分类","二级分类","三级分类"];//初始值
window._init_area = function(){  //初始化函数
	for(var i=0;i<s.length-1;i++){
	  document.getElementById(s[i]).onchange = new Function("change("+(i+1)+")");
	}
	change(0);
}
