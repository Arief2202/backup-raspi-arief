<?php require_once "data.php" ?>
<!DOCTYPE html>
<!-- saved from url=(0107)https://www.tokopedia.com/invoice.pl?id=827094735&pdf=Invoice-163763300-3990667-20210619003904-b29vb29vb281 -->
<html lang="id"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Invoice_files/style.css">
</head>

<body style="font-family: open sans, tahoma, sans-serif; margin: 0; -webkit-print-color-adjust: exact; padding-top: 60px;">
    
    <div id="action-area">
        <div id="navbar-wrapper" style="padding: 12px 16px;font-size: 0;line-height: 1.4; box-shadow: 0 -1px 7px 0 rgba(0, 0, 0, 0.15); position: fixed; top: 0; left: 0; width: 100%; background-color: #FFF; z-index: 100;">
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px;">
                <div class="btn-back" onclick="window.close();">
                    <img src="./Invoice_files/back-invoice.png" width="20px" alt="Back" style="display: inline-block; vertical-align: middle;">
                    <span style="display: inline-block; vertical-align: middle; margin-left: 16px; font-size: 16px; font-weight: bold; color: rgba(49, 53, 59, 0.96);">Invoice</span>
                </div>
            </div>
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px; text-align: right;">
                <a class="btn-download" href="javascript:window.print()" style="display: inline-block; vertical-align: middle;">
                    <img src="./Invoice_files/download-invoice.png" alt="Download" width="20px" ;="">
                </a>
                <a class="btn-print" href="javascript:window.print()" style="height: 100%; display: inline-block; vertical-align: middle;">
                    <button id="print-button" style="border: none; height: 100%; cursor: pointer;padding: 8px 40px;border-color: #03AC0E;border-radius: 8px;background-color: #03AC0E;margin-left: 16px;color: #fff;font-size: 12px;line-height: 1.333;font-weight: 700;">Cetak</button>
                </a>
            </div>
        </div>
    </div>
    <?php
        function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka, 0, '', '.');
            return $hasil_rupiah;   
        }
    ?>

    <div class="content-area">        
            <div style="background: url(https://ecs7.tokopedia.net/img/invoice/paid-stamp.png) center no-repeat; background-size: contain; margin: auto; width: 790px;">
                <table width="100%" cellspacing="0" cellpadding="0" style="width: 100%; padding: 25px 32px; color: #343030;">
                    <tbody><tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" style="padding-bottom: 20px; border-bottom: thin dashed #cccccc;">
                                <tbody><tr>
                                    <td style="width: 57%; vertical-align: top;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody><tr>
                                                <td colspan="2">
                                                    <img src="./Invoice_files/tokopedia-logo-large.png" alt="Tokopedia" style="margin-bottom: 15px; width: 147px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-size: 14px;">
                                                    <span style="font-weight: 600">Nomor Invoice</span> : <span style="color: #42b549; font-weight: 600;"><?php echo $noInvoice; ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-size: 12px; padding: 8px 0;">
                                                    Diterbitkan atas nama:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                    Penjual
                                                </td>
                                                <td style="font-size: 12px; padding-bottom: 6px;">
                                                    <a href="<?php echo $seller[1]; ?>">
                                                    <?php echo $seller[0]; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                    Tanggal</td>
                                                <td style="font-size: 12px; padding-bottom: 6px;">
                                                    <?php echo $tanggal; ?>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                    <td style="width: 43%; vertical-align: top; padding-left: 30px;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody><tr>
                                                <td style="font-weight: 600; font-size: 14px;padding-bottom: 8px;">
                                                    Tujuan Pengiriman:</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; padding-bottom: 20px;">
                                                    <span style="margin-bottom: 3px; font-weight: 600; display: block;">Hasan Zain</span>
                                                    <div>
                                                        Jl Mulyorejo Barat No 19, Kec. Mulyorejo, Kota Surabaya, Jawa Timur, 60115 <br>[Tokopedia Note: Rumah]
                                                        <br>Mulyorejo
                                                        Kota Surabaya
                                                        60115 <br>
                                                        Jawa Timur <br>
                                                        6285157677765
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; margin-top: 20px;">
                                <tbody><tr style="background-color: rgba(242, 242, 242, 0.74); font-size: 14px; font-weight: 600;">
                                    <td style="padding: 10px 15px;">Nama Produk</td>
                                    <td style="padding: 10px 15px; text-align: center;">Jumlah</td>
                                    <td style="padding: 10px 15px; text-align: center;">Berat</td>
                                    <td style="padding: 10px 15px; text-align: center; white-space: nowrap;">Harga
                                        Barang</td>
                                    <td style="padding: 10px 15px; text-align: right;">Subtotal</td>
                                </tr>

                                
                                <?php for($a = 0; $a<count($product); $a++){?>
                                <tr style="font-size: 14px;">
                                    <td width="330" style="padding: 15px; font-weight: 600; word-break: break-word;"><a href="<?php echo $product[$a][4]; ?>">
                                        <?php
                                        echo $product[$a][0];
                                        ?>
                                        </a>
                                        <div style="margin: 10px 0 0;"></div>
                                        <div style="margin: 10px 0 0;"></div>
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center;">
                                        <?php
                                        echo $product[$a][1];
                                        ?>
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center; white-space: nowrap;">
                                        <?php
                                        echo $product[$a][2];
                                        ?>
                                        gr
                                    </td>
                                    <td valign="top" style="padding: 15px; white-space: nowrap; text-align: center;">
                                        <?php
                                        echo rupiah($product[$a][3]);
                                        ?>
                                    </td>
                                    <td valign="top" style="padding: 15px; white-space: nowrap;">
                                        <?php
                                        echo rupiah($product[$a][3]*$product[$a][1]);
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5" style="padding: 0 15px;">
                                        <div style="border-bottom: thin solid #e0e0e0"></div>
                                    </td>
                                </tr>

                                

                                <tr>
                                    <td></td>
                                    <td colspan="4">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="padding-right: 15px; font-size: 14px; font-weight: 600;">
                                            <tbody><tr>
                                                <td colspan="2">
                                                    <div style="border-bottom: thin solid #e0e0e0"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px;">Subtotal Harga Barang</td>
                                                <td style="padding: 15px 0 15px 15px; text-align: right;">
                                                    <?php
                                                    $totalharga = 0;
                                                    $totalberat = 0;
                                                    for($a=0; $a<count($product); $a++){
                                                        $totalharga += ($product[$a][3]*$product[$a][1]);
                                                        $totalberat += $product[$a][2];
                                                    }
                                                    echo rupiah($totalharga);
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>

                    <!-- refactor div float left and right in case order is kelontong -->
                    <tr>
                        <td>
                            <div id="container_invoice_qr" style="float:left; font-weight: bold;
                                    margin-top:20px;">
                                
                            </div>

                            <div style="float:right;">
                                <table>
                                    <!-- subtotal ongkir -->
                                    <tbody><tr>
                                        <td>
                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                <tbody><tr>
                                                    <td style="width: 50%;"></td>
                                                    <td style="width: 50%;">
                                                        <table width="100%" style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; border: thin dashed #cccccc; font-size: 14px; font-weight: 600;">
                                                            <tbody><tr style="font-weight: normal; font-size: 12px;">
                                                                <td style="padding-bottom: 10px;">
                                                                    <?php
                                                                    echo $kirim[0];
                                                                    echo " - ";
                                                                    echo $kirim[1];
                                                                    ?>
                                                                    (Berat:
                                                                    <?php echo $totalberat; ?> 
                                                                    gr)</td>
                                                                <td style="padding-bottom: 10px;text-align: right; white-space: nowrap; vertical-align: top;">
                                                                    <?php
                                                                        echo rupiah($kirim[2]);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <!-- show this in invoice section subtotal ongkos kirim -->
                                                            
                                                            <tr>
                                                                <td style="border-top: thin solid #e0e0e0; padding-top: 10px;">
                                                                    Subtotal Ongkos Kirim</td>
                                                                <td style="border-top: thin solid #e0e0e0; padding-top: 10px; text-align: right; white-space: nowrap;">
                                                                    <?php
                                                                        echo rupiah($kirim[2]);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <!-- subtotal biaya lain -->
                                    
                                    <tr>
                                        <td>
                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                <tbody><tr>
                                                    <td style="width: 50%;"></td>
                                                    <td style="width: 50%;">
                                                        <table width="100%" style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; border: thin dashed #cccccc; font-size: 12px; font-weight: 600;">
                                                            

                                                            

                                                            
                                                            <tbody><tr style="font-weight: normal;">
                                                                <td style="padding-bottom: 10px;">
                                                                    Asuransi
                                                                    
                                                                    <div style="font-size: 11px; color: rgba(0, 0, 0, 0.54); margin-top: 8px;">
                                                                        Paket ini tidak menggunakan asuransi pihak logistik, penjual <strong>tidak perlu bayar asuransi</strong> ke kurir.
                                                                    </div>
                                                                    
                                                                </td>
                                                                <td style="padding-bottom: 10px;text-align: right; white-space: nowrap; vertical-align: top;">
                                                                    <?php
                                                                        echo rupiah($asuransi);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr style="font-size: 14px;">
                                                                <td style="border-top: thin solid #e0e0e0; padding-top: 10px;">
                                                                    Subtotal Biaya Lainnya</td>
                                                                <td style="border-top: thin solid #e0e0e0; padding-top: 10px; text-align: right; white-space: nowrap;">
                                                                    <?php
                                                                        echo rupiah($asuransi);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    

                                    <!-- total belanja -->
                                    

                                    <!-- subtotal nilai tukar tambah -->
                                    


                    <!-- subtotal nilai promo -->
                    

                    <!-- total invoice -->
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                    <td style="width: 50%;"></td>
                                    <td style="width: 50%;">
                                        <table width="100%" style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; border: thin solid rgba(0, 0, 0, 0.54); font-size: 14px; font-weight: 600;">
                                            <tbody><tr>
                                                <td>Total Bayar</td>
                                                <td style="text-align: right;">
                                                    <?php
                                                        $totalharga += $kirim[2];
                                                        $totalharga += $asuransi;
                                                        echo rupiah($totalharga);
                                                    ?>                                                
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>

                    <!-- Keterangan -->
                    
                </tbody></table>
            </div>
            </td>
            </tr>
            </tbody></table>
        </div>
    </div>

<script type="text/javascript" src="./Invoice_files/46XBAWNiA"></script>

<script src="./Invoice_files/d1dd3126ee9ae2b8381ed123ca34b2a2.js.download" type="text/javascript"></script>
<script src="./Invoice_files/6b42e5043225d4bd57fb1d885f07b835.js.download" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (event) {

        var qrcode = new QRCode("invoice_qr", {
            text: "",
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        $('#invoice_qr').on('contextmenu', 'img', function (e) {
            return false;
        });
    });
</script>

</body></html>