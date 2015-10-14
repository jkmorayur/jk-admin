<div id="page">
     <div class="row-fluid ">
          <div class="span12">
               <!-- BEGIN TAB PORTLET-->
               <div class="widget widget-tabs green">
                    <div class="widget-title">
                        <!--<h4><i class=" icon-search"></i>Search Result</h4>-->
                    </div>
                    <div class="widget-body">
                         <div class="tabbable portlet-tabs">
                              <ul class="nav nav-tabs pull-left">
                                   <li><a href="#backend_settings" data-toggle="tab">Backend Settings</a></li>
                                   <li class="active"><a href="#frontend_settings" data-toggle="tab">Frontend Settings</a></li>
                              </ul>
                              <div class="clearfix"></div>
                              <div class="tab-content">
                                   <div class="tab-pane active" id="frontend_settings">
                                        <div class="widget-body">
                                             <?php echo form_open_multipart("settings/insert", array('id' => "frmSettings", 'class' => "form-horizontal")) ?>
                                             <div class="control-group">
                                                  <label class="control-label">Site Url</label>
                                                  <div class="controls">
                                                       <input value="<?php echo get_settings_by_key('site_url'); ?>" type="text" placeholder="Site Url" class="input-xxlarge" name="settings[site_url]" />
                                                  </div>
                                             </div>
                                             <div class="form-actions">
                                                  <input type="submit" class="btn blue"/>
                                                  <button type="button" class="btn"><i class=" icon-remove"></i> Cancel</button>
                                             </div>
                                             <?php echo form_close() ?>
                                        </div>
                                   </div>
                                   <div class="tab-pane" id="backend_settings">
                                        <div class="widget-body">
                                             <?php echo form_open_multipart("settings/insert", array('id' => "frmSettings", 'class' => "form-horizontal")) ?>
                                             <div class="control-group">
                                                  <label class="control-label">Site Name</label>
                                                  <div class="controls">
                                                       <input value="<?php echo get_settings_by_key('site_name'); ?>" type="text" placeholder="Site Name" class="input-xxlarge" name="settings[site_name]" />
                                                  </div>
                                             </div>
                                             <?php if (get_settings_by_key('site_logo')) { ?>
                                                    <div class="form-group">
                                                         <label class="control-label"></label>
                                                         <div class="controls">
                                                              <div class="input-group">
                                                                   <?php echo img(array('src' => UPLOAD_PATH . 'admin_log/' . get_settings_by_key('site_logo'), 'height' => '80', 'width' => '100', 'id' => 'imgBrandImage')); ?>
                                                              </div>
                                                              <span class="help-block">
                                                                   <a data-url="<?php echo site_url('settings/removeSettings/site_logo'); ?>" 
                                                                      href="javascript:void(0);" style="width: 100px;" class="btnDeleteImage btn btn-block btn-danger btn-xs">Delete</a>
                                                              </span>
                                                         </div>
                                                    </div>
                                               <?php } ?>
                                             <div class="control-group">
                                                  <label class="control-label">Site Logo</label>
                                                  <div class="controls">
                                                       <div id="newupload">
                                                            <input type="hidden" id="x10" name="x1" />
                                                            <input type="hidden" id="y10" name="y1" />
                                                            <input type="hidden" id="x20" name="x2" />
                                                            <input type="hidden" id="y20" name="y2" />
                                                            <input type="hidden" id="w0" name="w" />
                                                            <input type="hidden" id="h0" name="h" />
                                                            <input type="file" class="form-control" style="display: table;margin-bottom: 10px;" 
                                                                   name="site_logo" id="image_file0" onchange="fileSelectHandler('0', '500', '333')" />
                                                            <img id="preview0" class="preview"/>
                                                       </div>
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
                    </div>
               </div>
          </div>
     </div>
</div>