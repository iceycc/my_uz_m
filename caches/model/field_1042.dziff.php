<?php
 return array (
  'title' => 
  array (
    'id' => '5803',
    'modelid' => '1042',
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
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '1',
    'ban_field' => '1',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '1',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'city' => 
  array (
    'id' => '5805',
    'modelid' => '1042',
    'field' => 'city',
    'name' => '城市',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '北京|3360
天津|3362
深圳|328
广州|326
上海|3361
西安|435
杭州|213
南京|200
武汉|295
郑州|278
成都|382
惠州|336
东莞|342
青岛|262
大连|165',
      'boxtype' => 'checkbox',
      'fieldtype' => 'varchar',
      'defaultvalue' => '',
      'outputtype' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请选择城市" nullmsg="请选择城市"',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'cover' => 
  array (
    'id' => '5806',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'intervene' => 
  array (
    'id' => '5808',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'address' => 
  array (
    'id' => '5810',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'cid' => 
  array (
    'id' => '5802',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'keywords' => 
  array (
    'id' => '5804',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'remark' => 
  array (
    'id' => '5800',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'thumb' => 
  array (
    'id' => '5798',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'block' => 
  array (
    'id' => '5791',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'content' => 
  array (
    'id' => '5801',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'url' => 
  array (
    'id' => '5793',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'relation' => 
  array (
    'id' => '5799',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'addtime' => 
  array (
    'id' => '5790',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'allowcomment' => 
  array (
    'id' => '5796',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'groups' => 
  array (
    'id' => '5792',
    'modelid' => '1042',
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
    'location' => '2',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '0',
    'to_block' => '0',
    'sort' => '18',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'sort' => 
  array (
    'id' => '5794',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'template' => 
  array (
    'id' => '5795',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
  'status' => 
  array (
    'id' => '5797',
    'modelid' => '1042',
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
    'master_table' => 'tjw_picture',
    'attr_table' => '',
  ),
)?>