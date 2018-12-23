<script type="text/javascript">
    $(document).ready(function () {
        $('#create-api').click(function () {
            $.ajax({
                url: "/api/key/",
                data:
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
        <h1>API keys</h1>
        <button class="btn btn-warning" id="create-api">Create API Key</button>

        <table class="table table-condensed table-striped">
            <?php foreach($keys as $key):?>
            <tr><td><?php echo $key['key']?></td></tr>
            <?php endforeach; ?>

        </table>

    </div>
</div>
