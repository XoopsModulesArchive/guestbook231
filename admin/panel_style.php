<html>
<head>
<title>Guestbook - Style</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<style type="text/css">
<!--
.text_size1 {  font-family: <?php echo $this->VARS['font_face']; ?>; font-size: <?php echo $this->VARS['tb_font_1']; ?>}
.text_size2 {  font-family: <?php echo $this->VARS['font_face']; ?>; font-size: <?php echo $this->VARS['tb_font_2']; ?>}
.font {  font-family: <?php echo $this->VARS['font_face']; ?>; }

-->
</style>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" color="#313031"><b>STYLE&nbsp;&nbsp;&nbsp;&nbsp;SETTINGS</b></font><br><br>
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
      <td colspan=3 align=center height="25"><b><font size="2" color="#FFFF00">スタイル設定</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0"> 
      <td colspan=3><font size="1"><b>以下の項目を入力して下さい。</b></font> 
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2">ページ背景色</font></b><br>
        <font size="1">フォーマット - #FFFFFF</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="pbgcolor" value="<?php echo $this->VARS['pbgcolor']; ?>" size=10 maxlength=7>
      </td>
      <td width=50%>
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['pbgcolor']; ?>" bordercolor="#000000">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2">テーブル幅</font></b><br>
        <font size="1">ピクセルでもパーセントでも指定できます。</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="width" value="<?php echo $this->VARS['width']; ?>" size=10 maxlength=6>
      </td>
      <td width=50% valign=top>&nbsp;</td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2">フォント (e.g., 
        Verdana)</font><br>
        </b><font size="1">日本語で表示できるフォントを指定して下さい。</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="font_face" value="<?php echo $this->VARS['font_face']; ?>" size=38 maxlength=70>
      </td>
      <td width=50% class="font">Font</td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2">リンクカラー</font></b><br>
        <font size="1">ゲストブックのリンクカラー。フォーマット - #FFFFFF</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="link_color" value="<?php echo $this->VARS['link_color']; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['link_color']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2">テキストカラー</font></b><br>
        <font size="1">ゲストブックのテキストカラー。フォーマット - #FFFFFF</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="text_color" value="<?php echo $this->VARS['text_color']; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['text_color']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2">テキストサイズ 1</font></b><br>
        <font size="1">テキストフォントサイズ</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="tb_font_1" value="<?php echo $this->VARS['tb_font_1']; ?>" size=6 maxlength=6>
      </td>
      <td width=50% class="text_size1">Text Size 1</td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2">テキストサイズ 2</font></b><br>
        <font size="1">選択したフォントにもよりますが、小さい数字をお勧めします。</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="tb_font_2" value="<?php echo $this->VARS['tb_font_2']; ?>"size=6 maxlength=6>
      </td>
      <td width=50% class="text_size2">Text Size 2</td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <font size="2"><b>テーブルヘッダー背景色</b></font><br>
        <font size="1">フォーマット - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_hdr_color" value="<?php echo $this->VARS['tb_hdr_color']; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['tb_hdr_color']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top> <font size="2"><b>テーブル背景色</b></font><br>
        <font size="1">フォーマット - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_bg_color" value="<?php echo $this->VARS['tb_bg_color']; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['tb_bg_color']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <font size="2"><b>テーブルヘッダーテキスト色</b></font><br>
        <font size="1">フォーマット - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_text" value="<?php echo $this->VARS['tb_text']; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['tb_text']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top> <b><font size="2">最初のテーブルコラムカラー</font></b><br>
        <font size="1">フォーマット - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_color_1" value="<?php echo $this->VARS['tb_color_1']; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VAeS['tb_color_1']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2">２つ目のテーブルコラムカラー</font></b><br>
        <font size="1">フォーマット - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_color_2" value="<?php echo $this->VARS['tb_color_2']; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS['tb_color_2']; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<table border=0 width=100% bgcolor="#000000">
  <tr bgcolor="#000000">
    <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">日付/時間 表示オプション</font></b></td>
  </tr>
  <tr bgcolor="#FCF0C0">
    <td colspan=2><font size="1">
      <b>このゲストブックではいろんなフォーマットで日付け、時間を表示することが出来ますが、
      ウェブサーバの場所によって設定されます。サーバの場所と同じ場所にいない場合は、時差を設定して下さい。</b>
      </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50%>
      <b><font size="2">サーバとの時差</font></b><font size="1"><br>
        サーバのローカル時刻と、管理者のローカル時刻との差を入力して下さい。</font>
    </td>
    <td width=50% valign=top><input type="text" name="offset" value="<?php echo $this->VARS['offset']; ?>" size=3 maxlength=4></td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50%> <b><font size="2">日付フォーマット</font></b> <font size="1"><br>
      ヨーロッパスタイルは DD-MM-YR 。合衆国スタイルは、 MM-DD-YR。</font></td>
    <td width=50% valign=top> <font size="2">
      <input type="RADIO" name="dformat" value="USx" <?php if ('USx' == $this->VARS['dformat']) {
    echo 'checked';
}?>>
      US Format (04-17-2000)<br>
      <input type="RADIO" name="dformat" value="US" <?php if ('US' == $this->VARS['dformat']) {
    echo 'checked';
}?>>
      Exp. US Format (Monday, April 25, 2000)<br>
      <input type="RADIO" name="dformat" value="Eurox" <?php if ('Eurox' == $this->VARS['dformat']) {
    echo 'checked';
}?>>
      European Format (17.04.2000)<br>
      <input type="RADIO" name="dformat" value="Euro" <?php if ('Euro' == $this->VARS['dformat']) {
    echo 'checked';
}?>>
      Exp. European Format (Monday, 25 April 2000) </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50%> <b><font size="2">時刻フォーマット</font></b> <font size="1"><br>
      AM/PM 表示、または、24時間表示を選択できます。</font></td>
    <td width=50% valign=top> <font size="2">
      <input type="RADIO" name="tformat" value="AMPM" <?php if ('AMPM' == $this->VARS['tformat']) {
    echo 'checked';
}?>>
      AM/PM フォーマット<br>
      <input type="RADIO" name="tformat" value="24hr" <?php if ('24hr' == $this->VARS['tformat']) {
    echo 'checked';
}?>>
      24-時間フォーマット (eg, 23:15) </font></td>
  </tr>
</table>
 <br>
  <center>
    <input type="submit" value="Submit Settings">
    <input type="reset" value="Reset">
    <input type="hidden" value="<?php echo $this->uid; ?>" name="uid">
    <input type="hidden" value="<?php echo $this->session; ?>" name="session">
    <input type="hidden" value="save" name="action">
    <input type="hidden" value="style" name="panel">
  </center>
</form>
