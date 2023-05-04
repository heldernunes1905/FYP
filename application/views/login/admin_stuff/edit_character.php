<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $first = ($this->session->userdata['logged_in']['first_name']);
    $last = ($this->session->userdata['logged_in']['last_name']);
} else {
    header("location: login");
}

$this->load->view('header/top');
?>
<br>
<br>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
<style>
    th,
    td {
        text-align: center
    }
</style>
<input id="myInput" type="text" placeholder="Search..">
<table class="table ">
    <thead>
        <tr>
            <th scope="col">Character Id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Pictures</th>
            <th scope="col">Actions</th>


        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
        foreach ($characters as $char) { ?>
            <tr>
                <th scope="row"><?php echo $char->character_id; ?></th>
                <td><?php echo $char->first_name; ?></td>
                <td><?php echo $char->last_name; ?></td>
                <td><?php echo $char->birthday; ?></td>
                <td><?php echo "<img src='../uploads/$char->pictures' width=50px>" ?></td>

                <td><i class="edit fas fa-user-edit" data-toggle="modal" data-target="#exampleModal"
                 data-character_id="<?php echo $char->character_id; ?>" 
                 data-first_name="<?php echo $char->first_name; ?>"
                 data-last_name="<?php echo $char->last_name; ?>"
                 data-birthday="<?php echo $char->birthday; ?>"
                 data-pictures="<?php echo $char->pictures; ?>"

                
                ></i> <i class="remove fas fa-user-times" data-toggle="modal" data-target="#deleteModal" 
                data-character_id="<?php echo $char->character_id; ?>" 
                data-first_name="<?php echo $char->first_name; ?>"
                data-last_name="<?php echo $char->last_name; ?>"
                data-pictures="<?php echo $char->pictures; ?>"></i></td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_id_top">Character id:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo "<div class='error_msg'>";
                echo validation_errors();
                echo "</div>";

                echo form_open_multipart('mod_character');
                ?>
                
                <div class="form-group">
                    <label for="message-text" class="col-form-label">First Name:</label>
                    
                    <?php echo form_input('first_name', "", 'id="first_name" class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Last Name:</label>
                    <?php echo form_input('last_name', "", 'id="last_name" class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Birthday:</label>
                    <input type="date" name="birthday" />
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Pictures:</label>
                    <img src='../uploads/' id="imgPath" name="image" width=400px>
                   <input type="file" name="characterimage" size="20" />
                </div>
                    <?php echo form_input('character_id', "", 'id="character_id" class="form-control" style="display:none"'); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php
                echo form_submit('submit', 'Edit info', 'class="btn btn-primary" style="background-color:#1584ab"');

                echo form_close();
                ?>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_id_top_delete">Character id:</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h5 class="modal-title" id="user_name_top_delete">User Name:</h5>
                <?php
                echo "<div class='error_msg'>";
                echo validation_errors();
                echo "</div>";

                echo form_open('remove_character');
                ?>
                <?php echo form_input('character_id', "", 'id="userid_delete" class="form-control" style="visibility: hidden"'); ?>
                <img src='../uploads/' id="imgPathDelete" name="image" width=400px>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php
                echo form_submit('submit', 'Delete User', 'class="btn btn-primary" style="background-color:#1584ab"');

                echo form_close();
                ?>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='<?php echo base_url(); ?>others/js/ajax_user.js' type='text/javascript'></script>
<script type='text/javascript'>
    var baseURL = "<?php echo base_url(); ?>";
</script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).on("click", ".edit", function () {
        var my_user_id = $(this).data('character_id');
        var top_user_id =document.getElementById('user_id_top')
        var user_id =document.getElementById('character_id')
        user_id.value = my_user_id
        top_user_id.innerHTML  = "Character Id: " + my_user_id
        document.getElementById("imgPath").src="../uploads/"+$(this).data('pictures')


        $('input[name=first_name]').val($(this).data('first_name'));
        $('input[name=last_name]').val($(this).data('last_name'));
        $('input[name=birthday]').val($(this).data('birthday'));
        $('input[name=pictures]').val($(this).data('pictures'));

    });
//                var_dump($users[1]);

$(document).on("click", ".remove", function () {
        var my_user_id = $(this).data('character_id');
        var top_user_id =document.getElementById('user_id_top_delete')
        var top_user_name =document.getElementById('user_name_top_delete')
        var user_id =document.getElementById('userid_delete')
        document.getElementById("imgPathDelete").src="../uploads/"+$(this).data('pictures')

        //alert('<?php //echo array_search('6', $users)?>')
        user_id.value = my_user_id
        top_user_id.innerHTML  = "Character Id: " + my_user_id
        top_user_name.innerHTML  = "Name: " + $(this).data('first_name') +' '+ $(this).data('last_name')
    });

</script>
<?php
$this->load->view('login/insideheader/bottom');
?>