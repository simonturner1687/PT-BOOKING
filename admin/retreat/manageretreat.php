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
            <li><a href="manageblog.php"><span class="icon icon-speech" aria-hidden="true"></span>Manage Blog</a></li>
            <li class="current"><a href="manageretreat.php"><span class="icon icon-pencil" aria-hidden="true"></span>Manage Retreats</a></li>
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
            <li><a href="newretreat.php">Create New Retreat</a></li>
        </ul>
        <ul>
            <li class="current"><a href="manageretreat.php" class="editor">All Retreats </a></li>
            <li><a href="live_retreats.php">Live Retreats</a></li>
            <li><a href="draft_retreats.php">Draft Retreats</a></li>
            <li><a href="archived_retreats.php">Archived Retreats </a></li>
            <li><a href="trash_retreats.php">Trash </a></li>
        </ul>
        <ul>
            <li><a href="bookedspaces.php">Training Orders</a></li>
            <li><a href="openspaces.php">Retreat Bookings </a></li>
        </ul>
        <a class="togglemenu"></a>
    </div><!--leftmenu-->
    
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">All Retreats</h1>
            <?php 
            include '/model/m_events.php';
            $Posts = new Posts();
            $posts = $Posts->get_retreats('', 'live');

            $open = '';
            $filled = '';

            foreach ($posts as $space) 
            {
                $open += $space['open'];
                $filled += $space['filled'];
            }

            @$percentage = ($filled/($open + $filled))*100

            ?>

            <ul class="hornav blogmenu">
                <li class="current"><a href="#">Retreats (<?php echo count($posts);?>)</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div class="contentwrapper">

        <table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
            <colgroup>

                <col class="con1" width="33%" />
                <col class="con0" width="33%" />
                <col class="con1" width="33%" />
            </colgroup>
            <thead>
                <tr>

                    <th class="head1">Current Open Spaces</th>
                    <th class="head0">Current Filled Spaces</th>
                    <th class="head1">Fill %</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $open; ?></td>
                    <td><?php echo $filled; ?></td>
                    <td class="center"><?php echo number_format($percentage, 2),'%'; ?></td>
                </tr>
            </tbody>
        </table>

        <br clear="all" />

        <table cellpadding="0" cellspacing="0" border="0" class="stdtable blogtable">
            <colgroup>

                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
            </colgroup>
            <thead>
            <tr>

                <th class="head0">Location</th>
                <th class="head1">Hotel</th>
                <th class="head0">Date</th>
                <th class="head1">Status</th>
                <th class="head0">Open Spaces</th>
                <th class="head1">Booked Spaces</th>
                <th class="head0"></th>
            </tr>
            </thead>
            
                <?php 
                $retreats = $Posts->get_retreats('', '');

                if (empty($retreats)) 
                {
                    echo '<tbody>
                          <tr><td>There are currently no retreats!</td></tr>';
                          
                } 
                else
                {
                // If we have an array with items
                if (count($retreats)) {
                    foreach ($retreats as $retreatArray) {

                      // Show the information about the item
                        echo'
            <tbody>
                <tr>

                    <td class="con0"><a href="viewblog.html" class="title">'.$retreatArray["location"].'</a></td>
                    <td class="con1">'.$retreatArray["hotel"].'</td>
                    <td class="con0">'.$retreatArray["date"].'</td>
                    <td class="con1">'.$retreatArray["status"].'</td>
                    <td class="con0 aligncenter">'.$retreatArray["open"].'</td>
                    <td class="con1 aligncenter">'.$retreatArray["filled"].'</td>
                    <td class="con0 actions aligncenter">
                        <a href="edit_retreat.php?id='.$retreatArray["id"].'">Edit</a> <a href="../../blog-post.php?title=">View</a> <a href="archive_retreat.php?id='.$retreatArray["id"].'" class="delete">Archive</a>
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
