<?php
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>
<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Data Users</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="<?php echo site_url('users/adduser')?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user_name" class="form-control" placeholder="Username" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass_name" class="form-control" placeholder="Password" />
            </div>
            <div class="form-group">
                <label>Confrim Password</label>
                <input type="password" name="re_pass_name" class="form-control" placeholder="Retype Password" />
            </div>
                <input type="hidden" name="id_user" class="form-control" />
                <input type="hidden" name="mode" class="form-control" value="<?php echo $mode;?>" />
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.boxs -->
<div class="box">
    <div class="box-header">
       <h3 class="box-title">Data Users</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Join Date</th>
                    <th>Token</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1 ?>
            <?php
                if (isset($users)) {
                    foreach ($users as $row ) {
            ?>
                <tr>
                    <th><?php echo $no++?></th>
                    <th><?php echo $row->username;?></th>
                    <th><?php echo $row->join_date;?></th>
                    <th><?php echo $row->token;?></th>
                    <th>
                        <span class="glyphicon glyphicon-trash" onClick="hapus(<?php echo $row->id_user?>)"></span>
                        <span class="glyphicon glyphicon-edit" onClick="edit('<?php echo $row->id_user?>','<?php echo $row->username?>','<?php echo $row->password?>','<?php echo $row->join_date?>','<?php echo $row->token?>')"></span>
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
        var message = confirm("Apakah Data User Ini Yakin DiHapus ? ");
        if (message == true) {
            document.location.href = "<?php echo base_url();?>users/deleteuser/"+ id;
        }
    }
    function edit(id,user_name) {
        var message = confirm("Apakah Data User Ini Yakin Di Edit ? ");
        if (message == true) {
            $("input[name=user_name]").val(user_name);
            $("input[name=id_user]").val(id);
            $("input[name=mode][type='hidden']").val('edit');
            //document.location.href = "<?php echo base_url();?>beacon/addcubeacon/"+val(id);
        }
    }
</script>
