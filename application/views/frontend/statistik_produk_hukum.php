<?php 
$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result(); 
?>
<br>
<br>
<div class="row center"> <!-- Awal Row -->
	<div id="aset_produk_hukum"></div>	
	<div class="form-group pull-right">
				<a href="<?php echo base_url() ?>" class="btn btn-default"><< Kembali</a>
			</div>
</div><!-- Akhir Row -->
<script src="https://code.highcharts.com/themes/dark-unica.js"></script>

<script type="text/javascript">
  Highcharts.chart('aset_produk_hukum', {

    title: {
        text: 'Statistik Produk Hukum'
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: 'Jumlah'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 1999
        }
    },

    series: [
     <?php
      
            foreach ($ref_kategori as $value)
            {
              

              $order_tahun = $this->db->query('SELECT * FROM ta_produk_hukum ORDER BY tahun ASC')->row();

              //$tahun = $order_tahun->tahun;

              ?>
               {
                  name: '<?= $value->kategori ?>',
                   data: [
                   <?php 

                   for($tahun = $order_tahun->tahun; $tahun < date('Y')+1; $tahun++){

                      $produk_hukum = $this->db->query('SELECT tahun, count(*) as jumlah FROM ta_produk_hukum WHERE id_kategori='.$value->id_kategori.' AND tahun='.$tahun)->row();
                      if ($produk_hukum->jumlah==0){
                        echo 'null ,';
                      }
                      else
                      {
                        echo $produk_hukum->jumlah.',';
                      }

                      
                  }

                   // foreach ($produk_hukum as $produk_hukum_list) {
                   //      echo $produk_hukum_list->jumlah.',';
                   // }
                   ?>
                   ]
                }, 


              <?php
            }
      ?>
     
     
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>