/////״̬�޸ĺ���////�ֶΣ�id���ֶΣ�Ƭ��///////////////////
function selectSingleRadio(str1,id,filed,name) {
var imageOn = "images/icon_21x21_selectboxon.gif";
var imageOff = "images/icon_21x21_selectboxoff.gif";
    if (document.all[str1].value == "True" || document.all[str1].value == "") {
        document.images[str1].src = imageOff;
        document.all[str1].value = "False";
        loadxml('?act=�޸�&t0=��&id='+id+'&filed='+filed+'&name='+name)
    } else {
        document.images[str1].src = imageOn;
        document.all[str1].value = "True";
	loadxml('?act=�޸�&t0=��&id='+id+'&filed='+filed+'&name='+name)
    }
//alert(document.all[str1].value)
}

/////�����˳�����///////////////////////
function ops(str1,str2,str3)
{
dWin=showModalDialog(str1,window,'dialogHeight:'+str2+'px;dialogWidth:'+str3+'px;scroll:yes;resizable:no;status:no;help:no');
}

/////xml��ȡ��Ϣ///////////////////////
function loadxml(str)
{
var oBao = new ActiveXObject("Microsoft.XMLHTTP");
    oBao.open("POST",str,false);
    oBao.send();
	var atext = unescape(oBao.responseText);
    //setTimeout("top.ts_mess.innerHTML=' '",1 * 10000)
    top.ts_mess.innerHTML=atext;
}

/////xml��ȡ��Ϣ�������Ի����///////////////////////
function loadxml_b(str)
{
var oBao = new ActiveXObject("Microsoft.XMLHTTP");
    oBao.open("POST",str,false);
    oBao.send();
    var atext = unescape(oBao.responseText);
    alert(atext);
}


////////����ӰƬ��Ϣ///////////////////////////////////////
function chk(str){
form1.idtxt.value="";
for (var i=0;i<form1.elements.id.length;i++)
{
		var e = form1.elements.id[i];
			if (e.checked == true){
			form1.idtxt.value+=e.value+",";
			}
}
if(form1.idtxt.value!=""){
if(str=="ɾ��"){
loadxml_b('?act=ɾ��&id='+form1.idtxt.value)
}else
{
ops('film_2.asp?id='+form1.idtxt.value,'410','500')
}

}else
{
alert("û��ѡ���¼����ֻ�����һ����¼")
}
}

////////����ӰƬ����֤����������///////////////////////////////////////
function add_chk(){
for (var i=1;i<=14;i++)
{
if (form1['t'+i].value == ""){
   	alert("���ϲ�����-"+['t'+i]);
	return false;
}
}
//�任����
//if(form1.t9.checked==true){var t9 = "��";}else{var t9 = "��";}
//if(form1.t15.checked==true){var t15 = "��";}else{var t15 = "��";}
//if(form1.t16.checked==true){var t16 = "��";}else{var t16 = "��";}
//if(form1.t17.checked==true){var t17 = "��";}else{var t17 = "��";}
//if(form1.t18.checked==true){var t18 = "��";}else{var t18 = "��";}
//if(form1.t14.value==""){var t14 = "��";}else{var t14 =escape(form1.t14.value);}
//addfilm('film_1.asp?act=����&t1='+form1.t1.value+'&t2='+form1.t2.value+'&t3='+form1.t3.value+'&t4='+form1.t4.value+'&t5='+form1.t5.value+'&t6='+form1.t6.value+'&t7='+form1.t7.value+'&t8='+form1.t8.value+'&t9='+t9+'&t10='+form1.t10.value+'&t11='+form1.t11.value+'&t12='+form1.t12.value+'&t13='+form1.t13.value+'&t14='+form1.t14.value+'&t15='+t15+'&t16='+t16+'&t17='+t17+'&t18='+t18)
form1.submit();
return true;
}

///��ʼ����ӰƬģ��///////
function addfilm(str)
{
var oBao = new ActiveXObject("Microsoft.XMLHTTP");
    oBao.open("POST",str,false);
    oBao.send();
    var atext = unescape(oBao.responseText);
	alert(atext)	
}

/////�������////_bΪͼƬ��///////////////
function ra_select(str1){
var imageOn = "images/icon_21x21_selectboxon.gif";
var imageOff = "images/icon_21x21_selectboxoff.gif";
    if (document.all[str1].value == "��" || document.all[str1].value == "") {
        document.images[str1+'_b'].src = imageOn;
        document.all[str1].value = "��";
    } else {
        document.images[str1+'_b'].src = imageOff;
        document.all[str1].value = "��";
    }
//alert(document.all[str1].value)
}

///////////html�༭��////////////
function eWebEditorPopUp(style, form, field, width, height) {
	window.open("ewebedit/examples/zh_cn/index.asp?style="+style+"&form="+form+"&field="+field, "", "width="+width+",height="+height+",toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

/////////////////ӰƬ���ظ����///////////////////////
function film_nametest(str1,str2)
{
var oBao = new ActiveXObject("Microsoft.XMLHTTP");
    oBao.open("POST",str1,false);
    oBao.send();
    var atext = unescape(oBao.responseText);
	document.all.film_nametest.innerHTML=atext;
}

//////////////������֤����//������,�ֶΣ�����////////////////////////////
function add_chkform(str1,str2,str3){
for (var i=1;i<=str3;i++)
{
if (document[str1][str2+i].value == ""){
   	alert("���ϲ�����-"+[str2+i]);
	document[str1][str2+i].focus();
	return false;
	}
}
document[str1].submit();
return true;
}

///////////////////////��Ա����ʾ����////////////////////////////////
function showinput(){
if(document.form1.t1.options[document.form1.t1.selectedIndex].value<"2"){
document.all.showinputdiv.innerHTML="&nbsp;������";
}else{
document.all.showinputdiv.innerHTML="&nbsp;��Ч��(��)��";
}
}

////////////�����޸�ӰƬʱ��ʾ��ͼƬ�ϴ���//////////////////////
function showlay(str){str.style.visibility="visible"}

////////////////////////�������ı���////////////////////////////////////
function cw_main(){
if(document.all.select4.options[document.form1.select4.selectedIndex].value!=""){
document.all.cw_put.innerHTML="<input type='text' name='select5' size='3'>";
}else
{
document.all.cw_put.innerHTML=" ";
}
}

//////////////////////��������/////////////////////
function popdate(ctrlobj)   
{
	showx = event.screenX - event.offsetX - 4 - 210 ; // + deltaX;
	showy = event.screenY - event.offsetY + 18; // + deltaY;
	newWINwidth = 210 + 4 + 18;

	retval = window.showModalDialog("date.htm", "", "dialogWidth:196px; dialogHeight:210px; dialogLeft:"+showx+"px; dialogTop:"+showy+"px; status:no; directories:yes;scrollbars:no;Resizable=no; "  );
	if( retval != null ){
		ctrlobj.value = retval;
	}else{
		//alert("canceled");
	}
}

/////////////////////////////////////���ݿⱸ��ҳ����////////////////
function chkform(str){
if(document.all.list.value==""){
alert("��ѡ�����ݿ��ļ����ļ�����Ϊϵͳ��ǰ���ݿ�");
return false
}

if(str=="�л�")
{
loadxml_b('?act=�л�&name='+document.all.list.value);
location.reload();
}

if(str=="ɾ��")
{
loadxml_b('?act=ɾ��&name='+document.all.list.value);
location.reload();
}
return true
}

///////////////////��ѡ/////////////////////////
function CheckOthers(form)
{
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
//		if (e.name != 'chkall')
			if (e.checked==false)
			{
				e.checked = true;// form.chkall.checked;
			}
			else
			{
				e.checked = false;
			}
	}
}
///////////////////ȫѡ/////////////////////////
function CheckAll(form)
{
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
//		if (e.name != 'chkall')
			e.checked = true// form.chkall.checked;
	}
}

///////////////////ȫ��ȡ��/////////////////////////
function checkall(form,str)
{
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
//		if (e.name != 'chkall')
			e.checked = str// form.chkall.checked;
	}
}

/////�ж�ȫѡ��ѡ
function checksel(form){
	if (form.sele.checked == true)
		checkall(form,true);
	else
		checkall(form,false);
}

function writeTip2(str1,str2,str3,str4,str5,str6,str7){
    tipAttr = '[<span style="color:blue;text-decoration:underline;cursor:hand" tip=" \
        <table width=200 border=0 cellspacing=0 cellpadding=0 bgcolor=#FFFFE1> \
        <tr>  \
          <td width=98% style=\'BORDER-bottom: #000000 1px solid; BORDER-top: #000000 1px solid; BORDER-left: #000000 1px solid; BORDER-right: #000000 1px solid;\' ><table width=100% border=0 cellspacing=0 cellpadding=10> \
              <tr> \
                <td class=about> \
                    <font color=#000000>'+str1+'</font><br> \
                    <font color=#000000>'+str2+'</font><br> \
                    <font color=#000000>'+str3+'</font><br> \
                    <font color=#000000>'+str4+'</font><br> \
                    <font color=#000000>'+str5+'</font><br> \
					<font color=#000000>'+str6+'</font><br> \
                  </td> \
              </tr> \
            </table></td> \
          <td width=4 valign=top bgcolor=#C4C4C4></td> \
        </tr> \
      </table> \
      <table width=180 border=0 cellpadding=0 cellspacing=0 bgcolor=#C4C4C4> \
        <tr> \
          <td></td> \
        </tr> \
        </table>">��</span>]';
        
        document.write(tipAttr);
}

//////��ת�ַ�///Ԥ������ϵͳ����////
function addRevstr(str){
newstr="";
for(i=0;i<str.length;i++)
newstr+=str.substring(str.length-1-i,str.length-i);
return newstr;
}

