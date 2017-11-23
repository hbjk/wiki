define(function(require, exports, module) {
    var init = require ('init');
    exports.load = function () {
        $("#userEdit").click(function () {
            init.confirm('baidu.com','处理成功');
        });
    }
})