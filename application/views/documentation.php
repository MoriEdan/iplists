<link href="<?= site_url(); ?>components/bootswatch-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= site_url(); ?>components/bootstrap/docs/assets/css/docs.css" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <h1>Documentation</h1>

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
                <code class="language-bash">
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

        <h2 id="api">API</h2>

        <h2 id="wordpres_plugin">Wordpress Plugin</h2>

    </div>
</div>