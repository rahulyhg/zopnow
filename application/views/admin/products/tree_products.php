<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=config_item('bootstrap')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>public/js/jtree/jquery.treeview.css" />
    <script src="<?=config_item('jquery')?>"></script>
    <script src="<?=base_url()?>public/js/jtree/jquery.treeview.js" type="text/javascript"></script>
    <script>
	$(function() {
			$("#browser").treeview();
		});
		function del(id){
			if(confirm('Are you Sure you want to move this item to trash ?')){
				$('#bar'+id).fadeOut('slow');
				$.post('<?=base_url()?>admin/category',{ID: id},function(data){});
				return false;
			}
			return false;
		}
	</script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
		border:1px solid #CCC;
		border-radius:4px;
		background:#FAFAFA;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Administrator Panel</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"> {username}</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
             
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
        <?php $this->load->view('admin/templates/sidebar')?>
          <!--/.well -->
        </div><!--/span-->
        <div class="span9">
          
          <div class="well">
          	<strong>Products </strong>
          </div>
          
         <a href="<?=base_url()?>admin/products/new_products" class="btn btn-primary">Add New Product </a> 
         &nbsp;
         <a href="<?=base_url()?>admin/products/" class="btn">List view</a>
         <br>
<br>

          <div class="row-fluid">
         
         &nbsp;&nbsp; 
         <br><br>
		
      <div id="main" style="margin-left:100px;">          
      <ul id="browser" class="filetree">
	<?php
	$this->db->where('trashed', 0);
	$s= $this->db->get('category');
	$q = $s->result_array();
		foreach($q as $c):
	?>
    	<li>
        <img src="<?=base_url()?>public/js/jtree/images/folder.gif" />  
		<a href="<?=base_url()?>admin/category/edit_category/<?=$c['category_id']?>"><?=$c['category_name']?></a></span>
			<ul>
            
            <?php 
			$this->db->where('category_id', $c['category_id']);
			$f = $this->db->get('subcategory');
			$h = $f->result_array();
			foreach($h as $s):
			?>
				<li> 
				
				<a href="<?=base_url()?>admin/subcategory/new_subcategory/'.$c['category_id'].'"><?=$s['subcategory_name']?></a> 
					<ul>
                    <?php 
					$this->db->where('category_id', $c['category_id']);
					$this->db->where('subcategory_id', $s['subcategory_id']);
					$pf = $this->db->get('products');
					$hh = $pf->result_array();
					foreach($hh as $sp):
					?>
						<li>
                        	<a href="<?=base_url()?>admin/products/edit_products/<?=$sp['products_id']?>/"><?=$sp['products_name']?> (<?=$sp['products_no']?>) </a>
                        </li>
                        
                        <?php endforeach;?>
					</ul>
				
				
				</li>
                
                <?php endforeach;?>
			</ul>
		</li>
       <?php endforeach;?> 
        
	</ul>
    
   
     </div>           
          </div><!--/row-->
          <!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->

  

  </body>
</html>
