    <!-- Main content -->
<section class="content container-fluid">
  <div class="box">
      <div class="box-header with-border">
          <h3>Dashboard JDIH</h3><small> Kabupaten Donggala</small>
      </div>
        <div class="box-body">
          <div class="row">
            <h3 align="center" style="color:#1f7a1f;">Rekapitulasi Jumlah Produk Hukum</h3>
            <br>
            <div class="col-sm-6">
              <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="col-sm-6">
              <div id="pie" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>

          </div>
        </div>
  </div>
</section>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php
            foreach ($ref_kategori as $value)
            {
            ?>
                '<?php echo $value->kategori ?>',
            <?php
            }
            ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah (Produk Hukum)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} Produk Hukum</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [

        <?php 
        foreach ($ref_status_peraturan as $list_status)
        {
        ?>
            {
                

                name: '<?php echo $list_status->nama_status_peraturan ?>',
                data: [
                    <?php
                    foreach ($ref_kategori as $value)
                    {
                    
                        $jum = $this->db->query('select ta_produk_hukum_det.id_produk_hukum, ta_produk_hukum_det.id_status_peraturan From ta_produk_hukum LEFT JOIN ta_produk_hukum_det ON ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum WHERE (ta_produk_hukum_det.id_status_peraturan='.$list_status->id_status_peraturan.') AND (ta_produk_hukum.id_kategori='.$value->id_kategori.') GROUP BY ta_produk_hukum_det.id_produk_hukum')->num_rows();
                        echo $jum;
                        echo ",";
                    }
                    ?>

                ]

            },
        <?php
        }
        ?>
    ]

});
</script>

<script type="text/javascript">
  
Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Berdasarkan Jenis Peraturan'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Jumlah',
        colorByPoint: true,
        data: [
            <?php 
            foreach ($ref_kategori as $value)
            {
                $jum = $this->db->query('select * From ta_produk_hukum where id_kategori='.$value->id_kategori.'')->num_rows();
            ?>
            {
                name: '<?php echo $value->kategori ?>',
                y: <?php echo $jum ?>,
                
            },
            <?php
            }
            ?>
        ]
    }]
});
</script>



