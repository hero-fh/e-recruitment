<?php
$threshold = date('Y-m-d', strtotime('-1 year')); // Get the date for 1 year ago

// Prepare and execute the query
$stmt = $conn->query("SELECT * FROM `requirements` WHERE date_passed <= '$threshold'");
$idArray = [];
while ($row = $stmt->fetch_assoc()) {
    $idArray[] = $row['id'];
}
?>
<form id="auto" action="">
    <?php foreach ($idArray as $id) : ?>
        <input type="hidden" name="id[]" value="<?php echo $id; ?>">
    <?php
    endforeach; ?>
</form>

<button type="submit" form="auto" id="submit" style="display: none;"></button>
<script>
    $(document).ready(function() {
        var submitButton = document.getElementById('submit');

        function triggerButton() {
            console.log('Open')
            submitButton.click();
        }
        setTimeout(triggerButton, 1000);
        $(function() {
            $('#auto').submit(function(e) {
                e.preventDefault();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=yearly",
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
                    error: err => {
                        console.log(err)
                        end_loader();
                    },
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            end_loader()
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            end_loader()
                        } else {
                            end_loader();
                        }
                    }
                })
            })
        })
    });
</script>