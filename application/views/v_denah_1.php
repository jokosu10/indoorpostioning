<?php
    if ($this->session->flashdata('message'))  {
        echo $this->session->flashdata('message');
    }
    //var_dump($area);die;
?>
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4"></div>
</div>
<div class="box box-succesful">
    <div class="box-header">
        <h3 class="box-title">Denah Lantai <?php echo $denah["id_denah_ruangan"];?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php echo validation_errors();?>
        <form role="form" method="post" action="<?php echo base_url();?>denah/uploaddenah1" enctype="multipart/form-data">
            <div class="form-group">
            <label >Upload Image Denah Ruangan</label>
               	<input type="file" name="upload_image_denah1" id="upload_image_denah1" accept="image/png, image/jpg, image/jpeg"><br/>
            	<button type="submit" class="btn btn-primary" >Upload</button>
            </div>
            <textarea id="x_y_user" rows="4" cols="100">

            </textarea>
            <div style="position: relative">
                <div id="area-container"></div>
                <div id="user-container"></div>
                <div id="beacon-container"></div>
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
<div class="box">
    <div class="box-header">
       <h3 class="box-title">Info User</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="table_log_user" class="table no-margin">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Nama User</th>
                        <th>Position</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
var marginBottom = 20.8;
var marginLeft = 28.7;
var markerHeight = 10;
var markerWidth = 10;
var boxHeight = 22.2;
var boxWidth = 32;
var selisihX = 13;
var multiLantai = "<?php echo $multi_lantai;?>";

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

function logLastPositionUser(data) {
    tbody = $("table#table_log_user tbody");
    tbody.empty();

    var string = "";
    jQuery.each(data, function(index, val) {
        string += "<tr id='user-"+val.id_user+"'>";
        //string += "<td>"+tbody.find("tr").length + 1 +"</td>";
        string += "<td>"+val.username +"</td>";
        string += "<td>"+parseData(val.nama_area_ruangan)+"</td>";
        string += "<td class='user-time'>"+val.time +"</td>";
        string +="</tr>";


        //user baru
        if(tbody.find("tr#user-"+val.id_user).length < 1){
            tbody.append(string);
        //user ada
        }else{
            var last_time = new Date(tbody.find("td.user-time").text());
            var new_time = new Date(val.time);

            console.log("timmee "+ last_time.getTime() +" "+ new_time.getTime());

            if((last_time.getTime() < new_time.getTime())){
                tbody.find("tr#user-"+val.id_user).empty();
                tbody.find("tr#user-"+val.id_user).append(string);
            }else{
                tbody.append(string);
            }
        }
        string ="";
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
                logLastPositionUser(data.data);

                jQuery.each(data.data, function(index, val) {
                  $("#x_y_user").append("Username = " + val.username + " Posisi X =  "+val.x_user+ " Posisi Y = "+val.y_user + "\n");

                  //jika marker untuk user belum ada, maka tambahkan
                    if($('#user-' + val.username).length == 0){
                        var tmp = "<div style='height: 10px; width: 10px; background: red; position: absolute' id='user-"+val.username + "' data-toggle='tooltip' title='User : "+val.username+"'>";

                        tmp += "<div style='position: absolute; left: 15px; bottom: 15px;'></div></div>";
                        $("#user-container").append(tmp);
                    }

                    $("[data-toggle='tooltip']").tooltip();

/*                  var marginBottom = 18;
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
<?php if (!empty($area)) { ?>
    posAreaToMap(<?php echo json_encode($area);?>);
<?php } ?>
function posAreaToMap(data){
        //alert("aaaaaa");
        if(!data) return;
        console.log(data);

        jQuery.each(data, function(index, val) {
            area_id = "area-"+val.id;
            console.log(val);

            if($('#' + area_id).length < 1){
/*                var marginBottom = 28; // box bawah image px
                var marginLeft = 37; // box kiri image px
                var boxHeight = 22.8; // besar tinggi box px
                var boxWidth = 34; // besar width box px*/

                var minXArea = posMinArea(val.position, "x"); //pos x min area
                var minYArea = posMinArea(val.position, "y"); //pos y min area
                var maxXArea = posMaxArea(val.position, "x"); //pos x max area
                var maxYArea = posMaxArea(val.position, "y"); //pos y min area
                //console.log("Pos area:"+val.name+" min x "+ minXArea +" max x "+maxXArea+ " min y "+ minYArea+" max y"+ maxYArea);

                var css = new Array();
                css['height'] = (boxHeight*(maxYArea- minYArea))+"px";
                css["width"] = (boxWidth* (maxXArea-minXArea))+"px";
                css["border"] = "1px solid "+((val.color) ? val.color : "black");
                css["position"] = "absolute";
                css["background"] = ((val.color) ? val.color : "black");
                css["opacity"] = "0.4";
                css["bottom"] = (marginBottom + (boxHeight*(minYArea))) +"px";
                css["left"] = (marginLeft + (boxWidth*(minXArea))) +"px";

                /// lantai banyak lantai
                /*if(multiLantai){
                    css["left"] = (marginLeft + (boxWidth*(minXArea - selisihX - 1))) +"px";
                }else{
                    css["left"] = (marginLeft + (boxWidth*(minXArea - 1))) +"px";
                }*/

                //console.log("Pos area:"+val.name+" width:"+css["width"]+" height:"+css["height"]+" bottom:"+ css["bottom"]+" left:"+css["left"]);

                str_style = "";
                jQuery.each(Object.keys(css), function(index, val) {
                   str_style += val+":"+css[val]+";";
                });
                //console.log("Pos Area:"+val.name+" "+str_style);

                area_logs = "Area: "+ parseData(val.name);
                area_logs += " [Pos XY1: "+parseData(val.position[0]["x"])+", "+parseData(val.position[0]["y"])+"]";
                area_logs += " [Pos XY2: "+parseData(val.position[1]["x"])+", "+parseData(val.position[1]["y"])+"]";
                area_logs += " [Pos XY3: "+parseData(val.position[2]["x"])+", "+parseData(val.position[2]["y"])+"]";
                area_logs += " [Pos XY4: "+parseData(val.position[3]["x"])+", "+parseData(val.position[3]["y"]) +"]\n";

                var tmp = "<div style='"+str_style+"' id='"+area_id+" ";
                tmp += "title='Area : "+parseData(val.name)+"' data-toggle='popover' data-content='"+area_logs+"'></div>";
                $("#area-container").append(tmp);

                $('[data-toggle="popover"]').popover({
                    "trigger":"click hover focus",
                    "placement":"auto"
                });

                $("textarea[name='log_areas']").append(area_logs);
            }
        });
    }

    function posMaxArea(data, pos) {
        var result = 0;
        if(!data){
            return result;
        }

        for ( i = 0; i < (data.length); i++) {
            if (parseInt(data[i][pos]) > parseInt(result)) {
                result = data[i][pos];
            }
        }
        return parseInt(result);
    }

    function posMinArea(data, pos) {
        var result = 999999;
        if(!data){
            return result;
        }

        for ( i = 0; i < (data.length); i++) {
            if (parseInt(data[i][pos]) < parseInt(result)) {
                result = data[i][pos];
            }
        }
        return parseInt(result);
    }

    function parseData(data){
        if (data === undefined || data === null) {
        //if(typeof data === 'undefined'){
            return;
        }

        return data;
    }

    <?php
    if (!empty($beacon)) { ?>
        posBeaconToMap(<?php echo json_encode($beacon);?>);
    <?php } ?>

    function posBeaconToMap(data){
        if(!data) return;
        console.log(data);

        jQuery.each(data, function(index, val) {
            beacon_id = 'beacon-' + val.id;
            if($('#'+beacon_id).length < 1){
                beacon_info = "Beacon: "+ parseData(val.name)+" UUID: "+parseData(val.uuid)+" Major: "+parseData(val.major)+" Minor: "+parseData(val.minor);
                beacon_info += " [Pos XY: "+parseData(val.x)+", "+parseData(val.y) +"]\n";

                var tmp = "<div id='"+beacon_id + "' style='height: 10px; width: 10px; background: "+val.color+"; position: absolute;border:1px solid black' ";
                tmp += "title='Beacon : "+parseData(val.name)+"' data-toggle='popover' data-content='"+beacon_info+"'>";;
                tmp += "<div style='position: absolute; left: 15px; bottom: 15px;'></div></div>";
                $("#beacon-container").append(tmp);

                $('[data-toggle="popover"]').popover({
                    "trigger":"click hover focus",
                    "placement":"auto"
                });

                //bottom =(marginBottom-(markerHeight/2)+boxHeight*val.y)
                //left = (marginLeft-(markerWidth/2)+boxWidth*val.x)
                //lama
                bottom =  (marginBottom +( (boxHeight*val.y) - (markerHeight/2) ));
                left = (marginLeft + ((boxWidth*val.x) - (markerWidth/2)));
                //bottom =  (marginBottom +( (boxHeight*val.y) - (markerHeight/2) ));
/*
                //lantai banyak keatas
                //if(multiLantai){
                    console.log('multiiiilantaai;');
                    //left = (marginLeft + ((boxWidth* (val.x - selisihX)) - (markerWidth/2)));
                //}else{
                    left = (marginLeft + ((boxWidth*val.x) - (markerWidth/2)));
                //}
                console.log("leffttt " +left);*/

                $("#" + beacon_id).css('bottom',bottom +'px');
                $("#" + beacon_id).css('left', left +'px');

                /*$("textarea[name='log_beacons']").append(beacon_info);*/
            }
        });
    }

setInterval(getLastXandYUser,10000);
</script>
