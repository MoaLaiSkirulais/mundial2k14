<?php
$mime = "text/html";
$charset = "iso-8859-1";
header ("Content-Type:text/xml");  
header("Vary: Accept");
?><?xml version="1.0" encoding="utf-8" standalone="yes"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/"
xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
  <item>
	   <title>Picture A</title>
	   <media:description> This one's my favorite.</media:description>
	   <link>pl_images/A.jpg</link>
	   <media:thumbnail url="http://localhost/sites/mundial2k10/users/data/Coso.jpg"/>
	   <media:content url="http://localhost/sites/mundial2k10/users/data/Coso.jpg"/>
  </item>
  <item>
	  <title>Video B</title>
	  <link>http://example.com/pl_images/B.jpg</link>
	  <media:thumbnail url="http://example.com/pl_thumbs/B.jpg"/>
	  <media:content type="video/x-flv"
	  url="http://example.com/pl_images/B.flv"/>
  </item>
</channel>
</rss>
