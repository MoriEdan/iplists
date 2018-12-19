<script>

    $(document).ready(function () {
        $('#table1').dataTable();
    });
</script>
<div class="row">
    <div class="col-md-12">
        <h2>Manage IP List</h2>

        <?php if ($this->ion_auth->is_admin()): ?>
            <p>
                <a href="<?php echo base_url(); ?>iplists/add" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add New Single IP</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/add_multiples" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add Multiple IP</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/import_multiples" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Import a CSV File</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/add_link" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add IP List Link</a>
            </p>
        <?php endif; ?>

        <div class="row">
            <form method="post" role="search">  
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="ip" class="form-control"/>
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-md" type="submit">
                                <span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <hr />
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">IP List Links</div>
                    <div class="panel-body" style="max-height: 10;overflow-y: scroll;"></div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Stats</div>
                        <div class="panel-body">
                            IP Rules: <?php echo number_format($ip_includes) ?><br />
                            List links: 

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">Scheduled List Insertions</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-striped">
                            <tr><th>Filename</th></tr>

                            <?php foreach ($import_list as $il): ?>
                                <tr>
                                    <td><?php echo $il['filename'] ?></td>                        
                                </tr>
                            <?php endforeach; ?>
                        </table>


                    </div>
                </div>

            </div>



        </div>
        <?php if (!empty($ip_lists)): ?>    
            <p>Below is a list of the IP's to be blocked</p>
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-table"></i>&nbsp;IP List
                </div>
            </div>
            <div class="panel-body">

                <table class="table table-condensed table-hover table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>IP</th>
                            <th>First IP</th>
                            <th>Last IP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ip_lists as $ip): ?>
                            <tr>
                                <td><?php echo $ip['ip']; ?></td>
                                <td><?php echo $ip['first_ip']; ?></td>
                                <td><?php echo $ip['last_ip']; ?></td>
                                <td> <!--
                                    <a href="<?php echo base_url() . 'iplists/edit/' . $ip['id'] ?>" class="btn btn-info btn-xs" role="button">
                                        <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                                    &nbsp;-->
                                    <a href="<?php echo base_url() . 'iplists/remove/' . $ip['id'] ?>" onclick="return confirm('Remove record ?')" class="btn btn-danger btn-xs" role="button">
                                        <span class="glyphicon glyphicon-trash"></span>&nbsp;Remove</a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        <?php endif; ?>
        <?php if ($this->ion_auth->is_admin()): ?>
            <p>
                <a href="<?php echo base_url(); ?>iplists/add" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add New Single IP</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/add_multiples" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add Multiple IP</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/import_multiples" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Import a CSV File</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo base_url(); ?>iplists/add_link" class="btn btn-xs btn-info"><i class="fa fa-plus"></i>&nbsp;Add IP List Link</a>
            </p>
        <?php endif; ?>
    </div>

</div>