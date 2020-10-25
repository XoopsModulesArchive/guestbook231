<html>
<head>
<title>Guestbook - General Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script language=JavaScript>
<!--
function CheckValue() {
  if(!(document.FormMain.entries_per_page.value >= 1)) {
    alert("The maximum records per page must be greater than 0!");
    document.FormMain.entries_per_page.focus();
    return false;
  }
}
//-->
</script>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" color="#313031"><b>GENERAL&nbsp;&nbsp;&nbsp;&nbsp;SETTINGS</b></font><br><br>
</center>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=priv&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">プライベートメッセージ</font></a> | <a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=gb&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">コメント一覧</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=general&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">全般設定</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=style&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スタイル</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=template&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">テンプレート</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=smilies&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">スマイルマーク</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=pwd&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">パスワード</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=logout&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ログアウト</font></a></b></font><br>
<HR>
<b><font size="1" color="#313031">環境変数をチェックするには、<a href="<?php echo $this->SELF; ?>?action=info&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#313031">ここをクリック</font></a></font></b>
<form action="<?php echo $this->SELF; ?>" name="FormMain" method="post" onsubmit="return CheckValue()">
<table border=0 width=100% bgcolor="#000000">
  <tr bgcolor="#000000">
    <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">一般のオプション</font></b></td>
  </tr>
  <tr bgcolor="#FCF0C0">
    <td colspan=2><font size="1"><b>ゲストブックのオプション設定です。</b></font></td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50%> <b><font size="2">１ページに表示するコメント数</font></b> <font size="1"><br>
      20 コメントが推奨数です</font></td>
    <td width=50% valign=top bgcolor="#dedfdf">
      <input type="text" name="entries_per_page" value="<?php echo $this->VARS['entries_per_page']; ?>" maxlength="5" size="5"></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top> <b><font size="2">言語</font></b><br>
      <font size="1">使用したい言語ファイル</font>.</td>
    <td width=50% valign=top><input type="text" name="lang" value="<?php echo $this->VARS['lang']; ?>">
     <select name="lang_file" onChange="forms[0].lang.value=options[selectedIndex].value">
      <option value="ja" selected>Language</option>
<?php
chdir('./lang');
$hnd = opendir('.');
while ($file = readdir($hnd)) {
    if (is_file($file)) {
        if (!preg_match('^codes-', $file)) {
            $langlist[] = $file;
        }
    }
}
closedir($hnd);
if ($langlist) {
    asort($langlist);

    while (list($key, $file) = each($langlist)) {
        if (preg_match('.php|.php3', $file, $regs)) {
            $language = str_replace((string)$regs[0], '', (string)$file);

            echo "<option value=\"$language\">$language</option>\n";
        }
    }
}
chdir('../');
?>
     </select>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50% valign=top> <b><font size="2">ゲストのIPとホスト名を表示</font></b><br>
      <font size="1">セキュリティ上、ゲストブックに書込んだ人のIPとホスト名を表示したくなりますね。デフォルトはONです。</font>
    </td>
    <td width=50% valign=top><font size="2">
      <input type="radio" name="show_ip" value="1" <?php if (1 == $this->VARS['show_ip']) {
    echo 'checked';
}?>>
      IPとホスト名を表示する<br>
      <input type="radio" name="show_ip" value="0" <?php if (0 == $this->VARS['show_ip']) {
    echo 'checked';
}?>>
      IPとホスト名を隠す</font>
    </td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top> <b><font size="2">HTML コード</font></b><br>
      <font size="1">ONにするとゲストのコメント内でHTMLコードを使用できるようになります。</font></td>
    <td width=50% valign=top>
      <font size="2">
        <input type="radio" name="allow_html" value="1" <?php if (1 == $this->VARS['allow_html']) {
    echo 'checked';
}?>>
        HTMLコードを許可<br>
        <input type="radio" name="allow_html" value="0" <?php if (0 == $this->VARS['allow_html']) {
    echo 'checked';
}?>>
        HTMLコードは無効</font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50% valign=top> <b><font size="2">スマイルマーク</font></b><br>
      <font size="1">E-mail や チャットなどで使用するスマイルと同じように使用できます。一般的な文字コードは自動的にマークに変換されます。</font></td>
    <td width=50% valign=top>
      <font size="2">
        <input type="radio" name="smilies" value="1" <?php if (1 == $this->VARS['smilies']) {
    echo 'checked';
}?>>
        スマイルマークを使用<br>
        <input type="radio" name="smilies" value="0" <?php if (0 == $this->VARS['smilies']) {
    echo 'checked';
}?>>
        スマイルマークを使用しない</font>
    </td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top> <b><font size="2">AGCodes</font></b><br>
      <font size="1">AGCode はHTMLタグの代わりになるものです。HTMLコードが無効の場合、使用することができます。</font></td>
    <td width=50% valign=top>
      <font size="2">
        <input type="radio" name="agcode" value="1" <?php if (1 == $this->VARS['agcode']) {
    echo 'checked';
}?>>
        AGCodes を許可<br>
        <input type="radio" name="agcode" value="0" <?php if (0 == $this->VARS['agcode']) {
    echo 'checked';
}?>>
        AGCodes は無効</font>
    </td>
  </tr>
</table>
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000"> 
      <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">フィールド設定</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0"> 
      <td colspan=2><font size="1"><b>ゲストブックの入力項目設定です。</b></font></td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top> <b><font size="2">ICQ</font></b><br>
        <font size="1">ICQ項目はオプションです。有効、無効を選択できます。</font> </td>
      <td width=50% valign=top><font size="2"> 
        <input type="radio" name="allow_icq" value="1" <?php if (1 == $this->VARS['allow_icq']) {
    echo 'checked';
}?>>
        ICQ 項目を使用する <br>
        <input type="radio" name="allow_icq" value="0" <?php if (0 == $this->VARS['allow_icq']) {
    echo 'checked';
}?>>
        ICQ 項目を使用しない </font> </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <b><font size="2">AIM</font></b><br>
        <font size="1">AIM は AOL インスタントメッセンジャーです。</font></td>
      <td width=50% valign=top> <font size="2"> 
        <input type="radio" name="allow_aim" value="1" <?php if (1 == $this->VARS['allow_aim']) {
    echo 'checked';
}?>>
        AIM 項目を使用する <br>
        <input type="radio" name="allow_aim" value="0" <?php if (0 == $this->VARS['allow_aim']) {
    echo 'checked';
}?>>
        AIM 項目を使用しない</font> </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top bgcolor="#dedfdf"> <b><font size="2">性別 
        </font></b><br>
        <font size="1">The gender field is also optional.</font></td>
      <td width=50% valign=top> <font size="2"> 
        <input type="radio" name="allow_gender" value="1" <?php if (1 == $this->VARS['allow_gender']) {
    echo 'checked';
}?>>
        性別項目を使用する<br>
        <input type="radio" name="allow_gender" value="0" <?php if (0 == $this->VARS['allow_gender']) {
    echo 'checked';
}?>>
        性別項目を使用しない</font></td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <b><font size="2">画像アップロード</font></b><br>
        <font size="1">ゲストに画像をアップロードすることを許可する場合は、画像の幅、高さ、最大容量を入力して下さい。それより大きな画像はリサイズされます。</font></td>
      <td width=50% valign=top> <font size="2"> 
        <input type="radio" name="allow_img" value="1" <?php if (1 == $this->VARS['allow_img']) {
    echo 'checked';
}?>>
        画像アップロードを使用する<br>
        <input type="radio" name="allow_img" value="0" <?php if (0 == $this->VARS['allow_img']) {
    echo 'checked';
}?>>
        画像アップロードを使用しない<br>
        <font size="1">大きさ</font>: 
        <input type="text" name="img_width" size="5" value="<?php echo $this->VARS['img_width']; ?>">
        X 
        <input type="text" name="img_height" size="5" value="<?php echo $this->VARS['img_height']; ?>">
        <font size="1">幅 x 高さ &nbsp;&nbsp;最大容量. 
        <input type="text" name="max_img_size" size="4" value="<?php echo round($this->VARS['max_img_size']); ?>">
        kb<br>
        </font></font></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width=50% valign=top bgcolor="#dedfdf"><font size="2"><b>サムネイル<br>
        </b><font size="1">Image Magick または PHP's GD が必要です。</font></font></td>
      <td width=50% valign=top bgcolor="#dedfdf"><font size="2"> 
        <input type="checkbox" name="thumbnail" value="1" <?php if (1 == $this->VARS['thumbnail']) {
    echo 'checked';
}?>>
        サムネイルを作成する<br>
        <font size="1">min. filesize</font> 
        <input type="text" name="thumb_min_fsize" size="5" value="<?php echo $this->VARS['thumb_min_fsize']; ?>">
        <font size="1"> kb</font></font></td>
    </tr>
  </table>
<table border=0 width=100% bgcolor="#000000">
  <tr bgcolor="#000000">
    <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">Email オプション</font></b></td>
  </tr>
  <tr bgcolor="#FCF0C0">
    <td colspan=2><font size="1">
      <b>ほとんどの Unix/Linux サーバには Sendmail がデフォルトでインストールされているはずです。sendmail までのパスは php.ini ファイルに書かれていますね。</b>
      </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top>
      <font size="2"><b>管理者 E-mail</b> <br>
       <font size="1">あなたの e-mail アドレス</font></font>
    </td>
    <td width=50% valign=top>
      <input type="text" name="admin_mail" value="<?php echo $this->VARS['admin_mail']; ?>" size=30 maxlength=60>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50% valign=top>
      <b><font size="2">E-mail によるお知らせ</font></b><br>
        <font size="1" COLOR="#000080">誰かがゲストブックに書込んだときにメールで知らせるかどうかの設定。
        </font>
    </td>
    <td width=50% valign=top> <font size="2">
      <input type="checkbox" name="notify_private" value="1" <?php if (1 == $this->VARS['notify_private']) {
    echo 'checked';
}?>>
      管理者へメール送信 (プライベートメッセージ)<br>
      <input type="checkbox" name="notify_admin" value="1" <?php if (1 == $this->VARS['notify_admin']) {
    echo 'checked';
}?>>
      管理者へメール送信<br>
      <input type="checkbox" name="notify_guest" value="1" <?php if (1 == $this->VARS['notify_guest']) {
    echo 'checked';
}?>>
      ゲストへメール送信</font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top>
      <font size="2"><b>E-mail お知らせメッセージ</b></font><br>
       <font size="1">お知らせメッセージを入力して下さい。</font>
    </td>
    <td width=50% valign=top>
      <textarea rows="5" cols="30" wrap="virtual" name="notify_mes"><?php echo $this->VARS['notify_mes']; ?></textarea>
    </td>
  </tr>
</table>
<table border=0 width=100% bgcolor="#000000">
  <tr bgcolor="#000000">
    <td colspan=2 align=center height="25"><b><font size="2" color="#FFFF00">その他のオプション
    </font></b></td>
  </tr>
  <tr bgcolor="#FCF0C0">
    <td colspan=2><font size="1">
      <b>ゲストブックのその他オプションです。</b>
      </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top> <b><font size="2">ゲストブックのコメント</font></b><br>
      <font size="1">コメントをつける際、パスワードを必要とするならば、入力して下さい。
      </font></td>
    <td width=50% valign=top>
      <font size="2">
        <input type="radio" name="need_pass" value="1" <?php if (1 == $this->VARS['need_pass']) {
    echo 'checked';
}?>>
        パスワード必要<br>
        <input type="radio" name="need_pass" value="0" <?php if (0 == $this->VARS['need_pass']) {
    echo 'checked';
}?>>
        パスワード無し<br>
        パスワード: <input type="text" name="comment_pass" size="18" value="<?php echo $this->VARS['comment_pass']; ?>"></font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
      <td width=50% valign=top bgcolor="#dedfdf"> <b><font size="2">メッセージの長さ</font></b><br>
        <font size="1">最少、最大メッセージ長を設定できます。最大１ワード数は、スペースを入れずに続けて何文字入るかです。</font> 
      </td>
    <td width=50% valign=top> <font size="2">
      <input type="text" name="min_text" size="5" value="<?php echo $this->VARS['min_text']; ?>">
      最少メッセージ長<br>
      <input type="text" name="max_text" size="5" value="<?php echo $this->VARS['max_text']; ?>">
      最大メッセージ長<br>
      <input type="text" name="max_word_len" size="5" value="<?php echo $this->VARS['max_word_len']; ?>">
      最大１ワード数</font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top>
      <b><font size="2">禁止ワードオプション</font></b><font size="1"><br>
        ここで設定した言葉を入力すると、自動的に、＊に変換されます。
        全てのメッセージ、件名に適用されます。
        有効にするには、下の「はい」にチェックをつけて、右のテキストボックスに
        禁止したい言葉を入力して下さい。<br><br>
        </font><font size="2"><CENTER>
        <INPUT TYPE="RADIO" NAME="censor" VALUE="1" <?php if (1 == $this->VARS['censor']) {
    echo 'checked';
}?>> はい
        <INPUT TYPE="RADIO" NAME="censor" VALUE="0" <?php if (0 == $this->VARS['censor']) {
    echo 'checked';
}?>> いいえ
        </CENTER></font>
        
    </td>
    <td width=50% valign=top>
     <b><font size="2">禁止ワード</font></b><font size="1"><br>
      禁止したい単語を１行に１単語入力して下さい。各単語の区切りにコンマを使用しないで下さい。
      </font><br>
     <TEXTAREA NAME="badwords" ROWS=5 COLS=30 WRAP="VIRTUAL">
<?php
if (isset($badwords) && count($badwords) > 0) {
    for ($i = 0, $iMax = count($badwords); $i < $iMax; $i++) {
        echo "$badwords[$i]\n";
    }
}
?></TEXTAREA>
    </td>
  </tr>
  <tr bgcolor="#dedfdf" valign=top>
    <td width=50%> <b><font size="2">２重投稿チェック</font></b> <font size="1"><br>
      ２重投稿を禁止するかどうかの設定です。オンに設定して、右のボックスに秒数を入力すると、投稿してから入力した秒数まで再度投稿できないようにします。
      </font>
      <br><br><CENTER><FONT SIZE="2">
      <INPUT TYPE="RADIO" NAME="flood_check" VALUE="1" <?php if (1 == $this->VARS['flood_check']) {
    echo 'checked';
}?>> オン
      <INPUT TYPE="RADIO" NAME="flood_check" VALUE="0" <?php if (0 == $this->VARS['flood_check']) {
    echo 'checked';
}?>> オフ
      </FONT></CENTER>
      </td>
    <td width=50% valign=top> <font size="2"><b>２重投稿禁止時間</b></font><font size="1"><br>
      ２重投稿を禁止する秒数を入力して下さい。
      <br>
      <input type="text" name="flood_timeout" size="5" value="<?php echo $this->VARS['flood_timeout']; ?>">
    </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50% valign=top>
      <b><font size="2">IPによる制限</font></b><font size="1"><br>
        ゲストブックへの書込みをIPで制限することが出来ます。
        正しいIPアドレスまたは、IPアドレスの一部を入力して下さい。
        ゲストの最初のIPが一致すると制限されます。
        </font><font size="2"><CENTER>
        <INPUT TYPE="RADIO" NAME="banned_ip" VALUE="1" <?php if (1 == $this->VARS['banned_ip']) {
    echo 'checked';
}?>> はい
        <INPUT TYPE="RADIO" NAME="banned_ip" VALUE="0" <?php if (0 == $this->VARS['banned_ip']) {
    echo 'checked';
}?>> いいえ
        </CENTER></font>
    </td>
    <td width=50% valign=top>
     <b><font size="2">制限する IP アドレス:</font></b><br><font size="1">
      各IPアドレスを１行に１つづつ入力して下さい。</font><br>
     <TEXTAREA NAME="banned_ips" ROWS=8 COLS=30 WRAP="VIRTUAL">
<?php
if (isset($banned_ips) && count($banned_ips) > 0) {
    for ($i = 0, $iMax = count($banned_ips); $i < $iMax; $i++) {
        echo "$banned_ips[$i]\n";
    }
}
?></TEXTAREA>
    </td>
  </tr>
</table>
 <br>
  <center>
    <input type="submit" value="Submit Settings">
    <input type="reset" value="Reset">
    <input type="hidden" value="<?php echo $this->uid; ?>" name="uid">
    <input type="hidden" value="<?php echo $this->session; ?>" name="session">
    <input type="hidden" value="save" name="action">
    <input type="hidden" value="general" name="panel">
  </center>
</form>
