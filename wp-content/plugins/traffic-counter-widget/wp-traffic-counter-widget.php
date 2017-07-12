<?php
/*
Plugin Name: Traffic Counter Widget
Plugin URI: http://www.pixme.org/wp-content/uploads/widget-traffic-counter/
Description: Counts the number of visitors of your blog and shows the traffic information on a widget
Author: Bogdan Nicolaescu
Version: 2.1.2
Author URI: http://www.pixme.org/
*/

function traffic_counter_control() {

  $options = get_wtc_options();

  if ($_POST['wp_wtc_Submit']){

    $options['wp_wtc_WidgetTitle'] = htmlspecialchars($_POST['wp_wtc_WidgetTitle']);
    $options['wp_wtc_WidgetText_Visitors'] = htmlspecialchars($_POST['wp_wtc_WidgetText_Visitors']);
    $options['wp_wtc_WidgetText_LastDay'] = htmlspecialchars($_POST['wp_wtc_WidgetText_LastDay']);
    $options['wp_wtc_WidgetText_LastWeek'] = htmlspecialchars($_POST['wp_wtc_WidgetText_LastWeek']);
    $options['wp_wtc_WidgetText_LastMonth'] = htmlspecialchars($_POST['wp_wtc_WidgetText_LastMonth']);
    $options['wp_wtc_WidgetText_Online'] = htmlspecialchars($_POST['wp_wtc_WidgetText_Online']);
    $options['wp_wtc_WidgetText_log_opt'] = htmlspecialchars($_POST['wp_wtc_WidgetText_log_opt']);
    $options['wp_wtc_WidgetText_bots_filter'] = htmlspecialchars($_POST['wp_wtc_WidgetText_bots_filter']);
    $options['wp_wtc_WidgetText_Hits'] = htmlspecialchars($_POST['wp_wtc_WidgetText_Hits']);
    $options['wp_wtc_WidgetText_Unique'] = htmlspecialchars($_POST['wp_wtc_WidgetText_Unique']);
    $options['wp_wtc_WidgetText_Default_Tab'] = htmlspecialchars($_POST['wp_wtc_WidgetText_Default_Tab']);
    $options['wp_wtc_WidgetText_wlink'] = htmlspecialchars($_POST['wp_wtc_WidgetText_wlink']);

    update_option("widget_traffic_counter", $options);
  }

?>
  <p>
    <label for="wp_wtc_WidgetText_wlink">Support TCW plugin by showing a small link under the stats. Please keep this checked unless you made a donation: </label>
    <input type="checkbox" id="wp_wtc_WidgetText_wlink" name="wp_wtc_WidgetText_wlink" <?php echo ($options['wp_wtc_WidgetText_wlink'] == "on" ? "checked" : "" ); ?> />
  </p>
  <p><strong>Use options below to translate english labels</strong></p>
  <p>
    <label for="wp_wtc_WidgetTitle">Text Title: </label>
    <input type="text" id="wp_wtc_WidgetTitle" name="wp_wtc_WidgetTitle" value="<?php echo ($options['wp_wtc_WidgetTitle'] =="" ? "Blog Traffic" : $options['wp_wtc_WidgetTitle']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_Visitors">Text Page Views : </label>
    <input type="text" id="wp_wtc_WidgetText_Visitors" name="wp_wtc_WidgetText_Visitors" value="<?php echo ($options['wp_wtc_WidgetText_Visitors'] =="" ? "Pages" : $options['wp_wtc_WidgetText_Visitors']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_Hits">Text Hits: </label>
    <input type="text" id="wp_wtc_WidgetText_Hits" name="wp_wtc_WidgetText_Hits" value="<?php echo ($options['wp_wtc_WidgetText_Hits'] =="" ? "Hits" : $options['wp_wtc_WidgetText_Hits']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_Unique">Text Unique: </label>
    <input type="text" id="wp_wtc_WidgetText_Unique" name="wp_wtc_WidgetText_Unique" value="<?php echo ($options['wp_wtc_WidgetText_Unique'] =="" ? "Unique" : $options['wp_wtc_WidgetText_Unique']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_LastDay">Text Last 24 Hours: </label>:
    <input type="text" id="wp_wtc_WidgetText_LastDay" name="wp_wtc_WidgetText_LastDay" value="<?php echo ($options['wp_wtc_WidgetText_LastDay'] =="" ? "Last 24 hours" : $options['wp_wtc_WidgetText_LastDay']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_LastWeek">Text Last 7 Days: </label>:
    <input type="text" id="wp_wtc_WidgetText_LastWeek" name="wp_wtc_WidgetText_LastWeek" value="<?php echo ($options['wp_wtc_WidgetText_LastWeek'] =="" ? "Last 7 days" : $options['wp_wtc_WidgetText_LastWeek']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_LastMonth">Text Last 30 Days: </label>:
    <input type="text" id="wp_wtc_WidgetText_LastMonth" name="wp_wtc_WidgetText_LastMonth" value="<?php echo ($options['wp_wtc_WidgetText_LastMonth'] =="" ? "Last 30 days" : $options['wp_wtc_WidgetText_LastMonth']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_Online">Text Online Now: </label>:
    <input type="text" id="wp_wtc_WidgetText_Online" name="wp_wtc_WidgetText_Online" value="<?php echo ($options['wp_wtc_WidgetText_Online'] =="" ? "Online now" : $options['wp_wtc_WidgetText_Online']); ?>" />
  </p>
  <p>
    <label for="wp_wtc_WidgetText_Default_Tab">Default Tab</label>:
    <select id="wp_wtc_WidgetText_Default_Tab" name="wp_wtc_WidgetText_Default_Tab">
      <option value="1" <?php echo ($options['wp_wtc_WidgetText_Default_Tab'] == "1" ? "selected" : "" ); ?> >Page Views</option>
      <option value="2" <?php echo ($options['wp_wtc_WidgetText_Default_Tab'] == "2" ? "selected" : "" ); ?> >Hits</option>
      <option value="3" <?php echo ($options['wp_wtc_WidgetText_Default_Tab'] == "3" ? "selected" : "" ); ?> >Unique Visitors</option>
    </select>
  </p>
  <p>
    <label for="wp_wtc_WidgetText_bots_filter">Automatic Traffic</label>:
    <select id="wp_wtc_WidgetText_bots_filter" name="wp_wtc_WidgetText_bots_filter">
      <option value="1" <?php echo ($options['wp_wtc_WidgetText_bots_filter'] == "1" ? "selected" : "" ); ?> >Log and show</option>
      <option value="2" <?php echo ($options['wp_wtc_WidgetText_bots_filter'] == "2" ? "selected" : "" ); ?> >Log do not show</option>
      <option value="3" <?php echo ($options['wp_wtc_WidgetText_bots_filter'] == "3" ? "selected" : "" ); ?> >Do not log</option>
    </select>
  </p>
  <p>
    <label for="wp_wtc_WidgetText_log_opt">Automatically delete old logs:*</label>
    <input type="checkbox" id="wp_wtc_WidgetText_log_opt" name="wp_wtc_WidgetText_log_opt" <?php echo ($options['wp_wtc_WidgetText_log_opt'] == "on" ? "checked" : "" ); ?> />
  </p>
<p>*Caution! By unchecking this you will have to manually delete old logs from time to time! Checking this would only keep logs for the past 1-2 months</p>
  <p>
    <input type="hidden" id="wp_wtc_Submit" name="wp_wtc_Submit" value="1" />
  </p>

<?php
}

function get_wtc_options() {

  $options = get_option("widget_traffic_counter");
  if (!is_array( $options )) {
    $options = array(
                     'wp_wtc_WidgetTitle' => 'Blog Traffic',
                     'wp_wtc_WidgetText_Visitors' => 'Pages',
                     'wp_wtc_WidgetText_Hits' => 'Hits',
                     'wp_wtc_WidgetText_Unique' => 'Unique',
                     'wp_wtc_WidgetText_LastDay' => 'Last 24 hours',
                     'wp_wtc_WidgetText_LastWeek' => 'Last 7 days',
                     'wp_wtc_WidgetText_LastMonth' => 'Last 30 days',
                     'wp_wtc_WidgetText_Online' => 'Online now',
                     'wp_wtc_WidgetText_log_opt' => 'on',
                     'wp_wtc_WidgetText_Default_Tab' => '1',
                     'wp_wtc_WidgetText_bots_filter' => '1',
                     'wp_wtc_WidgetText_wlink' => ''
                    );
  }
  return $options;
}

function get_traffic ($sex, $unique, $hit=false) {

  global $wpdb;
  $table_name = $wpdb->prefix . "wtc_log";
  $options = get_wtc_options();
  $sql = '';
  $stime = time()-$sex;
  $sql = "SELECT COUNT(".($unique ? "DISTINCT IP" : "*").") FROM $table_name where Time > ".$stime;

  if ($hit)
   $sql .= ' AND IS_HIT = 1 ';

  if ($options['wp_wtc_WidgetText_bots_filter'] > 1)
      $sql .= ' AND IS_BOT <> 1';

  return number_format_i18n($wpdb->get_var($sql));
}



function view() {

  global $wpdb;
  $options = get_wtc_options();
  $table_name = $wpdb->prefix . "wtc_log";

  if ($options['wp_wtc_WidgetText_log_opt'] == 'on' && date('j') == 1 && date('G') == 23)
     $wpdb->query('DELETE FROM '.$table_name.' WHERE Time < '.(time()-2592000));

  if (wtc_is_bot() && ($options ['wp_wtc_WidgetText_bots_filter'] == 3 ))
     return;

  if ($_SERVER['HTTP_X_FORWARD_FOR'])
       $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
  else
       $ip = $_SERVER['REMOTE_ADDR'];

  $user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where ".time()." - Time <= 3 and IP = '".$ip."'");

  if (!$user_count) {
    $data = array (
                 'IP' => $ip,
                 'Time' => time(),
                 'IS_BOT'=> wtc_is_bot(),
                 'IS_HIT'=> is_hit($ip)
                );
    $format  = array ('%s','%d', '%b','%b');
    $wpdb->insert( $table_name, $data, $format );
  }
?>

<strong> <p id="wtc_stats_title"><?php
$ttl = $options['wp_wtc_WidgetText_Visitors'];
if ($options['wp_wtc_WidgetText_Default_Tab'] == 2)
  $ttl =$options['wp_wtc_WidgetText_Hits'];
else if ($options['wp_wtc_WidgetText_Default_Tab'] == 3)
         $ttl = $options['wp_wtc_WidgetText_Unique'];
echo $ttl;?></p></strong>

<p id="wtcmenu"><a href="javascript:wtc_show('pages','<?php echo plugins_url('TCW-loading.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self"><?php echo ($options['wp_wtc_WidgetText_Visitors'] == '' ? 'Pages' : $options['wp_wtc_WidgetText_Visitors']); ?></a>|<a href="javascript:wtc_show('hits','<?php echo plugins_url('TCW-loading.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self" ><?php echo ($options['wp_wtc_WidgetText_Hits'] == '' ? 'Hits' : $options['wp_wtc_WidgetText_Hits']); ?> </a>|<a href="javascript:wtc_show('unique','<?php echo plugins_url('TCW-loading.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self" ><?php echo ($options['wp_wtc_WidgetText_Unique'] == '' ? 'Unique' : $options['wp_wtc_WidgetText_Unique']); ?></a></p>

  <?php $wtcuni = ($options['wp_wtc_WidgetText_Default_Tab'] == 3); ?>

  <ul>
  <li><?php echo $options["wp_wtc_WidgetText_LastDay"].": <span id='wtc_lds'>".get_traffic(86400,$wtcuni); ?></span></li>
  <li><?php echo $options["wp_wtc_WidgetText_LastWeek"].": <span id='wtc_lws'>".get_traffic(604800,$wtcuni); ?></span></li>
  <li><?php echo $options["wp_wtc_WidgetText_LastMonth"].": <span id='wtc_lms'>".get_traffic(2592000,$wtcuni); ?></span></li>
  <li><?php echo $options["wp_wtc_WidgetText_Online"].": ".get_traffic(600, true); ?></li>
  </ul>
<?php if ($options['wp_wtc_WidgetText_wlink'] == "on") { ?>
<small><a href="http://www.pixme.org/tehnologie-internet/wordpress-traffic-counter-widget/4228" target="_blank">Traffic Counter</a></small>
<?php } ?>

<?php
}

function widget_traffic_counter($args) {
  extract($args);

  $options = get_wtc_options();

  echo $before_widget;
  echo $before_title.$options["wp_wtc_WidgetTitle"];
  echo $after_title;
  view();
  echo $after_widget;
}

function wtc_is_bot(){

        if (isset($_SESSION['wtcrobot']))
           return true;

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$bots = array( 'Google Bot' => 'googlebot', 'Google Bot' => 'google', 'MSN' => 'msnbot', 'Alex' => 'ia_archiver', 'Lycos' => 'lycos', 'Ask Jeeves' => 'jeeves', 'Altavista' => 'scooter', 'AllTheWeb' => 'fast-webcrawler', 'Inktomi' => 'slurp@inktomi', 'Turnitin.com' => 'turnitinbot', 'Technorati' => 'technorati', 'Yahoo' => 'yahoo', 'Findexa' => 'findexa', 'NextLinks' => 'findlinks', 'Gais' => 'gaisbo', 'WiseNut' => 'zyborg', 'WhoisSource' => 'surveybot', 'Bloglines' => 'bloglines', 'BlogSearch' => 'blogsearch', 'PubSub' => 'pubsub', 'Syndic8' => 'syndic8', 'RadioUserland' => 'userland', 'Gigabot' => 'gigabot', 'Become.com' => 'become.com', 'Baidu' => 'baidu', 'Yandex' => 'yandex', 'Amazon' => 'amazonaws.com', 'crawl' => 'crawl', 'spider' => 'spider', 'slurp' => 'slurp', 'ebot' => 'ebot' );

	foreach ( $bots as $name => $lookfor )
		if ( stristr( $user_agent, $lookfor ) !== false )
			return true;

        return false;
}

function is_hit ($ip) {

   global $wpdb;
   $table_name = $wpdb->prefix . "wtc_log";

   $user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where ".time()." - Time <= 1000 and IP = '".$ip."'");

   return $user_count == 0;
}

function wp_wtc_install_db () {
   global $wpdb;

   $table_name = $wpdb->prefix . "wtc_log";
   $gTable = $wpdb->get_var("show tables like '$table_name'");
   $gColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'IS_BOT'");
   $hColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'IS_HIT'");

   if($gTable != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
           IP VARCHAR( 17 ) NOT NULL ,
           Time INT( 11 ) NOT NULL ,
           IS_BOT BOOLEAN NOT NULL,
           IS_HIT BOOLEAN NOT NULL,
           PRIMARY KEY ( IP , Time )
           );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

   } else {
     if (empty($gColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD IS_BOT BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }

     if (empty($hColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD IS_HIT BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }
   }
}

function traffic_counter_init() {

  wp_wtc_install_db ();
  register_sidebar_widget(__('Traffic Counter'), 'widget_traffic_counter');
  register_widget_control(__('Traffic Counter'), 'traffic_counter_control', 300, 200 );
}

function uninstall_wtc(){

  global $wpdb;
  $table_name = $wpdb->prefix . "wtc_log";
  delete_option("widget_traffic_counter");
  delete_option("wp_wtc_WidgetTitle");
  delete_option("wp_wtc_WidgetText_Visitors");
  delete_option("wp_wtc_WidgetText_LastDay");
  delete_option("wp_wtc_WidgetText_LastWeek");
  delete_option("wp_wtc_WidgetText_LastMonth");
  delete_option("wp_wtc_WidgetText_Online");
  delete_option("wp_wtc_WidgetText_log_opt");
  delete_option("wp_wtc_WidgetText_bots_filter");
  delete_option("wp_wtc_WidgetText_Hits");
  delete_option("wp_wtc_WidgetText_Unique");
  delete_option("wp_wtc_WidgetText_Default_Tab");
  delete_option("wp_wtc_WidgetText_wlink");

  $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function add_wtc_stylesheet() {
            wp_register_style('wtcStyleSheets', plugins_url('wtc-styles.css',__FILE__));
            wp_enqueue_style( 'wtcStyleSheets');
}

function add_wtc_ajax () {
  wp_enqueue_script('wtcScripts', plugins_url('wp-wtc-ajax.js',__FILE__));
}

function wtc_ajax_response () {

 $options = get_wtc_options();
 $stat = $_REQUEST['reqstats'];

 if ($stat == 'pages')
   echo $options['wp_wtc_WidgetText_Visitors'].'~'.get_traffic(86400,false).'~'.get_traffic(604800,false).'~'.get_traffic(2592000,false);
 if ($stat == 'hits')
   echo $options['wp_wtc_WidgetText_Hits'].'~'.get_traffic(86400, false ,true).'~'.get_traffic(604800, false, true). '~' . get_traffic(2592000, false, true);
 if ($stat == 'unique')
   echo $options['wp_wtc_WidgetText_Unique'].'~'.get_traffic(86400, true).'~'.get_traffic(604800,true).'~'.get_traffic(2592000,true);
die();
}

add_action("plugins_loaded", "traffic_counter_init");
add_action('wp_print_styles', 'add_wtc_stylesheet');
add_action('init', 'add_wtc_ajax');

add_action('wp_ajax_wtcstats', 'wtc_ajax_response');
add_action('wp_ajax_nopriv_wtcstats', 'wtc_ajax_response');

register_deactivation_hook( __FILE__, 'uninstall_wtc' );

?>
