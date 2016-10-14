<?php
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>
<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Data Area Ruangan</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="<?php echo site_url('area/addarea')?>">
            <div class="form-group">
                <label>Nama Area Ruangan</label>
                <input type="text" name="name_area" class="form-control" placeholder="Nama Area Ruangan" />
            </div>
            <div class="form-group">
                <label>X1 Area</label>
                <input type="text" name="x1_area" class="form-control" placeholder="X1 Area" />
            </div>
            <div class="form-group">
                <label>Y1 Area</label>
                <input type="text" name="y1_area" class="form-control" placeholder="Y1 Area" />
            </div>
            <div class="form-group">
                <label>X2 Area</label>
                <input type="text" name="x2_area" class="form-control" placeholder="X2 Area" />
            </div>
            <div class="form-group">
                <label>Y2 Area</label>
                <input type="text" name="y2_area" class="form-control" placeholder="Y2 Area" />
            </div>
            <div class="form-group">
                <label>X3 Area</label>
                <input type="text" name="x3_area" class="form-control" placeholder="X3 Area" />
            </div>
            <div class="form-group">
                <label>Y3 Area</label>
                <input type="text" name="y3_area" class="form-control" placeholder="Y3 Area" />
            </div>
            <div class="form-group">
                <label>X4 Area</label>
                <input type="text" name="x4_area" class="form-control" placeholder="X4 Area" />
            </div>
            <div class="form-group">
                <label>Y4 Area</label>
                <input type="text" name="y4_area" class="form-control" placeholder="Y4 Area" />
            </div>

                <input type="hidden" name="id_area_ruangan" class="form-control" />
                <input type="hidden" name="mode" class="form-control" value="<?php echo $mode;?>" />
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.boxs -->
<div class="box">
    <div class="box-header">
       <h3 class="box-title">Data Area Ruangan</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Area</th>
                    <th>X1</th>
                    <th>Y1</th>
                    <th>X2</th>
                    <th>Y2</th>
                    <th>X3</th>
                    <th>Y3</th>
                    <th>X4</th>
                    <th>Y4</th>
                    <th>Nama Ruangan</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1?>
            <?php
                if (isset($area)) {
                    foreach ($area as $row ) {
            ?>
                <tr>
                    <th><?php echo $no++?></th>
                    <th><?php echo $row->nama_area_ruangan;?></th>
                    <th><?php echo $row->x1;?></th>
                    <th><?php echo $row->y1;?></th>
                    <th><?php echo $row->x2;?></th>
                    <th><?php echo $row->y2;?></th>
                    <th><?php echo $row->x3;?></th>
                    <th><?php echo $row->y3;?></th>
                    <th><?php echo $row->x4;?></th>
                    <th><?php echo $row->y4;?></th>
                    <th><?php echo $row->id_denah_ruangan;?></th>
                    <th>
                        <span class="glyphicon glyphicon-trash" onClick="hapus(<?php echo $row->id_area_ruangan?>)"></span>
                        <span class="glyphicon glyphicon-edit" onClick="edit('<?php echo $row->id_area_ruangan?>','<?php echo $row->nama_area_ruangan?>','<?php echo $row->x1?>','<?php echo $row->y1?>','<?php echo $row->x2?>','<?php echo $row->y2?>','<?php echo $row->x3?>','<?php echo $row->y3?>','<?php echo $row->x4?>','<?php echo $row->y4?>')"></span>
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
        var message = confirm("Apakah Data Area Ruangan Ini Yakin DiHapus ? ");
        if (message == true) {
            document.location.href = "<?php echo base_url();?>area/deletearea/"+ id;
        }
    }
    function edit(id,name_area,x1_area,y1_area,x2_area,y2_area,x3_area,y3_area,x4_area,y4_area) {
        var message = confirm("Apakah Data Area Ruangan Ini Yakin Di Edit ? ");
        if (message == true) {
            $("input[name=name_area]").val(name_area);
            $("input[name=x1_area]").val(x1_area);
            $("input[name=y1_area]").val(y1_area);
            $("input[name=x2_area]").val(x2_area);
            $("input[name=y2_area]").val(y2_area);
            $("input[name=x3_area]").val(x3_area);
            $("input[name=y3_area]").val(y3_area);
            $("input[name=x4_area]").val(x4_area);
            $("input[name=y4_area]").val(y4_area);
            $("input[name=id_area_ruangan]").val(id);
            $("input[name=mode][type='hidden']").val('edit');
            //document.location.href = "<?php echo base_url();?>beacon/addcubeacon/"+val(id);
        }
    }
</script>
