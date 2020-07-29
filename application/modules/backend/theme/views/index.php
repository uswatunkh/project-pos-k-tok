<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-archive"></i> Theme Setting</h3>
                </div><!-- /.box-header -->

                <form id="dt_form" action="<?php echo backend_url() . this_module(); ?>/save_action" class="form-horizontal" method="post">
                    <div class="box-body wd-form">

                        <?php show_alert('success', $this->session->flashdata('success_message')); ?>
                        <?php show_alert('danger', $this->session->flashdata('danger_message')); ?>

                        <div class="callout callout-warning validate-js-message">
                            <h4><i class="icon fa fa-warning"></i> Warning</h4>

                            <?php echo wd_validation_errors();
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label" style="margin-top:10px;">Theme*</label>
                            <div class="col-sm-4">
                                <table class="table table-privileges col-sm-12">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-blue-modern"); ?> value='skin-blue-modern' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Modern Blue </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-blue-modern-light"); ?> value='skin-blue-modern-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Modern Blue Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-blue"); ?> value='skin-blue' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Blue </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-blue-light"); ?> value='skin-blue-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Blue Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-black"); ?> value='skin-black' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Dark </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-black-light"); ?> value='skin-black-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Dark Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-purple"); ?> value='skin-purple' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Purple </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-purple-light"); ?> value='skin-purple-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Purple Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-green"); ?> value='skin-green' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Green </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-green-light"); ?> value='skin-green-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Green Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-red"); ?> value='skin-red' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Red </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-red-light"); ?> value='skin-blue-right' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Red Light </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-yellow"); ?> value='skin-yellow' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Yellow </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('theme'), $theme[0]['value'], "skin-yellow-light"); ?> value='skin-yellow-light' type='radio' class='minimal' name='theme'>&nbsp;&nbsp;&nbsp; Skin Yellow Light </label>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label" style="margin-top:10px;">Layout*</label>
                            <div class="col-sm-4">
                                <table class="table table-privileges col-sm-12">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('layout'), $layout[0]['value'], ""); ?> value='' type='radio' class='minimal' name='layout'>&nbsp;&nbsp;&nbsp; Default Layout </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('layout'), $layout[0]['value'], "fixed"); ?> value='fixed' type='radio' class='minimal' name='layout'>&nbsp;&nbsp;&nbsp; Fixed Layout </label>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label" style="margin-top:10px;">Sidebar*</label>
                            <div class="col-sm-4">
                                <table class="table table-privileges col-sm-12">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('sidebar'), $sidebar[0]['value'], ""); ?> value='' type='radio' class='minimal' name='sidebar'>&nbsp;&nbsp;&nbsp; Default Sidebar </label>
                                            </td>
                                            <td class="col-sm-3">
                                                <label style="font-weight: 400" class=' radio'><input <?php echo set_value_edit_check(wd_set_value('sidebar'), $sidebar[0]['value'], "sidebar-collapse"); ?> value='sidebar-collapse' type='radio' class='minimal' name='sidebar'>&nbsp;&nbsp;&nbsp; Toggle Sidebar </label>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div><!-- /.box-body -->

                    <span class="wd-box-helper"></span>
                    <div class="wd-box-action">
                        <div class="col-sm-offset-2">
                            <div class="wd-box-action-btn">
                                <button type="submit" class="btn btn-info">Save</button>
                                <a href="<?php echo backend_url() . this_module(); ?>" class="btn btn-default">Back to List</a>
                            </div>
                        </div>
                    </div><!-- /.box-footer -->

                    <div class="wd-box-required">
                        <hr>
                        <span class="required">*</span>
                        Field Required
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2017-01-26 02:30:48 */

-->