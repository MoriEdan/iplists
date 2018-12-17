<h2>Add IP List Link</h2>
<?php $errors = validation_errors(); ?>

<?php if ($errors): ?>
    <div class="alert alert-warning">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>
<form method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>IP List Link</label>
                    <input type="text" name="link" class="form-control" placeholder="Link">                
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Data center</label>
                    <input type="checkbox" name="isDatacenter" value="1" class="form-checkbox" />
                    <label>Proxy</label>
                    <input type="checkbox" name="isProxy" value="1" class="form-checkbox" />
                </div>
            </div>
        </div>
        <div class="row">
            <div clas="col-md-6">
                <div class="form-group">
                    <button class="btn btn-info" type="submit">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>