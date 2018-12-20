<h2>Add a single IP</h2>

<form method="post" role="form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">                
                <label>IP</label>
                <input type="text" name="ip" class="form-control" placeholder="IP"/>
            </div>
            <div class="form-group">
                <label>Data center</label>
                <input type="checkbox" name="isDatacenter" value="1" class="form-checkbox" />

                <label>Proxy</label>
                <input type="checkbox" name="isProxy" value="1" class="form-checkbox" />
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <button class="btn btn-sm btn-info" type="submit">Add</button>
        </div>
    </div>
        
</form>