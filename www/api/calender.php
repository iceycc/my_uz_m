<?php

class calender_module{
    private $lunarInfo = array(
            0x4bd8, 0x4ae0, 0xa570, 0x54d5, 0xd260, 0xd950, 0x5554, 0x56af, 0x9ad0, 0x55d2,
            0x4ae0, 0xa5b6, 0xa4d0, 0xd250, 0xd255, 0xb54f, 0xd6a0, 0xada2, 0x95b0, 0x4977,
            0x497f, 0xa4b0, 0xb4b5, 0x6a50, 0x6d40, 0xab54, 0x2b6f, 0x9570, 0x52f2, 0x4970,
            0x6566, 0xd4a0, 0xea50, 0x6a95, 0x5adf, 0x2b60, 0x86e3, 0x92ef, 0xc8d7, 0xc95f,
            0xd4a0, 0xd8a6, 0xb55f, 0x56a0, 0xa5b4, 0x25df, 0x92d0, 0xd2b2, 0xa950, 0xb557,
            0x6ca0, 0xb550, 0x5355, 0x4daf, 0xa5b0, 0x4573, 0x52bf, 0xa9a8, 0xe950, 0x6aa0,
            0xaea6, 0xab50, 0x4b60, 0xaae4, 0xa570, 0x5260, 0xf263, 0xd950, 0x5b57, 0x56a0,
            0x96d0, 0x4dd5, 0x4ad0, 0xa4d0, 0xd4d4, 0xd250, 0xd558, 0xb540, 0xb6a0, 0x95a6,
            0x95bf, 0x49b0, 0xa974, 0xa4b0, 0xb27a, 0x6a50, 0x6d40, 0xaf46, 0xab60, 0x9570,
            0x4af5, 0x4970, 0x64b0, 0x74a3, 0xea50, 0x6b58, 0x5ac0, 0xab60, 0x96d5, 0x92e0,
            0xc960, 0xd954, 0xd4a0, 0xda50, 0x7552, 0x56a0, 0xabb7, 0x25d0, 0x92d0, 0xcab5,
            0xa950, 0xb4a0, 0xbaa4, 0xad50, 0x55d9, 0x4ba0, 0xa5b0, 0x5176, 0x52bf, 0xa930,
            0x7954, 0x6aa0, 0xad50, 0x5b52, 0x4b60, 0xa6e6, 0xa4e0, 0xd260, 0xea65, 0xd530,
            0x5aa0, 0x76a3, 0x96d0, 0x4afb, 0x4ad0, 0xa4d0, 0xd0b6, 0xd25f, 0xd520, 0xdd45,
            0xb5a0, 0x56d0, 0x55b2, 0x49b0, 0xa577, 0xa4b0, 0xaa50, 0xb255, 0x6d2f, 0xada0,
            0x4b63, 0x937f, 0x49f8, 0x4970, 0x64b0, 0x68a6, 0xea5f, 0x6b20, 0xa6c4, 0xaaef,
            0x92e0, 0xd2e3, 0xc960, 0xd557, 0xd4a0, 0xda50, 0x5d55, 0x56a0, 0xa6d0, 0x55d4,
            0x52d0, 0xa9b8, 0xa950, 0xb4a0, 0xb6a6, 0xad50, 0x55a0, 0xaba4, 0xa5b0, 0x52b0,
            0xb273, 0x6930, 0x7337, 0x6aa0, 0xad50, 0x4b55, 0x4b6f, 0xa570, 0x54e4, 0xd260,
            0xe968, 0xd520, 0xdaa0, 0x6aa6, 0x56df, 0x4ae0, 0xa9d4, 0xa4d0, 0xd150, 0xf252,
            0xd520);

    private $solarMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    private $Gan = array("甲", "乙", "丙", "丁", "戊", "己", "庚", "辛", "壬", "癸");
    private $Zhi = array("子", "丑", "寅", "卯", "辰", "巳", "午", "未", "申", "酉", "戌", "亥");
    private $Animals = array("鼠", "牛", "虎", "兔", "龙", "蛇", "马", "羊", "猴", "鸡", "狗", "猪");
    private $solarTerm = array("小寒", "大寒", "立春", "雨水", "惊蛰", "春分", "清明", "谷雨", "立夏", "小满", "芒种", "夏至", "小暑", "大暑", "立秋", "处暑", "白露", "秋分", "寒露", "霜降", "立冬", "小雪", "大雪", "冬至");
    private $sTermInfo = array(0, 21208, 42467, 63836, 85337, 107014, 128867, 150921, 173149, 195551, 218072, 240693, 263343, 285989, 308563, 331033, 353350, 375494, 397447, 419210, 440795, 462224, 483532, 504758);
    private $nStr1 = array('日', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
    private $nStr2 = array('初', '十', '廿', '卅', ' ');

    private $jcName0 = array('建', '除', '满', '平', '定', '执', '破', '危', '成', '收', '开', '闭');
    private $jcName1 = array('闭', '建', '除', '满', '平', '定', '执', '破', '危', '成', '收', '开');
    private $jcName2 = array('开', '闭', '建', '除', '满', '平', '定', '执', '破', '危', '成', '收');
    private $jcName3 = array('收', '开', '闭', '建', '除', '满', '平', '定', '执', '破', '危', '成');
    private $jcName4 = array('成', '收', '开', '闭', '建', '除', '满', '平', '定', '执', '破', '危');
    private $jcName5 = array('危', '成', '收', '开', '闭', '建', '除', '满', '平', '定', '执', '破');
    private $jcName6 = array('破', '危', '成', '收', '开', '闭', '建', '除', '满', '平', '定', '执');
    private $jcName7 = array('执', '破', '危', '成', '收', '开', '闭', '建', '除', '满', '平', '定');
    private $jcName8 = array('定', '执', '破', '危', '成', '收', '开', '闭', '建', '除', '满', '平');
    private $jcName9 = array('平', '定', '执', '破', '危', '成', '收', '开', '闭', '建', '除', '满');
    private $jcName10 = array('满', '平', '定', '执', '破', '危', '成', '收', '开', '闭', '建', '除');
    private $jcName11 = array('除', '满', '平', '定', '执', '破', '危', '成', '收', '开', '闭', '建');

    // 装修、开工、搬家、入宅、结婚、订婚
    private $luckyW = array(array('建','定'),array('开'),array('满'),array('除'),array('执','开'),array('执'));

    private function jcr($d) {
        $jcrjx = array();
        if ($d == '建') $jcrjx = array('出行 上任 会友 上书 装修','动土 开仓 嫁娶 纳采');
        if ($d == '除') $jcrjx = array('除服 疗病 出行 拆卸 入宅','求官 上任 开张 搬家 探病');
        if ($d == '满') $jcrjx = array('祈福 祭祀 结亲 开市 交易 搬家','服药 求医 栽种 动土 迁移');
        if ($d == '平') $jcrjx = array('祭祀 修填 涂泥','移徙 入宅 嫁娶 开市 安葬');
        if ($d == '定') $jcrjx = array('立券 会友 签约 纳畜 装修','种植 置业 卖田 掘井 造船');
        if ($d == '执') $jcrjx = array('祈福 祭祀 求子 结婚 立约 订婚','开市 交易 搬家 远行');
        if ($d == '破') $jcrjx = array('求医 赴考 祭祀','动土 出行 移徙 开市 修造');
        if ($d == '危') $jcrjx = array('经营 交易 求官 纳畜 动土','登高 行船 安床 入宅 博彩');
        if ($d == '成') $jcrjx = array('祈福 入学 开市 求医 成服','词讼 安门 移徙');
        if ($d == '收') $jcrjx = array('祭祀 求财 签约 嫁娶 订盟','开市 安床 安葬 入宅 破土');
        if ($d == '开') $jcrjx = array('疗病 结婚 交易 开工 求职','安葬 动土 针灸');
        if ($d == '闭') $jcrjx = array('祭祀 交易 收财 安葬','宴会 安床 出行 嫁娶 移徙');
        return($jcrjx);
    }

    //国历节日  *表示放假日
    private $sFtv = array(
            "0101*元旦",
            "0106  中国13亿人口日",
            "0110  中国110宣传日",

            "0202  世界湿地日",
            "0204  世界抗癌症日",
            "0210  世界气象日",
            "0214  情人节",
            "0221  国际母语日",
            "0207  国际声援南非日",

            "0303  全国爱耳日",
            "0308  妇女节",
            "0312  植树节 孙中山逝世纪念日",
            "0315  消费者权益保护日",
            "0321  世界森林日",
            "0322  世界水日",
            "0323  世界气象日",
            "0324  世界防治结核病日",

            "0401  愚人节",
            "0407  世界卫生日",
            "0422  世界地球日",

            "0501*国际劳动节",
            "0504  中国青年节",
            "0505  全国碘缺乏病日",
            "0508  世界红十字日",
            "0512  国际护士节",
            "0515  国际家庭日",
            "0517  世界电信日",
            "0518  国际博物馆日",
            "0519  中国汶川地震哀悼日 全国助残日",
            "0520  全国学生营养日",
            "0522  国际生物多样性日",
            "0523  国际牛奶日",
            "0531  世界无烟日",

            "0601  国际儿童节",
            "0605  世界环境日",
            "0606  全国爱眼日",
            "0617  防治荒漠化和干旱日",
            "0623  国际奥林匹克日",
            "0625  全国土地日",
            "0626  国际反毒品日",

            "0701  建党节 香港回归纪念日",
            "0707  抗日战争纪念日",
            "0711  世界人口日",

            "0801  八一建军节",
            "0815  日本正式宣布无条件投降日",

            "0908  国际扫盲日",
            "0909  毛泽东逝世纪念日",
            "0910  教师节",
            "0916  国际臭氧层保护日",
            "0917  国际和平日",
            "0918  九·一八事变纪念日",
            "0920  国际爱牙日",
            "0927  世界旅游日",
            "0928  孔子诞辰",

            "1001*国庆节 国际音乐节 国际老人节",
            "1002  国际减轻自然灾害日",
            "1004  世界动物日",
            "1007  国际住房日",
            "1008  世界视觉日 全国高血压日",
            "1009  世界邮政日",
            "1010  辛亥革命纪念日 世界精神卫生日",
            "1015  国际盲人节",
            "1016  世界粮食节",
            "1017  世界消除贫困日",
            "1022  世界传统医药日",
            "1024  联合国日",
            "1025  人类天花绝迹日",
            "1026  足球诞生日",
            "1031  万圣节",

            "1107  十月社会主义革命纪念日",
            "1108  中国记者日",
            "1109  消防宣传日",
            "1110  世界青年节",
            "1112  孙中山诞辰",
            "1114  世界糖尿病日",
            "1117  国际大学生节",

            "1201  世界艾滋病日",
            "1203  世界残疾人日",
            "1209  世界足球日",
            "1210  世界人权日",
            "1212  西安事变纪念日",
            "1213  南京大屠杀",
            "1220  澳门回归纪念日",
            "1221  国际篮球日",
            "1224  平安夜",
            "1225  圣诞节 世界强化免疫日",
            "1226  毛泽东诞辰");
    //农历节日  *表示放假日
    private $lFtv = array(
            "0101*春节",
            "0102*大年初二",
            "0103*大年初三",
            "0105  路神生日",
            "0115  元宵节",
            "0202  龙抬头",
            "0219  观世音圣诞",
            "0404  寒食节",
            "0408  佛诞节 ",
            "0505*端午节",
            "0606  天贶节 姑姑节",
            "0624  彝族火把节",
            "0707  七夕情人节",
            "0714  鬼节(南方)",
            "0715  盂兰节",
            "0730  地藏节",
            "0815*中秋节",
            "0909  重阳节",
            "1001  祭祖节",
            "1117  阿弥陀佛圣诞",
            "1208  腊八节 释迦如来成道日",
            "1223  过小年",
            "0100*除夕");
    //某月的第几个星期几; 5,6,7,8 表示到数第 1,2,3,4 个星期几
    private $wFtv = array(
            "0110  黑人节",
            "0150  世界麻风日",
            "0121  日本成人节",
            "0520  母亲节",
            "0530  全国助残日",
            "0630  父亲节",
            "0716  合作节",
            "0730  被奴役国家周",
            "0932  国际和平日",
            "0940  国际聋人节 世界儿童日",
            "1011  国际住房日",
            "1144  感恩节");

    function __construct(){
        date_default_timezone_set("Europe/Berlin");
        $this->Today = time();
        $this->tY = date('Y',$this->Today);
        $this->tM = date('n',$this->Today);
        $this->tD = date('j',$this->Today);
        $this->luckyInfo = array();
        $this->dateInfo = $this->calendar($this->tY,$this->tM);
        $this->tM -= 1;
    }

    /*****************************************************************************
     日期计算
     *****************************************************************************/

    //====================================== 返回农历 y年的总天数
    private function lYearDays($y) {
        $i;
        $sum = 348;
        for ($i = 0x8000; $i > 0x8; $i >>= 1) $sum += ($this->lunarInfo[$y - 1900] & $i) ? 1 : 0;
        return($sum + $this->leapDays($y));
    }

    //====================================== 返回农历 y年闰月的天数
    private function leapDays($y) {
        if ($this->leapMonth($y)) return( ($this->lunarInfo[$y - 1899] & 0xf) == 0xf ? 30 : 29);
        else return(0);
    }

    //====================================== 返回农历 y年闰哪个月 1-12 , 没闰返回 0
    private function leapMonth($y) {
        $lm = $this->lunarInfo[$y - 1900] & 0xf;
        return($lm == 0xf ? 0 : $lm);
    }

    //====================================== 返回农历 y年m月的总天数
    private function monthDays($y, $m) {
        return( ($this->lunarInfo[$y - 1900] & (0x10000 >> $m)) ? 30 : 29 );
    }

    private function getFullYear($objDate){
        return date('Y', $objDate);
    }

    private function getMonth($objDate){
        return date('n', $objDate)-1;
    }

    private function getDay($objDate){
        return date('j', $objDate);
    }

    private function getDate($year, $month, $day){
        $month += 1;
        return mktime(8,0,0,$month,$day,$year);
    }

    //====================================== 算出农历, 传入日期控件, 返回农历日期控件
    //                                       该控件属性有 .year .month .day .isLeap
    private function Lunar($objDate) {

        $i;
        $leap = 0;
        $temp = 0;
        $offset = ($this->getDate($this->getFullYear($objDate),$this->getMonth($objDate),$this->getDay($objDate)) + 
                    2206396800) / 86400;
        $offset = (int)$offset;
        for ($i = 1900; $i < 2100 && $offset > 0; $i++) {
            $temp = $this->lYearDays($i);
            $offset -= $temp;
        }

        if ($offset < 0) {
            $offset += $temp;
            $i--;
        }

        $data['year'] = $i;

        $leap = $this->leapMonth($i); //闰哪个月
        $data['isLeap'] = false;

        for ($i = 1; $i < 13 && $offset > 0; $i++) {
            //闰月
            if ($leap > 0 && $i == ($leap + 1) && $data['isLeap'] == false) {
                --$i;
                $data['isLeap'] = true;
                $temp = $this->leapDays($data['year']);
            }
            else {
                $temp = $this->monthDays($data['year'], $i);
            }

            //解除闰月
            if ($data['isLeap'] == true && $i == ($leap + 1)) $data['isLeap'] = false;

            $offset -= $temp;
        }

        if ($offset == 0 && $leap > 0 && $i == $leap + 1)
            if ($data['isLeap']) {
                $data['isLeap'] = false;
            }
            else {
                $data['isLeap'] = true;
                --$i;
            }

        if ($offset < 0) {
            $offset += $temp;
            --$i;
        }

        $data['month'] = $i;
        $data['day'] = $offset + 1;
        return $data;
    }

    //==============================返回公历 y年某m+1月的天数
    private function solarDays($y, $m) {
        if ($m == 1)
            return((($y % 4 == 0) && ($y % 100 != 0) || ($y % 400 == 0)) ? 29 : 28);
        else
            return($this->solarMonth[$m]);
    }
    //============================== 传入 offset 返回干支, 0=甲子
    private function cyclical($num) {
        return($this->Gan[$num % 10] . $this->Zhi[$num % 12]);
    }

    //============================== 传入 offset 返回生肖
    private function animal($num) {
        return($this->Animals[($num - 4) % 12]);
    }

    //============================== 阴历属性
    private function calElement($sYear, $sMonth, $sDay, $week, $lYear, $lMonth, $lDay, $isLeap, $cYear, $cMonth, $cDay) {
        $data = array();

        $data['isToday'] = false;
        //瓣句
        $data['sYear'] = $sYear;   //公元年4位数字
        $data['sMonth'] = $sMonth;  //公元月数字
        $data['sDay'] = $sDay;    //公元日数字
        $data['week'] = $week;    //星期, 1个中文
        //农历
        $data['lYear'] = $lYear;   //公元年4位数字
        $data['lMonth'] = $lMonth;  //农历月数字
        $data['lDay'] = $lDay;    //农历日数字
        $data['isLeap'] = $isLeap;  //是否为农历闰月?
        //八字
        $data['cYear'] = $cYear;   //年柱, 2个中文
        $data['cMonth'] = $cMonth;  //月柱, 2个中文
        $data['cDay'] = $cDay;    //日柱, 2个中文

        #$data['color'] = '';

        $data['lunarFestival'] = ''; //农历节日
        $data['solarFestival'] = ''; //公历节日
        $data['solarTerms'] = ''; //节气
        return $data;
    }

    //===== 某年的第n个节气为几日(从0小寒起算)
    private function sTerm($y, $n) {
        $offDate = date('d',((31556925974.7 * ($y - 1900) + $this->sTermInfo[$n] * 60000 ) -2208549300000)/1000);
        return $offDate;
    }

    //============================== 返回阴历 (y年,m+1月)
    private function cyclical6($num, $num2) {
        if ($num == 0) return($this->jcName0[$num2]);
        if ($num == 1) return($this->jcName1[$num2]);
        if ($num == 2) return($this->jcName2[$num2]);
        if ($num == 3) return($this->jcName3[$num2]);
        if ($num == 4) return($this->jcName4[$num2]);
        if ($num == 5) return($this->jcName5[$num2]);
        if ($num == 6) return($this->jcName6[$num2]);
        if ($num == 7) return($this->jcName7[$num2]);
        if ($num == 8) return($this->jcName8[$num2]);
        if ($num == 9) return($this->jcName9[$num2]);
        if ($num == 10) return($this->jcName10[$num2]);
        if ($num == 11) return($this->jcName11[$num2]);
    }
    private function CalConv2($yy, $mm, $dd, $y, $d, $m, $dt, $nm, $nd) {
        $dy = $d + '' + $dd;
        if (($yy == 0 && $dd == 6) || ($yy == 6 && $dd == 0) || ($yy == 1 && $dd == 7) || ($yy == 7 && $dd == 1) || ($yy == 2 && $dd == 8) || ($yy == 8 && $dd == 2) || ($yy == 3 && $dd == 9) || ($yy == 9 && $dd == 3) || ($yy == 4 && $dd == 10) || ($yy == 10 && $dd == 4) || ($yy == 5 && $dd == 11) || ($yy == 11 && $dd == 5)) {
            return '日值岁破 大事不宜';
        }
        else if (($mm == 0 && $dd == 6) || ($mm == 6 && $dd == 0) || ($mm == 1 && $dd == 7) || ($mm == 7 && $dd == 1) || ($mm == 2 && $dd == 8) || ($mm == 8 && $dd == 2) || ($mm == 3 && $dd == 9) || ($mm == 9 && $dd == 3) || ($mm == 4 && $dd == 10) || ($mm == 10 && $dd == 4) || ($mm == 5 && $dd == 11) || ($mm == 11 && $dd == 5)) {
            return '日值月破 大事不宜';
        }
        else if (($y == 0 && $dy == '911') || ($y == 1 && $dy == '55') || ($y == 2 && $dy == '111') || ($y == 3 && $dy == '75') || ($y == 4 && $dy == '311') || ($y == 5 && $dy == '95') || ($y == 6 && $dy == '511') || ($y == 7 && $dy == '15') || ($y == 8 && $dy == '711') || ($y == 9 && $dy == '35')) {
            return '日值上朔 大事不宜';
        }
        else if (($m == 1 && $dt == 13) || ($m == 2 && $dt == 11) || ($m == 3 && $dt == 9) || ($m == 4 && $dt == 7) || ($m == 5 && $dt == 5) || ($m == 6 && $dt == 3) || ($m == 7 && $dt == 1) || ($m == 7 && $dt == 29) || ($m == 8 && $dt == 27) || ($m == 9 && $dt == 25) || ($m == 10 && $dt == 23) || ($m == 11 && $dt == 21) || ($m == 12 && $dt == 19)) {
            return '日值杨公十三忌 大事不宜';
        }
        else {
            return 0;
        }
    }

    //======================================= 返回该年的复活节(春分后第一次满月周后的第一主日)
    private function easter($y) {

        $term2 = $this->sTerm($y, 5); //取得春分日期
        $dayTerm2 = $this->getdate($y, 2, $term2); //取得春分的公历日期控件(春分一定出现在3月)
        $lDayTerm2 = $this->Lunar($dayTerm2); //取得取得春分农历

        if ($lDayTerm2['day'] < 15) //取得下个月圆的相差天数
            $lMlen = 15 - $lDayTerm2['day'];
        else
            $lMlen = ($lDayTerm2['isLeap'] ? $this->leapDays($y) : $this->monthDays($y, $lDayTerm2['month'])) - $lDayTerm2['day'] + 15;

        //一天等于 1000*60*60*24 = 86400000 毫秒
        $time = microtime();
        $mtime=explode(' ',$time);
        $l15 = $dayTerm2 + 86400 * $lMlen; //求出第一次月圆为公历几日
        $dayEaster = $l15 + 86400 * ( 7 - date('w',$l15)); //求出下个周日

        $data = array();
        $data['m'] = date('n',$dayEaster)-1;
        $data['d'] = date('j',$dayEaster);
        return $data;
    }

    private function dayCheck(&$info, $limit, $begin, $end, $luckyno=-1, $time=-1, $t=0){
        if(count($info) > $limit-1) return;
        if($begin > $end) return;
        $sdate = date('Y-m-d', $begin);
        list($syear,$smonth,$sday) = explode('-',$sdate);
        if($syear != $this->dateInfo['year'] || $smonth != $this->dateInfo['month']){
            $this->luckyInfo = array();
            $this->dateInfo = $this->calendar($syear,$smonth,$t);
        }
        $skey = $sday-1;
        if(!isset($this->luckyInfo[$skey])){
        }else if($luckyno > -1){
            // if($begin > $end) $this->dayCheck($info, $limit, $time, $end, -1, $time, $t);
            $p = stripos(date('d', $begin), $luckyno);
            if($p>0 || $p===0){
                $info[] = $this->dateInfo[$skey];
            }
        }else{
            $info[] = $this->dateInfo[$skey];
        }
        $this->dayCheck($info, $limit, strtotime('+1 day',$begin), $end, $luckyno, $time, $t);
    }

    function calendar($y, $m, $t=0) {
        $y = intval($y);
        $m = intval($m);
        if($y<1901 || $y>2100 || $m<1 || $m>12)return array();
        $m -= 1;
        $sDObj;
        $lDObj;
        $lY;
        $lM;
        $lD = 1;
        $lL;
        $lX = 0;
        $tmp1;
        $tmp2;
        $lM2;
        $lY2=0;
        $lD2;
        $tmp3;
        $dayglus;
        $bsg;
        $xs;
        $xs1;
        $fs;
        $fs1;
        $cs;
        $cs1=0;
        $cY;
        $cM;
        $cD; //年柱,月柱,日柱
        $lDPOS = array(3);
        $n = 0;
        $firstLM = 0;

        $sDObj = $this->getdate($y, $m, 1);    //当月一日日期

        $data = array();
        $data['length'] = $this->solarDays($y, $m);    //公历当月天数
        $data['firstWeek'] = date('w', $sDObj);    //公历当月1日星期几
        $data['year'] = $y;
        $data['month'] = $m+1;

        ////////年柱 1900年立春后为庚子年(60进制36)
        if ($m < 2) $cY = $this->cyclical($y - 1900 + 36 - 1);
        else $cY = $this->cyclical($y - 1900 + 36);
        $term2 = $this->sTerm($y, 2); //立春日期

        ////////月柱 1900年1月小寒以前为 丙子月(60进制12)
        $firstNode = $this->sTerm($y, $m * 2); //返回当月「节」为几日开始
        $cM = $this->cyclical(($y - 1900) * 12 + $m + 12);

        $lM2 = ($y - 1900) * 12 + $m + 12;
        //当月一日与 1900/1/1 相差天数
        //1900/1/1与 1970/1/1 相差25567日, 1900/1/1 日柱为甲戌日(60进制10)
        $dayCyclical = $this->getdate($y, $m, 1) / 86400 + 25567 + 10;

        for ($i = 0; $i < $data['length']; $i++) {

            if ($lD > $lX) {
                $sDObj = $this->getdate($y, $m, $i+1);    //当月一日日期
                $lDObj = $this->Lunar($sDObj);     //农历
                $lY = $lDObj['year'];           //农历年
                $lM = $lDObj['month'];          //农历月
                $lD = $lDObj['day'];            //农历日
                $lL = $lDObj['isLeap'];         //农历是否闰月
                $lX = $lL ? $this->leapDays($lY) : $this->monthDays($lY, $lM); //农历当月最后一天

                if ($n == 0) $firstLM = $lM;
                $lDPOS[$n++] = $i - $lD + 1;
            }

            //依节气调整二月分的年柱, 以立春为界
            if ($m == 1 && ($i + 1) == $term2) {
                $cY = $this->cyclical($y - 1900 + 36);
                $lY2 = ($y - 1900 + 36);
            }
            //依节气月柱, 以「节」为界
            if (($i + 1) == $firstNode) {
                $cM = $this->cyclical(($y - 1900) * 12 + $m + 13);
                $lM2 = ($y - 1900) * 12 + $m + 13;
            }
            //日柱
            $cD = $this->cyclical($dayCyclical + $i);
            $lD2 = ($dayCyclical + $i);

            $data[$i] = $this->calElement($y, $m + 1, $i + 1, $this->nStr1[($i + $data['firstWeek']) % 7],
                    $lY, $lM, $lD++, $lL,
                    $cY, $cM, $cD);


            $data[$i]['sgz5'] = $this->CalConv2($lY2 % 12, $lM2 % 12, ($lD2) % 12, $lY2 % 10, ($lD2) % 10, $lM, $lD - 1, $m + 1, $cs1);
            $data[$i]['sgz3'] = $this->cyclical6($lM2 % 12, ($lD2) % 12);

//            if ($data[$i]['sgz5'] != 0) {
//                $data[$i]['sgz'] = $data[$i]['sgz5'];
//                unset($data[$i]['sgz5']);
//            } else {
//                $data[$i]['sgz'] = $this->jcr($data[$i]['sgz3']);
//                unset($data[$i]['sgz3']);
//            }
            $sgz = $this->jcr($data[$i]['sgz3']);
            $data[$i]['fit'] = explode(' ',$sgz[0]);
            $data[$i]['fear'] = explode(' ',$sgz[1]);
            if(array_search($data[$i]['sgz3'], $this->luckyW[$t],true) !==false) $this->luckyInfo[$i] = $sDObj;
            unset($data[$i]['sgz3'],$data[$i]['sgz5']);
        }

        //节气
        $tmp1 = $this->sTerm($y, $m * 2) - 1;
        $tmp2 = $this->sTerm($y, $m * 2 + 1) - 1;
        $data[$tmp1]['solarTerms'] = $this->solarTerm[$m * 2];
        $data[$tmp2]['solarTerms'] = $this->solarTerm[$m * 2 + 1];
        #if ($m == 3) $data[$tmp1]['color'] = 'red'; //清明颜色

        //国历节日
        foreach ($this->sFtv as $i=>$k)
            if (preg_match('/^(\d{2})(\d{2})([\s\*])(.+)$/',$k,$result))
                if ($result[1] == ($m + 1)) {
                    $data[$result[2] - 1]['solarFestival'] .= $result[4] . '  ';
                    #if ($result[3] == '*')  $data[$result[2] - 1]['color'] = 'red';
                }


        //农历节日
        foreach ($this->lFtv as $i=>$k)
            if (preg_match('/^(\d{2})(.{2})([\s\*])(.+)$/',$k,$result)) {
                $tmp1 = $result[1] - $firstLM;
                if ($tmp1 == -11)  $tmp1 = 1;
                if ($tmp1 >= 0 && $tmp1 < $n) {
                    $tmp2 = $lDPOS[$tmp1] + $result[2] - 1;
                    if ($tmp2 >= 0 && $tmp2 < $data['length']) {
                        $data[$tmp2]['lunarFestival'] .= $result[4] . '  ';
                        #if ($result[3] == '*')  $data[$tmp2]['color'] = 'red';
                    }
                }
            }

        //复活节只出现在3或4月
        if ($m == 2 || $m == 3) {
            $estDay = $this->easter($y);
            if ($m == $estDay['m'])
                $data[$estDay['d'] - 1]['solarFestival'] = $data[$estDay['d'] - 1]['solarFestival'] . ' 复活节';
        }


        //黑色星期五
        if (($data['firstWeek'] + 12) % 7 == 5)
            $data[12]['solarFestival'] .= '黑色星期五';

        //今日
        if ($y == $this->tY && $m == $this->tM) $data[$this->tD - 1]['isToday'] = true;

        #unset($data['length'],$data['firstWeek']);
        return $data;
    }

    //======================  中文日期
    function cDay($d) {
        $s;

        switch ($d) {
            case  10:
                $s = '初十';  break;
            case  20:
                $s = '二十';  break;
                break;
            case  30:
                $s = '三十';  break;
                break;
            default  :
                $s = $this->nStr2[floor($d / 10)];
                $s .= $this->nStr1[$d % 10];
        }
        return($s);
    }

    // 将农历iLunarMonth月格式化成农历表示的字符串
    function FormatLunarMonth($iLunarMonth) {
        $szText = "正二三四五六七八九十";
        $strMonth;
        if ($iLunarMonth <= 10) {
            $strMonth = substr($szText,($iLunarMonth - 1)*3, 3);
        }
        else if ($iLunarMonth == 11) $strMonth = "十一";
        else $strMonth = "腊";
        return $strMonth . "月";
    }

    // 将农历iLunarDay日格式化成农历表示的字符串
    function FormatLunarDay($iLunarDay) {
        $szText1 = "初十廿三";
        $szText2 = "一二三四五六七八九十";
        $strDay;
        if (($iLunarDay != 20) && ($iLunarDay != 30)) {
            $strDay = substr($szText1,intval(($iLunarDay - 1) / 10)*3, 3) . substr($szText2,(($iLunarDay - 1) % 10)*3, 3);
        }
        else if ($iLunarDay != 20) {
            $strDay = substr($szText1,intval($iLunarDay / 10)*3, 3) . "十";
        }
        else {
            $strDay = "二十";
        }
        return $strDay;
    }

    /**
     * 返回幸运日
     * mobile 手机号 可选
     * limit 返回数据条数 0无 可选
     */
    function luckyDays($begin, $end, $limit=12, $mobile=0, $t=0){
        $begin = abs($begin);
        $end = abs($end);
        if(!$begin || !$end || $begin > $end) return array();
        $mobile = abs($mobile);
        $limit = abs($limit)>12?12:abs($limit);
        $luckyno = $mobile > 0 ? $this->luckyNo($mobile): -1;

        $data = array();
        $this->dayCheck($data, $limit, $begin, $end, $luckyno,$begin,$t);

        return $data;
    }

    function luckyNo($mobile){
        $mobile = abs($mobile);
        $s = substr($mobile,-4,4);
        $d = round((round($s*100/80)/100-floor($s/80))*100)/100;
        $d = (string)floor($d*80);
        return $d{0};
    }
}
?>