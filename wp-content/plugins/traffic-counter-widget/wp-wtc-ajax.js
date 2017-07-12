var xmlhttp;
if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

function wtc_show (stat, plugin_url, blog_url) {

  document.getElementById("wtc_stats_title").innerHTML = '<img src="'+plugin_url+'" title="Loading Stats" alt="Loading Stats" border="0">';
  xmlhttp.onreadystatechange=wtc_change_stat;
  xmlhttp.open("GET",blog_url+"/wp-admin/admin-ajax.php?action=wtcstats&reqstats="+stat,true);
  xmlhttp.send(); 
}

function wtc_change_stat () {

  if (xmlhttp.readyState==4 && xmlhttp.status==200) {

     var rt = xmlhttp.responseText;
     var wtcdata = rt.split('~');
     document.getElementById("wtc_stats_title").innerHTML = wtcdata[0];
     document.getElementById("wtc_lds").innerHTML = wtcdata[1];
     document.getElementById("wtc_lws").innerHTML = wtcdata[2];
     document.getElementById("wtc_lms").innerHTML = wtcdata[3];

  }
}
