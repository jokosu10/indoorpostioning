<?php
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>

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
                <input type="hidden" name="mode" class="form-control" value="<?php echo $mode;?>" />
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
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cubeacon</th>
                    <th>UUID Cubeacon</th>
                    <th>Major Cubeacon</th>
                    <th>Minor Cubeacon</th>
                    <th>MAC Address</th>
                    <th>X Position </th>
                    <th>Y Position </th>
                    <th>&nbsp;</th>
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
                    <th>
                        <span class="glyphicon glyphicon-trash" onClick="hapus(<?php echo $row->id_cubeacon?>)"></span>
                        <span class="glyphicon glyphicon-edit" onClick="edit('<?php echo $row->id_cubeacon?>','<?php echo $row->nama_cubeacon?>','<?php echo $row->uuid_cubeacon?>','<?php echo $row->major_cubeacon?>','<?php echo $row->minor_cubeacon?>','<?php echo $row->mac_address?>','<?php echo $row->x_position?>','<?php echo $row->y_position?>')"></span>
                    </th>
                </tr>
            <?php
                    }
            }?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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
    function hapus(id) {
        var message = confirm("Apakah Data Cubeacon Ini Yakin DiHapus ? ");
        if (message == true) {
            document.location.href = "<?php echo base_url();?>beacon/deletecubeacon/"+ id;
        }
    }
    function edit(id,nama_cubeacon,uuid_cubeacon,major_cubeacon,minor_cubeacon,mac_address,x_position,y_position) {
        var message = confirm("Apakah Data Cubeacon Ini Yakin Di Edit ? ");
        if (message == true) {
            $("input[name=nama_cubeacon]").val(nama_cubeacon);
            $("input[name=uuid_cubeacon]").val(uuid_cubeacon);
            $("input[name=major_cubeacon]").val(major_cubeacon);
            $("input[name=minor_cubeacon]").val(minor_cubeacon);
            $("input[name=mac_cubeacon]").val(mac_address);
            $("input[name=x_pos_cubeacon]").val(x_position);
            $("input[name=y_pos_cubeacon]").val(y_position);
            $("input[name=id_cubeacon]").val(id);
            $("input[name=mode][type='hidden']").val('edit');
            //document.location.href = "<?php echo base_url();?>beacon/addcubeacon/"+val(id);
        }
    }
</script>
