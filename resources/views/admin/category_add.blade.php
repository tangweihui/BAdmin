@extends('base.base')
@section('base')
    <!-- 内容区域 -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">请填写分类信息</h4>
                            {{--<p class="card-description">--}}
                            {{--Basic form elements--}}
                            {{--</p>--}}
                            <form class="forms-sample" id="form">
                                <div class="form-group">
                                    <label >* 分类标题</label>
                                    <input type="text"  class="form-control required" name="title" placeholder="分类标题">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">*上级分类</label>
                                    <select class="form-control required" name="pid" >
                                        <option value="0">顶级菜单</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="string">
                                    <label >* 排序</label>
                                    <input type="text" name="sort" class="form-control value-input required"  placeholder="0">
                                </div>
                                <div class="form-group" id="image">
                                    <label>* 图片</label>
                                    <input type="file" class="file-upload-default img-file" data-path="image">
                                    <input type="hidden" name="image" class="image-path">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" onclick="upload($(this))" type="button">上传</button>
                                        </span>
                                    </div>
                                    <div class="img-yl">
                                    </div>
                                </div>
                                <button type="button" onclick="commit()" class="btn btn-sm btn-gradient-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    提交
                                </button>
                                <button type="button" onclick="cancel()" class="btn btn-sm btn-gradient-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i>
                                    取消
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var editor = new wangEditor('editor');
        // 上传图片（举例）
        editor.config.uploadImgUrl = "/admin/wangeditor/upload";
        // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
        editor.config.hideLinkImg = false;
        editor.create();
        function commit(){
            if(!checkForm()){
                return false;
            }
            var data = $("#form").serializeObject();
            myRequest("/admin/category/add","post",data,function(res){
                layer.msg(res.msg)
                setTimeout(function(){
                    parent.location.reload();
                },1500)
            });
        }
        function cancel() {
            parent.location.reload();
        }
    </script>
@endsection
