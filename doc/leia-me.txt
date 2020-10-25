Advanced Guestbook 2.3.1 (xoops2)
必要システム:

  - MySQL 3.22.x or higher
  - PHP 4
+----------------------------------------------+
オリジナルスクリプト配布サイト
URL: http://www.proxy2.de

XOOPS モジュール作成
http://www.rc-net.jp/xoops/
+----------------------------------------------+
guestbook231.zipファイルをダウンロードし解凍
1.設定ファイル config.inc.php をテキストエディタで開き
データベース設定を行って下さい。
guestbook231/admin/config.inc.php

/* database settings */

$GB_DB["dbName"] = "XOOPSで使用のデータベース名";
$GB_DB["host"]   = "localhost";
$GB_DB["user"]   = "user";
$GB_DB["pass"]   = "pass";
2. サーバにアップロード(modules/guestbook231)
3. 以下のディレクトリのパーミッションを変更して下さい。

    - public - 777 (drwxrwxrwx) (directory)
    - tmp    - 777 (drwxrwxrwx) (directory)
テンプレートファイルを編集する場合は、以下のファイルのアクセス権を書き込み可とする。
- admin_enter.php 
- body.php 
- entry.php 
- error.php 
- form.php 
- preview.php 
- preview_entry.php 
- header.php 
- footer.php 
- icq.php 
- url.php 
- aim.php 
- com.php 
- email.php 
- success.php 
- form_icq.php 
- form_aim.php 
- form_gender.php 
- form_image.php 
- com_pass.php 
- comment.php 
- user_pic.php 

4. インストール、及び初期設定
メインメニュから、ゲストブックをクリック、管理メニューをクリックしてログイン
   Username : test
   Password : 123
5.ユーザー名、パスワードを変更
パスワードをクリック、ユーザー名、パスワードを変更し、Submit Settingsボタンをクリック
6.全般設定
・ページに表示するコメント数  
・言語
・ゲストのIPとホスト名を表示
・HTML コード  
・スマイルマーク
・AGCodes　
7.フィールド設定 
ゲストブックの入力項目設定です。 
・ICQ　（ICQ項目はオプションです。有効、無効を選択できます。）   
・AIM　（AIM は AOL インスタントメッセンジャーです。）  
・性別 （性別項目の表示指定）
・画像アップロード（ゲストに画像をアップロードすることを許可する場合は、
画像の幅、高さ、最大容量を入力して下さい。それより大きな画像はリサイズされます。）  
・サムネイル　（Image Magick または PHP's GD が必要です。）

■Email オプション 
・e-mail アドレス  （ メールアドレスの指定） 
・E-mail によるお知らせ（誰かがゲストブックに書込んだときにメールで知らせるかどうかの設定。）   
・E-mail お知らせメッセージ　（お知らせメッセージを入力して下さい。）  
■その他のオプション  
ゲストブックのその他オプションです。  
・ゲストブックのコメント　（コメントをつける際、パスワードを必要とするならば、入力して下さい。）   
・メッセージの長さ　（最少、最大メッセージ長を設定できます。最大１ワード数は、
スペースを入れずに続けて何文字入るかです。）   
・禁止ワードオプション　（ここで設定した言葉を入力すると、自動的に、＊に変換されます。） 
・２重投稿チェック　（ ２重投稿を禁止するかどうかの設定です。オンに設定して、
右のボックスに秒数を入力すると、投稿してから入力した秒数まで再度投稿できないようにします。） 
・IPによる制限　（ゲストブックへの書込みをIPで制限することが出来ます。正しいIPアドレスまたは、
IPアドレスの一部を入力して下さい。 ゲストの最初のIPが一致すると制限されます。 ）



