<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 16/10/2018
 * Time: 0:56
 */
?>
<script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('' +
                '<tr id="row'+i+'">' +
                '<td><input type="text" placeholder="Nama Anggota" class="form-control" name="SipAngNam[]" value=""></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });


        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

    });
    $(document).ready(function(){
        var j=1;
        $('#add3').click(function(){
            j++;
            $('#dynamic_field3').append('' +
                '<tr id="row'+j+'">' +
                '<td><input type="text" placeholder="Nama Anggota" class="form-control" name="SipAngNam[]" value="">'+
                '<input type="text" placeholder="NIP/NIK Anggota" class="form-control" name="SipAngNam[]" value="">'+
                '<input type="text" placeholder="Pangkat/Golongan/Jabatan Anggota" class="form-control" name="SipAngNam[]" value=""></td>'+
                '<td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });


        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

    });
</script>