<div class="content-wrapper">
    <h4> <b>Master</b> <small class="text-muted">/ mapel</small>
    </h4>
    <hr>
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                <p class="card-description">
                <a data-toggle="modal" data-target="#add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Add mapel</a> <br>
                </p>
                <h4 class="card-title">Data mapel</h4>
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-hover" id="data">
                        <thead class="bg-dark text-white">
                        <tr>
                        <th>No.</th> 
                        <th>Nama mapel</th>  
                        <th>Opsi</th>                     
                        </tr>                        
                        </thead>  
                        <tbody>
                        <?php 
                        $no=1;
                        $sql = mysqli_query($con,"SELECT * FROM tb_master_mapel ORDER BY id_mapel ASC");
                        foreach ($sql as $d) { ?>
                        <tr>
                            <td width="50"><b><?=$no++; ?>.</b> </td>
                            <td><?=$d['mapel']?> </td>
                            <td width="150">
                            <a data-toggle="modal" data-target="#edit<?=$d['id_mapel']?>" class="btn btn-dark btn-xs text-warning"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="?page=mapel&act=del&id=<?=$d['id_mapel']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Del</a>

                            <!-- modal edit -->
                            <div class="modal fade" id="edit<?=$d['id_mapel']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header"><h4 class="modal-title"> Edit mapel </h4></div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="mapel"> Nama mapel</label>
                                            <input type="hidden" name="id" value="<?=$d['id_mapel']?>"> 
                                            <input type="text" id="mapel" name="mapel" class="form-control" value="<?=$d['mapel']?>">
                                        </div>
                                        <?php
                                            $mapel_id = (int)$d['id_mapel'];
                                            $mapel = mysqli_query($con,"SELECT * from schedules where id_mapel=$mapel_id ");
                                            $data = mysqli_fetch_array($mapel);
                                        ?>
                                        <div class="form-group">
                                            <input type="hidden" name="schedule_id" value="<?=$data['id']?>"> 
                                            <label for="day"> Hari</label>
                                            <select id="day" name="day" class="form-control">
                                                <?php
                                                    if($data['day'] == 1)
                                                        echo '<option selected value="1">Senin</option>';
                                                    else
                                                        echo '<option value="1">Senin</option>';

                                                    if($data['day'] == 2)
                                                        echo '<option selected value="2">Selasa</option>';
                                                    else
                                                        echo '<option value="2">Selasa</option>';

                                                    if($data['day'] == 3)
                                                        echo '<option selected value="3">Rabu</option>';
                                                    else
                                                        echo '<option value="3">Rabu</option>';

                                                    if($data['day'] == 4)
                                                        echo '<option selected value="4">Kamis</option>';
                                                    else
                                                        echo '<option value="4">Kamis</option>';

                                                    if($data['day'] == 5)
                                                        echo '<option selected value="5">Jumat</option>';
                                                    else
                                                        echo '<option value="5">Jumat</option>';

                                                    if($data['day'] == 6)
                                                        echo '<option selected value="6">Sabtu</option>';
                                                    else
                                                        echo '<option value="6">Sabtu</option>';
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_time"> Jam Masuk</label>
                                            <input type="time" id="start_time" name="start_time" class="form-control" value="<?=$data['start_time']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="end_time"> Jam Keluar</label>
                                            <input type="time" id="end_time" name="end_time" class="form-control" value="<?=$data['end_time']?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button name="edit" type="submit" class="btn btn-info"> Edit</button>
                                    </div>
                                    </form>
                                    <?php 
                                    if (isset($_POST['edit'])) {
                                        $qry = mysqli_query($con,"UPDATE tb_master_mapel SET mapel= '$_POST[mapel]' WHERE id_mapel='$_POST[id]' ");
                                        if ($sql) {
                                            if ($_POST['schedule_id'] == "") {
                                                $schedule = mysqli_query($con,"INSERT INTO schedules VALUES(NULL,'$_POST[id]','$_POST[day]','$_POST[start_time]','$_POST[end_time]') ");
                                            }else{
                                                $schedule = mysqli_query($con,"UPDATE schedules SET day= '$_POST[day]', start_time= '$_POST[start_time]', end_time= '$_POST[end_time]' WHERE id='$_POST[schedule_id]' ");
                                            }
                                            echo "
                                            <script type='text/javascript'>
                                            setTimeout(function () {
                                            swal({
                                            title: 'SUKSES',
                                            text:  'Data Telah diubah !!',
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: true
                                            });     
                                            },10);  
                                            window.setTimeout(function(){ 
                                            window.location.replace('?page=mapel');
                                            } ,3000);   
                                            </script>";                       
                                        }                   
                                    }              
                                    
                                    ?>
                                
                                </div>         
                        </div>
                    </div>


                            </td>                        
                        </tr>  
                        <?php } ?>                      
                        </tbody>                      
                        </table>                    
                    </div>
                </div>
            </div>                  
        </div>
    </div>
</div>
<!-- Modal Detail-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title"> Tambah mapel </h4></div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mapel"> Nama mapel</label>
                        <input type="text" id="mapel" name="mapel" class="form-control" placeholder="Nama mapel ..">
                    </div>
                    <div class="form-group">
                        <label for="day"> Hari</label>
                        <select id="day" name="day" class="form-control">
                            <option selected value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time"> Jam Masuk</label>
                        <input type="time" id="start_time" name="start_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_time"> Jam Keluar</label>
                        <input type="time" id="end_time" name="end_time" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button name="save" type="submit" class="btn btn-info"> Simpan</button>
                </div>
                </form>
                <?php 
                if (isset($_POST['save'])) {
                    $qry = mysqli_query($con,"INSERT INTO tb_master_mapel VALUES(NULL,'$_POST[mapel]') ");
                    $mapel = mysqli_query($con,"SELECT MAX(id_mapel) from tb_master_mapel ");
                    $mapel_id = mysqli_fetch_array($mapel);
                    $schedules = mysqli_query($con,"INSERT INTO schedules VALUES(NULL,'$mapel_id[0]','$_POST[day]','$_POST[start_time]','$_POST[end_time]') ");
                    if ($sql) {
                        echo "
                        <script type='text/javascript'>
                        setTimeout(function () {
                        swal({
                        title: 'SUKSES',
                        text:  'Data Tersimpan !!',
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: true
                        });     
                        },10);  
                        window.setTimeout(function(){ 
                        window.location.replace('?page=mapel');
                        } ,3000);   
                        </script>";                        
                    }                   
                }              
                
                ?>
               
            </div>         
    </div>
</div>