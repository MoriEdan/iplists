<h2>Add Multiple IP's</h2>

<form method="post" role="form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">                
                <label>IP lists:</label>
                <textarea  name="multiples" class="form-control" placeholder="Type the ip address per line" rows="5"></textarea>
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
            <div class="form-group">
                <button class="btn btn-sm btn-info" type="submit">Add</button>
            </div>
        </div>
    </div>

</form>

