<script type="text/javascript">
    $(document).ready(function () {
        $('#create-api').click(function () {
            $.ajax({
                url: "/api/key/",
                type: "PUT",               
                headers: {"X-API-KEY":"admin"},
                dataType: "json",
                success: function () {
                    //update the result set's
                }

            });
        });
    });

</script>

<div class="row">
    <div class="col-md-12">
        <button class="btn btn-warning" id="create-api">Create API Key</button>

    </div>
</div>
