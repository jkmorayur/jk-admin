<div class="row-fluid">
     <div class="span12">
          <!-- BEGIN EXAMPLE TABLE widget-->
          <div class="widget red">
               <div class="widget-title">
                    <h4><i class="icon-list-ul"></i> <?php echo $this->section; ?></h4>
               </div>
               <div class="widget-body">
                    <table class="table table-bordered table-striped" id="sample">
                         <thead>
                              <tr>
                                   <th class="hidden-phone">Name</th>
                                   <th class="hidden-phone">Status</th>
                                   <th class="hidden-phone">Part Number</th>
                                   <th class="hidden-phone">Brand</th>
                                   <th class="hidden-phone">Category</th>
                                   <th class="hidden-phone">Sub Category</th>
                                   <th class="hidden-phone">Edit</th>
                                   <th class="hidden-phone">Delete</th> 
                              </tr>
                         </thead>
                         <tfoot>
                              <tr>
                                   <th class="hidden-phone">Name</th>
                                   <th class="hidden-phone">Status</th>
                                   <th class="hidden-phone">Part Number</th>
                                   <th class="hidden-phone">Brand</th>
                                   <th class="hidden-phone">Category</th>
                                   <th class="hidden-phone">Sub Category</th>
                                   <th class="hidden-phone">Edit</th>
                                   <th class="hidden-phone">Delete</th> 
                              </tr>
                         </tfoot>
                         <tbody>
                              <?php if (!empty($productDetails['product_details'])) { ?>
                                     <?php foreach ($productDetails['product_details'] as $key => $value) { ?>
                                          <tr>
                                               <td class="hidden-phone"><?php echo $value['prd_name']; ?></td>
                                               <td class="hidden-phone"><?php echo $value['prd_status']; ?></td>
                                               <td class="hidden-phone"><?php echo $value['prd_part_number']; ?></td>
                                               <td class="hidden-phone"><?php echo $value['brd_title']; ?></td>
                                               <td class="hidden-phone"><?php echo empty($value['category_name']) ? $value['sub_category_name'] : $value['category_name']; ?></td>
                                               <td class="hidden-phone"><?php echo empty($value['category_name']) ? '' : $value['sub_category_name']; ?></td>
                                               <td  class="hidden-phone">
                                                    <a class="pencile edit" href="<?php echo site_url('product/view/' . $value['prd_id']); ?>">
                                                         <i class="icon-pencil"></i>
                                                    </a>
                                               </td>
                                               <td  class="hidden-phone">
                                                    <a class="pencile deleteRow" id="<?php echo $value['prd_id']; ?>" href="javascript:void(0);" data-url="<?php echo site_url('product/delete/' . $value['prd_id']); ?>">
                                                         <i class="icon-trash"></i>
                                                         </span>
                                               </td>
                                          </tr>
                                     <?php } ?>
                                <?php } ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
</div>