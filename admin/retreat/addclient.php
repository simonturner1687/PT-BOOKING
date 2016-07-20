<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin | Scott Jose Fitness</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />


<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){

    ///// TINYMCE EDITOR /////
    jQuery('textarea.tinymce').tinymce({
    // Location of TinyMCE script
    script_url : 'js/plugins/tinymce/tiny_mce.js',

    // General options
    theme : "advanced",
    skin : "themepixels",
    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
    inlinepopups_skin: "themepixels",
    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,blockquote,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,help,code,|,preview,|,forecolor,backcolor,removeformat,|,charmap,|,fullscreen",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Example content CSS (should be your site CSS)
    content_css : "css/plugins/tinymce.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",


    // Replace values for the template plugin
    template_replace_values : {
        username : "Some User",
        staffid : "991234"
    }
    });
        
        
    jQuery('.editornav a').click(function(){
        jQuery('.editornav li.current').removeClass('current');
        jQuery(this).parent().addClass('current');
        if(jQuery(this).hasClass('visual'))
            jQuery('#content').tinymce().show();
        else
            jQuery('#content').tinymce().hide();
        return false;
    });

        jQuery('.editornav a').click(function(){
        jQuery('.editornav li.current').removeClass('current');
        jQuery(this).parent().addClass('current');
        if(jQuery(this).hasClass('visual'))
            jQuery('#short_content').tinymce().show();
        else
            jQuery('#short_content').tinymce().hide();
        return false;
    });
});
</script>
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="withvernav">

<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo">ScottJose<span>Fitness</span></h1>
            <span class="slogan">admin</span>
            
            <br clear="all" />
            
        </div><!--left-->
    </div><!--topheader-->
    
    
    <div class="header">
        <ul class="headermenu">
            <li><a href="manageblog.php"><span class="icon icon-speech" aria-hidden="true"></span>Manage Blog</a></li>
            <li class="current"><a href="manageretreat.php"><span class="icon icon-pencil" aria-hidden="true"></span>Manage Retreats</a></li>
        </ul>
        
    </div><!--header-->
    
    <div class="vernav">
        <ul>
            <li><a href="newretreat.php">Create New Retreat</a></li>
        </ul>
        <ul>
            <li><a href="manageretreat.php" class="editor">All Retreats </a></li>
            <li><a href="draft_retreats.php">Draft Retreats</a></li>
            <li><a href="archived_retreats.php">Archived Retreats </a></li>
            <li><a href="trash_retreats.php">Trash </a></li>
        </ul>
            <li><a href="bookedspaces.php">Training Orders</a></li>
            <li class="current"><a href="openspaces.php">Retreat Bookings </a></li>
        <a class="togglemenu"></a>
    </div><!--leftmenu-->
    
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Manage Retreats</h1>
            <?php 
            include '/model/m_events.php';
            $Posts = new Posts();
            $posts = $Posts->get_blog_posts('', 'draft');?>

            <ul class="hornav blogmenu">
                <li><a href="openspaces.php">Open Spaces (<?php echo count($posts);?>)</a></li>
                <li class="current"><a href="addclient.php">Add Client</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	
        	<div id="basicform" class="subcontent">
                    
					<form class="stdform stdform2" method="post" action="create_client.php" enctype="multipart/form-data" name="form" novalidate>
                    	<p>
                        	<label>Name</label>
                            <span class="field"><input type="text" name="name"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Address</label>
                            <span class="field"><input type="text" name="address"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Address 2</label>
                            <span class="field"><input type="text" name="address2"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Town</label>
                            <span class="field"><input type="text" name="town"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Post Code</label>
                            <span class="field"><input type="text" name="postcode"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Email</label>
                            <span class="field"><input type="text" name="email"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Phone</label>
                            <span class="field"><input type="text" name="phone"  class="longinput" required /></span>
                        </p>
                        <p>
                            <label>Location</label>
                            <span class="field"><input type="text" name="location"  class="longinput" required /></span>
                        </p>
                        
                        <p>
                        	<label>Status</label>
                            <span class="field"><input type="text" name="status"  class="longinput" required/></span>
                        </p>
                        <p>
                            <label>Amount</label>
                            <span class="field"><input type="text" name="amount"  class="longinput" required/></span>
                        </p>
                                             
                        <p class="stdformbutton">
                        	<input type="submit" class="submit radius2" name="submit" id="publish" value="Add Booking" />
                        </p>
                    </form>
					
                    <br />

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>
</html>
