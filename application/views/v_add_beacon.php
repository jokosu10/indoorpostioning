<?php 

    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>
<?php var_dump($cubeacon);?>
<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Input Data Cubeacon</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="<?php echo site_url('beacon/addcubeacon')?>">
            <!-- text input -->
            <div class="form-group">
                <label>Nama Cubeacon</label>
                <input type="text" name="nama_cubeacon" class="form-control" placeholder="Nama Cubeacon" />
            </div>
            <div class="form-group">
                <label>UUID Cubeacon</label>
                <input type="text" name="uuid_cubeacon" class="form-control" placeholder="UUID Cubeacon" />
            </div>
            <div class="form-group">
                <label>Major Cubeacon</label>
                <input type="text" name="major_cubeacon" class="form-control" placeholder="Major Cubeacon" />
            </div>
            <div class="form-group">
                <label>Minor Cubeacon</label>
                <input type="text" name="minor_cubeacon" class="form-control" placeholder="Minor Cubeacon" />
            </div>
            <div class="form-group">
                <label>MAC Address Cubeacon</label>
                <input type="text" name="mac_cubeacon" class="form-control" placeholder="MAC Address Cubeacon" />
            </div>
            <div class="form-group">
                <label>X Position Cubeacon</label>
                <input type="text" name="x_pos_cubeacon" class="form-control" placeholder="Position X Cubeacon" />
            </div>
            <div class="form-group">
                <label>Y Position Cubeacon</label>
                <input type="text" name="y_pos_cubeacon" class="form-control" placeholder="Position Y Cubeacon" />
            </div>
                <input type="hidden" name="id_cubeacon" class="form-control" />
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.boxs -->
<div class="box">
    <div class="box-header">
       <h3 class="box-title">Data Beacon</h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cubeacon</th>
                    <th>UUID Cubeacon</th>
                    <th>Major Cubeacon</th>
                    <th>Minor Cubeacon</th>
                    <th>MAC Address Cubeacon</th>
                    <th>X Position Cubeacon</th>
                    <th>Y Position Cubeacon</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1?>
            <?php 
                if (isset($cubeacon)) {
                    foreach ($cubeacon as $row ) {
            ?>
                <tr>
                    <th><?php echo $no++?></th>
                    <th><?php echo $row->nama_cubeacon;?></th>
                    <th><?php echo $row->uuid_cubeacon;?></th>
                    <th><?php echo $row->major_cubeacon;?></th>
                    <th><?php echo $row->minor_cubeacon;?></th>
                    <th><?php echo $row->mac_address;?></th>
                    <th><?php echo $row->x_position;?></th>
                    <th><?php echo $row->y_position;?></th> 
                </tr>
            <?php 
                    } 
            }?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url();?>asset/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>asset/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
    /*function hapus(id) {
        var r = confirm("Apakah Yakin DiHapus ? ");
        if (r == true) {
            document.location.href = "<?php echo base_url();?>/index.php/input_user/hapus/"+ id;
        }
    }
    function edit(id,nama,status_user) {
        $("input[name=nm_user]").val(nama);
        $("input[name=status_user]").val(status_user);
        $("input[name=id]").val(id);
    }*/
</script>