<h2>Add a single IP</h2>

<form method="post" role="form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">                
                <label>IP</label>
                <input type="text" name="ip" value="<?=$ip_lists['ip'];?>" class="form-control" placeholder="IP"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <button class="btn btn-info" type="submit">Update</button>
        </div>
    </div>
        
</form>