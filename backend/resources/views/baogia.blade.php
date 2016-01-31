
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Xem bảng chào giá</title>
<!-- <base href="http://trungtamthietbi.com/tttb/" />[if IE]></base><![endif] -->
<link type="image/x-icon" rel="shortcut icon" href="http://www.trungtamthietbi.com/images/tttb.ico"/>
<link href="/assests/style3.css" rel="stylesheet" type="text/css">

<style type="text/css">

.style1 {font-size:13px;font-family: Arial, Helvetica, sans-serif}

</style>
</head>

<body>

<div id="printReady">
    <div class="style1" style="width:670px;margin:0 auto;position:relative">
    <div class="print_icon"><a href="javascript:;" onclick="window.print()"><img src="/assests/printer.png" title="In bản chào giá" /></a></div>
         <!--form chao gia-->
<table width="670" cellpadding="0" cellspacing="0" style="line-height: 14px;" class="td">
  <tr>
        <td colspan="3" rowspan="8" style="padding:0px;margin:0px"><a href="http://www.trungtamthietbi.com" target="_blank"><img src="/assests/logo.png"  /></a></td>
        <td colspan="4" style="padding:0px;margin:0px"><b><strong>CÔNG TY TRÁCH NHIỆM HỮU HẠN THƯƠNG MẠI YÊN HƯNG</strong></b></td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Địa chỉ</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p">Số 1/120 Trường Trinh, Phương Mai, Đống Đa, Hà Nội
</td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>VPGD</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p">Số 5-BT3, KĐT Trung Văn - Vinaconnex3, Nam Từ Liêm, Hà Nội</td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Tel/Fax</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p">043 576 4506/043 576 4301</td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Hotline Kinh doanh</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p">0902 173 585</td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Hotline kỹ thuật</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p">0968 062 125</td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Email</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><a href="mailto:tuyet.lta@yenhung.vn">tuyet.lta@yenhung.vn</a></td>
  </tr>
  <tr>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><strong>Website</strong></td>
        <td colspan="2" style="font-size:12px;padding:0px;margin:0p"><a href="http://www.yenhung.vn">www.yenhung.vn</a></td>
  </tr><br />
  <tr>
        <td colspan="7">&nbsp;</td>
  </tr>
 </table>

 
<br />


<div style="text-align:center;">
  <strong style="font-size:26px; font-weight:bold">BẢNG CHÀO GIÁ ({{date("Y-m-d", $data->time_create)}})</strong>
</div>
<br/><br/>

<table border="1" cellpadding="5" width="100%" cellspacing="0" bordercolor="#333" bgcolor="#FFFFFF">
  <tr>
    <td width="50%" valign="center" height="">Kính gửi: {{ $data->to_company }}</td>
    <td width="50%" valign="center">Người gửi: {{ $data->user->name }}</td>
  </tr>
  <tr>
    <td width="50%" valign="center" height="">Ng. nhận: {{ $data->to_name }}</td>
    <td width="50%" valign="center">SĐT : {{ $data->user->phone }}</td>
  </tr>

   <tr>
    <td width="50%" valign="center" height="">Tel: {{ $data->to_phone }}</td>
    <td width="50%" valign="center">Email: {{ $data->user->email }}</td>
  </tr>

  <tr>
    <td width="50%" valign="center" height="">ĐTDD: {{ $data->to_phone2 }}</td>
    <td width="50%" valign="center">HP: 0902.173.585</td>
  </tr>

  <tr>
    <td width="50%" valign="center" height="">Fax: {{ $data->to_fax }}</td>
    <td width="50%" valign="center">Giám đốc: Lê Thị Ánh Tuyết</td>
  </tr>

  <tr>
    <td width="50%" valign="center" height="">Email: {{ $data->to_email }}</td>
    <td width="50%" valign="center">Email: tuyet.lta@yenhung.vn</td>
  </tr>

</table><br/>

<!-- Bat dau phan noi dung -->
  <tr>
    <td colspan="9">Kính thưa Quý Công ty,</td>
  </tr><br><br>
  <tr>
    <td colspan="9" align="justify">
      Công ty Yên Hưng chân thành cảm ơn Quý Công ty đã quan tâm đến những sản phẩm mà chúng tôi đang cung cấp. Chúng tôi trân trọng gửi giá các sản phẩm Quý công ty yêu cầu như sau:
    </td>
  </tr>
  <br/>



<table border="1" cellpadding="5" width="100%" cellspacing="0" bordercolor="#333" bgcolor="#FFFFFF">
  <tr class="bold" align="center"> </tr>
  <tr bgcolor="#DBE5F1">
    <td width="41" align="center"><strong>STT</strong></td>
    <td width="255"align="center"><strong>Tên sản phẩm</strong></td>
    <td width="46" align="center"><strong>Bao bì (Kg/L)</strong></td>
    
    <td width="80" valign="top" align="center"><strong>Số lượng(Kg/L)</strong><br/>
            <strong>(VND)</strong></td>
    <td width="120" align="center"><strong>Đơn giá<br/>(VNĐ/L, VNĐ/Kg)<br/>
(chưa bao gồm VAT)"</strong></td>
    <td width="110" valign="bottom" align="center"><strong>Thành Tiền</strong><br />
            <strong>(VND) <br/>(chưa bao gồm VAT)</strong></td>
  </tr>
  <?php $total=0;?>
  @foreach ($data->items as $item)
  <tr>
    <td width="41" align="center">1</td>
    <td width="255"><span style="color:#000;"><a title="Xem chi tiết sản phẩm" target=_blank href=""><span style="color:#000">{{$item->product_name}}</span></a></span><br /><br>&nbsp;
    {{$item->description}}
    </td>
    <td width="46" align="center">{{$item->unit}}</td>
    <td width="46" align="center">{{$item->quantity}}</td>
    <td width="80" align="right">{{number_format($item->price)}}đ</td>
    <td width="80" align="right">{{number_format($item->price * $item->quantity)}}đ</td>
    <?php $total += $item->price * $item->quantity;?>
  </tr>
  @endforeach

  
  <tr>
    <td width="41" valign="middle"></td>
    <td width="255" align="center"><strong>Cộng</strong></td>
    <td width="100" valign="middle"><strong>&nbsp;</strong></td>
    <td width="46" valign="middle"><strong>&nbsp;</strong></td>
    <td width="46" valign="middle"><strong>&nbsp;</strong></td>
    <td width="80" valign="middle" align="right"><strong>{{number_format($total)}}đ</strong></td>
  </tr>
  <tr>
    <td width="41" valign="middle"></td>
    <td width="255" align="center"><strong>10% VAT</strong></td>
    <td width="100" valign="middle">&nbsp;</td>
    <td width="46" valign="middle">&nbsp;</td>
    <td width="46" valign="middle">&nbsp;</td>
    <td width="80" valign="middle" align="right">{{number_format(($total / 100) * 10)}}đ</td>
  </tr>

  <tr>
    <td width="41" valign="middle"></td>
    <td width="255" align="center"><strong></strong>Tổng cộng</strong></td>
    <td width="100" valign="middle">&nbsp;</td>
    <td width="46" valign="middle">&nbsp;</td>
    <td width="46" valign="middle">&nbsp;</td>
    <td width="80" valign="middle" align="right">{{number_format($total + (($total / 100) * 10))}}đ</td>
  </tr>
  

<tr></tr>
</table>
<br/>

<td>
<strong><u>Ghi chú: </u></strong><br/>
<strong>Phương thức thanh toán</strong><br/>

  <p>Thanh toán bằng: Chuyển khoản/ Tiền mặt</p>
  <p>Thời hạn thanh toán : Thanh toán trong vòng {{$data->delivery_day}} ngày từ khi nhận được hàng và hóa đơn VAT </p>
  <p>Chủ TK : Công ty TNHH Thương Mại Yên Hưng </p>
  <p>Số TK: 21110000128398 - BIDV Hà Nội </p>
<br/>

<strong>Thời hạn giao hàng</strong><br/>
<p>Theo bảng kê chi tiết như trên</p>
<br/>




<strong>Địa điểm giao hàng</strong><br/>

  <p>Tại kho của Quý Công ty tại Nội thành Hà Nội</p>
<br/>

<strong>Dịch vụ sau bán hàng</strong><br/>
<p>Huấn luyễn kỹ thuật cho nhân viên về các sử dụng và bảo quản dầu</p>
<p>Kết hợp với đội kỹ thuật của quý Công ty để lên lịch trình bảo trì bảo dưỡng máy</p>
<p>Kết hợp với đội kỹ thuật của quý Công ty để làm các bảng chuyển đổi sản phẩm nếu Quý Công ty có nhu cầu</p>
<br/>

<strong>Thời hạn báo giá</strong><br/>
<p>Giá trên có giá trị  từ ngày báo giá đến ngày có báo giá mới thay thế</p>
<p>Rất mong được hợp tác cùng Quý Công ty </p>
<p>Trân trọng kính chào</p>

<br/>

<img src="/assests/chuky.png" title="In bản chào giá" />

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

        
    </table>
      <!--end form chao gia-->
<style>.border-top-left{ border-top: 2px solid #111; border-left: 2px solid #111;}
        .border-top-right{ border-top: 2px solid #111; border-right: 2px solid #111;}
        .border-top{ border-top: 2px solid #111;}
        .border-bottom{ border-bottom: 2px solid #111;}
        .border-left{ border-left: 2px solid #111;}
        .border-right{ border-right: 2px solid #111;}
        .border-bottom-left{ border-bottom: 2px solid #111; border-left: 2px solid #111;}
        .border-bottom-right{ border-bottom: 2px solid #111; border-right: 2px solid #111;}
        .border-left-right{ border-left: 2px solid #111; border-right: 2px solid #111;}
        table,td,td *,ul,li,table  tr td
        {
            font-size:13px;font-family:Arial;color:#000;
            line-height:14px;
        }
        body,b
        {
        font-family:Arial;
        }
</style>         
    </div>
<!-- End demo -->
 </form>

   
    </div>
<script language="javascript">
function getDocHeight() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
    );
}
function getpage()
{
    var h = getDocHeight()-20;
    if(h<1208)
    {
        document.getElementById('page').innerHTML=1;
    }
    else if(1208<h<1208*2) {document.getElementById('page').innerHTML=2;}
    else if(1208*2<h<1208*3) {document.getElementById('page').innerHTML=3;}
    else{document.getElementById('page').innerHTML=1;}
}
getpage();
</script>
<style>
@media print
{

}
</style>
</body>
</html>
