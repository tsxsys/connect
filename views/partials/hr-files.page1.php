<?php
/**
 * Page that allows admins to verify or delete new (unverified) users
 **/

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary card-outline ecni_x ecni_x_file_upload">
                    <div class="card-header">
                        <h3 class="card-title">File zone</h3>
                    </div>
                    <div class="card-body">
                        <form
                                id="fileupload"
                                action=""
                                method="POST"
                                enctype="multipart/form-data"
                        >
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript
                            ><input
                                        type="hidden"
                                        name="redirect"
                                        value=""
                                /></noscript>
                            <div class="row fileupload-buttonbar">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fileCategory">Category</label>
                                        <select class="custom-select form-control-sm form-control-border"
                                                id="fileCategory">
                                            <option value="employee_doc">Employee Document</option>
                                            <option value="training_doc">Training Material</option>
                                            <option value="general_doc">General</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <div class="form-group text-center">
                                        <div class="btn-group ecni_x_btn_group">
                                            <span class="btn btn-sm btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Add Files...</span>
                                                <input type="file" name="files[]" multiple/>
                                            </span>
                                            <button type="submit" class="btn btn-sm btn-primary start">
                                                <i class="glyphicon glyphicon-upload"></i>
                                                <span>Upload All</span>
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-warning cancel">
                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                <span>Cancel upload</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                <span>Delete selected</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input toggle" type="checkbox"
                                                       id="toggle_select_all">
                                                <label for="toggle_select_all" class="custom-control-label">Select All</label>
                                            </div>
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process"></span>
                                        </div>
                                        <!-- The global progress state -->
                                        <div class="col-lg-8 fileupload-progress fade">
                                            <!-- The global progress bar -->
                                            <div
                                                    class="progress progress-striped active"
                                                    role="progressbar"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                            >
                                                <div
                                                        class="progress-bar progress-bar-success"
                                                        style="width: 0%;"
                                                ></div>
                                            </div>
                                            <!-- The extended global progress state -->
                                            <div class="progress-extended">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download
                            <div class="file__viewer scroll__bar2">-->
                                <table role="presentation" class="table table-striped">
                                    <tbody class="files"></tbody>
                                </table>
<!--                            </div>-->
                        </form>
                        <!-- The blueimp Gallery widget -->
                        <div
                                id="blueimp-gallery"
                                class="blueimp-gallery blueimp-gallery-controls"
                                aria-label="image gallery"
                                aria-modal="true"
                                role="dialog"
                                data-filter=":even"
                        >
                            <div class="slides" aria-live="polite"></div>
                            <h3 class="title"></h3>
                            <a
                                    class="prev"
                                    aria-controls="blueimp-gallery"
                                    aria-label="previous slide"
                                    aria-keyshortcuts="ArrowLeft"
                            ></a>
                            <a
                                    class="next"
                                    aria-controls="blueimp-gallery"
                                    aria-label="next slide"
                                    aria-keyshortcuts="ArrowRight"
                            ></a>
                            <a
                                    class="close"
                                    aria-controls="blueimp-gallery"
                                    aria-label="close"
                                    aria-keyshortcuts="Escape"
                            ></a>
                            <a
                                    class="play-pause"
                                    aria-controls="blueimp-gallery"
                                    aria-label="play slideshow"
                                    aria-keyshortcuts="Space"
                                    aria-pressed="false"
                                    role="button"
                            ></a>
                            <ol class="indicator"></ol>
                        </div>
                        <!-- The template to display files available for upload -->
                        <script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  <p class="name">{%=file.name%}</p>
                  <strong class="error text-danger"></strong>
              </td>
              <td>
                  <p class="size">Processing...</p>
                  <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
              </td>
              <td>
                  {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                    <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                        <i class="glyphicon glyphicon-edit"></i>
                        <span>Edit</span>
                    </button>
                  {% } %}
                  {% if (!i && !o.options.autoUpload) { %}
                      <button class="btn btn-primary start" disabled>
                          <i class="glyphicon glyphicon-upload"></i>
                          <span>Start</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
                        <!-- The template to display files available for download -->
                        <script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download1 fade1{%=file.thumbnailUrl?' image':''%}">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td>
                  {% if (file.deleteUrl) { %}
                      <button class="btn btn-xs btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="fas fa-trash"></i>
                          <span>Delete</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->