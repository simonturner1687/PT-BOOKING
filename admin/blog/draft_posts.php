<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Manage Blog | Scott Jose </title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
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
            <h1 class="logo">Scott<span>Jose</span></h1>
            <span class="slogan">admin</span>
            
            <br clear="all" />

        </div><!--left-->

    </div><!--topheader-->
    
    
    <div class="header">
        <ul class="headermenu">
            <li class="current"><a href="manageblog.php"><span class="icon icon-speech" aria-hidden="true"></span>Manage Blog</a></li>
            <li><a href="manageretreat.php"><span class="icon icon-pencil" aria-hidden="true"></span>Manage Retreats</a></li>
            <?php 
                session_start();
                if (!empty($_SESSION['message']))
                {
                    echo ' <li><a><span class="icon icon-speech"></span>'.$_SESSION['message'].'</a></li>';
                    unset($_SESSION['message']);
                }
            ?>
    </ul>
    </div><!--header-->
    
    <div class="vernav">
        <ul>
            <li><a href="newpost.php">Create New Post</a></li>
            <li><a href="manageblog.php" class="editor">All Posts</a></li>
            <li><a href="pub_posts.php">Published Posts</a></li>
            <li class="current"><a href="draft_posts.php">Draft Posts</a></li>
            <li><a href="trash_posts.php">Trash</a></li>
        </ul>
        <a class="togglemenu"></a>
    </div><!--leftmenu-->
    
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Manage Blog</h1>
            <?php 
            include '/model/m_events.php';
            $Posts = new Posts();
            $posts = $Posts->get_blog_posts('', 'draft');?>

            <ul class="hornav blogmenu">
                <li class="current"><a href="#">Draft Posts (<?php echo count($posts);?>)</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div class="contentwrapper"> 
<table cellpadding="0" cellspacing="0" border="0" class="stdtable blogtable">
    <colgroup>

        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
    </colgroup>
    <thead>
    <tr>

        <th class="head0">Title</th>
        <th class="head1">Author</th>
        <th class="head0">Categories</th>
        <th class="head1">Status</th>
        <th class="head0"></th>
    </tr>
    </thead>
    
        <?php 
        if (empty($posts)) 
        {
            echo '<tbody>
                  <tr><td>There are currently no posts!</td></tr>';
                  
        } 
        else
        {
        // If we have an array with items
        if (count($posts)) {
            foreach ($posts as $blogArray) {
              // Show the information about the item
                $title = str_replace(" ", "_", $blogArray['title']);
                echo'
    <tbody>
        <tr>

            <td class="con0"><a href="viewblog.html" class="title">'.$blogArray["title"].'</a></td>
            <td class="con1">'.$blogArray["author"].'</td>
            <td class="con0">'.$blogArray["topic"].'</td>
            <td class="con1">'.$blogArray["status"].'</td>
            <td class="actions aligncenter">
                <a href="edit_post.php?id='.$blogArray["id"].'">Edit</a> <a href="../../blog-post.php?title='.$title.'">View</a> <a href="trash.php?id='.$blogArray["id"].'" class="delete">Delete</a>
            </td>
        </tr>';
    }
}
}
?>
    </tbody>
</table>

             
        </div><!--contentwrapper-->
    
    </div><!--centercontent-->
    
    
</div><!--bodywrapper-->

</body>
</html>
