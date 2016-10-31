<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo ($curtitle); ?></title>
		
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<meta http-equiv="Content-Language" content="zh-CN" />
		<meta name="author" content="Jay" />
		<link rel="stylesheet" type="text/css" href="/oa/Tpl/default/Public/style/default/css/kdstyle.css" />
<script type="text/javascript" src="/oa/Tpl/default/Public/style/default/js/KD.js" ></script>
<script type="text/javascript" src="/oa/Tpl/default/Public/style/default/js/main.js" ></script>
<script type="text/javascript" src="/oa/Tpl/default/Public/style/default/js/js.js" ></script>

<link type="text/css" rel="stylesheet" href="/oa/Tpl/default/Public/css/validator.css" />
<script src="/oa/Tpl/default/Public/js/formValidator.js" type="text/javascript" charset="UTF-8"></script>
<script src="/oa/Tpl/default/Public/js/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script language="javascript" src="/oa/Tpl/default/Public/js/DateTimeMask.js" type="text/javascript"></script>
<script type="text/javascript" src="/oa/Tpl/default/Public/DatePicker/WdatePicker.js"></script>	
	</head>

<script language="JavaScript">
function CheckForm()
{
   if(document.form1.CONTENT.value=="")
   { alert("事务内容不能为空！");
     return (false);
   }
   return (true);
}

<?php switch($row[TYPE]): ?><?php case "2":  ?>var aff_type="day";<?php break;?>
<?php case "3":  ?>var aff_type="week";<?php break;?>
<?php case "4":  ?>var aff_type="mon";<?php break;?>
<?php case "5":  ?>var aff_type="year";<?php break;?>
<?php default: ?>var aff_type="day";<?php endswitch;?>

function sel_change()
{
   if(aff_type!="")
      document.all(aff_type).style.display="none";
   if(form1.TYPE.value=="2")
      aff_type="day";
   if(form1.TYPE.value=="3")
      aff_type="week";
   if(form1.TYPE.value=="4")
      aff_type="mon";
   if(form1.TYPE.value=="5")
      aff_type="year";
      
   document.all(aff_type).style.display="";
}

function td_calendar(fieldname)
{
  myleft=document.body.scrollLeft+event.clientX-event.offsetX-80;
  mytop=document.body.scrollTop+event.clientY-event.offsetY+140;

  window.showModalDialog("/inc/calendar.php?FIELDNAME="+fieldname,self,"edge:raised;scroll:0;status:0;help:0;resizable:1;dialogWidth:280px;dialogHeight:205px;dialogTop:"+mytop+"px;dialogLeft:"+myleft+"px");
}

function td_clock(fieldname)
{
  myleft=document.body.scrollLeft+event.clientX-event.offsetX-80;
  mytop=document.body.scrollTop+event.clientY-event.offsetY+140;

  window.showModalDialog("/inc/clock.php?FIELDNAME="+fieldname,self,"edge:raised;scroll:0;status:0;help:0;resizable:1;dialogWidth:280px;dialogHeight:120px;dialogTop:"+mytop+"px;dialogLeft:"+myleft+"px");
}

function td_clock1(fieldname)
{
  document.form1.REMIND_TIME2.value="";
  document.form1.REMIND_TIME3.value="";
  document.form1.REMIND_TIME4.value="";
  document.form1.REMIND_TIME5.value="";
  myleft=document.body.scrollLeft+event.clientX-event.offsetX-80;
  mytop=document.body.scrollTop+event.clientY-event.offsetY+140;

  window.showModalDialog("/inc/clock.php?FIELDNAME="+fieldname,self,"edge:raised;scroll:0;status:0;help:0;resizable:1;dialogWidth:280px;dialogHeight:120px;dialogTop:"+mytop+"px;dialogLeft:"+myleft+"px");
}
</script>
<script type="text/javascript" src="/oa/Tpl/default/Public/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
		setDomHeight("main", 56);
		createHeader({
        Title: "日程安排",
        Icon: "",
        IconCls:"ico ico-head-news",
        Cls: "",
        Active: 3,
        Toolbar: [
            { Title: "帮助", Url: "http://help.7e73.com", Icon: "", IconCls: "ico ico-help", Cls: "", Target: "_blank", TextHide: false },
			{ Title: "刷新", Url: "javascript:",Action:"location.reload()", Icon: "", IconCls: "ico ico-refresh", Cls: "", Target: "_self", TextHide: false }
        ],
        Items: [
            { Title: "日程安排", Url: "/index.php/Calendar/index", Cls: "", Icon: "", IconCls: "ico ico-calendar" },
            { Title: "日常事务", Url: "/index.php/Calendar/affairIndex", Cls: "", IconCls: "ico ico-clock" },
            { Title: "新建日常事务", Url: "/index.php/Calendar/affairform", Cls: "", IconCls: "ico ico-add" }
        ]
    });		   
});
</script>

<body onLoad="document.form1.CONTENT.focus();">

	
<div class="KDStyle" id="main">
<form action="/index.php/Calendar/affairsubmit"  method="post" name="form1" onSubmit="return CheckForm();">
 <table>
 <caption class="nostyle"><?php echo ($desc); ?></caption>
				<colgroup>
					<col width="80"></col>
					<col width=""></col>
				</colgroup>
				  
    <tr>
      <td>开始时间：</td>
      <td>
        <input type="text"name="BEGIN_TIME" size="20" value="<?php echo (is_array($row)?$row["BEGIN_TIME"]:$row->BEGIN_TIME); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
        <img src="/oa/Tpl/default/Public/images/ico/calendar.png" alt="选择时间" style="cursor:hand" onClick="WdatePicker({el:$dp.$('BEGIN_TIME'),dateFmt:'yyyy-MM-dd HH:mm:ss'})"  />
        &nbsp;&nbsp;为空为当前时间
      </td>
    </tr>
    <tr>
      <td> 事务类型：</td>
      <td>
        <select name="TYPE" onChange="sel_change()">
          <option value="2" <?php if($row[TYPE] == 2): ?>selected<?php endif; ?>>按日提醒</option>
          <option value="3" <?php if($row[TYPE] == 3): ?>selected<?php endif; ?>>按周提醒</option>
          <option value="4" <?php if($row[TYPE] == 4): ?>selected<?php endif; ?>>按月提醒</option>
          <option value="5" <?php if($row[TYPE] == 5): ?>selected<?php endif; ?>>按年提醒</option>
        </select>
      </td>
    </tr>
    <tr id="day" <?php if($row[TYPE] != 2): ?>style="display:none"<?php endif; ?>>
      <td> 提醒时间：</td>
      <td>
        <input name="REMIND_TIME2" onFocus="WdatePicker({dateFmt:'HH:mm:ss'})" size="10" value="<?php if($row[type] == 2): ?><?php echo ($row[REMIND_TIME]); ?><?php else: ?><?php echo ($CUR_TIME); ?><?php endif; ?>">
        
        <img src="/oa/Tpl/default/Public/images/ico/calendar.png" alt="选择时间" style="cursor:hand" onClick="WdatePicker({el:$dp.$('REMIND_TIME2'),dateFmt:'HH:mm:ss'})"  />        
        &nbsp;&nbsp;为空为当前时间
      </td>
    </tr>
    <tr id="week" <?php if($row[TYPE] != 3): ?>style="display:none"<?php endif; ?>>
      <td> 提醒时间：</td>
      <td>
        <select name="REMIND_DATE3" style="width:100px">
          <option value="1" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==1 || $row[TYPE]!="3"&&date("w",time())==1) echo "selected";?>>星期一</option>
          <option value="2" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==2 || $row[TYPE]!="3"&&date("w",time())==2) echo "selected";?>>星期二</option>
          <option value="3" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==3 || $row[TYPE]!="3"&&date("w",time())==3) echo "selected";?>>星期三</option>
          <option value="4" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==4 || $row[TYPE]!="3"&&date("w",time())==4) echo "selected";?>>星期四</option>
          <option value="5" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==5 || $row[TYPE]!="3"&&date("w",time())==5) echo "selected";?>>星期五</option>
          <option value="6" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==6 || $row[TYPE]!="3"&&date("w",time())==6) echo "selected";?>>星期六</option>
          <option value="0" <?php if($row[TYPE]=="3"&&$row[REMIND_DATE]==0 || $row[TYPE]!="3"&&date("w",time())==0) echo "selected";?>>星期日</option>
        </select>&nbsp;&nbsp;
        <input name="REMIND_TIME3" size="10" onFocus="WdatePicker({dateFmt:'HH:mm:ss'})" value="<?php if($row[type] == 3): ?><?php echo ($row[REMIND_TIME]); ?><?php else: ?><?php echo ($CUR_TIME); ?><?php endif; ?>">
                <img src="/oa/Tpl/default/Public/images/ico/calendar.png" alt="选择时间" style="cursor:hand" onClick="WdatePicker({el:$dp.$('REMIND_TIME3'),dateFmt:'HH:mm:ss'})"  />  
        &nbsp;&nbsp;为空为当前时间
      </td>
    </tr>
    <tr id="mon" <?php if($row[TYPE] != 4): ?>style="display:none"<?php endif; ?>>
      <td> 提醒时间：</td>
      <td>
        <select name="REMIND_DATE4" style="width:100px">
<?php
for($I=1;$I<=31;$I++)
{
?>
          <option value="<?php echo $I?>" <?php if($row[TYPE]=="4"&&$row[REMIND_DATE]==$I || $row[TYPE]!="4"&&date("j",time())==$I) echo "selected";?>><?=$I?>日</option>
<?php
}
?>
        </select>&nbsp;&nbsp;
        <input name="REMIND_TIME4" size="10" onFocus="WdatePicker({dateFmt:'HH:mm:ss'})" value="<?php if($row[type] == 4): ?><?php echo ($row[REMIND_TIME]); ?><?php else: ?><?php echo ($CUR_TIME); ?><?php endif; ?>">
                <img src="/oa/Tpl/default/Public/images/ico/calendar.png" alt="选择时间" style="cursor:hand" onClick="WdatePicker({el:$dp.$('REMIND_TIME4'),dateFmt:'HH:mm:ss'})"  />  
        &nbsp;&nbsp;为空为当前时间
      </td>
    </tr>
    <tr id="year" <?php if($row[TYPE] != 5): ?>style="display:none"<?php endif; ?>>
      <td> 提醒时间：</td>
      <td>
        <select name="REMIND_DATE5_MON" style="width:100px">
<?php
for($I=1;$I<=12;$I++)
{
?>
          <option value="<?php echo $I?>" <?php if($row[TYPE]=="5"&&$row[REMIND_DATE_MON]==$I || $row[TYPE]!="5"&&date("n",time())==$I) echo "selected";?>><?=$I?>月</option>
<?php
}
?>
        </select>&nbsp;&nbsp;
        <select name="REMIND_DATE5_DAY">
<?php
for($I=1;$I<=31;$I++)
{
?>
          <option value="<?php echo $I?>" <?php if($row[TYPE]=="5"&&$row[REMIND_DATE_DAY]==$I || $row[TYPE]!="5"&&date("j",time())==$I) echo "selected";?>><?=$I?>日</option>
<?php
}
?>
        </select>&nbsp;&nbsp;
        <input name="REMIND_TIME5" size="10" onFocus="WdatePicker({dateFmt:'HH:mm:ss'})" value="<?php if($row[type] == 5): ?><?php echo ($row[REMIND_TIME]); ?><?php else: ?><?php echo ($CUR_TIME); ?><?php endif; ?>">
        <img src="/oa/Tpl/default/Public/images/ico/calendar.png" alt="选择时间" style="cursor:hand" onClick="WdatePicker({el:$dp.$('REMIND_TIME5'),dateFmt:'HH:mm:ss'})"  />
        &nbsp;&nbsp;为空为当前时间
      </td>
    </tr>
    <tr>
      <td> 事务内容：</td>
      <td>
        <textarea name="CONTENT" cols="45" rows="5" class="content"><?php echo (is_array($row)?$row["CONTENT"]:$row->CONTENT); ?></textarea>
      </td>
    </tr>
    <tfoot>
    <tr>
      <th colspan="2" nowrap>
        <input type="hidden" name="AFF_ID" value="<?php echo ($AFF_ID); ?>" >
        <button type="submit" value="确定" class="btnFnt">确定</button>
        <button type="button" value="返回" class="btnFnt" onClick="location='/index.php/Calendar/affairIndex'">返回</button>
      </th>
    </tr>
    </tfoot>
  </table>
<?php if(C("TOKEN_ON")):?><input type="hidden" name="<?php echo C("TOKEN_NAME");?>" value="<?php echo Session::get(C("TOKEN_NAME")); ?>"/><?php endif;?></form>

</div>


</body>
</html>