<?php
 return array (
  'name' => 
  array (
    'id' => '5579',
    'modelid' => '1031',
    'field' => 'name',
    'name' => '案例名称',
    'remark' => '',
    'css' => '',
    'minlength' => '2',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '150',
      'defaultvalue' => '',
      'placeholder' => '建议10个字以内',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'style="width:150px;"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'area' => 
  array (
    'id' => '5580',
    'modelid' => '1031',
    'field' => 'area',
    'name' => '面积',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'style="width:150px;"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'style' => 
  array (
    'id' => '5581',
    'modelid' => '1031',
    'field' => 'style',
    'name' => '风格',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '现代|1
简约|2
田园|3
中式|4
欧式|5
美式|6
日式|7
新古典|8
地中海|9
东南亚|10
混搭|11
其他|14',
      'boxtype' => 'checkbox',
      'fieldtype' => 'tinyint',
      'minnumber' => '1',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'housetype' => 
  array (
    'id' => '5582',
    'modelid' => '1031',
    'field' => 'housetype',
    'name' => '户型',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '一居|1
二居|2
三居|3
四居|4
五居及以上|5
复式|6
别墅|7
公寓|8
四合院|13
其他|14',
      'boxtype' => 'select',
      'fieldtype' => 'tinyint',
      'minnumber' => '1',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'companyname' => 
  array (
    'id' => '5583',
    'modelid' => '1031',
    'field' => 'companyname',
    'name' => '装修公司',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box_sql',
    'setting' => 
    array (
      'sql' => 'SELECT `id`,`title` as companyname FROM `wz_m_company` ',
      'field_name' => 'companyname',
      'field_value' => 'id',
      'boxtype' => 'select',
      'fieldtype' => 'varchar',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'designer' => 
  array (
    'id' => '5584',
    'modelid' => '1031',
    'field' => 'designer',
    'name' => '设计师',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box_sql',
    'setting' => 
    array (
      'sql' => 'SELECT `id`,`title` FROM `wz_company_team`  WHERE `companyid`=\'$companyid\'',
      'field_name' => 'title',
      'field_value' => 'id',
      'boxtype' => 'select',
      'fieldtype' => 'varchar',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'companyid' => 
  array (
    'id' => '5585',
    'modelid' => '1031',
    'field' => 'companyid',
    'name' => '所属公司ID',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'materialtotal' => 
  array (
    'id' => '5586',
    'modelid' => '1031',
    'field' => 'materialtotal',
    'name' => '材料总价',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'crafttotal' => 
  array (
    'id' => '5587',
    'modelid' => '1031',
    'field' => 'crafttotal',
    'name' => '工艺总价',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'total' => 
  array (
    'id' => '5588',
    'modelid' => '1031',
    'field' => 'total',
    'name' => '参考报价',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'browsenum' => 
  array (
    'id' => '5589',
    'modelid' => '1031',
    'field' => 'browsenum',
    'name' => '浏览数',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'collectnum' => 
  array (
    'id' => '5590',
    'modelid' => '1031',
    'field' => 'collectnum',
    'name' => '收藏数',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'number',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'cover' => 
  array (
    'id' => '5594',
    'modelid' => '1031',
    'field' => 'cover',
    'name' => '封面图',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'image',
    'setting' => 
    array (
      'upload_allowext' => 'gif|jpg|jpeg|png|bmp',
      'is_water' => '1',
      'is_allow_show_img' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'case' => 
  array (
    'id' => '5595',
    'modelid' => '1031',
    'field' => 'case',
    'name' => '案例图',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'images',
    'setting' => 
    array (
      'defaultvalue' => '',
      'upload_allowext' => 'gif|jpg|jpeg|png|bmp',
      'is_water' => '0',
      'isselectimage' => '1',
      'images_width' => '',
      'images_height' => '',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'cid' => 
  array (
    'id' => '5575',
    'modelid' => '1031',
    'field' => 'cid',
    'name' => '所属栏目',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '请选择栏目',
    'formtype' => 'cid',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '1',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'title' => 
  array (
    'id' => '5576',
    'modelid' => '1031',
    'field' => 'title',
    'name' => '标题',
    'remark' => '',
    'css' => '',
    'minlength' => '2',
    'maxlength' => '80',
    'pattern' => '',
    'errortips' => '请输入标题',
    'formtype' => 'title',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '1',
    'sort' => '2',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'content' => 
  array (
    'id' => '5574',
    'modelid' => '1031',
    'field' => 'content',
    'name' => '正文',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'editor',
    'setting' => 
    array (
      'defaultvalue' => '',
      'enablesaveimage' => '1',
      'watermark_enable' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '8',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'url' => 
  array (
    'id' => '5566',
    'modelid' => '1031',
    'field' => 'url',
    'name' => '链接地址',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'url',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '1',
    'sort' => '11',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'relation' => 
  array (
    'id' => '5572',
    'modelid' => '1031',
    'field' => 'relation',
    'name' => '相关内容',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'relation',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '11',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'addtime' => 
  array (
    'id' => '5562',
    'modelid' => '1031',
    'field' => 'addtime',
    'name' => '添加时间',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'datetime',
    'setting' => 
    array (
      'fieldtype' => 'int',
      'format' => 'Y-m-d H:i:s',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '1',
    'sort' => '12',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'allowcomment' => 
  array (
    'id' => '5569',
    'modelid' => '1031',
    'field' => 'allowcomment',
    'name' => '允许评论',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '允许|1
不允许|0',
      'boxtype' => 'radio',
      'fieldtype' => 'tinyint',
      'minnumber' => '1',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '2',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '17',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'groups' => 
  array (
    'id' => '5565',
    'modelid' => '1031',
    'field' => 'groups',
    'name' => '用户组权限',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'group',
    'setting' => 
    array (
      'groups' => '4,5',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '2',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '18',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'sort' => 
  array (
    'id' => '5567',
    'modelid' => '1031',
    'field' => 'sort',
    'name' => '权重',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '255',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'slider',
    'setting' => 
    array (
      'defaultvalue' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '20',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
  'template' => 
  array (
    'id' => '5568',
    'modelid' => '1031',
    'field' => 'template',
    'name' => '内容页模板',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'template',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '21',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_picture',
    'attr_table' => 'm_picture_data',
  ),
)?>