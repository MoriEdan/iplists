<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
<script>
    $(document).ready(function () {
        $('pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <h1><span class="fa fa-book"></span>&nbsp;Documentation</h1>

        <ol>
            <li><a href="#introduction">Introduction</a></li>
            <li><a href="#web_panel">Web Panel</a></li>
            <li><a href="#api">API</a></li>
            <li><a href="#wordpress_plugin">Wordpress Plugin</a></li>
        </ol>
        <h2 id="documentation">Introduction</h2>
        <p>Welcome to IP lists Manager, a web system that lists all possible data center and proxies to block IP addresses to reduce bandwidth and prevent malicious script attacks.
            The system would record an IP or IP range in a MySQL database.  An API is provided that would check a certain IP if listed as a data center or a proxy.  Also a wordpress plugin that can be used to communicate with the API that can be used on multiple wordpress sites.                        
        </p>
        <h4>System Requirements</h4>
        <ul>
            <li>Linux Server</li>
            <li>Apache 2.4</li>
            <li>PHP 7.0</li>
            <li>MySQL 5.6</li>
            <li>Git</li>
            <li>Composer</li>
            <li>Yarn</li>
        </ul>   

        <h4>Installation Instructions</h4>
        <ul>
            <li>Clone the repository at <a href="https://github.com/slick2/iplists" target="_blank">https://github.com/slick2/iplists</a>
                <br />
                <code class="bash">
                    git clone https://github.com/slick2/iplists.git
                </code>
            </li>
            <li>Run composer install<br />
                <code class="language-bash" >
                    composer install
                </code>
            </li>
            <li>Create a database<br />
                <code class="language-bash">
                    mysql -u username -p -e "create database database"
                </code>                                                            
            </li>
            <li>Edit the file or use sed (line editor)
                <br />
                <code class="language-bash">
                    sed s/dbusername/username/ <./application/config/database.sample.php>./application/config/database.php                             
                </code>
                <br />
                <code class="language-bash">                         
                    sed -i s/dbpassword/pass/ ./application/config/database.php
                </code>
                <br />
                <code class="language-bash">
                    sed -i s/dbname/database/ ./application/config/database.php                  
                </code>
            </li>
            <li>Run the migration<br />
                <code class="language-bash">
                    php public_html/index.php cli/MigrateCli
                </code>
        </ul>

        <h2 id="web_panel">Web Panel</h2>
        <h4>Login</h4>
        <p>To access IP List features, a user name and password is required.  The default password for new installation is </p>
        <p>
            <code>username: admin@webtuners.pro</code>
            <code>password: password</code>
        </p>        
        <h4>Dashboard</h4>
        <p>On the dashboard would show some basic information about the system, the pending import, the list of links of IP set list and removal of data based on the IP set lists</p>        
        <h4>Add a Single IP rule</h4>
        <p>This feature allow the user to enter a single IP set rule, this is advisable for instant entering of a set rule.  The data would not be added if it's included in a set list or a range of IP set lists. </p>
        <h4>Add Multiple IP rule</h4>
        <p>This feature allow the user to enter a mulitple IP set rule, this is advisable for a set list less than 100, new IP rules should be separated by new line.  The data would not be added if it's included in a set list or a range of IP set lists. </p>                
        <h4>Import an IP rule</h4>
        <p>This feature allow the user to upload a csv, netlist, text file which contains a large IP set rule, new IP rules should be separated by new line.  The data would not be added if it's included in a set list or a range of IP set lists. </p>                
        <h4>Add a Link IP Set List</h4>
        <p>This feature allow the user to link a csv, netlist, text file which contains a large IP set rule . The site <a href="https://firehol.org">https://fireholorg</a> has a repo in github that maintains IP set rule.  Their data on github can be added provided that raw link is added.</p>
        <p>The data would not be added if it's included in a set list or a range of IP set lists. </p>                

        <h2 id="api">API</h2>
        <p>The data on IP Lists provided an API which can query an IP if it's listed as data center or a proxy.</p>
        <p>End point url <a href="https://check.youmake.net/api/">https://check.youmake.net/api/</a><p>
        <h4>Methods</h4>
        <p>Check an IP 
            <code><a href="https://check.youmake.net/api/check">https://check.youmake.net/api/check</a></code>                       
        <p>Make a post value using jQuery</p>

        <pre>
<code class="javascript" >            
$.ajax({
    url: "https://check.youmake.net/api/check",
    data: {ip:"123.255.255.255"},
    type: "GET",
    headers: {"X-API-KEY": "API_KEY_HERE"},
    dataType: "json",
    success: function (data) {
    console.log(data);
    ....
    }
});            
</code>
        </pre>
        <p>Wordpress Function using wp_remote_get()</p>
        <pre>
<code class="php">
wp_remote_get( 'https://check.youmake.net/api/ip/check/?ip=127.0.0.1',  array( 'timeout' => 30, 'headers' => array( 'X-API-KEY' => 'API_KEY_HERE')) );    
</code>
        </pre>
        <p>Accessing the API using php CURL</p>
        <pre>
<code class="php">
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://check.youmake.net/api/ip/check/');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY' => 'API_KEY_HERE'));
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
</code>
        </pre>
        <h2 id="wordpres_plugin">Wordpress Plugin</h2>
    </div>
</div>


