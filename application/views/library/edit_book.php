<?php include_once APPPATH . 'views/library_head.php';?>
 

<body>
        
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Books</a>
							</li>
							<li class="active">Update Book Details</li>
						</ul>
					</div>
					<div class="page-content">
	
			<div class="main_data">
    
          	<div class="user-profile">
            <div class="row">
             
		
            <div class="col-md-7">
                  <div class="panel" >
           		 	 <br>
					  <br>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php/library/edit_book_data', array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));
                      foreach ($bookdata as $row2)
					  {
					  ?>
                                     <input type="hidden" class="form-control" name="book_master_id" value="<?php echo $row2['book_master_id'];?>"/>
                       <div class="form-group">
                            <label class="col-sm-3 control-label">Book Name:</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_name" value="<?php echo $row2['book_name'];?>"/>
                            </div>
                        </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label"> Author Name:</label>
                            <div class="col-sm-8">
                                    <select name="author_name" class="form-control">
                                    <option value="<?php echo $row2['author_id']; ?>"><?php echo $row2['author_name'];?></option>
                                    <?php foreach($authordata as $author){ ?>
									<option value="<?php echo $author['author_id'];?>"><?php echo $author['author_name'];?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label"> Language Name:</label>
                            <div class="col-sm-8">
                                    <select name="language_name" class="form-control">
                                    <option value="<?php echo $row2['book_language_id'];?>"><?php echo $row2['book_language_name'];?></option>
                                    <?php foreach($languagedata as $l){ ?>
									<option value="<?php echo $l->book_language_id;?>"><?php echo $l->book_language_name;?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label"> Category Name:</label>
                            <div class="col-sm-8">
                                    <select name="category_name" class="form-control">
                                    <option value="<?php echo $row2['book_category_id'];?>"><?php echo $row2['book_category_name'];?></option>
                                    <?php foreach($categorydata as $category){ ?>
									<option value="<?php echo $category->book_category_id;?>"><?php echo $category->book_category_name;?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label">Stream Name:</label>
                            <div class="col-sm-8">
                                    <select name="stream_name" class="form-control">
                                    <option value="<?php echo $row2['book_stream_id'];?>"><?php echo $row2['book_stream_name'];?></option>
                                    <?php foreach($streamdata as $stream){ ?>
									<option value="<?php echo $stream->book_stream_name;?>"><?php echo $stream->book_stream_name;?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label">ISBN:</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="isbn" value="<?php echo $row2['isbn'];?>"/>
                            </div>
                 </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label">Edition:</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="edition" value="<?php echo $row2['edition'];?>"/>
                            </div>
                 </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label">Price:</label>
                            <div class="col-sm-8">
                                   <input type="text" class="form-control" name="price" value="<?php echo $row2['price'];?>"/>
                            </div>
                 </div>
				<div class="form-group">
                            <label class="col-sm-3 control-label">No.of Pages:</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_of_pages" value="<?php echo $row2['no_of_pages'];?>"/>
                            </div>
                  </div>
				 <center> <button type="submit" class="btn btn-info">Update</button></center></form>
                </div>
              </div>
                
                   <?php
                }
                ?>
            </div>
        </div>
	
              </div>
            </div>
          </div>

</div>
<?php include_once APPPATH . 'views/footer.php'; ?>
