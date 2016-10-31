<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<div style=" border:2px solid;overflow:auto;   width:792px; height:342px;margin-left:10px; padding:10px 0px 10px 0px;">
  <img id="main_img" style="width:790px; height:342px;"/> </div><table width="200" height="26" border="0" id="tool" style="float: right;">
    <tr>
       <td><input type="button" class="submit_but04" value="放大" onclick="PhotoSize.action(1);" /></td>

    </tr>
    <tr>
    <td><input type="button" class="submit_but04" value="缩小" onclick="PhotoSize.action(-1);" /></td></tr>
    <tr>
    <td><input type="button" class="submit_but04" value="还原大小" onclick="PhotoSize.action(0);" /></td></tr>
    <tr>
     <td width="60"><input class="submit_but04" name="button2" type="button" onclick="Vturn();" id="idVertical" value="垂直翻转" /></td></tr>
     <tr>
      <td width="60"><input class="submit_but04" name="button4" type="button" onclick="Hturn();" id="idHorizontal" value="水平翻转" />
      </td></tr>
      <tr>
      <td width="60"><input class="submit_but04" name="button5" type="button" onclick="reset();" id="idReset" value="还原位置" />
      </td></tr>
  </table>
<div style="width:1002px; height:60px; float:left; text-align:center; margin-left:10px; overflow: hidden; position: relative;" class="border_bottom01">

<img  id="showImg"  width="1002px;" height="55px;"/>


  
</div>

<!-- 此处是加载图像，让浏览器缓存，加速图像组件的操作 -->
<s:iterator value="taskImageURL" id="currUrl">
<img src="<%=request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()%>/imageSave/<s:property value='#currUrl'/>" style="display:none;"/>
</s:iterator> 

<script type="text/javascript">
var PhotoSize = {
  zoom: 0, // 缩放率
  count: 0, // 缩放次数
  cpu: 0, // 当前缩放倍数值
  elem: "", // 图片节点
  photoWidth: 0, // 图片初始宽度记录
  photoHeight: 0, // 图片初始高度记录
  
  init: function(){
    this.elem = document.getElementById("main_img");
    this.photoWidth = this.elem.scrollWidth;
    this.photoHeight = this.elem.scrollHeight;
    
    this.zoom = 1.2; // 设置基本参数
    this.count = 0;
    this.cpu = 1;
  },
  
  action: function(x){
    if(x === 0){
      this.cpu = 1;
      this.count = 0;
    }else{
      this.count += x; // 添加记录
      this.cpu = Math.pow(this.zoom, this.count); // 任意次幂运算
    };
    this.elem.style.width = this.photoWidth * this.cpu +"px";
    this.elem.style.height = this.photoHeight * this.cpu +"px";
  }
};
// 启动放大缩小效果,用onload方式加载，防止第一次点击获取不到图片的宽高
PhotoSize.init();
</script>