var _S_JV_ = "webbug_meta_ref_mod_noiframe_async_fc_:8.51a";
var _S_DPID_ = "-9999-0-0-1";
var _S_DOMAINROOT = "sina.com.cn";
var _S_PW_ = window;
var _S_PWD_ = _S_PW_.document;
var _S_PWDL_ = _S_PWD_.location;
var _S_BN_ = navigator;
var _S_NAN_ = _S_BN_.appName.indexOf('Microsoft Internet Explorer') >  - 1 ?
    'MSIE' : _S_BN_.appName;
var _S_NAV_ = _S_BN_.appVersion;
var _S_PREF_ = _S_PWD_.referrer.toLowerCase();
var _S_PURL_ = _S_PWDL_.href.toLowerCase();
var _SP_MPID_ = "";
var _S_PID_ = "";
var _S_UNA_ = "UNIPROU";
var _S_UID_ = "nick";
var _S_SID_ = "Apache";
var _S_GID_ = "SINAGLOBAL";
var _S_IFW = 640;
var _S_IFH = 480;
try
{
    if (_S_ET >= 0)
    {
        _S_ET = _S_ET;
    }
    else
    {
        var _S_ET = 0;
    }
}

catch (e)
{
    var _S_ET = 0;
}

var _S_GIDT = 0;
var _S_EXT1 = "";
var _S_EXT2 = "";
var _S_HTTP = _S_PURL_.indexOf('https') >  - 1 ? 'https://' : 'http://';
var _S_BCNDOMAIN = "beacon.sina.com.cn";
var _S_CP_RF = _S_HTTP + _S_BCNDOMAIN + "/a.gif";
var _S_CP_RF_D = _S_HTTP + _S_BCNDOMAIN + "/d.gif";
var _S_CP_FC = _S_HTTP + _S_BCNDOMAIN + "/fc.html";
function _S_gUCk(ckName)
{
    if (("undefined" == ckName) || ("" == ckName))
        return "";
    var _S_PWDC_ = _S_PWD_.cookie;
    var start = _S_PWDC_.indexOf(ckName + "=");
    if ( - 1 == start)
    {
        return "";
    }
    start = _S_PWDC_.indexOf("=", start) + 1;
    var end = _S_PWDC_.indexOf(";", start);
    if (0 >= end)
    {
        end = _S_PWDC_.length;
    }
    ckValue = _S_PWDC_.substring(start, end);
    return ckValue;
}

function _S_sUCk(ckName, ckValue, ckdays)
{
    if (ckValue != null)
    {
        if (("undefined" == ckdays) || (null == ckdays))
        {
            _S_PWD_.cookie = ckName + "=" + ckValue + "; domain=" +
                _S_DOMAINROOT + "; path=/";
        }
        else
        {
            var now = new Date();
            var time = now.getTime();
            time = time + 86400000 * ckdays;
            now.setTime(time);
            time = now.getTime();
            _S_PWD_.cookie = ckName + "=" + ckValue + "; domain=" +
                _S_DOMAINROOT + "; expires=" + now.toUTCString() + "; path=/";
        }
    }
}

function _S_gMeta(MName)
{
    pMeta = _S_PWD_.getElementsByName(MName);
    return (pMeta.length > 0) ? pMeta[0].content: "";
}

function _S_gCid()
{
    try
    {
        metaTxt = _S_gMeta("publishid");
        if ("" != metaTxt)
        {
            pbidList = metaTxt.split(",");
            if (pbidList.length > 0)
            {
                if (pbidList.length >= 3)
                {
                    _S_DPID_ = "-9999-0-" + pbidList[1] + "-" + pbidList[2];
                }
                return pbidList[0];
            }
        }
        else
        {
            return "0";
        }
    }
    catch (e)
    {
        return "0";
    }
}

function _S_gsSID()
{
    var sid = _S_gUCk(_S_SID_);
    if ("" == sid)
    {
        _S_sSID();
    }
    return sid;
}

function _S_sSID()
{
    _S_p2Bcn("", _S_CP_RF_D);
}

function _S_sSIDV(_s_sidv)
{
    if ("" != _s_sidv)
    {
        _S_sUCk(_S_SID_, _s_sidv);
    }
}

function _S_gGID()
{
    return _S_gUCk(_S_GID_);
}

function _S_sGID(gid)
{
    if ("" != gid)
    {
        _S_sUCk(_S_GID_, gid, 3650);
    }
}

function _S_IFC2GID()
{
    var _S_ifc = _S_PWD_.getElementById("SUDA_FC");
    if (_S_ifc)
    {
        _S_ifc.src = _S_CP_FC + "?a=g&n=" + _S_GID_ + "&r=" + Math.random();
    }
}

function _S_gsGID()
{
    if ("" != _S_GID_)
    {
        var gid = _S_gUCk(_S_GID_);
        if ("" == gid)
        {
            _S_IFC2GID();
        }
        return gid;
    }
    else
    {
        return "";
    }
}

function _S_p2Bcn(q, u)
{
    var scd = _S_PWD_.getElementById("SUDA_CS_DIV");
    if (null != scd)
    {
        var now = new Date();
        scd.innerHTML = "<img width=0 height=0 src='" + u + "?" + q + "gUid_" +
            now.getTime() + "' border='0' alt='' />";
    }
}

function _S_gConType()
{
    var ct = "";
    try
    {
        _S_PWD_.body.addBehavior("#default#clientCaps");
        ct = _S_PWD_.body.connectionType;
    }
    catch (e)
    {
        ct = "unkown";
    }
    return ct;
}

function _S_isHome()
{
    var cul = "";
    var isH = "";
    try
    {
        cul = _S_PURL_;
        _S_PWD_.body.addBehavior("#default#homePage");
        isH = _S_PWD_.body.isHomePage(cul) ? "Y" : "N";
    }
    catch (e)
    {
        isH = "unkown";
    }
    return isH;
}

function _S_isFreshMeta()
{
    var ph = _S_PWD_.documentElement.innerHTML.substring(0, 1024);
    var reg = new RegExp(
        "<meta\\s*http-equiv\\s*=((\\s*refresh\\s*)|(\'refresh\')|(\"refresh\"))\s*content\s*=", "ig");
    return reg.test(ph);
}

function _S_isIFrameSelf()
{
    if (_S_PW_.top == _S_PW_)
    {
        return false;
    }
    else
    {
        try
        {
            if (_S_PWD_.body.clientHeight == 0)
            {
                return false;
            }
            if ((_S_PWD_.body.clientHeight >= _S_IFH) &&
                (_S_PWD_.body.clientWidth >= _S_IFW))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        catch (e)
        {
            return true;
        }
    }
}

function _S_gJVer()
{
    var p, appsign, appver, jsver = 1.0, isN6 = 0;
    if ('MSIE' == _S_NAN_)
    {
        appsign = 'MSIE';
        p = _S_NAV_.indexOf(appsign);
        if (p >= 0)
        {
            appver = parseInt(_S_NAV_.substring(p + 5));
            if (3 <= appver)
            {
                jsver = 1.1;
                if (4 <= appver)
                {
                    jsver = 1.3;
                }
            }
        }
    }
    else if (("Netscape" == _S_NAN_) || ("Opera" == _S_NAN_) || ("Mozilla" ==
        _S_NAN_))
    {
        jsver = 1.3;
        appsign = 'Netscape6';
        p = _S_NAV_.indexOf(appsign);
        if (p >= 0)
        {
            jsver = 1.5;
        }
    }
    return jsver;
}

function _S_gPageInfo(pid, ref)
{
    return _S_gsSID() + "|pid:" + pid + "||st:0|et:" + _S_ET + "|" + escape(ref)
        + "|hp:" + _S_isHome() + "|lb:1|PGLS:" + _S_gMeta("stencil") + "|keys:"
        + _S_gMeta("keywords") + "|" + _S_EXT1 + "|" + _S_EXT2 + "|*|";
}

function _S_gEnvInfo()
{
    var now = new Date();
    return "sz:" + screen.width + "x" + screen.height + "||dp:" +
        screen.colorDepth + "||ac:" + _S_BN_.appCodeName + "||an:" + _S_NAN_ +
        "||av:0||cpu:" + _S_BN_.cpuClass + "||pf:" + _S_BN_.platform + "||jv:"
        + _S_gJVer() + "||ct:" + _S_gConType() + "||lg:" +
        _S_BN_.systemLanguage + "||tz:" + now.getTimezoneOffset() / 60;
}

function _S_pBeacon(pid, ext1, ext2)
{
    try
    {
        var gid = _S_gsGID();
        if ("" == gid)
        {
            if (_S_GIDT < 1)
            {
                _S_PW_.setTimeout("_S_pBeacon('" + pid + "','" + ext1 + "','" +
                    ext2 + "',0)", 3000);
                _S_GIDT++;
                return ;
            }
            else
            {
                gid = _S_gsSID();
                _S_sGID(gid);
            }
        }
        if (("undefined" == pid) || ("" == pid))
        {
            pid = _S_gCid() + _S_DPID_;
        }
        _SP_MPID_ = pid;
        _S_EXT1 = ("undefined" == ext1) ? _S_EXT1 : ext1;
        _S_EXT2 = ("undefined" == ext2) ? _S_EXT2 : ext2;
        var ckValue = _S_gEnvInfo();
        var unStr = _S_gUCk(_S_UNA_);
        var uidStr = _S_gUCk(_S_UID_);
        var envStr = "UNIPROINFO=" + ckValue + "||un:" + unStr + "||uid:" +
            uidStr + ";";
        var refUrl = _S_PREF_;
        var cPageStr = _S_gPageInfo(_SP_MPID_, refUrl);
        var lbStr = gid + "|*|" + cPageStr;
        lbStr = envStr + "UNIPROPATH=" + lbStr + ";";
        _S_p2Bcn(lbStr, _S_CP_RF);
    }
    catch (e){}
}

function _S_pSt(pid, ext1, ext2)
{
    try
    {
        if ((_S_isFreshMeta()) || (_S_isIFrameSelf()))
        {
            return ;
        }
        if (_S_ET > 0)
        {
            return ;
        }
        ++_S_ET;
        _S_PW_.setTimeout("_S_gsSID()", 500);
        _S_PW_.setTimeout("_S_pBeacon('" + pid + "','" + ext1 + "','" + ext2 +
            "',0)", 3000);
    }
    catch (e){}
}

function _S_pStM(pid, ext1, ext2)
{
    ++_S_ET;
    _S_pBeacon(pid, ext1, ext2);
}
