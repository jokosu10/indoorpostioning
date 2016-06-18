<?php 
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>

<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Denah Lantai <?php echo $denah["id_denah_ruangan"];?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php echo validation_errors();?>
        <form role="form" method="post" action="<?php echo base_url();?>denah/uploaddenah1" enctype="multipart/form-data">
            <div class="form-group">
            <label >Upload Image Denah</label>
               	<input type="file" name="upload_image_denah1" id="upload_image_denah1" accept="image/png, image/jpg, image/jpeg"><br/>
            	<button type="submit" class="btn btn-primary" >Upload</button>
            </div>
            <div>
            	<?php if (!empty($denah)) { ?>
            		<img id="image" src="<?php echo site_url('imagedenah/'.$denah['img_denah_ruangan']);?>">	
            	<?php } else { ?>
            		<img id="image" src="">
           		<?php }?>
           </div>
                <input type="hidden" name="id_image_denah_1" class="form-control"  value="<?php echo $denah["id_denah_ruangan"];?>"/>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.boxs -->
<script type="text/javascript">

function in_array(text,arr) {
    return (arr.indexOf(text) != -1);
}

$(':file').change(function (e) {
    var file = this.files[0];
    var URL = window.URL || window.webkitURL;
    $("#image").attr('src', "");
    $("#image").attr('src', URL.createObjectURL(file));
});
</script>