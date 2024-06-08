<section class="wrapper">

    <!-- /row -->
    <div class="row mt">
        <div class="col-lg-12">

            <div class="form-panel" style="display:none">
                <div id="alert-msg" class="alert alert-danger" style="display:none;">
                    <b>Peringatan!</b><br>msg
                </div>
                <h4 class="mb"><i class="fa fa-angle-right"></i> Form Data User</h4>
                <form class="form-horizontal style-form" id="user-form" method="POST"
                    action="<?php echo base_url() . 'data/user/simpan' ?>">

                    <input type="hidden" name="ajax" value="1">

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                        <div class="col-sm-4">
                            <input class="form-control round-form" type="text" id="txt_nik" name="nik"
                                autocomplete="off">
                            <span class="help-block">Masukkan Nomor Induk Karyawan</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
                        <div class="col-sm-4">
                            <input class="form-control round-form" type="text" id="txt_nama_lengkap" name="nama_lengkap"
                                autocomplete="off">
                            <!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                        <div class="col-sm-4">
                            <input class="form-control round-form" type="text" id="txt_username" name="username"
                                autocomplete="off">
                            <span class="help-block">Password secara default, sama dengan User Name</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Divisi</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="id_divisi" name="id_divisi">
                                <?php foreach($rs_divisi->result() as $divisi){ ?>
                                <option value="<?=$divisi->id;?>"><?=$divisi->nama;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group" id="select_level_row">
                        <label class="col-sm-2 col-sm-2 control-label">User Level</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="select_level" name="level">
                                <!--<option value="management">Management</option>-->
                                <option value="manager">Manager</option>
                                <option value="accounting">Accounting</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="tree" style="display:none">
                        <input type="hidden" id="granted_menu" name="granted_menu">
                        <label class="col-sm-2 col-sm-2 control-label">Hak Akses</label>
                        <div class="col-sm-6">
                            <ul>
                                <?php echo build_menu('build_hak_akses')?>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input class="form-control round-form" type="text" id="txt_email" name="email"
                                autocomplete="off">
                            <!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-default " type="button" id="btn-cancel">Batal</button>
                            <button class="btn btn-theme" type="submit">Simpan</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="content-panel">
                <button type="button" style="margin-right: 10px" class="btn btn-info pull-right"
                    id="btn-tambah-user">Tambah Data</button>
                <h4><i class="fa fa-angle-right"></i> Data User</h4>

                <?php if($rs->num_rows() == 0){ ?>
                <div class="alert alert-info">
                    <p style="text-align: center">Belum ada data</p>
                </div>
                <?php }else{ ?>

                <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>User Name</th>
                                <th>Divisi</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th style="width: 70px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                  foreach ($rs->result() as $r) { ?>
                            <tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1">
                                <td data-title="nama"><?php echo $r->nama_lengkap; ?></td>
                                <td data-title="nik"><?php echo $r->nik; ?></td>
                                <td data-title="username"><?php echo $r->username; ?></td>
                                <td><?php echo $r->divisi; ?></td>
                                <td data-title="level"><?php echo $r->level; ?></td>
                                <td data-title="email"><?php echo $r->email; ?></td>

                                <td>
                                    <button class="btn btn-primary btn-xs" onclick="edit(<?php echo $r->id; ?>)"><i
                                            class="fa fa-pencil"></i></button>
                                    <?php
							  $my_id = $this->session->userdata('userid');
						      if($r->id != $my_id){ ?>
                                    <button class="btn btn-danger btn-xs" onclick="del(<?php echo $r->id; ?>)"><i
                                            class="fa fa-trash-o "></i></button>
                                    <? } ?>
                                </td>
                            </tr>
                            <?php
                  } ?>

                        </tbody>
                    </table>
                    <ul class="pagination" id="ajax_paging" style="padding-left: 15px">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
                </section>
                <?php } ?>

            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-lg-12 -->
    </div>
    <!-- /row -->
</section>

<script>
applyPagination();
//$('#tree div').tree({});

function edit(id) {
    $('.alert-msg').hide();
    $('.content-panel').fadeOut(500, function() {

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>data/user/get/' + id,
            async: true,
            success: function(data) {

                $('#user-form').attr('action', '<?php echo base_url() ?>data/user/update/' + id);

                $('#txt_nik').attr('value', data.nik);
                $('#txt_nama_lengkap').attr('value', data.nama_lengkap);
                $('#txt_username').attr('value', data.username);
                $('select[name="id_divisi"]').find('option[value="' + data.id_divisi + '"]').attr(
                    "selected", true);
                <?php $man_id = $this->session->userdata('id_divisi_management');?>

                if (data.id_divisi === '<?php echo $man_id;?>') {
                    $('#select_level_row').hide();
                }

                $('select[name="level"]').find('option[value="' + data.level + '"]').attr(
                    "selected", true);

                $('#txt_email').attr('value', data.email);

                if (data.level === 'custom') {
                    $('#tree').show();
                }

                $('#tree div').tree({});
                granted_menu = data.granted_menu.split(',');

                var i;
                for (i = 0; i < granted_menu.length; i++) {
                    // do something with `substr[i]`
                    //$('#' + granted_menu[i]).attr('checked','checked');
                    //alert(granted_menu[i]);
                    $('#cb_' + granted_menu[i]).prop('checked', true);
                }

                $('.form-panel').show();
            },
            error: function() {

            }

        });
    });

    return false;
}


$('#id_divisi').change(function() {
    <?php $man_id = $this->session->userdata('id_divisi_management');?>
    var id_divisi = $('#id_divisi').val();

    if (id_divisi === '<?php echo $man_id;?>') {
        $('#select_level_row').hide();
        $('#tree').hide();
    } else {
        $('#select_level_row').show();
        //$('#tree').show();
    }
});

$('#select_level').change(function() {
    var select_level = $('#select_level').val();
    //alert(select_level);
    if (select_level === 'custom') {
        $('#tree').show();
    } else {
        $('#tree').hide();
    }

})

function del(id) {
    delete_data(id, '<?=base_url() . 'data/user/delete/';?>');
}

$('#btn-cancel').click(function() {
    $('.form-panel').fadeOut(500, function() {
        $('.content-panel').show();
    });
    return false;
});

$('#btn-tambah-user').click(function() {
    $('.alert-msg').hide();
    $('.content-panel').fadeOut(500, function() {
        $('#tree div').tree({});
        $('.form-panel').show();
    });
    return false;
});

$("#user-form").submit(function() {

    var page_url = $(this).attr("action");

    var selected = [];
    $('input:checkbox:checked').each(function(i, obj) {
        selected.push($(this).attr('kode'));
    });

    $('#granted_menu').val(selected.join(","));
    //alert(selected.join(","));

    $.ajax({
        url: page_url,
        type: 'POST',
        cache: false,
        async: false,
        data: $('#user-form').serialize(),
        success: function(data) {
            var status = data.status;
            var msg = data.msg;

            if (status === 'ERROR') {
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
                $('#alert-msg').show();
                $('#alert-msg').html(msg);

            } else {
                $('.form-panel').fadeOut(500, function() {
                    $('#main-content').html(data);
                    $('.content-panel').show();
                });
            }

        };
        error: function() {
            console.error('errrorrrrr');
        }

    });
    return false;
});
</script>