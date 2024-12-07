<?php

//include 'file-manager.class.php';
//include 'file-manager.inc.php';
fm_show_nav_path(FM_PATH); // current path
// show alert messages
fm_show_message();

$num_files = count($files);
$num_folders = count($folders);
$all_files_size = 0;
$tableTheme = (FM_THEME == "dark") ? "text-white bg-dark table-dark" : "bg-white";
?>



<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <!--place content here -->
                        <div id="wrapper">
                            <!-- New Item creation -->
                            <div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="newItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form class="modal-content <?php echo fm_get_theme(); ?>" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i><?php echo lng('CreateNewItem') ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><label for="newfile"><?php echo lng('ItemType') ?> </label></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="newfile" id="customRadioInline1" name="newfile" value="file">
                                                <label class="form-check-label" for="customRadioInline1"><?php echo lng('File') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="newfile" id="customRadioInline2" value="folder" checked>
                                                <label class="form-check-label" for="customRadioInline2"><?php echo lng('Folder') ?></label>
                                            </div>

                                            <p class="mt-3"><label for="newfilename"><?php echo lng('ItemName') ?> </label></p>
                                            <input type="text" name="newfilename" id="newfilename" value="" class="form-control" placeholder="<?php echo lng('Enter here...') ?>" required>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('CreateNow') ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Advance Search Modal -->
                            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content <?php echo fm_get_theme(); ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title col-10" id="searchModalLabel">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?php echo lng('Search') ?> <?php echo lng('a files') ?>" aria-label="<?php echo lng('Search') ?>" aria-describedby="search-addon3" id="advanced-search" autofocus required>
                                                    <span class="input-group-text" id="search-addon3"><i class="fa fa-search"></i></span>
                                                </div>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="lds-facebook"><div></div><div></div><div></div></div>
                                                <ul id="search-wrapper">
                                                    <p class="m-2"><?php echo lng('Search file in folder and subfolders...') ?></p>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Rename Modal -->
                            <div class="modal modal-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="renameDailog">
                                <div class="modal-dialog" role="document">
                                    <form class="modal-content rounded-3 shadow <?php echo fm_get_theme(); ?>" method="post" autocomplete="off">
                                        <div class="modal-body p-4 text-center">
                                            <h5 class="mb-3"><?php echo lng('Are you sure want to rename?') ?></h5>
                                            <p class="mb-1">
                                                <input type="text" name="rename_to" id="js-rename-to" class="form-control" placeholder="<?php echo lng('Enter new file name') ?>" required>
                                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                                <input type="hidden" name="rename_from" id="js-rename-from">
                                            </p>
                                        </div>
                                        <div class="modal-footer flex-nowrap p-0">
                                            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal"><?php echo lng('Cancel') ?></button>
                                            <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"><strong><?php echo lng('Okay') ?></strong></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Confirm Modal -->
                            <script type="text/html" id="js-tpl-confirm">
                                <div class="modal modal-alert confirmDailog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="confirmDailog-<%this.id%>">
                                    <div class="modal-dialog" role="document">
                                        <form class="modal-content rounded-3 shadow <?php echo fm_get_theme(); ?>" method="post" autocomplete="off" action="<%this.action%>">
                                            <div class="modal-body p-4 text-center">
                                                <h5 class="mb-2"><?php echo lng('Are you sure want to') ?> <%this.title%> ?</h5>
                                                <p class="mb-1"><%this.content%></p>
                                            </div>
                                            <div class="modal-footer flex-nowrap p-0">
                                                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal"><?php echo lng('Cancel') ?></button>
                                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                                <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal"><strong><?php echo lng('Okay') ?></strong></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </script>
                        <form action="" method="post" class="pt-3">
                            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
                            <input type="hidden" name="group" value="1">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

                                <table class="ts__table" id="main-table">
                                    <thead class="thead-white">
                                    <tr>
                                        <?php if (!FM_READONLY): ?>
                                            <th style="width:3%" class="custom-checkbox-header">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="js-select-all-items"
                                                           onclick="checkbox_toggle()">
                                                    <label class="custom-control-label" for="js-select-all-items"></label>
                                                </div>
                                            </th><?php endif; ?>
                                        <th><?php echo lng('Name') ?></th>
                                        <th><?php echo lng('Size') ?></th>
                                        <th><?php echo lng('Modified') ?></th>
                                        <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                                            <th><?php echo lng('Perms') ?></th>
                                            <th><?php echo lng('Owner') ?></th><?php endif; ?>
                                        <th><?php echo lng('Actions') ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    // link to parent folder
                                    if ($parent !== false) {
                                        ?>
                                        <tr><?php if (!FM_READONLY): ?>
                                                <td class="nosort"></td><?php endif; ?>
                                            <td class="border-0" data-sort><a href="?p=<?php echo urlencode($parent) ?>"><i
                                                        class="fa fa-chevron-circle-left go-back"></i> ..</a></td>
                                            <td class="border-0" data-order></td>
                                            <td class="border-0" data-order></td>
                                            <td class="border-0"></td>
                                            <?php if (!FM_IS_WIN && !$hide_Cols) { ?>
                                                <td class="border-0"></td>
                                                <td class="border-0"></td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                    $ii = 3399;
                                    foreach ($folders as $f) {
                                        $is_link = is_link($path . '/' . $f);
                                        $img = $is_link ? 'icon-link_folder' : 'far fa-folder';
                                        $modif_raw = filemtime($path . '/' . $f);
                                        $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                                        $date_sorting = strtotime(date("F d Y H:i:s.", $modif_raw));
                                        $filesize_raw = "";
                                        $filesize = lng('Folder');
                                        $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                                        if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                                            $owner = posix_getpwuid(fileowner($path . '/' . $f));
                                            $group = posix_getgrgid(filegroup($path . '/' . $f));
                                            if ($owner === false) {
                                                $owner = array('name' => '?');
                                            }
                                            if ($group === false) {
                                                $group = array('name' => '?');
                                            }
                                        } else {
                                            $owner = array('name' => '?');
                                            $group = array('name' => '?');
                                        }
                                        ?>
                                        <tr>
                                            <?php if (!FM_READONLY): ?>
                                                <td class="custom-checkbox-td">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo $ii ?>" name="file[]"
                                                           value="<?php echo fm_enc($f) ?>">
                                                    <label class="custom-control-label" for="<?php echo $ii ?>"></label>
                                                </div>
                                                </td><?php endif; ?>
                                            <td data-sort=<?php echo fm_convert_win(fm_enc($f)) ?>>
                                                <div class="filename"><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i
                                                            class="<?php echo $img ?>"></i> <?php echo fm_convert_win(fm_enc($f)) ?>
                                                    </a><?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?></div>
                                            </td>
                                            <td data-order="a-<?php echo str_pad($filesize_raw, 18, "0", STR_PAD_LEFT); ?>">
                                                <?php echo $filesize; ?>
                                            </td>
                                            <td data-order="a-<?php echo $date_sorting; ?>"><?php echo $modif ?></td>
                                            <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                                                <td><?php if (!FM_READONLY): ?><a title="Change Permissions"
                                                                                  href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                                                </td>
                                                <td><?php echo $owner['name'] . ':' . $group['name'] ?></td>
                                            <?php endif; ?>
                                            <td class="inline-actions"><?php if (!FM_READONLY): ?>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('Delete') ?>"
                                                       href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>"
                                                       onclick="confirmDailog(event, '1028','<?php echo lng('Delete') . ' ' . lng('Folder'); ?>','<?php echo urlencode($f) ?>', this.href);">
                                                        <i class="fas fa-trash" aria-hidden="true"></i></a>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('Rename') ?>" href="#"
                                                       onclick="rename('<?php echo fm_enc(addslashes(FM_PATH)) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i
                                                            class="fas fa-edit" aria-hidden="true"></i></a>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('CopyTo') ?>..."
                                                       href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i
                                                            class="fas fa-copy" aria-hidden="true"></i></a>
                                                <?php endif; ?>
                                                <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('DirectLink') ?>"
                                                   href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/') ?>"
                                                   target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        flush();
                                        $ii++;
                                    }
                                    $ik = 6070;
                                    foreach ($files as $f) {
                                        $is_link = is_link($path . '/' . $f);
                                        $img = $is_link ? 'far fa-file-alt' : fm_get_file_icon_class($path . '/' . $f);
                                        $modif_raw = filemtime($path . '/' . $f);
                                        $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                                        $date_sorting = strtotime(date("F d Y H:i:s.", $modif_raw));
                                        $filesize_raw = fm_get_size($path . '/' . $f);
                                        $filesize = fm_get_filesize($filesize_raw);
                                        $filelink = '?p=' . urlencode(FM_PATH) . '&amp;view=' . urlencode($f);
                                        $all_files_size += $filesize_raw;
                                        $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                                        if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                                            $owner = posix_getpwuid(fileowner($path . '/' . $f));
                                            $group = posix_getgrgid(filegroup($path . '/' . $f));
                                            if ($owner === false) {
                                                $owner = array('name' => '?');
                                            }
                                            if ($group === false) {
                                                $group = array('name' => '?');
                                            }
                                        } else {
                                            $owner = array('name' => '?');
                                            $group = array('name' => '?');
                                        }
                                        ?>
                                        <tr>
                                            <?php if (!FM_READONLY): ?>
                                                <td class="custom-checkbox-td">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo $ik ?>" name="file[]"
                                                           value="<?php echo fm_enc($f) ?>">
                                                    <label class="custom-control-label" for="<?php echo $ik ?>"></label>
                                                </div>
                                                </td><?php endif; ?>
                                            <td data-sort=<?php echo fm_enc($f) ?>>
                                                <div class="filename">
                                                    <?php
                                                    if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg', 'webp', 'avif'))): ?>
                                                    <?php $imagePreview = fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f); ?>
                                                    <a href="<?php echo $filelink ?>" data-preview-image="<?php echo $imagePreview ?>"
                                                       title="<?php echo fm_enc($f) ?>">
                                                        <?php else: ?>
                                                        <a href="<?php echo $filelink ?>" title="<?php echo $f ?>">
                                                            <?php endif; ?>
                                                            <i class="<?php echo $img ?>"></i> <?php echo fm_convert_win(fm_enc($f)) ?>
                                                        </a>
                                                        <?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?>
                                                </div>
                                            </td>
                                            <td data-order="b-<?php echo str_pad($filesize_raw, 18, "0", STR_PAD_LEFT); ?>"><span
                                                    title="<?php printf('%s bytes', $filesize_raw) ?>">
                        <?php echo $filesize; ?>
                        </span></td>
                                            <td data-order="b-<?php echo $date_sorting; ?>"><?php echo $modif ?></td>
                                            <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                                                <td><?php if (!FM_READONLY): ?><a title="<?php echo 'Change Permissions' ?>"
                                                                                  href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                                                </td>
                                                <td><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></td>
                                            <?php endif; ?>
                                            <td class="inline-actions">
                                                <?php if (!FM_READONLY): ?>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('Delete') ?>"
                                                       href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>"
                                                       onclick="confirmDailog(event, 1209, '<?php echo lng('Delete') . ' ' . lng('File'); ?>','<?php echo urlencode($f); ?>', this.href);">
                                                        <i class="fas fa-trash"></i></a>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('Rename') ?>" href="#"
                                                       onclick="rename('<?php echo fm_enc(addslashes(FM_PATH)) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a class="btn btn-outline-theme-dark btn-sm" title="<?php echo lng('CopyTo') ?>..."
                                                       href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i
                                                            class="fas fa-copy"></i></a>
                                                <?php endif; ?>
                                                <a title="<?php echo lng('DirectLink') ?>"
                                                   href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f) ?>"
                                                   target="_blank"><i class="fa fa-link"></i></a>
                                                <a title="<?php echo lng('Download') ?>"
                                                   href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"
                                                   onclick="confirmDailog(event, 1211, '<?php echo lng('Download'); ?>','<?php echo urlencode($f); ?>', this.href);"><i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        flush();
                                        $ik++;
                                    }

                                    if (empty($folders) && empty($files)) { ?>
                                        <tfoot>
                                        <tr><?php if (!FM_READONLY): ?>
                                                <td></td><?php endif; ?>
                                            <td colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? '6' : '4' ?>">
                                                <em><?php echo lng('Folder is empty') ?></em></td>
                                        </tr>
                                        </tfoot>
                                        <?php
                                    } else { ?>
                                        <tfoot>
                                        <tr>
                                            <td class="gray"
                                                colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? (FM_READONLY ? '6' : '7') : (FM_READONLY ? '4' : '5') ?>">
                                                <?php echo lng('FullSize') . ': <span class="badge badge-danger">' . fm_get_filesize($all_files_size) . '</span>' ?>
                                                <?php echo lng('File') . ': <span class="badge badge-warning">' . $num_files . '</span>' ?>
                                                <?php echo lng('Folder') . ': <span class="badge badge-success">' . $num_folders . '</span>' ?>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>


                            <div class="row">
                                <?php if (!FM_READONLY): ?>
                                    <div class="col-xs-12 col-sm-9">
                                        <ul class="list-inline footer-action">
                                            <li class="list-inline-item"><a href="#/select-all" class="btn btn-primary-1 btn-sm"
                                                                            onclick="select_all();return false;"><i
                                                        class="fa fa-check-square"></i> <?php echo lng('SelectAll') ?> </a></li>
                                            <li class="list-inline-item"><a href="#/unselect-all"
                                                                            class="btn btn-primary-1 btn-sm"
                                                                            onclick="unselect_all();return false;"><i
                                                        class="fa fa-window-close"></i> <?php echo lng('UnSelectAll') ?> </a></li>
                                            <li class="list-inline-item"><a href="#/invert-all" class="btn btn-primary-1 btn-sm"
                                                                            onclick="invert_all();return false;"><i
                                                        class="fa fa-th-list"></i> <?php echo lng('InvertSelection') ?> </a></li>
                                            <li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete"
                                                                                value="Delete"
                                                                                onclick="return confirm('<?php echo lng('Delete selected files and folders?'); ?>')">
                                                <a href="javascript:document.getElementById('a-delete').click();"
                                                   class="btn btn-primary-1 btn-sm"><i
                                                        class="fa fa-trash"></i> <?php echo lng('Delete') ?> </a></li>
                                            <li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip"
                                                                                onclick="return confirm('<?php echo lng('Create archive?'); ?>')">
                                                <a href="javascript:document.getElementById('a-zip').click();"
                                                   class="btn btn-primary-1 btn-sm"><i
                                                        class="far fa-file-archive"></i> <?php echo lng('Zip') ?> </a></li>
                                            <li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar"
                                                                                onclick="return confirm('<?php echo lng('Create archive?'); ?>')">
                                                <a href="javascript:document.getElementById('a-tar').click();"
                                                   class="btn btn-primary-1 btn-sm"><i
                                                        class="far fa-file-archive"></i> <?php echo lng('Tar') ?> </a></li>
                                            <li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy"
                                                                                value="Copy">
                                                <a href="javascript:document.getElementById('a-copy').click();"
                                                   class="btn btn-primary-1 btn-sm"><i
                                                        class="fas fa-copy"></i> <?php echo lng('Copy') ?> </a></li>
                                        </ul>
                                    </div>
                                    <div class="col-3 d-none d-sm-block"><a href="https://tinyfilemanager.github.io" target="_blank"
                                                                            class="float-right text-muted">Tiny File
                                            Manager <?php echo VERSION; ?></a></div>
                                <?php else: ?>
                                    <div class="col-12"><a href="https://tinyfilemanager.github.io" target="_blank"
                                                           class="float-right text-muted">Tiny File Manager <?php echo VERSION; ?></a></div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- /.content -->
