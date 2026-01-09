
<tr id ='<?= $id_produk_hukum ?>'>
	<td><button type="button" class="btn btn-danger btn-xs" id='rem' onclick="
	var child = document.getElementById('<?= $id_produk_hukum ?>');
    var subject_produk=$('#subject_produk').val();
	var split_subject_produk = subject_produk.split('=>');

	var subject_status=$('#subject_status').val();
	var split_subject_status = subject_status.split('=>');
    var id_produk_hukum=('<?= $id_produk_hukum ?>');

	

	for (var i = 0; i < split_subject_produk.length; i++) {

        if(split_subject_produk[i]!=id_produk_hukum)
        {
        	if (isNaN(hasil_subject_produk))
            {
            	var hasil_subject_produk = (split_subject_produk[i]);
            	var hasil_subject_status = (split_subject_status[i]);

            }
            else
            {
            	var hasil_subject_produk = (hasil_subject_produk) +'=>'+ (split_subject_produk[i]);
            	var hasil_subject_status = (hasil_subject_status) +'=>'+ (split_subject_status[i]);
            }
        }
    }


	$('#subject_produk').val(hasil_subject_produk);
	$('#subject_status').val(hasil_subject_status);
	//$(this).parent().parent().remove();
    child.remove();
    console.log(child);


	"><i class="fa fa-trash"></i></button></td>
	<td><?= $peraturan?></td>
    <td><?= $exp_status_peraturan?></td>
</tr>