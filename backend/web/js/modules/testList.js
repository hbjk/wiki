define(function(require, exports, module) {
    exports.editArticle = function () {
        var ue = UE.getEditor('editor',{
            initialFrameHeight: 450,
            initialFrameWidth: null
        });

    };
    exports.addArticle = function () {
        $(function(){
            var ue = UE.getEditor('editor',{
                initialFrameHeight: 450,
                initialFrameWidth: null
            });
            ue.ready(function() {
                //设置编辑器的内容
                ue.setContent('此处填写体检项目介绍！');
            });
            $('#tijiao').click(function(){
                var data = $("#w0").serialize();
                $.ajax({
                    type:'post',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(d) {
                        if(d.done==true){
                            swal({
                                'title': '添加文章成功',
                                'type': 'success',
                            }, function (isConfirm) {
                                if(isConfirm){
                                    window.location.href = "/test/list";
                                }
                            });
                        }else {
                            swal(d.error);
                        }
                    }
                });
            });
        });
    };

    exports.load = function(){
        $('.btn-danger').click(function(){
            var that = $(this);
            swal({
                    title: "您是确认删除该体检项目吗？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = that.attr('data');
                    }
                });
        });

        //排序
        var sortVal = '';

        $("input[name='testId']").focus(function(){
            sortVal = $(this).val();
        });

        //判断输入的一个数是不是正整数
        $("input[name='testId']").keyup(function(){
            var value = $(this).val();
            if((/^(\+|-)?\d+$/.test( value )) && value>0){
                return true;
            }else{
                swal('请输入正整数!');
                $(this).val(sortVal);
                return false;
            }
        });

        $("input[name='testId']").change(function(){
            var that = $(this);
            $.ajax({
                type:'post',
                url: that.attr('d-act'),
                dataType: 'json',
                data:{
                    sort: that.val(),
                    id: that.attr('id')
                },
                success: function(data) {
                    if(data.done == true){
                        swal({
                            title: "提示",
                            type: "success",
                            text: '操作成功'
                        });
                    }
                }
            });
        });
        $("#w1").on("select2:select", function () {
            $("#w0").submit();
        })
    };
});