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
            <textarea id="x_y_user" rows="4" cols="100">

            </textarea>
            <div style="position: relative">
                <div id="user-container">
                </div>
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

getLastXandYUser();

function getAllXandYUser(id_user, time) {
    jQuery.ajax({
        url: "<?php echo site_url('denah/getAllHistoryPosisiUser')?>",
        type: 'GET',
        dataType: 'json',
        data: {id_user: id_user, time : time},
        complete: function(xhr, textStatus) {
        //called when complete
        },
        success: function(data, textStatus, xhr) {
            //if (data.length > 0) {
                console.log(data.data);
                jQuery.each(data.data, function(index, val) {
                  $("").append(val.id_user + " "+val.x_user+ " "+val.y_user);
                });

            //}
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Erorr COK");
        }
    });
}

function getLastXandYUser(id_user, time) {
    jQuery.ajax({
        url: "<?php echo site_url('denah/getHistoryPosisiUserLastTime')?>",
        type: 'GET',
        dataType: 'json',
        data: {id_user: id_user, time : time},
        complete: function(xhr, textStatus) {
        //called when complete
        },
        success: function(data, textStatus, xhr) {
            //if (data.length > 0) {
                console.log(data.data);
                jQuery.each(data.data, function(index, val) {
                  $("#x_y_user").append("Username = " + val.username + " Posisi X =  "+val.x_user+ " Posisi Y = "+val.y_user + "\n");

                  //jika marker untuk user belum ada, maka tambahkan
                    if($('#user-' + val.username).length == 0){
                        var tmp = "<div style='height: 10px; width: 10px; background: red; position: absolute' id='user-"+val.username + "' data-toggle='tooltip' title='User : "+val.username+"'>";

                        tmp += "<div style='position: absolute; left: 15px; bottom: 15px;'></div></div>";
                        $("#user-container").append(tmp);
                    }

                    $("[data-toggle='tooltip']").tooltip();

/*                    var marginBottom = 18;
                    var marginLeft = 25;
                    var markerHeight = 10;
                    var markerWidth = 10;
                    var boxHeight = 18.5;
                    var boxWidth = 29.2;*/

                    var marginBottom = 18;
                    var marginLeft = 25;
                    var markerHeight = 10;
                    var markerWidth = 10;
                    var boxHeight = 21.9;
                    var boxWidth = 33.5;

                    $("#user-" + val.username).css('bottom', (marginBottom-(markerHeight/2)+boxHeight*val.y_user)+'px');
                    $("#user-" + val.username).css('left', (marginLeft-(markerWidth/2)+boxWidth*val.x_user)+'px');
                });
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Erorr Get Last Posisi User");
        }
    });
}

setInterval(getLastXandYUser,100000);
</script>
