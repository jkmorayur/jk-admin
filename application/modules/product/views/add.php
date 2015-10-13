<div class="row-fluid">
     <div class="span12">
          <div class="widget green">
               <div class="widget-title">
                    <h4><i class="icon-reorder"></i> <?php echo $this->section; ?></h4>
               </div>
               <div class="widget-body">
                    <?php echo form_open_multipart("product/insert", array('id' => "frmProduct", 'class' => "form-horizontal")) ?>
                    <div class="control-group">
                         <label class="control-label">Product Name</label>
                         <div class="controls">
                              <input type="text" placeholder="Product Name" class="input-xxlarge" name="product[prd_name]" />
                              <!--<span class="help-inline">Some hint here</span>-->
                         </div>
                    </div>
                    <div class="control-group">
                         <label class="control-label">Status</label>
                         <div class="controls">
                              <input type="text" placeholder="Status" class="input-xxlarge" name="product[prd_status]"/>
                         </div>
                    </div>
                    <div class="control-group">
                         <label class="control-label">Price</label>
                         <div class="controls">
                              <input type="text" placeholder="Price" class="input-xxlarge" name="product[prd_price]"/>
                         </div>
                    </div>
                    <div class="control-group">
                         <label class="control-label">Part Number</label>
                         <div class="controls">
                              <input type="text" placeholder="Price" class="input-xxlarge" name="product[prd_part_number]"/>
                         </div>
                    </div>
                    <div class="control-group">
                         <label class="control-label">Brand</label>
                         <div class="controls">
                              <select name="product[prd_brand]" id="prd_brand"  class="input-xxlarge">
                                   <option value="">Select Brand</option>
                                   <?php
                                     if (!empty($brands)) {
                                          foreach ($brands as $key => $value) {
                                               ?>
                                               <option value="<?php echo $value['brd_id']; ?>"><?php echo $value['brd_title']; ?></option>
                                               <?php
                                          }
                                     }
                                   ?>
                              </select>
                         </div>
                    </div>
                    <div class="control-group">
                         <label class="control-label">Category</label>
                         <div class="controls">
                              <?php
                                $options = get_options($category);
                                echo '<select name="product[prd_category]" id="prd_category"  class="form-control">';
                                echo '<option value="">Select Category</option>';
                                foreach ($options as $key => $val) {
                                     echo "<option value='" . substr($key, 1) . "'>" . $val . "</option>";
                                }
                                echo "</select>";
                              ?>
                         </div>
                    </div>

                    <div class="control-group">
                         <label class="control-label">Description</label>
                         <div class="controls">
                              <textarea placeholder="Price" class="editor" name="product[prd_desc]"></textarea>
                         </div>
                    </div>

                    <div class="control-group">
                         <label class="control-label">Product Image</label>
                         <div class="controls">
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
                              <span class="help-inline">Some hint here</span>
                         </div>
                    </div>
                    <div class="form-actions">
                         <input type="submit" class="btn blue"/>
                         <button type="button" class="btn"><i class=" icon-remove"></i> Cancel</button>
                    </div>
                    <?php echo form_close() ?>
               </div>
          </div>
     </div>
</div>


