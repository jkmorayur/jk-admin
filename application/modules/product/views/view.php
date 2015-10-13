<?php //echo '<pre>';print_r($productsDetails);exit;    ?>
<section class="content">
     <div class="row">
          <section class="col-lg-12 connectedSortable">
               <?php echo form_open_multipart("product/update", array('id' => "frmProduct", 'class' => "form-horizontal")) ?>
               <input type="hidden" name="prd_id" value="<?php echo $productsDetails['product_details']['prd_id']; ?>"/>
               <div class="box box-info">
                    <div class="box-header">
                         <h3 class="box-title">Edit Product</h3>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Product Name</label>
                         <div class="col-md-4">
                              <input value="<?php echo $productsDetails['product_details']['prd_name']; ?>" type="text" class="form-control" name="product[prd_name]" id="prd_name" placeholder="Product Name"/>
                              <span class="help-block"></span>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Status</label>
                         <div class="col-md-4">
                              <input value="<?php echo $productsDetails['product_details']['prd_status']; ?>" type="text" name="product[prd_status]" class="form-control" id="prd_status" placeholder="Status"/>
                              <span class="help-block"></span>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Price</label>
                         <div class="col-md-4">
                              <input value="<?php echo $productsDetails['product_details']['prd_price']; ?>" type="text" name="product[prd_price]" class="form-control" id="prd_price" placeholder="Price"/>
                              <span class="help-block"></span>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Part Number</label>
                         <div class="col-md-4">
                              <input value="<?php echo $productsDetails['product_details']['prd_part_number']; ?>" type="text" name="product[prd_part_number]" class="form-control" id="prd_part_number" placeholder="Part Number"/>
                              <span class="help-block"></span>
                         </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Brand</label>
                         <div class="col-md-4">
                              <select name="product[prd_brand]" id="prd_brand"  class="form-control">
                                   <option value="">Select Brand</option>
                                   <?php
                                     if (!empty($brands)) {
                                          foreach ($brands as $key => $value) {
                                               ?>
                                               <option 
                                               <?php echo ($productsDetails['product_details']['brd_id'] == $value['brd_id']) ? "selected='selected'" : ''; ?> 
                                                    value="<?php echo $value['brd_id']; ?>"><?php echo $value['brd_title']; ?></option>
                                                    <?php
                                               }
                                          }
                                        ?>
                              </select>
                              <span class="help-block"></span>
                         </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Category</label>
                         <div class="col-md-4">
                              <?php
                                $options = get_options($category);
                                echo '<select name="product[prd_category]" id="prd_category"  class="form-control">';
                                echo '<option value="">Select Category</option>';
                                foreach ($options as $key => $val) {
                                     $selected = (substr($key, 1) == $productsDetails['product_details']['prd_category']) ? "selected='selected'" : '';
                                     echo "<option $selected value='" . substr($key, 1) . "'>" . $val . "</option>";
                                }
                                echo "</select>";
                              ?>
                              <span class="help-block"></span>
                         </div>
                    </div>
<!--                    <div class="form-group">
                         <label class="col-md-3 control-label">Show on home page</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <input <?php echo ($productsDetails['product_details']['prd_show_on_home'] == '1') ? 'checked="true"' : '';  ?> 
                                        value="1" type="checkbox" name="product[prd_show_on_home]" id="prd_show_on_home"/>
                              </div>
                         </div>
                    </div>-->
                    <div class="form-group">
                         <label class="col-md-3 control-label">Is featured product</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <input <?php echo ($productsDetails['product_details']['prd_is_featured'] == '1') ? 'checked="true"' : '';  ?> 
                                        value="1" type="checkbox" name="product[prd_is_featured]" id="prd_is_featured"/>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Is Sold Out</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <input <?php echo ($productsDetails['product_details']['prd_in_stock'] == '1') ? 'checked="true"' : '';  ?> 
                                        value="1" type="checkbox" name="product[prd_in_stock]" id="prd_in_stock"/>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Description</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <textarea name="product[prd_desc]" id="prd_desc" class='editor'><?php echo $productsDetails['product_details']['prd_desc']; ?></textarea>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Description New</label>
                         <div class="col-md-4">
                              <div class="input-group" style="width: 100%;">
                                   <textarea name="product[prd_desc_new]" id="prd_desc_new" class='editor'><?php echo $productsDetails['product_details']['prd_desc_new']; ?></textarea>
                              </div>
                         </div>
                    </div>
<!--                    <div class="form-group">
                         <label class="col-md-3 control-label">Specifications</label>
                         <div class="col-md-4">
                              <div class="input-group" style="width: 100%;">
                                   <textarea name="product[prd_specifications_key]" id="prd_specifications_key" class='editor'><?php echo $productsDetails['product_details']['prd_specifications_key']; ?></textarea>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Specifications Details</label>
                         <div class="col-md-4">
                              <div class="input-group" style="width: 100%;">
                                   <textarea name="product[prd_specifications_value]" id="prd_specifications_value" class='editor'><?php echo $productsDetails['product_details']['prd_specifications_value']; ?></textarea>
                              </div>
                         </div>
                    </div>-->
                    <div class="form-group">
                         <label class="col-md-3 control-label">Features</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <textarea name="product[prd_features]" id="prd_features" class='editor'><?php echo $productsDetails['product_details']['prd_features']; ?></textarea>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 control-label"></label>
                         <div class="col-md-7" style="text-align: right;">
                              <div class="input-group" style="float: right;padding-right: 5px;">
                                   <div class="box-tools" style="display: table;">
                                        <label class="col-md-3 control-label" style="width: auto;">Add more specifications</label>
                                        <a href="javascript:void(0);" 
                                           class="btn btn-info btn-sm" id="btnAddMoreSpecification" data-original-title="Add More">
                                             <i class="fa fa-plus"></i>
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="form-group">
                         <?php
                           if ($productsDetails['product_specification']) {
                                foreach ($productsDetails['product_specification'] as $key => $value) {
                                     ?>
                                     <div style="padding-top:10px;">
                                          <label class="col-md-3 control-label">Specification</label>
                                          <div class="col-md-3" style="margin-right: -96px;">
                                               <div class="input-group">
                                                    <input value="<?php echo $value['spe_specification']; ?>" type="text" name="specification[spe_specification][]" class="form-control" id="spe_specification" placeholder="Specification"/>
                                               </div>
                                          </div>

                                          <label class="col-md-2 control-label">Specification Details</label>
                                          <div class="col-md-3"  style="margin-right: -41px;">
                                               <div class="input-group">
                                                    <input value="<?php echo $value['spe_specification_detail']; ?>" type="text" name="specification[spe_specification_detail][]" class="form-control" id="spe_specification" placeholder="Specification Details"/>
                                               </div>
                                          </div>
                                          <div class="box-tools">
                                               <a href="javascript:void(0);"  class="btn btn-info btn-sm btnRemoveMoreSpecification" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                               </a>
                                          </div>
                                     </div>
                         <?php } } ?>

                         <div id="divSpecificatiion">

                         </div>
                    </div>
                    <!-- -->
                    <?php if($productsDetails['product_images']) { foreach ($productsDetails['product_images'] as $key => $value) { ?>
                    <div class="form-group">
                         <label class="col-md-3 control-label"></label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <?php echo img(array('src' => 'assets/uploads/product/' . $value['pdi_image'], 'height' => '80', 'width' => '100','id' => 'imgBrandImage')); ?>
                              </div>
                              <?php if($value['pdi_image']) { ?>
                                   <span class="help-block">
                                        <a id="btnDeleteImage" data-url="<?php echo site_url('product/removeImage/'.$value['pdi_id']); ?>" href="javascript:void(0);" style="width: 100px;" class="btn btn-block btn-danger btn-xs">Delete</a>
                                   </span>
                              <?php } ?>
                         </div>
                    </div>
                    <?php } } ?>
                    
                    <div class="form-group">
                         <label class="col-md-3 control-label">Product Image</label>
                         <div class="col-md-4">
                              <div id="newupload">
                                   <input type="hidden" id="x10" name="x1[]" />
                                   <input type="hidden" id="y10" name="y1[]" />
                                   <input type="hidden" id="x20" name="x2[]" />
                                   <input type="hidden" id="y20" name="y2[]" />
                                   <input type="hidden" id="w0" name="w[]" />
                                   <input type="hidden" id="h0" name="h[]" />
                                   <input type="file" class="form-control" style="display: table;margin-bottom: 10px;" name="prd_image[]" id="image_file0" onchange="fileSelectHandler('0', '500', '333')" />
                                   <img id="preview0" class="preview"/>
                              </div>
                              <span class="help-block">
                                   <!--<p style="color: red;">Image size width 500 height 333</p>-->
                              </span>
                         </div>
<!--                         <div class="box-tools">
                              <a href="javascript:void(0);" 
                                 class="btn btn-info btn-sm" id="btnMoreProductImages" data-original-title="Add More">
                                   <i class="fa fa-plus"></i>
                              </a>
                         </div>-->
                    </div>
                    <div id="divMoreProductImages">

                    </div>
                    <!-- -->
                    <?php if (!empty($productsDetails['product_docs'])) { ?>
                         <?php foreach ($productsDetails['product_docs'] as $key => $value) { ?>
                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                     <div id="prodDocs<?php echo $value['pdc_id']?>" class="col-md-4">
                                          <div class="input-group">
                                             <?php echo $value['pdc_title']; ?>
                                          </div>
                                          <?php if ($value['pdc_title']) { ?>
                                               <span class="help-block">
                                                    <a id="<?php echo $value['pdc_id']?>" data-url="<?php echo site_url('product/removeDocs/' . $value['pdc_id']); ?>" href="javascript:void(0);" style="width: 100px;" class="btnDeleteDocs btn btn-block btn-danger btn-xs">Delete</a>
                                               </span>
                                          <?php } ?>
                                     </div>
                                </div>
                         <?php } ?>
                    <?php } ?>
                    <div class="form-group">
                         <label class="col-md-3 control-label">Technical Documents</label>
                         <div class="col-md-4">
                              <div class="input-group">
                                   <input multiple type="file" name="prod_docs[]" id="prod_docs" class="form-control" style="display: table;margin-bottom: 10px;"/>
                              </div>
                         </div>
                    </div>
                    <div class="box-footer clearfix">
                         <input type="submit" value="Save" class="btn btn-primary" style="float: left !important;"/>
                    </div>
               </div>
<?php echo form_close() ?>
          </section>
     </div>
</section>
</div>
<script type="text/template" id="temSpecification">
     <div style="padding-top:10px;">
     <label class="col-md-3 control-label">Specification</label>
     <div class="col-md-3" style="margin-right: -96px;">
     <div class="input-group">
     <input type="text" name="specification[spe_specification][]" class="form-control" id="spe_specification" placeholder="Specification"/>
     </div>
     </div>

     <label class="col-md-2 control-label">Specification Details</label>
     <div class="col-md-3"  style="margin-right: -41px;">
     <div class="input-group">
     <input type="text" name="specification[spe_specification_detail][]" class="form-control" id="spe_specification_detail" placeholder="Specification Details"/>
     </div>
     </div>

     <div class="box-tools">
     <a href="javascript:void(0);"  class="btn btn-info btn-sm btnRemoveMoreSpecification" data-original-title="Remove">
     <i class="fa fa-times"></i>
     </a>
     </div>
     </div>
</script>