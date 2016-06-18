<?php 
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
?>

<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Profil</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="<?php echo site_url('profil/editprofil')?>">

            <!-- text input -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $profil->username; ?>"/>
            </div>
            <div class="form-group">
                <label>Passowrd</label>
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>
            <div class="form-group">
                <label>Join Date</label>
                <input type="text" name="joindate" class="form-control" placeholder="Join Date" value="<?= $profil->join_date;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Token</label>
                <input type="text" name="token" class="form-control" value="<?= $profil->token;?>" readonly />
            </div>
                <input type="hidden" name="id_user" class="form-control" value="<?= $profil->id_user;?>"/>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" >Edit Profil</button>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.boxs -->