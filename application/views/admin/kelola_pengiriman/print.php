<?php

$css = '<style type="text/css"> 

body{  
  font-size: 10px;
  font-family: Arial, Sans Serif;
}

h3{
  font-size:16px;
}

#page {
  width: 100%;  
}
 

p{
  margin-bottom: 2px;
}

h3{
  font-weight: 600;
  text-transform: uppercase;
}

hr{
  height: 2px;
}

table{
  width: 100%;
}
.table-bordered{
  border-collapse: collapse;
}
.table-bordered td, .table-bordered th{
  border: 1px solid #333;
  padding: 7px 15px;
}

.text-left{
  text-align: left;
}
.text-right{
  text-align: right;
}
 
</style>';


$html = '<body>  
  <div id="page">
    <div class="header">
      <table>
        <tr>
          <td>
           <h3>' . $profile->nama_cv . '</h3>
            <p>' . $profile->alamat_cv . '</p>
            <p>Telp: ' . $profile->kontak_cv . ' | Email: ' . $profile->email_cv . '</p>
          </td>
          <td style="text-align: right"> 
            <h4><b>SURAT JALAN</b></h4><br>
            <p>Transaksi: <b>#'.$print->no_bukti.'</b></p> 
          </td>
        </tr>
      </table>
    </div>
    <hr>

    <table>
      <tr>
        <td width="74%"> 
          <p>Kepada : </p> 
          <p><b>' . $print->nama. '</b><br>' . $print->alamat. '<br>No Telp : ' . $print->no_telp. '</p> 
        </td>
        <td> 
          <p><h4>No. Surat Jalan #' . $print->no_pengiriman .'</h4></p> 
          <p>Tanggal : ' . $print->tgl_transaksi. '</p>
        </td>
      </tr>
    </table>  
    
    <br> 
    <table class="table-bordered">
      <thead>
        <tr>
          <th width="5%">No</th> 
               <th>Kode</th>  
               <th>Nama Produk</th>    
               <th width="25%">Deskripsi</th>    
               <th width="10%">Qty</th>  
               <th>Satuan</th>  
               <th>Jumlah</th>  
        </tr>
      </thead>
      
      <tbody>';
  
         $html .=' <tr>
            <td>' . (1). '</td>  
            <td>' . $print->kode. '</td> 
            <td>' . $print->nama_produk. '</td> 
            <td>' . $print->deskripsi. '</td> 
            <td>' . $print->berat. '</td>  
            <td align="center">' . ('KG') .'</td>  
            <td>' . format_rupiah($print->total). '</td>  
          </tr>';
   


      $html .= '</tbody>
      <tfoot>
        <tr>
          <th colspan="6" class="text-right">Total</th>
          <th class="text-left">' . format_rupiah($print->total). '</th>
        </tr>
      </tfoot> 
    </table> 
    <br>

    <table>
      <tr>
        <td style="height: 30px;">
          Mohon Diperiksa kondisi barang dan diterima.<br><br> 
        </td>
        <td width="30%"></td>
        <td> 
          Barang diterima pada tanggal .........................<br><br> 
        </td>
      </tr> 
      <tr>
        <td style="text-align: center">
          <div style="text-align: center; ">Pengirim<br><br><br><br>

          (................................................)
          </div>
        </td> 
        <td></td>
        <td style="text-align: center">
          <div style="text-align: center; ">Penerima<br><br><br><br>

          (................................................)
          </div>
        </td> 
      </tr>
    </table> 
  </div><!-- end page -->';

  $mpdf = new \Mpdf\Mpdf();
  

  //echo $css . $html;die;
  $mpdf->CSSselectMedia='mpdf';  
  $mpdf->WriteHTML($css . $html);
  $mpdf->Output('nota_pengiriman_' . $print->no_pengiriman . '.pdf', \Mpdf\Output\Destination::INLINE);



 