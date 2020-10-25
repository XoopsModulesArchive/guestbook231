<html>
<head>
<title>Guestbook - Password Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script language="JavaScript">
<!--
function checkForm() {
  if (document.FormPwd.NEWadmin_pass.value != document.FormPwd.confirm.value) {
    alert("The passwords do not match!");
    return false;
  }
}
//-->
</script>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" color="#313031"><b>CHANGE&nbsp;&nbsp;&nbsp;&nbsp;PASSWORD</b></font><br><br>
</center>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=priv&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">プライベートメッセージ</font></a> | <a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=gb&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">コメント一覧</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=general&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">全般設定</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=style&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スタイル</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=template&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">テンプレート</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=smilies&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スマイルマーク</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=pwd&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">パスワード</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=logout&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ログアウト</font></a></b></font><br>
<HR>
<b><font size="1" color="#313031">環境変数をチェックするには、<a href="<?php echo $this->SELF; ?>?action=info&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ここをクリック</font></a></font></b>
<form action="<?php echo $this->SELF; ?>" name="FormPwd" method="post">
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000">
      <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">ゲストブック ユーザ名/パスワード </font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0">
      <td colspan=2><font size="1"><b>ゲストブック管理のためのユーザ名とパスワード設定</b></font></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50% bgcolor="#dedfdf"><b><font size="2">現在のユーザ名</font></b></td>
      <td width=50% bgcolor="#dedfdf"><input type="text" name="NEWadmin_name" value="<?php echo $row['username']; ?>" size="30"></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width=50% bgcolor="#f7f7f7"> <b><font size="2">新しいパスワード</font></b></td>
      <td width=50%><input type="password" name="NEWadmin_pass" value="*****" size="30"></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50%><b><font size="2">新しいパスワード（確認）</font></b></td>
      <td width=50%>
        <input type="password" name="confirm" size="30">
        <input type="hidden" value="password" name="panel">
      </td>
    </tr>
  </table>
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000">
      <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">データベース設定</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0">
      <td colspan=2><font size="1"><b>MySQLデータベースの現在の設定です。</b></font></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50% bgcolor="#dedfdf"><b><font size="2">データベース名</font></b></td>
      <td width=50% bgcolor="#dedfdf"><b><font size="2"><?php echo $this->db->db['dbName']; ?></font></b></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width=50% bgcolor="#f7f7f7"><b><font size="2">MySQL ホスト名</font></b><br>
        <font size="1">デフォルトは 'localhost' です</font></td>
      <td width=50%><b><font size="2"><?php echo $this->db->db['host']; ?></font></b></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50%> <b><font size="2">MySQL ユーザ名 </font></b><br>
        <font size="1">データベースへアクセスするためのユーザ名</font></td>
      <td width=50%><b><font size="2"><?php echo $this->db->db['user']; ?></font></b></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width="50%" valign="top"> <b><font size="2">テーブル </font></b><br>
        <font size="1">ゲストブックで使用しているテーブル</font></td>
      <td width=50%><font size="2">

<?php
for (reset($this->table); $key = key($this->table); next($this->table)) {
    echo '- ' . $this->table[$key] . "<br>\n";
}
?>
      </font></td>
    </tr>
  </table>
  <br>
  <center>
    <input type="submit" value="Submit Settings" onclick="return checkForm()">
    <input type="reset"  value="Reset">
    <input type="hidden" value="<?php echo $this->uid; ?>" name="uid">
    <input type="hidden" value="<?php echo $this->session; ?>" name="session">
    <input type="hidden" value="password" name="panel">
    <input type="hidden" value="save" name="action">
  </center>
</form>
