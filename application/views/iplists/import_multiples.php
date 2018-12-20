<h2>Import file containing ipsets</h2>

<form method="post" role="form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>File:</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" name="ipsets" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Data center</label>
                <input type="checkbox" name="isDatacenter" value="Y" class="form-checkbox" />

                <label>Proxy</label>
                <input type="checkbox" name="isProxy" value="Y" class="form-checkbox" />
            </div>
        </div>
    </div> 
    <div class="row">            
        <div class="col-md-6">            
            <div class="form-group">
                <button class="btn btn-sm btn-info" type="submit">Add</button>
            </div>
        </div>
    </div>
</div>


</form>

