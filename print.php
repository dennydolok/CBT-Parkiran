<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Parkiran</title>
 <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>

 <link href="asset/css/style.css" rel="stylesheet">

 <link rel="shortcut icon">

</head>

<?php
include 'config/koneksi.php';
session_start();
$query = mysqli_query($con, "SELECT kd_parkir,no_kendaraan,jam_masuk FROM tbl_pengendara WHERE no_kendaraan='$_GET[no_kendaraan]'");
$data = mysqli_fetch_array($query);

if (isset($_POST['print'])) {
  echo "<script>document.location.href='pengendara/pengendara/index.php'</script>";
}
?>
<script language="javascript">
  function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
<body>
	<div class="col-md-12">
 
    <center>
      <form method="post">
        <div class="page-404 animated flipInX"> 
        <div id="divToPrint">
          <div id="print-karcis" class="print-area" style="color : #2280c2;">
           <img src="asset/img/g3986.png" style="width: 10%">
           <h2 style="font-weight:bold; color: #696969 ;margin-top: -4px;">Kode Parkir Anda</h2>
           <h1 style="font-size: 70pt; font-weight: bold; color:#808080; margin-top: -10px;"><?= $data['kd_parkir'] ?></h1>
           <h3 style="margin-top: -10px;color: #696969"><?= $data['no_kendaraan'] ?></h3>
           <h3 style="color: #696969"><?php echo @$_SESSION['penjaga'] ?></h3>
           <h5 style="margin-top: 10px;color: #696969">Jam Masuk : <?= $data['jam_masuk'] ?></h5>
           </div>
           <button type="submit" onClick="PrintDiv();" class="btn btn-outline btn-success no-print" style="width: 13%;height: 1%; margin-top: 1%" name="print">
            <div style="font-size: 14pt; font-weight: bold;">
              <span class="icons icon-printer"> </span>
              Print
            </div>
          </button>
        </div>
      </div>
    </form>
  </center>
</div>

<textarea id="printing-css" style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,em,img,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,footer,header,output,ruby,section,summary,time,mark{margin:10;padding:0;border:0;font-size:100%;font:inherit;vertical-align:center;text-align:center;}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1;}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:#f1f1f1;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script>
	function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
  }
</script>
</body>
</html>