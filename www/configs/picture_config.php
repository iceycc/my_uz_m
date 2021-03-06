<?php
defined('IN_WZ') or exit('No direct script access allowed');
return array(
    'upperletter' =>
        array(
            A=>'0',
            B=>'1',
            C=>'2',
            D=>'3',
            E=>'4',
            F=>'5',
            G=>'6',
            H=>'7',
            I=>'8',
            J=>'9',
            K=>'10',
            L=>'11',
            M=>'12',
            N=>'13',
            O=>'14',
            P=>'15',
            Q=>'16',
            R=>'17',
            S=>'18',
            T=>'19',
            W=>'20',
            X=>'21',
            Y=>'22',
            Z=>'23',
        ),
	'style1' =>
		array(
            1=>'欧式',
            2=>'美式',
            3=>'新古典',
            4=>'中式',
            5=>'新中式',
            6=>'田园',
            7=>'现代',
            8=>'地中海',
            9=>'东南亚',
            10=>'日式',
            11=>'混搭',
            12=>'其他',
		),
    'style' =>
        array(
            1=>'现代',
            2=>'简约',
            3=>'田园',
            4=>'中式',
            5=>'欧式',
            6=>'美式',
            7=>'日式',
            8=>'新古典',
            9=>'地中海',
            10=>'东南亚',
            11=>'混搭',
            14=>'其他',
        ),
    /*'house' =>
		array(
            1=>'一居',
            2=>'二居',
            3=>'三居',
            4=>'四居',
            5=>'五居',
            6=>'复式',
            7=>'别墅',
            8=>'公寓',
            9=>'跃层',
            10=>'loft',
            11=>'联排',
            12=>'独栋',
            13=>'四合院',
            14=>'其他'
		),*/
    'house' =>
        array(
            1=>'一居',
            2=>'二居',
            3=>'三居',
            4=>'四居',
            5=>'多居',
            6=>'复式',
            7=>'别墅',
            8=>'公寓',
            9=>'四合院',
            10=>'其他'
        ),
        'home' =>
        array(
            2=>'一居',
            3=>'二居',
            4=>'三居',
            5=>'四居',
            6=>'五居',
            7=>'六居以上',
            8=>'复式',
            9=>'别墅',
            10=>'公寓',
            11=>'其他'
        ),
         'home1' =>
        array(
            2=>'办公',
            3=>'ktv',
            4=>'餐饮',
            5=>'商铺',
            6=>'美容美发',
            7=>'展厅',
            8=>'酒吧',
            9=>'连锁店面',
            10=>'局部装修',
            11=>'其他装修'
        ),
    'space' =>
        array(
            1=>'玄关',
            2=>'玄关特写',
            3=>'客厅',
            4=>'客厅特写',
            5=>'过道',
            6=>'过道特写',
            7=>'隔断',
            8=>'餐厅',
            9=>'餐厅特写',
            10=>'楼梯',
            11=>'楼梯特写',
            12=>'卧室',
            13=>'卧室特写',
            14=>'书房',
            15=>'书房特写',
            16=>'儿童房',
            17=>'儿童房特写',
            18=>'老人房',
            19=>'老人房特写',
            20=>'衣帽间',
            21=>'衣帽间特写',
            22=>'厨房',
            23=>'厨房特写',
            24=>'卫生间',
            25=>'卫生间特写',
            26=>'阳台',
            27=>'阳台特写',
            28=>'其他',
            29=>'平面图'
        ),
    'space1' =>
        array(
            1=>'玄关',
            3=>'客厅',
            5=>'过道',
            7=>'隔断',
            8=>'餐厅',
            10=>'楼梯',
            12=>'卧室',
            14=>'书房',
            16=>'儿童房',
            18=>'老人房',
            20=>'衣帽间',
            22=>'厨房',
            24=>'卫生间',
            26=>'阳台',
            28=>'其他',
        ),
    'area' =>
        array(
            /*1=>array(
                'name'=>'40㎡以下',
                'min'=>'0',
                'max'=>'40',
            ),
            2=>array(
                'name'=>'40-60㎡',
                'min'=>'40',
                'max'=>'60',
            ),*/
            1=>array(
                'name'=>'60㎡以下',
                'min'=>'0',
                'max'=>'60',
            ),
            3=>array(
                'name'=>'60-80㎡',
                'min'=>'60',
                'max'=>'80',
            ),
            4=>array(
                'name'=>'80-100㎡',
                'min'=>'80',
                'max'=>'100',
            ),
            5=>array(
                'name'=>'100-120㎡',
                'min'=>'100',
                'max'=>'120',
            ),
            6=>array(
                'name'=>'120-150㎡',
                'min'=>'120',
                'max'=>'150',
            ),
            7=>array(
                'name'=>'150-200㎡',
                'min'=>'150',
                'max'=>'200',
            ),
            8=>array(
                'name'=>'200㎡以上',
                'min'=>'200',
                'max'=>'0',
            )
        ),
    'cost' =>
        array(
            /*1=>array(
                'name'=>'2W以下',
                'min'=>'0',
                'max'=>'20000',
            ),
            2=>array(
                'name'=>'2-4W',
                'min'=>'20000',
                'max'=>'40000',
            ),
            3=>array(
                'name'=>'4-6W',
                'min'=>'40000',
                'max'=>'60000',
            ),*/
            1=>array(
                'name'=>'5W以下',
                'min'=>'0',
                'max'=>'50000',
            ),
            4=>array(
                'name'=>'5-10W',
                'min'=>'50000',
                'max'=>'100000',
            ),
            5=>array(
                'name'=>'10-15W',
                'min'=>'100000',
                'max'=>'150000',
            ),
            6=>array(
                'name'=>'15-20W',
                'min'=>'150000',
                'max'=>'200000',
            ),
            7=>array(
                'name'=>'20W以上',
                'min'=>'200000',
                'max'=>'0',
            )
        ),
        'budget' =>
        array(
            1=>array(
                'name'=>'2W以下',
                'min'=>'0',
                'max'=>'20000',
            ),
            2=>array(
                'name'=>'2-4W',
                'min'=>'20000',
                'max'=>'40000',
            ),
            3=>array(
                'name'=>'4-6W',
                'min'=>'40000',
                'max'=>'60000',
            ),
            4=>array(
                'name'=>'6-10W',
                'min'=>'60000',
                'max'=>'100000',
            ),
            5=>array(
                'name'=>'10-15W',
                'min'=>'100000',
                'max'=>'150000',
            ),
            6=>array(
                'name'=>'15-20W',
                'min'=>'150000',
                'max'=>'200000',
            ),
            7=>array(
                'name'=>'20W以上',
                'min'=>'200000',
                'max'=>'0',
            )
        ),
    'color' =>
        array(
            1=>'白色',
            2=>'米色',
            3=>'黄色',
            4=>'橙色',
            5=>'橘色',
            6=>'红色',
            7=>'粉色',
            8=>'绿色',
            9=>'蓝色',
            10=>'紫色',
            11=>'彩色',
            12=>'黑色',
            13=>'棕色',
            14=>'褐色',
            15=>'金色',
            16=>'青色',
            17=>'灰色',
            18=>'原木色'
        ),
    'way'=>
    array(
         1=>'全包',
         2=>'半包',
         3=>'待定',
         4=>'套餐',
         5=>'定制',
        ),
    'renovationcategory'=>
    array(
         1=>'家装',
         2=>'公装',
        ),
    'housecategory'=>
    array(
         1=>'现房新房',
         2=>'期房新房',
         3=>'二手房',
        ),
     'renovation'=>
    array(
         1=>'毛坯装修',
         2=>'改造型装修',
        ),
     'housetype' =>
        array(
            1=>'办公',
            2=>'ktv',
            3=>'餐饮',
            4=>'商铺',
            5=>'美容美发',
            6=>'展厅',
            7=>'酒吧',
            8=>'连锁店面',
            9=>'局部装修',
            10=>'其他装修',
        ),
 'homestyle' =>
        array(
            1=>'小户型',
            2=>'一居',
            3=>'二居',
            4=>'三居',
            5=>'四居',
            6=>'五居',
            7=>'六居以上',
            8=>'复式',
            9=>'别墅',
            10=>'公寓',
            11=>'跃层',
            12=>'庭院',
            13=>'错层',
            14=>'四合院',
            15=>'loft',
            16=>'叠加',
            17=>'独栋',
            18=>'联排',
            19=>'局部装修'
        ),

    'material_selection' =>
        array(
            36=>'灯具',
            37=>'卫浴设备',
            38=>'油漆',
            39=>'瓷砖',
            40=>'门窗',
            41=>'五金',
            42=>'橱柜',
            43=>'地板',
            44=>'暖气设备',
            45=>'壁纸',
            46=>'水龙头',
            47=>'天花板/吊顶',
            48=>'建筑构件',
            49=>'装修材料',
            51=>'家具',
            52=>'儿童家具',
            53=>'地毯',
            171=>'床上用品',
            54=>'窗帘',
            55=>'日用杂品',
            56=>'饰品',
            57=>'办公设备',
            58=>'家用电器',
            59=>'橱用电器'
        ),

    'Decoration_class' =>
        array(
            66=>'收房',
            67=>'设计',
            68=>'预算',
            69=>'合同',
            70=>'拆改',
            71=>'水电',
            72=>'防水',
            73=>'泥瓦和木工',
            75=>'油漆',
            76=>'竣工',
            81=>'软装',
            82=>'环保',
            83=>'入驻'
        ),
    'nodeid' =>
        array(
            1=>'订单已确认',
            2=>'分配装修公司',
            9=>'分配管家',
            10=>'预约量房',
            11=>'上门量房',
            12=>'报价审核',
            15=>'签定意向定金',
            17=>'预交底',
            19=>'签订三方合同',
            21=>'开工仪式',
            23=>'拆改',
            25=>'水电材料验收',
            27=>'水电工程验收',
            28=>'防水工程验收',
            29=>'瓦木材料验收',
            31=>'瓦木工程验收',
            33=>'油漆材料验收',
            35=>'油漆工程验收',
            36=>'安装工程验收',
            37=>'竣工验收',
            39=>'第一次环保检测',
            43=>'第二次环保检测',
            45=>'维保节点',
            49=>'环保治理',
            51=>'环保治理复测'
        ),
    'node_id' =>
        array(
            0=>array(
                1=>1,
            ),
            1=>array(
                1=>2,
            ),
            2=>array(
                1=>9,
            ),
            9=>array(
                1=>10,
            ),
            10=>array(
                1=>11,
            ),
            11=>array(
                1=>12,
            ),
            12=>array(
                1=>15,
            ),
            15=>array(
                1=>15,
            ),
            17=>array(
                1=>19,
            ),
            19=>array(
                1=>21,
            ),
            21=>array(
                1=>23,
            ),
            23=>array(
                1=>25,
            ),
            25=>array(
                1=>27,
            ),
            27=>array(
                1=>28,
            ),
            28=>array(
                1=>29,
            ),
            29=>array(
                1=>31,
            ),
            31=>array(
                1=>33,
            ),
            33=>array(
                1=>35,
            ),
            35=>array(
                1=>36,
            ),
            36=>array(
                1=>37,
            ),
            37=>array(
                1=>39,
            ),
            39=>array(
                1=>43,
            ),
            43=>array(
                1=>45,
            ),
            45=>array(
                1=>49,
            ),
            49=>array(
                1=>51,
            )
        ),


 'tese' =>
        array(
            1=>'上市公司',
            2=>'装修0增项',
            3=>'环保装修',
            4=>'10年质保',
            5=>'装修管家服务',
            6=>'免费量房',
        )
    ) 
?>