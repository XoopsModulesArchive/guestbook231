<html>
<head>
<title>Guestbook - Templates</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<style type="text/css">
<!--
.text_size1 {  font-family: <?php echo $this->VARS['font_face']; ?>; font-size: <?php echo $this->VARS['tb_font_1']; ?>}
.text_size2 {  font-family: <?php echo $this->VARS['font_face']; ?>; font-size: <?php echo $this->VARS['tb_font_2']; ?>}
.font {  font-family: <?php echo $this->VARS['font_face']; ?>; }
.textfield {  font-size: 11px; width: 550px; height: 500px}

-->
</style>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" color="#313031"><b>GUESTBOOK&nbsp;&nbsp;&nbsp;&nbsp;TEMPLATES</b></font><br><br>
</center>
<font size="2"><b><a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=priv&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">プライベートメッセージ</font></a> | <a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=gb&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">コメント一覧</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=general&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">全般設定</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=style&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スタイル</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=template&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">テンプレート</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=smilies&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スマイルマーク</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=pwd&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">パスワード</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=logout&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ログアウト</font></a></b></font><br>
<HR>
<b><font size="1" color="#313031">環境変数をチェックするには、<a href="<?php echo $this->SELF; ?>?action=info&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ここをクリック</font></a></font></b>
<form action="<?php echo $this->SELF; ?>" name="FormMain" method="post">
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000"> 
      <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">テンプレート</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0"> 
      <td colspan=2><font size="1" color="#DD0000">
      <b>テンプレートファイルに書込みパーミッションを設定して下さい。</b></font></td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td valign="top"> <b><font size="2">ゲストブックテンプレート</font></b><br>
          <br>
        <table border="0" cellspacing="0" cellpadding="1">
<?php
for (reset($GB_TPL); $key = key($GB_TPL); next($GB_TPL)) {
    echo "         <tr> 
            <td width=\"15\">-</td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><a href=\"$this->SELF?action=template&amp;tpl_name=$GB_TPL[$key]&amp;session=$this->session&amp;uid=$this->uid\"><font color=\"#000066\">
            $GB_TPL[$key]</font></a></font></td>
          </tr>\n";
}
?>
        </table>
       <br>
      </td>
      <td valign=top align="center"><font size="2" color="#009900"> 
        </font> 
        <table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td align="center"><font size="2" color="#009900"><b> 
              <?php echo $tpl_name; ?>
              </b> </font></td>
          </tr>
          <tr>
            <td>
              <textarea name="gb_template" cols="60" rows="30" class="textfield" wrap="VIRTUAL"><?php echo htmlspecialchars($gb_template, ENT_QUOTES | ENT_HTML5); ?></textarea>
            </td>
          </tr>
        </table>
        <br>
      </td>
    </tr>
  </table>
  <br>
  <center>
    <input type="submit" value="Submit Settings">
    <input type="reset" value="Reset">
    <input type="hidden" name="uid" value="<?php echo $this->uid; ?>">
    <input type="hidden" name="session" value="<?php echo $this->session; ?>">
    <input type="hidden" name="action" value="template">
    <input type="hidden" name="tpl_name" value="<?php echo $tpl_name; ?>">
    <input type="hidden" name="save" value="update">
  </center>
</form>
