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
                                                       <input value="<?php echo get_settings_by_key('site_url'); ?>" type="text" placeholder="Site Url" class="input-xxlarge" name="site_url" />
                                                       <!--<span class="help-inline">Some hint here</span>-->
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
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>