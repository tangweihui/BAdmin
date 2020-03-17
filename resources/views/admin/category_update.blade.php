@extends('base.base')
@section('base')
    <!-- 内容区域 -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">请修改分类信息</h4>
                            {{--<p class="card-description">--}}
                            {{--Basic form elements--}}
                            {{--</p>--}}
                            <form class="forms-sample" id="form">
                                <div class="form-group">
                                    <label >* 分类标题</label>
                                    <input type="text"  class="form-control required" name="title" placeholder="配置描述" value="{{ $data->title }}">
                                </div>
                                <div class="form-group">
                                    <label >* 排序</label>
                                    <input type="text"  class="form-control required" name="sort" placeholder="key" value="{{ $data->sort }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword4">上级分类</label>
                                    <select class="form-control required" name="pid" >
                                        <option value="0">顶级分类</option>
                                        @foreach($categories as $cate)
                                            <option @if($data->pid == $cate->id) selected @endif value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="image">
                                    <label>* 图片</label>
                                    <input type="file" class="file-upload-default img-file" data-path="image">
                                    <input type="hidden" class="image-path" name="image" value="{{ $data->image }}">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" value="{{ $data->image }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" onclick="upload($(this))" type="button">上传</button>
                                        </span>
                                    </div>
                                    <div class="img-yl" style="display: block;">
                                        <img src="{{ $data->image }}" alt="">
                                    </div>
                                </div>
                                <button type="button" onclick="commit({{ $data->id }})" class="btn btn-sm btn-gradient-primary btn-icon-text">
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
        function commit(id){
            if(!checkForm()){
                return false;
            }
            var data = $("#form").serializeObject();
            myRequest("/admin/category/update/"+id,"post",data,function(res){
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
