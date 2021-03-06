<?php
 return array (
  'title' => 
  array (
    'id' => '5683',
    'modelid' => '1035',
    'field' => 'title',
    'name' => '标题',
    'remark' => '',
    'css' => '',
    'minlength' => '2',
    'maxlength' => '80',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'title',
    'setting' => '',
    'ext_code' => 'datatype="*2-80" sucmsg="OK" errormsg="请填写标题" nullmsg="请填写标题"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '1',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'special' => 
  array (
    'id' => '5688',
    'modelid' => '1035',
    'field' => 'special',
    'name' => '专题图',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请上传图片" nullmsg="请上传图片"',
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
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'address' => 
  array (
    'id' => '5689',
    'modelid' => '1035',
    'field' => 'address',
    'name' => '链接地址',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入链接地址" nullmsg="请输入链接地址"',
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
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'intervene' => 
  array (
    'id' => '5690',
    'modelid' => '1035',
    'field' => 'intervene',
    'name' => '干预值',
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
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'cid' => 
  array (
    'id' => '5682',
    'modelid' => '1035',
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
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'keywords' => 
  array (
    'id' => '5684',
    'modelid' => '1035',
    'field' => 'keywords',
    'name' => '关键词',
    'remark' => '多关键词之间用半角逗号“,”隔开',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'keyword',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '5',
    'search_field' => '1',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '3',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'remark' => 
  array (
    'id' => '5680',
    'modelid' => '1035',
    'field' => 'remark',
    'name' => '摘要',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'textarea',
    'setting' => 
    array (
      'defaultvalue' => '',
      'enablehtml' => '0',
    ),
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
    'sort' => '4',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'thumb' => 
  array (
    'id' => '5678',
    'modelid' => '1035',
    'field' => 'thumb',
    'name' => '缩略图',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'image',
    'setting' => 
    array (
      'upload_allowext' => 'gif|jpg|jpeg|png|bmp',
      'is_water' => '0',
      'is_allow_show_img' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '1',
    'sort' => '5',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'block' => 
  array (
    'id' => '5671',
    'modelid' => '1035',
    'field' => 'block',
    'name' => '添加到区块',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'block',
    'setting' => '',
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'content' => 
  array (
    'id' => '5681',
    'modelid' => '1035',
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
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '8',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'url' => 
  array (
    'id' => '5673',
    'modelid' => '1035',
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
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '1',
    'sort' => '11',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'relation' => 
  array (
    'id' => '5679',
    'modelid' => '1035',
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
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '11',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'addtime' => 
  array (
    'id' => '5670',
    'modelid' => '1035',
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
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'allowcomment' => 
  array (
    'id' => '5676',
    'modelid' => '1035',
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
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '2',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '17',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'groups' => 
  array (
    'id' => '5672',
    'modelid' => '1035',
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
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '5',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '18',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'sort' => 
  array (
    'id' => '5674',
    'modelid' => '1035',
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
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'template' => 
  array (
    'id' => '5675',
    'modelid' => '1035',
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
    'master_field' => '1',
    'ban_field' => '0',
    'location' => '1',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '21',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
  'status' => 
  array (
    'id' => '5677',
    'modelid' => '1035',
    'field' => 'status',
    'name' => '稿件状态',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '通过审核|9
待审|1
定时发送|8
草稿|6',
      'boxtype' => 'radio',
      'fieldtype' => 'tinyint',
      'minnumber' => '1',
      'defaultvalue' => '9',
      'outputtype' => '0',
    ),
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
    'sort' => '30',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'm_special',
    'attr_table' => '',
  ),
)?>