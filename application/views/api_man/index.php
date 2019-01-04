<script type="text/javascript">
    $(document).ready(function () {
        $('#create-api').click(function () {
            $.ajax({
                url: "/api/key/",
                data: {level: 5},
                type: "PUT",
                headers: {"X-API-KEY": "4cccscwckgs00008s8ssoo04wc88k8k0sggk0k0k"},
                dataType: "json",
                success: function () {
                    //update the result set's
                    location.reload();
                }

            });
        });
    });

</script>

<div class="row">
    <div class="col-md-12">
        <h1><span class="fa fa-key"></span>&nbsp;API keys</h1>
        <button class="btn btn-warning" id="create-api">Create API Key</button>
        <br />
        <br />
        <table class="table table-condensed table-striped">
            <?php
            foreach ($keys as $key):
                if ($key['key'] == "4cccscwckgs00008s8ssoo04wc88k8k0sggk0k0k")
                    continue;
                ?>
                <tr><td><?php echo $key['key'] ?></td>
                    <td><a href="<?php echo base_url() . 'api_man/remove/' . $key['id'] ?>" onclick="return confirm('Remove record ?')" class="btn btn-danger btn-xs" role="button">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Remove</a></td>
                </tr>
<?php endforeach; ?>
        </table>

    </div>
</div>
