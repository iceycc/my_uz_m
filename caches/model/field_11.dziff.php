<?php
 return array (
  'accounts_statu' => 
  array (
    'id' => '5525',
    'modelid' => '11',
    'field' => 'accounts_statu',
    'name' => '账号状态',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '正常|1
停用|2
隐藏|3',
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
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'more_test' => 
  array (
    'id' => '5526',
    'modelid' => '11',
    'field' => 'more_test',
    'name' => '状态描述',
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
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '0',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'sign_type' => 
  array (
    'id' => '5838',
    'modelid' => '11',
    'field' => 'sign_type',
    'name' => '设置签约类型',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '收取订单服务费|1
收取订单服务费+佣金|2',
      'boxtype' => 'radio',
      'fieldtype' => 'tinyint',
      'minnumber' => '-1',
      'defaultvalue' => '0',
      'outputtype' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'sms_mobile' => 
  array (
    'id' => '5839',
    'modelid' => '11',
    'field' => 'sms_mobile',
    'name' => '订单短信提示接收号码',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '11',
    'pattern' => '/^(1)[0-9]{10}$/',
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
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'companyname' => 
  array (
    'id' => '5103',
    'modelid' => '11',
    'field' => 'companyname',
    'name' => '公司名称',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入公司名称" nullmsg="请输入公司名称" ',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '0',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'yyzz' => 
  array (
    'id' => '5093',
    'modelid' => '11',
    'field' => 'yyzz',
    'name' => '营业执照扫描件',
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
      'is_allow_show_img' => '1',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请上传营业执照" nullmsg="请上传营业执照！"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '1',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'yyzzbh' => 
  array (
    'id' => '5336',
    'modelid' => '11',
    'field' => 'yyzzbh',
    'name' => '营业执照编号',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '50',
      'defaultvalue' => '',
      'placeholder' => '请输入营业执照编号',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入营业执照编号" nullmsg="请输入营业执照编号"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '2',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'swdj' => 
  array (
    'id' => '5341',
    'modelid' => '11',
    'field' => 'swdj',
    'name' => '税务登记证扫描件',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请上传税务登记证扫描件" nullmsg="请上传税务登记证扫描件！"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '4',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'swdjzno' => 
  array (
    'id' => '5342',
    'modelid' => '11',
    'field' => 'swdjzno',
    'name' => '税务登记证编号',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '50',
      'defaultvalue' => '',
      'placeholder' => '请输入税务登记证编号',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入税务登记证编号" nullmsg="请输入税务登记证编号"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '5',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'orgimg' => 
  array (
    'id' => '5343',
    'modelid' => '11',
    'field' => 'orgimg',
    'name' => '组织机构代码证扫描件',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="图片格式为.gif .jpg .peg .png .bmp" nullmsg="请上传组织机构代码证扫描件！"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '5',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'accountname' => 
  array (
    'id' => '5346',
    'modelid' => '11',
    'field' => 'accountname',
    'name' => '开户账户名称',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入开户账户名称',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入开户账户名称" nullmsg="请输入开户账户名称"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'openaccount' => 
  array (
    'id' => '5347',
    'modelid' => '11',
    'field' => 'openaccount',
    'name' => '开户行',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入开户行',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入开户行" nullmsg="请输入开户行"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'branchname' => 
  array (
    'id' => '5349',
    'modelid' => '11',
    'field' => 'branchname',
    'name' => '开户行支行名称',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入开户行支行名称',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'BankNo' => 
  array (
    'id' => '5350',
    'modelid' => '11',
    'field' => 'BankNo',
    'name' => '银行账号',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入银行账号',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => ' datatype="*" sucmsg="OK" errormsg="请输入银行卡号" nullmsg="请输入银行卡号"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'ConstructQuay' => 
  array (
    'id' => '5357',
    'modelid' => '11',
    'field' => 'ConstructQuay',
    'name' => '施工等级资质',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'box',
    'setting' => 
    array (
      'options' => '一级|1
二级|2
三级|3',
      'boxtype' => 'radio',
      'fieldtype' => 'tinyint',
      'minnumber' => '1',
      'defaultvalue' => '1',
      'outputtype' => '0',
    ),
    'ext_code' => ' datatype="n" sucmsg="OK" errormsg="请选择施工等级资质" nullmsg="请选施工等级资质"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '6',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'LegalCardId' => 
  array (
    'id' => '5352',
    'modelid' => '11',
    'field' => 'LegalCardId',
    'name' => '法人身份证扫描件',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请上传法人身份证扫描件" nullmsg="请上传法人身份证扫描件！"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '7',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'LegalIdentityCard' => 
  array (
    'id' => '5353',
    'modelid' => '11',
    'field' => 'LegalIdentityCard',
    'name' => '法人身份证号',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入法人身份证号',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '7',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'fzrxm' => 
  array (
    'id' => '5097',
    'modelid' => '11',
    'field' => 'fzrxm',
    'name' => '店铺负责人姓名',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请填写负责人姓名" nullmsg="请填写负责人姓名！"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '8',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'chargePersonPhone' => 
  array (
    'id' => '5355',
    'modelid' => '11',
    'field' => 'chargePersonPhone',
    'name' => '店铺负责人手机号码',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'text',
    'setting' => 
    array (
      'size' => '',
      'defaultvalue' => '',
      'placeholder' => '请输入店铺负责人手机号',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入店铺负责人手机号" nullmsg="请输入店铺负责人手机号"',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '8',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'areaid' => 
  array (
    'id' => '5444',
    'modelid' => '11',
    'field' => 'areaid',
    'name' => '公司地址',
    'remark' => '',
    'css' => '',
    'minlength' => '1',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'linkage',
    'setting' => 
    array (
      'linkageid' => '1',
      'defaultvalue' => '',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="选择公司地址" nullmsg="请选择公司地址！" ',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '32',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'one_text' => 
  array (
    'id' => '5456',
    'modelid' => '11',
    'field' => 'one_text',
    'name' => '公司详细地址',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
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
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入公司详细地址" nullmsg="请输入正确的公司详细地址" ',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '33',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'areaids' => 
  array (
    'id' => '5457',
    'modelid' => '11',
    'field' => 'areaids',
    'name' => '服务区域',
    'remark' => '',
    'css' => '',
    'minlength' => '0',
    'maxlength' => '0',
    'pattern' => '',
    'errortips' => '',
    'formtype' => 'linkage_box',
    'setting' => 
    array (
      'formfield' => 'LK1_2',
    ),
    'ext_code' => '',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '34',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
  'gszj' => 
  array (
    'id' => '5101',
    'modelid' => '11',
    'field' => 'gszj',
    'name' => '公司座机',
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
      'placeholder' => '请输入座机号码',
      'ispassword' => '0',
      'enablehtml' => '0',
    ),
    'ext_code' => 'datatype="*" sucmsg="OK" errormsg="请输入公司座机号码" nullmsg="请输入公司座机号码！" ',
    'unsetgids' => '',
    'unsetroles' => '',
    'master_field' => '0',
    'ban_field' => '0',
    'location' => '0',
    'search_field' => '0',
    'ban_contribute' => '1',
    'to_fulltext' => '1',
    'to_block' => '0',
    'sort' => '51',
    'disabled' => '0',
    'powerful_field' => '0',
    'master_table' => 'member',
    'attr_table' => 'member_company_data',
  ),
)?>