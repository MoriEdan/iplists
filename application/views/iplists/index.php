<script type="text/javascript">

    $(document).ready(function () {
        $('#table1').dataTable();
        $('#progress-body').hide();

        $('.remove-link').on('click', function (e) {
            e.preventDefault();
            $('#progress-body').show();
            var $progressbar = $("#progressbar");
            $('#progress-bar-status').text('Processing');
            $progressbar.show();
            $(function () {
                $progressbar.css('width', '30%');
            });
            var link_id = $(this).attr('data-link-id');
            var url = "<?php echo site_url(); ?>iplists/remove_link/" + link_id;
            console.log(url);
            $.ajax({
                url: url,
                type: "GET",
                contentType: false,
                processData: false,
                success: function (data) {
                    //$('#progress-body').hide();
                    $progressbar.css('width', '100%');
                    $('#progress-bar-status').text('Complete');
                    setTimeout(function () {
                        $('#progress-body').hide();
                        $progressbar.css('width', '100%');
                    }
                    , 10000);
                    location.reload();
                },
                error: function (data) {
                    alert("Something went wrong !");
                }
            });

        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <h2><span class="fa fa-archive"></span>&nbsp;Manage IP List</h2>

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
                    <div class="input-group input-group-sm">
                        <input type="text" name="ip" class="form-control"/>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit">
                                <span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <hr />
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
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="progress" id="progress-body"  style="height:24px;">                            
                        <div class="progress-bar"  style="line-height:24px;vertical-align: middle;" id="progressbar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            <span id="progress-bar-status">Processing</span>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">IP List Links</div>
                        <div class="panel-body" style="max-height: 20;overflow-y: scroll;">

                            <table class="table table-bordered table-condensed table-striped">
                                <tr><th>Links</th><th>DC</th><th>P</th><th>Action</th></tr>
                                <?php foreach ($list_links as $link): ?>
                                    <tr>
                                        <td style="min-width:10px"><a href="<?php echo $link['link'] ?>" data-toggle="tooltip" title="<?php echo $link['link'] ?>" target="_blank"><?php echo $link['link'] ?></a></td>                        
                                        <td><?php echo $link['isDatacenter']==1 ? 'Yes' : 'No'?></td>
                                        <td><?php echo $link['isProxy']==1 ? 'Yes' : 'No'?></td>
                                        <td><a href="#" data-link-id="<?php echo $link['id'] ?>" class="btn btn-danger btn-xs remove-link">remove</a>                                        
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Stats</div>
                            <div class="panel-body">
                                IP Rules: <?php echo number_format($ip_includes) ?><br />
                                List links: <?php echo count($list_links); ?><br />
                                Scheduled Import: <?php echo count($import_list); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">Scheduled Import</div>
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

        <?php endif; ?>        
    </div>




</div>