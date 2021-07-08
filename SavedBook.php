 <?php 
session_start();

$Navbar = '';
$main = '';
$pageTitle ='Saved Books';

 	if (!isset($_SESSION['User'])) {
		 
	 
		header('Location: login.php');
		
	}

include 'init.php'; 


?>

 

<!--<section class="   pen-rates text-center  col-md-10 col-md-offset-2">
<h2>Top Books</h2>
<div class="container">
<div class="pen-number col-md-5 col-md-offset-1">
<div class="golden-pen"> 
<span class="  glyphicon  glyphicon-pencil" aria-hidden="true"></span>
<span> Golden pen</span></div>
<div class="sp golden-pen"> <span>N°1</span><span>1.25555.5</span></div>


</div>
<div class="Book-name col-md-6">
<div class="book-n">
<span class="  glyphicon  glyphicon-book" aria-hidden="true"></span>
<span> Book Name</span>
</div>

<div class=" sp book-n"><span>Me Before You</span></div>
</div>
</div>


-->

 
  
          	<div class="table-userss">
  
   
   <table>
      <tr>
         <th class="col-xs-6 text-center"><h4> Saved Books<span class="spans  glyphicon  glyphicon-book" aria-hidden="true"></span></h4></th>
         </tr>
					</table>	</div>
          
     <?php
	  $user=$_SESSION['ID'];
						$stmt = $con->prepare(" SELECT * FROM savedbook INNER JOIN books   ON books.BookID  = savedbook.BookID  
						                       INNER JOIN users   ON users.UserID   = savedbook.bookUserID where savedbook.UserID=$user ORDER BY ID DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  if (empty($rows)) {
						  
						  echo "<span class='NothingHeres'>No books saved here</span>";
						  
					  }else{
							foreach($rows as $row) { ?>
							 
                   							  
				 
    <div class="middle-class col-xs-6  ">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	   <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
	 
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .$row['Date']. "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu" role="menu">
 <?php 
     $user=$_SESSION['ID'];
	 $id = $row['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
 
	<li><a class="edit_book" data-editbookid= "<?php echo $row['BookID'] ?>">Edit</a></li>

 <li><a class="del" data-idbookdelete= "<?php echo $row['BookID'] ?>"  data-bookdelete="<?php echo $j; ?>">Delete</a></li>
	 <?php } ?>
 <?php
	  if(($row['empty']=='No')){
 

 ?>
 
 <li><a href="download.php?file=<?php echo urlencode($row['Book'])?>">Download Book </a></li>
  <?php } ?>
<li><a class="savebookp" data-idbooksave="<?php echo $row['BookID'] ?>" data-idusersave="<?php echo $row['UserID'] ?>"> Save Book </a></li>
<li><a href="report.php?idbookreport=<?php echo $row['BookID']?>&iduserreport=<?php echo $row['UserID'] ?>">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-mid col-xs-12">

<div class="mid-mid-BookTitle col-xs-12  " id="mid-mid-BookTitle"> <?php echo "<h2 dir='auto' class='overflow-hidden minimin' id='mid-mid-BookTitle".$row['BookID']."'>" .$row['BookName']. "</h2>";?>

<?php echo "<h2 dir='auto' style='display:none;' class='overflow-hidden' id='mid-mid-BookTitlehidden".$row['BookID']."'>" .$row['BookName']. "</h2>";?>

</div>
  <div class="column  " ><div class="mid-mid-BookDescription col-xs-12 " id="mid-mid-BookDescription"> 
							<?php echo '<p dir="auto" class="minimizes" id="mid-mid-BookDescription'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?>

								<?php echo '<p dir="auto" style="display:none;" id="mid-mid-BookDescriptionhidden'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?> 	
							
 </div></div>
<div class="mid-mid-BookCover col-xs-12" id="mid-mid-BookCover"> 
<?php  
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img id='mid-mid-BookCover".$row['BookID']."' src='uploads/BookCover/" . $row['BookCover'] ."'    alt='Responsive image'>";
									}
								
									echo "</td>";?> </div></div>
							

 
</div>	
			  			 


					



  
 
  
  <!--middle col of the status end-->
					  <?php  } }?>
  </section><!--main page section end-->
  <script>
  jQuery(function(){

    var minimized_elements = $('p.minimizes');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 300) return;
        
        $(this).html(
            t.slice(0,300)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(300,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

});
jQuery(function(){

    var minimized_elements = $('h2.minmin');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 82) return;
        
        $(this).html(
            t.slice(0,82)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(82,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

});
  </script>
 <?php include $tpl.'footer.php'; ?>