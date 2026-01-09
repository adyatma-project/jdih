<?php 
$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
$ref_status_peraturan = $this->db->query('select * from ref_status_peraturan')->result(); 
?>

<br>
<br>
<div class="row center"> <!-- Awal Row -->
    <div id="container"></div>  
    <div class="form-group pull-right">
                <a href="<?php echo base_url() ?>" class="btn btn-default"><< Kembali</a>
            </div>
</div><!-- Akhir Row -->
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Rekapitulasi Produk Hukum Berdasarkan Status'
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
                    
                        $jum = $this->db->query('select ta_produk_hukum.id_produk_hukum From ta_produk_hukum LEFT JOIN ta_produk_hukum_det ON ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum where (ta_produk_hukum_det.id_status_peraturan='.$list_status->id_status_peraturan.') AND (ta_produk_hukum.id_kategori='.$value->id_kategori.')')->num_rows();
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