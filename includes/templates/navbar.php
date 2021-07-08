 <script>
 function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
} 
</script>
 <!--navbar section start-->
 
<nav class="navbar-expand-lg navbar  navbar-fixed-top" role="navigation">

 <?php 
 $user=  $_SESSION['ID'];
$stmt = $con->prepare("SELECT * FROM users  where UserID =$user");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  
							foreach($rows as $row) {
								 
								 
									 

 

?>
			  
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px; background:transparent;"></span> <i class="far fa-bell fa-2x"></i>
	  
	   <?php
                 $stmt = $con->prepare("(SELECT follownotification.UserID,follownotification.fUserID,follownotification.status,follownotification.date from follownotification INNER JOIN users ON follownotification.fUserID = users.UserID where status ='unread' AND follownotification.UserID=$user)
				                            UNION 
										(SELECT likenotification.UserID,likenotification.fUserID,likenotification.status,likenotification.date from likenotification INNER JOIN users ON likenotification.fUserID = users.UserID where status ='lunread' AND likenotification.UserID=$user)
										UNION 
										(SELECT commentnotification.UserID,commentnotification.fUserID,commentnotification.status,commentnotification.date from commentnotification INNER JOIN users ON commentnotification.fUserID = users.UserID where status ='cunread' AND commentnotification.UserID=$user)
									    UNION 
										(SELECT quoteNotification.UserID,quoteNotification.fUserID,quoteNotification.status,quoteNotification.date from quoteNotification INNER JOIN users ON quoteNotification.fUserID = users.UserID where status ='quoteunread' AND quoteNotification.UserID=$user)
										 UNION 
										(SELECT quotecommentnotification.UserID,quotecommentnotification.fUserID,quotecommentnotification.status,quotecommentnotification.date from quotecommentnotification INNER JOIN users ON quotecommentnotification.fUserID = users.UserID where status ='qcommentunread' AND quotecommentnotification.UserID=$user)
										 UNION 
										(SELECT likecommentnotification.UserID,likecommentnotification.fUserID,likecommentnotification.status,likecommentnotification.date from likecommentnotification INNER JOIN users ON likecommentnotification.fUserID = users.UserID where status ='replyunread' AND likecommentnotification.UserID=$user)
										 UNION 
										(SELECT qreplynotification.UserID,qreplynotification.fUserID,qreplynotification.status,qreplynotification.date from qreplynotification INNER JOIN users ON qreplynotification.fUserID = users.UserID where status ='qreplyunread' AND qreplynotification.UserID=$user)
														
											");
				 $stmt->execute();
					  $rows = $stmt->fetchAll();
                if(count($rows)>0){
                ?>
                <span class="badge badge-light countnot"><?php echo count($rows); ?></span>
              <?php
                }
                    ?>
              </a>
      <ul class="dropdown-menu  scrollable-menu dropnotif" >
	    <h2 class="dropdown-header">Notifications</h2>
	 
	   <?php
                 $stmt  =  $con->prepare("(SELECT follownotification.UserID,follownotification.fUserID,follownotification.status,follownotification.date,UserName,UserPic,BookID from follownotification INNER JOIN users ON follownotification.fUserID = users.UserID where follownotification.UserID=$user)
				                            UNION 
										(SELECT likenotification.UserID,likenotification.fUserID,likenotification.status,likenotification.date,UserName,UserPic,likenotification.BookID from likenotification INNER JOIN users ON likenotification.fUserID = users.UserID where likenotification.UserID=$user)
                                            UNION
										(SELECT commentnotification.UserID,commentnotification.fUserID,commentnotification.status,commentnotification.date,UserName,UserPic,commentnotification.BookID from commentnotification  INNER JOIN users ON commentnotification.fUserID = users.UserID where commentnotification.UserID=$user)
										 UNION 
										(SELECT quoteNotification.UserID,quoteNotification.fUserID,quoteNotification.status,quoteNotification.date,UserName,UserPic,quoteNotification.BookID from quoteNotification  INNER JOIN users ON quoteNotification.fUserID = users.UserID where quoteNotification.UserID=$user)
										 UNION 
										(SELECT quotecommentnotification.UserID,quotecommentnotification.fUserID,quotecommentnotification.status,quotecommentnotification.date,UserName,UserPic,quotecommentnotification.BookID from quotecommentnotification  INNER JOIN users ON quotecommentnotification.fUserID = users.UserID where quotecommentnotification.UserID=$user)
										 UNION 
										(SELECT likecommentnotification.UserID,likecommentnotification.fUserID,likecommentnotification.status,likecommentnotification.date,UserName,UserPic,likecommentnotification.BookID from likecommentnotification  INNER JOIN users ON likecommentnotification.fUserID = users.UserID where likecommentnotification.UserID=$user)
										 UNION 
										(SELECT qreplynotification.UserID,qreplynotification.fUserID,qreplynotification.status,qreplynotification.date,UserName,UserPic,qreplynotification.BookID from qreplynotification  INNER JOIN users ON qreplynotification.fUserID = users.UserID where qreplynotification.UserID=$user)
																						
										order by date DESC
				                           ");
				 $stmt->execute();
					  $rows = $stmt->fetchAll();
					   if(count($rows)>0){
                     foreach($rows as $i){
                
                ?>
				 <?php
                            if($i['status']=='unread'){
								?> 
						 <a   class="dropdown-item" style ="font-weight:bold;" href="profile.php?userid=<?php echo $user ?>&userview=<?php echo $i['fUserID'] ?>">
                             
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							 
                           
							<?php  echo "<span class='notifspan'>".$i['UserName']." Followed you. </span>"; ?> </a> <span class="badge badge-secondary"> New</span><br>                  
              				<small><?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
               <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='read'){ ?>
							 
							<a   class="dropdown-item" style ="font-weight:normal;" href="profile.php?userid=<?php echo $user ?>&userview=<?php echo $i['fUserID'] ?>">
                             <?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>


					 <?php  echo "<span class='notifspan'>".$i['UserName']." Followed you.</span>"; ?> </a><br>
							<small><?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>

 							
							<?php
							 if($i['status']=='lunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="view.php?userrid=<?php echo $user ?>&ubv=<?php echo $i['fUserID'] ?>&bookvid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Liked your Book. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='lread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="view.php?userrid=<?php echo $user ?>&ubv=<?php echo $i['fUserID'] ?>&bookvid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Liked your Book.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>

							           
                    <?php if($i['status']=='cunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="viewcomment.php?userrid=<?php echo $user ?>&ubv=<?php echo $i['fUserID'] ?>&bookvid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Commented on your Book. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='cread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="viewcomment.php?userrid=<?php echo $user ?>&ubv=<?php echo $i['fUserID'] ?>&bookvid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Commented on your Book.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>

          
                 
                  
				  <?php if($i['status']=='quoteunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="viewquote.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&quotevid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Liked your Quote. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='quoteread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="viewquote.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&quotevid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Liked your Quote.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>
						
		  <?php if($i['status']=='qcommentunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="viewqcomment.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&quotevid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Commented on your Quote. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='qcommentread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="viewqcomment.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&quotevid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Commented on your Quote.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>
         
		 
		 
		 <?php if($i['status']=='replyunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="viewreply.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&commentid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Replied to Your comment. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='replyread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="viewreply.php?userrqid=<?php echo $user ?>&ubvq=<?php echo $i['fUserID'] ?>&commentid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Replied to Your comment.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>
							   
							  
		 <?php if($i['status']=='qreplyunread'){
								?> 
							 
								<a   class="dropdown-item " style ="font-weight:bold;" href="viewqreply.php?userrrqid=<?php echo $user ?>&ubrq=<?php echo $i['fUserID'] ?>&quoterid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Replied to Your comment. </span>"; ?></a> <span class="badge badge-secondary">New</span><br>                   
							 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); ?></small>					 
                                            <div class="dropdown-divider"></div>

							<?php }else if($i['status']=='qreplyread'){ ?>
						 
							<a   class="dropdown-item" style ="font-weight:normal;" href="viewqreply.php?userrrqid=<?php echo $user ?>&ubrq=<?php echo $i['fUserID'] ?>&quoterid=<?php echo $i['BookID'] ?>">
<?php if (empty($i['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-responsive searchpicc' src='uploads/User/". $i['UserPic']."'></img>";}?>

							<?php  echo "<span class='notifspan'>".$i['UserName']." Replied to Your comment.</span>"; ?> </a> <br>
					 <small> <?php echo "<span class='notifdate'>".(time_elapsed_string($i['date'])); }?></small>					 
                               <div class="dropdown-divider"></div>
                <?php
                     
					 }
                 
					 }else{
                     echo "No Notifications yet.";}
                     ?>
	  
	  
	  </ul>
    <span style="font-size:30px;cursor:pointer;  margin-top:-36px;" class="navside hidden-sm  visible-xs " onclick="openNav()">&#9776;</span>
<div id="mySidenav" class="sidenav  hidden-md visible-sm visible-xs ">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   <div  class="classification">
  <div  class="row">
   
  <div class="user col-xs-12  ">
  <div class="col-xs-6">
 <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail   ' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle  img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>  </img>";}?></div> <a href="profile.php?userid=<?php echo $_SESSION['ID']?>"> <span class="col-xs-6"><?php echo $_SESSION['Username'];?></span></a>
 
 </div>
   <a href="index.php"><div class="pen-classification  col-xs-12  ">
 <span class="  glyphicon glyphicon-home" aria-hidden="true"></span>
 <span>Home</span>
  </div></a>
  <a href="quotes.php"><div class="pen-classification  col-xs-12  "><i class="fa fa-quote-left "></i>
   <span>Quotes</span></div>
  </a>
 
 <a href="discover.php"><div class="pen-classification  col-xs-12  "><i class="fas fa-compass"></i>
 <span>Discover</span></div>
 </a> 

  <a href="top-books.php"><div class="pen-classification  col-xs-12  ">
 <span class=" glyphicon  glyphicon-pencil" aria-hidden="true"></span>
 <span>Top Books</span>
 </div></a>
  
 <a href="SavedBook.php "><div class="pen-classification  col-xs-12  ">
 <span class=" far fa-bookmark" aria-hidden="true"></span>
 <span>Saved Books</span>
 </div></a>
 
 <a href="follow.php"><div class="pen-classification  col-xs-12  ">
 <span class="glyphicon glyphicon-user  " aria-hidden="true"></span>
 <span>Following</span>
 </div></a>
 
 
   
 <a href="logout.php"> <div class="pen-classification  col-xs-12  ">
 <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
 <span>Log Out</span>
  </div></a>
</div>   
 </div> </div>

<!-- <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>-->
	<div class="container">

<div class="navbar-collapse collapse" id="our-navbar">
 	

		<ul class="nav navbar-nav navbar-right">

<li class="active"><a href="index.php"><i class="fas fa-home fa-2x "></i></a></li>

<li class="active"><a href="quotes.php"><i class="fa fa-quote-left fa-2x"></i></a></li>
 
<li class="active"><a href="discover.php"><i class="fas fa-compass fa-2x"></i></a></li>

							
 

 <li><a href="profile.php?userid=<?php echo $_SESSION['ID']?>"><i class="navpic">  <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle img-fluid' src='uploads/User/" . $row['UserPic'] . "'>  </img>";}?>
</i></a></li><?php }?>	
 

</ul> 
      
 
 </div>
 <div class="input-group xs-form form-xs form-2 pl-0">
  <input class="form-control my-0 py-1 lime-border search_text" type="text" placeholder="Search For BookName Or UserName." id="search" aria-label="Search" autocomplete="off">
  <div class="input-group-append">
    <span class="input-group-text lime lighten-2" id="basic-text1"></span>
  </div>
 
</div>

  
<a class="navbabrand" href="" style="text-decoration:none;">
		 <h1>Deja Lu<h1><!--logo Image -->
    </a>  
   <!-- Suggestions will be displayed in below div. -->
   
   <li id="display" class="overflow-auto dropdown-menu " >
 				   <ul class="dropdown-menu  scrollable-menu  ">
				   
				   </ul>


   </li> 
  
</div> 
</nav>

 
<!--navbar section end-->
<!--navbar section end-->